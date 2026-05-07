<?php

namespace App\Services\PaymentProviders;

use App\Data\GatewayPaymentData;
use App\Data\PaymentData;
use App\Models\Order;
use App\Models\Payment;
use App\Services\PaymentProviders\Clients\PayGateAClientInterface;
use App\Services\PaymentProviders\StatusMappers\PayGateAStatusMapper;

class PayGateAService implements PaymentGatewayInterface
{
    public function __construct(
        private readonly PayGateAClientInterface $client,
        private readonly PayGateAStatusMapper $statusMapper,
    ) {}

    public function createPayment(Order $order, PaymentData $paymentData): GatewayPaymentData
    {
        $response = $this->client->createPayment(
            amount: $paymentData->amount,
            currency: $paymentData->currency,
            merchantOrderId: $order->uuid,
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
            ->where('external_id', $payload['payment_id'])
            ->firstOrFail();

        $payment->update([
            'status' => $this->statusMapper->map($payload['status']),
        ]);

        return $payment->fresh();
    }
}
