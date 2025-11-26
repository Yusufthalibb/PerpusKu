<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'isbn' => '9786020310208',
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'year' => 2005,
                'category_id' => 1, // Fiksi
                'pages' => 529,
                'shelf_code' => 'FIK-001-A',
                'description' => 'Novel inspiratif tentang perjuangan 10 anak dari keluarga miskin di Belitung yang bersekolah di SD Muhammadiyah.',
                'stock' => 10,
                'image' => 'books/laskar-pelangi.jpg',
            ],
            [
                'isbn' => '9786022910753',
                'title' => 'Cantik itu Luka',
                'author' => 'Eka Kurniawan',
                'publisher' => 'Gramedia Pustaka Utama',
                'year' => 2002,
                'category_id' => 1, // Fiksi
                'pages' => 535,
                'shelf_code' => 'FIK-002-B',
                'description' => 'Sebuah roman epik yang melintasi waktu dari era kolonial Hindia Belanda hingga awal kemerdekaan Indonesia, mengisahkan kehidupan Dewi Ayu.',
                'stock' => 7,
                'image' => 'books/cantik-itu-luka.jpg',
            ],
            [
                'isbn' => '9786022913372',
                'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'Gramedia Pustaka Utama',
                'year' => 2015,
                'category_id' => 2, // Non-Fiksi
                'pages' => 482,
                'shelf_code' => 'NF-001-A',
                'description' => 'Sejarah umat manusia dari zaman purba hingga era modern, mengeksplorasi bagaimana Homo sapiens menjadi spesies dominan di Bumi.',
                'stock' => 15,
                'image' => 'books/sapiens.jpg',
            ],
            [
                'isbn' => '9780132350884',
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'category_id' => 3, // Teknologi
                'pages' => 464,
                'shelf_code' => 'TEK-001-A',
                'description' => 'Panduan wajib bagi programmer untuk menulis kode yang bersih, mudah dibaca, dan dapat dipelihara.',
                'stock' => 5,
                'image' => 'books/clean-code.jpg',
            ],
            [
                'isbn' => '9780735211292',
                'title' => 'Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones',
                'author' => 'James Clear',
                'publisher' => 'Avery',
                'year' => 2018,
                'category_id' => 5, // Pengembangan Diri
                'pages' => 320,
                'shelf_code' => 'PD-001-A',
                'description' => 'Strategi praktis untuk membentuk kebiasaan baik dan menghilangkan kebiasaan buruk melalui perubahan kecil namun signifikan.',
                'stock' => 12,
                'image' => 'books/atomic-habits.jpg',
            ],
            [
                'isbn' => '9780061120084',
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'publisher' => 'HarperCollins',
                'year' => 1993,
                'category_id' => 1, // Fiksi
                'pages' => 208,
                'shelf_code' => 'FIK-003-C',
                'description' => 'Kisah inspiratif tentang seorang gembala Andalusia yang melakukan perjalanan untuk menemukan harta karunnya.',
                'stock' => 20,
                'image' => 'books/the-alchemist.jpg',
            ],
            [
                'isbn' => '9780785156565',
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'author' => 'J.K. Rowling',
                'publisher' => 'Scholastic Inc.',
                'year' => 1998,
                'category_id' => 6, // Anak & Remaja
                'pages' => 309,
                'shelf_code' => 'AR-001-A',
                'description' => 'Petualangan pertama Harry Potter di Hogwarts, dunia sihir yang penuh misteri dan keajaiban.',
                'stock' => 25,
                'image' => 'books/harry-potter-1.jpg',
            ],
            [
                'isbn' => '9780134685991',
                'title' => 'The Pragmatic Programmer: Your Journey to Mastery',
                'author' => 'David Thomas, Andrew Hunt',
                'publisher' => 'Addison-Wesley Professional',
                'year' => 2019,
                'category_id' => 3, // Teknologi
                'pages' => 352,
                'shelf_code' => 'TEK-002-B',
                'description' => 'Panduan klasik untuk menjadi programmer yang lebih efektif, produktif, dan pragmatis.',
                'stock' => 8,
                'image' => 'books/pragmatic-programmer.jpg',
            ],
        ];

        DB::table('books')->insert($books);
    }
}