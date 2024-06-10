<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

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
        'color',
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
}
