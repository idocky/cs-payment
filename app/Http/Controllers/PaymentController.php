<?php

namespace App\Http\Controllers;

use App\Data\PaymentData;
use App\Http\Requests\PaymentCallbackRequest;
use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService) {}

    public function store(PaymentRequest $request)
    {
        $validated = $request->validated();

        $payment = $this->paymentService->store(PaymentData::from($validated));

        return response()->json($payment);
    }

    public function callback(PaymentCallbackRequest $request, string $provider)
    {
        $payment = $this->paymentService->processCallback(
            provider: $provider,
            payload: $request->safe()->except('provider'),
        );

        return response()->json($payment);
    }
}
