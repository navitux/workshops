-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-11-2019 a las 10:09:32
-- Versión del servidor: 10.3.17-MariaDB-0+deb10u1
-- Versión de PHP: 7.3.9-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_real` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
);

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`usuario`, `password`, `nombre_real`) VALUES
('admin', 'admin', 'Prof. Administrador'),
('simple', 'simple', 'Usuario Normal Apellido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_pool`
--

CREATE TABLE `alumnos_pool` (
  `apellido` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `no_estudiante` int(10) NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tae` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_taes`
--

CREATE TABLE `alumnos_taes` (
  `apellido` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `no_estudiante` int(10) NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tae` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `alumnos_taes`
--

INSERT INTO `alumnos_taes` (`apellido`, `nombre`, `no_estudiante`, `telefono`, `correo`, `tae`) VALUES
('Leonheart', 'Squall', 898989898, '879879798798798', 'squall123@ffviii.com', 'MIB'),
('Aguirre Lopez', 'Manuu', 898989898, '333334141564', 'agopf@gmail.com', 'Proyecto Emprendedor Matutino'),
('Bbb', 'Hola', 898989898, '444444', 'hola@ejem.com', 'Liderazgo y Política en la Sociedad Mexicana Matutino'),
('Macarios', 'Oscar Maldonado', 725746922, '3312846874', 'macas1234@out.es', 'Danza Contemporánea Matutino'),
('GSDKP', 'Jporg', 897609230, '894587948945', 'hokpd7@gsdgo.com', 'Expresión Teatral Matutino'),
('sdfsfsdfs', 'Ivano', 956854569, '096790578506974', 'elcacas90@imbox.com', 'Interpretación y Creación Musical Matutino'),
('FHDSD', 'LFDsos', 568907345, '679067609578095', 'iurotuyio56@fdi.net', 'Creatividad en el Pensamiento Matemático Matutino'),
('GSDG', 'ÇIoa', 343567789, '564463463564564', 'GFDAOKfg5@fgsk.com', 'Protección Civil Matutino'),
('MHMH', 'YIoo', 65464555, '065946049550496', 'Yoyojfcc75@gk13.chn', 'Gestión de la Salud Matutino'),
('GSDNKG', 'Rmvmv', 682525220, '160525288452000', 'gaowiwrwr12@opiojh.ho', 'Instalaciones Eléctricas Residenciales Matutino'),
('POPOPLS', 'LOLOLL', 987498778, '796478945870954', 'gjdfiogjfdosgjsoe@a.a', 'Fundamentos de Electrónica y Robótica Matutino'),
('fdgdgfdg', 'HFDHDHFº', 487448444, '876845555555555', 'ghshdfg4@ewerew.ewe', 'MIB'),
('RTYRTRW', 'QWEQQQ', 956785678, '958409454594908', 'goigj@hxh.jp', 'Danza Folclórica Matutino'),
('Lucanor', 'Commonwealth', 111111111, '1461351313', 'comm@wealth.on', 'MIB'),
('Jao', 'Donchin', 123456789, '3325626556', 'donchinjao@git.io', 'MIB');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`nombre`, `nombre_formal`) VALUES
('depto_de_las_mates', 'Departamento Mates');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto_comm`
--

CREATE TABLE `depto_de_las_mates` (
  `nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacantes_totales` int(25) NOT NULL DEFAULT 25
);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
