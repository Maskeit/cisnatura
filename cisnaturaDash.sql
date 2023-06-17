-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2023 a las 02:40:03
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cisnaturadash`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `tipo_cita` varchar(255) NOT NULL,
  `telefono_cliente` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id`, `fecha_cita`, `hora_cita`, `nombre_cliente`, `tipo_cita`, `telefono_cliente`, `active`, `created_at`, `updated_at`, `deleted`) VALUES
(20, '2023-06-15', '10:00:00', 'Miguel Alejandre', 'Curso', '314 124 5623', 0, '2023-06-15 00:45:41', NULL, 0),
(21, '2023-06-15', '12:00:00', 'Roberto', 'Asesoria', '314 124 5642', 0, '2023-06-15 00:46:28', NULL, 0),
(22, '2023-06-16', '16:00:00', 'Juan Martin', 'Consulta', '314 4561212', 0, '2023-06-15 00:46:59', NULL, 0),
(23, '2023-06-16', '18:00:00', 'Juan Martin', 'Consulta', '314 4561212', 0, '2023-06-15 00:47:12', NULL, 0),
(24, '2023-06-17', '18:00:00', 'Juan Martin', 'Consulta', '314 4561212', 0, '2023-06-15 00:47:16', NULL, 0),
(25, '2023-06-23', '18:00:00', 'Juan Martin', 'Consulta', '314 4561212', 0, '2023-06-15 00:47:21', NULL, 0),
(26, '2023-06-23', '13:00:00', 'Jose Perez', 'Consulta', '314 1236789', 0, '2023-06-15 00:47:46', NULL, 0),
(27, '2023-06-27', '17:00:00', 'Angel Adolfo', 'Asesoria', '314 123 7856', 0, '2023-06-15 00:48:20', NULL, 0),
(28, '2023-06-27', '15:00:00', 'Angel Adolfo', 'Asesoria', '314 123 7856', 0, '2023-06-15 00:48:33', NULL, 0),
(29, '2023-06-28', '15:00:00', 'Angel Villa', 'Asesoria', '314 123 7856', 0, '2023-06-15 00:48:46', NULL, 0),
(30, '2023-06-28', '14:00:00', 'Angel Jimenez', 'Asesoria', '314 123 7856', 0, '2023-06-15 00:48:55', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `tipo_cita` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `extracto` varchar(250) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `thumb` text NOT NULL,
  `price` varchar(10) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `type`, `extracto`, `product_name`, `description`, `thumb`, `price`, `active`, `created_at`, `updated_at`, `deleted`) VALUES
(14, 'tintura', 'Tratamiento de cálculos biliares y renales', 'Tintura de Yumel', 'Tratamiento de cálculos biliares y renales: El Yumel es una planta medicinal poderosa para tratar los cálculos biliares y renales. Ayuda a deshacer y expulsar los cálculos de manera efectiva.&#13;&#10;Regulación de los lípidos en la sangre: Además de tratar los cálculos, el Yumel ayuda a regular los lípidos en la sangre, como el colesterol y los triglicéridos.&#13;&#10;Control de los niveles de glucosa: El Yumel también contribuye a regular los niveles de glucosa en la sangre, lo que lo hace útil en el tratamiento de la diabetes.&#13;&#10;Propiedades diuréticas: La planta de Yumel tiene propiedades diuréticas, lo que la vuelve efectiva en el tratamiento de las infecciones urinarias.&#13;&#10;', 'TINTURA DE YUMEL.jpeg', '95', 1, '2023-06-16 21:45:10', NULL, 0),
(15, 'tintura', 'Insuficiencia venosa', 'Tintura de CAMELLIA', 'Propiedades y beneficios&#13;&#10;Insuficiencia venosa: Esta fórmula es efectiva para tratar problemas de insuficiencia venosa, como hemorroides (incluidas las sangrantes), varices, flebitis, adormecimiento de pies y manos, hormigueos o piernas pesadas.&#13;&#10;Efecto venotónico y vasodilatador: Se atribuye a esta fórmula un efecto venotónico y vasodilatador. Ayuda a aumentar la elasticidad de las venas y la resistencia de los capilares, lo cual resulta útil en heridas con sangrado y hemorragias nasales.&#13;&#10;Enfermedades del sistema circulatorio y corazón: Esta tintura herbolaria también se utiliza para tratar enfermedades que afectan el sistema circulatorio y el corazón. Es útil tanto en casos de presión arterial alta como baja, aterosclerosis (endurecimiento de las arterias) y colesterol alto.&#13;&#10;', 'CAMELLIA.jpeg', '95', 1, '2023-06-16 21:45:10', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 2,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `passwd`, `tipo`, `active`, `created_at`) VALUES
(1, 'Ximena Manzo', 'xmanzo@ucol.mx', 'xmanzo', '29bd54d8d1e9bec6aaaaf7f987478bf8ce693b2b', 1, 1, '2023-03-23 14:47:46'),
(15, 'Miguel Agustin', 'xbox@gmail.com', 'mrmike', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', 2, 1, '2023-06-14 07:11:45'),
(16, 'Sofia Geovana', 'sofiageovana@gmail.com', 'sofiageovana', '5a918748d2b9f1dfe1febdcdf765ba2c2b435bb9', 1, 1, '2023-06-16 19:57:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
