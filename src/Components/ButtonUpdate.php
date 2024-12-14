<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class ButtonUpdate extends Component
{
    public $id;    
    public $label;
    public $icon;
    //public $required;
    //public $readOnly;
    /**
     * Create a new component instance.
     */
    public function __construct($label, $icon = 'far fa-save', $id = 'btn-update')
    {
        $this->id     = $id;
        $this->label    = $label;
        $this->icon     = $icon;
        // $this->prefixId = $prefixId;
        // $this->readOnly = $readOnly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.button-update');
    }
}
