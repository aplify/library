<?php

namespace Aplify\Library;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Finder\Finder;

class Scanner
{
    /**
     * All resources.
     *
     * @var array
     */
    protected $items = [];

    /**
     * @var $folder.
     */
    protected $folder;

    /**
     * @var $filename.
     */
    protected $filename;

    /**
     * Scanner constructor.
     */
    public function __construct()
    {
        $this->folder = config("library.scanner.folder");
        $this->filename = config("library.scanner.filename");
        $this->scan();
    }

    /**
     * Get all resources.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Library scan.
     *
     * @param bool $force
     * @return Scanner
     */
    public function scan($force = false)
    {
        if ($force && config('library.cache.enable')) $this->cache($force);
        else $this->finder();

        return $this;
    }

    /**
     * Get resources of the cache.
     *
     * @param bool $force
     * @return array
     */
    public function cache($force = false)
    {
        if ($force || !Cache::has(config('library.cache.key')))
            Cache::forever(config('library.cache.key'),  $this->finder());

        return $this->items = Cache::get(config('library.cache.key'));
    }

    /**
     * Finds resources files.
     *
     * @return array
     */
    public function finder()
    {
        $finder = Finder::create()
            ->files()
            ->in($this->folder)
            ->name($this->filename);

        $files = [];

        foreach ($finder as $file) $files[] = $this->generate($file);

        return  $this->items = $files;
    }

    /**
     * Generate resource structure.
     *
     * @param $file
     * @return mixed
     */
    public function generate($file)
    {
        $item = json_decode($file->getContents());

        if ($item->core) $item->active = $item->core;
        if (!$item->alias) $item->alias = $item->type.':'.$item->name;

        $merge['data'] = $item;
        $merge['file'] = (object)[
            'filename' => $file->getFilename(),
            'extension' => $file->getExtension(),
            'pathname' => $file->getPathname(),
            'path' => $file->getPath(),
        ];
        $merge['composer'] =  json_decode(file_get_contents($file->getPath().'/composer.json'), 1);

        return (object)$merge;
    }
}