<?php

namespace Eaquinta\FormComponentsPackage\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    public $prefixId;
    public $name;
    public $label;
    public $required;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $required = false, $prefixId = '')
    {
        if (!empty($prefixId))
        {dd($prefixId);}
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->$prefixId = $prefixId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('fcomponents::components.text-input');
    }
}
