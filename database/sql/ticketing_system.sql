-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 07:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `drugstore_name` varchar(255) NOT NULL,
  `complaint_type` varchar(255) NOT NULL,
  `incident_date` date NOT NULL,
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'low',
  `description` text NOT NULL,
  `status` enum('New','In Progress','Resolved','Closed') NOT NULL DEFAULT 'New',
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `created_at`, `updated_at`, `drugstore_name`, `complaint_type`, `incident_date`, `priority`, `description`, `status`, `user_id`) VALUES
(1, '2025-03-12 19:03:18', '2025-03-12 19:03:18', 'mercury', 'service_issue', '2025-03-13', 'low', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t exist', 'New', 7),
(2, '2025-03-12 19:04:34', '2025-03-12 19:04:34', 'mercury', 'service_issue', '2025-03-13', 'low', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t exist', 'New', 7),
(3, '2025-03-12 19:06:14', '2025-03-12 19:06:14', 'mercury', 'service_issue', '2025-03-13', 'low', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t existSQLSTATE[42S02]: Base table or view not found: 1146 Table \'ticketing_system.complaints\' doesn\'t exist', 'New', 7),
(4, '2025-03-12 21:13:25', '2025-03-12 21:13:25', 'mercury', 'medication_quality', '2025-03-13', 'high', 'asdasfasfasfasfasfasfasfasfassafasfasfasfasfasf', 'New', 7),
(5, '2025-03-12 21:13:47', '2025-03-12 21:13:47', 'mercury', 'medication_quality', '2025-03-13', 'high', 'asdasfasfasfasfasfasfasfasfassafasfasfasfasfasf', 'New', 7),
(6, '2025-03-12 21:14:23', '2025-03-12 21:14:23', 'mercury', 'medication_quality', '2025-03-13', 'high', 'asfasfasfasasfasfasfasfasfasfasfasfasfasfasfasfasfasfasfas', 'New', 7),
(7, '2025-03-12 21:29:31', '2025-03-12 21:29:31', 'mercury', 'medication_quality', '2025-03-13', 'low', '<?php\r\n\r\nnamespace App\\Http\\Controllers;\r\n\r\nuse Illuminate\\Http\\Request;\r\nuse App\\Models\\Complaint;\r\nuse Illuminate\\Support\\Facades\\Auth;\r\n\r\nclass CustomerController extends Controller\r\n{\r\n    public function dashboard()\r\n    {\r\n        $userId = Auth::id();\r\n\r\n        // Total complaints by the customer\r\n        $totalComplaints = Complaint::where(\'user_id\', $userId)->count();\r\n\r\n        // Active complaints (status \'New\' or \'In Progress\')\r\n        $activeComplaints = Complaint::where(\'user_id\', $userId)\r\n            ->whereIn(\'status\', [\'New\', \'In Progress\'])\r\n            ->count();\r\n\r\n        // Resolved complaints\r\n        $resolvedComplaints = Complaint::where(\'user_id\', $userId)\r\n            ->where(\'status\', \'Resolved\')\r\n            ->count();\r\n\r\n        // Recent complaints (latest 5)\r\n        $recentComplaints = Complaint::where(\'user_id\', $userId)\r\n            ->orderBy(\'created_at\', \'desc\')\r\n            ->limit(5)\r\n            ->get();\r\n\r\n        // Return the view with data\r\n        return view(\'customer\', compact(\r\n            \'totalComplaints\',\r\n            \'activeComplaints\',\r\n            \'resolvedComplaints\',\r\n            \'recentComplaints\'\r\n        ));\r\n    }\r\n}', 'New', 7);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_07_024003_add_role_to_users_table', 1),
(6, '2025_03_08_075527_create_tickets_table', 1),
(7, '2025_03_08_075853_add_status_to_tickets_table', 1),
(8, 'xxxx_xx_xx_add_status_to_tickets_table', 2),
(9, 'xxxx_xx_xx_add_status_to_users_table', 2),
(10, '2025_03_13_025835_create_complaints_table', 3),
(11, 'xxxx_xx_xx_add_drugstore_fields_to_complaints_table', 3),
(12, '2025_03_13_030052_add_description_to_complaints_table', 4),
(13, 'xxxx_xx_xx_add_description_to_complaints_table', 4),
(14, '2025_03_13_030232_add_user_id_to_complaints_table', 5),
(15, 'xxxx_xx_xx_add_user_id_to_complaints_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('New','In Progress','Resolved','Closed') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(7, 'Customer User', 'customer@gmail.com', 'customer', '2025-03-12 18:30:06', '$2y$10$NdWpzfEpFMBj.RAG/Dvuq.IRIRHr/7TkVogK7.oLw7P16DkpSum7a', 'cjdQqoMN8OOVYZZdoahFmnZPfD1uOInoHkfYniPfpnKDty4hqJh6OND2FdSq', '2025-03-12 18:30:06', '2025-03-12 18:30:06', 'active'),
(8, 'Admin User', 'admin@gmail.com', 'admin', '2025-03-12 18:30:23', '$2y$10$y8ZoryBC2DCFbrt.7aip1OI1E5wdGExXTwqiaNGS8Qju0y0MGhiTS', 'uj15dS9VMbUSHxgV01C3nclx0QKDKAKdpQfnQ16n2yaydoyeQTZHjmJkRMgn', '2025-03-12 18:30:23', '2025-03-12 18:30:23', 'active'),
(9, 'support staff', 'support@gmail.com', 'support_staff', NULL, '$2y$10$kABz4JMAdOccVqafYo/CWebO9JDeprR3Ah9iLmsk1YhopmlkLj6QO', NULL, '2025-03-12 18:34:59', '2025-03-12 18:34:59', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
