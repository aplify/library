<?php

namespace Aplify\Library\Concerns;

trait Assets
{
    /**
     * Find asset file for resource asset.
     *
     * @param string    $path
     *
     * @return string
     */
    public function assets($path)
    {
        return route(config('library.assets.name'), [$this->getAttribute('alias'), $path]);
    }
}
