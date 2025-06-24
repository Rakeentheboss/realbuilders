-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 05:16 PM
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
-- Database: `realbuilders`
--

-- --------------------------------------------------------

--
-- Table structure for table `atest`
--

CREATE TABLE `atest` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hafiz`
--

CREATE TABLE `hafiz` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `haider`
--

CREATE TABLE `haider` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hakim`
--

CREATE TABLE `hakim` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hanid`
--

CREATE TABLE `hanid` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hanif`
--

CREATE TABLE `hanif` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kjgh`
--

CREATE TABLE `kjgh` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modi`
--

CREATE TABLE `modi` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mostashfi`
--

CREATE TABLE `mostashfi` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `muntahar`
--

CREATE TABLE `muntahar` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `title` text NOT NULL,
  `contact_info` text NOT NULL,
  `location` text NOT NULL,
  `price` text NOT NULL,
  `id` int(11) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `photo1` varchar(20) DEFAULT NULL,
  `photo2` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`title`, `contact_info`, `location`, `price`, `id`, `photo`, `ownership_documents_path`, `lease_agreement_path`, `type`, `username`, `photo1`, `photo2`, `description`) VALUES
('A house', '12345', 'Dhaka', '1235', 1, 'Screenshot (160).png', 'Screenshot (33).png', 'Screenshot (93).png', 'Apartment', 'Rakeen', NULL, NULL, NULL),
('A Good House', '123456', 'Chittagong', '1234', 2, 'Screenshot (159).png', 'Screenshot (21).png', 'Screenshot (21).png', 'Skyline', 'Rakeen', NULL, NULL, NULL),
('A Building', '01768412722', 'Dhaka', '44', 4, 'Screenshot (158).png', 'Screenshot (146).png', 'Screenshot (168).png', 'Skyline', 'Rakeen', 'sheikhabdullah3.jpg', 'Screenshot (189).png', NULL),
('Suitable home', '1234', 'Chittagong', '3', 5, 'Screenshot (160).png', 'Screenshot (22).png', 'Screenshot (21).png', 'Mansion', 'Rakeen', 'Screenshot (141).png', 'Screenshot (189).png', '5 Beds 3 furnitures endless toilets');

-- --------------------------------------------------------

--
-- Table structure for table `raiyan`
--

CREATE TABLE `raiyan` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ree`
--

