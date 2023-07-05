<?php

use Elyes\SonosWrapper\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase{

    public function testGetCategories()
    {
        $api = new Api();
        $this->assertIsArray($api->getCategories());
    }
}