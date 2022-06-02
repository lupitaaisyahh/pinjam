-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2022 at 07:28 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `j_kel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `j_kel`, `email`, `no_telp`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'admin', 'Laki-laki', 'admin@admin.id', '000515848', 'admin', '$2y$10$f/Su3mG1ejRGVvTE8QePNejwMXoe.B7lM5fXL30wgFH/mGuZVmn4K', 'ZGVxkZ3xiGpYoaa8XDb0u1dDNDLH6neCtVJzqYpWJTlA0cuE51IlTpNOsDLj', '2019-05-06 21:00:38', '2021-10-15 02:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `foto` blob NOT NULL,
  `status` varchar(255) NOT NULL,
  `jenis_barang_id` int(11) NOT NULL,
  `satuan_barang_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `keterangan`, `jumlah`, `jumlah_stok`, `foto`, `status`, `jenis_barang_id`, `satuan_barang_id`, `created_at`, `updated_at`) VALUES
(1, 'INFOKUS D1', 'INFOKUS D1', 5, 2, 0x7075626c69632f75706c6f61642f61646d696e2f7275616e67616e2f494e464f4b55532044312d32322d31302d323032312d3435322e6a7067, 'Aktif', 3, 1, NULL, '2022-01-15 15:37:03'),
(6, 'INFOKUS D2', NULL, 5, 5, 0x7075626c69632f75706c6f61642f61646d696e2f626172616e672f494e464f4b55532044322d32322d31302d323032312d3831322e6a7067, 'Aktif', 3, 1, '2021-10-22 15:20:38', '2022-01-07 04:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `id` int(11) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `expiration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`id`, `key`, `value`, `expiration`) VALUES
(289, 'laravel_cacheh1091141011|::1:timer', 'i:1641223712;', '1641223712'),
(290, 'laravel_cacheh1091141011|::1', 'i:1;', '1641223712');

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id` int(11) NOT NULL,
  `gedung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`id`, `gedung`) VALUES
(1, 'Siskom'),
(2, 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `jenis_barang`) VALUES
(3, 'Infokus'),
(4, 'Mic');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nim` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `j_kel` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `chat_id` varchar(20) DEFAULT NULL,
  `ktm` blob DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `email`, `nim`, `username`, `password`, `j_kel`, `no_telp`, `jurusan`, `chat_id`, `ktm`, `status`, `created_at`, `updated_at`, `last_login_at`, `last_login_ip`) VALUES
(1, 'aji', 'adad@gmail.com', 'H1101141005', 'H1101141005', '$2y$10$TY3LpX/sudeBewNrkvswU.6QOecZ4.f6Qs6cb7uVHR9ztXmOVPrQG', 'Laki-laki', '089668950173', 'Sistem Informasi', '645306835', 0x7075626c69632f75706c6f61642f6b746d2f616a692d30352d30312d323032322d3930392e6a7067, 1, NULL, '2022-01-18 03:39:37', '2022-01-18 10:39:37', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2018_10_06_090646_create_admins_table', 1),
(8, '2018_10_06_093508_create_fakultas_table', 1),
(9, '2021_02_05_135709_add_login_fields_to_users_table', 2),
(10, '2021_02_05_140009_add_login_fields_to_op_table', 3),
(11, '2021_02_05_140046_add_login_fields_to_kp_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_barang`
--

CREATE TABLE `peminjaman_barang` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `lama_pinjam` int(11) DEFAULT NULL,
  `status_wd` int(11) DEFAULT NULL,
  `status_op` int(11) DEFAULT NULL,
  `status_pj` int(11) NOT NULL,
  `tgl_transaksi` varchar(20) NOT NULL,
  `tgl_kembali` varchar(20) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `catatan_kmbl` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman_barang`
--

INSERT INTO `peminjaman_barang` (`id`, `mahasiswa_id`, `lama_pinjam`, `status_wd`, `status_op`, `status_pj`, `tgl_transaksi`, `tgl_kembali`, `catatan`, `catatan_kmbl`, `created_at`, `updated_at`) VALUES
(25, 1, 2, 1, 1, 1, '2022-01-14 08:11:33', NULL, NULL, NULL, '2022-01-05 01:11:33', '2022-01-06 07:26:34'),
(27, 1, 1, 1, 1, 1, '2022-01-13 08:11:33', '2022-01-06 21:32:34', NULL, 'tes', '2022-01-06 07:35:25', '2022-01-07 04:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_barang_items`
--

