<?php

namespace App\Livewire\Warehouse\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Warehouse\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ShowCategories extends Component
{
    public bool $modalVisibility = false;
    public string $activeModalTab = 'A';
    public string $actionType = '';
    public ?int $categoryId = null;

    //DB columns.
    public $plural_name;
    public $singular_name;
    public $parent_id;
    public $slug;
    public $disabled;

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function rules() : Array
    {
        $rules = [
            'parent_id' => [
                'exists:categories',
                'nullable'
            ]
        ];

        if($this->category != null) {        
            $rules['plural_name'] = [
                'required',
                'string', 
                'max:50',
                Rule::unique('categories')->ignore($this->category->plural_name, 'plural_name'),
            ];
            $rules['singular_name'] = [
                'required',
                'string', 
                'max:50',
                Rule::unique('categories')->ignore($this->category->plural_name, 'singular_name'),
            ];
            $rules['slug'] = [
                'required',
                'string', 
                'max:50',
                Rule::unique('slug')->ignore($this->category->plural_name, 'slug'),
            ];
        } else {
            $rules['plural_name'] = [
                'required',
                'string', 
                'max:50',
                Rule::unique('categories'),
            ];
            $rules['singular_name'] = [
                'required',
                'string', 
                'max:50',
                Rule::unique('categories'),
            ];
            $rules['slug'] = [
                'required',
                'string', 
                'max:50',
                Rule::unique('slug'),
            ];
        }

        return $rules;
    }

    public function updatedPluralName($property) 
    {
        $this->slug = Str::slug($this->plural_name);
    }

    public function create() {
        $this->actionType = 'create';
        $this->modalVisibility = true;
    }

    private function buildTree(array $categories, $parentId = null) {
        
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
