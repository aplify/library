<?php

namespace Aplify\Library\Concerns;

trait SpaceName
{
    /**
     * Get the namespace
     *
     * @param null $key
     * @return mixed
     */
    public function namespace($key = null)
    {
        $namespace = $this->collection()->namespace;

        if ($this->exists)
            $namespace = $this->getOriginal('namespace');

        if ($key)
            $namespace = $namespace."\\".$key;

        return $namespace;
    }
}
