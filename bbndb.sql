-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2016 at 06:50 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbndb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivasi`
--

CREATE TABLE IF NOT EXISTS `aktivasi` (
  `id_user` int(11) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  `validated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aktivasi`
--

INSERT INTO `aktivasi` (`id_user`, `hash`, `valid`, `validated`) VALUES
(19, 'cc888574e4ad6c41b0d9abd045eff6a3', 0, '2016-03-14 07:08:29'),
(20, '80bea63452a65a107b2fe5fc0baa10a1', 1, '0000-00-00 00:00:00'),
(21, 'e833cc6fd6dc4b844187183a9c8bb2fd', 0, '2016-03-14 08:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_ktp` varchar(25) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `aktif` int(1) NOT NULL DEFAULT '0',
  `waktu_aktivasi` datetime NOT NULL,
  `registered_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `nama`, `alamat`, `nomor_ktp`, `nomor_hp`, `password`, `aktif`, `waktu_aktivasi`, `registered_date`) VALUES
(21, 'taujago@gmail.com', 'Firmansyah', 'afdf', '67664646', '081328080020', '4124bc0a9335c27f086f24ba207a4912', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
