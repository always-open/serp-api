<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class ImmersiveProductAboutTheProduct extends Data
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $link = null,
        public readonly ?string $displayed_link = null,
        public readonly ?string $icon = null,
        public readonly ?string $description = null,
        /* @var null|ImmersiveProductAboutTheProductFeature[] $features */
        #[DataCollectionOf(ImmersiveProductAboutTheProductFeature::class)]
        public readonly array $features,
    ) {}
}
