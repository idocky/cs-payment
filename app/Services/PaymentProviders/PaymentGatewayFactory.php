<?php

namespace App\Services\PaymentProviders;

use App\Enums\PaymentProvider;
use InvalidArgumentException;

class PaymentGatewayFactory
{
    public function __construct(
        private readonly PayGateAService $payGateAService,
        private readonly PayGateBService $payGateBService,
    ) {
    }

    public function make(PaymentProvider $provider): PaymentGatewayInterface
    {
        return match ($provider) {
            PaymentProvider::PaygateA => $this->payGateAService,
            PaymentProvider::PaygateB => $this->payGateBService,
            default => throw new InvalidArgumentException("Unsupported payment provider [{$provider->value}]."),
        };
    }
}
