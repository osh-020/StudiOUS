-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 07:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk_ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `user_id`, `title`, `message`, `image`, `created_at`, `updated_at`) VALUES
(5, 2, 'Enrollment for 2nd Semester A.Y. 2025 - 2026 is Ongoing!', 'All new and continuing students are encouraged to complete their enrollment within the given period to avoid delays in academic processing. Please submit all requirements on time.', 'announcement_images/60nAlUFalrMc3NYXs9BdyhANstBJkfdZY0YQAZPD.png', '2026-05-17 20:05:16', '2026-05-18 06:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'What is StudiOUS?', 'StudiOUS is a Digital Student Service Management System designed for PSU-OUS to help students access administrative and support services online through a centralized portal.', '2026-05-09 02:38:57', '2026-05-09 02:38:57'),
(2, 'How do I submit a service request?', 'Log in to your account, go to the Helpdesk page, open the ticket form, choose a category, describe your issue, and submit the ticket.', '2026-05-09 02:38:57', '2026-05-09 02:38:57'),
(3, 'How do I track my request?', 'Go to My Tickets or My Requests to see the status of your tickets and document requests. You can also view ticket details for updates and replies.', '2026-05-09 02:38:57', '2026-05-09 02:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `sender_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'Hello, I need help with login.', '2026-04-20 19:43:54', '2026-04-20 19:43:54'),
(2, 3, 2, 'okay ill be back', '2026-04-20 19:46:10', '2026-04-20 19:46:10'),
(3, 3, 1, 'okay po', '2026-04-20 19:50:01', '2026-04-20 19:50:01'),
(4, 3, 2, 'wait lang ha', '2026-04-20 19:53:16', '2026-04-20 19:53:16'),
(5, 3, 2, 'wait beh', '2026-04-20 20:58:07', '2026-04-20 20:58:07'),
(6, 2, 3, 'Hi! Help is on the way! YEY!', '2026-04-20 21:03:22', '2026-04-20 21:03:22'),
(7, 2, 2, 'Hi! Help is on the way! YEY!', '2026-04-20 21:06:51', '2026-04-20 21:06:51'),
(8, 5, 2, 'sige, wait lang po', '2026-05-06 19:27:35', '2026-05-06 19:27:35'),
(9, 5, 1, 'okay po', '2026-05-06 19:27:47', '2026-05-06 19:27:47'),
(10, 5, 1, 'halu, ano na update po?', '2026-05-09 03:34:00', '2026-05-09 03:34:00'),
(11, 4, 2, 'wait lang', '2026-05-09 04:17:16', '2026-05-09 04:17:16'),
(12, 2, 2, 'ok', '2026-05-09 04:17:39', '2026-05-09 04:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_21_032622_create_tickets_table', 1),
(5, '2026_04_21_032633_create_messages_table', 1),
(6, '2026_04_21_032657_add_role_to_users_table', 1),
(7, '2026_05_08_075219_add_document_request_fields_to_tickets_table', 2),
(8, '2026_05_09_075746_add_document_request_category_to_tickets_table', 3),
(9, '2026_05_09_083051_create_announcements_table', 4),
(10, '2026_05_09_083948_add_image_to_announcements_table', 5),
(11, '2026_05_09_090512_create_document_requests_table', 6),
(12, '2026_05_09_103304_create_faqs_table', 7),
(13, '2026_05_09_105255_add_additional_notes_and_scanned_copy_to_requests_table', 8),
(14, '2026_05_09_111126_update_document_request_statuses_enum', 9),
(15, '2026_05_09_112402_add_rejection_reason_to_requests_table', 10),
(16, '2026_05_09_120444_add_closed_status_to_tickets_table', 11),
(17, '2026_05_09_121254_remove_pending_status_from_tickets_table', 12),
(18, '2026_05_10_000000_add_guest_ticket_support_to_tickets_table', 13),
(19, '2026_05_18_000000_add_address_to_users_table', 14),
(20, '2026_05_18_000001_add_address_components_to_users_table', 14),
(21, '2026_05_19_000000_add_profile_photo_path_to_users_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `additional_notes` text DEFAULT NULL,
  `delivery_method` varchar(255) NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `scanned_copy` varchar(255) DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `priority` enum('Low','Medium','High') NOT NULL DEFAULT 'Medium',
  `status` enum('Pending','Processing','Ready for Release','Completed','Rejected','Cancelled','Cancellation Requested') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `subject`, `purpose`, `additional_notes`, `delivery_method`, `payment_proof`, `scanned_copy`, `rejection_reason`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Transcript of Records (TOR)', 'Employment', NULL, 'delivery', 'payment_proofs/DpbI5gSPQBQTE83mllCAwxdLpRXffiKn9HrY2pA4.png', 'scanned_copies/kxyGxMPBOHnJtgicHZ6Yzm8yvADSkV3N4MRdyrxE.png', 'kulang requirements mo neng, complete mo muna. salamat po.', 'Medium', 'Rejected', '2026-05-09 00:50:05', '2026-05-09 03:32:25'),
(2, 1, 'Certificate of Enrollment', 'Employment', 'penge scanned copy, salamat po', 'delivery', 'payment_proofs/MqlRz9sBEePRwOwNGHtop50z2uACO27l1TobvwZR.png', NULL, NULL, 'Medium', 'Cancelled', '2026-05-09 03:39:23', '2026-05-09 03:39:38'),
(3, 1, 'Transcript of Records (TOR)', 'Employment', 'penge scanned copy, salamat po', 'delivery', 'payment_proofs/D2q9dy27WzzaqVhwQIk96q4ZuZWDlXkQHhBcTrm7.png', NULL, NULL, 'Medium', 'Cancelled', '2026-05-09 03:40:26', '2026-05-09 03:46:33'),
(4, 1, 'Certificate of Grades', 'Enrolment', 'need a scanned copy', 'delivery', 'payment_proofs/rgiFHSwnyHNknz0neNHp9ZxDkGSqS72rZojVZDGm.png', 'scanned_copies/V1mHjPsPqqXbxMQquBGAsxBA4Pywq7SeePSkIUaP.png', NULL, 'Medium', 'Completed', '2026-05-09 03:51:24', '2026-05-09 19:15:34'),
(5, 1, 'Certificate of Enrollment', 'Scholarship', NULL, 'delivery', 'payment_proofs/eQXaPf9sTIXWYXgydvaxSCV4PlRuv6mb5fUCazjp.png', NULL, NULL, 'Medium', 'Pending', '2026-05-09 04:01:52', '2026-05-09 04:01:52'),
(6, 1, 'Transcript of Records (TOR)', 'Employment', 'scanned copy po pls thanks', 'delivery', 'payment_proofs/R73xpIfk7KxJFv090BIeanGDF8wLEGqnXp2cTDV7.png', 'scanned_copies/FAGNRXrMPDCJEG67RLH1ODlHtK18WPipT4LloP0M.png', NULL, 'Medium', 'Ready for Release', '2026-05-10 21:34:51', '2026-05-10 21:38:49'),
(7, 1, 'Transcript of Records (TOR)', 'Employment', 'gusto ko ng scanned copy and burger with fries at syempre di mawawala ang milktea', 'delivery', 'payment_proofs/bORWfCIeBDLgfHEqRGuOlksaAtjrudJeOGOoaRbx.png', NULL, 'KULANG REQUIREMENTS', 'Medium', 'Rejected', '2026-05-10 22:54:57', '2026-05-10 23:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5gVqWgYLek21NKnIrcb1aor30ibZhPHIivhcZYBN', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJoOGVOTnVPNVpYanpIZTNBa2JUd1NQWUZiN2loVTdIWEhXWFJpRjRzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvdGlja2V0cz9wcmlvcml0eT1Mb3cmc3RhdHVzPU9wZW4iLCJyb3V0ZSI6ImFkbWluLnRpY2tldHMifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=', 1776749715),
('6KMS7lIcrA4om8zbGvurNlf1LeGqv0sPhXWhnO39', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJaZzYxU3NYTTZvVGt6MDVjb3k4V2xFRkx4N0pUd2ZIRHpRZ1pySkNPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1778233998),
('EYR0aNpcWzSFT1DTDR6oy8NgpDFF2JDrNUnO1NsQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.119.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'eyJfdG9rZW4iOiJxaVB0blBhMjBhV0ViU08xR0VOclZOT21SZ0ppTEhvTk1NYW53eFFjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1778233952),
('IY4ge0fOmlLjsr62ZYijEVAKNUiO1z008OSLsUxD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.119.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'eyJfdG9rZW4iOiJqTlY2WnBJSHNzeVB2d084bVFHNFRaTTNFOGlRUmNrRm54SWFYTHRYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1778381525),
('TitLCc6T3CUINxyehTaLHqi0KkzVVpDLBZrtoDWC', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJFdHlqbGFLc3R4WFZ0N3dzTG1wZlFpQkNvUkhkVGpkWFQ1WWJGU3FsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC91c2VyXC90aWNrZXRzXC80Iiwicm91dGUiOiJ1c2VyLnRpY2tldHMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo0fQ==', 1776753069);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `category` enum('Login Issue','Payment','Document','Others') NOT NULL,
  `priority` enum('Low','Medium','High') NOT NULL DEFAULT 'Low',
  `status` enum('Open','In Progress','Resolved','Closed') NOT NULL DEFAULT 'Open',
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `email`, `subject`, `category`, `priority`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'login issue with student portal', 'Login Issue', 'Medium', 'Open', 'i cant login my student account', '2026-04-20 19:42:17', '2026-04-20 19:42:17'),
(2, 3, NULL, 'Sample Ticket', 'Login Issue', 'Medium', 'In Progress', 'This is a sample ticket description.', '2026-04-20 19:43:54', '2026-05-09 04:17:39'),
(3, 1, NULL, 'wrong spelling', 'Document', 'Low', 'In Progress', 'mali po yung spelling ng name ko sa document na nirequest ko kahapon', '2026-04-20 19:45:15', '2026-04-20 19:56:57'),
(4, 4, NULL, 'id replacement', 'Others', 'Medium', 'In Progress', 'i need new id, i lost my old one', '2026-04-20 22:31:04', '2026-05-09 04:17:16'),
(5, 1, NULL, 'payment error', 'Payment', 'High', 'Open', 'di po maaccept yung payment ko', '2026-05-06 19:26:52', '2026-05-09 04:08:48'),
(7, 1, NULL, 'id replacement', 'Others', 'Medium', 'Open', 'okay po', '2026-05-09 20:25:26', '2026-05-09 20:25:26'),
(8, NULL, 'armansalon@gmail.com', 'id replacement', 'Others', 'Medium', 'Open', 'okkk', '2026-05-09 20:26:12', '2026-05-09 20:26:12'),
(9, 6, NULL, 'math', 'Login Issue', 'High', 'Open', 'cant login', '2026-05-11 00:25:58', '2026-05-11 00:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `house_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `profile_photo_path`, `country`, `region`, `province`, `city`, `barangay`, `postal_code`, `street_name`, `building`, `house_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'verde', 'verde@gmail.com', '222 Angel Heart Street, Tonton, Lingayen, Pangasinan, Region I, Philippines, 2401', NULL, 'Philippines', 'Region I', 'Pangasinan', 'Lingayen', 'Tonton', '2401', NULL, NULL, NULL, NULL, '$2y$12$70p.oi4Zfy7PvLCWbj6xEOTWG4Mkg3VgYNeNFSvzmd9ge87rn2eOC', NULL, '2026-04-20 19:40:55', '2026-05-18 08:14:31', 'user'),
(2, 'Admin User', 'admin@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$Ogk6BkEb1ADq3G3cRlse3OysYQ6qQzmbgmbaX26MNjYDcZk3FPOua', NULL, '2026-04-20 19:43:54', '2026-05-06 19:24:23', 'admin'),
(3, 'Sample User', 'user@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$2HzCY6WvQTrz8odLrmQqcenYQk3d1jzRejK8E.MaDPR6M0kLV034i', NULL, '2026-04-20 19:43:54', '2026-04-20 19:43:54', 'user'),
(4, 'new', 'newe@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$DVuNAxBn5dxLSVLB9vniiems9pFWNqus.qzzW4/h6cWFxQouHX/kS', NULL, '2026-04-20 22:30:32', '2026-04-20 22:30:32', 'user'),
(5, 'Arman Salon', 'armansalon1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$eOFHTgPKl.dOvpMPIUUheusUvzL.yX1csTJg3NumgKxuhmjAByre6', NULL, '2026-05-09 21:26:57', '2026-05-09 21:26:57', 'user'),
(6, 'joshua', 'josh@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$6CtvY7oPsZY68eHuqZ2E8eDoh2GTjtg8puz/5CQf9.klLZi/T2n6K', NULL, '2026-05-11 00:23:52', '2026-05-11 00:23:52', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ticket_id_foreign` (`ticket_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
