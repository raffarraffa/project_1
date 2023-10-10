-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2023 a las 18:20:28
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mascotas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(10) UNSIGNED NOT NULL,
  `ciudad` varchar(80) NOT NULL,
  `id_pais` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_color` int(10) UNSIGNED NOT NULL,
  `color` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_color`, `color`) VALUES
(1, 'Blanco'),
(4, 'Dorado'),
(3, 'Marrón'),
(2, 'Negro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE `especies` (
  `id_especie` int(10) UNSIGNED NOT NULL,
  `especie` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`id_especie`, `especie`) VALUES
(3, 'Ave'),
(1, 'Canino'),
(2, 'Felino'),
(5, 'Reptil'),
(4, 'Roedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_mascotas`
--

CREATE TABLE `fotos_mascotas` (
  `id_foto` int(10) UNSIGNED NOT NULL,
  `id_mascota` int(10) UNSIGNED NOT NULL,
  `archivo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `id_especie` int(10) UNSIGNED NOT NULL,
  `id_raza` int(10) UNSIGNED NOT NULL,
  `id_color` int(10) UNSIGNED NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `genero` char(1) NOT NULL,
  `id_tamanio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id_pais` int(10) UNSIGNED NOT NULL,
  `denominacion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id_pais`, `denominacion`) VALUES
(1, 'Argentina'),
(2, 'Brasil'),
(3, 'Colombia'),
(4, 'Cuba'),
(5, 'Estados Unidos'),
(6, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

CREATE TABLE `razas` (
  `id_raza` int(10) UNSIGNED NOT NULL,
  `raza` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_salud`
--

CREATE TABLE `rel_salud` (
  `id_salud` int(10) UNSIGNED NOT NULL,
  `id_mascota` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_sociabilidad`
--

CREATE TABLE `rel_sociabilidad` (
  `id_sociabilidad` int(10) UNSIGNED NOT NULL,
  `id_mascota` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud`
--

CREATE TABLE `salud` (
  `id_salud` int(10) UNSIGNED NOT NULL,
  `salud` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sociabilidad`
--

CREATE TABLE `sociabilidad` (
  `id_sociabilidad` int(10) UNSIGNED NOT NULL,
  `tipo` char(1) NOT NULL,
  `sociabilidad` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanios`
--

CREATE TABLE `tamanios` (
  `id_tamanio` int(10) UNSIGNED NOT NULL,
  `tamanio` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `pass` varchar(65) NOT NULL,
  `pass_recovery` varchar(65) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `ciudad` varchar(65) NOT NULL,
  `pais` varchar(65) NOT NULL,
  `genero` char(1) DEFAULT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombres`, `apellido`, `email`, `telefono`, `fecha_nacimiento`, `pass`, `pass_recovery`, `domicilio`, `ciudad`, `pais`, `genero`, `foto`) VALUES
(1, 'Jose', 'Perez', 'joseperez@gmail.com', 2147483647, '1990-01-01', '1234', '', 'Av. Siempre Viva 123', 'Buenos Aires', 'Argentina', 'H', ''),
(2, 'Maria', 'Rodriguez', 'mariarodriguez@gmail.com', 654321987, '1980-02-02', '1234', '', 'Av. Aquiles Vaesa 123', 'Caracas', 'Venezuela', 'M', ''),
(3, 'Pedro', 'Picapiedra', 'pedropicapiedra@gmail.com', 741258963, '1970-03-03', '1234', '', 'Av. Edad de Piedra 123', 'Rio de Janeiro', 'Brasil', 'H', ''),
(4, 'Ana', 'Sanchez', 'anasanchez@gmail.com', 84321184, '2000-04-04', '1234', '', 'Av. South Park 123', 'Bogota', 'Colombia', 'M', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`),
  ADD UNIQUE KEY `color` (`color`);

--
-- Indices de la tabla `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id_especie`),
  ADD UNIQUE KEY `especie` (`especie`);

--
-- Indices de la tabla `fotos_mascotas`
--
ALTER TABLE `fotos_mascotas`
  ADD PRIMARY KEY (`id_foto`),
  ADD UNIQUE KEY `archivo` (`archivo`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `razas`
--
ALTER TABLE `razas`
  ADD PRIMARY KEY (`id_raza`),
  ADD UNIQUE KEY `raza` (`raza`);

--
-- Indices de la tabla `rel_salud`
--
ALTER TABLE `rel_salud`
  ADD PRIMARY KEY (`id_salud`,`id_mascota`);

--
-- Indices de la tabla `rel_sociabilidad`
--
ALTER TABLE `rel_sociabilidad`
  ADD PRIMARY KEY (`id_sociabilidad`,`id_mascota`);

--
-- Indices de la tabla `salud`
--
ALTER TABLE `salud`
  ADD PRIMARY KEY (`id_salud`),
  ADD UNIQUE KEY `salud` (`salud`);

--
-- Indices de la tabla `sociabilidad`
--
ALTER TABLE `sociabilidad`
  ADD PRIMARY KEY (`id_sociabilidad`),
  ADD UNIQUE KEY `sociabilidad` (`sociabilidad`);

--
-- Indices de la tabla `tamanios`
--
ALTER TABLE `tamanios`
  ADD PRIMARY KEY (`id_tamanio`),
  ADD UNIQUE KEY `tamanio` (`tamanio`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `especies`
--
ALTER TABLE `especies`
  MODIFY `id_especie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fotos_mascotas`
--
ALTER TABLE `fotos_mascotas`
  MODIFY `id_foto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `razas`
--
ALTER TABLE `razas`
  MODIFY `id_raza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salud`
--
ALTER TABLE `salud`
  MODIFY `id_salud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sociabilidad`
--
ALTER TABLE `sociabilidad`
  MODIFY `id_sociabilidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tamanios`
--
ALTER TABLE `tamanios`
  MODIFY `id_tamanio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
