/*
Navicat MySQL Data Transfer

Source Server         : MyLocal
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : dantech

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2016-10-29 08:42:22
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmf_setting`
-- ----------------------------
DROP TABLE IF EXISTS `cmf_setting`;
CREATE TABLE `cmf_setting` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_setting` int(11) NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `id_setting` (`id_setting`,`nama_item`,`id_parent`,`urutan`)
) ENGINE=MyISAM AUTO_INCREMENT=12000017 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmf_setting
-- ----------------------------
INSERT INTO `cmf_setting` VALUES ('1', '1', 'nama_app', '0', '1', '{\"label\":\"Nama aplikasi\",\"nilai\":\"DanTECH\",\"tipe\":\"text\"}');
INSERT INTO `cmf_setting` VALUES ('2', '1', 'slogan_app', '0', '2', '{\"label\":\"Slogan aplikasi\",\"nilai\":\"Codeigniter Admin Panel\",\"tipe\":\"text\"}');
INSERT INTO `cmf_setting` VALUES ('3', '1', 'logo_app', '0', '3', '{\"label\":\"Logo aplikasi\",\"nilai\":\"garuda.gif\",\"tipe\":\"upload\"}');
INSERT INTO `cmf_setting` VALUES ('4', '1', 'favicon_app', '0', '4', '{\"label\":\"Favicon app\",\"nilai\":\"fav_logo.gif\",\"tipe\":\"upload\"}');
INSERT INTO `cmf_setting` VALUES ('1001', '2', 'statis', '0', '1', '{\"label\":\"Halaman Statis\"}');
INSERT INTO `cmf_setting` VALUES ('1002', '2', 'artikel', '0', '2', '{\"label\":\"Artikel\",\"kategori\":\"ya\"}');
INSERT INTO `cmf_setting` VALUES ('1003', '2', 'galeri', '0', '3', '{\"label\":\"Galeri\",\"kategori\":\"ya\"}');
INSERT INTO `cmf_setting` VALUES ('1004', '2', 'direktori', '0', '4', '{\"label\":\"Direktori\",\"kategori\":\"ya\"}');
INSERT INTO `cmf_setting` VALUES ('1005', '2', 'polling', '0', '5', '{\"label\":\"Polling\",\"kategori\":\"ya\"}');
INSERT INTO `cmf_setting` VALUES ('1006', '2', 'agenda', '0', '6', '{\"label\":\"Agenda\",\"kategori\":\"ya\"}');
INSERT INTO `cmf_setting` VALUES ('1007', '2', 'banner', '0', '7', '{\"label\":\"Banner\"}');
INSERT INTO `cmf_setting` VALUES ('1008', '2', 'sekilasinfo', '0', '8', '{\"label\":\"Sekilas Info\"}');
INSERT INTO `cmf_setting` VALUES ('100001', '3', 'Klasik', '0', '1', '{\"theme_path\":\"klasik\",\"keterangan\":\"Theme Admin alternatif CMS ini\",\"status\":\"on\"}');
INSERT INTO `cmf_setting` VALUES ('100002', '3', 'SB Admin 2', '0', '2', '{\"theme_path\":\"admin\",\"keterangan\":\"Theme Admin Deafult CMS ini\",\"status\":\"on\"}');
INSERT INTO `cmf_setting` VALUES ('100003', '3', 'Admin LTE', '0', '3', '{\"theme_path\":\"adminlte\",\"keterangan\":\"Theme Admin alternatif CMS ini\",\"status\":\"on\"}');
INSERT INTO `cmf_setting` VALUES ('100004', '3', 'Cat Master', '0', '4', '{\"theme_path\":\"cat_master\",\"keterangan\":\"Oom Greg dapet dari aplikasi CAT gratisan..\",\"status\":\"on\"}');
INSERT INTO `cmf_setting` VALUES ('200001', '4', 'Theme Default', '0', '1', '{\"theme_path\":\"web\",\"keterangan\":\"Theme Deafult CMS ini\",\"status\":\"on\",\"header_opsi\":{\"height\":\"75px\",\"margin_top\":\"0px\",\"margin_bottom\":\"0px\",\"padding_top\":\"10px\",\"padding_bottom\":\"0px\"}}');
INSERT INTO `cmf_setting` VALUES ('200002', '4', 'Theme Alternatif', '0', '2', '{\"theme_path\":\"web_alt\",\"keterangan\":\"Theme Alternatif CMS ini\",\"status\":\"on\"}');
INSERT INTO `cmf_setting` VALUES ('400001', '5', 'infoslider', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"Widget anu\"}');
INSERT INTO `cmf_setting` VALUES ('400002', '5', 'artikel_slider', '0', '0', '{\"lokasi_widget\":\"topbar\",\"keterangan\":\"Menampilkan artikel terpilih dalam bentuk slider, biasanya setiap kanal ada slider artikelnya di bagian atas\",\"custom\":\"ya\"}');
INSERT INTO `cmf_setting` VALUES ('400003', '5', 'artikel_lastten', '0', '0', '{\"lokasi_widget\":\"mainbar\",\"keterangan\":\"Menampilkan 10 artikel terbaru, dalam bentuk judul dan potongan paragraf pertama\"}');
INSERT INTO `cmf_setting` VALUES ('400004', '5', 'bukutamu', '0', '0', '{\"lokasi_widget\":\"mainbar\",\"keterangan\":\"Menampilkan komponen/rubrik bukutamu di kanal\"}');
INSERT INTO `cmf_setting` VALUES ('400005', '5', 'galeri', '0', '0', '{\"lokasi_widget\":\"mainbar\",\"keterangan\":\"Menampilkan komponen galeri di kanal\"}');
INSERT INTO `cmf_setting` VALUES ('400006', '5', 'banner_slider', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"Menampilkan gambar di kanal\"}');
INSERT INTO `cmf_setting` VALUES ('400007', '5', 'pengumuman_samping', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"Untuk menampilkan pengumuman di sidebar\"}');
INSERT INTO `cmf_setting` VALUES ('400008', '5', 'agenda', '0', '0', '{\"lokasi_widget\":\"mainbar\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('400009', '5', 'direktori', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('400010', '5', 'daftar', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"Type Direktori Langsung\"}');
INSERT INTO `cmf_setting` VALUES ('400011', '5', 'banner_main', '0', '0', '{\"lokasi_widget\":\"mainbar\",\"keterangan\":\"Banner Slider untuk ditampilkan di Mainbar\"}');
INSERT INTO `cmf_setting` VALUES ('400012', '5', 'statis', '0', '0', '{\"lokasi_widget\":\"topbar\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('400013', '5', 'index_tutorial', '0', '0', '{\"lokasi_widget\":\"topbar\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('400014', '5', 'statis_main', '0', '0', '{\"lokasi_widget\":\"mainbar\",\"keterangan\":\"bg\"}');
INSERT INTO `cmf_setting` VALUES ('400015', '5', 'commented', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"df\"}');
INSERT INTO `cmf_setting` VALUES ('400016', '5', 'hl_slider', '0', '0', '{\"lokasi_widget\":\"mainbar\",\"keterangan\":\"Widget anu\",\"custom\":\"ya\"}');
INSERT INTO `cmf_setting` VALUES ('400017', '5', 'calendar', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"Kalender agenda dari Bang Opik\"}');
INSERT INTO `cmf_setting` VALUES ('400018', '5', 'last_artikel', '0', '0', '{\"lokasi_widget\":\"mainbar\"}');
INSERT INTO `cmf_setting` VALUES ('400019', '5', 'polling_samping', '0', '0', '{\"lokasi_widget\":\"sidebar\",\"keterangan\":\"Form Polling Berjalan\"}');
INSERT INTO `cmf_setting` VALUES ('900001', '6', 'sdf kasasi', '0', '5', '');
INSERT INTO `cmf_setting` VALUES ('1000000', '7', 'Depan', '0', '0', '{\"path_kanal\":\"depan\",\"path_root\":\"depan\",\"status\":\"on\",\"keterangan\":\"Halaman Default\",\"tipe\":\"biasa\",\"theme\":\"web\"}');
INSERT INTO `cmf_setting` VALUES ('3000001', '10', '', '0', '0', '{\"id_kanal\":\"1000000\",\"judul_header\":\"DanTECH\",\"sub_judul\":\"Codeigniter Admin Panel\",\"tinggi_header\":\"80px\",\"margin_top\":\"10px\",\"margin_bottom\":\"10px\",\"padding_top\":\"10px\",\"padding_bottom\":\"10px\"}');
INSERT INTO `cmf_setting` VALUES ('4000001', '11', 'mainbar', '0', '0', '{\"id_kanal\":\"1000000\",\"path_kanal\":\"depan\",\"widget\":[{\"nama_widget\":\"statis_main\",\"id_widget\":\"400014\",\"nama_wrapper\":\"Salam Kenal\",\"id_kategori\":\"8\",\"keterangan\":\"Contoh pemasangan widget di DanTECH\",\"opsi\":[{\"label\":\"Margin atas\",\"nama\":\"margin-top\",\"nilai\":\"10px\"},{\"label\":\"Margin bawah\",\"nama\":\"margin-bottom\",\"nilai\":\"10px\"},{\"label\":\"Banyaknya post\",\"nama\":\"n_post\",\"nilai\":\"3\"}]}]}');
INSERT INTO `cmf_setting` VALUES ('10000001', '12', 'Dashboard', '0', '1', '{\"path_menu\":\"module/cmshome/dashboard/webadmin\",\"icon_menu\":\"dashboard\",\"keterangan\":\"999\"}');
INSERT INTO `cmf_setting` VALUES ('10000002', '12', 'Konten', '0', '2', '{\"path_menu\":\"module/cmskonten/statis\",\"icon_menu\":\"puzzle-piece\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000003', '12', 'Komentar', '0', '3', '{\"path_menu\":\"module/cmskonten/comment\",\"icon_menu\":\"comments\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000004', '12', 'Kanal', '0', '4', '{\"path_menu\":\"module/cmskanal/kanal\",\"icon_menu\":\"cubes\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000005', '12', 'Administrasi', '0', '5', '{\"path_menu\":\"-\",\"icon_menu\":\"tasks\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000006', '12', 'Tools', '0', '6', '{\"path_menu\":\"-\",\"icon_menu\":\"wrench\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000007', '12', 'Ganti password', '0', '7', '{\"path_menu\":\"module/cmsadmin/user/ganti_password\",\"icon_menu\":\"lock\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000008', '12', 'Pengguna', '10000005', '1', '{\"path_menu\":\"module/cmsadmin/user\",\"icon_menu\":\"user\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000009', '12', 'Menu Pengguna', '10000005', '2', '{\"path_menu\":\"module/cmsadmin/menu/menu_grup\",\"icon_menu\":\"gear\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000010', '12', 'Menu', '10000005', '3', '{\"path_menu\":\"module/cmsadmin/menu\",\"icon_menu\":\"gears\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000011', '12', 'Grup pengguna', '10000005', '4', '{\"path_menu\":\"module/cmsadmin/user/grup\",\"icon_menu\":\"users\",\"keterangan\":\"--\"}');
INSERT INTO `cmf_setting` VALUES ('10000012', '12', 'Theme Web', '10000006', '1', '{\"path_menu\":\"module/cmsadmin/theme\",\"icon_menu\":\"object-group\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000013', '12', 'Theme Admin', '10000006', '2', '{\"path_menu\":\"module/cmsadmin/theme/admin\",\"icon_menu\":\"recycle\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000014', '12', 'Widget', '10000006', '3', '{\"path_menu\":\"module/cmsadmin/widget\",\"icon_menu\":\"clipboard\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000015', '12', 'Penulis berita', '10000005', '5', '{\"path_menu\":\"module/cmsadmin/penulis\",\"icon_menu\":\"pencil\",\"keterangan\":\"-\"}');
INSERT INTO `cmf_setting` VALUES ('10000016', '12', 'Asset Manager', '10000006', '4', '{\"path_menu\":\"module/cmskonten/fmanager\",\"icon_menu\":\"file\",\"keterangan\":\"Pengelola File Assets\"}');
INSERT INTO `cmf_setting` VALUES ('11000001', '13', 'webadmin', '0', '0', '{\"section_name\":\"klasik\",\"back_office\":\"admin\",\"keterangan\":\"-\",\"judul_app\":\"DanTECH\",\"sub_judul\":\"Codeigniter Admin Panel\",\"alertafter\":\"300000\",\"logoutafter\":\"600000\"}');
INSERT INTO `cmf_setting` VALUES ('12000001', '14', '', '0', '0', '{\"id_menu\":\"10000001\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000002', '14', '', '0', '0', '{\"id_menu\":\"10000002\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000003', '14', '', '0', '0', '{\"id_menu\":\"10000003\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000004', '14', '', '0', '0', '{\"id_menu\":\"10000004\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000005', '14', '', '0', '0', '{\"id_menu\":\"10000005\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000006', '14', '', '0', '0', '{\"id_menu\":\"10000006\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000007', '14', '', '0', '0', '{\"id_menu\":\"10000007\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000008', '14', '', '0', '0', '{\"id_menu\":\"10000008\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000009', '14', '', '0', '0', '{\"id_menu\":\"10000009\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000010', '14', '', '0', '0', '{\"id_menu\":\"10000010\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000011', '14', '', '0', '0', '{\"id_menu\":\"10000011\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000012', '14', '', '0', '0', '{\"id_menu\":\"10000012\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000013', '14', '', '0', '0', '{\"id_menu\":\"10000013\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000014', '14', '', '0', '0', '{\"id_menu\":\"10000014\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000015', '14', '', '0', '0', '{\"id_menu\":\"10000015\",\"group_id\":\"11000001\"}');
INSERT INTO `cmf_setting` VALUES ('12000016', '14', '', '0', '0', '{\"id_menu\":\"10000016\",\"group_id\":\"11000001\"}');

-- ----------------------------
-- Table structure for `konten`
-- ----------------------------
DROP TABLE IF EXISTS `konten`;
CREATE TABLE `konten` (
  `id_konten` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `komponen` varchar(200) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `sub_judul` varchar(200) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `isi_konten` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('on','off') NOT NULL,
  `urutan` int(11) NOT NULL,
  `baca` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_konten`),
  KEY `id_berita_kategori` (`id_kategori`),
  KEY `id_penulis` (`id_penulis`),
  KEY `user_id` (`user_id`,`urutan`),
  KEY `komponen` (`komponen`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of konten
-- ----------------------------
INSERT INTO `konten` VALUES ('8', '1000000', 'statis', 'Selamat Datang', '', '900001', '2015-06-02', '                                            <p>Inilah php 2 in 1, selain Framework untuk membangun aplikasi sekaligus juga CMS untuk membuat Website (publik).</p>\r\n                    ', '0', 'on', '1', null);

-- ----------------------------
-- Table structure for `konten_appe`
-- ----------------------------
DROP TABLE IF EXISTS `konten_appe`;
CREATE TABLE `konten_appe` (
  `id_appe` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_konten` int(11) unsigned DEFAULT NULL,
  `tipe` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `judul_appe` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan_appe` text COLLATE latin1_general_ci,
  `link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `urutan_appe` int(11) DEFAULT NULL,
  `foto_from` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_buat` date DEFAULT NULL,
  `nilai` int(14) DEFAULT NULL,
  `fotografer` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_appe`),
  KEY `FK_galeri` (`id_konten`),
  KEY `komponen` (`tipe`),
  KEY `link` (`link`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of konten_appe
-- ----------------------------
INSERT INTO `konten_appe` VALUES ('6', '8', 'kategori_widget', 'mainbar', 'statis', '400014', null, '1', null, null, '1000000', null);

-- ----------------------------
-- Table structure for `konten_komentar`
-- ----------------------------
DROP TABLE IF EXISTS `konten_komentar`;
CREATE TABLE `konten_komentar` (
  `id_komentar` int(11) NOT NULL AUTO_INCREMENT,
  `id_konten` int(11) NOT NULL,
  `nama_komentator` varchar(200) NOT NULL,
  `email_komentator` varchar(100) NOT NULL,
  `tanggal_komentar` datetime NOT NULL,
  `isi_komentar` text NOT NULL,
  `status` enum('on','off') NOT NULL,
  `id_induk` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `ip_adress` varchar(100) NOT NULL,
  PRIMARY KEY (`id_komentar`),
  KEY `id_berita` (`id_konten`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of konten_komentar
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(4) DEFAULT NULL,
  `username` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `passwd` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `nama_user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '11000001', 'admin_xp', 'a6853345f3c3b7cbb636e325736d95e8ab57f847', 'Admin Web Default', null);

-- ----------------------------
-- Table structure for `user_online`
-- ----------------------------
DROP TABLE IF EXISTS `user_online`;
CREATE TABLE `user_online` (
  `user_id` int(7) NOT NULL,
  `last_activity` datetime NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_online
-- ----------------------------
INSERT INTO `user_online` VALUES ('1', '2016-10-21 22:05:48', '::1');
