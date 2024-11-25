<?php

namespace App\Models\Commerce;

use App\Models\Contact;
use App\Traits\BelongsToStore;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExternalInvoice extends Model
{
    use HasFactory;
    use BelongsToUser;
    use BelongsToStore;

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


}
