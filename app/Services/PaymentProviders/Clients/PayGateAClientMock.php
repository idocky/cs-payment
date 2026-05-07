<?php

namespace App\Services\PaymentProviders\Clients;

use App\Data\GatewayClientResponseData;
use Illuminate\Support\Str;

class PayGateAClientMock implements PayGateAClientInterface
{

    public function createPayment(int $amount, string $currency, string $merchantOrderId): GatewayClientResponseData
    {
        $paymentExternalId = Str::uuid()->toString();

        $payGateResponse = [
            'payment_id' => $paymentExternalId,
            'payment_url' => "https://paygate-a.test/pay/$paymentExternalId",
            'status' => 'new',
        ];

        return GatewayClientResponseData::from([
            'externalId' => $payGateResponse['payment_id'],
            'paymentUrl' => $payGateResponse['payment_url'],
            'providerStatus' => $payGateResponse['status'],
        ]);
    }
}
