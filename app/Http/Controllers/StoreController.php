<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StoreController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        return view('management.store.index');
    }

    public function show(Store $store): View 
    {
        return view('management.store.show', compact('store'));
    }

}
