-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2024 a las 21:27:50
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proy_parking`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonados`
--

CREATE TABLE `abonados` (
  `id` bigint(11) NOT NULL,
  `tipo_doc` varchar(250) DEFAULT NULL,
  `num_doc` varchar(250) DEFAULT NULL,
  `razon_social` varchar(250) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `abonados`
--

INSERT INTO `abonados` (`id`, `tipo_doc`, `num_doc`, `razon_social`, `direccion`, `tel`, `email`, `observaciones`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2', '74146165', 'SEBASTIAN SAC', 'Pasaje Rosita', '987561212', 'a@gmail.com', 'a', '1', '2024-12-05 15:23:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint(20) NOT NULL,
  `dni` varchar(11) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `hora_entrada` time DEFAULT current_timestamp(),
  `hora_salida` time DEFAULT NULL,
  `total_horas` varchar(5) DEFAULT NULL,
  `latitud` varchar(250) DEFAULT NULL,
  `longitud` varchar(250) DEFAULT NULL,
  `latitud_salida` varchar(250) DEFAULT NULL,
  `longitud_salida` varchar(250) DEFAULT NULL,
  `ip_address` varchar(250) DEFAULT NULL,
  `ip_address_salida` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `dni`, `tipo_id`, `hora_entrada`, `hora_salida`, `total_horas`, `latitud`, `longitud`, `latitud_salida`, `longitud_salida`, `ip_address`, `ip_address_salida`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '74146165', 1, NULL, NULL, NULL, '-16.5937152', '-72.7678976', NULL, NULL, '127.0.0.1', NULL, '2022-10-09 14:49:42', NULL, '2024-11-13 18:12:52'),
(2, '06824493', 1, '11:08:30', NULL, NULL, '-16.5937152', '-72.7678976', NULL, NULL, '127.0.0.1', NULL, '2024-10-09 16:08:30', NULL, '2024-11-13 18:12:49'),
(3, '74146165', 1, '15:31:04', '15:31:12', NULL, '-16.5937152', '-72.7678976', '-16.5937152', '-72.7678976', '127.0.0.1', '127.0.0.1', '2024-10-10 20:31:04', NULL, '2024-11-13 18:12:46'),
(4, '74146165', 1, '09:22:45', '18:12:10', NULL, '-16.5937152', '-72.7678976', '-11.90619580808087', '-77.04270970285535', '127.0.0.1', '179.6.91.104', '2024-10-11 14:22:45', NULL, '2024-11-13 18:12:43'),
(5, '74146165', 1, '14:11:04', '14:27:55', NULL, '-12.05237749309523', '-77.03893876859017', '-16.5937152', '-72.7678976', '179.7.92.118', '190.116.43.197', '2024-10-14 19:11:04', NULL, '2024-11-13 18:12:40'),
(6, '74146165', 1, '08:17:35', NULL, NULL, '-16.5937152', '-72.7678976', NULL, NULL, '190.116.43.197', NULL, '2024-10-18 13:17:35', NULL, '2024-11-13 18:12:38'),
(7, '74146165', 1, '08:38:30', NULL, NULL, '-12.04224', '-77.0342912', NULL, NULL, '190.116.43.197', NULL, '2024-10-22 13:38:30', NULL, '2024-11-13 18:12:35'),
(8, '74146165', 1, '08:43:05', NULL, NULL, '-12.04224', '-77.0342912', NULL, NULL, '190.116.43.197', NULL, '2024-10-24 13:43:05', NULL, '2024-11-13 18:12:28'),
(9, '74146165', 1, '22:34:39', NULL, NULL, '-11.894784', '-77.0179072', NULL, NULL, '179.6.170.187', NULL, '2024-10-26 03:34:39', NULL, '2024-11-13 18:12:26'),
(10, '74146165', 1, '22:36:36', NULL, NULL, '-11.894784', '-77.0179072', NULL, NULL, '179.6.170.187', NULL, '2024-10-26 03:36:36', NULL, '2024-11-13 18:12:23'),
(11, '74146165', 1, '22:38:49', NULL, NULL, '-11.894784', '-77.0179072', NULL, NULL, '179.6.170.187', NULL, '2024-10-26 03:38:49', NULL, '2024-11-13 18:12:19'),
(12, '74146165', 1, '22:38:53', NULL, NULL, '-11.894784', '-77.0179072', NULL, NULL, '179.6.170.187', NULL, '2024-10-26 03:38:53', NULL, '2024-11-13 18:12:16'),
(13, '74146165', 1, '22:39:01', NULL, NULL, '-11.894784', '-77.0179072', NULL, NULL, '179.6.170.187', NULL, '2024-10-26 03:39:01', NULL, '2024-11-13 18:12:14'),
(14, '06824493', 1, '08:03:14', NULL, NULL, '-12.058624', '-77.037568', NULL, NULL, '190.116.43.197', NULL, '2024-10-26 13:03:14', NULL, '2024-11-13 18:12:12'),
(15, '74146165', 1, '11:51:02', NULL, NULL, '-12.058624', '-77.0408448', NULL, NULL, '190.116.43.197', NULL, '2024-10-28 16:51:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistentes`
--

CREATE TABLE `asistentes` (
  `id` bigint(11) NOT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nac` varchar(100) DEFAULT NULL,
  `distrito_id` int(11) NOT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `tel` int(10) DEFAULT NULL,
  `genero` varchar(20) NOT NULL,
  `celula_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `foto` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistentes`
--

INSERT INTO `asistentes` (`id`, `dni`, `nombre`, `apellido`, `fecha_nac`, `distrito_id`, `direccion`, `tel`, `genero`, `celula_id`, `estado`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '74146165', 'Sebastian', 'Vasquez Wong', '2024-09-16', 3, 'jr pacifico', 987654321, 'masculino', 1, 1, 'uploads/fotos/1726495798.jpg', '2024-09-11 15:01:39', NULL, NULL),
(2, NULL, 'Adrian Alexus', 'Sifuentes', '2024-09-18', 326, 'Jr pacifico', 987654455, 'femenino', 1, 1, 'uploads/fotos/1726264308.png', '2024-09-13 17:43:05', NULL, NULL),
(3, NULL, 'belen', 'llanos', '1988-11-08', 340, 'arica con junin', 987654321, 'masculino', 4, 2, 'uploads/fotos/1726496930.jpg', '2024-09-13 19:09:21', NULL, NULL),
(4, NULL, 'belen', 'llanos', '2024-09-13', 340, 'arica con junin', 987654321, 'femenino', 4, 1, 'uploads/fotos/UVD1_66e48dfaec2e2.png', '2024-09-13 19:09:46', NULL, '2024-09-13 21:10:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avatars`
--

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL,
  `file_name` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `avatars`
--

INSERT INTO `avatars` (`id`, `file_name`, `name`, `created_at`) VALUES
(1, 'uploads/avatars/avatar1.png', 'avatar1', '2024-10-09 19:31:58'),
(2, 'uploads/avatars/avatar2.png', 'avatar2', '2024-10-09 19:43:31'),
(3, 'uploads/avatars/avatar3.png', 'avatar3', '2024-10-09 21:25:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ingeniero de Sistemas e Informatica', '2024-10-09 13:24:55', NULL, NULL),
(2, 'Finanzas', '2024-10-11 17:13:07', NULL, '2024-11-13 18:11:34'),
(3, 'Recursos Humanos', '2024-10-11 17:13:14', NULL, NULL),
(4, 'Gerente General', '2024-10-11 17:13:19', NULL, '2024-11-13 18:11:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(11) NOT NULL,
  `placa` varchar(250) DEFAULT NULL,
  `id_tipo` varchar(250) DEFAULT NULL,
  `modelo` varchar(250) DEFAULT NULL,
  `marca` varchar(250) DEFAULT NULL,
  `color` varchar(350) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `estado` varchar(50) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` bigint(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `estado` int(5) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracions`
--

INSERT INTO `configuracions` (`id`, `numero`, `estado`, `created_at`) VALUES
(1, '127.0.0.1', 1, '2024-10-14 20:51:37'),
(2, '190.116.43.197', 1, '2024-10-15 14:38:14'),
(5, '127.0.0.12', 1, '2024-10-15 15:20:46'),
(6, '179.6.170.187', 1, '2024-10-26 03:34:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` int(11) NOT NULL,
  `abonado_id` varchar(250) DEFAULT NULL,
  `vehiculo_id` varchar(250) DEFAULT NULL,
  `plan_id` varchar(250) DEFAULT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `estacionamiento_id` varchar(250) DEFAULT NULL,
  `nota` varchar(250) DEFAULT NULL,
  `estado_pago` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `abonado_id`, `vehiculo_id`, `plan_id`, `fecha_inicio`, `fecha_fin`, `estacionamiento_id`, `nota`, `estado_pago`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '1', '1', '2024-12-05 19:28:40', '2025-01-31 19:28:40', '1', 'aaaa', '1', '1', '2024-12-05 19:29:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE `distritos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id`, `provincia_id`, `nombre`, `deleted_at`) VALUES
(1, 1, 'BAGUA', NULL),
(2, 1, 'BAGUA', NULL),
(3, 1, 'BAGUA GRANDE', NULL),
(4, 1, 'BONGARA', NULL),
(5, 1, 'CHACHAPOYAS', NULL),
(6, 1, 'CONDORCANQUI', NULL),
(7, 1, 'COROSHA', NULL),
(8, 1, 'EL CENEPA', NULL),
(9, 1, 'EL MILAGRO', NULL),
(10, 1, 'JAZAN', NULL),
(11, 1, 'LUYA', NULL),
(12, 1, 'NIEVA', NULL),
(13, 1, 'RODRIGUEZ DE MENDOZA', NULL),
(14, 1, 'SAN NICOLAS', NULL),
(15, 1, 'UTCUBAMBA', NULL),
(16, 2, 'AIJA', NULL),
(17, 2, 'ANTONIO RAYMONDI', NULL),
(18, 2, 'ASUNCION', NULL),
(19, 2, 'BOLOGNESI', NULL),
(20, 2, 'CARAZ', NULL),
(21, 2, 'CARHUAZ', NULL),
(22, 2, 'CARLOS FERMIN FITZCARRALD', NULL),
(23, 2, 'CASCA', NULL),
(24, 2, 'CASMA', NULL),
(25, 2, 'CHAVIN DE HUANTAR', NULL),
(26, 2, 'CHIMBOTE', NULL),
(27, 2, 'COISHCO', NULL),
(28, 2, 'CORONGO', NULL),
(29, 2, 'HUARAZ', NULL),
(30, 2, 'HUARI', NULL),
(31, 2, 'HUARMEY', NULL),
(32, 2, 'HUAYLAS', NULL),
(33, 2, 'INDEPENDENCIA', NULL),
(34, 2, 'MACATE', NULL),
(35, 2, 'MARISCAL LUZURIAGA', NULL),
(37, 2, 'NUEVO CHIMBOTE', NULL),
(38, 2, 'OCROS', NULL),
(39, 2, 'PALLASCA', NULL),
(40, 2, 'PAMPAROMAS', NULL),
(41, 2, 'POMABAMBA', NULL),
(42, 2, 'RECUAY', NULL),
(43, 2, 'SAN MARCOS', NULL),
(44, 2, 'SANTA', NULL),
(45, 2, 'SANTA', NULL),
(46, 2, 'SIHUAS', NULL),
(47, 2, 'YUNGAR', NULL),
(48, 2, 'YUNGAY', NULL),
(49, 2, 'YURACMARCA', NULL),
(50, 3, 'ABANCAY', NULL),
(51, 3, 'ANCO-HUALLO', NULL),
(52, 3, 'ANDAHUAYLAS', NULL),
(53, 3, 'ANTABAMBA', NULL),
(54, 3, 'AYMARAES', NULL),
(55, 3, 'CHALHUANCA', NULL),
(56, 3, 'CHALLHUAHUACHO', NULL),
(57, 3, 'CHINCHEROS', NULL),
(58, 3, 'CHUQUIBAMBILLA', NULL),
(59, 3, 'COTABAMBAS', NULL),
(60, 3, 'GRAU', NULL),
(61, 4, 'ACARI', NULL),
(62, 4, 'ALTO SELVA ALEGRE', NULL),
(63, 4, 'APLAO', NULL),
(64, 4, 'AREQUIPA', NULL),
(65, 4, 'ATIQUIPA', NULL),
(66, 4, 'BELLA UNION', NULL),
(67, 4, 'CAMANA', NULL),
(68, 4, 'CARAVELI', NULL),
(69, 4, 'CASTILLA', NULL),
(70, 4, 'CAYLLOMA', NULL),
(71, 4, 'CAYLLOMA', NULL),
(72, 4, 'CAYMA', NULL),
(73, 4, 'CERRO COLORADO', NULL),
(74, 4, 'CHALA', NULL),
(75, 4, 'CHAPARRA', NULL),
(76, 4, 'CHARACATO', NULL),
(77, 4, 'CHIVAY', NULL),
(78, 4, 'COCACHACRA', NULL),
(79, 4, 'CONDESUYOS', NULL),
(80, 4, 'ISLAY', NULL),
(81, 4, 'ISLAY', NULL),
(82, 4, 'JACOBO HUNTER', NULL),
(83, 4, 'JOSE LUIS BUSTAMANTE Y RIVERO', NULL),
(84, 4, 'LA JOYA', NULL),
(85, 4, 'LA UNION', NULL),
(86, 4, 'MARIANO MELGAR', NULL),
(87, 4, 'MARIANO NICOLAS VALCARCEL', NULL),
(88, 4, 'MOLLENDO', NULL),
(90, 4, 'ORCOPAMPA', NULL),
(91, 4, 'SABANDIA', NULL),
(92, 4, 'SACHACA', NULL),
(93, 4, 'SANTA RITA DE SIGUAS', NULL),
(94, 4, 'SOCABAYA', NULL),
(95, 4, 'TIABAYA', NULL),
(96, 4, 'YANAHUARA', NULL),
(97, 4, 'YAUCA', NULL),
(98, 4, 'YURA', NULL),
(99, 5, 'AYACUCHO', NULL),
(100, 5, 'AYAHUANCO', NULL),
(101, 5, 'CANGALLO', NULL),
(102, 5, 'CORACORA', NULL),
(103, 5, 'HUAMANGA', NULL),
(104, 5, 'HUAMANGUILLA', NULL),
(105, 5, 'HUANCA SANCOS', NULL),
(106, 5, 'HUANTA', NULL),
(107, 5, 'HUANTA', NULL),
(108, 5, 'JESUS NAZARENO', NULL),
(109, 5, 'LA MAR', NULL),
(110, 5, 'LUCANAS', NULL),
(111, 5, 'LUCANAS', NULL),
(112, 5, 'OYOLO', NULL),
(113, 5, 'PARINACOCHAS', NULL),
(114, 5, 'PAUCAR DEL SARA SARA', NULL),
(115, 5, 'PULLO', NULL),
(116, 5, 'PUQUIO', NULL),
(117, 5, 'SAMUGARI', NULL),
(118, 5, 'SAN PEDRO', NULL),
(119, 5, 'SAN PEDRO DE PALCO', NULL),
(120, 5, 'SANCOS', NULL),
(121, 5, 'SUCRE', NULL),
(122, 5, 'TAMBO', NULL),
(123, 5, 'VICTOR FAJARDO', NULL),
(124, 5, 'VILCAS HUAMAN', NULL),
(125, 6, 'BAMBAMARCA', NULL),
(126, 6, 'BELLAVISTA', NULL),
(127, 6, 'CAJABAMBA', NULL),
(128, 6, 'CAJABAMBA', NULL),
(129, 6, 'CAJAMARCA', NULL),
(130, 6, 'CELENDIN', NULL),
(131, 6, 'CHANCAY', NULL),
(132, 6, 'CHOTA', NULL),
(133, 6, 'CONTUMAZA', NULL),
(134, 6, 'CUTERVO', NULL),
(135, 6, 'HUALGAYOC', NULL),
(136, 6, 'JAEN', NULL),
(137, 6, 'JAEN', NULL),
(138, 6, 'LA ESPERANZA', NULL),
(140, 6, 'PEDRO GALVEZ', NULL),
(141, 6, 'PUCARA', NULL),
(142, 6, 'SAN IGNACIO', NULL),
(143, 6, 'SAN MARCOS', NULL),
(144, 6, 'SAN MIGUEL', NULL),
(145, 6, 'SAN PABLO', NULL),
(146, 6, 'SANTA CRUZ', NULL),
(147, 6, 'SANTA CRUZ DE TOLED', NULL),
(148, 7, 'BELLAVISTA', NULL),
(149, 7, 'CALLAO', NULL),
(150, 7, 'CARMEN DE LA LEGUA', NULL),
(151, 7, 'LA PERLA', NULL),
(152, 7, 'LA PUNTA', NULL),
(153, 7, 'VENTANILLA', NULL),
(154, 8, 'ACOMAYO', NULL),
(155, 8, 'ANCAHUASI', NULL),
(156, 8, 'ANTA', NULL),
(157, 8, 'ANTA', NULL),
(158, 8, 'CACHIMAYO', NULL),
(159, 8, 'CALCA', NULL),
(160, 8, 'CANAS', NULL),
(161, 8, 'CANCHIS', NULL),
(162, 8, 'CHINCHERO', NULL),
(163, 8, 'CHUMBIVILCAS', NULL),
(164, 8, 'CUSCO', NULL),
(165, 8, 'ECHARATE', NULL),
(166, 8, 'ESPINAR', NULL),
(167, 8, 'HUAYLLABAMBA', NULL),
(168, 8, 'LA CONVENCION', NULL),
(169, 8, 'MACHUPICCHU', NULL),
(170, 8, 'OLLANTAYTAMBO', NULL),
(171, 8, 'PARURO', NULL),
(172, 8, 'PAUCARTAMBO', NULL),
(173, 8, 'QUISPICANCHI', NULL),
(174, 8, 'SAN JERONIMO', NULL),
(175, 8, 'SAN SEBASTIAN', NULL),
(176, 8, 'SANTA TERESA', NULL),
(177, 8, 'SANTIAGO', NULL),
(178, 8, 'SANTO TOMAS', NULL),
(179, 8, 'SAYLLA', NULL),
(180, 8, 'SICUANI', NULL),
(181, 8, 'URUBAMBA', NULL),
(182, 8, 'URUBAMBA', NULL),
(183, 8, 'VELILLE', NULL),
(184, 8, 'WANCHAQ', NULL),
(185, 9, 'ACOBAMBA', NULL),
(186, 9, 'ANGARAES', NULL),
(187, 9, 'CASTROVIRREYNA', NULL),
(188, 9, 'CHURCAMPA', NULL),
(189, 9, 'COSME', NULL),
(190, 9, 'HUACHOCOLPA', NULL),
(191, 9, 'HUANCAVELICA', NULL),
(192, 9, 'HUAYTARA', NULL),
(193, 9, 'IZCUCHACA', NULL),
(194, 9, 'LA MERCED', NULL),
(195, 9, 'LIRCAY', NULL),
(196, 9, 'PAMPAS', NULL),
(197, 9, 'PAUCARA', NULL),
(198, 9, 'SANTA ANA', NULL),
(199, 9, 'TAYACAJA', NULL),
(200, 10, 'AMARILIS', NULL),
(201, 10, 'AMBO', NULL),
(202, 10, 'CONCHAMARCA', NULL),
(203, 10, 'DOS DE MAYO', NULL),
(204, 10, 'HUACAYBAMBA', NULL),
(205, 10, 'HUAMALIES', NULL),
(206, 10, 'HUANUCO', NULL),
(207, 10, 'LAURICOCHA', NULL),
(208, 10, 'LEONCIO PRADO', NULL),
(209, 10, 'LLATA', NULL),
(211, 10, 'MIRAFLORES', NULL),
(212, 10, 'MONZON', NULL),
(213, 10, 'PACHITEA', NULL),
(214, 10, 'PANAO', NULL),
(215, 10, 'PUERTO INCA', NULL),
(216, 10, 'RUPA-RUPA', NULL),
(217, 10, 'TINGO MARIA', NULL),
(218, 10, 'YACUS', NULL),
(219, 10, 'YAROWILCA', NULL),
(220, 11, 'ALTO LARAN', NULL),
(221, 11, 'CHINCHA', NULL),
(222, 11, 'CHINCHA ALTA', NULL),
(223, 11, 'CHINCHA BAJA', NULL),
(224, 11, 'GROCIO PRADO', NULL),
(225, 11, 'HUANCANO', NULL),
(226, 11, 'ICA', NULL),
(227, 11, 'INDEPENDENCIA', NULL),
(229, 11, 'LOS AQUIJES', NULL),
(230, 11, 'MARCONA', NULL),
(231, 11, 'NAZCA', NULL),
(232, 11, 'NAZCA', NULL),
(233, 11, 'PALPA', NULL),
(234, 11, 'PARACAS', NULL),
(235, 11, 'PARCONA', NULL),
(236, 11, 'PISCO', NULL),
(237, 11, 'PISCO', NULL),
(238, 11, 'PUEBLO NUEVO', NULL),
(239, 11, 'SAN ANDRES', NULL),
(240, 11, 'SAN JOSE DE LOS MOLINOS', NULL),
(241, 11, 'SAN JUAN BAUTISTA', NULL),
(242, 11, 'SUBTANJALLA', NULL),
(243, 11, 'SUNAMPE', NULL),
(244, 11, 'TAMBO DE MORA', NULL),
(245, 12, 'CARHUAMAYO', NULL),
(246, 12, 'CHANCHAMAYO', NULL),
(247, 12, 'CHUPACA', NULL),
(248, 12, 'CHUPURO', NULL),
(249, 12, 'CONCEPCION', NULL),
(250, 12, 'EL TAMBO', NULL),
(251, 12, 'HUANCAYO', NULL),
(252, 12, 'HUAY-HUAY', NULL),
(253, 12, 'JAUJA', NULL),
(254, 12, 'JUNIN', NULL),
(255, 12, 'LA OROYA', NULL),
(256, 12, 'LA UNION', NULL),
(257, 12, 'MOROCOCHA', NULL),
(258, 12, 'PANGOA', NULL),
(259, 12, 'PERENE', NULL),
(260, 12, 'PICHANAQUI', NULL),
(261, 12, 'RIO TAMBO', NULL),
(262, 12, 'SAN JERONIMO DE TUNAN', NULL),
(263, 12, 'SAN RAMON', NULL),
(264, 12, 'SANTA BARBARA DE CARHUACAYAN', NULL),
(265, 12, 'SATIPO', NULL),
(266, 12, 'SICAYA', NULL),
(267, 12, 'TARMA', NULL),
(268, 12, 'YAULI', NULL),
(269, 12, 'YAULI', NULL),
(270, 12, 'YAUYOS', NULL),
(271, 13, 'ASCOPE', NULL),
(272, 13, 'BOLIVAR', NULL),
(273, 13, 'CACHICADAN', NULL),
(274, 13, 'CASA GRANDE', NULL),
(275, 13, 'CASCAS', NULL),
(276, 13, 'CHAO', NULL),
(277, 13, 'CHEPEN', NULL),
(278, 13, 'CHICAMA', NULL),
(279, 13, 'CHOCOPE', NULL),
(280, 13, 'CURGOS', NULL),
(281, 13, 'FLORENCIA DE MORA', NULL),
(282, 13, 'GRAN CHIMU', NULL),
(283, 13, 'GUADALUPE', NULL),
(284, 13, 'HUAMACHUCO', NULL),
(285, 13, 'HUANCHACO', NULL),
(286, 13, 'JULCAN', NULL),
(287, 13, 'LAREDO', NULL),
(288, 13, 'MOCHE', NULL),
(289, 13, 'OTUZCO', NULL),
(290, 13, 'PACASMAYO', NULL),
(291, 13, 'PACASMAYO', NULL),
(292, 13, 'PARCOY', NULL),
(293, 13, 'PATAZ', NULL),
(294, 13, 'PATAZ', NULL),
(295, 13, 'RAZURI', NULL),
(296, 13, 'SALAVERRY', NULL),
(297, 13, 'SAN JOSE', NULL),
(298, 13, 'SAN PEDRO DE LLOC', NULL),
(299, 13, 'SANCHEZ CARRION', NULL),
(300, 13, 'SANTIAGO DE CAO', NULL),
(301, 13, 'SANTIAGO DE CHUCO', NULL),
(302, 13, 'TRUJILLO', NULL),
(303, 13, 'USQUIL', NULL),
(304, 13, 'VICTOR LARCO HERRERA', NULL),
(305, 13, 'VIRU', NULL),
(306, 14, 'CHICLAYO', NULL),
(307, 14, 'CHONGOYAPE', NULL),
(309, 14, 'JAYANCA', NULL),
(310, 14, 'JOSE LEONARDO ORTIZ', NULL),
(311, 14, 'LA VICTORIA', NULL),
(312, 14, 'LAMBAYEQUE', NULL),
(313, 14, 'MORROPE', NULL),
(314, 14, 'MOTUPE', NULL),
(315, 14, 'OLMOS', NULL),
(316, 14, 'PIMENTEL', NULL),
(317, 14, 'POMALCA', NULL),
(318, 14, 'SALAS', NULL),
(320, 15, 'AMBAR', '2022-03-13 14:21:20'),
(321, 15, 'ANCÓN', NULL),
(322, 15, 'ASIA', '2022-03-13 14:21:28'),
(323, 15, 'ATAVILLOS BAJO', '2022-03-13 14:21:32'),
(324, 15, 'ATE VITARTE', NULL),
(325, 27, 'BARRANCA', NULL),
(326, 15, 'BREÑA', NULL),
(327, 15, 'BARRANCO', NULL),
(329, 27, 'CAJATAMBO', NULL),
(330, 27, 'CANTA', NULL),
(332, 15, 'CARABAYLLO', NULL),
(333, 15, 'CERRO AZUL', '2022-03-13 14:22:23'),
(334, 15, 'CHACLACAYO', NULL),
(335, 15, 'CERCADO DE LIMA', NULL),
(336, 27, 'CAÑETE', NULL),
(337, 15, 'CHILCA', '2022-03-13 14:23:23'),
(338, 15, 'CHORRILLOS', NULL),
(339, 15, 'CIENEGUILLA', NULL),
(340, 15, 'COMAS', NULL),
(341, 15, 'EL AGUSTINO', NULL),
(342, 27, 'HUARAL', NULL),
(343, 27, 'HUAROCHIRÍ', NULL),
(344, 27, 'HUAURA', NULL),
(345, 15, 'HUAURA', '2022-03-13 14:23:59'),
(346, 15, 'IMPERIAL', '2022-03-13 14:24:01'),
(347, 15, 'INDEPENDENCIA', NULL),
(348, 15, 'JESÚS MARÍA', NULL),
(349, 15, 'LA MOLINA', NULL),
(350, 15, 'LA VICTORIA', NULL),
(351, 15, 'LAMPIAN', '2022-03-13 14:24:23'),
(352, 15, 'LIMA', '2022-03-13 14:24:26'),
(353, 15, 'LINCE', NULL),
(354, 15, 'LOS OLIVOS', NULL),
(355, 15, 'LUNAHUANA', '2022-03-13 14:24:35'),
(356, 15, 'LURIGANCHO', NULL),
(357, 15, 'LURÍN', NULL),
(358, 15, 'MAGDALENA DEL MAR', NULL),
(359, 15, 'MALA', '2022-03-13 14:24:57'),
(360, 15, 'MATUCANA', '2022-03-13 14:25:03'),
(361, 15, 'MIRAFLORES', NULL),
(362, 15, 'NUEVO IMPERIAL', '2022-03-13 14:25:16'),
(363, 27, 'OYÓN', NULL),
(364, 15, 'PACHACAMAC', NULL),
(365, 15, 'PARAMONGA', '2022-03-13 14:25:21'),
(366, 15, 'PATIVILCA', '2022-03-13 14:25:24'),
(367, 26, 'PUCUSANA', NULL),
(368, 15, 'PUEBLO LIBRE', NULL),
(369, 15, 'PUENTE PIEDRA', NULL),
(370, 26, 'PUNTA HERMOSA', NULL),
(371, 26, 'PUNTA NEGRA', NULL),
(372, 15, 'QUILMANA', '2022-03-13 14:25:42'),
(373, 15, 'RÍMAC', NULL),
(374, 26, 'SAN BARTOLO', NULL),
(375, 15, 'SAN BORJA', NULL),
(376, 15, 'SAN ISIDRO', NULL),
(377, 15, 'SAN JUAN DE LURIGANCHO', NULL),
(378, 15, 'SAN JUAN DE MIRAFLORES', NULL),
(379, 15, 'SAN LUIS', NULL),
(380, 15, 'SAN MARTIN DE PORRES', NULL),
(381, 15, 'SAN MATEO', '2022-03-13 14:26:16'),
(382, 15, 'SAN MIGUEL', NULL),
(384, 15, 'SANTA ANITA', NULL),
(385, 26, 'SANTA MARÍA DEL MAR', NULL),
(386, 15, 'SANTA ROSA', NULL),
(387, 15, 'SANTIAGO DE SURCO', NULL),
(388, 15, 'SANTIAGO DE TUNA', '2022-03-13 14:26:34'),
(389, 15, 'SUPE', '2022-03-13 14:26:36'),
(390, 15, 'SUPE PUERTO', '2022-03-13 14:26:39'),
(391, 15, 'SURQUILLO', NULL),
(392, 15, 'VILLA EL SALVADOR', NULL),
(393, 15, 'VILLA MARIA DEL TRIUNFO', NULL),
(394, 27, 'YAUYOS', NULL),
(395, 16, 'ALTO AMAZONAS', NULL),
(396, 16, 'BARRANCA', NULL),
(398, 16, 'IQUITOS', NULL),
(399, 16, 'LORETO', NULL),
(400, 16, 'MARISCAL RAMON CASTILLA', NULL),
(401, 16, 'MAYNAS', NULL),
(402, 16, 'NAUTA', NULL),
(403, 16, 'PUNCHANA', NULL),
(404, 16, 'REQUENA', NULL),
(405, 16, 'UCAYALI', NULL),
(406, 16, 'YURIMAGUAS', NULL),
(407, 17, 'IBERIA', NULL),
(409, 17, 'MADRE DE DIOS    ', NULL),
(410, 17, 'MANU', NULL),
(411, 17, 'MANU    ', NULL),
(412, 17, 'TAHUAMANU', NULL),
(413, 17, 'TAMBOPATA', NULL),
(414, 18, 'GENERAL SANCHEZ CERRO', NULL),
(416, 18, 'ILO', NULL),
(417, 18, 'MARISCAL NIETO', NULL),
(418, 18, 'MOQUEGUA', NULL),
(419, 18, 'OMATE', NULL),
(420, 18, 'SAMEGUA', NULL),
(421, 18, 'TORATA', NULL),
(422, 19, 'CHACAYAN', NULL),
(423, 19, 'CHONTABAMBA', NULL),
(425, 19, 'DANIEL ALCIDES CARRION', NULL),
(426, 19, 'GOYLLARISQUIZGA', NULL),
(427, 19, 'HUACHON', NULL),
(428, 19, 'HUARIACA', NULL),
(429, 19, 'HUAYLLAY', NULL),
(430, 19, 'OXAPAMPA', NULL),
(431, 19, 'PALCAZU', NULL),
(432, 19, 'PASCO', NULL),
(433, 19, 'PAUCAR', NULL),
(434, 19, 'SAN FRANCISCO DE ASIS DE YARUSYACAN', NULL),
(435, 19, 'SANTA ANA DE TUSI', NULL),
(436, 19, 'SIMON BOLIVAR', NULL),
(437, 19, 'TINYAHUARCO', NULL),
(438, 19, 'VILLA RICA', NULL),
(439, 19, 'YANACANCHA', NULL),
(440, 19, 'YANAHUANCA', NULL),
(441, 20, 'AYABACA', NULL),
(442, 20, 'CASTILLA', NULL),
(443, 20, 'CATACAOS', NULL),
(444, 20, 'CHULUCANAS', NULL),
(445, 20, 'EL ALTO', NULL),
(446, 20, 'HUANCABAMBA', NULL),
(447, 20, 'HUARMACA', NULL),
(448, 20, 'LA BREA', NULL),
(449, 20, 'LA MATANZA', NULL),
(450, 20, 'LA UNION', NULL),
(451, 20, 'LOS ORGANOS', NULL),
(452, 20, 'MANCORA', NULL),
(453, 20, 'MORROPON', NULL),
(454, 20, 'MORROPON', NULL),
(455, 20, 'PAITA', NULL),
(457, 20, 'PIURA', NULL),
(458, 20, 'RINCONADA LLICUAR', NULL),
(459, 20, 'SECHURA', NULL),
(460, 20, 'SONDORILLO', NULL),
(461, 20, 'SULLANA', NULL),
(462, 20, 'TALARA', NULL),
(463, 20, 'TAMBO GRANDE', NULL),
(464, 21, 'AJOYANI', NULL),
(465, 21, 'ANTAUTA', NULL),
(466, 21, 'ASILLO', NULL),
(467, 21, 'AYAVIRI', NULL),
(468, 21, 'AZANGARO', NULL),
(469, 21, 'AZANGARO', NULL),
(470, 21, 'CABANILLAS', NULL),
(471, 21, 'CARABAYA', NULL),
(472, 21, 'CARACOTO', NULL),
(473, 21, 'CHUCUITO', NULL),
(474, 21, 'COATA', NULL),
(475, 21, 'DESAGUADERO', NULL),
(476, 21, 'EL COLLAO', NULL),
(477, 21, 'HUANCANE', NULL),
(478, 21, 'ILAVE', NULL),
(479, 21, 'JULI', NULL),
(480, 21, 'JULIACA', NULL),
(481, 21, 'LAMPA', NULL),
(482, 21, 'MACUSANI', NULL),
(484, 21, 'MELGAR', NULL),
(485, 21, 'MOHO', NULL),
(487, 21, 'OLLACHEA', NULL),
(488, 21, 'PUNO', NULL),
(489, 21, 'PUTINA', NULL),
(490, 21, 'SAN ANTONIO DE PUTINA', NULL),
(491, 21, 'SAN GABAN', NULL),
(492, 21, 'SAN ROMAN', NULL),
(493, 21, 'SANDIA', NULL),
(494, 21, 'TARACO', NULL),
(495, 21, 'YUNGUYO', NULL),
(496, 21, 'YUNGUYO', NULL),
(497, 22, 'BELLAVISTA', NULL),
(498, 22, 'EL DORADO', NULL),
(499, 22, 'EL PORVENIR', NULL),
(500, 22, 'HUALLAGA', NULL),
(501, 22, 'JUANJUI', NULL),
(502, 22, 'LAMAS', NULL),
(503, 22, 'MARISCAL CACERES', NULL),
(504, 22, 'MOYOBAMBA', NULL),
(505, 22, 'NUEVA CAJAMARCA', NULL),
(506, 22, 'PICOTA', NULL),
(507, 22, 'PICOTA', NULL),
(508, 22, 'RIOJA', NULL),
(509, 22, 'RIOJA', NULL),
(510, 22, 'SAN JOSE DE SISA', NULL),
(511, 22, 'SAN MARTIN', NULL),
(512, 22, 'TARAPOTO', NULL),
(513, 22, 'TOCACHE', NULL),
(514, 22, 'UCHIZA', NULL),
(515, 23, 'CANDARAVE', NULL),
(516, 23, 'CORONEL GREGORIO ALBARRACIN LANCHIPA', NULL),
(517, 23, 'ESTIQUE', NULL),
(518, 23, 'ILABAYA', NULL),
(519, 23, 'JORGE BASADRE', NULL),
(520, 23, 'PACHIA', NULL),
(521, 23, 'PALCA', NULL),
(522, 23, 'TACNA', NULL),
(523, 23, 'TARATA', NULL),
(524, 24, 'CONTRALMIRANTE VILLAR', NULL),
(525, 24, 'TUMBES', NULL),
(526, 24, 'ZARUMILLA', NULL),
(527, 25, 'ATALAYA', NULL),
(528, 25, 'CORONEL PORTILLO', NULL),
(529, 25, 'PADRE ABAD', NULL),
(530, 25, 'PURUS', NULL),
(531, 7, 'MI PERÚ', NULL),
(532, 28, 'OTROS', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(11) NOT NULL,
  `dni` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `cargo_id` int(5) NOT NULL,
  `tel` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `salario` varchar(10) DEFAULT NULL,
  `horario_id` int(11) DEFAULT NULL,
  `avatar_id` int(11) DEFAULT 1,
  `estado` int(5) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `dni`, `nombre`, `apellido`, `cargo_id`, `tel`, `email`, `salario`, `horario_id`, `avatar_id`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '74146165', 'Sebastián', 'Vasquez', 1, '987654321', 'wong@gmail.com', NULL, 3, 1, 1, '2024-10-09 13:25:32', NULL, NULL),
(2, '06824493', 'Gianella', 'Perez', 3, '987654325', 'a@gmail.com', NULL, 1, 2, 1, '2024-10-09 16:03:02', NULL, NULL),
(3, '78146584', 'Pablo', 'Vera Vasquez', 4, '987654321', 'vera@gmail.com', NULL, 2, 3, 1, '2024-10-09 16:07:41', NULL, '2024-11-13 18:10:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` bigint(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `web` varchar(250) DEFAULT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `ruc`, `direccion`, `email`, `web`, `tel`, `logo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PARKINGMIX', '10646165651', 'AV ARGENTINA 614', 'correo@gmail.com', 'https://grupocodware.com/', '987654321', 'uploads/fotos/prefix_674e265a7d9e0.png', '2024-10-19 14:59:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacionamientos`
--

CREATE TABLE `estacionamientos` (
  `id` bigint(11) NOT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  `numero` varchar(250) DEFAULT NULL,
  `piso` varchar(50) DEFAULT NULL,
  `id_user` varchar(250) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `estado` varchar(50) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estacionamientos`
--

INSERT INTO `estacionamientos` (`id`, `codigo`, `numero`, `piso`, `id_user`, `observaciones`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LIBRE', 'LIBRE', '1', '1', 'NO HAY NUMERO DE ESTACIONAMIENTOS', '1', '2024-12-02 16:56:19', NULL, NULL),
(2, 'A001', 'B6D-356', '1', NULL, 'ABONADO', '1', '2024-12-02 17:32:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `id` bigint(11) NOT NULL,
  `dni` varchar(11) DEFAULT NULL,
  `horas` varchar(50) DEFAULT NULL,
  `minutos` varchar(50) DEFAULT NULL,
  `documento` varchar(250) DEFAULT NULL,
  `estado` int(5) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `extras`
--

INSERT INTO `extras` (`id`, `dni`, `horas`, `minutos`, `documento`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '74146165', '8', '40', NULL, 2, '2024-10-11 20:27:22', NULL, '2024-11-13 18:13:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `ingreso` time NOT NULL,
  `salida` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `ingreso`, `salida`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '08:00:00', '17:00:00', '2024-10-09 14:05:24', NULL, NULL),
(2, '13:00:00', '21:00:00', '2024-10-09 14:06:55', NULL, '2024-11-13 18:11:53'),
(3, '08:00:00', '12:00:00', '2024-10-09 14:07:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memorandum`
--

CREATE TABLE `memorandum` (
  `id` bigint(11) NOT NULL,
  `dni` varchar(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `asunto` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `memorandum`
--

INSERT INTO `memorandum` (`id`, `dni`, `nombres`, `logo`, `asunto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '74146165', 'Sebastián Vasquez', NULL, 'Es fundamental mantener una buena comunicación sobre cualquier dificultad que pueda surgir, así como el impacto que esto pueda tener en el equipo y en los proyectos en curso', '2024-10-26 03:37:49', NULL, '2024-11-13 18:13:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_02_27_213110_create_alumnos_table', 1),
(4, '2021_02_27_213535_create_alumno_avisos_table', 1),
(5, '2021_02_27_213551_create_alumno_habilidads_table', 1),
(6, '2021_02_27_215354_create_avisos_table', 1),
(7, '2021_02_27_215407_create_empresas_table', 1),
(8, '2021_02_27_215445_create_estados_table', 1),
(9, '2021_02_27_215500_create_experiencia_laborals_table', 1),
(10, '2021_02_27_215522_create_habilidads_table', 1),
(11, '2021_02_27_215542_create_referencias_table', 1),
(12, '2021_03_08_214534_create_areas_table', 1),
(13, '2021_03_08_214723_create_provincias_table', 1),
(14, '2021_03_08_214745_create_distritos_table', 1),
(15, '2021_03_08_214812_create_horarios_table', 1),
(16, '2021_03_09_081132_create_modalidads_table', 1),
(17, '2021_03_09_081202_create_condicions_table', 1),
(18, '2021_03_09_150419_create_cargos_table', 2),
(19, '2021_03_11_225431_create_educacions_table', 3),
(20, '2021_03_11_225531_create_referencia_laborals_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `tiempo` varchar(250) DEFAULT NULL,
  `precio` varchar(250) DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `estado` varchar(1) DEFAULT '',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `uptdated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `codigo`, `nombre`, `tiempo`, `precio`, `observaciones`, `estado`, `created_at`, `uptdated_at`, `deleted_at`) VALUES
(1, 'ABONADOS MENSUAL 24 HORAS', 'ABONADOS MENSUAL 24 HORAS', 'MENSUAL', '350', 'ABONADOS MENSUAL 24 HORAS', '1', '2024-12-05 17:22:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `deleted_at`) VALUES
(1, 'DESARROLLADOR', NULL),
(2, 'ADMINISTRADOR', NULL),
(3, 'SUPERVISOR', NULL),
(4, 'TIMOTEO', '2024-10-19 12:11:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`, `deleted_at`) VALUES
(1, 'AMAZONAS', '2022-03-13 07:00:00'),
(2, 'ANCASH', '2022-03-13 07:00:00'),
(3, 'APURIMAC', '2022-03-13 07:00:00'),
(4, 'AREQUIPA', '2022-03-13 07:00:00'),
(5, 'AYACUCHO', '2022-03-13 07:00:00'),
(6, 'CAJAMARCA', '2022-03-13 07:00:00'),
(7, 'CALLAO', NULL),
(8, 'CUSCO', '2022-03-13 07:00:00'),
(9, 'HUANCAVELICA', '2022-03-13 07:00:00'),
(10, 'HUÁNUCO', '2022-03-13 07:00:00'),
(11, 'ICA', '2022-03-13 07:00:00'),
(12, 'JUNÍN', '2022-03-13 07:00:00'),
(13, 'LA LIBERTAD', '2022-03-13 07:00:00'),
(14, 'LAMBAYEQUE', '2022-03-13 07:00:00'),
(15, 'LIMA METROPOLITANA', NULL),
(16, 'LORETO', '2022-03-13 07:00:00'),
(17, 'MADRE DE DIOS', '2022-03-13 07:00:00'),
(18, 'MOQUEGUA', '2022-03-13 07:00:00'),
(19, 'PASCO', '2022-03-13 07:00:00'),
(20, 'PIURA', '2022-03-13 07:00:00'),
(21, 'PUNO', '2022-03-13 07:00:00'),
(22, 'SAN MARTIN', '2022-03-13 07:00:00'),
(23, 'TACNA', '2022-03-13 07:00:00'),
(24, 'TUMBES', '2022-03-13 07:00:00'),
(25, 'UCAYALI', '2022-03-13 07:00:00'),
(26, 'LIMA BALNEARIOS', NULL),
(27, 'LIMA PROVINCIA', NULL),
(28, 'OTROS', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(11) NOT NULL,
  `vehiculo_id` varchar(11) NOT NULL,
  `tiempo_inicio` timestamp NULL DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `tiempo_fin` timestamp NULL DEFAULT NULL,
  `horas_servicio` time DEFAULT '01:00:00',
  `monto` varchar(250) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `vehiculo_id`, `tiempo_inicio`, `user_id`, `tiempo_fin`, `horas_servicio`, `monto`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4', '0000-00-00 00:00:00', '1', '2024-12-04 15:03:50', '01:00:00', '115', 2, '2024-12-03 16:59:16', NULL, NULL),
(2, '6', '2024-12-05 14:49:59', '1', NULL, '01:00:00', NULL, 1, '2024-12-03 17:28:44', NULL, NULL),
(3, '6', '0000-00-00 00:00:00', '1', '2024-12-05 14:49:54', '01:00:00', '88', 2, '2024-12-03 17:32:23', NULL, NULL),
(4, '6', '0000-00-00 00:00:00', '1', '2024-12-04 20:19:48', '01:00:00', '96', 2, '2024-12-03 21:09:53', NULL, NULL),
(5, '4', '0000-00-00 00:00:00', '1', '2024-12-05 13:44:04', '01:00:00', '85', 2, '2024-12-03 21:17:18', NULL, NULL),
(6, '4', '0000-00-00 00:00:00', '1', '2024-12-05 14:49:51', '01:00:00', '120', 2, '2024-12-04 15:12:06', NULL, NULL),
(7, '1', '0000-00-00 00:00:00', '1', '2024-12-05 13:44:01', '01:00:00', '110', 2, '2024-12-04 15:48:07', NULL, NULL),
(8, '4', '2024-12-04 19:10:39', '1', '2024-12-04 19:34:34', '01:00:00', '5', 2, '2024-12-03 19:27:41', NULL, NULL),
(9, '6', '2024-12-04 19:51:22', '1', '2024-12-05 13:43:59', '01:00:00', '72', 2, '2024-12-04 19:51:34', NULL, NULL),
(10, '4', '2024-12-04 20:17:40', '1', '2024-12-05 14:49:49', '01:00:00', '95', 2, '2024-12-04 20:17:42', NULL, NULL),
(11, '1', '2024-12-04 20:17:54', '1', '2024-12-05 14:49:47', '01:00:00', '95', 2, '2024-12-04 20:17:58', NULL, NULL),
(12, '1', '2024-12-04 20:18:01', '1', '2024-12-05 14:49:44', '01:00:00', '95', 2, '2024-12-04 20:18:03', NULL, NULL),
(13, '1', '2024-12-04 20:18:07', '1', '2024-12-05 13:43:57', '01:00:00', '90', 2, '2024-12-04 20:18:08', NULL, NULL),
(14, '1', '2024-12-04 20:18:12', '1', '2024-12-04 20:19:52', '01:00:00', '5', 2, '2024-12-04 20:18:13', NULL, NULL),
(15, '6', '2024-12-05 13:23:32', '1', '2024-12-05 14:49:42', '01:00:00', '8', 2, '2024-12-05 13:23:37', NULL, NULL),
(16, '6', '2024-12-05 14:41:15', '1', '2024-12-05 14:49:39', '01:00:00', '4', 2, '2024-12-05 14:41:18', NULL, NULL),
(17, '6', '2024-12-05 14:41:25', '1', '2024-12-05 14:49:37', '01:00:00', '4', 2, '2024-12-05 14:41:26', NULL, NULL),
(18, '6', '2024-12-05 14:49:24', '1', '2024-12-05 14:49:35', '01:00:00', '4', 2, '2024-12-05 14:41:34', NULL, NULL),
(19, '1', '2024-12-05 14:49:14', '1', NULL, '01:00:00', NULL, 1, '2024-12-05 14:41:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `Nombre`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DNI', '2024-12-05 15:33:03', NULL, NULL),
(2, 'Carnet de Extranjeria', '2024-12-05 15:33:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` bigint(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `montoxhora` varchar(250) DEFAULT NULL,
  `montoxfraccion` varchar(250) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `estado` varchar(250) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`, `montoxhora`, `montoxfraccion`, `descripcion`, `estado`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'AUTOS', '4', '4', 'Autos', '1', '2024-09-30 19:35:58', NULL, NULL),
(2, 'CAMIONETAS', '5', '5', 'SUV - HILUX - MINIVANS - PICK UP', '1', '2024-09-30 19:36:02', NULL, NULL),
(3, 'MOTO CARGA', '5', '5', 'Moto Carga', '1', '2024-12-02 21:24:29', NULL, NULL),
(4, 'MOTOS', '4', '4', 'Motos', '1', '2024-12-02 21:24:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `nombres` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `online` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `inicio_sesion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cerrar_sesion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `profile_id`, `nombres`, `email`, `email_verified_at`, `password`, `remember_token`, `estado`, `online`, `inicio_sesion`, `cerrar_sesion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Sebastian Vásquez', 'admin', NULL, '$2y$10$KABbWAD63KNjBVg/eIbNzeg7JzwT7bpwTeERNxV54seGFWWO/Zwea', NULL, '1', '1', '24-12-05 08:23:08', '24-12-04 04:24:46', NULL, '2024-12-05 13:23:08', NULL),
(2, 2, 'Pablo Vera', 'pablo', NULL, '$2y$10$e8EiL7ra1yVEmgnCBjdxF.3euOOFmrHU5mo1ukwkjHiom5swOnemi', NULL, '1', '0', NULL, NULL, '2024-09-18 08:23:27', '2024-10-11 16:33:47', '2024-10-11 16:33:47'),
(3, 2, 'Belén Llanos', 'belen', NULL, '$2y$10$zvohZLo.vpWMRZVy1uL0WuZ0EWZiCleqHSVbSaMuAI2k76uf25Tni', NULL, '1', '1', '24-10-03 12:41:19', '24-09-24 12:19:25', '2024-09-19 10:49:31', '2024-10-11 16:33:50', '2024-10-11 16:33:50'),
(4, 3, 'Graciela Becerra', 'graciela', NULL, '$2y$10$wrIbQTe5hZyOsi36XKPhJOt5mJBBIZCwjVOMWpVyZFMV.776plcuC', NULL, '1', '0', NULL, NULL, '2024-09-19 10:49:59', '2024-10-11 16:33:52', '2024-10-11 16:33:52'),
(5, 3, 'Margiorie Cabrera', 'margiorie', NULL, '$2y$10$euJ.cj5.uFNVXMk78qQCvOUmlNrD9Ncwwr96mdLUOItx8aUx7j/rO', NULL, '1', '1', '24-10-03 04:12:12', NULL, '2024-09-19 10:50:21', '2024-10-11 16:33:55', '2024-10-11 16:33:55'),
(6, 3, 'Naty Ichigo', 'naty', NULL, '$2y$10$bWyhqmxl4HVvvSB0p3pG9OZoEfnFtI/4YznUTkqLBa8aTAV.5jhcq', NULL, '1', '0', '24-09-29 10:05:55', '24-09-29 10:32:59', '2024-09-19 10:50:41', '2024-10-11 16:33:57', '2024-10-11 16:33:57'),
(7, 3, 'Angela Salirrosas', 'angela', NULL, '$2y$10$IIvKk3.spiW/L23SpyELUuwaFgVmy6voSRKjH58CLsVnw.GUHyFUK', NULL, '1', '1', '24-09-30 09:53:28', NULL, '2024-09-19 10:51:00', '2024-10-11 16:34:00', '2024-10-11 16:34:00'),
(8, 3, 'Miguel Ramón', 'miguel', NULL, '$2y$10$OwXL8vbANnR5J/xV9IvP/eNTcKt3Wurxu2ekxmu1DSSrUpSSFTwWu', NULL, '1', '1', '24-10-02 05:30:10', NULL, '2024-09-19 10:51:17', '2024-10-11 16:34:03', '2024-10-11 16:34:03'),
(9, 3, 'John Trujillo', 'john', NULL, '$2y$10$JZEl/uE.mY.OBA2y3I1MGuA9MRPNlB7g9ZQCwFcgA8vGHmQcJx2Cq', NULL, '1', '0', NULL, NULL, '2024-09-19 10:51:32', '2024-10-11 16:33:44', '2024-10-11 16:33:44'),
(10, 3, 'Jerry Caramantin', 'jerry', NULL, '$2y$10$BMLY39sw73k4gX4rAgbrieeVOWnAQgPH2IZpx..ByVMOiAvezYA7i', NULL, '1', '0', NULL, NULL, '2024-09-19 10:51:52', '2024-10-11 16:33:41', '2024-10-11 16:33:41'),
(11, 2, 'Isaí Garay', 'isai', NULL, '$2y$10$fqOCjVRiyB1gm0pBCq9zNuGGLA4n1aYnKJXnD8qwdpX9rgDlpug3m', NULL, '1', '1', '24-10-03 10:51:39', NULL, '2024-09-19 10:52:37', '2024-10-11 16:33:38', '2024-10-11 16:33:38'),
(12, 2, 'ADMIN', 'administrador', NULL, '$2y$10$dsGhSZU1ITYJoNcTQcFpg.vF0uwLnGFWDGkLXgJLab3X2Tbcqi6NO', NULL, '1', '0', '24-10-19 12:21:42', '24-10-19 12:30:16', '2024-10-19 12:18:59', '2024-10-19 12:30:16', NULL),
(13, 3, 'SUPERVISOR', 'supervisor', NULL, '$2y$10$ekgmrHEcUmYCRtJD2umH7OblexFaZxlzU2ObIZ.2oMmyqxZJQu846', NULL, '1', '0', '24-10-19 12:19:21', '24-10-19 12:21:36', '2024-10-19 12:19:13', '2024-10-19 12:21:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint(11) NOT NULL,
  `placa` varchar(250) DEFAULT NULL,
  `tipo_id` varchar(250) DEFAULT NULL,
  `modelo` varchar(250) DEFAULT NULL,
  `marca` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `estado` varchar(50) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `tipo_id`, `modelo`, `marca`, `color`, `observaciones`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BWA813', '2', '', '', '', '', '1', '2024-12-02 21:52:17', NULL, NULL),
(2, 'BWA813', '2', '', '', '', '', '1', '2024-12-02 21:52:22', NULL, '2024-12-02 21:57:38'),
(3, 'AZX865', '3', '', '', '', '', '1', '2024-12-02 21:58:33', NULL, NULL),
(4, 'A6D561', '3', '', '', '', '', '1', '2024-12-02 21:58:41', NULL, NULL),
(5, 'AXB589', '1', '', '', '', '', '1', '2024-12-02 21:58:50', NULL, NULL),
(6, '3248QC', '1', '', '', '', '', '1', '2024-12-02 21:59:13', NULL, NULL),
(7, 'SV02820', '2', '', '', '', '', '1', '2024-12-04 16:43:16', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonados`
--
ALTER TABLE `abonados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distritos_provincia_id_foreign` (`provincia_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estacionamientos`
--
ALTER TABLE `estacionamientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `memorandum`
--
ALTER TABLE `memorandum`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonados`
--
ALTER TABLE `abonados`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=533;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estacionamientos`
--
ALTER TABLE `estacionamientos`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `extras`
--
ALTER TABLE `extras`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `memorandum`
--
ALTER TABLE `memorandum`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
