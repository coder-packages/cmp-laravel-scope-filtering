# Scope filtering in Laravel

**Add trait into models**
```php
use Larapackages\ScopeFiltering\Traits\Filterable;

class User
{
	use Filterable;
}
```
**Create a Scope**

```php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Larapackages\ScopeFiltering\Scope;

class ContainsScope extends Scope
{
    protected $field;

    /** this is not required */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function filter(Builder $query, $value)
    {
        return $query->where($this->field, 'ilike', "%". mb_strtolower($value) . "%");
    }
}
```

**Use in searches**
```php
use App\Filters\ContainsScope;

User::filterBy([
    'name' => ContainsScope // or 'name' => new ContainsScope('name')
])->get();
```