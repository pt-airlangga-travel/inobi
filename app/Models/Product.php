<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'shopee_url',
        'tokopedia_url',
        'is_featured',
        'is_featured_banner',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_featured_banner' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function hasPublicPrice(): bool
    {
        return $this->price !== null;
    }
}
