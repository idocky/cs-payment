<?php

namespace App\Data;

use App\Enums\PaymentStatus;
use Spatie\LaravelData\Data;

class PaymentData extends Data
{
    public function __construct(
        public string $provider,
        public int $amount,
        public string $currency,
        public string $order_id,
        public ?string $description = null,
        public ?string $external_id = null,
        public ?string $payment_url = null,
        public string $status = PaymentStatus::Pending->value,
    ) {
    }
}
