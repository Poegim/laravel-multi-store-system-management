<?php

namespace App\Repositories\TemporaryExternalInvoiceItemRepository;

use Illuminate\Support\Carbon;
use App\Repositories\TemporaryExternalInvoiceItemRepository\TemporaryExternalInvoiceItemRepositoryInterface;

class  TemporaryExternalInvoiceItemRepository implements TemporaryExternalInvoiceItemRepositoryInterface
{
    
    public function store(array $data)
    {
        // $store = new Store;
        // $store = $this->associate($store, $data);
        // $store->created_at = Carbon::now()->format('Y-m-d H:i:s');
        // return $store->save();
    }
    
    public function update(array $data, int $id)
    {
        // $store = Store::findOrFail($id);
        // $store = $this->associate($store, $data);
        // $store->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        // return $store->save();
    }

    private function associate($data) 
    {
        // $store->name = $data['name'];
        // $store->email = $data['email'];
        // $store->order = $data['order'];
        // $store->phone = $data['phone'];
        // return $store;
    }

}