<?php

return [
    'payment_url'    => env('CPAY_URL_PAYMENT', 'https://www.cpay.com.mk/client/Page/default.aspx?xml_id=/mk-MK/.loginToPay/.simple/'),
    'success_url'    => env('CPAY_URL_SUCCESS'),
    'failure_url'    => env('CPAY_URL_FAILURE'),
    'merchant_id'    => env('CPAY_MERCHANT_ID'),
    'merchant_name'  => env('CPAY_MERCHANT_NAME'),
    'currency'       => env('CPAY_CURRENCY', 'MKD'),
    'auth_key'       => env('CPAY_AUTH_KEY', 'TEST_PASS'),
    'recurring_wsdl' => env('CPAY_RECURRING_WSDL', 'https://www.cpay.com.mk/Recurring/RecurringPaymentsWS.wsdl'),
];
