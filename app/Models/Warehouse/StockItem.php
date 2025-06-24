<?php

namespace App\Models\Warehouse;

use App\Models\Store;
use App\Models\VatRate;
use Illuminate\Support\Carbon;
use App\Traits\HasFormattedSRP;
use App\Traits\GetsFormattedAmount;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce\ExternalInvoice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockItem extends Model
{
    use HasFactory;
    use HasFormattedSRP;
    use GetsFormattedAmount;

    public const AVAILABLE = 0;
    public const SOLD = 1;
    public const MISSING = 2;
    public const IN_TRANSFER = 3;
    public const IN_REPAIR = 4;


    public function formattedPurchasePriceNet()
    {
        return $this->getFormattedAmount($this->purchase_price_net);
    }

    public function formattedSuggestedRetailPrice()
    {
        return $this->getFormattedAmount($this->suggested_retail_price);
    }

    public function externalInvoice()
    {
        return $this->belongsTo(ExternalInvoice::class, 'external_invoice_id');
    }

    public function formattedPurchasePriceGross()
    {
        return $this->getFormattedAmount($this->purchase_price_gross);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function vatRate(): BelongsTo
    {
        return $this->belongsTo(VatRate::class);
    }

    public function DSI()
    {
        return (int) $this->updated_at->diffInDays(now());
    }

    public function status() 
    {
        return match ($this->status) {
            self::AVAILABLE => 'Available',
            self::SOLD => 'Sold',
            self::MISSING => 'Missing',
            self::IN_TRANSFER => 'In Transfer',
            self::IN_REPAIR => 'In Repair',
            default => 'Unknown Status',
        };
    }
}
