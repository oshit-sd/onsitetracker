<?php

namespace Onsite\Tracker;

use Illuminate\Support\ServiceProvider;

class TimeTrackerServiceProvider extends ServiceProvider
{
    public function register()
    {
        # code...
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadViewsFrom(__DIR__ . '/views', 'tracker');

        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/'),
        ], 'tracker-assets');
    }
}
