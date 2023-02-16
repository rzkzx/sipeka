-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2023 at 11:02 AM
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
  `status` enum('USULAN','DITERIMA','DITOLAK') DEFAULT 'USULAN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `nip`, `nama`, `masakerja`, `alasan`, `tanggal`, `kodecuti`, `jabatan`, `lamacuti`, `pakai1`, `pakai2`, `pakai3`, `daritgl`, `sampaitgl`, `alamat`, `no_telp`, `nama_penyetuju`, `nip_penyetuju`, `nama_ketua`, `nip_ketua`, `surat`, `status`) VALUES
(3, '198701142006041001', 'NOOR SYARIF', '16', 'Urusan Keluarga', '2023-01-10', '2023-01-10-198701142006041001', 'Pengelola BMN', 2, 0, 0, 2, '2023-01-23', '2023-01-24', 'Jl. Pendidikan Martapura', '852', '', '0', 'ITA WIDYANINGSIH, S.H., M.H.', '197606172000032002', '', 'DITERIMA'),
(4, '198701142006041001', 'NOOR SYARIF', '16', 'cuti tahun baru ', '2023-01-25', '2023-01-25-198701142006041001', 'Pengelola BMN', 3, 0, 0, 3, '2023-01-26', '2023-01-28', 'rumah', '1232123223', '', '0', 'ITA WIDYANINGSIH, S.H., M.H.', '197606172000032002', '', 'DITERIMA'),
(5, '198701142006041001', 'NOOR SYARIF', '16', 'dadjaoijdad', '2024-01-18', '2023-01-30-198701142006041001', 'Pengelola BMN', 4, 0, 0, 4, '2023-02-01', '2023-02-07', 'dapkdpaod', '13131313', '', '0', 'ITA WIDYANINGSIH, S.H., M.H.', '197606172000032002', '', 'DITERIMA'),
(6, '12312213123', 'Roman Zidan Ramadhann', '5', 'tes', '2023-02-15', '2023-02-15-12312213123', 'Mahasiswa', 9, 3, 2, 4, '2023-02-17', '2023-02-25', 'tes', '081231244124', '', NULL, 'ITA WIDYANINGSIH, S.H., M.H.', '197606172000032002', NULL, 'DITOLAK'),
(8, 'ancah', 'Ancah SInaga', '12', 'ini hanya alasan', '2023-02-16', '2023-02-16-ancah', 'Mahasiswa', 10, 5, 3, 2, '2023-02-16', '2023-02-18', 'tes', 'tes', '', '', 'ITA WIDYANINGSIH, S.H., M.H.', '197606172000032002', NULL, 'DITERIMA');

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

--
-- Dumping data for table `jatah_cuti`
--

INSERT INTO `jatah_cuti` (`id`, `nip`, `nama`, `sisa1`, `sisa2`, `sisa3`, `totalcuti`) VALUES
(5, 'ancah', 'Ancah SInaga', 7, 9, 10, 10);

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

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `pangkat`, `jabatan`, `ruangan`, `masa_kerja`, `tgl_pengangkatan`, `tmt_pkt_terakhir`, `pangkat_berikutnya`, `periode_pkt_berikutnya`, `tmt_gajiterakhir`, `foto`, `ttd`) VALUES
(7, 'ancah', 'Ancah Ternaga', 'Penata Muda TK I / (III/b)', 'Mahasiswa Abadi', 'IX C', '12', '2023-02-16', '2023-02-18', 'Penata / (III/c)', '2027-02-18', '2023-02-22', '71830-ancah.jpg', '70179-ancah.png');

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

--
-- Dumping data for table `sk_pangkat`
--

INSERT INTO `sk_pangkat` (`id_pangkat`, `id_usul_pangkat`, `no_sk`, `tgl_sk`, `nip`, `pangkat_lama`, `tmt_pangkat_lama`, `pangkat_baru`, `tmt_pangkat_baru`, `periode_berikutnya`, `status`, `file_sk_pdf`) VALUES
(1, 1, 'W15.U/333/KP.05/2023', '2023-04-01', '198410072008052001', 'Penata Muda TK I / (III/b)', '2019-04-01', 'Penata / (III/c)', '2023-04-01', '2027-04-01', 'Selesai', NULL),
(2, 2, 'tesss', '2023-02-13', '199307032019031005', 'Penata / (II/c)', '2019-04-01', 'Penata TK I / (III/d)', '2023-02-08', '2023-02-10', 'Selesai', NULL),
(4, 5, 'ISDKOADJ/1203912', '2023-02-13', '12312213123', 'Pengatur / (II/c)', '2023-02-12', 'Pembina TK I / (IV/b)', '2023-02-24', '2023-11-21', 'Selesai', '69424-ISDKOADJ/1203912.pdf');

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
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nip_pegawai`, `username`, `password`, `avatar`, `role`) VALUES
(1, 'Administratorr', '99999999', 'admin', '$2y$10$EkYo02at3KEvwf9ttMKgPemGXCxHG2gRQVc9x4/wSZOw0jjR4ibmq', '9117-admin.jpg', 'admin'),
(2, 'Ancah Ternaga', 'ancah', 'ancah', '$2y$10$bTB7qv1W.QEU79a52mVy8ugP1ifwbdG9VFdJhr4GxYKdMQaAAzSFC', '71830-ancah.jpg', 'user');

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
-- Dumping data for table `usul_pangkat`
--

INSERT INTO `usul_pangkat` (`id_usul_pangkat`, `no_surat`, `tgl_surat`, `nip`, `pangkat_terakhir`, `tmt_pangkat_terakhir`, `pangkat_usulan`, `periode_usulan`, `status`, `file_usul_pdf`) VALUES
(1, 'W15.U3/101/KP/2023', '2023-01-10', '198410072008052001', 'Penata Muda TK I / (III/b)', '2019-04-01', 'Penata Muda TK I / (III/b)', '2023-04-01', 'Selesai', NULL),
(5, 'A4V3AAD', '2023-02-13', '12312213123', 'Pengatur / (II/c)', '2023-02-12', 'Pengatur Muda / (II/a)', '2023-02-15', 'Selesai', '1858-A4V3AAD.pdf');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usul_pangkat`
--
ALTER TABLE `usul_pangkat`
  MODIFY `id_usul_pangkat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
