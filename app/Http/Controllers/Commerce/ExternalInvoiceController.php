<?php

namespace App\Http\Controllers\Commerce;

use App\Models\Store;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExternalInvoiceRequest;
use App\Models\Commerce\ExternalInvoice;
use App\Services\ExternalInvoiceService;

class ExternalInvoiceController extends Controller
{

    public function __construct(
        protected ExternalInvoiceService $externalInvoiceService
        ) {}


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

    public function store(StoreExternalInvoiceRequest $request)
    {
        if($this->externalInvoiceService->store($request->validated())) {            
            session()->flash('flash.banner', __('External invoice has been successfully saved!'));
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('external-invoice.index', $request->store_id);
        } else {
            session()->flash('flash.banner', __('Error saving external invoice!'));
            session()->flash('flash.bannerStyle', 'warning');
            return redirect()->route('external-invoice.index', $request->store_id);
        }

    }


}
