<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_index_page_loads_successfully(): void
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
    }

    public function test_product_image_accessor_falls_back_intelligently_for_missing_file(): void
    {
        $product = Product::create([
            'name' => 'BHANEX - Natural Bovine Hydroxyapatite',
            'image' => 'uploads/products/non-existent-old-file.jpeg',
        ]);

        $this->assertNotNull($product->image_url);
        $this->assertStringContainsString('uploads/products/7d24ac69', $product->image_url);
    }

    public function test_product_gallery_images_only_returns_valid_images(): void
    {
        $product = Product::create([
            'name' => 'BHANEX Test Product',
            'image' => 'uploads/products/non-existent-file.jpeg',
        ]);

        $gallery = $product->getValidGalleryImages();

        $this->assertTrue($gallery->isNotEmpty());
        $this->assertStringContainsString('uploads/products/7d24ac69', $gallery->first());
    }
}
