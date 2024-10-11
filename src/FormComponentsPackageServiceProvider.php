<?php

namespace Eaquinta\FormComponentsPackage;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Eaquinta\FormComponentsPackage\Components\ButtonAdd;
use Eaquinta\FormComponentsPackage\Components\DateInput;
use Eaquinta\FormComponentsPackage\Components\TextInput;
use Eaquinta\FormComponentsPackage\Components\EmailInput;
use Eaquinta\FormComponentsPackage\Components\ButtonClose;
use Eaquinta\FormComponentsPackage\Components\SwitchInput;

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
        Blade::component('fc-text-input',   TextInput::class);
        Blade::component('fc-switch-input', SwitchInput::class);
        Blade::component('fc-date-input',   DateInput::class);
        Blade::component('fc-email-input',  EmailInput::class);        

        Blade::component('fc-button-close', ButtonClose::class);
        Blade::component('fc-button-add',   ButtonAdd::class);
        //Blade::component('fcomponents::components.hola', 'fc-text-input');
        //dd('Holax');
    }
}
