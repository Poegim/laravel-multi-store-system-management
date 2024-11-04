<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Models\Warehouse\Product;
use App\Models\Warehouse\Category;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('warehouse.category.index');
    }

    public function show(Category $category) 
    {
        $products = Product::where('category_id', $category->id)->paginate(10);
        return view('warehouse.category.show', compact('category', 'products'));
    }
}
