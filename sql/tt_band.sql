-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2014 at 10:10 PM
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
-- Table structure for table `tt_band`
--

CREATE TABLE IF NOT EXISTS `tt_band` (
  `bandid` int(11) NOT NULL AUTO_INCREMENT,
  `band_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `year_formed` year(4) NOT NULL,
  `members` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `wiki` text COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `on_tour` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bandid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tt_band`
--

INSERT INTO `tt_band` (`bandid`, `band_name`, `year_formed`, `members`, `wiki`, `genre`, `on_tour`) VALUES
(1, 'Phish', 1983, 'Trey Anastasio, Michael Gordon, Page McConnell, Jon Fishman', 'http://en.wikipedia.org/wiki/Phish', 'Jam Band', 'Yes'),
(2, 'Wilco', 1994, 'Jeff Tweedy, John Stirratt, Glenn Kotche, Mikael Jorgensen, Nels Cline, Pat Sansone', 'http://en.wikipedia.org/wiki/Wilco', 'Alternative Rock', 'Yes'),
(3, 'Metallica', 1981, 'James Hetfield, Lars Ulrich, Kirk Hammett, Robert Trujillo', 'http://en.wikipedia.org/wiki/Metallica', 'Metal', 'Yes'),
(4, 'Daft Punk', 1993, 'Thomas Bangalter, Guy Manuel de Homem-Christo', 'http://en.wikipedia.org/wiki/Daft_punk', 'French house', 'Yes'),
(5, 'Grateful Dead', 1965, ' Jerry Garcia (guitar, vocals), Bob Weir (guitar, vocals), Ron "Pigpen" McKernan (keyboards, harmonica, vocals), Phil Lesh (bass, vocals), and Bill Kreutzmann (drums).', 'http://en.wikipedia.org/wiki/Grateful_Dead', 'Jam Band', 'No'),
(6, 'Elton John', 1947, 'Elton John', 'http://en.wikipedia.org/wiki/Elton_John', 'Rock', 'Yes'),
(7, 'STS9', 1998, 'Hunter Brown, Alana Rocklin, Jeffree Lerner, David Phipps, Zach Velmer', 'http://en.wikipedia.org/wiki/Sound_Tribe_Sector_9', 'Patchouli Tronic Elevator Jazz', 'Yes'),
(8, 'The Beatles', 1965, 'Ringo, John, Paul, George', '', 'Rock', 'No'),
(9, 'Haim', 2010, '...', 'wikipedia.org/haim', 'Rock', 'Yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
