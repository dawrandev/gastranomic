-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 21 2026 г., 11:48
-- Версия сервера: 5.7.41
-- Версия PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gastronomic_`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cake Bumer', 'brands/logos/5dMqFqk7p7tAXhMIOrN590fIrsbEaAQi6vmBVECs.jpg', 'Роскошные десерты из свежих ингредиентов и сытный Fastfood', '2026-01-29 00:44:25', '2026-01-29 02:27:07'),
(2, 'Grand Lavash', 'brands/logos/39TnmeysQsR2AFsJuAe2PzG59akezGGR5xGVjwSS.png', 'Nókis qalasındaǵı eń mazalı fast food', '2026-01-29 01:54:57', '2026-01-29 01:58:19'),
(3, 'Neo', 'brands/logos/8nGRKsbI5Fvx8hzyiCbKWc3IFktCnj4VSJ12ycBV.jpg', 'Ресторан • Караоке • Танцпол', '2026-01-29 02:28:58', '2026-01-29 02:28:58'),
(4, 'Qaraqalpaǵım', 'brands/logos/Z3FiOAGPKv9wD7XUobiu8VxEBLL8bzshtPiGYz3S.jpg', 'Каракалпагым Кафе', '2026-01-29 02:35:18', '2026-01-29 02:35:18');

-- --------------------------------------------------------

--
-- Структура таблицы `brand_translations`
--

CREATE TABLE `brand_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('245e17026099a1d5b2d44e166f34e075fc5ca0e2', 'i:1;', 1771488491),
('245e17026099a1d5b2d44e166f34e075fc5ca0e2:timer', 'i:1771488491;', 1771488491),
('d510cf9556e1176c9f1b268567826f09a2802a80', 'i:1;', 1770637731),
('d510cf9556e1176c9f1b268567826f09a2802a80:timer', 'i:1770637731;', 1770637731),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:35:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:19:\"view_any_restaurant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"view_restaurant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"create_restaurant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:17:\"update_restaurant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:17:\"delete_restaurant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"edit_restaurant\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"search_restaurant\";s:1:\"c\";s:3:\"web\";}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"view_any_brand\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"create_brand\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"update_brand\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"delete_brand\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:10:\"view_brand\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:17:\"view_any_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"view_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"create_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"update_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"delete_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:21:\"view_any_menu_section\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:17:\"view_menu_section\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:19:\"create_menu_section\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:19:\"update_menu_section\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:19:\"delete_menu_section\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:18:\"view_any_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:14:\"view_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:16:\"create_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:16:\"update_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:16:\"delete_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:29:\"view_any_restaurant_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:25:\"view_restaurant_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:27:\"create_restaurant_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:27:\"update_restaurant_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:27:\"delete_restaurant_menu_item\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:15:\"view_any_review\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:11:\"view_review\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:13:\"delete_review\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"superadmin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}}}', 1771572369);

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `icon`, `created_at`, `updated_at`) VALUES
(2, 'categories/icons/uFeu7gxFPZglDIVw59sj496AgiGaAPOnjOgQRXbP.png', '2026-01-29 01:55:27', '2026-01-29 01:55:27'),
(3, 'categories/icons/zfztUKr3UN3ZFDUGFMQ6jWEPkHx6TixzTFaM2evu.png', '2026-01-29 02:29:21', '2026-01-29 02:29:21'),
(4, 'categories/icons/z9hDCF0Z2GC1iaTxAU52tCLTEfteJ1te4xJnbq93.png', '2026-01-29 02:34:42', '2026-01-29 02:34:42');

-- --------------------------------------------------------

--
-- Структура таблицы `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `code`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'uz', 'Fast Food', 'Tezkor, mazali va to‘yimli tanovul.', '2026-01-29 01:55:27', '2026-01-29 01:55:27'),
(2, 2, 'ru', 'Фаст Фуд', 'Быстрый, вкусный и сытный перекус.', '2026-01-29 01:55:27', '2026-01-29 01:55:27'),
(3, 2, 'en', 'Fast Food', 'Quick, delicious and satisfying meals.', '2026-01-29 01:55:27', '2026-01-29 01:55:27'),
(4, 2, 'kk', 'Fast Food', 'Tez, dámli hám toyımlı awqatlar.', '2026-01-29 01:55:27', '2026-01-29 01:55:27'),
(5, 3, 'uz', 'Restoran', 'Oliy darajadagi xizmat va nafis ta’mlar.', '2026-01-29 02:29:21', '2026-01-29 02:29:21'),
(6, 3, 'ru', 'Ресторан', 'Высокий сервис и изысканные вкусы.', '2026-01-29 02:29:21', '2026-01-29 02:29:21'),
(7, 3, 'en', 'Restaurant', 'Premium service and exquisite flavors.', '2026-01-29 02:29:21', '2026-01-29 02:29:21'),
(8, 3, 'kk', 'Restoran', 'Joqarı dárejeli xizmet hám názik dámler.', '2026-01-29 02:29:21', '2026-01-29 02:29:21'),
(9, 4, 'uz', 'Kafe', 'Qaynoq qahva va sokin muhit.', '2026-01-29 02:34:42', '2026-01-29 02:34:42'),
(10, 4, 'ru', 'Кафе', 'Горячий кофе и уютная атмосфера.', '2026-01-29 02:34:42', '2026-01-29 02:34:42'),
(11, 4, 'en', 'Cafe', 'Hot coffee and cozy atmosphere.', '2026-01-29 02:34:42', '2026-01-29 02:34:42'),
(12, 4, 'kk', 'Kafe', 'Issı kofe hám tınısh ortalıq.', '2026-01-29 02:34:42', '2026-01-29 02:34:42');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `created_at`, `updated_at`) VALUES
(1, '2026-01-29 00:44:04', '2026-01-29 00:44:04');

-- --------------------------------------------------------

--
-- Структура таблицы `city_translations`
--

CREATE TABLE `city_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `city_translations`
--

