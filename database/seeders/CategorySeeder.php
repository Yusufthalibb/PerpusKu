<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel, cerpen, dan karya imajinatif lainnya.'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku berdasarkan fakta, sejarah, biografi, dll.'],
            ['name' => 'Teknologi', 'description' => 'Buku tentang pemrograman, komputer, dan sains teknis.'],
            ['name' => 'Bisnis & Ekonomi', 'description' => 'Buku tentang manajemen, investasi, dan wirausaha.'],
            ['name' => 'Pengembangan Diri', 'description' => 'Buku motivasi, produktivitas, dan peningkatan diri.'],
            ['name' => 'Anak & Remaja', 'description' => 'Buku cerita, komik, dan pengetahuan untuk usia muda.'],
        ];

        DB::table('categories')->insert($categories);
    }
}