CREATE TABLE `ree` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`) VALUES
(1, 'Rakeen', 'islamrakeen8@gmail.com', '$2y$10$h5Lkd9DuZRSoBGEY6jcHguhq27NrurtBw1HETi57CwIZDhvIaXEau'),
(2, 'Maruf', 'maruf@gmail.com', '$2y$10$j3XGipP4X2CSe1rajZ6rQebRIovrvqQB6sIrs6ht/nzChSvg85M2W'),
(3, 'hj', 'maruf@gmail.com', '$2y$10$yc0ISTij.h/GqknpkBsjP.Sj1WrZKbN.ZWV4LxLj/InlTjrvKnkry'),
(4, 'sadid', 'sadid@gmail.com', '$2y$10$h0F2.N9CnTGjDiF.shO3K./1T5keNYaqXW3DmnNMfcxiwziJdwPMq'),
(5, 'Hakim', 'maruf@gmail.com', '$2y$10$jMZYpp56TQLhmi2BJ/xlV.BNHc.U0ZiSmvO11pc.3RZDby7kJQPp2'),
(6, 'amir', 'islamrakeen8@gmail.com', '$2y$10$w2aicotUYoyOtV3gG5gvMul8Cy/9t.d1K8CbExFwYCw0FAwyIC7UG'),
(7, 'muntahar', 'maruf@gmail.com', '$2y$10$YgggtJ0v4KjMdQjNrURMA.d40jF..FQV5lmOmz8IZZgdA6tdTudeC'),
(11, 'Haider', 'islamrakeen8@gmail.com', '$2y$10$OvKjL2ones7J7xYJuBi.qu6ey6jT61CsEJHdjzuH6E93xq8mOxvcO'),
(12, 'hafiz', 'maruf@gmail.com', '$2y$10$muPFdvFtilfjUOK0PwI17uE8GtGFTWUc1mZyAf7acuqTIav1a1v72'),
(13, 'hanif', 'asd@gmail.com', '$2y$10$9cmc8TE2jtRGixTPKMT4EujcvZLns65ECEc.0JSD1MP7ekJsXCpLy'),
(14, 'modi', 'rakeen@gmail.com', '$2y$10$1.M5gv5YHpxH2xPW7XDNX.c/HPgWGunG40ZQq.4M.Hn8JYMTd5e0m'),
(15, 'kjgh', 'rakeen@gmail.com', '$2y$10$FKUFQU19aoIv5V4zJWx5.e.dUjxydUPgM2cO6C7QykCFWeYuvoICm'),
(16, 'hanid', 'rakeen@gmail.com', '$2y$10$YStDuL/gGgyH4ui0jHUTqu2MkLPSnJQ4u5ABqscnOevoolRyUS.MS'),
(17, 'ree', 'maruf@gmail.com', '$2y$10$HX1DP5zt4pdStlqPjlne4.rdRWB7hSWSwimxzEFDv3SLNiuHlx0C6'),
(18, 'siam', 'islamrakeen8@gmail.com', '$2y$10$C2yfqwpdFLCNV3t2W4wi7eA37zsnp3oCI4GS3cfQPvVhQpL5dLgSm'),
(19, 'siam number 2 coz the first one broke', 'islamrakeen8@gmail.com', '$2y$10$VOIki95YHx.GGZ.rRl7dnu5/uq7rsHS4b47zi4ekQ6R5Kvzm8vvCa'),
(20, 'siam 3rd one coz the first 2 broke yassss', 'islamrakeen8@gmail.com', '$2y$10$wX6Jg1R7LMMHDlkJ3KX6oO1mgavS52kVlLQysCugUgLNolh/uIiVq'),
(21, 'Atest', 'islamrakeen8@gmail.com', '$2y$10$Rvk9./wHVhnt9NAjyfcoDefgkULaxr8EKghJcz7SxT/Ag2Mot8GUa'),
(22, 'Mostashfi', 'mostashfi@gmail.com', '$2y$10$5Y0r7s4pAaAcMrip./yf4.F50yZEtU82RACiJijRQql.WCKku7NrO'),
(23, 'Raiyan', 'raiyan@gmail.com', '$2y$10$3p.PpBIBgDr0SYzyN29OMOLHGBWN6fXeBxbebrw8gUSD1qUjVAuM6');

-- --------------------------------------------------------

--
-- Table structure for table `siam (girl version) best sister`
--

CREATE TABLE `siam (girl version) best sister` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siam 3rd one coz the first 2 broke yassss`
--

CREATE TABLE `siam 3rd one coz the first 2 broke yassss` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siam number 2 coz the first one broke`
--

CREATE TABLE `siam number 2 coz the first one broke` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ownership_documents_path` varchar(255) DEFAULT NULL,
  `lease_agreement_path` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atest`
--
ALTER TABLE `atest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hafiz`
--
ALTER TABLE `hafiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `haider`
--
ALTER TABLE `haider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hakim`
--
ALTER TABLE `hakim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hanid`
--
ALTER TABLE `hanid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hanif`
--
ALTER TABLE `hanif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kjgh`
--
ALTER TABLE `kjgh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modi`
--
ALTER TABLE `modi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mostashfi`
--
ALTER TABLE `mostashfi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muntahar`
--
ALTER TABLE `muntahar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raiyan`
--
ALTER TABLE `raiyan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ree`
--
ALTER TABLE `ree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `siam (girl version) best sister`
--
ALTER TABLE `siam (girl version) best sister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siam 3rd one coz the first 2 broke yassss`
--
ALTER TABLE `siam 3rd one coz the first 2 broke yassss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siam number 2 coz the first one broke`
--
ALTER TABLE `siam number 2 coz the first one broke`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atest`
--
ALTER TABLE `atest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hafiz`
--
ALTER TABLE `hafiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `haider`
--
ALTER TABLE `haider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hakim`
--
ALTER TABLE `hakim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hanid`
--
ALTER TABLE `hanid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hanif`
--
ALTER TABLE `hanif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kjgh`
--
ALTER TABLE `kjgh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modi`
--
ALTER TABLE `modi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mostashfi`
--
ALTER TABLE `mostashfi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `muntahar`
--
ALTER TABLE `muntahar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `raiyan`
--
ALTER TABLE `raiyan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ree`
--
ALTER TABLE `ree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `siam (girl version) best sister`
--
ALTER TABLE `siam (girl version) best sister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siam 3rd one coz the first 2 broke yassss`
--
ALTER TABLE `siam 3rd one coz the first 2 broke yassss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siam number 2 coz the first one broke`
--
ALTER TABLE `siam number 2 coz the first one broke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
