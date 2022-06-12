-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2022 a las 16:01:51
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `garagewash`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auto`
--

CREATE TABLE `auto` (
  `id` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auto`
--

INSERT INTO `auto` (`id`, `placa`, `id_modelo`, `id_cliente`, `status`) VALUES
(3, 'sdf51s', 3, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `domicilio` varchar(60) NOT NULL,
  `telefono` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `cedula`, `nombre`, `apellido`, `domicilio`, `telefono`) VALUES
(1, '20123789', 'Pedro ', 'Suarez', 'Andres Eloy Blanco', '04121234567'),
(2, '7852654', 'Carla', 'Perdomo', 'Ruiz Pineda', '0424789639'),
(3, '21584596', 'Laura', 'Segovia', 'Avenida Libertadores', '04121234567'),
(4, '10584693', 'Jose', 'Sandoval', 'Avenida Pedro Leon', '04121523258');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_producto`
--

CREATE TABLE `entrada_producto` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada_producto`
--

INSERT INTO `entrada_producto` (`id`, `fecha`, `id_producto`, `cantidad`) VALUES
(1, '2012-11-01 00:00:00', 2, 3),
(2, '2021-12-29 00:00:00', 5, 20),
(3, '2021-12-29 00:00:00', 5, 2),
(4, '2021-12-29 00:00:00', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `fecha`, `id_usuario`, `id_auto`, `total`) VALUES
(2, '2012-11-01 00:00:00', 1, 3, '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_servicio`
--

CREATE TABLE `factura_servicio` (
  `id` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura_servicio`
--

INSERT INTO `factura_servicio` (`id`, `id_factura`, `id_servicio`, `precio`) VALUES
(1, 2, 2, '2'),
(2, 2, 4, '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`) VALUES
(2, 'Toyota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `id` int(11) NOT NULL,
  `medida` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`id`, `medida`, `nombre`) VALUES
(3, 250, 'Gramos'),
(4, 10, 'Mililitros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id`, `nombre`, `id_marca`) VALUES
(3, 'corsa', 2),
(4, 'hyuda', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `existencia` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `id_medida`, `precio`, `existencia`, `status`) VALUES
(2, 'detergente', 3, '1', 13, 1),
(5, 'Jabon liquido', 4, '4', 55, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_servicio`
--

CREATE TABLE `producto_servicio` (
  `id` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `medida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `costo` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `costo`, `status`) VALUES
(2, 'Lavado de caucho', '2', 0),
(3, 'Lavado de vidrios', '10', 1),
(4, 'Lavado de puertas', '5', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `clave` varchar(12) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `clave`, `tipo`) VALUES
(1, 'admin', '123456', 0),
(2, 'user', '123456', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modelo` (`id_modelo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auto` (`id_auto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `factura_servicio`
--
ALTER TABLE `factura_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medida` (`id_medida`);

--
-- Indices de la tabla `producto_servicio`
--
ALTER TABLE `producto_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura_servicio`
--
ALTER TABLE `factura_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto_servicio`
--
ALTER TABLE `producto_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`id_modelo`) REFERENCES `modelo` (`id`),
  ADD CONSTRAINT `auto_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  ADD CONSTRAINT `entrada_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_auto`) REFERENCES `auto` (`id`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `factura_servicio`
--
ALTER TABLE `factura_servicio`
  ADD CONSTRAINT `factura_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `factura_servicio_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id`);

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`id`);

--
-- Filtros para la tabla `producto_servicio`
--
ALTER TABLE `producto_servicio`
  ADD CONSTRAINT `producto_servicio_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
