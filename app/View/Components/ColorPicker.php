<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColorPicker extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $selected,
        )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.color-picker');
    }
}
