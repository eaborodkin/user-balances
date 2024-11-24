<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Enums\OrderEnum;
use App\Http\Requests\User\HistoryRequest;
use App\Models\Balance;

class HistoryDto extends BaseDto
{
    public function __construct(
        public readonly Balance $balance,
        public readonly string    $search,
        public readonly OrderEnum $order,
        public readonly int       $page,
    ) {
    }

    public function toArray(): array
    {
        return [
            'balance_id' => $this->balance->id,
            'search' => $this->search,
            'order' => $this->order->value,
            'page' => $this->page,
        ];
    }

    public static function fromRequest(HistoryRequest $request): static
    {
        return new static(
            balance: $request->user()->balance,
            search: $request->string('search')->toString(),
            order: $request->enum('order', OrderEnum::class),
            page: $request->integer('page', 1),
        );
    }
}
