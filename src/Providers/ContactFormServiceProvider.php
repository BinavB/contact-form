<?php

namespace YourVendor\ContactForm\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ContactFormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     */
    public function boot(): void
    {
        // ── Migrations ──────────────────────────────────────────────────────
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        // ── Views ────────────────────────────────────────────────────────────
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'contact-form');

        // ── Routes ───────────────────────────────────────────────────────────
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        // ── Publishables ─────────────────────────────────────────────────────
        if ($this->app->runningInConsole()) {
            // Config
            $this->publishes([
                __DIR__ . '/../Config/contact-form.php'
                    => config_path('contact-form.php'),
            ], 'contact-form-config');

            // Migrations
            $this->publishes([
                __DIR__ . '/../Database/migrations'
                    => database_path('migrations'),
            ], 'contact-form-migrations');

            // Views
            $this->publishes([
                __DIR__ . '/../Resources/views'
                    => resource_path('views/vendor/contact-form'),
            ], 'contact-form-views');
        }
    }

    /**
     * Register the package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/contact-form.php',
            'contact-form'
        );
    }
}
