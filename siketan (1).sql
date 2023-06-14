-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2023 pada 12.21
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siketan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `kode` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id`, `nama`, `active`, `created_at`, `kode`, `img`) VALUES
(4, 'satu', 1, '2023-05-26 06:37:26', '772', 'zyro-image.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskusis`
--

CREATE TABLE `diskusis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `diskusis`
--

INSERT INTO `diskusis` (`id`, `judul`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'lorem ipsidjkfd fdfjdj', 'testing', 2, '2023-05-07 20:19:18', '2023-05-07 20:19:18'),
(2, 'Hama Wereng', 'Hama wereng di sekitar Sribit Lor mulai merajalela', 1, '2023-05-22 08:21:11', '2023-05-22 08:21:11'),
(3, 'perbedaan iklim atau cuaca', 'bagaimana untuk solusi ketika musim saat ini sering berubah ubah, pupuk apa yang cocok', 1, '2023-05-22 19:48:11', '2023-05-22 19:48:11'),
(4, 'Pupuk subsidi', 'Pupuk subsidi saat ini sudah tersedia atau belum ya... mohon dibantu jawab', 4, '2023-05-22 21:00:51', '2023-05-22 21:00:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasis`
--

CREATE TABLE `informasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `informasis`
--

INSERT INTO `informasis` (`id`, `user_id`, `judul`, `body`, `created_at`, `updated_at`) VALUES
(3, 2, 'Tips Menjadi Petani Sukses', '<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<p><span style=\'font-weight: 700; color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'>1. Jangan Gengsi</span><br style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'>Yang paling utama adalah harus memiliki perasaan yang bangga terhadap pekerjaan menjadi petani. Tanpa adanya petani, orang tidak akan bisa mendapatkan beras dan bahan makanan. Oleh karena itu, kita tak perlu merasa gengsi dengan pekerjaan yang kita pilih ini. Terlebih lagi, predikat Indonesia sebagai negara agraris harus dibangkitkan kembali. Sebagai generasi muda, tak ada salahnya memilih pekerjaan menjadi petani.</span></p><p><span style=\'font-weight: 700; color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'>2. Petani Harus Pandai Berinovasi dan memanfaatkan teknologi</span><br style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'>Jangan hanya berpedoman pada cara bertani yang telah menjadi warisan turun menurun, saat ini petani harus pandai berinovasi dalam bentuk pembibitan maupun teknologi dalam berproduksi. Inovasi banyak yang telah diciptakan oleh beberapa petani kreatif atau bahkan juga sering diciptakan oleh peneliti maupunmahasiswa di seluruh penjuru tanah air. Untuk mengetahui berbagai inovasi yang ada, petani harus mau dan mampu untuk memanfaatkan teknologi yang ada khususnya teknologi informasi dan komunikasi. Dalam hitungan detik, petani dimanapun dapat mengetahui inovasi-inovasi terbaru.</span><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'><br></span></p><p><span style=\'font-weight: 700; color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'>3. Bergabung Dengan Gabungan Kelompok Tani (Gapoktan) atau Kelembagaan Ekonomi Petani</span><br style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'>Permasalahan krusial yang sudah biasa dialami oleh petani Indonesia adalah dipermainkan oleh tengkulak. Ketika panen raya tiba, banyak petani di Indonesia yang menjual hasil panen pada pengepul atau tengkulak. Karena menjual secara individu dan hampir sebagian besar memiliki jenis atau komoditas yang sama mengakibatkan tengkulak bertindak semena-mena. Mereka dengan sengaja membeli dengan harga murah.</span></p><p><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'><br></span></p><p><img data-filename=\"tips.jpg\" style=\"width: 310px;\" src=\"http://127.0.0.1:8000/foto-informasi//69504e_1684817301.jpeg\" class=\"img-responsive\"><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'><br></span><span style=\'color: rgb(0, 0, 0); font-family: \"Open Sans\", Helvetica, Arial, sans-serif; font-size: 16px; text-align: justify;\'><br></span><br></p>\n', '2023-05-22 21:48:22', '2023-05-22 22:54:34'),
(4, 2, 'Pupuk Subsidi sudah Tersedia', '<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<p>Kini pupuk subsidi telah tersedia di Gudang GAPOKTAN. Mari para petani atau ketua bisa merapat sesuai jadwal&nbsp;<img data-filename=\"tips.jpg\" style=\"width: 310px;\" src=\"http://127.0.0.1:8000/foto-informasi//2b626d_1684821233.jpeg\" class=\"img-responsive\"></p>\n', '2023-05-22 22:53:53', '2023-05-22 22:53:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_diskusis`
--

