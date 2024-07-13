<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Brand;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class BrandController extends Controller
{
    public function index(): View
    {
        return view('warehouse.brand.index');
    }
}
