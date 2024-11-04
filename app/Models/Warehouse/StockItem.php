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
}
