-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2014 at 04:34 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `metube1`
--
CREATE DATABASE IF NOT EXISTS `metube1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `metube1`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `accid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `sex` varchar(1) NOT NULL,
  `dob` date NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`accid`),
  UNIQUE KEY `accid` (`accid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accid`, `username`, `password`, `email`, `firstname`, `lastname`, `sex`, `dob`, `about`) VALUES
(6, 'shoab101', '123456', 'shoab10@gmail.com', 'Shoab', 'Ahmed', 'M', '1991-03-25', 'Hey ! Winter is Coming.!'),
(9, 'haseeb101', '123456', 'ahaseeb@clemson.edu', 'Haseeb', 'Abdul', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `friendlist`
--

CREATE TABLE IF NOT EXISTS `friendlist` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `fusername` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `friendlist`
--

INSERT INTO `friendlist` (`fid`, `username`, `fusername`, `status`) VALUES
(11, 'haseeb101', 'shoab101', 1),
(12, 'shoab101', 'haseeb101', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE IF NOT EXISTS `friendrequest` (
  `frid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `fusername` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`frid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `mediaid` int(20) NOT NULL,
  `likeno` int(20) NOT NULL,
  `views` int(20) NOT NULL,
  UNIQUE KEY `mediaid` (`mediaid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`mediaid`, `likeno`, `views`) VALUES
(3, 0, 4),
(8, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `mediaid` int(50) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `keywoards` varchar(50) NOT NULL,
  `filepath` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`mediaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`mediaid`, `filename`, `type`, `title`, `keywoards`, `filepath`, `username`) VALUES
(3, '624+assignment.png', 'image/png', 'hh', 'hh', 'uploads/shoab101/', 'shoab101'),
(4, 'Video1.WMV', 'video/x-ms-wmv', 'kk', 'kk', 'uploads/shoab101/', 'shoab101'),
(7, 'Video1.WMV', 'video/x-ms-wmv', 'kk', 'kk', 'uploads/shoab101/', 'shoab101'),
(8, 'Video1.WMV', 'video/x-ms-wmv', 'kk', 'nn', 'uploads/shoab101/', 'shoab101');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msgid` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(10) NOT NULL,
  `receiver` varchar(10) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  PRIMARY KEY (`msgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgid`, `sender`, `receiver`, `time`, `message`) VALUES
(1, 'shoab101', 'haseeb101', '2014-04-08 21:32:46', 'hello world'),
(2, 'haseeb101', 'shoab101', '2014-04-08 21:48:20', 'hey dude ssup');

-- --------------------------------------------------------

--
-- Table structure for table `playlistmedia`
--

CREATE TABLE IF NOT EXISTS `playlistmedia` (
  `pid` int(20) NOT NULL,
  `mediaid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE IF NOT EXISTS `playlists` (
  `pid` int(20) NOT NULL AUTO_INCREMENT,
  `pname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`pid`, `pname`, `username`) VALUES
(3, 'music', 'shoab101'),
(4, 'dance', 'shoab101'),
(5, 'music', 'shoab101'),
(6, 'dance', 'shoab101');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `uploadid` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `mediaid` int(50) NOT NULL,
  PRIMARY KEY (`uploadid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`uploadid`, `username`, `mediaid`) VALUES
(1, 'shoab101', 0),
(2, 'shoab101', 0),
(3, 'shoab101', 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
