<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
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
        return view('components.form.input');
    }
}
