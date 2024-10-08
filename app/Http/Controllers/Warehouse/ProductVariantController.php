<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
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
        return view('warehouse.product_variant.create');
    }

    public function store(Request $request)
    {
        dd($request);
    }

}
