<?php

namespace Aplify\Library\Support\Providers\Concerns;

use Nuwave\Lighthouse\Events\BuildSchemaString;
use Symfony\Component\Finder\Finder;

trait Graphql
{
    /**
     * Register Graphql.
     *
     * @param string $type
     * @param $folder
     * @return $this
     */
    public function registerGraphql($type = 'graphql', $folder = null): self
    {
        $path = $folder ?? $this->resource->path('graphql');

        $files = Finder::create()->files()
            ->in($path)
            ->name('*.'.$type)
            ->contains([]);

        if ($type == 'php')
        {
            foreach($files as $item)
            {
                $config = $this->app['config']->get('graphql', []);
                $data = require $item->getPathname();
                $this->app['config']->set('graphql',
                    array_merge_recursive($data, $config)
                );
            }
        }

        if ($type == 'graphql')
        {
            foreach($files as $item)
            {
                app('events')->listen(
                    BuildSchemaString::class,
                    function () use ($item): string {
                        return $item->getContents();
                    }
                );
            }
        }

        return $this;
    }
}
