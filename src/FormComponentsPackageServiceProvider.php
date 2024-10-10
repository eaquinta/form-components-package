<?php

namespace eaquinta\FormComponentsPackage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class FormComponentsPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Cargar vistas
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mycomponent');

        // Registrar el componente
        Blade::component('Input', \eaquinta\FormComponentsPackage\Components\From\Input::class);
    }

    public function register()
    {
        //
    }
}
