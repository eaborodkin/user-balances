<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder          $builder
     * @param QueryFilter|null $filter
     */
    public function scopeFilter(
        Builder $builder,
        ?QueryFilter $filter = null,
    ): void {
        if (is_null($filter)) {
            $class = str(self::class)
                ->classBasename()
                ->prepend('App\\Http\\Filters\\')
                ->append('Filter')
                ->toString();
            $filter = new $class;
        }
        $filter->apply($builder);
    }
}
