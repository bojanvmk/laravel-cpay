<?php declare(strict_types=1);

namespace Bojanvmk\CPay\RecurringPayments\StructType;

use InvalidArgumentException;
use WsdlToPhp\PackageBase\AbstractStructBase;

/**
 * This class stands for sendPaymentResponse StructType
 * @subpackage Structs
 */
class SendPaymentResponse extends AbstractStructBase
{
    /**
     * The sendPaymentResult
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     */
    protected ?RecurringPaymentResponse $sendPaymentResult = null;
    /**
     * Constructor method for sendPaymentResponse
     * @uses SendPaymentResponse::setSendPaymentResult()
     */
    public function __construct(?RecurringPaymentResponse $sendPaymentResult = null)
    {
        $this
            ->setSendPaymentResult($sendPaymentResult);
    }
    /**
     * Get sendPaymentResult value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     */
    public function getSendPaymentResult(): ?RecurringPaymentResponse
    {
        return isset($this->sendPaymentResult) ? $this->sendPaymentResult : null;
    }
    /**
     * Set sendPaymentResult value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     */
    public function setSendPaymentResult(?RecurringPaymentResponse $sendPaymentResult = null): self
    {
        if (is_null($sendPaymentResult) || (is_array($sendPaymentResult) && empty($sendPaymentResult))) {
            unset($this->sendPaymentResult);
        } else {
            $this->sendPaymentResult = $sendPaymentResult;
        }

        return $this;
    }
}
