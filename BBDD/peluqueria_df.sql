-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2022 a las 15:49:56
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peluqueria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Asiento` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`ID`, `Nombre`, `Apellidos`, `Fecha`, `Hora`, `Asiento`) VALUES
(7, 'Manuel', 'Lopez', '2022-11-17', '17:40:00', 2),
(8, 'Rebeca', 'Sanchez', '2022-11-18', '14:45:00', 3),
(10, 'Sonia', 'Alcantara', '2022-11-11', '16:15:00', 2),
(11, 'Manuel', 'Lopez', '2022-11-16', '16:30:00', 1),
(13, 'Sonia', 'Alcantara', '2022-11-19', '17:15:00', 1),
(14, 'Sonia', 'Alcantara', '2022-11-18', '21:30:00', 2),
(15, 'Jack', 'Blue', '2022-11-28', '22:30:00', 3),
(21, 'Marina', 'Sanchez', '2022-11-29', '18:00:00', 1),
(24, 'Marina', 'Sanchez', '2022-12-08', '18:45:00', 2),
(31, 'Manuel', 'Lopez', '2022-12-14', '19:30:00', 2),
(32, 'Isabel', 'Paez', '2022-12-10', '17:30:00', 2),
(33, 'Daniel', 'Ramirez', '2022-11-12', '18:30:00', 1),
(34, 'Daniel', 'Ramirez', '2022-11-21', '17:30:00', 1),
(41, 'Marina', 'Sanchez', '2022-12-14', '19:15:00', 3),
(44, 'Marina', 'Sanchez', '2022-11-30', '11:30:00', 2),
(45, 'Daniel ', 'Martinez', '2022-11-24', '10:15:00', 2),
(46, 'Daniel', 'Ramirez', '2022-12-01', '20:00:00', 3),
(47, 'Marina', 'Sanchez', '2022-11-30', '12:30:00', 1),
(48, 'Javier', 'Perez', '2022-12-15', '13:45:00', 2),
(49, 'Javier', 'Perez', '2022-12-23', '15:30:00', 1),
(50, 'Javier', 'Perez', '2022-12-30', '19:15:00', 3),
(51, 'Rosa', 'Navarro', '2022-12-23', '14:45:00', 3),
(52, 'Rosa', 'Navarro', '2022-12-30', '16:30:00', 2),
(53, 'Tamara', 'Rodriguez', '2022-12-23', '18:00:00', 2),
(54, 'Tamara', 'Rodriguez', '2022-12-30', '16:45:00', 1),
(55, 'Paula', 'Londra', '2022-12-23', '18:45:00', 1),
(56, 'Paula', 'Londra', '2022-12-29', '14:45:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `setup`
--

CREATE TABLE `setup` (
  `Host` varchar(20) NOT NULL,
  `SuperAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `setup`
--

INSERT INTO `setup` (`Host`, `SuperAdmin`) VALUES
('localhost', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `apellidos`, `usuario`, `password`) VALUES
(1, 'John', 'Smith', 'jsmith90', 'qwerty'),
(2, 'Manuel', 'Lopez', 'malop15', '12345'),
(3, 'Edmundo', 'Jimenez', 'edij98', '9876'),
(4, 'Rebeca', 'Sanchez', 'rbksan', 'qazsd'),
(5, 'Isabel', 'Paez', 'isapaez45', 'poiuy'),
(6, 'Sonia', 'Alcantara', 'sykalcant', 'sykaos'),
(10, 'Paco', 'Paredes', 'paredes90', 'perrito54'),
(11, 'Jack', 'Blue', 'bluestacks88', '9899'),
(16, 'Alba', 'Majo', 'albmaj', '123456'),
(18, 'Marina', 'Sanchez', 'marsanchez', 'pandarina'),
(20, 'Daniel', 'Ramirez', 'dram', '1122'),
(26, 'Tamara', 'Rodriguez', 'tamrod', '7822'),
(33, 'Javier', 'Perez', 'calikete', 'elden'),
(34, 'Rosa', 'Navarro', 'rosnav', 'ross22'),
(35, 'Paula', 'Londra', 'paulond', 'asdel');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `misma_cita` (`Fecha`,`Hora`,`Asiento`);

--
-- Indices de la tabla `setup`
--
ALTER TABLE `setup`
  ADD UNIQUE KEY `SuperAdmin` (`SuperAdmin`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
