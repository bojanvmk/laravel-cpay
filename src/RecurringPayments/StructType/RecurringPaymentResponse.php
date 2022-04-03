<?php declare(strict_types=1);

namespace Bojanvmk\CPay\RecurringPayments\StructType;

use InvalidArgumentException;
use WsdlToPhp\PackageBase\AbstractStructBase;

/**
 * This class stands for RecurringPaymentResponse StructType
 * Meta information extracted from the WSDL
 * - nillable: true
 * - type: tns:RecurringPaymentResponse
 * @subpackage Structs
 */
class RecurringPaymentResponse extends AbstractStructBase
{
    /**
     * The CPayPaymentRef
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     * @var string|null
     */
    protected ?string $CPayPaymentRef = null;
    /**
     * The ErrorDecription
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     * @var string|null
     */
    protected ?string $ErrorDecription = null;
    /**
     * The RPRef
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     * @var string|null
     */
    protected ?string $RPRef = null;
    /**
     * The Success
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * @var bool|null
     */
    protected ?bool $Success = null;
    /**
     * Constructor method for RecurringPaymentResponse
     * @uses RecurringPaymentResponse::setCPayPaymentRef()
     * @uses RecurringPaymentResponse::setErrorDecription()
     * @uses RecurringPaymentResponse::setRPRef()
     * @uses RecurringPaymentResponse::setSuccess()
     * @param string $cPayPaymentRef
     * @param string $errorDecription
     * @param string $rPRef
     * @param bool $success
     */
    public function __construct(?string $cPayPaymentRef = null, ?string $errorDecription = null, ?string $rPRef = null, ?bool $success = null)
    {
        $this
            ->setCPayPaymentRef($cPayPaymentRef)
            ->setErrorDecription($errorDecription)
            ->setRPRef($rPRef)
            ->setSuccess($success);
    }
    /**
     * Get CPayPaymentRef value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     * @return string|null
     */
    public function getCPayPaymentRef(): ?string
    {
        return isset($this->CPayPaymentRef) ? $this->CPayPaymentRef : null;
    }
    /**
     * Set CPayPaymentRef value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     * @param string $cPayPaymentRef
     */
    public function setCPayPaymentRef(?string $cPayPaymentRef = null): self
    {
        // validation for constraint: string
        if (!is_null($cPayPaymentRef) && !is_string($cPayPaymentRef)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a string, %s given', var_export($cPayPaymentRef, true), gettype($cPayPaymentRef)), __LINE__);
        }
        if (is_null($cPayPaymentRef) || (is_array($cPayPaymentRef) && empty($cPayPaymentRef))) {
            unset($this->CPayPaymentRef);
        } else {
            $this->CPayPaymentRef = $cPayPaymentRef;
        }

        return $this;
    }
    /**
     * Get ErrorDecription value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     * @return string|null
     */
    public function getErrorDecription(): ?string
    {
        return isset($this->ErrorDecription) ? $this->ErrorDecription : null;
    }
    /**
     * Set ErrorDecription value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     * @param string $errorDecription
     */
    public function setErrorDecription(?string $errorDecription = null): self
    {
        // validation for constraint: string
        if (!is_null($errorDecription) && !is_string($errorDecription)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a string, %s given', var_export($errorDecription, true), gettype($errorDecription)), __LINE__);
        }
        if (is_null($errorDecription) || (is_array($errorDecription) && empty($errorDecription))) {
            unset($this->ErrorDecription);
        } else {
            $this->ErrorDecription = $errorDecription;
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
     * Get Success value
     * @return bool|null
     */
    public function getSuccess(): ?bool
    {
        return $this->Success;
    }
    /**
     * Set Success value
     * @param bool $success
     */
    public function setSuccess(?bool $success = null): self
    {
        // validation for constraint: boolean
        if (!is_null($success) && !is_bool($success)) {
            throw new InvalidArgumentException(sprintf('Invalid value %s, please provide a bool, %s given', var_export($success, true), gettype($success)), __LINE__);
        }
        $this->Success = $success;

        return $this;
    }
}
