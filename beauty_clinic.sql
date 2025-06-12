-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 11:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beauty_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `waktu_booking` datetime NOT NULL,
  `status_booking` enum('Menunggu','Dikonfirmasi','Dibatalkan','Selesai') NOT NULL,
  `catatan` text NOT NULL,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_pasien`, `id_dokter`, `id_layanan`, `waktu_booking`, `status_booking`, `catatan`, `in_trash`) VALUES
(3, 4, 1, 1, '2025-06-11 19:12:13', 'Menunggu', 'dvdsvdv', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `spesialisasi` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `jadwal_praktek` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `id_user`, `nama_dokter`, `spesialisasi`, `no_hp`, `jadwal_praktek`, `status`, `in_trash`) VALUES
(1, 6, 'dr. Mei Lestari', 'Dokter Kulit & Kecantikan	', '081234567890', 'Senin - Jumat, 09.00 - 15.00', 1, 0),
(2, 7, 'dr. Rani Utami', 'Estetika Medis', '082345678901', 'Selasa & Kamis, 10.00 - 16.00', 1, 0),
(3, 8, 'dr. Sinta Wibowo', 'Anti-Aging & Aesthetic', '083456789012', 'Senin, Rabu, Jumat 13.00 - 18.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `durasi` time NOT NULL,
  `harga` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `deskripsi`, `durasi`, `harga`, `status`, `in_trash`) VALUES
(1, 'Facial Glow Up', 'Perawatan wajah untuk mencerahkan dan melembabkan kulit', '01:00:00', 'Rp 150.000', 1, 0),
(2, 'Chemical Peeling', 'Mengangkat sel kulit mati & regenerasi kulit wajah', '00:45:00', 'Rp 200.000', 1, 0),
(3, 'Botox Wajah', 'Mengurangi kerutan dan garis halus edit', '00:30:00', 'Rp 500.000', 1, 0),
(4, 'Laser Acne Treatment', 'Mengatasi jerawat dengan teknologi laser', '00:50:00', 'Rp 300.000', 1, 0),
(5, 'Whitening Infusion', 'Infus vitamin untuk mencerahkan kulit secara merata', '00:40:00', 'Rp 250.000', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `aktivitas` text NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id_log`, `id_user`, `aktivitas`, `ip_address`, `waktu`) VALUES
(1, 10, 'Login', '::1', '2025-05-01 08:21:39'),
(2, 10, 'Logout', '::1', '2025-05-01 08:21:48'),
(3, 2, 'Login', '::1', '2025-05-04 10:07:58'),
(4, 2, 'Logout', '::1', '2025-05-04 10:08:23'),
(5, 10, 'Login', '::1', '2025-05-04 10:22:44'),
(6, 10, 'Logout', '::1', '2025-05-04 10:22:47'),
(7, 10, 'Login', '::1', '2025-05-04 10:35:50'),
(8, 10, 'Logout', '::1', '2025-05-04 12:00:49'),
(9, 10, 'Login', '::1', '2025-05-04 12:01:10'),
(10, 10, 'Login', '::1', '2025-05-05 03:01:11'),
(11, 10, 'Logout', '::1', '2025-05-05 03:06:36'),
(12, 10, 'Login', '::1', '2025-05-05 03:06:51'),
(13, 10, 'Logout', '::1', '2025-05-05 08:22:08'),
(14, 10, 'Login', '::1', '2025-05-10 02:28:30'),
(15, 10, 'Login', '::1', '2025-05-11 19:29:48'),
(16, 10, 'Logout', '::1', '2025-05-11 20:20:18'),
(17, 10, 'Login', '::1', '2025-05-11 20:21:45'),
(18, 10, 'Logout', '::1', '2025-05-11 20:28:02'),
(19, 10, 'Login', '::1', '2025-05-11 20:28:37'),
(20, 10, 'Logout', '::1', '2025-05-11 20:29:01'),
(21, 10, 'Login', '::1', '2025-05-11 20:29:33'),
(22, 10, 'Logout', '::1', '2025-05-11 20:31:11'),
(23, 10, 'Login', '::1', '2025-05-11 20:31:50'),
(24, 2, 'Login', '::1', '2025-05-23 08:01:56'),
(25, 2, 'Logout', '::1', '2025-05-23 08:07:14'),
(26, 8, 'Login', '::1', '2025-05-23 08:09:57'),
(27, 8, 'Logout', '::1', '2025-05-23 08:10:35'),
(28, 6, 'Login', '::1', '2025-05-23 08:12:47'),
(29, 6, 'Logout', '::1', '2025-05-23 08:13:04'),
(30, 14, 'Login', '::1', '2025-05-23 08:13:36'),
(31, 1, 'Login', '::1', '2025-05-25 18:55:15'),
(32, 1, 'Login', '::1', '2025-05-25 21:25:23'),
(33, 1, 'Logout', '::1', '2025-05-25 22:20:35'),
(34, 6, 'Login', '::1', '2025-05-25 22:25:26'),
(35, 6, 'Logout', '::1', '2025-05-25 22:26:07'),
(36, 1, 'Login', '::1', '2025-05-25 22:27:02'),
(37, 1, 'Login', '::1', '2025-05-26 08:06:25'),
(38, 2, 'Login', '::1', '2025-05-26 08:45:55'),
(39, 2, 'Logout', '::1', '2025-05-26 08:58:15'),
(40, 1, 'Login', '::1', '2025-05-26 08:59:08'),
(41, 1, 'Login', '::1', '2025-05-26 09:11:21'),
(42, 2, 'Login', '::1', '2025-05-26 17:51:32'),
(43, 2, 'Login', '::1', '2025-05-26 20:47:04'),
(44, 1, 'login ke sistem', '::1', '2025-05-26 21:29:20'),
(45, 1, 'login ke sistem', '::1', '2025-05-26 21:31:56'),
(46, 1, 'login ke sistem', '::1', '2025-05-26 21:36:04'),
(47, 2, 'login ke sistem', '::1', '2025-05-26 21:41:52'),
(48, 2, 'login ke sistem', '::1', '2025-05-26 21:46:23'),
(49, 1, 'login ke sistem', '::1', '2025-05-26 21:51:17'),
(50, 1, 'login ke sistem', '::1', '2025-05-26 23:16:20'),
(51, 1, 'login ke sistem', '::1', '2025-05-26 23:23:39'),
(52, 1, 'login ke sistem', '::1', '2025-05-26 23:29:38'),
(53, 2, 'login ke sistem', '::1', '2025-05-27 20:58:31'),
(54, 2, 'login ke sistem', '::1', '2025-05-27 21:03:27'),
(55, 2, 'login ke sistem', '::1', '2025-05-27 21:17:12'),
(56, 2, 'Logout', '::1', '2025-05-27 21:18:02'),
(57, 2, 'login ke sistem', '::1', '2025-06-02 17:38:58'),
(58, 2, 'logout dari sistem', '::1', '2025-06-02 17:39:58'),
(59, 2, 'login ke sistem', '::1', '2025-06-02 17:40:43'),
(60, 2, 'logout dari sistem', '::1', '2025-06-02 17:56:17'),
(61, 2, 'login ke dalam sistem', '::1', '2025-06-02 17:59:55'),
(62, 2, 'mengakses halaman dashboard', '::1', '2025-06-02 18:02:02'),
(63, 2, 'mengakses data dokter', '::1', '2025-06-02 18:04:02'),
(64, 2, 'menambahkan data dokter', '::1', '2025-06-02 18:07:17'),
(65, 2, 'mengakses data dokter', '::1', '2025-06-02 18:08:20'),
(66, 2, 'mengakses data dokter', '::1', '2025-06-02 18:09:17'),
(67, 2, 'mengakses data dokter', '::1', '2025-06-02 18:09:53'),
(68, 2, 'memulihkan data dokter yang dihapus', '::1', '2025-06-02 18:15:42'),
(69, 2, 'mengakses data dokter yang dihapus', '::1', '2025-06-02 18:15:54'),
(70, 2, 'mengakses data dokter', '::1', '2025-06-02 18:16:22'),
(71, 2, 'mmengakses log activity', '::1', '2025-06-02 18:35:13'),
(72, 2, 'mmengakses log activity', '::1', '2025-06-02 18:37:53'),
(73, 2, 'mmengakses log activity', '::1', '2025-06-02 18:39:09'),
(74, 2, 'mengakses log activity', '::1', '2025-06-02 18:41:01'),
(75, 2, 'mengakses log activity', '::1', '2025-06-02 18:41:34'),
(76, 2, 'mengakses log activity', '::1', '2025-06-02 18:42:31'),
(77, 2, 'mengakses log activity', '::1', '2025-06-02 18:44:38'),
(78, 2, 'mengakses log activity', '::1', '2025-06-02 18:45:16'),
(79, 2, 'mengakses data penjualan produk', '::1', '2025-06-02 19:01:54'),
(80, 2, 'mengakses data user', '::1', '2025-06-02 19:04:58'),
(81, 2, 'mengakses data penjualan produk', '::1', '2025-06-02 19:06:55'),
(82, 2, 'mengakses data penjualan produk', '::1', '2025-06-02 19:12:19'),
(83, 2, 'mengakses data user', '::1', '2025-06-02 19:16:22'),
(84, 2, 'mengakses data user', '::1', '2025-06-02 19:20:49'),
(85, 2, 'mengakses data user', '::1', '2025-06-02 19:26:09'),
(86, 2, 'mengakses data user', '::1', '2025-06-02 19:31:24'),
(87, 2, 'mengakses data pasien', '::1', '2025-06-02 19:32:00'),
(88, 2, 'mengakses data dokter', '::1', '2025-06-02 19:33:20'),
(89, 2, 'mengakses data produk', '::1', '2025-06-02 19:35:32'),
(90, 2, 'mengakses data layanan', '::1', '2025-06-02 19:36:52'),
(91, 2, 'mengakses data user', '::1', '2025-06-02 19:46:32'),
(92, 2, 'mengakses data user', '::1', '2025-06-02 19:47:37'),
(93, 2, 'mengakses data pasien', '::1', '2025-06-02 19:49:58'),
(94, 2, 'mengakses data dokter', '::1', '2025-06-02 19:50:29'),
(95, 2, 'menambahkan data dokter', '::1', '2025-06-02 19:51:12'),
(96, 2, 'mengakses data dokter', '::1', '2025-06-02 19:53:26'),
(97, 2, 'mengakses data pasien', '::1', '2025-06-02 19:54:13'),
(98, 2, 'menambahkan data pasien', '::1', '2025-06-02 19:54:44'),
(99, 2, 'mengakses halaman dashboard', '::1', '2025-06-02 20:53:54'),
(100, 2, 'mengakses data dokter', '::1', '2025-06-02 20:54:23'),
(101, 2, 'mengedit data dokter', '::1', '2025-06-02 20:55:00'),
(102, 2, 'mengedit data dokter', '::1', '2025-06-02 21:00:43'),
(103, 2, 'mengedit data dokter', '::1', '2025-06-02 21:02:50'),
(104, 2, 'mengedit data dokter', '::1', '2025-06-02 21:11:20'),
(105, 2, 'mengedit data dokter', '::1', '2025-06-02 21:12:32'),
(106, 2, 'mengakses data dokter', '::1', '2025-06-02 21:13:00'),
(107, 2, 'mengakses data dokter yang dihapus', '::1', '2025-06-02 21:13:58'),
(108, 2, 'mengakses data dokter', '::1', '2025-06-02 21:14:25'),
(109, 2, 'menghapus data dokter', '::1', '2025-06-02 21:15:48'),
(110, 2, 'mengakses data dokter', '::1', '2025-06-02 21:16:00'),
(111, 2, 'mengakses data dokter yang dihapus', '::1', '2025-06-02 21:17:01'),
(112, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-02 22:55:08'),
(113, 2, 'Mengakses Data Dokter', '::1', '2025-06-02 22:57:33'),
(114, 2, 'Mengakses Data User', '::1', '2025-06-02 23:12:35'),
(115, 2, 'Mengakses Data User', '::1', '2025-06-02 23:20:55'),
(116, 2, 'Mengakses Data User', '::1', '2025-06-02 23:24:43'),
(117, 2, 'Mengakses Data User', '::1', '2025-06-02 23:25:40'),
(118, 2, 'Mengakses Data User', '::1', '2025-06-02 23:29:42'),
(119, 2, 'Mengakses Data User', '::1', '2025-06-02 23:30:04'),
(120, 2, 'Mengakses Data User', '::1', '2025-06-02 23:33:37'),
(121, 2, 'Mengakses Data User', '::1', '2025-06-02 23:36:44'),
(122, 2, 'Mengakses Data User', '::1', '2025-06-02 23:37:16'),
(123, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-02 23:59:34'),
(124, 2, 'Mengakses Data Booking', '::1', '2025-06-03 00:17:56'),
(125, 2, 'Mengakses Data Booking', '::1', '2025-06-03 00:19:04'),
(126, 2, 'Mengakses Data Booking', '::1', '2025-06-03 00:24:59'),
(127, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 00:26:29'),
(128, 2, 'Login ke dalam Sistem', '::1', '2025-06-03 19:50:49'),
(129, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-03 19:50:58'),
(130, 2, 'Mengakses Data Booking', '::1', '2025-06-03 19:51:31'),
(131, 2, 'Mengakses Data Booking', '::1', '2025-06-03 19:52:54'),
(132, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 19:53:31'),
(133, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 19:54:23'),
(134, 2, 'Mengakses Data Pasien', '::1', '2025-06-03 19:55:00'),
(135, 2, 'Menambahkan Data Pasien', '::1', '2025-06-03 19:55:39'),
(136, 2, 'Mengakses Data Pasien', '::1', '2025-06-03 19:56:11'),
(137, 2, 'Mengakses Data Penjualan Produk', '::1', '2025-06-03 19:56:24'),
(138, 2, 'Menambahkan Data Penjualan Produk', '::1', '2025-06-03 19:57:02'),
(139, 2, 'Mengakses Data Booking', '::1', '2025-06-03 19:58:08'),
(140, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 19:58:41'),
(141, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 19:59:44'),
(142, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 20:00:25'),
(143, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 20:01:17'),
(144, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 20:05:37'),
(145, 2, 'Mengakses Data Booking', '::1', '2025-06-03 20:07:46'),
(146, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 20:08:11'),
(147, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 20:15:22'),
(148, 2, 'Mengakses Data Booking', '::1', '2025-06-03 20:34:40'),
(149, 2, 'Mengakses Data Penjualan Produk', '::1', '2025-06-03 20:39:08'),
(150, 2, 'Menambahkan Data Penjualan Produk', '::1', '2025-06-03 20:39:42'),
(151, 2, 'Menambahkan Data Penjualan Produk', '::1', '2025-06-03 20:42:03'),
(152, 2, 'Mengakses Data Penjualan Produk', '::1', '2025-06-03 20:42:38'),
(153, 2, 'Mengedit Data Penjualan Produk', '::1', '2025-06-03 20:48:06'),
(154, 2, 'Mengakses Data Pasien', '::1', '2025-06-03 20:50:00'),
(155, 2, 'Menambahkan Data Pasien', '::1', '2025-06-03 20:50:21'),
(156, 2, 'Mengakses Data Pasien', '::1', '2025-06-03 21:31:58'),
(157, 2, 'Mengakses Data Booking', '::1', '2025-06-03 21:32:30'),
(158, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 21:34:00'),
(159, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 21:37:06'),
(160, 2, 'Membuka Form Tambah Booking', '::1', '2025-06-03 21:38:13'),
(161, 2, 'Login ke dalam Sistem', '::1', '2025-06-08 20:51:43'),
(162, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-08 20:51:56'),
(163, 2, 'Mengakses Data User', '::1', '2025-06-08 20:52:29'),
(164, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 20:53:03'),
(165, 2, 'Mengakses Data User', '::1', '2025-06-08 20:53:38'),
(166, 2, 'Mengakses Data User', '::1', '2025-06-08 20:54:10'),
(167, 2, 'Menghapus Data User', '::1', '2025-06-08 20:55:10'),
(168, 2, 'Menghapus Data User', '::1', '2025-06-08 20:58:19'),
(169, 2, 'Mengakses Data User', '::1', '2025-06-08 20:58:36'),
(170, 2, 'Mengakses Data User', '::1', '2025-06-08 20:58:56'),
(171, 2, 'Menghapus Data User', '::1', '2025-06-08 20:59:31'),
(172, 2, 'Mengakses Data User', '::1', '2025-06-08 21:01:07'),
(173, 2, 'Menghapus Data User', '::1', '2025-06-08 21:01:39'),
(174, 2, 'Mengakses Data User', '::1', '2025-06-08 21:04:07'),
(175, 2, 'Mengakses Data User', '::1', '2025-06-08 21:04:40'),
(176, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:05:16'),
(177, 2, 'Mengakses form tambah Data Pasien', '::1', '2025-06-08 21:05:46'),
(178, 2, 'Berhasil menambahkan Data Pasien', '::1', '2025-06-08 21:06:44'),
(179, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:06:55'),
(180, 2, 'Mengakses form edit Data Pasien', '::1', '2025-06-08 21:07:23'),
(181, 2, 'Mengakses form edit Data Pasien', '::1', '2025-06-08 21:07:57'),
(182, 2, 'Berhasil mengedit Data Pasien', '::1', '2025-06-08 21:09:05'),
(183, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:09:16'),
(184, 2, 'Mengakses form edit Data Pasien', '::1', '2025-06-08 21:09:49'),
(185, 2, 'Berhasil mengedit Data Pasien', '::1', '2025-06-08 21:10:21'),
(186, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:10:34'),
(187, 2, 'Menghapus Data Pasien', '::1', '2025-06-08 21:11:07'),
(188, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:11:20'),
(189, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-08 21:11:49'),
(190, 2, 'Berhasil memulihkan Data Pasien', '::1', '2025-06-08 21:12:20'),
(191, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-08 21:12:31'),
(192, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:13:32'),
(193, 2, 'Menghapus Data Pasien', '::1', '2025-06-08 21:14:46'),
(194, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:14:58'),
(195, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-08 21:15:33'),
(196, 2, 'Berhasil menghapus Data Pasien secara permanen', '::1', '2025-06-08 21:16:03'),
(197, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-08 21:16:14'),
(198, 2, 'Berhasil menghapus semua Data Pasien', '::1', '2025-06-08 21:16:43'),
(199, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-08 21:16:53'),
(200, 2, 'Mengakses Data Pasien', '::1', '2025-06-08 21:17:21'),
(201, 2, 'Mengakses Data Dokter', '::1', '2025-06-08 21:18:40'),
(202, 2, 'Mengakses Data Dokter yang dihapus', '::1', '2025-06-08 21:37:53'),
(203, 2, 'Berhasil memulihkan Data Dokter', '::1', '2025-06-08 21:39:04'),
(204, 2, 'Mengakses Data Dokter yang dihapus', '::1', '2025-06-08 21:39:16'),
(205, 2, 'Mengakses Data Dokter', '::1', '2025-06-08 21:40:32'),
(206, 2, 'Mengakses form tambah Data Dokter', '::1', '2025-06-08 21:41:03'),
(207, 2, 'Berhasil menambahkan Data Dokter', '::1', '2025-06-08 21:44:54'),
(208, 2, 'Mengakses Data Dokter', '::1', '2025-06-08 21:45:04'),
(209, 2, 'Mengakses form edit Data Dokter', '::1', '2025-06-08 21:45:48'),
(210, 2, 'Berhasil mengedit Data Dokter', '::1', '2025-06-08 21:47:09'),
(211, 2, 'Mengakses Data Dokter', '::1', '2025-06-08 21:47:21'),
(212, 2, 'Menghapus Data Dokter', '::1', '2025-06-08 21:48:12'),
(213, 2, 'Mengakses Data Dokter', '::1', '2025-06-08 21:48:24'),
(214, 2, 'Mengakses Data Dokter yang dihapus', '::1', '2025-06-08 21:48:59'),
(215, 2, 'Berhasil menghapus semua Data Dokter', '::1', '2025-06-08 21:49:27'),
(216, 2, 'Mengakses Data Dokter yang dihapus', '::1', '2025-06-08 21:49:39'),
(217, 2, 'Mengakses Data Dokter', '::1', '2025-06-08 21:50:06'),
(218, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:16:45'),
(219, 2, 'Mengakses form tambah Data Layanan', '::1', '2025-06-08 22:17:50'),
(220, 2, 'Berhasil menambahkan Data Layanan', '::1', '2025-06-08 22:18:18'),
(221, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:18:28'),
(222, 2, 'Mengakses form edit Data Layanan', '::1', '2025-06-08 22:19:21'),
(223, 2, 'Berhasil mengedit Data Layanan', '::1', '2025-06-08 22:19:48'),
(224, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:19:58'),
(225, 2, 'Mengakses form edit Data Layanan', '::1', '2025-06-08 22:22:34'),
(226, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:23:50'),
(227, 2, 'Berhasil menghapus Data Layanan', '::1', '2025-06-08 22:24:15'),
(228, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:24:26'),
(229, 2, 'Mengakses Data Layanan yang dihapus', '::1', '2025-06-08 22:24:52'),
(230, 2, 'Berhasil memulihkan Data Layanan', '::1', '2025-06-08 22:25:18'),
(231, 2, 'Mengakses Data Layanan yang dihapus', '::1', '2025-06-08 22:25:28'),
(232, 2, 'Berhasil menghapus semua Data Layanan', '::1', '2025-06-08 22:25:53'),
(233, 2, 'Mengakses Data Layanan yang dihapus', '::1', '2025-06-08 22:26:03'),
(234, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:26:29'),
(235, 2, 'Berhasil menghapus Data Layanan', '::1', '2025-06-08 22:27:04'),
(236, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:27:16'),
(237, 2, 'Mengakses Data Layanan yang dihapus', '::1', '2025-06-08 22:27:44'),
(238, 2, 'Berhasil menghapus Data Layanan secara permanen', '::1', '2025-06-08 22:28:09'),
(239, 2, 'Mengakses Data Layanan yang dihapus', '::1', '2025-06-08 22:28:19'),
(240, 2, 'Mengakses Data Layanan', '::1', '2025-06-08 22:28:45'),
(241, 2, 'Mengakses Data Produk', '::1', '2025-06-08 22:30:35'),
(242, 2, 'Mengakses form tambah Data Produk', '::1', '2025-06-08 22:31:01'),
(243, 2, 'Berhasil menambahkan Data Produk', '::1', '2025-06-08 22:31:28'),
(244, 2, 'Mengakses Data Produk', '::1', '2025-06-08 22:31:37'),
(245, 2, 'Mengakses form edit Data Produk', '::1', '2025-06-08 22:32:02'),
(246, 2, 'Berhasil mengedit Data Produk', '::1', '2025-06-08 22:32:50'),
(247, 2, 'Mengakses Data Produk', '::1', '2025-06-08 22:32:59'),
(248, 2, 'Menghapus Data Produk', '::1', '2025-06-08 22:33:26'),
(249, 2, 'Mengakses Data Produk', '::1', '2025-06-08 22:33:36'),
(250, 2, 'Mengakses Data Produk yang dihapus', '::1', '2025-06-08 22:34:14'),
(251, 2, 'Berhasil memulihkan Data Produk', '::1', '2025-06-08 22:34:38'),
(252, 2, 'Mengakses Data Produk yang dihapus', '::1', '2025-06-08 22:34:48'),
(253, 2, 'Berhasil menghapus semua Data Produk', '::1', '2025-06-08 22:35:07'),
(254, 2, 'Mengakses Data Produk yang dihapus', '::1', '2025-06-08 22:35:17'),
(255, 2, 'Mengakses Data Produk', '::1', '2025-06-08 22:35:43'),
(256, 2, 'Menghapus Data Produk', '::1', '2025-06-08 22:36:09'),
(257, 2, 'Mengakses Data Produk yang dihapus', '::1', '2025-06-08 22:36:18'),
(258, 2, 'Berhasil menghapus Data Produk secara permanen', '::1', '2025-06-08 22:36:44'),
(259, 2, 'Mengakses Data Produk yang dihapus', '::1', '2025-06-08 22:36:53'),
(260, 2, 'Mengakses Data Produk', '::1', '2025-06-08 22:37:34'),
(261, 2, 'Mengakses Data Produk yang dihapus', '::1', '2025-06-08 23:20:17'),
(262, 2, 'Mengakses Data Produk', '::1', '2025-06-08 23:20:45'),
(263, 2, 'Mengakses Data Booking', '::1', '2025-06-08 23:21:03'),
(264, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-08 23:21:43'),
(265, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-08 23:22:24'),
(266, 2, 'Mengakses Data Booking', '::1', '2025-06-08 23:22:50'),
(267, 2, 'Login ke dalam Sistem', '::1', '2025-06-09 20:55:23'),
(268, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-09 20:55:34'),
(269, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:01:29'),
(270, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-09 21:03:00'),
(271, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-09 21:03:57'),
(272, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:05:28'),
(273, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:22:39'),
(274, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:24:31'),
(275, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:34:39'),
(276, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:35:01'),
(277, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:44:52'),
(278, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:45:13'),
(279, 2, 'Mengakses Data Penjualan Produk', '::1', '2025-06-09 21:46:12'),
(280, 2, 'Mengakses Data Booking', '::1', '2025-06-09 21:47:18'),
(281, 2, 'Login ke dalam Sistem', '::1', '2025-06-10 08:22:38'),
(282, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-10 08:22:47'),
(283, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:23:23'),
(284, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:25:46'),
(285, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:26:17'),
(286, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:29:13'),
(287, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:31:44'),
(288, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:33:12'),
(289, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-10 08:33:43'),
(290, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:34:00'),
(291, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:38:07'),
(292, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:38:46'),
(293, 2, 'Mengakses Data Booking', '::1', '2025-06-10 08:39:55'),
(294, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-10 08:40:41'),
(295, 2, 'Data Booking berhasil ditambahkan', '::1', '2025-06-10 08:41:15'),
(296, 2, 'Data Booking berhasil ditambahkan', '::1', '2025-06-10 08:43:40'),
(297, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-10 08:44:12'),
(298, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-10 08:45:22'),
(299, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-10 08:56:40'),
(300, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-10 08:58:29'),
(301, 2, 'Mengakses Data Dokter', '::1', '2025-06-10 09:01:22'),
(302, 2, 'Mengakses form tambah Data Dokter', '::1', '2025-06-10 09:02:00'),
(303, 2, 'Mengakses Data Dokter', '::1', '2025-06-10 09:31:52'),
(304, 2, 'Mengakses Data Booking', '::1', '2025-06-10 09:32:18'),
(305, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-10 09:32:54'),
(306, 2, 'Login ke dalam Sistem', '::1', '2025-06-11 08:50:27'),
(307, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-11 08:50:35'),
(308, 2, 'Mengakses Data Penjualan Produk', '::1', '2025-06-11 08:51:04'),
(309, 2, 'Mengakses Data Penjualan Produk', '::1', '2025-06-11 08:51:28'),
(310, 2, 'Mengakses Data Booking', '::1', '2025-06-11 08:51:53'),
(311, 2, 'Mengakses form tambah Data Booking', '::1', '2025-06-11 08:52:20'),
(312, 2, 'Data Booking berhasil ditambahkan', '::1', '2025-06-11 08:54:05'),
(313, 2, 'Mengakses Data Booking', '::1', '2025-06-11 08:54:15'),
(314, 2, 'Mengakses form edit Data Booking', '::1', '2025-06-11 08:55:10'),
(315, 2, 'Mengakses Data Booking', '::1', '2025-06-11 08:56:25'),
(316, 2, 'Mengakses form edit Data Booking', '::1', '2025-06-11 08:56:46'),
(317, 2, 'Data Booking berhasil diperbarui', '::1', '2025-06-11 08:58:13'),
(318, 2, 'Mengakses Data Booking', '::1', '2025-06-11 08:58:20'),
(319, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:00:45'),
(320, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:01:32'),
(321, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:02:26'),
(322, 2, 'Data Booking berhasil dihapus', '::1', '2025-06-11 09:02:51'),
(323, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:03:02'),
(324, 2, 'Data Booking berhasil dihapus', '::1', '2025-06-11 09:03:28'),
(325, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:03:37'),
(326, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:04:25'),
(327, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:04:50'),
(328, 2, 'Data Booking berhasil dipulihkan', '::1', '2025-06-11 09:05:39'),
(329, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:05:47'),
(330, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:06:21'),
(331, 2, 'Data Booking berhasil dihapus', '::1', '2025-06-11 09:06:51'),
(332, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:07:02'),
(333, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:12:10'),
(334, 2, 'Data Booking berhasil dihapus', '::1', '2025-06-11 09:12:46'),
(335, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:12:56'),
(336, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:15:43'),
(337, 2, 'Data Booking berhasil dihapus', '::1', '2025-06-11 09:16:26'),
(338, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:16:37'),
(339, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:17:03'),
(340, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:17:25'),
(341, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:18:12'),
(342, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:20:16'),
(343, 2, 'Data Booking berhasil dihapus', '::1', '2025-06-11 09:20:51'),
(344, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:20:59'),
(345, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:25:01'),
(346, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:25:30'),
(347, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:38:30'),
(348, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:38:54'),
(349, 2, 'Data Booking berhasil dipulihkan', '::1', '2025-06-11 09:39:22'),
(350, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:39:31'),
(351, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:39:54'),
(352, 2, 'Data Booking berhasil dihapus', '::1', '2025-06-11 09:41:13'),
(353, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:41:21'),
(354, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:41:46'),
(355, 2, 'Data Booking berhasil dihapus secara permanen', '::1', '2025-06-11 09:42:10'),
(356, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:42:18'),
(357, 2, 'Data Booking berhasil dihapus semua', '::1', '2025-06-11 09:42:44'),
(358, 2, 'Mengakses Data Booking yang dihapus', '::1', '2025-06-11 09:42:54'),
(359, 2, 'Mengakses Data Booking', '::1', '2025-06-11 09:43:26'),
(360, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:11:15'),
(361, 2, 'Mengakses form tambah Data Pembayaran', '::1', '2025-06-11 10:11:44'),
(362, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:12:37'),
(363, 2, 'Mengakses form tambah Data Pembayaran', '::1', '2025-06-11 10:12:56'),
(364, 2, 'Data Pembayaran berhasil ditambahkan', '::1', '2025-06-11 10:13:28'),
(365, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:13:39'),
(366, 2, 'Mengakses form edit Data Pembayaran', '::1', '2025-06-11 10:14:09'),
(367, 2, 'Mengakses form edit Data Pembayaran', '::1', '2025-06-11 10:15:03'),
(368, 2, 'Mengakses form edit Data Pembayaran', '::1', '2025-06-11 10:15:33'),
(369, 2, 'Mengakses form edit Data Pembayaran', '::1', '2025-06-11 10:16:17'),
(370, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:16:36'),
(371, 2, 'Mengakses form edit Data Pembayaran', '::1', '2025-06-11 10:17:03'),
(372, 2, 'Mengakses form edit Data Pembayaran', '::1', '2025-06-11 10:17:27'),
(373, 2, 'Mengakses form edit Data Pembayaran', '::1', '2025-06-11 10:17:53'),
(374, 2, 'Data Pembayaran berhasil diperbarui', '::1', '2025-06-11 10:18:29'),
(375, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:18:39'),
(376, 2, 'Data Pembayaran berhasil dihapus', '::1', '2025-06-11 10:19:09'),
(377, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:19:21'),
(378, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 10:19:54'),
(379, 2, 'Data Pembayaran berhasil dipulihkan', '::1', '2025-06-11 10:20:24'),
(380, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 10:20:33'),
(381, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:21:05'),
(382, 2, 'Data Pembayaran berhasil dihapus', '::1', '2025-06-11 10:21:39'),
(383, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:21:50'),
(384, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 10:22:23'),
(385, 2, 'Data Pembayaran berhasil dipulihkan', '::1', '2025-06-11 10:22:51'),
(386, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 10:23:02'),
(387, 2, 'Data Pembayaran berhasil dihapus semua', '::1', '2025-06-11 10:23:27'),
(388, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 10:23:37'),
(389, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:24:10'),
(390, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:49:02'),
(391, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:49:33'),
(392, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:52:51'),
(393, 2, 'Mengakses Data Pembayaran', '::1', '2025-06-11 10:54:45'),
(394, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 10:55:19'),
(395, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 10:56:52'),
(396, 2, 'Mengakses Data Pembayaran yang dihapus', '::1', '2025-06-11 12:04:23'),
(397, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-11 13:13:09'),
(398, 2, 'Logout dari Sistem', '::1', '2025-06-11 13:13:30'),
(399, 1, 'Login ke dalam Sistem', '::1', '2025-06-11 13:18:03'),
(400, 1, 'Mengakses Halaman Dashboard', '::1', '2025-06-11 13:18:16'),
(401, 1, 'Logout dari Sistem', '::1', '2025-06-11 13:19:37'),
(402, 1, 'Login ke dalam Sistem', '::1', '2025-06-11 13:24:26'),
(403, 1, 'Mengakses Halaman Dashboard', '::1', '2025-06-11 13:24:35'),
(404, 1, 'Mengakses Data User', '::1', '2025-06-11 13:25:26'),
(405, 1, 'Mengakses Data User', '::1', '2025-06-11 13:25:55'),
(406, 1, 'Mengakses Data Pasien', '::1', '2025-06-11 13:26:19'),
(407, 1, 'Mengakses form tambah Data Pasien', '::1', '2025-06-11 13:26:51'),
(408, 1, 'Data Pasien berhasil ditambahkan', '::1', '2025-06-11 13:27:38'),
(409, 1, 'Mengakses Data Pasien', '::1', '2025-06-11 13:27:51'),
(410, 1, 'Mengakses form edit Data Pasien', '::1', '2025-06-11 13:28:24'),
(411, 1, 'Data Pasien berhasil diperbarui', '::1', '2025-06-11 13:29:04'),
(412, 1, 'Mengakses Data Pasien', '::1', '2025-06-11 13:29:17'),
(413, 1, 'Data Pasien berhasil dihapus', '::1', '2025-06-11 13:29:50'),
(414, 1, 'Mengakses Data Pasien', '::1', '2025-06-11 13:30:01'),
(415, 1, 'Mengakses Data Dokter', '::1', '2025-06-11 13:30:31'),
(416, 1, 'Mengakses form tambah Data Dokter', '::1', '2025-06-11 13:31:04'),
(417, 1, 'Mengakses Data Dokter', '::1', '2025-06-11 13:31:35'),
(418, 1, 'Mengakses Data Layanan', '::1', '2025-06-11 13:32:00'),
(419, 1, 'Mengakses Data Produk', '::1', '2025-06-11 13:32:50'),
(420, 1, 'Mengakses Data Booking', '::1', '2025-06-11 13:33:59'),
(421, 1, 'Mengakses Data Penjualan Produk', '::1', '2025-06-11 13:34:54'),
(422, 1, 'Mengakses Data Pembayaran', '::1', '2025-06-11 13:35:39'),
(423, 1, 'Mengakses Peraturan', '::1', '2025-06-11 13:36:14'),
(424, 1, 'Mengakses Peraturan', '::1', '2025-06-11 13:36:45'),
(425, 1, 'Peraturan berhasil diperbarui', '::1', '2025-06-11 13:37:37'),
(426, 1, 'Mengakses Peraturan', '::1', '2025-06-11 13:37:49'),
(427, 1, 'Peraturan berhasil diperbarui', '::1', '2025-06-11 13:38:25'),
(428, 1, 'Mengakses Peraturan', '::1', '2025-06-11 13:38:36'),
(429, 1, 'Logout dari Sistem', '::1', '2025-06-11 13:39:09'),
(430, 2, 'Login ke dalam Sistem', '::1', '2025-06-11 13:39:55'),
(431, 2, 'Mengakses Halaman Dashboard', '::1', '2025-06-11 13:40:08'),
(432, 2, 'Mengakses Data Pasien', '::1', '2025-06-11 13:40:45'),
(433, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-11 13:41:15'),
(434, 2, 'Data Pasien berhasil dipulihkan', '::1', '2025-06-11 13:41:50'),
(435, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-11 13:42:02'),
(436, 2, 'Mengakses Data Pasien', '::1', '2025-06-11 13:42:35'),
(437, 2, 'Data Pasien berhasil dihapus', '::1', '2025-06-11 13:43:04'),
(438, 2, 'Mengakses Data Pasien', '::1', '2025-06-11 13:43:16'),
(439, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-11 13:43:44'),
(440, 2, 'Data Pasien berhasil dihapus secara permanen', '::1', '2025-06-11 13:44:20'),
(441, 2, 'Mengakses Data Pasien yang dihapus', '::1', '2025-06-11 13:44:33'),
(442, 2, 'Mengakses Data Pasien', '::1', '2025-06-11 13:45:03'),
(443, 2, 'Mengakses Log Activity', '::1', '2025-06-11 13:45:36'),
(444, 2, 'Mengakses Log Activity', '::1', '2025-06-11 13:46:27'),
(445, 2, 'Logout dari Sistem', '::1', '2025-06-11 13:47:23'),
(446, 3, 'Login ke dalam Sistem', '::1', '2025-06-11 13:48:15'),
(447, 3, 'Mengakses Halaman Dashboard', '::1', '2025-06-11 13:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Perempuan','Laki-Laki') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `id_user`, `nama_pasien`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_hp`, `tanggal_daftar`, `status`, `in_trash`) VALUES
(4, 2, 'Karina', 'Perempuan', '2025-06-09', 'Jln. Situ', '081234567890', '2025-06-09', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `metode_pembayaran` enum('Cash','Transfer','E-Wallet','Kartu Kredit') NOT NULL,
  `jumlah_bayar` varchar(50) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `status_pembayaran` enum('Lunas','Belum Lunas','Dibatalkan') NOT NULL,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `metode_pembayaran`, `jumlah_bayar`, `tanggal_bayar`, `status_pembayaran`, `in_trash`) VALUES
(1, 3, 'E-Wallet', 'Rp 500.000.000,00', '2025-06-13', 'Belum Lunas', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_produk`
--

CREATE TABLE `penjualan_produk` (
  `id_penjualan` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `total_harga` varchar(50) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan_produk`
--

INSERT INTO `penjualan_produk` (`id_penjualan`, `id_pasien`, `id_produk`, `jumlah`, `total_harga`, `tanggal_pembayaran`, `in_trash`) VALUES
(4, 4, 2, '1', 'Rp 95.000,00', '2025-05-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `deskripsi`, `harga`, `stok`, `status`, `in_trash`) VALUES
(1, 'Serum Vitamin C', 'Serum pencerah wajah dengan antioksidan tinggi', 'Rp 120.000', '25', 0, 0),
(2, 'Sunscreen SPF 50+', 'Tabir surya melindungi kulit dari sinar UVA & UVB', 'Rp 95.000', '40', 0, 0),
(3, 'Facial Wash Herbal', 'Sabun wajah dengan bahan alami, cocok untuk semua jenis kulit', 'Rp 65.000', '100', 0, 0),
(4, 'Night Cream Whitening', 'Krim malam untuk mencerahkan dan melembabkan kulit', 'Rp 110.000', '30', 0, 0),
(5, 'Moisturizer Aloe Vera', 'Pelembab dengan kandungan aloe vera menenangkan kulit', 'Rp 85.000', '20', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_description` text DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_description`, `site_logo`, `created_at`, `updated_at`) VALUES
(1, 'Beauty Clinic', 'dufubvuvbffvb', 'logo_1749674305.png', '2025-05-05 00:46:33', '2025-06-12 03:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `level` enum('1','2','3','4','5') NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `in_trash` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `username`, `password`, `level`, `status`, `in_trash`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin@', '$2y$10$H1P2guOWwWPQB3j0.YefI.cQ96..UxxYfV6jiLNZtdo1Gwsf/Rvnq', '1', 1, 0),
(2, 'Super Admin', 'super@gmail.com', 'superadmin@', '$2y$10$H1P2guOWwWPQB3j0.YefI.cQ96..UxxYfV6jiLNZtdo1Gwsf/Rvnq', '2', 1, 0),
(3, 'Petugas', 'petugas@gmail.com', 'petugas@', '$2y$10$H1P2guOWwWPQB3j0.YefI.cQ96..UxxYfV6jiLNZtdo1Gwsf/Rvnq', '3', 1, 0),
(6, 'dr. Mei Lestari', 'mei@gmail.com', 'mei@', '$2y$10$H1P2guOWwWPQB3j0.YefI.cQ96..UxxYfV6jiLNZtdo1Gwsf/Rvnq', '4', 1, 0),
(7, 'dr. Rani Utami', 'rani@gmail.com', 'rani@', '$2y$10$H1P2guOWwWPQB3j0.YefI.cQ96..UxxYfV6jiLNZtdo1Gwsf/Rvnq', '4', 1, 0),
(8, 'dr. Sinta Wibowo	', 'sinta@gmail.com', 'sinta@', '$2y$10$H1P2guOWwWPQB3j0.YefI.cQ96..UxxYfV6jiLNZtdo1Gwsf/Rvnq', '4', 1, 0),
(10, 'Hana Wulan Agusta', 'arekcreativeteknologi@gmail.com', 'hanawulan', '$2y$10$H1P2guOWwWPQB3j0.YefI.cQ96..UxxYfV6jiLNZtdo1Gwsf/Rvnq', '2', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
