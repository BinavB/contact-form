<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ContactFormServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            base_path('packages/ContactForm/src/Config/contact-form.php'),
            'contact-form'
        );
    }

    public function boot()
    {
        $this->loadRoutesFrom(base_path('packages/ContactForm/src/Routes/web.php'));
        $this->loadRoutesFrom(base_path('packages/ContactForm/src/Routes/api.php'));
        $this->loadViewsFrom(base_path('packages/ContactForm/src/Views'), 'contact-form');
        $this->loadMigrationsFrom(base_path('packages/ContactForm/src/Database/Migrations'));

        $this->publishes([
            base_path('packages/ContactForm/src/Config/contact-form.php') => config_path('contact-form.php'),
        ], 'contact-form-config');

        $this->publishes([
            base_path('packages/ContactForm/src/Views') => resource_path('views/vendor/contact-form'),
        ], 'contact-form-views');

        $this->publishes([
            base_path('packages/ContactForm/src/Database/Migrations') => database_path('migrations'),
        ], 'contact-form-migrations');

        View::composer('contact-form::layouts.app', function ($view) {
            $view->with('appName', config('app.name'));
        });
    }
}
