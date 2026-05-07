<?php

namespace App\Http\Requests;

use App\Enums\PaymentProvider;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'provider' => ['required', 'in:'.implode(',', array_values(PaymentProvider::allValues()))],
            'amount' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'order_id' => ['required', 'exists:orders,uuid'],
            'description' => ['nullable', 'string'],
        ];
    }
}
