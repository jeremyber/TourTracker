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
-- Table structure for table `tt_login`
--

CREATE TABLE IF NOT EXISTS `tt_login` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tt_login`
--

INSERT INTO `tt_login` (`userid`, `username`, `password`) VALUES
(80, 'ac93', 'aa9b4346877326ec3b1ba4a6d8121a272b0d1215'),
(90, 'lsber', '6bdb77537e6b6774584d279dddf8971cfdc134ba'),
(91, 'trey1983', '72d054c7e27fa83a32bf738d012397d4928327e2'),
(92, 'mtruthe', '743d7d1a20b3202682b046d6abcb0ba8d2e7dba1'),
(93, 'jdber', 'ee68891a4be740d745aa4edd6c1c3121abbf4ab4'),
(94, 'Haleemz', '03de4e33bdb9b0cf30dca3f82df6e90a0a644a09');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tt_login`
--
ALTER TABLE `tt_login`
  ADD CONSTRAINT `pkuserid` FOREIGN KEY (`userid`) REFERENCES `tt_user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
