-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 16:21:04
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_contrapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amistades`
--

DROP DATABASE db_contrapp;

CREATE DATABASE db_contrapp;

USE db_contrapp;

CREATE TABLE `amistades` (
  `id` int(11) NOT NULL,
  `usuario_1` int(11) NOT NULL,
  `usuario_2` int(11) NOT NULL,
  `FechaConfirmacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `amistades`
--

INSERT INTO `amistades` (`id`, `usuario_1`, `usuario_2`, `FechaConfirmacion`) VALUES
(3, 1, 9, '2023-11-02 18:33:14'),
(4, 1, 5, '2023-11-02 18:33:22'),
(6, 1, 11, '2023-11-03 10:51:51'),
(8, 1, 4, '2023-11-03 11:05:18'),
(9, 1, 6, '2023-11-03 11:05:18'),
(15, 2, 11, '2023-11-06 15:19:27'),
(16, 14, 2, '2023-11-06 15:19:27'),
(17, 1, 2, '2023-11-06 15:28:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosolicitudamistad`
--

CREATE TABLE `estadosolicitudamistad` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadosolicitudamistad`
--

INSERT INTO `estadosolicitudamistad` (`id`, `estado`) VALUES
(1, 'Aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `emisor` int(11) NOT NULL,
  `receptor` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `emisor`, `receptor`, `mensaje`, `fecha_envio`) VALUES
(1, 1, 2, 'Hola soy Oscar', '2023-10-31 12:10:45'),
(2, 2, 1, 'Hola yo Iker', '2023-10-31 16:10:45'),
(3, 4, 2, 'Hola soy Javi', '2023-10-31 16:11:35'),
(4, 4, 1, 'Hola oscar soy Javi', '2023-10-31 18:11:35'),
(5, 2, 1, 'Hola oscar soy iker', '2023-11-06 14:48:57'),
(6, 2, 11, 'Hola Jorge', '2023-11-06 15:25:37'),
(7, 11, 2, 'Hola Iker', '2023-11-06 15:25:53'),
(8, 1, 2, 'Hola', '2023-11-06 15:29:13'),
(9, 1, 2, 'HOla', '2023-11-06 15:35:41'),
(10, 1, 2, 'Holaaaaaa', '2023-11-06 15:44:16'),
(11, 1, 5, 'HOla admin', '2023-11-06 15:44:23'),
(12, 2, 1, 'Hola yo iker xddd', '2023-11-06 15:44:59'),
(13, 1, 2, 'Hola', '2023-11-06 15:46:11'),
(14, 1, 2, 'Hola son las 16', '2023-11-06 15:46:29'),
(15, 1, 2, 'iof3', '2023-11-06 15:46:55'),
(16, 2, 1, 'Hola oscar xddxdcnbejcnek', '2023-11-06 15:47:16'),
(17, 2, 1, 'Hola', '2023-11-06 15:54:53'),
(18, 2, 1, 'que la', '2023-11-06 15:55:04'),
(19, 1, 2, 'hoacnwo', '2023-11-06 15:59:25'),
(20, 1, 2, 'wcec', '2023-11-06 15:59:29'),
(21, 1, 2, 'Hola Ikerrr 07', '2023-11-07 14:54:17'),
(22, 1, 2, 'Hola iker que tal', '2023-11-07 15:00:34'),
(23, 1, 2, 'Pruyeba uno', '2023-11-07 15:31:53'),
(24, 1, 4, 'Hola que tyal', '2023-11-07 15:32:06'),
(25, 1, 2, 'sddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2023-11-07 15:46:06'),
(26, 1, 2, 'Hola que tal', '2023-11-08 12:24:35'),
(27, 1, 2, 'Me llamo TheDark', '2023-11-08 12:24:44'),
(28, 1, 8, 'Hola sergio soy oscar', '2023-11-13 14:16:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `emisor` int(11) NOT NULL,
  `receptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `emisor`, `receptor`) VALUES
(11, 1, 2),
(12, 1, 2),
(13, 9, 14),
(14, 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudesamistad`
--

CREATE TABLE `solicitudesamistad` (
  `id` int(11) NOT NULL,
  `emisor` int(11) NOT NULL,
  `receptor` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudesamistad`
--

INSERT INTO `solicitudesamistad` (`id`, `emisor`, `receptor`, `estado`) VALUES
(7, 2, 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `contraseña` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `nombre`, `contraseña`) VALUES
(1, 'oscar', 'oscar@gmail.com', 'Óscar', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(2, 'iker', 'iker@hotmail.com', 'Iker', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(3, 'daniel', 'daniel@gmail.com', 'Daniel García', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(4, 'javi', 'javi@hotmail.com', 'Javier', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(5, 'admin', 'admin@gmail.com', 'Admin', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(6, 'joel', 'joel@gmail.com', 'Joel', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(8, 'sergio', 'sergio@gmail.com', 'Sergio', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(9, 'alberto', 'alberto@gmail.com', 'Alberto', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(11, 'jorge', 'jorge@gmail.com', 'Jorge', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(12, 'julio', 'julioCesar@gmail.com', 'Julio Cesar', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(13, 'marlene', 'marlene@gmail.com', 'Marlene', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01'),
(14, 'wilson', 'wilson@gmail.com', 'Wilson', '7a9a93a93e4f3824b7be8f9acd43894f76b2776e4c33bbb5eb1cf1ba4beaaf01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amistades`
--
ALTER TABLE `amistades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_1` (`usuario_1`),
  ADD KEY `usuario_2` (`usuario_2`);

--
-- Indices de la tabla `estadosolicitudamistad`
--
ALTER TABLE `estadosolicitudamistad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor` (`emisor`),
  ADD KEY `receptor` (`receptor`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor` (`emisor`),
  ADD KEY `receptor` (`receptor`);

--
-- Indices de la tabla `solicitudesamistad`
--
ALTER TABLE `solicitudesamistad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor` (`emisor`),
  ADD KEY `receptor` (`receptor`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amistades`
--
ALTER TABLE `amistades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estadosolicitudamistad`
--
ALTER TABLE `estadosolicitudamistad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `solicitudesamistad`
--
ALTER TABLE `solicitudesamistad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amistades`
--
ALTER TABLE `amistades`
  ADD CONSTRAINT `amistades_ibfk_1` FOREIGN KEY (`usuario_1`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `amistades_ibfk_2` FOREIGN KEY (`usuario_2`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `solicitudesamistad`
--
ALTER TABLE `solicitudesamistad`
  ADD CONSTRAINT `solicitudesamistad_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `solicitudesamistad_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `solicitudesamistad_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `estadosolicitudamistad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
