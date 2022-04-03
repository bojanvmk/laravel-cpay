<?php declare(strict_types=1);

namespace Bojanvmk\CPay\RecurringPayments\ServiceType;

use Bojanvmk\CPay\RecurringPayments\StructType\SendPayment;
use Bojanvmk\CPay\RecurringPayments\StructType\SendPaymentResponse;
use SoapFault;
use WsdlToPhp\PackageBase\AbstractSoapClientBase;

class Send extends AbstractSoapClientBase
{
    /**
     * Method to call the operation originally named sendPayment
     * @uses AbstractSoapClientBase::setResult()
     * @uses AbstractSoapClientBase::saveLastError()
     * @uses AbstractSoapClientBase::getSoapClient()
     */
    public function sendPayment(SendPayment $parameters): ?SendPaymentResponse
    {
        try {
            $result = $this->getSoapClient()->__soapCall(
                'sendPayment',
                [$parameters],
                [],
                [],
                $this->outputHeaders
            );

            $this->setResult($result);

            return $result;
        }
        catch (SoapFault $soapFault) {
            $this->saveLastError(__METHOD__, $soapFault);

            return null;
        }
    }

    /**
     * @see AbstractSoapClientBase::getResult()
     */
    public function getResult(): SendPaymentResponse
    {
        return parent::getResult();
    }
}
