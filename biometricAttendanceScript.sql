-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 01:25:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biometricattendace`
--
CREATE DATABASE IF NOT EXISTS `biometricattendace` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `biometricattendace`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `curso` varchar(15) NOT NULL,
  `maestro` int(11) NOT NULL,
  `taller` varchar(100) NOT NULL,
  `num_estudiantes` int(11) NOT NULL,
  `grado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `curso`, `maestro`, `taller`, `num_estudiantes`, `grado`) VALUES
(1, 'A', 0, 'Electrónica ', 0, '5TO'),
(2, 'B', 0, 'Artes graficas y multimedia ', 0, '5TO'),
(3, 'C', 0, 'Mecánica ', 0, '5TO'),
(4, 'D', 0, 'Electricidad', 0, '5TO'),
(5, 'E', 0, 'Programación ', 0, '5TO'),
(6, 'F', 0, 'Redes', 0, '5TO'),
(7, 'G', 0, 'Artes graficas y multimedia', 0, '5TO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `tardanzas` int(11) NOT NULL,
  `ausencias` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fingerprint_id` int(11) NOT NULL,
  `fingerprint_select` tinyint(1) NOT NULL DEFAULT 0,
  `del_fingerid` tinyint(1) NOT NULL DEFAULT 0,
  `add_fingerid` tinyint(1) NOT NULL DEFAULT 0,
  `user_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `matricula`, `sexo`, `tardanzas`, `ausencias`, `id_curso`, `fingerprint_id`, `fingerprint_select`, `del_fingerid`, `add_fingerid`, `user_date`) VALUES
