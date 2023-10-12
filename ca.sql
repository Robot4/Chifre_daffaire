-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 oct. 2023 à 00:35
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ca`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `commande` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `moved_to_entrer` tinyint(1) DEFAULT 0,
  `moved_to_stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `image`, `name`, `commande`, `prix`, `ville`, `status`, `moved_to_entrer`, `moved_to_stock`) VALUES
(135, 'images/651c11b0f134c_b39d4d53-c239-409f-876b-85a8333eaa54.jpg', 'Zaki	', 'Leakers Bleu M', 70.00, 'Fes', 'Retour', 1, 0),
(136, 'images/651c122ab367f_96691777-f0cd-4340-9dad-f00277281866.jpg', 'MEHDI', 'Amiri Beig XL', 70.00, 'casbalnca', 'Livré', 1, 0),
(137, 'images/651c1283079f1_73f630a1-5a8f-4f4c-9c4d-eacbce9f4a50.jpg', 'Mohssine', 'Ensemble NIKE Noir .M	', 70.00, 'El Jadida', 'Refusé', 1, 1),
(138, 'images/651c1318c8b69_73f630a1-5a8f-4f4c-9c4d-eacbce9f4a50.jpg', 'Ayoub', 'Ensemble Nike Noir Taill  L	', 70.00, 'Agadir', 'Retour', 1, 0),
(139, 'images/651c136bc9230_fe4b981e-b749-443a-ab22-a9de62b85b31.jpg', 'Reda', 'Ensemble Blanc Taille XL', 85.00, 'Tanger', 'Livré', 1, 0),
(140, 'images/651c13c37fd2f_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Zaaim', 'Survette Noir Tail M	', 85.00, 'KHENIFRA VILLE', 'Livré', 1, 0),
(141, 'images/651c14172b128_e08e8ab0-b89b-4fb8-938c-ab19c75d89e3.jpg', 'zakaria', 'Survette Biege Taille M	', 85.00, 'Agadir', 'Livré', 1, 0),
(142, 'images/651c14b187923_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'yassine', 'Ensemble Noir Taille M', 85.00, 'TIZNIT', 'Retour', 1, 0),
(143, 'images/651c14f50b470_e08e8ab0-b89b-4fb8-938c-ab19c75d89e3.jpg', 'Ayoub', 'Ensemble Biege Taille XL	', 85.00, 'Oued Zem', 'Livré', 1, 0),
(144, 'images/651c152f4f42b_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Marc Vianney	', 'Ensemble Noir la taille XL', 85.00, 'Fes', 'Livré', 1, 0),
(145, 'images/651c15b65824f_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Hatim', 'Ensemble Biege XL Ensemble Noir XL	', 170.00, 'ElHajeb VILLE', 'Livré', 1, 0),
(146, 'images/651c15f160968_fe4b981e-b749-443a-ab22-a9de62b85b31.jpg', 'Adil', 'Ensemble blanc XL	', 85.00, 'Agouray - Meknes', 'Livré', 1, 0),
(147, 'images/651c162da42df_fe4b981e-b749-443a-ab22-a9de62b85b31.jpg', 'ahmed', 'Ensemble Blanc Taille M	', 85.00, 'Nador', 'Retour', 1, 0),
(148, 'images/651c1662a14fa_e08e8ab0-b89b-4fb8-938c-ab19c75d89e3.jpg', 'Mohamed', 'Ensemble Biege D Taille XL Ensemble Noir Actually Taille XL	', 170.00, 'Guelmim', 'Livré', 1, 0),
(149, 'images/651c169b68fdc_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Bakre Houdallah	', 'Ensemble Actually Bleu Taille : M	', 85.00, 'casbalnca', 'Livré', 1, 0),
(150, 'images/651c16d23a3ea_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Yassine	', 'Ensemble noir D taille XL	', 85.00, 'Echemmaia', 'Retour', 1, 0),
(151, 'images/651c17a8433a8_f6b6ba70-6028-4612-8bc6-a978039199b5.jpg', 'Mohcine', 'Ensemble Beige Actually Taille : XL', 85.00, 'Settat', 'Refusé', 1, 1),
(152, 'images/651c17d157a4f_e4d0c256-4023-4344-9d59-5eecd2f0a08a.jpg', 'mochine', 'Ensemble Blanc Actually Taille : XL', 85.00, 'Settat', 'Retour', 1, 0),
(153, 'images/651c184bc6db4_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Youssef	', 'Ensemble Actually Bleu Taille L	', 85.00, 'Drarga', 'Livré', 1, 0),
(154, 'images/651c18a0d13a3_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Mounir	', 'Ensemble D bleu Taille M Ensemble Blanc Actually Taille XL	', 170.00, 'Tetouan', 'Livré', 1, 0),
(155, 'images/651c18e22a205_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'zineb', 'Ensemble Bleu Taille XL	', 85.00, 'Rabat', 'Livré', 1, 0),
(156, 'images/651c192985075_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Med', 'Ensemble Actually bleu Taillz XXL Ensemble Actually Noir taille XXL	', 170.00, 'Tinejdad Ville', 'Livré', 1, 0),
(157, 'images/651c195c7af79_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'badr', 'Ensemble Actually blue Taille S	', 85.00, 'casbalnca', 'Livré', 1, 0),
(159, 'images/651c19f064660_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Said Ahouach	', 'Ensemble Actually Bleu Taille L	', 85.00, 'Ait Melloul', 'Livré', 1, 0),
(160, 'images/651c1a200dcbc_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Hassan	', 'Ensemble Actually Blue Taille XL	', 85.00, 'Meknes', 'Livré', 1, 0),
(161, 'images/651c1a4a7deb8_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Iman khatabi	', 'Ensemble Noir Actually Taille : L	', 85.00, 'Tetouan', 'Livré', 1, 0),
(162, 'images/651c1a6a70478_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'anwa', 'Ensemble Noir D Taille L	', 85.00, 'RICHE-02', 'Livré', 1, 0),
(163, 'images/6524574d54bf5_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Mohamed Gueye	', 'Ensemble Actually Blue Taille XL	', 85.00, 'MOUHAMMEDIA', 'Livré', 1, 0),
(164, 'images/652457664476a_f6b6ba70-6028-4612-8bc6-a978039199b5.jpg', 'Mustapha togba	', 'Ensemble Actually Beige Taille L	', 85.00, 'Sale', 'Livré', 1, 0),
(165, 'images/65245780394db_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'mohamed', 'Ensemble Actually Noir Taille XL	', 85.00, 'Dakhla', 'Retour', 1, 0),
(166, 'images/652457a70f4f5_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Mustafa', 'Ensemble Actually Noir Taille L	', 85.00, 'jerada', 'Livré', 1, 0),
(167, 'images/652457e02919f_f6b6ba70-6028-4612-8bc6-a978039199b5.jpg', 'Abdel Lhaq	', 'Ensemble Actually Biege Taille XXL	', 85.00, 'Ksar Sghir', 'Demandé', 0, 0),
(168, 'images/652458076140c_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Abdel Jalil	', 'Ensemble Actually Blue Taille XL	', 85.00, 'Marrakech', 'Demandé', 0, 0),
(169, 'images/6524582838265_e4d0c256-4023-4344-9d59-5eecd2f0a08a.jpg', 'Abdel karim	', 'Ensemble Blanc Actually Taille M ', 85.00, 'Marrakech', 'Retour', 1, 0),
(170, 'images/6524583f477cb_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Abdel karim	', 'Ensemble Blue Actually Taille M', 85.00, 'Marrakech', 'Retour', 1, 0),
(171, 'images/6524585c1e0b4_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Soulaymane	', 'Ensemble Noir Actually XL	', 85.00, 'IMZZOUREN', 'Livré', 1, 0),
(172, 'images/6524587b2ac68_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Zakaria twirsi	', 'Ensemble Actually Noir Taille : L	', 85.00, 'DAROUA', 'Retour', 1, 0),
(174, 'images/652459d15c8c7_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Ali	', 'Ensemble Noir Taille M	', 0.00, 'Tanger', 'Demandé', 0, 0),
(175, 'images/65283013cbc99_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Ayoub', 'Ensemble Actually Noir Taille XL', 85.00, 'Marrakech', 'Demandé', 0, 0),
(176, 'images/6528302e666f0_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Ayoub', 'Ensemble Actually Blue Taille XL', 85.00, 'Marrakech', 'Demandé', 0, 0),
(177, 'images/6528305ff2482_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Mohamed', 'Ensemble Actually Noir Taille XXL	', 85.00, 'Agadir', 'Demandé', 0, 0),
(178, 'images/6528308919c6c_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Salah	', 'Ensemble Actually noir taille XL	', 85.00, 'Meknes', 'Demandé', 0, 0),
(179, 'images/6528309dbf80a_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'abdourahmane', 'Ensemble Actually Noir Taille XL	', 85.00, 'Dakhla', 'Demandé', 0, 0),
(180, 'images/652830d274d2c_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Mohamed', 'Ensemble Actually Noir Taille XL	', 85.00, 'Taza', 'Demandé', 0, 0),
(181, 'images/652830ffe629f_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Aziz	', 'Ensemble Actually Noir Taille XL', 85.00, 'khemis zemamra', 'Livré', 1, 0),
(182, 'images/6528312bb5640_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'aziz', 'Ensemble Actually Blue Taille XL', 85.00, 'khemis zemamra', 'Livré', 1, 0),
(183, 'images/6528315221587_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'marc', 'Ensemble Actually Blue Taille L	', 85.00, 'Dakhla', 'Demandé', 0, 0),
(184, 'images/652833804e103_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Marwan	', 'Ensemble Actually Noir Taille M	', 85.00, 'Fes', 'Livré', 1, 0),
(185, 'images/652833ceeb682_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Said	', 'Ensemble Noir Actually XXL	', 85.00, 'Meknes', 'Livré', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `entrer`
--

CREATE TABLE `entrer` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `commande` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entrer`
--

INSERT INTO `entrer` (`id`, `image`, `name`, `commande`, `prix`, `ville`, `status`) VALUES
(175, 'images/651c122ab367f_96691777-f0cd-4340-9dad-f00277281866.jpg', 'MEHDI', 'Amiri Beig XL', 120.00, 'casbalnca', 'Livré'),
(176, 'images/651c1283079f1_73f630a1-5a8f-4f4c-9c4d-eacbce9f4a50.jpg', 'Mohssine', 'Ensemble NIKE Noir .M	', 0.00, 'El Jadida', 'Refusé'),
(177, 'images/651c136bc9230_fe4b981e-b749-443a-ab22-a9de62b85b31.jpg', 'Reda', 'Ensemble Blanc Taille XL', 200.00, 'Tanger', 'Livré'),
(178, 'images/651c13c37fd2f_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Zaaim', 'Survette Noir Tail M	', 200.00, 'KHENIFRA VILLE', 'Livré'),
(179, 'images/651c14172b128_e08e8ab0-b89b-4fb8-938c-ab19c75d89e3.jpg', 'zakaria', 'Survette Biege Taille M	', 200.00, 'Agadir', 'Livré'),
(180, 'images/651c14f50b470_e08e8ab0-b89b-4fb8-938c-ab19c75d89e3.jpg', 'Ayoub', 'Ensemble Biege Taille XL	', 200.00, 'Oued Zem', 'Livré'),
(181, 'images/651c152f4f42b_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Marc Vianney	', 'Ensemble Noir la taille XL', 200.00, 'Fes', 'Livré'),
(182, 'images/651c15b65824f_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Hatim', 'Ensemble Biege XL Ensemble Noir XL	', 350.00, 'ElHajeb VILLE', 'Livré'),
(183, 'images/651c15f160968_fe4b981e-b749-443a-ab22-a9de62b85b31.jpg', 'Adil', 'Ensemble blanc XL	', 200.00, 'Agouray - Meknes', 'Livré'),
(184, 'images/651c1662a14fa_e08e8ab0-b89b-4fb8-938c-ab19c75d89e3.jpg', 'Mohamed', 'Ensemble Biege D Taille XL ', 400.00, 'Guelmim', 'Livré'),
(185, 'images/651c169b68fdc_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Bakre Houdallah	', 'Ensemble Actually Bleu Taille : M	', 200.00, 'casbalnca', 'Livré'),
(186, 'images/651c17a8433a8_f6b6ba70-6028-4612-8bc6-a978039199b5.jpg', 'Mohcine', 'Ensemble Beige Actually Taille : XL', 0.00, 'Settat', 'Refusé'),
(187, 'images/651c184bc6db4_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Youssef	', 'Ensemble Actually Bleu Taille L	', 200.00, 'Drarga', 'Livré'),
(188, 'images/651c18a0d13a3_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Mounir	', 'Ensemble D bleu Taille M Ensemble Blanc Actually Taille XL	', 400.00, 'Tetouan', 'Livré'),
(189, 'images/651c18e22a205_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'zineb', 'Ensemble Bleu Taille XL	', 200.00, 'Rabat', 'Livré'),
(190, 'images/651c192985075_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Med', 'Ensemble Actually bleu Taillz XXL Ensemble Actually Noir taille XXL	', 320.00, 'Tinejdad Ville', 'Livré'),
(191, 'images/651c195c7af79_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'badr', 'Ensemble Actually blue Taille S	', 200.00, 'casbalnca', 'Livré'),
(192, 'images/651c1a4a7deb8_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Iman khatabi	', 'Ensemble Noir Actually Taille : L	', 200.00, 'Tetouan', 'Livré'),
(193, 'images/651c1a200dcbc_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Hassan	', 'Ensemble Actually Blue Taille XL	', 200.00, 'Meknes', 'Livré'),
(194, 'images/651c19f064660_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Said Ahouach	', 'Ensemble Actually Bleu Taille L	', 200.00, 'Ait Melloul', 'Livré'),
(195, 'images/651c1a6a70478_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'anwa', 'Ensemble Noir D Taille L	', 200.00, 'RICHE-02', 'Livré'),
(196, 'images/6524574d54bf5_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Mohamed Gueye	', 'Ensemble Actually Blue Taille XL	', 200.00, 'MOUHAMMEDIA', 'Livré'),
(197, 'images/652457664476a_f6b6ba70-6028-4612-8bc6-a978039199b5.jpg', 'Mustapha togba	', 'Ensemble Actually Beige Taille L	', 200.00, 'Sale', 'Livré'),
(198, 'images/652457a70f4f5_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Mustafa', 'Ensemble Actually Noir Taille L	', 200.00, 'jerada', 'Livré'),
(199, 'images/6524585c1e0b4_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Soulaymane	', 'Ensemble Noir Actually XL	', 200.00, 'IMZZOUREN', 'Livré'),
(200, 'images/652830ffe629f_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Aziz	', 'Ensemble Actually Noir Taille XL', 200.00, 'khemis zemamra', 'Livré'),
(201, 'images/6528312bb5640_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'aziz', 'Ensemble Actually Blue Taille XL', 200.00, 'khemis zemamra', 'Livré'),
(202, 'images/652833804e103_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Marwan	', 'Ensemble Actually Noir Taille M	', 200.00, 'Fes', 'Livré'),
(203, 'images/652833ceeb682_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Said	', 'Ensemble Noir Actually XXL	', 200.00, 'Meknes', 'Livré');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `commande` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `image`, `name`, `commande`, `prix`, `ville`, `status`) VALUES
(312, 'images/651c11b0f134c_b39d4d53-c239-409f-876b-85a8333eaa54.jpg', 'Zaki	', 'Leakers Bleu M', 70.00, 'Fes', 'Retour'),
(313, 'images/651c1283079f1_73f630a1-5a8f-4f4c-9c4d-eacbce9f4a50.jpg', 'Mohssine', 'Ensemble NIKE Noir .M	', 70.00, 'El Jadida', 'Refusé'),
(314, 'images/651c1318c8b69_73f630a1-5a8f-4f4c-9c4d-eacbce9f4a50.jpg', 'Ayoub', 'Ensemble Nike Noir Taill  L	', 70.00, 'Agadir', 'Retour'),
(316, 'images/651c162da42df_fe4b981e-b749-443a-ab22-a9de62b85b31.jpg', 'ahmed', 'Ensemble Blanc Taille M	', 85.00, 'Nador', 'Retour'),
(317, 'images/651c16d23a3ea_28848a3d-1619-4c5a-b190-887b09314be4.jpg', 'Yassine	', 'Ensemble noir D taille XL	', 85.00, 'Echemmaia', 'Retour'),
(318, 'images/651c17a8433a8_f6b6ba70-6028-4612-8bc6-a978039199b5.jpg', 'Mohcine', 'Ensemble Beige Actually Taille : XL', 85.00, 'Settat', 'Refusé'),
(319, 'images/651c17d157a4f_e4d0c256-4023-4344-9d59-5eecd2f0a08a.jpg', 'mochine', 'Ensemble Blanc Actually Taille : XL', 85.00, 'Settat', 'Retour'),
(321, 'images/6524597c4b964_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'abdelhaq', 'Ensemble noir Actually taille L	', 85.00, 'Fes', 'Retour'),
(322, 'images/6524587b2ac68_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'Zakaria twirsi	', 'Ensemble Actually Noir Taille : L	', 85.00, 'DAROUA', 'Retour'),
(323, 'images/65245780394db_0f861355-d0f7-46de-a257-bb01ca7ce9c5.jpg', 'mohamed', 'Ensemble Actually Noir Taille XL	', 85.00, 'Dakhla', 'Retour'),
(324, 'images/6524583f477cb_0df34566-8d3a-47dd-86f1-ee4ddcf0b6fe.jpg', 'Abdel karim	', 'Ensemble Blue Actually Taille M', 85.00, 'Marrakech', 'Retour'),
(325, 'images/6524582838265_e4d0c256-4023-4344-9d59-5eecd2f0a08a.jpg', 'Abdel karim	', 'Ensemble Blanc Actually Taille M ', 85.00, 'Marrakech', 'Retour');

-- --------------------------------------------------------

--
-- Structure de la table `ville_price`
--

CREATE TABLE `ville_price` (
  `ville` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ville_price`
--

INSERT INTO `ville_price` (`ville`, `price`) VALUES
('AÃ¯t Ishaq', 45.00),
('ADOUZ', 40.00),
('Afourar - Beni-Mellal', 45.00),
('AFOURER', 45.00),
('Agadir', 35.00),
('Aghbal', 45.00),
('Aghmat', 45.00),
('aghroud', 45.00),
('Aglou', 45.00),
('Agouray - Meknes', 45.00),
('Aguelmous', 45.00),
('AHFIR', 40.00),
('Ain Allah', 45.00),
('Ain Aouda', 40.00),
('AIN ATTIQ', 45.00),
('ain bida', 45.00),
('Ain Bni Mathar', 45.00),
('Ain Cheggag', 45.00),
('Ain Chkef', 45.00),
('Ain Dfali-Ouazzane', 45.00),
('Ain Dorij', 45.00),
('Ain Harouda', 30.00),
('Ain Seddaq', 45.00),
('Ait Aissa Oubrahim', 45.00),
('AIT ALI', 40.00),
('AIT AMIRA-AGADIR', 45.00),
('Ait Iaaza', 45.00),
('Ait Ishaq', 45.00),
('Ait Melloul', 35.00),
('Ait ourir-VILLE', 45.00),
('Ait tislit - Béni Mellal', 45.00),
('Ajdir-HOUCIMA', 45.00),
('Ajdir-taza', 45.00),
('Al Hoceima', 40.00),
('Alnif', 45.00),
('Amghila', 45.00),
('Ankar beni mallal', 40.00),
('ANZA', 40.00),
('Aoufous', 45.00),
('Aoulouz', 45.00),
('Aourir-Agadir', 45.00),
('Arbaa Aounat', 45.00),
('Asilah Ville', 45.00),
('Assa', 45.00),
('Attaouia', 45.00),
('AZEMMOUR', 45.00),
('AZILAL', 45.00),
('Azrou', 45.00),
('Bab Berred', 45.00),
('Badriouin', 40.00),
('Bejaad', 45.00),
('Belaagid', 45.00),
('Belfaa', 45.00),
('BELKSIRI', 45.00),
('Ben Ahmed', 45.00),
('Ben Guerir', 45.00),
('Ben Tayeb-NADOR', 45.00),
('Beni Ayat-Beni Mellal', 40.00),
('beni derar', 45.00),
('Beni Ensar', 45.00),
('Beni Mellal', 35.00),
('Benslimane', 40.00),
('Berkane', 40.00),
('Berrchid', 35.00),
('Bhalil', 45.00),
('Bin El Ouidane', 45.00),
('Biougra', 45.00),
('bir jedid', 45.00),
('Bni Ayat - Beni-Mellal', 40.00),
('Bni Bouayach', 45.00),
('Bni Yakhlef', 40.00),
('bouanane', 45.00),
('Bouarfa', 45.00),
('BOUFKRANE', 45.00),
('Bouizakarne', 45.00),
('Boujdour', 45.00),
('Boujniba', 45.00),
('BOUKNADL', 45.00),
('boulemane', 45.00),
('Boumalne Dades', 45.00),
('Boumia', 45.00),
('Bounaamane-TIZNIT', 45.00),
('BOUSKOURA', 35.00),
('BOUZNIKA', 40.00),
('Bradia - Beni-Mellal', 40.00),
('casbalnca', 20.00),
('Chefchaouen', 45.00),
('CHELLALAT', 40.00),
('Chichaoua', 45.00),
('Chichaoua-VILLE', 45.00),
('Chouiter', 45.00),
('Dakhla', 45.00),
('Dar Bouazza', 45.00),
('Dar Ould Zidouh', 45.00),
('DAR si Aissa', 45.00),
('DAROUA', 35.00),
('dcheira', 40.00),
('Douar Boumaiz', 45.00),
('Douiyat-fes', 45.00),
('Drarga', 45.00),
('Driouch-NADOR', 45.00),
('Echemmaia', 45.00),
('EL HOUSSIMA', 40.00),
('El Jadida', 35.00),
('El Ksiba - Beni-Mellal', 45.00),
('El Maader El Kabir-TIZNIT', 45.00),
('El Mansouria', 40.00),
('El Ouatia', 45.00),
('ElHajeb VILLE', 45.00),
('Erfoud VILLE', 45.00),
('ERRACHIDIA-02', 45.00),
('ERRAHMA VILLE', 30.00),
('Essaouira', 45.00),
('ESSMARA-SAHARA', 45.00),
('faryata', 40.00),
('Fes', 35.00),
('Figuig', 45.00),
('Fnideq', 45.00),
('Foum el Anser', 45.00),
('Foum Jemaa', 45.00),
('FOUM ZAOUIA', 45.00),
('Fquih Ben Salah', 40.00),
('Gezenaya', 40.00),
('Gfifat', 45.00),
('GHAFSAI', 45.00),
('Gouassem-VILLE', 45.00),
('Goulmima', 45.00),
('Guelmim', 45.00),
('Guercif', 45.00),
('Had Aounat', 45.00),
('Had Soualem', 45.00),
('HAD WLAD FRAJ', 45.00),
('Harhoura', 40.00),
('Hattane', 45.00),
('Houara', 45.00),
('IFRAN', 45.00),
('ighram laalam-beni mellal', 45.00),
('Ighrem Laalam', 40.00),
('IKHOURBA', 45.00),
('Imintanoute', 45.00),
('IMOUZAR KANDRE', 45.00),
('IMZZOUREN', 45.00),
('Inzegane', 35.00),
('Issaguen', 45.00),
('JEMAAT BNI HLAL', 45.00),
('Jemaat Mtal', 45.00),
('jemaat shaim', 45.00),
('jerada', 45.00),
('Jorf Sefar', 45.00),
('Kaf Nsour-KHENIRA', 45.00),
('Kalaat Magouna', 45.00),
('Kariat Ba Mohamed', 45.00),
('Kasba Tadla', 45.00),
('Kasbah El Taher', 45.00),
('kelaa des Sraghna', 45.00),
('KELIAA', 45.00),
('KENITRA VILLE', 35.00),
('Kettara', 45.00),
('khemis zemamra', 45.00),
('Khemisset', 45.00),
('Khenichet', 45.00),
('KHENIFRA VILLE', 45.00),
('Khouribga', 40.00),
('Ksar El Kebir', 40.00),
('Ksar Sghir', 45.00),
('LAAROUI', 45.00),
('Laayayta Ben Melal', 40.00),
('Laayoune-charkiya', 45.00),
('Laayoune-Sahara', 45.00),
('Lalla Mimouna', 45.00),
('Lalla Takerkoust', 45.00),
('Lamnabeha', 45.00),
('Laouamra', 45.00),
('larache', 40.00),
('leksour', 40.00),
('LHAJ KADOUR VILLE', 45.00),
('Lhawzia-JADIDA', 45.00),
('LMHAYA', 45.00),
('Louizia', 40.00),
('M Diq', 45.00),
('Marrakech', 35.00),
('Martil', 40.00),
('Masmouda - Ouazzane', 45.00),
('Massa', 45.00),
('Mazagan', 45.00),
('Mediouna', 35.00),
('MEHDIA', 45.00),
('MEHDIA VILLE', 45.00),
('Mejjat', 45.00),
('Meknes', 35.00),
('Midar-Driouch', 45.00),
('MIDELT', 45.00),
('Missour', 45.00),
('MOUHAMMEDIA', 35.00),
('MOULAY ABDELLAH', 40.00),
('moulay bousselham', 45.00),
('Moulay Brahim', 45.00),
('MOULAY DRISSE ZARHOUNE', 45.00),
('Moulay Yaâcoub', 45.00),
('Mrirt', 45.00),
('Msawar Raso', 45.00),
('Mzouda', 45.00),
('Mzoudia', 45.00),
('Nador', 45.00),
('Nouaceur', 35.00),
('Ouahat Sidi Brahim', 45.00),
('Ouaouizeght', 45.00),
('ouargui', 45.00),
('Ouarzazat', 45.00),
('Ouazzane', 45.00),
('OUDAYA-Marrakech', 45.00),
('Oued Amlil', 45.00),
('Oued Zem', 45.00),
('Oujda', 35.00),
('Oulad Amrane', 45.00),
('Oulad Ayad', 40.00),
('Oulad Berhil', 45.00),
('Oulad Dahou', 45.00),
('Oulad Ghanem', 45.00),
('OULAD ISMAIL BENI MALLAL', 45.00),
('oulad jerrar-Tiznit', 45.00),
('Oulad M barek-Beni Mellal', 45.00),
('Oulad Said L Oued', 45.00),
('Oulad Said-Beni Mellal', 45.00),
('Oulad si bouhya', 45.00),
('OULAD TAYEB-FES', 45.00),
('Oulad Teima', 45.00),
('OULAD YAHYA', 40.00),
('Oulad Yaich', 45.00),
('Oulad Youssef', 45.00),
('Oulad Zmam - Beni-Mellal', 45.00),
('OULED BEN RAHMOUN', 45.00),
('Ouled Boutabet', 45.00),
('Ouled Hassoune', 40.00),
('ouled kanaw', 40.00),
('Ouled Moussa-Beni Mellal', 45.00),
('Oulmès', 45.00),
('Ourika', 45.00),
('Ourika-VILLE', 45.00),
('Outat El Haj', 45.00),
('QLIAA', 40.00),
('Rabat', 35.00),
('Ras El Ain', 45.00),
('Ras El Ma-FES', 45.00),
('RICHE-02', 45.00),
('RISSANI VILLE', 45.00),
('SAAIDIA', 45.00),
('SAFI', 40.00),
('Sale', 35.00),
('Sale El Jadida', 35.00),
('Sbaa Ayoune', 45.00),
('Sebt El Guerdane', 45.00),
('SEBT GZOULA', 45.00),
('SEBT MAARIF-EL Jadida', 45.00),
('SEFROU', 45.00),
('Settat', 40.00),
('SGANGAN', 40.00),
('Sid L Mokhtar', 45.00),
('Sid Zouine', 45.00),
('Sidi Abbad', 45.00),
('SIDI AISSA', 40.00),
('Sidi Ali', 45.00),
('Sidi Bennour', 45.00),
('Sidi Bou Othmane-VILLE', 45.00),
('Sidi Bouzid', 40.00),
('Sidi Chiker', 45.00),
('Sidi Ghiat', 45.00),
('Sidi Harazem', 45.00),
('Sidi Hrazem', 45.00),
('SIDI IFNI', 45.00),
('Sidi Jaber-Beni-Mellal', 40.00),
('SIDI KACEM', 40.00),
('Sidi Rahal', 45.00),
('SIDI SLIMAN', 45.00),
('Sidi Taibi', 45.00),
('SIDI YAHYA GHARB VILLE', 45.00),
('sidi zouine', 40.00),
('Sidi-Bibi', 45.00),
('Skhirat', 45.00),
('Skhour Rehamna', 45.00),
('Souihla-VILLE', 45.00),
('Souiria', 45.00),
('SOUK LARBAA', 45.00),
('Souk Sebt Oulad Nemma', 40.00),
('Taddart-taza', 45.00),
('Tafoughalt', 45.00),
('Tafraoute', 45.00),
('Taghazout', 45.00),
('TAGZIRT', 45.00),
('Tagzirt Beni-Mellal', 45.00),
('Tahanaout-VILLE', 45.00),
('Tahla', 45.00),
('TALIOUINE', 45.00),
('tamaait', 45.00),
('Tamansourt-Marrakech', 45.00),
('Tamaris', 45.00),
('Tamegroute-zagora', 45.00),
('Tamesluht- VILLE', 45.00),
('Tamesna', 45.00),
('Tamraght', 45.00),
('Tanger', 35.00),
('Tanougha-Beni Mellal', 45.00),
('TANTAN', 45.00),
('Taounate', 45.00),
('Taourirt', 45.00),
('Tarfaya', 45.00),
('targuist', 45.00),
('Taroudant', 45.00),
('Tassoultant-VILLE', 45.00),
('TAWJTAT', 45.00),
('Taza', 45.00),
('Tazarine', 45.00),
('Taznakht', 45.00),
('Temara', 35.00),
('Temsia-agadir', 45.00),
('TENANT BENI MELLAL', 45.00),
('Teroual - Ouazzane', 45.00),
('Tetouan', 45.00),
('Tiflet', 45.00),
('TIGHASLIN-BENI MELLAL', 45.00),
('Tikiouine', 45.00),
('Timoulilt', 40.00),
('Timoulilt-Beni Mellal', 45.00),
('Tin Mansour', 45.00),
('Tinejdad Ville', 45.00),
('Tinghir ville', 45.00),
('TIT MELLIL', 30.00),
('TIZNIT', 45.00),
('Tlet Bouguedra', 45.00),
('Tnine Chtouka', 45.00),
('Tnine Gharbia', 45.00),
('WALIDIYA', 45.00),
('Youssoufia', 45.00),
('Zag', 45.00),
('ZAGORA', 45.00),
('Zaida', 45.00),
('Zaouiat Cheikh', 45.00),
('Zaouit Sidi Smail', 45.00),
('zayou', 45.00),
('Zoumi-Ouazzane', 45.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entrer`
--
ALTER TABLE `entrer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `ville_price`
--
ALTER TABLE `ville_price`
  ADD PRIMARY KEY (`ville`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT pour la table `entrer`
--
ALTER TABLE `entrer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
