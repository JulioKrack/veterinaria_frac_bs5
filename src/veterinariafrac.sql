-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2023 a las 16:37:12
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
  `nombre` varchar(255) NOT NULL,
  `dni` int(8) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `dni`, `correo`, `usuario`, `contrasenia`, `estado`) VALUES
(1, 'admin1', 123344555, 'admin10@utp.com', 'admin', '$2y$10$.dyfxzChdxk106ZlYjq0cuSafeuND9acOEf4Uao07nXvsBlgoos0G', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Alimento'),
(2, 'Accesorios'),
(3, 'limpieza'),
(4, 'medicina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dni` int(8) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `dni`, `correo`, `usuario`, `contrasenia`, `estado`) VALUES
(1, 'cesar', 2147483647, 'cesar@utp.com', 'cesar', '$2y$10$cNjjuCwojCBPSvkU/No2TuK6dWjChZHx1tYPPf9V1UYF9q2nOf8RO', 1),
(2, 'cliente10', 1232222222, 'cliente10@utp.com', 'cliente10', '$2y$10$fy15pCTq184THqKjrcH0S.6GAij.w7NKKg5YT4j5ggJvqL7UNjMRO', 1),
(5, 'goku', 9999999, 'goku@utp.com', 'goku', '$2y$10$7xF5.8p9qii0rynVn.S55enoKtqJHFegcMyQbfB8gG8ehWOVdm67K', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `id` int(11) NOT NULL,
  `id_cliente` int(8) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompraproducto`
--

CREATE TABLE `detallecompraproducto` (
  `id` int(11) NOT NULL,
  `iddetallecompra` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(8) NOT NULL,
  `id_cliente` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(2) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `raza` varchar(100) NOT NULL,
  `peso` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `id_cliente`, `nombre`, `edad`, `tipo`, `raza`, `peso`) VALUES
(13, 5, 'pikoro', 100, 'lagartija', 'namekusei', 70.00),
(14, 1, 'chems', 5, 'perro', 'Akita inu', 6.00),
(16, 2, 'chi', 10, 'perro', 'shitzu', 15.20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_normal` decimal(10,2) NOT NULL,
  `precio_rebajado` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio_normal`, `precio_rebajado`, `cantidad`, `imagen`, `id_categoria`) VALUES
(2, 'Producto Dos', 'Descripción del Producto Dos', 20.00, 18.00, 15, '20231025162201.jpg', 2),
(3, 'Producto Tres', 'Descripción del Producto Tres', 15.00, 12.50, 10, '20231025162201.jpg', 1),
(4, 'alimento', 'alimento para dog', 50.00, 49.99, 10, '20231212070339.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservadecitas`
--

CREATE TABLE `reservadecitas` (
  `id` int(8) NOT NULL,
  `id_administrador` int(8) NOT NULL,
  `id_cliente` int(8) DEFAULT NULL,
  `id_veterinario` int(8) NOT NULL,
  `fechareserva` date NOT NULL,
  `hora` time NOT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservadecitas`
--

INSERT INTO `reservadecitas` (`id`, `id_administrador`, `id_cliente`, `id_veterinario`, `fechareserva`, `hora`, `asunto`, `estado`) VALUES
(1, 1, 5, 1, '2023-12-15', '11:50:00', 'baño', 3),
(46, 1, NULL, 1, '2023-12-20', '03:32:00', '', 1),
(47, 1, 2, 4, '2023-12-27', '05:36:00', 'baño', 2),
(48, 1, NULL, 4, '2023-12-30', '04:39:00', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinario`
--

CREATE TABLE `veterinario` (
  `id` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dni` int(8) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `veterinario`
--

INSERT INTO `veterinario` (`id`, `nombre`, `dni`, `correo`, `usuario`, `contrasenia`, `estado`) VALUES
(1, 'pancho cavero', 982222828, 'pancho1@utp.com', 'pancho', '$2y$10$HEi14uTggKqQ3/9dhp60peYvXbv81gAlqWM/6qSdTKE4.2m.IjXji', 1),
(4, 'Mr Peet', 321312312, 'mrpeet@utp.com', 'mrpeet', '$2y$10$AnSwHnoGS7vyotyg0taRC.xabapAJaddypK.g8pVrCRQiFXE2RPoa', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `detallecompraproducto`
--
ALTER TABLE `detallecompraproducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddetallecompra` (`iddetallecompra`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente_2` (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `reservadecitas`
--
ALTER TABLE `reservadecitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_administrador` (`id_administrador`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_veterinario` (`id_veterinario`);

--
-- Indices de la tabla `veterinario`
--
ALTER TABLE `veterinario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detallecompraproducto`
--
ALTER TABLE `detallecompraproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reservadecitas`
--
ALTER TABLE `reservadecitas`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `veterinario`
--
ALTER TABLE `veterinario`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `detallecompra_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallecompraproducto`
--
ALTER TABLE `detallecompraproducto`
  ADD CONSTRAINT `detallecompraproducto_ibfk_1` FOREIGN KEY (`iddetallecompra`) REFERENCES `detallecompra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallecompraproducto_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservadecitas`
--
ALTER TABLE `reservadecitas`
  ADD CONSTRAINT `reservadecitas_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `administrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservadecitas_ibfk_3` FOREIGN KEY (`id_veterinario`) REFERENCES `veterinario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservadecitas_ibfk_4` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
