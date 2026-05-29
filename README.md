first
composer install
php artisan key:generate
php artisan serve

admin
admin123
db
/\*
Navicat Premium Data Transfer

Source Server : MySQL30
Source Server Type : MySQL
Source Server Version : 80039
Source Host : 127.0.0.1:3308
Source Schema : appointment

Target Server Type : MySQL
Target Server Version : 80039
File Encoding : 65001

Date: 15/05/2026 22:55:16
\*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

---

-- Table structure for appointments

---

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`patient_id` bigint UNSIGNED NOT NULL,
`doctor_id` bigint UNSIGNED NOT NULL,
`department_id` bigint UNSIGNED NOT NULL,
`appointment_date` datetime NOT NULL,
`status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`reason_for_visit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `appointments_patient_id_foreign`(`patient_id` ASC) USING BTREE,
INDEX `appointments_doctor_id_foreign`(`doctor_id` ASC) USING BTREE,
INDEX `appointments_department_id_foreign`(`department_id` ASC) USING BTREE,
CONSTRAINT `appointments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of appointments

---

INSERT INTO `appointments` VALUES (1, 1, 1, 1, '2026-01-05 00:00:00', 'pending', 'Sick', 'Sick', '2026-05-15 15:49:43', '2026-05-15 15:49:43');

---

-- Table structure for cache

---

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
`key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`expiration` int NOT NULL,
PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of cache

---

---

-- Table structure for cache_locks

---

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
`key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`expiration` int NOT NULL,
PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of cache_locks

---

---

-- Table structure for departments

---

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`head` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of departments

---

INSERT INTO `departments` VALUES (1, 'Cardiology', 'Heart and cardiovascular system', NULL, '2026-05-15 09:51:42', '2026-05-15 09:51:42');
INSERT INTO `departments` VALUES (2, 'Neurology', 'Brain and nervous system', NULL, '2026-05-15 09:51:42', '2026-05-15 09:51:42');
INSERT INTO `departments` VALUES (3, 'Orthopedics', 'Bones and muscles', NULL, '2026-05-15 09:51:42', '2026-05-15 09:51:42');
INSERT INTO `departments` VALUES (4, 'Pediatrics', 'Children health', NULL, '2026-05-15 09:51:42', '2026-05-15 09:51:42');
INSERT INTO `departments` VALUES (5, 'General Medicine', 'General health care', NULL, '2026-05-15 09:51:42', '2026-05-15 09:51:42');

---

-- Table structure for doctors

---

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` bigint UNSIGNED NOT NULL,
`department_id` bigint UNSIGNED NOT NULL,
`license_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`specialization` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`profile_photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
UNIQUE INDEX `doctors_license_number_unique`(`license_number` ASC) USING BTREE,
INDEX `doctors_user_id_foreign`(`user_id` ASC) USING BTREE,
INDEX `doctors_department_id_foreign`(`department_id` ASC) USING BTREE,
CONSTRAINT `doctors_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of doctors

---

INSERT INTO `doctors` VALUES (1, 3, 5, '00001', 'Teath', NULL, '0969645853', NULL, '2026-05-15 10:05:09', '2026-05-15 10:05:09');

---

-- Table structure for employees

---

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` bigint UNSIGNED NOT NULL,
`department_id` bigint UNSIGNED NULL DEFAULT NULL,
`employee_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`hire_date` date NULL DEFAULT NULL,
`salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`profile_photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
UNIQUE INDEX `employees_employee_id_unique`(`employee_id` ASC) USING BTREE,
INDEX `employees_user_id_foreign`(`user_id` ASC) USING BTREE,
INDEX `employees_department_id_foreign`(`department_id` ASC) USING BTREE,
CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of employees

---

---

-- Table structure for expenses

---

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`amount` decimal(10, 2) NOT NULL,
`expense_date` date NULL DEFAULT NULL,
`status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of expenses

---

---

-- Table structure for failed_jobs

---

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`) USING BTREE,
UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of failed_jobs

---

---

-- Table structure for invoices

---

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`patient_id` bigint UNSIGNED NULL DEFAULT NULL,
`invoice_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`invoice_date` date NULL DEFAULT NULL,
`total_amount` decimal(10, 2) NOT NULL,
`paid_amount` decimal(10, 2) NOT NULL DEFAULT 0.00,
`status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`due_date` date NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
UNIQUE INDEX `invoices_invoice_number_unique`(`invoice_number` ASC) USING BTREE,
INDEX `invoices_patient_id_foreign`(`patient_id` ASC) USING BTREE,
CONSTRAINT `invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of invoices

---

---

-- Table structure for job_batches

---

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
`id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`total_jobs` int NOT NULL,
`pending_jobs` int NOT NULL,
`failed_jobs` int NOT NULL,
`failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`cancelled_at` int NULL DEFAULT NULL,
`created_at` int NOT NULL,
`finished_at` int NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of job_batches

---

---

-- Table structure for jobs

---

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`attempts` tinyint UNSIGNED NOT NULL,
`reserved_at` int UNSIGNED NULL DEFAULT NULL,
`available_at` int UNSIGNED NOT NULL,
`created_at` int UNSIGNED NOT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of jobs

---

---

-- Table structure for messages

