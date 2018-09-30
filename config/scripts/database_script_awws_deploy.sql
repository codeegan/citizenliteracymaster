-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ip47
DROP DATABASE IF EXISTS `ip47`;
CREATE DATABASE IF NOT EXISTS `ip47` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ip47`;

-- Dumping structure for table ip47.activity
DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `lesson` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `activitytype` tinytext DEFAULT NULL,
  `grapheme` tinytext DEFAULT NULL,
  `lessontext` varchar(50) DEFAULT NULL,
  `nextactivity` tinytext DEFAULT NULL,
  `previousactivity` tinytext DEFAULT NULL,
  KEY `activity_i1` (`activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ip47.activity: ~12 rows (approximately)
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`lesson`, `activity`, `activitytype`, `grapheme`, `lessontext`, `nextactivity`, `previousactivity`) VALUES
	('satpin', 'write_n', 'write', 'n', '\\N', '', 'write_i'),
	('satpin', 'write_s', 'write', 's', '\\N', 'write_a', '\\N'),
	('satpin', 'write_p', 'write', 'p', '\\N', 'write_i', 'write_t'),
	('satpin', 'write_i', 'write', 'i', '\\N', 'write_n', 'write_p'),
	('satpin', 'write_t', 'write', 't', '\\N', 'write_p', 'write_a'),
	('satpin', 'write_a', 'write', 'a', '\\N', 'write_t', 'write_s'),
	('satpin', 'voice_n', 'voice', 'n', '\\N', '', 'voice_i'),
	('satpin', 'voice_s', 'voice', 's', '\\N', 'voice_a', '\\N'),
	('satpin', 'voice_p', 'voice', 'p', '\\N', 'voice_i', 'voice_t'),
	('satpin', 'voice_i', 'voice', 'i', '\\N', 'voice_n', 'voice_p'),
	('satpin', 'voice_t', 'voice', 't', '\\N', 'voice_p', 'voice_a'),
	('satpin', 'voice_a', 'voice', 'a', '\\N', 'voice_t', 'voice_s');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;

-- Dumping structure for table ip47.appconfig
DROP TABLE IF EXISTS `appconfig`;
CREATE TABLE IF NOT EXISTS `appconfig` (
  `imageurl` varchar(50) DEFAULT NULL,
  `soundurl` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ip47.appconfig: ~1 rows (approximately)
/*!40000 ALTER TABLE `appconfig` DISABLE KEYS */;
INSERT INTO `appconfig` (`imageurl`, `soundurl`) VALUES
	('https://s3.us-east-2.amazonaws.com/ip47media/', 'https://s3.us-east-2.amazonaws.com/ip47media/');
/*!40000 ALTER TABLE `appconfig` ENABLE KEYS */;

-- Dumping structure for table ip47.grapheme
DROP TABLE IF EXISTS `grapheme`;
CREATE TABLE IF NOT EXISTS `grapheme` (
  `grapheme` tinytext NOT NULL,
  `graphsound` varchar(100) DEFAULT NULL,
  `graphword` varchar(50) DEFAULT NULL,
  `graphimage` varchar(100) DEFAULT NULL,
  `graphaudio` varchar(100) DEFAULT NULL,
  `graphtype` tinytext DEFAULT NULL,
  KEY `grapheme_i1` (`grapheme`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ip47.grapheme: ~6 rows (approximately)
/*!40000 ALTER TABLE `grapheme` DISABLE KEYS */;
INSERT INTO `grapheme` (`grapheme`, `graphsound`, `graphword`, `graphimage`, `graphaudio`, `graphtype`) VALUES
	('s', 's', 'salad', 'salad.png', 's.mp3', 'grapheme'),
	('a', 'a', 'arm', 'arm.png', 'a.mp3', 'grapheme'),
	('t', 't', 'tattoo', 'tattoo.png', 't.mp3', 'grapheme'),
	('p', 'p', 'pen', 'pen.png', 'p.mp3', 'grapheme'),
	('i', 'i', 'inch', 'inch.png', 'i.mp3', 'grapheme'),
	('n', 'n', 'numbers', 'numbers.png', 'n.mp3', 'grapheme');
/*!40000 ALTER TABLE `grapheme` ENABLE KEYS */;

-- Dumping structure for table ip47.lesson
DROP TABLE IF EXISTS `lesson`;
CREATE TABLE IF NOT EXISTS `lesson` (
  `lessonname` varchar(50) NOT NULL,
  `lessontype` tinytext DEFAULT NULL,
  KEY `lesson_i1` (`lessonname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ip47.lesson: ~0 rows (approximately)
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
INSERT INTO `lesson` (`lessonname`, `lessontype`) VALUES
	('satpin', NULL);
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;

-- Dumping structure for table ip47.practice
DROP TABLE IF EXISTS `practice`;
CREATE TABLE IF NOT EXISTS `practice` (
  `lesson` varchar(50) DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL,
  `possibleanswer` text DEFAULT NULL,
  `correctanswer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ip47.practice: ~6 rows (approximately)
/*!40000 ALTER TABLE `practice` DISABLE KEYS */;
INSERT INTO `practice` (`lesson`, `activity`, `possibleanswer`, `correctanswer`) VALUES
	('satpin', 'sound', 's', 'c,s,z'),
	('satpin', 'sound', 'a', 'a,i,u'),
	('satpin', 'sound', 't', 't,th,j'),
	('satpin', 'sound', 'p', 'p,ph,k'),
	('satpin', 'sound', 'i', 'i,e,y'),
	('satpin', 'sound', 'n', 'n,m,w');
/*!40000 ALTER TABLE `practice` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
