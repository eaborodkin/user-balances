<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Contracts\Support\Arrayable;

abstract class BaseDto implements Arrayable
{
    abstract public function toArray(): array;
}
