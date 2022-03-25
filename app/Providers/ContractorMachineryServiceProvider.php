<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractorMachineryServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\ContractorMachinery\ContractorMachineryContract', 'App\Repositories\ContractorMachinery\EloquentContractorMachineryRepository');

    }
}