CREATE TABLE `peminjaman_barang_items` (
  `id` int(11) NOT NULL,
  `peminjaman_barang_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman_barang_items`
--

INSERT INTO `peminjaman_barang_items` (`id`, `peminjaman_barang_id`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(29, 25, 1, 2, '2022-01-05 01:11:33', '2022-01-05 01:11:33'),
(32, 27, 1, 1, '2022-01-06 07:35:25', '2022-01-06 07:35:25'),
(33, 27, 6, 1, '2022-01-06 07:35:25', '2022-01-06 07:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_ruangan`
--

CREATE TABLE `peminjaman_ruangan` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `status_wd` int(11) NOT NULL,
  `status_op` int(11) NOT NULL,
  `status_pj` int(11) NOT NULL,
  `tgl_transaksi` varchar(100) NOT NULL,
  `tgl_kembali` varchar(20) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `catatan_kmbl` text DEFAULT NULL,
  `ruangan_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman_ruangan`
--

INSERT INTO `peminjaman_ruangan` (`id`, `mahasiswa_id`, `jumlah_hari`, `status_wd`, `status_op`, `status_pj`, `tgl_transaksi`, `tgl_kembali`, `catatan`, `catatan_kmbl`, `ruangan_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 1, 1, 1, '2022-01-05 09:17:17', '2022-01-14 10:41:14', 'tes', NULL, 3, '2022-01-05 02:17:17', '2022-01-14 04:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` blob NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `status_pj` int(11) NOT NULL,
  `gedung_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama`, `keterangan`, `foto`, `status`, `status_pj`, `gedung_id`) VALUES
(1, 'Ruang Lab', 'Lab Terpadu SISFO', 0x7075626c69632f75706c6f61642f61646d696e2f7275616e67616e2f5275616e67204c61622d31352d31302d323032312d3539312e6a7067, 'Aktif', 0, 2),
(3, 'RUANG B1', NULL, 0x7075626c69632f75706c6f61642f61646d696e2f7275616e67616e2f5255414e472042312d32302d31322d323032312d3634332e6a7067, 'Aktif', 0, 2),
(4, 'RUANG B2', NULL, 0x7075626c69632f75706c6f61642f61646d696e2f7275616e67616e2f5255414e472042322d32302d31322d323032312d3736392e6a7067, 'Aktif', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id`, `satuan`) VALUES
(1, 'Buah');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_operator`
--

CREATE TABLE `user_operator` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `j_kel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chat_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_operator`
--

INSERT INTO `user_operator` (`id`, `nama`, `email`, `username`, `password`, `j_kel`, `no_telp`, `chat_id`, `remember_token`, `created_at`, `updated_at`, `last_login_at`, `last_login_ip`) VALUES
(9, 'Operator MIPA', 'operator@op.com', 'operator', '$2y$10$Qh6ZnZXsjEqPw7lhSii6LOAeIRo8w/mlrR0cnYG.vXEs5Ji6ojA3G', 'Perempuan', '0926232', 0, NULL, '2021-10-17 16:21:47', '2022-01-03 15:20:43', '2022-01-03 22:20:43', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `user_wakildekan`
--

CREATE TABLE `user_wakildekan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `j_kel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chat_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_wakildekan`
--

INSERT INTO `user_wakildekan` (`id`, `nama`, `email`, `username`, `password`, `j_kel`, `no_telp`, `chat_id`, `remember_token`, `created_at`, `updated_at`, `last_login_at`, `last_login_ip`) VALUES
(9, 'WD MIPA', 'operator@op.com', 'wakildekan', '$2y$10$q4nVvxnDG.dy6rIm04Mu2.mTGQxqDLQgcuQwLFNLJCcZ2RJbboE6y', 'Laki-laki', '089668950173', 0, NULL, '2021-10-17 16:21:47', '2022-01-18 03:40:51', '2022-01-18 10:40:51', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_barang_id` (`jenis_barang_id`),
  ADD KEY `satuan_barang_id` (`satuan_barang_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `peminjaman_barang_items`
--
ALTER TABLE `peminjaman_barang_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `peminjaman_barang_id` (`peminjaman_barang_id`);

--
-- Indexes for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gedung_id` (`gedung_id`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_operator`
--
ALTER TABLE `user_operator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_wakildekan`
--
ALTER TABLE `user_wakildekan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cache`
--
ALTER TABLE `cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `peminjaman_barang_items`
--
ALTER TABLE `peminjaman_barang_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_operator`
--
ALTER TABLE `user_operator`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_wakildekan`
--
ALTER TABLE `user_wakildekan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `jenisb` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satuanb` FOREIGN KEY (`satuan_barang_id`) REFERENCES `satuan_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman_barang_items`
--
ALTER TABLE `peminjaman_barang_items`
  ADD CONSTRAINT `peminjaman_barang_items_ibfk_1` FOREIGN KEY (`peminjaman_barang_id`) REFERENCES `peminjaman_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_barang_items_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `gedung_ruangan_id` FOREIGN KEY (`gedung_id`) REFERENCES `gedung` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