INSERT INTO `city_translations` (`id`, `city_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'kk', 'Nókis', '2026-01-29 00:44:04', '2026-01-29 00:44:04'),
(2, 1, 'uz', 'Nukus', '2026-01-29 00:44:04', '2026-01-29 00:44:04'),
(3, 1, 'ru', 'Нукус', '2026-01-29 00:44:04', '2026-01-29 00:44:04'),
(4, 1, 'en', 'Nukus', '2026-01-29 00:44:04', '2026-01-29 00:44:04');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `device_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Unique device identifier',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP address (IPv4/IPv6)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'kk', 'Karakalpak', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(2, 'uz', 'Uzbek', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(3, 'ru', 'Russian', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(4, 'en', 'English', '2026-02-09 06:20:16', '2026-02-09 06:20:16');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_section_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_price` decimal(8,2) DEFAULT NULL,
  `weight_grams` int(11) DEFAULT NULL,
  `weight` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_section_id`, `image_path`, `base_price`, `weight_grams`, `weight`, `created_at`, `updated_at`) VALUES
(1, 2, 'menu-items/BGG54pXqzzPHzZe7znht9d2qV76nwKoqLHVpb3Uu.webp', 22000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(2, 2, 'menu-items/sYkvPnATqOiMNmcNFStyWwosBmFUfVYNY7kmbRqF.webp', 23000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(3, 2, 'menu-items/WdR7iU7OevcCga4vM3nYqKri4QtxI5q1k8DWJ837.webp', 24000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(4, 1, 'menu-items/0JQgyshAo0eNGBmNd5wM4bfvP5VVMpmNQHxMBhLA.webp', 250000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(5, 1, 'menu-items/blM0C4yrFjwUjmX4GFYlT19xPM3jxu9iZKxRtmGb.webp', 170000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(6, 1, 'menu-items/IO7ijbXmbYc8sBC2riT4r1s4CrSHlq5sYzcOrN1s.webp', 110000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(7, 3, 'menu-items/LVc0TKKvXmSBXsS6JLYK5VGKeVeL8kOI4ABUEP2B.webp', 260000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(8, 3, 'menu-items/aFlwtZB8PQVpQRUBFcnakZ1KsnTvG5ztXtIZY4wk.webp', 270000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(9, 3, 'menu-items/0o7aUeiKf0DGBHJoBl0jRkNIjBGyPyjpoVYYovnk.webp', 372000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(10, 4, 'menu-items/c9ErO6sQ5HmApR0c41bx2VKJaUewQOzY5WdhNEDT.jpg', 33000.00, NULL, 350, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(11, 4, 'menu-items/8rr9sPmPbvmYpbfpUblhN0ct947etSyeTCEwHYHu.webp', 28000.00, NULL, 200, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(12, 4, 'menu-items/GD4CDtw96QQUHyPrpi4G5UCVeeLHnTHZwmIX1hOC.webp', 37000.00, NULL, 348, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(13, 6, 'menu-items/pi1ZsbDqngjgzOaphGOqv3ARLkxz43A7kBbwQXrh.webp', 45000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(14, 6, 'menu-items/P5l4qfiSzt8vLknBAv4rFVvBQExwBKagKTX4EUaY.webp', 65000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(15, 6, 'menu-items/RYlU6F0slla5iwlvDhar6HjIo7Aq07C3LwHdJ3O5.webp', 60000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(16, 5, 'menu-items/pdXfSolYJeDuHBQSKc0pTy4t0iO1JeQBCZqvKOze.webp', 50000.00, NULL, NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(17, 5, 'menu-items/7VjZ2XTz8jC8u769QjaKeQEv1iAhY6tsVcN0NT3L.webp', 70000.00, NULL, 520, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(18, 5, 'menu-items/74LlI3XZbON3ql7rGPgJmH323VI51JlUgjUxSnpn.webp', 29000.00, NULL, 200, '2026-01-29 01:43:29', '2026-01-29 01:43:29');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_item_translations`
--

CREATE TABLE `menu_item_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu_item_translations`
--

INSERT INTO `menu_item_translations` (`id`, `menu_item_id`, `lang_code`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'kk', 'Brown', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(2, 1, 'uz', 'Brown', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(3, 1, 'ru', 'Броун', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(4, 1, 'en', 'Brown', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(5, 2, 'kk', 'Bumer bólegi', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(6, 2, 'uz', 'Bumer parchasi', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(7, 2, 'ru', 'Бумер кусок', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(8, 2, 'en', 'Boomer piece', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(9, 3, 'kk', 'General bólegi', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(10, 3, 'uz', 'General parchasi', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(11, 3, 'ru', 'Генерал кусок', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(12, 3, 'en', 'General piece', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(13, 4, 'kk', 'Baby', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(14, 4, 'uz', 'Baby', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(15, 4, 'ru', 'Бейби', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(16, 4, 'en', 'Baby', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(17, 5, 'kk', 'Barxat', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(18, 5, 'uz', 'Barxat', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(19, 5, 'ru', 'Barxat', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(20, 5, 'en', 'Barxat', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(21, 6, 'kk', 'Bento', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(22, 6, 'uz', 'Bento', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(23, 6, 'ru', 'Бенто', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(24, 6, 'en', 'Bento', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(25, 7, 'kk', 'Malinali Chizkeyk', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(26, 7, 'uz', 'Malinali Chizkeyk', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(27, 7, 'ru', 'Чизкейк Малиновый', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(28, 7, 'en', 'Raspberry Cheesecake', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(29, 8, 'kk', 'Oreo Chizkeyk', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(30, 8, 'uz', 'Oreo Chizkeyk', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(31, 8, 'ru', 'Чизкейк Орео', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(32, 8, 'en', 'Oreo Cheesecake', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(33, 9, 'kk', 'San Sebastian Chizkeyk', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(34, 9, 'uz', 'San Sebastian Chizkeyk', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(35, 9, 'ru', 'Чизкейк Сан-Себастьян', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(36, 9, 'en', 'San Sebastian Cheesecake', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(37, 10, 'kk', 'Mal góshinnen úlken lavash', 'Juqa lavashqa shireli hám mazalı mal góshi, taza ovoshlar hám arnawlı sous qosılıp tayarlanadı. Toyımlı hám ishtey ashıwshı awqat.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(38, 10, 'uz', 'Mol góshtidan katta lavash', 'Yupqa lavashga shirali va mazali mol go‘shti, yangi sabzavotlar hamda maxsus sous qo‘shilib tayyorlanadi. To‘yimli va ishtahaochar taom.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(39, 10, 'ru', 'Большой лаваш с говядиной', 'Большой лаваш с сочной и ароматной говядиной, свежими овощами и фирменным соусом. Сытное и аппетитное блюдо.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(40, 10, 'en', 'Large Beef Lavash', 'Large lavash filled with juicy and flavorful beef, fresh vegetables, and a special sauce. A hearty and appetizing dish.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(41, 11, 'kk', 'Tawıq góshinen kishkene lavash', 'Tandırda pisirilgen juqa lavashqa jumsaq hám shireli tawıq góshi, taza ovoshlar hám arnawlı sous qosılıp tayarlanadı. Jeńil, mazalı hám tez tayar bolatuǵın taǵam.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(42, 11, 'uz', 'Tovuq go\'shtidan kichik lavash', 'Tandirda pishirilgan yupqa lavashga yumshoq va shirali tovuq go‘shti, yangi sabzavotlar hamda maxsus sous qo‘shilib tayyorlanadi. Yengil, mazali va tez tayyor bo‘ladigan taom.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(43, 11, 'ru', 'Тандыр мини лаваш с курицей', 'Мини-лаваш, приготовленный в тандыре, с нежным и сочным куриным мясом, свежими овощами и фирменным соусом. Лёгкое, вкусное и сытное блюдо.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(44, 11, 'en', 'Mini tandoor lavash with chicken', 'Mini tandoor-baked lavash filled with tender and juicy chicken, fresh vegetables, and a special sauce. A light, tasty, and satisfying dish.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(45, 12, 'kk', 'Tandırda pisirilgen úlken lavash mal góshi menen', 'Tandırda pisirilgen juqa lavashqa shireli hám mazalı mal góshi, taza ovoshlar hám arnawlı sous qosılıp tayarlanadı. Júdá toyımlı hám ishtey ashıwshı awqat.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(46, 12, 'uz', 'Tandirda pishirilgan katta lavash mol go‘shti bilan', 'Tandirda pishirilgan yupqa lavashga shirali va mazali mol go‘shti, yangi sabzavotlar hamda maxsus sous qo‘shilib tayyorlanadi. Juda to‘yimli va ishtahaochar taom.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(47, 12, 'ru', 'Тандыр лаваш большой с говядиной', 'Большой лаваш, приготовленный в тандыре, с сочной и ароматной говядиной, свежими овощами и фирменным соусом. Очень сытное и аппетитное блюдо.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(48, 12, 'en', 'Large tandoor-baked lavash with beef', 'Large tandoor-baked lavash filled with juicy and flavorful beef, fresh vegetables, and a special sauce. A hearty and satisfying dish.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(49, 13, 'kk', 'Vegetarian pitsa', 'Pomidor sousı tiykarında tayarlanǵan vegetarianlıq pizza. Quramına mozzarella sırı, pomidor, bolgar burıshı, zamarrıq, zaytun hám xosh iyisli pripravalar qosıladı.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(50, 13, 'uz', 'Vegetarian pitsa', 'Pomidor sousi asosida tayyorlangan vegetarian pitsa. Tarkibiga mozzarella pishlog‘i, pomidor, bolgar qalampiri, qo‘ziqorin, zaytun va xushbo‘y ziravorlar qo‘shiladi.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(51, 13, 'ru', 'Пицца вегетарианская', 'Вегетарианская пицца на основе томатного соуса. В состав входят сыр моцарелла, помидоры, болгарский перец, шампиньоны, оливки и ароматные специи.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(52, 13, 'en', 'Vegetarian pizza', 'Vegetarian pizza made with a tomato sauce base. Topped with mozzarella cheese, tomatoes, bell peppers, mushrooms, olives, and aromatic spices.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(53, 14, 'kk', 'Assorti pitsa', 'Pomidor sousı tiykarında tayarlanǵan assorti picası. Quramına mozzarella sırı, kolbasa, mal góshi, tawıq góshi, pomidor, bolgar burıshı, zamarrıq hám zaytun qosıladı.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(54, 14, 'uz', 'Assorti pitsa', 'Pomidor sousi asosida tayyorlangan assorti pitsa. Tarkibiga mozzarella pishlog‘i, kolbasa, mol go‘shti, tovuq go‘shti, pomidor, bolgar qalampiri, qo‘ziqorin va zaytun qo‘shiladi.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(55, 14, 'ru', 'Пицца Ассорти', 'Пицца ассорти на основе томатного соуса. В состав входят сыр моцарелла, колбаса, говядина, куриное мясо, помидоры, болгарский перец, шампиньоны и оливки.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(56, 14, 'en', 'Assorted pizza', 'Assorted pizza made with a tomato sauce base. Topped with mozzarella cheese, sausage, beef, chicken, tomatoes, bell peppers, mushrooms, and olives.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(57, 15, 'kk', 'Góshli pitsa', 'Pomidor sousı tiykarında tayarlanǵan góshli picca. Quramına mozzarella sırı, mal góshi, tawıq góshi, kolbasa, piyaz hám xosh iyisli pripravalar qosıladı.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(58, 15, 'uz', 'Go‘shtli pitsa', 'Pomidor sousi asosida tayyorlangan go‘shtli pitsa. Tarkibiga mozzarella pishlog‘i, mol go‘shti, tovuq go‘shti, kolbasa, piyoz va xushbo‘y ziravorlar qo‘shiladi.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(59, 15, 'ru', 'Пицца мясная', 'Мясная пицца на основе томатного соуса. В состав входят сыр моцарелла, говядина, куриное мясо, колбаса, лук и ароматные специи.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(60, 15, 'en', 'Meat pizza', 'Meat pizza made with a tomato sauce base. Topped with mozzarella cheese, beef, chicken, sausage, onion, and aromatic spices.', '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(61, 16, 'kk', 'Lavash kombo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(62, 16, 'uz', 'Lavash kombo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(63, 16, 'ru', 'Лаваш Комбо', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(64, 16, 'en', 'Lavash Combo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(65, 17, 'kk', 'Palwan kombo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(66, 17, 'uz', 'Polvon kombo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(67, 17, 'ru', 'Палуан комбо', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(68, 17, 'en', 'Paluan kombo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(69, 18, 'kk', 'Balalar kombo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(70, 18, 'uz', 'Bolalar Kombo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(71, 18, 'ru', 'Детский комбо', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(72, 18, 'en', 'Kids Combo', NULL, '2026-01-29 01:43:29', '2026-01-29 01:43:29');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_sections`
--

CREATE TABLE `menu_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu_sections`
--

INSERT INTO `menu_sections` (`id`, `brand_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-01-29 00:47:14', '2026-01-29 00:47:14'),
(2, 1, 2, '2026-01-29 01:26:40', '2026-01-29 01:26:40'),
(3, 1, 3, '2026-01-29 01:33:12', '2026-01-29 01:33:12'),
(4, 2, 1, '2026-01-29 02:03:58', '2026-01-29 02:03:58'),
(5, 2, 2, '2026-01-29 02:04:21', '2026-01-29 02:04:21'),
(6, 2, 3, '2026-01-29 02:04:47', '2026-01-29 02:04:47'),
(7, 2, 1, '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(8, 2, 2, '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(9, 2, 3, '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(10, 2, 4, '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(11, 2, 5, '2026-02-09 06:20:17', '2026-02-09 06:20:17');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_section_translations`
--

CREATE TABLE `menu_section_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_section_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu_section_translations`
--

INSERT INTO `menu_section_translations` (`id`, `menu_section_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'kk', 'Tortlar', '2026-01-29 00:47:14', '2026-01-29 00:47:14'),
(2, 1, 'uz', 'Tortlar', '2026-01-29 00:47:14', '2026-01-29 00:47:14'),
(3, 1, 'ru', 'Торты', '2026-01-29 00:47:14', '2026-01-29 00:47:14'),
(4, 1, 'en', 'Cakes', '2026-01-29 00:47:14', '2026-01-29 00:47:14'),
(5, 2, 'kk', 'Bólekli tortlar', '2026-01-29 01:26:40', '2026-01-29 01:26:40'),
(6, 2, 'uz', 'Parchali tortlar', '2026-01-29 01:26:40', '2026-01-29 01:26:40'),
(7, 2, 'ru', 'Кусок торты', '2026-01-29 01:26:40', '2026-01-29 01:26:40'),
(8, 2, 'en', 'A piece of cake', '2026-01-29 01:26:40', '2026-01-29 01:26:40'),
(9, 3, 'kk', 'Chizkeyk', '2026-01-29 01:33:12', '2026-01-29 01:33:12'),
(10, 3, 'uz', 'Chizkeyk', '2026-01-29 01:33:12', '2026-01-29 01:33:12'),
(11, 3, 'ru', 'Чизкейк', '2026-01-29 01:33:12', '2026-01-29 01:33:12'),
(12, 3, 'en', 'Cheesecake', '2026-01-29 01:33:12', '2026-01-29 01:33:12'),
(13, 4, 'kk', 'Lavash', '2026-01-29 02:03:58', '2026-01-29 02:03:58'),
(14, 4, 'uz', 'Lavash', '2026-01-29 02:03:58', '2026-01-29 02:03:58'),
(15, 4, 'ru', 'Лаваш', '2026-01-29 02:03:58', '2026-01-29 02:03:58'),
(16, 4, 'en', 'Lavash', '2026-01-29 02:03:58', '2026-01-29 02:03:58'),
(17, 5, 'kk', 'Kombo', '2026-01-29 02:04:21', '2026-01-29 02:04:21'),
(18, 5, 'uz', 'Kombo', '2026-01-29 02:04:21', '2026-01-29 02:04:21'),
(19, 5, 'ru', 'Комбо', '2026-01-29 02:04:21', '2026-01-29 02:04:21'),
(20, 5, 'en', 'Kombo', '2026-01-29 02:04:21', '2026-01-29 02:04:21'),
(21, 6, 'kk', 'Pitsa', '2026-01-29 02:04:47', '2026-01-29 02:04:47'),
(22, 6, 'uz', 'Pitsa', '2026-01-29 02:04:47', '2026-01-29 02:04:47'),
(23, 6, 'ru', 'Пицца', '2026-01-29 02:04:47', '2026-01-29 02:04:47'),
(24, 6, 'en', 'Pizza', '2026-01-29 02:04:47', '2026-01-29 02:04:47'),
(25, 7, 'ru', 'Салаты', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(26, 7, 'uz', 'Salatlar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(27, 7, 'kk', 'Salatlar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(28, 7, 'en', 'Salads', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(29, 8, 'ru', 'Супы', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(30, 8, 'uz', 'Sho\'rvalar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(31, 8, 'kk', 'Sorpalar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(32, 8, 'en', 'Soups', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(33, 9, 'ru', 'Основные блюда', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(34, 9, 'uz', 'Asosiy taomlar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(35, 9, 'kk', 'Tiykarǵı awqatlar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(36, 9, 'en', 'Main Dishes', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(37, 10, 'ru', 'Напитки', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(38, 10, 'uz', 'Ichimliklar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(39, 10, 'kk', 'Ishimlikler', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(40, 10, 'en', 'Beverages', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(41, 11, 'ru', 'Десерты', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(42, 11, 'uz', 'Shirinliklar', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(43, 11, 'kk', 'Shirinlikler', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(44, 11, 'en', 'Desserts', '2026-02-09 06:20:17', '2026-02-09 06:20:17');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_01_09_112812_create_permission_tables', 1),
(4, '2026_01_19_051535_create_brands_table', 1),
(5, '2026_01_19_051653_create_cities_table', 1),
(6, '2026_01_19_052126_create_categories_table', 1),
(7, '2026_01_19_063143_create_users_table', 1),
(8, '2026_01_20_090514_create_category_translations_table', 1),
(9, '2026_01_20_090523_create_languages_table', 1),
(10, '2026_01_20_112838_create_restaurants_table', 1),
(11, '2026_01_21_051900_create_operating_hours_table', 1),
(12, '2026_01_21_052329_create_restaurant_category', 1),
(13, '2026_01_21_053810_create_city_translations_table', 1),
(14, '2026_01_21_060037_create_restaurant_images_table', 1),
(15, '2026_01_23_062818_create_menu_sections_table', 1),
(16, '2026_01_23_063549_create_menu_items_table', 1),
(17, '2026_01_23_063725_create_restaurant_menu_items_table', 1),
(18, '2026_01_24_055927_create_menu_section_translations_table', 1),
(19, '2026_01_24_055928_create_menu_item_translations_table', 1),
(20, '2026_01_24_110044_create_verification_codes_table', 1),
(21, '2026_01_24_110114_create_clients_table', 1),
(22, '2026_01_24_110839_create_personal_access_tokens_table', 1),
(23, '2026_01_26_000001_create_reviews_table', 1),
(24, '2026_01_26_000002_create_favorites_table', 1),
(25, '2026_01_26_115930_add_weight_grams_to_menu_items_table', 1),
(26, '2026_01_29_064003_update_favorites_table_for_auth_only', 1),
(27, '2026_02_09_101933_create_brand_translations_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `operating_hours`
--

CREATE TABLE `operating_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `day_of_week` tinyint(4) NOT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `operating_hours`
--

INSERT INTO `operating_hours` (`id`, `restaurant_id`, `day_of_week`, `opening_time`, `closing_time`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '09:00:00', '23:00:00', 0, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(2, 1, 1, '09:00:00', '23:00:00', 0, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(3, 1, 2, '09:00:00', '23:00:00', 0, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(4, 1, 3, '09:00:00', '23:00:00', 0, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(5, 1, 4, '09:00:00', '23:00:00', 0, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(6, 1, 5, '09:00:00', '23:00:00', 0, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(7, 1, 6, '09:00:00', '23:00:00', 0, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(8, 2, 0, '10:00:00', '03:00:00', 0, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(9, 2, 1, '10:00:00', '03:00:00', 0, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(10, 2, 2, '10:00:00', '03:00:00', 0, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(11, 2, 3, '10:00:00', '03:00:00', 0, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(12, 2, 4, '10:00:00', '03:00:00', 0, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(13, 2, 5, '10:00:00', '03:00:00', 0, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(14, 2, 6, '10:00:00', '03:00:00', 0, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(15, 4, 0, '10:00:00', '03:00:00', 0, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(16, 4, 1, '10:00:00', '03:00:00', 0, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(17, 4, 2, '10:00:00', '03:00:00', 0, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(18, 4, 3, '10:00:00', '03:00:00', 0, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(19, 4, 4, '10:00:00', '03:00:00', 0, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(20, 4, 5, '10:00:00', '03:00:00', 0, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(21, 4, 6, '10:00:00', '03:00:00', 0, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(22, 5, 0, '09:00:00', '02:00:00', 0, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(23, 5, 1, '09:00:00', '02:00:00', 0, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(24, 5, 2, '09:00:00', '02:00:00', 0, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(25, 5, 3, '09:00:00', '02:00:00', 0, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(26, 5, 4, '09:00:00', '02:00:00', 0, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(27, 5, 5, '09:00:00', '02:00:00', 0, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(28, 5, 6, '09:00:00', '02:00:00', 0, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(29, 6, 0, '09:00:00', '00:00:00', 0, '2026-01-29 02:38:39', '2026-01-29 02:38:39'),
(30, 6, 1, '09:00:00', '00:00:00', 0, '2026-01-29 02:38:39', '2026-01-29 02:38:39'),
(31, 6, 2, '09:00:00', '00:00:00', 0, '2026-01-29 02:38:39', '2026-01-29 02:38:39'),
(32, 6, 3, '09:00:00', '00:00:00', 0, '2026-01-29 02:38:39', '2026-01-29 02:38:39'),
(33, 6, 4, '09:00:00', '00:00:00', 0, '2026-01-29 02:38:39', '2026-01-29 02:38:39'),
(34, 6, 5, '09:00:00', '00:00:00', 0, '2026-01-29 02:38:39', '2026-01-29 02:38:39'),
(35, 6, 6, '09:00:00', '00:00:00', 0, '2026-01-29 02:38:39', '2026-01-29 02:38:39');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_any_restaurant', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(2, 'view_restaurant', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(3, 'create_restaurant', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(4, 'update_restaurant', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(5, 'delete_restaurant', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(6, 'edit_restaurant', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(7, 'search_restaurant', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(8, 'view_any_brand', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(9, 'create_brand', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(10, 'update_brand', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(11, 'delete_brand', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(12, 'view_brand', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(13, 'view_any_category', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(14, 'view_category', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(15, 'create_category', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(16, 'update_category', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(17, 'delete_category', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(18, 'view_any_menu_section', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(19, 'view_menu_section', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(20, 'create_menu_section', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(21, 'update_menu_section', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(22, 'delete_menu_section', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(23, 'view_any_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(24, 'view_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(25, 'create_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(26, 'update_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(27, 'delete_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(28, 'view_any_restaurant_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(29, 'view_restaurant_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(30, 'create_restaurant_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(31, 'update_restaurant_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(32, 'delete_restaurant_menu_item', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(33, 'view_any_review', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(34, 'view_review', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(35, 'delete_review', 'web', '2026-02-09 06:20:17', '2026-02-09 06:20:17');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` geometry DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `restaurants`
--

INSERT INTO `restaurants` (`id`, `user_id`, `brand_id`, `city_id`, `branch_name`, `phone`, `description`, `address`, `location`, `is_active`, `qr_code`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'Cake Bumer №1', '990137757', NULL, 'Толепберген Кайипбергенов 54, Nukus', 0x000000000101000000d05128fe48ce4d4066df5c236d3b4540, 1, 'qrcodes/restaurant_1_1769683577.svg', '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(2, 3, 2, 1, 'Grand Lavash Main', '+998612006622', NULL, 'J. Aymurzaev kóshesi', 0x000000000101000000b01ec29fa5ce4d40056af5be1d3c4540, 1, 'qrcodes/restaurant_2_1769688170.svg', '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(4, 3, 2, 1, 'Grand Lavash 26', '+998612006622', NULL, 'Bilimler gúzari, 3', 0x000000000101000000839e415989cb4d40fa454162043c4540, 1, 'qrcodes/restaurant_4_1769689588.svg', '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(5, 4, 3, 1, 'Neo', '+998551100003', NULL, 'Sabira Kamalova kóshesi, 21', 0x0000000001010000006f13798f2dce4d4028fe0151e33a4540, 1, 'qrcodes/restaurant_5_1769689939.svg', '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(6, 5, 4, 1, 'Qaraqalpaǵım 1-filial', '+998999567007', NULL, 'Máteke Jumanazarov kóshesi', 0x00000000010100000062f2d7719fce4d404dc49c759d3c4540, 1, 'qrcodes/restaurant_6_1769690319.svg', '2026-01-29 02:38:39', '2026-01-29 02:38:39');

-- --------------------------------------------------------

--
-- Структура таблицы `restaurant_category`
--

CREATE TABLE `restaurant_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `restaurant_category`
--

INSERT INTO `restaurant_category` (`id`, `restaurant_id`, `category_id`, `created_at`, `updated_at`) VALUES
(3, 2, 2, '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(4, 4, 2, '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(5, 5, 3, '2026-02-09 06:20:17', '2026-02-09 06:20:17'),
(6, 6, 4, '2026-02-09 06:20:17', '2026-02-09 06:20:17');

-- --------------------------------------------------------

--
-- Структура таблицы `restaurant_images`
--

CREATE TABLE `restaurant_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `restaurant_images`
--

INSERT INTO `restaurant_images` (`id`, `restaurant_id`, `image_path`, `is_cover`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'restaurants/lFgMSQy2xCoqlzc2gCFseF96EIivzfvCKLuHznBs.jpg', 1, 1, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(2, 1, 'restaurants/EyVxQvwVJpzas0b23Lx5kvcb8q8f61jsF7iB2ff1.jpg', 0, 1, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(3, 1, 'restaurants/vSlst4OMwBJV57XR0QgjX2y5lp831v3SeaBrsBbi.jpg', 0, 1, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(4, 1, 'restaurants/csy7Uqg3TvUxcNpc9TqU8xBI4bi18PuUePDdDqoj.jpg', 0, 1, '2026-01-29 00:46:17', '2026-01-29 00:46:17'),
(5, 2, 'restaurants/6R0AptfDvQ4QZ5120W5S64Mvmzbi1aDm17yZqTA3.webp', 1, 1, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(7, 2, 'restaurants/t7uGLgUSn2COvwOGCWUqkCS0Ov2prH8yMVy5qSJG.webp', 0, 1, '2026-01-29 02:02:50', '2026-01-29 02:02:50'),
(9, 4, 'restaurants/QQx9AwbRAJMJpWLpHNzY1tzPDbSxjK6pj7nkZLUn.webp', 1, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(10, 4, 'restaurants/hhGBRJNHkOcZtBwzzplL5hTXiFI26xRVimQF26FU.webp', 0, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(11, 5, 'restaurants/D00JeL1Hqo7JKFMrH2E9egRJwobUALgZcVZTfS9h.jpg', 1, 1, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(12, 5, 'restaurants/zVPtmdPjHJrQ1IcNf4TdGQoUIDQ1e0bcdnOfcZA9.jpg', 0, 1, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(13, 5, 'restaurants/5USXt7WhKQ3EhozX64FNqknPOdjTviNkVZx5gUKp.jpg', 0, 1, '2026-01-29 02:32:19', '2026-01-29 02:32:19'),
(14, 6, 'restaurants/hFHCCkrSjoK4Qq2UnfGHvnnklNnJhqRlVILsTMuR.webp', 1, 1, '2026-01-29 02:38:39', '2026-01-29 02:38:39'),
(15, 6, 'restaurants/wi9OG9vjDwreps2oB9j2iXnt3a1B42hVZAwCczIh.webp', 0, 1, '2026-01-29 02:38:39', '2026-01-29 02:38:39');

-- --------------------------------------------------------

--
-- Структура таблицы `restaurant_menu_items`
--

CREATE TABLE `restaurant_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `restaurant_menu_items`
--

INSERT INTO `restaurant_menu_items` (`id`, `restaurant_id`, `menu_item_id`, `price`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 22000.00, 1, '2026-01-29 01:43:29', '2026-01-29 01:43:29'),
(2, 1, 2, 23000.00, 1, '2026-01-29 01:44:39', '2026-01-29 01:44:39'),
(3, 1, 3, 24000.00, 1, '2026-01-29 01:45:52', '2026-01-29 01:45:52'),
(4, 1, 4, 250000.00, 1, '2026-01-29 01:46:35', '2026-01-29 01:46:35'),
(5, 1, 5, 170000.00, 1, '2026-01-29 01:48:54', '2026-01-29 01:48:54'),
(6, 1, 6, 110000.00, 1, '2026-01-29 01:49:21', '2026-01-29 01:49:21'),
(7, 1, 7, 260000.00, 1, '2026-01-29 01:50:54', '2026-01-29 01:50:54'),
(8, 1, 8, 270000.00, 1, '2026-01-29 01:52:19', '2026-01-29 01:52:19'),
(9, 1, 9, 372000.00, 1, '2026-01-29 01:53:08', '2026-01-29 01:53:08'),
(10, 2, 10, 33000.00, 1, '2026-01-29 02:06:44', '2026-01-29 02:06:44'),
(11, 2, 11, 28000.00, 1, '2026-01-29 02:09:22', '2026-01-29 02:09:22'),
(12, 2, 12, 37000.00, 1, '2026-01-29 02:11:48', '2026-01-29 02:11:48'),
(13, 2, 13, 45000.00, 1, '2026-01-29 02:14:35', '2026-01-29 02:14:35'),
(14, 2, 14, 65000.00, 1, '2026-01-29 02:16:05', '2026-01-29 02:16:05'),
(15, 2, 15, 60000.00, 1, '2026-01-29 02:17:27', '2026-01-29 02:17:27'),
(16, 2, 16, 50000.00, 1, '2026-01-29 02:19:37', '2026-01-29 02:19:37'),
(17, 2, 17, 70000.00, 1, '2026-01-29 02:20:39', '2026-01-29 02:20:39'),
(18, 2, 18, 29000.00, 1, '2026-01-29 02:22:06', '2026-01-29 02:22:06'),
(19, 4, 10, 33000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(20, 4, 11, 28000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(21, 4, 12, 37000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(22, 4, 13, 45000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(23, 4, 14, 65000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(24, 4, 15, 60000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(25, 4, 16, 50000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(26, 4, 17, 70000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28'),
(27, 4, 18, 29000.00, 1, '2026-01-29 02:26:28', '2026-01-29 02:26:28');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `device_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Unique device identifier',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP address (IPv4/IPv6)',
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT '1-5 rating',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `client_id`, `restaurant_id`, `device_id`, `ip_address`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 'afef4bbd-d845-4096-aa9d-e1084290f6dd', '213.230.87.45', 3, 'Taza ónimler. jaqsi', '2026-01-31 13:57:30', '2026-01-31 13:57:30'),
(2, NULL, 1, '550e8400-e29b-41d4-a716-446655440000', '213.230.87.45', 5, 'Juda zo\'r restoran, taomlar mazali!', '2026-01-31 14:03:50', '2026-01-31 14:03:50'),
(3, NULL, 4, 'afef4bbd-d845-4096-aa9d-e1084290f6dd', '213.230.87.45', 4, 'Taza ónimler. bb', '2026-01-31 14:06:51', '2026-01-31 14:06:51'),
(4, NULL, 4, '550e8400-e29b-41d4-a716-446655440000', '213.230.87.45', 2, 'Juda boladi epleb!', '2026-01-31 14:09:12', '2026-01-31 14:09:12'),
(5, NULL, 6, 'afef4bbd-d845-4096-aa9d-e1084290f6dd', '213.230.87.45', 5, 'jaman', '2026-01-31 14:10:04', '2026-01-31 14:10:04'),
(6, NULL, 1, '6b10fc17-0021-4714-bf27-c1a9407b5b61', '84.54.73.218', 4, 'allow', '2026-02-01 05:19:23', '2026-02-01 05:19:23'),
(7, NULL, 5, '6b10fc17-0021-4714-bf27-c1a9407b5b61', '84.54.73.218', 3, NULL, '2026-02-01 05:19:36', '2026-02-01 05:19:36'),
(8, NULL, 5, 'ff308f4d-a26d-46bf-9e1c-a159b47bde6d', '213.230.87.45', 1, 'Porsiya kichik', '2026-02-01 11:44:17', '2026-02-01 11:44:17'),
(9, NULL, 4, 'ff308f4d-a26d-46bf-9e1c-a159b47bde6d', '213.230.87.45', 5, NULL, '2026-02-01 11:44:30', '2026-02-01 11:44:30'),
(10, NULL, 6, 'ff308f4d-a26d-46bf-9e1c-a159b47bde6d', '213.230.87.45', 5, 'yaqshi', '2026-02-01 14:23:45', '2026-02-01 14:23:45'),
(11, NULL, 1, 'b5576a4f-5777-479c-91a0-9219fbac0c9e', '213.230.92.114', 4, 'Xızmetkerler dosane. ficufufufu', '2026-02-01 23:47:36', '2026-02-01 23:47:36'),
(12, NULL, 6, 'e09ec613-5b4b-4317-a739-1f9facf8e01d', '37.110.214.74', 5, NULL, '2026-02-02 08:45:35', '2026-02-02 08:45:35'),
(13, NULL, 6, '6b10fc17-0021-4714-bf27-c1a9407b5b61', '84.54.73.218', 5, NULL, '2026-02-03 10:38:20', '2026-02-03 10:38:20'),
(14, NULL, 1, '6b4e935d-906e-43e5-9baa-ca616a419ac5', '84.54.73.218', 3, 'minaw Dilafruzga jaqpadi', '2026-02-03 21:32:24', '2026-02-03 21:32:24'),
(15, NULL, 2, '6b4e935d-906e-43e5-9baa-ca616a419ac5', '84.54.73.218', 5, 'Xızmet tez hám sıpatlı', '2026-02-03 21:32:44', '2026-02-03 21:32:44'),
(16, NULL, 6, '6b4e935d-906e-43e5-9baa-ca616a419ac5', '84.54.73.218', 1, 'xaxaxaxxaxaxa', '2026-02-04 01:53:08', '2026-02-04 01:53:08'),
(17, NULL, 5, '6b4e935d-906e-43e5-9baa-ca616a419ac5', '84.54.73.218', 5, NULL, '2026-02-04 11:54:14', '2026-02-04 11:54:14'),
(18, NULL, 1, '02bbe252-6457-4b5e-80d8-b2741df1bfa4', '84.54.71.66', 5, 'Clean and cozy. Beautiful atmosphere', '2026-02-04 21:52:36', '2026-02-04 21:52:36'),
(19, NULL, 6, '02bbe252-6457-4b5e-80d8-b2741df1bfa4', '84.54.72.227', 4, NULL, '2026-02-04 23:42:33', '2026-02-04 23:42:33'),
(20, NULL, 1, '6de9cc76-15f0-4df4-88fa-2e1716e5d4e3', '213.230.86.180', 5, 'Taza hám qolaylı', '2026-02-05 00:31:35', '2026-02-05 00:31:35'),
(21, NULL, 5, '02bbe252-6457-4b5e-80d8-b2741df1bfa4', '213.230.93.19', 5, 'Красивая атмосфера. uuu', '2026-02-05 07:01:25', '2026-02-09 06:47:51'),
(22, NULL, 5, '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', '213.230.93.19', 5, 'Taza ónimlerden tayarlanǵan. unadi', '2026-02-05 20:28:24', '2026-02-05 20:28:24'),
(23, NULL, 1, '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', '213.230.93.19', 5, 'nmnn', '2026-02-05 20:33:46', '2026-02-05 20:33:46'),
(24, NULL, 2, '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', '213.230.93.19', 5, 'xor\n\nz', '2026-02-05 20:34:33', '2026-02-05 20:34:33'),
(25, NULL, 4, '21eb932a-ac4a-48aa-aa3a-2b3f27a173e7', '213.230.93.19', 5, 'nmmmmm', '2026-02-05 20:35:05', '2026-02-05 20:35:05'),
(26, NULL, 4, '02bbe252-6457-4b5e-80d8-b2741df1bfa4', '84.54.72.227', 3, 'Taam suwıq edi. sbhs', '2026-02-06 02:28:02', '2026-02-06 02:28:02'),
(27, NULL, 2, '0e8129ad-809a-4e64-bfa4-69e5c098c0dd', '213.230.87.131', 1, 'A. Sizga nima yoqmadi?\n→ Qo\'pol yoki e\'tiborsiz xodimlar, Yetarli tozalik yo\'q\n\nB. Nima norozilikka sabab bo\'ldi?\n→ Taom/ichimlik: maza, sifat, harorat\n\n1. Qanday kategoriyani ajratib ko\'rsatasiz?\n→ Kechki ovqat\n\n2. Bu restoranga yana kelasizmi?\n→ Ehtimol', '2026-02-19 02:21:32', '2026-02-19 03:07:11'),
(28, NULL, 1, '0e8129ad-809a-4e64-bfa4-69e5c098c0dd', '213.230.87.131', 3, 'A. Sizge ne jaqpadı?\n→ Baqaw xızmet, Qolaylı emes xızmetkerler, Jetkilikli tazalıq joq, Buyırtpada qáteler, Yamán jaritıw, Shawqınlı muxıt, Qolaylı emes orınlıqlar\n\nB. Neni narazılıqqa sebep boldı?\n→ Taam/ishimlik: dám, sapat, temperatura, Xızmetkerdıń wájibliligı, Baha/sapat qatnası, Muxıttıń ulıwma tásiri, Taamdı kútiw waqtı\n\n1. Qanday kategoriyani ajratasiz?\n→ Gúnortaǵı tamaq\n\n2. Qaytadan kelesizbemi?\n→ Múmkin', '2026-02-19 02:39:21', '2026-02-19 02:39:21');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16'),
(2, 'admin', 'web', '2026-02-09 06:20:16', '2026-02-09 06:20:16');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
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
(23, 1),
(24, 1),
(28, 1),
(29, 1),
(33, 1),
(34, 1),
(35, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(8, 2),
(12, 2),
(13, 2),
(14, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `brand_id`, `name`, `login`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Asosiy Boshqaruvchi', 'superadmin', '$2y$12$iciKt8Q26TF5R2j8QNTJKemaBK.pBxCxJnoZCDPMN/XVg0retsVmG', NULL, '2026-01-29 00:44:04', '2026-01-29 00:44:04'),
(2, 1, 'Cake Bumer Admin', 'cakebumer', '$2y$12$nRXMEWySSxzl/tbDHblghe9r7vA0UA7cIoFNPy8zt9dd8QVtVPL8C', NULL, '2026-01-29 00:45:14', '2026-01-29 00:45:14'),
(3, 2, 'Grand Lavash Admini', 'grand123', '$2y$12$mX2XUHqJaEupp6fJW0SGdOEzM0LCed.cssnMtMwAWNd7s/iEFvIoK', NULL, '2026-01-29 01:55:54', '2026-01-29 01:55:54'),
(4, 3, 'Neo Admin', 'neo12345', '$2y$12$PJNusANyMe4u7mblVlYAGOYAtNXCyt.uELHOvC//zn4Wl/I1OAtQu', NULL, '2026-01-29 02:29:44', '2026-01-29 02:29:44'),
(5, 4, 'Qaraqalpaǵım Admin', 'qaraqalpaq', '$2y$12$DqGRxXI0xEJYYUSbe5F8Xew4XXVDWAzCL6z8MJe2QZXTzu/gKxLvy', NULL, '2026-01-29 02:35:51', '2026-01-29 02:35:51');

-- --------------------------------------------------------

--
-- Структура таблицы `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brand_translations`
--
ALTER TABLE `brand_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_translations_brand_id_foreign` (`brand_id`);

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_translations_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city_translations`
--
ALTER TABLE `city_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_translations_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_phone_unique` (`phone`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_device_favorite` (`device_id`,`restaurant_id`),
  ADD UNIQUE KEY `unique_client_favorite` (`client_id`,`restaurant_id`),
  ADD KEY `favorites_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `favorites_client_id_index` (`client_id`),
  ADD KEY `favorites_device_id_index` (`device_id`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Индексы таблицы `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_section_id_foreign` (`menu_section_id`);

--
-- Индексы таблицы `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_item_translations_menu_item_id_lang_code_unique` (`menu_item_id`,`lang_code`),
  ADD KEY `menu_item_translations_lang_code_foreign` (`lang_code`);

--
-- Индексы таблицы `menu_sections`
--
ALTER TABLE `menu_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_sections_brand_id_foreign` (`brand_id`);

--
-- Индексы таблицы `menu_section_translations`
--
ALTER TABLE `menu_section_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_section_translations_menu_section_id_lang_code_unique` (`menu_section_id`,`lang_code`),
  ADD KEY `menu_section_translations_lang_code_foreign` (`lang_code`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `operating_hours`
--
ALTER TABLE `operating_hours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operating_hours_restaurant_id_day_of_week_unique` (`restaurant_id`,`day_of_week`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Индексы таблицы `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurants_user_id_foreign` (`user_id`),
  ADD KEY `restaurants_brand_id_foreign` (`brand_id`),
  ADD KEY `restaurants_city_id_foreign` (`city_id`);

--
-- Индексы таблицы `restaurant_category`
--
ALTER TABLE `restaurant_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_category_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `restaurant_category_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `restaurant_images`
--
ALTER TABLE `restaurant_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_images_restaurant_id_foreign` (`restaurant_id`);

--
-- Индексы таблицы `restaurant_menu_items`
--
ALTER TABLE `restaurant_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_menu_items_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `restaurant_menu_items_menu_item_id_foreign` (`menu_item_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_device_restaurant` (`device_id`,`restaurant_id`),
  ADD KEY `reviews_client_id_foreign` (`client_id`),
  ADD KEY `reviews_restaurant_id_index` (`restaurant_id`),
  ADD KEY `reviews_rating_index` (`rating`),
  ADD KEY `reviews_ip_address_index` (`ip_address`),
  ADD KEY `reviews_device_id_index` (`device_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_login_unique` (`login`),
  ADD KEY `users_brand_id_foreign` (`brand_id`);

--
-- Индексы таблицы `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verification_codes_phone_index` (`phone`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `brand_translations`
--
ALTER TABLE `brand_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `city_translations`
--
ALTER TABLE `city_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `menu_sections`
--
ALTER TABLE `menu_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `menu_section_translations`
--
ALTER TABLE `menu_section_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `operating_hours`
--
ALTER TABLE `operating_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `restaurant_category`
--
ALTER TABLE `restaurant_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `restaurant_images`
--
ALTER TABLE `restaurant_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `restaurant_menu_items`
--
ALTER TABLE `restaurant_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `brand_translations`
--
ALTER TABLE `brand_translations`
  ADD CONSTRAINT `brand_translations_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `city_translations`
--
ALTER TABLE `city_translations`
  ADD CONSTRAINT `city_translations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_section_id_foreign` FOREIGN KEY (`menu_section_id`) REFERENCES `menu_sections` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD CONSTRAINT `menu_item_translations_lang_code_foreign` FOREIGN KEY (`lang_code`) REFERENCES `languages` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu_sections`
--
ALTER TABLE `menu_sections`
  ADD CONSTRAINT `menu_sections_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu_section_translations`
--
ALTER TABLE `menu_section_translations`
  ADD CONSTRAINT `menu_section_translations_lang_code_foreign` FOREIGN KEY (`lang_code`) REFERENCES `languages` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_section_translations_menu_section_id_foreign` FOREIGN KEY (`menu_section_id`) REFERENCES `menu_sections` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `operating_hours`
--
ALTER TABLE `operating_hours`
  ADD CONSTRAINT `operating_hours_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurants_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `restaurant_category`
--
ALTER TABLE `restaurant_category`
  ADD CONSTRAINT `restaurant_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_category_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `restaurant_images`
--
ALTER TABLE `restaurant_images`
  ADD CONSTRAINT `restaurant_images_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `restaurant_menu_items`
--
ALTER TABLE `restaurant_menu_items`
  ADD CONSTRAINT `restaurant_menu_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_menu_items_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
