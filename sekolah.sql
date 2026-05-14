-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 04, 2026 at 04:13 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin1', 'adminyarischool');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL,
  `aktivitas_sekarang` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `nis`, `nama_lengkap`, `jenis_kelamin`, `tahun_masuk`, `tahun_lulus`, `aktivitas_sekarang`, `created_at`) VALUES
(1, '2019001', 'Rizky Pratama', 'Laki-laki', 2019, 2022, 'Mahasiswa Universitas Andalas', '2026-03-08 22:56:42'),
(2, '2019002', 'Mega Wulandari', 'Perempuan', 2019, 2022, 'Mahasiswi UNP Padang', '2026-03-08 22:56:42'),
(3, '2020001', 'Hendra Wijaya', 'Laki-laki', 2020, 2023, 'Bekerja di PT. Semen Padang', '2026-03-08 22:56:42'),
(4, '2020002', 'Fitri Rahayu', 'Perempuan', 2020, 2023, 'Mahasiswi STIKES Padang', '2026-03-08 22:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `gambar` varchar(500) NOT NULL COMMENT 'Path atau URL gambar',
  `kategori` varchar(100) NOT NULL DEFAULT 'Umum',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `gambar`, `kategori`, `created_at`) VALUES
(1, 'Kegiatan Belajar Mengajar', 'Suasana belajar yang aktif dan menyenangkan di kelas.', '/project-web-sekolah/foto/belajar1.jpg', 'Akademik', '2026-03-09 00:24:17'),
(2, 'Praktikum Lab Kimia', 'Siswa melakukan eksperimen di laboratorium kimia sekolah.', '/project-web-sekolah/foto/lab1.jpg', 'Akademik', '2026-03-09 00:24:17'),
(3, 'Lomba Futsal Antar Kelas', 'Pertandingan futsal seru dalam rangka HUT sekolah.', '/project-web-sekolah/foto/futsal1.jpg', 'Olahraga', '2026-03-09 00:24:17'),
(5, 'Student Exchange Jerman', 'Program pertukaran pelajar ke Dr. Wilhelm-Andre Gymnasium, Chemnitz.', '/project-web-sekolah/foto/exchange1.jpg', 'Exchange', '2026-03-09 00:24:17'),
(6, 'Perpisahan Kelas XII', 'Momen perpisahan dan pelepasan siswa kelas XII angkatan 2025.', '/project-web-sekolah/foto/perpisahan1.jpg', 'Acara', '2026-03-09 00:24:17'),
(14, 'sdasd', 'asdsad', '69e99e61accf1.png', 'Umum', '2026-04-23 04:21:53'),
(15, 'AAAAAAAAAA', 'AAAAAAAAAAAAAAA', '69f0a78641499.jpg', 'Acara', '2026-04-28 12:26:46');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `niy` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `bidang_studi` varchar(150) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `foto`, `niy`, `nama_lengkap`, `bidang_studi`, `created_at`) VALUES
(1, NULL, '1111111111', 'AAAAAA', 'Ekonomi', '2026-05-04 04:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `kategori` enum('Penting','Kegiatan','Informasi','Libur') NOT NULL DEFAULT 'Informasi',
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `kategori`, `tanggal`, `created_at`) VALUES
(1, 'Pelaksanaan Ujian Tengah Semester Genap 2025', 'Diberitahukan kepada seluruh siswa kelas X, XI, dan XII bahwa Ujian Tengah Semester (UTS) Genap Tahun Pelajaran 2025/2026 akan dilaksanakan mulai tanggal 2 Februari 2026 hingga 8 Februari 2026.\r\n\r\nSiswa diwajibkan hadir tepat waktu dan membawa perlengkapan tulis yang lengkap. Tidak diperkenankan membawa catatan atau alat komunikasi ke dalam ruang ujian.\r\n\r\nJadwal lengkap ujian dapat dilihat di papan pengumuman sekolah atau menghubungi wali kelas masing-masing.\r\n\r\nApakah dimengerti semuanya?\r\nDemikian pengumuman ini disampaikan, atas perhatiannya diucapkan terima kasih.', 'Kegiatan', '2025-10-17', '2026-03-09 00:08:20'),
(2, 'Lomba Kebersihan Kelas Antar Angkatan', 'Dalam rangka memperingati HUT SMA YARI SCHOOL, OSIS mengadakan Lomba Kebersihan Kelas Antar Angkatan yang akan dilaksanakan pada tanggal 25 Januari 2026.\n\nPenilaian meliputi kebersihan, kerapian, dan kreativitas dekorasi kelas. Total hadiah yang diperebutkan senilai Rp 3.000.000,- untuk juara 1, 2, dan 3.\n\nSetiap kelas wajib mendaftarkan diri ke OSIS paling lambat tanggal 22 Januari 2026. Informasi lebih lanjut hubungi pengurus OSIS.', 'Kegiatan', '2026-01-15', '2026-03-09 00:08:20'),
(5, 'Iwak', 'Iwak peyek\r\n', 'Kegiatan', '2026-04-28', '2026-04-28 12:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_aktif`
--

CREATE TABLE `siswa_aktif` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa_aktif`
--

INSERT INTO `siswa_aktif` (`id`, `nis`, `nama_lengkap`, `jenis_kelamin`, `kelas`, `tahun_masuk`, `no_hp`, `created_at`) VALUES
(1, '2023001', 'Andi Kurniawan', 'Laki-laki', 'XII IPA 1', 2023, '081298765401', '2026-03-08 22:56:42'),
(2, '2023002', 'Dewi Lestari', 'Perempuan', 'XII IPA 2', 2023, '081298765402', '2026-03-08 22:56:42'),
(3, '2024001', 'Fajar Ramadhan', 'Laki-laki', 'XI IPS 1', 2024, '081298765403', '2026-03-08 22:56:42'),
(4, '2024002', 'Nurul Hidayah', 'Perempuan', 'X IPA 1', 2024, '081298765404', '2026-03-08 22:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `tendik`
--

CREATE TABLE `tendik` (
  `id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tendik`
--

INSERT INTO `tendik` (`id`, `nip`, `nama_lengkap`, `jenis_kelamin`, `jabatan`, `no_hp`, `email`, `created_at`) VALUES
(1, '198506102010011001', 'Rini Apriani', 'Perempuan', 'Tata Usaha', '081234567811', 'rini@smayari.sch.id', '2026-03-08 22:56:42'),
(2, '199012252014011002', 'Doni Prasetyo', 'Laki-laki', 'Penjaga Perpustakaan', '081234567812', 'doni@smayari.sch.id', '2026-03-08 22:56:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `niy` (`niy`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa_aktif`
--
ALTER TABLE `siswa_aktif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `tendik`
--
ALTER TABLE `tendik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswa_aktif`
--
ALTER TABLE `siswa_aktif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tendik`
--
ALTER TABLE `tendik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
