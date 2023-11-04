<?php

namespace App\ValueObjects;

class BalanceOperation
{
    public function __construct(
        readonly public string $emailRawValue,
        readonly public int $valueRawValue,
        readonly public bool $spendingRawValue,
        readonly public string $descriptionRawValue,
    )
    {
    }

    public function getValue():int
    {
        // Устанавливаем отрицательность значения для списаний по балансу
        if ($this->spendingRawValue) return $this->valueRawValue * -1;

        return $this->valueRawValue;
    }
}
