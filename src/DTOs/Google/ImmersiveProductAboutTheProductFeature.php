<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Data;

class ImmersiveProductAboutTheProductFeature extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $value,
    ) {}
}
