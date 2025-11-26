-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2025 pada 18.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpusku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `pages` int(11) NOT NULL,
  `shelf_code` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('tersedia','dipinjam','rusak') NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `publisher`, `year`, `category_id`, `pages`, `shelf_code`, `description`, `stock`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, '9786020310208', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2005', 1, 529, 'FIK-001-A', 'Novel inspiratif tentang perjuangan 10 anak dari keluarga miskin di Belitung yang bersekolah di SD Muhammadiyah.', 9, 'books/laskar-pelangi.jpg', 'tersedia', NULL, '2025-11-15 22:46:55'),
(2, '9786022910753', 'Cantik itu Luka', 'Eka Kurniawan', 'Gramedia Pustaka Utama', '2002', 1, 535, 'FIK-002-B', 'Sebuah roman epik yang melintasi waktu dari era kolonial Hindia Belanda hingga awal kemerdekaan Indonesia, mengisahkan kehidupan Dewi Ayu.', 7, 'books/cantik-itu-luka.jpg', 'tersedia', NULL, '2025-11-16 00:48:33'),
(3, '9786022913372', 'Sapiens: Riwayat Singkat Umat Manusia', 'Yuval Noah Harari', 'Gramedia Pustaka Utama', '2015', 2, 482, 'NF-001-A', 'Sejarah umat manusia dari zaman purba hingga era modern, mengeksplorasi bagaimana Homo sapiens menjadi spesies dominan di Bumi.', 15, 'books/sapiens.jpg', 'tersedia', NULL, NULL),
(4, '9780132350884', 'Clean Code: A Handbook of Agile Software Craftsmanship', 'Robert C. Martin', 'Prentice Hall', '2008', 3, 464, 'TEK-001-A', 'Panduan wajib bagi programmer untuk menulis kode yang bersih, mudah dibaca, dan dapat dipelihara.', 5, 'books/clean-code.jpg', 'tersedia', NULL, NULL),
(5, '9780735211292', 'Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones', 'James Clear', 'Avery', '2018', 5, 320, 'PD-001-A', 'Strategi praktis untuk membentuk kebiasaan baik dan menghilangkan kebiasaan buruk melalui perubahan kecil namun signifikan.', 12, 'books/atomic-habits.jpg', 'tersedia', NULL, NULL),
(6, '9780061120084', 'The Alchemist', 'Paulo Coelho', 'HarperCollins', '1993', 1, 208, 'FIK-003-C', 'Kisah inspiratif tentang seorang gembala Andalusia yang melakukan perjalanan untuk menemukan harta karunnya.', 20, 'books/the-alchemist.jpg', 'tersedia', NULL, NULL),
(7, '9780785156565', 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Scholastic Inc.', '1998', 6, 309, 'AR-001-A', 'Petualangan pertama Harry Potter di Hogwarts, dunia sihir yang penuh misteri dan keajaiban.', 25, 'books/harry-potter-1.jpg', 'tersedia', NULL, NULL),
(8, '9780134685991', 'The Pragmatic Programmer: Your Journey to Mastery', 'David Thomas, Andrew Hunt', 'Addison-Wesley Professional', '2019', 3, 352, 'TEK-002-B', 'Panduan klasik untuk menjadi programmer yang lebih efektif, produktif, dan pragmatis.', 8, 'books/pragmatic-programmer.jpg', 'tersedia', NULL, NULL),
(12, '213131', 'sadsda', 'sdadas', 'sadasd', '2022', 3, 21, 'A-01', 'dsadadwdwd', 1, 'books/1763281905_2BE9WVmlGD.png', 'tersedia', '2025-11-16 01:31:45', '2025-11-16 01:31:45'),
(13, '121242142132123', 'wadwa', 'dwadawd', 'awdawd', '2022', 2, 21, 'A-01', 'adewadwad', 12, 'books/1763282033_9pqbPsxE8u.png', 'tersedia', '2025-11-16 01:33:53', '2025-11-16 01:33:53'),
(14, '2312', 'wdawaw', 'dawdwad', 'dwadwa', '2022', 5, 22, 'A-01', 'dawawd', 12, 'books/1763282164_ighwsV9ll8.png', 'tersedia', '2025-11-16 01:36:04', '2025-11-16 01:36:04'),
(15, '23122313', 'bhhkhkkhjjkh', 'sadasd', 'sdad', '2022', 5, 22, 'A-01', 'addwadaw', 122, 'books/1763282832_naXv5Qv45f.jpg', 'tersedia', '2025-11-16 01:47:12', '2025-11-16 01:47:12'),
(16, '2312222', 'adwadwa', 'dadawd', 'awdawdaw', '2022', 6, 22, 'A-01', '2wadwdd', 12, 'books/1763282880_Y2xTqcYfBH.png', 'tersedia', '2025-11-16 01:48:00', '2025-11-16 01:48:00'),
(17, '21313122', 'sadasd', 'adsadsa', 'adadwd', '2022', 5, 22, 'A-01', 'dwadwadwa', 1222, 'books/1763283776_prnN2mjL4Y.png', 'tersedia', '2025-11-16 02:02:56', '2025-11-16 02:02:56'),
(18, '3232321', 'sdaa', 'adsad', 'asdasd', '2000', 5, 222, 'A-01', 'awdawdawdwda', 121, 'books/1763283848_cxzRFci0ql.png', 'tersedia', '2025-11-16 02:04:08', '2025-11-21 08:27:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowings`
--

CREATE TABLE `borrowings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `due_date` date DEFAULT NULL,
  `fine` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `borrowings`
--

INSERT INTO `borrowings` (`id`, `user_id`, `book_id`, `borrow_date`, `return_date`, `actual_return_date`, `status`, `due_date`, `fine`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2025-11-16', '2025-11-23', NULL, 'dipinjam', NULL, 0.00, '2025-11-15 22:46:55', '2025-11-15 22:46:55'),
(2, 3, 2, '2025-11-16', '2025-11-23', '2025-11-16', 'dikembalikan', NULL, 0.00, '2025-11-16 00:42:54', '2025-11-16 00:48:33'),
(3, 3, 18, '2025-11-21', '2025-11-28', NULL, 'dipinjam', NULL, 0.00, '2025-11-16 05:29:17', '2025-11-21 08:27:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@perpus.net|127.0.0.1', 'i:2;', 1763220595),
('laravel-cache-admin@perpus.net|127.0.0.1:timer', 'i:1763220595;', 1763220595);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', 'Novel, cerpen, dan karya imajinatif lainnya.', NULL, NULL),
(2, 'Non-Fiksi', 'Buku berdasarkan fakta, sejarah, biografi, dll.', NULL, NULL),
(3, 'Teknologi', 'Buku tentang pemrograman, komputer, dan sains teknis.', NULL, NULL),
(4, 'Bisnis & Ekonomi', 'Buku tentang manajemen, investasi, dan wirausaha.', NULL, NULL),
(5, 'Pengembangan Diri', 'Buku motivasi, produktivitas, dan peningkatan diri.', NULL, NULL),
(6, 'Anak & Remaja', 'Buku cerita, komik, dan pengetahuan untuk usia muda.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_15_124447_create_categories_table', 1),
(5, '2025_11_15_124448_create_books_table', 1),
(6, '2025_11_15_124455_create_borrowings_table', 1),
(7, '2025_11_15_000000_create_sessions_table', 2),
(8, '2025_11_15_152623_create_personal_access_tokens_table', 3),
(9, '2025_11_16_072004_update_borrowings_add_default_status', 4),
(10, '2025_11_16_074222_update_borrowings_nullable_dates', 5),
(11, '2025_11_21_084530_add_due_date_to_borrowings_table', 6),
(12, '2025_11_25_145638_create_settings_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Ki8sSZ35ZbmnumzmCqYCvpXojfasCunX6LxATbxf', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHFSRWhMVmt1ZVgxbXd3V2hNWGRDOTcyS0hEY3dpbHhmZngwYkJyQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1pbmphbS9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjE2OiJwZW1pbmphbS5wcm9maWxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1764176924);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'library_name', 'Perpustakaan Digital', NULL, NULL),
(2, 'library_email', 'admin@perpustakaan.com', NULL, NULL),
(3, 'library_phone', '+628123456789', NULL, NULL),
(4, 'library_address', 'Jl. Digital No. 1', NULL, NULL),
(5, 'max_borrow_days', '7', NULL, NULL),
(6, 'max_books_per_user', '3', NULL, NULL),
(7, 'fine_per_day', '1000', NULL, NULL),
(8, 'allow_extend', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL DEFAULT 'peminjam',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `phone`, `address`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'MinPus', 'admin@perpus.test', '2025-11-15 22:43:41', '$2y$12$JKQrQQ4lsa1NqSdL.NmpNOFCGejivyFXBoSjnf7BE7RiCMZTKU0Ge', 'admin', '08123456789', 'Jl. Perpustakaan No. 1', 'users/OpbNeRuznv7SRsmNKdmdmcvhug2zpRibMe9KPHzZ.jpg', NULL, '2025-11-15 22:43:41', '2025-11-21 03:15:03'),
(2, 'Petugas Satu', 'petugas', 'petugas@perpus.test', '2025-11-15 22:43:41', '$2y$12$iMTUeWdaK3ueK.G63pE5ceIvN7NJKL5M/Cs56MKVfxVT0LAhAST9m', 'petugas', '08198765432', 'Jl. Perpustakaan No. 2', 'profile/puRiqqh3nwQ2kR6xRK3QzFfYsPCLc2z70eUfYsVO.jpg', NULL, '2025-11-15 22:43:42', '2025-11-21 02:28:57'),
(3, 'Budi Santoso', 'budi', 'budi@member.test', '2025-11-15 22:43:42', '$2y$12$zaGZcb7xwE.LdJuzYOQ8MuBVY7hTH9hrGZwBG9OxvS2zWuWp0kphu', 'peminjam', '08199887766', 'Jl. Gatot Subroto No. 5', 'users/2muHyaEJXdsmfQaaCbJij3WESCaJ6ruYnBBXRBbx.jpg', NULL, '2025-11-15 22:43:42', '2025-11-21 02:24:32'),
(4, 'ucup', 'ucup', 'ucup@gmail.com', NULL, '$2y$12$N5JdmrKhnFlJukhKWA5W0.pJFYJQF0zBnGD8zU02itAk0/eAAUmrG', 'peminjam', '085710129738', 'dasdasda', 'users/MHDupvmQ83hw7jfaIhF8mZzQoMIXvbPikiflNuLH.png', NULL, '2025-11-21 08:40:15', '2025-11-23 07:09:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowings_user_id_foreign` (`user_id`),
  ADD KEY `borrowings_book_id_foreign` (`book_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
