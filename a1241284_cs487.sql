-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2013 at 02:38 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a1241284_cs487`
--
CREATE DATABASE IF NOT EXISTS `a1241284_cs487` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `a1241284_cs487`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Comment ID',
  `Text` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'Text in Comment',
  `VID` int(11) NOT NULL COMMENT 'Video that comment is linked to',
  `UID` int(11) NOT NULL COMMENT 'User that comment is linked to',
  `CID` int(11) DEFAULT NULL COMMENT 'Possible comment that comment is linked to',
  `Position` int(11) NOT NULL COMMENT 'Position of comment in comment list',
  `Enable` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Enables or disables comments',
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `Text`, `VID`, `UID`, `CID`, `Position`, `Enable`, `Date`) VALUES
(29, 'this great', 1241141118, 1, 0, 2, 1, '2013-12-03 01:18:47'),
(28, 'this great', 1241141118, 1, 0, 1, 1, '2013-12-03 01:13:22'),
(27, '134', 1211241337, 1, 0, 9, 1, '2013-12-03 12:36:18'),
(26, 'aaa', 1241141118, 1, 0, 0, 1, '2013-12-03 12:35:11'),
(25, 'thank you ', 1209455758, 1, 0, 0, 1, '2013-12-02 11:38:31'),
(24, 'wocao', 1211241337, 1, 0, 8, 1, '2013-12-02 10:38:56'),
(23, 'wocao', 1211241337, 1, 0, 7, 1, '2013-12-02 10:38:23'),
(22, 'wocao', 1211241337, 1, 0, 6, 1, '2013-12-02 10:38:10'),
(21, 'wocao', 1211241337, 1, 0, 5, 1, '2013-12-02 10:37:03'),
(20, 'wocao', 1211241337, 1, 0, 4, 1, '2013-12-02 10:36:45'),
(19, 'wocao', 1211241337, 1, 0, 3, 1, '2013-12-02 10:35:48'),
(18, 'wocao', 1211241337, 1, 0, 2, 1, '2013-12-02 10:35:06'),
(17, 'wocao', 1211241337, 1, 0, 1, 1, '2013-12-02 10:34:11'),
(16, 'wocao', 1211241337, 1, 0, 0, 1, '2013-12-02 10:33:21'),
(30, 'he said the key point of the computer science', 1241141118, 1, 0, 3, 1, '2013-12-03 01:36:24'),
(31, 'cao', 1211241337, 1, 0, 10, 1, '2013-12-03 04:56:54'),
(32, '1111111111111', 1209455758, 1, 0, 1, 1, '2013-12-03 04:57:27'),
(33, 'asdfsdafsdafffffffffffffffffffffffff', 1211241337, 1, 0, 11, 1, '2013-12-03 08:36:26'),
(34, 'asdfsdafsdafffffffffffffffffffffffff..............', 1211241337, 1, 0, 12, 1, '2013-12-03 08:49:56'),
(35, 'zhu jing yu ', 1211241337, 1, 0, 13, 1, '2013-12-04 05:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE IF NOT EXISTS `flags` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of flag',
  `UID` int(11) NOT NULL COMMENT 'User That Set Flag',
  `FVID` int(11) DEFAULT NULL COMMENT 'Flagged Video',
  `FCID` int(11) DEFAULT NULL COMMENT 'Flagged Comment',
  `FUID` int(11) DEFAULT NULL COMMENT 'Flagged User',
  `FlagType` int(11) NOT NULL COMMENT 'Type of Flag',
  `Enable` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Enables or disables flags',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `flagtype`
--

CREATE TABLE IF NOT EXISTS `flagtype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Flag Type ID',
  `Name` varchar(25) COLLATE latin1_general_ci NOT NULL COMMENT 'Name of Type of Flag',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `flagtype`
--

INSERT INTO `flagtype` (`ID`, `Name`) VALUES
(1, 'BadUser'),
(2, 'BadComment'),
(3, 'BadVideo'),
(4, 'SavedVideo'),
(5, 'SavedUploader');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `Fname` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'First name of user',
  `Lname` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'Last name of user',
  `Email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'Email of user',
  `Password` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL COMMENT 'password of user',
  `Type` int(11) NOT NULL COMMENT 'user type',
  `Enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Deletes the user',
  PRIMARY KEY (`UID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UID`, `Fname`, `Lname`, `Email`, `Password`, `Type`, `Enable`) VALUES
(1, 'xie', 'yangyang', 'axieyangb@iit.edu', 'a6163484a', 2, 1),
(2, 'x', 'yy', 'yxie23@iit.edu', 'a6163484a', 2, 1),
(3, 'yangyang', 'Xie', '123123@iit.edu', 'a6163484a', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`ID`, `Name`) VALUES
(1, 'Admin'),
(2, 'Uploader'),
(3, 'Registered');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Title` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Authors` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Article` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Keywords` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Journal` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `PubDate` date NOT NULL,
  `Description` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `Picture` varchar(25) COLLATE latin1_general_ci NOT NULL COMMENT 'location of picture',
  `Video` varchar(25) COLLATE latin1_general_ci NOT NULL COMMENT 'location of video file',
  `Enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Title` (`Title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1241141119 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`ID`, `UserID`, `Title`, `Authors`, `Article`, `Keywords`, `Journal`, `PubDate`, `Description`, `Picture`, `Video`, `Enable`) VALUES
(1211241337, 2, 'tank', 'luye zhujingyu xieyangyang', 'study the comic', 'comic tank war', 'im a child', '1991-06-03', 'this is a tank war video', '', '', 1),
(1209455758, 2, 'soccer', 'yangyangxie huyuzhang zhangxiaoang', 'study the hobby', 'game soccer social', 'im the ballfuns', '1991-06-03', 'this is a soccer game', '', '', 1),
(1241141118, 1, 'Golden Age of Computer Science', 'Bill Gates  ', '1111111111', 'science computer Bill Gates', '1111111111', '2013-07-15', 'Microsoft Chairman Bill Gates delivers the opening', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `videorating`
--

CREATE TABLE IF NOT EXISTS `videorating` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of rating',
  `UID` int(11) NOT NULL COMMENT 'User ID',
  `VID` int(11) NOT NULL COMMENT 'Video ID',
  `Rating` int(11) NOT NULL COMMENT 'used to store a rating from 1 to 5',
  `Type` varchar(10) COLLATE latin1_general_ci NOT NULL COMMENT 'Stores the type of rating (either beaker or star) ',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `videorating`
--

INSERT INTO `videorating` (`ID`, `UID`, `VID`, `Rating`, `Type`) VALUES
(3, 2, 1211241337, 4, 'Star'),
(4, 2, 1211241337, 2, 'Beaker'),
(5, 0, 1211241337, 3, 'Star'),
(6, 0, 1211241337, 1, 'Beaker'),
(7, 1, 1211241337, 2, 'Star'),
(8, 1, 1211241337, 1, 'Beaker'),
(9, 1, 1209455758, 3, 'Star'),
(10, 1, 1209455758, 2, 'Beaker'),
(11, 1, 1241141118, 5, 'Star'),
(12, 1, 1241141118, 3, 'Beaker');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
