-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2020 at 12:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amqjobs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `loker_tb`
--

CREATE TABLE `loker_tb` (
  `id_loker` int(11) NOT NULL,
  `nama_l` varchar(50) NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `gaji` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `waktu_buka` date NOT NULL,
  `waktu_tutup` date NOT NULL,
  `waktu_pekerjaan` varchar(50) NOT NULL,
  `tipe_pekerjaan` varchar(50) NOT NULL,
  `lokasi` varchar(500) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `persyaratan` varchar(500) NOT NULL,
  `catatan` varchar(500) NOT NULL,
  `id_tempat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loker_tb`
--

INSERT INTO `loker_tb` (`id_loker`, `nama_l`, `bidang`, `gaji`, `alamat`, `waktu_buka`, `waktu_tutup`, `waktu_pekerjaan`, `tipe_pekerjaan`, `lokasi`, `deskripsi`, `persyaratan`, `catatan`, `id_tempat`) VALUES
(6, 'Satpam Sadap Ancor', 'Staff', 'Rahasia', 'Jln. Wolter Monginsidi', '2020-09-25', '2020-10-25', 'tetap', 'onsite', 'https://goo.gl/maps/8GZtBQjHd9VeQ2ZX9', '<ul><li>Yang penting sadap sa</li></ul>', '<ul><li>Laki-laki Basantang</li><li>Umur Max. 25 Tahun</li></ul>', 'Silahkan ke alamat yang tersedia.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tempat_tb`
--

CREATE TABLE `tempat_tb` (
  `id_tempat` int(11) NOT NULL,
  `nama_t` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `link_web` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tentang` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tempat_tb`
--

INSERT INTO `tempat_tb` (`id_tempat`, `nama_t`, `gambar`, `link_web`, `telepon`, `email`, `tentang`) VALUES
(8, 'Salon Kezia', '5f70304eed11c.png', 'www.salonkez.amq', '0821', 'salon@kezia.amq', 'Ini Salon Kez'),
(10, 'Indojuni Ambon', '5f6eb5ed5b8e4.jpg', 'www.indojuni.com', '00000', 'indo@juni.id', 'Ini adalah tempat kerja yang menjual barang-barang kanapa?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `loker_tb`
--
ALTER TABLE `loker_tb`
  ADD PRIMARY KEY (`id_loker`),
  ADD KEY `loker_fk` (`id_tempat`);

--
-- Indexes for table `tempat_tb`
--
ALTER TABLE `tempat_tb`
  ADD PRIMARY KEY (`id_tempat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loker_tb`
--
ALTER TABLE `loker_tb`
  MODIFY `id_loker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tempat_tb`
--
ALTER TABLE `tempat_tb`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loker_tb`
--
ALTER TABLE `loker_tb`
  ADD CONSTRAINT `loker_fk` FOREIGN KEY (`id_tempat`) REFERENCES `tempat_tb` (`id_tempat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
