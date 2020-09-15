<?php

namespace Aplify\Library\Concerns;

trait File
{
	/**
     * The file data associated  with the item.
     *
     * @var array|boolean
     */
    protected $file = null;

    /**
     * Get the location associated with the resource.
     *
     * @return mixed
     */
    public function file()
    {
        return $this->file;
    }

    /**
     * Set the location associated with the resource.
     *
     * @param  string  $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