CREATE TABLE `komentar_diskusis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `diskusi_id` bigint(20) UNSIGNED NOT NULL,
  `komentar_diskusi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `komentar_diskusis`
--

INSERT INTO `komentar_diskusis` (`id`, `content`, `user_id`, `diskusi_id`, `komentar_diskusi_id`, `created_at`, `updated_at`) VALUES
(1, 'test10 101 010101010101 test', 2, 1, NULL, '2023-05-07 20:19:32', '2023-05-20 00:28:58'),
(2, 'menghubungi ketua gapoktan ya', 3, 4, NULL, '2023-05-23 23:31:35', '2023-05-23 23:32:19'),
(3, 'ya betul langsung menghubungi', 1, 4, 2, '2023-05-23 23:34:41', '2023-05-23 23:34:41'),
(4, 'silahkan bapak ibu menghubungii...', 1, 4, NULL, '2023-05-23 23:35:17', '2023-05-23 23:35:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_informasis`
--

CREATE TABLE `komentar_informasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `informasi_id` bigint(20) UNSIGNED NOT NULL,
  `komentar_informasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `komentar_informasis`
--

INSERT INTO `komentar_informasis` (`id`, `content`, `user_id`, `informasi_id`, `komentar_informasi_id`, `created_at`, `updated_at`) VALUES
(1, 'test10 101 010101010101 12 testing', 2, 1, NULL, '2023-05-20 00:26:55', '2023-05-20 00:30:14'),
(2, 'testing 20202020202020202020', 2, 1, 1, '2023-05-20 00:32:07', '2023-05-20 00:32:07'),
(3, 'wah.. sgt bermanfaat', 3, 3, NULL, '2023-05-22 21:50:12', '2023-05-22 21:50:12'),
(4, 'baikkk sekali pak bu', 1, 4, NULL, '2023-05-23 23:36:41', '2023-05-23 23:36:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_10_072656_create_roles_table', 1),
(6, '2023_04_10_134716_create_diskusis_table', 1),
(7, '2023_04_10_134915_create_komentar_diskusis_table', 1),
(8, '2023_05_18_071308_create_informasis_table', 2),
(9, '2023_05_20_071029_create_komentar_informasis_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nyewa`
--

CREATE TABLE `nyewa` (
  `id` int(11) NOT NULL,
  `penyewaan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_sewa` int(11) NOT NULL,
  `lama_nyewa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `pesan_tolak` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nyewa`
--

INSERT INTO `nyewa` (`id`, `penyewaan_id`, `user_id`, `created_at`, `status`, `img`, `alamat`, `active`, `no_hp`, `unit_sewa`, `lama_nyewa`, `jatuh_tempo`, `pesan_tolak`) VALUES
(42, 18, 7, '2023-06-14', 'tolak', NULL, 'oke', 1, '191939', 1, '3', '2023-06-17', 'oke'),
(43, 18, 7, '2023-06-14', 'selesai', NULL, 'baru', 1, '349837498', 2, '2', '2023-06-16', NULL),
(44, 18, 7, '2023-06-14', 'selesai', NULL, 'oke', 1, '39823', 2, '5', '2023-06-19', NULL),
(45, 18, 7, '2023-06-14', 'selesai', NULL, 'kdjhk', 1, '4398', 3, '4', '2023-06-18', NULL),
(46, 18, 7, '2023-06-14', 'selesai', NULL, 'ok', 1, '389', 2, '2', '2023-06-16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `nyewa_id` int(11) NOT NULL,
  `pesan` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `user_id`, `nominal`, `img`, `created_at`, `nyewa_id`, `pesan`) VALUES
(39, 7, 100000, 'zyro-image.png', '2023-06-14 07:34:03', 43, 'ike'),
(40, 7, 100000, 'default.png', '2023-06-14 07:46:00', 44, 'selamat'),
(41, 7, 300000, 'default.png', '2023-06-14 07:55:47', 45, 'oke'),
(42, 7, 200000, 'default.png', '2023-06-14 07:58:36', 46, 'oke');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id` int(11) NOT NULL,
  `nama_penyedia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_alat` int(11) NOT NULL,
  `luas_tanah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired` date NOT NULL,
  `biaya` int(11) NOT NULL,
  `pesan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `status_as` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`id`, `nama_penyedia`, `nama_alat`, `luas_tanah`, `expired`, `biaya`, `pesan`, `created_at`, `img`, `unit`, `status_as`) VALUES
(17, 'nama penyedia baru', 4, '20 M', '2023-05-25', 1000000, 'jakarta', '2023-05-26 06:45:44', 'zyro-image.png', 3, NULL),
(18, 'dua', 4, '10 M', '2023-05-18', 100000, 'oke', '2023-05-26 07:08:07', 'zyro-image.png', 90, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'petani', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`, `photo_profile`) VALUES
(1, 'Petani', 'petani@gmail.com', NULL, '$2y$10$mOi5Vl83hMv4ERzngcc3.exh4OopwzaJjXbq1tX0o.dInbhfT1VN.', 2, NULL, NULL, '2023-05-22 19:46:47', 'photo_profile/jEqaEz8EDkU5EYdOEqE1UVAd7yIyL4tqf9k0fPTz.jpg'),
(2, 'Admin2', 'admin@gmail.com', NULL, '$2y$10$mOi5Vl83hMv4ERzngcc3.exh4OopwzaJjXbq1tX0o.dInbhfT1VN.', 1, NULL, NULL, '2023-05-26 01:51:20', 'photo_profile/6alsulPZPvhnkyzClveO5pQZqTpXOkbemf2aa4QJ.jpg'),
(3, 'Putri Sekar (Petani)', 'putri@gmail.com', NULL, '$2y$10$Cm22yqlfi.tvh2dhNLO72.M6.jNddO9dbcpqgZm28zoSKST6575Ey', 2, NULL, '2023-05-22 20:49:35', '2023-05-22 20:49:35', 'photo_profile/2wFzRvqu26BSfZQ9IqwiPIBJIGtPFUVhBROr9PHl.png'),
(4, 'Yesiani (Petani)', 'yesiani@gmail.com', NULL, '$2y$10$q8Wa1CqvYWSw/TnnrcQjAOqsXAx0qQiiWXXLS9ni69TxLN5.BtvNe', 2, NULL, '2023-05-22 20:58:06', '2023-05-22 20:58:06', 'photo_profile/xgAKxsAeEI9nguXYKP4nd3kOrotVadLJ63aWytit.png'),
(5, 'Dandi Setiawan Harianto (Petani)', 'dandi@gmail.com', NULL, '$2y$10$p.MIjDnYPPxvgRKOyvhxyuyM7bz.z80esbkmcV9Hn3S6tRqYlIE3a', 2, NULL, '2023-05-22 22:56:11', '2023-05-22 22:56:51', 'photo_profile/aNz3kt7h6xLU7uQMb82tZ7Xpoasro5lG1WMOwdak.jpg'),
(6, 'baru123', 'baru@gmail.com', NULL, '$2y$10$lye4dIZ.fW0y4IsuruOOlOqzx78IyulvdFw9J8Hq/BwNr4oRS8Zjy', 2, NULL, '2023-05-26 00:50:48', '2023-05-26 00:50:48', 'photo_profile/KP89EJ05a8uoP27oz6WuEBhfsoKWobEMI5fez4jp.jpg'),
(7, 'saya123', 'saya@gmail.com', NULL, '$2y$10$35iwWPL.vXLBTLUtQggIH./MevBI/a4WSGNZpDK5i9.fW1gzgM0Cm', 2, NULL, '2023-06-14 00:30:52', '2023-06-14 00:30:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `diskusis`
--
ALTER TABLE `diskusis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `informasis`
--
ALTER TABLE `informasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar_diskusis`
--
ALTER TABLE `komentar_diskusis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar_informasis`
--
ALTER TABLE `komentar_informasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nyewa`
--
ALTER TABLE `nyewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyewaan_id` (`penyewaan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `nyewa_id` (`nyewa_id`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_penyedia` (`nama_penyedia`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `diskusis`
--
ALTER TABLE `diskusis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `informasis`
--
ALTER TABLE `informasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `komentar_diskusis`
--
ALTER TABLE `komentar_diskusis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `komentar_informasis`
--
ALTER TABLE `komentar_informasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `nyewa`
--
ALTER TABLE `nyewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
