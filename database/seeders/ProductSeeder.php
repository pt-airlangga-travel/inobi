<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = [
            'Bioproduk',
            'Alat Lab',
            'Consumable',
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                [
                    'name' => $categoryName,
                ],
                [
                    'slug' => Str::slug($categoryName),
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $products = [
            [
                'name' => 'BHANEX — Bovine Hydroxyapatite',
                'slug' => 'bhanex',
                'category' => 'Bioproduk',
                'short_description' => 'Serbuk hasil olahan tulang sapi secara steril, digunakan untuk membantu pemulihan patah tulang dan kerusakan jaringan tulang gigi.',
                'description' => 'Lengkapi deskripsi lengkap produk di sini: komposisi, indikasi penggunaan, cara penyimpanan, izin edar (kalau ada).',
                'image' => null,
                'is_featured' => true,
            ],

            [
                'name' => 'Bioactin',
                'slug' => 'bioactin',
                'category' => 'Bioproduk',
                'short_description' => 'Produk bioaktif pendukung untuk kebutuhan riset dan aplikasi klinis — detail formula tersedia melalui datasheet produk.',
                'description' => 'Lengkapi deskripsi lengkap produk Bioactin di sini.',
                'image' => null,
                'is_featured' => false,
            ],

            [
                'name' => 'Pocket Refraktometer',
                'slug' => 'pocket-refraktometer',
                'category' => 'Alat Lab',
                'short_description' => 'Alat ukur indeks bias portabel untuk kebutuhan pengujian cepat di lapangan maupun laboratorium.',
                'description' => 'Kalibrasi ATC · Portabel. Lengkapi detail spesifikasi produk di sini.',
                'image' => null,
                'is_featured' => false,
            ],

            [
                'name' => 'Pipet Transfer & Pipet Tips',
                'slug' => 'pipet-transfer',
                'category' => 'Consumable',
                'short_description' => 'Kebutuhan harian ruang lab untuk transfer sampel cairan secara presisi dan bebas kontaminasi silang.',
                'description' => 'Tersedia berbagai ukuran. Lengkapi detail spesifikasi produk di sini.',
                'image' => null,
                'is_featured' => false,
            ],

            [
                'name' => 'Centrifuge Tubes & Vacutainer Needle',
                'slug' => 'centrifuge-tubes',
                'category' => 'Consumable',
                'short_description' => 'Perlengkapan pengambilan dan pemrosesan sampel darah/cairan untuk laboratorium klinis dan riset.',
                'description' => 'Standar medis · Sekali pakai. Lengkapi detail spesifikasi produk di sini.',
                'image' => null,
                'is_featured' => false,
            ],

            [
                'name' => 'Beaker Glass',
                'slug' => 'beaker-glass',
                'category' => 'Alat Lab',
                'short_description' => 'Peralatan gelas laboratorium dasar dengan berbagai kapasitas untuk kebutuhan pengukuran dan pencampuran.',
                'description' => 'Kapasitas 50ml–1000ml. Lengkapi detail spesifikasi produk di sini.',
                'image' => null,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {

            $category = Category::where(
                'name',
                $product['category']
            )->firstOrFail();

            Product::updateOrCreate(
                [
                    'slug' => $product['slug'],
                ],
                [
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'short_description' => $product['short_description'],
                    'description' => $product['description'],
                    'image' => $product['image'],
                    'is_featured' => $product['is_featured'],
                ]
            );
        }
    }
}
