<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
        ) {}

    public function index(): View
    {
        return view('warehouse.product.index', [
            'products' => Product::paginate(10),
        ]);
    }
}
