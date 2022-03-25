<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EquipmentServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Equipments\EquipmentContract', 'App\Repositories\Equipments\EloquentEquipmentRepository');
    }
}
