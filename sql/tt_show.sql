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
-- Table structure for table `tt_show`
--

CREATE TABLE IF NOT EXISTS `tt_show` (
  `showid` int(11) NOT NULL AUTO_INCREMENT,
  `showdate` date NOT NULL,
  `location` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `venue` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`showid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tt_show`
--

INSERT INTO `tt_show` (`showid`, `showdate`, `location`, `venue`, `start_time`, `end_time`) VALUES
(1, '2014-07-03', 'Saratoga Springs, NY', 'Saratoga Performing Arts Center', '19:30:00', '23:30:00'),
(2, '2014-07-04', 'Normal, Illinois', 'Braden Auditorium', '19:30:00', '23:59:00'),
(3, '2014-09-25', 'Urbana, IL', 'The Canopy Club', '21:00:00', '24:00:00'),
(4, '1973-03-19', 'Uniondale, NY', 'Nassau Veterans Memorial Coliseum', '18:00:00', '21:00:00'),
(5, '2014-07-04', 'Saratoga Springs, NY', 'Saratoga Performing Arts Center', '19:30:00', '23:59:00'),
(6, '2014-04-05', 'Saratoga Springs, NY', 'Saratoga Performing Arts Center', '19:30:00', '23:59:00'),
(7, '2014-07-11', 'New York, NY', 'Randall''s Island', '19:30:00', '23:59:00'),
(8, '2014-07-12', 'New York, NY', 'Randall''s Island', '19:30:00', '23:59:00'),
(9, '2014-07-13', 'New York, NY', 'Randall''s Island', '19:30:00', '23:59:00'),
(10, '2014-07-15', 'Canandaigua, NY', 'CMAC Performing Arts Center', '19:30:00', '23:59:00'),
(11, '2014-07-16', 'Clarkston, MI', 'DTE Energy Music Theater', '19:30:00', '23:59:00'),
(12, '2014-07-18', 'Chicago, IL', 'FirstMerit Bank Pavilion at Northerly Island', '19:30:00', '23:59:00'),
(13, '2014-07-19', 'Chicago, IL', 'FirstMerit Bank Pavilion at Northerly Island', '19:30:00', '23:59:00'),
(14, '2014-07-20', 'Chicago, IL', 'FirstMerit Bank Pavilion at Northerly Island', '19:30:00', '23:59:00'),
(19, '2014-01-01', 'Normal, IL', 'Bone Student Center', '01:00:00', '13:00:00'),
(20, '2014-01-01', 'Normal, IL', 'Bone Student Center', '01:00:00', '13:00:00'),
(21, '2014-01-01', 'Normal, IL', 'Bone Student Center', '01:00:00', '13:00:00'),
(22, '2005-03-29', 'Chicago, IL', 'Riviera Theater ', '23:59:00', '23:58:00'),
(23, '2014-06-26', 'Las Vegas, NV', 'Hard Rock Hotel', '19:30:00', '23:54:00'),
(24, '2014-08-06', 'Chicago, IL', 'Riviera Theatre', '19:30:00', '23:30:00'),
(25, '2014-07-16', 'St. Louis, Missouri', 'The Pageant', '15:30:00', '19:42:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
