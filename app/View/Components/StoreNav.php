<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StoreNav extends Component
{
    public int $storeId;
    /**
     * Create a new component instance.
     */
    public function __construct(int $storeId)
    {
        $this->storeId = $storeId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.store-nav');
    }
}
