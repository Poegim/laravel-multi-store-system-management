<?php

namespace App\Models\Documents;

use App\Traits\BelongsToStore;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
