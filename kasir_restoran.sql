-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 05:54 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `tgl_dibuat`) VALUES
(1, 'Ayam', '2020-12-07 06:09:41'),
(2, 'Sayuran', '2020-12-07 06:11:04'),
(3, 'Ikan', '2020-12-07 06:13:58'),
(6, 'Minuman', '2020-12-15 03:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama`, `tgl_dibuat`) VALUES
(1, 'Admin', '2020-12-06 04:04:43'),
(2, 'Kasir', '2020-12-06 04:04:43'),
(3, 'Pelanggan', '2020-12-06 04:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` double(50,0) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `komposisi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `harga`, `foto`, `komposisi`, `deskripsi`, `status`, `tgl_dibuat`, `kategori_id`) VALUES
(2, 'Gurame Bakar Pedas', 50000, 'A7L3DIWM_gurame bakar.jpg', '2 ekor gurami ukuran sedang \r\n2 sdm minyak untuk menggoreng\r\n1 sdm air perasan lemon\r\n1 sdt merica bubuk\r\n1 sdt garam', 'Lorem ipsum, dolor sit amet consectetur, adipisicing elit. Harum beatae veritatis omnis odit! Ipsam recusandae est incidunt quis, sunt iusto perspiciatis reprehenderit aliquid veniam. Laudantium dolorum maxime cumque repudiandae expedita quis modi recusandae omnis explicabo atque hic, beatae saepe non qui harum nesciunt delectus assumenda totam numquam fugiat officia iusto?', 1, '2020-12-08 07:10:43', 3),
(3, 'Lele Goreng Gurih', 45000, 'JLSEHZ65_lele.jpg', '8 ekor lele segar\r\n4 siung bawang merah\r\n2 siung bawang putih\r\n1 kelingking kunyit\r\n1 sdm ketumbar', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae libero, vel ut soluta harum quas velit voluptates, modi tempore, officiis ullam, quisquam omnis nostrum porro tempora. Ex non minus aspernatur est ea repudiandae voluptates velit asperiores totam maiores veniam expedita, placeat minima ipsa odio deserunt harum illo. Delectus laboriosam, ipsa!', 1, '2020-12-09 14:06:52', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(50) NOT NULL,
  `tgl_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_bayar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `no_pesanan`, `tgl_bayar`, `status_bayar`) VALUES
(1, '20201212J24YET5V', '2020-12-12 03:40:01', 'Lunas'),
(2, '20201212ENDL5K6M', '2020-12-12 04:16:44', 'Lunas'),
(4, '20201222VHM9CA53', '2020-12-24 08:42:02', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.svg',
  `level_id` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `foto`, `level_id`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$2qvSqUzwUo54lRL8Pffm/ubIv0M3y47oP8M8mxgNdqCcZej76HJ7.', 'TKHY2S5R_user.png', 1),
(2, 'Abel Yoshuara', 'abel@gmail.com', '$2y$10$7vr7zT0UyiGhWIX1eK7Db.HwUZ/prV8kI2e489bCl7pJuceIqgOR2', 'R9ZBIW8D_undraw_profile.svg', 2),
(3, 'Riyan Erlangga', 'riyan@gmail.com', '$2y$10$PeANOmXppfSI/GwSigTso.BNW2oL/646WK72GKuycKCuDH2IWPVHm', 'JTY52P9L_user.png', 3),
(4, 'Angga Purnadita', 'angga@gmail.com', '$2y$10$fWnQpHKiIPkqpEBHjvO9u.hpN1hvMWYouzQZG0svBgcD2x9w6yq92', 'default.svg', 3),
(9, 'Edgar', 'edgar@gmail.com', '$2y$10$U03THnJixrLm4DUmCFE.EuuNUft3qcHwJgnglq1QkuStwPDjprhe6', 'default.svg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(50) NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `no_meja` varchar(10) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_bayar` double(50,0) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `no_pesanan`, `pengguna_id`, `no_meja`, `menu_id`, `jumlah`, `total_bayar`, `status`) VALUES
(1, '20201212J24YET5V', 3, '1', 3, 2, 90000, 'Lunas'),
(2, '20201212J24YET5V', 3, '1', 2, 1, 50000, 'Lunas'),
(3, '20201212ENDL5K6M', 3, '1', 2, 1, 50000, 'Lunas'),
(6, '20201222VHM9CA53', 4, '1', 2, 3, 150000, 'Lunas'),
(7, '20201222VHM9CA53', 4, '1', 3, 3, 135000, 'Lunas'),
(8, '202012254ISV1Y2N', 9, '1', 3, 2, 90000, 'Sedang Dipesan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
