<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class InputColor extends Component
{
    public $id;
    public $name;
    public $prefixId;
    public $value;
    public $label;
    // public $required;
    // public $readOnly;
    // public $placeholder;
    // public $placeholderText;
    // public $class;
    // public $disabled;
    // public $requiredChar;
    // public $requiredDisable;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $label,
        $id = null,
        $prefixId = '',
        $value = null, 
        // $required = false,
        // $readOnly = false, 
        // $placeholder = false,
        // $placeholderText = null,
        // $class = '', 
        // $disabled = false, 
        // $requiredChar = '*',
        // $requiredDisable = false
    )
    {
        $this->id               = $id;
        $this->name             = $name;
        $this->prefixId         = $prefixId;
        $this->value            = $value;
        $this->label            = $label;
        // $this->required         = $required;
        // $this->readOnly         = $readOnly;
        // $this->placeholder      = $placeholder;
        // $this->placeholderText  = $placeholderText;
        // $this->class            = $class;
        // $this->disabled         = $disabled;
        // $this->requiredChar     = $requiredChar;
        // $this->requiredDisable  = $requiredDisable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.input-color');
    }
}
