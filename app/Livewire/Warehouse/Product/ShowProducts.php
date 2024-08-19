<?php

namespace App\Livewire\Warehouse\Product;

use App\Models\Warehouse\Brand;
use Livewire\Component;
use App\Traits\HasModal;
use App\Traits\Sortable;
use App\Traits\BuildTree;
use App\Traits\Searchable;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Services\ProductService;
use App\Models\Warehouse\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Laravel\Jetstream\InteractsWithBanner;

class ShowProducts extends Component
{
    use Sortable;
    use Searchable;
    use HasModal;
    use WithPagination;
    use InteractsWithBanner;
    use BuildTree;

    public ?Product $product;
    public ?Brand $brand;
    
    public ?array $categories;
    public ?string $name;
    public ?string $slug;
    public ?bool $is_device;
    public ?int $brand_id;
    public ?int $category_id;

    protected ProductService $productService;

    public function rules() 
    {
        return [
            'name' => ['string','min:2','max:255',Rule::unique('products'),],
            'slug' => ['string','min:2','max:255',Rule::unique('products'),],
            'is_device' => ['boolean'],
            'brand_id' => ['exists:App\Models\Brand,id'],
            'category_id' => ['exists:App\Models\Category,id'],
        ];
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function boot(ProductService $productService) {
        $this->productService = $productService;
    }

    public function mount() {
        //Get enabled categories and build tree.
        $categoryTree = Cache::remember('categories_tree', 60, function () {
            $categories = DB::table('categories')->where('disabled', 0)->get()->map(function ($category) {
                return (array) $category;
            })->all();
        
            $this->categories = $this->buildTree($categories);
        });
    }

    public function updatedName() 
    {
        $this->slug = Str::slug($this->name);
    }

    public function update() {
        dd($this->selectedBrand);
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
        $this->brand = Brand::findOrFail($this->brand_id);
        $this->showModal('edit');
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';
        $products = Product::with(['category', 'brand'])->where('name', 'like', '%'.$this->search.'%')
                        ->orderBy($this->sortField, $sortDirection)
                        ->paginate(10);

        $brands = DB::table('brands')
        ->select('id', 'name')
        ->get();

        return view('livewire.warehouse.product.show-products', compact('products', 'brands'));
    }
}
