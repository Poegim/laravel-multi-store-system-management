<?php

namespace App\Repositories\TemporaryExternalInvoiceItemRepository;

use App\Models\VatRate;
use App\Models\Warehouse\TemporaryExternalInvoiceItem;
use Illuminate\Support\Carbon;
use App\Repositories\TemporaryExternalInvoiceItemRepository\TemporaryExternalInvoiceItemRepositoryInterface;
use App\Traits\FormatsAmount;
use App\Traits\NetToGrossConverts;

class  TemporaryExternalInvoiceItemRepository implements TemporaryExternalInvoiceItemRepositoryInterface
{

    use FormatsAmount;
    use NetToGrossConverts;
    
    public function store(array $data)
    {
        $temporaryExternalInvoiceItem = new TemporaryExternalInvoiceItem;
        $temporaryExternalInvoiceItem = $this->associate($temporaryExternalInvoiceItem, $data);
        $temporaryExternalInvoiceItem->created_at = Carbon::now()->format('Y-m-d H:i:s');
        return $temporaryExternalInvoiceItem->save();
    }
    
    public function update(array $data, int $id)
    {
        //
    }

    private function associate($temporaryExternalInvoiceItem, $data) 
    {
        $temporaryExternalInvoiceItem->product_variant_id = $data['productVariant'];
        $temporaryExternalInvoiceItem->external_invoice_id = $data['externalInvoiceId'];
        $temporaryExternalInvoiceItem->device_id = $data['selectedDevice'];
        $temporaryExternalInvoiceItem->color_id = $data['selectedColor'];
        $temporaryExternalInvoiceItem->brand_id = $data['brand'];
        $temporaryExternalInvoiceItem->vat_rate_id = $data['vatRateId'];
        $temporaryExternalInvoiceItem->imei_number = $data['imei_number'] !== '' ? $data['imei_number'] : null;
        $temporaryExternalInvoiceItem->serial_number = $data['serial_number'] !== '' ? $data['serial_number'] : null;        
        $temporaryExternalInvoiceItem->suggested_retail_price = $this->decimalToInteger(round((float) $data['srp'], 2));
        $temporaryExternalInvoiceItem->purchase_price_net = $this->decimalToInteger(round((float) $data['purchase_price_net'], 2));
        $temporaryExternalInvoiceItem->purchase_price_gross = $data['purchase_price_gross'];
        $temporaryExternalInvoiceItem->color_id = $data['selectedColor'];

        return $temporaryExternalInvoiceItem;
    }

}