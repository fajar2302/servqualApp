-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 03:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuisioner_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aldiansyah_aldi03`
--

CREATE TABLE `aldiansyah_aldi03` (
  `id_respon` varchar(250) NOT NULL,
  `username_id` varchar(200) DEFAULT NULL,
  `judul_id` varchar(250) DEFAULT NULL,
  `jenisKuisioner_id` varchar(100) DEFAULT NULL,
  `pertanyaan_id` varchar(100) DEFAULT NULL,
  `presepsi` int(20) NOT NULL,
  `harapan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aldiansyah_aldi03`
--

INSERT INTO `aldiansyah_aldi03` (`id_respon`, `username_id`, `judul_id`, `jenisKuisioner_id`, `pertanyaan_id`, `presepsi`, `harapan`) VALUES
('1699253510', 'aldi03', '9280', '1342', '0051', 4, 3),
('1699253513', 'aldi03', '9280', '1234', '0892', 5, 4),
('1699253516', 'aldi03', '9280', '1342', '1775', 4, 3),
('1699253519', 'aldi03', '9280', '2342', '5869', 3, 2),
('1699253522', 'aldi03', '9280', '2342', '6525', 3, 2),
('1699253525', 'aldi03', '9280', '1234', '8938', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `bernad_09876`
--

CREATE TABLE `bernad_09876` (
  `id_respon` varchar(250) NOT NULL,
  `username_id` varchar(200) DEFAULT NULL,
  `judul_id` varchar(250) DEFAULT NULL,
  `jenisKuisioner_id` varchar(100) DEFAULT NULL,
  `pertanyaan_id` varchar(100) DEFAULT NULL,
  `presepsi` int(20) NOT NULL,
  `harapan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bernad_09876`
--

INSERT INTO `bernad_09876` (`id_respon`, `username_id`, `judul_id`, `jenisKuisioner_id`, `pertanyaan_id`, `presepsi`, `harapan`) VALUES
('1693318917', '09876', '9280', '1234', '8938', 3, 4),
('1693318921', '09876', '9280', '1234', '0892', 4, 4),
('1693318926', '09876', '9280', '1342', '0051', 2, 3),
('1693318930', '09876', '9280', '1342', '1775', 3, 4),
('1693318940', '09876', '9280', '2342', '6525', 3, 3),
('1693318944', '09876', '9280', '2342', '5869', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fajarfebriansyah_7201042302020001`
--

