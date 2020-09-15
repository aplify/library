<?php

namespace Aplify\Library\Concerns;

use Aplify\Library\Support\Facades\Factory;
use Illuminate\Support\Str;

trait Generate
{
    /**
     * Generate the resource.
     * @param $name
     * @return mixed
     */
    public function generate($name)
    {
        $factory = Factory::builder($this->collection());

        return $factory->generate($name)
                ->replace('namespace', $this->namespace(Str::of($name)->studly()));
    }
}