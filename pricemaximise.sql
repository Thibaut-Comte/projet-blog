-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 déc. 2018 à 15:32
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pricemaximise`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_497DD6345E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(10, 'alimentaire'),
(13, 'divers'),
(11, 'électronique'),
(12, 'informatique'),
(14, 'ménager');

-- --------------------------------------------------------

--
-- Structure de la table `character`
--

DROP TABLE IF EXISTS `character`;
CREATE TABLE IF NOT EXISTS `character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_born` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_937AB034989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `character`
--

INSERT INTO `character` (`id`, `firstname`, `lastname`, `dt_born`, `image`, `slug`) VALUES
(3, 'Steven', 'Spielberg', '1946-12-18 00:00:00', '30e1e30ae2ae3a3d44b896243bf2e2b3.jpeg', 'spielberg-steven'),
(4, 'Besson', 'Luc', '1959-03-18 00:00:00', 'f2200637c588de57c4445b36cad5ac26.jpeg', 'luc-besson'),
(5, 'Olivia', 'Cooke', '1993-12-27 00:00:00', '06d2cbfb52d9336b1ca4d3c1aadc95e2.jpeg', 'cooke-olivia'),
(6, 'Tye', 'Sheridan', '1996-11-11 00:00:00', 'be90585d0e5632776820e868d60dcfdc.jpeg', 'sheridan-tye'),
(7, 'Jeff', 'Goldblum', '1952-10-22 00:00:00', '2c5282f511a183578eb359444702d03b.jpeg', 'goldblum-jeff'),
(8, 'Sam', 'Neill', '1947-09-14 00:00:00', '07955c9a6d311cb68e7703fa90fa7e49.jpeg', 'neill-sam'),
(9, 'Céline', 'Tran', '1979-04-09 00:00:00', '573f45fdc90544084f5484ad049370e2.jpeg', 'tran-celine'),
(10, 'Manuel', 'Ferrara', '1898-01-01 00:00:00', '4ab74babbaa6997a1abcc684d333c7df.jpeg', 'ferrara-manuel'),
(11, 'David', 'Crane', '1957-08-13 00:00:00', '2a2e17124f66703bbff2d00abaa21f08.jpeg', 'crane-david'),
(12, 'Jennifer', 'Aniston', '1969-02-11 00:00:00', '5c55086bfab784851f518755e965ef75.jpeg', 'aniston-jennifer'),
(13, 'Matthew', 'Perry', '1969-08-19 00:00:00', '8e538a9e81fb1931391359c8bf8adcee.jpeg', 'perry-matthew'),
(14, 'Gale Anne', 'Hurd', '1954-10-25 00:00:00', '96489117bc13f3035911ce8d0b8bfd8e.jpeg', 'hurd-gale-anne'),
(15, 'Andrew', 'Lincoln', '1973-09-14 00:00:00', '1cb61ee134b9a50706bd2d2e1c9e74d5.jpeg', 'lincoln-andrew'),
(16, 'Norman', 'Reedus', '1969-01-06 00:00:00', '325b67e9d143ad2f81d5a8bbc5b96747.jpeg', 'reedus-norman');

-- --------------------------------------------------------

--
-- Structure de la table `character_profession`
--

DROP TABLE IF EXISTS `character_profession`;
CREATE TABLE IF NOT EXISTS `character_profession` (
  `character_id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  PRIMARY KEY (`character_id`,`profession_id`),
  KEY `IDX_B1FB4EF1136BE75` (`character_id`),
  KEY `IDX_B1FB4EFFDEF8996` (`profession_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `character_profession`
--

INSERT INTO `character_profession` (`character_id`, `profession_id`) VALUES
(3, 2),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(14, 2),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Structure de la table `character_video`
--

DROP TABLE IF EXISTS `character_video`;
CREATE TABLE IF NOT EXISTS `character_video` (
  `character_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`character_id`,`video_id`),
  KEY `IDX_82043D4E1136BE75` (`character_id`),
  KEY `IDX_82043D4E29C1004E` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526C4584665A` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `text`, `date`, `product_id`) VALUES
(17, 5, 'Je suis intéressé, pouvez vous me contacter ?', '2018-12-04 09:41:34', 10),
(19, 2, 'Vraiment satisfait, je recommande !', '2018-12-04 09:55:23', 15),
(20, 2, 'Tiago, vous avez là une merveille, j\'aimerais savoir si le prix pourrait être négocier.', '2018-12-04 09:55:58', 17),
(21, 5, 'Bien-sûr, contactez moi dès maintenant !', '2018-12-04 09:56:44', 17),
(22, 3, 'Il me semble la reconnaître, comment s\'appeler votre cousin ?', '2018-12-04 09:57:52', 11);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Fantastique');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045F67B3B43D` (`users_id`),
  KEY `IDX_C53D045F6C8A81A9` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `date` datetime NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADF675F31B` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `date`, `author_id`, `image`) VALUES
(10, 'F22 - Raptor', 'Vends F22 Raptor très bon état ayant très peu servis. N\'a servi à l\'élimination que de deux villages. Pas sérieux s\'abstenir.', 25000000.5, '2018-12-04 09:24:49', 1, '0d0d71b97af806c6b3ac3920682ba49f.jpeg'),
(11, 'Moissonneuse batteuse', 'Vends moissonneuse batteuse. Hériter de mon vieux cousin éloigné. Prix à débattre.', 25000, '2018-12-04 09:26:22', 2, '5a6295c659f9287cfb2b757ecff739e5.jpeg'),
(12, 'PC GAMER', 'Vends PC Gamer toute dernière génération, fait tourné les derniers jeux en full hd ultra.', 2000, '2018-12-04 09:30:28', 3, 'c13bc1209288a4a1ddde189bd8864a6c.jpeg'),
(13, 'Ordinateur de bureau', 'Vends pc peu performant. Jouer au démineur reste possible.', 500, '2018-12-04 09:31:45', 3, '207ded4e28b33913afdba5f115f3edb6.jpeg'),
(14, 'Calgon', 'Les lavages dur plus longtemps avec calgon !', 20, '2018-12-04 09:33:04', 3, '7dac7bde4d95cf29ea7f580fbf0331c3.jpeg'),
(15, 'AJAX', 'Pour éliminer les taches tenaces, rien de mieux qu\'un bon AJAX !', 50, '2018-12-04 09:35:47', 4, 'e1a744bef85dbce5bcda94a1f1307fb2.jpeg'),
(16, 'Blender', 'Blender dernière génération. Attention ne pas mettre les doigts, il est tranchant, vous pouvez me croire.', 17, '2018-12-04 09:37:27', 4, 'c815e0ce13f3ab8b29f7ef59b738d5be.jpeg'),
(17, 'Balais Connecté', 'Balais connecté. Peut être utilisé depuis n\'importe où grâce aux nouvelles technologies. Avec sa caméra intégrée, aucune poussière ne vous échappera.', 250, '2018-12-04 09:39:22', 5, '00b5f7510f9049e478f022a13cc4315e.jpeg'),
(18, 'Chips Lays', '80% d\'air pour 20% de chips ! Que demande le peuple ??', 13, '2018-12-04 09:53:43', 2, '8ffcc0a06a336d4a9225e5686e349741.jpeg'),
(19, 'Ice Tea Pêche', 'Bouteille de contenance d\'1L.', 6, '2018-12-04 09:54:20', 2, 'd86617a75f71cbaeb5d1cbfa4e4e9aa2.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `product_categorie`
--

DROP TABLE IF EXISTS `product_categorie`;
CREATE TABLE IF NOT EXISTS `product_categorie` (
  `product_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`categorie_id`),
  KEY `IDX_27DD60B94584665A` (`product_id`),
  KEY `IDX_27DD60B9BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_categorie`
