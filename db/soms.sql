-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 09:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soms`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `announcement` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `user_id`, `title`, `announcement`, `status`, `created_at`, `updated_at`) VALUES
(8, '8', 'DSVS', 'VDSVSSD', '1', '2022-09-19 06:31:18', '2022-09-19 06:31:18'),
(9, '22', 'ptest', 'teadkjbak', '1', '2022-10-04 05:43:28', '2022-10-04 05:43:28'),
(10, '23', 'BEEd Annual Poem Qriting Contest', 'Halika na, sulat na!', '0', '2022-11-11 22:02:22', '2022-11-11 22:02:22'),
(11, '25', 'Fun Run 2022', 'ZVXCZXZCZXVC CGRRGHGHFSDF BSDDVCBVNVMF GJFGDBNHVGCHDTX CBCVBXBCV VBNVNGSD FGHDGCVC GDFXC CHBCV VC DFVBNVB', '1', '2022-11-14 06:20:26', '2022-11-14 06:20:26'),
(12, '26', 'Test Announcement', 'TESTTTT', '1', '2022-11-16 06:29:48', '2022-11-16 06:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `application_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advisers_commitment_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrator_id` int(11) DEFAULT NULL,
  `modified_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `organization_id`, `application_form`, `advisers_commitment_form`, `submitted_at`, `administrator_id`, `modified_at`, `created_at`, `updated_at`) VALUES
