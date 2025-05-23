<?php

namespace App\Models\Warehouse;

use App\Models\Color;
use App\Models\VatRate;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce\ExternalInvoice;
use App\Traits\BelongsToDevice;
use App\Traits\BelongsToStore;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemporaryExternalInvoiceItem extends Model
{
        protected $fillable = [
        'created_at',
    ];


    use HasFactory;
    use BelongsToDevice;

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function externalInvoice()
    {
        return $this->belongsTo(ExternalInvoice::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function vatRate()
    {
        return $this->belongsTo(VatRate::class);
    }



}
