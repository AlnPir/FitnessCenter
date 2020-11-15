-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jun 07, 2020 at 12:49 PM
-- Server version: 5.7.29
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitnesscenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfer`
--

CREATE TABLE `bank_transfer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_transfer`
--

INSERT INTO `bank_transfer` (`id`, `user_id`, `bank_name`, `iban`, `bic`, `account_owner`) VALUES
(1, NULL, 'Crédit Agricole', 'FRkk BBBB BGGG GGCC CCCC CCCC CKK', 'AVYUDI65965', 'Bjorn Northwood'),
(2, NULL, 'Crédit Mutuel', 'FRkk BBBB BGGG GGCC XXXX CCCC CKK', 'AVYUD165316', 'Bjorn Northwood');

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` datetime NOT NULL,
  `security_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`id`, `user_id`, `name`, `number`, `validity`, `security_code`) VALUES
(1, 2, 'Bjorn Northwood', '0123456789123489', '2020-11-30 10:51:43', 205),
(2, 2, 'Bjorn Northwood', '7894561230789423', '2021-03-31 10:51:43', 306);

-- --------------------------------------------------------

--
-- Table structure for table `endurance`
--

CREATE TABLE `endurance` (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `equipement_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `endurance`
--

INSERT INTO `endurance` (`id`, `duration`, `speed`, `user_id`, `equipement_id`, `created_at`) VALUES
(1, 120, 36, 2, 1, '2020-04-30 21:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`) VALUES
(1, 'Tapis de Course'),
(2, 'Banc de développé couché ');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200429183532', '2020-04-29 18:35:50'),
('20200429201026', '2020-04-29 20:10:38'),
('20200429203042', '2020-04-29 20:30:51'),
('20200429205549', '2020-04-29 20:55:53'),
('20200430152918', '2020-04-30 15:30:40'),
('20200430154649', '2020-04-30 15:47:18'),
('20200430194146', '2020-04-30 19:41:51'),
('20200430194412', '2020-04-30 19:44:15'),
('20200508154819', '2020-05-08 15:48:26'),
('20200509084339', '2020-05-09 08:43:45'),
('20200509085134', '2020-05-09 08:51:37'),
('20200605101119', '2020-06-05 10:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `modality`
--

CREATE TABLE `modality` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modality`
--

INSERT INTO `modality` (`id`, `offer_id`, `title`, `price`) VALUES
(1, 1, '9,99€ pour 1 mois', 9.99),
(2, 1, '24,99€ les 3 mois', 8.34),
(3, 1, '74,99€ l\'année', 6.25),
(4, 2, '14,99€ pour 1 mois', 14.99),
(5, 2, '39,99€ les 3 mois', 13.33),
(6, 2, '149,99€ l\'année', 12.5),
(7, 3, '24,99€ pour 1 mois', 24.99),
(8, 3, '59,99€ les 3 mois', 20),
(9, 3, '199.99€ l\'année', 16.67);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `title`, `description`) VALUES
(1, 'Formule Débutant', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nibh ipsum, gravida vitae scelerisque et, mattis eu est. Sed sit amet ex ante. Integer at metus aliquam, ullamcorper felis sit amet, porta magna. Aliquam dapibus accumsan arcu sed euismod. Mauris bibendum nulla vitae diam viverra, a pharetra quam ultrices. Nunc a pharetra dui. Mauris quis nulla eu ligula vestibulum pellentesque nec vel ante. Suspendisse interdum nisi dolor, sit amet commodo elit bibendum sed. Cras a elit ipsum. Phasellus justo erat, tincidunt et metus vel, vulputate lacinia tortor. Nam varius leo leo, vel auctor risus ornare a. '),
(2, 'Formule Intermédiaire', 'Nam eu ultrices turpis, sit amet viverra dui. Quisque semper, dolor id consequat vehicula, quam risus lobortis libero, vel pharetra velit ex et sem. Sed porta finibus nisi, eu dictum sem congue ac. Proin non tellus et justo ultrices lobortis. Sed rhoncus eu tellus interdum varius. Vestibulum bibendum vitae velit sed hendrerit. Suspendisse consectetur nibh eget erat condimentum efficitur. Donec vestibulum sem nec felis tincidunt, eget sagittis tortor eleifend. Sed auctor tortor in turpis congue, vitae aliquet nibh tincidunt. '),
(3, 'Formule Confirmé', 'Pellentesque pretium rutrum efficitur. Integer malesuada magna quis tristique varius. In ante nunc, dapibus eget euismod interdum, facilisis at enim. Maecenas egestas efficitur consectetur. Duis id ligula suscipit, feugiat neque sed, porta ligula. Nulla id mattis ipsum. Aenean et porttitor nulla, ut porttitor erat. Mauris nunc eros, molestie ac turpis a, finibus molestie tellus. Duis ultricies porttitor ipsum at rhoncus. Donec congue sem sed malesuada semper. Etiam rutrum egestas risus, at bibendum mauris lobortis eget. Nunc venenatis, nibh at scelerisque feugiat, lorem libero dignissim leo, ac congue tellus lectus in tortor. Vestibulum facilisis eros nec elit iaculis, aliquet euismod enim vehicula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. ');

-- --------------------------------------------------------

--
-- Table structure for table `strenght`
--

CREATE TABLE `strenght` (
  `id` int(11) NOT NULL,
  `repetition` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `equipement_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strenght`
--

INSERT INTO `strenght` (`id`, `repetition`, `weight`, `user_id`, `equipement_id`, `created_at`) VALUES
(1, 12, 150, 2, 2, '2020-04-30 21:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `renewal` tinyint(1) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `payment_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `user_id`, `created_at`, `start_date`, `end_date`, `renewal`, `status`, `offer_id`, `payment_option`, `payment_id`) VALUES
(1, 2, '2020-04-29 20:57:26', '2020-05-01 22:56:21', '2020-06-01 22:56:21', 0, 'Payé', 3, 'credit_card', 1),
(2, 2, '2020-04-30 20:57:26', '2020-07-01 22:56:21', '2020-08-31 22:56:21', 1, 'En attente de payement', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `admin`) VALUES
(1, 'admin', '$2y$10$QhaeYO8UEWp2KfND2L1R7ODsWh0xhnzad8aRY9waXgNbzrMir604O', 'admin@fitnesscenter.com', 'Alan', 'Pierre', 1),
(2, 'user', '$2y$10$Riw.xDA5IrWNPW/fDLHc4e6v1xGFBsLEJoe8SmQUatm5XuFqSPc/G', 'user@fitnesscenter.com', 'Bjorn', 'Northwood', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_transfer`
--
ALTER TABLE `bank_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7174B947A76ED395` (`user_id`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_11D627EEA76ED395` (`user_id`);

--
-- Indexes for table `endurance`
--
ALTER TABLE `endurance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2043FE18A76ED395` (`user_id`),
  ADD KEY `IDX_2043FE18806F0F5C` (`equipement_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `modality`
--
ALTER TABLE `modality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_307988C053C674EE` (`offer_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strenght`
--
ALTER TABLE `strenght`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_24CFE0CAA76ED395` (`user_id`),
  ADD KEY `IDX_24CFE0CA806F0F5C` (`equipement_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A3C664D3A76ED395` (`user_id`),
  ADD KEY `IDX_A3C664D353C674EE` (`offer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_transfer`
--
ALTER TABLE `bank_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `endurance`
--
ALTER TABLE `endurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modality`
--
ALTER TABLE `modality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `strenght`
--
ALTER TABLE `strenght`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_transfer`
--
ALTER TABLE `bank_transfer`
  ADD CONSTRAINT `FK_7174B947A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `FK_11D627EEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `endurance`
--
ALTER TABLE `endurance`
  ADD CONSTRAINT `FK_2043FE18806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipment` (`id`),
  ADD CONSTRAINT `FK_2043FE18A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `modality`
--
ALTER TABLE `modality`
  ADD CONSTRAINT `FK_307988C053C674EE` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`);

--
-- Constraints for table `strenght`
--
ALTER TABLE `strenght`
  ADD CONSTRAINT `FK_24CFE0CA806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipment` (`id`),
  ADD CONSTRAINT `FK_24CFE0CAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `FK_A3C664D353C674EE` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`),
  ADD CONSTRAINT `FK_A3C664D3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
