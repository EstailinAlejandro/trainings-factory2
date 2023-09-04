-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 jun 2023 om 00:05
-- Serverversie: 10.4.25-MariaDB
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainingsfactory`
--
CREATE DATABASE IF NOT EXISTS `trainingsfactory` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trainingsfactory`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230602105656', '2023-06-15 17:14:42', 57),
('DoctrineMigrations\\Version20230602110915', '2023-06-15 17:14:42', 23),
('DoctrineMigrations\\Version20230602120113', '2023-06-15 17:14:42', 46),
('DoctrineMigrations\\Version20230602121317', '2023-06-15 17:14:42', 25),
('DoctrineMigrations\\Version20230602121558', '2023-06-15 17:14:42', 27),
('DoctrineMigrations\\Version20230607103252', '2023-06-15 17:14:42', 108),
('DoctrineMigrations\\Version20230607103900', '2023-06-15 17:14:42', 110),
('DoctrineMigrations\\Version20230607104434', '2023-06-15 17:14:42', 259),
('DoctrineMigrations\\Version20230615154817', '2023-06-15 17:48:26', 190),
('DoctrineMigrations\\Version20230615155921', '2023-06-15 17:59:25', 197),
('DoctrineMigrations\\Version20230617191327', '2023-06-17 21:13:40', 162),
('DoctrineMigrations\\Version20230617202731', '2023-06-17 22:27:38', 37),
('DoctrineMigrations\\Version20230619180718', '2023-06-19 20:07:27', 73);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesson`
--

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `locaion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preprovision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` date NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `hiring_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `social_sec_number` int(11) DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `person`
--

INSERT INTO `person` (`id`, `email`, `password`, `firstname`, `lastname`, `preprovision`, `dateofbirth`, `roles`, `hiring_date`, `salary`, `social_sec_number`, `street`, `place`) VALUES
(1, 'lid@test.com', '$2y$13$J6ZYPBg0Fyd7YYR4ESPyUu4Sv3nuyAp12rGFctA/4ErCabbbwlTc6', 'Jan', 'Berg', 'van', '1984-06-14', '[\"ROLE_MEMBER\"]', '0000-00-00', NULL, NULL, 'Geleenstraat 45', 'Den Haag'),
(2, 'instructeur@test.com', '$2y$13$J6ZYPBg0Fyd7YYR4ESPyUu4Sv3nuyAp12rGFctA/4ErCabbbwlTc6', 'Mark', 'Zuckerberg', '', '1995-05-01', '[\"ROLE_INSTRUCTOR\"]', '2003-06-04', '1750.05', 1, NULL, NULL),
(3, 'admin@test.com', '$2y$13$J6ZYPBg0Fyd7YYR4ESPyUu4Sv3nuyAp12rGFctA/4ErCabbbwlTc6', 'Peter', 'Drieten', '', '1876-09-11', '[\"ROLE_ADMIN\"]', NULL, NULL, NULL, NULL, NULL),
(5, 'instructor2@test.com', '$2y$13$MtFk5E2AGodP2EQrMqlnNubRe7haIhzL6s9tGgbwMlPwdChuXmzvu', 'mark', 'banaan', 'ba', '1950-04-11', '[\"ROLE_INSTRUCTOR\"]', '2005-05-10', '1799.50', 34, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `training`
--

DROP TABLE IF EXISTS `training`;
CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_costs` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `training`
--

INSERT INTO `training` (`id`, `name`, `description`, `duration`, `extra_costs`) VALUES
(1, 'Boksen', 'Boksen: Vechtsport met stoten, ontwijken. Fysieke/mentale kracht. Queensberry-reglement. Gewichtsklassen. Bekende boksers. Fitness, zelfverdediging. Risico\'s: blessures. Professionele begeleiding, bescherming belangrijk.', '90 minuten', NULL),
(2, 'Kickboksen', 'Kickboksen: Vechtsport met stoten, trappen, knieën en ellebogen. Fysieke/mentale kracht. Technieken uit diverse vechtsporten. Populair, competitief. Fitness, zelfverdediging. Risico\'s: blessures. Professionele begeleiding, bescherming belangrijk.', '90 minuten', NULL),
(3, 'MMA', '\nMMA: Mixed Martial Arts. Volledig contactvechtsport. Combineert technieken zoals worstelen, boksen, kickboksen en grondgevecht. Fysiek en mentaal uitdagend. Kooigevechten. Populair, competitief. Veelzijdige vaardigheden. Risico op blessures.', '120 minuten', NULL),
(4, 'Stootzak-training', 'Stootzak-training: Verbeter stoot- en traptechnieken. Fysieke kracht, techniek, snelheid. Effectief, populair. Zelfstandig of begeleid. Verbeter coördinatie, conditie. Optimaliseer stoten, trappen.', '30 minuten', NULL),
(5, 'Bootcamp', '\nBootcamp: Intensieve groepstraining. Combinatie van cardio, kracht en intervaloefeningen. Fysieke uitdaging, teamwork. Verbetering van conditie, kracht en uithoudingsvermogen. Populair, motiverend. Buiten- of binnenlocaties. Gevarieerde oefeningen. Profe', '90 minuten', NULL),
(6, 'Fitness-uren', 'Fitness-uren', '60 minuten', NULL),
(8, 'sringtouwew1', 'panekanodsn o', '120 minuten', NULL),
(9, 'bok springen', 'dsassdsagsfasfsas', '30 minuten', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3217BBB47` (`person_id`),
  ADD KEY `IDX_F87474F3BEFD98D1` (`training_id`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_34DCD176E7927C74` (`email`);

--
-- Indexen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62A8A7A7CDF80196` (`lesson_id`),
  ADD KEY `IDX_62A8A7A7217BBB47` (`person_id`);

--
-- Indexen voor tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F3217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `FK_F87474F3BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`);

--
-- Beperkingen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `FK_62A8A7A7217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `FK_62A8A7A7CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
