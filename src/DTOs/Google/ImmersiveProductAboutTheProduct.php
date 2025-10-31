<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class ImmersiveProductAboutTheProduct extends Data
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $link,
        public readonly ?string $displayed_link,
        public readonly ?string $icon,
        public readonly ?string $description,
        /* @var null|ImmersiveProductAboutTheProductFeature[] $features */
        #[DataCollectionOf(ImmersiveProductAboutTheProductFeature::class)]
        public readonly ?array $features = null,
    ) {}
}
