<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Data;

class ImmersiveProductResponse extends Data
{
    public function __construct(
        public readonly SearchMetadata $search_metadata,
        public readonly SearchParameters $search_parameters,
        public readonly ?ImmersiveProductResults $product_results = null,
    ) {}
}
