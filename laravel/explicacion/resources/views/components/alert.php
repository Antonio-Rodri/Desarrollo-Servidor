<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class alert extends Component
{
    public $colortext;
    public $colorbg;
    /**
     * Create a new component instance.
     */
    public function __construct($colortext = 'pink', $colorbg = 'blue') // valor por defecto
    {
        $this->colortext = $colortext;
        $this->colorbg = $colorbg;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }

    public function peligro()
    {
        if ($this->colorbg == "red")
            return "¡¡¡¡¡¡¡PELIGRO!!!!!!!!";
    }
}
