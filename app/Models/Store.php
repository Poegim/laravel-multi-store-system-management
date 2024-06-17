<?php

namespace App\Models;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'order',
        'email',
        'phone',
        'city',
        'postcode',
        'street',
        'building_numer',
        'apartment number',
        'color_id',
        'contracts_prefix',
        'invoices_prefix',
        'margin_invoices_prefix',
        'proforma_invoices_prefix',
        'internal_servicing_prefix',
        'external_servicing_prefix',
        'next_receipt_number',
        'next_invoice_number',
        'next_margin_invoice_number',
        'next_proforma_invoice_number',
        'next_internal_servicing_number',
        'next_external_servicing_number',
        'description'
    ];

    public function color() : HasOne
    {
        return $this->hasOne(Color::class);
    }
}
