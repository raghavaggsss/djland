/* create script:

delimiter $$

CREATE TABLE `adlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playsheet_id` int(11) DEFAULT NULL,
  `num` smallint(6) DEFAULT NULL,
  `time` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `name` text CHARACTER SET utf8,
  `played` tinyint(4) DEFAULT NULL,
  `sam_id` int(11) DEFAULT NULL,
  `time_block` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107705 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$


delimiter $$

CREATE TABLE `djs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `day` text NOT NULL,
  `time` text NOT NULL,
  `dj` text NOT NULL,
  `desc` text NOT NULL,
  `image` text NOT NULL,
  `email` text NOT NULL,
  `website` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `group_members` (
  `username` varchar(20) NOT NULL DEFAULT '0',
  `groupname` varchar(20) NOT NULL DEFAULT '0',
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `groups` (
  `name` varchar(20) NOT NULL DEFAULT '0',
  `description` varchar(100) NOT NULL DEFAULT '0',
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `hosts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2080 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `format_id` tinyint(4) unsigned NOT NULL DEFAULT '8',
  `catalog` tinytext,
  `crtc` int(8) DEFAULT NULL,
  `cancon` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `femcon` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `local` int(1) unsigned NOT NULL DEFAULT '0',
  `playlist` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `compilation` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinytext,
  `artist` tinytext,
  `title` tinytext,
  `label` tinytext,
  `genre` tinytext,
  `added` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `text_desc` (`artist`,`title`,`label`,`genre`)
) ENGINE=MyISAM AUTO_INCREMENT=54630 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `login_status` (
  `name` varchar(20) NOT NULL DEFAULT '0',
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` tinytext,
  `firstname` tinytext,
  `gender` tinytext,
  `cdn` tinyint(1) DEFAULT NULL,
  `address` tinytext,
  `city` tinytext,
  `postal` tinytext,
  `cell` tinytext,
  `home` tinytext,
  `work` tinytext,
  `email` tinytext,
  `status_id` int(11) NOT NULL DEFAULT '5',
  `joined` year(4) NOT NULL DEFAULT '0000',
  `last_paid` year(4) NOT NULL DEFAULT '0000',
  `comments` tinytext,
  `show` tinytext,
  `djs` tinyint(4) NOT NULL DEFAULT '0',
  `mobile` tinyint(4) NOT NULL DEFAULT '0',
  `newsdept` tinyint(4) NOT NULL DEFAULT '0',
  `sportsdept` tinyint(4) NOT NULL DEFAULT '0',
  `board` tinyint(4) NOT NULL DEFAULT '0',
  `discorder` tinyint(4) NOT NULL DEFAULT '0',
  `executive` tinyint(4) NOT NULL DEFAULT '0',
  `women` tinyint(4) NOT NULL DEFAULT '0',
  `fill_in` tinyint(4) NOT NULL DEFAULT '0',
  `dept` tinyint(4) NOT NULL DEFAULT '0',
  `int_music` tinyint(4) NOT NULL DEFAULT '0',
  `int_arts` tinyint(4) NOT NULL DEFAULT '0',
  `int_spoken` tinyint(4) NOT NULL DEFAULT '0',
  `int_magazine` tinyint(4) NOT NULL DEFAULT '0',
  `int_promotions` tinyint(4) NOT NULL DEFAULT '0',
  `int_livesound` tinyint(1) DEFAULT NULL,
  `int_design` tinyint(1) DEFAULT NULL,
  `int_web` tinyint(1) DEFAULT NULL,
  `int_progcom` tinyint(1) DEFAULT NULL,
  `int_adpsa` tinyint(1) DEFAULT NULL,
  `int_video` tinyint(1) DEFAULT NULL,
  `int_other` tinytext,
  `added` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `text_desc` (`lastname`,`firstname`,`address`,`city`,`postal`,`cell`,`home`,`work`,`email`,`comments`,`show`,`int_other`)
) ENGINE=MyISAM AUTO_INCREMENT=2141 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `membership_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `membership_years` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL DEFAULT '0',
  `paid_year` year(4) NOT NULL DEFAULT '0000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3950 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `ncrcdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(32) NOT NULL,
  `province` varchar(32) NOT NULL,
  `postal` varchar(8) NOT NULL,
  `station` varchar(16) NOT NULL,
  `phone1` varchar(16) NOT NULL,
  `phone2` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `emailupdates` int(1) NOT NULL,
  `members` varchar(32) NOT NULL,
  `dates` varchar(64) NOT NULL,
  `transportation` varchar(32) NOT NULL,
  `accomodation` int(2) NOT NULL,
  `dietary` varchar(255) NOT NULL,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `playitems` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `show_id` int(10) unsigned DEFAULT NULL,
  `playsheet_id` bigint(20) unsigned DEFAULT NULL,
  `song_id` bigint(20) unsigned DEFAULT NULL,
  `format_id` tinyint(3) unsigned DEFAULT NULL,
  `is_playlist` tinyint(1) unsigned DEFAULT '0',
  `is_canadian` tinyint(1) unsigned DEFAULT '0',
  `is_yourown` tinyint(1) unsigned DEFAULT '0',
  `is_indy` tinyint(1) unsigned DEFAULT '0',
  `is_fem` tinyint(3) unsigned DEFAULT '0',
  `show_date` date DEFAULT NULL,
  `duration` tinytext,
  `is_theme` tinyint(3) unsigned DEFAULT NULL,
  `is_background` tinyint(3) unsigned DEFAULT NULL,
  `crtc_category` int(8) DEFAULT NULL,
  `lang` tinytext,
  `is_part` int(1) NOT NULL DEFAULT '0',
  `is_inst` int(1) NOT NULL DEFAULT '0',
  `is_hit` int(1) NOT NULL DEFAULT '0',
  `insert_song_start_hour` tinyint(4) DEFAULT NULL,
  `insert_song_start_minute` tinyint(4) DEFAULT NULL,
  `insert_song_length_minute` tinyint(4) DEFAULT NULL,
  `insert_song_length_second` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1469662 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `playlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `show_id` int(10) unsigned DEFAULT NULL,
  `host_id` int(10) unsigned DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_name` tinytext,
  `edit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_name` tinytext,
  `spokenword` mediumtext,
  `spokenword_duration` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `unix_time` int(11) DEFAULT NULL,
  `star` tinyint(4) DEFAULT NULL,
  `crtc` int(11) DEFAULT NULL,
  `lang` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=126152 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `scheduled_ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time_block` int(11) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `sam_song_id_list` text CHARACTER SET utf8,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `playsheet_id` bigint(20) unsigned DEFAULT NULL,
  `dj_note` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  UNIQUE KEY `show_id_UNIQUE` (`time_block`)
) ENGINE=InnoDB AUTO_INCREMENT=19324 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$


delimiter $$

CREATE TABLE `show_times` (
  `show_id` int(10) NOT NULL,
  `start_day` int(3) NOT NULL,
  `start_time` time NOT NULL,
  `end_day` int(3) NOT NULL,
  `end_time` time NOT NULL,
  `alternating` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`show_id`,`start_day`,`start_time`,`end_day`,`end_time`,`alternating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$


delimiter $$

CREATE TABLE `shows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext CHARACTER SET utf8,
  `host_id` int(10) unsigned NOT NULL DEFAULT '0',
  `weekday` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `pl_req` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cc_req` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `indy_req` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fem_req` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `last_show` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_name` tinytext CHARACTER SET utf8 NOT NULL,
  `edit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_name` tinytext CHARACTER SET utf8,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `crtc_default` int(8) NOT NULL DEFAULT '20',
  `lang_default` tinytext CHARACTER SET utf8,
  `genre` tinytext CHARACTER SET utf8,
  `website` tinytext CHARACTER SET utf8,
  `rss` tinytext CHARACTER SET utf8,
  `show_desc` text CHARACTER SET utf8,
  `notes` text CHARACTER SET utf8,
  `show_img` tinytext CHARACTER SET utf8,
  `sponsor_name` tinytext CHARACTER SET utf8,
  `sponsor_url` tinytext CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=300 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$


delimiter $$

CREATE TABLE `socan` (
  `idSocan` int(10) unsigned NOT NULL,
  `socanStart` date DEFAULT NULL,
  `socanEnd` date DEFAULT NULL,
  PRIMARY KEY (`idSocan`),
  UNIQUE KEY `idSocan_UNIQUE` (`idSocan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table for socan'$$


delimiter $$

CREATE TABLE `social` (
  `show_id` int(10) NOT NULL,
  `social_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `social_url` varchar(200) CHARACTER SET utf8 NOT NULL,
  `short_name` tinytext CHARACTER SET utf8,
  `unlink` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`show_id`,`social_name`,`social_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$


delimiter $$

CREATE TABLE `songs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `artist` tinytext,
  `title` tinytext,
  `song` tinytext,
  `composer` tinytext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1352098 DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `types_format` (
  `id` int(11) DEFAULT '0',
  `name` tinytext,
  `sort` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1$$


delimiter $$

CREATE TABLE `user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '0',
  `password` char(100) NOT NULL DEFAULT '0',
  `status` char(20) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `create_name` char(30) DEFAULT NULL,
  `edit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_name` char(30) DEFAULT NULL,
  `login_fails` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid` (`userid`),
  KEY `userid_2` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1$$


 ORDER BY id DESC;
 
 
 */
