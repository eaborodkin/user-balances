<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Operation;
use App\Services\BalanceService;
use Illuminate\Support\Facades\Log;

class OperationObserver
{
    public function __construct(protected readonly BalanceService $balanceService)
    {
    }

    public function creating(Operation $operation): void
    {
        $this->balanceService->changeBalance($operation->balance, $operation->value);
    }

    public function created(Operation $operation): void
    {
        Log::info(sprintf('Operation was added: %s', $operation->value->value()));
    }
}
