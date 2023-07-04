-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 02 juil. 2023 à 16:42
-- Version du serveur : 8.0.33-0ubuntu0.22.04.2
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lowcost`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int NOT NULL,
  `nomClient` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `prenomClient` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `idHistorique` int NOT NULL,
  `dateHistorique` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descriptionHistorique` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`idHistorique`, `dateHistorique`, `descriptionHistorique`, `id_user`) VALUES
(4, '2023-07-02 14:48:47', 'A jouter le produit Carotte qui coute 500', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int NOT NULL,
  `nomProduit` text COLLATE utf8mb4_general_ci NOT NULL,
  `prixAchat` int NOT NULL,
  `prixVente` int NOT NULL,
  `quantiteProduit` int NOT NULL DEFAULT '0',
  `descriptionProduit` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `nomProduit`, `prixAchat`, `prixVente`, `quantiteProduit`, `descriptionProduit`) VALUES
(1, 'Chocolat2', 3000, 4000, 1, 'Chococolat de chez chocolat\"'),
(3, 'Carotte', 100, 500, 10, 'Des carottes bio et frais sorti de l\'office du niger'),
(4, 'Savon', 400, 500, 10, 'Savon belle ivoire');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int NOT NULL,
  `nomUser` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `prenomUser` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `nomUser`, `prenomUser`, `login`, `mdp`, `role`) VALUES
(3, 'diakite', 'maimouna', 'mai', 'mai', 'admin'),
(4, 'bore', 'younouss', 'bore', '123456', 'admin'),
(5, 'la mytho', 'awa', 'awa', 'awa', 'employer');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `idVente` int NOT NULL,
  `dateVente` datetime DEFAULT CURRENT_TIMESTAMP,
  `montantVente` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_client` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `venteProduit`
--

CREATE TABLE `venteProduit` (
  `idVenteProduit` int NOT NULL,
  `quantiteVenteProduit` int NOT NULL,
  `id_vente` int NOT NULL,
  `id_produit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`idHistorique`),
  ADD KEY `historique_ibfk_1` (`id_user`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`idVente`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `vente_ibfk_1` (`id_client`);

--
-- Index pour la table `venteProduit`
--
ALTER TABLE `venteProduit`
  ADD PRIMARY KEY (`idVenteProduit`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_vente` (`id_vente`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `idHistorique` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `idVente` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `venteProduit`
--
ALTER TABLE `venteProduit`
  MODIFY `idVenteProduit` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Contraintes pour la table `venteProduit`
--
ALTER TABLE `venteProduit`
  ADD CONSTRAINT `venteProduit_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venteProduit_ibfk_2` FOREIGN KEY (`id_vente`) REFERENCES `vente` (`idVente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
