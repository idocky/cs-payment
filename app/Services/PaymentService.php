<?php

namespace App\Services;

use App\Data\PaymentData;
use App\Enums\PaymentProvider;
use App\Models\Order;
use App\Models\Payment;
use App\Services\PaymentProviders\PaymentGatewayFactory;

class PaymentService
{
    public function __construct(
        private readonly PaymentGatewayFactory $paymentGatewayFactory,
    ) {}

    public function store(PaymentData $data): Payment
    {
        $provider = PaymentProvider::from($data->provider);
        $order = Order::query()->where('uuid', $data->order_id)->firstOrFail();

        $gatewayPayment = $this->paymentGatewayFactory
            ->make($provider)
            ->createPayment($order, $data);

        return Payment::query()->create([
            'provider' => $provider,
            'amount' => $data->amount,
            'currency' => $data->currency,
            'order_id' => $order->id,
            'description' => $data->description ?? '',
            'status' => $gatewayPayment->status,
            'external_id' => $gatewayPayment->externalId,
            'payment_url' => $gatewayPayment->paymentUrl,
        ]);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function processCallback(string $provider, array $payload): Payment
    {
        return $this->paymentGatewayFactory
            ->make(PaymentProvider::from($provider))
            ->processCallback($payload);
    }
}
