<?php

namespace Aplify\Library\Support;

use Aplify\Library\Collection;
use Illuminate\Support\Str;

class Factory
{
    /**
     * The name of the resouece.
     *
     * @var string
     */
    public $name;

    /**
     * Collection.
     *
     * @var Collection
     */
    public $collection;

    /**
     * Path resource.
     *
     * @var $path
     */
    public $path;

    /**
     * The replacements array.
     *
     * @var array
     */
    protected $replaces = [];

    /**
     * Builder the resource.
     *
     * @param $collection
     * @return Factory
     */
    public function builder($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Generate structure replaces.
     *
     * @param string $name
     * @return Factory
     */
    public function generate(string $name)
    {
        $nameRule = config('library.factory.name.rule');
        $folderRule = config('library.factory.folder.rule');

        $this->name = $name;


        $of =  Str::of($name)->camel()->snake();

        $this->replaces = [
            'uuid' => (string) Str::uuid(),
            'name' => (string) $of->$nameRule(),
            'studlyName' => (string) $of->studly(),
            'namespace' => null,
            'vendor' => (string) $of->$folderRule(),
            'collection' => (string) $this->collection,
            'collectionSpace' => $this->collection->namespace,
            'collectionVendor' =>  $this->collection->vendor
        ];

        $this->path = $this->collection->path .'/'.$of->$folderRule();


        return $this;
    }

    /**
     * Build the resource.
     *
     * @return array
     */
    public function build()
    {
        if (is_dir($this->path)){
            return ['status' => false, 'message' => 'Sorry "'.$this->name.'" '. (string) $this->collection.' folder already exist!!!'];
        }

        foreach ($this->collection->stubs['files'] as $key => $value) {

            Stub::createFromPath($this->collection->stubs['path'].'/'.$key.'.stub',
                $this->replaces)
                ->saveTo($this->path, $value);
        }

        return ['status' => true, 'message' => Str::of($this->collection)->studly() . ' ' . $this->name . ' created successfully.',];
    }

    /**
     * Set Path.
     *
     * @param $path
     * @return Factory
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Set replacements array.
     *
     * @param $replace
     * @param $value
     * @return $this
     */
    public function replace($replace, $value = null)
    {
        if (is_array($replace)) {

            if ($value) {
                $this->replaces = $replace;
            } else {
                $this->replaces = array_merge($this->replaces, $replace);
            }
        }else {

            $this->replaces[$replace] = $value;
        }

        return $this;
    }
}