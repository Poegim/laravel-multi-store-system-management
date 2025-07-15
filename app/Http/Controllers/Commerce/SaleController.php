<?php

namespace App\Http\Controllers\Commerce;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Commerce\Sale;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index($store = null)
    {
        return 'index';
    }

    public function create(Store $store)
    {
        $sale = Sale::firstOrCreate([
            'store_id' => $store->id,
            'user_id' => auth()->id(),
            'status' => Sale::PENDING,
        ], [
            'store_id' => $store->id,
            'user_id' => auth()->id(),
            'status' => Sale::PENDING,
        ]);

        return view('commerce.sale.create', compact('store', 'sale'));
    }
    
    
}
