<?php

namespace App\Http\Controllers\Commerce;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExternalInvoiceController extends Controller
{
    public function index(Store $store = null)
    {
        return 'index';
    }
}
