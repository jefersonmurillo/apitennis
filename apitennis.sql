-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2019 a las 19:25:17
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apitennis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_golfista`
--

CREATE TABLE `categoria_golfista` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_golfista`
--

INSERT INTO `categoria_golfista` (`id`, `categoria`) VALUES
(1, 'BENJAMÍN'),
(2, 'ALEVÍN'),
(3, 'INFANTIL'),
(4, 'CADETE'),
(5, 'JUNIOR'),
(6, 'BOYS/GIRLS'),
(7, 'MAYOR'),
(8, 'SENIOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `disciplina`
--

INSERT INTO `disciplina` (`id`, `nombre`) VALUES
(1, 'Basquetbol'),
(2, 'Golf'),
(3, 'Natación'),
(4, 'Tennis'),
(5, 'Futbol'),
(6, 'Voleibol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_users`
--

CREATE TABLE `estado_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_users`
--

INSERT INTO `estado_users` (`id`, `estado`) VALUES
(1, 'ACTIVO'),
(2, 'EN ESPERA'),
(3, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(10) UNSIGNED NOT NULL,
  `prioridad_id` int(10) UNSIGNED NOT NULL,
  `tipo_evento_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `imagen_destacada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_evento`
--

CREATE TABLE `imagenes_evento` (
  `id` int(10) UNSIGNED NOT NULL,
  `evento_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_instalacion`
--

CREATE TABLE `imagenes_instalacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `instalacion_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacion`
--

CREATE TABLE `instalacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_instalacion_id` int(10) UNSIGNED NOT NULL,
  `disciplina_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'En caso de que sea una instalación deportiva',
  `nombre` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_destacada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_07_24_000002_create_tipo_instalacion_table', 1),
(3, '2019_07_24_000003_create_categoria_golfista_table', 1),
(4, '2019_07_24_000004_create_disciplina_table', 1),
(5, '2019_07_24_000005_create_tipo_evento_table', 1),
(6, '2019_07_24_000006_create_tipo_usuario_table', 1),
(7, '2019_07_24_000007_create_tipo_documento_table', 1),
(8, '2019_07_24_000008_create_prioridad_table', 1),
(9, '2019_07_24_000009_create_estado_users_table', 1),
(10, '2019_07_24_000010_create_evento_table', 1),
(11, '2019_07_24_000011_create_instalacion_table', 1),
(12, '2019_07_24_000012_create_imagenes_evento_table', 1),
(13, '2019_07_24_000013_create_imagenes_instalacion_table', 1),
(14, '2019_07_24_000014_create_users_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `id` int(10) UNSIGNED NOT NULL,
  `prioridad` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prioridad`
--

INSERT INTO `prioridad` (`id`, `prioridad`) VALUES
(1, 'GOLD'),
(2, 'ALTA'),
(3, 'MEDIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `tipo`) VALUES
(1, 'CEDULA DE CIUDADANIA'),
(2, 'CEDULA DE EXTRANGERIA'),
(3, 'PASAPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_evento`
--

CREATE TABLE `tipo_evento` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_evento`
--

INSERT INTO `tipo_evento` (`id`, `tipo`) VALUES
(1, 'FAMILIAR'),
(2, 'NIÑOS'),
(3, 'ADULTOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_instalacion`
--

CREATE TABLE `tipo_instalacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_instalacion`
--

INSERT INTO `tipo_instalacion` (`id`, `tipo`) VALUES
(1, 'RESTAURANTE'),
(2, 'SALÓN'),
(3, 'DEPORTE'),
(4, 'OTRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'AFILIADO'),
(2, 'ADMINISTRATIVO'),
(3, 'GOLFISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_documento_id` int(10) UNSIGNED NOT NULL,
  `tipo_usuario_id` int(10) UNSIGNED NOT NULL,
  `documento` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_naci` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_afiliado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_golfista` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_golfista_id` int(10) UNSIGNED DEFAULT NULL,
  `estado_users_id` int(10) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `tipo_documento_id`, `tipo_usuario_id`, `documento`, `email`, `password`, `name`, `nombres`, `apellidos`, `fecha_naci`, `telefono`, `direccion`, `genero`, `codigo_afiliado`, `codigo_golfista`, `categoria_golfista_id`, `estado_users_id`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '1092362256', 'admin@admin.com', '$2y$10$06XNrJZ9X2mMRikG5nlb1.99a/qPpyHGwk0D03KYQBkbZ6oB85nnS', 'Administrator', 'Jeferson', 'Murillo Ariza', '12/02/1997', '3133708060', 'Calle 34', 'MASCULÍNO', '-1', NULL, 1, 1, NULL, '2019-07-27 06:03:16', '2019-07-27 06:03:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_golfista`
--
ALTER TABLE `categoria_golfista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_users`
--
ALTER TABLE `estado_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evento_prioridad1_idx` (`prioridad_id`),
  ADD KEY `fk_evento_tipo_evento1_idx` (`tipo_evento_id`);

--
-- Indices de la tabla `imagenes_evento`
--
ALTER TABLE `imagenes_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagenes_evento_evento1_idx` (`evento_id`);

--
-- Indices de la tabla `imagenes_instalacion`
--
ALTER TABLE `imagenes_instalacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagenes_instalacion_instalacion1_idx` (`instalacion_id`);

--
-- Indices de la tabla `instalacion`
--
ALTER TABLE `instalacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_instalacion_disciplina1_idx` (`disciplina_id`),
  ADD KEY `fk_instalacion_tipo_instalacion1_idx` (`tipo_instalacion_id`);

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
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_instalacion`
--
ALTER TABLE `tipo_instalacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_afiliado_UNIQUE` (`codigo_afiliado`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `codigo_golfista_UNIQUE` (`codigo_golfista`),
  ADD KEY `fk_users_estado_users1_idx` (`estado_users_id`),
  ADD KEY `fk_users_categoria_golfista1_idx` (`categoria_golfista_id`),
  ADD KEY `fk_users_tipo_documento_idx` (`tipo_documento_id`),
  ADD KEY `fk_users_tipo_usuario1_idx` (`tipo_usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_golfista`
--
ALTER TABLE `categoria_golfista`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estado_users`
--
ALTER TABLE `estado_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_evento`
--
ALTER TABLE `imagenes_evento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_instalacion`
--
ALTER TABLE `imagenes_instalacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instalacion`
--
ALTER TABLE `instalacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_instalacion`
--
ALTER TABLE `tipo_instalacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_prioridad1_idx` FOREIGN KEY (`prioridad_id`) REFERENCES `prioridad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evento_tipo_evento1_idx` FOREIGN KEY (`tipo_evento_id`) REFERENCES `tipo_evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagenes_evento`
--
ALTER TABLE `imagenes_evento`
  ADD CONSTRAINT `fk_imagenes_evento_evento1_idx` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagenes_instalacion`
--
ALTER TABLE `imagenes_instalacion`
  ADD CONSTRAINT `fk_imagenes_instalacion_instalacion1_idx` FOREIGN KEY (`instalacion_id`) REFERENCES `instalacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `instalacion`
--
ALTER TABLE `instalacion`
  ADD CONSTRAINT `fk_instalacion_disciplina1_idx` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_instalacion_tipo_instalacion1_idx` FOREIGN KEY (`tipo_instalacion_id`) REFERENCES `tipo_instalacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_categoria_golfista1_idx` FOREIGN KEY (`categoria_golfista_id`) REFERENCES `categoria_golfista` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_estado_users1_idx` FOREIGN KEY (`estado_users_id`) REFERENCES `estado_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_tipo_documento_idx` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_tipo_usuario1_idx` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
