<?php

namespace Bojanvmk\CPay;

use Illuminate\Support\Facades\Validator;

class CPay
{
    const RECURRING_PAYMENT_REGISTER = 'R';
    const RECURRING_PAYMENT_CANCEL   = 'C';

    // required
    private int    $amountToPay;
    private string $amountCurrency;
    private int    $payToMerchant;
    private string $merchantName;
    private string $paymentOKURL;
    private string $paymentFailURL;
    private string $details1; // description
    private string $details2; // must be unique per payment, e.g. order id
    private string $checkSumHeader = '';
    private string $checkSum       = '';

    // for displaying purposes only
    private int     $originalAmount;
    private string  $originalCurrency;
    private ?string $fee = null; // any addition fee added to the original amount, e.g. 10% fee

    // Requires additional contract/agreement with the bank
    private ?string $rPRef           = null; // used with recurring payments
    private ?string $transactionType = null; // for refund use 004
    private ?int    $installment     = null; // number of installments

    // user parameters
    private ?string $email     = null;
    private ?string $firstName = null;
    private ?string $lastName  = null;
    private ?string $address   = null;
    private ?string $city      = null;
    private ?int    $zip       = null;
    private ?string $country   = null;
    private ?string $telephone = null;

    public function __construct(int $amount, int $orderId, string $description = '')
    {
        $this->amountToPay      = $amount * 100;
        $this->amountCurrency   = config('cpay.currency');
        $this->payToMerchant    = config('cpay.merchant_id');
        $this->merchantName     = config('cpay.merchant_name');
        $this->paymentOKURL     = config('cpay.success_url');
        $this->paymentFailURL   = config('cpay.failure_url');
        $this->details1         = $description;
        $this->details2         = $orderId;
        $this->originalAmount   = $amount;
        $this->originalCurrency = config('cpay.currency');

        $this->validateParameters();
    }

    public static function initFromParameters(array $parameters): self
    {
        $newInstance = new self($parameters['AmountToPay'], $parameters['Details2'], $parameters['Details1']);

        foreach ($parameters as $name => $value) {
            $newInstance->{lcfirst($name)} = $value;
        }

        $newInstance->validateParameters();

        return $newInstance;
    }

    public function getCheckSumHeader(): string
    {
        return $this->checkSumHeader ?: $this->setChecksums()->checkSumHeader;
    }

    public function getCheckSum(): string
    {
        return $this->checkSum ?: $this->setChecksums()->checkSum;
    }

    public function setRecurringPayment(string $billingCycle, int $maxBCycles = null, int $billingAmount = -1, string $billingCycleStart = '00000000'): self
    {
        $requestType = static::RECURRING_PAYMENT_REGISTER;
        $maxBCycles  = $maxBCycles ?? '';
        $this->rPRef = "$requestType,$billingCycle,$maxBCycles,$billingAmount,$billingCycleStart";

        return $this;
    }

    public function setTransactionType(string $transactionType): self
    {
        $this->transactionType = $transactionType;

        return $this;
    }

    public function setFee(string $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function setInstallment(int $installment): self
    {
        $this->installment = $installment;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function setZip(int $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function renderHiddenInputs(): string
    {
        $parameters = $this->getParameters(true);

        return view('laravel-cpay::hidden-inputs', [
            'parameters' => $parameters,
        ])->render();
    }

    public function getParameters(bool $withCheckSumAndCheckSumHeader = false): array
    {
        $parameters = array_filter($this->getAllParameters(), fn($param) => ! empty($param));

        if ($withCheckSumAndCheckSumHeader) {
            $parameters['CheckSumHeader'] = $this->getCheckSumHeader();
            $parameters['CheckSum']       = $this->getCheckSum();
        }

        return $parameters;
    }

    public function verifyReturnChecksum(int $cPayPaymentRef, string $returnCheckSum, string $returnRPRef = null): bool
    {
        // reverse the first 2 parameters places and add cPayPaymentRef at the end
        $parameters          = $this->getParameters();

        // use their returned hashed RPRef value instead of our
        if ($returnRPRef) {
            $parameters['RPRef'] = $returnRPRef;
        }

        $names               = array_keys($parameters);
        $values              = array_values($parameters);
        $reversedParamsArray = [$names[1] => $values[1]] + [$names[0] => $values[0]] + array_slice($parameters, 2);
        $returnParameters    = $reversedParamsArray + ['cPayPaymentRef' => $cPayPaymentRef];

        [, $checkSum] = $this->generateChecksums($returnParameters);

        return $checkSum === $returnCheckSum;
    }

    private function getAllParameters(): array
    {
        return [
            'AmountToPay'      => $this->amountToPay,
            'AmountCurrency'   => $this->amountCurrency,
            'PayToMerchant'    => $this->payToMerchant,
            'MerchantName'     => $this->merchantName,
            'PaymentOKURL'     => $this->paymentOKURL,
            'PaymentFailURL'   => $this->paymentFailURL,
            'Details1'         => $this->details1,
            'Details2'         => $this->details2,
            'OriginalAmount'   => $this->originalAmount,
            'OriginalCurrency' => $this->originalCurrency,
            'RPRef'            => $this->rPRef,
            'TransactionType'  => $this->transactionType,
            'Fee'              => $this->fee,
            'Installment'      => $this->installment,
            'Email'            => $this->email,
            'FirstName'        => $this->firstName,
            'LastName'         => $this->lastName,
            'Address'          => $this->address,
            'City'             => $this->city,
            'Zip'              => $this->zip,
            'Country'          => $this->country,
            'Telephone'        => $this->telephone,
        ];
    }

    private function setChecksums(): self
    {
        [$checkSumHeader, $checkSum] = $this->generateChecksums();

        $this->checkSumHeader = $checkSumHeader;
        $this->checkSum       = $checkSum;

        return $this;
    }

    private function generateChecksums(array $parameters = null): array
    {
        $parameters = $parameters ?? $this->getParameters();
        $keys       = '';
        $lengths    = '';
        $values     = '';

        foreach ($parameters as $key => $value) {
            $keys    .= $key . ',';
            $lengths .= sprintf("%03d", mb_strlen($value, 'UTF-8'));
            $values  .= $value;
        }

        $checkSumHeader = sprintf("%02d", count($parameters)) . $keys . $lengths;
        $inputString    = $checkSumHeader . $values . config('cpay.auth_key');
        $checkSum       = strtoupper(md5($inputString));

        return [$checkSumHeader, $checkSum];
    }

    private function validateParameters(): array
    {
        return Validator::make($this->getAllParameters(), [
            'AmountToPay'      => 'required|integer|gt:0',
            'AmountCurrency'   => 'required|string|max:3',
            'PayToMerchant'    => 'required|integer',
            'MerchantName'     => 'required|string|max:200',
            'Details1'         => 'required|string|max:100',
            'Details2'         => 'required|string|max:100',
            'PaymentOKURL'     => 'required|string|max:500',
            'PaymentFailURL'   => 'required|string|max:500',
            'OriginalAmount'   => 'sometimes|integer|gt:0',
            'OriginalCurrency' => 'sometimes|string|max:3',
        ])->validate();
    }
}
