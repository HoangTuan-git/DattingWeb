-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2025 at 07:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dating_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `khuvuc`
--

CREATE TABLE `khuvuc` (
  `ID` int(11) NOT NULL,
  `TenTP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khuvuc`
--

INSERT INTO `khuvuc` (`ID`, `TenTP`) VALUES
(1, 'TPHCM'),
(2, 'Hà Nội'),
(3, 'Đà Nẵng'),
(4, 'Cần Thơ'),
(5, 'Hải Phòng'),
(6, 'Huế'),
(7, 'Nha Trang'),
(8, 'Đà Lạt');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text_content` varchar(255) DEFAULT NULL,
  `image_content` varchar(255) DEFAULT NULL,
  `vid_content` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nghenghiep`
--

CREATE TABLE `nghenghiep` (
  `ID` int(11) NOT NULL,
  `nghenghiep` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nghenghiep`
--

INSERT INTO `nghenghiep` (`ID`, `nghenghiep`) VALUES
(1, 'Sinh viên'),
(2, 'Developer'),
(3, 'Designer'),
(4, 'Giáo viên'),
(5, 'Bác sĩ'),
(6, 'Kỹ sư'),
(7, 'Nhân viên văn phòng'),
(8, 'Kinh doanh');

-- --------------------------------------------------------

--
-- Table structure for table `sothich`
--

CREATE TABLE `sothich` (
  `ID` int(11) NOT NULL,
  `SoThich` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sothich`
--

INSERT INTO `sothich` (`ID`, `SoThich`) VALUES
(1, 'Âm nhạc'),
(2, 'Du lịch'),
(3, 'Đọc sách'),
(4, 'Thể thao'),
(5, 'Chụp ảnh'),
(6, 'Chơi game'),
(7, 'Nấu ăn'),
(8, 'Xem phim');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `age`, `region_id`, `job_id`, `user_id`, `avatar`) VALUES
(1, 'Linh', 22, 1, 2, 1, '547-300x400.jpg'),
(2, 'Nam', 25, 2, 1, 2, '896-300x400.jpg'),
(3, 'An', 24, 1, 8, 3, '1070-300x400.jpg'),
(4, 'Mai', 23, 3, 4, 4, '904-300x400.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_hobbies`
--

CREATE TABLE `user_hobbies` (
  `user_id` int(11) NOT NULL,
  `hobby_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_hobbies`
--

INSERT INTO `user_hobbies` (`user_id`, `hobby_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 6),
(3, 5),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `mid` int(11) NOT NULL,
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `first_liked_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`mid`, `uid1`, `uid2`, `status`, `first_liked_by`) VALUES
(1, 1, 2, 'like', 1),
(4, 3, 1, 'like', 3),
(6, 1, 3, 'like', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `uid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`uid`, `email`, `password`, `code`) VALUES
(1, 'linh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(2, 'Nam@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(3, 'An@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(4, 'Mai@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `khuvuc`
--
ALTER TABLE `khuvuc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `nghenghiep`
--
ALTER TABLE `nghenghiep`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sothich`
--
ALTER TABLE `sothich`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD PRIMARY KEY (`user_id`,`hobby_id`),
  ADD KEY `hobby_id` (`hobby_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `uid1` (`uid1`),
  ADD KEY `uid2` (`uid2`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `khuvuc`
--
ALTER TABLE `khuvuc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nghenghiep`
--
ALTER TABLE `nghenghiep`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sothich`
--
ALTER TABLE `sothich`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `khuvuc` (`ID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `nghenghiep` (`ID`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`uid`);

--
-- Constraints for table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD CONSTRAINT `user_hobbies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_hobbies_ibfk_2` FOREIGN KEY (`hobby_id`) REFERENCES `sothich` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `user_status`
--
ALTER TABLE `user_status`
  ADD CONSTRAINT `user_status_ibfk_1` FOREIGN KEY (`uid1`) REFERENCES `user_table` (`uid`),
  ADD CONSTRAINT `user_status_ibfk_2` FOREIGN KEY (`uid2`) REFERENCES `user_table` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
