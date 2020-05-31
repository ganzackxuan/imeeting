-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2020 at 10:16 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imeeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `renter_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `host_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `renter_id`, `place_id`, `date`, `status`, `host_id`) VALUES
(19, 98, 14, '2020-02-03 00:00:00', 'Rated', 22),
(20, 98, 15, '2020-03-02 00:00:00', 'Rated', 753);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `comment` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `full_name`, `date`, `comment`, `image`, `rating`) VALUES
(13, 14, 'Gan Zack', '2020-05-31 07:44:54', 'Great', 'brick2.jpg', 3),
(14, 15, 'Gan Zack', '2020-05-31 08:02:02', 'nice', 'brick2.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `hostplace`
--

CREATE TABLE `hostplace` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `payment` double DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `host_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `open_time` varchar(255) DEFAULT NULL,
  `close_time` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hostplace`
--

INSERT INTO `hostplace` (`place_id`, `place_name`, `city`, `state`, `payment`, `image`, `host_id`, `description`, `street`, `open_time`, `close_time`, `postalcode`) VALUES
(13, 'Meeting Room 1', 'Petaling Jaya ', 'Selangor', 11, '03C7AA35-C236-4EDB-B7B3-529364B43E92.jpeg', 21, 'Near in Petaling jaya', 'Jalan Fake', '06:00', '07:00', '723'),
(14, 'Homestyle Meeting Room', 'Port Dickson', 'Negeri Sembilan', 11, 'IMG_2595.jpeg', 22, 'Cozy Home meeting room', 'Jalan Lama, Kampung Dhoby', '06:00', '07:00', '71000'),
(15, 'Fluffy Meeting Room', 'Johor Bahru', 'Johor', 30, 'meeting1.jpg', 753, 'Modern and well designed meeting room', 'Jalan Ismail', '06:00', '07:00', '213'),
(16, 'Meeting Room 2', 'Johor', 'Johor Bahru', 11, 'slik_meeting1.jpg', 753, 'Nice place with nice view', 'Jalan Dummy', '06:00', '07:00', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) DEFAULT NULL,
  `rater_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  `rate` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `countrycode` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bankaccount` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `full_name`, `password`, `created_date`, `type`, `city`, `state`, `age`, `countrycode`, `phonenumber`, `f_name`, `l_name`, `email`, `image`, `bankaccount`, `bank`) VALUES
(21, 'host1.com', '0', 'abcd1234', '2020-05-31 07:02:11', 1, 'Petaling Jaya', 'Negeri Sembilan', 22, '+60(Malaysia) ', '01844213', 'James', 'Nord', 'host1.com', 'brick2.jpg', '213214214124', 'Maybank'),
(22, 'dummy1.com', '1', 'abcd1234', '2020-05-31 07:09:03', 1, 'Port Dickson', 'Negeri Sembilan', 22, '+60(Malaysia) ', '0142322156', 'Dummy', '1', 'dummy1.com', 'FlowerPot.jpg', '4314141241', 'Public Bank'),
(98, 'zx@zx', 'zx@zx', 'abcd1234', '2020-05-31 06:56:47', 0, 'Port Dickson', 'Negeri Sembilan', 22, '+60(Malaysia) ', '213213', 'Gan', 'Zack', 'zx@zx', 'brick2.jpg', NULL, NULL),
(101, 'foo@gmail.com', 'foo@gmail.com', 'abcd1234', '2020-05-31 07:00:09', 0, 'Petaling Jaya', 'Selangor', 18, '+60(Malaysia) ', '0142322158', 'Kainan', 'Foo', 'foo@gmail.com', 'CamScanner 05-22-2020 12.59.31_1.jpg', NULL, NULL),
(753, 'dummy2.com', '2', 'abcd1234', '2020-05-31 07:21:20', 1, 'Johor Bahru', 'Johor', 19, '+60(Malaysia) ', '01523213', 'Dummy', '2', 'dummy2.com', 'NightSky10.jpg', '2412412412', 'Maybank');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostplace`
--
ALTER TABLE `hostplace`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hostplace`
--
ALTER TABLE `hostplace`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=754;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
