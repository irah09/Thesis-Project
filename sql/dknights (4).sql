-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2022 at 01:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dknights`
--

-- --------------------------------------------------------

--
-- Table structure for table `question_table`
--

CREATE TABLE `question_table` (
  `qid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `choice_one` varchar(255) NOT NULL,
  `choice_two` varchar(255) NOT NULL,
  `choice_three` varchar(255) NOT NULL,
  `grading_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_table`
--

INSERT INTO `question_table` (`qid`, `tid`, `question`, `answer`, `choice_one`, `choice_two`, `choice_three`, `grading_level`) VALUES
(1, 1, '10 / 5 ?', '2', '23', '4', '5', '2nd Grading');

-- --------------------------------------------------------

--
-- Table structure for table `score_table`
--

CREATE TABLE `score_table` (
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score_table`
--

INSERT INTO `score_table` (`sid`, `tid`, `uid`, `score`, `status`, `month`, `year`) VALUES
(2, 1, 5, 74, 'Fail', 'January', 1998),
(3, 1, 6, 80, 'Pass', 'January', 1998),
(4, 1, 7, 50, 'Fail', 'December', 1998),
(5, 2, 8, 80, 'Pass', 'January', 1999),
(7, 2, 5, 80, 'Pass', 'January', 1999),
(8, 1, 8, 80, 'Pass', 'June', 1998);

-- --------------------------------------------------------

--
-- Table structure for table `topic_table`
--

CREATE TABLE `topic_table` (
  `tid` int(11) NOT NULL,
  `topic_name` varchar(20) NOT NULL,
  `day` varchar(2) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic_table`
--

INSERT INTO `topic_table` (`tid`, `topic_name`, `day`, `month`, `year`) VALUES
(1, 'Division ', '1', 'January', '1998'),
(2, 'Multiplication   ', '1', 'January', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `middle_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `userlevel` varchar(15) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `session_login` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`uid`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `userlevel`, `photo`, `session_login`) VALUES
(1, 'admin', 'admin123', 'Irah', 'Serrano', 'Nuncio', 'Admin', 'nuncio.png', ''),
(2, 'user ', 'user123 ', ' Gabrielle ', ' Danielle ', ' Marcelo', 'Teacher', '1.jpg', ''),
(3, 'irah123', 'irah123', 'Irah', 'Serrano', 'Nuncio', 'Teacher', '2.jpg', ''),
(5, 'student2      ', 'student123      ', 'Kordapyo      ', 'Baluyot      ', 'Baltazars     ', 'Student', 'fire.jpg', ''),
(6, ' student3 ', ' student123 ', ' Dante ', ' Mascardo ', ' Solano ', 'Student', 'horse.png', ''),
(7, 'student4', 'student123', 'Marco', 'Dapinix', 'Antonio', 'Student', 'dragon.png', ''),
(8, 'student5', 'student123', 'Maro', 'Polo', 'Santos', 'Student', '6.jpg', ''),
(10, 'Teacher3', '123', 'Dong', 'Berto', 'Buknoy', 'Teacher', 'nuncio.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question_table`
--
ALTER TABLE `question_table`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `qid` (`qid`) USING BTREE;

--
-- Indexes for table `score_table`
--
ALTER TABLE `score_table`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `tid` (`tid`,`uid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `topic_table`
--
ALTER TABLE `topic_table`
  ADD PRIMARY KEY (`tid`) USING BTREE;

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question_table`
--
ALTER TABLE `question_table`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `score_table`
--
ALTER TABLE `score_table`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `topic_table`
--
ALTER TABLE `topic_table`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_table`
--
ALTER TABLE `question_table`
  ADD CONSTRAINT `question_table_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `topic_table` (`tid`);

--
-- Constraints for table `score_table`
--
ALTER TABLE `score_table`
  ADD CONSTRAINT `score_table_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user_table` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_table_ibfk_3` FOREIGN KEY (`tid`) REFERENCES `topic_table` (`tid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
