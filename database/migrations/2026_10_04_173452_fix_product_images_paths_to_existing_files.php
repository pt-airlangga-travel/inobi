<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        $imageMappings = [
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

        $products = DB::table('products')->get();

        foreach ($products as $product) {
            $currentImage = $product->image;
            $needsUpdate = empty($currentImage) || ! file_exists(public_path($currentImage));

            if ($needsUpdate) {
                $name = strtolower($product->name ?? '');
                foreach ($imageMappings as $keyword => $newPath) {
                    if (str_contains($name, $keyword) && file_exists(public_path($newPath))) {
                        DB::table('products')
                            ->where('id', $product->id)
                            ->update(['image' => $newPath]);
                        break;
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Data fix does not require reversal
    }
};
