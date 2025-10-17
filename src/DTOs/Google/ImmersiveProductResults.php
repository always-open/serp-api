<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class ImmersiveProductResults extends Data
{
    //  reviews, rating, stores_next_page_token, ratings
    public function __construct(
        public readonly array $thumbnails,
        public readonly string $title,
        public readonly string $brand,
        public readonly string $price_range,
        public readonly ImmersiveProductAboutTheProduct $about_the_product,
        public readonly ?int $reviews = null,
        public readonly ?int $rating = null,
        public readonly ?string $stores_next_page_token = null,
        public readonly ?array $ratings = null,
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
