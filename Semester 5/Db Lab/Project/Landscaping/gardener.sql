-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 02:08 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gardener`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('miniproject', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `areadetails`
--

CREATE TABLE `areadetails` (
  `areaname` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `ismaintained` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `areadetails`
--

INSERT INTO `areadetails` (`areaname`, `size`, `ismaintained`) VALUES
('Block2', 10, 1),
('Block5', 22, 1),
('Block6', 7, 1),
('Block7', 10, 1),
('Block8', 13, 1),
('Block9', 4, 1),
('Block10', 8, 1),
('OldBoysHostel', 10, 1),
('OldGirlsHostel', 7, 1),
('NewBoysHostel', 19, 1),
('NewGirlsHostel', 12, 1),
('AdminBlock', 23, 1),
('MessArea', 10, 1),
('Block1', 7, 1),
('Block3', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `gardenerid` int(11) NOT NULL,
  `date` date NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`gardenerid`, `date`, `mark`) VALUES
(3, '2021-11-28', 1),
(4, '2021-11-28', 0),
(5, '2021-11-29', 0),
(7, '2021-11-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dutyroaster`
--

CREATE TABLE `dutyroaster` (
  `gardenerid` int(11) NOT NULL,
  `date` date NOT NULL,
  `areaname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dutyroaster`
--

INSERT INTO `dutyroaster` (`gardenerid`, `date`, `areaname`) VALUES
(3, '2021-11-28', 'Block1'),
(3, '2021-11-29', 'Block9'),
(3, '2021-11-30', 'Block7'),
(3, '2021-12-10', 'mess Backside'),
(4, '2021-11-28', 'sunday'),
(4, '2021-11-29', 'Adminblock'),
(6, '2021-11-29', 'Block3'),
(7, '2021-12-01', 'Block5'),
(7, '2021-12-02', 'Block5'),
(7, '2021-12-03', 'Block5');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipmentid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipmentid`, `status`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(19, 1),
(22, 1),
(30, 1),
(34, 1),
(36, 1),
(45, 1),
(54, 1),
(59, 1),
(65, 1),
(90, 1),
(231, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipmentrequest`
--

CREATE TABLE `equipmentrequest` (
  `erid` int(11) NOT NULL,
  `equipmentid` int(11) NOT NULL,
  `gardenerid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipmentrequest`
--

INSERT INTO `equipmentrequest` (`erid`, `equipmentid`, `gardenerid`, `status`) VALUES
(1, 231, 4, 2),
(2, 12, 4, 3),
(5, 231, 4, 3),
(6, 59, 4, 3),
(8, 22, 3, 3),
(9, 90, 3, 3),
(10, 30, 3, 2),
(11, 22, 4, 2),
(12, 30, 4, 3),
(13, 22, 4, 3),
(14, 36, 4, 3),
(15, 65, 4, 3),
(16, 34, 4, 3),
(17, 12, 3, 2),
(18, 45, 3, 3),
(19, 2, 3, 3),
(20, 2, 3, 3),
(21, 5, 3, 3),
(22, 3, 3, 3),
(23, 4, 3, 2),
(24, 54, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gardener`
--

CREATE TABLE `gardener` (
  `gardenerid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `contactno` bigint(20) NOT NULL,
  `workingarea` varchar(255) NOT NULL DEFAULT 'not assigned',
  `holiday` varchar(20) NOT NULL DEFAULT 'sunday',
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `username` varchar(55) NOT NULL,
  `doj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gardener`
--

INSERT INTO `gardener` (`gardenerid`, `name`, `dob`, `address`, `contactno`, `workingarea`, `holiday`, `password`, `gender`, `username`, `doj`) VALUES
(3, 'Tarusi Mittal', '2000-12-22', 'house no 4688,q block darshan vihar sector 68 mohali,punjab', 9781337500, 'mess Backside', 'sunday', '827ccb0eea8a706c4c34a16891f84e7b', 'F', 'Taru', '2021-10-07'),
(4, 'Tripati', '2005-01-29', 'house no 4688,q block darshan vihar sector 68 mohali,punjab', 9809899988, 'Adminblock', 'sunday', '827ccb0eea8a706c4c34a16891f84e7b', 'F', 'Tipi', '2021-10-07'),
(5, 'Tanishq Malu', '2001-04-18', 'Shivpuri', 9098858277, 'not assigned', 'sunday', '827ccb0eea8a706c4c34a16891f84e7b', 'M', 'tani', '2021-11-24'),
(6, 'Tejas', '2014-07-09', 'Mohali', 9809806468, 'Block3', 'sunday', '827ccb0eea8a706c4c34a16891f84e7b', 'M', 'tejas', '2021-10-07'),
(7, 'Puja Goyal', '1994-08-23', 'House no 147, Punjab', 8798798789, 'Block 5', 'sunday', '827ccb0eea8a706c4c34a16891f84e7b', 'F', 'puja', '2021-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `holidayrequest`
--

CREATE TABLE `holidayrequest` (
  `hrid` int(11) NOT NULL,
  `gardenerid` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `isApproved` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidayrequest`
--

INSERT INTO `holidayrequest` (`hrid`, `gardenerid`, `startdate`, `enddate`, `isApproved`) VALUES
(1, 3, '2021-11-28', '2021-11-28', 'denied'),
(2, 3, '2021-11-29', '2021-11-29', 'approved'),
(6, 5, '2021-11-28', '2021-11-29', 'approved'),
(7, 3, '2021-11-30', '2021-11-30', 'denied'),
(8, 3, '2021-12-03', '2021-12-03', 'pending'),
(9, 7, '2021-12-03', '2021-12-03', 'denied');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `srid` int(11) NOT NULL,
  `areaname` varchar(255) NOT NULL,
  `gardenerid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`srid`, `areaname`, `gardenerid`, `status`) VALUES
(1, 'block5', 3, 1),
(3, 'block2', 3, 1),
(4, 'block1', 4, 1),
(5, 'girls hostel ', 4, 1),
(6, 'block2', 3, 0),
(7, 'block8', 4, 0),
(8, 'boys hostel', 6, 0),
(9, 'new girls hostel', NULL, 0),
(10, 'mess 3 backyard', NULL, 0),
(11, 'admin block', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`gardenerid`,`date`);

--
-- Indexes for table `dutyroaster`
--
ALTER TABLE `dutyroaster`
  ADD PRIMARY KEY (`gardenerid`,`date`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipmentid`);

--
-- Indexes for table `equipmentrequest`
--
ALTER TABLE `equipmentrequest`
  ADD PRIMARY KEY (`erid`);

--
-- Indexes for table `gardener`
--
ALTER TABLE `gardener`
  ADD PRIMARY KEY (`gardenerid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `holidayrequest`
--
ALTER TABLE `holidayrequest`
  ADD PRIMARY KEY (`hrid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`srid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipmentrequest`
--
ALTER TABLE `equipmentrequest`
  MODIFY `erid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gardener`
--
ALTER TABLE `gardener`
  MODIFY `gardenerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `holidayrequest`
--
ALTER TABLE `holidayrequest`
  MODIFY `hrid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `srid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
