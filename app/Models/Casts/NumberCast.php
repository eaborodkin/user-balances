<?php

declare(strict_types=1);

namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use App\ValueObjects\NumberWithNegativeValues as Number;

class NumberCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Number
    {
        return new Number($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if ($value instanceof Number) {
            return $value->value();
        }

        throw new InvalidArgumentException('The given value is not a valid Number instance.');
    }
}
