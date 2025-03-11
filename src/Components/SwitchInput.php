<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class SwitchInput extends Component
{
    public $prefixId;
    public $name;
    public $label;
    public $required;
    public $readOnly;
    public $value;
    public $disabled;
    public $checked;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $required = false, $prefixId = '', $readOnly = false, $value = 1, $disabled = false, $checked = false)
    {
        //Log::info($prefixId);        
        $this->name     = $name;
        $this->label    = $label;
        $this->required = $required;
        $this->prefixId = $prefixId;
        $this->readOnly = $readOnly;
        $this->value    = $value;
        $this->disabled = $disabled;
        $this->checked  = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.switch-input');
    }
}
