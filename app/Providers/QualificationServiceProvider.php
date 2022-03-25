<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QualificationServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Qualifications\QualificationContract', 'App\Repositories\Qualifications\EloquentQualificationRepository');
    }
}
