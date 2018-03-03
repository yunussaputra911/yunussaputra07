-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2018 at 03:26 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposition`
--

CREATE TABLE IF NOT EXISTS `disposition` (
  `id` varchar(5) NOT NULL,
  `disposition_at` date NOT NULL,
  `reply_at` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `mailid` varchar(5) NOT NULL,
  `userid` varchar(5) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'sudah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposition`
--

INSERT INTO `disposition` (`id`, `disposition_at`, `reply_at`, `description`, `notification`, `mailid`, `userid`, `status`) VALUES
('DS002', '2018-02-15', 'Kepala Sekolah', 'Oke  SMKN2 akan ikut', 'balas', 'SM003', 'US003', 'sudah'),
('DS003', '2018-02-16', 'Kepala Sekolah', 'okeeeee', 'balas', 'SM001', 'US003', 'sudah'),
('DS004', '2018-02-17', 'Kepala Sekolah', 'akan kami persipakan pak', 'balas', 'SM004', 'US003', 'sudah'),
('DS005', '2018-02-17', 'Kepala Sekolah', 'okelah', 'abaikan', 'SM005', 'US003', 'sudah'),
('DS006', '2018-02-19', 'Kepala Sekolah', 'Oke kami sambut pak kedatangannya', 'balas', 'SM013', 'US003', 'sudah'),
('DS007', '2018-02-20', 'Kepala Sekolah', 'siap teruss', 'abaikan', 'SM006', 'US003', 'sudah'),
('DS008', '2018-02-20', 'Kepala Sekolah', 'oke surat terima', 'balas', 'SM014', 'US003', 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` varchar(5) NOT NULL,
  `incoming_at` date NOT NULL,
  `mail_code` varchar(30) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_from` varchar(70) NOT NULL,
  `mail_to` varchar(70) NOT NULL,
  `mail_subject` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `mail_typeid` varchar(5) NOT NULL,
  `userid` varchar(5) NOT NULL,
  `disposisi` varchar(10) NOT NULL DEFAULT 'belum',
  `status` varchar(25) NOT NULL DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `incoming_at`, `mail_code`, `mail_date`, `mail_from`, `mail_to`, `mail_subject`, `description`, `file_upload`, `mail_typeid`, `userid`, `disposisi`, `status`) VALUES
