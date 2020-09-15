<?php

use Aplify\Library\Collection;
use Aplify\Library\Support\Alias;
use Aplify\Library\Support\Facades\Library;

if (! function_exists('library')) {
    /**
     * Get the available Library explorer instance.
     *
     * @param null $collection
     * @return Library|Collection
     */
    function library($collection = null)
    {
        $instance = Library::getFacadeRoot();

        if ($collection) {

            if (Alias::check($collection)) {
                return  $instance->resource()->where('alias', $collection)->first();
            } else {
                return $instance->findCollection($collection);
            }
        }

        return $instance;
    }
}

if (! function_exists('library_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function library_path($path = '')
    {
        return config('library.scanner.folder').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
