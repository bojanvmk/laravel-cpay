<?php declare(strict_types=1);

namespace Bojanvmk\CPay\RecurringPayments;

use Bojanvmk\CPay\RecurringPayments\StructType\RecurringPaymentRequest;
use Bojanvmk\CPay\RecurringPayments\StructType\RecurringPaymentResponse;
use Bojanvmk\CPay\RecurringPayments\StructType\SendPayment;
use Bojanvmk\CPay\RecurringPayments\StructType\SendPaymentResponse;

class ClassMap
{
    /**
     * Returns the mapping between the WSDL Structs and generated Structs' classes
     * This array is sent to the \SoapClient when calling the WS
     * @return string[]
     */
    final public static function get(): array
    {
        return [
            'sendPayment'              => SendPayment::class,
            'sendPaymentResponse'      => SendPaymentResponse::class,
            'RecurringPaymentRequest'  => RecurringPaymentRequest::class,
            'RecurringPaymentResponse' => RecurringPaymentResponse::class,
        ];
    }
}
