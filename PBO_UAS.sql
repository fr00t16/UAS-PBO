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

 Date: 16/01/2021 22:53:49
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
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of log_login
-- ----------------------------
INSERT INTO `log_login` VALUES (27, 13, '127.0.0.1', '2021-01-16 01:22:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'Windows (Windows 10)');
INSERT INTO `log_login` VALUES (34, 13, '192.168.43.1', '2021-01-16 14:12:12', 'Mozilla/5.0 (Linux; Android 10; RMX1911) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.96 Mobile Safari/537.36', 'Android (Android)');
INSERT INTO `log_login` VALUES (35, 13, '192.168.43.1', '2021-01-16 14:31:50', 'Mozilla/5.0 (Linux; Android 10; RMX1911) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.96 Mobile Safari/537.36', 'Android (Android)');

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (13, 'admin', 'admin', 1, 'admin@uas.com', 1, '2021-01-16 01:16:41', '2021-01-16 14:31:50', '192.168.43.1', 9999999, 9999999);

-- ----------------------------
-- Table structure for sql_voucher
-- ----------------------------
DROP TABLE IF EXISTS `sql_voucher`;
CREATE TABLE `sql_voucher`  (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(26) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT 0,
  `balance` int(11) NULL DEFAULT 0,
  `reedemby` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'none',
  PRIMARY KEY (`vid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sql_voucher
-- ----------------------------
INSERT INTO `sql_voucher` VALUES (1, 'SGB-sTxEI-TGXtN-sV5si', 0, 1590241222, 'none');
INSERT INTO `sql_voucher` VALUES (2, 'SGB-a', 0, 1590241336, 'none');
INSERT INTO `sql_voucher` VALUES (3, 'SGB-z2lXC-QcnL1-TgmaF', 0, 1590241338, 'none');
INSERT INTO `sql_voucher` VALUES (4, 'SGB-R4Xas-R51Fq-3ibrq', 0, 1590241575, 'none');
INSERT INTO `sql_voucher` VALUES (5, 'SGB-DivN0-ncehZ-lBCJJ', 1, 1590242793, 'Faizal_Rifaldy');
INSERT INTO `sql_voucher` VALUES (6, 'SGB-DpXzb-tR7ml-s5yGm', 0, 1590242989, 'none');
INSERT INTO `sql_voucher` VALUES (7, 'SGB-VSuZJ-fQgxt-jYx64', 1, 1590243473, 'Faizal_Rifaldy');
INSERT INTO `sql_voucher` VALUES (8, 'SGB-psXaD-LZmZ8-Ee', 0, 1590243558, 'none');

SET FOREIGN_KEY_CHECKS = 1;
