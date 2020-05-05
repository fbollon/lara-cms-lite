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
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'lara-cms-lite');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'lara-cms-lite');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/layouts', 'lara-cms-lite');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('lara-cms-lite.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../vendor/tinymce' => public_path('vendor/tinymce'),
            ], 'public');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/lara-cms-lite'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/lara-cms-lite'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/lara-cms-lite'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'lara-cms-lite');

        // Register the main class to use with the facade
        $this->app->singleton('lara-cms-lite', function () {
            return new LaraCmsLite;
        });
    }
}
