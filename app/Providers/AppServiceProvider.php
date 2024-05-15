<?php

namespace App\Providers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Services\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginService::class, function ($app) {
            return new LoginService();
        });

        $this->app->bind(LoginController::class, function ($app) {
            return new LoginController($app->make(LoginService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
