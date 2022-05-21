-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2022 a las 21:10:35
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `astronewmy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `source` longtext DEFAULT NULL,
  `celestial_object_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `article`
--

INSERT INTO `article` (`id`, `title`, `slug`, `description`, `image`, `user_id`, `source`, `celestial_object_id`) VALUES
(1, 'The moon at daylight', 'the-moon-at-daylight', 'The moon view with a telescope at daylight', 'imagenes/article/1.jpg', 0, 'https://www.reddit.com/r/space/', 9),
(2, 'Saturn and Moon', 'saturn-and-moon', 'Saturn almost behind the moon', 'imagenes/article/2.jpg', 0, 'https://www.reddit.com/r/Astronomy/', 5),
(3, 'Jupiter', 'jupiter', 'Image of Jupiter', 'imagenes/article/3.jpg', 0, '', 4),
(4, 'First article', 'KSE189J2iAVTPRBH', 'fewrgtrhynedfrgt', 'imagenes/article/KSE189J2iAVTPRBH.jpg', 1, NULL, NULL),
(12, 'Article wirh equipment', '8UzAp4ylcbiVveWM', 'swdefv', 'imagenes/article/8UzAp4ylcbiVveWM.jpg', 1, NULL, NULL),
(13, 'Second article', '3PUk1O7ysEcbWdVR', 'dscfvgh', 'imagenes/article/3PUk1O7ysEcbWdVR.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articleequipment`
--

CREATE TABLE `articleequipment` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articleequipment`
--

INSERT INTO `articleequipment` (`id`, `article_id`, `equipment_id`) VALUES
(1, 12, 2),
(2, 12, 3),
(3, 13, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celestialobject`
--

CREATE TABLE `celestialobject` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `celestialobject`
--

INSERT INTO `celestialobject` (`id`, `name`, `description`, `image`) VALUES
(1, 'Mercury', 'Planet mercury', 'imagenes/celestialobject/Mercury/main/Mercury.svg'),
(2, 'Venus', 'Planet venus', 'imagenes/celestialobject/Venus/main/Venus.svg'),
(3, 'Mars', 'Planet mars', 'imagenes/celestialobject/Mars/main/Mars.svg'),
(4, 'Jupiter', 'Planet jupiter', 'imagenes/celestialobject/Jupiter/main/Jupiter.svg'),
(5, 'Saturn', 'Planet saturn', 'imagenes/celestialobject/Saturn/main/Saturn.svg'),
(6, 'Uranus', 'Planet uranus', 'imagenes/celestialobject/Uranus/main/Uranus.svg'),
(7, 'Neptune', 'Planet neptune', 'imagenes/celestialobject/Neptune/main/Neptune.svg'),
(8, 'Sun', 'The sun', 'imagenes/celestialobject/Sun/main/Sun.svg'),
(9, 'Moon', 'The moon', 'imagenes/celestialobject/Moon/main/Moon.svg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celestialobjectimages`
--

CREATE TABLE `celestialobjectimages` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `celestial_object_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `comment_text`, `likes`, `dislikes`, `user_id`, `article_id`, `created_at`) VALUES
(1, 'This is a test. My first comment!', 0, 0, 1, 3, '16:26 15/05/2022'),
(2, 'Second comment. Will it work just fine?', 0, 0, 1, 3, '16:41 15/05/2022'),
(3, 'Will it work? :O', 0, 0, 1, 4, '21:26 17/05/2022'),
(4, 'Now with the correct timezone?', 0, 0, 1, 4, '22:28 17/05/2022'),
(5, 'now? lol', 0, 0, 1, 4, '23:28 17/05/2022'),
(6, 'Hola soy edu feliz navidad', 0, 0, 1, 3, '19:52 19/05/2022'),
(7, 'Comment test', 0, 0, 1, 2, '00:26 21/05/2022'),
(8, 'TEEEEST', 0, 0, 1, 1, '00:27 21/05/2022');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(19,2) DEFAULT NULL,
  `external_link` longtext DEFAULT NULL,
  `click_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `price`, `external_link`, `click_count`) VALUES
(2, 'equipment 1', '48.00', 'https://www.amazon.es/Telescopio-Astron%C3%B3mico-Ampliaci%C3%B3n-Inteligente-Principiantes/dp/B08GKPNJ26/ref=sr_1_5?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=MJEGUOZHGOQG&keywords=telescopio&qid=1652980059&sprefix=telescopio%2Caps%2C95&sr=8-5', 0),
(3, 'equipment 2', '488448.00', NULL, 0),
(4, 'equipment 1', '1155.00', 'https://www.amazon.es/Telescopio-Astron%C3%B3mico-Ampliaci%C3%B3n-Inteligente-Principiantes/dp/B08GKPNJ26/ref=sr_1_5?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=MJEGUOZHGOQG&keywords=telescopio&qid=1652980059&sprefix=telescopio%2Caps%2C95&sr=8-5', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `searchinformation`
--

CREATE TABLE `searchinformation` (
  `id` int(11) NOT NULL,
  `country` varchar(200) NOT NULL,
  `city` decimal(19,2) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'EduSan', 'edusanchez4bc@gmail.com', NULL, '$2y$10$hN0bQaicsP52yDQsnkvU/OGtWGlo/WVLi5y.j53jgIR9RpRmd1hP2', NULL, NULL, '2022-05-20 19:19:04'),
(3, 'NataMas', 'natalia.mas.gisbert@gmail.com', NULL, '$2y$10$LyEDwfs.JYFQVaCy4l9aV.RZwAD0AFc5DaObqCoWtnkKkghq6GtiC', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `celestial_object_id` (`celestial_object_id`);

--
-- Indices de la tabla `articleequipment`
--
ALTER TABLE `articleequipment`
  ADD PRIMARY KEY (`id`,`article_id`,`equipment_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indices de la tabla `celestialobject`
--
ALTER TABLE `celestialobject`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `celestialobjectimages`
--
ALTER TABLE `celestialobjectimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `celestial_object_id` (`celestial_object_id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indices de la tabla `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `searchinformation`
--
ALTER TABLE `searchinformation`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `articleequipment`
--
ALTER TABLE `articleequipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `celestialobject`
--
ALTER TABLE `celestialobject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `celestialobjectimages`
--
ALTER TABLE `celestialobjectimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `searchinformation`
--
ALTER TABLE `searchinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`celestial_object_id`) REFERENCES `celestialobject` (`id`);

--
-- Filtros para la tabla `articleequipment`
--
ALTER TABLE `articleequipment`
  ADD CONSTRAINT `articleequipment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `articleequipment_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`);

--
-- Filtros para la tabla `celestialobjectimages`
--
ALTER TABLE `celestialobjectimages`
  ADD CONSTRAINT `celestialobjectimages_ibfk_1` FOREIGN KEY (`celestial_object_id`) REFERENCES `celestialobject` (`id`);

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
