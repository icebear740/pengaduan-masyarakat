-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2023 pada 03.01
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masyarakat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(5) NOT NULL,
  `tgl_pengaduan` varchar(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('belum proses','proses','selesai') NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `fullname`, `isi_laporan`, `foto`, `status`, `userid`) VALUES
(198, '2023-06-21', 'Reival', 'Banjir karena banyak sampah di daerah kami', 'gambar.jpg', 'selesai', 19),
(199, '2023-06-21', 'Reival', 'Test', 'noImage.png', 'proses', 5),
(202, '2023-06-21', 'Sanda', 'Bukit Longsor', 'img.jpg', 'proses', 19),
(214, '2023-06-22', 'Reival', 'Banjir', 'noImage.png', 'belum proses', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `telp_petugas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`userid`, `username`, `password`, `level`, `fullname`, `telp_petugas`) VALUES
(5, 'Deni', '$2y$10$b/WdCokglSOr5kESzPhZj.K6XvjDlXn9MIzlT/lnP4yTLTgzYAItm', 'Admin', 'Deni Purwanto', '08912938712984'),
(17, 'Reival', '$2y$10$9XxEBI8EOag5Vk327R8BCu4zebH6FiX6A9j7mnYN9kSgUS5qxAg6G', 'Masyarakat', 'Reival', '08912039812093'),
(18, 'Sanda', '$2y$10$uYAYhF8LMLBBFkgPRtLmDuw6Rm5VjD2EYkQXE2JJn7yPu5xW3JTby', 'Masyarakat', 'Sanda', '0891928372198'),
(19, 'Anisa', '$2y$10$pXE4.waq/mNALCpXTddK7ez9lDGNu3bCxSm6oGkBf5Uq8BE7Y4M8u', 'Admin', 'Anisa', '08618273218');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(5) NOT NULL,
  `id_pengaduan` int(5) NOT NULL,
  `tgl_tanggapan` varchar(20) NOT NULL,
  `tanggapan` text NOT NULL,
  `foto_tanggapan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `foto_tanggapan`) VALUES
(175, 197, '2023-06-21', 'Jalan Sedang diperbaiki', 'Screenshot_2023-06-21_101703.png'),
(176, 198, '2023-06-21', 'Sudah selesai diperbaiki', 'gambar9.jpg'),
(179, 202, '2023-06-21', 'Akan segera kami perbaiki', 'Screenshot_2023-06-21_140226.png'),
(188, 199, '2023-06-22', 'test1', 'jalan_rusak2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`userid`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
