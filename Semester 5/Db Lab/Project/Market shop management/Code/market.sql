-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 10:01 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `password`) VALUES
('admin', 'admin'),
('adean', 'adean');

-- --------------------------------------------------------

--
-- Table structure for table `licenserequest`
--

CREATE TABLE `licenserequest` (
  `skid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `IsApproved` varchar(20) NOT NULL,
  `lsdate` date NOT NULL,
  `ledate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE `performance` (
  `sid` int(11) NOT NULL,
  `dated` date NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` (`sid`, `dated`, `grade`) VALUES
(14, '2021-11-01', 4),
(7, '2021-11-01', 8),
(7, '2021-10-01', 5),
(6, '2021-11-17', 9),
(6, '2021-08-01', 6),
(7, '2021-11-01', 7),
(6, '2021-12-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `sid` int(11) NOT NULL,
  `skid` int(11) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `licensestart` date DEFAULT NULL,
  `licenseend` date DEFAULT NULL,
  `licensecharge` int(11) NOT NULL DEFAULT 0,
  `charges` int(11) NOT NULL DEFAULT 0,
  `pendingcharges` int(11) NOT NULL DEFAULT 0,
  `approval` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`sid`, `skid`, `sname`, `address`, `contact`, `licensestart`, `licenseend`, `licensecharge`, `charges`, `pendingcharges`, `approval`) VALUES
(3, 1, 'Tanishq Malu', 'Block-9, near nescafe, IIT Patna', 9098858227, NULL, NULL, 0, 0, 0, 'pending'),
(4, 2, 'Tanmay Malu', 'Block-6, near nescafe, IIT Patna', 9098858228, '2021-09-15', '2021-12-30', 0, 0, 0, 'approved'),
(5, 10, 'Tanmay Malu', 'Block-7, near nescafe, IIT Patna', 9565610106, NULL, NULL, 0, 0, 0, 'approved'),
(6, 14, 'jenish juice shop', 'Block-7, near nescafe, IIT Patna', 1111111111, '2021-11-30', '2021-12-30', 1000, 2000, 3000, 'approved'),
(7, 14, 'jenish snacks', 'CV Raman gate', 7285056295, '2021-11-10', '2021-11-18', 1000, 9000, 10000, 'approved'),
(8, 9, 'Malu shop', 'fruit shp, residential', 9898943426, '2021-11-02', '2021-12-17', 200, 1500, 1700, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `shopkeeper`
--

CREATE TABLE `shopkeeper` (
  `skid` int(11) NOT NULL,
  `skname` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopkeeper`
--

INSERT INTO `shopkeeper` (`skid`, `skname`, `gender`, `address`, `contact`, `dob`, `password`) VALUES
(9, 'Tanishq Malu', 'M', 'Vivekanand colony, Shivpuri - 473551', 9097858222, '2021-11-16', '202cb962ac59075b964b07152d234b70'),
(10, 'Tanmay Malu', 'M', 'bangalore', 9565610106, '2021-11-21', '202cb962ac59075b964b07152d234b70'),
(11, 'Sapna Malu', 'M', 'Vivekanand colony, Shivpuri - 473551    ', 9926449221, '2021-11-16', '202cb962ac59075b964b07152d234b70'),
(12, 'jenish', 'M', 'surat', 1111111111, '2021-11-18', '202cb962ac59075b964b07152d234b70'),
(13, 'jenish', 'M', 'A-101,New Boys Hostel, IIT Patna', 0, '2003-09-09', 'a67ef84afbf01ea3d84adda4fabc4adc'),
(14, 'jenish monpara', 'M', 'varachha, suratt', 7285056295, '2002-09-09', 'a67ef84afbf01ea3d84adda4fabc4adc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `licenserequest`
--
ALTER TABLE `licenserequest`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`sid`,`skid`);

--
-- Indexes for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  ADD PRIMARY KEY (`skid`,`dob`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  MODIFY `skid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
