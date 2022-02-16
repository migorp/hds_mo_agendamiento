-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2022 a las 22:08:19
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `DOC_ID` int(11) NOT NULL,
  `DOC_ESPECIALIDAD` text DEFAULT NULL,
  `DOC_OBSERVACIONES` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`DOC_ID`, `DOC_ESPECIALIDAD`, `DOC_OBSERVACIONES`) VALUES
(1, 'PEDIATRIA', 'DOCTOR PEDIATRA'),
(2, 'GINECOLOGIA', 'DOCTOR GINECOLOGO'),
(3, 'MEDICINA GENERAL', 'DOCTOR MEDICINA GENERAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `HIS_PAC_ID` int(11) DEFAULT NULL,
  `HIS_DOC_ID` int(11) DEFAULT NULL,
  `HIS_ID` int(11) NOT NULL,
  `HIS_FECHA` text DEFAULT NULL,
  `HIS_PESO` text DEFAULT NULL,
  `HIS_TALLA` text DEFAULT NULL,
  `HIS_PULSO` text DEFAULT NULL,
  `HIS_MOTIVO` text DEFAULT NULL,
  `HIS_ENFERMEDAD` text DEFAULT NULL,
  `HIS_EVOLUCION` text DEFAULT NULL,
  `HIS_DIAGNOSTICO` text DEFAULT NULL,
  `HIS_PRESCRIPCION` text DEFAULT NULL,
  `HIS_RECETA` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `PAC_US_ID` int(11) DEFAULT NULL,
  `PAC_HIS_ID` int(11) DEFAULT NULL,
  `PAC_ID` int(11) NOT NULL,
  `PAC_DIRECCION` text DEFAULT NULL,
  `PAC_TELEFONO` text DEFAULT NULL,
  `PAC_ESTADOCIVIL` text DEFAULT NULL,
  `PAC_SEXO` text DEFAULT NULL,
  `PAC_FECHANAC` text DEFAULT NULL,
  `PAC_OCUPACION` text DEFAULT NULL,
  `PAC_INSTRUCCION` text DEFAULT NULL,
  `PAC_NACIONALIDAD` text DEFAULT NULL,
  `PAC_HABITOS` text DEFAULT NULL,
  `PAC_ALERGIAS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `TUR_ID` int(11) NOT NULL,
  `TUR_FECHA` text DEFAULT NULL,
  `TUR_HORA` text DEFAULT NULL,
  `TUR_DOC_ID` int(11) DEFAULT NULL,
  `TUR_US_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`TUR_ID`, `TUR_FECHA`, `TUR_HORA`, `TUR_DOC_ID`, `TUR_US_ID`) VALUES
(1, '2022-02-28', '14:30', 1, 1),
(2, '2022-02-22', '15:30', 3, 1),
(3, '2022-02-23', '16:30', 2, 1),
(4, '2022-02-25', '15:15', 3, 1),
(5, '2022-02-25', '15:15', 3, 2),
(6, '2022-02-25', '14:00', 3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `US_ID` int(11) NOT NULL,
  `US_APELLIDOSNOMBRES` text DEFAULT NULL,
  `US_CEDULA` text DEFAULT NULL,
  `US_MOVIL` text DEFAULT NULL,
  `US_CLAVE` text DEFAULT NULL,
  `US_CORREO` text DEFAULT NULL,
  `US_OBSERVACIONES` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`US_ID`, `US_APELLIDOSNOMBRES`, `US_CEDULA`, `US_MOVIL`, `US_CLAVE`, `US_CORREO`, `US_OBSERVACIONES`) VALUES
(1, 'NIKOLA TESLA', '1212121212', '099999999', 'Nik123', 'nik@nik.n', 'nik obs'),
(2, 'THOMAS ALVA', '1313131313', '09000000', 'Tho123', 'tho@tho.t', 'tho obs'),
(3, 'ALBERT EINSTEIN', '14141414', '09111111', 'Alb123', 'alb@alb.a', 'alb obs'),
(7, 'LUDWING VAN BEETHOVEN', '1234567897', '1234567899', 'b123', 'bet@b.b', 'BEETH OBS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`DOC_ID`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`HIS_ID`),
  ADD KEY `HIS_DOC_ID` (`HIS_DOC_ID`),
  ADD KEY `HIS_PAC_ID` (`HIS_PAC_ID`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`PAC_ID`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`TUR_ID`),
  ADD KEY `TUR_DOC_ID` (`TUR_DOC_ID`),
  ADD KEY `TUR_US_ID` (`TUR_US_ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`US_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `DOC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `HIS_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `PAC_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `TUR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `US_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`HIS_DOC_ID`) REFERENCES `doctores` (`DOC_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `historia_clinica_ibfk_2` FOREIGN KEY (`HIS_PAC_ID`) REFERENCES `pacientes` (`PAC_ID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`TUR_DOC_ID`) REFERENCES `doctores` (`DOC_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `turnos_ibfk_2` FOREIGN KEY (`TUR_US_ID`) REFERENCES `usuarios` (`US_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
