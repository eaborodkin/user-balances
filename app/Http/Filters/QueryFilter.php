<?php

declare(strict_types=1);

namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter
{
    protected Builder $builder;

    public function __construct(
        protected ?Request $request = null
    ) {
        if (is_null($this->request)) {
            $this->request = request();
        }
    }

    public function apply(Builder $builder): void
    {
        $this->builder = $builder;
        foreach ($this->request->all() as $field => $value) {
            $method = Str::camel($field);
            if (method_exists($this, $method) && filled($value)) {
                call_user_func_array([$this, $method], [$value]);
            }
        }
    }
}
