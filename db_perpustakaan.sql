/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : db_perpustakaan

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2013-02-28 13:51:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_anggota`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_anggota`;
CREATE TABLE `tbl_anggota` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(140) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `foto` varchar(140) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_anggota
-- ----------------------------
INSERT INTO `tbl_anggota` VALUES ('94K00001', 'Khoirul Anam', '1994-01-21', 'Jln. Sultan Agung Ponorogo', '3042830473', '94K00001-IMG_9598.JPG');
INSERT INTO `tbl_anggota` VALUES ('94R00001', 'Redig Wijaya', '1994-02-20', 'Babadan Ponorogo', '3424324233243', '94R00001-IMG_9606.JPG');
INSERT INTO `tbl_anggota` VALUES ('95R00001', 'Resti Indarrapi', '0000-00-00', 'Ngrayun', '093248234834', '95R00001-IMG_9627.JPG');
INSERT INTO `tbl_anggota` VALUES ('93R00001', 'Ratrining Handayani', '1993-02-20', 'Jln. Mangunkusumo', '028322132132', '93R00001-IMG_9631.JPG');
INSERT INTO `tbl_anggota` VALUES ('95M00001', 'Mudhofar Mustofa', '1995-01-04', 'Jln. Hamengkubowono', '0834327434', '95M00001-IMG_9610.JPG');
INSERT INTO `tbl_anggota` VALUES ('94S00001', 'Saya', '1994-02-02', 'dfdf', '2543252', '94S00001-IMG_9598.JPG');

