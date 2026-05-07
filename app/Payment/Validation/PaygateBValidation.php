<?php

namespace App\Payment\Validation;

use App\Enums\PaymentProvider;

class PaygateBValidation implements PaymentValidationStrategy
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'string'],
            'order' => ['required', 'string'],
            'state' => ['required', 'string'],
        ];
    }

    public function supports(PaymentProvider $provider): bool
    {
        return $provider === PaymentProvider::PaygateB;
    }
}
