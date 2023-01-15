-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 05:45 AM
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
-- Database: `depa_melina`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `status`) VALUES
(1, 'Kang Tae Moo', 'Mahasiswa'),
(2, 'Park Min Young', 'Karyawan'),
(5, 'Choi Woo Shik', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `dt_pembelian`
--

CREATE TABLE `dt_pembelian` (
  `id` varchar(15) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `kuantitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_pembelian`
--

INSERT INTO `dt_pembelian` (`id`, `id_produk`, `nama_produk`, `id_supplier`, `nama_supplier`, `harga_beli`, `harga_jual`, `kuantitas`) VALUES
('20220531131759', 4, 'Penghapus', 1, 'Suho', 4000, 7000, 20),
('20220607133128', 10, 'Boba Milk', 3, 'Ten', 21000, 28000, 3),
('20220607133128', 15, 'Nasi Kuning', 3, 'Ten', 7000, 8000, 2),
('20220607145139', 15, 'Nasi Kuning', 3, 'Ten', 7000, 8000, 1),
('20220621174419', 10, 'Boba Milk', 3, 'Ten', 21000, 28000, 2),
('20220711093615', 4, 'Penghapus', 1, 'Suho', 4000, 7000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dt_penjualan`
--

CREATE TABLE `dt_penjualan` (
  `id` varchar(14) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `nama_owner` varchar(50) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `kuantitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dt_penjualan`
--

INSERT INTO `dt_penjualan` (`id`, `id_produk`, `nama_produk`, `id_owner`, `nama_owner`, `harga_beli`, `harga_jual`, `kuantitas`) VALUES
('20220531133723', 3, 'Buku', 2, 'Kang Daniel', 6000, 8000, 10),
('20220531143854', 15, 'Nasi Kuning', 5, 'Park Ji Hoon', 7000, 8000, 4),
('20220607152728', 1, 'Milk Tea', 1, 'RE', 2000, 5000, 8),
('20220614134040', 3, 'Buku', 2, 'Kang Daniel', 6000, 8000, 1),
('20220614135005', 1, 'Milk Tea', 1, 'RE', 2000, 5000, 1),
('20220621142151', 17, 'Cornetto', 1, 'RE', 5000, 6500, 5),
('20220621144346', 15, 'Nasi Kuning', 5, 'Park Ji Hoon', 7000, 8000, 1),
('20220621144434', 17, 'Cornetto', 1, 'RE', 5000, 6500, 4),
('20220621144911', 3, 'Buku', 2, 'Kang Daniel', 6000, 8000, 1),
('20220621145914', 10, 'Boba Milk', 8, 'Seung Hyun', 21000, 28000, 1),
('20220621145948', 15, 'Nasi Kuning', 5, 'Park Ji Hoon', 7000, 8000, 1),
('20220622110734', 3, 'Buku', 2, 'Kang Daniel', 6000, 8000, 3),
('20220711093126', 3, 'Buku', 2, 'Kang Daniel', 6000, 8000, 1),
('20220711100718', 28, 'Hello Panda', 1, 'RE', 2000, 3000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ht_pembelian`
--

CREATE TABLE `ht_pembelian` (
  `id` varchar(14) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(15) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `total_bayar` float NOT NULL,
  `kasir` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ht_pembelian`
--

INSERT INTO `ht_pembelian` (`id`, `id_supplier`, `nama_supplier`, `waktu`, `total_bayar`, `kasir`) VALUES
('20220531131759', 1, 'Suho', '2022-05-31 13:17:59', 80000, 'Depa M'),
('20220607133128', 3, 'Ten', '2022-06-07 13:31:28', 77000, 'Depa M'),
('20220607145139', 3, 'Ten', '2022-06-20 11:05:04', 7000, 'Depa M'),
('20220621174419', 3, 'Ten', '2022-06-21 11:05:12', 42000, NULL),
('20220711093615', 1, 'Suho', '2022-07-11 00:00:00', 4000, 'Kang Daniel');

-- --------------------------------------------------------

--
-- Table structure for table `ht_penjualan`
--

CREATE TABLE `ht_penjualan` (
  `id` varchar(14) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `total_bayar` float DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `kasir` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ht_penjualan`
--

INSERT INTO `ht_penjualan` (`id`, `id_customer`, `nama_customer`, `waktu`, `total_bayar`, `status`, `kasir`) VALUES
('20220531143854', 1, 'Kang Tae Moo', '2022-05-31 14:38:54', 32000, '', 'Depa M'),
('20220614135005', 5, 'Choi Woo Shik', '2022-06-14 13:50:05', 2000, '', 'Depa M'),
('20220621142151', 1, 'Kang Tae Moo', '2022-06-21 14:21:51', 32500, '', 'Depa M'),
('20220621144346', 1, 'Kang Tae Moo', '2022-06-21 14:43:46', 8000, '', 'Administrator\r\n'),
('20220621144434', 5, 'Choi Woo Shik', '2022-06-21 14:44:34', 10000, '', 'Administrator\r\n'),
('20220621144911', 5, 'Choi Woo Shik', '2022-06-21 14:49:11', 3000, '', 'Administrator\r\n'),
('20220621145914', 2, 'Park Min Young', '2022-06-21 14:59:14', 20000, '', 'Administrator\r\n'),
('20220621145948', 2, 'Park Min Young', '2022-06-21 14:59:48', 7000, '', 'Administrator\r\n'),
('20220622110734', 1, 'Kang Tae Moo', '2022-06-22 11:07:34', 24000, '', 'Depa M'),
('20220711100718', 1, 'Kang Tae Moo', '2022-07-11 10:07:18', 15000, '', 'Kang Daniel');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'ATK'),
(4, 'Permen'),
(6, 'Obat'),
(7, 'Ice Cream'),
(8, 'Minuman Cup'),
(9, 'Minuman Botol'),
(10, 'Minuman Kotak'),
(11, 'Minuman Sachet'),
(12, 'Minuman Kaleng'),
(13, 'Tisu'),
(14, 'Pembalut'),
(15, 'Aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `nama_owner` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `nama_owner`, `alamat`, `no_hp`) VALUES
(1, 'RE', 'Kota Tasikmalaya ', '089774653432'),
(2, 'Kang Daniel', 'Busan ', '089876888'),
(5, 'Park Ji Hoon', ' Ilsan', '6767677'),
(8, 'Seung Hyun', 'Ciamis', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kuantitas` int(3) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_barang`, `kuantitas`, `harga_beli`, `harga_jual`, `id_kategori`, `id_owner`, `id_supplier`) VALUES
(3, 'Buku', 22, 6000, 8000, 3, 2, 1),
(4, 'Penghapus', 13, 4000, 7000, 3, 1, 1),
(10, 'Boba Milk', 28, 21000, 28000, 2, 8, 3),
(15, 'Nasi Kuning', 12, 7000, 8000, 1, 5, 3),
(17, 'Cornetto', 24, 5000, 6500, 7, 1, 0),
(18, 'Frestea Teh Melati', 50, 5500, 7500, 9, 1, 0),
(27, 'Ultra Milk Strawberry', 30, 4000, 5500, 10, 1, 0),
(28, 'Hello Panda', 59, 2000, 3000, 1, 1, 0),
(29, 'Siip Jagung Bakar', 43, 2000, 4000, 1, 1, 0),
(30, 'Oreo', 27, 2000, 2500, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama_supplier` varchar(20) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`, `alamat`, `no_hp`) VALUES
(1, 'Suho', 'Busan', '08978788233'),
(3, 'Ten', 'Bogor', '07887888882');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `akses` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `akses`) VALUES
(1, 'danielmy', 'daniel', 'Kang Daniel', 'admin'),
(2, 'depa', 'depa', 'Depa Melina', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ht_pembelian`
--
ALTER TABLE `ht_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ht_penjualan`
--
ALTER TABLE `ht_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
