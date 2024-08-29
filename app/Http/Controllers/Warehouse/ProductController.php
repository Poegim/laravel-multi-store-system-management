<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\Warehouse\Brand;
use App\Services\ProductService;
use App\Models\Warehouse\Product;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\RendersCategoryOptions;

class ProductController extends Controller
{

    use RendersCategoryOptions;

    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService
        ) {}

    public function index(): View
    {
        return view('warehouse.product.index', [
            'products' => Product::paginate(10),
        ]);
    }

    public function create()
    {
        return view('warehouse.product.create', [
            'categoryOptions' => $this->renderCategoryOptions($this->categoryService->activeTree()),
            'brands' => Brand::select('id', 'name')->get(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->store($request->validated());
        session()->flash('flash.banner', __('Successfully created!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('product.index');
    }

    public function edit(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('warehouse.product.edit', [
            'categoryOptions' => $this->renderCategoryOptions($this->categoryService->activeTree(), $product->category_id),
            'brands' => Brand::select('id', 'name')->get(),
            'product' => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $this->productService->update($request->validated(), $product);
        session()->flash('flash.banner', __('Successfully created!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('product.index');
    }


}
