-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 31 oct. 2022 à 20:40
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garage`
--
CREATE DATABASE IF NOT EXISTS `garage` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `garage`;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221028205616', '2022-10-28 20:56:33', 130);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

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
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `voiture_id_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`id`, `voiture_id_id`, `file`, `caption`) VALUES
(30, 144, 'https://prod.pictures.autoscout24.net/listing-images/ea4b46e1-47f4-4cb0-b58f-bf7e9b069254_2572efd1-9fa0-4caa-abcf-fcc841fe5fb5.jpg/720x540.webp', 'voiture'),
(31, 144, 'https://prod.pictures.autoscout24.net/listing-images/ea4b46e1-47f4-4cb0-b58f-bf7e9b069254_5c4b99e1-6a29-4333-857e-65d9890688ae.jpg/720x540.webp', 'voiture'),
(32, 144, 'https://prod.pictures.autoscout24.net/listing-images/ea4b46e1-47f4-4cb0-b58f-bf7e9b069254_e34054cf-96b9-4116-9a3a-28b6b466ab55.jpg/720x540.webp', 'voiture'),
(33, 145, 'https://prod.pictures.autoscout24.net/listing-images/0a63678d-1ab2-4496-befa-83703d79c15d_1aba82b2-2466-40e4-bfba-c9729b496e36.jpg/1280x960.webp', 'voiture'),
(34, 145, 'https://prod.pictures.autoscout24.net/listing-images/0a63678d-1ab2-4496-befa-83703d79c15d_8a071719-5d9a-43dd-987f-d8cd7a56416e.jpg/1280x960.webp', 'voiture'),
(35, 145, 'https://prod.pictures.autoscout24.net/listing-images/0a63678d-1ab2-4496-befa-83703d79c15d_489fa355-66d9-43e1-9f77-1607e4cf38f4.jpg/1280x960.webp', 'voiture'),
(36, 146, 'https://prod.pictures.autoscout24.net/listing-images/87870074-844a-4a76-9b7e-a6338dcb7216_1ce42ed6-a7ed-455e-b4d3-5d27a680a168.jpg/720x540.webp', 'voiture'),
(37, 146, 'https://prod.pictures.autoscout24.net/listing-images/87870074-844a-4a76-9b7e-a6338dcb7216_9c4b22b1-5a8d-4a2e-86d3-50520c4b8aaa.jpg/720x540.webp', 'voiture'),
(38, 147, 'https://prod.pictures.autoscout24.net/listing-images/b7104180-b58b-423e-ad2c-0b5caa2262e5_c2d53903-d3de-4646-91ff-8c4ae7a9d4df.jpg/720x540.webp', 'voiture'),
(39, 147, 'https://prod.pictures.autoscout24.net/listing-images/b7104180-b58b-423e-ad2c-0b5caa2262e5_7d9b4758-e967-4b4b-8c1a-55e39f11fee5.jpg/720x540.webp', 'voiture'),
(40, 148, 'https://prod.pictures.autoscout24.net/listing-images/2409d9c5-9a85-409e-862e-6a68b974702b_a2fe1d95-5e93-41ed-b8ef-2346e0f79377.jpg/1280x960.webp', 'voiture'),
(41, 148, 'https://prod.pictures.autoscout24.net/listing-images/2409d9c5-9a85-409e-862e-6a68b974702b_882a6c98-2b9c-4a8d-aec4-e47d71e24dcc.jpg/1280x960.webp', 'voiture'),
(42, 148, 'https://prod.pictures.autoscout24.net/listing-images/2409d9c5-9a85-409e-862e-6a68b974702b_52110e9c-764d-4f35-9a18-b938cf1fca5c.jpg/1280x960.webp', 'voiture'),
(43, 148, 'https://prod.pictures.autoscout24.net/listing-images/2409d9c5-9a85-409e-862e-6a68b974702b_4edebf35-3a17-4abb-8ca8-19c99c2e8ef8.jpg/1280x960.webp', 'voiture'),
(44, 149, 'https://prod.pictures.autoscout24.net/listing-images/1c5b4674-072b-4fa0-92b5-e1c638d26cad_c0f64fcd-25b6-45e6-8ca4-1dc65451cfea.jpg/1280x960.webp', 'voiture'),
(45, 149, 'https://prod.pictures.autoscout24.net/listing-images/1c5b4674-072b-4fa0-92b5-e1c638d26cad_3e8002a9-d278-4051-b67c-72094d6798a0.jpg/1280x960.webp', 'voiture'),
(46, 149, 'https://prod.pictures.autoscout24.net/listing-images/1c5b4674-072b-4fa0-92b5-e1c638d26cad_a3fd8798-1d2f-4d94-a591-bb77c7d6cfbb.jpg/1280x960.webp', 'voiture');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `km` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `nb_proprio` int(11) NOT NULL,
  `cylindree` int(11) NOT NULL,
  `puissance` int(11) NOT NULL,
  `carburant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `transmission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `modele`, `image`, `km`, `prix`, `nb_proprio`, `cylindree`, `puissance`, `carburant`, `annee`, `transmission`, `description`, `options`, `slug`) VALUES
