-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2026 at 07:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Buku Tulis', 5000, 100, 1),
(2, 'BRG002', 'Pulpen Hitam', 3000, 150, 2),
(3, 'BRG003', 'Pensil 2B', 2500, 200, 3),
(4, 'BRG004', 'Penghapus Karet', 1500, 120, 4),
(5, 'BRG005', 'Penggaris 30cm', 4000, 80, 5),
(6, 'BRG006', 'Buku Gambar', 7000, 90, 6),
(7, 'BRG007', 'Spidol Whiteboard', 8000, 60, 7),
(8, 'BRG008', 'Tipe-X Kertas', 6000, 75, 8),
(9, 'BRG009', 'Gunting Kertas', 5500, 50, 9),
(10, 'BRG010', 'Stapler Kecil', 10000, 40, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Ahmad Fauzi', 'L', '081211112222', 'Surabaya'),
(2, 'Siti Aminah', 'P', '081322223333', 'Malang'),
(3, 'Budi Santoso', 'L', '081433334444', 'Sidoarjo'),
(4, 'Dewi Lestari', 'P', '081544445555', 'Gresik'),
(5, 'Eko Prasetyo', 'L', '081655556666', 'Bangkalan'),
(6, 'Fitri Handayani', 'P', '081766667777', 'Mojokerto'),
(7, 'Guntur Wibowo', 'L', '081877778888', 'Jombang'),
(8, 'Hesti Rahmawati', 'P', '081988889999', 'Tuban'),
(9, 'Irfan Hakim', 'L', '081199990000', 'Lamongan'),
(10, 'Joko Widodo', 'L', '081200001111', 'Madura');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-06-01 08:35:00', 25000, 'TUNAI', 1),
(2, '2026-06-01 09:20:00', 14000, 'TRANSFER', 2),
(3, '2026-06-02 10:05:00', 50000, 'EDC', 3),
(4, '2026-06-02 11:25:00', 35000, 'TUNAI', 4),
(5, '2026-06-03 13:05:00', 16000, 'TRANSFER', 5),
(6, '2026-06-03 14:50:00', 10000, 'TUNAI', 6),
(7, '2026-06-04 08:05:00', 75000, 'EDC', 7),
(8, '2026-06-04 10:15:00', 20000, 'TUNAI', 8),
(9, '2026-06-05 15:35:00', 45000, 'TRANSFER', 9),
(10, '2026-06-05 16:05:00', 60000, 'EDC', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(2, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(3, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(4, 'PT. Berkah Jaya', '0811223344', 'Malang'),
(5, 'PT. Sumber Makmur', '0822334455', 'Sidoarjo'),
(6, 'PT. Mitra Usaha', '0833445566', 'Gresik'),
(7, 'PT. Abadi Sentosa', '0844556677', 'Jakarta'),
(8, 'PT. Cipta Karya', '0855667788', 'Bandung'),
(9, 'PT. Karya Mandiri', '0866778899', 'Semarang'),
(10, 'PT. Bintang Terang', '0877889900', 'Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-06-01 08:30:00', 'Lunas pembelian alat tulis', 25000, 1),
(2, '2026-06-01 09:15:00', 'Pembelian buku gambar', 14000, 2),
(3, '2026-06-02 10:00:00', 'Keperluan kantor', 50000, 3),
(4, '2026-06-02 11:20:00', 'Belanja bulanan sekolah', 35000, 4),
(5, '2026-06-03 13:00:00', 'Pembelian spidol', 16000, 5),
(6, '2026-06-03 14:45:00', 'Keperluan tugas', 10000, 6),
(7, '2026-06-04 08:00:00', 'Belanja grosir kecil', 75000, 7),
(8, '2026-06-04 10:10:00', 'Pembelian tambahan', 20000, 8),
(9, '2026-06-05 15:30:00', 'Transaksi sore', 45000, 9),
(10, '2026-06-05 16:00:00', 'Pembelian alat kantor', 60000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000, 5),
(2, 6, 7000, 2),
(3, 10, 10000, 5),
(4, 2, 3000, 10),
(5, 7, 8000, 2),
(6, 3, 2500, 4),
(7, 4, 1500, 10),
(8, 5, 4000, 5),
(9, 8, 6000, 7),
(10, 9, 5500, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'Admin Utama', 'Surabaya', '081211111111', 1),
(2, 'kasir1', '827ccb0eea8a706c4c34a16891f84e7b', 'Kasir Satu', 'Malang', '081222222222', 2),
(3, 'kasir2', '827ccb0eea8a706c4c34a16891f84e7b', 'Kasir Dua', 'Sidoarjo', '081233333333', 2),
(4, 'gudang1', '827ccb0eea8a706c4c34a16891f84e7b', 'Petugas Gudang', 'Gresik', '081244444444', 3),
(5, 'owner', '827ccb0eea8a706c4c34a16891f84e7b', 'Pemilik Toko', 'Jakarta', '081255555555', 1),
(6, 'staff1', '827ccb0eea8a706c4c34a16891f84e7b', 'Staff A', 'Bangkalan', '081266666666', 3),
(7, 'staff2', '827ccb0eea8a706c4c34a16891f84e7b', 'Staff B', 'Mojokerto', '081277777777', 3),
(8, 'kasir3', '827ccb0eea8a706c4c34a16891f84e7b', 'Kasir Tiga', 'Jombang', '081288888888', 2),
(9, 'admin2', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin Cadangan', 'Tuban', '081299999999', 1),
(10, 'kasir4', '827ccb0eea8a706c4c34a16891f84e7b', 'Kasir Empat', 'Lamongan', '081200000000', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
