<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AwardServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Award\AwardContract', 'App\Repositories\Award\EloquentAwardRepository');

    }
}
