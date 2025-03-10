-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2025 a las 19:31:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `idAsignatura` int(11) NOT NULL,
  `nombreAsignatura` varchar(50) NOT NULL,
  `curso` varchar(25) NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`idAsignatura`, `nombreAsignatura`, `curso`, `idDepartamento`) VALUES
(1, 'Entorno Servidor', '2º DAW', 1),
(2, 'Entorno Cliente', '2º DAW', 1),
(3, 'Interfaces', '2º DAW', 1),
(4, 'Despliegue de aplicaciones', '2º DAW', 1),
(5, 'Empresas', '2º DAW', 5),
(6, 'Entornos de Desarrollo', '1º DAW', 1),
(7, 'Sistemas Informaticos', '1º DAW', 1),
(8, 'Lenguaje de Marcas', '1º DAW', 1),
(9, 'Programacón', '1º DAW', 1),
(10, 'Base de Datos', '1º DAW', 1),
(11, 'Formación y Orientación Laboral', '1º DAW', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDepartamento` int(11) NOT NULL,
  `nombreDepartamento` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`idDepartamento`, `nombreDepartamento`) VALUES
(1, 'Informática'),
(2, 'Geografía e Historia'),
(3, 'Matemáticas'),
(4, 'Lengua y Literatura'),
(5, 'Economía'),
(6, 'Física y Química'),
(7, 'Filosofía'),
(8, 'Inglés');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idUsuario` varchar(9) NOT NULL,
  `idAsignatura` int(11) NOT NULL,
  `grupo` varchar(1) DEFAULT NULL,
  `alumnosReserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `fecha`, `idUsuario`, `idAsignatura`, `grupo`, `alumnosReserva`) VALUES
(26, '2025-03-13', '11111111F', 1, 'B', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas-tramo`
--

CREATE TABLE `reservas-tramo` (
  `idReserva` int(11) NOT NULL,
  `idTramo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas-tramo`
--

INSERT INTO `reservas-tramo` (`idReserva`, `idTramo`) VALUES
(26, 'T6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombreRol`) VALUES
(1, 'Profesor'),
(2, 'Vicedirector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramos`
--

CREATE TABLE `tramos` (
  `idTramo` varchar(10) NOT NULL,
  `hora` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tramos`
--

INSERT INTO `tramos` (`idTramo`, `hora`) VALUES
('T1', '8:30 - 9:30'),
('T2', '9:30 - 10:30'),
('T3', '10:30 - 11:30'),
('T4', '12:00 - 13:00'),
('T5', '13:00 - 14:00'),
('T6', '14:00 - 15:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` varchar(9) NOT NULL,
  `contrasena` varchar(70) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `contrasena`, `nombreUsuario`, `apellido1`, `apellido2`, `email`, `idDepartamento`) VALUES
('11111111A', '$2y$10$toB/QRB6ZwxP3zSAs/eJ7uI0RSlEIeOVzHO4kIY5BO4Ib0TtodnP.', 'Noemí', 'Salobreña', 'Torres', 'nsaltor759@g.educaand.es', 1),
('11111111B', '$2y$10$kuaEV6RDiDEJmEbVUUJrZOZwk8dg7sbeBVjiHYDaRUBwYkVXM8Bc.', 'Juan Antonio', 'Chaves', 'Naranjo', 'jchanar975@g.educaand.es', 1),
('11111111C', '$2y$10$bAzL770ZaA7Y8.qHQoubQeK5Cz5Q3lSS7p.CQbM2hmkp0YjD9VKcC', 'Carmelo José', 'Jaén', 'Díaz', 'cjaedia071@g.educaand.es', 1),
('11111111D', '$2y$10$oqOfVdIOkAdL42OYHGAkSuC/.MwV3ICXp4tosLm0h30vlwhUtYKOO', 'Ana', 'Colacio', 'Moyano', 'ana@email.com', 1),
('11111111E', '$2y$10$DTLdvQufPjtIPIcGfgAYXelmbtFSI1arYeMZAvVH8Fx4PTxj0mvvm', 'Juan Jesús', 'Rivillas', 'Canalejo', 'jrivcan2406@g.educaand.es', 1),
('11111111F', '$2y$10$NpxG5GhpLpyIaQeSQQp9heGq05n5flmMX49ABGhE/XYOsUsRz2Nf.', 'Rafael', 'Jiménez', 'Ruiz', 'rjimrui727@g.educaand.es', 1),
('11111111G', '$2y$10$YugnVfVEu3EjMrvFe9PKF.g6wIZAlq7TFEPQrcrI3mcl672L6uKym', 'Daniel', 'Godoy', 'Medina', 'dgodmed486@g.educaand.es', 1),
('11111111H', '$2y$10$lm28iLdz14YEEDcI92ewvuh9O30Z7uZDQjs/x.RFKW0/WWN8Pmco6', 'Ruben', 'Torrico', 'Suarez', 'rtorsua@g.educaand.es', 1),
('11111111I', '$2y$10$pCpjVTlQtdRKY5FFKcACZ.YkW5ntqbBlCryMeixM0fnTTDdl4qjxS', 'Pablo', 'Robles', 'Navas', 'prodnav@g.educaand.es', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios-asignaturas`
--

CREATE TABLE `usuarios-asignaturas` (
  `idUsuario` varchar(9) NOT NULL,
  `idAsignatura` int(11) NOT NULL,
  `numAlumnos` int(5) NOT NULL,
  `grupo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios-asignaturas`
--

INSERT INTO `usuarios-asignaturas` (`idUsuario`, `idAsignatura`, `numAlumnos`, `grupo`) VALUES
('11111111A', 1, 25, 'A'),
('11111111A', 5, 25, ''),
('11111111B', 4, 15, 'A'),
('11111111C', 2, 25, 'C'),
('11111111C', 3, 25, 'A'),
('11111111D', 5, 10, 'C'),
('11111111E', 8, 18, 'B'),
('11111111F', 1, 5, 'B'),
('11111111G', 4, 16, 'A'),
('11111111H', 10, 20, 'B'),
('11111111I', 3, 15, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios-roles`
--

CREATE TABLE `usuarios-roles` (
  `idUsuario` varchar(9) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios-roles`
--

INSERT INTO `usuarios-roles` (`idUsuario`, `idRol`) VALUES
('11111111A', 2),
('11111111B', 1),
('11111111C', 1),
('11111111D', 1),
('11111111E', 1),
('11111111F', 1),
('11111111G', 1),
('11111111H', 1),
('11111111I', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`idAsignatura`),
  ADD KEY `idDepartamento` (`idDepartamento`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idUsuario` (`idUsuario`,`idAsignatura`,`grupo`);

--
-- Indices de la tabla `reservas-tramo`
--
ALTER TABLE `reservas-tramo`
  ADD PRIMARY KEY (`idReserva`,`idTramo`),
  ADD KEY `idTramo` (`idTramo`),
  ADD KEY `idReserva` (`idReserva`) USING BTREE;

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tramos`
--
ALTER TABLE `tramos`
  ADD PRIMARY KEY (`idTramo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idDepartamento` (`idDepartamento`);

--
-- Indices de la tabla `usuarios-asignaturas`
--
ALTER TABLE `usuarios-asignaturas`
  ADD PRIMARY KEY (`idUsuario`,`idAsignatura`,`grupo`),
  ADD KEY `idAsignatura` (`idAsignatura`),
  ADD KEY `idUsuario` (`idUsuario`) USING BTREE;

--
-- Indices de la tabla `usuarios-roles`
--
ALTER TABLE `usuarios-roles`
  ADD PRIMARY KEY (`idUsuario`,`idRol`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idUsuario` (`idUsuario`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `idAsignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`idDepartamento`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idUsuario`,`idAsignatura`,`grupo`) REFERENCES `usuarios-asignaturas` (`idUsuario`, `idAsignatura`, `grupo`);

--
-- Filtros para la tabla `reservas-tramo`
--
ALTER TABLE `reservas-tramo`
  ADD CONSTRAINT `reservas-tramo_ibfk_1` FOREIGN KEY (`idReserva`) REFERENCES `reservas` (`idReserva`),
  ADD CONSTRAINT `reservas-tramo_ibfk_2` FOREIGN KEY (`idTramo`) REFERENCES `tramos` (`idTramo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`idDepartamento`);

--
-- Filtros para la tabla `usuarios-asignaturas`
--
ALTER TABLE `usuarios-asignaturas`
  ADD CONSTRAINT `usuarios-asignaturas_ibfk_1` FOREIGN KEY (`idAsignatura`) REFERENCES `asignaturas` (`idAsignatura`),
  ADD CONSTRAINT `usuarios-asignaturas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `usuarios-roles`
--
ALTER TABLE `usuarios-roles`
  ADD CONSTRAINT `usuarios-roles_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`),
  ADD CONSTRAINT `usuarios-roles_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
