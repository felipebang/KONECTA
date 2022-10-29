-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-10-2022 a las 05:19:01
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shop_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `day`
--

DROP TABLE IF EXISTS `day`;
CREATE TABLE IF NOT EXISTS `day` (
  `id_day` int(11) NOT NULL AUTO_INCREMENT,
  `name_day` varchar(10) NOT NULL,
  PRIMARY KEY (`id_day`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `day`
--

INSERT INTO `day` (`id_day`, `name_day`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'sábado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestionar_valores`
--

DROP TABLE IF EXISTS `gestionar_valores`;
CREATE TABLE IF NOT EXISTS `gestionar_valores` (
  `id_valor` int(11) NOT NULL AUTO_INCREMENT,
  `Valor_Domicilio_Minimo` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id_valor`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gestionar_valores`
--

INSERT INTO `gestionar_valores` (`id_valor`, `Valor_Domicilio_Minimo`, `nombre`) VALUES
(11, 0, 'Domicilio'),
(22, 0, 'Monto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedidos`
--

DROP TABLE IF EXISTS `orden_pedidos`;
CREATE TABLE IF NOT EXISTS `orden_pedidos` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime` varchar(25) NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `peso` varchar(20) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `cantidad` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`, `precio`, `peso`, `categoria`, `date`, `cantidad`) VALUES
(50, 'Donas', '1666983980_istockphoto-470008813-612x612.jpg', 'buena calidad                                                                                                           ', '250', '425436', 'Postres', '2022-10-29', '25'),
(54, 'Churros', '-', 'buena calidad             ', '12', '25000', 'Postres', '2022-10-29', '20'),
(55, 'Coffee pastries', '', 'buena calida                                           ', '955', '5', 'Postres', '2022-10-29', '44'),
(56, 'Cupcakes  ', '', 'buena calidad                 ', '6', '65', 'Postres', '2022-10-29', '30'),
(58, 'CoctelerÃ­a con cafÃ©', '', 'buena calidad ', '1212', '220', 'Bebidas', '2022-10-29', '20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ciudad` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `ndireccion` varchar(3) NOT NULL,
  `ncasa` varchar(3) NOT NULL,
  `n1casa` varchar(3) NOT NULL,
  `barrio` varchar(200) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `apellido`, `celular`, `email`, `password`, `ciudad`, `direccion`, `ndireccion`, `ncasa`, `n1casa`, `barrio`, `user_type`) VALUES
(34, 'usuario', 'usuario', '3123523', 'usuario@usuario.co', '401cec94d3ed586d8cb895c10c0f7db6', 'Palmira', 'Calle', 'asd', '3', '0', 'palm', 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `name_product` varchar(50) NOT NULL,
  `price_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `fecha_venta` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_day` int(11) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `id_day` (`id_day`),
  KEY `name_day` (`id_day`),
  KEY `id_day_2` (`id_day`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_day`) REFERENCES `day` (`id_day`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
