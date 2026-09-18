<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Mengenal Bovine Hydroxyapatite dan Perannya dalam Regenerasi Tulang',
                'slug' => 'mengenal-bovine-hydroxyapatite',
                'category' => 'Riset',
                'excerpt' => 'BHANEX diolah dari tulang sapi menjadi biomaterial yang mendukung regenerasi jaringan tulang. Simak bagaimana proses dan manfaatnya bagi dunia riset dan medis.',
                'content' => "Hydroxyapatite adalah komponen mineral utama penyusun tulang dan gigi pada manusia. Karena strukturnya yang mirip dengan mineral tulang alami, hydroxyapatite banyak dimanfaatkan sebagai bahan biomaterial untuk mendukung regenerasi jaringan tulang.\n\nBHANEX, produk unggulan INOBI, memanfaatkan sumber tulang sapi (bovine) yang diolah melalui proses sterilisasi ketat sehingga aman digunakan untuk kebutuhan riset maupun aplikasi medis.\n\nKeunggulan bahan berbasis bovine hydroxyapatite terletak pada ketersediaannya yang lebih besar dibanding sumber sintetis, serta kompatibilitas biologis yang baik terhadap jaringan tubuh.",
                'cover_image' => 'blog/bhanex-artikel.jpg',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Tips Memilih Alat Laboratorium yang Tepat untuk Institusi Anda',
                'slug' => 'tips-memilih-alat-laboratorium',
                'category' => 'Produk',
                'excerpt' => 'Dari refraktometer hingga pipet transfer — kenali hal-hal yang perlu dipertimbangkan sebelum pengadaan alat lab untuk kampus, rumah sakit, atau lembaga riset.',
                'content' => "Pengadaan alat laboratorium untuk institusi pendidikan maupun kesehatan membutuhkan pertimbangan yang matang, bukan sekadar soal harga.\n\nBeberapa hal yang perlu diperhatikan: kesesuaian spesifikasi dengan kebutuhan riset, ketersediaan suku cadang dan kalibrasi ulang, serta dukungan purna jual dari penyedia.\n\nTim INOBI membantu institusi menentukan alat yang tepat sesuai skala penggunaan, mulai dari alat ukur portabel seperti pocket refraktometer, hingga consumable harian seperti pipet transfer dan centrifuge tubes.",
                'cover_image' => 'blog/alat-lab-artikel.jpg',
                'published_at' => now()->subDays(28),
            ],
            [
                'title' => 'INOBI Berpartisipasi dalam Instalasi Mikroskop di Laboratorium Mitra',
                'slug' => 'instalasi-mikroskop-laboratorium-mitra',
                'category' => 'Berita',
                'excerpt' => 'Sebagai bagian dari dukungan berkelanjutan kepada institusi mitra, tim INOBI membantu proses instalasi dan pelatihan penggunaan mikroskop di salah satu laboratorium riset.',
                'content' => "Selain menyediakan produk, INOBI turut mendampingi proses instalasi dan pelatihan penggunaan alat di lokasi mitra.\n\nPada kegiatan ini, tim teknis membantu pemasangan mikroskop penelitian sekaligus memberikan pelatihan dasar kepada staf laboratorium agar alat dapat dioperasikan secara optimal sejak hari pertama.\n\nPendampingan semacam ini menjadi bagian dari komitmen INOBI untuk memberikan pengalaman pengadaan yang menyeluruh, bukan sekadar transaksi jual-beli.",
                'cover_image' => 'blog/instalasi-artikel.jpg',
                'published_at' => now()->subDays(45),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
