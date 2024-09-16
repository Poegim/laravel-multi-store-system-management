<?php

namespace App\Livewire\Warehouse\Category;

use Livewire\Component;
use App\Traits\HasModal;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Services\CategoryService;
use App\Models\Warehouse\Category;
use App\Rules\ValidParentCategory;
use Laravel\Jetstream\InteractsWithBanner;

class IndexCategories extends Component
{

    use InteractsWithBanner;
    use HasModal;

    protected CategoryService $categoryService;

    public ?Category $category = null;

    // Index of all categories.
    public $categories;

    // Index of categories with excluded children for select list, to avoid try put parent inside child.
    public $categoriesSelectList;

    //DB columns.
    public $plural_name;
    public $singular_name;
    public $parent_id;
    public $slug;
    public bool $disabled;

    public function mount()
    {
        $this->categories = $this->categoryService->allTree();
        $this->categoriesSelectList = $this->categoryService->allTree();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function boot(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function rules() : Array
    {
        $rules = [
            'parent_id' => [
                'exists:categories,id',
                'nullable',
                new ValidParentCategory($this->category ? $this->category->id : null),
            ],
            'disabled' => "required",
        ];

        if($this->category != null) {
            $rules['plural_name'] = [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('categories')->ignore($this->category->plural_name, 'plural_name'),
            ];
            $rules['singular_name'] = [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('categories')->ignore($this->category->singular_name, 'singular_name'),
            ];
            $rules['slug'] = [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('categories')->ignore($this->category->slug, 'slug'),
            ];
        } else {
            $rules['plural_name'] = [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('categories'),
            ];
            $rules['singular_name'] = [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('categories'),
            ];
            $rules['slug'] = [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('categories'),
            ];
        }

        return $rules;
    }

    public function updatedPluralName()
    {
        $this->slug = Str::slug($this->plural_name);
    }

    public function create() {
        $this->resetVars();
        $this->showModal('create');
    }

    public function store()
    {
        $validated = $this->validate();
        $flag = $this->categoryService->store($validated);
        $this->modalVisibility = false;
        $flag ? $this->banner('Successfully created!') : $this->dangerBanner('An error was encountered while creating.');
        $this->refreshCategoryList();
    }

    public function edit($id)
    {
        $this->category = Category::findOrFail($id);
        $this->categoriesSelectList = $this->categoryService->activeTree($this->category->id);
        $this->plural_name = $this->category->plural_name;
        $this->singular_name = $this->category->singular_name;
        $this->parent_id = $this->category->parent_id;
        $this->slug = $this->category->slug;
        $this->disabled = $this->category->disabled;
        $this->showModal('edit');
    }

    public function update()
    {
        $validated = $this->validate();
        $flag = $this->categoryService->update($validated, $this->category->id);
        $this->modalVisibility = false;
        $flag ? $this->banner('Successfully updated!') : $this->dangerBanner('An error was encountered while updating.');
        $this->refreshCategoryList();
    }

    private function refreshCategoryList()
    {
        $this->categories = $this->categoryService->allTree();
    }

    public function resetVars()
    {
        $this->actionType = '';
        $this->category = null;
        $this->plural_name = null;
        $this->singular_name = null;
        $this->parent_id = null;
        $this->slug = null;
        $this->disabled = false;
    }

    public function render()
    {
        return view('livewire.warehouse.category.index-categories');
    }
}
