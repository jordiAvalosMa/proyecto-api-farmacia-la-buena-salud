-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2024 at 03:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmacia`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre_categoria` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre_categoria`, `created_at`, `updated_at`) VALUES
(1, 'VITAMINAS', '2024-11-19 03:38:29', '2024-11-19 03:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_ordenes_pedido`
--

CREATE TABLE `detalle_ordenes_pedido` (
  `id` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `pedido_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int NOT NULL,
  `venta_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `usuario_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `envio`
--

CREATE TABLE `envio` (
  `id` int NOT NULL,
  `venta_id` int DEFAULT NULL,
  `estado_envio` int DEFAULT NULL,
  `costo_envio` double DEFAULT NULL,
  `fecha_entrega` varchar(255) DEFAULT NULL,
  `empleado_id` int DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_23_034813_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_pedido`
--

CREATE TABLE `ordenes_pedido` (
  `id` int NOT NULL,
  `fecha` varchar(255) DEFAULT NULL,
  `total_pedido` double DEFAULT NULL,
  `proveedor_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'api-key', '138f2131ce66513453f47cc18c24087d29add4e6dfeecf15c7c64af505d33bae', '[\"*\"]', '2024-11-19 09:42:48', NULL, '2024-11-19 09:33:55', '2024-11-19 09:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int NOT NULL,
  `nombre_proveedor` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre_proveedor`, `direccion`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'Bayer', 'santa ana', '123654-5861', '2024-11-19 03:35:24', '2024-11-19 03:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'REPARTIDOR', '2024-11-19 03:33:46', '2024-11-19 03:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2qRybm7hLuqXF1i6xSftRnO3SXmCuVBclFWU2dWS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDRsRXY5Q0VhbVpsTDNjeHhnYU1lNmJnamM0S3BuT055Z0ZYNmJoZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731984454),
('BRnHJk04s5Skdkq0LCc8sCHNc6gBIWoPChfAX5wp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0tPalZTUUlIVWxpZHR4dkZIN1VrZXRhb1dFeXczbDVpcjlMVWZLZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731883449),
('eLK50dCOMmkF0mWkVIJvfIM5jLtIdfk64Fli9nUm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXNwMGpFZ1ppMTZPNjZQeFNsQjRRbUNaeDY2d3BRcWttOUdZY24xViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731987144),
('GfmZx24FcXBw0VG5rVSLYk1GN3r3asBMHSOXaujt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkkxOUdQdjZJMzBRVWY2R082UEZXdDJiSmsxbEJWREpNYlZhaHBEeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731879405);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rol_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'deku', 'deku@mail.com', NULL, '$2y$12$F2.HmvYPI7iU/hhxBACcI.gRXjBuSdMd4UAykicd4dQdqUH9N13mm', 1, NULL, '2024-11-19 09:33:55', '2024-11-19 09:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` int NOT NULL,
  `total_venta` double DEFAULT NULL,
  `fecha` varchar(255) DEFAULT NULL,
  `cliente_id` int DEFAULT NULL,
  `empleado_id` int DEFAULT NULL,
  `tipo_pago` varchar(255) DEFAULT NULL,
  `tipo_venta` varchar(255) DEFAULT NULL,
  `estado_venta` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_ordenes_pedido`
--
ALTER TABLE `detalle_ordenes_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordenes_pedido`
--
ALTER TABLE `ordenes_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_users_roles` (`rol_id`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detalle_ordenes_pedido`
--
ALTER TABLE `detalle_ordenes_pedido`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `envio`
--
ALTER TABLE `envio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordenes_pedido`
--
ALTER TABLE `ordenes_pedido`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_ordenes_pedido`
--
ALTER TABLE `detalle_ordenes_pedido`
  ADD CONSTRAINT `detalle_ordenes_pedido_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `detalle_ordenes_pedido_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `ordenes_pedido` (`id`);

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);

--
-- Constraints for table `ordenes_pedido`
--
ALTER TABLE `ordenes_pedido`
  ADD CONSTRAINT `ordenes_pedido_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
