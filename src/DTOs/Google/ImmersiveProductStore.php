<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Data;

class ImmersiveProductStore extends Data
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $logo = null,
        public readonly ?string $title = null,
        public readonly ?string $link = null,
        public readonly ?string $price = null,
        public readonly ?float $rating = null,
        public readonly ?int $reviews_count = null,
        public readonly ?string $payment_methods = null,
        public readonly ?array $details_and_offers = null,
        public readonly ?string $tag = null,
        public readonly ?float $extracted_price = null,
        public readonly ?string $shipping = null,
        public readonly ?float $shipping_extracted = null,
        public readonly ?string $total = null,
        public readonly ?float $extracted_total = null,
    ) {}
}
