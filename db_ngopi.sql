-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 09, 2022 at 04:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ngopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `log` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `log`) VALUES
(52, 9, '2022-02-03 19:00:52'),
(53, 10, '2022-02-03 19:02:31'),
(54, 12, '2022-02-03 19:03:53'),
(55, 10, '2022-02-03 19:04:39'),
(56, 10, '2022-02-03 19:12:18'),
(57, 9, '2022-02-04 18:49:43'),
(58, 12, '2022-02-04 21:09:22'),
(59, 10, '2022-02-04 21:12:28'),
(60, 9, '2022-02-05 02:52:00'),
(61, 12, '2022-02-05 02:53:39'),
(62, 10, '2022-02-05 03:03:13'),
(63, 13, '2022-02-05 03:06:06'),
(64, 12, '2022-02-05 03:07:00'),
(65, 9, '2022-02-07 14:55:17'),
(66, 12, '2022-02-07 14:55:54'),
(67, 10, '2022-02-07 14:56:51'),
(68, 12, '2022-02-09 04:42:02'),
(69, 9, '2022-02-09 06:46:11'),
(70, 12, '2022-02-09 07:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `harga` int(11) NOT NULL,
  `jenis` enum('makanan','minuman') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama`, `harga`, `jenis`) VALUES
(1, 'Caramel liseted apple crumble', 15000, 'makanan'),
(2, 'Chocolate Fondue', 12800, 'makanan'),
(13, 'Cappucino', 20500, 'minuman'),
(14, 'Cocoa toffe banana crunch', 23000, 'makanan'),
(15, 'The ultimate strawberry', 30000, 'makanan'),
(16, 'Nutella Banana', 21000, 'makanan'),
(17, 'Latte', 20500, 'minuman'),
(18, 'Milk Steamer', 21000, 'minuman'),
(19, 'Brewed Coffe', 15000, 'minuman'),
(20, 'Thai milk tea', 18000, 'minuman'),
(21, 'Iced Coffe', 13000, 'minuman'),
(22, 'Espresso Shot', 15000, 'minuman'),
(23, 'Chocolate', 12800, 'minuman'),
(24, 'Plain Waffle', 20500, 'makanan'),
(25, 'Ice-cream Sandwich', 25000, 'makanan');

-- --------------------------------------------------------

--
-- Table structure for table `pre_transaksi`
--

CREATE TABLE `pre_transaksi` (
  `id_trx` int(11) NOT NULL,
  `no_trx` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pre_transaksi`
--

INSERT INTO `pre_transaksi` (`id_trx`, `no_trx`, `id_menu`, `qty`, `total`) VALUES
(33, 16, 2, 1, 6000),
(34, 16, 23, 2, 24000),
(35, 17, 1, 2, 10000),
(36, 18, 16, 2, 10000),
(37, 19, 14, 1, 23000),
(38, 19, 20, 1, 18000),
(39, 20, 25, 2, 50000),
(41, 21, 1, 1, 15000),
(42, 22, 17, 1, 20500),
(43, 22, 1, 1, 15000),
(44, 26, 2, 1, 12800);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_trx` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_trx`, `id_user`, `tgl`, `qty`, `total`) VALUES
(16, 9, '2022-02-03', 3, 30000),
(17, 9, '2022-02-04', 2, 10000),
(18, 9, '2022-02-04', 2, 10000),
(19, 13, '2022-02-04', 2, 41000),
(20, 9, '2022-02-07', 2, 50000),
(21, 9, '2022-02-08', 1, 15000),
(22, 9, '2022-02-09', 2, 35500),
(23, 9, '2022-02-09', 2, 35500),
(24, 9, '2022-02-09', 2, 35500),
(25, 9, '2022-02-09', 2, 35500),
(26, 9, '2022-02-09', 1, 12800);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `role` enum('kasir','manager','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `role`) VALUES
(9, 'restu', '$2y$10$IuLpu7wJ8nJUWgYy24E61eOSCAeDoDh96DPpArIikayGpRfj1PPeO', 'Restu Fauzy', 'kasir'),
(10, 'admin', '$2y$10$SOQ.kbwFVhd8wL/7LonCpeI9fWoC/PEISgFcjjYx09a2SXprLPuYW', 'Administrator', 'admin'),
(12, 'manager', '$2y$10$VQTntmeezK8BSC1phNwP2eh2EWmK9j3LTPEqhIyxS4Xj.FDGD64ve', 'Irfan Ferdiansyah', 'manager'),
(13, 'riyanto', '$2y$10$5zDMubUQGGMQVdEzii9cyONJkHp9zyb1gRklgnEhiH9SN9.YI5nLG', 'Riyanto', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pre_transaksi`
--
ALTER TABLE `pre_transaksi`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_trx`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pre_transaksi`
--
ALTER TABLE `pre_transaksi`
  MODIFY `id_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_trx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
