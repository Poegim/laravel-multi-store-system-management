<?php

namespace App\Http\Controllers\Commerce;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documents\ExternalInvoice;

class ExternalInvoiceController extends Controller
{
    public function index(Store $store = null)
    {
        if ($store) {
            $externalInvoices = ExternalInvoice::where('store_id', $store->id)->get();
        } else {
            $externalInvoices = ExternalInvoice::all();
        }

        return view('commerce.external-invoice.index', compact('store', 'externalInvoices'));
    }

    public function create(Store $store)
    {
        return view('commerce.external-invoice.create', compact('store'));
    }
}
