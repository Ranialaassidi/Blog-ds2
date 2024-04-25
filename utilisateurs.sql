-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 avr. 2024 à 22:37
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `utilisateurs`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  `mail` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `mail`, `password`) VALUES
(2525, 'rania@gmail.com', 'rania123');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created_at`, `image_path`) VALUES
(1, '', '', '2024-04-18 18:15:51', NULL),
(39, 'Cuisine Palestinienne', 'Explorez les saveurs de la Palestine à travers cet article qui décrit les plats traditionnels palestiniens. De la musakhan au maqluba, en passant par les knafeh et les falafels, cet article offre un aperçu des ingrédients, des méthodes de cuisson et des histoires derrière ces plats emblématiques. Chaque plat est présenté dans son contexte culturel, fournissant un aperçu authentique de la vie quotidienne en Palestine.', '2024-04-24 17:18:50', ''),
(38, 'L\'histoire de la Palestine', 'Cet article offre un aperçu de l\'histoire riche et complexe de la Palestine, des temps anciens à nos jours. Il met en lumière les diverses civilisations qui ont habité cette région, les conflits historiques, et les moments marquants qui ont façonné son identité actuelle. Les points saillants incluent l\'époque ottomane, le mandat britannique, la création d\'Israël en 1948, et les récents développements dans les négociations de paix.', '2024-04-24 17:17:48', ''),
(40, 'Les défis contemporains de la Palestine', 'Cet article examine les problèmes actuels auxquels la Palestine est confrontée, y compris les tensions politiques, les enjeux de l\'eau et du territoire, et la situation économique difficile. Il aborde également les impacts de ces défis sur la vie quotidienne des Palestiniens, y compris l\'accès à l\'éducation et aux soins de santé, et explore les réponses de la communauté internationale à ces enjeux.', '2024-04-24 17:19:21', ''),
(47, 'The Ongoing Struggle in Palestine: Key Points', 'Palestine, located in the Middle East, includes parts of what is now Israel, the West Bank, and the Gaza Strip. Its history is marked by various rulers, from ancient civilizations to the Ottoman Empire, and most recently, British control after World War I.\r\n\r\nIn 1947, the United Nations proposed splitting the land into Jewish and Arab states, leading to the establishment of Israel in 1948 and triggering the Arab-Israeli War. Many Palestinians were displaced during this time, an event known as the Nakba.\r\n\r\nDecades of conflict followed, including wars and uprisings like the Intifadas. The Oslo Accords in the 1990s brought hope for peace, but tensions have continued.\r\n\r\nToday, Palestine faces ongoing challenges, including Israeli settlements in the West Bank and a blockade on the Gaza Strip, leading to significant humanitarian issues. The quest for a lasting peace remains elusive.\r\n\r\n\r\n\r\n\r\n\r\n', '2024-04-25 20:09:49', 'uploads/bebo.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`article_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `article_id`, `user_id`) VALUES
(1, 27, 55),
(2, 33, 11),
(3, 30, 11),
(4, 34, 11),
(5, 36, 11),
(6, 37, 11),
(7, 40, 1318),
(8, 40, 122),
(9, 44, 122),
(10, 45, 122);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `sender_id` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `sender_id` (`sender_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`sender_id`, `message`, `created_at`) VALUES
('<br />\r\n<font size=\'1\'><table ', 'vbfx', '2024-04-24 13:32:52'),
('<br />\r\n<font size=\'1\'><table ', 'vbfx', '2024-04-24 13:33:28'),
('<br />\r\n<font size=\'1\'><table ', 'bbbbb', '2024-04-24 13:33:40'),
('<br />\r\n<font size=\'1\'><table ', 'bbbbb', '2024-04-24 13:44:48'),
('<br />\r\n<font size=\'1\'><table ', 'bbbbb', '2024-04-24 13:51:40'),
('<br />\r\n<font size=\'1\'><table ', 'bbbbb', '2024-04-24 13:51:50'),
('<br />\r\n<font size=\'1\'><table ', 'bebe', '2024-04-24 13:53:21'),
('<br />\r\n<font size=\'1\'><table ', 'bebe', '2024-04-24 13:54:34'),
('<br />\r\n<font size=\'1\'><table ', 'bebe', '2024-04-24 13:54:55'),
('<br />\r\n<font size=\'1\'><table ', 'bebe', '2024-04-24 13:56:14'),
('<br />\r\n<font size=\'1\'><table ', 'bebe', '2024-04-24 13:56:41'),
('11', 'toto', '2024-04-24 14:35:41'),
('1318', 'hello', '2024-04-24 17:22:47'),
('1318', 'how are you ', '2024-04-24 17:23:04'),
('122', 'azouzti', '2024-04-25 19:41:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL,
  `mail` varchar(30) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `password`) VALUES
(3030, 'gvbhj@gmail.com', '1478'),
(4141, 'rourou@gmail.com', '$2y$10$wXPzJSSy/RpjnLbUVjVJ8u.'),
(1212, 'bechir@gmail.com', '$2y$10$U0w60s1kogAiflr21gqw9ut'),
(741, 'ranialaassidi@gmail.com', '$2y$10$mb1cWtb5/VJ4GmBY7BNICuw'),
(1515, 'bb@gmail.com', '$2y$10$8qkx4T.Tgk0k5iLyQM18reD'),
(456, 'rania@gmail.com', '$2y$10$vPa79J9yVy5bjs7ztzJ5P.s'),
(888, 'imen@gmail.com', '$2y$10$H6h90xVFHPQuDvvCgdaeNOn'),
(1414, 'ranya@gmail.com', '$2y$10$GLtJ3vWp4OKfuz3cZG97a.W'),
(15155, 'roro@gmail.com', '$2y$10$6/lxnbcXjYt2Qku9F2bUVe2'),
(1714, 'ranyaa@gmail.com', '$2y$10$2hHlo8LtbrkqgVY36JBLTOm'),
(123, 'Adamjoba@gmail.com', 'Adam'),
(4444, 'haha@gmail.com', '$2y$10$rdATvWJU1w1ITog.BnA2K.z'),
(7, 'kaka@gmail.com', '$2y$10$Hxz7KoQatpUihom7mn5Xo.V'),
(71, 'kaka1@gmail.com', '$2y$10$G5Wk9gBKCiCMvmkZVKvAKelz.Nv4wlAh/bHMS.czhqTOtPGNYQbr.'),
(15, 'lala@gmail.com', '$2y$10$xKY5QTlv46.wW2CWzSFPh.hcuzWJpCVLBozSwdPN9T0wcoVr.7ney'),
(0, '00@gmail.com', '$2y$10$xbH/JAAjbd567tckfSiqDeR9r9VVz/jsSQNRFQxYuU5KHYJ7sTvkC'),
(55, 'zaza@gmail.com', '$2y$10$hHw2ta/PPKF50mPyuu3QW.bF0D7x/94PmlxTCrQofYrTyFc4/JeV6'),
(122, 'farah@gmail.com', '$2y$10$BfYXjcKYwq5.jn4jhjOa3uiRNOsS6.mki4awoWMtvt/F3o9byvKWC'),
(1318, 'raniaalaassidi@gmail.com', '$2y$10$.NzAD/TM/23vmxCse0MmcedPJzJYwqT.DQLLolPm0jjVSVG8Rmvjm'),
(1619, 'oussema@gmail.com', '1619'),
(1918, 'roroita@gmail.com', 'roro');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
