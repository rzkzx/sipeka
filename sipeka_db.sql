-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 07:27 PM
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
-- Database: `sipeka`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` int(10) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `masakerja` varchar(255) NOT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kodecuti` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `lamacuti` int(11) DEFAULT NULL,
  `pakai1` int(11) DEFAULT NULL,
  `pakai2` int(11) DEFAULT NULL,
  `pakai3` int(11) DEFAULT NULL,
  `daritgl` date DEFAULT NULL,
  `sampaitgl` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `nama_penyetuju` varchar(255) DEFAULT NULL,
  `nip_penyetuju` varchar(255) DEFAULT NULL,
  `nama_ketua` varchar(255) DEFAULT NULL,
  `nip_ketua` varchar(255) DEFAULT NULL,
  `surat` varchar(255) DEFAULT NULL,
  `validasi_admin` enum('USULAN','DITERIMA','DITOLAK') DEFAULT 'USULAN',
  `validasi_ketua` enum('USULAN','DITERIMA','DITOLAK') DEFAULT 'USULAN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jatah_cuti`
--

CREATE TABLE `jatah_cuti` (
  `id` int(11) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `sisa1` int(11) NOT NULL,
  `sisa2` int(11) NOT NULL,
  `sisa3` int(11) NOT NULL,
  `totalcuti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `ruangan` varchar(255) DEFAULT NULL,
  `masa_kerja` varchar(255) DEFAULT NULL,
  `tgl_pengangkatan` date DEFAULT NULL,
  `tmt_pkt_terakhir` date DEFAULT NULL,
  `pangkat_berikutnya` varchar(255) DEFAULT NULL,
  `periode_pkt_berikutnya` date DEFAULT NULL,
  `tmt_gajiterakhir` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sk_pangkat`
--

CREATE TABLE `sk_pangkat` (
  `id_pangkat` int(11) NOT NULL,
  `id_usul_pangkat` int(11) NOT NULL,
  `no_sk` varchar(255) NOT NULL,
  `tgl_sk` date NOT NULL,
  `nip` varchar(255) NOT NULL,
  `pangkat_lama` varchar(255) DEFAULT NULL,
  `tmt_pangkat_lama` date DEFAULT NULL,
  `pangkat_baru` varchar(255) DEFAULT NULL,
  `tmt_pangkat_baru` date DEFAULT NULL,
  `periode_berikutnya` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `file_sk_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ttd`
--

CREATE TABLE `ttd` (
  `id` int(11) NOT NULL,
  `bagian` enum('ketua','kasubbag') DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ttd`
--

INSERT INTO `ttd` (`id`, `bagian`, `ttd`) VALUES
(1, 'ketua', 'ketua-ttd.png'),
(2, 'kasubbag', 'kasubbag-ttd.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip_pegawai` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('admin','user','ketua') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nip_pegawai`, `username`, `password`, `avatar`, `role`) VALUES
(1, 'Administratorr', '99999999', 'admin', '$2y$10$EkYo02at3KEvwf9ttMKgPemGXCxHG2gRQVc9x4/wSZOw0jjR4ibmq', '9117-admin.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `usul_pangkat`
--

CREATE TABLE `usul_pangkat` (
  `id_usul_pangkat` int(10) NOT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `pangkat_terakhir` varchar(255) DEFAULT NULL,
  `tmt_pangkat_terakhir` date DEFAULT NULL,
  `pangkat_usulan` varchar(255) DEFAULT NULL,
  `periode_usulan` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `file_usul_pdf` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jatah_cuti`
--
ALTER TABLE `jatah_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_pangkat`
--
ALTER TABLE `sk_pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `ttd`
--
ALTER TABLE `ttd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usul_pangkat`
--
ALTER TABLE `usul_pangkat`
  ADD PRIMARY KEY (`id_usul_pangkat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jatah_cuti`
--
ALTER TABLE `jatah_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sk_pangkat`
--
ALTER TABLE `sk_pangkat`
  MODIFY `id_pangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ttd`
--
ALTER TABLE `ttd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usul_pangkat`
--
ALTER TABLE `usul_pangkat`
  MODIFY `id_usul_pangkat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
