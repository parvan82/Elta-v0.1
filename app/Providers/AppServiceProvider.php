<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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


    public function boot()
    {
        // کوکی remember_me رو به 30 روز محدود کنیم
        Auth::viaRemember();

        // Override TTL برای کوکی ریممبر
        Cookie::queue(
            Auth::guard()->getRecallerName(),
            Cookie::get(Auth::guard()->getRecallerName()),
            60 * 24 * 30 // دقیقه → 30 روز
        );
    }
}
