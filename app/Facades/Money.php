<?php

namespace App\Facades;

use App\Services\MoneyHelper;
use Illuminate\Support\Facades\Facade;

class Money extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MoneyHelper::class;
    }
}
