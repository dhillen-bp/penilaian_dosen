-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 28, 2023 at 02:46 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian_dosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` char(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','dosen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `level`) VALUES
('001', 'dosen1', '$2y$10$5DqBYqDAsWko.CxDvgFmJeUX4ikXCUUn7ZyhNorVBW96lkRAg4pTm', 'dosen'),
('002', 'dosen', '$2y$10$Ypw5jb3BIFREDVq8hkpEsuQu/oB9rXvzwH9jycetnzaN5GzelzcPm', 'dosen'),
('1', 'admin', '$2y$10$ddgUW9eS0iq7nXwNqqJiu.HMw2WjP06H3Nusnnf.z.iFloc4v/lMC', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `tahun_ajar` char(9) NOT NULL,
  `semester` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`tahun_ajar`, `semester`) VALUES
('2020-2021', 1),
('2021', 2),
('2021-2022', 3),
('2022', 4),
('2022-2023', 5),
('2023', 6),
('2023-2024', 7),
('2024', 8);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` char(11) NOT NULL,
  `nm_dosen` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `foto_dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nm_dosen`, `email`, `foto_dosen`) VALUES
('001', 'Soeharto', 'dosen3@mail.com', 'gojo.jpg'),
('002', 'Dosen Dua', 'sayadosen2@mail.com', 'inumaki.jpg'),
('005', 'Soeharto', 'dosen333@mail.com', '1674874016_bee08ee52f64db9972a4.png');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kinerja`
--

CREATE TABLE `hasil_kinerja` (
  `id_hasil` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `favorit` enum('0','1') NOT NULL,
  `rating` float NOT NULL,
  `pesan` text NOT NULL,
  `kesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner`
--

CREATE TABLE `kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `pedagogik` int(11) NOT NULL,
  `profesional` int(11) NOT NULL,
  `kepribadian` int(11) NOT NULL,
  `sosial` int(11) NOT NULL,
  `id_mahasiswa` char(11) NOT NULL,
  `id_dosen` char(11) NOT NULL,
  `id_angkatan` char(9) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `kd_matkul` char(3) NOT NULL,
  `pesan_kesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kuesioner`
--

INSERT INTO `kuesioner` (`id_kuesioner`, `pedagogik`, `profesional`, `kepribadian`, `sosial`, `id_mahasiswa`, `id_dosen`, `id_angkatan`, `id_semester`, `kd_matkul`, `pesan_kesan`) VALUES
(14, 7, 6, 8, 9, '123', '001', '2021', 5, 'DAM', 'b aja'),
(15, 8, 7, 7, 6, '123', '001', '2022-2023', 5, 'PMO', ''),
(17, 2, 5, 8, 10, '2013010179', '001', '2020-2021', 5, 'DAM', ''),
(19, 8, 6, 7, 9, '2013010179', '002', '2023', 6, 'PMO', 'ya'),
(20, 7, 6, 8, 7, '2013010178', '002', '2020-2021', 4, 'DAM', 'tidak jelas'),
(21, 10, 10, 10, 10, '2013010178', '001', '2023', 6, 'DAM', 'biasa saja');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tahun_masuk` char(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `tahun_masuk`, `username`, `password`) VALUES
('123', 'Cyber', '2021', 'user', '$2y$10$l2VuSybD3bWG0RwqYN1tXeTjsWISBA9twt/yoWz20SpXUFncUXUZG'),
('2013010175', 'Tom', '2023', 'tom', '$2y$10$iSIfE2GgoRNaMB3YJ1FkceRF08pUgGn.gBeowFON9hswSq/k4.7Xy'),
('2013010178', 'wahyu', '2022', 'xxx', '$2y$10$PsMSC8OcSn8HYpnvO9ioXexnjSe5h3gdZjdeeN/720zk2vTgcYlqS'),
('2013010179', 'Dhillen Brahmantya Pradifta', '2020', 'dhillenbp', '$2y$10$NXzIkjWWReqoSIfpjTevROcQGG.7Ka3nKyYuwcXF/LLLxE9cwi/qG');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kd_matkul` char(3) NOT NULL,
  `nm_matkul` varchar(50) NOT NULL,
  `id_angkatan` char(9) NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `id_dosen` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kd_matkul`, `nm_matkul`, `id_angkatan`, `semester`, `id_dosen`) VALUES
('DAM', 'DESAIN APLIKASI MOBILE', '2022-2023', 5, '002'),
('PMO', 'PEMROGRAMAN MOBILE', '2022-2023', 5, '001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`tahun_ajar`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `hasil_kinerja`
--
ALTER TABLE `hasil_kinerja`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_kuesioner` (`id_kuesioner`);

--
-- Indexes for table `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_angkatan` (`id_angkatan`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_matkul` (`kd_matkul`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kd_matkul`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_angkatan` (`id_angkatan`),
  ADD KEY `semester` (`semester`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_kinerja`
--
ALTER TABLE `hasil_kinerja`
  ADD CONSTRAINT `hasil_kinerja_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `kuesioner` (`id_kuesioner`);

--
-- Constraints for table `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD CONSTRAINT `kuesioner_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `kuesioner_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`nidn`),
  ADD CONSTRAINT `kuesioner_ibfk_4` FOREIGN KEY (`kd_matkul`) REFERENCES `mata_kuliah` (`kd_matkul`);

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`nidn`),
  ADD CONSTRAINT `mata_kuliah_ibfk_3` FOREIGN KEY (`id_angkatan`) REFERENCES `angkatan` (`tahun_ajar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