CREATE TABLE `fajarfebriansyah_7201042302020001` (
  `id_respon` varchar(250) NOT NULL,
  `username_id` varchar(200) DEFAULT NULL,
  `judul_id` varchar(250) DEFAULT NULL,
  `jenisKuisioner_id` varchar(100) DEFAULT NULL,
  `pertanyaan_id` varchar(100) DEFAULT NULL,
  `presepsi` int(20) NOT NULL,
  `harapan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fajarfebriansyah_7201042302020001`
--

INSERT INTO `fajarfebriansyah_7201042302020001` (`id_respon`, `username_id`, `judul_id`, `jenisKuisioner_id`, `pertanyaan_id`, `presepsi`, `harapan`) VALUES
('1692323677', '7201042302020001', '9280', '1234', '8938', 3, 4),
('1692323681', '7201042302020001', '9280', '1234', '0892', 3, 4),
('1692323687', '7201042302020001', '9280', '1342', '0051', 3, 4),
('1692323691', '7201042302020001', '9280', '1342', '1775', 3, 4),
('1692323708', '7201042302020001', '9280', '2342', '6525', 3, 4),
('1692323711', '7201042302020001', '9280', '2342', '5869', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mouse_12345`
--

CREATE TABLE `mouse_12345` (
  `id_respon` varchar(250) NOT NULL,
  `username_id` varchar(200) DEFAULT NULL,
  `judul_id` varchar(250) DEFAULT NULL,
  `jenisKuisioner_id` varchar(100) DEFAULT NULL,
  `pertanyaan_id` varchar(100) DEFAULT NULL,
  `presepsi` int(20) NOT NULL,
  `harapan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mouse_12345`
--

INSERT INTO `mouse_12345` (`id_respon`, `username_id`, `judul_id`, `jenisKuisioner_id`, `pertanyaan_id`, `presepsi`, `harapan`) VALUES
('1693318817', '12345', '9280', '1234', '8938', 1, 4),
('1693318826', '12345', '9280', '1234', '0892', 3, 4),
('1693318830', '12345', '9280', '1342', '0051', 4, 4),
('1693318835', '12345', '9280', '1342', '1775', 2, 2),
('1693318841', '12345', '9280', '2342', '6525', 3, 4),
('1693318845', '12345', '9280', '2342', '5869', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `saprinpakaya_onal123`
--

CREATE TABLE `saprinpakaya_onal123` (
  `id_respon` varchar(250) NOT NULL,
  `username_id` varchar(200) DEFAULT NULL,
  `judul_id` varchar(250) DEFAULT NULL,
  `jenisKuisioner_id` varchar(100) DEFAULT NULL,
  `pertanyaan_id` varchar(100) DEFAULT NULL,
  `presepsi` int(20) NOT NULL,
  `harapan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saprinpakaya_onal123`
--

INSERT INTO `saprinpakaya_onal123` (`id_respon`, `username_id`, `judul_id`, `jenisKuisioner_id`, `pertanyaan_id`, `presepsi`, `harapan`) VALUES
('1696902353', 'onal123', '9280', '1234', '8938', 3, 4),
('1696902355', 'onal123', '9280', '1234', '0892', 2, 2),
('1696902356', 'onal123', '9280', '1342', '0051', 4, 4),
('1696902360', 'onal123', '9280', '1342', '1775', 2, 3),
('1696902361', 'onal123', '9280', '2342', '6525', 3, 3),
('1696902363', 'onal123', '9280', '2342', '5869', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `judul_id` varchar(200) NOT NULL,
  `x1_preptot` varchar(200) NOT NULL,
  `x1_hartot` varchar(200) NOT NULL,
  `y1_preptot` varchar(200) NOT NULL,
  `y1_hartot` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jeniskuisioner`
--

CREATE TABLE `tb_jeniskuisioner` (
  `id_jenisKuisioner` varchar(100) NOT NULL,
  `jenis_kuisioner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jeniskuisioner`
--

INSERT INTO `tb_jeniskuisioner` (`id_jenisKuisioner`, `jenis_kuisioner`) VALUES
('1234', 'TANGIBLE'),
('1342', 'ASSURANCE'),
('2342', 'RESPONSIVENESS'),
('2345', 'RELIABLITY'),
('5464', 'EMPATHY');

-- --------------------------------------------------------

--
-- Table structure for table `tb_judul`
--

CREATE TABLE `tb_judul` (
  `id_judul` varchar(100) NOT NULL,
  `judul` text NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `status` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_judul`
--

INSERT INTO `tb_judul` (`id_judul`, `judul`, `lokasi`, `tahun`, `status`) VALUES
('9280', 'Analisis Kualitas Pelayanan pada Bandara Djalaludin di Provinsi Gorontalo', 'Kabupaten Gorontalo', '2021', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id_pertanyaan` varchar(100) NOT NULL,
  `judul_id` varchar(100) NOT NULL,
  `jenisKuisioner_id` varchar(100) NOT NULL,
  `item_pertanyaan` text NOT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id_pertanyaan`, `judul_id`, `jenisKuisioner_id`, `item_pertanyaan`, `waktu`) VALUES
('0051', '9280', '1342', 'pertanyaan 1 Assurance', '2023-08-18'),
('0892', '9280', '1234', 'pertanyaan 2 Tangible', '2023-08-18'),
('1775', '9280', '1342', 'pertanyaan 2 Assurance', '2023-08-18'),
('5869', '9280', '2342', 'pertanyaan 2 Responsiveness', '2023-08-18'),
('6525', '9280', '2342', 'pertanyaan 1 Responsiveness', '2023-08-18'),
('8938', '9280', '1234', 'pertanyaan 1 Tangible ', '2023-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(100) NOT NULL,
  `roles` enum('admin','responden') NOT NULL,
  `nama` text NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `umur` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kata_kunci` varchar(250) NOT NULL,
  `pekerjaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`username`, `roles`, `nama`, `jenis_kelamin`, `no_hp`, `umur`, `alamat`, `kata_kunci`, `pekerjaan`) VALUES
('09876', 'responden', 'Bernad', 'laki-laki', '08987654323', '12', 'Jln. Delima', 'Bernad0987!', 'Siswa'),
('1234', 'admin', 'ADMIN', '', '', '', '', 'admin123!', ''),
('12345', 'responden', 'Mouse', 'perempuan', '081234567809', '17', 'Jln. Rambutan', 'Mouse1234!', 'Siswa'),
('7201042302020001', 'responden', 'Fajar Febriansyah', 'laki-laki', '082293754206', '', 'Jalan Mandala Kelurahan Pohe', '230202Fajar!', ''),
('aldi03', 'responden', 'Aldiansyah', 'laki-laki', '0908070605', '20', 'Jl. Jendral Sudirman', '1234', 'Mahasiswa'),
('onal123', 'responden', 'Saprin Pakaya', 'laki-laki', '19384293824', '', 'asdajksdbsfj', 'Onal123!', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aldiansyah_aldi03`
--
ALTER TABLE `aldiansyah_aldi03`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `username_id` (`username_id`),
  ADD KEY `judul_id` (`judul_id`),
  ADD KEY `jenisKuisioner_id` (`jenisKuisioner_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `bernad_09876`
--
ALTER TABLE `bernad_09876`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `username_id` (`username_id`),
  ADD KEY `judul_id` (`judul_id`),
  ADD KEY `jenisKuisioner_id` (`jenisKuisioner_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `fajarfebriansyah_7201042302020001`
--
ALTER TABLE `fajarfebriansyah_7201042302020001`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `username_id` (`username_id`),
  ADD KEY `judul_id` (`judul_id`),
  ADD KEY `jenisKuisioner_id` (`jenisKuisioner_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `mouse_12345`
--
ALTER TABLE `mouse_12345`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `username_id` (`username_id`),
  ADD KEY `judul_id` (`judul_id`),
  ADD KEY `jenisKuisioner_id` (`jenisKuisioner_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `saprinpakaya_onal123`
--
ALTER TABLE `saprinpakaya_onal123`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `username_id` (`username_id`),
  ADD KEY `judul_id` (`judul_id`),
  ADD KEY `jenisKuisioner_id` (`jenisKuisioner_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `tb_jeniskuisioner`
--
ALTER TABLE `tb_jeniskuisioner`
  ADD PRIMARY KEY (`id_jenisKuisioner`);

--
-- Indexes for table `tb_judul`
--
ALTER TABLE `tb_judul`
  ADD KEY `id_judul` (`id_judul`);

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `judul_id` (`judul_id`),
  ADD KEY `jenisKuisioner_id` (`jenisKuisioner_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aldiansyah_aldi03`
--
ALTER TABLE `aldiansyah_aldi03`
  ADD CONSTRAINT `aldiansyah_aldi03_ibfk_1` FOREIGN KEY (`username_id`) REFERENCES `tb_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aldiansyah_aldi03_ibfk_2` FOREIGN KEY (`judul_id`) REFERENCES `tb_judul` (`id_judul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aldiansyah_aldi03_ibfk_3` FOREIGN KEY (`jenisKuisioner_id`) REFERENCES `tb_jeniskuisioner` (`id_jenisKuisioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aldiansyah_aldi03_ibfk_4` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tb_pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bernad_09876`
--
ALTER TABLE `bernad_09876`
  ADD CONSTRAINT `bernad_09876_ibfk_1` FOREIGN KEY (`username_id`) REFERENCES `tb_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bernad_09876_ibfk_2` FOREIGN KEY (`judul_id`) REFERENCES `tb_judul` (`id_judul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bernad_09876_ibfk_3` FOREIGN KEY (`jenisKuisioner_id`) REFERENCES `tb_jeniskuisioner` (`id_jenisKuisioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bernad_09876_ibfk_4` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tb_pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fajarfebriansyah_7201042302020001`
--
ALTER TABLE `fajarfebriansyah_7201042302020001`
  ADD CONSTRAINT `fajarfebriansyah_7201042302020001_ibfk_1` FOREIGN KEY (`username_id`) REFERENCES `tb_user` (`username`),
  ADD CONSTRAINT `fajarfebriansyah_7201042302020001_ibfk_2` FOREIGN KEY (`judul_id`) REFERENCES `tb_judul` (`id_judul`),
  ADD CONSTRAINT `fajarfebriansyah_7201042302020001_ibfk_3` FOREIGN KEY (`jenisKuisioner_id`) REFERENCES `tb_jeniskuisioner` (`id_jenisKuisioner`),
  ADD CONSTRAINT `fajarfebriansyah_7201042302020001_ibfk_4` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tb_pertanyaan` (`id_pertanyaan`);

--
-- Constraints for table `mouse_12345`
--
ALTER TABLE `mouse_12345`
  ADD CONSTRAINT `mouse_12345_ibfk_1` FOREIGN KEY (`username_id`) REFERENCES `tb_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mouse_12345_ibfk_2` FOREIGN KEY (`judul_id`) REFERENCES `tb_judul` (`id_judul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mouse_12345_ibfk_3` FOREIGN KEY (`jenisKuisioner_id`) REFERENCES `tb_jeniskuisioner` (`id_jenisKuisioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mouse_12345_ibfk_4` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tb_pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saprinpakaya_onal123`
--
ALTER TABLE `saprinpakaya_onal123`
  ADD CONSTRAINT `saprinpakaya_onal123_ibfk_1` FOREIGN KEY (`username_id`) REFERENCES `tb_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saprinpakaya_onal123_ibfk_2` FOREIGN KEY (`judul_id`) REFERENCES `tb_judul` (`id_judul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saprinpakaya_onal123_ibfk_3` FOREIGN KEY (`jenisKuisioner_id`) REFERENCES `tb_jeniskuisioner` (`id_jenisKuisioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saprinpakaya_onal123_ibfk_4` FOREIGN KEY (`pertanyaan_id`) REFERENCES `tb_pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD CONSTRAINT `tb_pertanyaan_ibfk_1` FOREIGN KEY (`judul_id`) REFERENCES `tb_judul` (`id_judul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pertanyaan_ibfk_2` FOREIGN KEY (`jenisKuisioner_id`) REFERENCES `tb_jeniskuisioner` (`id_jenisKuisioner`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
