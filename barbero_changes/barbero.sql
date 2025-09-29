-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-06-2025 a las 15:50:25
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barbero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `username`, `password`, `nombre`, `email`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'Administrador', 'admin@barbershop.com', 1, '2025-05-12 05:08:20', '2025-05-12 06:00:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barberos`
--

DROP TABLE IF EXISTS `barberos`;
CREATE TABLE IF NOT EXISTS `barberos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especialidad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT '1',
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_barberos_activo` (`activo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `barberos`
--

INSERT INTO `barberos` (`id`, `nombre`, `email`, `telefono`, `imagen`, `especialidad`, `disponible`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Juan Pérez', 'juan@barbershop.com', '1234567890', 'barberos/juan.jpg', 'Cortes Clásicos', 1, 1, '2025-05-12 05:08:20', '2025-05-12 18:28:26'),
(2, 'Carlos Rodríguez', 'carlos@barbershop.com', '0987654321', 'barberos/carlos.jpg', 'Barba y Diseño', 1, 1, '2025-05-12 05:08:20', '2025-05-12 05:08:20'),
(3, 'Miguel García', 'miguel@barbershop.com', '5555555555', 'barberos/miguel.jpg', 'Cortes Modernos', 1, 1, '2025-05-12 05:08:20', '2025-05-12 05:08:20'),
(4, 'lucas', 'campana@gmail.com', '57896432', NULL, 'barber', 1, 1, '2025-06-09 03:41:58', '2025-06-25 08:09:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_servicios`
--

DROP TABLE IF EXISTS `categorias_servicios`;
CREATE TABLE IF NOT EXISTS `categorias_servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias_servicios`
--

INSERT INTO `categorias_servicios` (`id`, `nombre`, `descripcion`, `activo`, `created_at`) VALUES
(1, 'Cortes de Cabello', 'Cortes clásicos y modernos para hombres', 1, '2025-05-12 05:08:20'),
(2, 'Barba', 'Arreglo y diseño de barba', 1, '2025-05-12 05:08:20'),
(3, 'Tratamientos', 'Tratamientos capilares y faciales', 1, '2025-05-12 05:08:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de registro del cliente - MEJORA IMPLEMENTADA',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_clientes_email` (`email`),
  KEY `idx_clientes_fecha_registro` (`fecha_registro`),
  KEY `idx_clientes_nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `password`, `telefono`, `imagen`, `fecha_registro`, `created_at`) VALUES
(47, 'Luis Carlos', 'lui@gmail.com', '$2y$10$XCtC.r8vlix60wSl8bm/Z.l1fyJXkwOw8AMSPqItJMwOT.dyeD71u', '457896325', NULL, '2025-06-25 04:52:02', '2025-06-25 04:52:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `hora_inicio`, `hora_fin`, `activo`, `created_at`) VALUES
(15, '09:00:00', '10:00:00', 1, '2025-06-09 00:13:00'),
(16, '10:00:00', '11:00:00', 1, '2025-06-09 00:13:00'),
(17, '11:00:00', '12:00:00', 1, '2025-06-09 00:13:00'),
(18, '12:00:00', '13:00:00', 1, '2025-06-09 00:13:00'),
(19, '13:00:00', '14:00:00', 1, '2025-06-09 00:13:00'),
(20, '14:00:00', '15:00:00', 1, '2025-06-09 00:13:00'),
(21, '15:00:00', '16:00:00', 1, '2025-06-09 00:13:00'),
(22, '16:00:00', '17:00:00', 1, '2025-06-09 00:13:00'),
(23, '17:00:00', '18:00:00', 1, '2025-06-09 00:13:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

DROP TABLE IF EXISTS `promociones`;
CREATE TABLE IF NOT EXISTS `promociones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `imagen_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descuento_porcentaje` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activa` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `titulo`, `descripcion`, `imagen_url`, `descuento_porcentaje`, `precio`, `fecha_inicio`, `fecha_fin`, `activa`, `created_at`, `updated_at`) VALUES
(1, 'Pack Inicio de Año', 'Corte + Barba con 20% de descuento', 'public/assets/img/promo-default.jpg', 20, 20.00, '2025-05-11', '2025-05-28', 1, '2025-05-14 05:08:20', '2025-05-25 18:52:28'),
(2, 'Promoción aniversario', 'Corte a elección', 'public/assets/img/promo-default.jpg', 5, 20.00, '2025-05-25', '2025-05-31', 1, '2025-05-25 22:21:47', '2025-05-25 22:21:47'),
(3, 'Promoción cumpleañero', 'Corte ', 'public/assets/img/promo-default.jpg', 5, 10.00, '2025-05-25', '2025-05-31', 1, '2025-05-25 22:23:12', '2025-05-25 22:23:12'),
(4, 'Promoción grupo', 'Promoción válidad de grupos de 3 a mas', NULL, 15, 50.00, '2025-05-25', '2025-06-11', 1, '2025-05-25 22:24:37', '2025-06-10 01:13:18'),
(5, 'rte', 'daa', NULL, 5, 60.00, '2025-06-08', '2025-06-10', 1, '2025-06-09 03:33:19', '2025-06-09 03:33:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones_servicios`
--

DROP TABLE IF EXISTS `promociones_servicios`;
CREATE TABLE IF NOT EXISTS `promociones_servicios` (
  `promocion_id` int NOT NULL,
  `servicio_id` int NOT NULL,
  PRIMARY KEY (`promocion_id`,`servicio_id`),
  KEY `servicio_id` (`servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promociones_servicios`
--

INSERT INTO `promociones_servicios` (`promocion_id`, `servicio_id`) VALUES
(5, 1),
(1, 2),
(4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo_reserva` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Código único de reserva - MEJORA IMPLEMENTADA',
  `cliente_id` int DEFAULT NULL,
  `barbero_id` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','confirmada','completada','cancelada') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pendiente',
  `notas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_reserva` (`codigo_reserva`),
  KEY `cliente_id` (`cliente_id`),
  KEY `barbero_id` (`barbero_id`),
  KEY `idx_reservas_fecha_hora` (`fecha`,`hora_inicio`),
  KEY `idx_reservas_codigo` (`codigo_reserva`),
  KEY `idx_reservas_estado` (`estado`),
  KEY `idx_reservas_fecha_estado` (`fecha`,`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `codigo_reserva`, `cliente_id`, `barbero_id`, `fecha`, `hora_inicio`, `hora_fin`, `total`, `estado`, `notas`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(51, 'MENSPIRE-2025-9068', 47, NULL, '2025-06-26', '09:00:00', '09:20:00', 10.00, 'pendiente', NULL, '2025-06-25 07:29:44', '2025-06-25 07:29:44'),
(52, 'MENSPIRE-2025-1977', 47, 2, '2025-06-27', '09:00:00', '10:00:00', 55.00, 'cancelada', NULL, '2025-06-25 07:30:57', '2025-06-25 07:36:24'),
(53, 'MENSPIRE-2025-8941', 47, 2, '2025-06-27', '10:00:00', '11:00:00', 55.00, 'completada', NULL, '2025-06-25 07:34:07', '2025-06-25 08:10:03'),
(65, 'MENSPIRE-2025-1777', 47, NULL, '2025-06-27', '09:00:00', '09:20:00', 10.00, 'completada', NULL, '2025-06-25 07:55:18', '2025-06-25 08:20:00'),
(66, 'MENSPIRE-2025-6760', 47, NULL, '2025-06-25', '11:00:00', '11:20:00', 10.00, 'pendiente', NULL, '2025-06-25 07:57:53', '2025-06-25 07:57:53'),
(67, 'MENSPIRE-2025-0880', 47, NULL, '2025-06-26', '14:00:00', '14:20:00', 10.00, 'pendiente', NULL, '2025-06-25 07:58:51', '2025-06-25 07:58:51'),
(68, 'MENSPIRE-2025-8189', 47, NULL, '2025-06-26', '16:00:00', '16:20:00', 10.00, 'pendiente', NULL, '2025-06-25 08:22:53', '2025-06-25 08:22:53');

--
-- Disparadores `reservas`
--
DROP TRIGGER IF EXISTS `generar_codigo_reserva`;
DELIMITER $$
CREATE TRIGGER `generar_codigo_reserva` BEFORE INSERT ON `reservas` FOR EACH ROW BEGIN
    DECLARE codigo_temp VARCHAR(20);
    DECLARE existe INT DEFAULT 1;
    
    -- Solo generar código si no se proporciona uno
    IF NEW.codigo_reserva IS NULL OR NEW.codigo_reserva = '' THEN
        -- Generar código único
        WHILE existe > 0 DO
            SET codigo_temp = CONCAT('ELITE-', YEAR(NOW()), '-', LPAD(FLOOR(RAND() * 9999) + 1, 4, '0'));
            SELECT COUNT(*) INTO existe FROM reservas WHERE codigo_reserva = codigo_temp;
        END WHILE;
        
        SET NEW.codigo_reserva = codigo_temp;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_servicios`
--

DROP TABLE IF EXISTS `reservas_servicios`;
CREATE TABLE IF NOT EXISTS `reservas_servicios` (
  `reserva_id` int NOT NULL,
  `servicio_id` int NOT NULL,
  PRIMARY KEY (`reserva_id`,`servicio_id`),
  KEY `servicio_id` (`servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas_servicios`
--

INSERT INTO `reservas_servicios` (`reserva_id`, `servicio_id`) VALUES
(51, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(52, 4),
(53, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `precio` decimal(10,2) NOT NULL,
  `duracion` int NOT NULL COMMENT 'duración en minutos',
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destacado` tinyint(1) DEFAULT '0',
  `activo` tinyint(1) DEFAULT '1',
  `categoria_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `idx_servicios_activo` (`activo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `duracion`, `imagen`, `destacado`, `activo`, `categoria_id`, `created_at`, `updated_at`) VALUES
(1, 'Corte Clásico', 'Corte de cabello tradicional', 10.00, 30, 'servicios/corte-clasico.jpg', 1, 1, 1, '2025-05-12 05:08:20', '2025-05-12 05:55:27'),
(2, 'Corte Moderno', 'Corte de cabello con técnicas modernas', 20.00, 45, 'servicios/corte-moderno.jpg', 1, 1, 1, '2025-05-12 05:08:20', '2025-05-12 05:08:20'),
(3, 'Arreglo de Barba', 'Recorte y diseño de barba', 10.00, 20, 'servicios/barba.jpg', 0, 1, 2, '2025-05-12 05:08:20', '2025-05-12 05:08:20'),
(4, 'Corte + Barba', 'Corte de cabello y arreglo de barba', 55.00, 60, 'servicios/corte-barba.jpg', 1, 1, 1, '2025-05-12 05:08:20', '2025-05-12 05:55:41'),
(5, 'Corte escolar', '..', 10.00, 30, NULL, 0, 1, 1, '2025-06-08 23:37:47', '2025-06-08 23:37:47'),
(6, 'PEINADO de novia', 'tipos de peinados ', 50.00, 60, NULL, 0, 1, 3, '2025-06-09 03:30:38', '2025-06-09 03:30:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

DROP TABLE IF EXISTS `testimonios`;
CREATE TABLE IF NOT EXISTS `testimonios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `comentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion` int NOT NULL DEFAULT '5',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `promociones_servicios`
--
ALTER TABLE `promociones_servicios`
  ADD CONSTRAINT `promociones_servicios_ibfk_1` FOREIGN KEY (`promocion_id`) REFERENCES `promociones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promociones_servicios_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`barbero_id`) REFERENCES `barberos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `reservas_servicios`
--
ALTER TABLE `reservas_servicios`
  ADD CONSTRAINT `reservas_servicios_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_servicios_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_servicios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD CONSTRAINT `testimonios_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
