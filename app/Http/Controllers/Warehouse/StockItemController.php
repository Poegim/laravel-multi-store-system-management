<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockItemController extends Controller
{

    public function index(?Store $store = null): \Illuminate\View\View
    {
        return view('warehouse.stock_items.index', compact('store'));
    }
    
    public function show($id)
    {
        //
    }
}
