<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdvertServiceProvider extends ServiceProvider
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
    public function boot()
    {
        $this->app->bind('App\Repositories\Advert\AdvertContract', 'App\Repositories\Advert\EloquentAdvertRepository');

    }
}
