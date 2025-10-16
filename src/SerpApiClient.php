<?php

namespace AlwaysOpen\SerpApi;

use AlwaysOpen\SerpApi\DTOs\Google\ImmersiveProductResponse;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Throwable;

class SerpApiClient
{
    protected string $apiKey;

    protected string $baseSearchUrl = 'https://serpapi.com/search';

    protected string $baseArchiveUrl = 'https://serpapi.com/searches';

    public const string JSON_TYPE = 'json';

    public const string HTML_TYPE = 'html';

    public const string JSON_WITH_PIXEL_POSITION_TYPE = 'json_with_pixel_position';

    public function __construct(
        ?string $apiKey = null,
    ) {
        $this->apiKey = $apiKey ?? config('serp-api.serp_api_key') ?? '';
    }

    /**
     * @throws GuzzleException|Throwable
     */
    public function makeGetRequest(
        array $params = [],
        string $responseType = self::JSON_TYPE,
        ?string $baseUrl = null,
    ): Response {
        if ($params) {
            $params['api_key'] = $this->apiKey;
        } else {
            $params = ['api_key' => $this->apiKey];
        }

        $paramString = http_build_query($params);

        $request = new Request(
            method: 'get',
            uri: ($baseUrl ?? $this->baseSearchUrl).".$responseType".($paramString ? '?'.$paramString : ''),
        );

        /**
         * @var Response|null $response
         */
        $response = retry(1, function () use ($request): PromiseInterface|Response {
            return Http::withHeaders($request->getHeaders())
                ->get($request->getUri())
                ->throw();
        }, 2000);

        return $response;
    }

    /**
     * @throws Throwable
     * @throws GuzzleException
     */
    public function makeGoogleImmersiveProductRequest(
        string $pageToken,
        bool $moreStores = false,
        ?string $nextPageToken = null,
        string $responseType = self::JSON_TYPE,
        bool $async = false,
        bool $asDto = true,
    ): ImmersiveProductResponse|array|string {
        $params = array_filter([
            'engine' => SerpApi::ENGINE_GOOGLE_IMMERSIVE_PRODUCT,
            'pageToken' => $pageToken,
            'more_stores' => $moreStores,
            'next_page_token' => $nextPageToken,
            'async' => $async,
        ]);

        $response = $this->makeGetRequest(params: $params, responseType: $responseType);

        if ($responseType === self::JSON_TYPE) {
            if ($asDto) {
                return ImmersiveProductResponse::from($response->json());
            }

            return $response->json();
        }

        return $response->body();
    }

    /**
     * @throws Throwable
     * @throws GuzzleException
     */
    public function retrieveGoogleImmersiveProductResult(
        string $searchId,
        string $responseType = self::JSON_TYPE,
        bool $asDto = true,
    ) {

        $response = $this->makeGetRequest(responseType: $responseType, baseUrl: $this->baseArchiveUrl . "/$searchId");

        if ($responseType === self::JSON_TYPE) {
            if ($asDto) {
                return ImmersiveProductResponse::from($response->json());
            }

            return $response->json();
        }

        return $response->body();
    }
}
