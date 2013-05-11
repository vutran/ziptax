PHP Zip-Tax
=====

A PHP wrapper for the zip-tax.com API.

# Requirements

1. An account on zip-tax.com
2. PHP 5.3.0+
3. libcurl

# Usage

``` php

$zipTax = new vutran\ZipTax('YOUR_API_KEY');

$rate = $zipTax->request('90210');

echo $rate->results[0]->taxSales;

```