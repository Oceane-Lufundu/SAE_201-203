-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 01 août 2025 à 17:06
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae_203`
--

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id_materiel` int(11) NOT NULL,
  `reference_materiel` varchar(100) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `photo_url` text DEFAULT NULL,
  `type_materiel` varchar(100) DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `etat_global` enum('Très bon','Bon','En panne','En réparation') DEFAULT 'Bon',
  `quantite` int(11) NOT NULL DEFAULT 1,
  `descriptif` text DEFAULT NULL,
  `lien_demo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `resamateriel`
--

CREATE TABLE `resamateriel` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `numero_etudiant` int(11) NOT NULL,
  `email_universitaire` varchar(255) DEFAULT NULL,
  `date_reservation` date NOT NULL,
  `heure_remise` time DEFAULT NULL,
  `nom_projet` varchar(255) DEFAULT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `enseignant_responsable` varchar(255) DEFAULT NULL,
  `materiel` text DEFAULT NULL,
  `statut` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Déchargement des données de la table `resamateriel`
--

INSERT INTO `resamateriel` (`id`, `nom`, `prenom`, `numero_etudiant`, `email_universitaire`, `date_reservation`, `heure_remise`, `nom_projet`, `quantite`, `enseignant_responsable`, `materiel`, `statut`) VALUES
(1, 'Lufundu', 'Océane', 289746, 'oceane.lufundu@edu.univ-eiffel.fr', '2025-05-28', '14:01:00', 'sae202', 1, 'Peronne', 'PC de Bureau (1), Casque Oculus Quest 2 (1)', 'en attente');

>>>>>>> 946537cd9ce075bd170a43045118f8d4f8661557
-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int(11) NOT NULL,
  `id_utilisateurs` int(11) NOT NULL,
  `id_materiel` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `quantite_reservee` int(11) NOT NULL DEFAULT 1,
  `statut` enum('En attente','Validée','Refusée','Terminée') DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse_postale` text NOT NULL,
  `role` enum('étudiant','enseignant','agent','administrateur') NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
<<<<<<< HEAD
=======
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `pseudo`, `nom`, `prenom`, `date_naissance`, `adresse_postale`, `role`, `mot_de_passe`) VALUES
(3, 'oceane.lufundu@edu.univ-eiffel.fr', 'Océane', 'Lufundu', 'Océane', '2003-06-23', '12 Rue Robert Schuman', 'enseignant', '$2y$10$G6gzYOespY9dkt/gGfLRl.yfeQogSXnu0j6lB68ZrSX.CYd5Ji0wC'),
(4, 'lufundu.oceane@gmail.com', 'Océane', 'Lufundu', 'Océane', '2003-06-23', '12 Rue Robert Schuman', 'agent', '$2y$10$8d/lTKNpxeiYazXLhHYCJuYLKu1bEOid6pE87Eb8pP6mfLOsaIxdG'),
(5, 'oceane.lfnd@gmail.com', 'Océane', 'Lufundu', 'Océane', '2003-06-23', '12 Rue Robert Schuman', 'étudiant', '$2y$10$tEbiX3.b8VsJt3aaGAt1JOZflLZCMLqAqOxOOx7f08xbN3IAmzL.2'),
(6, 'lenygerance@gmail.com', 'Babe', 'Gérance', 'Lény', '2003-11-27', '33 rue xavier bichard', 'enseignant', '$2y$10$TGfLr5WEBLKcVcHWsXqn2O/bVlFdkInjCHvBr9L6/sxlQIdCDKRIa'),
(7, 'oceanelufundu@hotmail.com', 'Babe', 'Lufundu', 'Océane', '2003-06-23', '12 Rue Robert Schuman', 'administrateur', '$2y$10$S90QOdwQWqqxr4JEHhaosOkU5S3njAfXnkvWPwuY2Gf1hTVCpJmkO');

--
>>>>>>> 946537cd9ce075bd170a43045118f8d4f8661557
-- Index pour les tables déchargées
--

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id_materiel`);

--
-- Index pour la table `resamateriel`
--
ALTER TABLE `resamateriel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_materiel` (`id_materiel`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id_materiel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `resamateriel`
--
ALTER TABLE `resamateriel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_materiel`) REFERENCES `materiel` (`id_materiel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
