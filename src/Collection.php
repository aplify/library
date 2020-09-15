<?php

namespace Aplify\Library;

use Illuminate\Support\Str;

class Collection
{
    /**
     * The key identifier for the collection.
     *
     * @var string
     */
    public $key;

    /**
     * The alias of the collection.
     *
     * @var string
     */
    public $alias;

    /**
     * The name of the collection.
     *
     * @var string
     */
    public $name;

    /**
     * The namespace of the collection.
     *
     * @var string
     */
    public $namespace;

    /**
     * The $collection's description.
     *
     * @var string
     */
    public $description;

    /**
     * The vendor folder of the collection.
     *
     * @var string
     */
    public $vendor;

    /**
     * The path of the collection.
     *
     * @var string
     */
    public $path;

    /**
     * The stubs of the collection.
     *
     * @var array
     */
    public $stubs;

    /**
     * Create a new collection instance.
     *
     * @param  string  $key
     * @return void
     */
    public function __construct(string $key = null)
    {
        $this->key = $key;
        $this->build();
    }

    /**
     * Builder the collection.
     *
     * @return void
     */
    public function build()
    {
        $this->name         = (string)Str::of($this->key)->studly();
        $this->namespace    = (string)Str::of($this->key)->studly()->plural();
        $this->alias        = (string)Str::of($this->key)->lower();
        $this->vendor       = (string)Str::of($this->name)->lower()->plural();
        $this->path         = library_path($this->vendor);
        $this->stubs        = config('library.stubs');
    }

    /**
     * Alias the collection
     *
     * @param string $alias
     * @return $this
     */
    public function alias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Name the collection
     *
     * @param string $name
     * @return $this
     */
    public function name(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Namespace the collection
     *
     * @param string $namespace
     * @return $this
     */
    public function namespace(string $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Describe the collection.
     *
     * @param  string  $description
     * @return $this
     */
    public function description(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Vendor the collection
     *
     * @param string $vendor
     * @return $this
     */
    public function vendor(string $vendor)
    {
        $this->vendor = $vendor;
        $this->path = library_path($this->vendor);

        return $this;
    }

    /**
     * Vendor the collection
     *
     * @param array $stubs
     * @return $this
     */
    public function stubs(array $stubs)
    {
        $this->stubs = $stubs;

        return $this;
    }

    /**
     * Get resource collection.
     *
     * @return mixed
     */
    public function resource()
    {
        return (new Resource())->collection($this->alias);
    }

    /**
     * Get the raw string collection.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->key;
    }
}