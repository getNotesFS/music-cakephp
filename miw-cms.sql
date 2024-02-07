-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2024 at 06:35 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miw-cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `release_date` date NOT NULL,
  `artist_id` int NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `release_date`, `artist_id`, `created`, `modified`) VALUES
(1, '30', '2021-11-19', 2, '2024-02-03 23:44:20', '2024-02-04 15:17:08'),
(2, 'Brand New Eyes', '2009-09-29', 4, '2024-02-04 03:02:27', '2024-02-04 15:35:26'),
(3, '21', '2011-01-24', 2, '2024-02-04 15:26:10', '2024-02-04 15:26:10'),
(4, 'Favourite Worst Nightmare', '2007-04-23', 1, '2024-02-04 15:33:36', '2024-02-04 15:33:36'),
(5, 'The Car', '2022-08-21', 1, '2024-02-04 15:34:11', '2024-02-04 15:34:11'),
(6, 'AM', '2013-09-09', 1, '2024-02-04 15:40:46', '2024-02-04 15:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `biography` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int DEFAULT NULL,
  `discography_id` int NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `biography`, `country`, `age`, `discography_id`, `created`, `modified`) VALUES
(1, 'Arctic Monkeys', 'Arctic Monkeys es una banda británica de rock alternativo, formada en Sheffield, Reino Unido.​ El grupo está compuesto por el guitarrista principal y vocalista Alex Turner, el guitarrista Jamie Cook, el baterista Matt Helders y el bajista Nick O\'Malley.', 'Reino Unido', NULL, 8, '2024-02-03 22:32:57', '2024-02-04 15:13:37'),
(2, 'Adele', 'Adele Laurie Blue Adkins, conocida simplemente como Adele, es una cantautora y multinstrumentista británica.​ Es una de las artistas musicales con mayores ventas del mundo, con más de 120 millones de ventas entre discos y sencillos.', 'Reino Unido', 35, 6, '2024-02-03 23:28:15', '2024-02-04 15:10:15'),
(3, 'Måneskin', 'Måneskin es una banda italiana formada en 2016 en Roma, conformada por Damiano David como vocalista, Victoria De Angelis como bajista, Thomas Raggi como guitarrista e Ethan Torchio como baterista.', 'Italia', NULL, 1, '2024-02-04 14:51:43', '2024-02-04 14:51:43'),
(4, 'Paramore', 'Paramore es una banda estadounidense de rock alternativo​​​​ integrada por Hayley Williams, Taylor York y Zac Farro. Fue formada en Franklin, Tennessee, en 2004, por Williams y Jeremy Davis junto con Josh Farro, Zac Farro ​ y Jason Bynum.​', 'Estados Unidos', NULL, 4, '2024-02-04 15:05:17', '2024-02-04 15:05:17'),
(5, 'Coldplay', 'Coldplay es una banda británica de rock formada en Londres en 1997. Está integrada por Chris Martin, Jonny Buckland, Guy Berryman, Will Champion y Phil Harvey.​​', 'Reino Unido', NULL, 7, '2024-02-04 15:12:12', '2024-02-04 15:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `discographies`
--

CREATE TABLE `discographies` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `launch_date` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discographies`
--

INSERT INTO `discographies` (`id`, `name`, `country`, `launch_date`, `created`, `modified`) VALUES
(1, 'Sony Music', 'Estados Unidos', '1929-10-09', '2024-02-03 16:05:55', '2024-02-04 14:57:42'),
(3, 'RCA Records', 'Estados Unidos', '1900-01-01', '2024-02-03 16:55:35', '2024-02-04 14:58:59'),
(4, 'Warner Music Group', 'Estados Unidos', '1958-04-06', '2024-02-04 15:00:21', '2024-02-04 15:00:21'),
(5, 'Fueled by Ramen', 'Estados Unidos', '1996-01-01', '2024-02-04 15:01:44', '2024-02-04 15:01:44'),
(6, 'XL', 'Reino Unido', '1989-01-01', '2024-02-04 15:10:04', '2024-02-04 15:10:04'),
(7, 'Parlophone', 'Alemania', '1896-01-01', '2024-02-04 15:11:14', '2024-02-04 15:11:14'),
(8, 'Domino Records', 'Reino Unido', '1993-01-01', '2024-02-04 15:13:00', '2024-02-04 15:13:00'),
(9, 'Columbia Records', 'Estados Unidos', '1887-01-01', '2024-02-04 15:16:30', '2024-02-04 15:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Rock', '2024-02-03 17:48:18', '2024-02-03 17:48:18'),
(2, 'Folk', '2024-02-03 17:48:27', '2024-02-03 17:48:27'),
(4, 'Alternative', '2024-02-04 15:14:27', '2024-02-04 15:14:27'),
(5, 'Soul', '2024-02-04 15:19:26', '2024-02-04 15:19:26'),
(6, 'Pop', '2024-02-04 15:19:31', '2024-02-04 15:19:31'),
(7, 'Jazz', '2024-02-04 15:19:34', '2024-02-04 15:19:53'),
(8, 'Indie', '2024-02-04 15:19:43', '2024-02-04 15:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender_id` int NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `gender_id`, `created`, `modified`) VALUES
(1, 'Folk Indie session', 1, '2024-02-04 00:43:17', '2024-02-04 03:32:59'),
(2, 'Nevermind Session', 2, '2024-02-04 03:32:33', '2024-02-04 15:44:44'),
(3, 'Arctic', 1, '2024-02-04 16:05:10', '2024-02-04 16:05:39'),
(4, 'Tester ddd', 1, '2024-02-04 16:47:04', '2024-02-04 16:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_spotify` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender_id` int NOT NULL,
  `album_id` int NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `name`, `link_spotify`, `gender_id`, `album_id`, `created`, `modified`) VALUES
