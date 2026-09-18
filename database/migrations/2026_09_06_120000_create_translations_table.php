<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('translatable_type');
            $table->unsignedBigInteger('translatable_id');
            $table->string('locale', 5);
            $table->string('field', 100);
            $table->longText('value');
            $table->timestamps();

            $table->unique(
                ['translatable_type', 'translatable_id', 'locale', 'field'],
                'translations_unique_content',
            );
            $table->index(['translatable_type', 'translatable_id']);
        });

        $featuredWorks = [
            1 => ['title' => 'Microscope Installation', 'description' => 'Instrument preparation and installation to support laboratory research activities.'],
            2 => ['title' => 'BHA Production Process', 'description' => 'Documentation of the development and production process for Bovine Hydroxyapatite.'],
            3 => ['title' => 'Laboratory Testing', 'description' => 'Material characterization testing to ensure product quality and consistency.'],
            4 => ['title' => 'Research Activities', 'description' => 'INOBI team activities supporting bioproduct research and development.'],
            5 => ['title' => 'Bioproduct Innovation', 'description' => 'Exploring innovative bioproduct solutions for healthcare and research needs.'],
        ];

        foreach ($featuredWorks as $id => $fields) {
            foreach ($fields as $field => $value) {
                DB::table('translations')->insert([
                    'translatable_type' => 'App\\Models\\FeaturedWork',
                    'translatable_id' => $id,
                    'locale' => 'en',
                    'field' => $field,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach (DB::table('products')->get(['id', 'name', 'description']) as $product) {
            foreach (['name' => $product->name, 'description' => $product->description] as $field => $value) {
                if (filled($value)) {
                    DB::table('translations')->insert([
                        'translatable_type' => 'App\\Models\\Product',
                        'translatable_id' => $product->id,
                        'locale' => 'en',
                        'field' => $field,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
