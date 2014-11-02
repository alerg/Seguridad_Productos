-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2014 a las 07:06:54
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `scaw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `IdComentario` int(11) NOT NULL AUTO_INCREMENT,
  `IdProducto` int(11) NOT NULL,
  `CuerpoComentario` varchar(255) NOT NULL,
  `FechaComentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdComentario`),
  KEY `IdProducto` (`IdProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`IdComentario`, `IdProducto`, `CuerpoComentario`, `FechaComentario`) VALUES
(1, 1, 'MUY CARO!!!', '2014-11-01 05:51:24'),
(4, 1, 're caro loco!!!', '2014-11-01 06:03:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarioanonimo`
--

CREATE TABLE IF NOT EXISTS `comentarioanonimo` (
  `IdComentario` int(11) NOT NULL,
  `NickName` varchar(255) NOT NULL,
  KEY `IdComentario` (`IdComentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarioanonimo`
--

INSERT INTO `comentarioanonimo` (`IdComentario`, `NickName`) VALUES
(4, '3v@');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariousuarioregistrado`
--

CREATE TABLE IF NOT EXISTS `comentariousuarioregistrado` (
  `IdComentario` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  KEY `IdComentario` (`IdComentario`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentariousuarioregistrado`
--

INSERT INTO `comentariousuarioregistrado` (`IdComentario`, `IdUsuario`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE IF NOT EXISTS `precio` (
  `IdUsuario` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `FechaPrecio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Monto` float NOT NULL,
  PRIMARY KEY (`IdUsuario`,`IdProducto`,`FechaPrecio`),
  KEY `precio_ibfk_1` (`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`IdUsuario`, `IdProducto`, `FechaPrecio`, `Monto`) VALUES
(1, 1, '2014-11-01 05:50:49', 275.5),
(1, 39, '2014-11-01 05:52:34', 1000),
(1, 43, '2014-11-01 05:52:34', 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `IdProducto` int(11) NOT NULL AUTO_INCREMENT,
  `IdTipoProducto` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`IdProducto`),
  KEY `IdTipoProducto` (`IdTipoProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `IdTipoProducto`, `Descripcion`) VALUES
(1, 1, '1 Tb Seagate SATA III Barracuda 64Mb Buffer'),
(2, 1, '1 Tb WD SATA III Black 64Mb Buffer'),
(3, 1, '1 Tb WD SATA III Blue 64Mb Buffer'),
(4, 1, '2 Tb WD SATA III Black 64Mb Buffer'),
(5, 1, '500 Gb WD SATA III Blue 16Mb Buffer'),
(6, 2, 'Fuente Cooler Master eXtreme II Power Plus 725W '),
(7, 2, 'Fuente Cooler Master eXtreme Power Plus 500W '),
(8, 2, 'Fuente Cooler Master eXtreme Power Plus 550W '),
(9, 2, 'Fuente Cooler Master V850'),
(10, 2, 'Fuente Cooler Master Silent Pro M2 1000W '),
(11, 3, 'Gabinete Sentey DS1 4237 c/LCD 650W'),
(12, 3, 'Gabinete Thermaltake Commander II Black USB 3.0 '),
(13, 3, 'Gabinete Thermaltake Armor Revo Gene Snow '),
(14, 3, 'Gabinete Thermaltake V3 Black Edition 450W '),
(15, 3, 'Gabinete Sentey DS1 4234 c/LCD 650W '),
(16, 3, 'Gabinete Cooler Master K350 '),
(17, 3, 'Gabinete Cooler Master Haf 922 USB 3.0 '),
(18, 3, 'Gabinete Cooler Master Haf 912'),
(19, 3, 'Gabinete Cooler Master Elite 335 '),
(20, 3, 'Gabinete Cooler Master CM690 II Advanced c/dock sata y USB 3.0 '),
(21, 4, 'DDR3 1866 Mhz (2x8Gb) Kingston HyperX CL10 '),
(22, 4, 'DDR3 2400 Mhz (8Gb) Gskill Sniper CL11 '),
(23, 4, 'DDR3 2133 Mhz (2x8Gb) Gskill Sniper CL10 '),
(24, 4, 'DDR3 1866 Mhz (2x8Gb) Kingston HyperX CL10 '),
(25, 4, 'DDR3 1600 Mhz (2x4Gb) Gskill Sniper CL9'),
(26, 5, 'Monitor LED IPS 17" LG 17EA53V'),
(27, 5, 'Monitor LED IPS 23" LG 23EA53V con HDMI'),
(28, 5, 'Monitor LED IPS 22" LG 22EA53T'),
(29, 5, 'Monitor LED 19 LG E1942S '),
(30, 5, 'Monitor LED 19 LG 19EN33S '),
(31, 6, 'Asrock Z87 Extreme6/AC '),
(32, 6, 'Asus Maximus VI GENE '),
(33, 6, 'Asus Sabertooth Z87'),
(34, 6, 'Asus Sabertooth Z97 Mark 2 '),
(35, 6, 'Asus Z97M-Plus '),
(36, 6, 'Asus Crosshair V Formula-Z'),
(37, 6, 'Asus M5A99X EVO R2.0 '),
(38, 6, 'Asus Sabertooth 990FX R2.0 '),
(39, 6, 'Gigabyte GA-990FXA-UD3'),
(40, 6, 'Asus A88X-PRO'),
(41, 7, 'Intel Core I3 4160 Haswell '),
(42, 7, 'Intel Core I5 4460 Haswell '),
(43, 7, 'Intel Core I5 4590 Haswell '),
(44, 7, 'Intel Core I5 4690K Haswell '),
(45, 7, 'Intel Core I7 4790K Haswell'),
(46, 7, 'FX-8 Core Vishera 9590'),
(47, 7, 'FX-8 Core Vishera 9370 '),
(48, 7, 'FX-8 Core Vishera 8350'),
(49, 7, ' FX-8 Core Vishera 8320 '),
(50, 7, 'APU A10-7850K Kaveri '),
(51, 8, 'Samsung Galaxy Tab4 10.1" T530 Black '),
(52, 8, ' Samsung Galaxy Tab4 10.1" T530 White '),
(53, 8, 'Samsung Galaxy Tab4 7.0" T230 Black'),
(54, 8, 'Samsung Galaxy Tab4 7.0" T230 White');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `IdTipoProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`IdTipoProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`IdTipoProducto`, `Descripcion`) VALUES
(1, 'Discos Rígidos'),
(2, 'Fuentes\r\n'),
(3, 'Gabinetes\r\n'),
(4, 'Memorias\r\n'),
(5, 'Monitores\r\n'),
(6, 'Motherboards'),
(7, 'Procesadores\r\n'),
(8, 'Tablets\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Apelllido` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`IdUsuario`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nombre`, `Apelllido`, `Email`, `Password`) VALUES
(1, 'Seguridad', 'Informatica', 'scaw@unlam.edu.ar', '/*-Unl@m-*/');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `precio_ibfk_3` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarioanonimo`
--
ALTER TABLE `comentarioanonimo`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`IdComentario`) REFERENCES `comentario` (`IdComentario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentariousuarioregistrado`
--
ALTER TABLE `comentariousuarioregistrado`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`IdComentario`) REFERENCES `comentario` (`IdComentario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `precio`
--
ALTER TABLE `precio`
  ADD CONSTRAINT `precio_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `precio_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `tipoproducto_ibfk_1` FOREIGN KEY (`IdTipoProducto`) REFERENCES `tipoproducto` (`IdTipoProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
