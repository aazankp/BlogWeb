-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 08:17 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `post_at` varchar(255) NOT NULL,
  `post_added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`id`, `content`, `image`, `post_at`, `post_added_by`) VALUES
(45, 'sdfsdfsdfsdfsdfsdf', '../Images/39888_361658477_292890489936878_1348581864583322500_n.jpg', '2023-10-01 11:03:05pm', 1),
(46, 'asdasdasdasdasdas', '../Images/96573_8-83719_best-wallpaper-for-laptop.jpg', '2023-10-08 05:32:50pm', 1),
(47, 'jdlsfjsdljfsdklfjl', '../Images/86014_Ertugrul.jpg', '2023-10-08 05:34:26pm', 1),
(48, 'sjdlfjsdljflsdjfklsdf', '../Images/43914_00e0830cf439d2599b2d21374a7ed2e1.jpg', '2023-10-08 09:36:09pm', 3);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `comment_at` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `comment_at`, `post_id`, `comment_by`) VALUES
(1, 'asdasdasd', '2023-10-08 05:07:07pm', 45, 1),
(2, 'Superb', '2023-10-08 05:07:38pm', 45, 1),
(3, 'Awesome', '2023-10-08 05:08:25pm', 45, 1),
(4, 'Nice Pic', '2023-10-08 05:35:13pm', 46, 1),
(5, 'Good Picture', '2023-10-08 09:36:57pm', 48, 3),
(6, 'Good Looking', '2023-10-22 04:15:18pm', 47, 1),
(7, 'Good News', '2023-10-22 04:18:38pm', 45, 2),
(8, 'Great', '2023-10-22 04:31:26pm', 47, 2),
(9, 'asadsdas', '2023-10-22 04:33:03pm', 46, 2),
(10, 'New Comment', '2023-10-22 04:39:56pm', 46, 2),
(11, 'asddsad', '2023-10-22 04:41:32pm', 47, 2),
(12, 'Nice Natural View', '2023-10-22 09:55:12pm', 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(2, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `gender` varchar(233) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fname`, `lname`, `email`, `password`, `profile_picture`, `gender`) VALUES
(1, 'Aazan Khan', 'Pathan', 'aazank517@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '../Images/14191_WhatsApp Image 2022-07-30 at 11.42.46 AM.jpg', 'Male'),
(2, 'Ali', 'Khan', 'ali@gmail.com', '86318e52f5ed4801abe1d13d509443de', '../Images/42269_bb49d0b46e95f6430daf0508e6052b2b.jpg', 'Male'),
(3, 'Shahzaib', 'Khan', 'shahzaib@gmail.com', 'eca229fc0b44249b57be702acc7e29e3', '../Images/83160_shahzaib.jpg', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
