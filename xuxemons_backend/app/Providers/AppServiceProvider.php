<?php

namespace App\Providers;

use App\Models\Xuxemons;
use App\Observers\XuxemonObserver;
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
    public function boot()
    {
        Xuxemons::observe(XuxemonObserver::class);
    }
}
