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

-- Listage des données de la table iformat.classrooms : ~6 rows (environ)
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
INSERT IGNORE INTO `classrooms` (`classrooms_id`, `classrooms_name`, `classrooms_countries_id`, `classrooms_status`, `classrooms_detail`, `classrooms_user_created_by`, `classrooms_user_updated_by`, `classrooms_created_at`, `classrooms_updated_at`) VALUES
	(1, 'Salles A25', 1, -1, NULL, 1, 1, '2022-04-29 07:43:55', '2022-04-29 23:05:05'),
	(2, 'Salles A25', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:22', '2022-04-30 02:01:22'),
	(3, 'Salles A4', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:30', '2022-04-30 02:01:30'),
	(4, 'Salles A2510', 2, 1, NULL, 1, NULL, '2022-04-30 02:01:42', '2022-04-30 02:01:42'),
	(5, 'Salles A4', 3, 1, NULL, 1, NULL, '2022-04-30 02:01:53', '2022-04-30 02:01:53'),
	(6, 'Salles A4', 3, 1, NULL, 1, NULL, '2022-04-30 02:02:03', '2022-04-30 02:02:03');
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;

-- Listage des données de la table iformat.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage des données de la table iformat.learnings : ~0 rows (environ)
/*!40000 ALTER TABLE `learnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `learnings` ENABLE KEYS */;

-- Listage des données de la table iformat.migrations : ~7 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(48, '2014_04_24_201258_create_roles_table', 1),
	(49, '2014_10_12_000000_create_users_table', 1),
	(50, '2014_10_12_100000_create_password_resets_table', 1),
	(51, '2019_08_19_000000_create_failed_jobs_table', 1),
	(52, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(53, '2022_04_28_223303_create_classrooms_table', 1),
	(54, '2022_04_28_224315_create_learnings_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage des données de la table iformat.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage des données de la table iformat.personal_access_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage des données de la table iformat.roles : ~0 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage des données de la table iformat.users : ~8 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `gender`, `from`, `fonction`, `user_role_id`, `user_created_by`, `user_updated_by`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Super', 'admin@gmail.com', '66666666', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '$2y$10$zmHrqdDegQRc41t0INK5uOODuJk35q0kEt9kil5Kd57pw.vYHEBnS', 1, NULL, '2022-04-29 07:34:01', '2022-04-29 07:34:01'),
	(2, 'sortoto', 'Spon', 'spon1@gmail.com', '62547853', NULL, NULL, NULL, NULL, 2, 1, 1, NULL, '$2y$10$EX9rNTQRPzErVUL.Jz/MY.R0kUJKyjOmEoyMF2jDCo0l38o5Q88nq', -1, NULL, '2022-04-30 02:03:57', '2022-04-30 09:33:08'),
	(3, 'DANIEL', 'DANIEL', 'daniel@gmail.com', '62458768', NULL, NULL, NULL, NULL, 2, 1, NULL, NULL, '$2y$10$tEqy./uNZ37bg80vlIy8qOh.xKn4J9JuR1psWOHwlUrJsxCud.5U6', 1, NULL, '2022-04-30 02:07:08', '2022-04-30 02:07:08'),
	(4, 'ASSIAVI', 'ASSIAVI', 'assiavi@gmail.com', '62351478', NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, '$2y$10$erSq1i98Gy9K73hARw6Tf.eF7M8bqKHTDtlwzIm9DbnfgUMrDKF1u', 1, NULL, '2022-04-30 09:36:21', '2022-04-30 09:36:21'),
	(5, 'DALMEIDA', 'DALMEIDA', 'dalmeida@gmail.com', NULL, NULL, NULL, NULL, NULL, 3, 1, NULL, NULL, '$2y$10$LnMkNXc1woDI9Kn2ZaQf1ey1A4h83QN.HkgJ7QMMr6a9Gx3g2fM4G', 1, NULL, '2022-04-30 09:38:45', '2022-04-30 09:38:45'),
	(6, 'Benito', 'CLARO', 'claro.benito@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$8s/AkkEBW/kB197d8Y0GCusKacqRSebXBNmBHrpBTGXZ.GksoHRRG', 1, NULL, '2022-04-30 10:17:31', '2022-04-30 10:17:31'),
	(7, 'Habib', 'OROU', 'orou.habib@gmail.com', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, NULL, '$2y$10$EFp.fQt79farwqteeVs2r.hGtAsS6jfOW0k4/oNCYbLCfKT3OD62u', 1, NULL, '2022-04-30 10:18:21', '2022-04-30 10:18:21'),
	(8, 'Abdel', 'VIHO', 'viho@gmail.com', NULL, NULL, NULL, 'ASSI2', 'DT-Adjoint', 4, 1, NULL, NULL, '$2y$10$3W6lkWGIhDoG74CNtTXuv.qZaywPtIGkgnuJjLwzNGPJuGrcVrj6C', 1, NULL, '2022-04-30 10:31:12', '2022-04-30 10:42:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
