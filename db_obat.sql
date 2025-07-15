-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8877
-- Waktu pembuatan: 15 Jul 2025 pada 03.32
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
-- Database: `db_obat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `harga` double NOT NULL,
  `tanggal_kadaluwarsa` date DEFAULT NULL,
  `tahun_produksi` year(4) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kode_obat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `harga`, `tanggal_kadaluwarsa`, `tahun_produksi`, `deskripsi`, `kode_obat`) VALUES
(1, 'Paramex', 8, '2026-12-31', '2023', 'Obat sakit kepala dan flu ringan.', 'OBT001'),
(2, 'Bodrex', 7500, '2025-10-15', '2022', 'Pereda demam dan nyeri otot.', 'OBT002'),
(4, 'Vitamin C 1000mg', 12000, '2026-05-10', '2023', 'Suplemen daya tahan tubuh.', 'OBT004'),
(6, 'Sanmol', 6500, '2026-11-11', '2023', 'Obat penurun panas.', 'OBT006'),
(7, 'Woods Cough Syrup', 9000, '2026-02-28', '2023', 'Obat batuk kering dan berdahak.', 'OBT007'),
(8, 'Promag', 5500, '2027-07-01', '2024', 'Obat maag dan mual.', 'OBT008'),
(10, 'Decolgen', 10000, '2025-12-31', '2022', 'Obat flu dan hidung tersumbat.', 'OBT010'),
(22, '5456', 12, '2025-07-14', '0000', 'wehoiweh', 'qede32'),
(23, 'jhgfyg', 1233, '2025-07-14', '0000', 'yctcx', '67ff'),
(24, 'rrrr', 12, '2025-07-14', '0000', 'hfyi', '7tfy'),
(25, 'hfeiug', 12, '2025-07-14', '2023', 'agdfuiegw', '2893y4g');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
