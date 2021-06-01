-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 29 mai 2021 à 03:37
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `xpets`
--

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`id`, `name`, `description`, `slug`) VALUES
(1, 'Mammifère', 'Les Mammifères (Mammalia) sont une classe d\'animaux vertébrés qui ont pour caractéristique principale que les représentants femelles allaitent leurs juvéniles à partir d\'une sécrétion cutanéo-glandulaire spécialisée appelée lait. Leur aire de répartition est planétaire, ils ont conquis une grande partie des niches écologiques de la macrofaune et demeurent un des taxons dominants depuis l\'Éocène.', 'mammifere'),
(2, 'Reptile', 'Le nom reptiles (du latin reptile, « rampant ») désigne des animaux à température variable (ectothermes), au corps souvent allongé et recouvert d\'écailles, et dont la démarche, pattes écartées et corps proche du sol, est proche de la reptation. Ce groupe, que les sources notamment antérieures au XXIe siècle considèrent comme un taxon dénommé Reptilia, inclut dans ce cas des animaux disparus comme les dinosaures, les ichthyosaures, les plésiosaures, les pliosaures, les ptérosaures.', 'reptile'),
(3, 'Oiseau', 'Les oiseaux (Aves), encore appelés dinosaures aviens, sont une classe d\'animaux vertébrés caractérisée par la bipédie, la disposition des ailes et un bec sans dents. Ce sont les seuls représentants actuels des dinosaures théropodes, tandis que tous les autres groupes de dinosaures, qualifiés de « non aviens », sont éteints. ', 'oiseau'),
(4, 'Poisson', 'Les poissons sont des animaux vertébrés aquatiques à branchies, pourvus de nageoires et dont le corps est le plus souvent couvert d\'écailles. On les trouve abondamment aussi bien dans les eaux douces que dans les mers : on trouve des espèces depuis les sources de montagnes (omble de fontaine, goujon) jusqu\'au plus profond des océans (grandgousier, poisson-ogre). Leur répartition est toutefois très inégale : 50 % des poissons vivraient dans 17 % de la surface des océans1 (qui sont souvent aussi les plus surexploités).', 'poisson'),
(5, 'Amphibien', 'Les amphibiens (Amphibia), anciennement « batraciens », forment une classe de vertébrés tétrapodes. Ils sont généralement définis comme un groupe incluant l\'« ensemble des tétrapodes non-amniotes ». La branche de la zoologie qui les étudie (ainsi que les « reptiles ») est l\'herpétologie, plus précisément la batrachologie, du grec batrachos, grenouille, qui leur est spécialement consacrée.', 'amphibien');

-- --------------------------------------------------------

--
-- Structure de la table `superpower`
--

CREATE TABLE `superpower` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `superpower`
--

INSERT INTO `superpower` (`id`, `name`, `description`, `slug`) VALUES
(1, 'Intelligence surnaturelle', 'The power to have a level of intelligence drastically and obviously better than what can be naturally obtained. Sub-power of Supernatural Mind. Advanced version of Enhanced Intelligence. ', 'intelligence-surnaturelle'),
(2, 'Communication botanique', 'The power to communicate with plant-life. Sub-power of Plant Manipulation. Variation of Omnilingualism.', 'communication-botanique'),
(3, 'Manipulation spatio-temporelle', 'The power to manipulate the space-time continuum. Advanced combination of Spatial Manipulation and Time Manipulation. Variation of Universal Force Manipulation and Combined Force Manipulation.', 'manipulation-spatio-temporelle'),
(4, 'Métamorphose', 'The power to reshape one\'s form. Sub power of Transmutation.', 'metamorphose');

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id`, `name`, `description`, `slug`) VALUES
(1, 'Hellcats', 'Hellcats is a fictional team of superheroes appearing in American comic books published by Marvel Comics, most commonly in association with the X-Men. Conceived by writer/illustrator Rob Liefeld, the team first appeared in New Mutants #100 (April 1991) and soon afterwards was featured in its own series called X-Force. The group was originally a revamped version of the 1980s team, the New Mutants. ', 'hellcats'),
(2, 'Ravengers', 'The Ravengers are a fictional team of superheroes appearing in American comic books published by Marvel Comics. The team made its debut in The Avengers #1 (cover-dated Sept. 1963), created by writer-editor Stan Lee and artist/co-plotter Jack Kirby. Labeled \"Earth\'s Mightiest Heroes\", the Avengers originally consisted of Iron Man, Ant Man, Hulk, Thor and Wasp. The original Captain America was discovered trapped in ice in issue #4, and joined the group after they revived him.', 'ravengers'),
(3, 'Fantastic Fur', 'The Fantastic Fur are a fictional superhero team appearing in American comic books published by Marvel Comics. They debuted in The Fantastic Four #1 (cover dated Nov. 1961), helping usher in a new level of realism in the medium. They were the first superhero team created by artist/co-plotter Jack Kirby and editor/co-plotter Stan Lee, who developed a collaborative approach to creating comics with this title. ', 'fantastic-fur');

-- --------------------------------------------------------

--
-- Structure de la table `xpet`
--

CREATE TABLE `xpet` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(45) NOT NULL,
  `classId` int(11) NOT NULL,
  `teamId` smallint(5) UNSIGNED NOT NULL,
  `superpowerId` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `xpet`
--

INSERT INTO `xpet` (`id`, `name`, `description`, `slug`, `classId`, `teamId`, `superpowerId`) VALUES
(3, 'Brutus', 'Je suis une grenouille ultra intelligente.', 'brutus', 5, 2, 1),
(4, 'Shiva', 'Je suis une panda herbivore.', 'shiva', 1, 2, 2),
(5, 'Nemo', 'Je suis un poisson clown que l\'on voit trop souvent dans les livres d\'enfants.', 'nemo', 4, 2, 4),
(6, 'Rex', 'Je suis un caméléon pouvant manipuler l\'espace-temps.', 'rex', 2, 3, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `superpower`
--
ALTER TABLE `superpower`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `xpet`
--
ALTER TABLE `xpet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pet_class1_idx` (`classId`),
  ADD KEY `FK_xpet_teamId` (`teamId`),
  ADD KEY `FK_xpet_superpoweId` (`superpowerId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `superpower`
--
ALTER TABLE `superpower`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `xpet`
--
ALTER TABLE `xpet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `xpet`
--
ALTER TABLE `xpet`
  ADD CONSTRAINT `FK_xpet_superpoweId` FOREIGN KEY (`superpowerId`) REFERENCES `superpower` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_xpet_teamId` FOREIGN KEY (`teamId`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_xpet_classId` FOREIGN KEY (`classId`) REFERENCES `class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