-- ----------------------------
-- Table structure for `tbl_buku`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_buku`;
CREATE TABLE `tbl_buku` (
  `kode` varchar(10) NOT NULL,
  `kode_kategori` varchar(10) NOT NULL,
  `kode_penerbit` varchar(10) NOT NULL,
  `judul` varchar(70) NOT NULL,
  `jumhal` int(4) NOT NULL,
  `pengarang` varchar(40) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kondisi` int(1) NOT NULL,
  `foto` varchar(140) NOT NULL,
  PRIMARY KEY (`kode`),
  KEY `kode_kategori` (`kode_kategori`),
  KEY `kode_penerbit` (`kode_penerbit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_buku
-- ----------------------------
INSERT INTO `tbl_buku` VALUES ('SO0001GRA', 'SO', 'GRA', '100 Cara Mempengaruhi Orang', '120', 'J. Robert', '2005', 'Sebuah buku tentang cara menpengaruhi orang di depan anda', '1', 'SO0001GRA-100 Cara Mudah Mempengaruhi Orang Dan Mendapatkan Apa Pun Ya.jpg');
INSERT INTO `tbl_buku` VALUES ('HU0001GGM', 'HU', 'GGM', 'Gaya Sackdress Jawa Timur', '200', 'Threes Emir', '2008', 'ldsjlsajdlas sdsjdl', '2', 'HU0001GGM-20120605090039_Gaya Big Size Batik Jawa Timur.jpg');
INSERT INTO `tbl_buku` VALUES ('KO0001GRA', 'KO', 'GRA', '1 Menit Belajar Ms. Word', '201', 'BJ. Annah', '2010', 'ljdlsjdljlslk', '1', 'KO0001GRA-20120605090202_1 Menit Belajar MS Word [Buku Bestseller].jpg');
INSERT INTO `tbl_buku` VALUES ('KO0001GGM', 'KO', 'GGM', 'Rahasia Fungsi Excel', '120', 'Shakti Nugraha', '2008', 'mssdlklsf', '1', 'KO0001GGM-20120605090353_Rahasia Fungsi Excel 2007 & 2010.jpg');
INSERT INTO `tbl_buku` VALUES ('KO0002GRA', 'KO', 'GRA', '1 Menit Belajar Presentasi Power Point', '200', 'Anggit Bahana', '0000', 'ndaknds', '1', 'KO0002GRA-20120605090257_1 Menit Belajar Presentasi yang Memikat denga.jpg');
INSERT INTO `tbl_buku` VALUES ('TU0001DVP', 'TU', 'DVP', 'Cara Memasak Ayam Goreng', '32', 'Chef Rudi', '2001', 'lsdjlksd', '3', 'TU0001DVP-20120605134854_Resep Masakan Indonesia Favorit Ayam Goreng.jpg');
INSERT INTO `tbl_buku` VALUES ('AG0001ERL', 'AG', 'ERL', 'Hidup Senang Mati Tentram', '57', 'Abraham', '2000', 'skljds', '2', 'AG0001ERL-BK_20120604032049.jpg');
INSERT INTO `tbl_buku` VALUES ('HU0002GGM', 'HU', 'GGM', 'Doraemon', '12', 'Shinichi', '1994', 'sdfdsfsdf', '1', 'HU0002GGM-0006-1.jpg');
INSERT INTO `tbl_buku` VALUES ('RE0001ERL', 'RE', 'ERL', 'Lari-lari pagi', '200', 'Bendol', '1994', 'fadffs', '1', 'RE0001ERL-Cover Novel Dunia Trisa.jpg');

-- ----------------------------
-- Table structure for `tbl_detail_peminjaman`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_detail_peminjaman`;
CREATE TABLE `tbl_detail_peminjaman` (
  `kode_peminjaman` varchar(10) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` double NOT NULL,
  `status` tinyint(1) NOT NULL,
  KEY `tbl_detail_peminjaman_ibfk_1` (`kode_buku`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_detail_peminjaman
-- ----------------------------
INSERT INTO `tbl_detail_peminjaman` VALUES ('39', 'SO0001GRA', '0000-00-00', '0', '1');
INSERT INTO `tbl_detail_peminjaman` VALUES ('38', 'KO0001GRA', '2013-02-28', '0', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('38', 'SO0001GRA', '2013-02-28', '0', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('37', 'KO0002GRA', '2013-02-28', '5000', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('37', 'HU0001GGM', '2013-02-28', '5000', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('34', 'SO0001GRA', '2013-02-28', '3500', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('34', 'HU0001GGM', '2013-02-28', '3500', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('35', 'KO0002GRA', '2013-02-28', '0', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('35', 'KO0001GGM', '2013-02-28', '0', '0');
INSERT INTO `tbl_detail_peminjaman` VALUES ('36', 'HU0002GGM', '0000-00-00', '0', '1');
INSERT INTO `tbl_detail_peminjaman` VALUES ('39', 'HU0001GGM', '0000-00-00', '0', '1');

-- ----------------------------
-- Table structure for `tbl_kartu_pendaftaran`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kartu_pendaftaran`;
CREATE TABLE `tbl_kartu_pendaftaran` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_petugas` varchar(10) NOT NULL,
  `kode_anggota` varchar(10) NOT NULL,
  `tanggal_pembuatan` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_petugas` (`kode_petugas`),
  KEY `kode_anggota` (`kode_anggota`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_kartu_pendaftaran
-- ----------------------------
INSERT INTO `tbl_kartu_pendaftaran` VALUES ('16', 'admin', '94K00001', '2013-02-28', '2014-02-23', '1');
INSERT INTO `tbl_kartu_pendaftaran` VALUES ('17', 'admin', '94R00001', '2013-02-28', '2014-02-23', '1');
INSERT INTO `tbl_kartu_pendaftaran` VALUES ('18', 'admin', '95R00001', '2013-02-28', '2014-02-23', '1');
INSERT INTO `tbl_kartu_pendaftaran` VALUES ('19', 'admin', '93R00001', '2013-02-28', '2014-02-23', '1');
INSERT INTO `tbl_kartu_pendaftaran` VALUES ('20', 'admin', '95M00001', '2013-02-28', '2014-02-23', '1');
INSERT INTO `tbl_kartu_pendaftaran` VALUES ('21', 'admin', '94S00001', '2013-02-28', '2014-02-23', '1');

-- ----------------------------
-- Table structure for `tbl_kategori`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kategori`;
CREATE TABLE `tbl_kategori` (
  `kode` varchar(2) NOT NULL,
  `nama` varchar(28) NOT NULL,
  `keterangan` varchar(140) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_kategori
-- ----------------------------
INSERT INTO `tbl_kategori` VALUES ('HU', 'Humor', 'Buku buku lucu');
INSERT INTO `tbl_kategori` VALUES ('NO', 'Novel', 'Buku buku Novel');
INSERT INTO `tbl_kategori` VALUES ('RE', 'Referensi', 'Buku buku Referensi\r\n');
INSERT INTO `tbl_kategori` VALUES ('SA', 'Sains', 'Buku-buku Pengetahuan alam');
INSERT INTO `tbl_kategori` VALUES ('SO', 'Sosial', 'Buku buku Pengetahuan Umum');
INSERT INTO `tbl_kategori` VALUES ('AG', 'Agama', 'Buku buku pelajaran Agama');
INSERT INTO `tbl_kategori` VALUES ('KO', 'Komputer', 'Buku-buku tentang pengetahuan Komputer');
INSERT INTO `tbl_kategori` VALUES ('TU', 'Tutorial', 'Cara-cara');

-- ----------------------------
-- Table structure for `tbl_log_petugas`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_log_petugas`;
CREATE TABLE `tbl_log_petugas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `log` varchar(240) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_log_petugas
-- ----------------------------
INSERT INTO `tbl_log_petugas` VALUES ('7', 'Administrator memperbarui data petugas Rifqi Nashiruddin', '2013-02-25 22:18:43');
INSERT INTO `tbl_log_petugas` VALUES ('8', 'Administrator memperbarui data petugas Rifqi Nashiruddin', '2013-02-25 22:19:08');
INSERT INTO `tbl_log_petugas` VALUES ('9', 'Administrator memperbarui data petugas Rifqi Nashiruddin', '2013-02-25 22:20:05');
INSERT INTO `tbl_log_petugas` VALUES ('10', 'Administrator memperbarui data petugas Rifqi Nashiruddin', '2013-02-25 22:20:12');
INSERT INTO `tbl_log_petugas` VALUES ('11', 'Administrator menghapus petugas Rifqi Nashiruddin', '2013-02-25 22:20:58');
INSERT INTO `tbl_log_petugas` VALUES ('12', 'Administrator memperbarui data kategori Novela', '2013-02-25 22:44:52');
INSERT INTO `tbl_log_petugas` VALUES ('13', 'Administrator memperbarui data kategori Humor', '2013-02-25 22:45:52');
INSERT INTO `tbl_log_petugas` VALUES ('14', 'Administrator memperbarui data kategori Novel', '2013-02-25 22:46:35');
INSERT INTO `tbl_log_petugas` VALUES ('15', 'Administrator memperbarui data kategori Referensi', '2013-02-25 22:48:00');
INSERT INTO `tbl_log_petugas` VALUES ('16', 'Administrator memperbarui data kategori Humor', '2013-02-25 22:48:26');
INSERT INTO `tbl_log_petugas` VALUES ('17', 'Administrator memperbarui data kategori Sains', '2013-02-25 22:49:10');
INSERT INTO `tbl_log_petugas` VALUES ('18', 'Administrator memperbarui data kategori Novela', '2013-02-25 22:49:22');
INSERT INTO `tbl_log_petugas` VALUES ('19', 'Administrator memperbarui data kategori Novela', '2013-02-25 22:50:00');
INSERT INTO `tbl_log_petugas` VALUES ('20', 'Administrator menghapus kategori saya', '2013-02-25 22:55:32');
INSERT INTO `tbl_log_petugas` VALUES ('21', 'Administrator memperbarui kategori Sosial', '2013-02-25 22:58:54');
INSERT INTO `tbl_log_petugas` VALUES ('22', 'Administrator menghapus kategori fdsff', '2013-02-25 22:59:15');
INSERT INTO `tbl_log_petugas` VALUES ('23', 'Administrator menambahkan penerbit baru Cibaduyut Broad Center', '2013-02-25 23:09:30');
INSERT INTO `tbl_log_petugas` VALUES ('24', 'Administrator menambahkan penerbit baru Tiga Serangkai', '2013-02-25 23:11:36');
INSERT INTO `tbl_log_petugas` VALUES ('25', 'Administrator menambahkan penerbit baru sdf', '2013-02-25 23:12:20');
INSERT INTO `tbl_log_petugas` VALUES ('26', 'Administrator menghapus penerbit sdf', '2013-02-25 23:12:26');
INSERT INTO `tbl_log_petugas` VALUES ('27', 'Administrator memperbarui penerbit Cibaduyut Brick Center', '2013-02-25 23:16:51');
INSERT INTO `tbl_log_petugas` VALUES ('28', 'Administrator menghapus kategori lksdkjksl', '2013-02-26 20:30:15');
INSERT INTO `tbl_log_petugas` VALUES ('29', 'Administrator menghapus penerbit Cibaduyut Brick Center', '2013-02-26 20:31:18');
INSERT INTO `tbl_log_petugas` VALUES ('30', 'Administrator menambahkan penerbit baru Erlangga', '2013-02-26 20:31:59');
INSERT INTO `tbl_log_petugas` VALUES ('31', 'Administrator menambahkan penerbit baru Gramedia', '2013-02-26 20:33:52');
INSERT INTO `tbl_log_petugas` VALUES ('32', 'Administrator menambahkan penerbit baru Gagas Media', '2013-02-26 20:34:32');
INSERT INTO `tbl_log_petugas` VALUES ('33', 'Administrator memperbarui penerbit Gagas Media', '2013-02-26 20:34:59');
INSERT INTO `tbl_log_petugas` VALUES ('34', 'Administrator menambahkan penerbit baru Diva Press', '2013-02-26 20:36:17');
INSERT INTO `tbl_log_petugas` VALUES ('35', 'Administrator menghapus buku ', '2013-02-26 20:58:52');
INSERT INTO `tbl_log_petugas` VALUES ('36', 'Administrator menghapus buku sdlk', '2013-02-26 21:00:05');
INSERT INTO `tbl_log_petugas` VALUES ('37', 'Administrator menghapus buku 10 Cara Mudah Mempengaruhi Orang', '2013-02-26 21:00:49');
INSERT INTO `tbl_log_petugas` VALUES ('38', 'Administrator menghapus buku Cara Memasak Ayam Goreng', '2013-02-26 21:00:56');
INSERT INTO `tbl_log_petugas` VALUES ('39', 'Administrator menghapus anggota ', '2013-02-26 23:51:26');
INSERT INTO `tbl_log_petugas` VALUES ('40', 'Administrator menghapus anggota Oky Brilian', '2013-02-26 23:51:47');
INSERT INTO `tbl_log_petugas` VALUES ('41', 'Administrator menghapus anggota Sakti Nugraha', '2013-02-26 23:52:48');
INSERT INTO `tbl_log_petugas` VALUES ('42', 'Administrator menghapus anggota ', '2013-02-26 23:54:16');
INSERT INTO `tbl_log_petugas` VALUES ('43', 'Administrator menghapus anggota sd', '2013-02-26 23:57:34');
INSERT INTO `tbl_log_petugas` VALUES ('44', 'Administrator menghapus anggota ksmfd', '2013-02-26 23:58:25');
INSERT INTO `tbl_log_petugas` VALUES ('45', 'Administrator memperpanjang masa aktif anggota ', '2013-02-27 01:01:32');
INSERT INTO `tbl_log_petugas` VALUES ('46', 'Administrator memperpanjang masa aktif anggota Rizka Amalinda', '2013-02-27 01:02:15');
INSERT INTO `tbl_log_petugas` VALUES ('47', 'Administrator memperpanjang masa aktif anggota Yonathan Christianto', '2013-02-27 01:02:57');
INSERT INTO `tbl_log_petugas` VALUES ('48', 'Administrator memperpanjang masa aktif anggota Yonathan Christianto', '2013-02-27 16:23:08');
INSERT INTO `tbl_log_petugas` VALUES ('49', 'Administrator memperpanjang masa aktif anggota Yonathan Christianto', '2013-02-27 16:24:43');
INSERT INTO `tbl_log_petugas` VALUES ('50', 'Administrator memperpanjang masa aktif anggota Yonathan Christianto', '2013-02-27 16:25:28');
INSERT INTO `tbl_log_petugas` VALUES ('51', 'Administrator memperpanjang masa aktif anggota Yonathan Christianto', '2013-02-27 16:25:41');
INSERT INTO `tbl_log_petugas` VALUES ('52', 'Administrator memperpanjang masa aktif anggota Yonathan Christianto', '2013-02-27 16:45:39');
INSERT INTO `tbl_log_petugas` VALUES ('53', 'Administrator memperpanjang masa aktif anggota Yonathan Christianto', '2013-02-27 16:51:11');
INSERT INTO `tbl_log_petugas` VALUES ('54', 'Administrator membatalkan peminjaman bernomor 8', '2013-02-27 23:37:34');
INSERT INTO `tbl_log_petugas` VALUES ('55', 'Administrator membatalkan peminjaman bernomor 9', '2013-02-27 23:37:43');
INSERT INTO `tbl_log_petugas` VALUES ('56', 'Administrator membatalkan peminjaman bernomor 10', '2013-02-27 23:37:45');
INSERT INTO `tbl_log_petugas` VALUES ('57', 'Administrator membatalkan peminjaman bernomor 11', '2013-02-27 23:37:46');
INSERT INTO `tbl_log_petugas` VALUES ('58', 'Administrator membatalkan peminjaman bernomor 12', '2013-02-27 23:37:47');
INSERT INTO `tbl_log_petugas` VALUES ('59', 'Administrator membatalkan peminjaman bernomor 13', '2013-02-27 23:37:48');
INSERT INTO `tbl_log_petugas` VALUES ('60', 'Administrator membatalkan peminjaman bernomor 14', '2013-02-27 23:37:49');
INSERT INTO `tbl_log_petugas` VALUES ('61', 'Administrator menambahkan Wahyu Novita sebagai petugas', '2013-02-28 03:49:09');
INSERT INTO `tbl_log_petugas` VALUES ('62', 'Administrator memperbarui data petugas Wahyu Novita', '2013-02-28 03:49:17');
INSERT INTO `tbl_log_petugas` VALUES ('63', 'Administrator menghapus petugas Wahyu Novita', '2013-02-28 03:49:23');
INSERT INTO `tbl_log_petugas` VALUES ('64', 'Administrator menghapus anggota Priyan Budi Utomo', '2013-02-28 07:08:51');
INSERT INTO `tbl_log_petugas` VALUES ('65', 'Administrator menghapus anggota Kunia Rahmawati', '2013-02-28 07:13:04');
INSERT INTO `tbl_log_petugas` VALUES ('66', 'Administrator menghapus anggota ', '2013-02-28 07:13:06');
INSERT INTO `tbl_log_petugas` VALUES ('67', 'Administrator menghapus anggota fgdsg', '2013-02-28 07:15:27');
INSERT INTO `tbl_log_petugas` VALUES ('68', 'Administrator menghapus anggota ', '2013-02-28 07:15:28');
INSERT INTO `tbl_log_petugas` VALUES ('69', 'Administrator menghapus anggota ', '2013-02-28 07:15:31');
INSERT INTO `tbl_log_petugas` VALUES ('70', 'Administrator menghapus anggota rifqi', '2013-02-28 07:17:32');
INSERT INTO `tbl_log_petugas` VALUES ('71', 'Administrator membatalkan peminjaman bernomor 20', '2013-02-28 07:18:13');
INSERT INTO `tbl_log_petugas` VALUES ('72', 'Administrator membatalkan peminjaman bernomor 18', '2013-02-28 07:19:07');
INSERT INTO `tbl_log_petugas` VALUES ('73', 'Administrator membatalkan peminjaman bernomor 19', '2013-02-28 07:19:13');
INSERT INTO `tbl_log_petugas` VALUES ('74', 'Administrator membatalkan peminjaman bernomor 15', '2013-02-28 07:19:21');
INSERT INTO `tbl_log_petugas` VALUES ('75', 'Administrator menambahkah Yogi Nu Cahyono sebagai anggota', '2013-02-28 07:59:01');
INSERT INTO `tbl_log_petugas` VALUES ('76', 'Administrator memperbarui data anggota Salaman Gress Mandot', '2013-02-28 08:02:48');
INSERT INTO `tbl_log_petugas` VALUES ('77', 'Administrator memperbarui data anggota Salman Gress Mandot', '2013-02-28 08:03:19');
INSERT INTO `tbl_log_petugas` VALUES ('78', 'Administrator meminjamkan 4 buku kepada ', '2013-02-28 08:14:26');
INSERT INTO `tbl_log_petugas` VALUES ('79', 'Administrator meminjamkan 4 buku kepada ', '2013-02-28 08:14:27');
INSERT INTO `tbl_log_petugas` VALUES ('80', 'Administrator membatalkan peminjaman bernomor 25', '2013-02-28 08:17:31');
INSERT INTO `tbl_log_petugas` VALUES ('81', 'Administrator membatalkan peminjaman bernomor 24', '2013-02-28 08:17:35');
INSERT INTO `tbl_log_petugas` VALUES ('82', 'Administrator membatalkan peminjaman bernomor 23', '2013-02-28 08:18:23');
INSERT INTO `tbl_log_petugas` VALUES ('83', 'Administrator menambahkah Khoirul Anam sebagai anggota', '2013-02-28 08:24:52');
INSERT INTO `tbl_log_petugas` VALUES ('84', 'Administrator menambahkah Redig Wijaya sebagai anggota', '2013-02-28 08:25:19');
INSERT INTO `tbl_log_petugas` VALUES ('85', 'Administrator menambahkah Resti Indarrapi sebagai anggota', '2013-02-28 08:26:00');
INSERT INTO `tbl_log_petugas` VALUES ('86', 'Administrator menambahkah Ratrining Handayani sebagai anggota', '2013-02-28 08:26:48');
INSERT INTO `tbl_log_petugas` VALUES ('87', 'Administrator menambahkah Mudhofar Mustofa sebagai anggota', '2013-02-28 08:27:31');
INSERT INTO `tbl_log_petugas` VALUES ('88', 'Administrator membatalkan peminjaman bernomor 30', '2013-02-28 08:29:19');
INSERT INTO `tbl_log_petugas` VALUES ('89', 'Administrator membatalkan peminjaman bernomor 31', '2013-02-28 08:37:21');
INSERT INTO `tbl_log_petugas` VALUES ('90', 'Administrator membatalkan peminjaman bernomor 32', '2013-02-28 08:37:23');
INSERT INTO `tbl_log_petugas` VALUES ('91', 'Administrator membatalkan peminjaman bernomor 33', '2013-02-28 08:37:25');
INSERT INTO `tbl_log_petugas` VALUES ('92', 'Administrator menambahkah Saya sebagai anggota', '2013-02-28 12:07:11');

-- ----------------------------
-- Table structure for `tbl_peminjaman`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_peminjaman`;
CREATE TABLE `tbl_peminjaman` (
  `kode` int(10) NOT NULL AUTO_INCREMENT,
  `kode_petugas` varchar(10) NOT NULL,
  `kode_anggota` varchar(10) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_harus_kembali` date NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_peminjaman
-- ----------------------------
INSERT INTO `tbl_peminjaman` VALUES ('39', 'admin', '94K00001', '2013-02-28', '2013-03-14');
INSERT INTO `tbl_peminjaman` VALUES ('34', 'admin', '94K00001', '2013-02-07', '2013-02-21');
INSERT INTO `tbl_peminjaman` VALUES ('35', 'admin', '94R00001', '2013-02-21', '2013-03-07');
INSERT INTO `tbl_peminjaman` VALUES ('36', 'admin', '94K00001', '2013-02-28', '2013-03-14');
INSERT INTO `tbl_peminjaman` VALUES ('37', 'admin', '95M00001', '2013-02-04', '2013-02-18');
INSERT INTO `tbl_peminjaman` VALUES ('38', 'admin', '94K00001', '2013-02-28', '2013-03-14');

-- ----------------------------
-- Table structure for `tbl_penerbit`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penerbit`;
CREATE TABLE `tbl_penerbit` (
  `kode` varchar(3) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(70) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `email` varchar(28) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_penerbit
-- ----------------------------
INSERT INTO `tbl_penerbit` VALUES ('ERL', 'Erlangga', 'Jln. Gadjah Mada 25 A Jakarta Barat', '02182737287', 'info@erlangga.com');
INSERT INTO `tbl_penerbit` VALUES ('TSR', 'Tiga Serangkai', 'Jln. 2 Rangkai Surakarta', '02938289382083', '3serangkai@ymail.com');
INSERT INTO `tbl_penerbit` VALUES ('GRA', 'Gramedia', 'Jln. Ahmad Yani No 25 Yogyakarta.', '022934349348', 'gramedia@kompas.com');
INSERT INTO `tbl_penerbit` VALUES ('GGM', 'Gagas Media', 'Jln. Soekarno Hatta 25 Surakarta', '039483208493', 'gagasmedia@ymail.com');
INSERT INTO `tbl_penerbit` VALUES ('DVP', 'Diva Press', 'Jln. Ring Road Utara No. 29 A Klaten', '021345789', 'divapress@ymail.com');

-- ----------------------------
-- Table structure for `tbl_pengaturan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pengaturan`;
CREATE TABLE `tbl_pengaturan` (
  `id` int(11) NOT NULL,
  `web_nama` varchar(42) NOT NULL,
  `web_logo` varchar(140) NOT NULL,
  `web_color` varchar(14) NOT NULL,
  `web_lamapinjam` int(3) NOT NULL,
  `web_masaaktif` int(3) NOT NULL,
  `web_denda` double(10,0) NOT NULL,
  `web_kuotapinjam` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_pengaturan
-- ----------------------------
INSERT INTO `tbl_pengaturan` VALUES ('1', 'Metro Library', 'logo-IMG_9599.JPG', '#0979C8', '14', '360', '750', '3');

-- ----------------------------
-- Table structure for `tbl_petugas`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_petugas`;
CREATE TABLE `tbl_petugas` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `keterangan` varchar(140) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'o',
  `sbuku` tinyint(1) NOT NULL,
  `spenerbit` tinyint(1) NOT NULL,
  `skategori` tinyint(1) NOT NULL,
  `sanggota` tinyint(1) NOT NULL,
  `spetugas` tinyint(1) NOT NULL,
  `speminjaman` tinyint(1) NOT NULL,
  `spengembalian` tinyint(1) NOT NULL,
  `sberita` tinyint(1) NOT NULL,
  `sslide` tinyint(1) NOT NULL,
  `spengaturan` tinyint(1) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_petugas
-- ----------------------------
INSERT INTO `tbl_petugas` VALUES ('admin', 'Administrator', '', '0cc175b9c0f1b6a831c399e269772661', 'a', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1');
INSERT INTO `tbl_petugas` VALUES ('rendra', 'Rendra Budi Hutama', 'Operator Penuh', 'bcb0195b3b8dcfd3f5656518d9063499', 'o', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `tbl_petugas` VALUES ('resti', 'Resti Indarrapi', 'Operator Master Data', '0cc175b9c0f1b6a831c399e269772661', 'o', '1', '1', '1', '1', '0', '1', '1', '0', '0', '0');
INSERT INTO `tbl_petugas` VALUES ('puji', 'Pujianto', 'Admin Content Website', '0cc175b9c0f1b6a831c399e269772661', 'o', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0');
INSERT INTO `tbl_petugas` VALUES ('ratri', 'Ratrining Handayani', 'Operator Arus Buku', '0cc175b9c0f1b6a831c399e269772661', 'o', '0', '0', '0', '0', '0', '1', '1', '0', '0', '0');
INSERT INTO `tbl_petugas` VALUES ('salman', 'Salman Abdul Aziz', 'Operator Buku', '0cc175b9c0f1b6a831c399e269772661', 'o', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `tbl_petugas` VALUES ('ridzwan', 'Ridzwan Miftahul aji', 'Operator Pendaftaran dan Data Master', '0cc175b9c0f1b6a831c399e269772661', 'o', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0');
