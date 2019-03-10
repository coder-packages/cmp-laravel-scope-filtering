<?php
declare(strict_types=1);

namespace Larapackages\ScopeFiltering\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Larapackages\ScopeFiltering\Scoper;

trait Filterable
{
    public function scopeFilterBy(Builder $builder, array $filters = [], Request $request = null)
    {
        if ($request === null) {
            $request = request();
        }

        return (new Scoper($request))->add($filters)->filter($builder);
    }
}