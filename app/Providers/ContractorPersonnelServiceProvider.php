<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractorPersonnelServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\ContractorPersonnel\ContractorPersonnelContract', 'App\Repositories\ContractorPersonnel\EloquentContractorPersonnelRepository');

    }
}
