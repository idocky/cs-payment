<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class GatewayClientResponseData extends Data
{
    public function __construct(
        public string $externalId,
        public string $paymentUrl,
        public string $providerStatus,
    ) {}
}
