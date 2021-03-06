<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdvertLotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        $this->app->bind('App\Repositories\AdvertLot\AdvertLotContract', 'App\Repositories\AdvertLot\EloquentAdvertLotRepository');

    }
}
