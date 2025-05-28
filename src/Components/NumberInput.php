<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class NumberInput extends Component
{
    public $id;
    public $prefixId;
    public $name;
    public $label;
    public $required;
    public $readOnly;
    public $placeholder;
    public $value;
    public $class;
    public $disabled;
    public $min;
    public $max;
    public $step;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $label,
        $required = false,
        $prefixId = '',
        $readOnly = false, 
        $placeholder = false, 
        $value = null, 
        $class = '', 
        $disabled = false, 
        $id = null,
        $min = null,
        $max = null,
        $step = 1
    )
    {
        $this->id           = $id;
        $this->name         = $name;
        $this->label        = $label;
        $this->required     = $required;
        $this->prefixId     = $prefixId;
        $this->readOnly     = $readOnly;
        $this->placeholder  = $placeholder;
        $this->value        = $value;
        $this->class        = $class;
        $this->disabled     = $disabled;
        $this->min          = $min;
        $this->max          = $max;
        $this->step         = $step;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.number-input');
    }
}