-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2025 a las 19:28:41
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idDepartamento` (`idDepartamento`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`idDepartamento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