--

INSERT INTO `product_categorie` (`product_id`, `categorie_id`) VALUES
(10, 13),
(11, 13),
(12, 12),
(13, 12),
(14, 14),
(15, 14),
(16, 11),
(17, 11),
(18, 10),
(19, 10);

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

DROP TABLE IF EXISTS `profession`;
CREATE TABLE IF NOT EXISTS `profession` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profession`
--

INSERT INTO `profession` (`id`, `name`) VALUES
(1, 'Acteur'),
(2, 'Réalisateur');

-- --------------------------------------------------------

--
-- Structure de la table `project_user`
--

DROP TABLE IF EXISTS `project_user`;
CREATE TABLE IF NOT EXISTS `project_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B4021E51E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project_user`
--

INSERT INTO `project_user` (`id`, `password`, `email`, `first_name`, `last_name`, `role`, `image`, `is_delete`) VALUES
(1, '$2y$13$k/4RMak1OokbUO52VdXjyuWHM7tIGP35kqhYAQQ4p3XwJTPl4eH.G', 'admin@test.com', 'admin', 'admin', 'ROLE_ADMIN', '7efc60ccee38488af50a896718fe1f7e.jpeg', 0),
(2, '$2y$13$fA8ss9HcG9oB23oiCA0VeOqZDtNvkLtMQE9ub75Vbdsa5rl3TZI1u', 'tibo@gmail.com', 'Thibaut', 'Comte', 'ROLE_USER', '9520798248a38935c3026f1817826ed4.jpeg', 0),
(3, '$2y$13$CTro1tdXqRPpj4bGmO.YPu/0rySzLjv6uuWbzkWGS5HhO7mYZHgj6', 'bidon@gmail.com', 'Bindon', 'Gama', 'ROLE_USER', '679a8c26b7c9c98f9dc9926453dc5b89.jpeg', 0),
(4, '$2y$13$7v021iqapHh74taJ/1Z2FeWC1iFA302TqbRa6plFNRpteh/fzv7RO', 'trop@russian.com', 'Pin', 'Pon', 'ROLE_USER', NULL, 0),
(5, '$2y$13$O3UJvlYVrSTxJG3Hx.j.5.e5eHSFMdXUhElj9T01i.ZnFrmV8CrP2', 'tiago@fernandes.com', 'Tiago', 'Fernandes', 'ROLE_USER', '9ddce30fb8bb556e45b1522b415bb7cc.jpeg', 0),
(6, '$2y$13$tSxsGUveZCzbcha.xwXUGeW40DuxQbzruyncR465C1zw9m8f/j6ge', 'test@test', 'test', 'test', 'ROLE_USER', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `dt_paid` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6117D13B29C1004E` (`video_id`),
  KEY `IDX_6117D13BA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Film'),
(2, 'Série');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_created` datetime NOT NULL,
  `dt_update` datetime NOT NULL,
  `dt_born` datetime NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `dt_created`, `dt_update`, `dt_born`, `roles`, `email`) VALUES
