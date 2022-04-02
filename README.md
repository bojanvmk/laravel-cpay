# laravel-cpay
### Cpay (CaSys) integration for Laravel

This package can help you integrate with cpay more easily, it can handle all the specified cpay parameters, validation and checksums generation and verification.

This is just a helper class, you would still be required to create your own views/forms with your own design, and provide your own success/fail routes. You should be familiar with the "Cpay Merchant Integration Specification" document before using this package.

### Installation

```bash 
composer require bojanvmk/laravel-cpay

php artisan vendor:publish
```

Edit the cpay.php config file with your own values

### Basic usage:

```php
use Bojanvmk\CPay\CPay;

$amount = 100;   // in the currency specified in the cpay.php config file
$orderId = 1325; // unique order/subscription id
$description = 'Some description here';

// It will automatically validate and generate all the needed parameters
// based on these 3 params and the config file
$cPay = new CPay($amount, $orderId, $description);

// set additional optional parameters
// see the Cpay.php class for all the other supported cpay parameters
// more details about them can be found in the official cpay docs
$cPay->setEmail('test@test.com') 
      ->setRecurringPayment('1M')
      ...
        
// Get all the needed cpay params which should be included in your form (as hidden inputs)
$withChecksums = true;
$cPayParams = $cPay->getParameters($withChecksums);

// This package can also generate a ready html with these parameters as hidden inputs
$html = $cPay->renderHiddenInputs();
```

### Verify return checksum from cPay

```php
// Create a new instance from existing parameters
// you'll ideally keep a copy of the sent parameters in db for each payment
$cPay = CPay::initFromParameters($params);

// verify that the return checksum matches the original payment data
// note: $cPayPaymentRef is returned by cpay
if ($cPay->verifyReturnChecksum($cPayPaymentRef, $returnCheckSum)) {
    // we're good to go
}
```
