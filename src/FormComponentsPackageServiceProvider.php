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
        // Cargar vistas
        $this->loadViewsFrom(__DIR__ . '/views', 'fcomponents');
        Blade::component('fc-text-input', \Eaquinta\FormComponentsPackage\Components\TextInput::class);        
        //Blade::component('fcomponents::components.hola', 'fc-text-input');
        //dd('Holax');
    }
}
