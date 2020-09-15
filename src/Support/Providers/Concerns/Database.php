<?php

namespace Aplify\Library\Support\Providers\Concerns;

trait Database
{
    /**
     * Register Database.
     *
     * @param null $folder
     * @return $this
     */
    protected function registerDatabase($folder = null): self
    {
        $path = $folder ?? $this->resource->path('database/migrations');
        $this->loadMigrationsFrom($path);

        return $this;
    }
}
