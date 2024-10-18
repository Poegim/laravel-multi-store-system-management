<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantRequest;
use App\Models\Warehouse\ProductVariant;

class ProductVariantController extends Controller
{
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
        $products = Product::select('id', 'name')->where('is_device', false)->get();
        $devices = Product::devices()->get();
        $features = Feature::select(['id', 'name'])->orderBy('name', 'asc')->get();
        
        return view('warehouse.product_variant.create', [
            'products' => $products,
            'devices' => $devices,
            'features' => $features,
        ]);
    }

    public function store(StoreProductVariantRequest $request)
    {
        //
    }

    public function edit(int $id)
    {
        $products = Product::select('id', 'name')->where('is_device', false)->get();
        $devices = Product::devices()->get();
        $features = Feature::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $productVariant = ProductVariant::findOrFail($id);
        $selectedDeivces = null;

        return view('warehouse.product_variant.edit', [
            'productVariant' => $productVariant,
            'products' => $products,
            'devices' => $devices,
            'features' => $features,
        ]);
    }

}
