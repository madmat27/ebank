-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 07:18 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mazi`
--
CREATE DATABASE IF NOT EXISTS `mazi` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `mazi`;

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

DROP TABLE IF EXISTS `Accounts`;
CREATE TABLE IF NOT EXISTS `Accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `cusID` int(11) NOT NULL,
  `friendlyName` text COLLATE utf8_unicode_ci NOT NULL,
  `IBAN` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doc` date NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  PRIMARY KEY (`accountID`),
  KEY `Fkey` (`cusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10002 ;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`accountID`, `cusID`, `friendlyName`, `IBAN`, `doc`, `balance`) VALUES
(1, 1, 'iBank', 'GR00 1234 5678 1234 5678 1234 567', '0000-00-00', '97680480.00');

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
CREATE TABLE IF NOT EXISTS `Customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `sex` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10003 ;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`customerID`, `name`, `lastname`, `email`, `password`, `dob`, `sex`) VALUES
(1, 'iBank', 'iBank', 'info@ibank.gr', '123456', '0000-00-00', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `MoneyTransfer`
--

DROP TABLE IF EXISTS `MoneyTransfer`;
CREATE TABLE IF NOT EXISTS `MoneyTransfer` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `billingAccountID` int(11) NOT NULL,
  `creditAccountID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `dot` datetime NOT NULL,
  `infos` text COLLATE utf8_unicode_ci NOT NULL,
  `showRecent` int(1) NOT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `billingAccountID` (`billingAccountID`),
  KEY `creditAccountID` (`creditAccountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `MoneyTransfer`
--

INSERT INTO `MoneyTransfer` (`paymentID`, `billingAccountID`, `creditAccountID`, `amount`, `dot`, `infos`, `showRecent`) VALUES
(1, 1, 5, '100.00', '2019-03-16 18:49:47', 'Αρχικοποίηση λογαριασμού', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

DROP TABLE IF EXISTS `Payments`;
CREATE TABLE IF NOT EXISTS `Payments` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `paymentTypeID` int(11) NOT NULL,
  `paymentCode` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `dot` datetime NOT NULL,
  `accountID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `showRecent` int(1) NOT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `accountID` (`accountID`),
  KEY `customerID` (`customerID`),
  KEY `paymentTypeID` (`paymentTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `Payments`
--

INSERT INTO `Payments` (`paymentID`, `paymentTypeID`, `paymentCode`, `amount`, `dot`, `accountID`, `customerID`, `showRecent`) VALUES
(1, 1, '100121001-200232002-300343003', '500.00', '2019-03-05 09:30:01', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PaymentType`
--

DROP TABLE IF EXISTS `PaymentType`;
CREATE TABLE IF NOT EXISTS `PaymentType` (
  `paymentTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `paymentType` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`paymentTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `PaymentType`
--

INSERT INTO `PaymentType` (`paymentTypeID`, `paymentType`) VALUES
(1, 'Εφορία'),
(2, 'ΕΝΦΙΑ'),
(3, 'ΔΕΗ'),
(4, 'Ασφάλεια Αυτοκινήτου');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Accounts`
--
ALTER TABLE `Accounts`
  ADD CONSTRAINT `Customer_fk_Constraint` FOREIGN KEY (`cusID`) REFERENCES `Customers` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `MoneyTransfer`
--
ALTER TABLE `MoneyTransfer`
  ADD CONSTRAINT `MoneyTransfer_ibfk_1` FOREIGN KEY (`billingAccountID`) REFERENCES `Accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MoneyTransfer_ibfk_2` FOREIGN KEY (`creditAccountID`) REFERENCES `Accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `Payments_ibfk_1` FOREIGN KEY (`paymentTypeID`) REFERENCES `PaymentType` (`paymentTypeID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `Payments_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `Accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Payments_ibfk_3` FOREIGN KEY (`customerID`) REFERENCES `Customers` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
