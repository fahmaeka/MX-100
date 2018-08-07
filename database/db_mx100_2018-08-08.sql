# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17)
# Database: db_mx100
# Generation Time: 2018-08-07 22:44:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table jobs_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs_list`;

CREATE TABLE `jobs_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jobs_code` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `job_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `jobs_list` WRITE;
/*!40000 ALTER TABLE `jobs_list` DISABLE KEYS */;

INSERT INTO `jobs_list` (`id`, `jobs_code`, `id_users`, `name`, `job_description`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'JOB/3/07/08/2018/CAM',3,'Enhanced Notification\'s Campaign','Push notification delivery validation from interval 3 hours',NULL,NULL,NULL),
	(2,'JOB/3/07/08/2018/USR',3,'Enhanced Notification\'s Users','Push notification users validation from interval 3 hours',NULL,NULL,NULL);

/*!40000 ALTER TABLE `jobs_list` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2018_08_06_050711_create_users_table',1),
	(2,'2018_08_07_045237_create_rank_configuration',1),
	(3,'2018_08_07_050301_create_registration_users_rank',1),
	(4,'2018_08_07_050740_create_jobs_list',1),
	(5,'2018_08_07_050757_proposal',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table proposal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `proposal`;

CREATE TABLE `proposal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_jobs_list` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `provide_budget` int(11) NOT NULL,
  `completion_date_estimation` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `proposal` WRITE;
/*!40000 ALTER TABLE `proposal` DISABLE KEYS */;

INSERT INTO `proposal` (`id`, `id_jobs_list`, `id_users`, `provide_budget`, `completion_date_estimation`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(3,1,2,55000,'2018-08-03','2018-08-08 01:52:57','2018-08-08 01:52:57',NULL);

/*!40000 ALTER TABLE `proposal` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rank_configuration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rank_configuration`;

CREATE TABLE `rank_configuration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `point` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `rank_configuration` WRITE;
/*!40000 ALTER TABLE `rank_configuration` DISABLE KEYS */;

INSERT INTO `rank_configuration` (`id`, `name`, `point`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'A','40',NULL,NULL,NULL),
	(2,'B','20',NULL,NULL,NULL);

/*!40000 ALTER TABLE `rank_configuration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table registration_users_rank
# ------------------------------------------------------------

DROP TABLE IF EXISTS `registration_users_rank`;

CREATE TABLE `registration_users_rank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_rank` int(11) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `registration_users_rank` WRITE;
/*!40000 ALTER TABLE `registration_users_rank` DISABLE KEYS */;

INSERT INTO `registration_users_rank` (`id`, `id_users`, `id_rank`, `balance`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,1,12,NULL,'2018-08-08 05:36:52',NULL),
	(2,2,2,10,NULL,NULL,NULL),
	(3,4,2,0,NULL,NULL,NULL);

/*!40000 ALTER TABLE `registration_users_rank` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `api_token`, `type`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'ekafahma','$2y$10$NfAOijbtbOF/jU6DSBzuYeYH1kNjzEF7.EcinuBfuxkVA7n0.1qaG','fahmaeka@gmail.com','37487901e58bfa91e593bc5c93201bcb9478f3c8','freelancer','2018-08-07 12:40:04','2018-08-07 12:40:08',NULL),
	(2,'doraemon','$2y$10$sJNAXUPt.UHzR9RBOtWMmO1S099LqC5UhR/eVK5Rh94neiBeWybMG','doraemon@gmail.com','ef0b65c14f3aef4aab1bc28c5d26b13c9aade2a0','freelancer','2018-08-07 13:01:54','2018-08-07 13:02:01',NULL),
	(3,'PT. Dragon Ball','$2y$10$.PSN1ukKdFEJRDDqtLfc3eqqK1YehmoyXUSjKVktkh7TdXCUXauRC','uv7@gmail.com','bf18fb39b0b77ada7428921136f6ef05fdd9220b','company','2018-08-07 13:03:34','2018-08-07 13:03:54',NULL),
	(4,'yayan','$2y$10$twGPAt79nxlC6oRomPtMnuXh13TemYBfd4YJA/dC4XNm52NrOrjvK','yayan@gmail.com','2f6125b02174f2d87c124f4b28f7a57a006f1599','freelancer','2018-08-08 05:24:32','2018-08-08 05:27:01',NULL),
	(5,'makmur_jaya','$2y$10$rC1LRilbt2z7zeYPKpUtZulm4JTdwFmkmII/2tmzeHMnbIBkdBX3C','makmur_jaya@gmail.com','','company','2018-08-08 05:40:36','2018-08-08 05:40:36',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
