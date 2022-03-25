<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Countries\CountriesContract', 'App\Repositories\Countries\EloquentCountriesRepository');

        $this->app->bind('App\Repositories\States\StateContract', 'App\Repositories\States\EloquentStateRepository');
    }
}
