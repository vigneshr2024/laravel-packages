<?php

namespace Laravel\User;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/user.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'user');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $router = $this->app->make(Router::class);
    }
}
