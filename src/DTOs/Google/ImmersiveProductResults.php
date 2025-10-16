<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class ImmersiveProductResults extends Data
{
    public function __construct(
        public readonly array $thumbnails,
        public readonly string $title,
        public readonly string $brand,
        public readonly int $reviews,
        public readonly int $rating,
        public readonly string $price_range,
        public readonly string $stores_next_page_token,
        public readonly ImmersiveProductAboutTheProduct $about_the_product,
        public readonly array $ratings,
        /* @var null|ImmersiveProductStore[] $stores */
        #[DataCollectionOf(ImmersiveProductStore::class)]
        public readonly ?array $stores = null,
        public readonly ?array $top_insights = null,
        public readonly ?array $reviews_images = null,
        public readonly ?array $user_reviews = null,
        public readonly ?array $videos = null,
        public readonly ?array $discussions_and_forums = null,
        public readonly ?array $more_options = null,
        public readonly ?array $variants = null,
    ) {}
}
