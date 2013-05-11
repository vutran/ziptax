<?php

require_once('../vendor/autoload.php');

// Set the API key
$apiKey = 'YOUR_API_KEY';

// Instantiate the client
$zipTax = new vutran\ZipTax($apiKey);

$rate = $zipTax->request('90210');

print_r($rate);

?>