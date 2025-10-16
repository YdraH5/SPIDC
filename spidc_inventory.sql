-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2025 at 04:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spidc_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemcodesetup`
--

CREATE TABLE `itemcodesetup` (
  `RecordNo` int(11) NOT NULL,
  `DateInput` date NOT NULL DEFAULT current_timestamp(),
  `ItemCode` varchar(255) NOT NULL,
  `ItemDesc` varchar(255) NOT NULL,
  `TotSupply` int(11) NOT NULL,
  `TotSupplyLeft` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemcodesetup`
--

INSERT INTO `itemcodesetup` (`RecordNo`, `DateInput`, `ItemCode`, `ItemDesc`, `TotSupply`, `TotSupplyLeft`) VALUES
(4, '2025-10-16', '123', '12321', 500, 495),
(5, '2025-10-16', '123', '321', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `transentry`
--

CREATE TABLE `transentry` (
  `RecordNo` int(11) NOT NULL,
  `TransDate` date NOT NULL DEFAULT current_timestamp(),
  `AcctName` varchar(255) NOT NULL,
  `ItemCodeID` int(11) NOT NULL,
  `NumOfItem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transentry`
--

INSERT INTO `transentry` (`RecordNo`, `TransDate`, `AcctName`, `ItemCodeID`, `NumOfItem`) VALUES
(9, '2025-10-16', 'Test312', 4, 123),
(10, '2025-10-16', 'asdqwe', 4, 11),
(11, '2025-10-16', '12321', 4, 312),
(12, '2025-10-16', '12321', 4, 5123),
(13, '2025-10-16', '12321', 4, 1),
(14, '2025-10-16', 'asdqwe', 4, 1),
(15, '2025-10-16', 'Test312', 4, 1),
(16, '2025-10-16', '12321', 4, 5),
(17, '2025-10-16', 'Test312', 4, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemcodesetup`
--
ALTER TABLE `itemcodesetup`
  ADD PRIMARY KEY (`RecordNo`);

--
-- Indexes for table `transentry`
--
ALTER TABLE `transentry`
  ADD PRIMARY KEY (`RecordNo`),
  ADD KEY `ItemCodeID` (`ItemCodeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemcodesetup`
--
ALTER TABLE `itemcodesetup`
  MODIFY `RecordNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transentry`
--
ALTER TABLE `transentry`
  MODIFY `RecordNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transentry`
--
ALTER TABLE `transentry`
  ADD CONSTRAINT `fk_itemcode` FOREIGN KEY (`ItemCodeID`) REFERENCES `itemcodesetup` (`RecordNo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
