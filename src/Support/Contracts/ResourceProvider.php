<?php

namespace Aplify\Library\Support\Contracts;

interface ResourceProvider
{
    /**
     * Define resource in service provider.
     *
     * @param null $resource
     * @return mixed
     */
    public function setResource($resource);
}