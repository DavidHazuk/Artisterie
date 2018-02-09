-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 08 fév. 2018 à 22:02
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `artisterie`
--
CREATE DATABASE IF NOT EXISTS `artisterie` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `artisterie`;

-- --------------------------------------------------------

--
-- Structure de la table `t_event`
--

DROP TABLE IF EXISTS `t_event`;
CREATE TABLE `t_event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_event`
--

INSERT INTO `t_event` (`id`, `title`, `start`, `end`, `idUser`) VALUES
(3, 'Test1', '2018-02-10 11:00:00', '2018-02-10 13:00:00', 4),
(4, 'Test2', '2018-02-08 16:00:00', '2018-02-08 19:00:00', 4),
(5, 'Test3', '2018-02-10 11:00:00', '2018-02-10 17:00:00', 20),
(13, 'zerezrz', '2018-02-09 12:00:00', '2018-02-09 20:00:00', 4),
(27, 'teststudiodfgdfg', '2018-02-08 04:00:00', '2018-02-08 14:00:00', 35),
(29, 'teststudiozefzaze', '2018-02-09 08:00:00', '2018-02-09 12:00:00', 35),
(43, 'azeaze', '2018-02-10 09:00:00', '2018-02-10 11:00:00', 35),
(44, 'gzgzrr', '2018-02-07 10:00:00', '2018-02-07 14:00:00', 35),
(45, 'Test4', '2018-02-08 14:00:00', '2018-02-08 18:00:00', 17),
(46, 'zerzer', '2018-02-08 16:00:00', '2018-02-08 19:00:00', 13),
(47, 'arzr', '2018-02-09 18:00:00', '2018-02-09 20:00:00', 13);

-- --------------------------------------------------------

--
-- Structure de la table `t_group`
--

