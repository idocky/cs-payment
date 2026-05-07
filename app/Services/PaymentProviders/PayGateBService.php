<?php

namespace App\Services\PaymentProviders;

use App\Data\GatewayPaymentData;
use App\Data\PaymentData;
use App\Facades\Money;
use App\Models\Order;
use App\Models\Payment;
use App\Services\PaymentProviders\Clients\PayGateBClientInterface;
use App\Services\PaymentProviders\StatusMappers\PayGateBStatusMapper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PayGateBService implements PaymentGatewayInterface
{
    public function __construct(
        private readonly PayGateBClientInterface $client,
        private readonly PayGateBStatusMapper $statusMapper,
    ) {
    }

    public function createPayment(Order $order, PaymentData $paymentData): GatewayPaymentData
    {
        $response = $this->client->createPayment(
            order: $order->uuid,
            total: Money::toCents($paymentData->amount),
            currencyCode: $paymentData->currency,
            note: $paymentData->description,
        );

        return new GatewayPaymentData(
            externalId: $response->externalId,
            paymentUrl: $response->paymentUrl,
            status: $this->statusMapper->map($response->providerStatus),
        );
    }

    public function processCallback(array $payload): Payment
    {
        $payment = Payment::query()
            ->where('external_id', $payload['id'])
            ->firstOrFail();

        $payment->update([
            'status' => $this->statusMapper->map($payload['state']),
        ]);

        return $payment->fresh();
    }
}
