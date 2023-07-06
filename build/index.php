<?php

use Elyes\SonosWrapper\Api;

require_once __DIR__ . '/../vendor/autoload.php';

$api = new Api();
//var_dump($api->getCategories());
//var_dump($api->getProductsByCategory("wireless-speakers"));
var_dump($api->getProduct("era-100"));
