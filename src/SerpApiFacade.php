<?php

namespace AlwaysOpen\SerpApi;

use Illuminate\Support\Facades\Facade;

class SerpApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SerpApiClient::class;
    }
}
