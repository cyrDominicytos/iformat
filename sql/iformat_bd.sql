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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.classrooms : ~0 rows (environ)
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
INSERT IGNORE INTO `classrooms` (`classrooms_id`, `classrooms_name`, `classrooms_countries_id`, `classrooms_status`, `classrooms_detail`, `classrooms_user_created_by`, `classrooms_user_updated_by`, `classrooms_created_at`, `classrooms_updated_at`) VALUES
	(1, 'Salles A25', 1, -1, NULL, 1, 1, '2022-04-29 07:43:55', '2022-04-29 23:05:05'),
	(2, 'Salles A25', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:22', '2022-04-30 02:01:22'),
	(3, 'Salles A4', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:30', '2022-04-30 02:01:30'),
	(4, 'Salles A2510', 2, 1, NULL, 1, NULL, '2022-04-30 02:01:42', '2022-04-30 02:01:42'),
	(5, 'Salles A4', 3, 1, NULL, 1, NULL, '2022-04-30 02:01:53', '2022-04-30 02:01:53'),
	(6, 'Salles A4', 3, 1, NULL, 1, NULL, '2022-04-30 02:02:03', '2022-04-30 02:02:03'),
	(7, 'Bourse de travail', 2, 1, 'test', 1, 1, '2022-04-30 19:10:53', '2022-04-30 19:11:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.groups : ~0 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT IGNORE INTO `groups` (`groups_id`, `groups_name`, `groups_participant`, `groups_status`, `groups_detail`, `groups_user_created_by`, `groups_user_updated_by`, `groups_created_at`, `groups_updated_at`) VALUES
	(6, 'G1', '["6"]', -1, 'test', 1, 1, '2022-04-30 19:16:16', '2022-05-01 07:02:36'),
	(7, 'G2', '["7"]', -1, 'test', 1, 1, '2022-04-30 19:17:13', '2022-05-01 07:03:08');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage de la structure de la table iformat. learnings
DROP TABLE IF EXISTS `learnings`;
CREATE TABLE IF NOT EXISTS `learnings` (
  `learnings_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `learnings_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learnings_goal` text COLLATE utf8mb4_unicode_ci,
  `learnings_target` text COLLATE utf8mb4_unicode_ci,
  `learnings_duration` text COLLATE utf8mb4_unicode_ci,
  `learnings_infos` text COLLATE utf8mb4_unicode_ci,
  `learnings_status` int(11) NOT NULL DEFAULT '1',
  `learnings_user_created_by` bigint(20) unsigned DEFAULT NULL,
  `learnings_user_updated_by` int(11) DEFAULT NULL,
  `learnings_created_at` timestamp NOT NULL,
  `learnings_updated_at` timestamp NOT NULL,
  PRIMARY KEY (`learnings_id`),
  KEY `learnings_learnings_user_created_by_foreign` (`learnings_user_created_by`),
  CONSTRAINT `learnings_learnings_user_created_by_foreign` FOREIGN KEY (`learnings_user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.learnings : ~0 rows (environ)
/*!40000 ALTER TABLE `learnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `learnings` ENABLE KEYS */;

-- Listage de la structure de la table iformat. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.migrations : ~8 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(48, '2014_04_24_201258_create_roles_table', 1),
	(49, '2014_10_12_000000_create_users_table', 1),
	(50, '2014_10_12_100000_create_password_resets_table', 1),
	(51, '2019_08_19_000000_create_failed_jobs_table', 1),
	(52, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(53, '2022_04_28_223303_create_classrooms_table', 1),
	(54, '2022_04_28_224315_create_learnings_table', 1),
	(55, '2014_04_24_201258_create_roles_table', 1),
	(56, '2014_10_12_000000_create_users_table', 1),
	(57, '2014_10_12_100000_create_password_resets_table', 1),
	(58, '2019_08_19_000000_create_failed_jobs_table', 1),
	(59, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(60, '2022_04_28_223303_create_classrooms_table', 1),
	(61, '2022_04_28_224315_create_learnings_table', 1),
	(62, '2022_04_30_122943_create_groups_table', 1);
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
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_created_by_foreign` (`user_created_by`),
  CONSTRAINT `users_user_created_by_foreign` FOREIGN KEY (`user_created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table iformat.users : ~0 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `gender`, `from`, `fonction`, `user_role_id`, `user_created_by`, `user_updated_by`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Super', 'admin@gmail.com', '66666666', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '$2y$10$zmHrqdDegQRc41t0INK5uOODuJk35q0kEt9kil5Kd57pw.vYHEBnS', 1, NULL, '2022-04-29 07:34:01', '2022-04-29 07:34:01'),
	(2, 'sortoto', 'Spon', 'spon1@gmail.com', '62547853', NULL, NULL, NULL, NULL, 2, 1, 1, NULL, '$2y$10$EX9rNTQRPzErVUL.Jz/MY.R0kUJKyjOmEoyMF2jDCo0l38o5Q88nq', -1, NULL, '2022-04-30 02:03:57', '2022-04-30 09:33:08'),
	(3, 'DANIEL', 'DANIEL', 'daniel@gmail.com', '62458768', NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, '$2y$10$tEqy./uNZ37bg80vlIy8qOh.xKn4J9JuR1psWOHwlUrJsxCud.5U6', 1, NULL, '2022-04-30 02:07:08', '2022-04-30 02:07:08'),
	(4, 'ASSIAVI', 'ASSIAVI', 'assiavi@gmail.com', '62351478', NULL, NULL, NULL, NULL, 3, 1, 1, NULL, '$2y$10$erSq1i98Gy9K73hARw6Tf.eF7M8bqKHTDtlwzIm9DbnfgUMrDKF1u', -1, NULL, '2022-04-30 09:36:21', '2022-04-30 19:15:09'),
	(5, 'DALMEIDA', 'DALMEIDA', 'dalmeida@gmail.com', NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, '$2y$10$LnMkNXc1woDI9Kn2ZaQf1ey1A4h83QN.HkgJ7QMMr6a9Gx3g2fM4G', 1, NULL, '2022-04-30 09:38:45', '2022-04-30 09:38:45'),
	(6, 'Benito', 'CLARO', 'claro.benito@gmail.com', '66666666', 'Cotonou-Cadjèhoun', NULL, 'MND', 'Développeur', 4, 1, 1, NULL, '$2y$10$8s/AkkEBW/kB197d8Y0GCusKacqRSebXBNmBHrpBTGXZ.GksoHRRG', -1, NULL, '2022-04-30 10:17:31', '2022-05-01 06:56:24'),
	(7, 'Habib', 'OROU', 'orou.habib@gmail.com', NULL, NULL, NULL, 'ASSI', 'DT', 4, 1, NULL, NULL, '$2y$10$EFp.fQt79farwqteeVs2r.hGtAsS6jfOW0k4/oNCYbLCfKT3OD62u', 1, NULL, '2022-04-30 10:18:21', '2022-04-30 18:38:25'),
	(8, 'Abdel', 'VIHO', 'viho@gmail.com', NULL, NULL, NULL, 'ASSI2', 'DT-Adjoint', 4, 1, 1, NULL, '$2y$10$3W6lkWGIhDoG74CNtTXuv.qZaywPtIGkgnuJjLwzNGPJuGrcVrj6C', -1, NULL, '2022-04-30 10:31:12', '2022-04-30 19:05:12'),
	(9, 'DOSSOU', 'DOSSOU', 'dossa@gmail.com', NULL, NULL, NULL, NULL, NULL, 2, 1, 1, NULL, '$2y$10$8FFusadGk3StyFwoqp3Ci.gP8EgE15WzTqCYjgI1rrnGzY3.agzZ2', -1, NULL, '2022-04-30 18:58:55', '2022-04-30 19:03:10'),
	(10, 'Bill', 'SOSSOU', 'bill@gmail.com', '62584789', NULL, NULL, 'MND', 'DGA', 2, 1, NULL, NULL, '$2y$10$J41yIdcJ.VHAJyeDAwqh1.tFop2eJ72S3kSMnnbeWNwHCNr1KVD2W', 1, NULL, '2022-04-30 19:01:25', '2022-04-30 19:02:06'),
	(11, 'Grâce', 'SOSSA', 'sossa@gmail.com', NULL, NULL, NULL, 'MJL', 'ANALYSTE PROGRAMMEUR', 4, 1, NULL, NULL, '$2y$10$JXHaHOgnl75OssKP0lrTqe2taA3duL1vkawtwCLeNYXUJsVdHRXTq', 1, NULL, '2022-04-30 19:04:03', '2022-04-30 19:04:52'),
	(12, 'Géorge', 'AGUEDEGAN', 'ague@gmail.com', '62354879', NULL, NULL, 'MJL', 'DT', 3, 1, NULL, NULL, '$2y$10$CLjhXLN28PWWLOhu/LOLLezjVmfX/hJWo3qkEX5E1kD9WHd.xo.bq', 1, NULL, '2022-04-30 19:06:13', '2022-04-30 19:06:40'),
	(13, 'Cyr', 'TOSSOU', 'cyr@gmail.com', '+22966757001', 'Rue 560, Cotonou, Bénin', NULL, NULL, NULL, 1, 1, NULL, NULL, '$2y$10$VMuE0MkRvGYoXGeXetApeehhpEzum39.fKryl1HmuSWnBJ5Pwrw1q', 1, NULL, '2022-04-30 19:07:53', '2022-04-30 19:08:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