(3, 'Mia', 'Taveras', '2022-0028', 'Masculino', 20, 1, 5, 3, 0, 0, 0, '2024-03-04 00:00:00'),
(4, 'Axel', 'Cuevas', '2022-0146', 'Masculino', 13, 1, 5, 4, 0, 0, 0, '2024-03-05 00:00:00'),
(5, 'Jose', 'Rojas', '2022-0039', 'Masculino', 4, 0, 5, 5, 0, 0, 0, '2024-03-06 00:00:00'),
(6, 'Adriana', 'Encarnacion', '2022-0111', 'Femenino', 8, 2, 5, 6, 0, 0, 0, '2024-03-06 00:00:00'),
(8, 'Emely', 'Quezada', '2022-0238', 'Femenino', 4, 1, 5, 8, 0, 0, 0, '2024-03-06 00:00:00'),
(9, 'Mañolo ', 'La escopeta', 'Escopeta', 'Masculino', 11, 1, 5, 9, 0, 0, 0, '2024-03-06 00:00:00'),
(10, 'Rubi', 'Mendez', '2022-0141', 'Femenino', 5, 1, 5, 10, 0, 0, 0, '2024-03-06 00:00:00'),
(11, 'Mirianny', 'Medina', '2022-0037', 'Femenino', 2, 2, 5, 11, 0, 0, 0, '2024-03-06 00:00:00'),
(12, 'Enmanuel ', 'Fortunato', '2022-0114', 'Masculino', 3, 1, 5, 12, 0, 0, 0, '2024-03-06 00:00:00'),
(13, 'Heidy', 'Martinez', '2022-0209', 'Femenino', 2, 1, 5, 13, 0, 0, 0, '2024-03-06 00:00:00'),
(14, 'Yilbert', 'James', '2022-0080', 'Masculino', 1, 0, 5, 14, 0, 0, 0, '2024-03-06 00:00:00'),
(15, 'Onassis', 'El Crack', '2022-0249', 'Masculino', 2, 2, 5, 15, 0, 0, 0, '2024-03-06 00:00:00'),
(16, 'Miguel', 'Angel', '2022-0217', 'Masculino', 2, 0, 5, 16, 0, 0, 0, '2024-03-06 00:00:00'),
(28, 'Luis', 'Ernesto', '7272-31', 'Masculino', 0, 0, 1, 17, 0, 0, 0, '2024-03-08 00:00:00'),
(29, 'Elimarnys', 'Cuevas Paniagua', '888888', 'Masculino', 2, 0, 4, 18, 0, 0, 0, '2024-03-08 00:00:00'),
(30, 'Loorglin', 'Cuevas Paniagua', 'Tio', 'Masculino', 0, 0, 4, 19, 0, 0, 0, '2024-03-08 00:00:00'),
(31, 'Luis ernesto', 'Cuevas Santana', '727231', 'Masculino', 0, 0, 1, 20, 0, 0, 0, '2024-03-08 00:00:00'),
(32, 'Eusebia ', 'Paniagua De Cuevas', 'Mama', 'Masculino', 0, 0, 1, 21, 1, 0, 0, '2024-03-08 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_logs`
--

CREATE TABLE `users_logs` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fingerprint_id` int(5) NOT NULL,
  `checkindate` date NOT NULL,
  `hora_llegada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `curso` varchar(10) NOT NULL,
  `tardanzas` int(11) NOT NULL,
  `ausencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users_logs`
--

INSERT INTO `users_logs` (`id`, `nombre`, `apellido`, `matricula`, `user_id`, `fingerprint_id`, `checkindate`, `hora_llegada`, `hora_salida`, `curso`, `tardanzas`, `ausencias`) VALUES
(1, 'Heidy', 'Cue', '2022-0209', 0, 1, '2024-03-04', '08:28:39', '08:29:03', '5TO E', 20, 16),
(2, 'Enma', 'Gei', '2022-0114', 0, 2, '2024-03-04', '08:32:27', '08:33:36', '5TO E', 15, 15),
(3, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '08:33:19', '08:33:26', '5TO E', 9, 1),
(4, 'Enma', 'Gei', '2022-0114', 0, 2, '2024-03-04', '08:40:43', '00:00:00', '5TO E', 15, 15),
(5, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '08:40:59', '08:42:26', '5TO E', 9, 1),
(6, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '08:42:30', '08:42:36', '5TO E', 9, 1),
(7, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '08:46:05', '08:57:12', '5TO E', 9, 1),
(8, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '09:30:16', '09:35:48', '5TO E', 9, 1),
(9, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '09:35:55', '09:36:04', '5TO E', 9, 1),
(10, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '09:36:09', '10:02:45', '5TO E', 9, 1),
(11, 'Mia', 'La Bandida', '2022-0028', 0, 3, '2024-03-04', '10:02:50', '00:00:00', '5TO E', 9, 1),
(12, 'Axel', 'Cuevas', '2022-0146', 0, 4, '2024-03-05', '03:35:26', '03:35:41', '5TO E', 2, 1),
(13, 'Axel', 'Cuevas', '2022-0146', 0, 4, '2024-03-05', '03:36:00', '03:36:06', '5TO E', 2, 1),
(14, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-05', '22:49:43', '22:51:13', '5TO E', 2, 1),
(15, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-05', '22:54:06', '22:55:57', '5TO E', 2, 1),
(16, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-05', '22:56:22', '22:59:59', '5TO E', 2, 1),
(17, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-05', '23:00:20', '23:01:03', '5TO E', 2, 1),
(18, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-05', '23:01:46', '00:00:00', '5TO E', 3, 1),
(19, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '08:21:47', '08:22:23', '5TO E', 9, 1),
(20, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '08:22:13', '08:22:57', '5TO E', 4, 1),
(21, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '08:22:28', '08:22:45', '5TO E', 10, 1),
(22, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '08:23:02', '08:23:28', '5TO E', 11, 1),
(23, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '08:24:32', '08:24:45', '5TO E', 12, 1),
(24, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '08:25:03', '08:53:39', '5TO E', 13, 1),
(25, 'Jose', 'Rojas', '2022-0039', 5, 5, '2024-03-06', '08:26:38', '08:26:54', '5TO E', 0, 0),
(26, 'Jose', 'Rojas', '2022-0039', 5, 5, '2024-03-06', '08:26:59', '08:56:39', '5TO E', 1, 0),
(27, 'Adriana', 'Encarnacion', '2022-0111', 6, 6, '2024-03-06', '08:28:12', '08:28:19', '5TO E', 6, 2),
(28, 'Enmanuel', 'Fortunato', '2022-0114', 7, 7, '2024-03-06', '08:31:22', '08:31:35', '5TO E', 2, 2),
(29, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '08:41:25', '08:41:45', '5TO E', 5, 1),
(30, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '08:42:03', '08:45:36', '5TO E', 6, 1),
(31, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '08:47:09', '08:47:31', '5TO E', 7, 1),
(32, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '08:47:35', '08:47:51', '5TO E', 8, 1),
(33, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '08:47:58', '08:48:20', '5TO E', 9, 1),
(34, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '08:52:29', '08:54:02', '5TO E', 10, 1),
(35, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '08:53:46', '08:53:55', '5TO E', 14, 1),
(36, 'Enmanuel', 'Fortunato', '2022-0114', 7, 7, '2024-03-06', '08:54:30', '10:05:38', '5TO E', 3, 2),
(37, 'Jose', 'Rojas', '2022-0039', 5, 5, '2024-03-06', '08:56:44', '10:03:32', '5TO E', 2, 0),
(38, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '10:02:27', '10:03:43', '5TO E', 3, 1),
(39, 'Rubi', 'Mendez', '2022-0141', 10, 10, '2024-03-06', '10:03:26', '00:00:00', '5TO E', 4, 1),
(40, 'Jose', 'Rojas', '2022-0039', 5, 5, '2024-03-06', '10:03:38', '00:00:00', '5TO E', 3, 0),
(41, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '10:05:20', '10:34:28', '5TO E', 4, 1),
(42, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '10:06:13', '10:43:35', '5TO E', 11, 1),
(43, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '10:06:20', '10:08:24', '5TO E', 15, 1),
(44, 'Enmanuel ', 'Fortunato', '2022-0114', 12, 12, '2024-03-06', '10:07:37', '00:00:00', '5TO E', 1, 1),
(45, 'Heidy', 'Martinez', '2022-0209', 13, 13, '2024-03-06', '10:10:03', '00:00:00', '5TO E', 1, 1),
(46, 'Adriana', 'Encarnacion', '2022-0111', 6, 6, '2024-03-06', '10:10:12', '00:00:00', '5TO E', 7, 2),
(47, 'Yilbert', 'James', '2022-0080', 14, 14, '2024-03-06', '10:15:28', '00:00:00', '5TO E', 0, 0),
(48, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '10:34:42', '10:36:57', '5TO E', 5, 1),
(49, 'Onassis', 'El Crack', '2022-0249', 15, 15, '2024-03-06', '10:36:41', '10:36:47', '5TO E', 1, 2),
(50, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '10:37:03', '10:37:07', '5TO E', 6, 1),
(51, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '10:39:27', '10:40:07', '5TO E', 7, 1),
(52, 'Miguel', 'Angel', '2022-0217', 16, 16, '2024-03-06', '10:39:36', '00:00:00', '5TO E', 1, 0),
(53, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '10:40:13', '10:40:37', '5TO E', 8, 1),
(54, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-06', '10:40:42', '00:00:00', '5TO E', 9, 1),
(55, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '10:44:20', '10:48:03', '5TO E', 16, 1),
(56, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '10:49:07', '10:50:26', '5TO E', 17, 1),
(57, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '10:54:31', '11:01:10', '5TO E', 18, 1),
(58, 'Mia', 'La Bandida', '2022-0028', 3, 3, '2024-03-06', '11:11:55', '11:12:54', '5TO E', 19, 1),
(59, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-06', '11:13:02', '20:23:39', '5TO E', 12, 1),
(60, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '01:18:08', '01:18:13', '5TO E', 13, 1),
(61, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '01:18:31', '01:49:43', '5TO E', 13, 1),
(62, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '01:49:52', '01:54:18', '5TO E', 13, 1),
(63, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '01:54:23', '01:56:21', '5TO E', 13, 1),
(64, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '01:56:25', '02:28:06', '5TO E', 13, 1),
(65, 'Elimarnys', 'Cuevas Paniagua', '888888', 29, 18, '2024-03-08', '02:25:33', '00:00:00', '5TO E', 2, 0),
(66, 'Loorglin', 'Cuevas Paniagua', 'Tio', 30, 19, '2024-03-08', '02:26:39', '00:00:00', '5TO E', 0, 0),
(67, 'Luis ernesto', 'Cuevas Santana', '727231', 31, 20, '2024-03-08', '02:28:00', '00:00:00', '5TO E', 0, 0),
(68, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '02:28:38', '08:21:24', '5TO E', 13, 1),
(69, 'Eusebia ', 'Paniagua De Cuevas', 'Mama', 32, 21, '2024-03-08', '02:30:57', '02:31:01', '5TO E', 0, 0),
(70, 'Eusebia ', 'Paniagua De Cuevas', 'Mama', 32, 21, '2024-03-08', '02:31:05', '00:00:00', '5TO E', 0, 0),
(71, 'Mañolo ', 'La escopeta', 'Escopeta', 9, 9, '2024-03-08', '12:18:50', '00:00:00', '5TO E', 10, 1),
(72, 'Enmanuel ', 'Fortunato', '2022-0114', 12, 12, '2024-03-08', '08:20:24', '08:20:36', '5TO E', 2, 1),
(73, 'Enmanuel ', 'Fortunato', '2022-0114', 12, 12, '2024-03-08', '08:21:09', '08:21:18', '5TO E', 3, 1),
(74, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '08:21:34', '08:23:02', '5TO E', 13, 1),
(75, 'Mia', 'Taveras', '2022-0028', 3, 3, '2024-03-08', '08:22:30', '08:22:41', '5TO E', 20, 1),
(76, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '08:23:11', '08:23:27', '5TO E', 13, 1),
(77, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '08:27:49', '08:28:06', '5TO E', 13, 1),
(78, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '09:04:49', '09:04:56', '5TO E', 13, 1),
(79, 'Axel', 'Cuevas', '2022-0146', 4, 4, '2024-03-08', '09:30:43', '00:00:00', '5TO E', 13, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_cursos` (`id_curso`);

--
-- Indices de la tabla `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
