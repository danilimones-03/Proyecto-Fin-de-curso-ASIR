-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2023 a las 18:39:47
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
-- Base de datos: `login terminado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE `motivo` (
  `id_motivo` int(11) NOT NULL,
  `Motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivospartes`
--

CREATE TABLE `motivospartes` (
  `id_parte` int(11) NOT NULL,
  `id_motivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes`
--

CREATE TABLE `partes` (
  `id` int(11) NOT NULL,
  `email_profesor` varchar(255) NOT NULL,
  `nombrealumno` varchar(255) NOT NULL,
  `apellido1alumno` varchar(255) NOT NULL,
  `apellido2alumno` varchar(255) NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `fecha` date DEFAULT NULL,
  `tramo_horario` varchar(255) NOT NULL,
  `explicacion` varchar(500) NOT NULL,
  `permanencia_aula` varchar(255) NOT NULL,
  `fecha_llamada` date NOT NULL,
  `hora_llamada` time NOT NULL,
  `resultado_llamada` varchar(255) NOT NULL,
  `fecha_envio_ipasen` date DEFAULT NULL,
  `motivo_parte` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido1` varchar(255) NOT NULL,
  `apellido2` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `motivo`
--
ALTER TABLE `motivo`
  ADD PRIMARY KEY (`id_motivo`);

--
-- Indices de la tabla `motivospartes`
--
ALTER TABLE `motivospartes`
  ADD PRIMARY KEY (`id_parte`,`id_motivo`),
  ADD KEY `id_motivo` (`id_motivo`);

--
-- Indices de la tabla `partes`
--
ALTER TABLE `partes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_profesor` (`email_profesor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `motivo`
--
ALTER TABLE `motivo`
  MODIFY `id_motivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `partes`
--
ALTER TABLE `partes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `motivospartes`
--
ALTER TABLE `motivospartes`
  ADD CONSTRAINT `motivospartes_ibfk_1` FOREIGN KEY (`id_parte`) REFERENCES `partes` (`id`),
  ADD CONSTRAINT `motivospartes_ibfk_2` FOREIGN KEY (`id_motivo`) REFERENCES `motivo` (`id_motivo`);

--
-- Filtros para la tabla `partes`
--
ALTER TABLE `partes`
  ADD CONSTRAINT `partes_ibfk_1` FOREIGN KEY (`email_profesor`) REFERENCES `usuarios` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