---

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`sender_id` bigint UNSIGNED NOT NULL,
`recipient_id` bigint UNSIGNED NOT NULL,
`message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`is_read` tinyint(1) NOT NULL DEFAULT 0,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `messages_sender_id_foreign`(`sender_id` ASC) USING BTREE,
INDEX `messages_recipient_id_foreign`(`recipient_id` ASC) USING BTREE,
CONSTRAINT `messages_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of messages

---

---

-- Table structure for migrations

---

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
`id` int UNSIGNED NOT NULL AUTO_INCREMENT,
`migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`batch` int NOT NULL,
PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of migrations

---

INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2026_05_15_092202_create_departments_table', 1);
INSERT INTO `migrations` VALUES (5, '2026_05_15_092843_create_doctors_table', 1);
INSERT INTO `migrations` VALUES (6, '2026_05_15_092844_create_employees_table', 1);
INSERT INTO `migrations` VALUES (7, '2026_05_15_092844_create_patients_table', 1);
INSERT INTO `migrations` VALUES (8, '2026_05_15_092900_create_appointments_table', 1);
INSERT INTO `migrations` VALUES (9, '2026_05_15_093015_create_schedules_table', 1);
INSERT INTO `migrations` VALUES (10, '2026_05_15_093016_create_expenses_table', 1);
INSERT INTO `migrations` VALUES (11, '2026_05_15_093017_create_invoices_table', 1);
INSERT INTO `migrations` VALUES (12, '2026_05_15_093017_create_messages_table', 1);
INSERT INTO `migrations` VALUES (13, '2026_05_15_093017_create_notifications_table', 1);
INSERT INTO `migrations` VALUES (14, '2026_05_15_093018_create_payments_table', 1);

---

-- Table structure for notifications

---

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` bigint UNSIGNED NOT NULL,
`title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`is_read` tinyint(1) NOT NULL DEFAULT 0,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `notifications_user_id_foreign`(`user_id` ASC) USING BTREE,
CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of notifications

---

---

-- Table structure for password_reset_tokens

---

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
`email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`created_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of password_reset_tokens

---

---

-- Table structure for patients

---

DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` bigint UNSIGNED NOT NULL,
`age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`blood_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`medical_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`emergency_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`profile_photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `patients_user_id_foreign`(`user_id` ASC) USING BTREE,
CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of patients

---

INSERT INTO `patients` VALUES (1, 2, '25', 'Sangkat Stung Mean Chey\r\nKhan Meanchey ,Phnom Penh', '0969645853', 'A+', NULL, NULL, NULL, '2026-05-15 10:03:06', '2026-05-15 10:03:06');

---

-- Table structure for payments

---

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`invoice_id` bigint UNSIGNED NULL DEFAULT NULL,
`payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`amount` decimal(10, 2) NOT NULL,
`payment_date` date NULL DEFAULT NULL,
`status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
`reference_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `payments_invoice_id_foreign`(`invoice_id` ASC) USING BTREE,
CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of payments

---

---

-- Table structure for roles

---

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
UNIQUE INDEX `roles_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of roles

---

INSERT INTO `roles` VALUES (1, 'admin', 'Administrator', '2026-05-15 09:51:41', '2026-05-15 09:51:41');
INSERT INTO `roles` VALUES (2, 'doctor', 'Doctor', '2026-05-15 09:51:41', '2026-05-15 09:51:41');
INSERT INTO `roles` VALUES (3, 'patient', 'Patient', '2026-05-15 09:51:41', '2026-05-15 09:51:41');
INSERT INTO `roles` VALUES (4, 'employee', 'Employee', '2026-05-15 09:51:41', '2026-05-15 09:51:41');

---

-- Table structure for schedules

---

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`doctor_id` bigint UNSIGNED NOT NULL,
`day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`start_time` time NULL DEFAULT NULL,
`end_time` time NULL DEFAULT NULL,
`status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `schedules_doctor_id_foreign`(`doctor_id` ASC) USING BTREE,
CONSTRAINT `schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of schedules

---

---

-- Table structure for sessions

---

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
`id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`user_id` bigint UNSIGNED NULL DEFAULT NULL,
`ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
`payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`last_activity` int NOT NULL,
PRIMARY KEY (`id`) USING BTREE,
INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of sessions

---

INSERT INTO `sessions` VALUES ('7wYcX1QE2GpRXAfTZzAvJmmk01TC7JvUfGLR1GqY', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTU5tanlqMlo5WW5HS2lBc3ZwRnFGVHJGaU5JeFJTQnExUENITTJ4SSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1778860253);
INSERT INTO `sessions` VALUES ('Wq56fdvAeatDH2jLvqymxU8RmTAb7t8GRuBEmAeL', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQzF4WlVsWjF4QnFMMXY2VnhKbURDc1RJcHo0WnR5UkhyUmtzWEhCQSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1778839552);

---

-- Table structure for users

---

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
`name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`email_verified_at` timestamp NULL DEFAULT NULL,
`password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
`role_id` bigint UNSIGNED NULL DEFAULT NULL,
`remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`) USING BTREE,
UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE,
UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
INDEX `users_role_id_foreign`(`role_id` ASC) USING BTREE,
CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

---

-- Records of users

---

INSERT INTO `users` VALUES (1, 'Sira', 'admin', 'admin@su30.com', NULL, '$2y$12$Ttiz.36kgDeFtAzid/.Hxesl8npxZ9O6SHWFE4IHB823XIKM7hqUi', 1, NULL, '2026-05-15 09:51:42', '2026-05-15 09:51:42');

SET FOREIGN_KEY_CHECKS = 1;
