<?php

namespace App\Livewire\Warehouse\Product;

use Livewire\Component;
use App\Traits\HasModal;
use App\Models\Warehouse\Brand;
use App\RendersCategoryOptions;
use Illuminate\Validation\Rule;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\InteractsWithBanner;

class CreateProduct extends Component
{
    use HasModal;
    use InteractsWithBanner;
    use RendersCategoryOptions;

    public ?Brand $brand;

    public ?array $categories;
    public string $name = '';
    public string $slug = '';
    public bool $is_device = false;
    public ?int $brand_id;
    public ?int $category_id;

    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function rules()
    {
        return [
            'name' => ['string','min:2','max:255',Rule::unique('products'),],
            'slug' => ['string','min:2','max:255',Rule::unique('products'),],
            'is_device' => ['boolean'],
            'brand_id' => ['exists:App\Models\Warehouse\Brand,id'],
            'category_id' => ['exists:App\Models\Warehouse\Category,id'],
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

    public function mount() {
        $this->categories = $this->categoryService->activeTree();
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
