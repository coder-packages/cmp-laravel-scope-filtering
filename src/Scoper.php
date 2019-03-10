<?php
declare(strict_types=1);

namespace Larapackages\ScopeFiltering;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Scoper
{
    protected $request;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter(Builder $builder)
    {
        foreach($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder, $value);
        }

        return $builder;
    }

    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }

    protected function getFilters()
    {
        return $this->filterFilters($this->filters);
    }

    protected function resolveFilter($filter)
    {
        if ($this->filters[$filter] instanceof Scope) {
            return $this->filters[$filter];
        }

        return new $this->filters[$filter];
    }

    protected function filterFilters($filters)
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

}