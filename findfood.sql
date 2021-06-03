-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2021 at 07:27 AM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci,
  `active` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `img`, `active`) VALUES
(9, 'Pizza', '/foods/mLQQuCTDe4qyYmur_food1.png', 1),
(10, 'Eggs', '/foods/OXqR2ptPJ0d451F__food2.png', 1),
(11, 'Spagetti', '/foods/ihBAuNYuJtELDOix_food3.png', 1),
(12, 'Bun', '/foods/cn7oeHnAVhVhRcOm_food4.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_ingredient`
--

CREATE TABLE `food_ingredient` (
  `id` int NOT NULL,
  `food_id` int DEFAULT NULL,
  `ing_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food_ingredient`
--

INSERT INTO `food_ingredient` (`id`, `food_id`, `ing_id`) VALUES
(5, 9, 1),
(6, 9, 2),
(7, 9, 3),
(8, 9, 4),
(9, 9, 5),
(10, 10, 2),
(11, 10, 3),
(12, 10, 6),
(13, 11, 1),
(14, 11, 4),
(15, 12, 1),
(16, 12, 6),
(19, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id`, `title`, `active`) VALUES
(1, 'flour', 1),
(2, 'eggs', 1),
(3, 'salt', 1),
(4, 'tomato', 1),
(5, 'mushrooms', 1),
(6, 'love', 1),
(7, 'plants', 0),
(9, 'olive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1622576106),
('m210601_193636_create_food_table', 1622576727),
('m210601_193928_create_ingredient_table', 1622576727),
('m210601_194346_create_food_ingredient_table', 1622576728);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_ingredient`
--
ALTER TABLE `food_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-food_ingredient-food_id` (`food_id`),
  ADD KEY `idx-food_ingredient-ing_id` (`ing_id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food_ingredient`
--
ALTER TABLE `food_ingredient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_ingredient`
--
ALTER TABLE `food_ingredient`
  ADD CONSTRAINT `fk-food_ingredient-food_id` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-food_ingredient-ing_id` FOREIGN KEY (`ing_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
