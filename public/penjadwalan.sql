# SQL-Front 5.1  (Build 4.16)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: penjadwalan
# ------------------------------------------------------
# Server version 5.5.5-10.4.32-MariaDB

#
# Source for table failed_jobs
#

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Dumping data for table failed_jobs
#

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table migrations
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Dumping data for table migrations
#

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table ms_room
#

DROP TABLE IF EXISTS `ms_room`;
CREATE TABLE `ms_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` text DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Dumping data for table ms_room
#

LOCK TABLES `ms_room` WRITE;
/*!40000 ALTER TABLE `ms_room` DISABLE KEYS */;
INSERT INTO `ms_room` VALUES (1,'Sunflower Ballroom',1);
INSERT INTO `ms_room` VALUES (2,'Jasmine Ballroom',1);
INSERT INTO `ms_room` VALUES (3,'Daisy Ballroom',1);
INSERT INTO `ms_room` VALUES (4,'Lilac Ballroom',1);
INSERT INTO `ms_room` VALUES (5,'Magnolia Ballroom',1);
/*!40000 ALTER TABLE `ms_room` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table password_resets
#

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Dumping data for table password_resets
#

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table personal_access_tokens
#

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Dumping data for table personal_access_tokens
#

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table schedules
#

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_room` int(11) DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Dumping data for table schedules
#

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,5,'Rapat Koordinasi - Anggaran APBN - KEMENKEU 2024','Rapat Koordinasi','2023-12-28 12:00:00','2023-12-28 21:30:00','fc-event-primary-dim','2023-12-28 09:57:53',NULL,NULL,1);
INSERT INTO `schedules` VALUES (2,1,'NBHC Meeting 2024','Deskripsi NBHC Meeting 2024','2023-12-07 16:30:00','2023-12-13 18:00:00','fc-event-warning-dim','2023-12-28 09:59:04','2023-12-29 13:41:01',NULL,1);
INSERT INTO `schedules` VALUES (3,1,'BCA - Kickoff Meeting 2023','Kickoff Meeting','2023-12-30 01:30:00','2023-12-31 02:00:00','fc-event-danger-dim','2023-12-28 10:11:18',NULL,NULL,1);
INSERT INTO `schedules` VALUES (4,2,'Testing Tanggal 1','Deskripsi','2023-12-01 00:30:00','2023-12-02 01:00:00','fc-event-dark-dim','2023-12-29 12:31:31',NULL,'2023-12-29 12:31:38',9);
INSERT INTO `schedules` VALUES (5,2,'KPNL Kickoff Meeting Test - 2025','Testing penjadwalan','2023-12-03 01:00:00','2023-12-08 01:00:00','fc-event-info-dim','2023-12-29 13:09:50','2023-12-29 13:20:17',NULL,1);
INSERT INTO `schedules` VALUES (6,1,'1- KPNL Kickoff Meeting Test - 2024','Testing penjadwalan','2023-12-01 01:00:00','2023-12-06 01:00:00','fc-event-primary-dim','2023-12-29 13:15:38','2023-12-29 13:19:05',NULL,1);
INSERT INTO `schedules` VALUES (7,1,'Lorem Ipsum is simply dummy text of the printing and typesetting industry - 2029','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2023-12-14','2023-12-17 02:30:00','fc-event-dark-dim','2023-12-29 13:26:50','2023-12-29 13:40:06',NULL,1);
INSERT INTO `schedules` VALUES (8,5,'MAIDA MAYA BELINDA','Aku Cinta Protokoler','2024-01-01 00:30:00','2024-01-07 08:00:00','fc-event-info-dim','2024-01-01 10:53:45','2024-01-01 10:57:56','2024-01-02 10:29:34',9);
INSERT INTO `schedules` VALUES (9,4,'Panic At The Disco! - Meeting Kickoff - January 2024','Death Of The Bachelor','2024-01-09 01:00:00','2024-01-16 03:00:00','fc-event-info-dim','2024-01-03 02:02:58','2024-01-03 02:04:18',NULL,1);
INSERT INTO `schedules` VALUES (10,2,'Kick Off Meeting - A$AP FERG','Deskripsi','2024-01-03','2024-01-04 23:30:00','fc-event-warning-dim','2024-01-03 02:13:02','2024-01-03 08:28:58',NULL,1);
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

#
# Source for table users
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Dumping data for table users
#

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$rJCrclpx5CNGgHl0NJSZbeFhQaEyn25glqi3RO4PK4bhzGsQcY6Fq',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
