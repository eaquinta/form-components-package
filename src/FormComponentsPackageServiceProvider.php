<?php

namespace Eaquinta\FormComponentsPackage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class FormComponentsPackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::component('fc-text-input', 'components.hola');
    }
}
