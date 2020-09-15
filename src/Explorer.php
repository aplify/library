<?php

namespace Aplify\Library;

use Aplify\Library\Support\Autoload;
use Aplify\Library\Support\Facades\Scanner;
use Illuminate\Contracts\Foundation\Application;

class Explorer
{
    /**
     * All of the registered Library collect.
     *
     * @var array
     */
    public static $collections = [];

    /**
     * All of the registered Library tool resources.
     *
     * @var array
     */
    public static $resources = [];

    /**
     * Get resource.
     *
     * @return mixed
     */
    public static function resource()
    {
        return (new Resource());
    }

    /**
     * Get all resource.
     *
     * @param null $collection
     * @return mixed
     */
    public static function resources($collection = null)
    {
        if ($collection && isset(static::$collections[$collection])) {
            return collect(static::$resources)->where('type', $collection)->all();
        }
        return static::$resources;
    }

    /**
     * Find the collection with the given key.
     *
     * @param  string  $key
     * @return Collection
     */
    public static function findCollection(string $key)
    {
        return static::$collections[$key] ?? null;
    }

    /**
     * Define a collection.
     *
     * @param string $key
     * @return Collection
     */
    public static function collection(string $key)
    {
        return tap(new Collection($key), function ($collection) use ($key) {
            static::$collections[$key] = $collection;
        });
    }

    /**
     * Run library explorer
     *
     * @param Application $app
     * @return static
     */
    public static function run(Application $app)
    {
        $resources = Scanner::all();

        foreach ($resources as $resource) {

            $model = static::resource()
                ->newFromBuilder($resource->data)
                ->setComposer($resource->composer)
                ->setFile($resource->file);

            $model->collection(static::$collections[$model->type]);

            foreach ((array)$model->composer('autoload.psr-4') as $class => $src)
            {
                if (is_array($src)){
                    foreach ($src as $path){
                        Autoload::addPsr4($class, $model->path($path));
                    }
                }else {
                    Autoload::addPsr4($class, $model->path($src));
                }
            }

            if ($model->composer('autoload.files')) {
                foreach ($model->composer('autoload.files') as $file){
                    require $model->path($file);
                }
            }

            static::$resources[] = $model;
        }

        foreach (static::$resources as $resource)
        {
            $method = $resource->namespace('Providers\ApplyServiceProvider');

            $service = (new $method($app))->setResource($resource);
            $app->register($service);
        }

        return new static;
    }

    /**
     * Sync resources library
     *
     * @return static
     */
    public static function sync()
    {
        Scanner::scan(true);
        return new static;
    }
}