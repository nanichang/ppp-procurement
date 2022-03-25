<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PDFCertifcateNameServiceProvider extends ServiceProvider
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
    public function boot(){
        $this->app->bind('App\Repositories\PdfCertificateName\PdfCertificateNameContract', 'App\Repositories\PdfCertificateName\EloquentPdfCertificateNameRepository');

    }
}
