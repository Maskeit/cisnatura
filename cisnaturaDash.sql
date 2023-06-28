-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2023 a las 22:33:07
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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `userId`, `productId`, `cantidad`, `created_at`, `updated_at`) VALUES
(3, 15, 26, 1, '2023-06-28 20:32:20', '2023-06-28 20:32:20');

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
(24, '2023-06-17', '18:00:00', 'Juan Martin', 'Consulta', '314 4561212', 0, '2023-06-15 00:47:16', NULL, 0),
(26, '2023-06-23', '13:00:00', 'Jose Perez', 'Consulta', '314 1236789', 0, '2023-06-15 00:47:46', NULL, 0),
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
(19, 'tintura', 'asdastwetgfvgdf', 'asdasdasd', 'ertqwefdfq4rfd', 'VALERI.jpeg', '78', 1, '2023-06-19 23:58:02', NULL, 0),
(20, 'tintura', 'h grdhfdghd56dg', 'h6hfg dghfgf', 'hdfghdrtshdfgsgdfh', 'SPICIGERA.jpeg', '65', 1, '2023-06-19 23:58:15', NULL, 0),
(22, 'tintura', 'asdasdasd', 'Lo que sea', 'asdasd', 'TINTURA DE BLANCO.jpeg', '78', 1, '2023-06-20 01:59:47', NULL, 0),
(24, 'cds', 'asdahsdñaolsda', 'Dioxido', 'dafdsfhalfuasdfasdf', 'SENNA.jpeg', '78', 0, '2023-06-20 02:00:14', NULL, 0),
(25, 'tintura', 'Para Debilidad del corazón, Lesiones de las válvulas cardíacas...', 'Tintura de Blanco', 'Tónico Cardíaco Indicaciones:&#13;&#10;Debilidad del corazón&#13;&#10;Lesiones de las válvulas cardíacas&#13;&#10;Presión alta de la sangre&#13;&#10;Mala circulación&#13;&#10;Angina de pecho&#13;&#10;Dolores de corazón&#13;&#10;Dolores nerviosos de cabeza&#13;&#10;Mareos y propensión al desmayo&#13;&#10;Corazón nervioso&#13;&#10;Insomnio por trastornos del hígado en algunos casos&#13;&#10;Espasmos&#13;&#10;Palpitaciones nerviosas&#13;&#10;Vómitos nerviosos&#13;&#10;', 'TINTURA DE BLANCO.jpeg', '95', 1, '2023-06-21 15:39:18', NULL, 0),
(26, 'tintura', 'Expectorante y Calmante Respiratorio', 'Sambucus', 'Antiespasmódico&#13;&#10;Microbicida contra la tos y espasmos de la garganta&#13;&#10;Pectoral&#13;&#10;Emoliente&#13;&#10;Calmante de las inflamaciones&#13;&#10;Catarros de las vías respiratorias (faringe, laringe, tráquea y bronquios)&#13;&#10;Sudorífico y depurativo en casos de fiebre y catarros respiratorios&#13;&#10;', 'OPUNTIA.jpeg', '95', 1, '2023-06-21 15:39:56', NULL, 0),
(27, 'cds', 'Dioxido de Cloro', 'Dioxido de Cloro 3pmm', 'mata cosas', '7242a3fb-c59e-4fee-aebd-41b207b87e54.jpg', '185', 1, '2023-06-21 15:40:27', NULL, 0),
(28, 'otro', 'Para preparar CDS con  Clorito de Sodio  y Ácido Clorhídrico...', 'Duo de Activadores para hacer Dióxido de Cloro insitu', 'Mezcla en igual proporción Clorito de Sodio al 24% y Ácido Clorhídrico.&#13;&#10;La proporción recomendada es de 14 gotas de Clorito de Sodio al 24% más 14 gotas de Ácido Clorhídrico al 4%.&#13;&#10;Permite que la mezcla se active y cambie de color a caramelo.&#13;&#10;Agrega esta activación a 1 litro de agua y divide en 8 porciones.&#13;&#10;Toma una porción cada 1 hora durante 21 días.&#13;&#10;', 'DUO CITRICO.jpeg', '340', 1, '2023-06-21 15:41:26', NULL, 0),
(29, 'curso', 'Este curso', 'Curso de Flores de Bach', '¡Te invitamos a un fascinante curso de Flores de Bach, donde aprenderás a sanar tus emociones y encontrar el equilibrio interior! Este curso será impartido por CISnatura y contará con la presencia de Sofia Geovana, una reconocida Terapeuta Floral con 25 años de experiencia en el campo.&#13;&#10;&#13;&#10;Detalles del curso:', 'cursoflores.jpg', '2800', 1, '2023-06-21 15:43:15', NULL, 0);

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
(16, 'Sofia Geovana', 'sofiageovana@gmail.com', 'sofiageovana', '5a918748d2b9f1dfe1febdcdf765ba2c2b435bb9', 1, 1, '2023-06-16 19:57:23'),
(17, 'Manuel Perez', 'manu@gmail.com', 'manu', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', 2, 1, '2023-06-22 20:50:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrito_user` (`userId`),
  ADD KEY `fk_carrito_product` (`productId`);

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
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_product` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_carrito_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
