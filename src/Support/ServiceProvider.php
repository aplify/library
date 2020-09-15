<?php

namespace Aplify\Library\Support;

use Aplify\Library\Support\Contracts\ResourceProvider;
use Aplify\Library\Support\Providers\Concerns\Resource;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;;

class ServiceProvider extends BaseServiceProvider implements ResourceProvider
{
    use Resource;
}