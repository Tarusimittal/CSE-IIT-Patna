-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2021 at 02:41 PM
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
-- Database: `guesthouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookedrooms`
--

CREATE TABLE `bookedrooms` (
  `serial` int(11) NOT NULL,
  `room` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `floor` varchar(256) NOT NULL DEFAULT 'None',
  `id` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `guestname` varchar(256) NOT NULL,
  `indentorname` varchar(256) NOT NULL,
  `arrival` datetime NOT NULL,
  `departure` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookedrooms`
--

INSERT INTO `bookedrooms` (`serial`, `room`, `type`, `floor`, `id`, `username`, `guestname`, `indentorname`, `arrival`, `departure`) VALUES
(12, 'R-111', 'Deluxe', '1', '2e6f385aa2bd2418', 'tanishq', 'Tarusi', 'Tanishq Malu', '2021-12-21 00:00:00', '2021-12-23 00:00:00'),
(13, 'R-112', 'Normal', '1', '134199878b143b79', 'tanmay', 'Prashik', 'Tanmay Malu', '2021-11-30 17:42:00', '2021-12-01 17:42:00'),
(14, 'R-122', 'Normal', '1', '2739e3df1c7232b4', 'tanmay', 'Sapna Malu', 'Tanmay Malu', '2021-11-30 17:45:00', '2021-11-30 17:45:00'),
(15, 'R-123', 'Normal', '1', '2739e3df1c7232b4', 'tanmay', 'Sapna Malu', 'Tanmay Malu', '2021-11-30 17:45:00', '2021-11-30 17:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `guestname` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'Pending',
  `guestphone` varchar(12) NOT NULL,
  `appartment` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `state` varchar(256) NOT NULL,
  `pin` varchar(6) NOT NULL,
  `number_people` int(11) NOT NULL,
  `payment` varchar(256) NOT NULL DEFAULT 'Done',
  `number_rooms` int(11) NOT NULL,
  `accomodation` varchar(256) NOT NULL,
  `arrival` datetime NOT NULL,
  `departure` datetime NOT NULL,
  `purpose` varchar(256) NOT NULL DEFAULT 'General',
  `vegbreakfast` int(11) NOT NULL,
  `veglunch` int(11) NOT NULL,
  `vegdinner` int(11) NOT NULL,
  `nonvegbreakfast` int(11) NOT NULL DEFAULT 0,
  `nonveglunch` int(11) NOT NULL DEFAULT 0,
  `nonvegdinner` int(11) NOT NULL DEFAULT 0,
  `indentorname` varchar(256) NOT NULL,
  `employeeid` varchar(256) NOT NULL,
  `designation` varchar(256) NOT NULL,
  `department` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `requestedrooms` varchar(256) NOT NULL DEFAULT 'Master'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `username`, `guestname`, `status`, `guestphone`, `appartment`, `city`, `state`, `pin`, `number_people`, `payment`, `number_rooms`, `accomodation`, `arrival`, `departure`, `purpose`, `vegbreakfast`, `veglunch`, `vegdinner`, `nonvegbreakfast`, `nonveglunch`, `nonvegdinner`, `indentorname`, `employeeid`, `designation`, `department`, `phone`, `email`, `requestedrooms`) VALUES
('134199878b143b79', 'tanmay', 'Prashik', 'accepted', '1122334455', 'RJ road', 'Bhopal', 'MP', '462016', 2, 'On Arrival', 1, 'Deluxe', '2021-11-30 17:42:00', '2021-12-01 17:42:00', 'Meeting', 2, 2, 2, 0, 0, 0, 'Tanmay Malu', '2 ', 'hod', 'Computer Science and Engineering', '9565610206', 'tanmay.malu@gmail.com', 'R-112'),
('2739e3df1c7232b4', 'tanmay', 'Sapna Malu', 'accepted', '9926449221', 'Chetan House', 'Shivpuri', 'MP', '473551', 3, 'Debit Card', 2, 'Deluxe', '2021-11-30 17:45:00', '2021-11-30 17:45:00', 'Event', 3, 3, 3, 0, 0, 0, 'Tanmay Malu', '2 ', 'hod', 'Computer Science and Engineering', '9565610206', 'tanmay.malu@gmail.com', 'R-122,R-123'),
('2e6f385aa2bd2418', 'tanishq', 'Tarusi', 'accepted', '9781337500', 'House-no. 4688, darshan vihar, sector 68', 'Mohali', 'Punjab', '160062', 2, 'On Arrival', 1, 'Normal', '2021-12-21 00:00:00', '2021-12-23 00:00:00', 'Guest Lecture', 1, 1, 1, 1, 1, 1, 'Tanishq Malu', '1 ', 'CEO', 'Computer Science and Engineering', '9098858227', 'tanishq_1901cs63@iitp.ac.in', 'R-111');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `cost` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`id`, `Title`, `date`, `cost`, `Description`) VALUES
(1, 'misc', '2021-12-04', 400, 'Cleaning'),
(2, 'Misc.', '2021-11-30', 450, 'Cleaning'),
(3, 'Ration', '2021-12-01', 8000, 'Complete Ration.'),
(4, 'Wages', '2021-12-01', 20000, 'Salary To employees/workers');

-- --------------------------------------------------------

--
-- Table structure for table `guestdetails`
--

CREATE TABLE `guestdetails` (
  `name` varchar(255) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guestdetails`
--

INSERT INTO `guestdetails` (`name`, `contact`, `startdate`, `enddate`) VALUES
('Tarusi', 9781337500, '2021-12-21 00:00:00', '2021-12-23 00:00:00'),
('Tanishq', 9781337500, '2021-12-21 00:00:00', '2021-12-23 00:00:00'),
('Prashik', 1122334455, '2021-11-30 17:42:00', '2021-12-01 17:42:00'),
('Soumya', 1122334455, '2021-11-30 17:42:00', '2021-12-01 17:42:00'),
('Sapna Malu', 9926449221, '2021-11-30 17:45:00', '2021-11-30 17:45:00'),
('Sanjay Malu', 9926449221, '2021-11-30 17:45:00', '2021-11-30 17:45:00'),
('Tanishq Malu', 9926449221, '2021-11-30 17:45:00', '2021-11-30 17:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `floor` varchar(256) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room`, `type`, `floor`) VALUES
('R-101', 'Deluxe', '1'),
('R-102', 'Normal', '1'),
('R-103', 'Normal', '1'),
('R-111', 'Deluxe', '1'),
('R-112', 'Normal', '1'),
('R-113', 'Normal', '1'),
('R-121', 'Deluxe', '1'),
('R-122', 'Normal', '1'),
('R-123', 'Normal', '1'),
('R-131', 'Deluxe', '1'),
('R-132', 'Normal', '1'),
('R-133', 'Normal', '1'),
('R-201', 'Deluxe', '2'),
('R-202', 'Normal', '2'),
('R-203', 'Normal', '2'),
('R-211', 'Deluxe', '2'),
('R-212', 'Normal', '2'),
('R-213', 'Normal', '2'),
('R-221', 'Deluxe', '2'),
('R-222', 'Normal', '2'),
('R-223', 'Normal', '2'),
('R-231', 'Deluxe', '2'),
('R-232', 'Normal', '2'),
('R-233', 'Normal', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `designation` varchar(256) NOT NULL,
  `employeeid` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `department` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `designation`, `employeeid`, `phone`, `department`, `password`) VALUES
(1, 'tanishq', 'Tanishq Malu', 'tanishq_1901cs63@iitp.ac.in', 'CEO', '1', '9098858227', 'Computer Science and Engineering', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'tanmay', 'Tanmay Malu', 'tanmay.malu@gmail.com', 'hod', '2', '9565610206', 'Computer Science and Engineering', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'sanjay', 'Sanjay Malu', 'sanjay.malu@gmail.com', 'Professor', '3', '5544332211', 'Computer Science and Engineering', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'Madhur', 'madhur', 'madur@yahoo.com', 'Professor', '4', '2233441155', 'Civil Engineering', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Ramesh', 'Ramesh Babu', 'ramesh@gmail.com', 'Assisstant. Professor', '5', '3344552211', 'Mechanical Engineering', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookedrooms`
--
ALTER TABLE `bookedrooms`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookedrooms`
--
ALTER TABLE `bookedrooms`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