(22, 23, 18, 'files/application/Bacherlor of Elementary Education/Bacherlor of Elementary Education_ApplicationForm.pdf', 'files/application/Bacherlor of Elementary Education/Bacherlor of Elementary Education_AdvisersCommitmentForm.pdf', '11/12/2022', 8, '11/12/2022', '2022-11-11 21:43:14', '2022-11-11 21:43:14'),
(24, 25, 20, 'files/application/University Student Council/University Student Council_ApplicationForm.pdf', 'files/application/University Student Council/University Student Council_AdvisersCommitmentForm.pdf', '11/14/2022', 8, '11/14/2022', '2022-11-14 06:05:04', '2022-11-14 06:05:04'),
(25, 26, 21, 'files/application/Bachelor of Science in Business Administration/Bachelor of Science in Business Administration_ApplicationForm.pdf', 'files/application/Bachelor of Science in Business Administration/Bachelor of Science in Business Administration_AdvisersCommitmentForm.pdf', '11/16/2022', 8, '11/16/2022', '2022-11-16 06:22:19', '2022-11-16 06:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `archive_announcements`
--

CREATE TABLE `archive_announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `announcement_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `announcement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `announcement_created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `announcement_updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_events`
--

CREATE TABLE `archive_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `event_created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_organizations`
--

CREATE TABLE `archive_organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `organization_created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archive_students`
--

CREATE TABLE `archive_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `image`, `name`, `place`, `date_time`, `out`, `description`, `status`, `created_at`, `updated_at`) VALUES
(22, 1, 'images/events/astro world convention_event.jpg', 'Astro World Convention', 'Gymnasium', '2022-11-23T09:30', '2022-11-24T16:00', 'Ultimate Rock and Roll', 1, '2022-11-11 07:14:38', '2022-11-11 07:14:38'),
(23, 1, 'images/events/it convention_event.jpg', 'IT Convention', 'Laboratory', '2022-11-10T11:17', '2022-11-11T16:22', 'Let\'s go immerge to IT Industry', 0, '2022-11-11 07:18:28', '2022-11-11 07:18:28'),
(24, 1, 'images/events/vr-contest_event.jpg', 'VR Contest', 'Laboratory', '2022-11-13T13:02', '2022-11-14T08:02', 'Go nuts!', 0, '2022-11-11 16:03:20', '2022-11-11 16:03:20'),
(27, 23, 'images/events/annual-poem-writing-contest_event.jpeg', 'Annual Poem Writing Contest', 'Campus', '2022-11-13T00:00', '2022-11-14T00:00', 'Write it out!', 1, '2022-11-11 21:59:16', '2022-11-11 21:59:16'),
(28, 25, 'images/events/fun-run-2022_event.png', 'Fun Run 2022', 'Talavera Town Proper', '2022-11-15T05:00', '2022-11-15T10:00', '2022 Fun Run', 1, '2022-11-14 06:11:52', '2022-11-14 06:11:52'),
(29, 25, 'images/events/jjjjgcgfq_event.png', 'JJJJGCGFQ', 'GHKHKFVJVH', '2022-11-14T22:43', '2022-11-14T22:44', 'BJKVJVJM', 1, '2022-11-14 06:41:31', '2022-11-14 06:41:31'),
(30, 26, 'images/events/soms-update_event.png', 'SOMS Update', '127.0.0.1:8000/', '2022-11-17T00:00', '2022-11-17T15:50', 'Software Update', 1, '2022-11-16 06:25:20', '2022-11-16 06:25:20'),
(31, 26, 'images/events/test-active_event.PNG', 'Test Active', 'Test Place', '2022-11-16T22:29', '2022-11-16T22:31', 'Test Description', 1, '2022-11-16 06:27:44', '2022-11-16 06:27:44'),
(32, 1, 'images/events/test_event.png', 'Fun Run', 'Talavera Town Proper', '2022-11-26T09:05', '2022-11-30T10:00', 'test', 1, '2022-11-25 17:03:15', '2022-11-25 17:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(46, '2014_10_12_000000_create_users_table', 1),
(47, '2014_10_12_100000_create_password_resets_table', 1),
(48, '2019_08_19_000000_create_failed_jobs_table', 1),
(49, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(50, '2022_04_29_004516_create_organizations_table', 1),
(51, '2022_04_30_101256_create_events_table', 1),
(52, '2022_05_02_033050_create_announcements_table', 1),
(55, '2022_10_01_122456_create_applications_table', 2),
(60, '2022_11_12_082702_create_archive_organizations_table', 3),
(61, '2022_11_10_165754_create_renewals_table', 4),
(62, '2022_11_12_080626_create_archive_events_table', 5),
(63, '2022_11_12_082817_create_archive_announcements_table', 6),
(66, '2022_11_14_160215_create_archive_students_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `user_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(17, 1, 'Bachelor Of Science in Information Technology', 1, NULL, NULL),
(18, 23, 'Bachelor of Elementary Education', 1, '2022-11-11 21:43:14', '2022-11-11 21:55:40'),
(20, 25, 'University Student Council', 2, '2022-11-14 06:05:04', '2022-11-25 16:04:12'),
(21, 26, 'Bachelor of Science in Business Administration', 1, '2022-11-16 06:22:19', '2022-11-16 06:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renewals`
--

CREATE TABLE `renewals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `renewal_letter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accomplishment_report` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budgetary_report` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrator_id` int(11) DEFAULT NULL,
  `modified_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `renewals`
--

INSERT INTO `renewals` (`id`, `user_id`, `organization_id`, `renewal_letter`, `accomplishment_report`, `budgetary_report`, `submitted_at`, `administrator_id`, `modified_at`, `created_at`, `updated_at`) VALUES
(1, 25, 20, 'files/renewal/University Student Council/University Student Council_RenewalLetter.pdf', 'files/renewal/University Student Council/University Student Council_AccomplishmentReport.pdf', 'files/renewal/University Student Council/University Student Council_BudgetaryReport.pdf', '11/14/2022', 8, '11/14/2022', '2022-11-14 06:26:46', '2022-11-14 06:26:46'),
(2, 26, 21, 'files/renewal/Bachelor of Science in Business Administration/Bachelor of Science in Business Administration_RenewalLetter.pdf', 'files/renewal/Bachelor of Science in Business Administration/Bachelor of Science in Business Administration_AccomplishmentReport.pdf', 'files/renewal/Bachelor of Science in Business Administration/Bachelor of Science in Business Administration_BudgetaryReport.pdf', '11/16/2022', 8, '11/16/2022', '2022-11-16 06:33:32', '2022-11-16 06:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test Org', 'testorg@email.com', NULL, '$2y$10$sWi3i8YRKsrji.cJaS0kVeBdBjjjw3XT6BOg1f1DXwI3fTvPfhwXy', 'Organization', NULL, NULL, NULL),
(2, 'Test Student', 'teststud@email.com', NULL, '$2y$10$eSJFdvrOU0YwgNu8YyZuZ.1Z9xcKWKjEmBDaEUVPU08DclwCZcBPS', 'Student', NULL, NULL, NULL),
(8, 'Test Administrator', 'testadmin@email.com', NULL, '$2y$10$sWi3i8YRKsrji.cJaS0kVeBdBjjjw3XT6BOg1f1DXwI3fTvPfhwXy', 'Administrator', NULL, NULL, NULL),
(23, 'BEEd Handler', 'testorg2@email.com', NULL, '$2y$10$yCqzmEp0/VNWn/IX6ZhTyezD2a6sc0DB95H.tvNb0L5tsmf3qdymu', 'Organization', NULL, '2022-11-11 21:34:56', '2022-11-11 21:34:56'),
(25, 'USC Handler', 'usc@neust.com', NULL, '$2y$10$ZKTsXzs960o/rCWHeGQ8juPtbvF7gsr2d9oTH7vg.rPfXmHstbWrm', 'Organization', NULL, '2022-11-14 06:00:55', '2022-11-14 06:00:55'),
(26, 'BSBA Handler', 'bsba@neust.com', NULL, '$2y$10$CY.jyvYS7faVsJOn9mPeuO5fz8O4DD6pCKQ3GkVoaaD37CTSYQQoq', 'Organization', NULL, '2022-11-16 06:21:14', '2022-11-16 06:21:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_announcements`
--
ALTER TABLE `archive_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_events`
--
ALTER TABLE `archive_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_organizations`
--
ALTER TABLE `archive_organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_students`
--
ALTER TABLE `archive_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `archive_students_email_unique` (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `renewals`
--
ALTER TABLE `renewals`
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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `archive_announcements`
--
ALTER TABLE `archive_announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `archive_events`
--
ALTER TABLE `archive_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `archive_organizations`
--
ALTER TABLE `archive_organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `archive_students`
--
ALTER TABLE `archive_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renewals`
--
ALTER TABLE `renewals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
