/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: european-manicure_test
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2020_10_04_115514_create_moonshine_roles_table',1),
(5,'2020_10_05_173148_create_moonshine_tables',1),
(6,'2026_03_24_121027_create_notifications_table',1),
(7,'2026_03_24_162447_create_pages_table',2),
(9,'2026_03_24_172406_create_pages_table',3),
(10,'2026_03_24_184122_create_settings_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `moonshine_user_roles`
--

DROP TABLE IF EXISTS `moonshine_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `moonshine_user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moonshine_user_roles`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `moonshine_user_roles` WRITE;
/*!40000 ALTER TABLE `moonshine_user_roles` DISABLE KEYS */;
INSERT INTO `moonshine_user_roles` VALUES
(1,'Admin','2026-03-24 11:16:44','2026-03-24 11:16:44');
/*!40000 ALTER TABLE `moonshine_user_roles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `moonshine_users`
--

DROP TABLE IF EXISTS `moonshine_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `moonshine_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `moonshine_user_role_id` bigint(20) unsigned NOT NULL DEFAULT 1,
  `email` varchar(190) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `moonshine_users_email_unique` (`email`),
  KEY `moonshine_users_moonshine_user_role_id_foreign` (`moonshine_user_role_id`),
  CONSTRAINT `moonshine_users_moonshine_user_role_id_foreign` FOREIGN KEY (`moonshine_user_role_id`) REFERENCES `moonshine_user_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moonshine_users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `moonshine_users` WRITE;
/*!40000 ALTER TABLE `moonshine_users` DISABLE KEYS */;
INSERT INTO `moonshine_users` VALUES
(1,1,'test@test.com','$2y$12$vn9hip1T5YtUsczPN2hbte7RgiCJYXMEf5mzVJbduloKTjKvwRkhm','admin',NULL,'8SH1PIicHeF79bTDWwiw2QOxsvXjkr4h44ZhcD9JX4Fc25VsS4Pgzy8EbWG2','2026-03-24 13:36:01','2026-03-24 13:36:01');
/*!40000 ALTER TABLE `moonshine_users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` CHAR(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES
(1,'Home','index','{\"1\":{\"key\":1,\"name\":\"hero\",\"values\":{\"title\":\"EUROPEAN MANICURE\",\"description\":\"Experience clean, refined, and safe manicures inspired by the timeless artistry of European beauty. Precision, uncompromising hygiene, and perfect results are our promise.\",\"description_mb\":\"A refined European technique focused on precision, hygiene, and naturally elegant results\",\"text_left\":\"Tetiana <br> Wiese\",\"text_right\":\"Fasion\",\"button_text\":\"View Procedures\",\"button_link\":\"http:\\/\\/european-manicure.test\",\"image\":\"pages\\/3vek48QZy2KrjTnqf35iZScWnEdsp9DrQjsOtgP4.png\",\"is_lazy\":0}},\"2\":{\"key\":2,\"name\":\"content_section\",\"values\":{\"title\":\"About Studio\",\"image_mobile\":\"pages\\/XiV8Tog2CQ90g4lVM82RbaTt8jg4jiuZQ66JS0KF.jpg\",\"image_desktop\":\"pages\\/eWQwaZBrvsUowbI6tpESyxqHnuzPrgNIkvnA0dnq.jpg\",\"description\":\"<p><span style=\\\"white-space:pre-wrap;\\\">European Manicure is a boutique nail studio dedicated to the art of clean beauty, precision, and uncompromising hygiene. Inspired by modern European techniques, we create a soft, natural aesthetic that feels elegant, effortless, and timeless.<\\/span><\\/p><p><span style=\\\"white-space:pre-wrap;\\\">Our philosophy centers on gentle manicure practices, meticulous cuticle care, and the use of premium, certified products. Every step \\u2014 from thorough tool sterilization to the final touch of shine \\u2014 is thoughtfully designed to safeguard nail health while enhancing their natural beauty.<\\/span><\\/p>\",\"description_mb_1\":\"<p><span style=\\\"white-space:pre-wrap;\\\">European Manicure is a boutique nail studio dedicated to the art of clean beauty, precision, and uncompromising hygiene. Inspired by modern European techniques, we create a soft, natural aesthetic that feels elegant, effortless, and timeless.<\\/span><\\/p>\",\"description_mb_2\":\"<p><span style=\\\"white-space:pre-wrap;\\\">Our philosophy centers on gentle manicure practices, meticulous cuticle care, and the use of premium, certified products. Every step \\u2014 from thorough tool sterilization to the final touch of shine \\u2014 is thoughtfully designed to safeguard nail health while enhancing their natural beauty.<\\/span><\\/p>\",\"text_1\":\"Founded by Tetiana Wiese, a certified specialist focused on gentle European manicure techniques\",\"text_2\":\"Our studio embodies clean beauty, offering refined, safe results through uncompromising attention to hygiene.\",\"items\":[{\"title\":\"Delicate technique\",\"image\":\"pages\\/QLwmFDJS72LiXjMV1llZnabMgmloS92qyYS8yKWC.jpg\"},{\"title\":\"Sterile tools\",\"image\":\"pages\\/ykdVrFfDtHbzpt6GcCrhWdMqUURpO5uUZbuQPeYb.jpg\"},{\"title\":\"Natural finish\",\"image\":\"pages\\/oBNJ3kYQqrTyi3LgVzAtexoZCVJEvKjBybiKgVHZ.jpg\"}],\"is_lazy\":1}},\"3\":{\"key\":3,\"name\":\"our_services\",\"values\":{\"title\":\"Our Services\",\"description\":\"Curated with care\",\"items\":[{\"title\":\"Gel polish manicure\",\"image\":\"pages\\/XG1OpwHKmiVMLNefvxHKgb0vmoYiCZhso7blF4uO.jpg\",\"button_text\":\"Book Online\",\"button_link\":\"#!\"},{\"title\":\"Builder gel manicure\",\"image\":\"pages\\/tu1juxdsegOC3BdYUkpG4fxD5RgcmzwPxeqPqiIg.jpg\",\"button_text\":\"Book Online\",\"button_link\":\"#!\"}],\"is_lazy\":1}},\"4\":{\"key\":4,\"name\":\"what_apart\",\"values\":{\"title\":\"What Sets Us&nbsp;Apart\",\"description\":\"<p><span style=\\\"white-space:pre-wrap;\\\">This section showcases the distinctive benefits of our studio, where every service is guided by precision, gentle care, and uncompromising hygiene. We are committed to creating a seamless journey \\u2014 from your very first visit to ongoing nail care \\u2014 within a calm, welcoming environment. Every detail is thoughtfully curated to preserve nail health while enhancing their beauty and natural elegance.<\\/span><\\/p>\",\"logo_image\":\"pages\\/VhXDVapX22YYGZzrs6GGO18c3OW5J5rJTDLs4AxQ.png\",\"main_image\":\"pages\\/BskP98bQn7aI7xJ7etuXZghil9H7g84WooAevUdC.jpg\",\"items\":[{\"title\":\"What Sets Us Apart\",\"image\":\"pages\\/MXvHk9MmY03hnlO4Kn4ncubhly14adjzYw341IbV.jpg\",\"description\":\"European specialist with professional certification\"},{\"title\":\"Gentle Techniques\",\"image\":\"pages\\/jjwx8rQHWjU1wpdrQNIlNYvoLsw7U6h492TO8ruc.jpg\",\"description\":\"Delicate methods that protect natural nail health\"},{\"title\":\"Strict Hygiene\",\"image\":\"pages\\/PUjFcUMnL8aUHM7TFWtObjvqCJ5opNSMeQZKOEc1.jpg\",\"description\":\"Full sterilization and medical-grade cleanliness at every step\"},{\"title\":\"Premium Materials\",\"image\":\"pages\\/Tvqlk8duFqMUlG6SIgUlOcKBwzjTblljz40tCvmE.jpg\",\"description\":\"Safe, high-quality products selected for lasting results\"}],\"is_lazy\":1}},\"5\":{\"key\":5,\"name\":\"nail_artists\",\"values\":{\"title\":\"nail artists\",\"items\":[{\"image\":\"pages\\/DnaGItOPLsPKsarNRkqV2RbdN0rNOnAhAmGZqxEo.jpg\",\"name\":\"Lili Fraide\",\"specialist\":\"Advanced specialist\",\"button_text\":\"Book Online\",\"button_link\":\"#!\"},{\"image\":\"pages\\/ms4jIZ6izu2ctGYIm0azTK8j3ZOvTKSi3eChGOt7.jpg\",\"name\":\"Tetiana Wiese\",\"specialist\":\"Owner\",\"button_text\":\"Book Online\",\"button_link\":\"#!\"},{\"image\":\"pages\\/DBiJJlrRhIzIGis87wzJpYX5KEWO8LvgwTjOLqrE.jpg\",\"name\":\"Morgan Feght\",\"specialist\":\"Trainee\",\"button_text\":\"Book Online\",\"button_link\":\"#!\"}],\"is_lazy\":1}},\"6\":{\"key\":6,\"name\":\"reviews\",\"values\":{\"title\":\"Client Reviews\",\"images\":[{\"image\":\"pages\\/cDhf4FQsZOzQXucO6xlOUqCTD94kRpjg8nnd2WVu.png\"},{\"image\":\"pages\\/AYTZMEzJfrL65m4IZFnAkc18p4O8ZWZdEoOSlDSK.png\"},{\"image\":\"pages\\/9CixM7TYOrTQn7425G9ZQ0RC3rlUy5eVmryL64SY.png\"}],\"trusted_clients_number\":\"+100\",\"trusted_clients_text\":\"trusted clients\",\"reviews\":[{\"image\":\"pages\\/LHZkmuRPINJ5qT54wBWKlvF1fa2sz7BD5RlRB6Nf.png\",\"platform_icon\":\"pages\\/3DDqFXB4GB2tc3WyMQerVrPapsAX2Z9C9CvbufoH.png\",\"platform_text\":\"Google\",\"description\":\"The manicure was incredibly gentle and precise \\u2014 my nails have never looked this clean and natural 1\",\"name\":\"Anna K.\",\"client_type\":\"Regular client\"},{\"image\":\"pages\\/vHMdb79eVtCvp0XtcfuX1Ny5gIg5vXRak0Z8SuDG.png\",\"platform_icon\":\"pages\\/cnlGQ2bsNzBS40e9cyufW3zE0s6l54qQsygYrVwH.png\",\"platform_text\":\"Facebook\",\"description\":\"The manicure was incredibly gentle and precise \\u2014 my nails have never looked this clean and natural 2\",\"name\":\"Anna K.\",\"client_type\":\"Regular client\"},{\"image\":\"pages\\/UI3hIzoYyEvAdPE2tvX9hgzCPjPEXrlRMAuQOdbp.png\",\"platform_icon\":\"pages\\/pf3rkX0A28dFRxSm4tnDT7SbpCYfcjE2KbL4TR8k.png\",\"platform_text\":\"Facebook\",\"description\":\"The manicure was incredibly gentle and precise \\u2014 my nails have never looked this clean and natural 1 The manicure was incredibly gentle and precise \\u2014 my nails have never looked this clean and natural 1\",\"name\":\"Anna K.\",\"client_type\":\"Regular client\"},{\"image\":\"pages\\/gcWCzyLtPU2wRB5zqGNK8UQ2etdopegN9b4XgVhQ.png\",\"platform_icon\":\"pages\\/kwubdAxg7yu7vUBWVpzO699ex6eXpV9qHBQcf9N2.png\",\"platform_text\":\"Facebook\",\"description\":\"The manicure was incredibly gentle and precise \\u2014 my nails have never looked this clean and natural 3\",\"name\":\"Anna K.\",\"client_type\":\"Regular client\"}],\"subtitle\":\"What our clients say\",\"is_lazy\":1}},\"7\":{\"key\":7,\"name\":\"faq\",\"values\":{\"title\":\"Have questions?\",\"subtitle\":\"Still unsure? <br> Contact us anytime\",\"questions\":[{\"title\":\"How long does a European manicure take?\",\"description\":\"Usually 45\\u201360 minutes depending on your nail condition.\"},{\"title\":\"Do you work with damaged or thin nails?\",\"description\":\"Usually 45\\u201360 minutes depending on your nail condition.\"},{\"title\":\"Can I do manicure if I have sensitive skin or allergies?\",\"description\":\"Usually 45\\u201360 minutes depending on your nail condition.\"},{\"title\":\"What hygiene measures do you follow?\",\"description\":\"Usually 45\\u201360 minutes depending on your nail condition.\"},{\"title\":\"How do I book an appointment?\",\"description\":\"Usually 45\\u201360 minutes depending on your nail condition.\"},{\"title\":\"Do you offer nail restoration treatments?\",\"description\":\"Usually 45\\u201360 minutes depending on your nail condition.\"}]}},\"8\":{\"key\":8,\"name\":\"contact\",\"values\":{\"image\":\"pages\\/fT0wOUcVzu4y7DH2SjHlgErbCBoiW1E5C2YTpwX2.jpg\",\"title\":\"Contact\",\"description\":\"The studio offers a calm and private environment for every visit.Feel free to reach out with any questions or to book an appointment \\u2014 we\\u2019re here to make your experience comfortable and refined.\",\"contact_info_title\":\"Visit the Studio\",\"contact_info\":[{\"icon\":\"pages\\/c4HNRqmltwo8jdojh5W2i96t8fuE73x2TgjhK18c.svg\",\"text\":\"Mon\\u2013Sat: 10:00\\u201319:00\"},{\"icon\":\"pages\\/GAwcVZ50tY8F3BxPpBmV4wEO8DUcN1UMHly9uZ2z.svg\",\"text\":\"<p><a href=\\\"#!\\\">4610 Utica Ridge Rd Suite 109, Davenport, IA 52807<\\/a><\\/p>\"},{\"icon\":\"pages\\/GF5biNNFQo0GsXUJ6V7TOoAKtrE6sf2twuPQtoXk.svg\",\"text\":\"<p><a href=\\\"tel:+15632415642\\\">+1 (563) 241-5642<\\/a><\\/p>\"},{\"icon\":\"pages\\/6SA1jlAgQs4wqY7APCrKNRktv9FRkyQnNEp68zFJ.svg\",\"text\":\"<p><a href=\\\"mailto:help.europeanmanicure@gmail.com\\\">help.europeanmanicure@gmail.com<\\/a><\\/p>\"}],\"socials_title\":\"Social Media:\",\"socials\":[{\"icon\":\"pages\\/tKI8IZJVHR4UuLImizmc0tqISDqnb2nxxHMds26E.svg\",\"link\":\"#!\"},{\"icon\":\"pages\\/RAc46JgJ11c89tUuDU0WR1WxcMpSGHBaYxpB3iSA.svg\",\"link\":\"#!\"}],\"form_title\":\"Book an Appointment\",\"button_text\":\"Send Request\",\"success_message\":\"Your message has been sent successfully!\",\"is_lazy\":1}}}','2026-03-24 13:45:04','2026-03-26 05:21:25');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('3AgPjVE6mB1hyUqZB7EBcwCHKj8205ps51aI7uvT',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiJoREFPS2RnN0lEdVY4Tzc1ZEpEZTdCY0xWNlM3TFZmNjJ6NjBrc2kxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V1cm9wZWFuLW1hbmljdXJlLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1774513168),
('fE6xSFr1prMG8igIvaRgPdsHafEFxB32vGcDtchr',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiJkREFpOVU2V1oxekZXRFlPU28wZ0MyVFg3bGlxTEhJRkxvVkJQZHoxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V1cm9wZWFuLW1hbmljdXJlLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl9tb29uc2hpbmVfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF9tb29uc2hpbmUiOiI5M2RhN2Q0OWQ4ZWNiM2MyYTkxZDUwOGZiMjRjZmVjZWI3MTVmMzU0YTc2MDlmZTViYTY3Zjc0NjQ4MGFlNzg1In0=',1774516372),
('hXuyH2zXa00lLFByYZxUNrKM9p31CRPUV99DbwxG',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiJJYTU4THZSZXpTMjBkdEpPUVh0UVg3dEozaDJ2ZDBkb0pkZjFSbTBQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V1cm9wZWFuLW1hbmljdXJlLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1774507777),
('jcyVyX2ppjffjJ7ozdlEH6Pzgm7ItZWGbID7iZ7i',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiJORUc1NXlpQzB2TkxKVjdMWk5qaDhTWHJmMmpQQm00dGUxT2ZzdHFOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V1cm9wZWFuLW1hbmljdXJlLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1774507648),
('Pc6QetYCSUfQIQvceaW4rn1fEvrULHN18nEfNt5z',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiJpOUJ6T0dwb2cxcHphNTM0c3hCcVI2SlowZVhROEhtc3oyYkMweWpyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2V1cm9wZWFuLW1hbmljdXJlLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1774515476);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'Header','header','{\"1\":{\"key\":1,\"name\":\"header\",\"values\":{\"links\":[{\"text\":\"Home\",\"url\":\"#!\"},{\"text\":\"About\",\"url\":\"#!\"},{\"text\":\"Services\",\"url\":\"#!\"},{\"text\":\"Contact\",\"url\":\"#!\"}],\"logo\":\"settings\\/SDHruNZjAZjLvaKx1dlmhEc4WZg15UX4KRMuwMzT.png\",\"info\":[{\"icon\":\"settings\\/B3gAWsNF8THYy3viiPHXSONtbbHSTeaUvhjJfdST.svg\",\"text\":\"421 Madison Avenue, NY\"},{\"icon\":\"settings\\/Y6B4cIrRop9HMFA39xUWCiXpYrsBGZZC3txdXTsq.svg\",\"text\":\"Mon\\u2013Sat: 10:00\\u201319:00\"}],\"socials\":[{\"name\":\"instagram\",\"url\":\"#!\",\"icon\":\"settings\\/hvbaoGZtEqLN5tfRQ7nMHVKreprN75SHRdLq5CXH.svg\"},{\"name\":\"Facebook\",\"url\":\"#!\",\"icon\":\"settings\\/r1LtEGEanTpY3IKsQ4Mu3LpQfgSlZdDp5JBh11vc.svg\"}],\"button_text\":\"Book Online\"}}}','2026-03-24 15:50:27','2026-03-24 22:06:36'),
(2,'Footer','footer','{\"1\":{\"key\":1,\"name\":\"footer\",\"values\":{\"logo\":\"settings\\/81EgKwvdmIsoYY0IQHrtgJEUsEry7Z9W9LQov8js.png\",\"name\":\"EUROPEAN MANICURE\",\"copyright\":\"\\u00a9 2026. All rights reserved.\",\"links\":[{\"text\":\"Privacy Policy\",\"url\":\"#!\"},{\"text\":\"Terms of Service\",\"url\":\"#!\"}]}}}','2026-03-26 05:16:50','2026-03-26 05:16:50');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-03-26 12:18:41
