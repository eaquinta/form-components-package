<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class SelectInput extends Component
{
    public $prefixId;
    public $name;
    public $label;
    public $required;
    public $readOnly;
    public $optionsList;
    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $required = false, $prefixId = '', $readOnly = false, $optionsList = [], $value = null)
    {
        //Log::info($prefixId);        
        $this->name         = $name;
        $this->label        = $label;
        $this->required     = $required;
        $this->prefixId     = $prefixId;
        $this->readOnly     = $readOnly;
        $this->optionsList  = $optionsList;
        $this->value        = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.select-input');
    }
}
