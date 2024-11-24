<?php

declare(strict_types=1);

namespace App\Http\Filters;

class OperationFilter extends QueryFilter
{
    protected function search(string $search): void
    {
        $this->builder->search($search);
    }

    protected function order(string $order): void
    {
        $this->builder->orderBy('updated_at', $order);
    }
}
