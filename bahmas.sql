-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 06:55 AM
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
-- Database: `bahmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `id` int(11) NOT NULL,
  `child_first_name` varchar(50) NOT NULL,
  `child_middle_name` varchar(50) NOT NULL,
  `child_last_name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(255) NOT NULL,
  `height` text NOT NULL,
  `weight` int(50) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `mother_first_name` varchar(50) NOT NULL,
  `mother_middle_name` varchar(50) NOT NULL,
  `mother_last_name` varchar(50) NOT NULL,
  `father_first_name` varchar(50) NOT NULL,
  `father_middle_name` varchar(50) NOT NULL,
  `father_last_name` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`id`, `child_first_name`, `child_middle_name`, `child_last_name`, `gender`, `age`, `height`, `weight`, `birthday`, `mother_first_name`, `mother_middle_name`, `mother_last_name`, `father_first_name`, `father_middle_name`, `father_last_name`, `date`) VALUES
(11, 'haah', 'haha', 'asdas', 'male', 12, '12', 12, '2023-04-26', 'asda', 'sdasd', 'asda', 'adasd', 'asdasasdasd', 'asdasasdas', '2023-04-26'),
(14, 'test', 'test', 'test', 'male', 12, '12', 12, '2023-04-26', 'asda', 'sasd', 'asd', 'asda', 'sdas', 'dasda', '2023-04-26'),
(15, 'asdasd', 'asda', 'sdasd', 'male', 12, '12', 12, '2023-04-27', 'asd', 'asdasd', 'asda', 'sdas', 'dasd', 'asdas', '0000-00-00'),
(16, 'asd', 'asdas', 'dasd', 'male', 12, '12', 12, '2023-04-27', 'asd', 'asd', 'asda', 'asd', 'asd', 'asdas', '2023-04-27'),
(17, 'asda', 'asdasd', 'asdas', 'male', 12, '12', 12, '2023-04-27', 'asd', 'asda', 'sdas', 'asdas', 'dasd', 'das', '2023-04-27'),
(18, 'asdas', 'dasd', 'asdas', 'male', 12, '12', 12, '2023-04-27', 'sadas', 'das', 'das', 'asdas', 'asd', 'dasd', '2023-04-27'),
(19, 'asd', 'asda', 'sdas', 'male', 12, '12', 12, '2023-04-27', 'asd', 'asda', 'sdas', 'dasda', 'das', 'das', '2023-04-27'),
(20, 'asd', 'asdas', 'dasd', 'male', 12, '12', 12, '2023-04-27', 'asd', 'asd', 'asda', 'dasdas', 'sdas', 'sda', '2023-04-27'),
(21, 'asd', 'asdas', 'dasd', 'male', 12, '12', 12, '2023-04-27', 'asd', 'asdas', 'dasd', 'asd', 'asd', 'asdas', '2023-04-27'),
(22, 'asd', 'asda', 'sdas', 'male', 12, '112', 12, '2023-04-27', 'asd', 'asd', 'asda', 'das', 'sdas', 'asda', '2023-04-27'),
(23, 'asd', 'asd', 'asdas', 'male', 12, '12', 12, '2023-04-27', 'asd', 'asd', 'asd', 'asdas', 'asd', 'asd', '2023-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `arrival` date NOT NULL,
  `expiry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `temperature` int(255) NOT NULL,
  `blood_pressure` int(255) NOT NULL,
  `sickness` varchar(255) NOT NULL,
  `medicine` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `patient_name`, `temperature`, `blood_pressure`, `sickness`, `medicine`, `quantity`, `date`) VALUES
(1, 'arnold nillas', 12, 12, 'wew', 'paracetamol', 12, '2023-04-27'),
(3, 'asdas', 12, 12, 'gihilantan', 'biogesic', 2, '2023-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` int(12) NOT NULL,
  `weight` int(255) NOT NULL,
  `temperature` varchar(255) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `sickness` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `first_name`, `middle_name`, `last_name`, `age`, `gender`, `civil_status`, `birthday`, `birthplace`, `address`, `contact_number`, `weight`, `temperature`, `blood_pressure`, `blood_type`, `sickness`, `date`, `status`) VALUES
(19, 'asd', 'asdas', 'dasd', 12, 'male', 'single', '2023-04-26', 'asda', 'sdasd', 0, 12, 'dasdas', 'dasd', 'asdas', 'dasda', '2023-04-26', 'sdas');

-- --------------------------------------------------------

--
-- Table structure for table `population`
--

CREATE TABLE `population` (
  `id` int(11) NOT NULL,
  `purok_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `status` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `population`
--

INSERT INTO `population` (`id`, `purok_name`, `first_name`, `middle_name`, `last_name`, `gender`, `age`, `civil_status`, `house_no`, `street`, `barangay`, `city`, `birthdate`, `status`, `date`) VALUES
(4, 'asdas', 'wew', 'asda', 'asda', 'male', 12, 'single', 'asd', 'asd', 'asd', 'asda', '2023-04-26', 'asdas', '2023-04-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `population`
--
ALTER TABLE `population`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `population`
--
ALTER TABLE `population`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
