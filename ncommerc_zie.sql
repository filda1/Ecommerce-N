-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-04-2021 a las 08:26:19
-- Versión del servidor: 10.3.23-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ncommerc_zie`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adresses_users`
--

CREATE TABLE `adresses_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  `is_main` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `adresses_users`
--

INSERT INTO `adresses_users` (`id`, `user_id`, `number`, `country`, `locality`, `zip_code`, `street`, `is_active`, `is_main`, `created_at`, `updated_at`, `deleted_at`) VALUES
(44, 10, '914166310', 'Portugal Madeira', 'Lousada', '4620-696', 'Av. da Liberdade, 279', 0, 0, '2021-04-23 11:00:26', '2021-04-23 16:18:04', NULL),
(45, 17, '91112546', 'Portugal Madeira', 'Lousada', '4620-696', 'ac sfsjjs', 1, 1, '2021-04-23 16:14:34', '2021-04-23 16:14:37', NULL),
(46, 17, '91225457', 'Portugal Continental', 'lousada', '4620-696', 'adsda', 1, 0, '2021-04-23 16:15:43', '2021-04-23 16:15:43', NULL),
(47, 10, '78787', 'Portugal Madeira', '6u676', '12323-566', '45555', 1, 0, '2021-04-23 16:18:00', '2021-04-23 16:22:00', NULL),
(48, 10, '55555', 'Portugal Continental', 'ttttt', '2233', 'errrr', 1, 1, '2021-04-23 16:21:57', '2021-04-23 16:22:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner_publicitario`
--

