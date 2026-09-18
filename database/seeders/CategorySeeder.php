<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Laboratory Equipments',
                'description' => 'Peralatan dan instrumen laboratorium presisi tinggi untuk kebutuhan penelitian, diagnostik, dan edukasi.',
            ],
            [
                'name' => 'Glassware',
                'description' => 'Peralatan kaca laboratorium berkualitas tinggi tahan panas dan bahan kimia (lab glassware).',
            ],
            [
                'name' => 'Plasticware',
                'description' => 'Peralatan plastik laboratorium steril dan non-steril seperti tabung sentrifus, pipet transfer, dan wadah sampel.',
            ],
            [
                'name' => 'Microbiology Reagents',
                'description' => 'Media kultur, reagen mikrobiologi, dan agar plate untuk identifikasi serta pertumbuhan mikroorganisme.',
            ],
            [
                'name' => 'Chemical Reagents',
                'description' => 'Bahan kimia murni (analytical grade) dan reagen berkualitas standar laboratorium internasional.',
            ],
            [
                'name' => 'Chemical Reagents (TKDN)',
                'description' => 'Bahan kimia reagen dengan sertifikasi Tingkat Komponen Dalam Negeri (TKDN) resmi untuk pengadaan instansi.',
            ],
            [
                'name' => 'Analysis Kit',
                'description' => 'Kit uji analisis cepat dan akurat untuk parameter kimia, kualitas air, pangan, dan penelitian.',
            ],
            [
                'name' => 'Diagnostic Kit',
                'description' => 'Kit diagnostik medis, klinis, dan laboratorium patologi untuk deteksi cepat dan andal.',
            ],
            [
                'name' => 'Custom Chemical Reagents/Raw Materials for Research (imported)',
                'description' => 'Bahan kimia kustom, senyawa khusus, dan bahan baku riset impor sesuai spesifikasi proyek penelitian.',
            ],
            [
                'name' => 'Custom Equipments for Research (imported)',
                'description' => 'Peralatan dan mesin kustom impor khusus yang disesuaikan dengan kebutuhan eksperimen laboratorium.',
            ],
            [
                'name' => 'Import Handling Service',
                'description' => 'Layanan profesional pengurusan izin dan impor bahan penelitian, spesimen biologis, dan instrumen riset.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['name' => $cat['name']],
                [
                    'slug' => Str::slug($cat['name']),
                    'description' => $cat['description'],
                ]
            );
        }

        // Hubungkan produk sampel yang ada ke kategori yang sesuai
        $labEq = Category::where('name', 'Laboratory Equipments')->first();
        $plastic = Category::where('name', 'Plasticware')->first();
        $micro = Category::where('name', 'Microbiology Reagents')->first();
        $chem = Category::where('name', 'Chemical Reagents')->first();

        // ATAGO Refractometer -> Laboratory Equipments
        Product::where('name', 'like', '%Refractometer%')
            ->orWhere('name', 'like', '%ATAGO%')
            ->update(['category_id' => $labEq?->id]);

        // Plastic Pipette & Centrifuge Tubes -> Plasticware
        Product::where('name', 'like', '%Pipette%')
            ->orWhere('name', 'like', '%Centrifuge%')
            ->update(['category_id' => $plastic?->id]);

        // Bioactin -> Microbiology Reagents
        Product::where('name', 'like', '%Bioactin%')
            ->update(['category_id' => $micro?->id]);

        // BHANEX -> Chemical Reagents / Microbiology
        Product::where('name', 'like', '%BHANEX%')
            ->update(['category_id' => $chem?->id]);
    }
}