(144, 'Austin-Healey 3000', 'Mk 2IIa', '207980-63601db467efc.jpg', 37500, 53500, 2, 2970, 136, 'Essence', 1963, 'manuelle', 'Austin Healey Mk2A van 1963 in zeer goede staat.  Auto is in de laatste 4 jaar ge-upgraded met volgende opties :  nieuwe zwarte velgen en banden, nieuwe versnellingsbak (5-bak : zie foto), nieuwe uitlaat (zie foto), nieuw stuur Moto-lita, electrische fan, nieuwe alternator (2022), gereviseerde motor + carbu, verstralers en overriders, vering Dennis Welsh. Interieur en dak als nieuw. uitvoering in DHC, dus met draairuiten en makkelijk cabriodak.', 'Voiture rouge, cabriolet, ancêtre, 2 portes', 'austin-healey-3000mk-2iia37500'),
(145, 'Buick Electra', 'Auction', 'voiture2-63601ee23b12b.png', 30000, 13500, 2, 6500, 325, 'Essence', 1961, 'Automatique', 'The car was repainted by the previous owner in the correct Cordovan and features a contrasting cream color on the top and rear cove. While bright rocker trim and the four Ventiports on the front fenders were carried over for the 1961 redesign, changes to the second generation included shrunken tail fins. The interior remains unrestored according to the seller and is finished in 732 Fawn upholstery with light brown carpet. Interior features include Buick’s “Mirrormatic” speedometer, where the speedometer is reflected into an adjustable mirror that could be angled for the best visibility. All interior items and controls are said to be working order, including the odometer which shows 30,751 miles.', 'pas d\'options spécifiques', 'buick-electraauction30000'),
(146, 'Oldtimer De Soto', 'Firesweep Sportsman Sedan', 'voiture3-63601fd607df1.png', 61865, 25000, 3, 1230, 295, 'Essence', 1959, 'Automatique', 'The car was repainted by the previous owner in the correct Cordovan and features a contrasting cream color on the top and rear cove. While bright rocker trim and the four Ventiports on the front fenders were carried over for the 1961 redesign, changes to the second generation included shrunken tail fins. The interior remains unrestored according to the seller and is finished in 732 Fawn upholstery with light brown carpet. Interior features include Buick’s “Mirrormatic” speedometer, where the speedometer is reflected into an adjustable mirror that could be angled for the best visibility. All interior items and controls are said to be working order, including the odometer which shows 30,751 miles.', 'Beige, blanc, citadine, 6 sièges , 4 portes', 'oldtimer-de-sotofiresweep-sportsman-sedan61865'),
(147, 'Volvo', 'P1800', 'voiture4-6360215e52bfc.png', 190000, 13500, 3, 1200, 116, 'Essence', 1962, 'Manuelle', 'The car was repainted by the previous owner in the correct Cordovan and features a contrasting cream color on the top and rear cove. While bright rocker trim and the four Ventiports on the front fenders were carried over for the 1961 redesign, changes to the second generation included shrunken tail fins. The interior remains unrestored according to the seller and is finished in 732 Fawn upholstery with light brown carpet. Interior features include Buick’s “Mirrormatic” speedometer, where the speedometer is reflected into an adjustable mirror that could be angled for the best visibility. All interior items and controls are said to be working order, including the odometer which shows 30,751 miles.', 'Beige, coupé, 2 sièges, 2 portes', 'volvop1800190000'),
(148, 'Alpine A110', '1600SX - One of the last 50 produced’', 'voiture5-636022b711713.png', 7250, 124900, 5, 1647, 95, 'Essence', 1977, 'Manuelle', 'The car was repainted by the previous owner in the correct Cordovan and features a contrasting cream color on the top and rear cove. While bright rocker trim and the four Ventiports on the front fenders were carried over for the 1961 redesign, changes to the second generation included shrunken tail fins. The interior remains unrestored according to the seller and is finished in 732 Fawn upholstery with light brown carpet. Interior features include Buick’s “Mirrormatic” speedometer, where the speedometer is reflected into an adjustable mirror that could be angled for the best visibility. All interior items and controls are said to be working order, including the odometer which shows 30,751 miles.', 'Alpine blue, cuir partiel , 5 vitesses, 790kg, 2 siège', 'alpine-a1101600sx-one-of-the-last-50-produced-7250'),
(149, 'Ford Fairlane', '500-6', 'voiture6-636023d1eaaf0.png', 75000, 18000, 2, 3700, 223, 'Essence', 1958, 'Manuelle', 'The car was repainted by the previous owner in the correct Cordovan and features a contrasting cream color on the top and rear cove. While bright rocker trim and the four Ventiports on the front fenders were carried over for the 1961 redesign, changes to the second generation included shrunken tail fins. The interior remains unrestored according to the seller and is finished in 732 Fawn upholstery with light brown carpet. Interior features include Buick’s “Mirrormatic” speedometer, where the speedometer is reflected into an adjustable mirror that could be angled for the best visibility. All interior items and controls are said to be working order, including the odometer which shows 30,751 miles.', 'GRis, intérieur tissu', 'ford-fairlane500-675000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F7C2FC052E93BA0` (`voiture_id_id`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `FK_8F7C2FC052E93BA0` FOREIGN KEY (`voiture_id_id`) REFERENCES `voitures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
