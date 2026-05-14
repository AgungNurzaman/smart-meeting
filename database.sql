/*M!999999\- enable the sandbox mode */

DROP DATABASE IF EXISTS db_office_smart;
CREATE DATABASE db_office_smart;
USE db_office_smart;

-- =========================
-- TABLE KARYAWAN
-- =========================

DROP TABLE IF EXISTS `m_karyawan`;

CREATE TABLE `m_karyawan` (

  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,

  `nik` varchar(20) DEFAULT NULL,

  `nama_karyawan` varchar(100) DEFAULT NULL,

  `divisi` varchar(50) DEFAULT NULL,

  PRIMARY KEY (`id_karyawan`),

  UNIQUE KEY `nik` (`nik`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


INSERT INTO `m_karyawan`
VALUES

(1,'32013343','januar','Designer'),

(2,'32013344','Agung','Programmer'),

(3,'32013345','dimas','Admin'),

(4,'32013346','rakha','Programmer'),

(5,'32013347','ikbal','Security'),

(6,'32013348','moreno','Security');



-- =========================
-- TABLE RUANGAN
-- =========================

DROP TABLE IF EXISTS `m_ruangan`;

CREATE TABLE `m_ruangan` (

  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,

  `nama_ruangan` varchar(50) DEFAULT NULL,

  `kapasitas` int(11) DEFAULT NULL,

  `fasilitas` text DEFAULT NULL,

  PRIMARY KEY (`id_ruangan`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


INSERT INTO `m_ruangan`
VALUES

(1,'Lab Kom 1',8,'Kursi 8'),

(2,'101',9,'Meja 9'),

(3,'103',10,'Proyektor'),

(4,'Lab Kom 2',10,'AC'),

(5,'303',9,'TV'),

(6,'102',9,'Terminal'),

(7,'301',7,'Penghapus Papan Tulis'),

(8,'201',8,'Papan Tulis');



-- =========================
-- TABLE BOOKING
-- =========================

DROP TABLE IF EXISTS `t_booking`;

CREATE TABLE `t_booking` (

  `id_booking` int(11) NOT NULL AUTO_INCREMENT,

  `id_karyawan` int(11) DEFAULT NULL,

  `id_ruang` int(11) DEFAULT NULL,

  `tanggal_rapat` date DEFAULT NULL,

  `jam_mulai` time DEFAULT NULL,

  `jam_selesai` time DEFAULT NULL,

  `agenda` varchar(255) DEFAULT NULL,

  `status` varchar(20) DEFAULT NULL,

  PRIMARY KEY (`id_booking`),

  KEY `id_karyawan` (`id_karyawan`),

  KEY `id_ruang` (`id_ruang`),

  CONSTRAINT `t_booking_ibfk_1`
  FOREIGN KEY (`id_karyawan`)
  REFERENCES `m_karyawan` (`id_karyawan`),

  CONSTRAINT `t_booking_ibfk_2`
  FOREIGN KEY (`id_ruang`)
  REFERENCES `m_ruangan` (`id_ruangan`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


INSERT INTO `t_booking`
VALUES

(1,1,2,'2026-05-13',
'20:30:00',
'21:31:00',
'basis data',
'Pinjam'),

(2,2,1,'2026-05-13',
'22:22:00',
'23:00:00',
'praktek html',
'Pinjam');



-- =========================
-- TABLE LOG AKTIVITAS
-- =========================

DROP TABLE IF EXISTS `t_log_aktivitas`;

CREATE TABLE `t_log_aktivitas` (

  `id_log` int(11) NOT NULL AUTO_INCREMENT,

  `keterangan` text DEFAULT NULL,

  `created_at`
  timestamp NULL
  DEFAULT current_timestamp(),

  PRIMARY KEY (`id_log`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


INSERT INTO `t_log_aktivitas`
(`id_log`,`keterangan`,`created_at`)
VALUES

(1,
'Booking berhasil dibuat pada 2026-05-12 12:29:22',
'2026-05-12 12:29:22'),

(2,
'Data booking berhasil diupdate',
'2026-05-12 12:40:00'),

(3,
'Booking berhasil dibuat pada 2026-05-12 13:20:51',
'2026-05-12 13:20:51');