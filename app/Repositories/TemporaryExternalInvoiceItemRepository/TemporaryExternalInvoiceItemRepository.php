<?php

namespace App\Repositories\TemporaryExternalInvoiceItemRepository;

use App\Models\Warehouse\TemporaryExternalInvoiceItem;
use Illuminate\Support\Carbon;
use App\Repositories\TemporaryExternalInvoiceItemRepository\TemporaryExternalInvoiceItemRepositoryInterface;

class  TemporaryExternalInvoiceItemRepository implements TemporaryExternalInvoiceItemRepositoryInterface
{
    
    public function store(array $data)
    {
        $asdf = new TemporaryExternalInvoiceItem();
        // $asdf = $this->associate($asdf, $data);
        $asdf->created_at = Carbon::now()->format('Y-m-d H:i:s');
        dd($asdf);
        // return $temporaryExternalInvoiceItem->save();
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