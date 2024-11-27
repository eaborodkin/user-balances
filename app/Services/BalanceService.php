<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Balance;
use Illuminate\Support\Facades\Log;
use MichaelRubel\ValueObjects\Collection\Primitive\Number;

class BalanceService
{
    public function changeBalance(Balance $balance, Number $amount): void
    {
        $balance->update(['amount' => $amount]);
        Log::info(sprintf('Balance updated: %s', $amount->value()));
    }
}
