<?php

namespace Aplify\Library\Concerns;

trait Arrayable
{
    /**
     * Convert the resource instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributesToArray();
    }
}
