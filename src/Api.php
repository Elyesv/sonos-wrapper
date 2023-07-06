<?php

declare(strict_types=1);

namespace Elyes\SonosWrapper;

use PhpParser\Node\Expr\Array_;
use Symfony\Component\HttpClient\HttpClient;

class Api
{
    public function getCategories(): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://www.sonos.com/_next/data/Umxp-bVpfNOwryZCCeU88/fr-fr/home.json?slug=home'
        );

        $content = $response->toArray();
        $categories = [];

        foreach ($content['pageProps']['navHeaderSubCategoryData']['getCommerce']['categories']['data'][0] as $value){
            foreach($value as $value2){
                if(isset($value2['content'][0]['externalId']) && isset($value2['content'][0]['name']) && isset($value2['content'][0]['slug']['current'])){
                    $categories[] = array(
                        'externalId' => $value2['content'][0]['externalId'],
                        'name' => $value2['content'][0]['name'],
                        'slug' => $value2['content'][0]['slug']['current'],
                    );
                }
            }
        };
        return $categories;
    }

    public function getProductsByCategory(String $category): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://www.sonos.com/_next/data/Umxp-bVpfNOwryZCCeU88/fr-fr/internal/commerce/categories/' . $category . '.json'
        );

        $content = $response->toArray();
        $products = [];

        foreach ($content['pageProps']['category']['products']['hits'] as $value){
                $products[] = array(
                    'productId' => $value['productId'],
                    'name' => $value['content'][0]['name'],
                    'slug' => $value['content'][0]['slug']['current'],
                );
            }

        return $products;
    }

    public function getProduct(String $product): array
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://www.sonos.com/_next/data/Umxp-bVpfNOwryZCCeU88/fr-fr/internal/commerce/products/' . $product . '.json'
        );

        $content = $response->toArray();
        return [
            'productId' => $content['pageProps']['product']['id'],
            'price' => $content['pageProps']['product']['price'],
            'stockLevel' => $content['pageProps']['product']['inventory']['stockLevel'],
            'name' => $content['pageProps']['product']['content'][0]['name'],
            'slug' => $content['pageProps']['product']['content'][0]['slug']['current'],
            'descriptor' => $content['pageProps']['product']['content'][0]['descriptor'],
            'overview' => $content['pageProps']['product']['content'][0]['overview'],
            'media' => $content['pageProps']['product']['content'][0]['media'],
            'color' => $content['pageProps']['product']['variationAttributes'][0]['values'],

        ];
    }
}
