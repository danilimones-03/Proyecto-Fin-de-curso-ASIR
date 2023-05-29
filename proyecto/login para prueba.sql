-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2023 a las 18:08:48
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
-- Base de datos: `login`
--
CREATE DATABASE login;
USE login;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE `motivo` (
  `id_motivo` int(11) NOT NULL,
  `Motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivo`
--

INSERT INTO `motivo` (`id_motivo`, `Motivo`) VALUES
(25, 'Conductas que perturban el normal desarrollo de la clase'),
(26, 'Falta de colaboración en las actividades'),
(27, 'Impedir el derecho a estudio de los compañeros'),
(28, 'Falta injustificada de puntualidad'),
(29, 'Falta injustificada de asistencia a clase'),
(30, 'Desconsideración hacia otros miembros de la comunidad educativa'),
(31, 'Daños realizados al centro'),
(32, 'Daños a las pertenencias de los compañeros'),
(33, 'Incumplimiento de las normas de clase'),
(34, 'Uso de móviles o similares'),
(35, 'Otras'),
(36, 'Agresión física contra cualquier miembro de la comunidad educativa'),
(37, 'Injurias y ofensas contra cualquier miembro de la comunidad educativa'),
(38, 'Acoso Escolar'),
(39, 'Actos perjudiciales para la salud y la integridad de cualquier miembro de la comunidad educativa'),
(40, 'Vejaciones y humillaciones contra cualquier miembro de la comunidad educativa '),
(41, 'Amenazas o coacciones contra cualquier miembro de la comunidad educativa'),
(42, 'Suplantación de identidad'),
(43, 'Actuaciones que causen graves daños a las instalaciones del centro'),
(44, 'Reiteración en un mismo curso escolar de cualquiera de las aquí listadas'),
(45, 'Cualquier acto dirigido a perturbar el normal funcionamiento del centro'),
(46, 'Incumplimiento de las correcciones impuestas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivospartes`
--

CREATE TABLE `motivospartes` (
  `id_parte` int(11) NOT NULL,
  `id_motivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivospartes`
--

INSERT INTO `motivospartes` (`id_parte`, `id_motivo`) VALUES
(78, 29),
(78, 30),
(79, 26),
(79, 27),
(79, 28),
(80, 25),
(80, 27),
(80, 30),
(80, 31),
(80, 32),
(81, 33),
(81, 34),
(81, 36),
(81, 38);

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
  `fecha_envio_ipasen` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partes`
--

INSERT INTO `partes` (`id`, `email_profesor`, `nombrealumno`, `apellido1alumno`, `apellido2alumno`, `grupo`, `fecha`, `tramo_horario`, `explicacion`, `permanencia_aula`, `fecha_llamada`, `hora_llamada`, `resultado_llamada`, `fecha_envio_ipasen`) VALUES
(78, 'pruebaadministrador@gmail.com', 'Daniel', 'Limones', 'Arredondo', '2º Asir', '2023-05-09', '1ª Hora', 'sadasdasd', 'Si', '2023-05-06', '11:38:00', ' Contesta', '0000-00-00'),
(79, 'pruebausuario@gmail.com', 'Alumno', 'Alumno', 'Alumno', '2ºASIR', '2023-05-03', '1ª Hora', 'Ejemplo desarrollo hechos', 'Si', '2023-05-04', '15:56:00', ' Contesta', '0000-00-00'),
(80, 'pruebausuario2@gmail.com', 'Alumno', 'Alumno', 'Alumno', '1º SMR', '2023-05-26', '4ª Hora', 'Ejemplo desarrollo', 'No', '2023-05-11', '15:57:00', ' No contesta', '2023-05-31'),
(81, 'pruebausuario3@gmail.com', 'Alumno', 'Alumno', 'Alumno', '2ºASIR', '2023-05-30', '1ª Hora', 'Esta es una prueba', 'Si', '2023-05-12', '17:59:00', ' Comunica', '0000-00-00');

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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `contrasenia`, `nombre`, `apellido1`, `apellido2`, `rol`) VALUES
('pruebaadministrador@gmail.com', '$2y$10$AEbZbhM2ZAeCvR0szB9kZu83JsAwWAZva1MQ2NeZVao1BZ585PeKa', 'PRUEBA', 'PRUEBA', 'PRUEBA', 'Administrador'),
('pruebausuario2@gmail.com', '$2y$10$7A9nYHRX9oDQeG.GrafLGe1TE7iJ8H.8PSrcTGWOqvxYW/K0bjfuW', 'Usuario', 'Usuario', 'Usuario', 'Usuario'),
('pruebausuario3@gmail.com', '$2y$10$YPVekTNlQ.PzCRr2NL2nw.nvOpC5nRUt8GdoRPs257PYjJ/MBHV0K', 'Prueba', 'Prueba', 'Prueba', 'Usuario'),
('pruebausuario@gmail.com', '$2y$10$hic/z0gkRKfNukxlUrsxKuQhD9oRPBeZDxVeGvqIn/ipz2ImoVUDS', 'Usuario', 'Usuario', 'Usuario', 'Usuario');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
