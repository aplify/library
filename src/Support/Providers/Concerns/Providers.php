<?php

namespace Aplify\Library\Support\Providers\Concerns;

use Aplify\Library\Support\Contracts\ResourceProvider;

trait Providers
{
    /**
     * Register providers.
     */
    public function registerProviders(): self
    {
        foreach ($this->providers() as $provider) {

            $instance = (new $provider($this->app));

            if ($instance instanceof ResourceProvider){
                $instance->setResource($this->resource);
                $this->app->register($instance);
            } else {
                $this->app->register($provider);
            }
        }
        return $this;
    }

    /**
     * Register services providers by the resource.
     *
     * @return array
     */
    public function providers()
    {
        return [];
    }
}
