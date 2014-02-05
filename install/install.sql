-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2014 at 03:48 PM
-- Server version: 5.1.63-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crc_judge`
--
CREATE DATABASE IF NOT EXISTS `msanford_crc_judge` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `msanford_crc_judge`;

-- --------------------------------------------------------

--
-- Table structure for table `journalism_rubric`
--

DROP TABLE IF EXISTS `journalism_rubric`;
CREATE TABLE IF NOT EXISTS `journalism_rubric` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `judge_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Who cast the vote',
  `school_id` tinyint(3) unsigned NOT NULL COMMENT 'What team the vote is for',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When the vote was cast',
  `1` enum('true','false') NOT NULL,
  `2` tinyint(3) unsigned NOT NULL,
  `3` tinyint(3) unsigned NOT NULL,
  `4` tinyint(3) unsigned NOT NULL,
  `5` tinyint(3) unsigned NOT NULL,
  `6` tinyint(3) unsigned NOT NULL,
  `7` tinyint(3) unsigned NOT NULL,
  `comments` text,
  `total` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `judge_id` (`judge_id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Journalism rubric hints.' AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- Table structure for table `overall`
--

DROP TABLE IF EXISTS `overall`;
CREATE TABLE IF NOT EXISTS `overall` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `judge_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `component` enum('video','journalism','web','kiosk','build','design') DEFAULT NULL,
  `score` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `school_id` (`school_id`),
  KEY `component` (`component`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Overall ranking for all schools across all categories' AUTO_INCREMENT=344 ;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE IF NOT EXISTS `schools` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'School ID',
  `name` varchar(150) NOT NULL DEFAULT '0' COMMENT 'School Name',
  `video` varchar(200) DEFAULT NULL COMMENT 'Video URL',
  `web` varchar(200) DEFAULT NULL COMMENT 'Web site URL',
  `journalism` varchar(200) DEFAULT NULL COMMENT 'Web site URL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Mapping table for schools.';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'User UUID',
  `email` varchar(255) NOT NULL DEFAULT '0' COMMENT 'User email',
  `pin` varchar(6) DEFAULT NULL COMMENT 'Access PIN',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 = Enabled, 1 = Suspended',
  `lang` enum('en','fr') NOT NULL DEFAULT 'en',
  `firstname` varchar(255) NOT NULL DEFAULT '0' COMMENT 'First name',
  `lastname` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Family name',
  `affiliation` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Company, school, etc',
  `role` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Their user role',
  `lastactivity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last activity',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `state` (`state`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `video_rubric`
--

DROP TABLE IF EXISTS `video_rubric`;
CREATE TABLE IF NOT EXISTS `video_rubric` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Vote ID',
  `judge_id` smallint(5) unsigned NOT NULL COMMENT 'Who cast this vote',
  `school_id` tinyint(3) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When this vote was cast',
  `1` enum('true','false') NOT NULL COMMENT 'Axis 1',
  `2` tinyint(3) unsigned NOT NULL COMMENT 'Axis 2',
  `3` tinyint(3) unsigned NOT NULL COMMENT 'Axis 3',
  `4` tinyint(3) unsigned NOT NULL COMMENT 'Axis 4',
  `5` tinyint(3) unsigned NOT NULL COMMENT 'Axis 5',
  `6` tinyint(3) unsigned NOT NULL COMMENT 'Axis 6',
  `7` tinyint(3) unsigned NOT NULL COMMENT 'Axis 7',
  `comments` text,
  `total` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `judge_id` (`judge_id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='To store video rubric hints per judge.' AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- Table structure for table `web_rubric`
--

DROP TABLE IF EXISTS `web_rubric`;
CREATE TABLE IF NOT EXISTS `web_rubric` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `judge_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Who cast this vote.',
  `school_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'The team',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When this vote was cast',
  `1` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 1',
  `2` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 2',
  `3` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 3',
  `4` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 4',
  `5` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 5',
  `comments` text,
  `total` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `judge_id` (`judge_id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
