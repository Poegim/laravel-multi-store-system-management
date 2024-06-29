<?php

namespace App\Livewire\Warehouse\Category;

use App\Models\Warehouse\Category;
use Livewire\Component;

class ShowCategories extends Component
{
    public function render()
    {
        return view('livewire.warehouse.category.show-categories', [
            'categories' => Category::whereNull('parent_id')->with('children')->get(),
        ]);
    }
}
