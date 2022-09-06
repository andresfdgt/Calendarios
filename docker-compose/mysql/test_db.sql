/*
 Navicat Premium Data Transfer

 Source Server         : localhost_docker_recetas
 Source Server Type    : MySQL
 Source Server Version : 50737
 Source Host           : localhost:3037
 Source Schema         : db_ingeniero_11

 Target Server Type    : MySQL
 Target Server Version : 50737
 File Encoding         : 65001

 Date: 18/03/2022 13:21:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ingredientes
-- ----------------------------
DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE `ingredientes`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `precio_base` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `registro_sanitario` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `elaborado_por` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `fecha_ultima_revision` date NULL DEFAULT NULL,
  `imagen` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ingredientes
-- ----------------------------
INSERT INTO `ingredientes` VALUES (1, 'agua', 9.99, 'si tiene', 'cristian', '2022-02-15', NULL, '2022-02-15 17:11:38', '2022-02-17 16:56:42', '2022-02-17 16:56:42');
INSERT INTO `ingredientes` VALUES (2, 'nuevo', 150.00, 'si tiene', 'cristian', '2022-02-15', NULL, '2022-02-15 22:14:15', '2022-02-17 16:56:12', NULL);
INSERT INTO `ingredientes` VALUES (3, 'aceite de oliva', 0.00, '', '', '2017-03-01', NULL, '2022-02-22 14:13:34', '2022-03-03 20:30:22', NULL);
INSERT INTO `ingredientes` VALUES (4, 'cerveza', 0.00, '', '', '2018-09-05', NULL, '2022-02-22 14:42:31', '2022-02-28 21:49:05', NULL);
INSERT INTO `ingredientes` VALUES (5, 'chocolate blanco nepal chocovic', 0.00, '', '', NULL, NULL, '2022-02-22 14:52:17', '2022-03-03 20:40:38', NULL);
INSERT INTO `ingredientes` VALUES (6, 'clara de huevo', 0.00, '', '', NULL, NULL, '2022-02-22 15:01:12', '2022-03-03 20:28:39', NULL);
INSERT INTO `ingredientes` VALUES (7, 'turron 70%', 0.00, '', '', NULL, NULL, '2022-02-22 15:12:05', '2022-03-03 20:45:03', NULL);

-- ----------------------------
-- Table structure for ingredientes_atributos
-- ----------------------------
DROP TABLE IF EXISTS `ingredientes_atributos`;
CREATE TABLE `ingredientes_atributos`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `azucares` double NULL DEFAULT 0,
  `materia_grasa_lactea` double NULL DEFAULT 0,
  `materia_grasa_no_lactea` double NULL DEFAULT 0,
  `solidos_no_grasos_de_la_leche` double NULL DEFAULT 0,
  `otros_solidos` double NULL DEFAULT 0,
  `proteinas_lacteas` double NULL DEFAULT 0,
  `lactosa` double NULL DEFAULT 0,
  `poder_anticongelante` double NULL DEFAULT 0,
  `dulzor_relativo` double NULL DEFAULT 0,
  `peso_molecular_azucares` double NULL DEFAULT 0,
  `altramuces` bit(1) NULL DEFAULT NULL,
  `apio` bit(1) NULL DEFAULT NULL,
  `cacahuetes` bit(1) NULL DEFAULT NULL,
  `crustaceos` bit(1) NULL DEFAULT NULL,
  `frutos_secos` bit(1) NULL DEFAULT NULL,
  `gluten` bit(1) NULL DEFAULT NULL,
  `huevos` bit(1) NULL DEFAULT NULL,
  `leche` bit(1) NULL DEFAULT NULL,
  `moluscos` bit(1) NULL DEFAULT NULL,
  `mostaza` bit(1) NULL DEFAULT NULL,
  `pescado` bit(1) NULL DEFAULT NULL,
  `sesamo` bit(1) NULL DEFAULT NULL,
  `soya` bit(1) NULL DEFAULT NULL,
  `sulfitos` bit(1) NULL DEFAULT NULL,
  `humedad` double NULL DEFAULT 0,
  `parte_seca` double NULL DEFAULT 0,
  `volumen_especifico` double NULL DEFAULT 0,
  `orden_pasteurizacion` double NULL DEFAULT 0,
  `alcohol` double NULL DEFAULT 0,
  `energia_kcal` double NULL DEFAULT 0,
  `energia_kj` double NULL DEFAULT 0,
  `grasas` double NULL DEFAULT 0,
  `grasa_saturadas` double NULL DEFAULT 0,
  `hidratos_de_carbono` double NULL DEFAULT 0,
  `hidratos_de_carbono_azucares` double NULL DEFAULT 0,
  `fibras` double NULL DEFAULT 0,
  `proteinas` double NULL DEFAULT 0,
  `sales` double NULL DEFAULT 0,
  `ingrediente_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ingredientes_atributos
-- ----------------------------
INSERT INTO `ingredientes_atributos` VALUES (1, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, b'0', b'0', b'1', b'0', b'1', b'0', b'1', b'0', b'1', b'0', b'1', b'0', b'0', b'0', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 2);
INSERT INTO `ingredientes_atributos` VALUES (2, 0, 0, 100, 1, 0, 0, 0, NULL, NULL, 1, b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', 0, 101, 0, 3, 0, 899, 3763.9, 99.9, 14.3, 0, 0, 0, 1, 0, 3);
INSERT INTO `ingredientes_atributos` VALUES (3, 0.16, 0, 0, 0.5, 0, 0, 0, -0.64, 100, 342, b'0', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', 0, 0.66, 0, 4, 4.5, 42.4, 177.52, 0, 0, 3.12, 0.16, 0, 0.5, 0, 4);
INSERT INTO `ingredientes_atributos` VALUES (4, 54.8, 4, 31, 6.9, 0, 0, 0, -0.64, 79.6, 342, b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'0', b'1', b'0', 0, 96.7, 0, 3, 0, 568, 2378.1, 35.2, 21.1, 55.4, 54.8, 0, 6.9, 0.18, 5);
INSERT INTO `ingredientes_atributos` VALUES (5, 0.41, 0, 0.2, 11.12, 0, 0, 0, -0.64, 100, 342, b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', 0, 11.73, 0, 2, 0, 491, 205.57, 0.2, 0, 0.7, 0.41, 0, 11.12, 0, 6);
INSERT INTO `ingredientes_atributos` VALUES (6, 31, 0, 35.8, 15, 0, 0, 0, -0.93, 109, 270, b'0', b'0', b'0', b'0', b'1', b'0', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', 0, 81.8, 0, 3, 0, 565, 2365.5, 41, 4, 31, 31, 8, 15, 0.01, 7);
INSERT INTO `ingredientes_atributos` VALUES (7, 31, NULL, 35.8, 15, NULL, NULL, NULL, -0.93, 109, 255, b'0', b'0', b'0', b'0', b'1', b'0', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', NULL, 81.8, NULL, 3, NULL, 565, 2365.5, 41, 4, 31, 31, 8, 15, 0.01, 8);

-- ----------------------------
-- Table structure for ingredientes_datos_generales
-- ----------------------------
DROP TABLE IF EXISTS `ingredientes_datos_generales`;
CREATE TABLE `ingredientes_datos_generales`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `descripcion_resumida` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `descripcion_adicional` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `anotaciones` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `proceso_de_elaboracion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `envasado` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `etiquetado` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `almacenamiento_ubicacion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `forma_uso` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `vida_util` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `poblacion_destino` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `ingrediente_id` smallint(5) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ingredientes_datos_generales
-- ----------------------------
INSERT INTO `ingredientes_datos_generales` VALUES (1, 'una observacion', '<p>si se p&uacute;ede</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);
INSERT INTO `ingredientes_datos_generales` VALUES (2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3);
INSERT INTO `ingredientes_datos_generales` VALUES (3, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4);
INSERT INTO `ingredientes_datos_generales` VALUES (4, 'contiene cacao, vainilla, cafeina, sacarosa y fructosa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5);
INSERT INTO `ingredientes_datos_generales` VALUES (5, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6);
INSERT INTO `ingredientes_datos_generales` VALUES (6, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7);
INSERT INTO `ingredientes_datos_generales` VALUES (7, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8);

-- ----------------------------
-- Table structure for recetas
-- ----------------------------
DROP TABLE IF EXISTS `recetas`;
CREATE TABLE `recetas`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `visualizar` tinyint(1) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of recetas
-- ----------------------------
INSERT INTO `recetas` VALUES (1, 'nueva', 0, '2022-03-03 20:58:26', '2022-03-18 13:14:19', NULL);

-- ----------------------------
-- Table structure for equ_recetas_versiones
-- ----------------------------
DROP TABLE IF EXISTS `equ_recetas_versiones`;
CREATE TABLE `equ_recetas_versiones`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL,
  `peso_deseado` decimal(10, 2) NULL DEFAULT 0.00,
  `receta_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of equ_recetas_versiones
-- ----------------------------
INSERT INTO `equ_recetas_versiones` VALUES (1, 'version uno', 0.00, 1, '2022-03-03 20:58:48', '2022-03-03 20:58:48', NULL);

-- ----------------------------
-- Table structure for equ_recetas_versiones_ingredientes
-- ----------------------------
DROP TABLE IF EXISTS `equ_recetas_versiones_ingredientes`;
CREATE TABLE `equ_recetas_versiones_ingredientes`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingrediente_id` smallint(5) UNSIGNED NOT NULL,
  `receta_version_id` smallint(5) UNSIGNED NOT NULL,
  `peso` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `topping` bit(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of equ_recetas_versiones_ingredientes
-- ----------------------------
INSERT INTO `equ_recetas_versiones_ingredientes` VALUES (1, 3, 1, 1, b'0');
INSERT INTO `equ_recetas_versiones_ingredientes` VALUES (3, 4, 1, 1, b'0');

SET FOREIGN_KEY_CHECKS = 1;
