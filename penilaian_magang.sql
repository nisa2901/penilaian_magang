-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2026 pada 09.01
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian_magang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bu_yuni`
--

CREATE TABLE `bu_yuni` (
  `id` int(11) NOT NULL,
  `data_magang_id` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `angkatan` varchar(20) DEFAULT NULL,
  `email_pribadi` varchar(255) DEFAULT NULL,
  `email_sekolah` varchar(100) DEFAULT NULL,
  `sekolah` varchar(100) DEFAULT NULL,
  `dokumen_penilaian` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_dinilai` date DEFAULT NULL,
  `unit_penempatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bu_yuni`
--

INSERT INTO `bu_yuni` (`id`, `data_magang_id`, `nama_lengkap`, `angkatan`, `email_pribadi`, `email_sekolah`, `sekolah`, `dokumen_penilaian`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `tanggal_dinilai`, `unit_penempatan`) VALUES
(67, 434, 'adelia12', '20261', 'erdhienbijerr@gmail.com', 'erdhienbjerr@gmail.com', 'smk 1 sleman', 'penilaian_434_1779086426.pdf', '2026-04-28', '2026-05-29', '2026-05-18 06:53:28', '2026-05-18', 'ARSIPARIS'),
(68, 440, 'nona1', '2026', 'rahmaptrisya@gmail.com', 'rahmaputririnasya@students.amikom.ac.id', 'sma sleman', 'Fakhrunnisa_Fadia_Faida.pdf', '2026-04-01', '2026-05-30', '2026-05-18 06:51:21', '2026-04-28', 'ARSIPARIS'),
(69, 473, 'ujang1', '20231', 'lutfiabaik@gmail.com', 'lutfiabaik@gmail.com', 'smk 1 seyegan1', NULL, '2026-04-29', '2026-04-30', '2026-04-30 10:30:00', NULL, 'SEKRETARIAT'),
(71, 434, 'adelia12', '20261', 'erdhienbijerr@gmail.com', 'erdhienbjerr@gmail.com', 'smk 1 sleman', 'penilaian_434_1779086426.pdf', '2026-04-28', '2026-05-29', '2026-05-18 06:53:28', '2026-05-18', 'ARSIPARIS'),
(74, 440, 'nona', '2026', 'rahmaptrisya@gmail.com', 'rahmaputririnasya@students.amikom.ac.id', 'sma sleman', 'Fakhrunnisa_Fadia_Faida.pdf', '2026-04-01', '2026-05-30', '2026-04-28 09:07:45', '2026-04-28', 'ARSIPARIS'),
(84, 473, 'ujang1', '20231', 'lutfiabaik@gmail.com', 'rizkifajri@gmail.com', 'smk 1 seyegan1', NULL, '2026-04-29', '2026-04-30', '2026-04-30 10:30:00', '2026-04-30', 'SEKRETARIAT'),
(102, 486, 'aaa', '2025', 'arya@gmail.com', 'ww@gmai.com', 'smk 1 seyegan', 'KRS_Erdhien.pdf', '2026-04-29', '2026-04-30', '2026-05-03 08:16:52', '2026-05-03', 'ARSIPARIS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_magang`
--

CREATE TABLE `data_magang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `angkatan` varchar(20) DEFAULT NULL,
  `email_pribadi` varchar(255) DEFAULT NULL,
  `email_sekolah` varchar(100) DEFAULT NULL,
  `sekolah` varchar(100) DEFAULT NULL,
  `universitas` varchar(100) DEFAULT NULL,
  `email_universitas` varchar(100) DEFAULT NULL,
  `dokumen_pendaftaran` varchar(255) DEFAULT NULL,
  `dokumen_penilaian` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_dinilai` date DEFAULT NULL,
  `unit_penempatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_magang`
--

INSERT INTO `data_magang` (`id`, `user_id`, `nama_lengkap`, `angkatan`, `email_pribadi`, `email_sekolah`, `sekolah`, `universitas`, `email_universitas`, `dokumen_pendaftaran`, `dokumen_penilaian`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `tanggal_dinilai`, `unit_penempatan`) VALUES
(434, 112, 'adelia12', '20261', 'erdhienbijerr@gmail.com', 'erdhienbjerr@gmail.com', 'smk 1 sleman', NULL, NULL, '63531_logbook_6dbd0e2a7b249584564d751176b9d5a02f65da6ee8ed4424f82d506fd8e35bce3.pdf', 'penilaian_434_1779086426.pdf', '2026-04-28', '2026-05-29', '2026-04-28 07:32:20', '2026-05-18', 'ARSIPARIS'),
(437, 113, 'juanda', '2026', 'erdhienbijerr@gmail.com', NULL, NULL, 'Universitas Amikom Yogyakarta', 'erdhienbijerr@gmail.com', '63531_logbook_6dbd0e2a7b249584564d751176b9d5a02f65da6ee8ed4424f82d506fd8e35bce6.pdf', 'Balasan_SIP.pdf', '2026-04-28', '2026-06-26', '2026-04-28 07:33:59', '2026-04-28', 'SEKRETARIAT'),
(440, 114, 'nona1', '2026', 'rahmaptrisya@gmail.com', 'rahmaputririnasya@students.amikom.ac.id', 'sma sleman', NULL, '', 'KHS7.pdf', 'Fakhrunnisa_Fadia_Faida.pdf', '2026-04-01', '2026-05-30', '2026-04-28 09:07:45', '2026-04-28', 'ARSIPARIS'),
(467, 123, 'lama', '2026', 'rahmaptrisya@gmail.com', '', '', 'Universitas Amikom Yogyakarta', 'rahmaputririnasya@students.amikom.ac.id', 'KHS10.pdf', NULL, '2026-04-28', '2026-05-29', '2026-04-28 12:48:23', NULL, 'RENKEU'),
(470, 124, 'alfamart', '2026', 'lutfiabaik@gmail.com', '', '', 'uny', 'rahmaputririnasya@students.amikom.ac.id', 'KHS11.pdf', 'Fakhrunnisa_Fadia_Faida.pdf', '2026-04-28', '2026-05-28', '2026-04-28 13:01:32', '2026-04-28', 'ARSIPARIS'),
(473, 125, 'ujang1', '20231', 'lutfiabaik@gmail.com', 'rizkifajri@gmail.com', 'smk 1 seyegan1', NULL, '', 'KRS_Erdhien.pdf', NULL, '2026-04-29', '2026-04-30', '2026-04-30 10:30:00', '2026-04-30', 'SEKRETARIAT'),
(476, 126, 'yuda', '2023', 'nizartharegi@gmail.com', '', '', 'amikom ', 'rizkifajri@gmail.com', 'KRS_Erdhien.pdf', NULL, '2026-04-29', '2026-04-30', '2026-04-30 10:57:41', NULL, 'ARSIPARIS'),
(485, 129, 'fafa1', '20251', 'erdhien@students.amikom.ac.id', NULL, NULL, 'amikom1', 'erdhien@students.amikom.ac.id', 'KRS_Erdhien1.pdf', 'KRS_Erdhien.pdf', '2026-04-29', '2026-04-30', '2026-05-02 08:11:04', '2026-05-02', 'ARSIPARIS'),
(486, 130, 'aaa', '2025', 'arya@gmail.com', 'ww@gmai.com', 'smk 1 seyegan', NULL, '', NULL, 'KRS_Erdhien.pdf', '2026-04-29', '2026-04-30', '2026-05-02 08:13:41', '2026-05-02', 'ARSIPARIS'),
(487, 131, 'GG', '2025', 'nizartharegi@gmail.com', '', '', 'amikom ', 'luuu@gmail.com', NULL, NULL, '2026-05-02', '2026-05-02', '2026-05-02 08:48:43', NULL, 'SEKRETARIAT'),
(488, 132, 'Febri Hari', '2025', 'lutfiabaik@gmail.com', NULL, NULL, 'amikom ', 'lutfiabaik@gmail.com', NULL, 'penilaian_488_1777790334.pdf', '2026-05-02', '2026-05-02', '2026-05-03 06:04:50', '2026-05-03', 'SEKRETARIAT'),
(489, 133, 'qalwa1', '20271', 'rizkifajri323@gmail.com', '', NULL, 'Universitas Amikom a', 'rizkifajri323@gmail.com', 'Desain_tanpa_judul.pdf', 'laprak2_5083.pdf', '2026-05-18', '2026-05-22', '2026-05-18 06:43:33', '2026-05-18', 'DAFDUK');

--
-- Trigger `data_magang`
--
DELIMITER $$
CREATE TRIGGER `trg_user_to_data_magang` BEFORE INSERT ON `data_magang` FOR EACH ROW BEGIN
    SET NEW.email_pribadi = (
        SELECT email_pribadi 
        FROM users 
        WHERE id = NEW.user_id
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `logbook`
--

CREATE TABLE `logbook` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak') DEFAULT 'menunggu',
  `data_magang_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `logbook`
--

INSERT INTO `logbook` (`id`, `tanggal`, `kegiatan`, `deskripsi`, `status`, `data_magang_id`) VALUES
(47, '2026-04-30', 'merekap ', 'merekap dokumen akta', 'disetujui', 470),
(48, '2026-05-02', 'AAA', 'AAAA', 'menunggu', 487),
(49, '2026-05-05', 'ss', 'ssss', 'menunggu', 488),
(50, '2026-05-06', 'aa', 'aaaa', 'ditolak', 488),
(51, '2026-05-18', 'q', 'qq', 'menunggu', 489);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pak_hani`
--

CREATE TABLE `pak_hani` (
  `id` int(11) NOT NULL,
  `data_magang_id` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `angkatan` varchar(20) DEFAULT NULL,
  `email_pribadi` varchar(255) DEFAULT NULL,
  `email_universitas` varchar(100) DEFAULT NULL,
  `universitas` varchar(100) DEFAULT NULL,
  `dokumen_penilaian` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_dinilai` date DEFAULT NULL,
  `unit_penempatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pak_hani`
--

INSERT INTO `pak_hani` (`id`, `data_magang_id`, `nama_lengkap`, `angkatan`, `email_pribadi`, `email_universitas`, `universitas`, `dokumen_penilaian`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `tanggal_dinilai`, `unit_penempatan`) VALUES
(119, 467, 'lama', '2026', 'rahmaptrisya@gmail.com', 'rahmaputririnasya@students.amikom.ac.id', 'Universitas Amikom Yogyakarta', NULL, '2026-04-28', '2026-05-29', '2026-04-28 12:48:23', NULL, 'RENKEU'),
(120, 470, 'alfamart', '2026', 'lutfiabaik@gmail.com', 'rahmaputririnasya@students.amikom.ac.id', 'uny', 'Fakhrunnisa_Fadia_Faida.pdf', '2026-04-28', '2026-05-28', '2026-05-03 05:56:47', '2026-05-03', 'ARSIPARIS'),
(121, 476, 'yuda', '2023', 'nizartharegi@gmail.com', 'rizkifajri@gmail.com', 'amikom ', NULL, '2026-04-29', '2026-04-30', '2026-04-30 10:57:41', NULL, 'ARSIPARIS'),
(123, 437, 'juanda', '2026', 'erdhienbijerr@gmail.com', 'erdhienbijerr@gmail.com', 'Universitas Amikom Yogyakarta', 'Balasan_SIP.pdf', '2026-04-28', '2026-06-26', '2026-04-28 07:33:59', '2026-04-28', 'SEKRETARIAT'),
(140, 467, 'lama', '2026', 'rahmaptrisya@gmail.com', 'rahmaputririnasya@students.amikom.ac.id', 'Universitas Amikom Yogyakarta', NULL, '2026-04-28', '2026-05-29', '2026-04-28 12:48:23', NULL, 'RENKEU'),
(143, 470, 'alfamart', '2026', 'lutfiabaik@gmail.com', 'rahmaputririnasya@students.amikom.ac.id', 'uny', 'Fakhrunnisa_Fadia_Faida.pdf', '2026-04-28', '2026-05-28', '2026-04-28 13:01:32', '2026-04-28', 'ARSIPARIS'),
(146, 476, 'yuda', '2023', 'nizartharegi@gmail.com', 'rizkifajri@gmail.com', 'amikom ', NULL, '2026-04-29', '2026-04-30', '2026-04-30 10:57:41', NULL, 'ARSIPARIS'),
(154, 485, 'fafa1', '20251', 'erdhien@students.amikom.ac.id', 'erdhien@students.amikom.ac.id', 'amikom1', 'KRS_Erdhien.pdf', '2026-04-29', '2026-04-30', '2026-05-18 06:41:37', '2026-05-09', 'ARSIPARIS'),
(155, 487, 'GG', '2025', NULL, 'luuu@gmail.com', 'amikom ', NULL, '2026-05-02', '2026-05-02', '2026-05-02 08:48:43', NULL, 'SEKRETARIAT'),
(156, 488, 'Febri Hari', '2025', 'lutfiabaik@gmail.com', 'lutfiabaik@gmail.com', 'amikom ', 'penilaian_488_1777790334.pdf', '2026-05-02', '2026-05-02', '2026-05-09 07:07:12', '2026-05-09', 'SEKRETARIAT'),
(157, 489, 'qalwa1', '20271', 'rizkifajri323@gmail.com', 'rizkifajri323@gmail.com', 'Universitas Amikom a', 'laprak2_5083.pdf', '2026-05-18', '2026-05-22', '2026-05-18 06:48:16', '2026-05-18', 'DAFDUK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `magang_id` int(11) NOT NULL,
  `disiplin` int(11) DEFAULT NULL,
  `kehadiran` int(11) DEFAULT NULL,
  `tanggung_jawab` int(11) DEFAULT NULL,
  `kejujuran` int(11) DEFAULT NULL,
  `kerjasama_tim` int(11) DEFAULT NULL,
  `inisiatif` int(11) DEFAULT NULL,
  `kerapihan_kerja` int(11) DEFAULT NULL,
  `kemampuan_tugas` int(11) DEFAULT NULL,
  `penguasaan_skill` int(11) DEFAULT NULL,
  `komunikasi` int(11) DEFAULT NULL,
  `catatan_pembimbing` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id`, `magang_id`, `disiplin`, `kehadiran`, `tanggung_jawab`, `kejujuran`, `kerjasama_tim`, `inisiatif`, `kerapihan_kerja`, `kemampuan_tugas`, `penguasaan_skill`, `komunikasi`, `catatan_pembimbing`, `created_at`, `updated_at`) VALUES
(16, 437, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 'ok', '2026-04-28 08:06:15', '2026-04-28 08:06:15'),
(17, 434, 100, 88, 89, 78, 98, 87, 89, 88, 98, 87, 'bgs', '2026-04-28 08:25:50', '2026-04-28 08:25:50'),
(18, 488, 22, 22, 22, 22, 23, 22, 22, 22, 22, 22, 'ggg', '2026-05-03 06:38:32', '2026-05-03 06:38:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_pribadi` varchar(100) DEFAULT NULL,
  `instansi` varchar(150) DEFAULT NULL,
  `role` enum('admin','participant') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email_pribadi`, `instansi`, `role`, `created_at`) VALUES
(4, 'admin', 'admin123', 'admin@email.com', NULL, 'admin', '2025-12-15 07:57:23'),
(96, 'lutfia', '$2y$10$trP5hPJWCWvEhBG/x8Auq.9hRyvH.IkJ.YEJ2FodzlsdjqVaxF0cy', 'lutfiabaik@gmail.com', NULL, 'participant', '2026-04-26 07:31:22'),
(97, 'rahma', '$2y$10$Rr9Hl2MvgGxZRK1tx26sEukLyzLlaPxaepLAMsB0jkxUmeSHbkRWm', 'rahmaptrisya@gmail.com', NULL, 'participant', '2026-04-26 07:33:07'),
(98, 'arab', '$2y$10$aiD6R7/.jZnKLAognmhQIOyeO6Fx.nWTLVbiyVq0t2sZ8IW0OTye2', 'arab01@gmail.com', NULL, 'participant', '2026-04-26 08:11:03'),
(99, 'ida', '$2y$10$rCTMyBU3CWTNK868rbnoVOKHVAauusIHIUt5s5zlqtcCXSjVyE9Ri', 'lutfiabaik@gmail.com', NULL, 'participant', '2026-04-26 08:14:33'),
(103, 'asta', '$2y$10$0Ca1NqPPUhf81pV2k7GWpOkmv0bHZbg54WhtsF814gyxCuGIo.Pti', 'asta@gmail.com', NULL, 'participant', '2026-04-28 05:48:02'),
(104, 'inah', '$2y$10$x07SVjFvVMeLB9XMigSx8.njb6vh1T8DKxfuz7wYHDjo8PkTPHPT.', 'inah@gmail.com', NULL, 'participant', '2026-04-28 06:02:45'),
(105, 'iyup', '$2y$10$1NMuRdcEICW/nK.ciTAG0O3ozoDquEzqlEXIJ0yvSjplY/Qpg1rDS', 'iyup@gmail.com', NULL, 'participant', '2026-04-28 06:17:39'),
(106, 'ita', '$2y$10$j3l9arXeCFUxnrS8TTuXxezwc526WRsjUCxEdxL2GBbsN4B/EyQI.', 'ita@gmail.com', NULL, 'participant', '2026-04-28 06:21:05'),
(107, 'juna', '$2y$10$Zz17IMUoh1/e1sAyN9fvBuRLNo3aCyW5WZPmmfZE.xvrDVESGv6xm', 'juna@gmail.com', NULL, 'participant', '2026-04-28 06:37:18'),
(108, 'ika', '$2y$10$jnEdwjB.2AQQZp244iPd8OzDlqlfVBoU0XQeWQDecBrAH7rWkMCr.', 'ika@gmail.com', NULL, 'participant', '2026-04-28 06:39:28'),
(109, 'terserah', '$2y$10$PWMIfhjJVYNCXgHU1Zy0z.Jkrsf/V3rL/YHo8HB6fDbIXThILzVIe', 'terserah@gmail.com', NULL, 'participant', '2026-04-28 06:54:29'),
(110, 'hani', '$2y$10$LdsR/0uOIEPEc1Nz9p7FcOIDnl2NFItL/fnjPY2.Nu8n.wme4zAPW', 'hani@gmail.com', NULL, 'participant', '2026-04-28 07:03:41'),
(111, 'yuni', '$2y$10$WY0qsoN4up2kmUGiWh.38u3ePGUFdRfkd1X21HnITLU7Q6qfzBW32', 'yuni@gmail.com', NULL, 'participant', '2026-04-28 07:05:26'),
(112, 'adel', '$2y$10$j04wgqnZko.OBefBaYMD8O41R23B0olDfxgtEFetmWE5hdIQPbItS', 'erdhienbijerr@gmail.com', NULL, 'participant', '2026-04-28 07:32:20'),
(113, 'juan', '$2y$10$cvP3Wy/TJ/a2wdWpeaOThuhY0mGYkeItrchJv9X94lqNdnXlkQU1.', 'erdhienbijerr@gmail.com', NULL, 'participant', '2026-04-28 07:33:59'),
(114, 'no', '$2y$10$Wuy/UrK862FszuWyjcfgSOyZVRyhmtGAGRPyCFOttuaN5aFIqHnpe', 'rahmaptrisya@gmail.com', NULL, 'participant', '2026-04-28 09:07:45'),
(115, 'iw', '$2y$10$6n/d1hAPfD3OOAqm4gwaxOQyRFYi7VhrkO9r5XPuI1.KVvBFPO5H.', 'rahmaptrisya@gmail.com', NULL, 'participant', '2026-04-28 11:03:06'),
(116, 'uma', '$2y$10$tpdY.QAwmDorHoggmZGpjeGNVZduMvq3GYVbbaoGETnJw2Y/yk3F6', 'rahmaptrisya@gmail.com', 'amikom', 'participant', '2026-04-28 11:10:47'),
(117, 'yaya', '$2y$10$aFDqOfbMGZmXmCzvglDzLe81ahWujKA9xKNybmG2.FIM6wuBKe5MC', 'rahmaptrisya@gmail.com', 'uny', 'participant', '2026-04-28 11:47:26'),
(118, 'aw', '$2y$10$JsnYcATE2Y/gkmmnKsKEh.iJM/Vl8Dc5FC7n2lBzcWNarFKUUCk3K', 'rahmaptrisya@gmail.com', 'amikom', 'participant', '2026-04-28 12:03:48'),
(119, 'lp', '$2y$10$H.1w4bMxK2wJOzdV7QWXDOHFJnvGJOVMcP79cOyt.hsAYq8FwjzLK', 'rahmaptrisya@gmail.com', 'uny', 'participant', '2026-04-28 12:11:10'),
(120, 'nana', '$2y$10$pVmgjCSg5q5Ka3IR8Ydf2Oko5jHHN8.1LQLrH29OO2UpU/WTEKCu.', 'rahmaptrisya@gmail.com', 'amikom', 'participant', '2026-04-28 12:26:50'),
(121, 'indah', '$2y$10$tcnCgSt67hLVscfyTLB2dusx3fkuf9g.8bKLchqTGvgpvgmz.HaH6', 'rahmaptrisya@gmail.com', 'amikom', 'participant', '2026-04-28 12:31:07'),
(122, 'ama', '$2y$10$.TQGdLebOwSaUdoPUBdGSeprUiDj2Qe3C5l9pkUXx9nC6iPkV7402', 'lutfiabaik@gmail.com', 'amikom', 'participant', '2026-04-28 12:48:04'),
(123, 'la', '$2y$10$pGynWmsLz0jzX2GyulYF8.FZKMAbVwTfvmWUWNzjQCCbNXEocoPzO', 'rahmaptrisya@gmail.com', 'amikom', 'participant', '2026-04-28 12:48:23'),
(124, 'alfa', '$2y$10$6Sd6aLfYqp2oIxV0twBDb.eDRM5/VVWZS31G8iOA8gY7Aiuoq63CS', 'lutfiabaik@gmail.com', 'uny', 'participant', '2026-04-28 13:01:32'),
(125, 'w', '$2y$10$S9O6e2OJdbDmPlj8qpZtpOBz2VUVTimPM7ObVpoS70tFgsQMTUoha', 'lutfiabaik@gmail.com', 'smk 1 seyegan', 'participant', '2026-04-30 10:30:00'),
(126, 'y', '$2y$10$V6CjKfs21Uq5HyFJllckr.7Ge3W6z6/IaEJ1e2e4Cx3i8Fznwt1RG', 'nizartharegi@gmail.com', NULL, 'participant', '2026-04-30 10:57:41'),
(127, 't', '$2y$10$pqW1W0WP5QXagkdPx8no8OFtXAF6oC9le931pfYUJQVyDFXcVzily', 'www@gmail.com', 'amikom', 'participant', '2026-04-30 11:03:47'),
(128, 'm', '$2y$10$mLQyueqYbw1BADIG7N487ehroM1OiBglpEhCNTG7HraD41zvmHZq.', 'erdhien@students.amikom.ac.id', 'smk 1 seyegan', 'participant', '2026-04-30 11:04:16'),
(129, 'f', '$2y$10$sSRX.GY1l76sBN4BQ5BCrOeS2nUNjILduWXFlolQLyT73jJSjK5au', 'erdhien@students.amikom.ac.id', 'amikom ', 'participant', '2026-05-02 08:11:04'),
(130, 'a', '$2y$10$f6oXZa/UqIjQWW/yLgTHNODOYHZQNremfdrtMe148FUtrRvf50/IW', 'arya@gmail.com', 'smk 1 seyegan', 'participant', '2026-05-02 08:13:41'),
(131, 'i', '$2y$10$EEAhxQvosj3f6ylgmEVyo.6JxeNn1CS69kVX7Qb.MvPr50ZhI2zfS', 'nizartharegi@gmail.com', 'amikom ', 'participant', '2026-05-02 08:48:43'),
(132, 'febri', '$2y$10$tafQ9qrYPhdhxSRJGVkl3.KLidKVWloaKufVOXtE/qAMRynEwn53a', 'lutfiabaik@gmail.com', 'amikom ', 'participant', '2026-05-03 06:04:50'),
(133, 'q', '$2y$10$/d0UdaXs8bF.SYQ/uZjED.AdcpOEV3eYF3oeU4j5FDaOX43wL4s.u', 'rizkifajri323@gmail.com', 'universitas amikom', 'participant', '2026-05-18 06:43:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bu_yuni`
--
ALTER TABLE `bu_yuni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bu_yuni_data_magang` (`data_magang_id`);

--
-- Indeks untuk tabel `data_magang`
--
ALTER TABLE `data_magang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_data_magang_user` (`user_id`);

--
-- Indeks untuk tabel `logbook`
--
ALTER TABLE `logbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_logbook_data_magang` (`data_magang_id`);

--
-- Indeks untuk tabel `pak_hani`
--
ALTER TABLE `pak_hani`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pak_hani_data_magang` (`data_magang_id`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penilaian_data_magang` (`magang_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bu_yuni`
--
ALTER TABLE `bu_yuni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `data_magang`
--
ALTER TABLE `data_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=490;

--
-- AUTO_INCREMENT untuk tabel `logbook`
--
ALTER TABLE `logbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `pak_hani`
--
ALTER TABLE `pak_hani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bu_yuni`
--
ALTER TABLE `bu_yuni`
  ADD CONSTRAINT `fk_bu_yuni_data_magang` FOREIGN KEY (`data_magang_id`) REFERENCES `data_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_magang`
--
ALTER TABLE `data_magang`
  ADD CONSTRAINT `fk_data_magang_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `logbook`
--
ALTER TABLE `logbook`
  ADD CONSTRAINT `fk_logbook_data_magang` FOREIGN KEY (`data_magang_id`) REFERENCES `data_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pak_hani`
--
ALTER TABLE `pak_hani`
  ADD CONSTRAINT `fk_pak_hani_data_magang` FOREIGN KEY (`data_magang_id`) REFERENCES `data_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_penilaian_data_magang` FOREIGN KEY (`magang_id`) REFERENCES `data_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
