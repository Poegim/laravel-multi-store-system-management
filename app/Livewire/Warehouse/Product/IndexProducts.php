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
use App\Traits\RendersCategoryOptions;
use Laravel\Jetstream\InteractsWithBanner;

class IndexProducts extends Component
{
    use Sortable;
    use Searchable;
    use WithPagination;

    protected $listeners = ['reloadProductsIndex'];

    /**
     * Optional params
     */
    public $category_filter;

    public function reloadProductsIndex()
    {
        $this->resetPage();
    }

    public function mount($category = null) {
        $this->category_filter = $category;
        // $this->categories = $this->categoryService->allTree();
    }

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $productsQuery = Product::with(['category'])
        ->where('products.name', 'like', '%' . $this->search . '%') // Explicitly specify that we're referring to products.name
        ->withCount('productVariants'); // Add the alias 'product_variants_count'

        $count = 0;
        //If there is passed category filter id to component
        if($this->category_filter) {
            $productsQuery = $productsQuery->where('category_id', $this->category_filter->id);
            $count = $this->category_filter->products->count();
        }


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

        $products = $productsQuery->paginate(10, ['*'], 'page_products');

        return view('livewire.warehouse.product.index-products', compact('products', 'count'));
    }
}
