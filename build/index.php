<?php

use Elyes\SonosWrapper\Api;

require_once __DIR__ . '/../vendor/autoload.php';

$api = new Api();
var_dump($api->getCategories());