<?php

// El comando para publicar estos recursos sería: 
// php artisan vendor:publish --tag=fcomponents-styles


namespace Eaquinta\FormComponentsPackage;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Eaquinta\FormComponentsPackage\Components\ButtonAdd;
use Eaquinta\FormComponentsPackage\Components\DateInput;
use Eaquinta\FormComponentsPackage\Components\TextInput;
use Eaquinta\FormComponentsPackage\Components\ButtonEdit;
use Eaquinta\FormComponentsPackage\Components\EmailInput;
use Eaquinta\FormComponentsPackage\Components\ButtonClose;
use Eaquinta\FormComponentsPackage\Components\FileInput;
use Eaquinta\FormComponentsPackage\Components\NumberInput;
use Eaquinta\FormComponentsPackage\Components\SelectInput;
use Eaquinta\FormComponentsPackage\Components\SwitchInput;
use Eaquinta\FormComponentsPackage\Components\TextDisplay;
use Eaquinta\FormComponentsPackage\Components\ButtonCustom;
use Eaquinta\FormComponentsPackage\Components\ButtonUpdate;
use Eaquinta\FormComponentsPackage\Components\CheckBoxInput;
use Eaquinta\FormComponentsPackage\Components\PasswordInput;
use Eaquinta\FormComponentsPackage\Components\TextAreaInput;
use Eaquinta\FormComponentsPackage\Components\SelectMultipleInput;

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
        // Publicar CSS
        $this->publishes([
            __DIR__ . '/resources/css/form-components.css' => public_path('vendor/fcomponents/form-components.css'),
        ], 'fcomponents-styles');
        // Registrar componentes
        Blade::component('fc-text-display',             TextDisplay::class);
        Blade::component('fc-display-text',             TextDisplay::class);

        Blade::component('fc-text-input',               TextInput::class);
        Blade::component('fc-input-text',               TextInput::class);
        Blade::component('fc-text-area-input',          TextAreaInput::class);
        Blade::component('fc-input-textarea',           TextAreaInput::class);
        Blade::component('fc-input-file',               FileInput::class);
        Blade::component('fc-input-number',             NumberInput::class);
        Blade::component('fc-switch-input',             SwitchInput::class);
        Blade::component('fc-input-switch',             SwitchInput::class);
        Blade::component('fc-date-input',               DateInput::class);
        Blade::component('fc-input-date',               DateInput::class);
        Blade::component('fc-email-input',              EmailInput::class);
        Blade::component('fc-password-input',           PasswordInput::class);
        Blade::component('fc-select-multiple-input',    SelectMultipleInput::class);
        Blade::component('fc-select-input',             SelectInput::class);
        Blade::component('fc-input-select',             SelectInput::class);
        Blade::component('fc-check-box-input',          CheckBoxInput::class);

        Blade::component('fc-button-close',             ButtonClose::class);
        Blade::component('fc-button-add',               ButtonAdd::class);
        Blade::component('fc-button-edit',              ButtonEdit::class);
        Blade::component('fc-button-update',            ButtonUpdate::class);
        Blade::component('fc-button-custom',            ButtonCustom::class);
    }
}
