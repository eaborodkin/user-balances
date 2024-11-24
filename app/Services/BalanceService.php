<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Balance;
use Illuminate\Support\Facades\Log;
use App\ValueObjects\NumberWithNegativeValues as Number;

class BalanceService
{
    public function changeBalance(Balance $balance, Number $amount): void
    {
        $balance->update(['value' => $amount]);
        Log::info(sprintf('Balance updated: %s', $amount->value()));
    }
}
