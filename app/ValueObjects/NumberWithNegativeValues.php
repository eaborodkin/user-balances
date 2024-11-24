<?php

declare(strict_types=1);

namespace App\ValueObjects;

use LengthException;
use MichaelRubel\ValueObjects\Collection\Primitive\Number;

class NumberWithNegativeValues extends Number
{
    protected function sanitize(int|string|float|null $number): string
    {
        if (is_float($number) && ! $this->isPrecise($number)) {
            throw new LengthException('Float precision loss detected.');
        }

        $number = str($number)->replace(',', '.');

        $dots = $number->substrCount('.');

        if ($dots >= 2) {
            $number = $number
                ->replaceLast('.', ',')
                ->replace('.', '')
                ->replaceLast(',', '.');
        }

        return $number
            ->replaceMatches('/(?!^-)[^0-9.]/', '')
            ->toString();
    }
}
