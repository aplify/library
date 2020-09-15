<?php

namespace Aplify\Library\Support\Providers;

use Aplify\Library\Support\Contracts\ResourceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider implements ResourceProvider
{
    use Concerns\Resource;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            if(file_exists($api = $this->resource->path('routes/api.php')))
                Route::prefix('api')
                    ->middleware('api')
                    ->group($api);

            if(file_exists($web = $this->resource->path('routes/web.php')))
                Route::middleware('web')
                    ->group($web);
        });
    }
}