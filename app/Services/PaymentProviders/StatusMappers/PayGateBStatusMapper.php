<?php

namespace App\Services\PaymentProviders\StatusMappers;

use App\Enums\PaymentStatus;
use InvalidArgumentException;

class PayGateBStatusMapper
{
    public function map(string $externalStatus): PaymentStatus
    {
        return match ($externalStatus) {
            'created' => PaymentStatus::Pending,
            'success' => PaymentStatus::Success,
            'failed' => PaymentStatus::Failed,
            default => throw new InvalidArgumentException("Unsupported PayGateB status [{$externalStatus}]."),
        };
    }
}
