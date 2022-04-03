<?php declare(strict_types=1);

namespace Bojanvmk\CPay\RecurringPayments\StructType;

use InvalidArgumentException;
use WsdlToPhp\PackageBase\AbstractStructBase;

/**
 * This class stands for sendPayment StructType
 * @subpackage Structs
 */
class SendPayment extends AbstractStructBase
{
    /**
     * The request
     * Meta information extracted from the WSDL
     * - minOccurs: 0
     * - nillable: true
     */
    protected ?RecurringPaymentRequest $request = null;
    /**
     * Constructor method for sendPayment
     * @uses SendPayment::setRequest()
     */
    public function __construct(?RecurringPaymentRequest $request = null)
    {
        $this
            ->setRequest($request);
    }
    /**
     * Get request value
     * An additional test has been added (isset) before returning the property value as
     * this property may have been unset before, due to the fact that this property is
     * removable from the request (nillable=true+minOccurs=0)
     */
    public function getRequest(): ?RecurringPaymentRequest
    {
        return isset($this->request) ? $this->request : null;
    }
    /**
     * Set request value
     * This property is removable from request (nillable=true+minOccurs=0), therefore
     * if the value assigned to this property is null, it is removed from this object
     * @param RecurringPaymentRequest $request
     */
    public function setRequest(?RecurringPaymentRequest $request = null): self
    {
        if (is_null($request) || (is_array($request) && empty($request))) {
            unset($this->request);
        } else {
            $this->request = $request;
        }

        return $this;
    }
}
