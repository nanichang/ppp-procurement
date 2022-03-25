<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TenderEligibilityServiceProvider extends ServiceProvider
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
    public function boot() {
        $this->app->bind('App\Repositories\TenderEligibility\TenderEligibilityContract', 'App\Repositories\TenderEligibility\EloquentTenderEligibilityRepository');

       
    }
}
