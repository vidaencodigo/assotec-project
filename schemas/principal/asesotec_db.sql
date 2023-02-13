-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2023 a las 21:46:07
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asesotec_db`
--
CREATE DATABASE IF NOT EXISTS `asesotec_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `asesotec_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_asesoria`
--

CREATE TABLE `alumno_asesoria` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_asesoria` int(11) DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_spanish_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena asesoria inscrita';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesorias_table`
--

CREATE TABLE `asesorias_table` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_horario_materia` int(11) DEFAULT NULL,
  `tipo` enum('presencial','virtual') COLLATE utf8_spanish_ci DEFAULT NULL,
  `salon` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_sesion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_spanish_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dia` date DEFAULT NULL,
  `inicio` time DEFAULT NULL,
  `fin` time DEFAULT NULL,
  `limite` int(11) NOT NULL DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena oferta de asesoria';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_table`
--

CREATE TABLE `categorias_table` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_spanish_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena categorias';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elemento_categoria_table`
--

CREATE TABLE `elemento_categoria_table` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_elemento` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena elementos en categoria';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_asesorias_table`
--

CREATE TABLE `horarios_asesorias_table` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `dia` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_spanish_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena horarios de asesoria';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_agenda_table`
--

CREATE TABLE `materias_agenda_table` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_spanish_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena materias';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_type` enum('administrador','usuario','maestro','alumno') COLLATE utf8_spanish_ci DEFAULT 'alumno',
  `profile_image` longblob DEFAULT NULL,
  `carrera` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `semestre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_spanish_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena usuarios';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos_table`
--

CREATE TABLE `videos_table` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_spanish_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena calificaion de asesoria';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno_asesoria`
--
ALTER TABLE `alumno_asesoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario alumno id` (`id_usuario`),
  ADD KEY `asesoria alumno id` (`id_asesoria`);

--
-- Indices de la tabla `asesorias_table`
--
ALTER TABLE `asesorias_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario asesoria` (`id_usuario`),
  ADD KEY `asesoria materia` (`id_horario_materia`);

--
-- Indices de la tabla `categorias_table`
--
ALTER TABLE `categorias_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_categoria_fk_id` (`id_usuario`);

--
-- Indices de la tabla `elemento_categoria_table`
--
ALTER TABLE `elemento_categoria_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_fk_id` (`id_categoria`),
  ADD KEY `video_fk_id` (`id_elemento`);

--
-- Indices de la tabla `horarios_asesorias_table`
--
ALTER TABLE `horarios_asesorias_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`id_usuario`),
  ADD KEY `materia` (`id_materia`);

--
-- Indices de la tabla `materias_agenda_table`
--
ALTER TABLE `materias_agenda_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`id_usuario`);

--
-- Indices de la tabla `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `videos_table`
--
ALTER TABLE `videos_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_maestro_id` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno_asesoria`
--
ALTER TABLE `alumno_asesoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asesorias_table`
--
ALTER TABLE `asesorias_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias_table`
--
ALTER TABLE `categorias_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `elemento_categoria_table`
--
ALTER TABLE `elemento_categoria_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios_asesorias_table`
--
ALTER TABLE `horarios_asesorias_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias_agenda_table`
--
ALTER TABLE `materias_agenda_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `videos_table`
--
ALTER TABLE `videos_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno_asesoria`
--
ALTER TABLE `alumno_asesoria`
  ADD CONSTRAINT `asesoria alumno id` FOREIGN KEY (`id_asesoria`) REFERENCES `asesorias_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario alumno id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asesorias_table`
--
ALTER TABLE `asesorias_table`
  ADD CONSTRAINT `asesoria materia` FOREIGN KEY (`id_horario_materia`) REFERENCES `materias_agenda_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario asesoria` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categorias_table`
--
ALTER TABLE `categorias_table`
  ADD CONSTRAINT `user_categoria_fk_id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `elemento_categoria_table`
--
ALTER TABLE `elemento_categoria_table`
  ADD CONSTRAINT `categoria_fk_id` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `video_fk_id` FOREIGN KEY (`id_elemento`) REFERENCES `videos_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horarios_asesorias_table`
--
ALTER TABLE `horarios_asesorias_table`
  ADD CONSTRAINT `materia` FOREIGN KEY (`id_materia`) REFERENCES `materias_agenda_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materias_agenda_table`
--
ALTER TABLE `materias_agenda_table`
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `videos_table`
--
ALTER TABLE `videos_table`
  ADD CONSTRAINT `video_maestro_id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* usuario admin */

INSERT INTO `users_table` (`id`, `user`, `name`, `last_name`, `mail`, `password`, `user_type`, `profile_image`, `carrera`, `semestre`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrador', 'Administrador base', 'mail@mail.con', '$2y$10$fEbAispQDWWMY62Oew8Mx.k64i/1XstQSdlLMYPQ5XAv9UL.sNjyS', 'administrador', NULL, NULL, NULL, 'active', '2023-01-23 08:09:15', '2023-02-13 20:47:07');