-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2014 at 10:12 PM
-- Server version: 5.1.73-cll
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `it354_jdber`
--

-- --------------------------------------------------------

--
-- Table structure for table `tt_user`
--

CREATE TABLE IF NOT EXISTS `tt_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_joined` date NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=95 ;

--
-- Dumping data for table `tt_user`
--

INSERT INTO `tt_user` (`userid`, `firstname`, `lastname`, `email`, `phone`, `date_joined`) VALUES
(80, 'Alex', 'Cesich', 'ac_93@aol.com', '', '2014-04-06'),
(90, 'Sammi', 'Ber', 'lsber@yahoo.com', '555-555-5555', '2014-04-10'),
(91, 'Trey', 'Anastasio', 'phish@phish.com', '(555) 555-5555', '2014-04-15'),
(92, 'Matt', 'R', 'mtruthe@ilstu.edu', '', '2014-04-21'),
(93, 'Sammi', 'Ber', 'none@ilstu.edu', '11111111111', '2014-04-21'),
(94, 'Hal', 'A', 'haleema.ahmad@yahoo.com', '', '2014-04-23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
