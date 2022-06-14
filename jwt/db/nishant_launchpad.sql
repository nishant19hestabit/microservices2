-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(16,	'default',	'{\"uuid\":\"19ae964f-8404-4ebb-bd1e-5d85da6e2cc6\",\"displayName\":\"App\\\\Notifications\\\\AssignTeacherNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":16:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:17;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:12:\\\"notification\\\";O:43:\\\"App\\\\Notifications\\\\AssignTeacherNotification\\\":12:{s:15:\\\"student_details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:19;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:2:\\\"id\\\";s:36:\\\"3ae2347f-4994-4c14-8322-9b02bbda8ddc\\\";s:6:\\\"locale\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}',	0,	NULL,	1654775320,	1654775320),
(17,	'default',	'{\"uuid\":\"7444710f-4fbc-4b4c-a74d-5c32b4de706c\",\"displayName\":\"App\\\\Mail\\\\UserApproveMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserApproveMail\\\":29:{s:7:\\\"details\\\";a:3:{s:5:\\\"title\\\";s:8:\\\"Approved\\\";s:4:\\\"name\\\";s:11:\\\"Rahul Sagar\\\";s:7:\\\"message\\\";s:30:\\\"Your account has been approved\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"rahul@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}',	0,	NULL,	1654781890,	1654781890),
(18,	'default',	'{\"uuid\":\"c8a7dd6a-7163-44a2-9f2d-d57a4d573c03\",\"displayName\":\"App\\\\Mail\\\\UserApproveMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\UserApproveMail\\\":29:{s:7:\\\"details\\\";a:3:{s:5:\\\"title\\\";s:8:\\\"Approved\\\";s:4:\\\"name\\\";s:11:\\\"Rahul Sagar\\\";s:7:\\\"message\\\";s:30:\\\"Your account has been approved\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"rahul@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}',	0,	NULL,	1654782797,	1654782797);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2022_06_07_053251_create_roles_table',	1),
(6,	'2022_06_07_053708_create_roles_table',	2),
(7,	'2022_06_07_055332_create_users_table',	3),
(8,	'2022_06_07_060758_create_users_table',	4),
(9,	'2022_06_09_063455_create_jobs_table',	5),
(10,	'2022_06_09_131241_add_is_active_to_users_table',	6),
(11,	'2022_06_09_131709_remove_is_active_to_users_table',	7),
(12,	'2022_06_09_133130_remove_timestamps_from_users_table',	8),
(13,	'2022_06_09_133358_add_timestamps_to_users_table',	9),
(14,	'2022_06_09_134512_remove_timestamp_from_users_table',	10),
(15,	'2022_06_09_134716_add_timestamp_to_users_table',	11);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
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


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'2022-06-07 05:40:39',	'2022-06-07 05:40:39'),
(2,	'student',	'2022-06-07 05:41:35',	'2022-06-07 05:41:35'),
(3,	'teacher',	'2022-06-07 05:41:55',	'2022-06-07 05:41:55');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL,
  `teacher_assigned` int DEFAULT NULL,
  `experience` int DEFAULT NULL,
  `expertise_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `address`, `password`, `profile_picture`, `current_school`, `previous_school`, `role_id`, `teacher_assigned`, `experience`, `expertise_subject`, `father_name`, `mother_name`, `is_approved`, `created_at`, `updated_at`) VALUES
(4,	'Rahul Sagar',	'rahul@gmail.com',	'wz-234, Local Address, India',	'$2y$10$.SIcQnldScEmU92CsopWJ.gcFV80RQtaJ5NxfQON5p7N4C.mR46hy',	'http://127.0.0.1:8000/uploads/students/1654587534957.jpeg',	'DEF Public School',	'QSR Public School',	2,	15,	NULL,	NULL,	NULL,	NULL,	1,	'2022-06-09 13:51:08',	'2022-06-09 13:53:17'),
(7,	'admin',	'admin@admin.com',	NULL,	'$2y$10$QfFAqab6Z6I0Y9LGz.GbU.wKKAuoc7XtnI.5LRlJef0uJdRZN64Nu',	NULL,	NULL,	NULL,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'2022-06-09 13:51:08',	'2022-06-09 13:51:08'),
(8,	'Rachna',	'rachna@gmail.com',	'wz-234, Local Address, India',	'$2y$10$E.f3NRajBANhrjoQXAi83uPGqR5D502rXNpcfatwpHHjjEb4pq6LK',	'http://127.0.0.1:8000/uploads/students/1654672947632.png',	'DEF Public School',	'QSR Public School',	2,	15,	NULL,	NULL,	'Rohan',	'Sonali',	1,	'2022-06-09 13:51:08',	'2022-06-09 13:51:08'),
(9,	'Rachna NEw',	'rachnanew@gmail.com',	'wz-234, Local Address, India',	'$2y$10$14jW8pA80USOjzXIGMIEeeU434ynmGwjMZeTU3W65Ah0X1eqduF.e',	'http://127.0.0.1:8000/uploads/students/1654609906904.jpeg',	'DEF Public School',	'QSR Public School',	2,	NULL,	NULL,	NULL,	'Ramesh',	'shikha',	0,	'2022-06-09 13:51:08',	'2022-06-09 13:51:08'),
(10,	'Saumya',	'saumya@gmail.com',	'wz-234, Local Address, India',	'$2y$10$86tJAIsJ.NYBT8nWJtOo8uVYL0jlJ2gOjm1AzM62UnUSiRxovHOrO',	'http://127.0.0.1:8000/uploads/students/1654610241236.jpeg',	'DEF Public School',	'QSR Public School',	2,	NULL,	NULL,	NULL,	'Ramesh',	'shikha',	0,	'2022-06-09 13:51:08',	'2022-06-09 13:51:08'),
(12,	'Ritu Chawla',	'r.chawla@gmail.com',	'Wz-467, Rani Bagh, Delhi, India',	'$2y$10$XXnLNQequwxIxC4pNuJ1desQftYqGzCzjR3DBRvTYsj4W0B9aUk9u',	'http://127.0.0.1:8000/uploads/teachers/1654669148515.jpeg',	'Govt. Coed Sr. Sec. School',	'Pratibha Vikas School',	3,	NULL,	5,	'English',	NULL,	NULL,	0,	'2022-06-09 13:51:08',	'2022-06-09 14:05:47'),
(13,	'Rachna',	'rachnaa@gmail.com',	'wz-234, Local Address, India',	'$2y$10$EZyFaWbLBBNPivbZn3pqTumENyIidLrwBevoX6o9YIINiPM7BT2bi',	'http://127.0.0.1:8000/uploads/teachers/1654673583102.jpeg',	'DEF Public School',	'QSR Public School',	3,	NULL,	7,	'History',	NULL,	NULL,	0,	'2022-06-09 13:51:08',	'2022-06-09 14:05:49'),
(15,	'Nishant Kumar',	'nishant19.hestabit@gmail.com',	'Wz-467, Rani Bagh, Delhi, India',	'$2y$10$8y4hiH1.8VZUO/Tp.ebHqO2YbH9nS.QPZHHSXJmAdgsm9dH9igHUC',	'http://127.0.0.1:8000/uploads/teachers/1654754204517.png',	'Govt. Coed Sr. Sec. School',	'Pratibha Vikas School',	3,	NULL,	5,	'English',	NULL,	NULL,	1,	'2022-06-09 13:51:08',	'2022-06-09 14:06:46'),
(17,	'Nishant Kumar',	'nishant.kumar@hestabit.in',	'Wz-467, Rani Bagh, Delhi, India',	'$2y$10$R7WzsiU3dVYB.J9mC3f.TOnIFaJPPMbFndxLLXpNd7ehz6JitmuM.',	'http://127.0.0.1:8000/uploads/teachers/165477101619.png',	'Govt. Coed Sr. Sec. School',	'Pratibha Vikas School',	3,	NULL,	5,	'English',	NULL,	NULL,	0,	'2022-06-09 13:51:08',	'2022-06-09 14:05:53'),
(19,	'Saumya Thakur',	'saumyathakur@gmail.com',	'wz-234, Local Address, India',	'$2y$10$OyI19HfyEE3ZDyT1hxao4.WZF/xpiAiDigI/JrnenQqg/unjGTiAi',	'http://127.0.0.1:8000/uploads/students/1654771322625.jpeg',	'DEF Public School',	'QSR Public School',	2,	17,	NULL,	NULL,	'Ramesh',	'shikha',	1,	'2022-06-09 13:51:08',	'2022-06-09 13:51:08'),
(20,	'Ajay Thakur',	'ajaythakur@gmail.com',	'wz-234, Local Address, India',	'$2y$10$eQiPkzkBeytekRDVH5miautUzKvOnCHdRdDdX/IEjQtPrqrgN/qle',	'http://127.0.0.1:8000/uploads/students/16547820435.jpeg',	'DEF Public School',	'QSR Public School',	2,	NULL,	NULL,	NULL,	'Ramesh',	'shikha',	0,	'2022-06-09 13:51:08',	'2022-06-09 13:51:08');

-- 2022-06-09 14:16:15
