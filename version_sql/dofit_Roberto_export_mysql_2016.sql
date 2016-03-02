-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2016 a las 03:30:41
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

--
DROP DATABASE IF EXISTS `DoFit`;
--

CREATE DATABASE IF NOT EXISTS `DoFit`;
--
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

DROP TABLE IF EXISTS DoFit.`Admin`;
DROP TABLE IF EXISTS DoFit.`Respuesta`;
DROP TABLE IF EXISTS DoFit.`Perfil_Muro_Profesor`;
DROP TABLE IF EXISTS DoFit.`Perfil_Social`;
DROP TABLE IF EXISTS DoFit.`Pago`;
DROP TABLE IF EXISTS DoFit.`Actividad_Alumno`;
DROP TABLE IF EXISTS DoFit.`Actividad_Horario`;
DROP TABLE IF EXISTS DoFit.`Actividad`;
DROP TABLE IF EXISTS DoFit.`Profesor_Institucion`;
DROP TABLE IF EXISTS DoFit.`Ficha_Institucion`;
DROP TABLE IF EXISTS DoFit.`Ficha_Usuario`;
DROP TABLE IF EXISTS DoFit.`Deporte`;
DROP TABLE IF EXISTS DoFit.`Localidad`;
DROP TABLE IF EXISTS DoFit.`Provincia`;
DROP TABLE IF EXISTS DoFit.`Institucion`;
DROP TABLE IF EXISTS DoFit.`Usuario`;
DROP TABLE IF EXISTS DoFit.`Perfil`;
DROP TABLE IF EXISTS DoFit.`Estado`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dofit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS DoFit.`actividad` (
`id_actividad` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valor_actividad` decimal(15,2) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO DoFit.`actividad` (`id_actividad`, `id_deporte`, `id_institucion`, `id_usuario`, `valor_actividad`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 1, 3, 6, '300.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(2, 1, 1, 6, '400.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 3, 2, 5, '390.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 12, 2, 5, '450.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 2, 5, 7, '550.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 16, 1, 5, '400.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 17, 4, 6, '450.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(8, 21, 5, 7, '250.00', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_alumno`
--

CREATE TABLE IF NOT EXISTS DoFit.`actividad_alumno` (
  `id_actividad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(1) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad_alumno`
--

INSERT INTO DoFit.`actividad_alumno` (`id_actividad`, `id_usuario`, `id_estado`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(1, 3, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(2, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 1, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 3, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 4, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 5, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 6, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 7, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 9, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 10, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 11, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 12, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 13, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 4, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 1, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 3, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 1, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 4, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(8, 3, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_horario`
--

CREATE TABLE IF NOT EXISTS DoFit.`actividad_horario` (
  `id_actividad` int(11) NOT NULL,
  `id_dia` int(11) NOT NULL,
  `hora` int(11) NOT NULL,
  `minutos` int(11) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad_horario`
--

INSERT INTO DoFit.`actividad_horario` (`id_actividad`, `id_dia`, `hora`, `minutos`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 1, 20, 30, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(1, 4, 19, 0, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(2, 5, 20, 0, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(2, 6, 15, 30, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 2, 18, 0, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 5, 19, 0, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 1, 16, 30, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 2, 17, 45, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 4, 18, 0, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 3, 21, 0, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 5, 10, 15, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(8, 1, 22, 0, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(8, 6, 20, 45, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS DoFit.`admin` (
`id_usuario` int(11) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO DoFit.`admin` (`id_usuario`, `usuario`, `password`, `fhcreacion`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2016-01-06 02:30:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversacion`
--

CREATE TABLE IF NOT EXISTS DoFit.`conversacion` (
`id_conversacion` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `mensaje` varchar(45) DEFAULT NULL,
  `id_usuarioori` int(11) NOT NULL,
  `id_usuariodes` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE IF NOT EXISTS DoFit.`deporte` (
`id_deporte` int(11) NOT NULL,
  `deporte` varchar(60) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO DoFit.`deporte` (`id_deporte`, `deporte`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 'Fútbol', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(2, 'Basquet', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(3, 'Natación', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(4, 'Fútsal', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(5, 'Hockey', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(6, 'Handball', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(7, 'Judo', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(8, 'Atletismo', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(9, 'Kung-Fu', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(10, 'Teakwondo', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(11, 'Tenis', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(12, 'Voley', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(13, 'Rugby', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(14, 'Esgrima', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(15, 'Boxeo', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(16, 'Karate', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(17, 'Cross-Fit', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(18, 'Pesas-Musculación', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(19, 'Spinning', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(20, 'Polo', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(21, 'Kempo', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(22, 'Ping-pong', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(23, 'Acqua GYM', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(24, 'Waterpolo', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS DoFit.`estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(60) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO DoFit.`estado` (`id_estado`, `estado`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(0, 'En espera', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(1, 'Confirmado', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_institucion`
--

CREATE TABLE IF NOT EXISTS DoFit.`ficha_institucion` (
`id_ficha` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `cuit` bigint(30) NOT NULL,
  `telfijo` varchar(30) DEFAULT NULL,
  `celular` varchar(30) DEFAULT NULL,
  `id_localidad` int(11) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `piso` varchar(10) DEFAULT NULL,
  `depto` varchar(10) DEFAULT NULL,
  `coordenada_x` varchar(50) DEFAULT NULL,
  `coordenada_y` varchar(50) DEFAULT NULL,
  `acepta_mp` varchar(1) DEFAULT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ficha_institucion`
--

INSERT INTO DoFit.`ficha_institucion` (`id_ficha`, `id_institucion`, `nombre`, `cuit`, `telfijo`, `celular`, `id_localidad`, `direccion`, `piso`, `depto`, `coordenada_x`, `coordenada_y`, `acepta_mp`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 1, 'Megatlon S.A.', 30210009941, '0810-666-6496', '1560203456', 7, 'Reconquista 335', 'PB', '', '-34.603930', '-58.372369', 'S', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(2, 2, 'Universidad Nacional de La Matanza', 31345066691, '4480-8900', '1123905890', 5, 'Florencio Varela 1903', NULL, NULL, '-34.670580', '-58.562751', 'N', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 3, 'Club Atletico Boca Juniors ', 30780910107, ' 5777-1200', '1543041212', 7, 'Del Valle Iberlucea', '', '', '-34.633399', '-58.365223', 'S', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 4, 'Thaler S.A.', 20899909901, '4697-6008', '1567803400', 1, 'Avenida Rivadavia 18037', '', '', '-34.649347', '-58.617812', 'S', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 5, 'Tu Gimansio', 30670890121, '5400-9008', '1567803200', 37, 'Gobernador Pedro Godoy 257', '', '', '-54.804559', '-68.303432', 'N', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_usuario`
--

CREATE TABLE IF NOT EXISTS DoFit.`ficha_usuario` (
`id_ficha` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `dni` varchar(60) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fechanac` date NOT NULL,
  `telfijo` varchar(30) DEFAULT NULL,
  `celular` varchar(30) DEFAULT NULL,
  `conemer` varchar(60) DEFAULT NULL,
  `telemer` varchar(30) DEFAULT NULL,
  `id_localidad` int(11) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `piso` varchar(10) DEFAULT NULL,
  `depto` varchar(10) DEFAULT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ficha_usuario`
--

INSERT INTO DoFit.`ficha_usuario` (`id_ficha`, `id_usuario`, `nombre`, `apellido`, `dni`, `sexo`, `fechanac`, `telfijo`, `celular`, `conemer`, `telemer`, `id_localidad`, `direccion`, `piso`, `depto`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 1, 'Roberto', 'Montoto', '32823932', 'M', '1987-01-10', '54374616', '1558204125', 'Mercedes Alderte', '46971769', 1, 'Coronel Arenas 1151', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(2, 2, 'Rodolfo', 'Lopez', '28067980', 'M', '1980-02-26', '469692030', '1567803450', 'Lorena Paola', '45678909', 4, 'Alsina 360', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 3, 'Damian', 'Castellini', '33405780', 'M', '1989-03-17', '56709809', '1545670980', 'Micaela Lopez', NULL, 4, 'Conesa 289', '2', 'B', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 4, 'Romina', 'Gaetani', '25098670', 'F', '1983-09-21', '56708900', '1567003410', 'Nicolas Gaetani', '54309087', 5, 'Florencio Varela 1300', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 5, 'Elizabeth', 'Vernacci', '27089780', 'F', '1975-07-07', '54360986', '156700978', 'Luciano Vernacci', '54609007', 7, 'Pellegrini 1350', '1', 'A', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 6, 'Martin', 'Palermo', '22340678', 'M', '1973-11-07', '54260967', '151890078', 'Yamila Tevez', '67004500', 13, 'Parejas 340', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 7, 'Luciano', 'Soro', '30560781', 'M', '1982-10-02', '54260111', '151456890', 'Lorena Soro', '678004500', 5, 'Camino de cintura 340', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(8, 8, 'Barbara', 'Franco', '23109567', 'F', '1986-09-21', '54568991', '156789077', 'Tamara Franco', '45603201', 7, 'Av. Cordoba 430', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(9, 9, 'José', 'Rodriguez', '23450987', 'M', '1990-03-20', '46978097', '1567905600', 'Jose Peréz', '45670987', 1, 'Lanus 340', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(10, 10, 'Luis Alberto', 'Spinetta', '14506780', 'M', '1950-01-23', '46780466', '1567801230', 'Catalina Spinetta', '45671230', 7, 'Av. Libertador 5600', '5', 'C', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(11, 11, 'Karina', 'Perez', '23056709', 'F', '1980-03-24', '43201240', '1567803401', 'Lorena Perez', '45601230', 17, 'Av. Rivadavia 340', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(12, 12, 'Yazmin', 'Juarez', '29560340', 'F', '1988-09-21', '43102300', '1556903200', 'Jose Juarez', '44201200', 30, 'Bariloche y catriel ', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(13, 13, 'Ulises', 'Gonzalez', '19708340', 'M', '1990-10-23', '41085600', '1546002300', 'Ulises Gonzalez', '42011600', 27, 'Colon 1764', '', '', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE IF NOT EXISTS DoFit.`institucion` (
`id_institucion` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO DoFit.`institucion` (`id_institucion`, `email`, `password`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 'megatlon@gmail.com', '97fb6f8e6f2b463b9a883811d99b0c2e', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(2, 'unlam@yahoo.com.ar', '03aa405cbce847401fa4b895b735c4cb', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(3, 'bocajuniors@gmail.com', '097ff5de9066f6bf0de1eae0355f2f73', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(4, 'losamigos@gmail.com', '8deedd3cdbee5ef3b169dfab10abcedd', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 'programacionweb3@gmail.com', '482b46a83934465207cab9c5ba39899a', '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE IF NOT EXISTS DoFit.`localidad` (
`id_localidad` int(11) NOT NULL,
  `localidad` varchar(60) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO DoFit.`localidad` (`id_localidad`, `localidad`, `id_provincia`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 'Morón', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(2, 'San Martin', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(3, 'Avellaneda', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(4, 'Ramos Mejía', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(5, 'San Justo', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(6, 'Banfield', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(7, 'Capital Federal', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(8, 'Heado', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(9, 'Quilmes', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(10, 'Lanus', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(11, 'Mar del Plata', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(12, 'Navarro', 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(13, 'San Fernando del valle de Catamarca', 2, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(14, 'Fiambala', 2, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(15, 'Resistencia', 3, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(16, 'Rawson', 4, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(17, 'Córdoba', 5, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(18, 'Corrientes', 6, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(19, 'Paraná', 7, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(20, 'Gualeguaychú', 7, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(21, 'Gualeguay', 7, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(22, 'Formosa', 8, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(23, 'San Salvador de Jujuy', 9, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(24, 'Santa Rosa', 10, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(25, 'La Rioja', 11, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(26, 'Mendoza', 12, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(27, 'Posadas', 13, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(28, 'Neuquén', 14, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(29, 'Viedma', 15, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(30, 'Las grutas', 15, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(31, 'Salta', 16, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(32, 'San Juan', 17, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(33, 'San Luis', 18, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(34, 'Río Gallegos', 19, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(35, 'Santa Fe', 20, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(36, 'Santiago del Estero', 21, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(37, 'Ushuaia', 22, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(38, 'San Miguel de Tucumán', 23, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS DoFit.`pago` (
  `id_actividad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `monto` decimal(15,2) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO DoFit.`pago` (`id_actividad`, `id_usuario`, `mes`, `anio`, `monto`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 2, 2, 2015, '300.00', '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'sysadmin'),
(2, 2, 1, 2015, '400.00', '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'sysadmin'),
(3, 4, 1, 2015, '300.00', '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS DoFit.`perfil` (
`id_perfil` int(11) NOT NULL,
  `perfil` varchar(60) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO DoFit.`perfil` (`id_perfil`, `perfil`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 'Alumno', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(2, 'Profesor', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_muro_profesor`
--

CREATE TABLE IF NOT EXISTS DoFit.`perfil_muro_profesor` (
`id_posteo` int(11) NOT NULL,
  `posteo` varchar(2000) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_canal` int(11) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil_muro_profesor`
--

INSERT INTO DoFit.`perfil_muro_profesor` (`id_posteo`, `posteo`, `id_actividad`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, '¿Hay clases de Natacion este martes?', 3, '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'sysadmin'),
(2, '¿Cuanto sale para practicar futbol los lunes por la noche?', 1, '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_social`
--

CREATE TABLE IF NOT EXISTS DoFit.`perfil_social` (
  `id_usuario` int(11) NOT NULL,
  `fotoperfil` varchar(60) DEFAULT NULL,
  `foto1` varchar(60) DEFAULT NULL,
  `foto2` varchar(60) DEFAULT NULL,
  `foto3` varchar(60) DEFAULT NULL,
  `foto4` varchar(60) DEFAULT NULL,
  `foto5` varchar(60) DEFAULT NULL,
  `foto6` varchar(60) DEFAULT NULL,
  `descripcion` varchar(3000) DEFAULT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil_social`
--

INSERT INTO DoFit.`perfil_social` (`id_usuario`, `fotoperfil`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`, `foto6`, `descripcion`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, NULL, 'images.jpg', NULL, NULL, NULL, NULL, NULL, 'Futbolista argentino. Delantero en el F. C. Barcelona, de la Primera División de España, y en la Selección Argentina.', '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'usuprueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_institucion`
--

CREATE TABLE IF NOT EXISTS DoFit.`profesor_institucion` (
  `id_usuario` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `id_estado` int(1) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor_institucion`
--

INSERT INTO DoFit.`profesor_institucion` (`id_usuario`, `id_institucion`, `id_estado`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(5, 1, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 2, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(5, 4, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 1, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 3, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(6, 4, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 1, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin'),
(7, 5, 1, '2016-01-06 02:30:05', '2016-01-06 02:30:05', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS DoFit.`provincia` (
`id_provincia` int(11) NOT NULL,
  `provincia` varchar(60) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO DoFit.`provincia` (`id_provincia`, `provincia`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 'Buenos Aires', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(2, 'Catamarca', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(3, 'Chaco', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(4, 'Chubut', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(5, 'Córdoba', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(6, 'Corrientes', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(7, 'Entre Ríos', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(8, 'Formosa', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(9, 'Jujuy', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(10, 'La Pampa', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(11, 'La Rioja', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(12, 'Mendoza', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(13, 'Misiones', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(14, 'Neuquén', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(15, 'Rio Negro', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(16, 'Salta', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(17, 'San Juan', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(18, 'San Luis', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(19, 'Santa Cruz', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(20, 'Santa Fé', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(21, 'Santiago del Estero', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(22, 'Tierra del Fuego', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(23, 'Tucumán', '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE IF NOT EXISTS DoFit.`respuesta` (
  `id_posteo` int(11) NOT NULL,
  `id_respuesta` int(11) NOT NULL,
  `respuesta` varchar(2000) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO DoFit.`respuesta` (`id_posteo`, `id_respuesta`, `respuesta`, `id_usuario`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 1, 'Si en todos los horarios', 5, '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'sysadmin'),
(2, 2, '$300', 6, '2016-01-06 02:30:06', '2016-01-06 02:30:06', 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS DoFit.`usuario` (
`id_usuario` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_estado` int(1) NOT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO DoFit.`usuario` (`id_usuario`, `email`, `password`, `id_perfil`, `id_estado`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(1, 'monti.rober9@gmail.com', 'c5e46bb5e85d2ba5e3637cf41402baf0', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(2, 'programacionweb3@gmail.com', '482b46a83934465207cab9c5ba39899a', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(3, 'dcastellini89@gmail.com', '27f7112562cd7c5683ba383257527897', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(4, 'romina@gmail.com', 'e1a1e60757d1ec6d5eb3ae3979e87e77', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(5, 'vernacci_elizabeth@gmail.com', 'd28f13988de85120b2d0d0ab238080bd', 2, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(6, 'monto_rober@yahoo.com.ar', 'c5c0e7c0a4bd8d2c36e0909e075d916d', 2, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(7, 'soro.luciano@gmail.com', '0c4263fe9e48ebae96e6282b37bb3344', 2, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(8, 'barbifranco23@gmail.com', 'a1638b8f0454d36f1dc9ae3a71649a8a', 1, 0, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(9, 'jrodriguez@gmail.com', '05f7af41e0229c2548cf23b83b750a23', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(10, 'laspinetta@gmail.com', '32be8ac07ee80f28e223f83faedf3271', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(11, 'kperez@yahoo.com.ar', '0d7d25722d2d9091127d4cc864807217', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(12, 'yjuarez@gmail.com', '8fe2ba8d8235cf93bf7270f7147ac5aa', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin'),
(13, 'urodriguez@gmail.com', 'ab2e5541237d26536c72122fe8e99151', 1, 1, '2016-01-06 02:30:04', '2016-01-06 02:30:04', 'sysadmin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE DoFit.`actividad`
 ADD PRIMARY KEY (`id_actividad`), ADD KEY `actividad_profesor_institucion_fk` (`id_usuario`,`id_institucion`), ADD KEY `actividad_deporte_fk` (`id_deporte`);

--
-- Indices de la tabla `actividad_alumno`
--
ALTER TABLE DoFit.`actividad_alumno`
 ADD PRIMARY KEY (`id_actividad`,`id_usuario`), ADD KEY `actividad_alumno_usuario_fk` (`id_usuario`), ADD KEY `actividad_ac_estado_fk` (`id_estado`);

--
-- Indices de la tabla `actividad_horario`
--
ALTER TABLE DoFit.`actividad_horario`
 ADD PRIMARY KEY (`id_actividad`,`id_dia`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE DoFit.`admin`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `conversacion`
--
ALTER TABLE DoFit.`conversacion`
 ADD PRIMARY KEY (`id_conversacion`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE DoFit.`deporte`
 ADD PRIMARY KEY (`id_deporte`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE DoFit.`estado`
 ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `ficha_institucion`
--
ALTER TABLE DoFit.`ficha_institucion`
 ADD PRIMARY KEY (`id_ficha`), ADD UNIQUE KEY `cuit` (`cuit`), ADD UNIQUE KEY `id_institucion` (`id_institucion`), ADD KEY `ficha_institucion_localidad_fk` (`id_localidad`);

--
-- Indices de la tabla `ficha_usuario`
--
ALTER TABLE DoFit.`ficha_usuario`
 ADD PRIMARY KEY (`id_ficha`), ADD UNIQUE KEY `dni` (`dni`), ADD UNIQUE KEY `id_usuario` (`id_usuario`), ADD KEY `ficha_localidad_fk` (`id_localidad`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE DoFit.`institucion`
 ADD PRIMARY KEY (`id_institucion`), ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE DoFit.`localidad`
 ADD PRIMARY KEY (`id_localidad`), ADD KEY `localidad_provincia_fk` (`id_provincia`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE DoFit.`pago`
 ADD PRIMARY KEY (`id_actividad`,`id_usuario`,`mes`,`anio`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE DoFit.`perfil`
 ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `perfil_muro_profesor`
--
ALTER TABLE DoFit.`perfil_muro_profesor`
 ADD PRIMARY KEY (`id_posteo`), ADD KEY `perfil_muro_profesor_actividad_fk` (`id_actividad`);

--
-- Indices de la tabla `perfil_social`
--
ALTER TABLE DoFit.`perfil_social`
 ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `profesor_institucion`
--
ALTER TABLE DoFit.`profesor_institucion`
 ADD PRIMARY KEY (`id_usuario`,`id_institucion`), ADD KEY `profesor_institucion_institucion_fk` (`id_institucion`), ADD KEY `profesor_institucion_estado_fk` (`id_estado`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE DoFit.`provincia`
 ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE DoFit.`respuesta`
 ADD PRIMARY KEY (`id_posteo`,`id_respuesta`), ADD KEY `respuesta_usuario_fk` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE DoFit.`usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `email` (`email`), ADD KEY `usuario_perfil_fk` (`id_perfil`), ADD KEY `usuario_estado_fk` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE DoFit.`actividad`
MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE DoFit.`admin`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `conversacion`
--
ALTER TABLE DoFit.`conversacion`
MODIFY `id_conversacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE DoFit.`deporte`
MODIFY `id_deporte` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `ficha_institucion`
--
ALTER TABLE DoFit.`ficha_institucion`
MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ficha_usuario`
--
ALTER TABLE DoFit.`ficha_usuario`
MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE DoFit.`institucion`
MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE DoFit.`localidad`
MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE DoFit.`perfil`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `perfil_muro_profesor`
--
ALTER TABLE DoFit.`perfil_muro_profesor`
MODIFY `id_posteo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE DoFit.`provincia`
MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE DoFit.`usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE DoFit.`actividad`
ADD CONSTRAINT `actividad_deporte_fk` FOREIGN KEY (`id_deporte`) REFERENCES `deporte` (`id_deporte`),
ADD CONSTRAINT `actividad_profesor_institucion_fk` FOREIGN KEY (`id_usuario`, `id_institucion`) REFERENCES `profesor_institucion` (`id_usuario`, `id_institucion`);

--
-- Filtros para la tabla `actividad_alumno`
--
ALTER TABLE DoFit.`actividad_alumno`
ADD CONSTRAINT `actividad_ac_estado_fk` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
ADD CONSTRAINT `actividad_alumno_actividad_fk` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`),
ADD CONSTRAINT `actividad_alumno_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `actividad_horario`
--
ALTER TABLE DoFit.`actividad_horario`
ADD CONSTRAINT `actividad_horario_actividad_fk` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`);

--
-- Filtros para la tabla `ficha_institucion`
--
ALTER TABLE DoFit.`ficha_institucion`
ADD CONSTRAINT `ficha_institucion_institucion_fk` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`),
ADD CONSTRAINT `ficha_institucion_localidad_fk` FOREIGN KEY (`id_localidad`) REFERENCES `localidad` (`id_localidad`);

--
-- Filtros para la tabla `ficha_usuario`
--
ALTER TABLE DoFit.`ficha_usuario`
ADD CONSTRAINT `ficha_localidad_fk` FOREIGN KEY (`id_localidad`) REFERENCES `localidad` (`id_localidad`),
ADD CONSTRAINT `ficha_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE DoFit.`localidad`
ADD CONSTRAINT `localidad_provincia_fk` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id_provincia`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE DoFit.`pago`
ADD CONSTRAINT `pago_actividad_alumno_fk` FOREIGN KEY (`id_actividad`, `id_usuario`) REFERENCES `actividad_alumno` (`id_actividad`, `id_usuario`);

--
-- Filtros para la tabla `perfil_muro_profesor`
--
ALTER TABLE DoFit.`perfil_muro_profesor`
ADD CONSTRAINT `perfil_muro_profesor_actividad_fk` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`);

--
-- Filtros para la tabla `perfil_social`
--
ALTER TABLE DoFit.`perfil_social`
ADD CONSTRAINT `perfil_social_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `profesor_institucion`
--
ALTER TABLE DoFit.`profesor_institucion`
ADD CONSTRAINT `profesor_institucion_estado_fk` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
ADD CONSTRAINT `profesor_institucion_institucion_fk` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`),
ADD CONSTRAINT `profesor_institucion_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE DoFit.`respuesta`
ADD CONSTRAINT `respuesta_perfil_muro_profesor_fk` FOREIGN KEY (`id_posteo`) REFERENCES `perfil_muro_profesor` (`id_posteo`),
ADD CONSTRAINT `respuesta_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE DoFit.`usuario`
ADD CONSTRAINT `usuario_estado_fk` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
ADD CONSTRAINT `usuario_perfil_fk` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2016 a las 22:56:58
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dofit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canal`
--

CREATE TABLE IF NOT EXISTS DoFit.`canal` (
 `id_canal` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `id_actividad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `canal`
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canal`
--
ALTER TABLE DoFit.`canal`
 ADD PRIMARY KEY (`id_canal`), ADD UNIQUE KEY `id_actividad` (`id_actividad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canal`
--
ALTER TABLE DoFit.`canal`
MODIFY `id_canal` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canal`
--
ALTER TABLE DoFit.`canal`
ADD CONSTRAINT `canal_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-03-2016 a las 01:32:00
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dofit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS DoFit.`imagen` (
  `id_imagen` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fhcreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fhultmod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cusuario` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO DoFit.`imagen` (`id_imagen`, `nombre`, `id_usuario`, `fhcreacion`, `fhultmod`, `cusuario`) VALUES
(11, 'eeeee.png', 5, '2016-01-27 15:00:58', '0000-00-00 00:00:00', 'pepe'),
(12, 'image003.png', 5, '2016-01-27 15:07:38', '0000-00-00 00:00:00', 'pepe'),
(13, 'image003.png', 5, '2016-01-27 15:09:28', '0000-00-00 00:00:00', 'pepe'),
(14, 'image003.png', 5, '2016-01-27 15:11:36', '0000-00-00 00:00:00', 'pepe'),
(15, 'eeeee.png', 5, '2016-01-27 15:13:59', '0000-00-00 00:00:00', 'pepe'),
(16, 'eeeee.png', 5, '2016-01-27 15:22:57', '0000-00-00 00:00:00', 'pepe'),
(17, 'eeeee.png', 5, '2016-01-27 15:23:10', '0000-00-00 00:00:00', 'pepe'),
(18, 'eeeee.png', 5, '2016-01-27 15:26:56', '0000-00-00 00:00:00', 'pepe'),
(19, 'eeeee.png', 5, '2016-01-28 20:41:55', '0000-00-00 00:00:00', 'pepe'),
(20, 'c4e2b989-ba22-411c-9573-140fe5908cac.jpg', 3, '2016-02-23 00:22:39', '0000-00-00 00:00:00', 'pepe'),
(21, 'sddefault.jpg', 3, '2016-02-23 00:42:11', '0000-00-00 00:00:00', 'pepe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagen`
--
ALTER TABLE DoFit.`imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE DoFit.`imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE DoFit.`imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

