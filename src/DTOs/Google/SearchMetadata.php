<?php

namespace AlwaysOpen\SerpApi\DTOs\Google;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class SearchMetadata extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $status,
        public readonly string $json_endpoint,
        public readonly string $prettify_html_file,
        public readonly string $google_immersive_product_url,
        public readonly float $total_time_taken,
        #[WithCast(DateTimeInterfaceCast::class, format: ['Y-m-d H:i:s', 'Y-m-d\TH:i:s\+H:i', 'Y-m-d H:i:s.u', 'Y-m-d H:i:s T'])]
        public readonly ?Carbon $created_at = null,
        #[WithCast(DateTimeInterfaceCast::class, format: ['Y-m-d H:i:s', 'Y-m-d\TH:i:s\+H:i', 'Y-m-d H:i:s.u', 'Y-m-d H:i:s T'])]
        public readonly ?Carbon $processed_at = null,
        public readonly ?string $raw_html_file = null,
    ) {}
}
