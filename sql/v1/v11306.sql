-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table iformat. assessments
DROP TABLE IF EXISTS `assessments`;
CREATE TABLE IF NOT EXISTS `assessments` (
  `assessments_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assessments_learning_id` bigint(20) unsigned DEFAULT NULL,
  `assessments_participant_id` bigint(20) unsigned DEFAULT NULL,
  `assessments_value` bigint(20) unsigned DEFAULT NULL,
  `assessments_created_at` timestamp NOT NULL,
  `assessments_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`assessments_id`),
  KEY `assessments_assessments_user_created_by_foreign` (`assessments_participant_id`),
  KEY `FK_assessments_learnings` (`assessments_learning_id`),
  CONSTRAINT `FK_assessments_learnings` FOREIGN KEY (`assessments_learning_id`) REFERENCES `learnings` (`learnings_id`),
  CONSTRAINT `assessments_assessments_user_created_by_foreign` FOREIGN KEY (`assessments_participant_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.assessments : ~1 rows (environ)
/*!40000 ALTER TABLE `assessments` DISABLE KEYS */;
INSERT INTO `assessments` (`assessments_id`, `assessments_learning_id`, `assessments_participant_id`, `assessments_value`, `assessments_created_at`, `assessments_updated_at`) VALUES
	(18, 1, 9, 17, '2022-06-10 21:55:31', '2022-06-10 21:55:31');
/*!40000 ALTER TABLE `assessments` ENABLE KEYS */;

-- Listage de la structure de la table iformat. certifications
DROP TABLE IF EXISTS `certifications`;
CREATE TABLE IF NOT EXISTS `certifications` (
  `certifications_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `certifications_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certifications_participant` json DEFAULT NULL,
  `certifications_participant_list` json DEFAULT NULL,
  `certifications_learnings_id` bigint(20) unsigned DEFAULT NULL,
  `certifications_group_id` bigint(20) unsigned DEFAULT NULL,
  `certifications_status` int(11) NOT NULL DEFAULT '1',
  `certifications_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `certifications_user_updated_by` int(11) DEFAULT NULL,
  `certifications_created_at` timestamp NOT NULL,
  `certifications_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`certifications_id`),
  UNIQUE KEY `certifications_certifications_code_unique` (`certifications_code`),
  KEY `certifications_certifications_learnings_id_foreign` (`certifications_learnings_id`),
  KEY `certifications_certifications_user_created_by_foreign` (`certifications_user_created_by`),
  CONSTRAINT `certifications_certifications_learnings_id_foreign` FOREIGN KEY (`certifications_learnings_id`) REFERENCES `learnings` (`learnings_id`) ON DELETE CASCADE,
  CONSTRAINT `certifications_certifications_user_created_by_foreign` FOREIGN KEY (`certifications_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.certifications : ~4 rows (environ)
/*!40000 ALTER TABLE `certifications` DISABLE KEYS */;
INSERT INTO `certifications` (`certifications_id`, `certifications_code`, `certifications_participant`, `certifications_participant_list`, `certifications_learnings_id`, `certifications_group_id`, `certifications_status`, `certifications_user_created_by`, `certifications_user_updated_by`, `certifications_created_at`, `certifications_updated_at`) VALUES
	(5, 'ICDL1', '["9", "10"]', '["9", "10"]', 1, 3, 1, 1, NULL, '2022-05-20 09:03:31', '2022-05-20 09:03:39'),
	(6, 'ICDL6', '["7"]', '["7"]', 1, 2, 1, 1, NULL, '2022-05-20 09:03:49', '2022-05-20 09:03:49'),
	(7, 'ICDL7', '["6"]', '["6"]', 1, 1, 1, 1, NULL, '2022-05-20 09:04:01', '2022-05-20 09:04:01'),
	(8, 'ICDL8', '["12"]', '["12"]', 1, 5, 1, 1, NULL, '2022-05-20 10:21:40', '2022-05-20 10:21:40'),
	(9, 'ICDL9', '["14"]', '["14"]', 1, 6, 1, 1, NULL, '2022-05-20 10:21:53', '2022-05-20 10:21:53'),
	(10, 'ICDL10', '["11"]', '["11"]', 1, 4, 1, 1, NULL, '2022-06-10 22:03:07', '2022-06-10 22:03:07');
/*!40000 ALTER TABLE `certifications` ENABLE KEYS */;

-- Listage de la structure de la table iformat. classrooms
DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE IF NOT EXISTS `classrooms` (
  `classrooms_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `classrooms_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classrooms_countries_id` int(11) NOT NULL,
  `classrooms_status` int(11) NOT NULL DEFAULT '1',
  `classrooms_detail` text COLLATE utf8mb4_unicode_ci,
  `classrooms_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `classrooms_user_updated_by` int(11) DEFAULT NULL,
  `classrooms_created_at` timestamp NOT NULL,
  `classrooms_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`classrooms_id`),
  KEY `classrooms_classrooms_user_created_by_foreign` (`classrooms_user_created_by`),
  CONSTRAINT `classrooms_classrooms_user_created_by_foreign` FOREIGN KEY (`classrooms_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.classrooms : ~6 rows (environ)
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
INSERT INTO `classrooms` (`classrooms_id`, `classrooms_name`, `classrooms_countries_id`, `classrooms_status`, `classrooms_detail`, `classrooms_user_created_by`, `classrooms_user_updated_by`, `classrooms_created_at`, `classrooms_updated_at`) VALUES
	(1, 'Salles A1', 1, -1, NULL, 1, 1, '2022-04-29 07:43:55', '2022-04-29 23:05:05'),
	(2, 'Salles A2', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:22', '2022-04-30 02:01:22'),
	(3, 'Salles A3', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:30', '2022-04-30 02:01:30'),
	(4, 'Salles A4', 2, 1, NULL, 1, NULL, '2022-04-30 02:01:42', '2022-04-30 02:01:42'),
	(5, 'Salles A5', 3, 1, NULL, 1, NULL, '2022-04-30 02:01:53', '2022-04-30 02:01:53'),
	(6, 'Salles A6', 3, 1, NULL, 1, NULL, '2022-04-30 02:02:03', '2022-04-30 02:02:03');
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;

-- Listage de la structure de la table iformat. failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Listage des données de la table iformat.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table iformat. groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `groups_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `groups_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groups_participant` json DEFAULT NULL,
  `groups_status` int(11) NOT NULL DEFAULT '1',
  `groups_detail` text COLLATE utf8mb4_unicode_ci,
  `groups_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `groups_user_updated_by` int(11) DEFAULT NULL,
  `groups_created_at` timestamp NOT NULL,
  `groups_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`groups_id`),
  KEY `groups_groups_user_created_by_foreign` (`groups_user_created_by`),
  CONSTRAINT `groups_groups_user_created_by_foreign` FOREIGN KEY (`groups_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.groups : ~6 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`groups_id`, `groups_name`, `groups_participant`, `groups_status`, `groups_detail`, `groups_user_created_by`, `groups_user_updated_by`, `groups_created_at`, `groups_updated_at`) VALUES
	(1, 'G1', '["6"]', 1, NULL, 1, NULL, '2022-05-11 07:15:04', '2022-05-11 07:15:04'),
	(2, 'G2', '["7"]', 1, NULL, 1, NULL, '2022-05-11 07:15:20', '2022-05-11 07:15:20'),
	(3, 'G3', '["9", "10"]', 1, NULL, 1, NULL, '2022-05-16 18:53:29', '2022-05-16 18:53:29'),
	(4, 'G4', '["11"]', 1, NULL, 1, NULL, '2022-05-16 18:54:00', '2022-05-16 18:54:00'),
	(5, 'G5', '["12"]', 1, NULL, 1, NULL, '2022-05-16 18:54:12', '2022-05-16 18:54:12'),
	(6, 'G6', '["14"]', 1, NULL, 1, NULL, '2022-05-16 18:54:35', '2022-05-16 18:54:35');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage de la structure de la table iformat. learnings
DROP TABLE IF EXISTS `learnings`;
CREATE TABLE IF NOT EXISTS `learnings` (
  `learnings_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `learnings_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learnings_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learnings_title2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `learnings_goal` text COLLATE utf8mb4_unicode_ci,
  `learnings_target` text COLLATE utf8mb4_unicode_ci,
  `learnings_duration` text COLLATE utf8mb4_unicode_ci,
  `learnings_infos` text COLLATE utf8mb4_unicode_ci,
  `learnings_author_id` int(11) DEFAULT NULL,
  `learnings_days` json DEFAULT NULL,
  `learnings_time_slot` json DEFAULT NULL,
  `learnings_status` int(11) NOT NULL DEFAULT '1',
  `learnings_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `learnings_user_updated_by` int(11) DEFAULT NULL,
  `learnings_created_at` timestamp NOT NULL,
  `learnings_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`learnings_id`),
  UNIQUE KEY `learnings_learnings_code_unique` (`learnings_code`),
  KEY `learnings_learnings_user_created_by_foreign` (`learnings_user_created_by`),
  CONSTRAINT `learnings_learnings_user_created_by_foreign` FOREIGN KEY (`learnings_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.learnings : ~2 rows (environ)
/*!40000 ALTER TABLE `learnings` DISABLE KEYS */;
INSERT INTO `learnings` (`learnings_id`, `learnings_code`, `learnings_title`, `learnings_title2`, `learnings_goal`, `learnings_target`, `learnings_duration`, `learnings_infos`, `learnings_author_id`, `learnings_days`, `learnings_time_slot`, `learnings_status`, `learnings_user_created_by`, `learnings_user_updated_by`, `learnings_created_at`, `learnings_updated_at`) VALUES
	(1, 'FORM', 'EXCEL PERFECTIONNEMENT', 'Les fonctionnalités incontournables pour être efficace', 'Test', 'Test', '30', 'Tester', 1, '["1", "2", "3", "4", "5"]', '["08:00 - 12:00", "15:00 - 19:26"]', 1, 1, 1, '2022-05-11 05:47:09', '2022-05-20 09:39:29'),
	(2, 'FORM2', 'EXCEL PERFECTIONNEMENT', 'Les fonctionnalités incontournables pour être efficace', 'Test2', 'Test 2', '15', NULL, NULL, '["2", "4"]', '["06:33 - 06:34"]', 1, 1, 1, '2022-05-13 04:37:11', '2022-05-13 05:11:26'),
	(3, 'FORM3', 'EXCEL PERFECTIONNEMENT APPROFONDI', 'Les fonctionnalités incontournables pour être efficace', 'Maîtriser les fonctions financières et avancées essentielles au métier de la Banque, de la Finance, \r\nde la statistique, de l’Analyse de données et de la Comptabilité.', 'Contrôleurs de gestion, DAF, Financiers, Banquiers, Statisticiens, RH, toute personne ayant à exploiter des résultats chiffrés dans Excel. \r\nLes exercices et cas pratiques sont tirés de cas professionnels.', '60', '30 heures soit 6 heures par jour sur 5 jours / 08h à 14H30.\r\nPause-café, cas pratiques, attestation de formation', 1, '["1", "2", "3"]', '["08:00 - 12:00", "15:00 - 18:00"]', 1, 1, 1, '2022-06-10 21:26:27', '2022-06-10 21:29:22');
/*!40000 ALTER TABLE `learnings` ENABLE KEYS */;

-- Listage de la structure de la table iformat. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.migrations : ~11 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(29, '2014_04_24_201258_create_roles_table', 1),
	(30, '2014_10_12_000000_create_users_table', 1),
	(31, '2014_10_12_100000_create_password_resets_table', 1),
	(32, '2019_08_19_000000_create_failed_jobs_table', 1),
	(33, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(34, '2022_04_28_223303_create_classrooms_table', 1),
	(35, '2022_04_28_224315_create_learnings_table', 1),
	(36, '2022_04_30_122943_create_groups_table', 1),
	(37, '2022_05_07_071545_create_plannings_table', 1),
	(38, '2022_05_17_163033_create_presences_table', 1),
	(39, '2022_05_17_163913_create_certifications_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table iformat. password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table iformat. personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Listage des données de la table iformat.personal_access_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage de la structure de la table iformat. plannings
DROP TABLE IF EXISTS `plannings`;
CREATE TABLE IF NOT EXISTS `plannings` (
  `plannings_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plannings_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plannings_infos` text COLLATE utf8mb4_unicode_ci,
  `plannings_teachers` json DEFAULT NULL,
  `plannings_teachers_roles` json DEFAULT NULL,
  `plannings_user_groups` json DEFAULT NULL,
  `plannings_time_slot` json DEFAULT NULL,
  `plannings_status` int(11) NOT NULL DEFAULT '1',
  `plannings_date` json DEFAULT NULL,
  `plannings_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `plannings_learning_id` bigint(20) unsigned DEFAULT NULL,
  `plannings_classroom_id` bigint(20) unsigned DEFAULT NULL,
  `plannings_user_updated_by` int(11) DEFAULT NULL,
  `plannings_created_at` timestamp NOT NULL,
  `plannings_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`plannings_id`),
  UNIQUE KEY `plannings_plannings_code_unique` (`plannings_code`),
  KEY `plannings_plannings_user_created_by_foreign` (`plannings_user_created_by`),
  KEY `plannings_plannings_learning_id_foreign` (`plannings_learning_id`),
  KEY `plannings_plannings_classroom_id_foreign` (`plannings_classroom_id`),
  CONSTRAINT `plannings_plannings_classroom_id_foreign` FOREIGN KEY (`plannings_classroom_id`) REFERENCES `classrooms` (`classrooms_id`),
  CONSTRAINT `plannings_plannings_learning_id_foreign` FOREIGN KEY (`plannings_learning_id`) REFERENCES `learnings` (`learnings_id`) ON DELETE CASCADE,
  CONSTRAINT `plannings_plannings_user_created_by_foreign` FOREIGN KEY (`plannings_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.plannings : ~3 rows (environ)
/*!40000 ALTER TABLE `plannings` DISABLE KEYS */;
INSERT INTO `plannings` (`plannings_id`, `plannings_code`, `plannings_infos`, `plannings_teachers`, `plannings_teachers_roles`, `plannings_user_groups`, `plannings_time_slot`, `plannings_status`, `plannings_date`, `plannings_user_created_by`, `plannings_learning_id`, `plannings_classroom_id`, `plannings_user_updated_by`, `plannings_created_at`, `plannings_updated_at`) VALUES
	(1, 'PLAN1', 'soso', '["4"]', NULL, '["1"]', '["08:00 - 12:00", "08:00 - 12:00"]', 1, '["2022-05-16", "2022-05-23"]', 4, 1, 5, 1, '2022-05-13 07:12:32', '2022-05-16 19:16:15'),
	(2, 'PLAN2', 'SOSO', '["4"]', NULL, '["2"]', '["08:00 - 12:00", "08:00 - 12:00", "08:00 - 12:00"]', 1, '["2022-05-23", "2022-05-30", "2022-06-06"]', 6, 1, 6, 1, '2022-05-15 15:32:53', '2022-05-20 09:51:47'),
	(3, 'PLAN3', NULL, '["4"]', NULL, '["3", "4"]', '["15:00 - 19:26", "15:00 - 19:26", "15:00 - 19:26"]', 1, '["2022-05-20", "2022-05-27", "2022-06-03"]', 1, 1, 6, NULL, '2022-05-20 09:54:00', '2022-05-20 09:54:00'),
	(4, 'PLAN4', NULL, '["4"]', NULL, '["5", "6"]', '["08:00 - 12:00", "08:00 - 12:00", "08:00 - 12:00"]', 1, '["2022-06-24", "2022-06-31", "2022-06-07"]', 1, 1, 4, NULL, '2022-05-20 09:54:55', '2022-05-20 09:54:55'),
	(5, 'PLAN5', NULL, '["4"]', NULL, '["1", "2"]', '["08:00 - 12:00", "08:00 - 12:00"]', 1, '["2022-06-13", "2022-06-20"]', 1, 3, 2, 1, '2022-06-10 21:34:41', '2022-06-10 21:36:46');
/*!40000 ALTER TABLE `plannings` ENABLE KEYS */;

-- Listage de la structure de la table iformat. presences
DROP TABLE IF EXISTS `presences`;
CREATE TABLE IF NOT EXISTS `presences` (
  `presences_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `presences_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presences_time_slot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presences_participant` json DEFAULT NULL,
  `presences_participant_list` json DEFAULT NULL,
  `presences_date` date NOT NULL,
  `presences_planning_id` bigint(20) unsigned DEFAULT NULL,
  `presences_group_id` bigint(20) unsigned DEFAULT NULL,
  `presences_status` int(11) NOT NULL DEFAULT '1',
  `presences_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `presences_user_updated_by` int(11) DEFAULT NULL,
  `presences_created_at` timestamp NOT NULL,
  `presences_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`presences_id`),
  UNIQUE KEY `presences_presences_code_unique` (`presences_code`),
  KEY `presences_presences_planning_id_foreign` (`presences_planning_id`),
  KEY `presences_presences_user_created_by_foreign` (`presences_user_created_by`),
  CONSTRAINT `presences_presences_planning_id_foreign` FOREIGN KEY (`presences_planning_id`) REFERENCES `plannings` (`plannings_id`) ON DELETE CASCADE,
  CONSTRAINT `presences_presences_user_created_by_foreign` FOREIGN KEY (`presences_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.presences : ~3 rows (environ)
/*!40000 ALTER TABLE `presences` DISABLE KEYS */;
INSERT INTO `presences` (`presences_id`, `presences_code`, `presences_time_slot`, `presences_participant`, `presences_participant_list`, `presences_date`, `presences_planning_id`, `presences_group_id`, `presences_status`, `presences_user_created_by`, `presences_user_updated_by`, `presences_created_at`, `presences_updated_at`) VALUES
	(15, 'PRE1', '08:00 - 12:00', '["12"]', '["12"]', '2022-06-07', 4, 5, 1, 4, NULL, '2022-06-10 19:20:37', '2022-06-10 19:20:37'),
	(16, 'PRE16', '08:00 - 12:00', '["14"]', '["14"]', '2022-06-07', 4, 6, 1, 4, NULL, '2022-06-10 19:21:07', '2022-06-10 19:21:07'),
	(17, 'PRE17', '15:00 - 19:26', '["9", "10"]', '["10"]', '2022-05-20', 3, 3, 1, 4, 4, '2022-06-10 19:22:37', '2022-06-10 21:46:38'),
	(18, 'PRE18', '15:00 - 19:26', '["11"]', '["11"]', '2022-05-20', 3, 4, 1, 4, NULL, '2022-06-10 21:47:54', '2022-06-10 21:47:54');
/*!40000 ALTER TABLE `presences` ENABLE KEYS */;

-- Listage de la structure de la table iformat. roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.roles : ~0 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table iformat. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_created_by` bigint(20) unsigned DEFAULT NULL,
  `user_updated_by` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_user_created_by_foreign` (`user_created_by`),
  CONSTRAINT `users_user_created_by_foreign` FOREIGN KEY (`user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.users : ~20 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `gender`, `from`, `fonction`, `user_role_id`, `user_created_by`, `user_updated_by`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Super', 'admin@gmail.com', '66666666', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '$2y$10$zmHrqdDegQRc41t0INK5uOODuJk35q0kEt9kil5Kd57pw.vYHEBnS', 1, NULL, '2022-04-29 07:34:01', '2022-04-29 07:34:01'),
	(2, 'sortoto', 'Spon', 'spon1@gmail.com', '62547853', NULL, NULL, NULL, NULL, 2, 1, 1, NULL, '$2y$10$EX9rNTQRPzErVUL.Jz/MY.R0kUJKyjOmEoyMF2jDCo0l38o5Q88nq', -1, NULL, '2022-04-30 02:03:57', '2022-04-30 09:33:08'),
	(3, 'DANIEL', 'DANIEL', 'daniel@gmail.com', '62458768', NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, '$2y$10$tEqy./uNZ37bg80vlIy8qOh.xKn4J9JuR1psWOHwlUrJsxCud.5U6', 1, NULL, '2022-04-30 02:07:08', '2022-04-30 02:07:08'),
	(4, 'ASSIAVI', 'ASSIAVI', 'assiavi@gmail.com', '62351478', NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, '$2y$10$erSq1i98Gy9K73hARw6Tf.eF7M8bqKHTDtlwzIm9DbnfgUMrDKF1u', 1, NULL, '2022-04-30 09:36:21', '2022-04-30 09:36:21'),
	(5, 'Jolie', 'DALMEIDA', 'dalmeida@gmail.com', NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, '$2y$10$LnMkNXc1woDI9Kn2ZaQf1ey1A4h83QN.HkgJ7QMMr6a9Gx3g2fM4G', 1, NULL, '2022-04-30 09:38:45', '2022-04-30 09:38:45'),
	(6, 'Benito', 'CLARO', 'claro.benito@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$8s/AkkEBW/kB197d8Y0GCusKacqRSebXBNmBHrpBTGXZ.GksoHRRG', 1, NULL, '2022-04-30 10:17:31', '2022-04-30 10:17:31'),
	(7, 'Habib', 'OROU', 'orou.habib@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$EFp.fQt79farwqteeVs2r.hGtAsS6jfOW0k4/oNCYbLCfKT3OD62u', 1, NULL, '2022-04-30 10:18:21', '2022-04-30 10:18:21'),
	(8, 'Abdel', 'VIHO', 'viho@gmail.com', NULL, NULL, NULL, 'ASSI2', 'DT-Adjoint', 4, 1, NULL, NULL, '$2y$10$3W6lkWGIhDoG74CNtTXuv.qZaywPtIGkgnuJjLwzNGPJuGrcVrj6C', 1, NULL, '2022-04-30 10:31:12', '2022-04-30 10:42:39'),
	(9, 'P1', 'Participant1', 'p1@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$zwq.GdmxMKvDFs73BpBEYuadsdPGYPoA8TP5JeZixBFA9JjveKR4G', 1, NULL, '2022-05-16 18:45:25', '2022-05-16 18:45:25'),
	(10, 'P2', 'Participant2', 'p2@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$eJmtAXPAzdK1xmGPnp/2ZeeI4sDKYo6BBhDT.uLW4H3In//xu.gGe', 1, NULL, '2022-05-16 18:46:04', '2022-05-16 18:46:04'),
	(11, 'p3', 'Participant3', 'p3@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$okeN70FH.1wjYx/QY8NgfuHOD.HprTWbJ6s3Xw5JBxDeYCxVe0FQ.', 1, NULL, '2022-05-16 18:48:36', '2022-05-16 18:48:36'),
	(12, 'p4', 'Participant4', 'p4@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$kL.Yf.bqanOPfxBj24FtHODeuIPlwhlHpWSnOXnJHMwmMuAvrLzp6', 1, NULL, '2022-05-16 18:49:00', '2022-05-16 18:49:00'),
	(13, 'p5', 'Participant', 'p5@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$MN/HzGekvmJdHCWkEJvfIe8CO0gX5BFntZsKp9goI/dJ4oDI9pS7S', 1, NULL, '2022-05-16 18:49:20', '2022-05-16 18:49:20'),
	(14, 'p6', 'Participant6', 'p6@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$iPhy.OZuNISV6e4MikDK1uDclkRa/JdgIEqOsDVaHDyjf7DWTzJEe', 1, NULL, '2022-05-16 18:49:42', '2022-05-16 18:49:42'),
	(15, 'p7', 'Participant7', 'p7@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$jHqjkCMgbdvykNA/BR.TzuHr1duPy5mw43ozWxa.OnSJs7eZHjEiK', 1, NULL, '2022-05-16 18:50:02', '2022-05-16 18:50:02'),
	(16, 'p8', 'Participant8', 'p8@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$vJ2FHg89rjfcxXDKdBSl.urc2Dblx9j2js./f1oUwDwkJHXu0SMdy', 1, NULL, '2022-05-16 18:50:21', '2022-05-16 18:50:21'),
	(17, 'p9', 'Participant9', 'p9@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$ZfLO0hcOH13PeA53YBBxJOSKpb3xEeuIZwFrdnq0PnBhy47Cktb8i', 1, NULL, '2022-05-16 18:50:41', '2022-05-16 18:50:41'),
	(18, 'p10', 'Participant10', 'p10@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$9pHJudY8lOJDq15G1W5WaekeoCBxnXMl74ebB.8Xnnp22H00PCcee', 1, NULL, '2022-05-16 18:51:09', '2022-05-16 18:51:09'),
	(19, 'p11', 'Participant11', 'p11@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$77vUq6q.2Lczt7SweZNJXu7vdJn9Gr2N4JVcPYE2rHN.XBavy0Sy.', 1, NULL, '2022-05-16 18:52:02', '2022-05-16 18:52:02'),
	(20, 'p12', 'Participant12', 'p12@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$sV03yyZCmDKfsN6KIBOyk.S6Ox1xE6U1h3jQXup6aKQy2adJ.lGpG', 1, NULL, '2022-05-16 18:52:26', '2022-05-16 18:52:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
