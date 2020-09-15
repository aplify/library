<?php

namespace Aplify\Library\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Library extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'library';
    }
}