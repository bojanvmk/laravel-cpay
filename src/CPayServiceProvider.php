<?php

namespace Bojanvmk\CPay;

use Illuminate\Support\ServiceProvider;

class CPayServiceProvider extends ServiceProvider
{
    private const VIEW_PATH   = __DIR__ . '/../resources/views';
    private const CONFIG_PATH = __DIR__ . '/../config/cpay.php';

    public function boot()
    {
        $this->loadViewsFrom(static::VIEW_PATH, 'laravel-cpay');

        $this->publishes([
            static::CONFIG_PATH => config_path('/cpay.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(static::CONFIG_PATH, 'cpay');
    }
}
