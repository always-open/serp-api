<?php

namespace AlwaysOpen\SerpApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlwaysOpen\SerpApi\SerpApi
 */
class SerpApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AlwaysOpen\SerpApi\SerpApi::class;
    }
}
