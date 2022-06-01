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
	(1, 'Salles A1', 1, -1, NULL, 1, 1, '2022-04-29 07:43:55', '2022-04-29 23:05:05'),
	(2, 'Salles A2', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:22', '2022-04-30 02:01:22'),
	(3, 'Salles A3', 1, 1, NULL, 1, NULL, '2022-04-30 02:01:30', '2022-04-30 02:01:30'),
	(4, 'Salles A4', 2, 1, NULL, 1, NULL, '2022-04-30 02:01:42', '2022-04-30 02:01:42'),
	(5, 'Salles A5', 3, 1, NULL, 1, NULL, '2022-04-30 02:01:53', '2022-04-30 02:01:53'),
	(6, 'Salles A6', 3, 1, NULL, 1, NULL, '2022-04-30 02:02:03', '2022-04-30 02:02:03');
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;

-- Listage des données de la table iformat.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage des données de la table iformat.groups : ~6 rows (environ)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT IGNORE INTO `groups` (`groups_id`, `groups_name`, `groups_participant`, `groups_status`, `groups_detail`, `groups_user_created_by`, `groups_user_updated_by`, `groups_created_at`, `groups_updated_at`) VALUES
	(1, 'G1', '["6"]', 1, NULL, 1, NULL, '2022-05-11 07:15:04', '2022-05-11 07:15:04'),
	(2, 'G2', '["7"]', 1, NULL, 1, NULL, '2022-05-11 07:15:20', '2022-05-11 07:15:20'),
	(3, 'G3', '["9", "10"]', 1, NULL, 1, NULL, '2022-05-16 18:53:29', '2022-05-16 18:53:29'),
	(4, 'G4', '["11"]', 1, NULL, 1, NULL, '2022-05-16 18:54:00', '2022-05-16 18:54:00'),
	(5, 'G5', '["12"]', 1, NULL, 1, NULL, '2022-05-16 18:54:12', '2022-05-16 18:54:12'),
	(6, 'G6', '["14"]', 1, NULL, 1, NULL, '2022-05-16 18:54:35', '2022-05-16 18:54:35');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Listage des données de la table iformat.learnings : ~0 rows (environ)
/*!40000 ALTER TABLE `learnings` DISABLE KEYS */;
INSERT IGNORE INTO `learnings` (`learnings_id`, `learnings_code`, `learnings_title`, `learnings_title2`, `learnings_goal`, `learnings_target`, `learnings_duration`, `learnings_infos`, `learnings_author_id`, `learnings_days`, `learnings_time_slot`, `learnings_status`, `learnings_user_created_by`, `learnings_user_updated_by`, `learnings_created_at`, `learnings_updated_at`) VALUES
	(1, 'FORM', 'EXCEL PERFECTIONNEMENT', 'Les fonctionnalités incontournables pour être efficace', 'Test', 'Test', '30', 'Tester', 1, '["1", "2", "3", "4", "5"]', '["08:00 - 12:00", "15:00 - 19:26"]', 1, 1, 1, '2022-05-11 05:47:09', '2022-05-15 12:26:30'),
	(2, 'FORM2', 'EXCEL PERFECTIONNEMENT', 'Les fonctionnalités incontournables pour être efficace', NULL, NULL, '15', NULL, NULL, '["2", "4"]', '["06:33 - 06:34"]', -2, 1, 1, '2022-05-13 04:37:11', '2022-05-13 05:11:26');
/*!40000 ALTER TABLE `learnings` ENABLE KEYS */;



-- Listage des données de la table iformat.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage des données de la table iformat.personal_access_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage des données de la table iformat.plannings : ~4 rows (environ)
/*!40000 ALTER TABLE `plannings` DISABLE KEYS */;
INSERT IGNORE INTO `plannings` (`plannings_id`, `plannings_code`, `plannings_infos`, `plannings_teachers`, `plannings_teachers_roles`, `plannings_user_groups`, `plannings_date`, `plannings_status`, `plannings_time_slot`, `plannings_user_created_by`, `plannings_classroom_id`, `plannings_learning_id`, `plannings_user_updated_by`, `plannings_created_at`, `plannings_updated_at`) VALUES
	(1, 'PLAN1', 'soso', '["5"]', NULL, '["1"]', '["2022-05-16", "2022-05-23"]', -1, '["08:00 - 12:00","08:00 - 12:00"]', 4, 5, 1, 1, '2022-05-13 07:12:32', '2022-05-16 19:16:15'),
	(2, 'PLAN2', 'SOSO', '["4", "5"]', NULL, '["2", "1"]', '["2022-05-16", "2022-05-27"]', 1, '["08:00 - 12:00","08:00 - 12:00"]', 6, 4, 1, 1, '2022-05-15 15:32:53', '2022-05-15 22:25:06');

-- Listage des données de la table iformat.roles : ~0 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage des données de la table iformat.users : ~17 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `gender`, `from`, `fonction`, `user_role_id`, `user_created_by`, `user_updated_by`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
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
