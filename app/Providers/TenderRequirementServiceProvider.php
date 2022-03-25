<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TenderRequirementServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\TenderRequirement\TenderRequirementContract', 'App\Repositories\TenderRequirement\EloquentTenderRequirementRepository');

    }
}
