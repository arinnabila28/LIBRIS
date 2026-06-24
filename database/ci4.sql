-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ci4
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `berita`
--

DROP TABLE IF EXISTS `berita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita` (
  `id_berita` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` enum('berita','dokumen') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'berita',
  `ringkasan` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi` text COLLATE utf8mb4_general_ci,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_dokumen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `penulis` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_berita`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita`
--

LOCK TABLES `berita` WRITE;
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
INSERT INTO `berita` VALUES (1,'Pekan Literasi Informasi 2026','pekan-literasi-informasi-2026','berita','Rangkaian kelas dan workshop literasi informasi digelar sepanjang pekan ini.','LIBRIS menyelenggarakan Pekan Literasi Informasi 2026.\n\nKegiatan meliputi kelas penelusuran jurnal, workshop manajemen sitasi, dan kelas anti-plagiarisme. Terbuka gratis untuk seluruh pemustaka.',NULL,NULL,'2026-06-20','Administrator','2026-06-22 17:53:49','2026-06-22 17:53:49',NULL),(2,'Berita Acara Serah Terima Koleksi','berita-acara-serah-terima-koleksi','dokumen','Dokumen resmi serah terima koleksi hibah periode Juni 2026.','Dokumen berita acara serah terima koleksi hibah.',NULL,NULL,'2026-06-18','Administrator','2026-06-22 17:53:49','2026-06-22 17:53:49',NULL);
/*!40000 ALTER TABLE `berita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_reviews`
--

DROP TABLE IF EXISTS `book_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_reviews` (
  `id_review` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `id_book` int unsigned NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT '5',
  `comment` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_review`),
  UNIQUE KEY `id_user_id_book` (`id_user`,`id_book`),
  KEY `book_reviews_id_book_foreign` (`id_book`),
  CONSTRAINT `book_reviews_id_book_foreign` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_reviews_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_reviews`
--

LOCK TABLES `book_reviews` WRITE;
/*!40000 ALTER TABLE `book_reviews` DISABLE KEYS */;
INSERT INTO `book_reviews` VALUES (2,5,4,5,'bagus','2026-06-16 18:33:28','2026-06-16 18:33:28'),(3,1,12,5,'SAYA BERUBAH 180 DERAJAT SETELAH BACA BUKU INI, SEKARANG ADMIN BISA PRODUKTIF SETIAP HARI','2026-06-22 18:06:21','2026-06-22 18:06:21'),(4,5,12,5,'KEREN','2026-06-22 18:07:12','2026-06-22 18:07:12'),(5,1,2,5,'Bagus','2026-06-23 04:32:01','2026-06-23 04:32:01');
/*!40000 ALTER TABLE `book_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id_book` int unsigned NOT NULL AUTO_INCREMENT,
  `code_book` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn_book` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_klasifikasi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title_book` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `author_book` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `publisher_book` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kota_terbit` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `published_year` year DEFAULT NULL,
  `edisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description_book` text COLLATE utf8mb4_general_ci,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deskripsi_fisik` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `volume` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subjek` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe` enum('fisik','digital') COLLATE utf8mb4_general_ci DEFAULT 'fisik',
  `file_digital` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_book`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'BK001','978-0-06-112008-4','813.01','To Kill a Mockingbird','Harper Lee','J.B. Lippincott','Bandung',1960,'Cet. 1','Novel klasik tentang keadilan dan rasisme di Amerika Selatan.',5,'2026-06-16 04:12:10','2026-06-23 04:24:57',NULL,'xii, 157 hlm; 21 cm','Vol. 1','Sastra, Klasik','fisik',NULL,NULL),(2,'BK002','978-0-7432-7356-5','813.02','Harry Potter and the Sorcerer\'s Stone','J.K. Rowling','Bloomsbury','Yogyakarta',1997,'Cet. 1','Kisah seorang anak yatim yang menemukan dirinya adalah penyihir.',8,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 164 hlm; 21 cm','Vol. 1','Sejarah','fisik',NULL,NULL),(3,'BK003','978-0-7432-7357-2','813.03','The Great Gatsby','F. Scott Fitzgerald','Scribner','Surabaya',1925,'Cet. 1','Kisah tentang kemewahan dan kehancuran di era Jazz Amerika.',4,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 171 hlm; 21 cm','Vol. 1','Sains, Teknologi','digital','sample.pdf',NULL),(4,'BK004','978-0-452-28423-4','813.04','1984','George Orwell','Secker & Warburg','Jakarta',1949,'Cet. 1','Distopia tentang totalitarianisme dan pengawasan massal.',6,'2026-06-16 04:12:10','2026-06-23 04:29:41',NULL,'xii, 178 hlm; 21 cm','Vol. 1','Filsafat, Psikologi','fisik',NULL,NULL),(5,'BK005','978-0-316-76948-0','813.05','The Catcher in the Rye','J.D. Salinger','Little, Brown','Bandung',1951,'Cet. 1','Kisah remaja yang mencari jati diri di New York.',3,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 185 hlm; 21 cm','Vol. 1','Fiksi, Novel','fisik',NULL,NULL),(6,'BK006','978-0-14-028329-7','813.06','Brave New World','Aldous Huxley','Chatto & Windus','Yogyakarta',1932,'Cet. 1','Gambaran dunia masa depan yang dikendalikan teknologi dan kesenangan.',4,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 192 hlm; 21 cm','Vol. 1','Sastra, Klasik','digital','sample.pdf',NULL),(7,'BK007','978-0-7434-8773-3','813.07','The Lord of the Rings','J.R.R. Tolkien','Allen & Unwin','Surabaya',1954,'Cet. 1','Epik fantasi tentang perjalanan menghancurkan cincin kegelapan.',5,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 199 hlm; 21 cm','Vol. 1','Sejarah','fisik',NULL,NULL),(8,'BK008','978-0-06-093546-9','813.08','To Kill a Mockingbird','Harper Lee','HarperCollins','Jakarta',2002,'Cet. 1','Edisi ulang tahun ke-40 novel klasik Harper Lee.',2,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 206 hlm; 21 cm','Vol. 1','Sains, Teknologi','fisik',NULL,NULL),(9,'BK009','978-0-14-303943-3','813.09','Pride and Prejudice','Jane Austen','Penguin Classics','Bandung',0000,'Cet. 1','Kisah cinta dan masyarakat di Inggris abad ke-19.',6,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 213 hlm; 21 cm','Vol. 1','Filsafat, Psikologi','digital','sample.pdf',NULL),(10,'BK010','978-0-7432-7358-9','813.10','The Alchemist','Paulo Coelho','HarperOne','Yogyakarta',1988,'Cet. 1','Perjalanan seorang gembala muda mengejar mimpinya.',7,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 220 hlm; 21 cm','Vol. 1','Fiksi, Novel','fisik',NULL,NULL),(11,'BK011','978-0-385-33348-1','813.11','The Da Vinci Code','Dan Brown','Doubleday','Surabaya',2003,'Cet. 1','Thriller tentang misteri seni dan agama di Eropa.',4,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 227 hlm; 21 cm','Vol. 1','Sastra, Klasik','fisik',NULL,NULL),(12,'BK012','978-0-525-55360-5','813.12','Atomic Habits','James Clear','Avery','Jakarta',2018,'Cet. 1','Panduan membangun kebiasaan baik dan menghilangkan kebiasaan buruk.',9,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 234 hlm; 21 cm','Vol. 1','Sejarah','digital','sample.pdf',NULL),(13,'BK013','978-0-7432-7359-6','813.13','Clean Code','Robert C. Martin','Prentice Hall','Bandung',2008,'Cet. 1','Panduan menulis kode yang bersih dan mudah dipahami.',5,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 241 hlm; 21 cm','Vol. 1','Sains, Teknologi','fisik',NULL,NULL),(14,'BK014','978-0-201-63361-0','813.14','Design Patterns','Gang of Four','Addison-Wesley','Yogyakarta',1994,'Cet. 1','Pola desain perangkat lunak yang telah teruji.',3,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 248 hlm; 21 cm','Vol. 1','Filsafat, Psikologi','fisik',NULL,NULL),(15,'BK015','978-979-756-853-6','813.15','Laskar Pelangi','Andrea Hirata','Bentang Pustaka','Surabaya',2005,'Cet. 1','Kisah inspiratif anak-anak Belitung yang berjuang untuk pendidikan.',8,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 255 hlm; 21 cm','Vol. 1','Fiksi, Novel','digital','sample.pdf',NULL),(16,'BK016','978-979-756-999-1','813.16','Bumi Manusia','Pramoedya Ananta Toer','Hasta Mitra','Jakarta',1980,'Cet. 1','Novel sejarah tentang perjuangan di era kolonial Belanda.',4,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 262 hlm; 21 cm','Vol. 1','Sastra, Klasik','fisik',NULL,NULL),(17,'BK017','978-602-8811-45-3','813.17','Negeri 5 Menara','Ahmad Fuadi','Gramedia','Bandung',2009,'Cet. 1','Kisah perjuangan santri di pesantren Gontor.',6,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 269 hlm; 21 cm','Vol. 1','Sejarah','fisik',NULL,NULL),(18,'BK018','978-0-7432-7360-2','813.18','CodeIgniter 4 Handbook','Dino Cajic','Packt Publishing','Yogyakarta',2022,'Cet. 1','Panduan lengkap menggunakan framework CodeIgniter 4.',5,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 276 hlm; 21 cm','Vol. 1','Sains, Teknologi','digital','sample.pdf',NULL),(19,'BK019','978-0-13-235088-4','813.19','The Pragmatic Programmer','Andrew Hunt','Addison-Wesley','Surabaya',1999,'Cet. 1','Panduan menjadi programmer yang lebih efektif dan profesional.',4,'2026-06-16 04:12:10','2026-06-23 04:33:51',NULL,'xii, 283 hlm; 21 cm','Vol. 1','Filsafat, Psikologi','fisik',NULL,NULL),(20,'BK020','978-0-13-468599-1','813.20','Deep Work','Cal Newport','Grand Central Publishing','Jakarta',2016,'Cet. 1','Strategi fokus bekerja dalam era distraksi digital.',5,'2026-06-16 04:12:10','2026-06-16 04:12:10',NULL,'xii, 290 hlm; 21 cm','Vol. 1','Fiksi, Novel','fisik',NULL,NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurnal`
--

DROP TABLE IF EXISTS `jurnal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jurnal` (
  `id_jurnal` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(270) COLLATE utf8mb4_general_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_jurnal` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penerbit` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `volume` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomor` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `halaman` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doi` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `issn` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bidang` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `abstrak` text COLLATE utf8mb4_general_ci,
  `file_pdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_jurnal`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurnal`
--

LOCK TABLES `jurnal` WRITE;
/*!40000 ALTER TABLE `jurnal` DISABLE KEYS */;
INSERT INTO `jurnal` VALUES (1,'Pengaruh Literasi Digital terhadap Minat Baca Mahasiswa','pengaruh-literasi-digital-minat-baca','Andi Saputra, Rina Dewi','Jurnal Ilmu Perpustakaan','Prodi Ilmu Perpustakaan',2025,'12','2','45-58','10.1234/jip.2025.12.2','2541-1234','Pendidikan','Penelitian ini mengkaji hubungan literasi digital dengan minat baca mahasiswa.',NULL,'2026-06-22 18:08:09','2026-06-22 18:08:09',NULL),(2,'Implementasi Sistem Otomasi Perpustakaan Berbasis Web','implementasi-sistem-otomasi-perpustakaan-berbasis-web','Budi Santoso','Jurnal Teknologi Informasi','LPPM',2024,'8','1','10-22','10.5678/jti.2024.8.1','2620-5678','Teknologi','Artikel ini membahas perancangan sistem otomasi perpustakaan berbasis web.','1782188634_0fbeab496a61b805ed5d.pdf','2026-06-22 18:08:09','2026-06-23 04:24:32',NULL);
/*!40000 ALTER TABLE `jurnal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id_member` int unsigned NOT NULL AUTO_INCREMENT,
  `name_member` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email_member` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_member` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status_member` enum('Aktif','Nonaktif') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `email_member` (`email_member`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Budi Santoso','budi.santoso@email.com','081234567801','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(2,'Ani Rahayu','ani.rahayu@email.com','081234567802','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(3,'Rudi Hermawan','rudi.hermawan@email.com','081234567803','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(4,'Dewi Kusuma','dewi.kusuma@email.com','081234567804','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(5,'Siti Aminah','siti.aminah@email.com','081234567805','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(6,'Agus Pratama','agus.pratama@email.com','081234567806','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(7,'Rina Wulandari','rina.wulandari@email.com','081234567807','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(8,'Hendra Kurniawan','hendra.kurniawan@email.com','081234567808','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(9,'Maya Sari','maya.sari@email.com','081234567809','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(10,'Dian Permata','dian.permata@email.com','081234567810','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(11,'Fajar Nugroho','fajar.nugroho@email.com','081234567811','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(12,'Lestari Putri','lestari.putri@email.com','081234567812','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(13,'Wahyu Setiawan','wahyu.setiawan@email.com','081234567813','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(14,'Nita Anggraini','nita.anggraini@email.com','081234567814','Nonaktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(15,'Bayu Adi','bayu.adi@email.com','081234567815','Aktif','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(23,'Irfan TheCreator','muhammadirfannuha17@gmail.com','1234567890','Aktif','2026-06-16 17:15:55','2026-06-23 04:35:22',NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026-05-14-163359','App\\Database\\Migrations\\CreateBookTable','default','App',1781583118,1),(2,'2026-06-03-224348','App\\Database\\Migrations\\Members','default','App',1781583118,1),(3,'2026-06-04-022751','App\\Database\\Migrations\\Peminjaman','default','App',1781583118,1),(4,'2026-06-04-033607','App\\Database\\Migrations\\Pengembalian','default','App',1781583118,1),(5,'2026-06-16-010101','App\\Database\\Migrations\\CreateUsersTable','default','App',1781602877,2),(6,'2026-06-16-020202','App\\Database\\Migrations\\AddBookMetadata','default','App',1781623761,3),(7,'2026-06-16-030303','App\\Database\\Migrations\\CreatePengajuanTable','default','App',1781629534,4),(8,'2026-06-17-040404','App\\Database\\Migrations\\CreateWishlistTable','default','App',1781630434,5),(9,'2026-06-17-050505','App\\Database\\Migrations\\CreateBookReviewsTable','default','App',1781634371,6),(10,'2026-06-17-060606','App\\Database\\Migrations\\AddBookCover','default','App',1781637623,7),(11,'2026-06-23-100000','App\\Database\\Migrations\\CreateBeritaTable','default','App',1782150785,8),(12,'2026-06-23-110000','App\\Database\\Migrations\\CreatePengaturanTable','default','App',1782151309,9),(13,'2026-06-23-120000','App\\Database\\Migrations\\CreateJurnalTable','default','App',1782151642,10),(14,'2026-06-23-130000','App\\Database\\Migrations\\AddStatusBayarPengembalian','default','App',1782188657,11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peminjaman` (
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (1,1,2,'2026-06-08','2026-06-16','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(2,5,12,'2026-06-10','2026-06-18','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(3,3,13,'2026-06-06','2026-06-14','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(4,7,15,'2026-06-11','2026-06-19','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(5,9,1,'2026-06-09','2026-06-17','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(6,2,10,'2026-06-13','2026-06-20','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(7,4,16,'2026-06-14','2026-06-21','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(8,6,18,'2026-06-12','2026-06-19','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(9,8,20,'2026-06-15','2026-06-22','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(10,10,4,'2026-06-13','2026-06-20','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(11,11,7,'2026-06-14','2026-06-21','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(12,12,9,'2026-06-15','2026-06-22','2026-06-16 04:12:10','2026-06-16 04:12:10',NULL),(13,2,3,'2026-05-27','2026-06-03','2026-06-16 03:12:10','2026-06-16 04:12:10',NULL),(14,3,5,'2026-06-01','2026-06-08','2026-06-16 01:12:10','2026-06-16 04:12:10',NULL),(15,4,8,'2026-06-04','2026-06-11','2026-06-15 23:12:10','2026-06-16 04:12:10',NULL),(16,5,11,'2026-06-06','2026-06-13','2026-06-15 04:12:10','2026-06-16 04:12:10',NULL),(17,6,14,'2026-06-08','2026-06-15','2026-06-14 04:12:10','2026-06-16 04:12:10',NULL),(18,7,17,'2026-06-10','2026-06-14','2026-06-13 04:12:10','2026-06-16 04:12:10',NULL),(19,13,19,'2026-06-11','2026-06-15','2026-06-12 04:12:10','2026-06-16 04:12:10',NULL),(20,1,6,'2026-06-10','2026-06-15','2026-06-10 04:12:10','2026-06-16 04:12:10',NULL),(21,2,7,'2026-06-10','2026-06-15','2026-06-10 04:12:10','2026-06-16 04:12:10',NULL),(22,3,8,'2026-06-11','2026-06-15','2026-06-11 04:12:10','2026-06-16 04:12:10',NULL),(23,4,9,'2026-06-11','2026-06-15','2026-06-11 04:12:10','2026-06-16 04:12:10',NULL),(24,5,10,'2026-06-11','2026-06-15','2026-06-11 04:12:10','2026-06-16 04:12:10',NULL),(25,6,11,'2026-06-12','2026-06-15','2026-06-12 04:12:10','2026-06-16 04:12:10',NULL),(26,7,12,'2026-06-12','2026-06-15','2026-06-12 04:12:10','2026-06-16 04:12:10',NULL),(27,8,13,'2026-06-12','2026-06-15','2026-06-12 04:12:10','2026-06-16 04:12:10',NULL),(28,9,14,'2026-06-13','2026-06-20','2026-06-13 04:12:10','2026-06-16 04:12:10',NULL),(29,10,15,'2026-06-13','2026-06-20','2026-06-13 04:12:10','2026-06-16 04:12:10',NULL),(30,11,16,'2026-06-14','2026-06-21','2026-06-14 04:12:10','2026-06-16 04:12:10',NULL),(31,12,17,'2026-06-14','2026-06-21','2026-06-14 04:12:10','2026-06-16 04:12:10',NULL),(32,13,18,'2026-06-15','2026-06-22','2026-06-15 04:12:10','2026-06-16 04:12:10',NULL),(33,14,19,'2026-06-15','2026-06-22','2026-06-15 04:12:10','2026-06-16 04:12:10',NULL),(34,15,20,'2026-06-16','2026-06-23','2026-06-16 04:10:10','2026-06-16 04:12:10',NULL),(35,1,3,'2026-06-16','2026-06-23','2026-06-16 04:07:10','2026-06-16 04:12:10',NULL),(37,23,4,'2026-06-16','2026-06-23','2026-06-16 17:16:30','2026-06-16 17:16:30',NULL),(39,23,19,'2026-06-23','2026-06-30','2026-06-23 04:33:16','2026-06-23 04:33:16',NULL);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengajuan`
--

DROP TABLE IF EXISTS `pengajuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengajuan` (
  `id_pengajuan` int unsigned NOT NULL AUTO_INCREMENT,
  `id_member` int unsigned NOT NULL,
  `id_book` int unsigned NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status` enum('menunggu','disetujui','ditolak') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menunggu',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`),
  KEY `pengajuan_id_member_foreign` (`id_member`),
  KEY `pengajuan_id_book_foreign` (`id_book`),
  CONSTRAINT `pengajuan_id_book_foreign` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan`
--

LOCK TABLES `pengajuan` WRITE;
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
INSERT INTO `pengajuan` VALUES (2,23,4,'2026-06-16','disetujui','2026-06-16 17:16:03','2026-06-16 17:16:30'),(3,23,12,'2026-06-16','ditolak','2026-06-16 17:17:50','2026-06-16 17:18:28'),(4,23,19,'2026-06-23','disetujui','2026-06-23 04:32:57','2026-06-23 04:33:16');
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengaturan`
--

DROP TABLE IF EXISTS `pengaturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengaturan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `lama_pinjam` int NOT NULL DEFAULT '7',
  `denda_per_hari` int NOT NULL DEFAULT '1000',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaturan`
--

LOCK TABLES `pengaturan` WRITE;
/*!40000 ALTER TABLE `pengaturan` DISABLE KEYS */;
INSERT INTO `pengaturan` VALUES (1,7,1000,'2026-06-22 18:01:49');
/*!40000 ALTER TABLE `pengaturan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengembalian` (
  `id_pengembalian` int NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int NOT NULL,
  `tanggal_kembali_aktual` date NOT NULL,
  `total_denda` int NOT NULL,
  `status_bayar` enum('belum','lunas') COLLATE utf8mb4_general_ci DEFAULT 'belum',
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` VALUES (1,13,'2026-06-03',0,'lunas'),(2,14,'2026-06-08',0,'lunas'),(3,15,'2026-06-11',0,'lunas'),(4,16,'2026-06-13',0,'lunas'),(5,17,'2026-06-15',0,'lunas'),(6,18,'2026-06-14',0,'lunas'),(7,19,'2026-06-15',0,'lunas'),(8,20,'2026-06-15',0,'lunas'),(9,21,'2026-06-15',0,'lunas'),(10,22,'2026-06-15',0,'lunas'),(11,23,'2026-06-15',0,'lunas'),(12,24,'2026-06-15',0,'lunas'),(13,25,'2026-06-15',0,'lunas'),(14,26,'2026-06-15',0,'lunas'),(15,27,'2026-06-15',0,'lunas'),(16,28,'2026-06-20',0,'lunas'),(17,29,'2026-06-20',0,'lunas'),(18,30,'2026-06-21',0,'lunas'),(19,31,'2026-06-21',0,'lunas'),(20,32,'2026-06-22',0,'lunas'),(21,33,'2026-06-22',0,'lunas'),(22,34,'2026-06-23',0,'lunas'),(23,35,'2026-06-23',0,'lunas'),(25,37,'2026-06-23',0,'lunas'),(26,39,'2026-06-23',0,'lunas');
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `id_member` int unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `users_id_member_foreign` (`id_member`),
  CONSTRAINT `users_id_member_foreign` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@cybershelf.test','$2y$12$3MXo0xCWUMNiOCmodD8jVevvndkFlE2AAiVn0.RN71WshEdifkUtS','admin',NULL,'2026-06-16 09:41:17','2026-06-16 09:41:17'),(5,'Irfan TheCreator','muhammadirfannuha17@gmail.com','$2y$12$XDKpeS9tZObpzMW23znwQu00pgMAwYGXC9uDgiFKshSGQBJHUiHKS','user',23,'2026-06-16 17:15:56','2026-06-23 04:35:22');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlist` (
  `id_wishlist` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `id_book` int unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_wishlist`),
  UNIQUE KEY `id_user_id_book` (`id_user`,`id_book`),
  KEY `wishlist_id_book_foreign` (`id_book`),
  CONSTRAINT `wishlist_id_book_foreign` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wishlist_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (9,1,2,'2026-06-23 04:31:46');
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-23 12:08:23
