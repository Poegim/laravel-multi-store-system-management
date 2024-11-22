<?php

namespace App\Http\Controllers\Commerce;

use App\Models\Store;
use App\Models\Contact;
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
        $companies = Contact::select('id', 'name', 'identification_number')->companies()->get();
        return view('commerce.external-invoice.create', compact('store', 'companies'));
    }
}
