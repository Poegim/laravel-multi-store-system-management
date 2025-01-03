<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['plural_name', 'singular_name',  'slug', 'disabled' ,'parent_id'];

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
                throw ValidationException::withMessages([
                    'slug' => 'The combination of slug and parent_id must be unique.',
                ]);
            }
        });

    }

    /**
     * Scope a query to only include enabled categories.
     */
    public function scopeEnabled(Builder $query): void
    {
        $query->where('disabled', 0);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
