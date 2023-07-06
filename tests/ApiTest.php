<?php

use Elyes\SonosWrapper\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase{

    public function testGetCategories(): void
    {
        $api = new Api();
        $this->assertIsArray($api->getCategories());
    }

    public function getProductsByCategory(): void
    {
        $api = new Api();
        $this->assertIsArray($api->getProductsByCategory("wireless-speakers"));
    }
}