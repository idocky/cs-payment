<?php

namespace App\Services\PaymentProviders\Clients;

use App\Data\GatewayClientResponseData;
use Illuminate\Support\Str;

class PayGateBClientMock implements PayGateBClientInterface
{
    public function createPayment(string $order, int $total, string $currencyCode, ?string $note = null): GatewayClientResponseData
    {
        $paymentExternalId = Str::uuid()->toString();

        $response = [
            'id' => $paymentExternalId,
            'redirect_url' => "https://paygate-b.test/checkout/$paymentExternalId",
            'status' => 'created',
        ];

        return GatewayClientResponseData::from([
            'externalId' => $response['id'],
            'paymentUrl' => $response['redirect_url'],
            'providerStatus' => $response['status'],
        ]);
    }
}
