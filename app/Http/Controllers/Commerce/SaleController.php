<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index($store = null)
    {
        return 'index';
    }

    public function create(Store $store)
    {   
        return view('commerce.sale.create', compact('store'));
    }
}
