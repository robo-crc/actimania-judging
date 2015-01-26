CREATE DATABASE IF NOT EXISTS `crc_acijdg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `crc_acijdg`;

CREATE TABLE `journalism_rubric` (
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='Journalism rubric hints.';

CREATE TABLE `overall` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `judge_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `component` enum('video','journalism','web','kiosk','build','design') DEFAULT NULL,
  `score` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `school_id` (`school_id`),
  KEY `component` (`component`)
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8 COMMENT='Overall ranking for all schools across all categories';

CREATE TABLE `schools` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'School ID',
  `name` varchar(150) NOT NULL DEFAULT '0' COMMENT 'School Name',
  `video` varchar(200) DEFAULT NULL COMMENT 'Video URL',
  `web` varchar(200) DEFAULT NULL COMMENT 'Web site URL',
  `journalism` varchar(200) DEFAULT NULL COMMENT 'Web site URL',
  `result_key` varchar(40) DEFAULT NULL COMMENT 'Results key',
  PRIMARY KEY (`id`),
  UNIQUE KEY `result_key_UNIQUE` (`result_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Mapping table for schools.';

CREATE TABLE `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'User UUID',
  `email` varchar(255) NOT NULL DEFAULT '0' COMMENT 'User email',
  `pin` varchar(6) DEFAULT NULL COMMENT 'Access PIN',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 = Enabled, 1 = Suspended',
  `lang` enum('en','fr') NOT NULL DEFAULT 'en',
  `firstname` varchar(255) NOT NULL DEFAULT '0' COMMENT 'First name',
  `lastname` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Family name',
  `affiliation` varchar(255) DEFAULT NULL,
  `role` tinyint(3) unsigned DEFAULT '0',
  `lastactivity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last activity',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `state` (`state`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

CREATE TABLE `video_rubric` (
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
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COMMENT='To store video rubric hints per judge.';

CREATE TABLE `web_rubric` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `judge_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Who cast this vote.',
  `school_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'The team',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When this vote was cast',
  `1` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 1',
  `2` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 2',
  `3` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 3',
  `4` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 4',
  `5` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Axis 5',
  `6` enum('true','false') NOT NULL DEFAULT 'false',
  `comments` text,
  `total` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `judge_id` (`judge_id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;
