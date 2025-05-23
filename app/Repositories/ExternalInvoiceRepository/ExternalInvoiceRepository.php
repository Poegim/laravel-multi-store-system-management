<?php

namespace App\Repositories\ExternalInvoiceRepository ;

use Illuminate\Support\Carbon;
use App\Models\Commerce\ExternalInvoice;
use Illuminate\Support\Facades\DB;

class ExternalInvoiceRepository implements ExternalInvoiceRepositoryInterface
{
    public function store(array $data) {
        $externalInvoice = new ExternalInvoice();
        $externalInvoice = $this->associate($externalInvoice, $data);
        $externalInvoice->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $externalInvoice->save();
        return $externalInvoice->id;
    }
    
    public function update(array $data, ExternalInvoice $externalInvoice) {
        $externalInvoice = $this->associate($externalInvoice, $data);
        $externalInvoice->is_temp = $data['is_temp'];
        $externalInvoice->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        return $externalInvoice->save();
    }

    public function confirm(ExternalInvoice $externalInvoice) {
        $externalInvoice->is_temp = false;
        $this->moveTemporaryItemsToStock($externalInvoice);
        return $externalInvoice->save();
    }

    public function destroy(int $id) {
        $externalInvoice = ExternalInvoice::findOrFail($id);
        if($externalInvoice->is_temp) {
            return $externalInvoice->delete();
        } else {
            abort(403, 'You cannot delete this invoice');
        }
    }

    private function moveTemporaryItemsToStock(ExternalInvoice $externalInvoice)
    {
        $storeId = $externalInvoice->store_id;
        $batchData = [];
        foreach ($externalInvoice->temporaryExternalInvoiceItems as $item) {
            $batchData[] = [
                'product_variant_id' => $item->product_variant_id,
                'external_invoice_id' => $externalInvoice->id,
                'suggested_retail_price' => $item->suggested_retail_price,
                'purchase_price_net' => $item->purchase_price_net,
                'purchase_price_gross' => $item->purchase_price_gross,
                'color_id' => $item->color_id,
                'vat_rate_id' => $item->vat_rate_id,
                'brand_id' => $item->brand_id,
                'store_id' => $storeId,
            ];
        }

        // Insert the batch data into the stock_items table
        DB::table('stock_items')->insert($batchData);

        // Delete the temporary items
        foreach ($externalInvoice->temporaryExternalInvoiceItems as $item) {
            $item->delete();
        }

        dd($externalInvoice->temporaryExternalInvoiceItems);
    }

    private function associate(ExternalInvoice $externalInvoice, array $data)
    {
        $externalInvoice->invoice_number = $data['invoice_number'];
        $externalInvoice->store_id = $data['store_id'];
        $externalInvoice->user_id = auth()->user()->id;
        $externalInvoice->contact_id = $data['contact_id'];
        $externalInvoice->is_temp = $data['is_temp'];
        return $externalInvoice;
    }
}
