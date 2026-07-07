-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ci4
DROP DATABASE IF EXISTS `ci4`;
CREATE DATABASE IF NOT EXISTS `ci4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ci4`;

-- Dumping structure for table ci4.berita
DROP TABLE IF EXISTS `berita`;
CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` enum('berita','dokumen') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'berita',
  `ringkasan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `penulis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_berita`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id_book` int unsigned NOT NULL AUTO_INCREMENT,
  `code_book` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isbn_book` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_klasifikasi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title_book` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publisher_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kota_terbit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `published_year` year DEFAULT NULL,
  `edisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description_book` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deskripsi_fisik` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `volume` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subjek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe` enum('fisik','digital','keduanya') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'fisik',
  `file_digital` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_book`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.book_reviews
DROP TABLE IF EXISTS `book_reviews`;
CREATE TABLE IF NOT EXISTS `book_reviews` (
  `id_review` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `id_book` int unsigned NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT '5',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_review`),
  UNIQUE KEY `id_user_id_book` (`id_user`,`id_book`),
  KEY `book_reviews_id_book_foreign` (`id_book`),
  CONSTRAINT `book_reviews_id_book_foreign` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_reviews_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.jurnal
DROP TABLE IF EXISTS `jurnal`;
CREATE TABLE IF NOT EXISTS `jurnal` (
  `id_jurnal` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(270) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `penulis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_jurnal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penerbit` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `volume` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `halaman` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `issn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bidang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `abstrak` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_jurnal`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id_member` int unsigned NOT NULL AUTO_INCREMENT,
  `name_member` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_member` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_member` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_member` enum('Aktif','Nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `email_member` (`email_member`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.peminjaman
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_peminjaman` int unsigned NOT NULL AUTO_INCREMENT,
  `id_member` int unsigned NOT NULL,
  `id_book` int unsigned NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `peminjaman_id_member_foreign` (`id_member`),
  KEY `peminjaman_id_book_foreign` (`id_book`),
  CONSTRAINT `peminjaman_id_book_foreign` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `peminjaman_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.pengajuan
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE IF NOT EXISTS `pengajuan` (
  `id_pengajuan` int unsigned NOT NULL AUTO_INCREMENT,
  `id_member` int unsigned NOT NULL,
  `id_book` int unsigned NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status` enum('menunggu','disetujui','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menunggu',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`),
  KEY `pengajuan_id_member_foreign` (`id_member`),
  KEY `pengajuan_id_book_foreign` (`id_book`),
  CONSTRAINT `pengajuan_id_book_foreign` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.pengaturan
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `lama_pinjam` int NOT NULL DEFAULT '7',
  `denda_per_hari` int NOT NULL DEFAULT '1000',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.pengembalian
DROP TABLE IF EXISTS `pengembalian`;
CREATE TABLE IF NOT EXISTS `pengembalian` (
  `id_pengembalian` int NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int NOT NULL,
  `tanggal_kembali_aktual` date NOT NULL,
  `total_denda` int NOT NULL,
  `status_bayar` enum('belum','lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'belum',
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.subjek
DROP TABLE IF EXISTS `subjek`;
CREATE TABLE IF NOT EXISTS `subjek` (
  `id_subjek` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe` enum('buku','jurnal') COLLATE utf8mb4_general_ci DEFAULT 'buku',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_subjek`),
  UNIQUE KEY `nama_tipe` (`nama`,`tipe`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `id_member` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `users_id_member_foreign` (`id_member`),
  CONSTRAINT `users_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table ci4.wishlist
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id_wishlist` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `id_book` int unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_wishlist`),
  UNIQUE KEY `id_user_id_book` (`id_user`,`id_book`),
  KEY `wishlist_id_book_foreign` (`id_book`),
  CONSTRAINT `wishlist_id_book_foreign` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wishlist_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
