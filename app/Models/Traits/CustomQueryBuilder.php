<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CustomQueryBuilder
{
    public function newEloquentBuilder($query): Builder
    {
        $class = str(self::class)
            ->classBasename()
            ->prepend('App\\QueryBuilders\\')
            ->append('QueryBuilder')
            ->toString();

        if (class_exists($class)) {
            return new $class($query);
        }
        return parent::newEloquentBuilder($query);
    }
}
