<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class TextInput extends Component
{
    public $prefixId;
    public $name;
    public $label;
    public $required;
    public $readOnly;
    public $placeholder;
    public $value;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $required = false, $prefixId = '', $readOnly = false, $placeholder = false, $value = null, $class = '')
    {
        //Log::info($prefixId);        
        $this->name         = $name;
        $this->label        = $label;
        $this->required     = $required;
        $this->prefixId     = $prefixId;
        $this->readOnly     = $readOnly;
        $this->placeholder  = $placeholder;
        $this->value        = $value;
        $this->class        = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.text-input');
    }
}
