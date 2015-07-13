-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2015 a las 20:21:46
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `durox`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `id_padre` int(11) NOT NULL,
  `nivel_arbol` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellido` varchar(128) NOT NULL,
  `cuit` bigint(12) NOT NULL,
  `id_grupo_cliente` int(11) NOT NULL,
  `id_razon_social` int(11) NOT NULL,
  `imagen` varchar(256) NOT NULL,
  `nombre_fantasia` varchar(128) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `cuit`, `id_grupo_cliente`, `id_razon_social`, `imagen`, `nombre_fantasia`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Cristian', 'Nieto', 20320299579, 1, 2, 'http://localhost/Durox/img/clientes/User1.jpg', '', '2015-06-01 00:00:00', '2015-06-02 00:00:00', 0, 0, 0),
(2, 'Diego', 'Nieto', 32221299579, 1, 1, 'http://localhost/Durox/img/clientes/User2.jpg', 'Cabeza', '2015-06-03 00:00:00', '2015-06-03 00:00:00', 0, 0, 0),
(3, 'Nuevo', 'Prueba', 23135568429, 1, 2, '', '', '2015-06-10 00:00:00', '2015-06-10 00:00:00', 1, 0, 0),
(5, 'Estoes', 'UnaPrueba', 1234567891, 1, 1, 'http://localhost/Durox/img/clientes/Penguins.jpg', 'Prueba', '2015-06-17 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(6, 'Alejandro', 'Weber', 23561234569, 6, 2, 'http://localhost/Durox/img/clientes/Lighthouse.jpg', 'Ale', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 'silvia', 'garcia', 2651558449, 1, 2, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 'teresa', 'riquelme', 2655154159, 1, 2, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(64) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`, `id_provincia`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Godoy Cruz', 1, '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE IF NOT EXISTS `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `direccion` varchar(128) NOT NULL,
  `cod_postal` varchar(32) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `id_tipo`, `id_departamento`, `id_provincia`, `id_pais`, `direccion`, `cod_postal`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, 1, 1, 'Calle falsa 123', '231', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 1, 1, 1, 1, 'No soy una calle', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 2, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 2, 1, 1, 1, 'Otra prueba', '4141', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 2, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(13, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(14, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(15, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(16, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(17, 1, 1, 1, 1, 'Calle', '2623', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(18, 1, 1, 1, 1, 'Burgos', '5000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(19, 2, 1, 1, 1, 'Burgos', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(20, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(21, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(22, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(23, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(24, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(25, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(26, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(27, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(28, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(29, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(30, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(31, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(32, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(33, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(34, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(35, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(36, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(37, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(38, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(39, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(40, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(41, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(42, 2, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(43, 2, 1, 1, 1, 'Calle falsa 123', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(44, 1, 1, 1, 1, 'Costanera 1948', '5501', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(45, 2, 1, 1, 1, 'Calle falsa 123', '2623', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nombre`, `user_add`, `user_upd`) VALUES
