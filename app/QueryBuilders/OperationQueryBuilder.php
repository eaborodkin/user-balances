<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class OperationQueryBuilder extends Builder
{
    public function search(string $search): Builder
    {
        return $this->when(!empty($search), fn (Builder $query) => $query
            ->whereRaw('LOWER(`description`) LIKE ? ', ["%{$search}%"])
        );
    }
}
