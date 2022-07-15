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

-- Les données exportées n'étaient pas sélectionnées.

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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table iformat. classrooms
DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE IF NOT EXISTS `classrooms` (
  `classrooms_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `classrooms_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classrooms_countries_id` int(11) NOT NULL,
  `classrooms_state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classrooms_status` int(11) NOT NULL DEFAULT '1',
  `classrooms_detail` text COLLATE utf8mb4_unicode_ci,
  `classrooms_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `classrooms_user_updated_by` int(11) DEFAULT NULL,
  `classrooms_created_at` timestamp NOT NULL,
  `classrooms_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`classrooms_id`),
  KEY `classrooms_classrooms_user_created_by_foreign` (`classrooms_user_created_by`),
  CONSTRAINT `classrooms_classrooms_user_created_by_foreign` FOREIGN KEY (`classrooms_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table iformat. groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `groups_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `groups_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groups_participant` json DEFAULT NULL,
  `groups_status` int(11) NOT NULL DEFAULT '1',
  `groups_detail` text COLLATE utf8mb4_unicode_ci,
  `groups_learning_id` int(11) DEFAULT NULL,
  `groups_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `groups_user_updated_by` int(11) DEFAULT NULL,
  `groups_created_at` timestamp NOT NULL,
  `groups_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`groups_id`),
  KEY `groups_groups_user_created_by_foreign` (`groups_user_created_by`),
  CONSTRAINT `groups_groups_user_created_by_foreign` FOREIGN KEY (`groups_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table iformat. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table iformat. password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table iformat. plannings
DROP TABLE IF EXISTS `plannings`;
CREATE TABLE IF NOT EXISTS `plannings` (
  `plannings_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plannings_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plannings_infos` text COLLATE utf8mb4_unicode_ci,
  `plannings_teachers` json DEFAULT NULL,
  `plannings_teachers_roles` json DEFAULT NULL,
  `plannings_user_groups` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

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

-- Les données exportées n'étaient pas sélectionnées.

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
  `department` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_created_by` bigint(20) unsigned DEFAULT NULL,
  `user_updated_by` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_user_created_by_foreign` (`user_created_by`),
  CONSTRAINT `users_user_created_by_foreign` FOREIGN KEY (`user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
