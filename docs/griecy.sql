-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2023 a las 05:19:07
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `griecy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concursos`
--

CREATE TABLE `concursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `version` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `doc_convocatoria` blob DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `id_jac` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_directivo`
--

CREATE TABLE `grupo_directivo` (
  `id` int(11) NOT NULL,
  `id_jac` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_directivo_detalle`
--

CREATE TABLE `grupo_directivo_detalle` (
  `id` int(11) NOT NULL,
  `id_grupo_directivo` int(11) DEFAULT NULL,
  `id_tercero` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `junta_accion_comunal`
--

CREATE TABLE `junta_accion_comunal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `personeria_juridica` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nit` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `rut` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `ruc_numero` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `ruc_documento` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_vereda` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `email_password` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `direccion_fisica` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `id_concurso` int(11) DEFAULT NULL,
  `id_jac` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terceros`
--

CREATE TABLE `terceros` (
  `id` int(11) NOT NULL,
  `id_jac` int(11) DEFAULT NULL,
  `nombre_completo` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `num_doc_identidad` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `lugar_expedicion` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `direccion_fisica` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `img_cc` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veredas`
--

CREATE TABLE `veredas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(11) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `concursos`
--
ALTER TABLE `concursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jac` (`id_jac`);

--
-- Indices de la tabla `grupo_directivo`
--
ALTER TABLE `grupo_directivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jac` (`id_jac`);

--
-- Indices de la tabla `grupo_directivo_detalle`
--
ALTER TABLE `grupo_directivo_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo_directivo` (`id_grupo_directivo`),
  ADD KEY `id_tercero` (`id_tercero`);

--
-- Indices de la tabla `junta_accion_comunal`
--
ALTER TABLE `junta_accion_comunal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vereda` (`id_vereda`);

--
-- Indices de la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_concurso` (`id_concurso`),
  ADD KEY `id_jac` (`id_jac`);

--
-- Indices de la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jac` (`id_jac`);

--
-- Indices de la tabla `veredas`
--
ALTER TABLE `veredas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `concursos`
--
ALTER TABLE `concursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo_directivo`
--
ALTER TABLE `grupo_directivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo_directivo_detalle`
--
ALTER TABLE `grupo_directivo_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `junta_accion_comunal`
--
ALTER TABLE `junta_accion_comunal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `terceros`
--
ALTER TABLE `terceros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `veredas`
--
ALTER TABLE `veredas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_jac`) REFERENCES `junta_accion_comunal` (`id`);

--
-- Filtros para la tabla `grupo_directivo`
--
ALTER TABLE `grupo_directivo`
  ADD CONSTRAINT `grupo_directivo_ibfk_1` FOREIGN KEY (`id_jac`) REFERENCES `junta_accion_comunal` (`id`);

--
-- Filtros para la tabla `grupo_directivo_detalle`
--
ALTER TABLE `grupo_directivo_detalle`
  ADD CONSTRAINT `grupo_directivo_detalle_ibfk_1` FOREIGN KEY (`id_grupo_directivo`) REFERENCES `grupo_directivo` (`id`),
  ADD CONSTRAINT `grupo_directivo_detalle_ibfk_2` FOREIGN KEY (`id_tercero`) REFERENCES `terceros` (`id`);

--
-- Filtros para la tabla `junta_accion_comunal`
--
ALTER TABLE `junta_accion_comunal`
  ADD CONSTRAINT `junta_accion_comunal_ibfk_1` FOREIGN KEY (`id_vereda`) REFERENCES `veredas` (`id`);

--
-- Filtros para la tabla `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `participantes_ibfk_1` FOREIGN KEY (`id_concurso`) REFERENCES `concursos` (`id`),
  ADD CONSTRAINT `participantes_ibfk_2` FOREIGN KEY (`id_jac`) REFERENCES `junta_accion_comunal` (`id`);

--
-- Filtros para la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD CONSTRAINT `terceros_ibfk_1` FOREIGN KEY (`id_jac`) REFERENCES `junta_accion_comunal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
