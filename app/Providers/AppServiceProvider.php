<?php

namespace App\Providers;

use App\Models\UserLink;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('user_url', function (string $value) {
            return UserLink::where('url', $value)->firstOrFail();
        });
    }
}
