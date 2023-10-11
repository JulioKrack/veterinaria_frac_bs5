-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2023 a las 13:54:00
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinariafrac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(8) NOT NULL,
  `id_persona` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `id_persona`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(8) NOT NULL,
  `id_persona` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `id_persona`) VALUES
(1, 3),
(3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(2) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `id_cliente` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `nombre`, `edad`, `tipo`, `id_cliente`) VALUES
(1, 'Chems', 10, 'Perro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dni` int(8) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `telefono` int(9) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `dni`, `correo`, `usuario`, `contrasenia`, `telefono`, `rol`, `estado`) VALUES
(1, 'Admin', 87654321, 'admin@admin.com', 'admin', '123456', 987654321, 'Administrador', 1),
(3, 'cliente1', 81234567, 'cliente1@cliente.com', 'cliente', '123456', 987654322, 'cliente', 1),
(4, 'veterinario1', 87654421, 'veterinario1@veterinario.com', 'veterinario', '123456', 988654321, 'Veterinario', 1),
(5, 'gojo', 321312, 'gojo@utp.edu.pe', 'gojo1', '123456', 312312312, 'cliente', 1),
(7, 'cliente2', 12312312, 'cliente2@cliente.com', 'cliente2', '123456', 213123123, 'cliente', 1),
(8, 'prueba1234', 123432, 'veterinario@gmail.com', 'veterinario4', '123456', 123456, 'veterinario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservadecitas`
--

CREATE TABLE `reservadecitas` (
  `id` int(8) NOT NULL,
  `fechareserva` date NOT NULL,
  `hora` varchar(10) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_administrador` int(8) NOT NULL,
  `id_veterinario` int(8) NOT NULL,
  `id_cliente` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservadecitas`
--

INSERT INTO `reservadecitas` (`id`, `fechareserva`, `hora`, `asunto`, `estado`, `id_administrador`, `id_veterinario`, `id_cliente`) VALUES
(1, '2023-10-16', '3:00', 'aeiou', 2, 1, 1, 1),
(3, '2023-10-16', '3:00', 'aeiou', 2, 1, 1, 1),
(5, '2023-10-16', '3:00', 'bañobaño', 2, 1, 1, 1),
(7, '2023-10-16', '3:00', 'aeiou', 2, 1, 1, 1),
(8, '2023-10-27', '18:00', 'pruebaprueba', 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinario`
--

CREATE TABLE `veterinario` (
  `id` int(8) NOT NULL,
  `id_persona` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `veterinario`
--

INSERT INTO `veterinario` (`id`, `id_persona`) VALUES
(1, 4),
(2, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpersona` (`id_persona`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservadecitas`
--
ALTER TABLE `reservadecitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_veterinario` (`id_veterinario`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `veterinario`
--
ALTER TABLE `veterinario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo` (`id_persona`),
  ADD KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reservadecitas`
--
ALTER TABLE `reservadecitas`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `veterinario`
--
ALTER TABLE `veterinario`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `reservadecitas`
--
ALTER TABLE `reservadecitas`
  ADD CONSTRAINT `reservadecitas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `reservadecitas_ibfk_2` FOREIGN KEY (`id_veterinario`) REFERENCES `veterinario` (`id`),
  ADD CONSTRAINT `reservadecitas_ibfk_3` FOREIGN KEY (`id_administrador`) REFERENCES `administrador` (`id`);

--
-- Filtros para la tabla `veterinario`
--
ALTER TABLE `veterinario`
  ADD CONSTRAINT `veterinario_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
