<?php

namespace AlwaysOpen\SerpApi;

use Illuminate\Support\ServiceProvider;

class SerpApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SerpApiClient::class, function ($app) {
            return new SerpApiClient(
                config('serp-api.serp_api_key'),
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/serp-api.php' => config_path('serp-api.php'),
            __DIR__.'/../config/data.php' => config_path('data.php'),
        ], 'config');
    }
}
