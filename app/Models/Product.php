<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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

    /**
     * Get the resolved public URL for the product main image.
     * If the recorded image file is missing from disk, it intelligently searches for
     * matching fallback images in public/uploads/products/ by product name keyword.
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image && file_exists(public_path($this->image)) && is_file(public_path($this->image))) {
            return asset($this->image);
        }

        $fallbackPath = $this->findFallbackImage();
        if ($fallbackPath) {
            return asset($fallbackPath);
        }

        return null;
    }

    /**
     * Fallback finder for products when database file paths don't match disk files.
     */
    protected function findFallbackImage(): ?string
    {
        $name = strtolower($this->name ?? '');

        $patterns = [
            'bhanex' => 'uploads/products/7d24ac69-5e05-4c9e-911f-75a9cc8e2214_dreamina-2026-09-06-2975-professional-e-commerce-product-photo-of.jpeg',
            'bioactin' => 'uploads/products/74d99aa2-b416-4246-9be9-b301574ac9e3_d7ab6bb5b0adadaa9eace3493acf016e.jpg',
            'atago' => 'uploads/products/5e7a4fdd-d6b5-41d9-ac33-ab39023d9e60_dreamina-2026-09-06-5182-professional-e-commerce-product-photo-of.jpeg',
            'refractometer' => 'uploads/products/5e7a4fdd-d6b5-41d9-ac33-ab39023d9e60_dreamina-2026-09-06-5182-professional-e-commerce-product-photo-of.jpeg',
            'biologix' => 'uploads/products/f9c29432-0340-4838-807d-370f37ef112b_dreamina-2026-09-10-3153-professional-commercial-e-commerce-produ.jpeg',
            'centrifuge' => 'uploads/products/16aa4a2a-b10f-4df8-8878-a5deec0d5dd0_dreamina-2026-09-06-3615-professional-e-commerce-product-photo-of.jpeg',
            'beaker' => 'uploads/products/7961be09-3dd1-4d1d-aa55-d3c071ace594_dreamina-2026-09-06-2994-professional-e-commerce-product-photo-of.jpeg',
            'iwaki' => 'uploads/products/7961be09-3dd1-4d1d-aa55-d3c071ace594_dreamina-2026-09-06-2994-professional-e-commerce-product-photo-of.jpeg',
            'methylne' => 'uploads/products/c2eb43b4-ee44-4c22-9da1-3757600a1858_dreamina-2026-09-10-8566-professional-commercial-e-commerce-produ.jpeg',
            'methylene' => 'uploads/products/c2eb43b4-ee44-4c22-9da1-3757600a1858_dreamina-2026-09-10-8566-professional-commercial-e-commerce-produ.jpeg',
            'onemed' => 'uploads/products/9b93b615-bdf5-4650-82ba-f7148317406c_dreamina-2026-09-06-3221-professional-e-commerce-product-photo-of.jpeg',
            'transfer pipette' => 'uploads/products/9b93b615-bdf5-4650-82ba-f7148317406c_dreamina-2026-09-06-3221-professional-e-commerce-product-photo-of.jpeg',
            'potassium' => 'uploads/products/35cef06f-ba1b-4ce9-8917-dc5705ccc761_0f5ec90d-0882-4572-ac05-3b076899c7c8.jpg',
        ];

        foreach ($patterns as $keyword => $relativePath) {
            if (str_contains($name, $keyword) && file_exists(public_path($relativePath))) {
                return $relativePath;
            }
        }

        return null;
    }

    /**
     * Retrieve all valid, existing gallery images for the product.
     *
     * @return Collection<int, string>
     */
    public function getValidGalleryImages(): Collection
    {
        $images = collect();

        if ($this->image_url) {
            $images->push($this->image_url);
        }

        foreach ($this->images as $galleryImg) {
            if ($galleryImg->path && file_exists(public_path($galleryImg->path)) && is_file(public_path($galleryImg->path))) {
                $images->push(asset($galleryImg->path));
            }
        }

        return $images->unique()->values();
    }
}
