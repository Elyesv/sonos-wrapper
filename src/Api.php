<?php

declare(strict_types=1);

namespace Elyes\SonosWrapper;

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

}
