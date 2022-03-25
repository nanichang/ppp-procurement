<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DirectorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        $this->app->bind('App\Repositories\Director\DirectorContract', 'App\Repositories\Director\EloquentDirectorRepository');
    }
}
