<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Commerce\ExternalInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function color() : BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function storeBgColor(): String
    {
        if($this->color) {

            return 'bg-'.$this->color->name;
        } else {
            return '';
        }
    }

    public function fillColor(): String
    {
        return 'fill-'.$this->color->name;
    }

    public function bgFillColor(): string
    {
        $parts = explode('-', $this->color->name);
        if(count($parts) != 2) {
            return 'bg-white';
        } else {
            if(intval($parts[1]) > 500) {
                return 'bg-white';
            } else {
                return 'bg-slate-900';
            }
        }
    }

    public function externalInvoices(): HasMany
    {
        return $this->hasMany(ExternalInvoice::class, 'store_id');
    }
}
