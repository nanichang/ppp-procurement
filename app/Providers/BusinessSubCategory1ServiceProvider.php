<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BusinessSubCategory1ServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\BusinessSubCategory1\BusinessSubCategoryContract', 'App\Repositories\BusinessSubCategory1\EloquentBusinessSubCategoryRepository');
    }
}
