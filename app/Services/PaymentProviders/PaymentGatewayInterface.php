<?php

namespace App\Services\PaymentProviders;

use App\Data\GatewayPaymentData;
use App\Data\PaymentData;
use App\Models\Order;
use App\Models\Payment;

interface PaymentGatewayInterface
{
    public function createPayment(Order $order, PaymentData $paymentData): GatewayPaymentData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function processCallback(array $payload): Payment;
}
