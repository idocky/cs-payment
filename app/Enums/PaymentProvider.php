<?php

namespace App\Enums;

enum PaymentProvider: string
{
    case PaygateA = 'paygate_a';
    case PaygateB = 'paygate_b';

    public static function allValues():array
    {
        return collect(PaymentProvider::cases())->pluck('value')->toArray();
    }
}
