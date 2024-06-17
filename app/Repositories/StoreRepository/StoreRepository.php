<?php

namespace App\Repositories\StoreRepository;

use App\Models\Store;
use App\Repositories\StoreRepository\StoreRepositoryInterface;

class  StoreRepository implements StoreRepositoryInterface
{
    
    public function store(array $data): bool
    {
        $store = new Store;
        $store = $this->associate($store, $data);
        return $store->save();
    }

    public function update(array $data, int $id): bool
    {
        $store = Store::findOrFail($id);
        $store = $this->associate($store, $data);
        return $store->save();
    }

    private function associate(Store $store, $data): Store 
    {
        $store->name = $data['name'];
        $store->email = $data['email'];
        $store->order = $data['order'];
        $store->phone = $data['phone'];
        $store->city = $data['city'];
        $store->postcode = $data['postcode'];
        $store->street = $data['street'];
        $store->building_number = $data['building_number'];
        $store->apartment_number = $data['apartment_number'];
        $store->color = $data['color'];
        $store->contracts_prefix = $data['contracts_prefix'];
        $store->invoices_prefix = $data['invoices_prefix'];
        $store->margin_invoices_prefix = $data['margin_invoices_prefix'];
        $store->proforma_invoices_prefix = $data['proforma_invoices_prefix'];
        $store->internal_servicing_prefix = $data['internal_servicing_prefix'];
        $store->external_servicing_prefix = $data['external_servicing_prefix'];
        $store->next_receipt_number = $data['next_receipt_number'];
        $store->next_invoice_number = $data['next_invoice_number'];
        $store->next_margin_invoice_number = $data['next_margin_invoice_number'];
        $store->next_proforma_invoice_number = $data['next_proforma_invoice_number'];
        $store->next_internal_servicing_number = $data['next_internal_servicing_number'];
        $store->next_external_servicing_number = $data['next_external_servicing_number'];
        $store->description === NULL ? $store->description = '' : $store->description = $data['description'];

        return $store;
    }

}