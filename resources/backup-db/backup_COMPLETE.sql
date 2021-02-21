# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.29)
# Database: fitmoms
# Generation Time: 2021-01-02 18:11:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table days
# ------------------------------------------------------------

DROP TABLE IF EXISTS `days`;

CREATE TABLE `days` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `burned_kcal` int(11) DEFAULT NULL,
  `getted_kcal` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table exercise_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exercise_categories`;

CREATE TABLE `exercise_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_pregnant` tinyint(1) NOT NULL,
  `start_month` int(11) NOT NULL,
  `end_month` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `exercise_categories` WRITE;
/*!40000 ALTER TABLE `exercise_categories` DISABLE KEYS */;

INSERT INTO `exercise_categories` (`id`, `name`, `description`, `is_pregnant`, `start_month`, `end_month`, `created_at`, `updated_at`)
VALUES
	(1,'Addominali','Allenamento addominale post-parto',0,2,4,'2021-01-02 16:19:02','2021-01-02 16:19:02'),
	(2,'Step','Allenamento gambe su step durante la gravidanza',1,4,6,'2021-01-02 16:19:02','2021-01-02 16:19:02');

/*!40000 ALTER TABLE `exercise_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table exercise_mother
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exercise_mother`;

CREATE TABLE `exercise_mother` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mother_id` bigint(20) NOT NULL,
  `exercise_id` bigint(20) NOT NULL,
  `day_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table exercises
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exercises`;

CREATE TABLE `exercises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exercise_seconds` int(11) NOT NULL,
  `break_seconds` int(11) DEFAULT NULL,
  `exercise_category_id` bigint(20) NOT NULL,
  `repetitions` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `exercises` WRITE;
/*!40000 ALTER TABLE `exercises` DISABLE KEYS */;

INSERT INTO `exercises` (`id`, `name`, `description`, `exercise_seconds`, `break_seconds`, `exercise_category_id`, `repetitions`, `created_at`, `updated_at`)
VALUES
	(1,'Candela','Posizione supina con glutei sollevati da terra e gomiti piegati a sorreggerli',90,NULL,1,3,'2021-01-02 16:19:02','2021-01-02 16:19:02'),
	(2,'Addominali laterali','Posizione supina dove il gomito va incontro al ginocchio opposto, alternatamente',120,NULL,1,2,'2021-01-02 16:19:02','2021-01-02 16:19:02'),
	(3,'Distensione gamba','Un piede è posizionato sullo step e l\'altra gamba viene mossa su e giù distesa',120,NULL,2,4,'2021-01-02 16:19:02','2021-01-02 16:19:02'),
	(4,'Base','I piedi salgono e scendono in maniera alternata dallo step',180,NULL,2,3,'2021-01-02 16:19:02','2021-01-02 16:19:02');

/*!40000 ALTER TABLE `exercises` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(21,'2014_10_12_000000_create_users_table',1),
	(22,'2014_10_12_100000_create_password_resets_table',1),
	(23,'2019_08_19_000000_create_failed_jobs_table',1),
	(24,'2019_12_14_000001_create_personal_access_tokens_table',1),
	(25,'2021_01_02_101732_create_mothers_table',1),
	(26,'2021_01_02_103654_create_weights_table',1),
	(27,'2021_01_02_144529_create_days_table',1),
	(28,'2021_01_02_145031_create_exercises_table',1),
	(29,'2021_01_02_145343_create_exercise_categories_table',1),
	(30,'2021_01_02_155532_create_exercise_mother_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mothers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mothers`;

CREATE TABLE `mothers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight_id` bigint(20) DEFAULT NULL,
  `is_pregnant` tinyint(1) DEFAULT NULL,
  `pregnancy_months` int(11) DEFAULT NULL,
  `baby_months` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `mothers` WRITE;
/*!40000 ALTER TABLE `mothers` DISABLE KEYS */;

INSERT INTO `mothers` (`id`, `user_id`, `name`, `birthday`, `height`, `weight_id`, `is_pregnant`, `pregnancy_months`, `baby_months`, `created_at`, `updated_at`)
VALUES
	(1,1,'Alice Gelsomini',NULL,NULL,NULL,0,NULL,2,'2021-01-02 16:19:02','2021-01-02 16:19:02'),
	(2,2,'Laura Farfalla',NULL,NULL,NULL,1,6,NULL,'2021-01-02 16:19:02','2021-01-02 16:19:02');

/*!40000 ALTER TABLE `mothers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Alice Gelsomini','alice@prova.it',NULL,'$2y$10$.SCGf8O4ehq.A2UXMZ2bR.nHCclNWB6fYgq9RMy3182NrbQ5m2Zt.',NULL,'2021-01-02 16:19:02','2021-01-02 16:19:02'),
	(2,'Laura Farfalla','laura@prova.it',NULL,'$2y$10$ZvZxorCYeTbIJ8CnTHLageHIzar9KKt7lt87WlYH1JVx5OxNtrVA2',NULL,'2021-01-02 16:19:02','2021-01-02 16:19:02');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table weights
# ------------------------------------------------------------

DROP TABLE IF EXISTS `weights`;

CREATE TABLE `weights` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mother_id` bigint(20) NOT NULL,
  `weight` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
