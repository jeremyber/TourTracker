-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2014 at 10:11 PM
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
-- Table structure for table `tt_band_event`
--

CREATE TABLE IF NOT EXISTS `tt_band_event` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT,
  `showid` int(11) NOT NULL,
  `bandid` int(11) NOT NULL,
  `headliner` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `poster_link` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`eventid`),
  UNIQUE KEY `showid_2` (`showid`,`bandid`),
  UNIQUE KEY `showid_3` (`showid`,`bandid`),
  KEY `bandid_2` (`bandid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tt_band_event`
--

INSERT INTO `tt_band_event` (`eventid`, `showid`, `bandid`, `headliner`, `event_description`, `poster_link`) VALUES
(1, 1, 1, 'Phish', 'Phish opens their Summer 2014 Tour at SPAC this year.', 'spac.jpg'),
(2, 2, 1, 'Al Bowman', 'Al Bowman welcomes some truly amazing guests to play at ISU for one helluva show', 'al.jpg'),
(3, 2, 2, 'Al Bowman', 'Description', 'none.jpg'),
(4, 2, 3, 'Al Bowman', 'Description', 'none.jpg'),
(9, 2, 4, 'Al Bowman', 'Daft Punk plays a crazy show at ISU', 'dp.jpg'),
(10, 3, 1, 'Phish', 'Phish does stuff.', 'phish.jpg'),
(11, 4, 5, 'Grateful Dead', 'Heady Jams in this one dude', 'gd.jpg'),
(12, 5, 1, 'Phish', 'Night 2', 'phish.jpg'),
(13, 6, 1, 'Phish', 'Night 3', 'phish.jpg'),
(14, 7, 1, 'Phish', 'Night 1', 'phish.jpg'),
(15, 8, 1, 'Phish', 'Night 2', 'phish.jpg'),
(16, 9, 1, 'Phish', 'Phish plays a show', ''),
(17, 10, 1, 'Phish', 'Phish plays a show', ''),
(18, 11, 1, 'Phish', 'Phish plays a show', ''),
(19, 12, 1, 'Phish', 'Phish plays a show', ''),
(20, 13, 1, 'Phish ', 'Phish plays a show', ''),
(21, 14, 1, 'Phish', 'Phish plays a show', ''),
(26, 19, 1, 'Woo hoo', 'Be Happy', ''),
(27, 20, 3, 'Woo hoo', 'Be Happy', ''),
(28, 21, 4, 'Daft Punk', 'YOLO', ''),
(29, 22, 5, 'Grateful Dead 2', 'None', ''),
(30, 23, 4, 'Daft Punk', 'Daft Punk rocks Chicago', ''),
(31, 24, 6, 'Elton John', 'Awesome show!', ''),
(32, 25, 7, 'STS9', 'No description listed', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
