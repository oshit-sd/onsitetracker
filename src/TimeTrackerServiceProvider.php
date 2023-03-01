<?php

namespace Osd\TimeTrack;

use Illuminate\Support\ServiceProvider;

class TimeTrackServiceProvider extends ServiceProvider
{
    public function register()
    {
        # code...
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/'),
        ], 'time-track-assets');
    }
}
