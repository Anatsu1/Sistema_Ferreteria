-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2024 a las 01:05:18
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferreteriarozzo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `dniCuil` bigint(50) NOT NULL,
  `credito` double NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cliente`, `dniCuil`, `credito`, `empresa`, `categoria`) VALUES
(1, 'mati', 20382445776, 0, 'Gige y Asociados', 'empresarial'),
(2, 'agus', 45789456, 0, 'gige y asociados', 'empresarial'),
(3, '', 96258741, 1560, 'Gige y asociados', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `compania` varchar(40) NOT NULL,
  `recurrente` tinyint(1) NOT NULL,
  `datos` mediumtext NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `cliente`, `compania`, `recurrente`, `datos`, `fecha`) VALUES
(28, '', '', 0, 'a:2:{i:0;a:3:{s:2:\"id\";s:1:\"9\";s:8:\"cantidad\";s:1:\"3\";s:5:\"valor\";s:3:\"123\";}i:1;a:3:{s:2:\"id\";s:1:\"2\";s:8:\"cantidad\";s:1:\"4\";s:5:\"valor\";s:4:\"35.2\";}}', '2024-04-19'),
(29, '20382445776', 'Mati', 0, 'a:2:{i:0;a:3:{s:2:\"id\";s:1:\"9\";s:8:\"cantidad\";s:1:\"3\";s:5:\"valor\";s:3:\"123\";}i:1;a:3:{s:2:\"id\";s:1:\"2\";s:8:\"cantidad\";s:1:\"4\";s:5:\"valor\";s:4:\"35.2\";}}', '2024-04-19'),
(30, '20382445776', 'Gige y asociados', 0, 'a:1:{i:0;a:3:{s:2:\"id\";s:1:\"9\";s:8:\"cantidad\";s:1:\"3\";s:5:\"valor\";s:3:\"123\";}}', '2024-05-07'),
(31, '20382445776', 'Gige y asociados', 0, 'a:1:{i:0;a:3:{s:2:\"id\";s:1:\"2\";s:8:\"cantidad\";s:1:\"3\";s:5:\"valor\";s:4:\"35.2\";}}', '2024-05-10'),
(32, '20382445776', 'Gige y asociados', 0, 'a:1:{i:0;a:3:{s:2:\"id\";s:2:\"12\";s:8:\"cantidad\";s:1:\"4\";s:5:\"valor\";s:4:\"1000\";}}', '2024-05-10'),
(33, '20382445776', 'Gige y asociados', 0, 'a:1:{i:0;a:3:{s:2:\"id\";s:1:\"3\";s:8:\"cantidad\";s:1:\"5\";s:5:\"valor\";s:5:\"75.69\";}}', '2024-05-10'),
(34, '20382445776', 'Gige y asociados', 0, 'a:2:{i:0;a:3:{s:2:\"id\";s:1:\"3\";s:8:\"cantidad\";s:1:\"4\";s:5:\"valor\";s:5:\"75.69\";}i:1;a:3:{s:2:\"id\";s:1:\"2\";s:8:\"cantidad\";s:1:\"3\";s:5:\"valor\";s:4:\"35.2\";}}', '2024-07-01'),
(35, '20382445776', 'Gige y asociados', 0, 'a:1:{i:0;a:3:{s:2:\"id\";s:2:\"16\";s:8:\"cantidad\";s:2:\"33\";s:5:\"valor\";s:5:\"12343\";}}', '2024-07-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigoProducto` int(10) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `cantidadMinima` int(10) DEFAULT NULL,
  `cantidad` int(50) NOT NULL,
  `divisible` float NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `multiplicador` int(10) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `provedor` varchar(50) NOT NULL,
  `obs` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigoProducto`, `nombre`, `cantidadMinima`, `cantidad`, `divisible`, `imagen`, `valor`, `multiplicador`, `tipo`, `provedor`, `obs`) VALUES
(2, NULL, 'nillos', NULL, 3, 0, '', 35.2, NULL, NULL, 'marshall', NULL),
(3, NULL, 'nillotina', NULL, 450, 0, '', 75.69, NULL, NULL, 'marolio', NULL),
(8, NULL, 's', NULL, 5, 1, '', 1321, NULL, NULL, 'tefo', NULL),
(12, NULL, 'tornillo', NULL, 1, 0, 'imgSubida/tornillo.', 1000, NULL, NULL, 'marshall', NULL),
(13, NULL, 'muffing', NULL, 3, 0, 'imgSubida/muffing.', 123, NULL, NULL, 'marolio', NULL),
(15, NULL, 'tornillos', NULL, 3, 0, 'imagen', 40, NULL, NULL, 'marolio', NULL),
(16, NULL, 'ejemplo de texto largo para compra de carrito xd', NULL, 20, 1, 'imgSubida/ejemplo de texto largo para compra de ca', 12343, NULL, NULL, 'ASUS', NULL),
(17, 2, 'ejemplo_Nuevo', 10, 54, 0, 'imgSubida/ejemplo_Nuevo.', 345, 2, 'tornillos', 'marolio', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provedor`
--

INSERT INTO `provedor` (`id`, `nombre`) VALUES
(2, 'marolio'),
(3, 'marshall'),
(4, 'ASUS'),
(6, 'tefo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `dni` int(9) DEFAULT NULL,
  `contra` varchar(25) NOT NULL,
  `estado` enum('usuario','administrador','socio') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `dni`, `contra`, `estado`) VALUES
(1, 'admin', NULL, 'admin', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `provedor`
--
ALTER TABLE `provedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
