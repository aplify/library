<?php

namespace Aplify\Library\Support;

class Autoload
{
    /**
     * Add Psr4
     *
     * @param $class
     * @param $path
     */
    public static function addPsr4($class, $path)
    {
        $composer = require(base_path('vendor/autoload.php'));

        if (! array_key_exists($class, $composer->getClassMap())) {
            $composer->addPsr4($class, $path);
        }

        $composer->register();
    }
}