<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MdaServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\MDA\MdaContract', 'App\Repositories\MDA\EloquentMdaRepository');
    }
}
