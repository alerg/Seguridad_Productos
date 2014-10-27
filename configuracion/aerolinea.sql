-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2014 a las 15:31:53
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aerolinea`
--
CREATE DATABASE IF NOT EXISTS `aerolinea` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aerolinea`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aeropuerto`
--

CREATE TABLE IF NOT EXISTS `aeropuerto` (
  `codigo` varchar(4) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aeropuerto`
--

INSERT INTO `aeropuerto` (`codigo`, `ciudad`, `provincia`, `nombre`) VALUES
('SAAC', 'Concordia', 'Entre Ríos', 'Aeropuerto Comodoro Pierrestegui'),
('SAAJ', 'Junín', 'Buenos Aires', 'Aeropuerto de Junín'),
('SAAK', 'Isla Martín García', 'Buenos Aires', 'Aeropuerto Isla Martín García'),
('SAAP', 'Paraná', 'Entre Ríos', 'Aeropuerto General Justo José de Urquiza'),
('SAAR', 'Rosario', 'Santa Fe', 'Aeropuerto Internacional Rosario Islas Malvinas'),
('SAAU', 'Villaguay', 'Entre Ríos', 'Aeropuerto de Villaguay'),
('SAAV', 'Sauce Viejo', 'Santa Fe', 'Aeropuerto de Sauce Viejo'),
('SABE', 'Buenos Aires', 'CABA', 'Aeroparque Jorge Newbery'),
('SACC', 'La Cumbre', 'Córdoba', 'Aeropuerto La Cumbre'),
('SACO', 'Córdoba', 'Córdoba', 'Aeropuerto Internacional Ingeniero Ambrosio Tarave'),
('SACP', 'Chepes', 'La Rioja', 'Aeropuerto Chepes'),
('SACT', 'Chamical', 'La Rioja', 'Aeropuerto Gobernador Gordillo'),
('SADD', 'Don Torcuato', 'Buenos Aires', 'Aeródromo de Don Torcuato (Cerrado)'),
('SADF', 'San Fernando', 'Buenos Aires', 'Aeropuerto Internacional de San Fernando'),
('SADJ', 'José C. Paz', 'Buenos Aires', 'Aeropuerto Mariano Moreno'),
('SADL', 'La Plata', 'Buenos Aires', 'Aeropuerto de La Plata'),
('SADM', 'Morón', 'Buenos Aires', 'Aeropuerto de Morón'),
('SADO', 'Campo de Mayo', 'Buenos Aires', 'Aeródromo de Campo de Mayo'),
('SADP', 'El Palomar', 'Buenos Aires', 'Aeropuerto El Palomar'),
('SADS', 'San Justo', 'Buenos Aires', 'Aeropuerto de San Justo'),
('SAEM', 'Miramar', 'Buenos Aires', 'Aeródromo Juan Domingo Perón'),
('SAEZ', 'Ezeiza', 'Buenos Aires', 'Aeropuerto Internacional Ministro Pistarini'),
('SAFS', 'Sunchales', 'Santa Fe', 'Aeropuerto de Sunchales'),
('SAHE', 'Caviahue', 'Neuquén', 'Aeropuerto de Caviahue'),
('SAHR', 'General Roca', 'Rio Negro', 'Aeropuerto de General Roca'),
('SAHZ', 'Zapala', 'Neuquén', 'Aeropuerto de Zapala'),
('SAMA', 'General Alvear', 'Mendoza', 'Aeropuerto de General Alvear'),
('SAME', 'Mendoza', 'Mendoza', 'Aeropuerto Internacional El Plumerillo'),
('SAMM', 'Malargüe', 'Mendoza', 'Aeropuerto Internacional Comodoro Ricardo Salomón'),
('SAMR', 'San Rafael', 'Mendoza', 'Aeropuerto Internacional Suboficial Ayudante Santi'),
('SANC', 'San Fernando del Val', 'Catamarca', 'Aeropuerto Coronel Felipe Varela'),
('SANE', 'Santiago del Estero', 'Santiago del Estero', 'Aeropuerto Vicecomodoro Ángel de la Paz Aragonés'),
('SANL', 'La Rioja', 'La Rioja', 'Aeropuerto Capitán Vicente Almandos Amonacide'),
('SANO', 'Chilecito', 'La Rioja', 'Aeropuerto Chilecito'),
('SANR', 'Termas de Río Hondo', 'Santiago del Estero', 'Aeropuerto Internacional Termas de Río Hondo'),
('SANT', 'San Miguel de Tucumá', 'Tucumán', 'Aeropuerto Internacional Teniente General Benjamín'),
('SANU', 'San Juan', 'San Juan', 'Aeropuerto Domingo Faustino Sarmiento'),
('SANW', 'Ceres', 'Santa Fe', 'Aeropuerto Ceres'),
('SAOC', 'Río Cuarto', 'Córdoba', 'Aeropuerto de Río Cuarto'),
('SAOD', 'Villa Dolores', 'Córdoba', 'Aeropuerto de Villa Dolores'),
('SAOL', 'Laboulaye', 'Córdoba', 'Aeródromo de Laboulaye'),
('SAOR', 'Villa Reynolds', 'San Luis', 'Aeropuerto de Villa Reynolds'),
('SAOS', 'Merlo', 'San Luis', 'Aeropuerto Internacional Valle del Conlara'),
('SAOU', 'San Luis', 'San Luis', 'Aeropuerto Brigadier Mayor Cesar Raúl Ojeda'),
('SARC', 'Corrientes', 'Corrientes', 'Aeropuerto Internacional Doctor Fernando Piragine '),
('SARE', 'Resistencia', 'Chaco', 'Aeropuerto Internacional de Resistencia'),
('SARF', 'Formosa', 'Formosa', 'Aeropuerto Internacional de Formosa'),
('SARI', 'Puerto Iguazú', 'Misiones', 'Aeropuerto Internacional de Puerto Iguazú'),
('SARL', 'Paso de los Libres', 'Corrientes', 'Aeropuerto Internacional de Paso de los Libres'),
('SARM', 'Monte Caseros', 'Corrientes', 'Aeropuerto de Monte Caseros'),
('SARP', 'Posadas', 'Misiones', 'Aeropuerto Internacional Libertador General José d'),
('SASA', 'Presidencia Roque Sa', 'Chaco', 'Aeropuerto de Presidencia Roque Sáenz Peña'),
('SASJ', 'Perico', 'Jujuy', 'Aeropuerto Internacional Gobernador Horacio Guzmán'),
('SASO', 'San Ramón de la Nuev', 'Salta', 'Aero Club Orán'),
('SAST', 'Tartagal', 'Salta', 'Aeropuerto de Tartagal'),
('SATC', 'Clorinda', 'Formosa', 'Aeropuerto Clorinda'),
('SATK', 'Las Lomitas', 'Formosa', 'Aeródromo Alferez Armando Rodríguez'),
('SATR', 'Reconquista', 'Santa Fe', 'Aeropuerto Daniel Jurkic'),
('SATU', 'Curuzú Cuatiá', 'Corrientes', 'Aeropuerto de Curuzú Cuatiá'),
('SAVB', 'El Bolsón', 'Rio Negro', 'Aeropuerto de El Bolson'),
('SAVC', 'Comodoro Rivadavia', 'Chubut', 'Aeropuerto Internacional General Enrique Mosconi'),
('SAVE', 'Esquel', 'Chubut', 'Aeropuerto Brigadier General Antonio Parodi'),
('SAVH', 'Las Heras', 'Santa Cruz', 'Aeropuerto Las Heras'),
('SAVJ', 'Ingeniero Jacobacci', 'Río Negro', 'Aeropuerto de Ingeniero Jacobacci'),
('SAVR', 'Alto Río Senguer', 'Chubut', 'Aeropuerto Alto Río Senguer'),
('SAVT', 'Trelew', 'Chubut', 'Aeropuerto Almirante Marco Andrés Zar'),
('SAVV', 'Viedma', 'Río Negro', 'Aeropuerto Gobernador Edgardo Castello'),
('SAVY', 'Puerto Madryn', 'Chubut', 'Aeropuerto El Tehuelche'),
('SAWA', 'El Calafate', 'Santa Cruz', 'Aeropuerto de Lago Argentino (Cerrado)'),
('SAWC', 'El Calafate', 'Santa Cruz', 'Aeropuerto Comandante Armando Tola'),
('SAWD', 'Puerto Deseado', 'Santa Cruz', 'Aeropuerto Puerto Deseado'),
('SAWE', 'Río Grande', 'Tierra del Fuego', 'Aeropuerto Internacional Gob. Ramón Trejo Noel'),
('SAWG', 'Río Gallegos', 'Santa Cruz', 'Aeropuerto Internacional Piloto Civil Norberto Fer'),
('SAWH', 'Ushuaia', 'Tierra del Fuego', 'Aeropuerto de Ushuaia'),
('SAWJ', 'Puerto San Julián', 'Santa Cruz', 'Aeropuerto Capitán José Daniel Vázquez'),
('SAWP', 'Perito Moreno', 'Santa Cruz', 'Aeropuerto Perito Moreno'),
('SAWT', 'Río Turbio', 'Santa Cruz', 'Aeropuerto Río Turbio'),
('SAWU', 'Puerto Santa Cruz', 'Santa Cruz', 'Aeropuerto de Puerto Santa Cruz'),
('SAZA', 'Azul', 'Buenos Aires', 'Aeropuerto de Azul'),
('SAZB', 'Bahía Blanca', 'Buenos Aires', 'Aeropuerto Comandante Espora'),
('SAZC', 'Coronel Suárez', 'Buenos Aires', 'Aeropuerto Brigadier Hector Eduardo Ruiz'),
('SAZD', 'Dolores', 'Buenos Aires', 'Aeródromo de Dolores'),
('SAZF', 'Olavarría', 'Buenos Aires', 'Aeropuerto de Olavarría'),
('SAZG', 'General Pico', 'La Pampa', 'Aeropuerto de General Pico'),
('SAZH', 'Tres Arroyos', 'Buenos Aires', 'Aeropuerto Municipal Primer Teniente Héctor Ricard'),
('SAZI', 'Bolívar', 'Buenos Aires', 'Aeropuerto de Bolívar'),
('SAZL', 'Santa Teresita', 'Buenos Aires', 'Aeropuerto de Santa Teresita'),
('SAZM', 'Mar del Plata', 'Buenos Aires', 'Aeropuerto Internacional Astor Piazolla'),
('SAZN', 'Neuquén', 'Neuquén', 'Aeropuerto Internacional Presidente Perón'),
('SAZO', 'Necochea', 'Buenos Aires', 'Aeropuerto Edgardo Hugo Yelpo'),
('SAZP', 'Pehuajó', 'Buenos Aires', 'Aeropuerto Comodoro P. Zanni'),
('SAZR', 'Santa Rosa', 'La Pampa', 'Aeropuerto de Santa Rosa'),
('SAZS', 'Bariloche', 'Río Negro', 'Aeropuerto Internacional Teniente Luis Candelaria'),
('SAZT', 'Tandil', 'Buenos Aires', 'Aeropuerto de Tandil'),
('SAZV', 'Villa Gesell', 'Buenos Aires', 'Aeropuerto de Villa Gesell'),
('SAZW', 'Cutral-Co', 'Neuquén', 'Aeropuerto de Cutral-Co'),
('SAZY', 'San Martín de los An', 'Neuquén', 'Aeropuerto Aviador Carlos Campos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avion`
--

CREATE TABLE IF NOT EXISTS `avion` (
  `id_avion` int(11) NOT NULL,
  `tipo_avion` int(11) NOT NULL,
  PRIMARY KEY (`id_avion`),
  KEY `tipo_avion` (`tipo_avion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `avion`:
--   `tipo_avion`
--       `tipo_avion` -> `id_tipo`
--

--
-- Volcado de datos para la tabla `avion`
--

INSERT INTO `avion` (`id_avion`, `tipo_avion`) VALUES
(1, 1),
(5, 1),
(9, 1),
(2, 2),
(6, 2),
(10, 2),
(3, 3),
(7, 3),
(11, 3),
(4, 4),
(8, 4),
(12, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `check_in`
--

CREATE TABLE IF NOT EXISTS `check_in` (
  `id_pasaje` int(11) NOT NULL,
  `columna` int(11) NOT NULL,
  `fila` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_pasaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE IF NOT EXISTS `dias` (
  `id_dia` int(11) NOT NULL,
  `nombre` varchar(11) NOT NULL,
  PRIMARY KEY (`id_dia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id_dia`, `nombre`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_recorridos`
--

CREATE TABLE IF NOT EXISTS `dias_recorridos` (
  `id_recorridos` int(11) NOT NULL,
  `id_dias` int(11) NOT NULL,
  KEY `id_dias` (`id_dias`),
  KEY `id_recorridos` (`id_recorridos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `dias_recorridos`:
--   `id_dias`
--       `dias` -> `id_dia`
--   `id_recorridos`
--       `recorrido` -> `id_recorrido`
--

--
-- Volcado de datos para la tabla `dias_recorridos`
--

INSERT INTO `dias_recorridos` (`id_recorridos`, `id_dias`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(2, 7),
(3, 2),
(3, 3),
(3, 5),
(3, 6),
(3, 7),
(4, 6),
(5, 4),
(5, 5),
(5, 7),
(6, 5),
(6, 6),
(7, 2),
(7, 5),
(8, 1),
(8, 2),
(8, 4),
(9, 2),
(9, 3),
(9, 4),
(10, 2),
(10, 3),
(10, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(0, 'reserva'),
(1, 'pago'),
(2, 'check-in'),
(3, 'exceso'),
(4, 'vencido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_de_pago`
--

CREATE TABLE IF NOT EXISTS `forma_de_pago` (
  `id` int(4) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id_pasaje` int(11) NOT NULL,
  `forma_pago` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `precio` int(4) NOT NULL,
  PRIMARY KEY (`id_pasaje`),
  KEY `forma_pago` (`forma_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `pago`:
--   `forma_pago`
--       `forma_de_pago` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasaje`
--

CREATE TABLE IF NOT EXISTS `pasaje` (
  `id_pasaje` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(8) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_vuelo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pasaje`),
  KEY `id_vuelo` (`id_vuelo`),
  KEY `id_vuelo_2` (`id_vuelo`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- RELACIONES PARA LA TABLA `pasaje`:
--   `id_estado`
--       `estado` -> `id`
--   `id_vuelo`
--       `vuelo` -> `id_vuelo`
--

--
-- Volcado de datos para la tabla `pasaje`
--

INSERT INTO `pasaje` (`id_pasaje`, `dni`, `nombre`, `fecha_nacimiento`, `id_vuelo`, `id_estado`, `email`, `categoria`) VALUES
(11, 32123457, 'Carlos Funetes', '1986-07-01', 13, 3, 'c.fuentes@gmail.com', 'Primera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE IF NOT EXISTS `recorrido` (
  `id_recorrido` int(11) NOT NULL,
  `id_ciudad_origen` varchar(4) NOT NULL,
  `id_ciudad_destino` varchar(4) NOT NULL,
  `precio_primera` int(11) NOT NULL,
  `precio_economy` int(11) NOT NULL,
  PRIMARY KEY (`id_recorrido`),
  KEY `id_ciudad_destino` (`id_ciudad_destino`),
  KEY `id_ciudad_origen` (`id_ciudad_origen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `recorrido`:
--   `id_ciudad_origen`
--       `aeropuerto` -> `codigo`
--   `id_ciudad_destino`
--       `aeropuerto` -> `codigo`
--

--
-- Volcado de datos para la tabla `recorrido`
--

INSERT INTO `recorrido` (`id_recorrido`, `id_ciudad_origen`, `id_ciudad_destino`, `precio_primera`, `precio_economy`) VALUES
(1, 'SAVR', 'SAZY', 1465, 1191),
(2, 'SAZA', 'SAZW', 2258, 1836),
(3, 'SAZB', 'SAZV', 3071, 2497),
(4, 'SAZS', 'SAZT', 2658, 2161),
(5, 'SAZI', 'SAZS', 1510, 1228),
(6, 'SADO', 'SAZP', 1191, 968),
(7, 'SAHE', 'SAZO', 1576, 1281),
(8, 'SANW', 'SAZN', 2565, 2085),
(9, 'SACT', 'SAZM', 2037, 1656),
(10, 'SACP', 'SAZL', 2438, 1982),
(11, 'SANO', 'SAZI', 1137, 924),
(12, 'SATC', 'SAZH', 2593, 2108),
(13, 'SAVC', 'SAZG', 1125, 915),
(14, 'SACO', 'SAZF', 1454, 1182),
(15, 'SAAC', 'SAZD', 1952, 1587),
(16, 'SAZC', 'SAZC', 1924, 1564),
(17, 'SARC', 'SAZB', 3047, 2477),
(18, 'SATU', 'SAZA', 3064, 2491),
(19, 'SAZW', 'SAWU', 1913, 1555),
(20, 'SAZD', 'SAWT', 3015, 2451),
(21, 'SADD', 'SAWP', 2167, 1762),
(22, 'SAVB', 'SAWJ', 2846, 2314),
(23, 'SAWC', 'SAWH', 2043, 1661),
(24, 'SAWA', 'SAWG', 1620, 1317),
(25, 'SADP', 'SAWE', 2776, 2257),
(26, 'SAVE', 'SAWD', 2486, 2021),
(27, 'SAEZ', 'SAWC', 2378, 1933),
(28, 'SARF', 'SAWA', 1169, 950),
(29, 'SAMA', 'SAVY', 1496, 1216),
(30, 'SAZG', 'SAVV', 2394, 1946),
(31, 'SAHR', 'SAVT', 2323, 1889),
(32, 'SAVJ', 'SAVR', 1091, 887),
(33, 'SAAK', 'SAVJ', 1391, 1131),
(34, 'SADJ', 'SAVH', 1123, 913),
(35, 'SAAJ', 'SAVE', 2861, 2326),
(36, 'SAOL', 'SAVC', 1606, 1306),
(37, 'SACC', 'SAVB', 2117, 1721),
(38, 'SADL', 'SATU', 2683, 2181),
(39, 'SANL', 'SATR', 2240, 1821),
(40, 'SAVH', 'SATK', 2406, 1956),
(41, 'SATK', 'SATC', 2717, 2209),
(42, 'SAMM', 'SAST', 2702, 2197),
(43, 'SAZM', 'SASO', 1670, 1358),
(44, 'SAME', 'SASJ', 1101, 895),
(45, 'SAOS', 'SASA', 1042, 847),
(46, 'SAEM', 'SASA', 2515, 2045),
(47, 'SARM', 'SARP', 1364, 1109),
(48, 'SADM', 'SARM', 2168, 1763),
(49, 'SAZO', 'SARL', 2048, 1665),
(50, 'SAZN', 'SARI', 2225, 1809),
(51, 'SAZF', 'SARF', 2264, 1841),
(52, 'SAAP', 'SARE', 1327, 1079),
(53, 'SARL', 'SARC', 1363, 1108),
(54, 'SAZP', 'SAOU', 2598, 2112),
(55, 'SASJ', 'SAOS', 2967, 2412),
(56, 'SAWP', 'SAOR', 2435, 1980),
(57, 'SARP', 'SAOL', 1060, 862),
(58, 'SAWD', 'SAOD', 1876, 1525),
(59, 'SARI', 'SAOC', 2742, 2229),
(60, 'SAVY', 'SANW', 1070, 870),
(61, 'SAWJ', 'SANU', 2664, 2166),
(62, 'SAWU', 'SANT', 1443, 1173),
(63, 'SASA', 'SANR', 2461, 2001),
(64, 'SATR', 'SANO', 2727, 2217),
(65, 'SARE', 'SANL', 2871, 2334),
(66, 'SAOC', 'SANE', 2477, 2014),
(67, 'SAWG', 'SANC', 1798, 1462),
(68, 'SAWE', 'SAMR', 2791, 2269),
(69, 'SAWT', 'SAMM', 2712, 2205),
(70, 'SAAR', 'SAME', 1349, 1097),
(71, 'SASA', 'SAMA', 1216, 989),
(72, 'SADF', 'SAHZ', 2899, 2357),
(73, 'SANC', 'SAHR', 2111, 1716),
(74, 'SANU', 'SAHE', 1706, 1387),
(75, 'SAOU', 'SAFS', 1269, 1032),
(76, 'SAMR', 'SAEZ', 1940, 1577),
(77, 'SASO', 'SAEM', 1791, 1456),
(78, 'SADS', 'SADS', 1651, 1342),
(79, 'SANT', 'SADP', 2007, 1632),
(80, 'SAZR', 'SADO', 2969, 2414),
(81, 'SAZL', 'SADM', 2891, 2350),
(82, 'SANE', 'SADL', 2263, 1840),
(83, 'SAZY', 'SADJ', 2577, 2095),
(84, 'SAAV', 'SADF', 2168, 1763),
(85, 'SAFS', 'SADD', 2809, 2284),
(86, 'SAZT', 'SACT', 2795, 2272),
(87, 'SAST', 'SACP', 2274, 1849),
(88, 'SANR', 'SACO', 1909, 1552),
(89, 'SAVT', 'SACC', 3041, 2472),
(90, 'SAZH', 'SABE', 2940, 2390),
(91, 'SAWH', 'SAAV', 1843, 1498),
(92, 'SAVV', 'SAAU', 1455, 1183),
(93, 'SAOD', 'SAAR', 1626, 1322),
(94, 'SAZV', 'SAAP', 1509, 1227),
(95, 'SAOR', 'SAAK', 1902, 1546),
(96, 'SAAU', 'SAAJ', 1021, 830),
(97, 'SAHZ', 'SAAC', 2427, 1973),
(98, 'SABE', 'SADO', 3047, 2477),
(99, 'SABE', 'SAHE', 2862, 2327),
(100, 'SABE', 'SANW', 1317, 1071),
(101, 'SABE', 'SACT', 2844, 2312),
(102, 'SABE', 'SACP', 1205, 980),
(103, 'SABE', 'SANO', 2630, 2138),
(104, 'SABE', 'SATC', 2395, 1947),
(105, 'SABE', 'SAVC', 1178, 958),
(106, 'SABE', 'SACO', 2562, 2083),
(107, 'SABE', 'SAAC', 2574, 2093),
(108, 'SABE', 'SAZC', 1306, 1062),
(109, 'SABE', 'SARC', 1692, 1376),
(110, 'SABE', 'SATU', 1758, 1429),
(111, 'SABE', 'SAZW', 1426, 1159),
(112, 'SABE', 'SAZD', 2141, 1741),
(113, 'SABE', 'SADD', 2946, 2395),
(114, 'SABE', 'SAVB', 1426, 1159),
(115, 'SABE', 'SAWC', 1641, 1334),
(116, 'SABE', 'SAWA', 2204, 1792),
(117, 'SABE', 'SADP', 1518, 1234),
(118, 'SABE', 'SAVE', 2403, 1954),
(119, 'SABE', 'SAEZ', 1522, 1237),
(120, 'SABE', 'SARF', 1430, 1163),
(121, 'SABE', 'SAMA', 2033, 1653),
(122, 'SABE', 'SAZG', 2161, 1757),
(123, 'SABE', 'SAHR', 2855, 2321),
(124, 'SABE', 'SAVJ', 1522, 1237),
(125, 'SABE', 'SAAK', 2271, 1846),
(126, 'SABE', 'SADJ', 2691, 2188),
(127, 'SABE', 'SAAJ', 1989, 1617),
(128, 'SABE', 'SAOL', 1359, 1105),
(129, 'SABE', 'SACC', 1980, 1610),
(130, 'SABE', 'SADL', 2301, 1871),
(131, 'SABE', 'SANL', 1684, 1369),
(132, 'SABE', 'SAVH', 2454, 1995),
(133, 'SABE', 'SATK', 2631, 2139),
(134, 'SABE', 'SAMM', 2750, 2236),
(135, 'SABE', 'SAZM', 1568, 1275),
(136, 'SABE', 'SAME', 1863, 1515),
(137, 'SABE', 'SAOS', 3059, 2487),
(138, 'SABE', 'SAEM', 2660, 2163),
(139, 'SABE', 'SARM', 2969, 2414),
(140, 'SABE', 'SADM', 2951, 2399),
(141, 'SABE', 'SAZO', 2343, 1905),
(142, 'SABE', 'SAZN', 3022, 2457),
(143, 'SABE', 'SAZF', 1680, 1366),
(144, 'SABE', 'SAAP', 3043, 2474),
(145, 'SABE', 'SARL', 1477, 1201),
(146, 'SABE', 'SAZP', 2702, 2197),
(147, 'SABE', 'SASJ', 1510, 1228),
(148, 'SABE', 'SAWP', 2209, 1796),
(149, 'SABE', 'SARP', 3037, 2469),
(150, 'SABE', 'SAWD', 2004, 1629),
(151, 'SABE', 'SARI', 2283, 1856),
(152, 'SABE', 'SAVY', 1171, 952),
(153, 'SABE', 'SAWJ', 1026, 834),
(154, 'SABE', 'SAWU', 2918, 2372),
(155, 'SABE', 'SASA', 1536, 1249),
(156, 'SABE', 'SATR', 2400, 1951),
(157, 'SABE', 'SARE', 2173, 1767),
(158, 'SABE', 'SAOC', 1129, 918),
(159, 'SABE', 'SAWG', 2477, 2014),
(160, 'SABE', 'SAWE', 1768, 1437),
(161, 'SABE', 'SAWT', 1784, 1450),
(162, 'SABE', 'SAAR', 1148, 933),
(163, 'SABE', 'SASA', 1402, 1140),
(164, 'SABE', 'SADF', 2785, 2264),
(165, 'SABE', 'SANC', 2957, 2404),
(166, 'SABE', 'SANU', 1434, 1166),
(167, 'SABE', 'SAOU', 1868, 1519),
(168, 'SABE', 'SAMR', 2194, 1784),
(169, 'SABE', 'SASO', 3007, 2445),
(170, 'SABE', 'SADS', 2133, 1734),
(171, 'SABE', 'SANT', 2405, 1955),
(172, 'SABE', 'SAZR', 2654, 2158),
(173, 'SABE', 'SAZL', 2750, 2236),
(174, 'SABE', 'SANE', 2418, 1966),
(175, 'SABE', 'SAZY', 2609, 2121),
(176, 'SABE', 'SAAV', 1975, 1606),
(177, 'SABE', 'SAFS', 2103, 1710),
(178, 'SABE', 'SAZT', 1581, 1285),
(179, 'SABE', 'SAST', 1566, 1273),
(180, 'SABE', 'SANR', 2839, 2308),
(181, 'SABE', 'SAVT', 2379, 1934),
(182, 'SABE', 'SAZH', 1935, 1573),
(183, 'SABE', 'SAWH', 1017, 827),
(184, 'SABE', 'SAVV', 1294, 1052),
(185, 'SABE', 'SAOD', 1267, 1030),
(186, 'SABE', 'SAZV', 1695, 1378),
(187, 'SABE', 'SAOR', 1582, 1286),
(188, 'SABE', 'SAAU', 2779, 2259),
(189, 'SABE', 'SAHZ', 1761, 1432),
(190, 'SACO', 'SAEZ', 1957, 1591),
(191, 'SACO', 'SARF', 1087, 884),
(192, 'SACO', 'SAMA', 2475, 2012),
(193, 'SACO', 'SAZG', 2991, 2432),
(194, 'SACO', 'SAHR', 1005, 817),
(195, 'SACO', 'SAVJ', 2657, 2160),
(196, 'SACO', 'SAAK', 1212, 985),
(197, 'SACO', 'SADJ', 1449, 1178),
(198, 'SACO', 'SAAJ', 2556, 2078),
(199, 'SACO', 'SAOL', 1418, 1153),
(200, 'SACO', 'SACC', 1950, 1585),
(201, 'SACO', 'SADL', 2617, 2128),
(202, 'SACO', 'SANL', 2127, 1729),
(203, 'SACO', 'SAVH', 1478, 1202),
(204, 'SACO', 'SATK', 2951, 2399),
(205, 'SACO', 'SAMM', 2801, 2277),
(206, 'SACO', 'SAZM', 1647, 1339),
(207, 'SACO', 'SAME', 2908, 2364),
(208, 'SACO', 'SAOS', 1605, 1305),
(209, 'SACO', 'SAEM', 2883, 2344),
(210, 'SACO', 'SARM', 1005, 817),
(211, 'SACO', 'SADM', 2125, 1728),
(212, 'SACO', 'SAZO', 2239, 1820),
(213, 'SACO', 'SAZN', 2674, 2174),
(214, 'SACO', 'SAZF', 1032, 839),
(215, 'SACO', 'SAAP', 1140, 927),
(216, 'SACO', 'SARL', 1049, 853),
(217, 'SACO', 'SAZP', 2692, 2189),
(218, 'SACO', 'SASJ', 1390, 1130),
(219, 'SACO', 'SAWP', 1278, 1039),
(220, 'SACO', 'SARP', 2507, 2038),
(221, 'SACO', 'SAWD', 2656, 2159),
(222, 'SACO', 'SARI', 2771, 2253),
(223, 'SACO', 'SAVY', 2920, 2374),
(224, 'SACO', 'SAWJ', 3047, 2477),
(225, 'SACO', 'SAWU', 1255, 1020),
(226, 'SACO', 'SASA', 1285, 1045),
(227, 'SACO', 'SATR', 1825, 1484),
(228, 'SACO', 'SARE', 2271, 1846),
(229, 'SACO', 'SAOC', 2526, 2054),
(230, 'SACO', 'SAWG', 2942, 2392),
(231, 'SACO', 'SAWE', 2075, 1687),
(232, 'SACO', 'SAWT', 1180, 959),
(233, 'SACO', 'SAAR', 1411, 1147),
(234, 'SACO', 'SASA', 2831, 2302),
(235, 'SACO', 'SADF', 2951, 2399),
(236, 'SACO', 'SANC', 1934, 1572),
(237, 'SACO', 'SANU', 1674, 1361),
(238, 'SACO', 'SAOU', 2438, 1982),
(239, 'SACO', 'SAMR', 2946, 2395),
(240, 'SACO', 'SASO', 2931, 2383),
(241, 'SACO', 'SADS', 1599, 1300),
(242, 'SACO', 'SANT', 2990, 2431),
(243, 'SACO', 'SAZR', 2033, 1653),
(244, 'SACO', 'SAZL', 2392, 1945),
(245, 'SACO', 'SANE', 2034, 1654),
(246, 'SACO', 'SAZY', 2187, 1778),
(247, 'SACO', 'SAAV', 2763, 2246),
(248, 'SACO', 'SAFS', 2442, 1985),
(249, 'SACO', 'SAZT', 3029, 2463),
(250, 'SACO', 'SAST', 1850, 1504),
(251, 'SACO', 'SANR', 1720, 1398),
(252, 'SACO', 'SAVT', 1000, 813),
(253, 'SACO', 'SAZH', 2814, 2288),
(254, 'SACO', 'SAWH', 2357, 1916),
(255, 'SACO', 'SAVV', 1625, 1321),
(256, 'SACO', 'SAOD', 1157, 941),
(257, 'SACO', 'SAZV', 2520, 2049),
(258, 'SACO', 'SAOR', 2845, 2313),
(259, 'SACO', 'SAAU', 2952, 2400),
(260, 'SACO', 'SAHZ', 1657, 1347);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_avion`
--

CREATE TABLE IF NOT EXISTS `tipo_avion` (
  `id_tipo` int(11) NOT NULL,
  `columnas_primera` int(11) NOT NULL,
  `columnas_economic` int(11) NOT NULL,
  `fila_economy` int(11) NOT NULL,
  `fila_primera` int(11) NOT NULL,
  `marca` varchar(10) NOT NULL,
  `modelo` varchar(10) NOT NULL,
  `total_pasajes` int(20) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_avion`
--

INSERT INTO `tipo_avion` (`id_tipo`, `columnas_primera`, `columnas_economic`, `fila_economy`, `fila_primera`, `marca`, `modelo`, `total_pasajes`) VALUES
(1, 3, 3, 30, 30, 'Embraer', 'EMB-120', 180),
(2, 1, 5, 50, 10, 'Embraer', 'ER-145', 260),
(3, 2, 4, 15, 25, 'Embraer', 'ER-145', 110),
(4, 4, 2, 20, 30, 'Embraer', 'ER-170', 160);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE IF NOT EXISTS `vuelo` (
  `id_vuelo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `asientos_disponibles_primera` int(3) NOT NULL,
  `asientos_disponibles_economy` int(3) NOT NULL,
  `asientos_exedidos` int(2) NOT NULL DEFAULT '0',
  `id_avion` int(11) NOT NULL,
  `id_recorrido` int(11) NOT NULL,
  PRIMARY KEY (`id_vuelo`),
  KEY `id_avion` (`id_avion`),
  KEY `id_recorrido` (`id_recorrido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `vuelo`:
--   `id_recorrido`
--       `recorrido` -> `id_recorrido`
--   `id_avion`
--       `avion` -> `id_avion`
--

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`id_vuelo`, `fecha`, `asientos_disponibles_primera`, `asientos_disponibles_economy`, `asientos_exedidos`, `id_avion`, `id_recorrido`) VALUES
(1, '2014-07-27', 50, 60, 0, 3, 1),
(2, '2015-02-20', 10, 250, 0, 2, 2),
(3, '2014-08-08', 90, 90, 0, 1, 3),
(4, '2015-02-22', 120, 40, 0, 4, 4),
(5, '2014-09-23', 50, 60, 0, 3, 5),
(6, '2014-10-24', 10, 250, 0, 2, 6),
(7, '2015-07-25', 50, 60, 0, 3, 7),
(8, '2014-07-26', 10, 250, 0, 2, 8),
(9, '2014-10-27', 50, 60, 0, 3, 9),
(10, '2014-11-28', 10, 250, 0, 2, 10),
(11, '2014-11-09', 90, 90, 0, 1, 11),
(12, '2014-10-24', 120, 40, 0, 4, 12),
(13, '2014-11-19', 9, 250, 0, 2, 13),
(14, '2014-07-26', 10, 250, 0, 2, 14),
(15, '2014-12-25', 10, 250, 0, 2, 15),
(16, '2014-10-17', 10, 250, 0, 2, 16),
(17, '2014-11-24', 50, 60, 0, 3, 17),
(18, '2014-07-30', 120, 40, 0, 4, 18),
(19, '2014-10-29', 90, 90, 0, 1, 19),
(20, '2014-12-18', 50, 60, 0, 3, 20),
(21, '2014-08-10', 50, 60, 0, 3, 21),
(22, '2014-12-01', 10, 250, 0, 2, 22),
(23, '2014-09-14', 120, 40, 0, 4, 23),
(24, '2014-12-05', 50, 60, 0, 3, 24),
(25, '2014-10-02', 90, 90, 0, 1, 25),
(26, '2014-08-13', 50, 60, 0, 3, 26),
(27, '2014-09-12', 90, 90, 0, 1, 27),
(28, '2015-01-01', 50, 60, 0, 3, 28),
(29, '2015-06-30', 90, 90, 0, 1, 29),
(30, '2015-06-01', 10, 250, 0, 2, 30),
(31, '2014-08-15', 20, 200, 0, 3, 8);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avion`
--
ALTER TABLE `avion`
  ADD CONSTRAINT `avion_ibfk_1` FOREIGN KEY (`tipo_avion`) REFERENCES `tipo_avion` (`id_tipo`);

--
-- Filtros para la tabla `dias_recorridos`
--
ALTER TABLE `dias_recorridos`
  ADD CONSTRAINT `dias_recorridos_ibfk_3` FOREIGN KEY (`id_dias`) REFERENCES `dias` (`id_dia`),
  ADD CONSTRAINT `dias_recorridos_ibfk_4` FOREIGN KEY (`id_recorridos`) REFERENCES `recorrido` (`id_recorrido`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`forma_pago`) REFERENCES `forma_de_pago` (`id`);

--
-- Filtros para la tabla `pasaje`
--
ALTER TABLE `pasaje`
  ADD CONSTRAINT `pasaje_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `pasaje_ibfk_3` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelo` (`id_vuelo`);

--
-- Filtros para la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD CONSTRAINT `recorrido_ibfk_1` FOREIGN KEY (`id_ciudad_origen`) REFERENCES `aeropuerto` (`codigo`),
  ADD CONSTRAINT `recorrido_ibfk_2` FOREIGN KEY (`id_ciudad_destino`) REFERENCES `aeropuerto` (`codigo`);

--
-- Filtros para la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`id_recorrido`) REFERENCES `recorrido` (`id_recorrido`),
  ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`id_avion`) REFERENCES `avion` (`id_avion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
