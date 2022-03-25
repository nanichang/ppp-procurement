<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractorFinanceServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\ContractorFinance\ContractorFinanceContract', 'App\Repositories\ContractorFinance\EloquentContractorFinanceRepository');
    }
}
