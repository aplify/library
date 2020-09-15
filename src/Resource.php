<?php

namespace Aplify\Library;

use Aplify\Library\Support\Model;
use ArrayAccess;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\ForwardsCalls;
use JsonSerializable;

class Resource extends Model implements Arrayable, ArrayAccess ,Jsonable, JsonSerializable,UrlRoutable
{
    use Concerns\Arrayable,
        Concerns\ArrayAccess,
        Concerns\Assets,
        Concerns\Collection,
        Concerns\Composer,
        Concerns\File,
        Concerns\Generate,
        Concerns\Jsonable,
        Concerns\Path,
        Concerns\QueryCollection,
        Concerns\Routable,
        Concerns\SpaceName,
        ForwardsCalls;

    /**
     * Create a new resource instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->syncOriginal();

        $this->fill($attributes);
    }

    /**
     * Fill the resource with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
                $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @param  bool  $exists
     * @return static
     */
    public function newInstance($attributes = [], $exists = false)
    {
        $model = new static((array) $attributes);

        $model->exists = $exists;

        return $model;
    }

    /**
     * Create a new resource instance that is existing.
     *
     * @param  array  $attributes
     * @param  string|null  $collection
     * @return static
     */
    public function newFromBuilder($attributes = [], $collection = null)
    {
        $model = $this->newInstance([], true);

        $model->setRawAttributes((array) $attributes, true);

        return $model;
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $resources
     * @return Collection
     */
    public function newCollection(array $resources = [])
    {
        return new Collection($resources);
    }

    /**
     * Get a new query builder that doesn't have any global scopes or eager loading.
     *
     * @return Collection
     */
    public function newModelQuery()
    {
        return $this->newEloquentBuilder(
            $this->newCollection(Explorer::resources($this->collection))
        );
    }

    /**
     * Handle dynamic method calls into the resource.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo($this->newQuery(), $method, $parameters);
    }

    /**
     * Handle dynamic static method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}