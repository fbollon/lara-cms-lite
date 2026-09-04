<?php

namespace Fbollon\LaraCmsLite;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LaraCmsLiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'lara-cms-lite');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'lara-cms-lite');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/layouts', 'lara-cms-lite');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('lara-cms-lite.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/resources/views' => resource_path('views/vendor/lara-cms-lite'),
            ], 'views');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'lara-cms-lite');

        // Register the main class to use with the facade
        $this->app->singleton('lara-cms-lite', function () {
            return new LaraCmsLite;
        });
    }
}
