<?php

namespace App\Payment\Validation;

use App\Enums\PaymentProvider;

interface PaymentValidationStrategy
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array;

    public function supports(PaymentProvider $provider): bool;
}
