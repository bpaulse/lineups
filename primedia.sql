-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2019 at 02:51 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `lineup`
--

CREATE TABLE `lineup` (
  `lineup_id` int(5) NOT NULL,
  `station_id` int(5) NOT NULL,
  `lineup_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lineup`
--

INSERT INTO `lineup` (`lineup_id`, `station_id`, `lineup_desc`) VALUES
(1, 1, 'Lineup - Monday 13 May 2019'),
(2, 1, 'Lineup - Tuesday 14 May 2019'),
(3, 2, 'Lineup - Thursday 09 May 2019'),
(4, 2, 'Lineup - Sunday 12 May 2019'),
(5, 1, 'Lineup - Wednesday 15 May 2019'),
(6, 1, 'Lineup - Tuesday 07 May 2019'),
(7, 1, 'Lineup - Wednesday 08 May 2019'),
(8, 1, 'Lineup - Thursday 16 May 2019'),
(9, 1, 'Lineup - Friday 17 May 2019'),
(10, 2, 'Lineup - Saturday 11 May 2019'),
(11, 3, 'Lineup - Monday 13 May 2019'),
(12, 3, 'Lineup - Tuesday 14 May 2019'),
(13, 4, 'Lineup - Monday 13 May 2019');

-- --------------------------------------------------------

--
-- Table structure for table `presenter`
--

CREATE TABLE `presenter` (
  `presenter_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `main_presenter` enum('yes','no') NOT NULL DEFAULT 'yes',
  `stand_in_presenter` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `presenter`
--

INSERT INTO `presenter` (`presenter_id`, `user_id`, `main_presenter`, `stand_in_presenter`) VALUES
(1, 1, 'yes', NULL),
(2, 6, 'yes', NULL),
(3, 7, 'yes', NULL),
(4, 8, 'yes', NULL),
(5, 9, 'yes', NULL),
(6, 10, 'yes', NULL),
(7, 11, 'yes', NULL),
(8, 12, 'yes', NULL),
(9, 4, 'no', NULL),
(10, 5, 'no', NULL),
(11, 13, 'yes', NULL),
(12, 14, 'no', NULL),
(13, 15, 'yes', NULL),
(14, 3, 'yes', NULL),
(15, 16, 'yes', NULL),
(16, 17, 'yes', NULL),
(17, 18, 'yes', NULL),
(18, 19, 'yes', NULL),
(19, 20, 'yes', NULL),
(20, 21, 'yes', NULL),
(21, 22, 'yes', NULL),
(22, 23, 'yes', NULL),
(23, 24, 'yes', NULL),
(24, 25, 'yes', NULL),
(25, 26, 'yes', NULL),
(26, 27, 'yes', NULL),
(27, 28, 'yes', NULL),
(28, 29, 'yes', NULL),
(29, 30, 'yes', NULL),
(30, 45, 'yes', NULL),
(31, 46, 'yes', NULL),
(32, 47, 'yes', NULL),
(33, 48, 'yes', NULL),
(34, 49, 'yes', NULL),
(35, 50, 'yes', NULL),
(36, 51, 'yes', NULL),
(37, 52, 'yes', NULL),
(38, 53, 'yes', NULL),
(39, 54, 'yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `show`
--

CREATE TABLE `show` (
  `show_id` int(5) NOT NULL,
  `show_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `show`
--

INSERT INTO `show` (`show_id`, `show_name`) VALUES
(1, 'EARLY MORNINGS WITH LIEZEL'),
(2, 'KFM MORNINGS WITH DARREN, SHERLIN AND SIBS'),
(3, 'TRACEY LANGE'),
(4, 'RYAN O\'CONNOR'),
(5, 'THE FLASH DRIVE WITH CARL WASTIE'),
(6, 'KFM NIGHTS WITH BRANDON LEIGH'),
(7, 'Breakfast with Bongani Bingwa'),
(8, 'The Eusebius McKaiser Show'),
(9, 'The Xolani Gwala Show'),
(10, 'The Azania Mosaka Show'),
(11, 'Afternoon Drive with Joanne Joseph'),
(12, 'The Money Show with Bruce Whitfield'),
(13, 'The Karima Brown Show'),
(14, 'Weekend Breakfast with Phemelo Motene'),
(15, 'Soulful Sundays with Kenny Maistry'),
(16, 'Soulful Sundays with Paul Mtirara'),
(17, 'Soulful Sundays with Nonn Botha'),
(18, 'SportsTalk with Buhle Madulini'),
(19, 'NightTalk with Gushwell Brooks'),
(20, 'Early Breakfast with Abongile Nzelenzele'),
(21, 'Breakfast with Kieno Kammies'),
(22, 'Upfront with Refilwe Molotol'),
(23, 'The Xolani Gwala Show'),
(24, 'The Pippa Hudson Show'),
(25, 'The John Maytham Show'),
(26, 'The Money Show with Bruce Whitfield'),
(27, 'Tonight with Lester Kiewit'),
(28, 'NightTalk with Aubrey Masango'),
(29, 'The Alex Caige Show'),
(30, '947 Breakfast Club with Anele'),
(31, '947 Beats @ Work'),
(32, 'Ayanda MVP'),
(33, '947 Beats @ Work'),
(34, 'Afternoon Drive with Greg & Lucky'),
(35, 'The Night Show with Zweli & Mantsoe'),
(36, 'MAC G');

-- --------------------------------------------------------

--
-- Table structure for table `show_presenter`
--

CREATE TABLE `show_presenter` (
  `show_presenter_id` int(5) NOT NULL,
  `show_id` int(5) NOT NULL,
  `presenter_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `show_presenter`
--

INSERT INTO `show_presenter` (`show_presenter_id`, `show_id`, `presenter_id`) VALUES
(1, 1, 1),
(3, 2, 9),
(4, 2, 10),
(5, 2, 11),
(6, 5, 12),
(7, 5, 13),
(8, 3, 14),
(9, 14, 15),
(10, 15, 16),
(11, 16, 17),
(12, 17, 18),
(13, 18, 19),
(21, 19, 20),
(22, 20, 21),
(23, 21, 22),
(24, 22, 23),
(25, 23, 24),
(26, 24, 25),
(27, 25, 26),
(28, 26, 27),
(29, 27, 28),
(30, 29, 30),
(31, 30, 31),
(32, 31, 32),
(33, 32, 33),
(34, 33, 34),
(35, 34, 35),
(36, 34, 36),
(37, 35, 37),
(38, 35, 38),
(39, 36, 39);

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `station_id` int(5) NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `station_desc` text,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`, `station_desc`, `status`) VALUES
(1, 'KFM', 'KFM Radio Station', 'Active'),
(2, '702', '702 Radio Station', 'Active'),
(3, 'CapeTalk', 'Cape Talk Radio', 'Active'),
(4, '947', '94.7 High Veld', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `timeslot_id` int(5) NOT NULL,
  `lineup_id` int(5) NOT NULL,
  `timeslot_date` date NOT NULL,
  `timespanslot_id` int(5) NOT NULL,
  `show_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeslot_id`, `lineup_id`, `timeslot_date`, `timespanslot_id`, `show_id`) VALUES
(2, 1, '2019-05-13', 3, 1),
(3, 1, '2019-05-13', 4, 2),
(4, 1, '2019-05-13', 6, 3),
(5, 1, '2019-05-13', 10, 4),
(6, 1, '2019-05-13', 14, 5),
(7, 1, '2019-05-13', 17, 6),
(8, 3, '2019-05-09', 4, 7),
(9, 3, '2019-05-09', 6, 8),
(10, 3, '2019-05-09', 9, 9),
(11, 3, '2019-05-09', 11, 10),
(12, 3, '2019-05-09', 13, 11),
(13, 3, '2019-05-09', 15, 12),
(14, 3, '2019-05-09', 18, 13),
(15, 4, '2019-05-12', 19, 14),
(16, 4, '2019-05-12', 20, 15),
(17, 4, '2019-05-12', 21, 16),
(18, 4, '2019-05-12', 22, 17),
(19, 4, '2019-05-12', 23, 18),
(20, 4, '2019-05-12', 24, 19),
(21, 2, '2019-05-14', 3, 1),
(22, 2, '2019-05-14', 4, 2),
(23, 2, '2019-05-14', 6, 3),
(24, 2, '2019-05-14', 10, 4),
(25, 2, '2019-05-14', 14, 5),
(26, 2, '2019-05-14', 17, 6),
(27, 10, '2019-05-11', 19, 1),
(28, 10, '2019-05-11', 20, 1),
(29, 10, '2019-05-11', 21, 1),
(30, 10, '2019-05-11', 22, 1),
(31, 10, '2019-05-11', 23, 1),
(32, 10, '2019-05-11', 24, 1),
(33, 11, '2019-05-13', 26, 20),
(34, 11, '2019-05-13', 4, 21),
(35, 11, '2019-05-13', 6, 22),
(36, 11, '2019-05-13', 9, 23),
(37, 11, '2019-05-13', 11, 24),
(38, 11, '2019-05-13', 13, 25),
(39, 11, '2019-05-13', 15, 26),
(40, 11, '2019-05-13', 18, 27),
(41, 11, '2019-05-13', 25, 28),
(42, 11, '2019-05-14', 26, 20),
(43, 11, '2019-05-14', 4, 21),
(44, 11, '2019-05-14', 6, 22),
(45, 11, '2019-05-14', 9, 23),
(46, 11, '2019-05-14', 11, 24),
(47, 11, '2019-05-14', 13, 25),
(48, 11, '2019-05-14', 15, 26),
(49, 11, '2019-05-14', 18, 27),
(50, 11, '2019-05-14', 25, 28),
(51, 13, '2019-05-13', 3, 29),
(52, 13, '2019-05-13', 4, 30),
(53, 13, '2019-05-13', 27, 31),
(54, 13, '2019-05-13', 8, 32),
(55, 13, '2019-05-13', 28, 33),
(56, 13, '2019-05-13', 22, 34),
(57, 13, '2019-05-13', 17, 35),
(58, 13, '2019-05-13', 25, 36);

-- --------------------------------------------------------

--
-- Table structure for table `timespanslot`
--

CREATE TABLE `timespanslot` (
  `timespanslot_id` int(5) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timespanslot`
--

INSERT INTO `timespanslot` (`timespanslot_id`, `start_time`, `end_time`) VALUES
(1, '01:00:00', '04:00:00'),
(26, '04:00:00', '06:00:00'),
(2, '04:00:00', '07:00:00'),
(3, '05:00:00', '06:00:00'),
(4, '06:00:00', '09:00:00'),
(19, '06:00:00', '10:00:00'),
(5, '07:00:00', '10:00:00'),
(27, '09:00:00', '10:00:00'),
(6, '09:00:00', '12:00:00'),
(20, '10:00:00', '13:00:00'),
(7, '10:00:00', '14:00:00'),
(8, '10:00:00', '15:00:00'),
(9, '12:00:00', '13:00:00'),
(10, '12:00:00', '15:00:00'),
(11, '13:00:00', '15:00:00'),
(21, '13:00:00', '16:00:00'),
(12, '14:00:00', '18:00:00'),
(28, '15:00:00', '16:00:00'),
(13, '15:00:00', '18:00:00'),
(14, '15:00:00', '19:00:00'),
(22, '16:00:00', '19:00:00'),
(15, '18:00:00', '20:00:00'),
(16, '18:00:00', '21:00:00'),
(23, '19:00:00', '21:00:00'),
(17, '19:00:00', '22:00:00'),
(18, '20:00:00', '22:00:00'),
(24, '21:00:00', '00:00:00'),
(25, '22:00:00', '01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `firstname`, `lastname`, `email`) VALUES
(1, 'lvdm', 'Liezel', 'van der Westhuizen', NULL),
(2, 'roc', 'Ryan', 'O\'Connor', NULL),
(3, 'tlange', 'Tracey', 'Lange', NULL),
(4, 'sbarends', 'Sherlin', 'Barends', NULL),
(5, 'sibs', 'Sibongile', 'Mafu', NULL),
(6, 'bonganib', 'Bongani', 'Bingwa', NULL),
(7, 'eusebiusm', 'Eusebius', 'McKaiser', NULL),
(8, 'xolanig', 'Xolani', 'Gwala', NULL),
(9, 'azaniam', 'Azania', 'Mosaka', NULL),
(10, 'joannej', 'Joanne', 'Joseph', NULL),
(11, 'brucew', 'Bruce', 'Whitfield', NULL),
(12, 'karimab', 'Karima', 'Brown', NULL),
(13, 'darrens', 'Darren', 'Simpson', NULL),
(14, 'zoeb', 'Zoe', 'Brown', NULL),
(15, 'wastic', 'Carl', 'Wastie', NULL),
(16, 'pmotene', 'Phemelo', 'Motene', NULL),
(17, 'kmaistry', 'Kenny', 'Maistry', NULL),
(18, 'pmtirara', 'Paul', 'Mtirara', NULL),
(19, 'nbotha', 'Nonn', 'Botha', NULL),
(20, 'bmadulini', 'Buhle', 'Madulini', NULL),
(21, 'gbrooks', 'Gushwell', 'Brooks', NULL),
(22, 'anzelenzele', 'Abongile', 'Nzelenzele', NULL),
(23, 'kkammies', 'Kieno', 'Kammies', NULL),
(24, 'rmoloto', 'Refilwe', 'Moloto', NULL),
(25, 'xgwala', 'Xolani', 'Gwala', NULL),
(26, 'phudson', 'Pippa', 'Hudson', NULL),
(27, 'jmaytham', 'John', 'Maytham', NULL),
(28, 'bwhitfield', 'Bruce', 'Whitfield', NULL),
(29, 'lkiewit', 'Lester', 'Kiewit', NULL),
(30, 'amasango', 'Aubrey', 'Masango', NULL),
(45, 'acaige', 'Alex', 'Caige', NULL),
(46, 'Anele', 'Anele', 'Anele', NULL),
(47, 'bwork', 'Beats', 'Work', NULL),
(48, 'ayanda', 'Ayanda', '', NULL),
(49, 'bwork', 'Beats', 'Work', NULL),
(50, 'galdridge', 'Greg', 'Aldridge', NULL),
(51, 'luckydup', 'Lucky', 'Du Plessis', NULL),
(52, 'zmbhele', 'Zweli', 'Mbhele', NULL),
(53, 'mpout', 'Mantsoe', 'Pout', NULL),
(54, 'macg', 'MAC', 'Gee', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lineup`
--
ALTER TABLE `lineup`
  ADD PRIMARY KEY (`lineup_id`),
  ADD KEY `FK_Lineup_Station` (`station_id`);

--
-- Indexes for table `presenter`
--
ALTER TABLE `presenter`
  ADD PRIMARY KEY (`presenter_id`) USING BTREE,
  ADD KEY `FK_USER_ID` (`user_id`);

--
-- Indexes for table `show`
--
ALTER TABLE `show`
  ADD PRIMARY KEY (`show_id`) USING BTREE;

--
-- Indexes for table `show_presenter`
--
ALTER TABLE `show_presenter`
  ADD PRIMARY KEY (`show_presenter_id`) USING BTREE,
  ADD KEY `FK_SHOW_ID` (`show_id`),
  ADD KEY `FK_PRESENTER_ID` (`presenter_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`),
  ADD UNIQUE KEY `station_name` (`station_name`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`timeslot_id`),
  ADD KEY `FK_LINEUP_ID` (`lineup_id`),
  ADD KEY `timespanslot_id` (`timespanslot_id`);

--
-- Indexes for table `timespanslot`
--
ALTER TABLE `timespanslot`
  ADD PRIMARY KEY (`timespanslot_id`),
  ADD UNIQUE KEY `UC_Start_End_Time` (`start_time`,`end_time`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lineup`
--
ALTER TABLE `lineup`
  MODIFY `lineup_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `presenter`
--
ALTER TABLE `presenter`
  MODIFY `presenter_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `show`
--
ALTER TABLE `show`
  MODIFY `show_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `show_presenter`
--
ALTER TABLE `show_presenter`
  MODIFY `show_presenter_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `station_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timeslot_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `timespanslot`
--
ALTER TABLE `timespanslot`
  MODIFY `timespanslot_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lineup`
--
ALTER TABLE `lineup`
  ADD CONSTRAINT `FK_Lineup_Station` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`);

--
-- Constraints for table `presenter`
--
ALTER TABLE `presenter`
  ADD CONSTRAINT `FK_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `show_presenter`
--
ALTER TABLE `show_presenter`
  ADD CONSTRAINT `FK_PRESENTER_ID` FOREIGN KEY (`presenter_id`) REFERENCES `presenter` (`presenter_id`),
  ADD CONSTRAINT `FK_SHOW_ID` FOREIGN KEY (`show_id`) REFERENCES `show` (`show_id`);

--
-- Constraints for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD CONSTRAINT `FK_LINEUP_ID` FOREIGN KEY (`lineup_id`) REFERENCES `lineup` (`lineup_id`),
  ADD CONSTRAINT `FK_TIMESPANSLOT_ID` FOREIGN KEY (`timespanslot_id`) REFERENCES `timespanslot` (`timespanslot_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
