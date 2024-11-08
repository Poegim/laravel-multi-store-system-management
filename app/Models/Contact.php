<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public const PERSON = 1;
    public const COMPANY = 2;

    protected $fillable = [
        'name',
        'second_name',
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
    ];

    public function isPerson() {
        return $this->type === self::PERSON;
    }

    public function isCompany() {
        return $this->type === self::COMPANY;
    }

}
