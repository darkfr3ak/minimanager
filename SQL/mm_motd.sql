-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               5.5.20 - MySQL Community Server (GPL)
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             7.0.0.4379
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Exportiere Daten aus Tabelle mmfpm.mm_motd: 1 rows
DELETE FROM `mm_motd`;
/*!40000 ALTER TABLE `mm_motd` DISABLE KEYS */;
INSERT INTO `mm_motd` (`id`, `realmid`, `type`, `content`) VALUES
	(1, 1, '02/05/10 14:29:07 Posted by: MiniManager Team', 'Hello Admin\r\n\r\nhelp supporting Minimanager\r\n\r\nhttp://www.trinityscripts.xe.cx\r\n\r\nif you found a bug or improved it, please contribute\r\n\r\nor it will eventually stop development from lack of interrest from community ');
/*!40000 ALTER TABLE `mm_motd` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
