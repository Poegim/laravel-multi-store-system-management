<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Warehouse\ProductVariant;

class ProductVariantController extends Controller
{
    public function index()
    {
        return view('warehouse.product_variant.index');
    }

    public function show(string $slug)
    {

        $productVariant = ProductVariant::where('slug', $slug)->with('stockItems')->first();
                
        return view('warehouse.product_variant.show', [
            'productVariant' => $productVariant,
        ]);
    }

    public function create()
    {
        return view('warehouse.product_variant.create', [
            'products' => Product::all('id', 'name'),
            'features' => Feature::all('id', 'name'),
        ]);
    }

}
