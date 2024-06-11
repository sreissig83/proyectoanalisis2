-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-06-2024 a las 19:03:17
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `meson_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

DROP TABLE IF EXISTS `articulo`;
CREATE TABLE IF NOT EXISTS `articulo` (
  `id_articulo` int NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Autor` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Id_editorial` int NOT NULL,
  `ISBN` int NOT NULL,
  `cod_barra` int NOT NULL,
  `costo` decimal(7,2) NOT NULL,
  `precio_venta` decimal(7,2) NOT NULL,
  `punto_pedido_gral` int NOT NULL,
  `punto_pedido_venta` int NOT NULL,
  PRIMARY KEY (`id_articulo`) USING BTREE,
  KEY `Id_editorial` (`Id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `Titulo`, `Autor`, `Id_editorial`, `ISBN`, `cod_barra`, `costo`, `precio_venta`, `punto_pedido_gral`, `punto_pedido_venta`) VALUES
(1, 'El Señor de los Anillos - Las ', 'J.R.R Toklkien', 25, 1234569526, 55452875, 15000.00, 23000.00, 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'nombre del cliente',
  `Apellido` varchar(25) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'apellido del cliente',
  `CUIT` bigint NOT NULL COMMENT 'cuit del cliente',
  `Domicilio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'domicilio del cliente',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `Nombre`, `Apellido`, `CUIT`, `Domicilio`) VALUES
(1, 'Sebastian', 'Leon', 20325678425, 'Scozzina 1032');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

DROP TABLE IF EXISTS `editorial`;
CREATE TABLE IF NOT EXISTS `editorial` (
  `Id_editorial` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`Id_editorial`, `Nombre`) VALUES
(25, 'Minotauro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `fecha_venta` date NOT NULL,
  `id_cliente` int NOT NULL,
  `tipo_factura` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_punto_venta` int NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_punto_venta` (`id_punto_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_factura`
--

DROP TABLE IF EXISTS `linea_factura`;
CREATE TABLE IF NOT EXISTS `linea_factura` (
  `id_linea_factura` int NOT NULL AUTO_INCREMENT,
  `id_factura` int NOT NULL,
  `id_articulo` int NOT NULL,
  `cantidad_art` int NOT NULL,
  `precio_venta` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_linea_factura`),
  KEY `id_articulo` (`id_articulo`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_mov`
--

DROP TABLE IF EXISTS `linea_mov`;
CREATE TABLE IF NOT EXISTS `linea_mov` (
  `id_linea_mov` int NOT NULL AUTO_INCREMENT,
  `id_mov` int NOT NULL,
  `id_art` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_linea_mov`),
  KEY `idconmov` (`id_mov`),
  KEY `idconart` (`id_art`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `linea_mov`
--

INSERT INTO `linea_mov` (`id_linea_mov`, `id_mov`, `id_art`, `cantidad`) VALUES
(38, 33, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locaciones`
--

DROP TABLE IF EXISTS `locaciones`;
CREATE TABLE IF NOT EXISTS `locaciones` (
  `id` int NOT NULL,
  `nombre` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `locaciones`
--

INSERT INTO `locaciones` (`id`, `nombre`) VALUES
(1, 'Deposito'),
(2, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_movimiento` int NOT NULL AUTO_INCREMENT,
  `fecha_mov` datetime NOT NULL,
  `usuario` int NOT NULL,
  `origen` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `destino` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_movimiento`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_movimiento`, `fecha_mov`, `usuario`, `origen`, `destino`) VALUES
(33, '2024-06-11 16:02:00', 1, 'Deposito', 'PuntoVenta1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `cuenta_de_pago` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `contacto` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cuit` int NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `razon_social`, `cuenta_de_pago`, `contacto`, `cuit`) VALUES
(14, 'Rodrigo Bustamante', '0112463587124598', '3704561234', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos_venta`
--

DROP TABLE IF EXISTS `puntos_venta`;
CREATE TABLE IF NOT EXISTS `puntos_venta` (
  `id_punto_venta` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_punto_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puntos_venta`
--

INSERT INTO `puntos_venta` (`id_punto_venta`, `nombre`) VALUES
(1, 'PuntoVenta1'),
(2, 'PuntoVenta2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_art_prov`
--

DROP TABLE IF EXISTS `rel_art_prov`;
CREATE TABLE IF NOT EXISTS `rel_art_prov` (
  `id_relacion` int NOT NULL AUTO_INCREMENT,
  `id_articulo` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `cod_proveedor` int NOT NULL,
  PRIMARY KEY (`id_relacion`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_articulo` (`id_articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'dataentry'),
(2, 'deposito'),
(3, 'venta'),
(4, 'admin'),
(5, 'lector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `usuario_uname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_passk` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_nombres` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_apellidos` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `usuario_dni` int NOT NULL,
  `usuario_correo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `roles` int NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `roles` (`roles`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `usuario_uname`, `usuario_passk`, `usuario_nombres`, `usuario_apellidos`, `usuario_dni`, `usuario_correo`, `roles`) VALUES
(1, 'admin', '25f9e794323b453885f5181f1b624d0b', 'Administrador', 'Sistema', 9999999, 'admin@meson.com', 4),
(105, 'dataentry', '25f9e794323b453885f5181f1b624d0b', 'data', 'entry', 88888888, 'dentry@meson.com', 1),
(106, 'deposito', '25f9e794323b453885f5181f1b624d0b', 'deposito', 'deposito', 77777777, 'alamcen@meson.com', 2),
(110, 'lector', '25f9e794323b453885f5181f1b624d0b', 'lector', 'lector', 123456789, 'lector@meson.com', 5),
(111, 'venta', '25f9e794323b453885f5181f1b624d0b', 'venta', 'venta', 123456789, 'venta@venta.com', 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_punto_venta`) REFERENCES `puntos_venta` (`id_punto_venta`);

--
-- Filtros para la tabla `linea_factura`
--
ALTER TABLE `linea_factura`
  ADD CONSTRAINT `linea_factura_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`),
  ADD CONSTRAINT `linea_factura_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`);

--
-- Filtros para la tabla `linea_mov`
--
ALTER TABLE `linea_mov`
  ADD CONSTRAINT `linea_mov_ibfk_1` FOREIGN KEY (`id_mov`) REFERENCES `movimientos` (`id_movimiento`),
  ADD CONSTRAINT `linea_mov_ibfk_2` FOREIGN KEY (`id_art`) REFERENCES `articulo` (`id_articulo`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_4` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `rel_art_prov`
--
ALTER TABLE `rel_art_prov`
  ADD CONSTRAINT `rel_art_prov_ibfk_1` FOREIGN KEY (`id_relacion`) REFERENCES `proveedores` (`id_proveedor`),
  ADD CONSTRAINT `rel_art_prov_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`roles`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
