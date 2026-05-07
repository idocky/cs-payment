<?php

namespace App\Payment\Validation;

use App\Enums\PaymentProvider;

class PaygateAValidation implements PaymentValidationStrategy
{
    public function rules(): array
    {
        return [
            'payment_id' => ['required', 'string'],
            'merchant_order_id' => ['required', 'string'],
            'status' => ['required', 'string'],
        ];
    }

    public function supports(PaymentProvider $provider): bool
    {
        return $provider === PaymentProvider::PaygateA;
    }
}
