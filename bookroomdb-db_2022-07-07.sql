-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2022 at 10:26 PM
-- Server version: 8.0.23
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookroomdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int NOT NULL,
  `roomID` int NOT NULL,
  `customerID` int NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `booking_extras` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `review` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `roomID`, `customerID`, `checkin_date`, `checkout_date`, `contactNumber`, `booking_extras`, `review`) VALUES
(2, 1, 5, '2022-06-30', '2022-07-02', '222-332-3432', 'extra sheets plz', ''),
(11, 2, 4, '2022-07-14', '2022-07-16', '542', '', NULL),
(25, 6, 7, '2022-08-16', '2022-08-19', '123-234-2346', 'extra towel', ''),
(27, 1, 1, '2022-08-08', '2022-08-13', '456-789-0123', 'extra bedsheets and towel please', ''),
(28, 5, 15, '2022-08-16', '2022-08-19', '000-111-2222', '', NULL),
(30, 13, 18, '2022-09-05', '2022-09-08', '444-213-8972', '', NULL),
(31, 3, 13, '2022-09-13', '2022-09-16', '222-131-1552', 'extra towel please', NULL),
(32, 3, 13, '2022-09-13', '2022-09-16', '222-131-1552', 'extra towel please', NULL),
(33, 4, 6, '2022-09-13', '2022-09-16', '129-098-1542', 'extra towels please', NULL),
(34, 4, 4, '2022-07-22', '2022-07-25', '222-131-1552', '', NULL),
(35, 4, 4, '2022-07-22', '2022-07-25', '222-131-1552', '', NULL),
(36, 4, 7, '2022-10-09', '2022-10-12', '567-092-1435', '', NULL),
(37, 4, 7, '2022-10-09', '2022-10-12', '567-092-1435', '', NULL),
(38, 4, 7, '2022-10-09', '2022-10-12', '567-092-1435', '', NULL),
(39, 4, 7, '2022-10-09', '2022-10-12', '567-092-1435', '', NULL),
(40, 3, 5, '2022-09-13', '2022-09-15', '232-132-6754', '', NULL),
(41, 3, 5, '2022-09-13', '2022-09-15', '232-132-6754', '', NULL),
(42, 9, 9, '2022-08-14', '2022-08-17', '123-645-9871', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'Garrison', 'Jordan', 'sit.amet.ornare@nequesedsem.edu', NULL),
(2, 'Desiree', 'Collier', 'Maecenas@non.co.uk', NULL),
(3, 'Irene', 'Walker', 'id.erat.Etiam@id.org', NULL),
(4, 'Forrest', 'Baldwin', 'eget.nisi.dictum@a.com', NULL),
(5, 'Beverly', 'Sellers', 'ultricies.sem@pharetraQuisqueac.co.uk', NULL),
(6, 'Glenna', 'Kinney', 'dolor@orcilobortisaugue.org', NULL),
(7, 'Montana', 'Gallagher', 'sapien.cursus@ultriciesdignissimlacus.edu', NULL),
(8, 'Harlan', 'Lara', 'Duis@aliquetodioEtiam.edu', NULL),
(9, 'Benjamin', 'King', 'mollis@Nullainterdum.org', NULL),
(13, 'neel', 'green', 'neel123@gmail.com', 'neelgreen'),
(14, 'neel', 'green', 'neelpari@gmail.com', 'neelpari123'),
(15, 'raj', 'taylor', 'taylor22@gmail.com', 'taylor22'),
(17, 'james', 'sollen', 'jamessollen@gmail.com', 'sollen2022'),
(18, 'james', 'arden', 'ardenj@ymail.com', 'ardenjames');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int NOT NULL,
  `roomname` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `roomtype` char(1) NOT NULL,
  `bed` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomname`, `description`, `roomtype`, `bed`) VALUES
(1, 'Kellie', 'everything is changed', 'S', 2),
(2, 'Herman', 'Lorem ipsum dolor sit amet, consectetuer', 'D', 1),
(3, 'Scarlett', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur', 'D', 2),
(4, 'Jelani', 'new beds and fine wooden furniture', 'D', 5),
(5, 'victoria', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod', 'D', 2),
(6, 'sonia', 'ommodo consequat. Duis aute irure dolor in reprehenderit in voluptat', 'S', 5),
(9, 'marvel', 'ipsum quia dolor sit amet, consectetur, adipisci velit.&quot;', 'D', 3),
(13, 'marvellous', 'renovated room', 'S', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `FK_customerID` (`customerID`),
  ADD KEY `FK_roomID` (`roomID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_customerID` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_roomID` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
