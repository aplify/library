<?php

namespace Aplify\Library\Providers;

use Aplify\Library\Console\Commands\LibraryList;
use Aplify\Library\Console\Commands\LibraryMake;
use Aplify\Library\Console\Commands\LibrarySync;
use Aplify\Library\Explorer;
use Aplify\Library\Scanner;
use Aplify\Library\Support\Factory;
use Illuminate\Support\ServiceProvider;

class LibraryServiceProvider extends ServiceProvider
{
    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        if (! defined('LIBRARY_PATH')) {
            define('LIBRARY_PATH', realpath(__DIR__.'/../../'));
        }

        $this->mergeConfigFrom(realpath(LIBRARY_PATH . '/config/library.php'), 'library');
        $this->app->bind('library.scanner', Scanner::class);
        $this->app->bind('library', Explorer::class);
        $this->app->bind('library.factory', Factory::class);
        $this->registerDefaultCollection();
        $this->registerCommands();
        $this->makeDirectory();
    }

    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        $this->registerAutoload();
        $this->registerAssets();
    }

    /**
     * Register Library´s.
     *
     * @return void
     */
    public function registerAutoload()
    {
        Explorer::run($this->app);
    }

    /**
     * Register default collection for the Library´s.
     *
     * @return void
     */
    public function registerDefaultCollection()
    {

        if (config('library.default')) {
            Explorer::collection(config('library.default'));
        }
    }

    /**
     * Make Directory if no exist.
     *
     * @return void
     */
    public function makeDirectory()
    {
        if (!file_exists(config('library.scanner.folder')))
            mkdir(config('library.scanner.folder'), 0755, true);
    }

    /**
     * Register Library´s.
     *
     * @return void
     */
    public function registerAssets()
    {
        $this->app['router']->get(config('library.assets.route'), config('library.assets.controller'))
            ->where('patch', '.*')
            ->name(config('library.assets.name'));
    }

    /**
     * Register Commands.
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([
            LibraryList::class,
            LibraryMake::class,
            LibrarySync::class
        ]);
    }
}
