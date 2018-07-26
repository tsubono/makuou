<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PrintReceiptServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'printReceipt',             // キーとクラスをバインド
            'App\Services\PrintReceiptService'
        );
    }
}
