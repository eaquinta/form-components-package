<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class InputTextDimensional extends Component
{
    public $id;
    public $prefixId;
    public $name;
    public $nameDimensional;
    public $label;
    public $required;
    public $readOnly;
    public $placeholder;
    public $placeholderText;
    public $value;
    public $valueDimensional;
    public $class;
    public $disabled;
    public $requiredChar;
    public $requiredDisable;
    public $optionsList;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $nameDimensional,
        $label,
        $required = false,
        $prefixId = '',
        $readOnly = false, 
        $placeholder = false,
        $placeholderText = null,
        $value = null,
        $valueDimensional = null,
        $class = '', 
        $disabled = false, 
        $id = null,
        $requiredChar = '*',
        $requiredDisable = false,
        $optionsList = []
    )
    {
        $this->id               = $id;
        $this->name             = $name;
        $this->nameDimensional  = $nameDimensional;
        $this->label            = $label;
        $this->required         = $required;
        $this->prefixId         = $prefixId;
        $this->readOnly         = $readOnly;
        $this->placeholder      = $placeholder;
        $this->placeholderText  = $placeholderText;
        $this->value            = $value;
        $this->valueDimensional = $valueDimensional;
        $this->class            = $class;
        $this->disabled         = $disabled;
        $this->requiredChar     = $requiredChar;
        $this->requiredDisable  = $requiredDisable;
        $this->optionsList      = $optionsList;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.input-text-dimensional');
    }
}
