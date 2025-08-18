<?php

namespace App\Models\Warehouse;

use App\Models\Store;
use App\Models\VatRate;
use App\Models\Commerce\Sale;
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
    public const IN_PENDING_SALE = 3;
    public const IN_REPAIR = 4;
    public const IN_TRANSFER = 5;

    public function scopeAvailable($query)
    {
        return $query->where('status', self::AVAILABLE);
    }

    public function scopeSold($query)
    {
        return $query->where('status', self::SOLD);
    }

    public function scopeMissing($query)
    {
        return $query->where('status', self::MISSING);
    }


    public function formattedPurchasePriceNet()
    {
        return $this->getFormattedAmount($this->purchase_price_net);
    }

    public function formattedSuggestedRetailPrice()
    {
            if ($this->suggested_retail_price > 0) {
                return $this->getFormattedAmount($this->suggested_retail_price);
            }

            if ($this->productVariant->suggested_retail_price > 0) {
                return $this->getFormattedAmount($this->productVariant->suggested_retail_price);
            }

            if ($this->productVariant->product->suggested_retail_price > 0) {
                return $this->getFormattedAmount($this->productVariant->product->suggested_retail_price);
            }

            return $this->getFormattedAmount($this->suggested_retail_price);
    }

    public function suggestedRetailPrice(): int
    {
        if ($this->suggested_retail_price > 0) {
            return $this->suggested_retail_price;
        }

        if ($this->productVariant->suggested_retail_price > 0) {
            return $this->productVariant->suggested_retail_price;
        }

        if ($this->productVariant->product->suggested_retail_price > 0) {
            return $this->productVariant->product->suggested_retail_price;
        }

        return $this->suggested_retail_price;
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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function vatRate(): BelongsTo
    {
        return $this->belongsTo(VatRate::class);
    }

    /**
     * Days spent in inventory.
     *
     * @return int
     */
    public function DSI() : int
    {
        return (int) $this->updated_at->diffInDays(now());
    }

    public function status() : string
    {
        return match ($this->status) {
            self::AVAILABLE => 'Available',
            self::SOLD => 'Sold',
            self::MISSING => 'Missing',
            self::IN_PENDING_SALE => 'In Pending Sale',
            self::IN_REPAIR => 'In Repair',
            self::IN_TRANSFER => 'In Transfer',
            default => 'Unknown Status',
        };
    }

    public function isAvailable(): bool
    {
        return $this->status === self::AVAILABLE;
    }

    public function isSold(): bool
    {
        return $this->status === self::SOLD;
    }

    public function isMissing(): bool
    {
        return $this->status === self::MISSING;
    }

    public function isInPendingSale(): bool
    {
        return $this->status === self::IN_PENDING_SALE;
    }
    public function isInRepair(): bool
    {
        return $this->status === self::IN_REPAIR;
    }
    public function isInTransfer(): bool
    {
        return $this->status === self::IN_TRANSFER;
    }
    

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

}
