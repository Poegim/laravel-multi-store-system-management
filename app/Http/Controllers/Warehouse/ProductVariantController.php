<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use App\Http\Controllers\Controller;
use App\Services\ProductVariantService;
use App\Models\Warehouse\ProductVariant;
use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;

class ProductVariantController extends Controller
{
    private $products;
    private $devices;
    private $features;

    public function __construct(
        protected ProductVariantService $productVariantService,
    ) {         
        $this->products = Product::select('id', 'name')->where('is_device', false)->get();
        $this->devices = Product::devices()->get();
        $this->features = Feature::select(['id', 'name'])->orderBy('name', 'asc')->get();
    }

    public function index()
    {
        return view('warehouse.product_variant.index');
    }

    public function show(int $id)
    {
        $productVariant = ProductVariant::where('id', $id)->with('stockItems')->first();
        return view('warehouse.product_variant.show', [
            'productVariant' => $productVariant,
        ]);
    }

    public function create()
    {
        return view('warehouse.product_variant.create', [
            'products' => $this->products,
            'devices' => $this->devices,
            'features' => $this->features,
        ]);
    }

    public function store(StoreProductVariantRequest $request)
    {
        $this->productVariantService->store($request->validated());
        session()->flash('flash.banner', __('Successfully created!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('product-variant.index');
    }

    public function edit(int $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        return view('warehouse.product_variant.edit', [
            'productVariant' => $productVariant,
            'products' => $this->products,
            'devices' => $this->devices,
            'features' => $this->features,
        ]);
    }

    public function update(ProductVariant $productVariant, UpdateProductVariantRequest $request)
    {   
        $this->productVariantService->update($request->validated(), $productVariant);
        session()->flash('flash.banner', __('Successfully updated! ' . $productVariant->id . ' ' . $productVariant->product->name . ' ' . $productVariant->name));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('product-variant.index');
    }

}
