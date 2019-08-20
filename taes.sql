-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-08-2019 a las 18:10:24
-- Versión del servidor: 10.3.15-MariaDB-1
-- Versión de PHP: 7.3.4-2

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
  `nombre_real` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`usuario`, `password`, `nombre_real`) VALUES
('admingral', 'passCount3r', 'Prof. Administrador'),
('simple-admin', 'lockPAss', 'Usuario Normal');

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
('Hanzo', 'May', 249999999, '3333333333', 'mayhanzo33@kawaii.com', 'testo'),
('Leonheart', 'Squall', 898989898, '879879798798798', 'squall123@ffviii.com', 'MIB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(4) NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `nombre_formal`) VALUES
(2, 'depto_humm_soc', 'Departamento de Humanidades y Sociedad'),
(3, 'depto_mates', 'Departamento de Matemática'),
(4, 'depto_salud_cnat', 'Departamento de Salud y Ciencias Naturales'),
(5, 'depto_sociotec', 'Departamento de Sociotecnologías'),
(10, 'testo', 'TESTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto_comm`
--

CREATE TABLE `depto_comm` (
  `id_tae` int(100) NOT NULL,
  `nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacantes_totales` int(25) NOT NULL DEFAULT 25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `depto_comm`
--

INSERT INTO `depto_comm` (`id_tae`, `nombre_tae`, `nombre_formal`, `vacantes_totales`) VALUES
(1, 'frances_mat', 'Francés Matutino', 25),
(2, 'frances_vesp', 'Francés Vespertino', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto_humm_soc`
--

CREATE TABLE `depto_humm_soc` (
  `id_tae` int(100) NOT NULL,
  `nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacantes_totales` int(25) NOT NULL DEFAULT 25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `depto_humm_soc`
--

INSERT INTO `depto_humm_soc` (`id_tae`, `nombre_tae`, `nombre_formal`, `vacantes_totales`) VALUES
(1, 'proyectempr_mat', 'Proyecto Emprendedor Matutino', 25),
(2, 'politic_mat', 'Liderazgo y Política en la Sociedad Mexicana Matutino', 25),
(3, 'danzco_mat', 'Danza Contemporánea Matutino', 25),
(4, 'danzfolc_mat', 'Danza Folclórica Matutino', 25),
(5, 'teatro_mat', 'Expresión Teatral Matutino', 25),
(6, 'musica_mat', 'Interpretación y Creación Musical Matutino', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto_mates`
--

CREATE TABLE `depto_mates` (
  `id_tae` int(100) NOT NULL,
  `nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacantes_totales` int(25) NOT NULL DEFAULT 25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `depto_mates`
--

INSERT INTO `depto_mates` (`id_tae`, `nombre_tae`, `nombre_formal`, `vacantes_totales`) VALUES
(1, 'su_mates_mat', 'Creatividad en el Pensamiento Matemático Matutino', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto_salud_cnat`
--

CREATE TABLE `depto_salud_cnat` (
  `id_tae` int(100) NOT NULL,
  `nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacantes_totales` int(25) NOT NULL DEFAULT 25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `depto_salud_cnat`
--

INSERT INTO `depto_salud_cnat` (`id_tae`, `nombre_tae`, `nombre_formal`, `vacantes_totales`) VALUES
(1, 'proteccivil_mat', 'Protección Civil Matutino', 25),
(2, 'gestsalud_mat', 'Gestión de la Salud Matutino', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto_sociotec`
--

CREATE TABLE `depto_sociotec` (
  `id_tae` int(100) NOT NULL,
  `nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacantes_totales` int(25) NOT NULL DEFAULT 25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `depto_sociotec`
--

INSERT INTO `depto_sociotec` (`id_tae`, `nombre_tae`, `nombre_formal`, `vacantes_totales`) VALUES
(1, 'electr_res_mat', 'Instalaciones Eléctricas Residenciales Matutino', 25),
(2, 'robot_mat', 'Fundamentos de Electrónica y Robótica Matutino', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testo`
--

CREATE TABLE `testo` (
  `id_tae` int(100) NOT NULL,
  `nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacantes_totales` int(25) NOT NULL DEFAULT 25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `testo`
--

INSERT INTO `testo` (`id_tae`, `nombre_tae`, `nombre_formal`, `vacantes_totales`) VALUES
(18, 'Mic', 'MIB', 77);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `depto_comm`
--
ALTER TABLE `depto_comm`
  ADD PRIMARY KEY (`id_tae`);

--
-- Indices de la tabla `depto_humm_soc`
--
ALTER TABLE `depto_humm_soc`
  ADD PRIMARY KEY (`id_tae`);

--
-- Indices de la tabla `depto_mates`
--
ALTER TABLE `depto_mates`
  ADD PRIMARY KEY (`id_tae`);

--
-- Indices de la tabla `depto_salud_cnat`
--
ALTER TABLE `depto_salud_cnat`
  ADD PRIMARY KEY (`id_tae`);

--
-- Indices de la tabla `depto_sociotec`
--
ALTER TABLE `depto_sociotec`
  ADD PRIMARY KEY (`id_tae`);

--
-- Indices de la tabla `testo`
--
ALTER TABLE `testo`
  ADD PRIMARY KEY (`id_tae`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `depto_comm`
--
ALTER TABLE `depto_comm`
  MODIFY `id_tae` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `depto_humm_soc`
--
ALTER TABLE `depto_humm_soc`
  MODIFY `id_tae` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `depto_mates`
--
ALTER TABLE `depto_mates`
  MODIFY `id_tae` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `depto_salud_cnat`
--
ALTER TABLE `depto_salud_cnat`
  MODIFY `id_tae` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `depto_sociotec`
--
ALTER TABLE `depto_sociotec`
  MODIFY `id_tae` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `testo`
--
ALTER TABLE `testo`
  MODIFY `id_tae` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
