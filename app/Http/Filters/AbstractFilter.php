<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    protected array $queryParams = [];

//    AbstructFilter constructor
    public function __construct(array $queryParams)
    {
      $this->queryParams = $queryParams;
    }

    abstract protected function getCallbacks(): array;

    public function apply(Builder $builder): void
    {
        $this->before($builder);

        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                $callback($builder, $this->queryParams[$name]);
            }
        }
    }

    protected function before(Builder $builder)
    {
    }

    protected function getQueryParam(string $key, $default = null): mixed
    {
        return $this->queryParams[$key] ?? $default;
    }

    protected function removeQueryParam(string ...$keys): AbstractFilter
    {
        foreach ($keys as $key) {
            unset($this->queryParams[$key]);
        }

        return $this;
    }
}
