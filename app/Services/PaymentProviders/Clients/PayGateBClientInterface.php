<?php

namespace App\Services\PaymentProviders\Clients;

use App\Data\GatewayClientResponseData;

interface PayGateBClientInterface
{
    public function createPayment(string $order, int $total, string $currencyCode, ?string $note = null): GatewayClientResponseData;
}
