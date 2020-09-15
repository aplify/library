<?php

namespace Aplify\Library\Support\Providers;

use Aplify\Library\Support\Contracts\ResourceProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider implements ResourceProvider
{
    use Concerns\Alias,
        Concerns\Config,
        Concerns\Configs,
        Concerns\Database,
        Concerns\Graphql,
        Concerns\Providers,
        Concerns\Resource,
        Concerns\Views;
}