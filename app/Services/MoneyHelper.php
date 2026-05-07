<?php

namespace App\Services;

class MoneyHelper
{
    public function fromCents(int $cents): float
    {
        return round($cents / 100, 2);
    }

    public function toCents(float $amount): int
    {
        return (int) round($amount * 100);
    }
}
