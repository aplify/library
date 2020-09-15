<?php

namespace Aplify\Library\Support\Providers\Concerns;

trait Config
{
    /**
     * Register config.
     *
     * @param null $alias
     * @param null $file
     * @return $this
     */
    protected function registerConfig($alias = null, $file = null): self
    {
        $file = $file ?? $alias;

        if ($alias)
            $this->mergeConfigFrom($this->resource->path('config/'.$file.'.php'), $alias);

        return $this;
    }
}
