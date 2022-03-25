<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdvertModeServiceProvider extends ServiceProvider
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
    public function boot(){
        $this->app->bind('App\Repositories\AdvertMode\AdvertModeContract', 'App\Repositories\AdvertMode\EloquentAdvertModeRepository');

    }
}
