<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Http\Requests\User\BalanceRequest;
use App\Models\Balance;

class BalanceDto extends BaseDto
{
    public function __construct(
        public readonly Balance $balance,
    ) {
    }

    public function toArray(): array
    {
        return [
            'balance_id' => $this->balance->id,
            'balance_amount' => $this->balance->amount->value(),
        ];
    }

    public static function fromRequest(BalanceRequest $request): static
    {
        return new static(
            balance: $request->user()->balance,
        );
    }
}
