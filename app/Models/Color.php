<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use App\Traits\HasUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    use BelongsToUser;
    use HasUpdatedBy;

    protected $fillable = [
        'name',
        'value',
        'user_id',
        'updated_by',
    ];
}
