<?php

namespace App\Models\Commerce;

use App\Models\Warehouse\StockItem;
use App\Traits\BelongsToStore;
use App\Traits\BelongsToUser;
use App\Traits\FormatsAmount;
use App\Traits\GetsFormattedAmount;
use App\Traits\HasFormattedSRP;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    use BelongsToUser;
    use BelongsToStore;
    use GetsFormattedAmount;
    use HasFormattedSRP;

    public const PENDING = 0;
    public const COMPLETED = 1;
    public const CANCELLED = 2;

    protected $fillable = [
        'store_id',
        'user_id',
        'status',
    ];

    public function stockItems()
    {
        return $this->belongsToMany(StockItem::class)
                    ->withPivot(['price'])
                    ->withTimestamps();
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::COMPLETED);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::PENDING);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', self::CANCELLED);
    }

    public function isCompleted(): bool
    {
        return $this->status === self::COMPLETED;
    }

    public function isPending(): bool
    {
        return $this->status === self::PENDING;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::CANCELLED;
    }

    public function status(): string
    {
        return match ($this->status) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            default => 'Unknown',
        };
    }

    public function formattedPurchasePriceNet(): string
    {
        return $this->getFormattedAmount($this->purchase_price_net);
    }

    public function formattedPurchasePriceGross(): string
    {
        return $this->getFormattedAmount($this->purchase_price_gross);
    }



}
