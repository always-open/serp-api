<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Data;

class SearchParameters extends Data
{
    public function __construct(
        public readonly string $engine,
        public readonly string $page_token,
        public readonly ?string $more_stores = null,
        public readonly ?string $next_page_token = null,
    ) {}
}