('SM001', '2017-12-02', 'kec/btg/XII/01', '2017-12-01', 'kecamatan Bantar Gerbang', 'SMKN  2 Kota Bekasi', 'pembuatan  KTP', 'pembuatan KTP di SMK 2', 'BIODATA SISWA SMK NEGERI 2 BEKASI.docx', 'JS001', 'US002', 'sudah', 'arsip'),
('SM003', '2018-01-04', 'walkot/02/08/2018', '2018-01-03', 'Walikota Bekasi', 'SMKN  2 Kota Bekasi', 'Lomba Sekolah Bersih', 'Akan dilaksanakan Lomba Sekolah Bersih se Bekasi', 'FORM PENILAIAN.docx', 'JS002', 'US002', 'sudah', 'arsip'),
('SM004', '2018-01-18', 'srtpolsek/001/v01', '2018-01-16', 'Polsek Bekasi', 'SMKN  2 Kota Bekasi', 'Pembuatan SIM', 'Akan Dilaksanakan Pembuatan SIM Di Smkn2', 'Syarat dan Ketentuan Umum peserta.docx', 'JS004', 'US002', 'sudah', 'tidak'),
('SM005', '2018-01-27', 'sateki/02/2018', '2018-01-27', 'CV.Indo Sateki', 'BKK SMKN  2 Kota Bekasi', 'Penerimaan Siswa Prakerin', 'CV.indo sateki membutuhkan siswa magang di perusahaan', 'contoh soal A kelas XII.docx', 'JS005', 'US002', 'sudah', 'arsip'),
('SM006', '2018-02-05', 'nf/02/004/2018', '2018-02-04', 'PT.Nutrifood', 'BKK SMKN 2 Kota Bekasi', 'recruitment Pegawai', 'pt.nutrifood akan datang melakukan recruitment bagi siswa smkn2', 'contoh soal B kelas XII.docx', 'JS004', 'US002', 'sudah', 'tidak'),
('SM007', '2018-02-08', 'rt09/10/2018', '2018-02-08', 'RT 09', 'SMKN  2 Kota Bekasi', 'Gotong Royong', 'Diharapkan untuk gotong royong lingkungan rt.09', 'bunga.png', 'JS003', 'US002', 'belum', 'tidak'),
('SM008', '2018-02-09', 'unj/01/002', '2018-02-09', 'Universitas Negeri Jakarta', 'SMKN  2 Kota Bekasi', 'beasiswa kuliah', 'beasiswa kuliah untuk murid smk 2 bekasi', 'bab 2 a.docx', 'JS005', 'US002', 'belum', 'tidak'),
('SM009', '2018-01-10', 'SMK5/VI/2018', '2018-01-08', 'smkn 5 bekasi', 'SMKN  2 Kota Bekasi', 'Lomba', 'Akan Ada Lomba Di SMK 5', 'bangunlah dunia.jpg', 'JS003', 'US002', 'belum', 'tidak'),
('SM010', '2018-01-29', 'Digbud/02/2018', '2018-01-28', 'Kemendigbud', 'SMKN  2 Kota Bekasi', 'sosialisasi', 'akan diadakan sosialisasi di smk 2', '15 - 1.jpg', 'JS005', 'US002', 'belum', 'tidak'),
('SM011', '2018-02-15', 'surat/24/01/2018', '2018-02-14', 'Pak hanuji', 'SMKN  2 Kota Bekasi', 'minta cuti', 'minta cuti 2  hari', 'fais.jpg', 'JS004', 'US002', 'belum', 'tidak'),
('SM012', '2018-02-17', 'kmp/05/17/2018', '2018-02-16', 'Kemenpora', 'SMKN  2 Kota Bekasi', 'PON Jabar', 'Smkn 2 Diundang untuk mengikuti Pon', 'FAS1 sementara2.jpg', 'JS003', 'US002', 'belum', 'tidak'),
('SM013', '2018-02-19', 'walkot/19/02', '2018-02-18', 'Walikota Bekasi', 'SMKN  2 Kota Bekasi', 'kunjungan dinas', 'walkot dan jajaranya akan berkunjung ke smk2', 'Makalah.doc', 'JS001', 'US004', 'sudah', 'arsip'),
('SM014', '2018-02-06', '423.6/048/smkn2/.2-BP3', '2018-02-06', 'PT. ASA', 'SMKN  2 Kota Bekasi', 'Acc assesor', 'accecor dari PT.asa bersedia', 'cover.doc', 'JS005', 'US002', 'sudah', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `mail_out`
--

CREATE TABLE IF NOT EXISTS `mail_out` (
  `id` varchar(5) NOT NULL,
  `mail_code` varchar(75) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_to` varchar(75) NOT NULL,
  `mail_subject` varchar(75) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `mail_typeid` varchar(5) NOT NULL,
  `userid` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_out`
--

INSERT INTO `mail_out` (`id`, `mail_code`, `mail_date`, `mail_to`, `mail_subject`, `description`, `file_upload`, `mail_typeid`, `userid`) VALUES
('SK001', 'surat/30/01/2018', '2018-02-14', 'smkn 1 bekasi', 'sparing futsal', 'Smkn 2 Kota bekasi Kekurangan  buku di perpustakaan', 'PPK - BAB 1.docx', 'JS001', 'US002'),
('SK002', 'SMKN215/02/2018', '2018-02-15', 'Walikota Bekasi', 'Surat Balasan', 'Oke  SMKN2 akan ikut', 'Tidak Ada', 'JS005', 'US003'),
('SK003', 'SMKN215/02/2018', '2018-02-15', 'kecamatan Bantar Gerbang', 'Surat Balasan', 'okeeeee', 'Tidak Ada', 'JS001', 'US003'),
('SK004', 'smk2/17/2018', '2018-02-17', 'kelurahan Bantar gerbang', 'KTP pelajar smkn2', 'menanyakan lama jadinya KTP', 'Karakteristik (PLH).doc', 'JS005', 'US002'),
('SK005', 'SMKN217/02/2018', '2018-02-17', 'Polsek Bekasi', 'Surat Balasan', 'akan kami persipakan pak', 'Tidak Ada', 'JS005', 'US003'),
('SK006', 'SMKN219/02/2018', '2018-02-19', 'Walikota Bekasi', 'Surat Balasan', 'Oke kami sambut pak kedatangannya', 'Tidak Ada', 'JS005', 'US003'),
('SK007', 'SMKN220/02/2018', '2018-02-20', 'PT. ASA', 'Surat Balasan', 'oke surat terima', 'Tidak Ada', 'JS005', 'US003');

-- --------------------------------------------------------

--
-- Table structure for table `mail_type`
--

CREATE TABLE IF NOT EXISTS `mail_type` (
  `id` varchar(5) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_type`
--

INSERT INTO `mail_type` (`id`, `type`) VALUES
('JS001', 'Dinas'),
('JS002', 'Tugas'),
('JS003', 'Undangan'),
('JS004', 'Permohonan'),
('JS005', 'Resmi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `level`, `jabatan`, `picture`) VALUES
('US001', 'admin', '123', 'Zaidan Riski', 'admin', 'Programmer IT', 'gua.jpg'),
('US002', 'jidan', '123', 'Jidan Altama', 'operator', 'Staff TU', 'jdn.PNG'),
('US003', 'alfin', '123', 'Alfiansyah', 'pimpinan', 'Kepala Sekolah', 'tukul.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposition`
--
ALTER TABLE `disposition`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_out`
--
ALTER TABLE `mail_out`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_type`
--
ALTER TABLE `mail_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
