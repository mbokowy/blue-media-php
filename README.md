# [Blue Media Online Payments System](https://platnosci.bm.pl/)

Integration library for the BM (Blue Media) Online Payments System

## Requirements

1. PHP from version 7.0
2. Required extensions:
    - xmlwriter
    - xmlreader
    - iconv
    - mbstring
    - hash
    - cURL

## TL;DR

Just want to see some code? Here is some PHP
```php
use BlueMedia\OnlinePayments\Gateway;

$gateway = new Gateway(
    123456,
    '81532ad38b71944834059480537b324bd1ab2bd9',
    Gateway::MODE_SANDBOX,
    'sha256',
    '|'
);

$model = $this->gateway->doPaywayList();

```

# Installation using Composer

## Existing project
Just add to your composer.json such line in `require`:
```json
"blue-media/online-payments-php": "^2.4"
```

## Project from scratch
The recommended way to install via [Composer](http://getcomposer.org).

1. [Install Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
2. To install "Blue Media Online Payments System" with dependencies, run Composer in the main "Blue Media Online Payments System" directory:

```bash
composer install
```

or if you want to add "Blue Media Online Payments System" to your project, just run:

```bash
composer require blue-media/online-payments-php
```

3. After installation, the Composer autoloader must be loaded in the project:

```php
require 'vendor/autoload.php';
```

You can then update "Blue Media Online Payments System" using Composer:

```bash
composer update blue-media/online-payments-php
```

## Documentation

For latest documentation, specifications or question please contact [Blue Media](mailto:info@bm.pl)

1. Information page [Online Payments BM](https://platnosci.bm.pl/)
2. [Administrative panel - production](https://oplacasie.bm.pl/)
3. [Administrative panel - testing](https://oplacasie-accept.bm.pl/)

## Approach
This tool implement and make easy to run payments with Blue Media. So if you want to easly work with you
should have same basic knowledge about PHP programming language, XML markup language HTTP protocol and 
generally about Blue Media payment API (hash, parameters, endpoints).


## Payment SDK configuration

`BluemediaPaymentGateway(array $config, $notifyType = 'itn')` object accept DI`$config` parameters as array.
Here we have example configuration array:

```php
<?php
[
    'serviceID' => '1111',
    'gatewayDomain' => 'https://payment-xyz.bm.pl',
    'itnUrl' => 'https://domain.com/status',
    'backUrl' => 'https://domain.com/powrot',
    'hash' => '56d35492f9d455c2daa157acfb3080b7',
    'protocol' => 'https',
    'balancePoints' => ['1111']
];
```

When we have configuration with fully configured payment gateway from Blue Media we can list available (for us)
gateways.

```php
$BMPG = new BluemediaPaymentGateway($configuration);
//@var $gatewaysOriginal SimpleXMLElement with available fields: gatewayID, gatewayName, iconURL
$gatewaysOriginal = $BMPG->getAvailableGateways();
```

After user pick gateway we can generate transactions params and begin transaction:

```php
$transactionParams = [
    'OrderID' => $paymentId,
    'Amount' => '10',
    'GatewayID' => $gatewayToPay->id,
    'Currency' => 'PLN',
    'Products' => $customerProducts,
];

$result = $BMPG->beginTransaction(
    $transactionParams,
    'POST'
);
```

# Troubleshoot

## Payment issues
INVALID_HASH - When you receive this issue this bascially mean that hash is invalid but firstly check if order send parameters 
is correct, best way to do this is to check it with bm technical support.