(1, 'Admin', 'Admin', 'Admin', '$2y$13$pq1oJRZtDL8veUjn5QXS/O.Ec8sepy/jRDUGh/db.z6R1P8.STY.m', '2018-12-03 00:00:00', '2018-12-04 14:45:35', '1990-12-02 00:00:00', 'ROLE_ADMIN', 'admin@hitema.fr'),
(2, 'User', 'User', 'user', '$2y$13$wN0RqTQIUPSH5AOrkWXoEum.mhg3qYIAHUGGlBM3XqULt76sCgZPi', '2018-12-03 00:00:00', '2018-12-04 15:23:41', '2016-12-02 00:00:00', 'ROLE_USER', 'user@hitema.fr');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_release` datetime NOT NULL,
  `dt_add` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `required_age` double DEFAULT NULL,
  `image` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7CC7DA2C989D9B62` (`slug`),
  KEY `IDX_7CC7DA2CC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `type_id`, `name`, `dt_release`, `dt_add`, `price`, `required_age`, `image`, `url_trailer`, `comment`, `slug`) VALUES
(11, 1, 'Ready Player One', '2018-03-29 00:00:00', '2018-12-04 14:54:35', 10, NULL, 'c391ddff4797b79e4e0b24712b4e3fe8.jpeg', 'https://www.youtube.com/v/oYGkAMHCOC4', 'En 2045, le monde est au bord du chaos. Les êtres humains se réfugient dans l\'OASIS, univers virtuel mis au point par le brillant et excentrique James Halliday. Avant de disparaître, celui-ci a décidé de léguer son immense fortune à quiconque découvrira l\'oeuf de Pâques numérique qu\'il a pris soin de dissimuler dans l\'OASIS. L\'appât du gain provoque une compétition planétaire.', 'ready-player-one-1'),
(12, 1, 'Jurassic Park', '1993-09-30 00:00:00', '2018-12-04 14:59:47', 10, 10, '9a553a023aee62d86a227986fa981d3f.jpeg', NULL, 'Ne pas réveiller le chat qui dort, c\'est ce que le milliardaire John Hammond aurait dû se rappeler avant de se lancer dans le clonage de dinosaures. C\'est à partir d\'une goutte de sang absorbée par un moustique fossilisé que John Hammond et son équipe ont réussi à faire renaître une dizaine d\'espèces de dinosaures.', 'jurassic-park'),
(13, 1, 'Orgy II : The XXX championship', '2012-01-01 00:00:00', '2018-12-04 15:05:51', 50, 18, '9ca60b0615bd28a8ff64833f7a36ca3c.jpeg', NULL, 'Orgy II : The XXX Championship - également commercialisé sous le titre L\'Orgie de Katsuni - est un film pornographique français réalisé par Max Candy, Katsuni et Manuel Ferrara sorti en 2012.', 'orgy-ii-the-xxx-championship'),
(14, 2, 'Friends', '1994-09-22 00:00:00', '2018-12-04 15:13:40', 15, NULL, '428fa5f3e3ea6a8bf4b795b0e78c3730.jpeg', NULL, 'Les péripéties de trois jeunes femmes et trois jeunes hommes new-yorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori.', 'friends'),
(15, 2, 'The Walking Dead', '2010-10-31 00:00:00', '2018-12-04 15:19:46', 20, 12, 'fd10793e2c4d73dcfd1fd78fab00f367.png', NULL, 'Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d\'hommes et de femmes mené par l\'officier Rick Grimes tente de survivre. Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde.', 'the-walking-dead');

-- --------------------------------------------------------

--
-- Structure de la table `videos_actors`
--

DROP TABLE IF EXISTS `videos_actors`;
CREATE TABLE IF NOT EXISTS `videos_actors` (
  `video_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  PRIMARY KEY (`video_id`,`character_id`),
  KEY `IDX_6D2C89D229C1004E` (`video_id`),
  KEY `IDX_6D2C89D21136BE75` (`character_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `videos_actors`
--

INSERT INTO `videos_actors` (`video_id`, `character_id`) VALUES
(11, 5),
(11, 6),
(12, 7),
(12, 8),
(13, 9),
(13, 10),
(14, 12),
(14, 13),
(15, 15),
(15, 16);

-- --------------------------------------------------------

--
-- Structure de la table `videos_filmmakers`
--

DROP TABLE IF EXISTS `videos_filmmakers`;
CREATE TABLE IF NOT EXISTS `videos_filmmakers` (
  `video_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  PRIMARY KEY (`video_id`,`character_id`),
  KEY `IDX_9862648D29C1004E` (`video_id`),
  KEY `IDX_9862648D1136BE75` (`character_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `videos_filmmakers`
--

INSERT INTO `videos_filmmakers` (`video_id`, `character_id`) VALUES
(11, 3),
(12, 3),
(13, 10),
(14, 11),
(15, 14);

-- --------------------------------------------------------

--
-- Structure de la table `video_genre`
--

DROP TABLE IF EXISTS `video_genre`;
CREATE TABLE IF NOT EXISTS `video_genre` (
  `video_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`video_id`,`genre_id`),
  KEY `IDX_C323A5A29C1004E` (`video_id`),
  KEY `IDX_C323A5A4296D31F` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video_genre`
--

INSERT INTO `video_genre` (`video_id`, `genre_id`) VALUES
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(14, 2),
(15, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `character_profession`
--
ALTER TABLE `character_profession`
  ADD CONSTRAINT `FK_B1FB4EF1136BE75` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B1FB4EFFDEF8996` FOREIGN KEY (`profession_id`) REFERENCES `profession` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `character_video`
--
ALTER TABLE `character_video`
  ADD CONSTRAINT `FK_82043D4E1136BE75` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_82043D4E29C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `project_user` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `project_user` (`id`),
  ADD CONSTRAINT `FK_C53D045F6C8A81A9` FOREIGN KEY (`products_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04ADF675F31B` FOREIGN KEY (`author_id`) REFERENCES `project_user` (`id`);

--
-- Contraintes pour la table `product_categorie`
--
ALTER TABLE `product_categorie`
  ADD CONSTRAINT `FK_27DD60B94584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_27DD60B9BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `FK_6117D13B29C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `FK_6117D13BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `videos_actors`
--
ALTER TABLE `videos_actors`
  ADD CONSTRAINT `FK_6D2C89D21136BE75` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6D2C89D229C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `videos_filmmakers`
--
ALTER TABLE `videos_filmmakers`
  ADD CONSTRAINT `FK_9862648D1136BE75` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9862648D29C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `video_genre`
--
ALTER TABLE `video_genre`
  ADD CONSTRAINT `FK_C323A5A29C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C323A5A4296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
