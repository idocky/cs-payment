<?php

namespace App\Data;

use App\Enums\PaymentStatus;

readonly class GatewayPaymentData
{
    public function __construct(
        public string $externalId,
        public string $paymentUrl,
        public PaymentStatus $status,
    ) {
    }
}
