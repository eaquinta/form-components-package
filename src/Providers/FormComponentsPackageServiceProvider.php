<?php

namespace eaquinta\FormComponentsPackage\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class FormComponentsPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Cargar vistas
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'fcomponents');

        // Registrar el componente
        Blade::component('fc-text-input', \eaquinta\FormComponentsPackage\Components\TextInput::class);
    }

    public function register()
    {
        //
    }
}
