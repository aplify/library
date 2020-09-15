<?php

namespace Aplify\Library\Concerns;

use Illuminate\Support\Collection;

trait QueryCollection
{
    /**
     * Begin querying the resource.
     *
     * @return Collection
     */
    public static function query()
    {
        return (new static)->newQuery();
    }

    /**
     * Get a new query builder for the resources's.
     *
     * @return Collection
     */
    public function newQuery()
    {
        return  $this->newModelQuery();
    }

    /**
     * Create a new query builder for the resource.
     *
     * @param  Collection  $query
     * @return Collection
     */
    public function newEloquentBuilder($query)
    {
        return $query;
    }

}