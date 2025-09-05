-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 07:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dimplestar`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `action` varchar(50) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_email`, `action`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 'nvtraquena7560pam@student.fatima.edu.ph', 'Signup Successful', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-05 04:48:49'),
(2, 'nvtraquena7560pam@student.fatima.edu.ph', 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-05 04:50:25'),
(3, 'nvtraquena7560pam@student.fatima.edu.ph', 'Logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-05 04:53:00'),
(4, 'nvtraquena7560pam@student.fatima.edu.ph', 'Login Failed - Wrong password', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-05 04:53:05'),
(5, 'nvtraquena7560pam@student.fatima.edu.ph', 'Login Successful', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-05 04:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` char(64) NOT NULL,
  `salt` char(32) NOT NULL,
  `role` enum('user','admin','superadmin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fname`, `lname`, `email`, `password`, `salt`, `role`, `created_at`) VALUES
(2, 'Super', 'Admin', 'superadmin@dimplestar.com', 'd121f394d37859adf9339a1e48cdccec54cf8226383d6c15b9f16d4fd319d190', '577d70da2c78719298f1db9735435430', 'superadmin', '2025-09-05 04:26:35'),
(3, 'jeyk', 'mart', 'jeyk@gmail.com', '4938630a4edc4f54b2f6550e9872555304c61281e38637766b49ac74fa33a9fe', '90e4e2e48f60fa659184ff0ff3419349', 'user', '2025-09-05 04:40:19'),
(4, 'andrei', 'traquena', 'nvtraquena7560pam@student.fatima.edu.ph', 'c34a8e459f7bf9f09b01d47cc071f71f50123188b8383b5aeecd338eb6ca73e7', 'd342284b745562007cb0988715a648f3', 'user', '2025-09-05 04:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `content`) VALUES
(1, 'about', '<h3>Our Story</h3><p>Founded in the early 1990s ...</p>');

-- --------------------------------------------------------

--
-- Table structure for table `regs`
--

CREATE TABLE `regs` (
  `ticket` int(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bustype` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `seat_no` varchar(255) DEFAULT NULL,
  `timetodep` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `regs`
--

INSERT INTO `regs` (`ticket`, `name`, `address`, `mobile`, `email`, `bustype`, `origin`, `destination`, `price`, `seat_no`, `timetodep`) VALUES
(1, 'A', 'B', '123465', 'C@D.COM', 'Ordinary', 'Espana', 'San Jose', '200', '7', '5:30am'),
(2, 'A', 'B', '123465', 'C@D.COM', 'Ordinary', 'Espana', 'San Jose', '200', '8', '5:30am'),
(3, 'A', 'B', '123465', 'C@D.COM', 'Ordinary', 'Espana', 'San Jose', '200', '9', '5:30am'),
(4, 'A', 'B', '123465', 'C@D.COM', 'Ordinary', 'Espana', 'San Jose', '200', '10', '5:30am'),
(5, 'A', 'B', '123465', 'C@D.COM', 'Ordinary', 'Espana', 'San Jose', '200', '11', '5:30am'),
(6, 'A', 'B', '123465', 'C@D.COM', 'Ordinary', 'Espana', 'San Jose', '200', '12', '5:30am'),
(7, 'A', 'B', '123465', 'C@D.COM', 'Ordinary', 'Espana', 'San Jose', '200', '13', '5:30am');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `busid` int(20) NOT NULL,
  `origin` varchar(20) NOT NULL,
  `destination` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `bustype` varchar(20) NOT NULL,
  `smsstat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`busid`, `origin`, `destination`, `time`, `price`, `bustype`, `smsstat`) VALUES
(1, 'Ali Mall Cubao', 'San Jose', '10am', '300', 'Air Conditioned', 'None'),
(2, 'Ali Mall Cubao', 'San Jose', '9am', '300', 'Air Conditioned', 'None'),
(3, 'Ali Mall Cubao', 'San Jose', '1pm', '300', 'Air Conditioned', 'none'),
(4, 'Ali Mall Cubao', 'San Jose', '4pm', '300', 'Air Conditioned', 'none'),
(5, 'Alabang', 'San Jose', '6am', '300', 'Air Conditioned', 'None'),
(6, 'Alabang', 'San Jose', '7am', '300', 'Air Conditioned', 'None'),
(7, 'Alabang', 'San Jose', '2pm', '300', 'Air Conditioned', 'none'),
(8, 'Alabang', 'San Jose', '6pm', '300', 'Air Conditioned', 'none'),
(9, 'Alabang', 'San Jose', '10pm', '300', 'Air Conditioned', 'none'),
(10, 'Cabuyao ', 'San Jose', '8am', '300', 'Air Conditioned', 'None'),
(11, 'Cabuyao ', 'San Jose', '9am', '300', 'Air Conditioned', 'None'),
(12, 'Cabuyao ', 'San Jose', '4pm', '300', 'Air Conditioned', 'none'),
(13, 'Cabuyao ', 'San Jose', '8pm', '300', 'Air Conditioned', 'none'),
(14, 'Espana', 'San Jose', '4:30am', '300', 'Air Conditioned', 'None'),
(15, 'Espana', 'San Jose', '5:30am', '300', 'Air Conditioned', 'None'),
(16, 'Espana', 'San Jose', '12am', '300', 'Air Conditioned', 'none'),
(17, 'Espana', 'San Jose', '4pm', '300', 'Air Conditioned', 'none'),
(18, 'Espana', 'San Jose', '8pm', '300', 'Air Conditioned', 'none'),
(19, 'San Lorenzo', 'San Jose', '3am', '300', 'Air Conditioned', 'None'),
(20, 'San Lorenzo', 'San Jose', '4:30am', '200', 'Air Conditioned', 'None'),
(21, 'San Lorenzo', 'San Jose', '11am', '300', 'Air Conditioned', 'none'),
(22, 'San Lorenzo', 'San Jose', '3pm', '300', 'Air Conditioned', 'none'),
(23, 'San Lorenzo', 'San Jose', '7pm', '300', 'Air Conditioned', 'none'),
(24, 'Pasay', 'San Jose', '5am', '300', 'Air Conditioned', 'None'),
(25, 'Pasay', 'San Jose', '6am', '300', 'Air Conditioned', 'none'),
(26, 'Pasay', 'San Jose', '1pm', '300', 'Air Conditioned', 'none'),
(27, 'Pasay', 'San Jose', '3pm', '300', 'Air Conditioned', 'none'),
(28, 'Ali Mall Cubao', 'San Jose', '10am', '200', 'Ordinary', 'None'),
(29, 'Ali Mall Cubao', 'San Jose', '9am', '200', 'Ordinary', 'None'),
(30, 'Ali Mall Cubao', 'San Jose', '1pm', '200', 'Ordinary', 'none'),
(31, 'Ali Mall Cubao', 'San Jose', '4pm', '200', 'Ordinary', 'none'),
(32, 'Alabang', 'San Jose', '6am', '200', 'Ordinary', 'None'),
(33, 'Alabang', 'San Jose', '7am', '200', 'Ordinary', 'None'),
(34, 'Alabang', 'San Jose', '2pm', '200', 'Ordinary', 'none'),
(35, 'Alabang', 'San Jose', '6pm', '200', 'Ordinary', 'none'),
(36, 'Alabang', 'San Jose', '10pm', '200', 'Ordinary', 'none'),
(37, 'Cabuyao ', 'San Jose', '8am', '200', 'Ordinary', 'None'),
(38, 'Cabuyao ', 'San Jose', '9am', '200', 'Ordinary', 'None'),
(39, 'Cabuyao ', 'San Jose', '4pm', '200', 'Ordinary', 'none'),
(40, 'Cabuyao ', 'San Jose', '8pm', '200', 'Ordinary', 'none'),
(41, 'Espana', 'San Jose', '4:30am', '200', 'Ordinary', 'None'),
(42, 'Espana', 'San Jose', '5:30am', '200', 'Ordinary', 'None'),
(43, 'Espana', 'San Jose', '12am', '200', 'Ordinary', 'none'),
(44, 'Espana', 'San Jose', '4pm', '200', 'Ordinary', 'none'),
(45, 'Espana', 'San Jose', '8pm', '200', 'Ordinary', 'none'),
(46, 'San Lorenzo', 'San Jose', '3am', '200', 'Ordinary', 'None'),
(47, 'San Lorenzo', 'San Jose', '4:30am', '200', 'Ordinary', 'None'),
(48, 'San Lorenzo', 'San Jose', '11am', '200', 'Ordinary', 'none'),
(49, 'San Lorenzo', 'San Jose', '3pm', '200', 'Ordinary', 'none'),
(50, 'San Lorenzo', 'San Jose', '7pm', '200', 'Ordinary', 'none'),
(51, 'Pasay', 'San Jose', '5am', '200', 'Ordinary', 'None'),
(52, 'Pasay', 'San Jose', '6am', '200', 'Ordinary', 'none'),
(53, 'Pasay', 'San Jose', '1pm', '200', 'Ordinary', 'none'),
(54, 'Pasay', 'San Jose', '3pm', '200', 'Ordinary', 'none');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_name` (`page_name`);

--
-- Indexes for table `regs`
--
ALTER TABLE `regs`
  ADD PRIMARY KEY (`ticket`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`busid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `regs`
--
ALTER TABLE `regs`
  MODIFY `ticket` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `busid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
