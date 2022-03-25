<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractorCategoryServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\ContractorCategory\ContractorCategoryContract', 'App\Repositories\ContractorCategory\EloquentContractorCategoryRepository');

    }
}
