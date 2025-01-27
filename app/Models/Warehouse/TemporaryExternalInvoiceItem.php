<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryExternalInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
    ];

}
