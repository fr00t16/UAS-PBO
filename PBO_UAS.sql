/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : tb_game

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 17/01/2021 22:23:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for log_login
-- ----------------------------
DROP TABLE IF EXISTS `log_login`;
CREATE TABLE `log_login`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(12) NOT NULL,
  `ip` varchar(17) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu` datetime(0) NOT NULL,
  `perangkat_lunak` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `perangkat_keras` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kelamin` int(3) NOT NULL DEFAULT 1,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `admin` int(12) NOT NULL DEFAULT 0,
  `tanggal_daftar` datetime(0) NOT NULL,
  `terakhir_login` datetime(0) NOT NULL,
  `ip_terakhir_login` varchar(17) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uang` int(12) NOT NULL DEFAULT 0,
  `diamond` int(12) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (14, 'admin', 'admin', 1, 'agus@gmail.com', 1, '2021-01-17 15:23:06', '2021-01-17 22:14:48', '127.0.0.1', 0, 960);

-- ----------------------------
-- Table structure for sql_voucher
-- ----------------------------
DROP TABLE IF EXISTS `sql_voucher`;
CREATE TABLE `sql_voucher`  (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `balance` int(11) NOT NULL DEFAULT 0,
  `dibuatoleh` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'n/a',
  `reedemby` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'none',
  PRIMARY KEY (`vid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
