-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2025 at 10:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_qlsv`
--
CREATE DATABASE IF NOT EXISTS `web_qlsv` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `web_qlsv`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `pass`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `name`, `email`, `tel`, `note`) VALUES
(1, 'ág', 'e@mail.co', '0934276', 'ag'),
(2, 'ág', 'e@mail.co', '0934276', 'ag'),
(3, 'ág', 'e@mail.co', '0934276', 'ag'),
(4, 'a', 'a@mail.co', '34624652', 'éhgbs'),
(5, '2754', 'a@mail.co', '34624652', 'éhgbs'),
(6, 'ronaldo', 'a@gm.c', '9387541', 'haha');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` varchar(50) NOT NULL,
  `ten` varchar(50) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `sdt` varchar(50) DEFAULT NULL,
  `nganh` varchar(50) DEFAULT NULL,
  `lop` varchar(50) DEFAULT NULL,
  `cpa` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `ten`, `ngaysinh`, `mail`, `sdt`, `nganh`, `lop`, `cpa`) VALUES
('adsgjh', 'nam', '2033-12-23', 'a@m.c', '9823715', 'adsv', 'ádvb', 2.1),
('aikushgiu', 'Lamine Yamal', '2421-03-12', 'a@d.c', '2395711', 'dsiuhcv', 'uoiahsg', 3.6),
('b22812735981', 'nam', '1212-12-12', 'ad@d.c', '23459012385', 'cnđ', 'uyuidag9821', 3.3),
('B22DCCN015', 'Hoàng Văn P', '2004-01-25', 'p.hoang@example.com', '0901000015', 'HTTT', 'B22CQHT02-A', 3.5),
('B22DCCN016', 'Vũ Thị Q', '2004-02-14', 'q.vu@example.com', '0901000016', 'CNTT', 'B22CQCN04-A', 3.1),
('B22DCCN017', 'Đỗ Văn R', '2003-03-30', 'r.do@example.com', '0901000017', 'KTPM', 'B22CQPM03-A', 2.6),
('B22DCCN018', 'Bùi Thị S', '2004-04-12', 's.bui@example.com', '0901000018', 'HTTT', 'B22CQHT02-B', 3.2),
('B22DCCN019', 'Ngô Văn T', '2003-05-20', 't.ngo@example.com', '0901000019', 'CNTT', 'B22CQCN04-B', 2.9),
('B22DCCN020', 'Đặng Thị U', '2004-06-06', 'u.dang@example.com', '0901000020', 'KTPM', 'B22CQPM03-B', 3.4),
('B22DCCN021', 'Nguyễn Văn V', '2004-07-17', 'v.nguyen@example.com', '0901000021', 'CNTT', 'B22CQCN05-A', 3.6),
('B22DCCN022', 'Trần Thị X', '2003-08-08', 'x.tran@example.com', '0901000022', 'HTTT', 'B22CQHT03-A', 3.3),
('B22DCCN023', 'Lê Văn Y', '2004-09-01', 'y.le@example.com', '0901000023', 'CNTT', 'B22CQCN05-B', 3.7),
('B22DCCN024', 'Phạm Thị Z', '2004-10-11', 'z.pham@example.com', '0901000024', 'KTPM', 'B22CQPM04-A', 3),
('B22DCCN025', 'Hoàng Thị Ánh', '2003-11-22', 'anh.hoang@example.com', '0901000025', 'HTTT', 'B22CQHT03-B', 3.1),
('B22DCCN871', 'Nguyễn Đức Trung', '2004-05-05', 'trun@gmail.com', '0902155394', 'CNTT', 'B22CQCN07-B', 3.9),
('dskjfag', '10h37', '2124-03-12', 'e@m.c', '356257236246', 'dsajhgn', 'alskdug', 0.1),
('ẻah', 'Đầu Trứng', '2453-03-12', 'ae@mg.xcoom', '090127136', 'b22dccn712', 'aoihg', 3.6),
('ksajdng', 'add', '2040-12-12', 'a@c.c', '891760', 'iaduhg', 'udfgh', 1.2),
('onhgaiuwre', 'ajax', '1214-12-12', 'a@ga.c', '09iadg213', 'kágl', 'lưieuf', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
