<?php

namespace App\Services\PaymentProviders\StatusMappers;

use App\Enums\PaymentStatus;
use InvalidArgumentException;

class PayGateAStatusMapper
{
    public function map(string $externalStatus): PaymentStatus
    {
        return match ($externalStatus) {
            'new' => PaymentStatus::Pending,
            'paid' => PaymentStatus::Success,
            'failed' => PaymentStatus::Failed,
            default => throw new InvalidArgumentException("Unsupported PayGateA status [{$externalStatus}]."),
        };
    }
}
