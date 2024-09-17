<?php

namespace Laravel\Permission;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/permission.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'permission');
        $router = $this->app->make(Router::class);
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
