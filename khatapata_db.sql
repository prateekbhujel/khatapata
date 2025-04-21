-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 06:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khatapata_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `type` enum('Admin','Staff') NOT NULL DEFAULT 'Staff',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `status`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@email.com', NULL, '$2y$12$4p1tW6sgnGjcMzKxsP1xP.iK90W21hppIYmLJFAGdyIl9D8.zc/f2', '9862500130', 'Biratnagar', 'Active', 'Admin', '1EElPUyh1iK5Zndosj1pZPFq5DwwFsKhObilhOFsZwB6mJ3C3EQMnir8rlQQ', '2024-07-01 10:44:23', '2024-07-01 10:44:23'),
(2, 'Jhon Doe', 'jhon@email.com', NULL, '$2y$12$fsA39MIPrNnHodJsTrlNluGOwMbseSv77yW0FA.HMKJTadBLf4gyG', '9841454544', 'Biratnagar, Nepal', 'Active', 'Staff', 'z8RHUHiwHRcGtB50ujIsLuEf2UzrnzUksMaOzRUkxQaRz5mNVY894CwdwZuZ', '2024-07-01 10:58:56', '2024-07-01 10:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 1, 179265, '2024-07-03 12:57:44', '2024-07-04 02:02:20'),
(2, 2, 361495, '2024-07-04 02:21:35', '2024-07-04 04:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `user_id`, `category_id`, `name`, `amount`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'Budget for DTD Expense', 5000, '2024-07-03', '2024-08-04', 'Active', '2024-07-03 12:53:50', '2024-07-03 12:53:50'),
(2, 1, 7, 'Limit Glocories', 1500, '2024-07-03', '2024-08-04', 'Inactive', '2024-07-03 15:17:30', '2024-07-03 15:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Expense','Income') NOT NULL DEFAULT 'Expense',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'Salary', 'Income', 'Active', '2024-07-03 12:50:54', '2024-07-03 12:50:54'),
(7, 1, 'Glocories', 'Expense', 'Active', '2024-07-03 12:51:09', '2024-07-03 12:51:09'),
(8, 1, 'misc.', 'Expense', 'Active', '2024-07-03 12:51:16', '2024-07-03 12:51:16'),
(9, 1, 'Rent collection', 'Income', 'Active', '2024-07-03 12:51:26', '2024-07-03 12:52:02'),
(10, 1, 'Debts Recovery', 'Income', 'Active', '2024-07-03 12:51:39', '2024-07-03 12:51:39'),
(11, 1, 'Day to Day Expenses', 'Expense', 'Active', '2024-07-03 12:52:46', '2024-07-03 12:52:46'),
(12, 2, 'Day to Day Expenses', 'Expense', 'Active', '2024-07-04 02:18:11', '2024-07-04 02:18:11'),
(13, 2, 'Salary', 'Income', 'Active', '2024-07-04 02:36:07', '2024-07-04 02:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `expense_receipts` text DEFAULT NULL,
  `expense_note` text DEFAULT NULL,
  `expense_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `category_id`, `amount`, `expense_receipts`, `expense_note`, `expense_date`, `created_at`, `updated_at`) VALUES
(4, 1, 12, 505, '[\"img202407040736037185.png\"]', 'Brought an White Wired headphones.', '2024-07-03', '2024-07-04 01:49:19', '2024-07-04 02:21:48'),
(5, 1, 11, 1500, '[\"img202407040737097286.jpg\",\"img202407040737093984.png\"]', 'Brought Laptop Stand and Mouse.', '2024-07-04', '2024-07-04 01:52:09', '2024-07-04 01:52:09'),
(6, 1, 11, 25, '[]', 'Tea and Breakfast and Side ko dokan', '2024-07-04', '2024-07-04 01:52:54', '2024-07-04 01:52:54'),
(7, 1, 11, 50, '[]', 'Bus fair to go to office', '2024-07-04', '2024-07-04 01:53:15', '2024-07-04 01:53:15'),
(8, 1, 8, 7500, '[\"img202407040740118841.png\",\"img202407040740121102.jpg\"]', 'Brought and paid some misc items don\'t remember.', '2024-07-03', '2024-07-04 01:55:12', '2024-07-04 01:55:12'),
(9, 1, 8, 1000, '[\"img202407040740553627.png\",\"img202407040740552272.jpg\",\"img202407040740564152.png\"]', 'Did an birthday party', '2024-05-04', '2024-07-04 01:55:56', '2024-07-04 01:55:56'),
(10, 1, 11, 50, '[]', 'Ball pen and copy', '2024-06-04', '2024-07-04 01:56:41', '2024-07-04 01:56:41'),
(11, 1, 11, 55, '[]', 'Colgate and toothbrush.', '2024-06-04', '2024-07-04 01:57:32', '2024-07-04 01:57:32'),
(12, 1, 11, 55, '[]', 'Colgate manjan brought again', '2024-07-04', '2024-07-04 01:58:07', '2024-07-04 01:58:07'),
(13, 2, 12, 37000, '[]', 'total expenses up to june', '2024-06-04', '2024-07-04 02:54:25', '2024-07-04 02:57:59');

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
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Expense Tracking', '<p style=\"text-align: left;\"><li><em>Real-time logging of expenses</em></li><li><em>Categorization of expenses (e.g., food, travel, utilities)</em></li><li><em>Attach receipts via photo upload</em></li><li><em>Recurring expenses setup</em></li></p>', 'Active', '2024-07-01 11:08:51', '2024-07-03 07:12:39'),
(2, 'Custom Categories', '<p><li><em>Users can create, edit, and delete expense categories</em></li><li><em>Subcategories for detailed tracking</em></li><li><em>Customizable icons and colors for categories</em></li></p>', 'Active', '2024-07-01 11:16:57', '2024-07-01 11:16:57'),
(3, 'Budget Planning', '<p><li><em>Set monthly or weekly budgets for expenses categories.</em></li><li><em>Alerts and notifications for budget limits.</em></li><li><em>Flexible budget adjustment.</em></li></p>', 'Active', '2024-07-01 11:17:57', '2024-07-01 11:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `income_receipts` text NOT NULL,
  `income_note` text NOT NULL,
  `income_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `user_id`, `category_id`, `amount`, `income_receipts`, `income_note`, `income_date`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 25000, '[]', 'Received this month salary', '2024-07-03', '2024-07-03 12:57:44', '2024-07-03 12:57:44'),
(2, 1, 6, 150000, '[]', 'Salary  up to June month or balance BD for 2024.(Date set at starting)', '2024-01-01', '2024-07-04 02:02:00', '2024-07-04 02:02:20'),
(4, 2, 13, 18500, '[\"img202407040821467692.webp\"]', 'Received the income for the month', '2024-07-04', '2024-07-04 02:36:47', '2024-07-04 02:36:47'),
(5, 2, 13, 18500, '[]', 'June salary received.', '2024-06-01', '2024-07-04 02:49:02', '2024-07-04 04:27:37'),
(6, 2, 13, 18500, '[]', 'May salary received.', '2024-05-01', '2024-07-04 02:49:28', '2024-07-04 02:49:28');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_04_05_154750_create_admins_table', 1),
(7, '2024_04_07_183606_create_features_table', 1),
(8, '2024_04_09_181144_create_web_settings_table', 1),
(9, '2024_04_15_143953_create_accounts_table', 1),
(10, '2024_04_15_161154_create_categories_table', 1),
(13, '2024_04_23_173214_create_budgets_table', 1),
(14, '2024_04_18_140507_create_expenses_table', 2),
(15, '2024_04_18_151940_create_incomes_table', 3),
(16, '2024_07_03_181602_create_balances_table', 4);

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pratik Bhujel', 'demo@email.com', NULL, '$2y$12$u4RNZJ0VkbLg/bISjFPn4eaJAT8mNHch7.5eAte/Xr96mxMr4zo7C', '9862500130', 'Biratnagar, Nepal', 'Active', '8Qj5hKQwK7VkBELqWTwKbqGTZce0utE54Cbn5KfO9DodQoyzqc4HgrQs5CX3', '2024-07-01 10:59:20', '2024-07-01 10:59:20'),
(2, 'Jhon Doe', 'jhon@email.com', NULL, '$2y$12$T.ENAmrb.ees2lgUW68YoOB7qTgnh7FKfZEFBgZ/uVutas/AK//Ly', '9812445554', 'Biratnagar', 'Active', NULL, '2024-07-03 15:49:44', '2024-07-03 15:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

CREATE TABLE `web_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `about_us_description` text DEFAULT NULL,
  `btn_name` varchar(255) DEFAULT NULL,
  `btn_route` varchar(255) DEFAULT NULL,
  `website_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `banner` text NOT NULL,
  `favico` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `name`, `description`, `about_us_description`, `btn_name`, `btn_route`, `website_title`, `seo_description`, `seo_keywords`, `banner`, `favico`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'KhataPata', '<p style=\"text-align: center; \"><em><strong>\"Your Personal Expense and Income Tracker.\"</strong></em></p>', '<blockquote style=\"text-align: center;\"><em><strong>\"</strong>Khatapata is an expense app designed to help users manage their finances effectively with key features such as expense tracking, custom categories, and budget planning. The app allows for real-time expense tracking, including capturing receipts and handling recurring expenses. Users can create personalized categories for organizing their expenses according to their individual needs, enabling detailed tracking and analysis of spending habits. Budget planning tools allow users to set and adjust budgets across various categories, with alerts to keep spending in check. By providing visual representations of spending trends and goal-setting options, Khatapata empowers users to make informed financial decisions and stay on track with their financial goals.</em></blockquote>', 'Get Started', 'register', 'Expense Tracker', 'An Expense Tracker App which tracks the records if income and expenses.', 'Finance, Expense, Income, PHP, Laravel, Backend, AI', '/public/uploads/1716904273banner.jpg', '/public/uploads/812444237favicon(2).png', '/public/uploads/749485143logo(3).png', NULL, '2024-07-01 12:00:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `balances_user_id_foreign` (`user_id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budgets_user_id_foreign` (`user_id`),
  ADD KEY `budgets_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`),
  ADD KEY `expenses_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_user_id_foreign` (`user_id`),
  ADD KEY `incomes_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balances`
--
ALTER TABLE `balances`
  ADD CONSTRAINT `balances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `budgets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
