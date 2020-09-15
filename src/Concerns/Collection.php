<?php

namespace Aplify\Library\Concerns;

use Aplify\Library\Explorer;

trait Collection
{
    /**
     * Collection resource's.
     *
     * @var string
     */
    protected $collection;

    /**
     *  Collection associated with the resource's.
     *
     * @param null $collection
     * @return string
     */
    public function collection($collection = null)
    {
        if (is_null($collection))
            return  Explorer::findCollection($this->collection);

        $this->collection = $collection;

        return $this;
    }
}