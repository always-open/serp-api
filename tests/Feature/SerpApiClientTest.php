<?php

namespace AlwaysOpen\SerpApi\Tests\Feature;

use AlwaysOpen\SerpApi\SerpApiClient;
use AlwaysOpen\SerpApi\Tests\BaseTest;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use Throwable;

class SerpApiClientTest extends BaseTest
{
    /**
     * @throws GuzzleException
     * @throws Throwable
     */
    public function test_google_immersive_product()
    {
        Http::fake([
            'https://serpapi.com/search.json?engine=google_immersive_product&page_token=asdf&api_key=tests' => Http::response($this->getFixtureJsonContent('google_immersive_product_response.json'), 200),
        ]);

        $client = new SerpApiClient(apiKey: 'tests');

        $immersiveProductResponse = $client->makeGoogleImmersiveProductRequest('asdf');

        $this->assertNotEmpty($immersiveProductResponse->product_results);
        $this->assertEquals('Folgers Classic Roast Ground Coffee', $immersiveProductResponse->product_results->title);
        $this->assertIsNumeric($immersiveProductResponse->search_metadata->created_at->microsecond);
    }

    /**
     * @throws GuzzleException
     * @throws Throwable
     */
    public function test_google_immersive_product_async()
    {
        Http::fake([
            'https://serpapi.com/search.json?engine=google_immersive_product&page_token=asdf&api_key=tests' => Http::response($this->getFixtureJsonContent('google_immersive_product_response_async.json'), 200),
            'https://serpapi.com/searches/68f12e7fcc56d34e74b53c3e.json?api_key=tests' => Http::response($this->getFixtureJsonContent('google_immersive_product_response.json'), 200),
        ]);

        $client = new SerpApiClient(apiKey: 'tests');

        $immersiveProductResponse = $client->makeGoogleImmersiveProductRequest('asdf');

        $this->assertEmpty($immersiveProductResponse->product_results);
        $this->assertEquals('68f12e7fcc56d34e74b53c3e', $immersiveProductResponse->search_metadata->id);

        $immersiveProductResponse = $client->retrieveGoogleImmersiveProductResult('68f12e7fcc56d34e74b53c3e');

        $this->assertNotEmpty($immersiveProductResponse->product_results);
        $this->assertEquals('68f12e7fcc56d34e74b53c3e', $immersiveProductResponse->search_metadata->id);
        $this->assertEquals('Folgers Classic Roast Ground Coffee', $immersiveProductResponse->product_results->title);
    }

    /**
     * SerpApi can return product_results carrying only a non-string title map and no stores.
     *
     * @throws GuzzleException
     * @throws Throwable
     */
    public function test_google_immersive_product_result_with_non_string_title()
    {
        Http::fake([
            'https://serpapi.com/searches/68f12e7fcc56d34e74b53c3f.json?api_key=tests' => Http::response($this->getFixtureJsonContent('google_immersive_product_response_title_map.json'), 200),
        ]);

        $client = new SerpApiClient(apiKey: 'tests');

        $immersiveProductResponse = $client->retrieveGoogleImmersiveProductResult('68f12e7fcc56d34e74b53c3f');

        $this->assertEquals('68f12e7fcc56d34e74b53c3f', $immersiveProductResponse->search_metadata->id);
        $this->assertNull($immersiveProductResponse->product_results->title);
        $this->assertNull($immersiveProductResponse->product_results->stores);
    }

    /**
     * @throws GuzzleException
     * @throws Throwable
     */
    public function test_google_immersive_product_fractional_rating()
    {
        Http::fake([
            'https://serpapi.com/search.json?engine=google_immersive_product&page_token=asdf&api_key=tests' => Http::response($this->getFixtureJsonContent('google_immersive_product_response.json'), 200),
        ]);

        $client = new SerpApiClient(apiKey: 'tests');

        $immersiveProductResponse = $client->makeGoogleImmersiveProductRequest('asdf');

        $this->assertSame(4.6, $immersiveProductResponse->product_results->rating);
    }
}
