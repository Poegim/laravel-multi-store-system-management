<?php

namespace App\Livewire\Warehouse\Product;

use Livewire\Component;
use App\Traits\HasModal;
use App\Traits\Sortable;
use App\Traits\Searchable;
use Livewire\WithPagination;
use App\Models\Warehouse\Brand;
use Illuminate\Validation\Rule;
use App\Services\ProductService;
use App\Models\Warehouse\Product;
use App\Services\CategoryService;
use App\Traits\HasUpdatedName;
use Illuminate\Support\Facades\DB;
use App\Traits\RendersCategoryOptions;
use Laravel\Jetstream\InteractsWithBanner;

class IndexProducts extends Component
{
    use Sortable;
    use Searchable;
    use HasModal;
    use HasUpdatedName;
    use WithPagination;
    use InteractsWithBanner;
    use RendersCategoryOptions;

    public ?Product $product;
    public ?Brand $brand;

    public ?array $categories;
    public ?string $name;
    public ?string $slug;
    public ?bool $is_device;
    public ?int $brand_id;
    public ?int $category_id;

    protected ProductService $productService;
    protected CategoryService $categoryService;

    protected $listeners = ['reloadProductsIndex'];

    public function reloadProductsIndex()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string','min:2','max:255',Rule::unique('products')->ignore($this->product->id),],
            'slug' => ['required', 'string','min:2','max:255',Rule::unique('products')->ignore($this->product->id),],
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

    public function mount() {
        $this->categories = $this->categoryService->allTree();
    }

    public function update() {
        $validated = $this->validate();
        $flag = $this->productService->update($validated, $this->product);
        $this->modalVisibility = false;
        if($flag) {
            $this->banner('Successfully updated!');
         } else {
             $this->dangerBanner('An error was encountered while updating.');
         }
    }

    public function updatedBrandId()
    {
        $this->brand = Brand::findOrFail($this->brand_id);
    }

    public function edit(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->is_device = $product->is_device;
        $this->brand = Brand::findOrFail($this->brand_id);
        $this->dispatch('resetSearchDropdownState');
        $this->showModal('edit');
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $productsQuery = Product::with(['category'])
        ->where('products.name', 'like', '%' . $this->search . '%') // Explicitly specify that we're referring to products.name
        ->withCount('productVariants'); // Add the alias 'product_variants_count'

        if ($this->sortField === 'brand') {
            // Add a join to the brands table to sort by brand.name
            $productsQuery = $productsQuery->join('brands', 'products.brand_id', '=', 'brands.id')
                                           ->orderBy('brands.name', $sortDirection);
        } elseif ($this->sortField === 'product_variants_count') {
            // Sort by the 'product_variants_count' alias without the 'products' prefix
            $productsQuery = $productsQuery->orderBy('product_variants_count', $sortDirection);
        } else {
            // Standard sorting by fields from the Product model
            $productsQuery = $productsQuery->orderBy('products.' . $this->sortField, $sortDirection); // Explicitly specify that the sorting applies to columns from the products table
        }

        $products = $productsQuery->paginate(10);


        $categoryOptions = $this->renderCategoryOptions($this->categories);

        return view('livewire.warehouse.product.index-products', compact('products', 'categoryOptions'));
    }
}
