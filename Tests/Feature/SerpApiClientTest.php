<?php

namespace AlwaysOpen\SerpApi\Tests\Feature;

use AlwaysOpen\SerpApi\Tests\BaseTest;
use AlwaysOpen\SerpApi\SerpApiClient;
use Illuminate\Support\Facades\Http;

class SerpApiClientTest extends BaseTest
{
    public function test_google_immersive_product()
    {
        Http::fake([
            'https://serpapi.com/search.json?engine=google_immersive_product&pageToken=asdf&api_key=test' => Http::response($this->getFixtureJsonContent('google_immersive_product_response.json'), 200),
        ]);

        $client = new SerpApiClient(apiKey: 'test');

        $immersiveProductResponse = $client->makeGoogleImmersiveProductRequest('asdf');

        $this->assertNotEmpty($immersiveProductResponse->product_results);
        $this->assertEquals('Folgers Classic Roast Ground Coffee', $immersiveProductResponse->product_results->title);
    }
}
