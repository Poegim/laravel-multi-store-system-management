<?php

namespace App\Models\Commerce;

use App\Models\Contact;
use App\Traits\BelongsToUser;
use App\Traits\FormatsAmount;
use App\Traits\BelongsToStore;
use App\Traits\HasFormattedSRP;
use App\Models\Warehouse\StockItem;
use App\Traits\GetsFormattedAmount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public const RECEIPT = 0;
    public const RECEIPT_NIP = 1;
    public const INVOICE = 2;

    public const PAYMENT_CASH = 0;
    public const PAYMENT_CARD = 1;
    public const PAYMENT_TRANSFER = 2;


    protected $fillable = [
        'store_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'sold_at' => 'datetime',
    ];

    public function documentType(): string {
        return match ($this->document_type) {
            self::RECEIPT => 'receipt',
            self::RECEIPT_NIP => 'receipt_nip',
            self::INVOICE => 'invoice',
        };
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function stockItems()
    {
        return $this->belongsToMany(StockItem::class)
                    ->withPivot(['price', 'sold_at', 'vat_rate'])
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

    public function totalPrice(): string
    {
        return $this->getFormattedAmount($this->stockItems->sum(function ($item) {
            return $item->pivot->price;
        }));
    }

    public function totalPriceNet(): string
    {
        return $this->getFormattedAmount($this->stockItems->sum(function ($item) {
            return $item->pivot->price / $item->pivot->vat_rate;
        }));
    }

    public function paymantMethod(): string
    {
        return match ($this->payment_method) {
            0 => 'Cash',
            1 => 'Card',
            2 => 'Transfer',
            default => 'Unknown',
        };
    }

    // public function formattedPurchasePriceNet(): string
    // {
    //     return $this->getFormattedAmount($this->purchase_price_net);
    // }

    // public function formattedPurchasePriceGross(): string
    // {
    //     return $this->getFormattedAmount($this->purchase_price_gross);
    // }



}
