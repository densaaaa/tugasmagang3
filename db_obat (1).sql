-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8877
-- Waktu pembuatan: 15 Jul 2025 pada 08.23
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
-- Struktur dari tabel `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_obat`
--

INSERT INTO `kategori_obat` (`id_kategori`, `nama_kategori`, `kode_kategori`, `status`) VALUES
(1, 'keras', '21e2r', 'aktif'),
(3, 'bebas', '23dyd', 'aktif'),
(4, 'bebas terbatas', '34hvr', 'aktif'),
(5, 'narkotika', '32ygr', 'aktif'),
(6, 'herbal', 'whvr3', 'aktif'),
(7, 'cihuy', 'efd32', 'aktif');

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
  `kode_obat` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `harga`, `tanggal_kadaluwarsa`, `tahun_produksi`, `deskripsi`, `kode_obat`, `id_kategori`) VALUES
(1, 'Paramex', 8, '2026-12-31', '2023', 'Obat sakit kepala dan flu ringan.', 'OBT001', NULL),
(2, 'Bodrex', 7500, '2025-10-15', '2022', 'Pereda demam dan nyeri otot.', 'OBT002', NULL),
(4, 'Vitamin C 1000mg', 12000, '2026-05-10', '2023', 'Suplemen daya tahan tubuh.', 'OBT004', NULL),
(6, 'Sanmol', 6500, '2026-11-11', '2023', 'Obat penurun panas.', 'OBT006', 1),
(7, 'Woods Cough Syrup', 9000, '2026-02-28', '2023', 'Obat batuk kering dan berdahak.', 'OBT007', NULL),
(8, 'Promag', 5500, '2027-07-01', '2024', 'Obat maag dan mual.', 'OBT008', 3),
(10, 'Decolgen', 10000, '2025-12-31', '2022', 'Obat flu dan hidung tersumbat.', 'OBT010', NULL),
(22, '5456', 12, '2025-07-14', '0000', 'wehoiweh', 'qede32', NULL),
(23, 'jhgfyg', 1233, '2025-07-14', '0000', 'yctcx', '67ff', NULL),
(24, 'rrrr', 12, '2025-07-14', '0000', 'hfyi', '7tfy', NULL),
(25, 'hfeiug', 12, '2025-07-14', '2023', 'agdfuiegw', '2893y4g', NULL),
(26, 'dafa', 12111, '2025-07-19', '0000', 'qjbdqe', 'efwe23', 1),
(27, 'dafaa', 12101, '2025-07-19', '0000', 'wef', 'efwe2w', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kode_kategori` (`kode_kategori`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`id_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_obat` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
