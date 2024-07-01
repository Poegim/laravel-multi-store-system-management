<?php

namespace App\Livewire\Warehouse\Category;

use App\Models\Warehouse\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowCategories extends Component
{
    protected function buildTree(array $categories, $parentId = null) {
        
        $branch = [];
    
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $children = $this->buildTree($categories, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }
    
        return $branch;
    }

    public function render()
    {
        $categoryTree = Cache::remember('categories_tree', 60, function () {
            $categories = DB::table('categories')->get()->map(function ($category) {
                return (array) $category;
            })->all();
        
            return $this->buildTree($categories);
        });
        
        return view('livewire.warehouse.category.show-categories', [
            'categories' => $categoryTree,
        ]);
    }
}
