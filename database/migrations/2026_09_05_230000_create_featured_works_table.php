<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('featured_works', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('featured_works')->insert([
            ['image' => 'images/instalasi-mikroskop.png', 'title' => 'Instalasi Mikroskop', 'description' => 'Persiapan dan instalasi instrumen untuk mendukung kegiatan riset laboratorium.', 'sort_order' => 1],
            ['image' => 'images/pembuatan-bha.png', 'title' => 'Proses Pembuatan BHA', 'description' => 'Dokumentasi proses pengembangan dan produksi Bovine Hydroxyapatite.', 'sort_order' => 2],
            ['image' => 'images/refraktometer.png', 'title' => 'Pengujian Laboratorium', 'description' => 'Pengujian karakteristik material untuk memastikan kualitas dan konsistensi produk.', 'sort_order' => 3],
            ['image' => 'images/pipet-transfer.png', 'title' => 'Aktivitas Riset', 'description' => 'Aktivitas tim INOBI dalam mendukung penelitian dan pengembangan bioproduk.', 'sort_order' => 4],
            ['image' => 'images/bioactin.png', 'title' => 'Inovasi Bioproduk', 'description' => 'Eksplorasi solusi bioproduk inovatif untuk kebutuhan kesehatan dan riset.', 'sort_order' => 5],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_works');
    }
};
