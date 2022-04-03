<?php

namespace Bojanvmk\CPay\RecurringPayments;

use Bojanvmk\CPay\Exceptions\RecurringPaymentException;
use Bojanvmk\CPay\RecurringPayments\ServiceType\Send;
use Bojanvmk\CPay\RecurringPayments\StructType\RecurringPaymentRequest;
use Bojanvmk\CPay\RecurringPayments\StructType\SendPayment;
use Bojanvmk\CPay\RecurringPayments\StructType\SendPaymentResponse;
use WsdlToPhp\PackageBase\AbstractSoapClientBase;

class CPayRecurring
{
    private int    $amount;
    private string $rPRef;
    private string $rPRefID;
    private string $merchantId;

    public function __construct(int $amount, string $rPRef, string $rPRefID)
    {
        $this->amount     = $amount;
        $this->rPRef      = $rPRef;
        $this->rPRefID    = $rPRefID;
        $this->merchantId = config('cpay.merchant_id');
        $this->md5        = $this->generateChecksum();
    }

    private function generateChecksum(): string
    {
        $parameters = [
            'MerchantID' => $this->merchantId,
            'RPRefID'    => $this->rPRefID,
            'RPRef'      => $this->rPRef,
            'Amount'     => $this->amount,
        ];

        $values = '';
        foreach ($parameters as $value) {
            $values .= $value;
        }

        return md5($values . config('cpay.auth_key'));
    }

    public function makeRequest(): SendPaymentResponse
    {
        $send = new Send([
            AbstractSoapClientBase::WSDL_URL      => config('cpay.recurring_wsdl'),
            AbstractSoapClientBase::WSDL_CLASSMAP => ClassMap::get(),
        ]);

        $request = new RecurringPaymentRequest(
            $this->amount,
            $this->md5,
            $this->merchantId,
            $this->rPRef,
            $this->rPRefID,
        );
        $payment = new SendPayment($request);
        $result  = $send->sendPayment($payment);

        if (! $result) {
            throw new RecurringPaymentException(json_encode($send->getLastError()));
        }

        return $result;
    }
}
