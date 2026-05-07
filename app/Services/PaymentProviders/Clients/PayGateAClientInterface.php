<?php

namespace App\Services\PaymentProviders\Clients;

use App\Data\GatewayClientResponseData;

interface PayGateAClientInterface
{
    public function createPayment(int $amount, string $currency, string $merchantOrderId): GatewayClientResponseData;
}
