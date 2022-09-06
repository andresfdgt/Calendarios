/*
 Navicat Premium Data Transfer

 Source Server         : docker_recetas
 Source Server Type    : MySQL
 Source Server Version : 50737
 Source Host           : localhost:3037
 Source Schema         : recetas_universal

 Target Server Type    : MySQL
 Target Server Version : 50737
 File Encoding         : 65001

 Date: 18/03/2022 13:22:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cif_dni` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL DEFAULT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `razon_social` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `telefono` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `telefono_2` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `longitud` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `latitud` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `pais` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `estado` tinyint(3) UNSIGNED NULL DEFAULT NULL COMMENT '0=inactivo,1=activo,2=mora,3=vencido',
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `codigo_postal` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `localidad` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `provincia` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `usuario_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES (2, NULL, 'ce', NULL, NULL, NULL, 'calle false 123', 'cevillalbas@misena.edu.co', NULL, NULL, 'images/cevillalbas_2/logo/nombre1623814873.jpg', 1, NULL, NULL, NULL, NULL, NULL, '2021-06-12 05:15:30', '2022-03-17 13:04:14', '2022-03-17 13:04:14');
INSERT INTO `clientes` VALUES (3, NULL, 'didier fernando guerrero sumalave', NULL, '3208777146', NULL, 'calle 1 numero 26-17', 'dfguerrero@unicesar.edu.co', NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, '2021-06-15 01:39:28', '2021-06-15 02:14:10', NULL);
INSERT INTO `clientes` VALUES (4, NULL, 'laura', NULL, '3162252923', NULL, 'cra 5a n°9a-18', 'lvardila98@gmail.com', NULL, NULL, 'images/lvardila98_4/logo/nombre1623894766.jpg', 3, NULL, NULL, NULL, NULL, NULL, '2021-06-15 18:57:13', '2021-06-16 20:52:46', NULL);
INSERT INTO `clientes` VALUES (5, NULL, 'getito', NULL, '0', NULL, NULL, 'juanfelizzola@gmail.com', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '2021-06-17 18:02:31', '2021-06-17 18:02:35', NULL);
INSERT INTO `clientes` VALUES (6, NULL, 'vanessa', NULL, '312456743', NULL, NULL, 'vanesa@gmail.com', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '2021-06-22 17:17:41', '2021-06-22 17:17:46', NULL);
INSERT INTO `clientes` VALUES (7, NULL, 'homtall', NULL, '0', NULL, NULL, 'dairotest@yopmail.com', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '2021-06-24 23:12:32', '2021-06-24 23:12:38', NULL);
INSERT INTO `clientes` VALUES (8, NULL, 'wfab', NULL, '3132849190', NULL, NULL, 'wilver06w@hotmail.com', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '2021-06-26 09:54:09', '2021-06-26 09:54:13', NULL);
INSERT INTO `clientes` VALUES (9, NULL, 'perinvento', NULL, '3004052835', NULL, NULL, 'andresfdgt@gmail.com', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, '2021-08-22 13:23:38', '2021-08-22 13:23:41', NULL);
INSERT INTO `clientes` VALUES (11, NULL, 'ingeniero', NULL, '317256468', NULL, NULL, 'ingeniero@gmail.com', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2022-02-15 16:31:52', '2022-03-17 13:04:00', NULL);
INSERT INTO `clientes` VALUES (12, '1234567890', 'prueba cliente', 'prueba cliente razon social', '3172526468', '3162252923', 'calle 11 # 15-13', 'pruebacliente@gmail.com', NULL, NULL, 'colombia', 1, 'una observacion', '205010', 'aguachica', 'cesar', 23, '2022-03-07 12:50:12', '2022-03-07 12:50:12', NULL);
INSERT INTO `clientes` VALUES (13, '1192724162', 'andrés felipe gamboa torres', 'voltech', '3004052835', '3004052835', 'carrera 10a #16-59', 'andresfdgt@outlook.com', NULL, NULL, 'colombia', 1, NULL, '205010', 'aguachica', 'cesar', 27, '2022-03-14 21:02:38', '2022-03-14 21:02:38', NULL);
INSERT INTO `clientes` VALUES (17, NULL, 'cygnus', NULL, '3004052835', NULL, NULL, 'andresfdgt@unicesar.edu.co', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '2021-06-12 04:36:03', '2021-06-12 04:36:06', NULL);
INSERT INTO `clientes` VALUES (18, '123456789009', 'ardila', 'ardila', '31123456789', '31123456789', 'calle falsa 123', 'laura@gmail.com', NULL, NULL, 'colombia', 1, 'premiun', '205010', 'aguachica', 'cesar', 28, '2022-03-17 13:09:32', '2022-03-17 13:11:01', NULL);

-- ----------------------------
-- Table structure for empresas
-- ----------------------------
DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `razon_social` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `telefono` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `longitud` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `latitud` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `imagen` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `estado` tinyint(1) UNSIGNED NULL DEFAULT NULL COMMENT '0=inactivo,1=activo',
  `cif` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL DEFAULT NULL,
  `pais` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `codigo_postal` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `localidad` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `cliente_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `contacto` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `host` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `base_datos` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `user_db` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `password_db` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `puerto` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empresas
-- ----------------------------
INSERT INTO `empresas` VALUES (2, 'ce', NULL, NULL, 'calle false 123', 'cevillalbas@misena.edu.co', NULL, NULL, 'images/cevillalbas_2/logo/nombre1623814873.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cevillalbas_2', NULL, NULL, NULL, '2021-06-12 05:15:30', '2021-06-15 22:41:13', NULL);
INSERT INTO `empresas` VALUES (3, 'didier fernando guerrero sumalave', NULL, '3208777146', 'calle 1 numero 26-17', 'dfguerrero@unicesar.edu.co', NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dfguerrero_3', NULL, NULL, NULL, '2021-06-15 01:39:28', '2021-06-15 02:14:10', NULL);
INSERT INTO `empresas` VALUES (4, 'laura', NULL, '3162252923', 'cra 5a n°9a-18', 'lvardila98@gmail.com', NULL, NULL, 'images/lvardila98_4/logo/nombre1623894766.jpg', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lvardila98_4', NULL, NULL, NULL, '2021-06-15 18:57:13', '2021-06-16 20:52:46', NULL);
INSERT INTO `empresas` VALUES (5, 'getito', NULL, '0', NULL, 'juanfelizzola@gmail.com', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'juanfelizzola_5', NULL, NULL, NULL, '2021-06-17 18:02:31', '2021-06-17 18:02:35', NULL);
INSERT INTO `empresas` VALUES (6, 'vanessa', NULL, '312456743', NULL, 'vanesa@gmail.com', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vanesa_6', NULL, NULL, NULL, '2021-06-22 17:17:41', '2021-06-22 17:17:46', NULL);
INSERT INTO `empresas` VALUES (7, 'homtall', NULL, '0', NULL, 'dairotest@yopmail.com', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dairotest_7', NULL, NULL, NULL, '2021-06-24 23:12:32', '2021-06-24 23:12:38', NULL);
INSERT INTO `empresas` VALUES (8, 'laura', 'ardila', '3132849190', 'calle falsa 123', 'ardila@gmail.com', NULL, NULL, NULL, 3, '123456789', 'colombia', '205010', 'aguachicas', NULL, 'laura ardila', 'localhost', 'wilver06w_8', 'root', 'recetasadmin', 3037, '2021-06-26 09:54:09', '2022-03-17 21:15:03', NULL);
INSERT INTO `empresas` VALUES (9, 'perinvento', NULL, '3004052835', NULL, 'andresfdgt@gmail.com', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'andresfdgt_9', NULL, NULL, NULL, '2021-08-22 13:23:38', '2021-08-22 13:23:41', NULL);
INSERT INTO `empresas` VALUES (10, 'cygnus', NULL, '3004052835', NULL, 'andresfdgt@unicesar.co', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pruebaclienteempresa_1', NULL, NULL, NULL, '2021-06-12 04:36:03', '2021-06-12 04:36:06', NULL);
INSERT INTO `empresas` VALUES (11, 'ingeniero', NULL, '317256468', NULL, 'ingeniero@gmail.com', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 12, NULL, NULL, 'ingeniero_11', NULL, NULL, NULL, '2022-02-15 16:31:52', '2022-02-15 16:31:52', NULL);
INSERT INTO `empresas` VALUES (13, 'prueba', 'nueva prueba', '3214567890', 'calle falsa 123', 'prueba@gmail.com', NULL, NULL, NULL, 1, '1234567890', 'colombia', '205010', 'cesar', 1, 'contacto princial', NULL, NULL, NULL, NULL, NULL, '2022-03-06 18:07:11', '2022-03-06 18:07:11', NULL);
INSERT INTO `empresas` VALUES (15, 'prueba cliente empresa', 'prueba cliente empresa razon social', '3234455667', 'calle falsa 123', 'pruebaclienteempresa@gmail.com', NULL, NULL, NULL, 1, '21121212121212', 'colombia', '205010', 'aguachica', 12, 'contacto empresa', NULL, 'pruebaclienteempresa_1', NULL, NULL, NULL, '2022-03-07 13:21:18', '2022-03-15 20:11:53', NULL);
INSERT INTO `empresas` VALUES (16, 'otra empresa', 'prueba cliente empresa razon social', '3234455667', 'calle falsa 123', 'pruebaclienteempresa@gmail.com', NULL, NULL, NULL, 1, '1234567', 'colombia', '205010', 'aguachica', 12, 'contacto empresa', NULL, 'pruebaclienteempresa_16', NULL, NULL, NULL, '2022-03-11 12:52:38', '2022-03-11 13:04:42', NULL);
INSERT INTO `empresas` VALUES (19, 'andrés felipe gamboa torres', 'voltech', '+573004052835', 'calle 1n #1a- 119', 'andresfdgt@outlook.com', NULL, NULL, NULL, 1, '1192724162', 'colombia', '205010', 'aguachica (139)', 13, 'frente a mi casa', NULL, 'andresfdgt_19', NULL, NULL, NULL, '2022-03-14 21:11:33', '2022-03-14 21:11:33', NULL);
INSERT INTO `empresas` VALUES (22, 'laura', 'ardila', '3114190337', 'calle falsa 123', 'ardila@gmail.com', NULL, NULL, NULL, 1, '123456789', 'colombia', '205010', 'aguachicas', 18, 'laura ardila', 'localhost', 'ardila_22', 'root', 'recetasadmin', 3037, '2022-03-17 20:18:29', '2022-03-17 21:17:57', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2021_09_14_154405_create_permission_tables', 2);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`, `empresa_id`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
INSERT INTO `model_has_permissions` VALUES (2, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (3, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (4, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (5, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (6, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (7, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (8, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (9, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (10, 'App\\Models\\User', 23, 16);
INSERT INTO `model_has_permissions` VALUES (19, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (20, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (21, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (22, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (23, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (24, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (25, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (26, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (27, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (28, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (29, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (30, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (31, 'App\\Models\\USer', 23, 16);
INSERT INTO `model_has_permissions` VALUES (1, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (2, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (3, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (4, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (50, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (51, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (52, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (53, 'App\\Models\\User', 25, 11);
INSERT INTO `model_has_permissions` VALUES (54, 'App\\Models\\User', 25, 11);

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------

-- ----------------------------
-- Table structure for modulos
-- ----------------------------
DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos`  (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `estado` bit(1) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of modulos
-- ----------------------------
INSERT INTO `modulos` VALUES (1, 'receta', b'1', '2022-03-09 18:40:44', '2022-03-17 21:35:08');
INSERT INTO `modulos` VALUES (2, 'talleres', b'1', '2022-03-12 08:17:54', '2022-03-12 08:17:57');
INSERT INTO `modulos` VALUES (3, 'iglesia', b'1', '2022-03-17 21:43:43', '2022-03-17 21:43:43');
INSERT INTO `modulos` VALUES (10000, 'System', b'1', '2022-03-14 21:38:42', '2022-03-14 21:38:46');

-- ----------------------------
-- Table structure for modulos_empresas
-- ----------------------------
DROP TABLE IF EXISTS `modulos_empresas`;
CREATE TABLE `modulos_empresas`  (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `empresa_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `modulo_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of modulos_empresas
-- ----------------------------
INSERT INTO `modulos_empresas` VALUES (1, 15, 1);
INSERT INTO `modulos_empresas` VALUES (4, 16, 1);
INSERT INTO `modulos_empresas` VALUES (5, 16, 2);
INSERT INTO `modulos_empresas` VALUES (8, 19, 1);
INSERT INTO `modulos_empresas` VALUES (9, 19, 2);
INSERT INTO `modulos_empresas` VALUES (12, 22, 1);
INSERT INTO `modulos_empresas` VALUES (13, 11, 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('andresfdgt@outlook.com', '$2y$10$IjYMZOfqyHzdbtaAzc6hQu9jLUbTo0.uWk05KZq/Vl7fyc.LP9Cay', '2021-10-08 15:42:23');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modulo_id` smallint(5) UNSIGNED NOT NULL,
  `grupo` smallint(255) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'ingredientes', 1, 1, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (2, 'crear_ingrediente', 1, 1, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (3, 'editar_ingrediente', 1, 1, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (4, 'eliminar_ingrediente', 1, 1, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (50, 'recetas', 1, 2, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (51, 'crear_receta', 1, 2, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (52, 'editar_receta', 1, 2, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (53, 'eliminar_receta', 1, 2, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (54, 'visualizar receta', 1, 2, '2022-03-09 19:11:27', '2022-03-09 19:11:27');
INSERT INTO `permissions` VALUES (10000, 'usuarios', 10000, 1, '2022-03-14 21:38:42', '2022-03-14 21:38:46');
INSERT INTO `permissions` VALUES (10001, 'crear_usuarios', 10000, 1, '2022-03-14 21:38:42', '2022-03-14 21:38:46');
INSERT INTO `permissions` VALUES (10002, 'editar_usuarios', 10000, 1, '2022-03-14 21:59:49', '2022-03-14 21:59:49');
INSERT INTO `permissions` VALUES (10003, 'eliminar_usuarios', 10000, 1, '2022-03-14 21:59:49', '2022-03-14 21:59:49');
INSERT INTO `permissions` VALUES (10004, 'estado_usuarios', 10000, 1, '2022-03-14 21:59:49', '2022-03-14 21:59:49');
INSERT INTO `permissions` VALUES (10051, 'empresas', 10000, 2, '2022-03-14 22:00:44', '2022-03-14 22:00:44');
INSERT INTO `permissions` VALUES (10052, 'crear_empresas', 10000, 2, '2022-03-14 22:03:31', '2022-03-14 22:03:31');
INSERT INTO `permissions` VALUES (10053, 'editar_empresas', 10000, 2, '2022-03-14 22:03:31', '2022-03-14 22:03:31');
INSERT INTO `permissions` VALUES (10054, 'eliminar_empresas', 10000, 2, '2022-03-14 22:03:31', '2022-03-14 22:03:31');
INSERT INTO `permissions` VALUES (10055, 'estado_empresa', 10000, 2, '2022-03-15 19:59:58', '2022-03-15 20:00:00');
INSERT INTO `permissions` VALUES (10101, 'roles', 10000, 3, '2022-03-14 22:00:44', '2022-03-14 22:00:44');
INSERT INTO `permissions` VALUES (10102, 'crear_roles', 10000, 3, '2022-03-14 22:03:31', '2022-03-14 22:03:31');
INSERT INTO `permissions` VALUES (10103, 'editar_roles', 10000, 3, '2022-03-14 22:03:31', '2022-03-14 22:03:31');
INSERT INTO `permissions` VALUES (10104, 'eliminar_roles', 10000, 3, '2022-03-14 22:03:31', '2022-03-14 22:03:31');
INSERT INTO `permissions` VALUES (10151, 'perfil', 10000, 4, '2022-03-14 22:09:27', '2022-03-14 22:09:30');
INSERT INTO `permissions` VALUES (10152, 'editar_perfil', 10000, 4, '2022-03-14 22:09:46', '2022-03-14 22:09:49');
INSERT INTO `permissions` VALUES (10201, 'configuracion', 10000, 4, '2022-03-16 12:30:07', '2022-03-16 12:30:09');
INSERT INTO `permissions` VALUES (10202, 'estado_configuracion', 10000, 4, '2022-03-16 12:30:07', '2022-03-16 12:30:09');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `empresa_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for roles_app
-- ----------------------------
DROP TABLE IF EXISTS `roles_app`;
CREATE TABLE `roles_app`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles_app
-- ----------------------------
INSERT INTO `roles_app` VALUES (1, 'nuevo rol', 16, '2022-03-12 09:18:00', '2022-03-12 09:48:16');
INSERT INTO `roles_app` VALUES (2, 'otro', 16, '2022-03-12 09:18:00', '2022-03-16 19:01:41');
INSERT INTO `roles_app` VALUES (3, 'nuevo', 11, '2022-03-18 13:06:02', '2022-03-18 13:15:00');

-- ----------------------------
-- Table structure for roles_permisos
-- ----------------------------
DROP TABLE IF EXISTS `roles_permisos`;
CREATE TABLE `roles_permisos`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles_permisos
-- ----------------------------
INSERT INTO `roles_permisos` VALUES (2, 1);
INSERT INTO `roles_permisos` VALUES (3, 1);
INSERT INTO `roles_permisos` VALUES (4, 1);
INSERT INTO `roles_permisos` VALUES (5, 1);
INSERT INTO `roles_permisos` VALUES (6, 1);
INSERT INTO `roles_permisos` VALUES (7, 1);
INSERT INTO `roles_permisos` VALUES (8, 1);
INSERT INTO `roles_permisos` VALUES (9, 1);
INSERT INTO `roles_permisos` VALUES (18, 1);
INSERT INTO `roles_permisos` VALUES (19, 1);
INSERT INTO `roles_permisos` VALUES (20, 1);
INSERT INTO `roles_permisos` VALUES (21, 1);
INSERT INTO `roles_permisos` VALUES (22, 1);
INSERT INTO `roles_permisos` VALUES (23, 1);
INSERT INTO `roles_permisos` VALUES (24, 1);
INSERT INTO `roles_permisos` VALUES (25, 1);
INSERT INTO `roles_permisos` VALUES (26, 1);
INSERT INTO `roles_permisos` VALUES (27, 1);
INSERT INTO `roles_permisos` VALUES (28, 1);
INSERT INTO `roles_permisos` VALUES (29, 1);
INSERT INTO `roles_permisos` VALUES (30, 1);
INSERT INTO `roles_permisos` VALUES (31, 1);
INSERT INTO `roles_permisos` VALUES (2, 2);
INSERT INTO `roles_permisos` VALUES (3, 2);
INSERT INTO `roles_permisos` VALUES (4, 2);
INSERT INTO `roles_permisos` VALUES (5, 2);
INSERT INTO `roles_permisos` VALUES (6, 2);
INSERT INTO `roles_permisos` VALUES (7, 2);
INSERT INTO `roles_permisos` VALUES (8, 2);
INSERT INTO `roles_permisos` VALUES (9, 2);
INSERT INTO `roles_permisos` VALUES (10, 2);
INSERT INTO `roles_permisos` VALUES (11, 2);
INSERT INTO `roles_permisos` VALUES (12, 2);
INSERT INTO `roles_permisos` VALUES (13, 2);
INSERT INTO `roles_permisos` VALUES (18, 2);
INSERT INTO `roles_permisos` VALUES (19, 2);
INSERT INTO `roles_permisos` VALUES (20, 2);
INSERT INTO `roles_permisos` VALUES (22, 2);
INSERT INTO `roles_permisos` VALUES (26, 2);
INSERT INTO `roles_permisos` VALUES (27, 2);
INSERT INTO `roles_permisos` VALUES (28, 2);
INSERT INTO `roles_permisos` VALUES (29, 2);
INSERT INTO `roles_permisos` VALUES (1, 3);
INSERT INTO `roles_permisos` VALUES (2, 3);
INSERT INTO `roles_permisos` VALUES (3, 3);
INSERT INTO `roles_permisos` VALUES (4, 3);
INSERT INTO `roles_permisos` VALUES (50, 3);
INSERT INTO `roles_permisos` VALUES (51, 3);
INSERT INTO `roles_permisos` VALUES (52, 3);
INSERT INTO `roles_permisos` VALUES (53, 3);
INSERT INTO `roles_permisos` VALUES (54, 3);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(3) UNSIGNED NOT NULL,
  `base_datos` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `last_empresa_id` smallint(5) UNSIGNED NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `email_verified_at` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `last_login_at` datetime NULL DEFAULT NULL,
  `last_login_ip` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Andrés Felipe Gamboa Torres', 'andresfdgt@gmail.com', '$2y$10$H97gSD42wnOk7DlKd.7H4./nQb2KShlwNV1ijEg2wOwKb/TTE2OBa', 'Administrador Principal', 1, 'andresfdgt_1', 0, 'JHHCNPIBj7l1c3UiAcTBnZTzf9Q7NY1boZg6D2cADVPp92ZatrljO4g0jcOe', '2021-06-24 22:25:13', '2021-06-12 04:36:03', '2021-08-23 22:37:55', NULL, '2022-03-14 20:30:03', '172.18.0.1');
INSERT INTO `usuarios` VALUES (2, 'cristian eduardo villaba sarabia', 'cevillalbas@misena.edu.co', '$2y$10$cELDDi1zYJw7INT/r.bvWurUAKGpTKHB9C.M11C7tO8XcVxzCcSg.', 'Administrador Principal', 1, 'cevillalbas_2', 0, 'wwf7scn4TrghawFUD0yLscCiw2zYIERtkgl90yxgR4D82kF5ifitJUwXmyqH', '2021-06-25 12:27:14', '2021-06-12 05:15:30', '2021-12-13 12:49:54', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (3, 'didier fernando guerrero sumalave', 'dfguerrero@unicesar.edu.co', '$2y$10$KGszQqENh9aoj9qF/tlvkeQeD/8OCFZDGxIcfuCm0OSppXjJkRMg2', 'Administrador Principal', 1, 'dfguerrero_3', 0, '41tRrXTJ7nnjGe7UcTdiOvIgBz5uUGoIE6u8gfiBNmfPMw3VnuyV9V6cQpyV', '2021-08-18 10:17:20', '2021-06-15 01:39:28', '2021-08-18 10:17:20', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (5, 'laura', 'dairo@yopmail.com', '$2y$10$6NJNJhn47fq4L7v1L1HRt.sKX4nWAG6oot2ExrZUc8cgMI/0wJOCu', 'Administrador Principal', 1, 'lvardila98_4', 0, 'gWh2kpIj4AHVpm7VwuTyCRh2UVAG5NM3YcCywMIjhI4Wkze4vUHx7p81VrJO', '2021-06-24 23:02:34', '2021-06-15 18:57:13', '2021-06-26 22:04:25', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (6, 'Jesus Aurelio', 'jesus@gmail.com_delete', '$2y$10$6dL9aiBh/1K3.04uVfZLuOGu6msOtxW6blzI32lQPiwHf.4F24kDe', 'Caja', 1, 'lvardila98_4', 0, NULL, NULL, '2021-06-15 19:12:54', '2021-06-17 09:18:33', '2021-06-17 09:18:33', NULL, NULL);
INSERT INTO `usuarios` VALUES (7, 'Sergio Andres', 'sergio_an94@hotmail.com_delete', '$2y$10$GTVCTType3jMpEkiJ0JIB.M5vqmlvGuCjiNPP8GkEZSi/CSJl0vce', 'Tecnico', 1, 'lvardila98_4', 0, NULL, NULL, '2021-06-15 19:23:14', '2021-06-17 09:20:33', '2021-06-17 09:20:33', NULL, NULL);
INSERT INTO `usuarios` VALUES (8, 'jesus', 'jesus@gmail.com_delete8', '$2y$10$HFaAlLybUAVoud3F0O9bXOQvpEoUvPA06buRiAdCVtXyr4K4RUfTS', 'Caja', 1, 'lvardila98_4', 0, 'sIlRHxzI2T4nHsdlwCY9HEA3f7jx8CeoaGoI65TdPIxX0Mk4ZoW86tN3dJdj', NULL, '2021-06-17 09:20:28', '2021-06-22 18:36:05', '2021-06-22 18:36:05', NULL, NULL);
INSERT INTO `usuarios` VALUES (9, 'getito', 'juanfelizzola@gmail.com', '$2y$10$sDoOXXe0oGSwffah1e20IO3PAFl9AR5p2d03Y1JZc4P8Tiwo0T7xu', 'Administrador Principal', 1, 'juanfelizzola_5', 0, NULL, NULL, '2021-06-17 18:02:31', '2021-06-17 18:02:31', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (10, 'Sergio Andres', 'sergio_an94@hotmail.com_delete10', '$2y$10$wmHiAX9AAdPlEDV2oACnHuCZh2VhKoyXjwWajP58Rk66zFv9P/bPi', 'Tecnico', 1, 'lvardila98_4', 0, NULL, NULL, '2021-06-17 18:58:07', '2021-06-26 14:13:52', '2021-06-26 14:13:52', NULL, NULL);
INSERT INTO `usuarios` VALUES (11, 'vanessa', 'vanesa@gmail.com', '$2y$10$uvp4AU1s.UZntJai9p2X1uLgXAAHZgw2f.4yMLYTmjo7Uz2UWa54K', 'Administrador Principal', 1, 'vanesa_6', 0, NULL, NULL, '2021-06-22 17:17:41', '2021-06-22 17:17:41', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (12, 'homtall', 'dairotest@yopmail.com', '$2y$10$.sS2Qpqj9Q8Dtmo9/LIXX.9JZecX2JFzN0fAOWRuTxOCU5U4fBWrq', 'Administrador Principal', 1, 'dairotest_7', 0, NULL, '2021-06-24 23:13:15', '2021-06-24 23:12:32', '2021-06-24 23:13:15', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (13, 'wfab', 'wilver06w@hotmail.com', '$2y$10$XL2hNesOY4//fj5OR1/Oi.MhqPnXuWZbdLg973fTqSI/2v1LLUjtW', 'Administrador Principal', 1, 'wilver06w_8', 0, NULL, '2021-06-26 09:54:39', '2021-06-26 09:54:09', '2021-06-26 21:07:51', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (14, 'Wilver', 'wilverfabian.06@gmail.com', '$2y$10$evvgUOQ0nMtx.5o9j0P5DetEa9cLiQUQSwhXZGMiFcocXK9NdoP.q', 'Tecnico', 1, 'wilver06w_8', 0, NULL, '2021-06-26 10:00:50', '2021-06-26 09:59:46', '2021-06-26 21:42:00', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (16, 'negro', 'negro@yopmail.com_delete', '$2y$10$4uRV6GUtEdmnaULhzvlKDO9pCHhopT4w02txGpquTX9WJWfRnyLaW', 'Tecnico', 1, 'lvardila98_4', 0, NULL, '2021-06-26 14:25:05', '2021-06-26 14:25:05', '2021-06-30 15:21:11', '2021-06-30 15:21:11', NULL, NULL);
INSERT INTO `usuarios` VALUES (17, 'Andrés Felipe Gamboa Torres', 'andresfdgt@unicesar.edu.co', '$2y$10$H97gSD42wnOk7DlKd.7H4./nQb2KShlwNV1ijEg2wOwKb/TTE2OBa', 'Administrador Principal', 1, 'andresfdgt_17', 0, NULL, '2021-06-30 15:27:49', '2021-06-30 15:27:49', '2021-06-30 15:27:58', '2021-06-30 15:27:58', NULL, NULL);
INSERT INTO `usuarios` VALUES (18, 'Aurelio Ardila', 'aurelio@gmail.com', '$2y$10$GOkBRn9arnvCilLLocUAW.vqhb1nKHBEnbFEH1UFXxLXuljRldbNG', 'Tecnico', 1, 'lvardila98_4', 0, NULL, '2021-07-01 18:15:11', '2021-07-01 18:15:11', '2021-07-01 18:15:11', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (19, 'arley', 'arleydoquin@gmail.com', '$2y$10$C3JOlwf1AGxZlcLxn2LPUuxaQJlTpdL92DQzq67I8vfdhLZQ4dkQq', 'Caja', 1, 'dfguerrero_3', 0, 'xGFybPDiJRZujeMdXSZtpBsWi5dTQQOYX9L6xjJYqy1giAUUqSVA9ZJlXHwN', '2021-08-18 10:18:29', '2021-08-18 10:18:29', '2021-08-18 10:18:29', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (20, 'JOSE CLARO ECHEVERRY', 'joseclar_@hotmail.com', '$2y$10$MYvru85IGLIJYjOFopihHekCHxLz1kYyage4HLiY4DNeg6ilIRQ3.', 'Tecnico', 1, 'dfguerrero_3', 0, NULL, '2021-08-19 08:53:31', '2021-08-19 08:53:31', '2021-08-19 08:53:31', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (21, 'perinvento', 'perinvento@gmail.com', '$2y$10$jJ5erI/5fR5I7uY75ZfN6.M7LkrWKA8i3HPpuzt6NJg54M1u47e02', 'Administrador Principal', 1, 'andresfdgt_9', 0, NULL, '2021-08-22 13:24:31', '2021-08-22 13:23:38', '2021-08-22 13:24:31', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (22, 'ingeniero', 'ingeniero@gmail.com', '$2y$10$8.lM1EpW3QHhDZSZB2.VeeqZ/0vgiStRbyBPlei1rKCFUO0l5C9s.', 'master', 1, 'ingeniero_11', 11, NULL, NULL, '2022-02-15 16:31:52', '2022-02-15 16:31:52', NULL, '2022-03-06 10:08:54', '172.18.0.1');
INSERT INTO `usuarios` VALUES (23, 'prueba cliente', 'pruebacliente@gmail.com', '$2y$10$53tiDX5t61ApQ1IzuReU.OGmJa2EFPOGN2xxv6wexuXbw37XrW1R6', 'master', 1, 'ingeniero_11', 11, NULL, NULL, '2022-03-07 12:50:12', '2022-03-07 12:50:12', NULL, '2022-03-18 12:38:23', '127.0.0.1');
INSERT INTO `usuarios` VALUES (25, 'usuariko de prueba', 'pruebaclienteempresa2@gmail.com', '$2y$10$53tiDX5t61ApQ1IzuReU.OGmJa2EFPOGN2xxv6wexuXbw37XrW1R6', 'otro', 1, 'ingeniero_11', 11, NULL, '2022-03-12 19:43:24', '2022-03-12 19:43:24', '2022-03-18 13:13:19', NULL, '2022-03-18 13:02:58', '127.0.0.1');
INSERT INTO `usuarios` VALUES (26, 'pruebapruebas', 'pruebaprueba@gmail.com', '$2y$10$TeDxmqWHyXB8vavxhZ6VHOuN.ZlU16DY2I5/lwkqeXpdkTX7UflYe', 'otro', 1, 'pruebaclienteempresa_16', 16, NULL, '2022-03-13 13:32:21', '2022-03-13 13:32:21', '2022-03-13 13:56:41', NULL, NULL, NULL);
INSERT INTO `usuarios` VALUES (27, 'andrés felipe gamboa torres', 'andresfdgt@outlook.com', '$2y$10$pJLDon70/uL.hClQ2GtJ6ecfwEqXB7wUerUFywsiP9LqCK6gH7HoK', 'master', 1, 'db_andresfdgt_19', 19, NULL, NULL, '2022-03-14 21:02:38', '2022-03-14 21:02:38', NULL, '2022-03-14 21:03:09', '172.18.0.1');
INSERT INTO `usuarios` VALUES (28, 'laura vanessa', 'laura@gmail.com', '$2y$10$MwpwmOI8mwGu8hBfSFJLe.PJlr09eOBRryc7RyycABSbUO.PHgOSC', 'master', 1, '', 0, NULL, NULL, '2022-03-17 13:09:32', '2022-03-17 13:09:32', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for usuarios_admin
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_admin`;
CREATE TABLE `usuarios_admin`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(3) UNSIGNED NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `email_verified_at` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `last_login_at` datetime NULL DEFAULT NULL,
  `last_login_ip` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuarios_admin
-- ----------------------------
INSERT INTO `usuarios_admin` VALUES (1, 'Andrés Felipe Gamboa Torres', 'andresfdgt@gmail.com', '$2y$10$H97gSD42wnOk7DlKd.7H4./nQb2KShlwNV1ijEg2wOwKb/TTE2OBa', 'Administrador Principal', 1, 'JHHCNPIBj7l1c3UiAcTBnZTzf9Q7NY1boZg6D2cADVPp92ZatrljO4g0jcOe', '2021-06-24 22:25:13', '2021-06-12 04:36:03', '2021-08-23 22:37:55', NULL, '2022-03-14 20:30:03', '172.18.0.1');
INSERT INTO `usuarios_admin` VALUES (2, 'cristian eduardo villaba sarabia', 'cevillalbas@misena.edu.co', '$2y$10$cELDDi1zYJw7INT/r.bvWurUAKGpTKHB9C.M11C7tO8XcVxzCcSg.', 'Administrador Principal', 1, 'wwf7scn4TrghawFUD0yLscCiw2zYIERtkgl90yxgR4D82kF5ifitJUwXmyqH', '2021-06-25 12:27:14', '2021-06-12 05:15:30', '2021-12-13 12:49:54', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (3, 'didier fernando guerrero sumalave', 'dfguerrero@unicesar.edu.co', '$2y$10$KGszQqENh9aoj9qF/tlvkeQeD/8OCFZDGxIcfuCm0OSppXjJkRMg2', 'Administrador Principal', 1, '41tRrXTJ7nnjGe7UcTdiOvIgBz5uUGoIE6u8gfiBNmfPMw3VnuyV9V6cQpyV', '2021-08-18 10:17:20', '2021-06-15 01:39:28', '2021-08-18 10:17:20', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (5, 'laura', 'dairo@yopmail.com', '$2y$10$6NJNJhn47fq4L7v1L1HRt.sKX4nWAG6oot2ExrZUc8cgMI/0wJOCu', 'Administrador Principal', 1, 'gWh2kpIj4AHVpm7VwuTyCRh2UVAG5NM3YcCywMIjhI4Wkze4vUHx7p81VrJO', '2021-06-24 23:02:34', '2021-06-15 18:57:13', '2021-06-26 22:04:25', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (6, 'Jesus Aurelio', 'jesus@gmail.com_delete', '$2y$10$6dL9aiBh/1K3.04uVfZLuOGu6msOtxW6blzI32lQPiwHf.4F24kDe', 'Caja', 1, NULL, NULL, '2021-06-15 19:12:54', '2021-06-17 09:18:33', '2021-06-17 09:18:33', NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (7, 'Sergio Andres', 'sergio_an94@hotmail.com_delete', '$2y$10$GTVCTType3jMpEkiJ0JIB.M5vqmlvGuCjiNPP8GkEZSi/CSJl0vce', 'Tecnico', 1, NULL, NULL, '2021-06-15 19:23:14', '2021-06-17 09:20:33', '2021-06-17 09:20:33', NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (8, 'jesus', 'jesus@gmail.com_delete8', '$2y$10$HFaAlLybUAVoud3F0O9bXOQvpEoUvPA06buRiAdCVtXyr4K4RUfTS', 'Caja', 1, 'sIlRHxzI2T4nHsdlwCY9HEA3f7jx8CeoaGoI65TdPIxX0Mk4ZoW86tN3dJdj', NULL, '2021-06-17 09:20:28', '2021-06-22 18:36:05', '2021-06-22 18:36:05', NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (9, 'getito', 'juanfelizzola@gmail.com', '$2y$10$sDoOXXe0oGSwffah1e20IO3PAFl9AR5p2d03Y1JZc4P8Tiwo0T7xu', 'Administrador Principal', 1, NULL, NULL, '2021-06-17 18:02:31', '2021-06-17 18:02:31', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (10, 'Sergio Andres', 'sergio_an94@hotmail.com_delete10', '$2y$10$wmHiAX9AAdPlEDV2oACnHuCZh2VhKoyXjwWajP58Rk66zFv9P/bPi', 'Tecnico', 1, NULL, NULL, '2021-06-17 18:58:07', '2021-06-26 14:13:52', '2021-06-26 14:13:52', NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (11, 'vanessa', 'vanesa@gmail.com', '$2y$10$uvp4AU1s.UZntJai9p2X1uLgXAAHZgw2f.4yMLYTmjo7Uz2UWa54K', 'Administrador Principal', 1, NULL, NULL, '2021-06-22 17:17:41', '2021-06-22 17:17:41', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (12, 'homtall', 'dairotest@yopmail.com', '$2y$10$.sS2Qpqj9Q8Dtmo9/LIXX.9JZecX2JFzN0fAOWRuTxOCU5U4fBWrq', 'Administrador Principal', 1, NULL, '2021-06-24 23:13:15', '2021-06-24 23:12:32', '2021-06-24 23:13:15', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (13, 'wfab', 'wilver06w@hotmail.com', '$2y$10$XL2hNesOY4//fj5OR1/Oi.MhqPnXuWZbdLg973fTqSI/2v1LLUjtW', 'Administrador Principal', 1, NULL, '2021-06-26 09:54:39', '2021-06-26 09:54:09', '2021-06-26 21:07:51', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (14, 'Wilver', 'wilverfabian.06@gmail.com', '$2y$10$evvgUOQ0nMtx.5o9j0P5DetEa9cLiQUQSwhXZGMiFcocXK9NdoP.q', 'Tecnico', 1, NULL, '2021-06-26 10:00:50', '2021-06-26 09:59:46', '2021-06-26 21:42:00', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (16, 'negro', 'negro@yopmail.com_delete', '$2y$10$4uRV6GUtEdmnaULhzvlKDO9pCHhopT4w02txGpquTX9WJWfRnyLaW', 'Tecnico', 1, NULL, '2021-06-26 14:25:05', '2021-06-26 14:25:05', '2021-06-30 15:21:11', '2021-06-30 15:21:11', NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (17, 'Andrés Felipe Gamboa Torres', 'andresfdgt@unicesar.edu.co', '$2y$10$H97gSD42wnOk7DlKd.7H4./nQb2KShlwNV1ijEg2wOwKb/TTE2OBa', 'Administrador Principal', 1, NULL, '2021-06-30 15:27:49', '2021-06-30 15:27:49', '2021-06-30 15:27:58', '2021-06-30 15:27:58', NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (18, 'Aurelio Ardila', 'aurelio@gmail.com', '$2y$10$GOkBRn9arnvCilLLocUAW.vqhb1nKHBEnbFEH1UFXxLXuljRldbNG', 'Tecnico', 1, NULL, '2021-07-01 18:15:11', '2021-07-01 18:15:11', '2021-07-01 18:15:11', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (19, 'arley', 'arleydoquin@gmail.com', '$2y$10$C3JOlwf1AGxZlcLxn2LPUuxaQJlTpdL92DQzq67I8vfdhLZQ4dkQq', 'Caja', 1, 'xGFybPDiJRZujeMdXSZtpBsWi5dTQQOYX9L6xjJYqy1giAUUqSVA9ZJlXHwN', '2021-08-18 10:18:29', '2021-08-18 10:18:29', '2021-08-18 10:18:29', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (20, 'JOSE CLARO ECHEVERRY', 'joseclar_@hotmail.com', '$2y$10$MYvru85IGLIJYjOFopihHekCHxLz1kYyage4HLiY4DNeg6ilIRQ3.', 'Tecnico', 1, NULL, '2021-08-19 08:53:31', '2021-08-19 08:53:31', '2021-08-19 08:53:31', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (21, 'perinvento', 'perinvento@gmail.com', '$2y$10$jJ5erI/5fR5I7uY75ZfN6.M7LkrWKA8i3HPpuzt6NJg54M1u47e02', 'Administrador Principal', 1, NULL, '2021-08-22 13:24:31', '2021-08-22 13:23:38', '2021-08-22 13:24:31', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (22, 'ingeniero', 'ingeniero@gmail.com', '$2y$10$8.lM1EpW3QHhDZSZB2.VeeqZ/0vgiStRbyBPlei1rKCFUO0l5C9s.', 'master', 1, NULL, NULL, '2022-02-15 16:31:52', '2022-02-15 16:31:52', NULL, '2022-03-06 10:08:54', '172.18.0.1');
INSERT INTO `usuarios_admin` VALUES (23, 'prueba cliente', 'pruebacliente@gmail.com', '$2y$10$53tiDX5t61ApQ1IzuReU.OGmJa2EFPOGN2xxv6wexuXbw37XrW1R6', 'master', 1, NULL, NULL, '2022-03-07 12:50:12', '2022-03-07 12:50:12', NULL, '2022-03-16 22:17:05', '127.0.0.1');
INSERT INTO `usuarios_admin` VALUES (25, 'usuariko de prueba 2', 'pruebaclienteempresa2@gmail.com', '$2y$10$53tiDX5t61ApQ1IzuReU.OGmJa2EFPOGN2xxv6wexuXbw37XrW1R6', 'otro', 1, NULL, '2022-03-12 19:43:24', '2022-03-12 19:43:24', '2022-03-16 13:03:16', NULL, '2022-03-16 18:59:12', '127.0.0.1');
INSERT INTO `usuarios_admin` VALUES (26, 'pruebapruebas', 'pruebaprueba@gmail.com', '$2y$10$TeDxmqWHyXB8vavxhZ6VHOuN.ZlU16DY2I5/lwkqeXpdkTX7UflYe', 'otro', 1, NULL, '2022-03-13 13:32:21', '2022-03-13 13:32:21', '2022-03-13 13:56:41', NULL, NULL, NULL);
INSERT INTO `usuarios_admin` VALUES (27, 'andrés felipe gamboa torres', 'andresfdgt@outlook.com', '$2y$10$pJLDon70/uL.hClQ2GtJ6ecfwEqXB7wUerUFywsiP9LqCK6gH7HoK', 'master', 1, NULL, NULL, '2022-03-14 21:02:38', '2022-03-14 21:02:38', NULL, '2022-03-14 21:03:09', '172.18.0.1');

-- ----------------------------
-- Table structure for usuarios_empresas
-- ----------------------------
DROP TABLE IF EXISTS `usuarios_empresas`;
CREATE TABLE `usuarios_empresas`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` smallint(5) UNSIGNED NOT NULL,
  `empresa_id` smallint(5) UNSIGNED NOT NULL,
  `rol_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuarios_empresas
-- ----------------------------
INSERT INTO `usuarios_empresas` VALUES (1, 23, 11, 0);
INSERT INTO `usuarios_empresas` VALUES (2, 23, 15, 0);
INSERT INTO `usuarios_empresas` VALUES (3, 23, 16, 0);
INSERT INTO `usuarios_empresas` VALUES (6, 17, 17, 1);
INSERT INTO `usuarios_empresas` VALUES (7, 27, 19, 1);
INSERT INTO `usuarios_empresas` VALUES (8, 28, 22, 0);
INSERT INTO `usuarios_empresas` VALUES (11, 25, 11, 3);

-- ----------------------------
-- Procedure structure for nueva_base_datos
-- ----------------------------
DROP PROCEDURE IF EXISTS `nueva_base_datos`;
delimiter ;;
CREATE PROCEDURE `nueva_base_datos`(IN `nombre_db` CHAR(45))
BEGIN
declare db_name CHAR(45);
SET db_name = nombre_db;

	SET @s = CONCAT('CREATE DATABASE IF NOT EXISTS db_', db_name);
	PREPARE stmt_create FROM @s;
	EXECUTE stmt_create; 
	
		SET @sql1 = CONCAT('CREATE TABLE IF NOT EXISTS db_', db_name,'.' ,' ingredientes  (
 id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
 nombre text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 precio_base decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0,
 registro_sanitario text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 elaborado_por text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 fecha_ultima_revision date NULL DEFAULT NULL,
 imagen text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 created_at datetime(0) NULL DEFAULT NULL,
 updated_at datetime(0) NULL DEFAULT NULL,
 deleted_at datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (id) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Dynamic;');
PREPARE f FROM @sql1; 
EXECUTE f;

	SET @sql1 = CONCAT('CREATE TABLE IF NOT EXISTS db_', db_name,'.' ,'  ingredientes_atributos  (
  id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  azucares tinyint(3) UNSIGNED NULL DEFAULT 0,
  materia_grasa_lactea tinyint(3) UNSIGNED NULL DEFAULT 0,
  materia_grasa_no_lactea tinyint(3) UNSIGNED NULL DEFAULT 0,
  solidos_no_grasos_de_la_leche decimal(5, 2) UNSIGNED NULL DEFAULT 0,
  otros_solidos tinyint(3) UNSIGNED NULL DEFAULT 0,
  proteinas_lacteas tinyint(3) UNSIGNED NULL DEFAULT 0,
  lactosa tinyint(3) UNSIGNED NULL DEFAULT 0,
  poder_anticongelante tinyint(3) UNSIGNED NULL DEFAULT 0,
  dulzor_relativo tinyint(3) UNSIGNED NULL DEFAULT 0,
  peso_molecular_azucares tinyint(3) UNSIGNED NULL DEFAULT 0,
  altramuces bit(1) NULL DEFAULT NULL,
  apio bit(1) NULL DEFAULT NULL,
  cacahuetes bit(1) NULL DEFAULT NULL,
  crustaceos bit(1) NULL DEFAULT NULL,
  frutos_secos bit(1) NULL DEFAULT NULL,
  gluten bit(1) NULL DEFAULT NULL,
  huevos bit(1) NULL DEFAULT NULL,
  leche bit(1) NULL DEFAULT NULL,
  moluscos bit(1) NULL DEFAULT NULL,
  mostaza bit(1) NULL DEFAULT NULL,
  pescado bit(1) NULL DEFAULT NULL,
  sesamo bit(1) NULL DEFAULT NULL,
  soya bit(1) NULL DEFAULT NULL,
  sulfitos bit(1) NULL DEFAULT NULL,
  humedad tinyint(3) UNSIGNED NULL DEFAULT 0,
  parte_seca decimal(5, 2) NULL DEFAULT 0,
  volumen_especifico tinyint(3) UNSIGNED NULL DEFAULT 0,
  orden_pasteurizacion tinyint(3) UNSIGNED NULL DEFAULT 0,
  alcohol tinyint(3) UNSIGNED NULL DEFAULT 0,
  energia_kcal tinyint(3) UNSIGNED NULL DEFAULT 0,
  energia_kj decimal(5, 3) NULL DEFAULT 0,
  grasas tinyint(3) UNSIGNED NULL DEFAULT 0,
  grasa_saturadas tinyint(3) UNSIGNED NULL DEFAULT 0,
  hidratos_de_carbono tinyint(3) UNSIGNED NULL DEFAULT 0,
  hidratos_de_carbono_azucares tinyint(3) UNSIGNED NULL DEFAULT 0,
  fibras tinyint(3) UNSIGNED NULL DEFAULT 0,
  proteinas tinyint(3) UNSIGNED NULL DEFAULT 0,
  sales tinyint(3) UNSIGNED NULL DEFAULT 0,
  ingrediente_id smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (id) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;');
PREPARE f FROM @sql1; 
EXECUTE f;

	SET @sql1 = CONCAT('CREATE TABLE IF NOT EXISTS db_', db_name,'.' ,' ingredientes_datos_generales  (
 id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
 observacion text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 descripcion_resumida text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 descripcion_adicional text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 anotaciones text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 proceso_de_elaboracion text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 envasado text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 etiquetado text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 almacenamiento_ubicacion text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 forma_uso text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 vida_util text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 poblacion_destino text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
 ingrediente_id smallint(5) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (id) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Dynamic;');
PREPARE f FROM @sql1; 
EXECUTE f;

SET @sql1 = CONCAT('CREATE TABLE IF NOT EXISTS db_', db_name,'.' ,' recetas  (
  id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
	visualizar tinyint(1) UNSIGNED NULL DEFAULT 0,
  created_at datetime(0) NULL DEFAULT NULL,
  updated_at datetime(0) NULL DEFAULT NULL,
  deleted_at datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (id) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Dynamic;');
PREPARE f FROM @sql1; 
EXECUTE f;

SET @sql1 = CONCAT('CREATE TABLE IF NOT EXISTS db_', db_name,'.' ,' equ_recetas_versiones  (
  id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  peso_deseado decimal(10, 2) NULL DEFAULT 0,
  receta_id smallint(5) UNSIGNED NOT NULL,
  created_at datetime(0) NULL DEFAULT NULL,
  updated_at datetime(0) NULL DEFAULT NULL,
  deleted_at datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (id) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Dynamic;');
PREPARE f FROM @sql1; 
EXECUTE f;

SET @sql1 = CONCAT('CREATE TABLE IF NOT EXISTS db_', db_name,'.' ,' equ_recetas_versiones_ingredientes  (
  id mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  ingrediente_id smallint(5) UNSIGNED NOT NULL,
  receta_version_id smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (id) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Dynamic;');
PREPARE f FROM @sql1; 
EXECUTE f;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
