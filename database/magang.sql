-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2023 at 09:26 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int NOT NULL,
  `id_peserta` int NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `status_masuk` enum('Tepat Waktu','Terlambat') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'lebih dari jam 8 terlambat',
  `status_keluar` enum('Tepat Waktu','Belum Waktunya') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'kurang dari jam 16 belum waktunya',
  `keterangan` enum('Sakit','Izin','Alfa') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_absen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `aspek_penilaian`
--

CREATE TABLE `aspek_penilaian` (
  `id_aspek` int NOT NULL,
  `aspek_penilaian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batas_nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aspek_penilaian`
--

INSERT INTO `aspek_penilaian` (`id_aspek`, `aspek_penilaian`, `batas_nilai`) VALUES
(7, 'Aspek 1', 60),
(8, 'Apek 2', 30),
(9, 'Aspek 3', 10),
(10, 'Aspek 4', 50);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_harian`
--

CREATE TABLE `catatan_harian` (
  `id_catatan_harian` int NOT NULL,
  `id_detail_mentoring` int NOT NULL,
  `catatan_harian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan_mentor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_kegiatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_catatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_mentoring`
--

CREATE TABLE `detail_mentoring` (
  `id_detail_mentoring` int NOT NULL,
  `id_mentor` int NOT NULL,
  `id_peserta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_mentoring`
--

INSERT INTO `detail_mentoring` (`id_detail_mentoring`, `id_mentor`, `id_peserta`) VALUES
(2, 4, 3),
(3, 5, 4),
(4, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_nilai`
--

CREATE TABLE `detail_nilai` (
  `id_detail_nilai` int NOT NULL,
  `id_aspek` int NOT NULL,
  `id_peserta` int NOT NULL,
  `id_mentor` int NOT NULL,
  `nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int NOT NULL,
  `nama_divisi` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(2, 'Divisi A'),
(3, 'Divisi B'),
(4, 'Divisi C');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_hasil_magang`
--

CREATE TABLE `laporan_hasil_magang` (
  `id_laporan_hasil` int NOT NULL,
  `id_detail_mentoring` int NOT NULL,
  `laporan_hasil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan_hasil_mentor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_buat` date NOT NULL,
  `status` enum('Revisi','Diterima') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id_mentor` int NOT NULL,
  `nama_mentor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_divisi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id_mentor`, `nama_mentor`, `tgl_lahir`, `alamat`, `no_telp`, `username`, `password`, `id_divisi`) VALUES
(4, 'Bambang Gunardi', '1990-01-01', 'Jalan Kutilang', '081721828311', 'bamgun', '5d13ba3e71cbf881486aa0ade03dfaf4', 2),
(5, 'Iwan Setiawan', '1994-01-29', 'Jalan Kucing', '087112351733', 'iwan', '01ccce480c60fcdb67b54f4509ffdb56', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_magang`
--

CREATE TABLE `nilai_magang` (
  `id_nilai` int NOT NULL,
  `id_peserta` int NOT NULL,
  `id_mentor` int NOT NULL,
  `total_nilai` double NOT NULL,
  `sertifikat_file` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peserta_magang`
--

CREATE TABLE `peserta_magang` (
  `id_peserta` int NOT NULL,
  `nama_peserta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta_magang`
--

INSERT INTO `peserta_magang` (`id_peserta`, `nama_peserta`, `tgl_lahir`, `alamat`, `no_telp`, `username`, `password`) VALUES
(3, 'Ivan Gutawa', '2023-06-01', 'Jalan Kutilang 1', '081721828312', 'ivan', '2c42e5cf1cdbafea04ed267018ef1511'),
(4, 'Noval Huda', '2003-02-12', 'Jalan Jalan Jalan', '087112351733', 'noval', '467bae90b19ee6eb379a749cb924f726'),
(5, 'Bagus Indra', '2023-06-01', 'Jalan Kunang', '081721828312', 'bagus', '17b38fc02fd7e92f3edeb6318e3066d8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `aspek_penilaian`
--
ALTER TABLE `aspek_penilaian`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indexes for table `catatan_harian`
--
ALTER TABLE `catatan_harian`
  ADD PRIMARY KEY (`id_catatan_harian`);

--
-- Indexes for table `detail_mentoring`
--
ALTER TABLE `detail_mentoring`
  ADD PRIMARY KEY (`id_detail_mentoring`);

--
-- Indexes for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD PRIMARY KEY (`id_detail_nilai`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `laporan_hasil_magang`
--
ALTER TABLE `laporan_hasil_magang`
  ADD PRIMARY KEY (`id_laporan_hasil`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id_mentor`);

--
-- Indexes for table `nilai_magang`
--
ALTER TABLE `nilai_magang`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `peserta_magang`
--
ALTER TABLE `peserta_magang`
  ADD PRIMARY KEY (`id_peserta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aspek_penilaian`
--
ALTER TABLE `aspek_penilaian`
  MODIFY `id_aspek` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `catatan_harian`
--
ALTER TABLE `catatan_harian`
  MODIFY `id_catatan_harian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `detail_mentoring`
--
ALTER TABLE `detail_mentoring`
  MODIFY `id_detail_mentoring` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  MODIFY `id_detail_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan_hasil_magang`
--
ALTER TABLE `laporan_hasil_magang`
  MODIFY `id_laporan_hasil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id_mentor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_magang`
--
ALTER TABLE `nilai_magang`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `peserta_magang`
--
ALTER TABLE `peserta_magang`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
