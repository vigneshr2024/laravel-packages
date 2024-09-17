<?php

namespace Laravel\Auth;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Laravel\Auth\App\Http\Middleware\UserAuthCheck;

class AuthServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__ . '/routes/auth.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'auth');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('userauthcheck', UserAuthCheck::class);
    }
}
