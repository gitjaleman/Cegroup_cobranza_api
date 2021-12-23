-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2021 a las 18:37:24
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cegroup`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acuerdos`
--

CREATE TABLE `acuerdos` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `cliente` varchar(30) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `facuerdo` date DEFAULT NULL,
  `fregistro` date DEFAULT NULL,
  `asesor` varchar(10) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `valor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `asesor` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `alerta` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `asesor` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base`
--

CREATE TABLE `base` (
  `operacion` bigint(20) NOT NULL,
  `cuenta` int(20) DEFAULT NULL,
  `tcedula` int(20) DEFAULT NULL,
  `tnombre` varchar(60) DEFAULT NULL,
  `ttel1` varchar(40) DEFAULT NULL,
  `ttel2` varchar(40) DEFAULT NULL,
  `ccedula` int(20) DEFAULT NULL,
  `cnombre` varchar(60) DEFAULT NULL,
  `ctel1` varchar(40) DEFAULT NULL,
  `ctel2` varchar(40) DEFAULT NULL,
  `gcedula` int(20) DEFAULT NULL,
  `gnombre` varchar(60) DEFAULT NULL,
  `gtel1` varchar(40) DEFAULT NULL,
  `gtel2` varchar(40) DEFAULT NULL,
  `fingreso` date DEFAULT NULL,
  `sucursal` varchar(40) DEFAULT NULL,
  `condicion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campana`
--

CREATE TABLE `campana` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `campana` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera`
--

CREATE TABLE `cartera` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `cartera` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decil`
--

CREATE TABLE `decil` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `decil` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(20) NOT NULL,
  `estado` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiones`
--

CREATE TABLE `gestiones` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `asesor` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `gestion` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `asesor` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `pago` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `sub` varchar(60) DEFAULT NULL,
  `fgestion` date DEFAULT NULL,
  `asesor` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldos`
--

CREATE TABLE `saldos` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `capital` varchar(20) DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subs`
--

CREATE TABLE `subs` (
  `id` int(20) NOT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `sub` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `id` int(20) NOT NULL,
  `operacion` bigint(20) DEFAULT NULL,
  `asesor` varchar(10) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioll`
--

CREATE TABLE `usuarioll` (
  `cedula` int(20) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(40) NOT NULL,
  `usertype` int(1) NOT NULL,
  `avatar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarioll`
--

INSERT INTO `usuarioll` (`cedula`, `nombre`, `telefono`, `username`, `password`, `usertype`, `avatar`) VALUES
(123456, 'LUIS ALEMAN', '322468566', 'JALEMAN', '202cb962ac59075b964b07152d234b70', 0, '1'),
(12345678, 'JAVIER MORA', '3224685663', 'JALEMAN', '202cb962ac59075b964b07152d234b70', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` int(20) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `avatar` varchar(6) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `userpass` varchar(100) DEFAULT NULL,
  `usertype` int(1) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `nombre`, `telefono`, `avatar`, `username`, `userpass`, `usertype`, `estado`) VALUES
(123456, 'LUIS ALEMAN', 3224685663, '1', 'JALEMAN', '202cb962ac59075b964b07152d234b70', 1, 'TRUE');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acuerdos`
--
ALTER TABLE `acuerdos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`operacion`);

--
-- Indices de la tabla `campana`
--
ALTER TABLE `campana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cartera`
--
ALTER TABLE `cartera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `decil`
--
ALTER TABLE `decil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gestiones`
--
ALTER TABLE `gestiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `saldos`
--
ALTER TABLE `saldos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarioll`
--
ALTER TABLE `usuarioll`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acuerdos`
--
ALTER TABLE `acuerdos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campana`
--
ALTER TABLE `campana`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cartera`
--
ALTER TABLE `cartera`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `decil`
--
ALTER TABLE `decil`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gestiones`
--
ALTER TABLE `gestiones`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `saldos`
--
ALTER TABLE `saldos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subs`
--
ALTER TABLE `subs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
