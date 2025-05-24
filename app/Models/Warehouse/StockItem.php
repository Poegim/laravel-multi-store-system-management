<?php

namespace App\Models\Warehouse;

use App\Models\Store;
use App\Traits\GetsFormattedAmount;
use App\Traits\HasFormattedSRP;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
