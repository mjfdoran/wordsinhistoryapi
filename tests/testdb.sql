# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.60-0ubuntu0.14.04.1)
# Database: wihapi_local
# Generation Time: 2018-06-17 08:40:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table books_en
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_en`;

CREATE TABLE `books_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_books_title_lang` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table books_es
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books_es`;

CREATE TABLE `books_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_books_title_lang` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table comments_en
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments_en`;

CREATE TABLE `comments_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table comments_es
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments_es`;

CREATE TABLE `comments_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table feedback
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table films_en
# ------------------------------------------------------------

DROP TABLE IF EXISTS `films_en`;

CREATE TABLE `films_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_films_title` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table films_es
# ------------------------------------------------------------

DROP TABLE IF EXISTS `films_es`;

CREATE TABLE `films_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_films_title` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`language`),
  KEY `language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table likes_en
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes_en`;

CREATE TABLE `likes_en` (
  `user_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `super_like` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`quote_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table likes_es
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes_es`;

CREATE TABLE `likes_es` (
  `user_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `super_like` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`quote_id`),
  CONSTRAINT `fk_user_id_es` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table people
# ------------------------------------------------------------

DROP TABLE IF EXISTS `people`;

CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_people_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table phinxlog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `phinxlog`;

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`)
VALUES
	(20170413205140,'People','2018-06-17 08:39:19','2018-06-17 08:39:19',0),
	(20170413205338,'Quotes','2018-06-17 08:39:19','2018-06-17 08:39:19',0),
	(20170413214207,'Books','2018-06-17 08:39:19','2018-06-17 08:39:19',0),
	(20170413214212,'Songs','2018-06-17 08:39:19','2018-06-17 08:39:20',0),
	(20170413214415,'Film','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20170414081051,'Users','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20170414082739,'Likes','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20170414082843,'Fakes','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20170419185030,'Languages','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20180522112636,'OnlyAllowOneQuoteSource','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20180525124613,'Reports','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20180525124810,'ForeignKeys','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20180601110000,'Feedback','2018-06-17 08:39:20','2018-06-17 08:39:20',0),
	(20180606124825,'SpanishTables','2018-06-17 08:39:20','2018-06-17 08:39:20',0);

/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table quotes_en
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quotes_en`;

CREATE TABLE `quotes_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(1000) NOT NULL,
  `person_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `total_likes` int(11) NOT NULL DEFAULT '0',
  `super_likes` int(11) NOT NULL DEFAULT '0',
  `information` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255),`person_id`,`user_id`,`book_id`,`song_id`,`film_id`,`approved`),
  KEY `fk_person_id` (`person_id`),
  KEY `fk_book_id` (`book_id`),
  KEY `fk_song_id` (`song_id`),
  KEY `fk_film_id` (`film_id`),
  KEY `fk_user_id3` (`user_id`),
  CONSTRAINT `fk_user_id3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `books_en` (`id`),
  CONSTRAINT `fk_film_id` FOREIGN KEY (`film_id`) REFERENCES `films_en` (`id`),
  CONSTRAINT `fk_person_id` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `fk_song_id` FOREIGN KEY (`song_id`) REFERENCES `songs_en` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table quotes_es
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quotes_es`;

CREATE TABLE `quotes_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(1000) NOT NULL,
  `person_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `total_likes` int(11) NOT NULL DEFAULT '0',
  `super_likes` int(11) NOT NULL DEFAULT '0',
  `information` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255),`person_id`,`user_id`,`book_id`,`song_id`,`film_id`,`approved`),
  KEY `fk_person_id_es` (`person_id`),
  KEY `fk_book_id_es` (`book_id`),
  KEY `fk_song_id_es` (`song_id`),
  KEY `fk_film_id_es` (`film_id`),
  KEY `fk_user_id3_es` (`user_id`),
  CONSTRAINT `fk_user_id3_es` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_book_id_es` FOREIGN KEY (`book_id`) REFERENCES `books_es` (`id`),
  CONSTRAINT `fk_film_id_es` FOREIGN KEY (`film_id`) REFERENCES `films_es` (`id`),
  CONSTRAINT `fk_person_id_es` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `fk_song_id_es` FOREIGN KEY (`song_id`) REFERENCES `songs_es` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reports_en
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports_en`;

CREATE TABLE `reports_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reports_es
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports_es`;

CREATE TABLE `reports_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table songs_en
# ------------------------------------------------------------

DROP TABLE IF EXISTS `songs_en`;

CREATE TABLE `songs_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_songs_title` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table songs_es
# ------------------------------------------------------------

DROP TABLE IF EXISTS `songs_es`;

CREATE TABLE `songs_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_songs_title` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `language` varchar(255) NOT NULL DEFAULT 'en',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_email` (`email`),
  UNIQUE KEY `idx_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
