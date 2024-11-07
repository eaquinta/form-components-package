<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class DateInput extends Component
{
    public $prefixId;
    public $name;
    public $label;
    public $required;
    public $readOnly;
    public $value
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $required = false, $prefixId = '', $readOnly = false, $value = '')
    {
        //Log::info($prefixId);        
        $this->name     = $name;
        $this->label    = $label;
        $this->required = $required;
        $this->prefixId = $prefixId;
        $this->readOnly = $readOnly;
        $this->value    = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.date-input');
    }
}
