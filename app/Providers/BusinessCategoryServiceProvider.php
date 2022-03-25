<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BusinessCategoryServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\BusinessCategory\BusinessCategoryContract', 'App\Repositories\BusinessCategory\EloquentBusinessCategoryRepository');
    }
}
