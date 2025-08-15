<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class FileInput extends Component
{
    public $prefixId;
    public $name;
    public $id;
    public $label;
    public $required;
    public $readOnly;
    public $placeholder;
    public $accept;
    public $multiple;
    public $class;
    public $disabled;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name, 
        $label, 
        $required = false, 
        $prefixId = '', 
        $readOnly = false, 
        $disabled = false, 
        $placeholder = false, 
        $accept = '', 
        $multiple = false,
        $class = '',
        $id = null
    )
    {
        $this->name         = $name;
        $this->label        = $label;
        $this->required     = $required;
        $this->prefixId     = $prefixId;
        $this->readOnly     = $readOnly;
        $this->placeholder  = $placeholder;
        $this->accept       = $accept;
        $this->multiple     = $multiple;
        $this->class        = $class;
        $this->disabled     = $disabled;
        $this->id           = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.file-input');
    }
}