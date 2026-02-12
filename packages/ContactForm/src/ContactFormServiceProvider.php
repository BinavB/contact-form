<?php

namespace ContactForm;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ContactFormServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/contact-form.php',
            'contact-form'
        );
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'contact-form');
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->publishes([
            __DIR__ . '/Config/contact-form.php' => config_path('contact-form.php'),
        ], 'contact-form-config');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/contact-form'),
        ], 'contact-form-views');

        $this->publishes([
            __DIR__ . '/Database/Migrations' => database_path('migrations'),
        ], 'contact-form-migrations');

        View::composer('contact-form::layouts.app', function ($view) {
            $view->with('appName', config('app.name'));
        });
    }
}
