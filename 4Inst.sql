-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 11:32 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `4Inst`
--
CREATE DATABASE IF NOT EXISTS `4Inst` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `4Inst`;

-- --------------------------------------------------------

--
-- Table structure for table `Circles`
--

CREATE TABLE IF NOT EXISTS `Circles` (
  `circleID` int(11) NOT NULL AUTO_INCREMENT,
  `circleName` text DEFAULT NULL,
  `circleUserArray` text DEFAULT NULL,
  `circleCreator` int(11) NOT NULL,
  PRIMARY KEY (`circleID`),
  UNIQUE KEY `circleID` (`circleID`),
  UNIQUE KEY `circleID_2` (`circleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `photoID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `commentText` text NOT NULL,
  `commentStamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentID`),
  UNIQUE KEY `commentID` (`commentID`),
  KEY `photoID` (`photoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `friendActivity`
--

CREATE TABLE IF NOT EXISTS `friendActivity` (
  `activityID` int(11) NOT NULL AUTO_INCREMENT,
  `user1ID` int(11) NOT NULL,
  `user2ID` int(11) NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`activityID`),
  UNIQUE KEY `activityID` (`activityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Invites`
--

CREATE TABLE IF NOT EXISTS `Invites` (
  `inviteID` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  PRIMARY KEY (`inviteID`),
  UNIQUE KEY `inviteID` (`inviteID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE IF NOT EXISTS `Likes` (
  `likeID` int(11) NOT NULL AUTO_INCREMENT,
  `photoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`likeID`),
  UNIQUE KEY `likeID` (`likeID`),
  KEY `photoID` (`photoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE IF NOT EXISTS `Login` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `userID` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE IF NOT EXISTS `Messages` (
  `msgID` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `msg_text` text DEFAULT NULL,
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opened` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`msgID`),
  UNIQUE KEY `msgID` (`msgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `PhotoUpload`
--

CREATE TABLE IF NOT EXISTS `PhotoUpload` (
  `photoID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `circleShared` text DEFAULT NULL,
  `datestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`photoID`),
  UNIQUE KEY `photoID` (`photoID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE IF NOT EXISTS `Profile` (
  `userID` int(11) NOT NULL,
  `firstname` text,
  `lastname` text,
  `about` text DEFAULT NULL,
  `friendArray` text NOT NULL,
  `location` text DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ProfilePicture`
--

CREATE TABLE IF NOT EXISTS `ProfilePicture` (
  `userID` int(11) NOT NULL,
  `profile_Picture` text NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`photoID`) REFERENCES `PhotoUpload` (`photoID`);
  

--
-- Constraints for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Login` (`userID`);

--
-- Constraints for table `Likes`
--
ALTER TABLE `Likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`photoID`) REFERENCES `PhotoUpload` (`photoID`);

--
-- Constraints for table `PhotoUpload`
--
ALTER TABLE `PhotoUpload`
  ADD CONSTRAINT `photoupload_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Login` (`userID`);

--
-- Constraints for table `Profile`
--
ALTER TABLE `Profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Login` (`userID`);

--
-- Constraints for table `ProfilePicture`
--
ALTER TABLE `ProfilePicture`
  ADD CONSTRAINT `profilepicture_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Login` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
