-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 10:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mare`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyId` int(11) NOT NULL,
  `fkIngredientListId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `billDate` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyId`, `fkIngredientListId`, `amount`, `billDate`) VALUES
(4, 1, 2, '2023-02-07 02:19:55.000000'),
(5, 1, 10, '2023-02-07 02:26:20.000000'),
(6, 2, 10, '2023-02-07 02:26:26.000000'),
(7, 3, 10, '2023-02-07 02:26:31.000000');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredient` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `fkMenuId` int(11) NOT NULL,
  `fkIngredientListId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingredient`, `used`, `fkMenuId`, `fkIngredientListId`) VALUES
(1, 10, 1, 1),
(2, 5, 1, 2),
(3, 5, 1, 3),
(4, 3, 2, 2),
(5, 3, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ingredientlist`
--

CREATE TABLE `ingredientlist` (
  `ingredientListId` int(11) NOT NULL,
  `ingredientListName` varchar(255) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredientlist`
--

INSERT INTO `ingredientlist` (`ingredientListId`, `ingredientListName`, `total`) VALUES
(1, 'ใบกะเพรา', 5),
(2, 'กะเทียม', 2),
(3, 'พริก', 11),
(4, 'มะเขือเทศ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuId` int(11) NOT NULL,
  `menuName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuId`, `menuName`) VALUES
(1, 'ผัดกะเพรา'),
(2, 'ข้าวผัด');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyId`),
  ADD KEY `fkIngrefientListId` (`fkIngredientListId`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredient`),
  ADD KEY `ingredient_ibfk_1` (`fkMenuId`),
  ADD KEY `fkIngredientListId` (`fkIngredientListId`);

--
-- Indexes for table `ingredientlist`
--
ALTER TABLE `ingredientlist`
  ADD PRIMARY KEY (`ingredientListId`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ingredientlist`
--
ALTER TABLE `ingredientlist`
  MODIFY `ingredientListId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`fkIngredientListId`) REFERENCES `ingredientlist` (`ingredientListId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`fkMenuId`) REFERENCES `menu` (`menuId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`fkIngredientListId`) REFERENCES `ingredientlist` (`ingredientListId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
