<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BusinessSubCategory2ServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\BusinessSubCategory2\BusinessSubCategory2Contract', 'App\Repositories\BusinessSubCategory2\EloquentBusinessSubCategory2Repository');
    }
}
