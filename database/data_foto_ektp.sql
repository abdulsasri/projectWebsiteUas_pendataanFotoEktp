-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2021 at 07:12 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_foto_ektp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `jk`, `username`, `password`, `level`) VALUES
(6, 'Admin - 1', 'Laki-Laki', 'admin1', '$2y$10$GtP8iDAYQIzjMnzHLxTdUOfxtPrnHljnUifFLy7J5cp2HEZ5laLxC', 'Admin'),
(7, 'Admin - 2', 'Perempuan', 'admin2', '$2y$10$xm9ISBogyQkOR7.pmMKIUeeHshSyQfOCAKY28f9qaC6Kw2Yx0vxRO', 'Admin'),
(8, 'User - 1', 'Laki-Laki', 'user1', '$2y$10$FzcB7Bz80VGz89wqMhR4pu7cdmOHMeqKV1fGNcpJ4ipSiBnd6Dfpa', 'User'),
(9, 'User - 2', 'Perempuan', 'user2', '$2y$10$CCoKg/91zMCCWHZ/QF.AUuJva2aICmgzdLP9oaEUASB2luJocf2m2', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `file_kk` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `nik`, `nama`, `kelurahan`, `file_kk`, `status`) VALUES
(5, '123456789', 'ABDUL SASRI LAEDI', 'Kelurahan 3', '6105710e6f2f2.pdf', 'Telah Foto'),
(8, '1802039884', 'TYO', 'Kelurahan 2', '61057c00c9eea.pdf', 'Telah Foto'),
(9, '32333442', 'MEGA', 'Kelurahan 4', '61057ea7abf7a.pdf', 'Telah Foto'),
(10, '123454321', 'WULAN', 'Kelurahan 1', '61057ec47b872.pdf', ''),
(11, '4444344423335', 'ANTO', 'Kelurahan 3', '610773bec64f9.pdf', ''),
(12, '453466', 'ANILA', 'Kelurahan 4', '61077e1806637.pdf', 'Telah Foto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
