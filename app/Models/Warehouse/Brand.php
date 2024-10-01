<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function stockItems(): HasMany
    {
        return $this->hasMany(StockItem::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
