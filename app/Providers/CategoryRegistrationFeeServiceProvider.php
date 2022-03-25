<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryRegistrationFeeServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\CategoryFee\CategoryFeeContract', 'App\Repositories\CategoryFee\EloquentCategoryFeeRepository');

    }
}
