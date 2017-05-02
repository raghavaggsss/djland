ALTER TABLE `library`
ADD COLUMN `description` LONGTEXT NULL AFTER `modified`,
ADD COLUMN `email` TINYTEXT NULL AFTER `description`;
ADD COLUMN `art_url` varchar(255) DEFAULT NULL AFTER `email`;

CREATE TABLE `library_songs` (
  `song_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `library_id` int(11) DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `album_artist` varchar(255) DEFAULT NULL,
  `album_title` varchar(255) DEFAULT NULL,
  `song_title` varchar(255) DEFAULT NULL,
  `credit` varchar(45) DEFAULT NULL,
  `track_num` smallint(6) DEFAULT '0',
  `tracks_total` smallint(6) DEFAULT '0',
  `genre` varchar(255) DEFAULT NULL,
  `s/t` bit(1) DEFAULT b'0',
  `v/a` bit(1) DEFAULT b'0',
  `compilation` bit(1) DEFAULT b'0',
  `composer` varchar(255) DEFAULT NULL,
  `crtc` tinyint(4) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `length` int(10) unsigned DEFAULT NULL,
  `file_location` mediumtext,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`song_id`),
  KEY `fk_library_songs_1_idx` (`library_id`),
  CONSTRAINT `fk_library_songs_1` FOREIGN KEY (`library_id`) REFERENCES `library` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `format_id` tinyint(3) DEFAULT NULL,
  `catalog` tinytext,
  `crtc` int(11) DEFAULT NULL,
  `cancon` tinyint(1) DEFAULT NULL,
  `femcon` tinyint(1) DEFAULT NULL,
  `local` int(11) DEFAULT NULL,
  `playlist` tinyint(1) DEFAULT NULL,
  `compilation` tinyint(1) DEFAULT NULL,
  `digitized` tinyint(1) DEFAULT NULL,
  `status` tinytext,
  `is_trashed` tinyint(1) DEFAULT 0,
  `artist` tinytext,
  `title` tinytext,
  `label` tinytext,
  `genre` tinytext,
  `tags` tinytext,
  `submitted` date DEFAULT NULL,
  `releasedate` date DEFAULT NULL,
  `assignee` int(10) unsigned DEFAULT NULL,
  `reviewed` int(10) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `description` longtext,
  `location` tinytext,
  `email` tinytext,
  `songlist` bigint(20) unsigned NOT NULL,
  `credit` tinytext,
  `art_url` tinytext,
  `review_comments` mediumtext,
  `staff_comment` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `submissions_archive` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact` tinytext,
  `catalog` tinytext,
  `artist` tinytext,
  `title` tinytext,
  `submitted` date DEFAULT NULL,
  `format_id` tinyint(3) DEFAULT NULL,
  `cancon` tinyint(1) DEFAULT NULL,
  `femcon` tinyint(1) DEFAULT NULL,
  `local` tinyint(1) DEFAULT NULL,
  `label` tinytext,
  `review_comments` tinytext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `submissions_rejected` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` tinytext,
  `artist` tinytext,
  `title` tinytext,
  `submitted` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `library_edits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `format_id` tinyint(4) DEFAULT NULL,
  `old_format_id` tinyint(4) DEFAULT NULL,
  `catalog` tinytext,
  `old_catalog` tinytext,
  `cancon` tinyint(1) DEFAULT NULL,
  `old_cancon` tinyint(1) DEFAULT NULL,
  `femcon` tinyint(1) DEFAULT NULL,
  `old_femcon` tinyint(1) DEFAULT NULL,
  `local` int(1) DEFAULT NULL,
  `old_local` int(1) DEFAULT NULL,
  `playlist` tinyint(1) DEFAULT NULL,
  `old_playlist` tinyint(1) DEFAULT NULL,
  `compilation` tinyint(1) DEFAULT NULL,
  `old_compilation` tinyint(1) DEFAULT NULL,
  `digitized` tinyint(1) DEFAULT NULL,
  `old_digitized` tinyint(1) DEFAULT NULL,
  `status` tinytext,
  `old_status` tinytext,
  `artist` tinytext,
  `old_artist` tinytext,
  `title` tinytext,
  `old_title` tinytext,
  `label` tinytext,
  `old_label` tinytext,
  `genre` tinytext,
  `old_genre` tinytext,
  `library_id` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `submission_songs` (
  `song_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submission_id` int(10) unsigned DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `album_artist` varchar(255) DEFAULT NULL,
  `album_title` varchar(255) DEFAULT NULL,
  `song_title` varchar(255) DEFAULT NULL,
  `credit` varchar(45) DEFAULT NULL,
  `track_num` smallint(6) DEFAULT '0',
  `tracks_total` smallint(6) DEFAULT '0',
  `genre` varchar(255) DEFAULT NULL,
  `s/t` bit(1) DEFAULT b'0',
  `v/a` bit(1) DEFAULT b'0',
  `compilation` bit(1) DEFAULT b'0',
  `composer` varchar(255) DEFAULT NULL,
  `crtc` tinyint(4) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `length` int(10) unsigned DEFAULT NULL,
  `file_location` mediumtext,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`song_id`),
  KEY `fk_submission_songs_1_idx` (`submission_id`),
  CONSTRAINT `fk_submission_songs_1` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
