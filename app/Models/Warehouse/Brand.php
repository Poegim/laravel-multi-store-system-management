<?php

namespace App\Models\Warehouse;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = ['name', 'slug', 'user_id'];

    public function stockItems(): HasMany
    {
        return $this->hasMany(StockItem::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
