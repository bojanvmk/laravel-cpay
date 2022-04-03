<?php declare(strict_types=1);

namespace Bojanvmk\CPay\RecurringPayments\StructType;

use InvalidArgumentException;
use WsdlToPhp\PackageBase\AbstractStructBase;

/**
 * This class stands for RecurringPaymentRequest StructType
 * Meta information extracted from the WSDL
 * - nillable: true
 * - type: tns:RecurringPaymentRequest
 * @subpackage Structs
 */
class RecurringPaymentRequest extends AbstractStructBase
{
    /**
     * The Amount
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * @var float|null
     */
    protected ?float $Amount = null;
    /**
     * The MD5
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     * @var string|null
     */
    protected ?string $MD5 = null;
    /**
     * The MerchantID
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     * @var string|null
     */
    protected ?string $MerchantID = null;
    /**
     * The RPRef
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     * @var string|null
     */
    protected ?string $RPRef = null;
    /**
     * The RPRefID
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     * @var string|null
     */
    protected ?string $RPRefID = null;
    /**
     * Constructor method for RecurringPaymentRequest
     * @uses RecurringPaymentRequest::setAmount()
     * @uses RecurringPaymentRequest::setMD5()
     * @uses RecurringPaymentRequest::setMerchantID()
     * @uses RecurringPaymentRequest::setRPRef()
     * @uses RecurringPaymentRequest::setRPRefID()
     * @param float $amount
     * @param string $mD5
     * @param string $merchantID
     * @param string $rPRef
     * @param string $rPRefID
     */
    public function __construct(?float $amount = null, ?string $mD5 = null, ?string $merchantID = null, ?string $rPRef = null, ?string $rPRefID = null)
    {
        $this
            ->setAmount($amount)
            ->setMD5($mD5)
            ->setMerchantID($merchantID)
            ->setRPRef($rPRef)
            ->setRPRefID($rPRefID);
    }
    /**
     * Get Amount value
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->Amount;
    }
    /**
     * Set Amount value
     * @param float $amount
     * @return RecurringPaymentRequest
     */
    public function setAmount(?float $amount = null): self
    {
        // validation for constraint: float
        if (!is_null($amount) && !(is_float($amount) || is_numeric($amount))) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a float value, %s given', var_export($amount, true), gettype($amount)), __LINE__);
        }
        $this->Amount = $amount;

        return $this;
    }
    /**
     * Get MD5 value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     * @return string|null
     */
    public function getMD5(): ?string
    {
        return isset($this->MD5) ? $this->MD5 : null;
    }
    /**
     * Set MD5 value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     * @param string $mD5
     * @return RecurringPaymentRequest
     */
    public function setMD5(?string $mD5 = null): self
    {
        // validation for constraint: string
        if (!is_null($mD5) && !is_string($mD5)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a string, %s given', var_export($mD5, true), gettype($mD5)), __LINE__);
        }
        if (is_null($mD5) || (is_array($mD5) && empty($mD5))) {
            unset($this->MD5);
        } else {
            $this->MD5 = $mD5;
        }

        return $this;
    }
    /**
     * Get MerchantID value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     * @return string|null
     */
    public function getMerchantID(): ?string
    {
        return isset($this->MerchantID) ? $this->MerchantID : null;
    }
    /**
     * Set MerchantID value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     * @param string $merchantID
     * @return RecurringPaymentRequest
     */
    public function setMerchantID(?string $merchantID = null): self
    {
        // validation for constraint: string
        if (!is_null($merchantID) && !is_string($merchantID)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a string, %s given', var_export($merchantID, true), gettype($merchantID)), __LINE__);
        }
        if (is_null($merchantID) || (is_array($merchantID) && empty($merchantID))) {
            unset($this->MerchantID);
        } else {
            $this->MerchantID = $merchantID;
        }

        return $this;
    }
    /**
     * Get RPRef value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     * @return string|null
     */
    public function getRPRef(): ?string
    {
        return isset($this->RPRef) ? $this->RPRef : null;
    }
    /**
     * Set RPRef value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     * @param string $rPRef
     */
    public function setRPRef(?string $rPRef = null): self
    {
        // validation for constraint: string
        if (!is_null($rPRef) && !is_string($rPRef)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a string, %s given', var_export($rPRef, true), gettype($rPRef)), __LINE__);
        }
        if (is_null($rPRef) || (is_array($rPRef) && empty($rPRef))) {
            unset($this->RPRef);
        } else {
            $this->RPRef = $rPRef;
        }

        return $this;
    }
    /**
     * Get RPRefID value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     */
    public function getRPRefID(): ?string
    {
        return isset($this->RPRefID) ? $this->RPRefID : null;
    }
    /**
     * Set RPRefID value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     */
    public function setRPRefID(?string $rPRefID = null): self
    {
        // validation for constraint: string
        if (!is_null($rPRefID) && !is_string($rPRefID)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a string, %s given', var_export($rPRefID, true), gettype($rPRefID)), __LINE__);
        }
        if (is_null($rPRefID) || (is_array($rPRefID) && empty($rPRefID))) {
            unset($this->RPRefID);
        } else {
            $this->RPRefID = $rPRefID;
        }

        return $this;
    }
}