(1, 'Why\'d You Only', 'https://open.spotify.com/track/086myS9r57YsLbJpU0TgK9', 1, 6, '2024-02-04 00:14:58', '2024-02-04 15:40:53'),
(2, 'Careful', 'https://open.spotify.com/track/63L9AjBDN3SOMbJlBkFqiZ', 2, 2, '2024-02-04 03:01:09', '2024-02-04 15:44:13'),
(3, 'Oh My God', 'https://open.spotify.com/track/3Kkjo3cT83cw09VJyrLNwX', 5, 1, '2024-02-04 03:01:55', '2024-02-04 15:43:14'),
(4, 'Strangers by Nature', 'https://open.spotify.com/track/13CVSGLSFl4UxpDVR6u3dq', 1, 1, '2024-02-04 15:19:20', '2024-02-04 15:19:20'),
(5, 'Easy on Me', 'https://open.spotify.com/track/46IZ0fSY2mpAiktS3KOqds', 5, 1, '2024-02-04 15:23:42', '2024-02-04 15:23:42'),
(6, 'My Little Love', 'https://open.spotify.com/track/2DuPBbS5mIldXnh7Wum8Cy', 5, 1, '2024-02-04 15:25:08', '2024-02-04 15:25:08'),
(7, 'Rolling in the Deep', 'https://open.spotify.com/track/4OSBTYWVwsQhGLF9NHvIbR', 5, 3, '2024-02-04 15:27:23', '2024-02-04 15:27:23'),
(8, 'Rumour Has It', 'https://open.spotify.com/track/5mFMb5OHI3cN0UjITVztCj', 5, 3, '2024-02-04 15:27:42', '2024-02-04 15:27:42'),
(9, 'There’d Better Be A Mirrorball', 'https://open.spotify.com/track/1zx6GSqLYI2ynzAHnPRKBR', 1, 5, '2024-02-04 15:36:06', '2024-02-04 15:36:06'),
(10, 'I Ain’t Quite Where I Think I Am', 'https://open.spotify.com/track/1UwUhKmFxGKs59xiWO60Sx', 1, 5, '2024-02-04 15:36:34', '2024-02-04 15:36:34'),
(11, 'Brianstorm', 'https://open.spotify.com/track/7f9I5WdyXm5q1XqnSYgQZb', 1, 4, '2024-02-04 15:37:47', '2024-02-04 15:37:47'),
(12, 'Teddy Picker', 'https://open.spotify.com/track/5kxVyCgEUND7E2QKG7JmoF', 1, 4, '2024-02-04 15:38:05', '2024-02-04 15:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `songs_playlists`
--

CREATE TABLE `songs_playlists` (
  `id` int UNSIGNED NOT NULL,
  `song_id` int NOT NULL,
  `playlist_id` int NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs_playlists`
--

INSERT INTO `songs_playlists` (`id`, `song_id`, `playlist_id`, `created`, `modified`) VALUES
(1, 1, 1, NULL, NULL),
(2, 3, 1, NULL, NULL),
(4, 2, 2, NULL, NULL),
(5, 7, 2, NULL, NULL),
(6, 11, 2, NULL, NULL),
(7, 1, 3, NULL, NULL),
(8, 1, 4, NULL, NULL),
(9, 4, 4, NULL, NULL),
(10, 6, 4, NULL, NULL),
(11, 7, 4, NULL, NULL),
(12, 9, 4, NULL, NULL),
(13, 11, 4, NULL, NULL),
(14, 12, 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discographies`
--
ALTER TABLE `discographies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs_playlists`
--
ALTER TABLE `songs_playlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discographies`
--
ALTER TABLE `discographies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `songs_playlists`
--
ALTER TABLE `songs_playlists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