(1, 'Durox', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_pedidos`
--

CREATE TABLE IF NOT EXISTS `estados_pedidos` (
  `id_estado_pedido` int(11) NOT NULL,
  `estado` varchar(64) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` int(11) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_pedidos`
--

INSERT INTO `estados_pedidos` (`id_estado_pedido`, `estado`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Enviado', '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(2, 'En Proceso', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 'Imposible de Enviar', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_presupuestos`
--

CREATE TABLE IF NOT EXISTS `estados_presupuestos` (
  `id_estado_presupuesto` int(11) NOT NULL,
  `estado` varchar(64) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_presupuestos`
--

INSERT INTO `estados_presupuestos` (`id_estado_presupuesto`, `estado`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Generado', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(2, 'Enviado a Cliente', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 'Anulado', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(4, 'Generar Pedido', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_productos_pedidos`
--

CREATE TABLE IF NOT EXISTS `estados_productos_pedidos` (
  `id_estado_producto_pedido` int(11) NOT NULL,
  `estado` varchar(64) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_productos_pedidos`
--

INSERT INTO `estados_productos_pedidos` (`id_estado_producto_pedido`, `estado`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Enviado', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(2, 'En Proceso', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 'Imposible de Enviar', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_productos_presupuestos`
--

CREATE TABLE IF NOT EXISTS `estados_productos_presupuestos` (
  `id_estado_producto_presupuesto` int(11) NOT NULL,
  `estado` varchar(64) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_productos_presupuestos`
--

INSERT INTO `estados_productos_presupuestos` (`id_estado_producto_presupuesto`, `estado`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'En Espera', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(2, 'Aceptado', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 'Rechazado', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_clientes`
--

CREATE TABLE IF NOT EXISTS `grupos_clientes` (
  `id_grupo_cliente` int(11) NOT NULL,
  `grupo_nombre` varchar(64) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos_clientes`
--

INSERT INTO `grupos_clientes` (`id_grupo_cliente`, `grupo_nombre`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Sin grupo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 'Mas grupos', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 'Sin grupo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 'Nuevos', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 'Otro', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 'Cristian', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 'Nuevos', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 'Otro', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 'Prueba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 'Prueba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 'Prueba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 'Prueba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(13, 'Otro', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(14, 'Compra poco', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(15, 'Compra poco', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(16, 'Otro', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(17, 'Compra poco', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva`
--

CREATE TABLE IF NOT EXISTS `iva` (
  `id_iva` int(11) NOT NULL,
  `iva` float NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_productos_pedidos`
--

CREATE TABLE IF NOT EXISTS `linea_productos_pedidos` (
  `id_linea_producto_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_estado_producto_pedido` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea_productos_pedidos`
--

INSERT INTO `linea_productos_pedidos` (`id_linea_producto_pedido`, `id_pedido`, `id_producto`, `precio`, `cantidad`, `id_estado_producto_pedido`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, 40, 3, 1, '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(2, 1, 2, 100, 2, 1, '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(3, 1, 3, 5, 10, 1, '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_productos_presupuestos`
--

CREATE TABLE IF NOT EXISTS `linea_productos_presupuestos` (
  `id_linea_producto_presupuesto` int(11) NOT NULL,
  `id_presupuesto` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_estado_producto_presupuesto` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
  `id_mail` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mails`
--

INSERT INTO `mails` (`id_mail`, `id_tipo`, `mail`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 2, 'cristiannieto101@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 1, 'ad_gonzalez@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 2, 'adgonzalez@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 1, 'otrocorreo@aosdaskdaks.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 2, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 1, 'alejandro.weber@tmsgroup.com.ar', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 1, 'asodjaopsjopdapso@aosdaskdaks.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(13, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(14, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(15, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(16, 1, 'cristiannemesis101@hotmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id_pais` int(11) NOT NULL,
  `nombre_pais` varchar(128) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id_pais`, `nombre_pais`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Argentina', '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(2, 'Chile', '2015-06-24 00:00:00', '2015-06-24 00:00:00', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `id_presupuesto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_estado_pedido` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_visita`, `id_presupuesto`, `id_cliente`, `id_vendedor`, `id_estado_pedido`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, 1, 1, 1, '2015-06-15 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(2, 2, 0, 3, 1, 1, '2015-06-16 07:00:00', '2015-06-16 07:27:12', 0, 0, 0),
(3, 4, 4, 2, 2, 2, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE IF NOT EXISTS `presupuestos` (
  `id_presupuesto` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_estado_presupuesto` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`id_presupuesto`, `id_visita`, `id_cliente`, `id_vendedor`, `id_estado_presupuesto`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, 1, 4, '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(2, 3, 2, 1, 2, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 4, 2, 2, 3, '2015-06-17 00:00:00', '2015-06-17 00:00:00', 0, 0, 0),
(4, 4, 2, 2, 4, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `precio` float NOT NULL,
  `precio_iva` float NOT NULL,
  `precio_min` float NOT NULL,
  `precio_min_iva` float NOT NULL,
  `id_iva` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `precio_iva`, `precio_min`, `precio_min_iva`, `id_iva`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Producto 1', 0, 0, 0, 0, 0, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(2, 'Producto 2', 0, 0, 0, 0, 0, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 'Producto 3', 0, 0, 0, 0, 0, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(4, 'Producto 4', 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id_provincia` int(11) NOT NULL,
  `nombre_provincia` varchar(128) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nombre_provincia`, `id_pais`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Mendoza', 1, '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(2, 'Buenos Aires', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 'San Juan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 'San Luis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 'Cordoba', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 'Santiago', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 'Viña del Mar', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razon_social`
--

CREATE TABLE IF NOT EXISTS `razon_social` (
  `id_razon_social` int(11) NOT NULL,
  `razon_social` varchar(64) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `razon_social`
--

INSERT INTO `razon_social` (`id_razon_social`, `razon_social`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Monotributista', '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0),
(2, 'Responsable Inscripto', '2015-06-16 00:00:00', '2015-06-16 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reglas`
--

CREATE TABLE IF NOT EXISTS `reglas` (
  `id_regla` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `id_grupo_cliente` int(11) NOT NULL,
  `valor` float NOT NULL,
  `aumento_descuento` tinyint(1) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reglas`
--

INSERT INTO `reglas` (`id_regla`, `nombre`, `id_grupo_cliente`, `valor`, `aumento_descuento`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Cristian', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 'Cristian', 2, 120, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 'Cristian', 3, 120, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 'Descuento', 4, 25, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 'a ver', 5, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 'Cristian', 6, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 'Cristianotro', 7, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 'Cristian', 8, 12, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 'Prueba', 9, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 'Prueba', 10, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 'Prueba', 11, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 'Prueba', 12, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(13, 'Cristian', 13, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(14, 'a ver', 14, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(15, 'a ver', 15, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(16, 'Cristian', 16, 12, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(17, 'a ver', 17, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_clientes_direcciones`
--

CREATE TABLE IF NOT EXISTS `sin_clientes_direcciones` (
  `id_sin_cliente_direccion` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_clientes_direcciones`
--

INSERT INTO `sin_clientes_direcciones` (`id_sin_cliente_direccion`, `id_cliente`, `id_direccion`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 6, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 1, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 1, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 1, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 1, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 1, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 1, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 1, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(13, 1, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(14, 1, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(15, 1, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(16, 1, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(17, 1, 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(18, 1, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(19, 1, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(20, 1, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(21, 1, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(22, 6, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(23, 3, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(24, 3, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(25, 1, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(26, 1, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(27, 1, 33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(28, 1, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(29, 1, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(30, 1, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(31, 1, 37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(32, 1, 38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(33, 1, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(34, 1, 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(35, 6, 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(36, 6, 43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(37, 6, 44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(38, 6, 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_clientes_mails`
--

CREATE TABLE IF NOT EXISTS `sin_clientes_mails` (
  `id_sin_cliente_mail` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mail` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_clientes_mails`
--

INSERT INTO `sin_clientes_mails` (`id_sin_cliente_mail`, `id_cliente`, `id_mail`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 6, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 1, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 1, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 6, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 6, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 6, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 6, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 6, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 6, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 6, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_clientes_telefonos`
--

CREATE TABLE IF NOT EXISTS `sin_clientes_telefonos` (
  `id_sin_cliente_telefono` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_telefono` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_clientes_telefonos`
--

INSERT INTO `sin_clientes_telefonos` (`id_sin_cliente_telefono`, `id_cliente`, `id_telefono`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, '2015-06-15 00:00:00', '2015-06-15 00:00:00', 0, 0, 0),
(2, 1, 2, '2015-06-15 00:00:00', '2015-06-15 00:00:00', 0, 0, 0),
(3, 5, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 3, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 3, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 1, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 6, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 1, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 1, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 1, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 1, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 1, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(13, 1, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(14, 6, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(15, 1, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(16, 1, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(17, 1, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(18, 1, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(19, 1, 33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(20, 6, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_productos_categorias`
--

CREATE TABLE IF NOT EXISTS `sin_productos_categorias` (
  `id_sin_producto_categoria` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_reglas_categorias`
--

CREATE TABLE IF NOT EXISTS `sin_reglas_categorias` (
  `id_sin_regla_categoria` int(11) NOT NULL,
  `id_regla` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_vendedores_clientes`
--

CREATE TABLE IF NOT EXISTS `sin_vendedores_clientes` (
  `id_sin_vendedor_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_vendedores_clientes`
--

INSERT INTO `sin_vendedores_clientes` (`id_sin_vendedor_cliente`, `id_vendedor`, `id_cliente`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0),
(4, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_vendedores_direcciones`
--

CREATE TABLE IF NOT EXISTS `sin_vendedores_direcciones` (
  `id_sin_vendedor_direccion` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_vendedores_direcciones`
--

INSERT INTO `sin_vendedores_direcciones` (`id_sin_vendedor_direccion`, `id_vendedor`, `id_direccion`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 1, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 1, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 2, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 2, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 1, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 1, 42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_vendedores_mails`
--

CREATE TABLE IF NOT EXISTS `sin_vendedores_mails` (
  `id_sin_vendedor_mail` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_mail` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_vendedores_mails`
--

INSERT INTO `sin_vendedores_mails` (`id_sin_vendedor_mail`, `id_vendedor`, `id_mail`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 1, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(3, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 1, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_vendedores_telefonos`
--

CREATE TABLE IF NOT EXISTS `sin_vendedores_telefonos` (
  `id_sin_vendedor_telefono` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_telefono` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_vendedores_telefonos`
--

INSERT INTO `sin_vendedores_telefonos` (`id_sin_vendedor_telefono`, `id_vendedor`, `id_telefono`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 1, 3, '2015-06-23 00:00:00', '2015-06-23 00:00:00', 0, 1, 1),
(3, 2, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 1, 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 1, 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 1, 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 1, 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 2, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 1, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 1, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 1, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sin_visitas_presupuestos`
--

CREATE TABLE IF NOT EXISTS `sin_visitas_presupuestos` (
  `id_sin_visita_presupuesto` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `id_presupuesto` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sin_visitas_presupuestos`
--

INSERT INTO `sin_visitas_presupuestos` (`id_sin_visita_presupuesto`, `id_visita`, `id_presupuesto`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(2, 3, 2, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 4, 3, '2015-06-17 00:00:00', '2015-06-17 00:00:00', 0, 0, 0),
(4, 4, 4, '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE IF NOT EXISTS `telefonos` (
  `id_telefono` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `telefono` bigint(12) NOT NULL,
  `cod_area` int(6) NOT NULL,
  `fax` tinyint(1) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `telefonos`
--

INSERT INTO `telefonos` (`id_telefono`, `id_tipo`, `telefono`, `cod_area`, `fax`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 2, 4396721, 261, 0, '2015-06-15 00:00:00', '2015-06-15 00:00:00', 0, 0, 0),
(2, 2, 4167442, 261, 0, '2015-06-15 00:00:00', '2015-06-15 00:00:00', 0, 0, 0),
(3, 1, 4, 261, 0, '2015-06-22 00:00:00', '2015-06-22 00:00:00', 0, 1, 1),
(4, 1, 4250568, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 2, 4525252, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(6, 2, 4202668, 251, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(9, 1, 4396721, 261, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(10, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(11, 2, 5164587, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(12, 1, 4455678, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(13, 1, 4345465, 2623, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(14, 2, 5996854, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(15, 2, 4356595, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(16, 1, 4355642, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(17, 1, 4250568, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(18, 1, 4250568, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(19, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(20, 1, 5164587, 251, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(21, 1, 5153216, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(22, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(23, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(24, 1, 5, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(25, 1, 4396721, 2623, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(26, 1, 4250568, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(27, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(28, 1, 5134368, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(29, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(30, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(31, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(32, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(33, 1, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(34, 1, 4, 261, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(35, 2, 4396721, 261, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id_tipo`, `tipo`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Hogar', '2015-06-15 00:00:00', '2015-06-15 00:00:00', 0, 0, 0),
(2, 'Personal', '2015-06-15 00:00:00', '2015-06-15 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE IF NOT EXISTS `vendedores` (
  `id_vendedor` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellido` varchar(128) NOT NULL,
  `contraseña` varchar(64) NOT NULL,
  `imagen` varchar(256) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id_vendedor`, `nombre`, `apellido`, `contraseña`, `imagen`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 'Alfonso', 'Gonzalez', '2222', 'http://localhost/Durox/img/vendedores/Penguins.jpg', '2015-06-01 00:00:00', '2015-06-02 00:00:00', 0, 0, 0),
(2, 'Otro', 'Vendedor', '111111', 'http://localhost/Durox/img/vendedores/', '2015-06-10 00:00:00', '2015-06-11 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
  `id_visita` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `eliminado` tinyint(2) NOT NULL,
  `user_add` int(11) NOT NULL,
  `user_upd` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visita`, `id_vendedor`, `id_cliente`, `descripcion`, `date_add`, `date_upd`, `eliminado`, `user_add`, `user_upd`) VALUES
(1, 1, 1, '', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(2, 1, 3, '', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(3, 1, 2, '', '2015-06-18 00:00:00', '2015-06-19 00:00:00', 0, 0, 0),
(4, 2, 2, '', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0),
(5, 2, 1, '', '2015-06-18 00:00:00', '2015-06-18 00:00:00', 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indices de la tabla `estados_presupuestos`
--
ALTER TABLE `estados_presupuestos`
  ADD PRIMARY KEY (`id_estado_presupuesto`);

--
-- Indices de la tabla `estados_productos_pedidos`
--
ALTER TABLE `estados_productos_pedidos`
  ADD PRIMARY KEY (`id_estado_producto_pedido`);

--
-- Indices de la tabla `estados_productos_presupuestos`
--
ALTER TABLE `estados_productos_presupuestos`
  ADD PRIMARY KEY (`id_estado_producto_presupuesto`);

--
-- Indices de la tabla `grupos_clientes`
--
ALTER TABLE `grupos_clientes`
  ADD PRIMARY KEY (`id_grupo_cliente`);

--
-- Indices de la tabla `iva`
--
ALTER TABLE `iva`
  ADD PRIMARY KEY (`id_iva`);

--
-- Indices de la tabla `linea_productos_pedidos`
--
ALTER TABLE `linea_productos_pedidos`
  ADD PRIMARY KEY (`id_linea_producto_pedido`);

--
-- Indices de la tabla `linea_productos_presupuestos`
--
ALTER TABLE `linea_productos_presupuestos`
  ADD PRIMARY KEY (`id_linea_producto_presupuesto`);

--
-- Indices de la tabla `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id_mail`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id_presupuesto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `razon_social`
--
ALTER TABLE `razon_social`
  ADD PRIMARY KEY (`id_razon_social`);

--
-- Indices de la tabla `reglas`
--
ALTER TABLE `reglas`
  ADD PRIMARY KEY (`id_regla`);

--
-- Indices de la tabla `sin_clientes_direcciones`
--
ALTER TABLE `sin_clientes_direcciones`
  ADD PRIMARY KEY (`id_sin_cliente_direccion`);

--
-- Indices de la tabla `sin_clientes_mails`
--
ALTER TABLE `sin_clientes_mails`
  ADD PRIMARY KEY (`id_sin_cliente_mail`);

--
-- Indices de la tabla `sin_clientes_telefonos`
--
ALTER TABLE `sin_clientes_telefonos`
  ADD PRIMARY KEY (`id_sin_cliente_telefono`);

--
-- Indices de la tabla `sin_productos_categorias`
--
ALTER TABLE `sin_productos_categorias`
  ADD PRIMARY KEY (`id_sin_producto_categoria`);

--
-- Indices de la tabla `sin_reglas_categorias`
--
ALTER TABLE `sin_reglas_categorias`
  ADD PRIMARY KEY (`id_sin_regla_categoria`);

--
-- Indices de la tabla `sin_vendedores_clientes`
--
ALTER TABLE `sin_vendedores_clientes`
  ADD PRIMARY KEY (`id_sin_vendedor_cliente`);

--
-- Indices de la tabla `sin_vendedores_direcciones`
--
ALTER TABLE `sin_vendedores_direcciones`
  ADD PRIMARY KEY (`id_sin_vendedor_direccion`);

--
-- Indices de la tabla `sin_vendedores_mails`
--
ALTER TABLE `sin_vendedores_mails`
  ADD PRIMARY KEY (`id_sin_vendedor_mail`);

--
-- Indices de la tabla `sin_vendedores_telefonos`
--
ALTER TABLE `sin_vendedores_telefonos`
  ADD PRIMARY KEY (`id_sin_vendedor_telefono`);

--
-- Indices de la tabla `sin_visitas_presupuestos`
--
ALTER TABLE `sin_visitas_presupuestos`
  ADD PRIMARY KEY (`id_sin_visita_presupuesto`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`id_telefono`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id_vendedor`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_visita`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  MODIFY `id_estado_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estados_presupuestos`
--
ALTER TABLE `estados_presupuestos`
  MODIFY `id_estado_presupuesto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estados_productos_pedidos`
--
ALTER TABLE `estados_productos_pedidos`
  MODIFY `id_estado_producto_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estados_productos_presupuestos`
--
ALTER TABLE `estados_productos_presupuestos`
  MODIFY `id_estado_producto_presupuesto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `grupos_clientes`
--
ALTER TABLE `grupos_clientes`
  MODIFY `id_grupo_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `iva`
--
ALTER TABLE `iva`
  MODIFY `id_iva` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `linea_productos_pedidos`
--
ALTER TABLE `linea_productos_pedidos`
  MODIFY `id_linea_producto_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `linea_productos_presupuestos`
--
ALTER TABLE `linea_productos_presupuestos`
  MODIFY `id_linea_producto_presupuesto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mails`
--
ALTER TABLE `mails`
  MODIFY `id_mail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `razon_social`
--
ALTER TABLE `razon_social`
  MODIFY `id_razon_social` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `reglas`
--
ALTER TABLE `reglas`
  MODIFY `id_regla` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `sin_clientes_direcciones`
--
ALTER TABLE `sin_clientes_direcciones`
  MODIFY `id_sin_cliente_direccion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `sin_clientes_mails`
--
ALTER TABLE `sin_clientes_mails`
  MODIFY `id_sin_cliente_mail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `sin_clientes_telefonos`
--
ALTER TABLE `sin_clientes_telefonos`
  MODIFY `id_sin_cliente_telefono` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `sin_productos_categorias`
--
ALTER TABLE `sin_productos_categorias`
  MODIFY `id_sin_producto_categoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sin_reglas_categorias`
--
ALTER TABLE `sin_reglas_categorias`
  MODIFY `id_sin_regla_categoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sin_vendedores_clientes`
--
ALTER TABLE `sin_vendedores_clientes`
  MODIFY `id_sin_vendedor_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sin_vendedores_direcciones`
--
ALTER TABLE `sin_vendedores_direcciones`
  MODIFY `id_sin_vendedor_direccion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sin_vendedores_mails`
--
ALTER TABLE `sin_vendedores_mails`
  MODIFY `id_sin_vendedor_mail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sin_vendedores_telefonos`
--
ALTER TABLE `sin_vendedores_telefonos`
  MODIFY `id_sin_vendedor_telefono` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `sin_visitas_presupuestos`
--
ALTER TABLE `sin_visitas_presupuestos`
  MODIFY `id_sin_visita_presupuesto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  MODIFY `id_telefono` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
