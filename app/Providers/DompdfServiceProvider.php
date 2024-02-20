<?php

namespace App\Providers;

use Dompdf\Dompdf;
use Illuminate\Support\ServiceProvider;

class DompdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('dompdf', function () {
            return new Dompdf();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
