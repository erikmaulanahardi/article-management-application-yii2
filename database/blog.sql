-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2026 at 08:06 AM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(45) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `name`, `role`) VALUES
('ADM001', '$2y$13$KD9A0.k9Wpt5e8r./xKxFuUrbnMIcPBR39Ik7rmh8UQIJnxo9boqm', 'Alex', 'Admin'),
('ATH001', '$2y$13$c5XzxsNezPoKlrV6Ul39xuMKQX7DmfuLzQbY0jt/Oh8gU2rqgNhte', 'John', 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', 'ADM001', 1793935257),
('Author', 'ATH001', 1793935257);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Admin', 1, NULL, NULL, NULL, 1793935257, 1793935257),
('Author', 1, NULL, NULL, NULL, 1793935257, 1793935257),
('post/delete', 2, 'Hapus blog', NULL, NULL, 1793935257, 1793935257),
('post/index', 2, 'Akses halaman index blog', NULL, NULL, 1793935257, 1793935257);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'post/delete'),
('Admin', 'post/index'),
('Author', 'post/index');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1793935252),
('m140506_102106_rbac_init', 1793935255),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1793935255),
('m180201_230521_init_db', 1793935255),
('m180523_151638_rbac_updates_indexes_without_prefix', 1793935256),
('m200409_110543_rbac_update_mssql_trigger', 1793935256),
('m261105_093819_initRoleAndUser', 1793935257),
('m261106_032433_add_status_and_rejection_reason_to_post_table', 1793935560);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idpost` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(45) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `rejection_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`idpost`, `title`, `content`, `date`, `username`, `status`, `rejection_reason`) VALUES
(1, 'Selamat Datang di Website Baru Kami', 'Ini adalah postingan pertama yang dibuat sebagai contoh atau dummy data untuk blog ini.', '2026-11-06 04:20:57', 'ADM001', 'draft', NULL),
(2, 'Tips Belajar Framework Yii2 dengan Cepat', 'Yii2 adalah framework PHP yang sangat cepat dan aman. Pelajari dasar-dasar MVC dan RBAC untuk hasil optimal.', '2026-11-06 04:20:57', 'ATH001', 'published', NULL),
(3, 'Lorem Ipsum Dolor Sit Amet', '<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non tortor urna. Proin elementum metus vel quam pharetra, id posuere nunc interdum. In rhoncus justo orci, ut mollis diam ultricies et. Etiam venenatis arcu sit amet est blandit commodo. Suspendisse orci neque, euismod vitae vulputate in, commodo nec eros. Phasellus semper vel ex vitae faucibus. Vivamus consectetur nulla tellus, ac vestibulum diam convallis eu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In ut magna mauris.</strong></p>\r\n\r\n<p>Vivamus at augue tincidunt massa hendrerit rhoncus. Sed lobortis nisi vehicula mauris varius, id volutpat massa accumsan. Etiam sit amet sodales turpis. Nulla a est libero. Curabitur ullamcorper arcu non lectus blandit, in scelerisque enim pellentesque. Vivamus vehicula tellus nec ipsum aliquam faucibus non ac sem. Praesent fringilla, ante eu varius facilisis, nunc est efficitur metus, sed euismod tortor est a lacus. Curabitur a tristique mauris, sed tempus nisi. In imperdiet auctor sem non vulputate. In congue lacinia lacus quis vestibulum. Sed gravida est nec urna posuere, ut vehicula lorem egestas. Sed consequat, augue quis gravida porttitor, nunc arcu ultrices sem, aliquam tincidunt elit arcu vel metus. Maecenas nulla elit, molestie at lacus sed, luctus euismod ex. In hendrerit pellentesque mattis. Ut at dui nec metus sodales aliquam.</p>\r\n\r\n<p>Integer vehicula rutrum neque, et commodo sapien molestie ac. Etiam odio arcu, dignissim bibendum nulla ac, lobortis euismod nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean varius, augue sit amet lobortis consectetur, turpis nibh consectetur est, eu interdum est lacus luctus dui. Aliquam vestibulum lacinia viverra. Sed non ante sit amet enim condimentum faucibus. Maecenas dictum ullamcorper augue, a finibus nunc fermentum at. Phasellus sollicitudin dolor nec elit interdum, at suscipit sapien euismod. Praesent quam tortor, molestie et volutpat in, gravida ut elit. Nullam lobortis dictum mi quis consectetur. Phasellus tempor tortor a mauris consectetur hendrerit. Cras a ante porta, euismod libero ac, placerat erat. Aenean lectus magna, auctor in molestie in, dictum in elit. Sed eleifend ipsum in sem aliquam commodo a ut enim.</p>\r\n', '2026-11-06 05:10:13', 'ATH001', 'published', NULL),
(6, 'Lorem ipsum Part 2 ', '<p>Vivamus at augue tincidunt massa hendrerit rhoncus. Sed lobortis nisi vehicula mauris varius, id volutpat massa accumsan. Etiam sit amet sodales turpis. Nulla a est libero. Curabitur ullamcorper arcu non lectus blandit, in scelerisque enim pellentesque. Vivamus vehicula tellus nec ipsum aliquam faucibus non ac sem. Praesent fringilla, ante eu varius facilisis, nunc est efficitur metus, sed euismod tortor est a lacus. Curabitur a tristique mauris, sed tempus nisi. In imperdiet auctor sem non vulputate. In congue lacinia lacus quis vestibulum. Sed gravida est nec urna posuere, ut vehicula lorem egestas. Sed consequat, augue quis gravida porttitor, nunc arcu ultrices sem, aliquam tincidunt elit arcu vel metus. Maecenas nulla elit, molestie at lacus sed, luctus euismod ex. In hendrerit pellentesque mattis. Ut at dui nec metus sodales aliquam.</p>\r\n\r\n<p>SUDAH TERUPDATE!!!!</p>\r\n', '2026-11-06 05:36:39', 'ATH001', 'published', NULL),
(7, 'Lorem ipsum - Part 3', '<p>Integer vehicula rutrum neque, et commodo sapien molestie ac. Etiam odio arcu, dignissim bibendum nulla ac, lobortis euismod nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean varius, augue sit amet lobortis consectetur, turpis nibh consectetur est, eu interdum est lacus luctus dui. Aliquam vestibulum lacinia viverra. Sed non ante sit amet enim condimentum faucibus. Maecenas dictum ullamcorper augue, a finibus nunc fermentum at. Phasellus sollicitudin dolor nec elit interdum, at suscipit sapien euismod. Praesent quam tortor, molestie et volutpat in, gravida ut elit. Nullam lobortis dictum mi quis consectetur. Phasellus tempor tortor a mauris consectetur hendrerit. Cras a ante porta, euismod libero ac, placerat erat. Aenean lectus magna, auctor in molestie in, dictum in elit. Sed eleifend ipsum in sem aliquam commodo a ut enim.</p>\r\n\r\n<p>Etiam scelerisque feugiat justo a elementum. Sed aliquam enim eu finibus porttitor. Maecenas erat est, commodo elementum lacus at, finibus vulputate elit. Mauris pharetra dictum diam vitae tristique. Donec ac consequat quam. Suspendisse potenti. Proin efficitur lacus enim, at condimentum massa venenatis a. Morbi egestas diam erat, quis placerat purus suscipit eget. Praesent ac auctor nisi. Curabitur sed rhoncus sapien. Aenean vitae leo blandit, tempus augue id, vulputate velit. Nulla tempus dui eu purus feugiat fermentum. Maecenas vitae suscipit risus. Praesent dictum interdum eros, quis dapibus massa volutpat in. Duis scelerisque sem ipsum, a facilisis est semper at. Ut aliquam lobortis sem.</p>\r\n', '2026-11-06 05:37:41', 'ATH001', 'rejected', 'Mohon maaf untuk user ATH001, artikel anda belum lolos karena masih belum memenuhi persyaratan dan ketentuan yang berlaku, tetap semangat yaa :)))'),
(8, 'Program Workout Split Terbaik untuk para Web Developer - 5 DAYS WORKOUT SPLIT', '<p>The 5-Day Push / Pull / Legs / Upper / Lower (PPL - UL) Schedule<!--TgQPHd|||[[2,[null,null,1,null,null,null,null,null,null,null,null,null,[351768,null,0]],[],null,1]]--></p>\r\n\r\n<p><!--TgQPHd|||[]--></p>\r\n\r\n<ul>\r\n	<li><strong>Day 1: Push<!--TgQPHd|||[]--></strong> (Chest, Shoulders, Triceps)<!--TgQPHd|||[]--><!--TgQPHd|||[]--></li>\r\n	<!--TgQPHd|||[]-->\r\n</ul>\r\n\r\n<ul>\r\n	<li><strong>Day 2: Pull<!--TgQPHd|||[]--></strong> (Back, Biceps, Rear Delts)<!--TgQPHd|||[]--><!--TgQPHd|||[]--></li>\r\n	<!--TgQPHd|||[]-->\r\n</ul>\r\n\r\n<ul>\r\n	<li><strong>Day 3: Legs<!--TgQPHd|||[]--></strong> (Quads, Hamstrings, Glutes, Calves)<!--TgQPHd|||[]--><!--TgQPHd|||[]--></li>\r\n	<!--TgQPHd|||[]-->\r\n</ul>\r\n\r\n<ul>\r\n	<li><strong>Day 4: Rest / Active Recovery<!--TgQPHd|||[]--></strong><!--TgQPHd|||[]--><!--TgQPHd|||[]--></li>\r\n	<!--TgQPHd|||[]-->\r\n</ul>\r\n\r\n<ul>\r\n	<li><strong>Day 5: Upper Body<!--TgQPHd|||[]--></strong> (Chest, Back, Shoulders, Arms)<!--TgQPHd|||[]--><!--TgQPHd|||[]--></li>\r\n	<!--TgQPHd|||[]-->\r\n</ul>\r\n\r\n<ul>\r\n	<li><strong>Day 6: Lower Body &amp; Core<!--TgQPHd|||[]--></strong><!--TgQPHd|||[]--><!--TgQPHd|||[]--></li>\r\n	<!--TgQPHd|||[]-->\r\n</ul>\r\n\r\n<ul>\r\n	<li><strong>Day 7: Rest / Active Recovery</strong></li>\r\n</ul>\r\n\r\n<ul>\r\n</ul>\r\n', '2026-11-06 07:16:35', 'ATH001', 'published', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `fk_post_account_idx` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_account` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
