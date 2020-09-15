<?php

namespace Aplify\Library\Support\Providers\Concerns;

trait Resource
{
    /**
     * @var $resource
     */
    public $resource;

    /**
     * Define resource in service provider.
     *
     * @param null $resource
     * @return null
     */
    public function setResource($resource = null)
    {
        if (is_null($resource))
            return  $this->resource;

        $this->resource = $resource;

        return $this;
    }
}
