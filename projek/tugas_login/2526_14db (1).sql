-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2026 pada 06.44
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2526_14db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `posisi` varchar(100) NOT NULL,
  `jk` enum('Perempuan','Laki-Laki') NOT NULL,
  `alamat` text NOT NULL,
  `NIP/NIS` varchar(50) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama_lengkap`, `password`, `tgl_lahir`, `posisi`, `jk`, `alamat`, `NIP/NIS`, `no_hp`) VALUES
(4, 'Aku', 'Akuuuu', '123', '2026-05-24', 'siswi', 'Perempuan', 'tangerang', '1234567', '987654321'),
(5, 'Bu Yuli', 'Noor Yuli Astuti, S.Pd. ', '123', '1967-07-24', 'Wakil Kepala Sekolah Bidang Kurikulum', 'Perempuan', 'Jalan Pojok Utara No 2024 Cimahi', '196707241996032003', '08122055998'),
(6, 'Bu Amel', 'Amalia Wulandari, S.Pd.', '123', '1984-10-25', 'Staf Kurikulum Bidang Evaluasi dan Penjadwalan', 'Perempuan', 'Komp. Cibogo Indah No 37 RT 02 RW  17 Desa Cangkuang Kulon Kecamatan Dayeuhkolot. ', '198410252014102001', '08562092063'),
(7, 'Pa Indra', 'Indra Setia Nugraha, S.T. ', '123', '1988-06-30', 'Staf Kurikulum Bidang Pengembangan IT', 'Laki-Laki', 'Kp. Cijeruk No. 11 RT 003 RW 008 Ds. Bojongsari Kec. Bojongsoang', '198806302022211009', '082126360972'),
(8, 'Bu Puspa', 'Puspa Ayu Winarni, S.Par.', '123', NULL, '', 'Perempuan', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
