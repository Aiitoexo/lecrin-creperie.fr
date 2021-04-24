<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use function session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!session('cart')) {
            session()->put('cart', []);
        }
    }
}
