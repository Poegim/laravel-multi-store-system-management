<?php

namespace App\Livewire\Warehouse\Product;

use Livewire\Component;
use App\Traits\HasModal;
use App\Models\Warehouse\Brand;
use Illuminate\Validation\Rule;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Traits\HasUpdatedName;
use Illuminate\Support\Facades\DB;
use App\Traits\RendersCategoryOptions;
use Laravel\Jetstream\InteractsWithBanner;

class CreateProduct extends Component
{
    use HasModal;
    use InteractsWithBanner;
    use RendersCategoryOptions;
    use HasUpdatedName;

    public ?Brand $brand;

    public ?array $categories;
    public string $name = '';
    public string $slug = '';
    public bool $is_device = false;
    public ?int $brand_id;
    public ?int $category_id;

    protected ProductService $productService;
    protected CategoryService $categoryService;

    // protected $listeners = ['brandSelected'];

    // public function brandSelected($brandId)
    // {
    //     $this->brand_id = $brandId;
    // }

    public function rules()
    {
        return [
            'name' => ['required', 'string','min:2','max:255',Rule::unique('products'),],
            'slug' => ['required', 'string','min:2','max:255',Rule::unique('products'),],
            'is_device' => ['required', 'boolean'],
            'brand_id' => ['required', 'exists:App\Models\Warehouse\Brand,id'],
            'category_id' => ['required', 'exists:App\Models\Warehouse\Category,id'],
        ];
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function boot(ProductService $productService, CategoryService $categoryService) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function mount()
    {
        $this->categories = $this->categoryService->activeTree();
    }

    public function store()
    {
        $validated = $this->validate();
        $flag = $this->productService->store($validated);
        $this->resetVars();
        $this->modalVisibility = false;
        $flag ? $this->banner('Successfully created!') : $this->dangerBanner('An error was encountered while creating.');
        $this->dispatch('reloadProductsIndex');
    }

    public function resetVars()
    {
        $this->name = '';
        $this->slug = '';
        $this->is_device = false;
        $this->brand_id = null;
        $this->category_id = null;
        $this->brand = null;
    }

    public function render()
    {
        $brands = $brands = DB::table('brands')
        ->select('id', 'name')
        ->get();

        $categoryOptions = $this->renderCategoryOptions($this->categories);

        return view('livewire.warehouse.product.create-product', [
            'brands' => $brands,
            'categoryOptions' => $categoryOptions,
        ]);
    }
}
