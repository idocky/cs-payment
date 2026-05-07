<?php

namespace App\Http\Requests;

use App\Enums\PaymentProvider;
use App\Payment\Validation\PaymentValidationFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentCallbackRequest extends FormRequest
{
    public function __construct(
        private readonly PaymentValidationFactory $validationFactory,
    ) {
        parent::__construct();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'provider' => $this->route('provider'),
        ]);
    }

    public function rules(): array
    {
        $provider = PaymentProvider::tryFrom((string) $this->route('provider'));

        $commonRules = [
            'provider' => ['required', Rule::in(PaymentProvider::allValues())],
        ];

        if (!$provider) {
            return $commonRules;
        }

        return array_merge($commonRules, $this->validationFactory
                ->getStrategy($provider)
                ->rules());
    }
}
