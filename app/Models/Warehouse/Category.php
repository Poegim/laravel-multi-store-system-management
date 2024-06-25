<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id'];

    public static function boot()
    {
        parent::boot();

        //Validate is parent_id and slug together unique.
        static::saving(function ($category) {
            $query = static::where('slug', $category->slug)
                           ->where('parent_id', $category->parent_id);

            if ($category->exists) {
                $query->where('id', '!=', $category->id);
            }

            if ($query->exists()) {
                return false;
            }

            return true;
        });

    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}
