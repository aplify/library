<?php

namespace Aplify\Library\Concerns;

use Illuminate\Config\Repository;

trait Composer
{
    /**
     *  Composer associated with the resource.
     *
     * @var array|boolean
     */
    protected $composer = false;

    /**
     *  Get the composer resource.
     *
     * @param null $key
     * @return Repository|mixed
     */
    public function composer($key = null)
    {
        $composer = new Repository($this->composer);

        if ($key){
            return $composer->get($key);
        }

        return $composer;
    }

    /**
     *  Set the composer resource.
     *
     * @param null $composer
     * @return $this
     */
    public function setComposer($composer = null)
    {
        $this->composer = $composer;

        return $this;
    }
}