CREATE TABLE `banner_publicitario` (
  `id` int(10) UNSIGNED NOT NULL,
  `imagem` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `banner_publicitario`
--

INSERT INTO `banner_publicitario` (`id`, `imagem`, `ativo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'banner-publicitario/April2021/sjFYqcDcQdcyF2P05e6G.jpg', 1, '2021-04-19 17:30:33', '2021-04-21 10:31:04', '2021-04-21 10:31:04'),
(3, 'banner-publicitario/April2021/kDtsIA5ObGH8GhdvDH0y.jpeg', 1, '2021-04-21 10:31:22', '2021-04-21 10:31:22', NULL),
(4, 'banner-publicitario/April2021/NGM1Vgjp7LyO8volZ1JA.jpeg', 1, '2021-04-21 10:31:33', '2021-04-21 10:31:33', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE `configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `produtos` int(11) DEFAULT NULL,
  `familias` int(11) DEFAULT NULL,
  `vendas_mensais` int(11) DEFAULT NULL,
  `dominio_proprio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gestao_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_categorias_transporte` int(11) DEFAULT NULL,
  `n_paises` int(11) DEFAULT NULL,
  `blog` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `plan_free` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `produtos`, `familias`, `vendas_mensais`, `dominio_proprio`, `seo`, `gestao_stock`, `n_categorias_transporte`, `n_paises`, `blog`, `plan`, `plan_end`, `created_at`, `updated_at`, `deleted_at`, `plan_free`) VALUES
(1, 200, 30, 1000, 'Sim', 'Sim', 'Sim', 15, 10, 'Sim', 'Normal', '2021-04-27 15:15:10', NULL, NULL, NULL, 'Sim');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localizacao` geometry DEFAULT NULL,
  `lat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `morada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localization_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `email`, `localizacao`, `lat`, `lng`, `created_at`, `updated_at`, `deleted_at`, `morada`, `codigo_postal`, `localidade`, `numero`, `facebook`, `instagram`, `twitter`, `localization_type`) VALUES
(1, 'online@zie.pt', 0x0000000001010000001f80d4264e8e20c024b4e55c8aa34440, '41.27766', '-8.27794', NULL, '2021-04-19 17:13:36', NULL, NULL, NULL, NULL, '914155651', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Portugal Continental', '2021-04-19 17:05:12', '2021-04-19 17:05:12', NULL),
(4, 'Portugal Açores', '2021-04-19 17:05:27', '2021-04-19 17:05:38', '2021-04-19 17:05:38'),
(5, 'Portugal Açores', '2021-04-19 17:05:32', '2021-04-19 17:05:32', NULL),
(6, 'Portugal Madeira', '2021-04-19 17:05:51', '2021-04-19 17:05:51', NULL),
(7, 'Spain', '2021-04-19 17:06:04', '2021-04-19 17:06:04', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `create_contact_us_table`
--

CREATE TABLE `create_contact_us_table` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacto` varchar(25) DEFAULT NULL,
  `mensagem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9),
(22, 4, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(23, 4, 'email', 'text', 'Email', 0, 1, 1, 1, 1, 1, '{}', 2),
(24, 4, 'localizacao', 'coordinates', 'Localização', 0, 1, 1, 1, 1, 1, '{}', 11),
(25, 4, 'lat', 'hidden', 'Lat', 0, 0, 0, 1, 1, 1, '{}', 12),
(26, 4, 'lng', 'hidden', 'Lng', 0, 0, 0, 1, 1, 1, '{}', 13),
(27, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 14),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 15),
(29, 4, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 16),
(30, 5, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(31, 5, 'imagem', 'media_picker', 'Imagem', 0, 1, 1, 1, 1, 1, '{\"max\":1,\"min\":1,\"expanded\":false,\"show_folders\":true,\"show_toolbar\":true,\"allow_upload\":true,\"allow_move\":true,\"allow_delete\":true,\"allow_create_folder\":true,\"allow_rename\":true,\"allow_crop\":true,\"allowed\":[],\"hide_thumbnails\":false,\"quality\":90}', 3),
(32, 5, 'texto', 'rich_text_box', 'Texto', 0, 1, 1, 1, 1, 1, '{}', 2),
(33, 5, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 4),
(34, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(35, 5, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 6),
(36, 6, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(37, 6, 'titulo', 'text', 'Titulo', 1, 1, 1, 1, 1, 1, '{}', 2),
(38, 6, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 3),
(39, 6, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(40, 6, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 5),
(41, 7, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(42, 7, 'imagem', 'image', 'Imagem', 1, 1, 1, 1, 1, 1, '{}', 2),
(43, 7, 'ativo', 'checkbox', 'Ativo', 0, 1, 1, 1, 1, 1, '{\"on\":\"Sim\",\"off\":\"N\\u00e3o\",\"checked\":\"false\"}', 3),
(44, 7, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 4),
(45, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(46, 7, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 6),
(47, 4, 'morada', 'text', 'Morada', 0, 1, 1, 1, 1, 1, '{}', 7),
(48, 4, 'codigo_postal', 'text', 'Código Postal', 0, 1, 1, 1, 1, 1, '{}', 8),
(49, 4, 'localidade', 'text', 'Localidade', 0, 1, 1, 1, 1, 1, '{}', 9),
(50, 4, 'numero', 'text', 'Número de Telefone', 0, 1, 1, 1, 1, 1, '{}', 3),
(51, 4, 'facebook', 'text', 'Facebook', 0, 1, 1, 1, 1, 1, '{}', 4),
(52, 4, 'instagram', 'text', 'Instagram', 0, 1, 1, 1, 1, 1, '{}', 5),
(53, 4, 'twitter', 'text', 'Twitter', 0, 1, 1, 1, 1, 1, '{}', 6),
(54, 8, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(55, 8, 'name', 'text', 'Nome', 1, 1, 1, 1, 1, 1, '{}', 2),
(56, 8, 'cover_image', 'media_picker', 'Cover Image', 1, 0, 1, 1, 1, 1, '{\"max\":1,\"min\":1,\"expanded\":false,\"show_folders\":true,\"show_toolbar\":true,\"allow_upload\":true,\"allow_move\":true,\"allow_delete\":true,\"allow_create_folder\":true,\"allow_rename\":true,\"allow_crop\":true,\"allowed\":[],\"hide_thumbnails\":false,\"quality\":90}', 7),
(57, 8, 'description', 'text_area', 'Descrição', 1, 0, 1, 1, 1, 1, '{}', 8),
(58, 8, 'xd_id', 'text', 'Xd Id', 0, 0, 1, 1, 1, 1, '{}', 9),
(59, 8, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 11),
(60, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 12),
(61, 8, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 13),
(63, 8, 'general_image', 'media_picker', 'General Image', 1, 0, 1, 1, 1, 1, '{}', 10),
(64, 8, 'familia_id', 'hidden', 'Familia Id', 0, 0, 0, 1, 1, 1, '{}', 16),
(65, 8, 'item_belongsto_familia_relationship', 'relationship', 'Familia', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Familia\",\"table\":\"familias\",\"type\":\"belongsTo\",\"column\":\"familia_id\",\"key\":\"id\",\"label\":\"titulo\",\"pivot_table\":\"banner_publicitario\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(66, 10, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(67, 10, 'name', 'select_dropdown', 'Nome', 1, 1, 1, 1, 1, 1, '{\"default\":\"Portugal Continental\",\"options\":{\"Afghanistan\":\"Afghanistan\",\"\\u00c5land Islands\":\"\\u00c5land Islands\",\"Albania\":\"Albania\",\"Algeria\":\"Algeria\",\"American Samoa\":\"American Samoa\",\"Andorra\":\"Andorra\",\"Angola\":\"Angola\",\"Anguilla\":\"Anguilla\",\"Antarctica\":\"Antarctica\",\"Antigua and Barbuda\":\"Antigua and Barbuda\",\"Argentina\":\"Argentina\",\"Armenia\":\"Armenia\",\"Aruba\":\"Aruba\",\"Australia\":\"Australia\",\"Austria\":\"Austria\",\"Azerbaijan\":\"Azerbaijan\",\"Bahamas\":\"Bahamas\",\"Bahrain\":\"Bahrain\",\"Bangladesh\":\"Bangladesh\",\"Barbados\":\"Barbados\",\"Belarus\":\"Belarus\",\"Belgium\":\"Belgium\",\"Belize\":\"Belize\",\"Benin\":\"Benin\",\"Bermuda\":\"Bermuda\",\"Bhutan\":\"Bhutan\",\"Bolivia, Plurinational State of\":\"Bolivia, Plurinational State of\",\"Bonaire, Sint Eustatius and Saba\":\"Bonaire, Sint Eustatius and Saba\",\"Bosnia and Herzegovina\":\"Bosnia and Herzegovina\",\"Botswana\":\"Botswana\",\"Bouvet Island\":\"Bouvet Island\",\"Brazil\":\"Brazil\",\"British Indian Ocean Territory\":\"British Indian Ocean Territory\",\"Brunei Darussalam\":\"Brunei Darussalam\",\"Bulgaria\":\"Bulgaria\",\"Burkina Faso\":\"Burkina Faso\",\"Burundi\":\"Burundi\",\"Cambodia\":\"Cambodia\",\"Cameroon\":\"Cameroon\",\"Canada\":\"Canada\",\"Cape Verde\":\"Cape Verde\",\"Cayman Islands\":\"Cayman Islands\",\"Central African Republic\":\"Central African Republic\",\"Chad\":\"Chad\",\"Chile\":\"Chile\",\"China\":\"China\",\"Christmas Island\":\"Christmas Island\",\"Cocos (Keeling) Islands\":\"Cocos (Keeling) Islands\",\"Colombia\":\"Colombia\",\"Comoros\":\"Comoros\",\"Congo\":\"Congo\",\"Congo, the Democratic Republic of the\":\"Congo, the Democratic Republic of the\",\"Cook Islands\":\"Cook Islands\",\"Costa Rica\":\"Costa Rica\",\"C\\u00f4te d\'Ivoire\":\"C\\u00f4te d\'Ivoire\",\"Croatia\":\"Croatia\",\"Cuba\":\"Cuba\",\"Cura\\u00e7ao\":\"Cura\\u00e7ao\",\"Cyprus\":\"Cyprus\",\"Czech Republic\":\"Czech Republic\",\"Denmark\":\"Denmark\",\"Djibouti\":\"Djibouti\",\"Dominica\":\"Dominica\",\"Dominican Republic\":\"Dominican Republic\",\"Ecuador\":\"Ecuador\",\"Egypt\":\"Egypt\",\"El Salvador\":\"El Salvador\",\"Equatorial Guinea\":\"Equatorial Guinea\",\"Eritrea\":\"Eritrea\",\"Estonia\":\"Estonia\",\"Ethiopia\":\"Ethiopia\",\"Falkland Islands (Malvinas)\":\"Falkland Islands (Malvinas)\",\"Faroe Islands\":\"Faroe Islands\",\"Fiji\":\"Fiji\",\"Finland\":\"Finland\",\"France\":\"France\",\"French Guiana\":\"French Guiana\",\"French Polynesia\":\"French Polynesia\",\"French Southern Territories\":\"French Southern Territories\",\"Gabon\":\"Gabon\",\"Gambia\":\"Gambia\",\"Georgia\":\"Georgia\",\"Germany\":\"Germany\",\"Ghana\":\"Ghana\",\"Gibraltar\":\"Gibraltar\",\"Greece\":\"Greece\",\"Greenland\":\"Greenland\",\"Grenada\":\"Grenada\",\"Guadeloupe\":\"Guadeloupe\",\"Guam\":\"Guam\",\"Guatemala\":\"Guatemala\",\"Guernsey\":\"Guernsey\",\"Guinea\":\"Guinea\",\"Guinea-Bissau\":\"Guinea-Bissau\",\"Guyana\":\"Guyana\",\"Haiti\":\"Haiti\",\"Heard Island and McDonald Islands\":\"Heard Island and McDonald Islands\",\"Holy See (Vatican City State)\":\"Holy See (Vatican City State)\",\"Honduras\":\"Honduras\",\"Hong Kong\":\"Hong Kong\",\"Hungary\":\"Hungary\",\"Iceland\":\"Iceland\",\"Israel\":\"Israel\",\"Italy\":\"Italy\",\"Jamaica\":\"Jamaica\",\"Japan\":\"Japan\",\"Jersey\":\"Jersey\",\"Jordan\":\"Jordan\",\"Kazakhstan\":\"Kazakhstan\",\"Kenya\":\"Kenya\",\"Kiribati\":\"Kiribati\",\"Korea, Democratic People\'s Republic of\":\"Korea, Democratic People\'s Republic of\",\"Korea, Republic of\":\"Korea, Republic of\",\"Kuwait\":\"Kuwait\",\"Kyrgyzstan\":\"Kyrgyzstan\",\"Lao People\'s Democratic Republic\":\"Lao People\'s Democratic Republic\",\"Latvia\":\"Latvia\",\"Lebanon\":\"Lebanon\",\"Lesotho\":\"Lesotho\",\"Liberia\":\"Liberia\",\"Libya\":\"Libya\",\"Liechtenstein\":\"Liechtenstein\",\"Lithuania\":\"Lithuania\",\"Luxembourg\":\"Luxembourg\",\"Macao\":\"Macao\",\"Macedonia, the former Yugoslav Republic of\":\"Macedonia, the former Yugoslav Republic of\",\"Madagascar\":\"Madagascar\",\"Malawi\":\"Malawi\",\"Malaysia\":\"Malaysia\",\"Maldives\":\"Maldives\",\"Mali\":\"Mali\",\"MMaltaT\":\"Malta\",\"Marshall Islands\":\"Marshall Islands\",\"Martinique\":\"Martinique\",\"Mauritania\":\"Mauritania\",\"Mauritius\":\"Mauritius\",\"Mayotte\":\"Mayotte\",\"Mexico\":\"Mexico\",\"Micronesia, Federated States of\":\"Micronesia, Federated States of\",\"Moldova, Republic of\":\"Moldova, Republic of\",\"Monaco\":\"Monaco\",\"Mongolia\":\"Mongolia\",\"Montenegro\":\"Montenegro\",\"Montserrat\":\"Montserrat\",\"Morocco\":\"Morocco\",\"Mozambique\":\"Mozambique\",\"Myanmar\":\"Myanmar\",\"Namibia\":\"Namibia\",\"Nauru\":\"Nauru\",\"Nepal\":\"Nepal\",\"Netherlands\":\"Netherlands\",\"New Caledonia\":\"New Caledonia\",\"New Zealand\":\"New Zealand\",\"Nicaragua\":\"Nicaragua\",\"Niger\":\"Niger\",\"Nigeria\":\"Nigeria\",\"Niue\":\"Niue\",\"Norfolk Island\":\"Norfolk Island\",\"Northern Mariana Islands\":\"Northern Mariana Islands\",\"Norway\":\"Norway\",\"Oman\":\"Oman\",\"Pakistan\":\"Pakistan\",\"Palau\":\"Palau\",\"Palestinian Territory, Occupied\":\"Palestinian Territory, Occupied\",\"Panama\":\"Panama\",\"Papua New Guinea\":\"Papua New Guinea\",\"Paraguay\":\"Paraguay\",\"Peru\":\"Peru\",\"Philippines\":\"Philippines\",\"Pitcairn\":\"Pitcairn\",\"Poland\":\"Poland\",\"Portugal Continental\":\"Portugal Continental\",\"Portugal A\\u00e7ores\":\"Portugal A\\u00e7ores\",\"Portugal Madeira\":\"Portugal Madeira\",\"Puerto Rico\":\"Puerto Rico\",\"Qatar\":\"Qatar\",\"R\\u00e9union\":\"R\\u00e9union\",\"Romania\":\"Romania\",\"Russian Federation\":\"Russian Federation\",\"Rwanda\":\"Rwanda\",\"Saint Barth\\u00e9lemy\":\"Saint Barth\\u00e9lemy\",\"Saint Helena, Ascension and Tristan da Cunha\":\"Saint Helena, Ascension and Tristan da Cunha\",\"Saint Kitts and Nevis\":\"Saint Kitts and Nevis\",\"Saint Lucia\":\"Saint Lucia\",\"Saint Martin (French part)\":\"Saint Martin (French part)\",\"Saint Pierre and Miquelon\":\"Saint Pierre and Miquelon\",\"Saint Vincent and the Grenadines\":\"Saint Vincent and the Grenadines\",\"Samoa\":\"Samoa\",\"San Marino\":\"San Marino\",\"Sao Tome and Principe\":\"Sao Tome and Principe\",\"Saudi Arabia\":\"Saudi Arabia\",\"Senegal\":\"Senegal\",\"Serbia\":\"Serbia\",\"Seychelles\":\"Seychelles\",\"Sierra Leone\":\"Sierra Leone\",\"Singapore\":\"Singapore\",\"Sint Maarten (Dutch part)\":\"Sint Maarten (Dutch part)\",\"Slovakia\":\"Slovakia\",\"Slovenia\":\"Slovenia\",\"Solomon Islands\":\"Solomon Islands\",\"Somalia\":\"Somalia\",\"South Africa\":\"South Africa\",\"South Georgia and the South Sandwich Islands\":\"South Georgia and the South Sandwich Islands\",\"South Sudan\":\"South Sudan\",\"Spain\":\"Spain\",\"Sri Lanka\":\"Sri Lanka\",\"Sudan\":\"Sudan\",\"Suriname\":\"Suriname\",\"Svalbard and Jan Mayen\":\"Svalbard and Jan Mayen\",\"Swaziland\":\"Swaziland\",\"Sweden\":\"Sweden\",\"Switzerland\":\"Switzerland\",\"Syrian Arab Republic\":\"Syrian Arab Republic\",\"Taiwan, Province of China\":\"Taiwan, Province of China\",\"Tajikistan\":\"Tajikistan\",\"Tanzania, United Republic of\":\"Tanzania, United Republic of\",\"Thailand\":\"Thailand\",\"Timor-Leste\":\"Timor-Leste\",\"Togo\":\"Togo\",\"Tokelau\":\"Tokelau\",\"Tonga\":\"Tonga\",\"Trinidad and Tobago\":\"Trinidad and Tobago\",\"Tunisia\":\"Tunisia\",\"Turkey\":\"Turkey\",\"Turkmenistan\":\"Turkmenistan\",\"Turks and Caicos Islands\":\"Turks and Caicos Islands\",\"Tuvalu\":\"Tuvalu\",\"Uganda\":\"Uganda\",\"Ukraine\":\"Ukraine\",\"United Arab Emirates\":\"United Arab Emirates\",\"United Kingdom\":\"United Kingdom\",\"United States\":\"United States\",\"United States Minor Outlying Islands\":\"United States Minor Outlying Islands\",\"Uruguay\":\"Uruguay\",\"Uzbekistan\":\"Uzbekistan\",\"Vanuatu\":\"Vanuatu\",\"Venezuela, Bolivarian Republic of\":\"Venezuela, Bolivarian Republic of\",\"Viet Nam\":\"Viet Nam\",\"Virgin Islands, British\":\"Virgin Islands, British\",\"Virgin Islands, U.S.\":\"Virgin Islands, U.S.\",\"Wallis and Futuna\":\"Wallis and Futuna\",\"Western Sahara\":\"Western Sahara\",\"Yemen\":\"Yemen\",\"Zambia\":\"Zambia\",\"Zimbabwe\":\"Zimbabwe\"}}', 2),
(68, 10, 'created_at', 'timestamp', 'Criado a', 0, 1, 1, 1, 0, 1, '{}', 3),
(69, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(70, 10, 'deleted_at', 'timestamp', 'Apagado a', 0, 1, 1, 0, 0, 0, '{}', 5),
(71, 11, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(72, 11, 'country_id', 'hidden', 'Country Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(74, 11, 'created_at', 'timestamp', 'Criado a', 0, 1, 1, 0, 0, 0, '{}', 7),
(75, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(76, 11, 'deleted_at', 'timestamp', 'Apagado a', 0, 1, 1, 0, 0, 0, '{}', 9),
(77, 11, 'price', 'number', 'Custo', 1, 1, 1, 1, 1, 1, '{}', 6),
(79, 11, 'transport_cost_belongsto_country_relationship', 'relationship', 'País', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Country\",\"table\":\"countries\",\"type\":\"belongsTo\",\"column\":\"country_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banner_publicitario\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(80, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(81, 12, 'desc', 'text', 'Descrição', 1, 1, 1, 1, 1, 1, '{}', 3),
(82, 12, 'created_at', 'timestamp', 'Criada a', 0, 1, 1, 1, 0, 1, '{}', 4),
(83, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(84, 12, 'deleted_at', 'timestamp', 'Apagada a', 0, 1, 1, 0, 0, 0, '{}', 6),
(86, 11, 'transport_cost_belongsto_transport_category_relationship', 'relationship', 'Categoria', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\TransportCategory\",\"table\":\"transport_categories\",\"type\":\"belongsTo\",\"column\":\"transport_categories\",\"key\":\"id\",\"label\":\"desc\",\"pivot_table\":\"banner_publicitario\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(87, 11, 'transport_categories', 'hidden', 'Transport Categories', 1, 1, 1, 1, 1, 1, '{}', 4),
(88, 12, 'order', 'hidden', 'Order', 0, 0, 0, 1, 1, 1, '{}', 2),
(89, 8, 'transport_category_id', 'hidden', 'Transport Category Id', 0, 0, 0, 1, 1, 1, '{}', 15),
(90, 8, 'item_belongsto_transport_category_relationship', 'relationship', 'Categoria de Transporte', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\TransportCategory\",\"table\":\"transport_categories\",\"type\":\"belongsTo\",\"column\":\"transport_category_id\",\"key\":\"id\",\"label\":\"desc\",\"pivot_table\":\"banner_publicitario\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4),
(91, 8, 'pvp', 'select_dropdown', 'PVP', 0, 0, 1, 1, 1, 1, '{\"options\":{\"Price1\":\"PVP1\",\"Price2\":\"PVP2\",\"Price3\":\"PVP3\",\"Price4\":\"PVP4\",\"Price5\":\"PVP5\"}}', 6),
(92, 8, 'image_type', 'text', 'Image Type', 0, 0, 0, 1, 1, 1, '{}', 14),
(93, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(94, 13, 'number', 'number', 'Número', 1, 1, 1, 1, 1, 1, '{}', 3),
(95, 13, 'country', 'select_dropdown', 'País', 1, 1, 1, 1, 1, 1, '{\"default\":\"PT\",\"options\":{\"AF\":\"Afghanistan\",\"AX\":\"\\u00c5land Islands\",\"AL\":\"Albania\",\"DZ\":\"Algeria\",\"AS\":\"American Samoa\",\"AD\":\"Andorra\",\"AO\":\"Angola\",\"AI\":\"Anguilla\",\"AQ\":\"Antarctica\",\"AG\":\"Antigua and Barbuda\",\"AR\":\"Argentina\",\"AM\":\"Armenia\",\"AW\":\"Aruba\",\"AU\":\"Australia\",\"AT\":\"Austria\",\"AZ\":\"Azerbaijan\",\"BS\":\"Bahamas\",\"BH\":\"Bahrain\",\"BD\":\"Bangladesh\",\"BB\":\"Barbados\",\"BY\":\"Belarus\",\"BE\":\"Belgium\",\"BZ\":\"Belize\",\"BJ\":\"Benin\",\"BM\":\"Bermuda\",\"BT\":\"Bhutan\",\"BO\":\"Bolivia, Plurinational State of\",\"BQ\":\"Bonaire, Sint Eustatius and Saba\",\"BA\":\"Bosnia and Herzegovina\",\"BW\":\"Botswana\",\"BV\":\"Bouvet Island\",\"BR\":\"Brazil\",\"IO\":\"British Indian Ocean Territory\",\"BN\":\"Brunei Darussalam\",\"BG\":\"Bulgaria\",\"BF\":\"Burkina Faso\",\"BI\":\"Burundi\",\"KH\":\"Cambodia\",\"CM\":\"Cameroon\",\"CA\":\"Canada\",\"CV\":\"Cape Verde\",\"KY\":\"Cayman Islands\",\"CF\":\"Central African Republic\",\"TD\":\"Chad\",\"CL\":\"Chile\",\"CN\":\"China\",\"CX\":\"Christmas Island\",\"CC\":\"Cocos (Keeling) Islands\",\"CO\":\"Colombia\",\"KM\":\"Comoros\",\"CG\":\"Congo\",\"CD\":\"Congo, the Democratic Republic of the\",\"CK\":\"Cook Islands\",\"CR\":\"Costa Rica\",\"CI\":\"C\\u00f4te d\'Ivoire\",\"HR\":\"Croatia\",\"CU\":\"Cuba\",\"CW\":\"Cura\\u00e7ao\",\"CY\":\"Cyprus\",\"CZ\":\"Czech Republic\",\"DK\":\"Denmark\",\"DJ\":\"Djibouti\",\"DM\":\"Dominica\",\"DO\":\"Dominican Republic\",\"EC\":\"Ecuador\",\"EG\":\"Egypt\",\"SV\":\"El Salvador\",\"GQ\":\"Equatorial Guinea\",\"ER\":\"Eritrea\",\"EE\":\"Estonia\",\"ET\":\"Ethiopia\",\"FK\":\"Falkland Islands (Malvinas)\",\"FO\":\"Faroe Islands\",\"FJ\":\"Fiji\",\"FI\":\"Finland\",\"FR\":\"France\",\"GF\":\"French Guiana\",\"PF\":\"French Polynesia\",\"TF\":\"French Southern Territories\",\"GA\":\"Gabon\",\"GM\":\"Gambia\",\"GE\":\"Georgia\",\"DE\":\"Germany\",\"GH\":\"Ghana\",\"GI\":\"Gibraltar\",\"GR\":\"Greece\",\"GL\":\"Greenland\",\"GD\":\"Grenada\",\"GP\":\"Guadeloupe\",\"GU\":\"Guam\",\"GT\":\"Guatemala\",\"GG\":\"Guernsey\",\"GN\":\"Guinea\",\"GW\":\"Guinea-Bissau\",\"GY\":\"Guyana\",\"HT\":\"Haiti\",\"HM\":\"Heard Island and McDonald Islands\",\"VA\":\"Holy See (Vatican City State)\",\"HN\":\"Honduras\",\"HK\":\"Hong Kong\",\"HU\":\"Hungary\",\"IS\":\"Iceland\",\"IL\":\"Israel\",\"IT\":\"Italy\",\"JM\":\"Jamaica\",\"JP\":\"Japan\",\"JE\":\"Jersey\",\"JO\":\"Jordan\",\"KZ\":\"Kazakhstan\",\"KE\":\"Kenya\",\"KI\":\"Kiribati\",\"KP\":\"Korea, Democratic People\'s Republic of\",\"KR\":\"Korea, Republic of\",\"KW\":\"Kuwait\",\"KG\":\"Kyrgyzstan\",\"LA\":\"Lao People\'s Democratic Republic\",\"LV\":\"Latvia\",\"LB\":\"Lebanon\",\"LS\":\"Lesotho\",\"LR\":\"Liberia\",\"LY\":\"Libya\",\"LI\":\"Liechtenstein\",\"LT\":\"Lithuania\",\"LU\":\"Luxembourg\",\"MO\":\"Macao\",\"MK\":\"Macedonia, the former Yugoslav Republic of\",\"MG\":\"Madagascar\",\"MW\":\"Malawi\",\"MY\":\"Malaysia\",\"MV\":\"Maldives\",\"ML\":\"Mali\",\"MT\":\"Malta\",\"MH\":\"Marshall Islands\",\"MQ\":\"Martinique\",\"MR\":\"Mauritania\",\"MU\":\"Mauritius\",\"YT\":\"Mayotte\",\"MX\":\"Mexico\",\"FM\":\"Micronesia, Federated States of\",\"MD\":\"Moldova, Republic of\",\"MC\":\"Monaco\",\"MN\":\"Mongolia\",\"ME\":\"Montenegro\",\"MS\":\"Montserrat\",\"MA\":\"Morocco\",\"MZ\":\"Mozambique\",\"MM\":\"Myanmar\",\"NA\":\"Namibia\",\"NR\":\"Nauru\",\"NP\":\"Nepal\",\"NL\":\"Netherlands\",\"NC\":\"New Caledonia\",\"NZ\":\"New Zealand\",\"NI\":\"Nicaragua\",\"NE\":\"Niger\",\"NG\":\"Nigeria\",\"NU\":\"Niue\",\"NF\":\"Norfolk Island\",\"MP\":\"Northern Mariana Islands\",\"NO\":\"Norway\",\"OM\":\"Oman\",\"PK\":\"Pakistan\",\"PW\":\"Palau\",\"PS\":\"Palestinian Territory, Occupied\",\"PA\":\"Panama\",\"PG\":\"Papua New Guinea\",\"PY\":\"Paraguay\",\"PE\":\"Peru\",\"PH\":\"Philippines\",\"PN\":\"Pitcairn\",\"PL\":\"Poland\",\"PT\":\"Portugal\",\"PR\":\"Puerto Rico\",\"QA\":\"Qatar\",\"RE\":\"R\\u00e9union\",\"RO\":\"Romania\",\"RU\":\"Russian Federation\",\"RW\":\"Rwanda\",\"BL\":\"Saint Barth\\u00e9lemy\",\"SH\":\"Saint Helena, Ascension and Tristan da Cunha\",\"KN\":\"Saint Kitts and Nevis\",\"LC\":\"Saint Lucia\",\"MF\":\"Saint Martin (French part)\",\"PM\":\"Saint Pierre and Miquelon\",\"VC\":\"Saint Vincent and the Grenadines\",\"WS\":\"Samoa\",\"SM\":\"San Marino\",\"ST\":\"Sao Tome and Principe\",\"SA\":\"Saudi Arabia\",\"SN\":\"Senegal\",\"RS\":\"Serbia\",\"SC\":\"Seychelles\",\"SL\":\"Sierra Leone\",\"SG\":\"Singapore\",\"SX\":\"Sint Maarten (Dutch part)\",\"SK\":\"Slovakia\",\"SI\":\"Slovenia\",\"SB\":\"Solomon Islands\",\"SO\":\"Somalia\",\"ZA\":\"South Africa\",\"GS\":\"South Georgia and the South Sandwich Islands\",\"SS\":\"South Sudan\",\"ES\":\"Spain\",\"LK\":\"Sri Lanka\",\"SD\":\"Sudan\",\"SR\":\"Suriname\",\"SJ\":\"Svalbard and Jan Mayen\",\"SZ\":\"Swaziland\",\"SE\":\"Sweden\",\"CH\":\"Switzerland\",\"SY\":\"Syrian Arab Republic\",\"TW\":\"Taiwan, Province of China\",\"TJ\":\"Tajikistan\",\"TZ\":\"Tanzania, United Republic of\",\"TH\":\"Thailand\",\"TL\":\"Timor-Leste\",\"TG\":\"Togo\",\"TK\":\"Tokelau\",\"TO\":\"Tonga\",\"TT\":\"Trinidad and Tobago\",\"TN\":\"Tunisia\",\"TR\":\"Turkey\",\"TM\":\"Turkmenistan\",\"TC\":\"Turks and Caicos Islands\",\"TV\":\"Tuvalu\",\"UG\":\"Uganda\",\"UA\":\"Ukraine\",\"AE\":\"United Arab Emirates\",\"GB\":\"United Kingdom\",\"US\":\"United States\",\"UM\":\"United States Minor Outlying Islands\",\"UY\":\"Uruguay\",\"UZ\":\"Uzbekistan\",\"VU\":\"Vanuatu\",\"VE\":\"Venezuela, Bolivarian Republic of\",\"VN\":\"Viet Nam\",\"VG\":\"Virgin Islands, British\",\"VI\":\"Virgin Islands, U.S.\",\"WF\":\"Wallis and Futuna\",\"EH\":\"Western Sahara\",\"YE\":\"Yemen\",\"ZM\":\"Zambia\",\"ZW\":\"Zimbabwe\"}}', 6),
(96, 13, 'locality', 'text', 'Localidade', 1, 1, 1, 1, 1, 1, '{}', 7),
(97, 13, 'zip_code', 'text', 'Código Postal', 1, 1, 1, 1, 1, 1, '{}', 8),
(98, 13, 'street', 'text', 'Rua', 1, 1, 1, 1, 1, 1, '{}', 9),
(99, 13, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 10),
(100, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 11),
(101, 13, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 13),
(103, 14, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(104, 14, 'items_id', 'text', 'Items Id', 0, 0, 0, 1, 1, 1, '{}', 2),
(105, 14, 'value', 'text', 'Valor', 0, 1, 1, 1, 1, 1, '{}', 3),
(106, 14, 'percentage', 'text', 'Percentagem', 0, 1, 1, 1, 1, 1, '{}', 4),
(107, 14, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 5),
(108, 14, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(109, 14, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 7),
(110, 14, 'promotion_belongsto_item_relationship', 'relationship', 'Item', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Item\",\"table\":\"items\",\"type\":\"belongsTo\",\"column\":\"items_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"adresses_users\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(111, 14, 'values', 'text', 'Values', 1, 0, 0, 1, 1, 1, '{}', 3),
(112, 14, 'value_origin', 'text', 'Value Origin', 1, 0, 0, 1, 1, 1, '{}', 6),
(113, 14, 'attr_name', 'text', 'Attr Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(114, 13, 'user_id', 'text', 'User Id', 0, 0, 0, 1, 1, 1, '{}', 4),
(115, 13, 'is_active', 'checkbox', 'Ativo', 0, 1, 1, 1, 1, 1, '{\"on\":\"Sim\",\"off\":\"N\\u00e3o\",\"checked\":true}', 12),
(116, 13, 'is_main', 'checkbox', 'Principal', 0, 1, 1, 1, 1, 1, '{\"on\":\"Sim\",\"off\":\"N\\u00e3o\",\"checked\":false}', 14),
(117, 13, 'adresses_user_belongsto_user_relationship', 'relationship', 'Utilizador', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"adresses_users\",\"pivot\":\"0\",\"taggable\":\"0\"}', 2),
(118, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(119, 15, 'items_id', 'text', 'Artigo', 0, 0, 0, 0, 0, 0, '{}', 3),
(120, 15, 'stock', 'number', 'Stock', 1, 1, 1, 1, 1, 1, '{}', 4),
(121, 15, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 5),
(122, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(123, 15, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 7),
(124, 15, 'stock_belongsto_item_relationship', 'relationship', 'Artigo', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Item\",\"table\":\"items\",\"type\":\"belongsTo\",\"column\":\"items_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"adresses_users\",\"pivot\":\"0\",\"taggable\":\"0\"}', 2),
(125, 15, 'attr_ids', 'text', 'Atributos', 0, 1, 1, 1, 1, 1, '{}', 3),
(126, 15, 'type', 'select_dropdown', 'Tipo', 0, 1, 1, 1, 1, 1, '{\"options\":{\"entrada\":\"Entrada de Stock\",\"saida\":\"Sa\\u00edda de Stock\"}}', 8),
(127, 8, 'price', 'hidden', 'Preço', 0, 1, 1, 1, 1, 1, '{}', 5),
(128, 16, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(129, 16, 'user_id', 'hidden', 'User Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(130, 16, 'address_user_id', 'text', 'Endereço do Utilizador', 0, 1, 1, 1, 1, 1, '{}', 4),
(131, 16, 'content', 'text', 'Conteúdo', 0, 1, 1, 1, 1, 1, '{}', 5),
(132, 16, 'n_order', 'text', 'Numero da Encomenda', 0, 1, 1, 1, 1, 1, '{}', 6),
(133, 16, 'total', 'text', 'Total', 0, 1, 1, 1, 1, 1, '{}', 7),
(134, 16, 'type_payment', 'text', 'Tipo de Pagamento', 0, 1, 1, 1, 1, 1, '{}', 8),
(135, 16, 'created_at', 'timestamp', 'Criado a', 0, 1, 1, 0, 0, 0, '{}', 10),
(136, 16, 'updated_at', 'timestamp', 'Atualizado a', 0, 0, 1, 0, 0, 0, '{}', 11),
(137, 16, 'deleted_at', 'timestamp', 'Eliminado a', 0, 0, 1, 0, 0, 0, '{}', 13),
(138, 16, 'order_belongsto_user_relationship', 'relationship', 'Utilizador', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"adresses_users\",\"pivot\":\"0\",\"taggable\":\"0\"}', 2),
(140, 4, 'localization_type', 'checkbox', 'Aparecer mapa?', 0, 1, 1, 1, 1, 1, '{\"on\":\"Sim\",\"off\":\"N\\u00e3o\",\"checked\":\"false\"}', 10),
(141, 16, 'order_belongsto_state_relationship', 'relationship', 'Estado', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\State\",\"table\":\"state\",\"type\":\"belongsTo\",\"column\":\"order_state\",\"key\":\"id\",\"label\":\"state\",\"pivot_table\":\"adresses_users\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(142, 16, 'order_state', 'text', 'Order State', 0, 1, 1, 1, 1, 1, '{}', 12),
(143, 16, 'paypal_transaction_id', 'text', 'Paypal Transaction Id', 0, 0, 0, 1, 1, 1, '{}', 12),
(144, 16, 'paypal_payment_ack', 'text', 'Paypal Payment Ack', 0, 0, 0, 1, 1, 1, '{}', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', '', 1, 0, NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, '', '', 1, 0, NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(4, 'contactos', 'contactos', 'Contacto', 'Contactos', 'voyager-telephone', 'App\\Contacto', NULL, 'App\\Http\\Controllers\\ContactosController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-09-25 11:17:33', '2020-05-02 09:22:43'),
(5, 'sobres', 'sobres', 'Sobre', 'Sobres', 'voyager-file-text', 'App\\Sobre', NULL, 'App\\Http\\Controllers\\SobreController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-09-25 11:18:21', '2020-05-04 16:32:47'),
(6, 'familias', 'familias', 'Familia de Artigos', 'Familias de Artigos', 'voyager-categories', 'App\\Familia', NULL, 'App\\Http\\Controllers\\FamiliasController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-09-26 10:33:07', '2020-06-04 15:26:35'),
(7, 'banner_publicitario', 'banner-publicitario', 'Banner Publicitário', 'Banners Publicitários', 'voyager-images', 'App\\BannerPublicitario', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-09-26 11:12:54', '2020-04-21 07:49:10'),
(8, 'items', 'items', 'Artigo', 'Artigos', 'voyager-bread', 'App\\Item', NULL, 'App\\Http\\Controllers\\ItemsController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":\"currentActiveItems\"}', '2019-09-30 10:49:49', '2020-05-11 15:16:57'),
(9, 'countrys', 'countrys', 'PaÃƒÂ­s', 'PaÃƒÂ­ses', 'fa fa-2x fa-flag', 'App\\Country', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2019-10-14 07:16:09', '2019-10-14 07:16:09'),
(10, 'countries', 'countries', 'País de Entrega', 'Países de Entrega', 'fa fa-flag', 'App\\Country', NULL, 'App\\Http\\Controllers\\CountriesController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-10-14 07:22:26', '2020-06-04 15:37:09'),
(11, 'transport_costs', 'transport-costs', 'Custo de Transporte', 'Custos de Transporte', 'fa fa-book', 'App\\TransportCost', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-10-14 07:33:22', '2020-05-07 16:20:10'),
(12, 'transport_categories', 'transport-categories', 'Categoria de Transporte', 'Categorias de Transporte', 'fa fa-book', 'App\\TransportCategory', NULL, 'App\\Http\\Controllers\\TransportCategoriesController', NULL, 1, 0, '{\"order_column\":\"order\",\"order_display_column\":\"desc\",\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-10-14 08:30:23', '2020-06-04 15:35:42'),
(13, 'adresses_users', 'adresses-users', 'Endereço de Cliente', 'Endereços de Clientes', 'voyager-location', 'App\\AdressesUser', NULL, 'App\\Http\\Controllers\\AdressUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-10-17 14:26:23', '2020-04-21 07:48:54'),
(14, 'promotions', 'promotions', 'Promoção', 'Promoções', 'voyager-star-two', 'App\\Promotion', NULL, 'App\\Http\\Controllers\\PromotionsController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2019-10-19 08:27:13', '2020-04-21 07:46:47'),
(15, 'stocks', 'stocks', 'Stock', 'Stocks', 'voyager-archive', 'App\\Stock', NULL, 'App\\Http\\Controllers\\StockController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":\"currentUser\"}', '2019-10-29 14:32:18', '2019-11-13 13:46:20'),
(16, 'orders', 'orders', 'Encomenda', 'Encomendas', 'voyager-data', 'App\\Order', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-01-20 11:50:02', '2020-04-21 07:46:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`id`, `titulo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'NIKE', '2021-04-15 15:20:26', '2021-04-15 15:29:48', '2021-04-15 15:29:48'),
(5, 'ADIDAS', '2021-04-15 15:32:58', '2021-04-19 17:08:29', NULL),
(6, 'NIKE', '2021-04-19 17:08:18', '2021-04-19 17:08:18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xd_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `general_image` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]',
  `familia_id` int(11) DEFAULT NULL,
  `transport_category_id` int(11) DEFAULT NULL,
  `pvp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `name`, `cover_image`, `description`, `xd_id`, `created_at`, `updated_at`, `deleted_at`, `general_image`, `familia_id`, `transport_category_id`, `pvp`, `image_type`, `price`) VALUES
(16, 'Nike Air', 'items/3e20d171-99cf-46f1-a72d-b03a06f73586.jpg', 'Nike Air', NULL, '2021-04-19 17:10:45', '2021-04-23 16:47:36', NULL, '[\"items/a1f2c7ed-e1c8-4769-829a-535ba36ad6b5.jpg\"]', 6, 5, NULL, 'general', 35),
(17, 'Addidas Falcon', 'items/7d39ee87-4a77-46b9-95c8-fde59032b861.jpg', 'Adidas Falcon', NULL, '2021-04-19 17:12:07', '2021-04-23 16:47:05', NULL, '[\"items/506d6e8a-75e1-4717-b963-d1f1a9e8f001.jpg\"]', 5, 5, NULL, 'general', 40),
(18, 'Nike Jordan', 'items/a86a2b66-90d3-470a-95d2-2d172b8adabf.jpg', 'Nike Jordan', NULL, '2021-04-20 14:37:25', '2021-04-23 16:46:50', NULL, '[\"items/a86a2b66-90d3-470a-95d2-2d172b8adabf.jpg\"]', 6, 5, NULL, 'general', 40),
(19, 'Nike Jordan Low', 'items/a2d54d06-e650-496d-ab7f-1a6305bee74d.jpg', 'Nike Jordan Low', NULL, '2021-04-20 14:41:33', '2021-04-23 16:49:55', NULL, '', 6, 5, NULL, 'attr', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_attr_images`
--

CREATE TABLE `items_attr_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `items_id` int(11) DEFAULT NULL,
  `attr_id` int(11) DEFAULT NULL,
  `id_attr` int(11) DEFAULT NULL,
  `name_attr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images_attr` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attr_id_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locked`
--

CREATE TABLE `locked` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mail_queue`
--

CREATE TABLE `mail_queue` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `var` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mail_queue`
--

INSERT INTO `mail_queue` (`id`, `email`, `subject`, `var`, `view`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 'developer@napp.pt', 'Pagamento da Encomenda em ', '{\"name\":\"Teste2\",\"message\":\"Pagamento Concluido\"}', 'email.cc', 'pending', '2021-04-23 11:02:42', '2021-04-23 11:02:42', NULL),
(24, 'developer@napp.pt', 'Encomenda em ', '{\"name\":\"Teste2\",\"message\":\"A sua Encomenda foi enviada, ir\\u00e1 receb\\u00ea-la em breve.\"}', 'email.cc', 'pending', '2021-04-23 11:02:57', '2021-04-23 11:02:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-09-21 07:13:31', '2019-09-21 07:13:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Painel de Controlo', '', '_self', 'voyager-boat', '#000000', NULL, 2, '2019-09-21 07:13:31', '2019-09-21 07:17:35', 'voyager.dashboard', 'null'),
(2, 1, 'Gestor de Ficheiros', '', '_self', 'voyager-images', '#000000', NULL, 7, '2019-09-21 07:13:31', '2020-01-20 12:28:19', 'voyager.media.index', 'null'),
(3, 1, 'Utilizadores', '', '_self', 'voyager-person', '#76d6ff', NULL, 4, '2019-09-21 07:13:31', '2019-10-14 10:19:03', 'voyager.users.index', 'null'),
(4, 1, 'Permissões', '', '_self', 'voyager-lock', '#000000', NULL, 3, '2019-09-21 07:13:31', '2020-04-20 07:34:46', 'voyager.roles.index', 'null'),
(5, 1, 'Administração', '', '_self', 'voyager-tools', '#000000', NULL, 1, '2019-09-21 07:13:31', '2020-04-20 07:34:24', NULL, ''),
(6, 1, 'Construtor de Menus', '', '_self', 'voyager-list', '#000000', 5, 1, '2019-09-21 07:13:31', '2019-09-21 07:17:19', 'voyager.menus.index', 'null'),
(7, 1, 'Base de Dados', '', '_self', 'voyager-data', '#000000', 5, 2, '2019-09-21 07:13:31', '2019-09-21 07:17:29', 'voyager.database.index', 'null'),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2019-09-21 07:13:31', '2019-09-21 07:17:08', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2019-09-21 07:13:31', '2019-09-21 07:17:08', 'voyager.bread.index', NULL),
(10, 1, 'Definições', '', '_self', 'voyager-settings', '#000000', 5, 6, '2019-09-21 07:13:31', '2020-04-20 07:34:37', 'voyager.settings.index', 'null'),
(11, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2019-09-21 07:13:31', '2019-09-21 07:17:08', 'voyager.hooks', NULL),
(12, 1, 'Contactos', '', '_self', 'voyager-telephone', NULL, NULL, 13, '2019-09-25 11:17:33', '2020-01-20 12:28:19', 'voyager.contactos.index', NULL),
(13, 1, 'Sobre', '', '_self', 'voyager-file-text', '#000000', NULL, 12, '2019-09-25 11:18:21', '2020-01-20 12:28:19', 'voyager.sobres.index', 'null'),
(14, 1, 'Familias', '', '_self', 'voyager-categories', NULL, NULL, 9, '2019-09-26 10:33:08', '2020-01-20 12:28:19', 'voyager.familias.index', NULL),
(15, 1, 'Banners Publicitários', '', '_self', 'voyager-images', '#000000', NULL, 8, '2019-09-26 11:12:54', '2020-04-20 07:35:13', 'voyager.banner-publicitario.index', 'null'),
(16, 1, 'Artigos', '', '_self', 'voyager-bread', '#000000', NULL, 10, '2019-09-30 10:49:49', '2020-01-20 12:28:19', 'voyager.items.index', 'null'),
(18, 1, 'Países', '', '_self', 'fa fa-flag', '#000000', NULL, 14, '2019-10-14 07:22:26', '2020-04-20 07:35:23', 'voyager.countries.index', 'null'),
(19, 1, 'Custos', '', '_self', 'fa fa-book', '#000000', 21, 2, '2019-10-14 07:33:23', '2019-10-14 10:20:41', 'voyager.transport-costs.index', 'null'),
(20, 1, 'Categorias', '', '_self', 'fa fa-book', '#000000', 21, 1, '2019-10-14 08:30:23', '2019-10-14 10:20:05', 'voyager.transport-categories.index', 'null'),
(21, 1, 'Def. Transportes', '', '_self', 'voyager-truck', '#22ff00', NULL, 15, '2019-10-14 10:17:33', '2020-01-20 12:28:19', NULL, ''),
(22, 1, 'Endereços dos Clientes', '', '_self', 'voyager-location', '#000000', NULL, 6, '2019-10-17 14:26:23', '2020-04-20 07:34:58', 'voyager.adresses-users.index', 'null'),
(24, 1, 'Stocks', '', '_self', 'voyager-archive', NULL, NULL, 16, '2019-10-29 14:32:19', '2020-01-20 12:28:19', 'voyager.stocks.index', NULL),
(25, 1, 'Encomendas', '', '_self', 'voyager-data', NULL, NULL, 5, '2020-01-20 11:50:02', '2020-01-20 12:28:19', 'voyager.orders.index', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2018_10_06_100234_create_media_manager_lock_list_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_user_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_order` int(11) DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `order_state` int(11) DEFAULT NULL,
  `paypal_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_payment_ack` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_user_id`, `content`, `n_order`, `total`, `type_payment`, `created_at`, `updated_at`, `deleted_at`, `order_state`, `paypal_transaction_id`, `paypal_payment_ack`) VALUES
(331, 10, 44, '[{\"attributeImageKey\":\"\",\"attributeImageValue\":\"\",\"attributePriceKey\":\"\",\"attributePriceValue\":\"\",\"quantity\":4,\"label\":\"Nike Air\",\"id\":\"16--\",\"image\":\"https://zie.pt/storage/items/a1f2c7ed-e1c8-4769-829a-535ba36ad6b5.jpg\",\"price\":35}]', 837955090, '140', 'zero', '2021-04-23 11:00:41', '2021-04-23 11:02:57', NULL, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_state`
--

CREATE TABLE `order_state` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_state`
--

INSERT INTO `order_state` (`id`, `order_id`, `state_id`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(160, 331, 1, 1, '2021-04-23 11:00:41', '2021-04-23 11:00:41', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(2, 'browse_bread', NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(3, 'browse_database', NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(4, 'browse_media', NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(5, 'browse_compass', NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(6, 'browse_menus', 'menus', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(7, 'read_menus', 'menus', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(8, 'edit_menus', 'menus', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(9, 'add_menus', 'menus', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(10, 'delete_menus', 'menus', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(11, 'browse_roles', 'roles', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(12, 'read_roles', 'roles', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(13, 'edit_roles', 'roles', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(14, 'add_roles', 'roles', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(15, 'delete_roles', 'roles', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(16, 'browse_users', 'users', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(17, 'read_users', 'users', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(18, 'edit_users', 'users', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(19, 'add_users', 'users', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(20, 'delete_users', 'users', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(21, 'browse_settings', 'settings', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(22, 'read_settings', 'settings', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(23, 'edit_settings', 'settings', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(24, 'add_settings', 'settings', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(25, 'delete_settings', 'settings', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(26, 'browse_hooks', NULL, '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(27, 'browse_contactos', 'contactos', '2019-09-25 11:17:33', '2019-09-25 11:17:33'),
(28, 'read_contactos', 'contactos', '2019-09-25 11:17:33', '2019-09-25 11:17:33'),
(29, 'edit_contactos', 'contactos', '2019-09-25 11:17:33', '2019-09-25 11:17:33'),
(30, 'add_contactos', 'contactos', '2019-09-25 11:17:33', '2019-09-25 11:17:33'),
(31, 'delete_contactos', 'contactos', '2019-09-25 11:17:33', '2019-09-25 11:17:33'),
(32, 'browse_sobres', 'sobres', '2019-09-25 11:18:21', '2019-09-25 11:18:21'),
(33, 'read_sobres', 'sobres', '2019-09-25 11:18:21', '2019-09-25 11:18:21'),
(34, 'edit_sobres', 'sobres', '2019-09-25 11:18:21', '2019-09-25 11:18:21'),
(35, 'add_sobres', 'sobres', '2019-09-25 11:18:21', '2019-09-25 11:18:21'),
(36, 'delete_sobres', 'sobres', '2019-09-25 11:18:21', '2019-09-25 11:18:21'),
(37, 'browse_familias', 'familias', '2019-09-26 10:33:07', '2019-09-26 10:33:07'),
(38, 'read_familias', 'familias', '2019-09-26 10:33:07', '2019-09-26 10:33:07'),
(39, 'edit_familias', 'familias', '2019-09-26 10:33:07', '2019-09-26 10:33:07'),
(40, 'add_familias', 'familias', '2019-09-26 10:33:07', '2019-09-26 10:33:07'),
(41, 'delete_familias', 'familias', '2019-09-26 10:33:07', '2019-09-26 10:33:07'),
(42, 'browse_banner_publicitario', 'banner_publicitario', '2019-09-26 11:12:54', '2019-09-26 11:12:54'),
(43, 'read_banner_publicitario', 'banner_publicitario', '2019-09-26 11:12:54', '2019-09-26 11:12:54'),
(44, 'edit_banner_publicitario', 'banner_publicitario', '2019-09-26 11:12:54', '2019-09-26 11:12:54'),
(45, 'add_banner_publicitario', 'banner_publicitario', '2019-09-26 11:12:54', '2019-09-26 11:12:54'),
(46, 'delete_banner_publicitario', 'banner_publicitario', '2019-09-26 11:12:54', '2019-09-26 11:12:54'),
(47, 'browse_items', 'items', '2019-09-30 10:49:49', '2019-09-30 10:49:49'),
(48, 'read_items', 'items', '2019-09-30 10:49:49', '2019-09-30 10:49:49'),
(49, 'edit_items', 'items', '2019-09-30 10:49:49', '2019-09-30 10:49:49'),
(50, 'add_items', 'items', '2019-09-30 10:49:49', '2019-09-30 10:49:49'),
(51, 'delete_items', 'items', '2019-09-30 10:49:49', '2019-09-30 10:49:49'),
(52, 'browse_countrys', 'countrys', '2019-10-14 07:16:09', '2019-10-14 07:16:09'),
(53, 'read_countrys', 'countrys', '2019-10-14 07:16:09', '2019-10-14 07:16:09'),
(54, 'edit_countrys', 'countrys', '2019-10-14 07:16:09', '2019-10-14 07:16:09'),
(55, 'add_countrys', 'countrys', '2019-10-14 07:16:09', '2019-10-14 07:16:09'),
(56, 'delete_countrys', 'countrys', '2019-10-14 07:16:09', '2019-10-14 07:16:09'),
(57, 'browse_countries', 'countries', '2019-10-14 07:22:26', '2019-10-14 07:22:26'),
(58, 'read_countries', 'countries', '2019-10-14 07:22:26', '2019-10-14 07:22:26'),
(59, 'edit_countries', 'countries', '2019-10-14 07:22:26', '2019-10-14 07:22:26'),
(60, 'add_countries', 'countries', '2019-10-14 07:22:26', '2019-10-14 07:22:26'),
(61, 'delete_countries', 'countries', '2019-10-14 07:22:26', '2019-10-14 07:22:26'),
(62, 'browse_transport_costs', 'transport_costs', '2019-10-14 07:33:23', '2019-10-14 07:33:23'),
(63, 'read_transport_costs', 'transport_costs', '2019-10-14 07:33:23', '2019-10-14 07:33:23'),
(64, 'edit_transport_costs', 'transport_costs', '2019-10-14 07:33:23', '2019-10-14 07:33:23'),
(65, 'add_transport_costs', 'transport_costs', '2019-10-14 07:33:23', '2019-10-14 07:33:23'),
(66, 'delete_transport_costs', 'transport_costs', '2019-10-14 07:33:23', '2019-10-14 07:33:23'),
(67, 'browse_transport_categories', 'transport_categories', '2019-10-14 08:30:23', '2019-10-14 08:30:23'),
(68, 'read_transport_categories', 'transport_categories', '2019-10-14 08:30:23', '2019-10-14 08:30:23'),
(69, 'edit_transport_categories', 'transport_categories', '2019-10-14 08:30:23', '2019-10-14 08:30:23'),
(70, 'add_transport_categories', 'transport_categories', '2019-10-14 08:30:23', '2019-10-14 08:30:23'),
(71, 'delete_transport_categories', 'transport_categories', '2019-10-14 08:30:23', '2019-10-14 08:30:23'),
(72, 'browse_adresses_users', 'adresses_users', '2019-10-17 14:26:23', '2019-10-17 14:26:23'),
(73, 'read_adresses_users', 'adresses_users', '2019-10-17 14:26:23', '2019-10-17 14:26:23'),
(74, 'edit_adresses_users', 'adresses_users', '2019-10-17 14:26:23', '2019-10-17 14:26:23'),
(75, 'add_adresses_users', 'adresses_users', '2019-10-17 14:26:23', '2019-10-17 14:26:23'),
(76, 'delete_adresses_users', 'adresses_users', '2019-10-17 14:26:23', '2019-10-17 14:26:23'),
(77, 'browse_promotions', 'promotions', '2019-10-19 08:27:13', '2019-10-19 08:27:13'),
(78, 'read_promotions', 'promotions', '2019-10-19 08:27:13', '2019-10-19 08:27:13'),
(79, 'edit_promotions', 'promotions', '2019-10-19 08:27:13', '2019-10-19 08:27:13'),
(80, 'add_promotions', 'promotions', '2019-10-19 08:27:13', '2019-10-19 08:27:13'),
(81, 'delete_promotions', 'promotions', '2019-10-19 08:27:14', '2019-10-19 08:27:14'),
(82, 'browse_stocks', 'stocks', '2019-10-29 14:32:19', '2019-10-29 14:32:19'),
(83, 'read_stocks', 'stocks', '2019-10-29 14:32:19', '2019-10-29 14:32:19'),
(84, 'edit_stocks', 'stocks', '2019-10-29 14:32:19', '2019-10-29 14:32:19'),
(85, 'add_stocks', 'stocks', '2019-10-29 14:32:19', '2019-10-29 14:32:19'),
(86, 'delete_stocks', 'stocks', '2019-10-29 14:32:19', '2019-10-29 14:32:19'),
(87, 'browse_orders', 'orders', '2020-01-20 11:50:02', '2020-01-20 11:50:02'),
(88, 'read_orders', 'orders', '2020-01-20 11:50:02', '2020-01-20 11:50:02'),
(89, 'edit_orders', 'orders', '2020-01-20 11:50:02', '2020-01-20 11:50:02'),
(90, 'add_orders', 'orders', '2020-01-20 11:50:02', '2020-01-20 11:50:02'),
(91, 'delete_orders', 'orders', '2020-01-20 11:50:02', '2020-01-20 11:50:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(4, 3),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(27, 3),
(28, 1),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(36, 3),
(37, 1),
(37, 3),
(38, 1),
(38, 3),
(39, 1),
(39, 3),
(40, 1),
(40, 3),
(41, 1),
(41, 3),
(42, 1),
(42, 3),
(43, 1),
(43, 3),
(44, 1),
(44, 3),
(45, 1),
(45, 3),
(46, 1),
(46, 3),
(47, 1),
(47, 3),
(48, 1),
(48, 3),
(49, 1),
(49, 3),
(50, 1),
(50, 3),
(51, 1),
(51, 3),
(52, 1),
(52, 3),
(53, 1),
(53, 3),
(54, 1),
(54, 3),
(55, 1),
(55, 3),
(56, 1),
(56, 3),
(57, 1),
(57, 3),
(58, 1),
(58, 3),
(59, 1),
(59, 3),
(60, 1),
(60, 3),
(61, 1),
(61, 3),
(62, 1),
(62, 3),
(63, 1),
(63, 3),
(64, 1),
(64, 3),
(65, 1),
(65, 3),
(66, 1),
(66, 3),
(67, 1),
(67, 3),
(68, 1),
(68, 3),
(69, 1),
(69, 3),
(70, 1),
(70, 3),
(71, 1),
(71, 3),
(72, 1),
(72, 3),
(73, 1),
(73, 3),
(74, 1),
(74, 3),
(75, 1),
(75, 3),
(76, 1),
(76, 3),
(77, 1),
(77, 3),
(78, 1),
(78, 3),
(79, 1),
(79, 3),
(80, 1),
(80, 3),
(81, 1),
(81, 3),
(82, 1),
(82, 3),
(83, 1),
(83, 3),
(84, 1),
(84, 3),
(85, 1),
(85, 3),
(86, 1),
(86, 3),
(87, 1),
(87, 3),
(88, 1),
(88, 3),
(89, 1),
(89, 3),
(90, 1),
(90, 3),
(91, 1),
(91, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promotions`
--

CREATE TABLE `promotions` (
  `id` int(10) UNSIGNED NOT NULL,
  `items_id` int(11) DEFAULT NULL,
  `values` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_origin` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(2, 'user', 'Normal User', '2019-09-21 07:13:31', '2019-09-21 07:13:31'),
(3, 'ncommerce', 'NCommerce', '2020-04-18 14:05:34', '2020-04-18 14:07:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', NULL, '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'user_disk/wgOSJmtyaUheCgaVIc2i.png', '', 'image', 4, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 9, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', 'settings/February2020/u2VrK9nFk9swKBX9lGiF.png', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'NCommerce', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Bem-Vindo ao seu painel de controlo.', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin'),
(11, 'site.icon', 'Site Icon', 'user_disk/wgOSJmtyaUheCgaVIc2i.png', NULL, 'image', 3, 'Site'),
(14, 'site.xd_software', 'Carregar Dados de XD', '0', NULL, 'checkbox', 10, 'Site'),
(16, 'site.barra_navegacao', 'Cor da Barra de Navegação', '#ffffff', NULL, 'color', 11, 'Site'),
(17, 'site.texto_barra_navegacao', 'Cor do Texto da Barra de Navegação', '#000000', NULL, 'color', 12, 'Site'),
(18, 'site.fundo_website', 'Cor do Fundo do Website', '#ffffff', NULL, 'color', 13, 'Site'),
(19, 'site.cor_titulos', 'Cor dos Títulos', '#000000', NULL, 'color', 14, 'Site'),
(20, 'site.cor_textos', 'Cor dos Textos', '#000000', NULL, 'color', 15, 'Site'),
(21, 'site.nib', 'NIB', '33333', NULL, 'text', 7, 'Site'),
(22, 'site.company_name', 'Nome da Empresa', NULL, NULL, 'text', 16, 'Site'),
(23, 'site.company_email', 'Email da Empresa', NULL, NULL, 'text', 17, 'Site'),
(24, 'site.company_contact', 'Contacto da Empresa', NULL, NULL, 'text', 18, 'Site'),
(25, 'site.company_vat', 'NIF da Empresa', NULL, NULL, 'text', 19, 'Site'),
(26, 'site.n_account', 'Nº de Conta', '233333', NULL, 'text', 6, 'Site'),
(27, 'site.bic', 'BIC/SWIFT', '1233444', NULL, 'text', 8, 'Site'),
(28, 'site.paypal_username', 'PAYPAL USERNAME', NULL, NULL, 'text', 20, 'Site'),
(29, 'site.paypal_password', 'PAYPAL PASSWORD', NULL, NULL, 'text', 21, 'Site'),
(30, 'site.paypal_signature', 'PAYPAL SIGNATURE', NULL, NULL, 'text', 22, 'Site'),
(31, 'site.n_banco', 'Nome do Banco', NULL, NULL, 'text', 5, 'Site');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sobres`
--

CREATE TABLE `sobres` (
  `id` int(10) UNSIGNED NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sobres`
--

INSERT INTO `sobres` (`id`, `imagem`, `texto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sobres/September2019/wgOSJmtyaUheCgaVIc2i.png', '<p>Somos Especialistas em R&eacute;plicas de qualidade.</p>\r\n<p>Experimenta e maravilha-te.</p>', '2019-09-25 11:19:51', '2021-04-19 17:12:59', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `state`
--

CREATE TABLE `state` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `state`
--

INSERT INTO `state` (`id`, `state`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A Aguardar Pagamento', '2020-01-20 08:17:18', '2020-01-20 08:17:18', NULL),
(2, 'A Aguardar Envio', '2020-01-20 10:31:22', '2020-01-20 10:31:22', NULL),
(3, 'Enviado', '2020-01-20 12:13:32', '2020-01-20 12:13:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `items_id` int(11) DEFAULT NULL,
  `attr_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transport_categories`
--

CREATE TABLE `transport_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `transport_categories`
--

INSERT INTO `transport_categories` (`id`, `desc`, `created_at`, `updated_at`, `deleted_at`, `order`) VALUES
(3, 'Até 1kg', '2021-04-15 15:31:00', '2021-04-19 17:06:48', NULL, NULL),
(4, 'De 1Kg a 2kg', '2021-04-19 17:07:13', '2021-04-19 17:07:13', NULL, NULL),
(5, 'Portes Grátis', '2021-04-20 08:32:14', '2021-04-20 08:32:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transport_costs`
--

CREATE TABLE `transport_costs` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `transport_categories` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `transport_costs`
--

INSERT INTO `transport_costs` (`id`, `country_id`, `transport_categories`, `created_at`, `updated_at`, `deleted_at`, `price`) VALUES
(4, 3, 4, '2021-04-19 17:08:05', '2021-04-20 10:05:56', '2021-04-20 10:05:56', 0.50),
(5, 3, 5, '2021-04-20 08:32:29', '2021-04-20 08:32:29', NULL, 0.00),
(6, 3, 3, '2021-04-20 14:05:30', '2021-04-20 14:08:27', '2021-04-20 14:08:27', 12.00),
(7, 3, 3, '2021-04-20 14:11:47', '2021-04-23 16:45:31', '2021-04-23 16:45:31', 12.00),
(8, 6, 5, '2021-04-21 09:33:59', '2021-04-23 16:45:39', '2021-04-23 16:45:39', 0.00),
(9, 6, 5, '2021-04-21 09:33:59', '2021-04-21 09:33:59', NULL, 0.00),
(10, 5, 5, '2021-04-23 16:45:54', '2021-04-23 16:45:54', NULL, 0.00),
(11, 7, 5, '2021-04-23 16:46:11', '2021-04-23 16:46:11', NULL, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_finish_setup` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `domain_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_confirmation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `has_finish_setup`, `created_at`, `updated_at`, `deleted_at`, `domain_token`, `token_confirmation`) VALUES
(1, 1, 'NCommerce Support', 'support@ncommerce.pt', 'users/default.png', NULL, '$2y$10$NfJJfqe.9B5.vHFXdFY0mOMtYytBQjSlr61C034.imxbsV9nWg/da', 'gEOsPx6tXPjRIQkOBewcWMBRtlPalHMutmZHHYbjkbb6xXhF6Y26qW5U4qTv', '{\"locale\":\"pt\"}', 0, '2020-04-21 07:08:32', '2020-04-21 14:33:10', NULL, NULL, NULL),
(2, 3, 'TESTE', 'negociosrb@gmail.com', 'users/default.png', NULL, '$2y$10$Xv.HdJ800ugvpH6vXnnN/.D5MMYHZngOO1dDF4YlYi9z53H8V9ZZO', 'vraw4arZUdkdokW04CwIl3tEnYOJpRIm9MlBmNv94lsaBNd5DRmtJvHyrmGm', '{\"locale\":\"pt\"}', 0, '2021-04-12 14:15:10', '2021-04-12 14:16:28', NULL, 'ljfnTfNCxNli1DTVrQNKLDeVns5oW2GcjDuIauRadWxN2PNJN9zwdcOrlFzgHXj1LaD5Yvi3ktR3v1aFubqbnyqXel', NULL),
(6, NULL, 'José  Freitas', 'online@zie.pt', 'users/default.png', NULL, '$2y$10$7F66.eBw2kImuH8Iz2.9fOY8FszMNLoXieQ4zbUogU9U1aOe5VX3C', NULL, '{\"locale\":\"pt\"}', 0, '2021-04-15 15:49:44', '2021-04-15 15:49:44', NULL, NULL, NULL),
(7, 2, 'Jose', 'a.j.r.t.f18@hotmail.com', 'users/default.png', NULL, '$2y$10$AKHvqfD0PHnS0Z8HhOyuwey0wO7F03dvXD/PO0kCUFc9Ms3JFQn9.', 'iJ7orfNpiL2FqUMrrjxXXSuCv04tZrKDrkXLC8aDoWVKbkZvfhFyjl4q3cRv', NULL, 1, '2021-04-19 17:15:55', '2021-04-19 17:16:54', NULL, NULL, ''),
(9, 2, 'RUBEN JOAO PINTO BESSA', 'rubenbessa@gmail.com', 'users/default.png', NULL, '$2y$10$I7ZUhwSKDHaW3hh13KyLz.iKwYcWVOfdV2Ey3AeN.Slm7aJD0NxMm', 'D2BVEeD5tLCciypX9gZI881Kir83aWCRkN4xWvGkux0uYEYnQIyvpWPWr4wr8fLBVk96bJxQuHV8NdD3uktoUhTgvRhXyxZsQXuy', NULL, 1, '2021-04-21 10:33:37', '2021-04-21 10:34:12', NULL, NULL, ''),
(10, 2, 'Teste2', 'developer@napp.pt', 'users/default.png', NULL, '$2y$10$fx9M7DnE5BQBkGP0OqWjuu51eTaT69hNtapRGu61eWzL9/09NhC.y', '0MErg8XcRYsuxaH08pDWiO5yV2Vp9iAccRALYJ5Y1NPk0WjogJghxHfMRZlrI01RSxz9vj4kipl3cjrbjlv0F8Hdvqya27R2IANO', NULL, 1, '2021-04-22 08:52:10', '2021-04-23 16:44:37', NULL, NULL, ''),
(12, 2, 'Teste3', 'lduarte@napp.pt', 'users/default.png', NULL, '$2y$10$5FM9igL28.jF/UbUfDSXuO1GqXVwDaZnt1XoRUb8U1swo4agdhs12', '1PddP8L1zKlkty12V9dgZ82FcuaTccrcKcV7QPsAcK5kqWPMgMv9u76AMepd', NULL, 1, '2021-04-22 09:25:35', '2021-04-22 09:26:12', NULL, NULL, ''),
(13, 2, 'RUBEN JOAO PINTO BESSA', 'bessa@n-solucoes.pt', 'users/default.png', NULL, '$2y$10$dOQWRv8FhuLYO5eJL/7qpe40y3RLN/dHZTKukOWAaGEAud8570iIC', NULL, NULL, 0, '2021-04-23 10:57:55', '2021-04-23 10:57:55', NULL, NULL, '$2y$10$jqvRp7q64j5gF9MtvpfRFe0MIWf4ZLi02dl2anSTbDzaiET43FcLe'),
(16, 2, 'Lucio', 'lucioduarte@napp.pt', 'users/default.png', NULL, '$2y$10$T1JhL6Xj0mNur7HzENTIgu93SlAssCUf7xHHCsOKAUXI9Pyysk1Ty', 'obwfLuM5TQsp3p5fzgKCYHPA3fyvncQ5xLkAKTRHlRQTAui73JVmpzvqfLngF266F240IAT6SKupFc3zEvchpmrII0H2MZr5Ekce', NULL, 1, '2021-04-23 11:05:57', '2021-04-23 11:06:37', NULL, NULL, ''),
(17, 2, 'Joao', 'geral@n-solucoes.pt', 'users/default.png', NULL, '$2y$10$.lR7DHXghrlO6wGSRtZW.ekbvEheynfcS2TfLZNFFP0DKrLGfUk/6', 'Jrl7s8Rgc9tRLKpdCYnh49IeIr0SjXlbFOT8fmTfboXCaMvNJxSKMWdKA12uxdWf6aabb2RkjoV2ioIZxnNc1jwCFBhOk7zdW3kh', NULL, 1, '2021-04-23 16:12:48', '2021-04-23 16:14:01', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(6, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adresses_users`
--
ALTER TABLE `adresses_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banner_publicitario`
--
ALTER TABLE `banner_publicitario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `create_contact_us_table`
--
ALTER TABLE `create_contact_us_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indices de la tabla `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items_attr_images`
--
ALTER TABLE `items_attr_images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locked`
--
ALTER TABLE `locked`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mail_queue`
--
ALTER TABLE `mail_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indices de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_state`
--
ALTER TABLE `order_state`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `sobres`
--
ALTER TABLE `sobres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indices de la tabla `transport_categories`
--
ALTER TABLE `transport_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transport_costs`
--
ALTER TABLE `transport_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adresses_users`
--
ALTER TABLE `adresses_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `banner_publicitario`
--
ALTER TABLE `banner_publicitario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `create_contact_us_table`
--
ALTER TABLE `create_contact_us_table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de la tabla `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `items_attr_images`
--
ALTER TABLE `items_attr_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `locked`
--
ALTER TABLE `locked`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mail_queue`
--
ALTER TABLE `mail_queue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT de la tabla `order_state`
--
ALTER TABLE `order_state`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `sobres`
--
ALTER TABLE `sobres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `state`
--
ALTER TABLE `state`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transport_categories`
--
ALTER TABLE `transport_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transport_costs`
--
ALTER TABLE `transport_costs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
