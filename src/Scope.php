<?php
declare(strict_types=1);

namespace Larapackages\ScopeFiltering;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

abstract class Scope
{

    abstract public function filter(Builder $query, $value);

    public function mappings() : array
    {
        return [];
    }

    protected function resolveFilterValue($key)
    {
        return Arr::get($this->mappings(), $key);
    }
}