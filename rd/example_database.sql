-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 04 août 2024 à 14:54
-- Version du serveur : 10.11.8-MariaDB-cll-lve
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : ``
--

-- --------------------------------------------------------

--
-- Structure de la table `pro_categories`
--

CREATE TABLE `pro_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_ref` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pro_categories`
--

INSERT INTO `pro_categories` (`category_id`, `category_name`, `category_ref`) VALUES
(1, 'Stockage par clé USB', 'SKUSB'),
(2, 'Disque Dur Externe', 'SDE'),
(3, 'Double authentification par clé', 'DAUHTK'),
(4, 'Logiciel', 'SOFTW'),
(5, 'Armoire forte', 'ARMF');

-- --------------------------------------------------------

--
-- Structure de la table `pro_form`
--

CREATE TABLE `pro_form` (
  `form_id` int(11) NOT NULL,
  `form_reason` enum('empty','devis','infoProduct','infoService','contact','other') NOT NULL,
  `form_mark_choice` int(11) NOT NULL,
  `form_lastname` varchar(50) NOT NULL,
  `form_firstname` varchar(50) NOT NULL,
  `form_contact_email` varchar(50) NOT NULL,
  `form_company` varchar(50) NOT NULL,
  `form_message` varchar(500) NOT NULL,
  `form_date_send` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pro_imgs`
--

CREATE TABLE `pro_imgs` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(50) NOT NULL,
  `img_img` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pro_marks`
--

CREATE TABLE `pro_marks` (
  `mark_id` int(11) NOT NULL,
  `mark_name` varchar(50) NOT NULL,
  `mark_img` blob NOT NULL,
  `mark_desc` varchar(1500) NOT NULL,
  `solution_id` int(11) NOT NULL,
  `mark_alt` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pro_models`
--

CREATE TABLE `pro_models` (
  `model_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `model_img` mediumblob NOT NULL,
  `model_text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pro_products`
--

CREATE TABLE `pro_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_desc` varchar(3000) NOT NULL,
  `product_sub_desc` varchar(500) NOT NULL,
  `product_img_hero_1` longblob NOT NULL,
  `mark_id` int(11) NOT NULL,
  `product_doc` blob NOT NULL,
  `product_doc_link` varchar(100) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_fonct` varchar(3500) NOT NULL,
  `product_page_type` mediumint(9) NOT NULL,
  `product_alt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pro_product_moduls`
--

CREATE TABLE `pro_product_moduls` (
  `modul_id` int(11) NOT NULL,
  `modul_name` varchar(50) NOT NULL,
  `modul_title` varchar(100) NOT NULL,
  `modul_text` varchar(500) NOT NULL,
  `modul_bg_img` longblob NOT NULL,
  `modul_img` blob NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pro_product_qualites`
--

CREATE TABLE `pro_product_qualites` (
  `quality_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quality_title` varchar(150) NOT NULL,
  `quality_text` varchar(1500) NOT NULL,
  `quality_img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pro_solutions`
--

CREATE TABLE `pro_solutions` (
  `solution_id` int(11) NOT NULL,
  `solution_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pro_categories`
--
ALTER TABLE `pro_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `pro_form`
--
ALTER TABLE `pro_form`
  ADD PRIMARY KEY (`form_id`);

--
-- Index pour la table `pro_imgs`
--
ALTER TABLE `pro_imgs`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Index pour la table `pro_marks`
--
ALTER TABLE `pro_marks`
  ADD PRIMARY KEY (`mark_id`),
  ADD KEY `mark_id` (`mark_id`),
  ADD KEY `solution_id` (`solution_id`);

--
-- Index pour la table `pro_models`
--
ALTER TABLE `pro_models`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `pro_products`
--
ALTER TABLE `pro_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `mark_id` (`mark_id`),
  ADD KEY `product_category_id` (`product_category_id`);

--
-- Index pour la table `pro_product_moduls`
--
ALTER TABLE `pro_product_moduls`
  ADD PRIMARY KEY (`modul_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `pro_product_qualites`
--
ALTER TABLE `pro_product_qualites`
  ADD PRIMARY KEY (`quality_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `quality_img_id` (`quality_img_id`);

--
-- Index pour la table `pro_solutions`
--
ALTER TABLE `pro_solutions`
  ADD PRIMARY KEY (`solution_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pro_categories`
--
ALTER TABLE `pro_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pro_form`
--
ALTER TABLE `pro_form`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pro_imgs`
--
ALTER TABLE `pro_imgs`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pro_marks`
--
ALTER TABLE `pro_marks`
  MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pro_models`
--
ALTER TABLE `pro_models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pro_products`
--
ALTER TABLE `pro_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pro_product_moduls`
--
ALTER TABLE `pro_product_moduls`
  MODIFY `modul_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pro_product_qualites`
--
ALTER TABLE `pro_product_qualites`
  MODIFY `quality_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pro_solutions`
--
ALTER TABLE `pro_solutions`
  MODIFY `solution_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pro_marks`
--
ALTER TABLE `pro_marks`
  ADD CONSTRAINT `pro_marks_ibfk_1` FOREIGN KEY (`solution_id`) REFERENCES `pro_solutions` (`solution_id`);

--
-- Contraintes pour la table `pro_models`
--
ALTER TABLE `pro_models`
  ADD CONSTRAINT `pro_models_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `pro_products` (`product_id`);

--
-- Contraintes pour la table `pro_products`
--
ALTER TABLE `pro_products`
  ADD CONSTRAINT `pro_products_ibfk_1` FOREIGN KEY (`mark_id`) REFERENCES `pro_marks` (`mark_id`),
  ADD CONSTRAINT `pro_products_ibfk_2` FOREIGN KEY (`product_category_id`) REFERENCES `pro_categories` (`category_id`);

--
-- Contraintes pour la table `pro_product_moduls`
--
ALTER TABLE `pro_product_moduls`
  ADD CONSTRAINT `pro_product_moduls_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `pro_products` (`product_id`);

--
-- Contraintes pour la table `pro_product_qualites`
--
ALTER TABLE `pro_product_qualites`
  ADD CONSTRAINT `pro_product_qualites_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `pro_products` (`product_id`),
  ADD CONSTRAINT `pro_product_qualites_ibfk_2` FOREIGN KEY (`quality_img_id`) REFERENCES `pro_imgs` (`img_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
