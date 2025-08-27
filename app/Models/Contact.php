<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce\ExternalInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use BelongsToUser;
    use HasFactory;

    public const PERSON = 1;
    public const COMPANY = 2;

    protected $fillable = [
        'name',
        'indentification_number',
        'type',
        'country',
        'city',
        'postcode',
        'street',
        'building_number',
        'apartment_number',
        'email',
        'phone',
        'second_phone',
        'www',
        'description',
        'user_id'
    ];

    public function externalInvoices()
    {
        return $this->hasMany(ExternalInvoice::class);
    }

    public function scopeCompanies($query)
    {
        return $query->where('type', self::COMPANY);
    }

    public function scopePeople($query)
    {
        return $query->where('type', self::PERSON);
    }

    public function isPerson() {
        return $this->type === self::PERSON;
    }

    public function isCompany() {
        return $this->type === self::COMPANY;
    }

    public function type(): string {
        return $this->type === self::PERSON ? 'Person' : 'Company';
    }

}
