-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2015 at 06:45 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_reservasi`
--
CREATE DATABASE IF NOT EXISTS `db_reservasi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_reservasi`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailreservasi`
--

CREATE TABLE IF NOT EXISTS `tb_detailreservasi` (
  `IdDetailReservasi` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdReservasi` int(11) DEFAULT NULL,
  `IdMenuMakanan` int(11) DEFAULT NULL,
  `JumlahItem` smallint(6) DEFAULT NULL,
  `Harga` int(11) DEFAULT NULL,
  `NotesMenu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdDetailReservasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `tb_detailreservasi`
--

INSERT INTO `tb_detailreservasi` (`IdDetailReservasi`, `IdReservasi`, `IdMenuMakanan`, `JumlahItem`, `Harga`, `NotesMenu`) VALUES
(8, 1, 5, 10, 8000, NULL),
(9, 1, 2, 5, 9000, NULL),
(10, 1, 3, 5, 12000, NULL),
(11, 2, 4, 5, 11000, NULL),
(12, 2, 5, 4, 8000, NULL),
(13, 2, 2, 2, 9000, NULL),
(14, 2, 3, 3, 12000, NULL),
(18, 4, 2, 3, 9000, NULL),
(19, 4, 5, 20, 8000, NULL),
(20, 4, 3, 3, 12000, NULL),
(21, 4, 4, 20, 11000, NULL),
(22, 3, 2, 3, 9000, NULL),
(23, 3, 5, 2, 8000, NULL),
(24, 3, 3, 5, 12000, NULL),
(25, 3, 1, 3, 20000, NULL),
(26, 5, 3, 5, 12000, NULL),
(27, 5, 4, 12, 11000, NULL),
(28, 5, 2, 4, 9000, NULL),
(29, 5, 5, 12, 8000, NULL),
(46, 8, 1, 2, 20000, ''),
(47, 8, 3, 3, 12000, 'sambel pedas'),
(48, 8, 8, 12, 50000, 'tambah sambel asin'),
(49, 8, 2, 12, 9000, 'tambah susu'),
(54, 6, 2, 20, 9000, ''),
(55, 6, 7, 12, 12000, 'Ikan goren sambal pedas asem'),
(56, 6, 6, 13, 15000, 'sambel tidak terlalu pedas'),
(57, 6, 5, 5, 8000, ''),
(58, 9, 2, 32, 9000, ''),
(59, 9, 5, 12, 8000, ''),
(60, 9, 3, 30, 12000, ''),
(61, 9, 4, 12, 11000, 'tambah sambel ikan'),
(62, 9, 7, 12, 12000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenismakanan`
--

CREATE TABLE IF NOT EXISTS `tb_jenismakanan` (
  `IdJenisMakanan` smallint(6) NOT NULL AUTO_INCREMENT,
  `JenisMakanan` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`IdJenisMakanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_jenismakanan`
--

INSERT INTO `tb_jenismakanan` (`IdJenisMakanan`, `JenisMakanan`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kota`
--

CREATE TABLE IF NOT EXISTS `tb_kota` (
  `IdKota` smallint(6) NOT NULL AUTO_INCREMENT,
  `Kota` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`IdKota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_kota`
--

INSERT INTO `tb_kota` (`IdKota`, `Kota`) VALUES
(1, 'Denpasar'),
(2, 'Karangasem'),
(3, 'Gianyar'),
(4, 'Manado');

-- --------------------------------------------------------

--
-- Table structure for table `tb_leveluser`
--

CREATE TABLE IF NOT EXISTS `tb_leveluser` (
  `IdLevelUser` smallint(6) NOT NULL AUTO_INCREMENT,
  `LevelUser` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`IdLevelUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_leveluser`
--

INSERT INTO `tb_leveluser` (`IdLevelUser`, `LevelUser`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menumakanan`
--

CREATE TABLE IF NOT EXISTS `tb_menumakanan` (
  `IdMenuMakanan` int(11) NOT NULL AUTO_INCREMENT,
  `MenuMakanan` varchar(100) DEFAULT NULL,
  `Harga` int(11) DEFAULT NULL,
  `IdJenisMakanan` smallint(6) DEFAULT NULL,
  `InfoMenu` text,
  PRIMARY KEY (`IdMenuMakanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_menumakanan`
--

INSERT INTO `tb_menumakanan` (`IdMenuMakanan`, `MenuMakanan`, `Harga`, `IdJenisMakanan`, `InfoMenu`) VALUES
(1, 'Tempe Penyet', 20000, 1, NULL),
(2, 'Jus Stroberry', 9000, 2, NULL),
(3, 'Ayam Goreng', 12000, 1, NULL),
(4, 'Bak Mie Sayur', 11000, 1, NULL),
(5, 'Jus Tomat', 8000, 2, NULL),
(6, 'Ikan Bakar Sambel Spesial Teri', 15000, 1, 'Ikan dengan samble asem gurih dengan tambahan "Teri"'),
(7, 'Ikan Goreng', 12000, 1, 'Ikan gurami goreng yang "Ueenakk"'),
(8, 'Paket Hemat', 50000, 1, 'Paket Hemat :\r\n- Ayam Goreng : 2\r\n- Jus Stoberry : 2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_organizer`
--

CREATE TABLE IF NOT EXISTS `tb_organizer` (
  `IdOrganizer` int(11) NOT NULL AUTO_INCREMENT,
  `Organizer` varchar(100) DEFAULT NULL,
  `IdTipeCustomer` smallint(6) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Telepon` varchar(16) DEFAULT NULL,
  `IdKota` smallint(6) DEFAULT NULL,
  `Alamat` varchar(120) DEFAULT NULL,
  `Owner` varchar(150) DEFAULT NULL,
  `KontakOwner` varchar(16) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdOrganizer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tb_organizer`
--

INSERT INTO `tb_organizer` (`IdOrganizer`, `Organizer`, `IdTipeCustomer`, `Email`, `Telepon`, `IdKota`, `Alamat`, `Owner`, `KontakOwner`, `Note`) VALUES
(1, 'Abira Tour', 2, 'info@abidatour.com', '90909', 3, 'Jalan Pegangsahan', 'Ibu Abidah', '0812344342', 'Merupakan Tamu VIP'),
(4, 'Bank BRI', 1, 'bankbri@bri.com', '036122887', 1, 'Denpasar', 'Bank BRI', NULL, 'Tamu Biasa'),
(14, 'Mitra Tour', 1, 'info@mitrais.com', '909090', 1, 'Jalan Tukad Yeh Biu', 'David Mitra', '08778732', NULL),
(20, 'Tes Organizer', 1, 'test@test.com', '036122887', 3, 'Jalan Pegangsahan', 'Test Owner', '88977767', NULL),
(23, 'Test Baru', 1, 'testbaru@test.com', '0888080', 2, 'Jalan Pegangsahan', 'Test owner baru', '0812344342', 'Organizer VVIP harus dilayani dengan baik ya '),
(24, 'Test Popup', 1, 'testbaru@test.com', '5665', 1, 'Jalan Manado Hahhuuu', 'Owner Popup', '45553434', 'Organizer VVIP');

-- --------------------------------------------------------

--
-- Table structure for table `tb_person`
--

CREATE TABLE IF NOT EXISTS `tb_person` (
  `IdPerson` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) DEFAULT NULL,
  `Alamat` varchar(120) DEFAULT NULL,
  `JenisKelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `NoTelp` varchar(15) DEFAULT NULL,
  `NoHandphone` varchar(15) DEFAULT NULL,
  `IdOrganizer` int(11) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdPerson`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tb_person`
--

INSERT INTO `tb_person` (`IdPerson`, `Nama`, `Alamat`, `JenisKelamin`, `Email`, `NoTelp`, `NoHandphone`, `IdOrganizer`, `Note`) VALUES
(1, 'Komang Baglur', 'Denpasar', 'Laki-laki', '0909878', '080803435', '9898789', 1, 'Tamu Komang Baglur'),
(2, 'Citra Lidia Murni', 'Surabaya City', 'Perempuan', 'citra@yahoo.com', '89898989', '898989', 4, 'Citta Lidia'),
(3, 'Citra Pramayanti', 'Klungkung', 'Perempuan', 'citra@yahoo.com', '08080808', '8871727', 1, NULL),
(4, 'Hendra', 'Jalan Pedangsalan', 'Laki-laki', 'hendra@mitrais.com', '0080', '4545', 14, NULL),
(5, 'rtrtr', 'ertrt', 'Laki-laki', 'tete@tt.cf', '5666', '6777', 16, NULL),
(6, 'Elok Deshiari', 'Tabanan', 'Perempuan', 'elok@yahoo.com', NULL, '081877383873', 15, NULL),
(8, 'Test Person Baru', 'Jalan Manado Hahhuuu', 'Laki-laki', 'test@test.com', NULL, '08233123', 23, 'Update note person'),
(11, 'Test Person Baru', 'gggg', 'Laki-laki', 'testbaru@test.com', NULL, '08233123', 24, 'test tnoooote');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reservasi`
--

CREATE TABLE IF NOT EXISTS `tb_reservasi` (
  `IdReservasi` int(11) NOT NULL AUTO_INCREMENT,
  `IdPerson` int(11) DEFAULT NULL,
  `JumlahPeserta` int(11) DEFAULT NULL,
  `TanggalReservasi` date DEFAULT NULL,
  `JamReservasi` time DEFAULT NULL,
  `JumlahKendaraan` smallint(6) DEFAULT NULL,
  `IdStatusReservasi` smallint(6) DEFAULT '1',
  `NoBill` varchar(10) DEFAULT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `Notes` tinytext,
  `Discount` bigint(20) DEFAULT '0',
  PRIMARY KEY (`IdReservasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_reservasi`
--

INSERT INTO `tb_reservasi` (`IdReservasi`, `IdPerson`, `JumlahPeserta`, `TanggalReservasi`, `JamReservasi`, `JumlahKendaraan`, `IdStatusReservasi`, `NoBill`, `Username`, `Notes`, `Discount`) VALUES
(1, 1, 25, '2014-12-20', '14:00:00', 4, 3, NULL, 'user', NULL, 0),
(2, 2, 23, '2014-12-22', '11:00:00', 2, 4, '6785', 'user', NULL, 10),
(3, 4, 20, '2014-12-26', '17:00:00', 1, 4, '2312', 'user', NULL, 0),
(4, 4, 23, '2014-12-23', '20:00:00', 3, 4, '2345', 'user', NULL, 0),
(5, 3, 22, '2014-12-23', '14:00:00', 2, 4, '45454', 'user', NULL, 100000),
(6, 3, 20, '2015-01-07', '14:00:00', 2, 4, '6775', 'user', 'Tamu akan datang diantar pak nardi', 50000),
(8, 1, 32, '2015-01-03', '22:00:00', 2, 4, '2345', 'user', 'tamu akan datang malam hari dengan 2 bus', 15),
(9, 3, 43, '2015-01-07', '14:00:00', 4, 4, '4435', 'user', 'Tamu VVI dari Kepresidenan', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_statusreservasi`
--

CREATE TABLE IF NOT EXISTS `tb_statusreservasi` (
  `IdStatusReservasi` smallint(6) NOT NULL AUTO_INCREMENT,
  `StatusReservasi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdStatusReservasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_statusreservasi`
--

INSERT INTO `tb_statusreservasi` (`IdStatusReservasi`, `StatusReservasi`) VALUES
(1, 'Waiting'),
(2, 'Confirmed'),
(3, 'Canceled'),
(4, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipecustomer`
--

CREATE TABLE IF NOT EXISTS `tb_tipecustomer` (
  `IdTipeCustomer` smallint(6) NOT NULL AUTO_INCREMENT,
  `TipeCustomer` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`IdTipeCustomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_tipecustomer`
--

INSERT INTO `tb_tipecustomer` (`IdTipeCustomer`, `TipeCustomer`) VALUES
(1, 'Corporate'),
(2, 'Travel Agent'),
(3, 'Freelance Guide');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `Username` char(15) NOT NULL,
  `Password` char(32) DEFAULT NULL,
  `NamaLengkap` varchar(100) DEFAULT NULL,
  `JenisKelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `Alamat` varchar(150) DEFAULT NULL,
  `NoHandphone` varchar(12) DEFAULT NULL,
  `IdLevelUser` smallint(6) DEFAULT NULL,
  `IsActive` smallint(6) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`Username`, `Password`, `NamaLengkap`, `JenisKelamin`, `Alamat`, `NoHandphone`, `IdLevelUser`, `IsActive`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'I Komang Suhendra Eka Putra', 'Laki-laki', 'Denpasar', '081805603963', 1, 1),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Gatot Kaca', 'Laki-laki', 'Jalan Gatot Kaca', '0823232', 2, 1),
('komang', '3da015fb8727d60123f0543d2e6a63fa', 'Komang Hendra', 'Laki-laki', 'Dalem Rock City', '9090909', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_waktu_kunjungan`
--

CREATE TABLE IF NOT EXISTS `tb_waktu_kunjungan` (
  `IdWktKunjungan` smallint(6) NOT NULL AUTO_INCREMENT,
  `WaktuKunjungan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IdWktKunjungan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_waktu_kunjungan`
--

INSERT INTO `tb_waktu_kunjungan` (`IdWktKunjungan`, `WaktuKunjungan`) VALUES
(1, 'Pagi'),
(2, 'Siang'),
(3, 'Sore'),
(4, 'Malam');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
