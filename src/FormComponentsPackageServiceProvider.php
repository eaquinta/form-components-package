<?php

namespace eaquinta\FormComponentsPackage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class FormComponentsPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Cargar vistas
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'fcomponents');

        // Registrar el componente
        Blade::component('fcomponent-input', \eaquinta\FormComponentsPackage\Components\FromInput::class);
    }

    public function register()
    {
        //
    }
}
