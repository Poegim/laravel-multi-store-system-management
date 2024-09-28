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
            'products' => Product::all('id', 'name'),
            'devices' => Product::devices()->get(),
            'features' => Feature::select(['id', 'name'])->orderBy('name', 'asc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        return $request;
    }

}
