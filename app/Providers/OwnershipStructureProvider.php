<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OwnershipStructureProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\OwnershipStructure\OwnershipStructureContract', 'App\Repositories\OwnershipStructure\EloquentOwnershipRepository');
    }
}
