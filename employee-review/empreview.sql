-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2018 at 02:17 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `department` varchar(30) NOT NULL,
  `teamlead` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `employee_name`, `employee_id`, `department`, `teamlead`, `position`, `date`) VALUES
(2, 'sravani', 102, 'mesh', 'subbu', 'trainee', '0000-00-00'),
(3, 'bhargavi', 103, 'ios', 'subbu', 'trainee', '0000-00-00'),
(4, 'nikhila', 104, 'android', 'subbu', 'trainee', '0000-00-00'),
(5, 'sushmitha', 105, 'mesh', 'subbu', 'trainee', '0000-00-00'),
(6, 'sriyali', 106, 'ios', 'anjali', 'trainee', '2018-02-23'),
(7, 'srikanth', 107, 'android', 'anjali', 'trainee', '2018-02-23'),
(8, 'chaithanya', 108, 'php', 'anjali', 'trainee', '2018-02-23'),
(9, 'dinesh', 109, 'php', 'anjali', 'trainee', '2018-02-23'),
(10, 'raja', 110, 'javascipt', 'anjali', 'trainee', '2018-02-23'),
(11, 'subbu', 111, 'mesh', 'none', 'teamlead', '2018-02-23'),
(12, 'raghu', 999, 'none', 'none', 'manager', '2018-02-23'),
(13, 'anjali', 222, 'ios', 'none', 'teamlead', '2018-02-23'),
(14, 'vyshu', 54, 'mesh', 'subbu', 'jnr', '2018-02-26'),
(24, 'bhanu', 546, 'Android', 'Android', 'jnr', '2018-02-28'),
(0, 'karthika', 506, 'Mesh', 'Android', 'php developer', '2018-03-01'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02'),
(0, '', 0, 'none', 'none', '', '2018-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`id`, `username`, `password`, `employee_id`, `date`) VALUES
(1, 'subbu', 'subbu', 111, '2018-02-23'),
(2, 'anjali', 'anjali', 222, '2018-02-23'),
(3, 'raghu', 'raghu', 999, '2018-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `reviewdetails`
--

CREATE TABLE `reviewdetails` (
  `id` int(20) NOT NULL,
  `employeeid` int(20) DEFAULT NULL,
  `reviewerid` int(20) DEFAULT NULL,
  `fromdate` date DEFAULT NULL,
  `todate` date NOT NULL,
  `jobper` int(30) DEFAULT NULL,
  `jobcomments` varchar(30) DEFAULT NULL,
  `productivity` int(30) DEFAULT NULL,
  `procomments` varchar(30) DEFAULT NULL,
  `workquality` int(30) DEFAULT NULL,
  `workcomments` varchar(30) DEFAULT NULL,
  `techskills` int(30) DEFAULT NULL,
  `techcomments` varchar(30) DEFAULT NULL,
  `workconsis` int(30) DEFAULT NULL,
  `consiscomments` varchar(30) DEFAULT NULL,
  `enthusiasm` int(30) DEFAULT NULL,
  `enthcomments` varchar(30) DEFAULT NULL,
  `cooperation` int(30) DEFAULT NULL,
  `coopcomments` varchar(30) DEFAULT NULL,
  `attitude` int(30) DEFAULT NULL,
  `attitudecomments` varchar(30) DEFAULT NULL,
  `initiative` int(30) DEFAULT NULL,
  `initiativecomments` varchar(30) DEFAULT NULL,
  `workrelations` int(30) DEFAULT NULL,
  `relacomments` varchar(30) DEFAULT NULL,
  `creativity` int(30) DEFAULT NULL,
  `creativecomments` varchar(30) DEFAULT NULL,
  `punctuality` int(30) DEFAULT NULL,
  `puncomments` varchar(30) DEFAULT NULL,
  `attendance` int(30) DEFAULT NULL,
  `attencomments` varchar(30) DEFAULT NULL,
  `dependability` int(30) DEFAULT NULL,
  `depencomments` varchar(30) DEFAULT NULL,
  `communication` int(30) DEFAULT NULL,
  `commcomments` varchar(30) DEFAULT NULL,
  `overallrating` int(30) DEFAULT NULL,
  `ratingcomments` varchar(30) DEFAULT NULL,
  `oppcomments` varchar(30) DEFAULT NULL,
  `revcomments` varchar(30) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `average` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviewdetails`
--

INSERT INTO `reviewdetails` (`id`, `employeeid`, `reviewerid`, `fromdate`, `todate`, `jobper`, `jobcomments`, `productivity`, `procomments`, `workquality`, `workcomments`, `techskills`, `techcomments`, `workconsis`, `consiscomments`, `enthusiasm`, `enthcomments`, `cooperation`, `coopcomments`, `attitude`, `attitudecomments`, `initiative`, `initiativecomments`, `workrelations`, `relacomments`, `creativity`, `creativecomments`, `punctuality`, `puncomments`, `attendance`, `attencomments`, `dependability`, `depencomments`, `communication`, `commcomments`, `overallrating`, `ratingcomments`, `oppcomments`, `revcomments`, `date`, `average`) VALUES
(22, 103, 0, '2018-02-23', '2018-02-28', 3, 'ok', 2, 'ok', 3, 'ok', 2, 'ok', 4, 'ok', 1, 'ok', 3, 'ok', 2, 'ok', 4, 'ok', 3, 'ok', 1, 'ok', 4, 'ok', 3, 'ok', 2, 'ok', 1, 'ok', 3, 'ok', '0', 'excellent', '2018-02-23', 0),
(24, 102, 0, '2018-02-23', '2018-03-20', 3, 'hiring', 4, 'ok', 4, 'ok', 3, 'ok', 2, 'ok', 3, 'ok', 2, 'ok', 3, 'ok', 4, 'ok', 4, 'ok', 3, 'ok', 2, 'ok', 3, 'ok', 4, 'ok', 4, 'ok', 2, 'ok', 'ertyhj', 'fine', '2018-02-23', 3),
(26, 104, 0, '2018-02-25', '2018-02-27', 4, 'ok', 3, 'ok', 2, 'ok', 4, 'ok', 1, 'ok', 4, 'ok', 3, 'ok', 4, 'ok', 4, 'ok', 3, 'ok', 4, 'ok', 4, 'ok', 3, 'ok', 4, 'ok', 4, 'ok', 3, 'ok', '', '', '2018-02-25', 3),
(27, 107, 0, '2018-02-26', '2018-03-13', 4, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '2018-02-26', 0),
(28, 0, 0, '2018-02-27', '2018-02-27', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '2018-02-27', 0),
(29, 0, 0, '2018-02-27', '2018-02-27', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '2018-02-27', 0),
(30, 0, 0, '2018-02-27', '2018-02-27', 4, '', 3, '', 2, '', 3, '', 4, '', 2, '', 3, '', 4, '', 1, '', 3, '', 4, '', 3, '', 2, '', 1, '', 2, '', 3, '', ' x', '', '2018-02-27', 3),
(31, 0, 0, '2018-02-27', '2018-02-27', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '2018-02-27', 0),
(32, 0, 0, '2018-02-27', '2018-02-27', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '2018-02-27', 0),
(33, 103, 0, '2018-03-01', '2018-03-01', 4, 'excellent', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '2018-03-01', 0),
(34, 104, 0, '2018-03-01', '2018-03-03', 4, 'ok...', 2, 'ok...', 3, 'ok...', 3, 'ok...', 3, 'ok...', 0, 'ok...', 0, 'ok...', 3, 'ok...', 3, 'ok...', 4, 'ok...', 3, 'ok...', 1, 'ok...', 4, 'ok...', 3, 'ok...', 3, 'ok...', 2, 'ok...', 'waiting', 'upto the mark', '2018-03-01', 3),
(35, 54, 0, '2018-03-01', '2018-03-06', 4, 'interesting', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', '', '', '2018-03-01', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviewdetails`
--
ALTER TABLE `reviewdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviewdetails`
--
ALTER TABLE `reviewdetails`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
