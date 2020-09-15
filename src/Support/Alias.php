<?php

namespace Aplify\Library\Support;

use Illuminate\Support\Str;

class Alias
{
    /**
     * @var $collect null
     */
    protected static $collection = null;

    /**
     * @var $resource null
     */
    protected static $resource = null;

    /**
     * Render Alias String
     *
     * @param $alias
     * @return mixed
     */
    public static function render($alias)
    {
        if (static::check($alias)){
            $collection = Str::of($alias)->explode(':');
            static::$collection = $collection[0];
            static::$resource = $collection[1];
        }
        else{
            static::$resource = $alias;
        }

        return new static;
    }

    /**
     * Check if exists collection
     *
     * @param $alias
     * @return boolean
     */
    public static function check($alias = null)
    {
        return $alias ? Str::contains($alias, ':') : static::$collection ;
    }

    /**
     * Get collection name
     *
     * @return mixed
     */
    public static function collection()
    {
        return static::$collection;
    }

    /**
     * Get resource name
     *
     * @return mixed
     */
    public static function resource()
    {
        return static::$resource;
    }
}