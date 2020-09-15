<?php

namespace Aplify\Library\Support\Providers\Concerns;

use Illuminate\Foundation\AliasLoader;

trait Alias
{
    /**
     * Register alias.
     */
    public function registerAlias(): self
    {
        $loader = AliasLoader::getInstance();

        foreach ($this->alias() as $alias => $class) {
            $loader->alias($alias, $class);
        }

        return $this;
    }

    /**
     * Get the alias by the provider.
     *
     * @return array
     */
    public function alias(): array
    {
        return [];
    }

}
