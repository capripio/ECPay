<?php

namespace flamelin\ECPay;

use Illuminate\Support\ServiceProvider;

class EcpayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Route
        include __DIR__ . '/routes.php';

        //Language
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'ecpay');

        //Publish Config
        $this->publishes([
            __DIR__ . '/Config/ecpay.php' => config_path('ecpay.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Config
        $this->mergeConfigFrom(__DIR__ . '/Config/ecpay.php', 'ecpay');

        //View
        $this->loadViewsFrom(__DIR__ . '/Views', 'ecpay');

        //Facade => Custom Class
        $this->app['ecpay'] = $this->app->share(function ($app) {
            return new Ecpay;
        });

    }
}
