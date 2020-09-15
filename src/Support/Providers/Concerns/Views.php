<?php

namespace Aplify\Library\Support\Providers\Concerns;

trait Views
{
    /**
     * Register views & Publish views.
     *
     * @param null $alias
     * @param null $folder
     * @return $this
     */
    public function registerViews($alias = null, $folder = null): self
    {
        $path = $folder ?? $this->resource->path('resources/views');
        $alias = $alias ?? $this->resource->alias;
        $this->loadViewsFrom($path, $alias);

        return $this;
    }
}
