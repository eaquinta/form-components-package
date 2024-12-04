<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class TextAreaInput extends Component
{
    public $prefixId;
    public $name;
    public $label;
    public $required;
    public $readOnly;
    public $placeholder;
    public $rows;
    public $cols;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $required = false, $prefixId = '', $readOnly = false, $placeholder = false, $rows = 3, $cols = 20)
    {
        //Log::info($prefixId);        
        $this->name         = $name;
        $this->label        = $label;
        $this->required     = $required;
        $this->prefixId     = $prefixId;
        $this->readOnly     = $readOnly;
        $this->placeholder  = $placeholder;
        $this->rows         = $rows;
        $this->cols         = $cols;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.text-area-input');
    }
}