DROP TABLE IF EXISTS `t_group`;
CREATE TABLE `t_group` (
  `idGroup` int(11) NOT NULL,
  `txtGroupName` varchar(255) NOT NULL,
  `idRoom` int(11) DEFAULT NULL,
  `txtGroupImgPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_group`
--

INSERT INTO `t_group` (`idGroup`, `txtGroupName`, `idRoom`, `txtGroupImgPath`) VALUES
(1, 'NONSENSE', 2, NULL),
(2, 'ARCANE', 3, NULL),
(3, 'BURNING OLDIES', 3, NULL),
(4, 'LINGUS', 4, NULL),
(5, 'FOES AND DARLINGS', 4, NULL),
(6, 'TURNOVER', 4, NULL),
(7, 'Individuel 1', 4, NULL),
(8, 'Individuel 2', 2, NULL),
(14, 'pmacaro', 1, NULL),
(17, 'testavatar', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_news`
--

DROP TABLE IF EXISTS `t_news`;
CREATE TABLE `t_news` (
  `idnew` int(11) NOT NULL,
  `txtNewTitle` varchar(255) NOT NULL,
  `txtNewContent` text NOT NULL,
  `txtNewImgPath` varchar(255) DEFAULT NULL,
  `dtNewDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_news`
--

INSERT INTO `t_news` (`idnew`, `txtNewTitle`, `txtNewContent`, `txtNewImgPath`, `dtNewDate`) VALUES
(6, 'Masterclass du Youtubeur Canadien Etienne Tremblay de \"la machine à mixer\".', 'Célèbre Youtubeur canadien, Etienne Tremblay est passé par l\'Artisterie lors de sa tournée française de masterclass 2017. Le thème du workshop était : le traitement des sous-groupes en mixage. Pas moins d\'une quinzaine de personne ont fait le déplacement pour assister à ce cours qui fût très instructif, convivial et dépaysant au vue de l\'accent d\'Etienne !', '/upload/news/a4087dbd6a8fbe1142ebfcac7e93ce0d.jpeg', '2018-02-05 23:55:35'),
(7, 'Préproduction de l\'EP du groupe \"Nonsense\" : La batterie.', 'Au programme de ce Vendredi 26 Janvier, accordage de la batterie, choix des cymbales, travail sur la prise de son, en vue d\'obtenir le son désiré pour les prises définitives au Printemps 2018.', '/upload/news/b7de3d93f1d1f0e9aef7b247fb41dc35.jpeg', '2018-02-05 23:56:45'),
(8, 'Résidence du groupe \"Moods\"', 'Laïs et Denis ont fait une résidence d\'une journée au studio le Dimanche 3 Décembre 2017 pour travailler sur leur composition, en vue de la sortie d\'un EP courant 2019. Avec la précieuse aide de Sébastien qui ré-arrange, modifie et embellit les chansons du couple, l\'EP promet d\'être magnifique !', '/upload/news/6542d1e30ef9cd33f603b3af54ee4033.jpeg', '2018-02-05 23:57:11');

-- --------------------------------------------------------

--
-- Structure de la table `t_picture`
--

DROP TABLE IF EXISTS `t_picture`;
CREATE TABLE `t_picture` (
  `idPicture` int(11) NOT NULL,
  `txtPictureName` varchar(255) NOT NULL,
  `txtPictureThumbnailPath` varchar(500) NOT NULL,
  `txtPicturePath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_picture`
--

INSERT INTO `t_picture` (`idPicture`, `txtPictureName`, `txtPictureThumbnailPath`, `txtPicturePath`) VALUES
(1, '0001.jpg', '/upload/gallery/thumbnails/thumb0001.jpg', '/upload/gallery/0001.jpg'),
(2, '0002.jpg', '/upload/gallery/thumbnails/thumb0002.jpg', '/upload/gallery/0002.jpg'),
(3, '0003.jpg', '/upload/gallery/thumbnails/thumb0003.jpg', '/upload/gallery/0003.jpg'),
(4, '0004.jpg', '/upload/gallery/thumbnails/thumb0004.jpg', '/upload/gallery/0004.jpg'),
(5, '0005.jpg', '/upload/gallery/thumbnails/thumb0005.jpg', '/upload/gallery/0005.jpg'),
(6, '0006.jpg', '/upload/gallery/thumbnails/thumb0006.jpg', '/upload/gallery/0006.jpg'),
(7, '0007.jpg', '/upload/gallery/thumbnails/thumb0007.jpg', '/upload/gallery/0007.jpg'),
(8, '0008.jpg', '/upload/gallery/thumbnails/thumb0008.jpg', '/upload/gallery/0008.jpg'),
(9, '0009.jpg', '/upload/gallery/thumbnails/thumb0009.jpg', '/upload/gallery/0009.jpg'),
(10, '0010.jpg', '/upload/gallery/thumbnails/thumb0010.jpg', '/upload/gallery/0010.jpg'),
(11, '0011.jpg', '/upload/gallery/thumbnails/thumb0011.jpg', '/upload/gallery/0011.jpg'),
(12, '0012.jpg', '/upload/gallery/thumbnails/thumb0012.jpg', '/upload/gallery/0012.jpg'),
(13, '0013.jpg', '/upload/gallery/thumbnails/thumb0013.jpg', '/upload/gallery/0013.jpg'),
(14, '0014.jpg', '/upload/gallery/thumbnails/thumb0014.jpg', '/upload/gallery/0014.jpg'),
(15, '0015.jpg', '/upload/gallery/thumbnails/thumb0015.jpg', '/upload/gallery/0015.jpg'),
(16, '0016.jpg', '/upload/gallery/thumbnails/thumb0016.jpg', '/upload/gallery/0016.jpg'),
(17, '0017.jpg', '/upload/gallery/thumbnails/thumb0017.jpg', '/upload/gallery/0017.jpg'),
(18, '0018.jpg', '/upload/gallery/thumbnails/thumb0018.jpg', '/upload/gallery/0018.jpg'),
(19, '0019.jpg', '/upload/gallery/thumbnails/thumb0019.jpg', '/upload/gallery/0019.jpg'),
(20, '0020.jpg', '/upload/gallery/thumbnails/thumb0020.jpg', '/upload/gallery/0020.jpg'),
(21, '0021.jpg', '/upload/gallery/thumbnails/thumb0021.jpg', '/upload/gallery/0021.jpg'),
(22, '0022.jpg', '/upload/gallery/thumbnails/thumb0022.jpg', '/upload/gallery/0022.jpg'),
(23, '0023.jpg', '/upload/gallery/thumbnails/thumb0023.jpg', '/upload/gallery/0023.jpg'),
(24, '0024.jpg', '/upload/gallery/thumbnails/thumb0024.jpg', '/upload/gallery/0024.jpg'),
(25, '0025.jpg', '/upload/gallery/thumbnails/thumb0025.jpg', '/upload/gallery/0025.jpg'),
(26, '0026.jpg', '/upload/gallery/thumbnails/thumb0026.jpg', '/upload/gallery/0026.jpg'),
(27, '0027.jpg', '/upload/gallery/thumbnails/thumb0027.jpg', '/upload/gallery/0027.jpg'),
(28, '0028.jpg', '/upload/gallery/thumbnails/thumb0028.jpg', '/upload/gallery/0028.jpg'),
(29, '0029.jpg', '/upload/gallery/thumbnails/thumb0029.jpg', '/upload/gallery/0029.jpg'),
(30, '0030.jpg', '/upload/gallery/thumbnails/thumb0030.jpg', '/upload/gallery/0030.jpg'),
(31, '0031.jpg', '/upload/gallery/thumbnails/thumb0031.jpg', '/upload/gallery/0031.jpg'),
(32, '0032.jpg', '/upload/gallery/thumbnails/thumb0032.jpg', '/upload/gallery/0032.jpg'),
(33, '0033.jpg', '/upload/gallery/thumbnails/thumb0033.jpg', '/upload/gallery/0033.jpg'),
(34, '0034.jpg', '/upload/gallery/thumbnails/thumb0034.jpg', '/upload/gallery/0034.jpg'),
(35, '0035.jpg', '/upload/gallery/thumbnails/thumb0035.jpg', '/upload/gallery/0035.jpg'),
(36, '0036.jpg', '/upload/gallery/thumbnails/thumb0036.jpg', '/upload/gallery/0036.jpg'),
(37, '0037.jpg', '/upload/gallery/thumbnails/thumb0037.jpg', '/upload/gallery/0037.jpg'),
(38, '0038.jpg', '/upload/gallery/thumbnails/thumb0038.jpg', '/upload/gallery/0038.jpg'),
(39, '0039.jpg', '/upload/gallery/thumbnails/thumb0039.jpg', '/upload/gallery/0039.jpg'),
(40, '0040.jpg', '/upload/gallery/thumbnails/thumb0040.jpg', '/upload/gallery/0040.jpg'),
(41, '0041.jpg', '/upload/gallery/thumbnails/thumb0041.jpg', '/upload/gallery/0041.jpg'),
(42, '0042.jpg', '/upload/gallery/thumbnails/thumb0042.jpg', '/upload/gallery/0042.jpg'),
(43, '0043.jpg', '/upload/gallery/thumbnails/thumb0043.jpg', '/upload/gallery/0043.jpg'),
(44, '0044.jpg', '/upload/gallery/thumbnails/thumb0044.jpg', '/upload/gallery/0044.jpg'),
(45, '0045.jpg', '/upload/gallery/thumbnails/thumb0045.jpg', '/upload/gallery/0045.jpg'),
(46, '0046.jpg', '/upload/gallery/thumbnails/thumb0046.jpg', '/upload/gallery/0046.jpg'),
(47, '0047.jpg', '/upload/gallery/thumbnails/thumb0047.jpg', '/upload/gallery/0047.jpg'),
(48, '0048.jpg', '/upload/gallery/thumbnails/thumb0048.jpg', '/upload/gallery/0048.jpg'),
(49, '0049.jpg', '/upload/gallery/thumbnails/thumb0049.jpg', '/upload/gallery/0049.jpg'),
(50, '0050.jpg', '/upload/gallery/thumbnails/thumb0050.jpg', '/upload/gallery/0050.jpg'),
(51, '0051.jpg', '/upload/gallery/thumbnails/thumb0051.jpg', '/upload/gallery/0051.jpg'),
(52, '0052.jpg', '/upload/gallery/thumbnails/thumb0052.jpg', '/upload/gallery/0052.jpg'),
(53, '0053.jpg', '/upload/gallery/thumbnails/thumb0053.jpg', '/upload/gallery/0053.jpg'),
(54, '0054.jpg', '/upload/gallery/thumbnails/thumb0054.jpg', '/upload/gallery/0054.jpg'),
(55, '0055.jpg', '/upload/gallery/thumbnails/thumb0055.jpg', '/upload/gallery/0055.jpg'),
(56, '0056.jpg', '/upload/gallery/thumbnails/thumb0056.jpg', '/upload/gallery/0056.jpg'),
(57, '0057.jpg', '/upload/gallery/thumbnails/thumb0057.jpg', '/upload/gallery/0057.jpg'),
(58, '0058.jpg', '/upload/gallery/thumbnails/thumb0058.jpg', '/upload/gallery/0058.jpg'),
(59, '0059.jpg', '/upload/gallery/thumbnails/thumb0059.jpg', '/upload/gallery/0059.jpg'),
(60, '0060.jpg', '/upload/gallery/thumbnails/thumb0060.jpg', '/upload/gallery/0060.jpg'),
(61, '0061.jpg', '/upload/gallery/thumbnails/thumb0061.jpg', '/upload/gallery/0061.jpg'),
(62, '0062.jpg', '/upload/gallery/thumbnails/thumb0062.jpg', '/upload/gallery/0062.jpg'),
(63, '0063.jpg', '/upload/gallery/thumbnails/thumb0063.jpg', '/upload/gallery/0063.jpg'),
(64, '0064.jpg', '/upload/gallery/thumbnails/thumb0064.jpg', '/upload/gallery/0064.jpg'),
(65, '0065.jpg', '/upload/gallery/thumbnails/thumb0065.jpg', '/upload/gallery/0065.jpg'),
(66, '0066.jpg', '/upload/gallery/thumbnails/thumb0066.jpg', '/upload/gallery/0066.jpg'),
(67, '0067.jpg', '/upload/gallery/thumbnails/thumb0067.jpg', '/upload/gallery/0067.jpg'),
(68, '0068.jpg', '/upload/gallery/thumbnails/thumb0068.jpg', '/upload/gallery/0068.jpg'),
(69, '0069.jpg', '/upload/gallery/thumbnails/thumb0069.jpg', '/upload/gallery/0069.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `t_quote`
--

DROP TABLE IF EXISTS `t_quote`;
CREATE TABLE `t_quote` (
  `idQuote` int(11) NOT NULL,
  `txtQuote` varchar(255) NOT NULL,
  `txtAuthor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_quote`
--

INSERT INTO `t_quote` (`idQuote`, `txtQuote`, `txtAuthor`) VALUES
(1, 'The fact there\'s a highway to hell and only a stairway to heaven says a lot about anticipated traffic numbers.', ''),
(2, 'Don\'t forget that you never work for the machine, the machine works for you.', 'Quincy Jones'),
(3, 'One good thing about music, when it hits you, you feel no pain.', 'Bob Marley'),
(4, 'Where words fail, music speaks.', ''),
(5, 'I became a musician, so I don\'t have to get up at 6 in the morning.', 'Norah Jones'),
(6, 'Good music doesn\'t have an expiration date.', ''),
(7, 'Quand ta guitare est fausse, chante comme elle.', 'Kurt Cobain'),
(8, 'If you think you\'re too old to rock and roll, then you are !', 'Lemmy Kilmister'),
(9, 'I like my music\'s volume high enough to not hear you.', ''),
(10, 'When I was a little boy, I told my dad, \'When I grow up, I want to be a musician.\' My dad said: \'You can\'t do both, son\'.', 'Chet Atkins'),
(11, 'Let me be clear about this: I don\'t have a drug problem, I have a police problem.', 'Keith Richards'),
(12, 'Too many pieces of music finish too long after the end.', 'Igor Stravinsky'),
(13, 'I can\'t understand why people are frightened of new ideas. I\'m frightened of the old ones.', 'John Cage'),
(14, 'I smash guitars because I like them.', 'Pete Townshend'),
(15, 'I\'m sick to death of people saying we\'ve made 11 albums that sound exactly the same. In fact, we\'ve made 12 albums that sound exactly the same.', 'Angus Young'),
(16, 'Do it again on the next verse, and people think you meant it.', 'Chet Atkins'),
(17, 'Talking about music is like dancing about architecture.', 'Steve Martin'),
(18, 'A gentleman is someone who can play the accordion, but doesn\'t.', 'Tom Waits'),
(19, 'I\'ve been imitated so well I\'ve heard people copy my mistakes.', 'Jimi Hendrix'),
(20, 'Do I listen to pop music because I\'m miserable or am I miserable because I listen to pop music ?', 'John Cusack'),
(21, 'Brass bands are all very well in their place: outdoor and several miles away.', 'Sir Thomas Beecham'),
(22, 'I may not be a first-rate composer, but I am a first-class second-rate composer.', 'Richard Strauss'),
(23, 'Life\'s a bitch and so am I !', 'Pete Townshend'),
(24, 'Singing in the shower is all fun and games until you get shampoo in your mouth, then it just becomes a soap opera.', ''),
(25, 'One of the best recording techniques I know is to say, \'I meant to do that\'.', 'Mark Rubel'),
(26, 'My old rule when I had a studio was if you can\'t afford one good mic, use three crappy ones instead.', 'Nic Collins'),
(27, 'I won\'t be a rock star. I will be a legend.', 'Jimi Hendrix'),
(28, 'If it\'s illegal to rock and roll, throw my ass in jail !', 'Kurt Cobain'),
(29, 'When I die, just keep playing the records.', 'Jimi Hendrix'),
(30, 'Blues is easy to play, but hard to feel.', 'Jimi Hendrix'),
(31, 'Some of the worst mistakes of my life have been haircuts.', 'Jim Morrison'),
(32, 'The first time I performed musically, I threw up.', 'Marilyn Manson'),
(33, 'Inspiration is hard to come by. You have to take it where you find it.', 'Bob Dylan'),
(34, 'I don\'t dance, I headbang !', ''),
(35, 'I don\'t always listen to Metallica, but when i do, nothing else matters.', ''),
(36, 'Headphones on. World off.', ''),
(37, 'Monday needs a double dose of coffee and a triple dose of metal.', ''),
(38, 'Without music, life would be a mistake.', 'Friederich Nietzsche'),
(39, 'Heavy metal would not exist without Led Zeppelin, and if it did. It would suck.', 'Dave Grohl'),
(40, 'If someday we all go to prison for illegally downloading music, I just hope they split us by genre.', '');
-- --------------------------------------------------------

--
-- Structure de la table `t_room`
--

DROP TABLE IF EXISTS `t_room`;
CREATE TABLE `t_room` (
  `idRoom` int(11) NOT NULL,
  `txtRoomName` varchar(255) NOT NULL,
  `txtRoomColor` varchar(10) NOT NULL,
  `bRoomStudio` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_room`
--

INSERT INTO `t_room` (`idRoom`, `txtRoomName`, `txtRoomColor`, `bRoomStudio`) VALUES
(1, 'Studio', '#E33C3C', 1),
(2, 'Local 1', '#00FF7C', 0),
(3, 'Local 2', '#0000FF', 0),
(4, 'Local 3', '#FFEF00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_track`
--

DROP TABLE IF EXISTS `t_track`;
CREATE TABLE `t_track` (
  `idTrack` int(11) NOT NULL,
  `txtTrackName` varchar(50) NOT NULL,
  `tmTrackLength` time DEFAULT NULL,
  `txtSoundcloudURL` varchar(1000) NOT NULL,
  `txtAudioPath` varchar(255) DEFAULT NULL,
  `txtRecordName` varchar(50) NOT NULL,
  `dtRecordDate` year(4) NOT NULL,
  `txtRecordStyle` varchar(50) NOT NULL,
  `txtArtworkPath` varchar(255) DEFAULT NULL,
  `txtArtistName` varchar(50) NOT NULL,
  `txtArtistSiteURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_track`
--

INSERT INTO `t_track` (`idTrack`, `txtTrackName`, `tmTrackLength`, `txtSoundcloudURL`, `txtAudioPath`, `txtRecordName`, `dtRecordDate`, `txtRecordStyle`, `txtArtworkPath`, `txtArtistName`, `txtArtistSiteURL`) VALUES
(1, 'Between', '00:06:39', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/390759651&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe>', '/upload/musics/siiilk_between.wav', 'Way to Lhassa', 2013, 'Rock Progressif', '/upload/artworks/siiilk_waytolhassa.jpg', 'Siiilk', 'http://siiilk.com'),
(2, 'Inertia', '00:06:01', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/348649465&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe>', '/upload/musics/nonsense_inertia.wav', 'On Earth', 2016, 'Metal Djent', '/upload/artworks/nonsense_onearth.jpg', 'Nonsense', ''),
(3, 'If You Wait', '00:04:02', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/348650428&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe>', '/upload/musics/aurane_ifyouwait.wav', 'Nightfall', 2017, 'Piano / Voix', '/upload/artworks/aurane_nightfall.jpg', 'Aurane', ''),
(4, 'Red Prairie Dawn', '00:04:39', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/348650883&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe> ', '/upload/musics/rootsanddrive_redprairiedawn.wav', 'Lost In The Rain', 2017, 'Bluegrass', '/upload/artworks/rootsanddrive_lostintherain.jpg', 'Roots & Drive', 'https://www.rootsanddrive.com'),
(5, 'Endless Mystery', '00:05:39', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/348651461&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe>        ', '/upload/musics/siiilk_endlessmystery.wav', 'Endless Mystery', 2017, 'Rock Progressif', '/upload/artworks/siiilk_endlessmystery.jpg', 'Siiilk', 'http://siiilk.com'),
(6, 'Broken Dreams', '00:03:48', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/348651090&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe>      \r\n            ', '/upload/musics/victormarc_brokendreams.wav', 'Extended Play', 2017, 'Pop Folk', '/upload/artworks/victormarc_extendedplay.jpg', 'Victor Marc', ''),
(7, 'Regard En Arrière', '00:03:16', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/390761973&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe>', '/upload/musics/lucile_regardenarriere.wav', 'Lucile', 2018, 'Chanson Française', '/upload/artworks/lucile_lucile.jpg', 'Lucile', ''),
(8, 'Why', '00:04:44', '<iframe height=\"250\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/348650047&amp;color=%23287c4e&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false&amp;show_teaser=false&amp;visual=true\"></iframe>', '/upload/musics/maze_why.wav', 'Why', 2018, 'Pop Rock', '/upload/artworks/maze_why.mp3', 'Maze', '');

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `txtUserName` varchar(255) NOT NULL,
  `txtUserMail` varchar(255) NOT NULL,
  `txtUserRole` varchar(25) NOT NULL,
  `txtUserPassword` varchar(255) NOT NULL,
  `txtUserSalt` varchar(255) NOT NULL,
  `txtUserImgPath` varchar(255) DEFAULT NULL,
  `idGroup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `txtUserName`, `txtUserMail`, `txtUserRole`, `txtUserPassword`, `txtUserSalt`, `txtUserImgPath`, `idGroup`) VALUES
(1, 'Sebastien Biola', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 1),
(2, 'Romain REGAL', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 1),
(3, 'Olivier SICAUD', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 1),
(4, 'Maxime MANGEANT', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 1),
(5, 'Raphael DE STEFANO', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 1),
(6, 'Florian BIOLA', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 7),
(7, 'François GLAIZAL', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 8),
(8, 'Christophe ORRY', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 2),
(9, 'Franck RIVAL', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 2),
(10, 'Nicolas Combasson', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 2),
(11, 'Olivier Combasson', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 2),
(12, 'Pierre ...', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 2),
(13, 'Bruno LENAIN', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 3),
(14, 'Bruno RAVAT', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 3),
(15, 'Eric BACHMANN', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 3),
(16, 'Pascal LORINI', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 3),
(17, 'Antoine VALEX', 'testzez@test.com', 'ROLE_USER', '$2y$13$UkiHS3r7PJHe.LTGyRq30.rRLO6H4DENyWnwzEXPtL2teqLn4C6mq', '6e2824b63251fa7ad33d4c9', NULL, 4),
(18, 'Mathias VALEX', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 4),
(19, 'Julien RUSSO', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 4),
(20, 'Julien FERRAND', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 5),
(21, 'Paul RUIZ', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 5),
(22, 'Pierre DESPRAZ', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 5),
(23, 'Pierre ROJON', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 5),
(24, 'Membre1', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 6),
(25, 'Membre2', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 6),
(26, 'Membre3', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 6),
(27, 'Membre4', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 6),
(28, 'Membre5', 'test@test.com', 'ROLE_USER', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 6),
(30, 'megofavalon', 'test@test.com', 'ROLE_ADMIN', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, NULL),
(31, 'ryohazuk.dt', 'test@test.com', 'ROLE_ADMIN', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, NULL),
(35, 'pmacaro', 'test@test.com', 'ROLE_ADMIN', '$2y$13$RnDoGtNO4bJuXkz64S63yeJc92NTM1IAFJUV.bxxG1xc1RFaiCMbm', '6e2824b63251fa7ad33d4c9', NULL, 14),
(38, 'testavatar', 'test@test.com', 'ROLE_ADMIN', '$2y$13$L.Rwy4uyo35B9m3SNbuBUuB6XPAob4Y1gqmiG.d3nKyhlXTt5Eyli', 'c1597e3ec30e2a601cfbd7b', '/upload/avatars/d0b921b458d9b8797fae7f7cdb02dfad.png', 17),
(41, 'egsergsdfgsdfg', 'test@test.com', 'ROLE_USER', '$2y$13$CfIoAafjwLnn9w3Fcq4BM.zgqCMG2r0QD2pCmVATeOWWYlIOG2x6a', '7e79ef486b20bb39eae0f96', NULL, 17);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_event`
--
ALTER TABLE `t_event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_group`
--
ALTER TABLE `t_group`
  ADD PRIMARY KEY (`idGroup`);

--
-- Index pour la table `t_news`
--
ALTER TABLE `t_news`
  ADD PRIMARY KEY (`idnew`);

--
-- Index pour la table `t_picture`
--
ALTER TABLE `t_picture`
  ADD PRIMARY KEY (`idPicture`);

--
-- Index pour la table `t_quote`
--
ALTER TABLE `t_quote`
  ADD PRIMARY KEY (`idQuote`);

--
-- Index pour la table `t_room`
--
ALTER TABLE `t_room`
  ADD PRIMARY KEY (`idRoom`);

--
-- Index pour la table `t_track`
--
ALTER TABLE `t_track`
  ADD PRIMARY KEY (`idTrack`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_event`
--
ALTER TABLE `t_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `t_group`
--
ALTER TABLE `t_group`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `t_news`
--
ALTER TABLE `t_news`
  MODIFY `idnew` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `t_picture`
--
ALTER TABLE `t_picture`
  MODIFY `idPicture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `t_quote`
--
ALTER TABLE `t_quote`
  MODIFY `idQuote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `t_room`
--
ALTER TABLE `t_room`
  MODIFY `idRoom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_track`
--
ALTER TABLE `t_track`
  MODIFY `idTrack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
