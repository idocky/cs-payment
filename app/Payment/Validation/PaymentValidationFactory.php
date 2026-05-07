<?php

namespace App\Payment\Validation;

use App\Enums\PaymentProvider;
use InvalidArgumentException;

class PaymentValidationFactory
{
    /**
     * @param  iterable<PaymentValidationStrategy>  $strategies
     */
    public function __construct(
        private readonly iterable $strategies = [],
    ) {
    }

    public function getStrategy(PaymentProvider $provider): PaymentValidationStrategy
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($provider)) {
                return $strategy;
            }
        }

        throw new InvalidArgumentException("No validation strategy for {$provider->name}.");
    }
}
