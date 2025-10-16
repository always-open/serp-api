<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Spatie\LaravelData\Data;

class SearchMetadata extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $status,
        public readonly string $json_endpoint,
        public readonly string $created_at,
        public readonly string $processed_at,
        public readonly string $raw_html_file,
        public readonly string $prettify_html_file,
        public readonly string $google_immersive_product_url,
        public readonly float $total_time_taken,
    ) {}
}
