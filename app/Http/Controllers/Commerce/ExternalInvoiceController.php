<?php

namespace App\Http\Controllers\Commerce;

use Exception;
use App\Models\Store;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Warehouse\Brand;
use App\Models\Warehouse\Product;
use App\Http\Controllers\Controller;
use App\Models\Commerce\ExternalInvoice;
use App\Services\ExternalInvoiceService;
use App\Http\Requests\StoreExternalInvoiceRequest;

class ExternalInvoiceController extends Controller
{

    public function __construct(
        protected ExternalInvoiceService $externalInvoiceService
        ) {}


    public function index(?Store $store = null)
    {
        $contacts = Contact::companies()->pluck('id');
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

    public function store(StoreExternalInvoiceRequest $request)
    {
        try {
            $externalInvoiceId = $this->externalInvoiceService->store($request->validated());
        } catch (Exception $e) {
            session()->flash('flash.banner', 'Error: ' . $e->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
        
            return redirect()->route('external-invoice.index');
        }
        
        return redirect()->route('external-invoice.edit', $externalInvoiceId);

    }

    public function edit(int $id) {
        $externalInvoice = ExternalInvoice::findOrfail($id);
        // $companies = Contact::select('id', 'name', 'identification_number')->get();
        // $brands = Brand::select('id', 'name')->get();
        // $products = Product::select('id', 'name')->get();
        return view('commerce.external-invoice.edit', compact([
            'externalInvoice'
        ]));
    }

    public function show(int $id) {
        $externalInvoice = ExternalInvoice::with('contact', 'stockItems', 'store')->findOrfail($id);
        return view('commerce.external-invoice.show', compact('externalInvoice'));
    }


}
