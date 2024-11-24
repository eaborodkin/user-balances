<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\BalanceOperationDto;
use App\DataTransferObjects\HistoryDto;
use Illuminate\Database\Eloquent\Builder;

class OperationService
{
    public function getOperations(HistoryDto $dto): Builder
    {
        return $dto->balance->operations()
            ->filter()
            ->getQuery();
    }

    public function saveBalanceOperation(BalanceOperationDto $dto): void
    {
        $dto->user->balance->operations()->create($dto->toArray());
    }
}
