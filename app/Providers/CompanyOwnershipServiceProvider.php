<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CompanyOwnershipServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\CompanyOwnership\CompanyOwnershipContract', 'App\Repositories\CompanyOwnership\EloquentCompanyOwnershipRepository');
    }
}
