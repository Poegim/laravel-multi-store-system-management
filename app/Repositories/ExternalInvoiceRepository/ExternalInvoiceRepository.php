<?php

namespace App\Repositories\ExternalInvoiceRepository ;

use Illuminate\Support\Carbon;
use App\Models\Commerce\ExternalInvoice;


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

    public function destroy(int $id) {
        $externalInvoice = ExternalInvoice::findOrFail($id);
        if($externalInvoice->is_temp) {
            return $externalInvoice->delete();
        } else {
            abort(403, 'You cannot delete this invoice');
        }
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
