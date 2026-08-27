<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_en',
        'name_ar',
        'slug',
        'description_en',
        'description_ar',
        'price',
        'compare_price',
        'stock',
        'sku',
        'image',
        'additional_images',
        'is_featured',
        'is_new',
        'rating',
        'sales_count'
    ];

    protected $casts = [
        'additional_images' => 'array',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->compare_price && $this->compare_price > $this->price) {
            return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
        return 0;
    }
}
