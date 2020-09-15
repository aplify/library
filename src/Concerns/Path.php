<?php

namespace Aplify\Library\Concerns;

trait Path
{
    /**
     * Path.
     *
     * @param null $key
     * @return mixed|string
     */
    public function path($key = null)
    {
        $path =  $this->collection()->path;

        if ($this->exists)
        {
            $path = dirname($this->file()->pathname);
        }

        if ($key) {
            return $path.'/'.$key;
        }

        return $path;
    }
}