-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2018 at 07:43 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--
CREATE DATABASE IF NOT EXISTS `pengaduan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `pengaduan`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `jenis` enum('Root','Direktur','Tim IT') NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `jenis`, `username`, `nama`, `password`) VALUES
(1, 'Root', 'root', 'Super User', '63a9f0ea7bb98050796b649e85481845'),
(8, 'Direktur', 'direktur', 'Direktur Utama', '4fbfd324f5ffcdff5dbf6f019b02eca8');

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id`, `nama`) VALUES
(6, 'PPIC 1'),
(7, 'PPIC 2'),
(8, 'PPIC 3'),
(9, 'HRD'),
(10, 'PERSONALIA'),
(11, 'QC 1'),
(12, 'QC 2'),
(13, 'QC 3'),
(14, 'MAINTENANCE');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama`) VALUES
(1, 'Perbaikan'),
(2, 'Permintaan dan Instalasi'),
(3, 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `penanganan`
--

CREATE TABLE `penanganan` (
  `id` int(11) NOT NULL,
  `id_aduan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `status` enum('Menunggu Persetujuan','Disetujui','Ditolak','Sedang Dikerjakan','Selesai') NOT NULL,
  `stok` enum('Tersedia','Tidak Tersedia') DEFAULT NULL,
  `tanggal_pengerjaan` date DEFAULT NULL,
  `catatan` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penanganan`
--

INSERT INTO `penanganan` (`id`, `id_aduan`, `id_admin`, `status`, `stok`, `tanggal_pengerjaan`, `catatan`) VALUES
(1, 3, 1, 'Selesai', 'Tidak Tersedia', '2018-04-19', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.'),
(2, 4, 8, 'Ditolak', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `masalah` longtext NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `id_bagian`, `id_jenis`, `id_user`, `lokasi`, `masalah`, `gambar`, `tanggal`) VALUES
(3, 7, 1, 1, 'Poly', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic et provident illo, amet libero vero beatae. Iste earum quae sapiente quod veritatis aut dolore ut, laboriosam, sequi alias consequuntur veniam!', '17042018130011.png', '2018-04-17'),
(4, 10, 2, 1, 'Bojong', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic et provident illo, amet libero vero beatae. Iste earum quae sapiente quod veritatis aut dolore ut, laboriosam, sequi alias consequuntur veniam!', '17042018133640.png', '2018-04-17'),
(5, 14, 3, 1, 'MC', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic et provident illo, amet libero vero beatae. Iste earum quae sapiente quod veritatis aut dolore ut, laboriosam, sequi alias consequuntur veniam!', '17042018134316.png', '2018-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `nohp`, `email`, `password`) VALUES
(1, 'Ramita', '08970008875', 'ramita.digmi@gmail.com', 'be56e66270ab8b5d27808974f1794c85'),
(6, 'Samsul', '09089080080', 'samsul@gmail.com', '670b14728ad9902aecba32e22fa4f6bd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aduan` (`id_aduan`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_aduan_2` (`id_aduan`),
  ADD KEY `id_admin_2` (`id_admin`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bagian` (`id_bagian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_bagian_2` (`id_bagian`),
  ADD KEY `id_user_2` (`id_user`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nohp` (`nohp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penanganan`
--
ALTER TABLE `penanganan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD CONSTRAINT `penanganan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `penanganan_ibfk_2` FOREIGN KEY (`id_aduan`) REFERENCES `pengaduan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_3` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
