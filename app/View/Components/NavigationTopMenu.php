<?php

namespace App\View\Components;

use Closure;
use App\Models\Store;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class NavigationTopMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation-top-menu', [
            'stores' => Store::select('id', 'name', 'invoices_prefix')->get(),
        ]);
    }
}
