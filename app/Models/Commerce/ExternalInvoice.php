<?php

namespace App\Models\Commerce;

use App\Models\Contact;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToStore;
use App\Models\Warehouse\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Warehouse\TemporaryExternalInvoiceItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExternalInvoice extends Model
{
    use HasFactory;
    use BelongsToUser;
    use BelongsToStore;    

    public const TEMPORARY = 1;

    protected $fillable = [
        'name',
        'store_id',
        'user_id',
        'company_id',
        'net_price',
        'is_temp',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function temporaryExternalInvoiceItems()
    {
        return $this->hasMany(TemporaryExternalInvoiceItem::class, 'external_invoice_id');
    }

    public function stockItems(): HasMany
    {
        return $this->hasMany(StockItem::class, 'external_invoice_id');
    }

    public function isTemp()
    {
        return $this->is_temp === self::TEMPORARY;
    }

    public function status() {
        return $this->isTemp() ? 'pending' : 'added';
    }


}
