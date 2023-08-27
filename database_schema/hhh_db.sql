-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 05:13 PM
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
-- Database: `hhh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `holiday_homes`
--

CREATE TABLE `holiday_homes` (
  `home_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `availability_start` date DEFAULT NULL,
  `availability_end` date DEFAULT NULL,
  `description` text NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday_homes`
--

INSERT INTO `holiday_homes` (`home_id`, `name`, `location`, `availability_start`, `availability_end`, `description`, `rating`, `image_path`, `price`) VALUES
(1, 'Luxury villa', 'Florida', '2023-08-02', '2023-08-31', 'This luxury holiday home in Florida, USA is filled to the brim with an array of amazing facilities and luxury amenities. With 15,000 square feet of space, the unique mansion is just over five miles from Disneyland and has views over the world-famous Jack Nicklaus golf course. But there\'s something surprising here that may keep you indoors.', 4.0, 'assets/img/holiday-homes/Luxury-villa.jpg', 500.00),
(2, 'Downtown garden apartment', 'Florida', '2023-08-01', '2023-09-07', 'This modern apartment in Buena Vista, Colorado is the ideal space for a weekend getaway and holds a secret inside that\'s perfect for the active holidaymaker. With its own garden and seating area, it can sleep up to four people and has all the latest modern amenities.', 4.2, 'assets/img/holiday-homes/Downtown-garden-apartment.jpg', 400.00),
(3, 'Luxury villa2', 'Florida', '2023-08-01', '2023-08-31', 'However, hidden deep in the house is the ultimate in luxury entertainment: a bowling alley! With two lanes, it\'s the perfect place to get competitive and even has a comfortable lounge space and TV screens so you can keep track of who\'s winning. At £2,052 ($2,608) a night, with a minimum stay of four nights, it\'ll be an expensive game of bowling. ', 4.3, 'assets/img/holiday-homes/Luxury-villa2.jpg', 300.00),
(4, 'City escape', 'Florida', '2023-08-01', '2023-08-31', 'Designed as a break from busy city life, guests walk into a magical forest where the relaxing living room features a log stool and a fun swinging chair. The enchanting woodland doesn\'t come without modern-day amenities and includes a smart TV and air-conditioning. ', 3.9, 'assets/img/holiday-homes/City-escape.jpg', 360.00),
(5, 'Domus Civita', 'Florida', '2023-08-01', '2023-08-29', 'Located on the first floor of the house, the living room and kitchen are full of original features including a basalt stone fireplace, terracotta floors and wooden beams, which all date from the 14th century. Overall the villa can sleep six people in three bedrooms which are surrounded by arched doorways and exposed tufa rock.', 3.7, 'assets/img/holiday-homes/Domus-Civita.jpg', 470.00);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `home_id` int(255) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `user_id`, `home_id`, `check_in_date`, `check_out_date`, `total_price`) VALUES
(1, 1, 2, '2023-08-16', '2023-08-23', 2800.00),
(2, 1, 1, '2023-08-16', '2023-08-23', 3500.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'adhi', 'a@gmail.com', 1234567890, '1234'),
(2, 'WoofBot', 'adhirajfirst@gmail.com', 2147483647, '1234'),
(3, 'rhito', 'rhito@gmail.com', 2147483647, '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `holiday_homes`
--
ALTER TABLE `holiday_homes`
  ADD PRIMARY KEY (`home_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `foreign_key_user_id` (`user_id`),
  ADD KEY `foreign_key_home_id` (`home_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holiday_homes`
--
ALTER TABLE `holiday_homes`
  MODIFY `home_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `foreign_key_home_id` FOREIGN KEY (`home_id`) REFERENCES `holiday_homes` (`home_id`),
  ADD CONSTRAINT `foreign_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
