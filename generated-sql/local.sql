-- --------------------------------------------------------
-- Host:                         192.168.33.10
-- Versión del servidor:         5.6.26-74.0 - Percona Server (GPL), Release 74.0, Revision 32f8dfd
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para rockolaweb
DROP DATABASE IF EXISTS `rockolaweb`;
CREATE DATABASE IF NOT EXISTS `rockolaweb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `rockolaweb`;


-- Volcando estructura para tabla rockolaweb.author
DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nationality` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla rockolaweb.author: ~7 rows (aproximadamente)
DELETE FROM `author`;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` (`id`, `name`, `nationality`) VALUES
	(1, 'Juanes', '1'),
	(2, 'Juan Luis Guerra', ''),
	(3, 'Metallica', ''),
	(4, 'Jaguares', ''),
	(5, 'Tucanes', ''),
	(6, 'Vicente Fernandez', ''),
	(7, 'Avivamiento', 'CO'),
	(8, 'Lebron Brothers', ''),
	(9, 'JOE CUBA', ''),
	(10, 'SEXTETO JUVENTUD', ''),
	(11, 'Andy Montañez', ''),
	(12, 'El Gran Combo', ''),
	(13, 'Tito Nieves', ''),
	(14, 'hector lavoe', ''),
	(15, 'Sonora Dinamita & Rodolfo Aicardi', ''),
	(16, 'RODOLFO Y SU TIPICA R.A.7', '');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;


-- Volcando estructura para tabla rockolaweb.genders
DROP TABLE IF EXISTS `genders`;
CREATE TABLE IF NOT EXISTS `genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla rockolaweb.genders: ~5 rows (aproximadamente)
DELETE FROM `genders`;
/*!40000 ALTER TABLE `genders` DISABLE KEYS */;
INSERT INTO `genders` (`id`, `name`) VALUES
	(1, 'Tropical'),
	(2, 'Rock'),
	(3, 'Salsa'),
	(4, 'Vallenato'),
	(5, 'Gospel');
/*!40000 ALTER TABLE `genders` ENABLE KEYS */;


-- Volcando estructura para tabla rockolaweb.music
DROP TABLE IF EXISTS `music`;
CREATE TABLE IF NOT EXISTS `music` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `rock_id` varchar(24) NOT NULL,
  `youtube_id` varchar(24) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `countplay` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `music_fi_43d98c` (`gender_id`),
  KEY `music_fi_ea464c` (`author_id`),
  CONSTRAINT `music_fk_43d98c` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`),
  CONSTRAINT `music_fk_ea464c` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla rockolaweb.music: ~31 rows (aproximadamente)
DELETE FROM `music`;
/*!40000 ALTER TABLE `music` DISABLE KEYS */;
INSERT INTO `music` (`id`, `title`, `rock_id`, `youtube_id`, `gender_id`, `author_id`, `countplay`) VALUES
	(2, 'Te seguiré', '00002', 'zqnqEuI2l1k', 5, 7, 0),
	(3, 'Mi Amigo es real', '00003', 'kbCGkqX8mjY', 5, 7, 0),
	(4, 'Echa sobre Él tu carga', '00004', 'ZLeVWdli5xM', 5, 7, 0),
	(5, 'Carpintero de Galilea', '00005', 'V28aQCYGhJQ', 5, 7, 0),
	(6, 'El Rey me llamó', '00006', 'oyS3_QqKk3w', 5, 7, 0),
	(7, 'Vine a darte gracias', '00007', 'zfcEc5YVUZY', 5, 7, 0),
	(8, 'Tu gloria mi Señor', '00008', 'D-eyPU4WRL0', 5, 7, 0),
	(9, 'En Tu habitación', '00009', 'GbM5VkcyFNs', 5, 4, 0),
	(10, 'Espíritu Santo mi Mejor Amigo', '00010', 'N-7FhWGRjT4', 5, 7, 0),
	(11, 'Mi alma se aferra a Ti', '00011', 'UjNAm99xibY', 5, 7, 0),
	(12, 'Mi deseo es para Ti', '00012', '6jqdthTO9Lk', 5, 7, 0),
	(13, 'Tiempos mejores', '00013', 'E-7AOpcvLmU', 5, 7, 0),
	(14, 'Fortaléceme mi Dios', '00014', '8K4y4fkNIn8', 5, 7, 0),
	(15, 'Confesaré mis transgresiones', '00015', 'AQbjECQQEhs', 5, 7, 0),
	(16, 'No me dejes de hablar', '00016', '8FUw6S81vH4', 5, 7, 0),
	(17, 'En Tu nombre me levantaré', '00017', 'JrOfKwzzeUw', 5, 7, 0),
	(18, 'A dónde huiré', '00018', '5xAbSFAdvdA', 5, 7, 0),
	(19, 'Que suba el pozo', '00019', 'Ppk6SaBNzPo', 5, 7, 0),
	(20, 'Un día te veré', '00020', 'sfBxSGk89rk', 5, 7, 0),
	(21, 'Conozco que todo lo puedes', '00021', 'VlG9-rSPuo0', 5, 7, 0),
	(22, 'Río de fuego', '00022', 'ah-t7MhJDRs', 5, 7, 0),
	(23, 'Es mi Jesús', '00023', '9vD7oftpM9M', 5, 7, 0),
	(24, 'Examíname', '00024', '4gwj2M2VxUk', 5, 7, 0),
	(25, 'Hosanna', '00025', 'LkOm2ekpGdY', 5, 7, 0),
	(26, 'Rey de Gloria', '00026', 'UstRAYv1hXE', 5, 7, 0),
	(27, 'Para Ti yo canto', '00027', 'xmY6gpG5yqA', 5, 7, 0),
	(28, 'Eres bueno', '00028', 'mVrWN8SQ_1U', 5, 7, 0),
	(29, 'Dios es bueno', '00029', 'RzaJINnsMA4', 5, 7, 0),
	(30, 'Como torrente Tú desciendes', '00030', 'Yvj9yg6u9HA', 5, 7, 0),
	(31, 'Al despertar', '00031', '-sa3nMr2TK0', 5, 7, 0),
	(32, 'Solo Tú eres digno', '00032', 'HyhxoGB2iYE', 5, 7, 0),
	(33, 'La Temperatura', '00033', 'AYc8SC5nnNA', 3, 8, 0),
	(34, 'Que Pena', '00034', '3_Ps6pfXCxY', 3, 8, 0),
	(35, 'MUJER DIVINA', '00035', 'gr2lstzz4wo', 3, 10, 0),
	(36, 'ESPIRITUALMENTE', '00036', 'rLoW39AKRCg', 3, 9, 0),
	(37, 'milonga para una niña', '00037', 'SGs8hAdPAXQ', 3, 11, 0),
	(38, 'Señora Ley', '00038', 'cluqvDJm-fA', 3, 13, 0),
	(39, 'Esos ojitos negros', '00039', 'IwG6g8xAgS0', 3, 12, 0),
	(40, 'Ella mintió', '00040', 'uc0Xtnjh_q8', 3, 14, 0),
	(42, 'Ciclón', '00041', 'hry5URsYkog', 1, 15, 0),
	(46, 'LA COLEGIALA', '00042', 'RYrMaoOsJJA', 1, 16, 0),
	(47, 'Cumbia con un vaso de cerveza', '00043', 'YR3sLXyr6oc', 1, 15, 0);
/*!40000 ALTER TABLE `music` ENABLE KEYS */;


-- Volcando estructura para tabla rockolaweb.songlist
DROP TABLE IF EXISTS `songlist`;
CREATE TABLE IF NOT EXISTS `songlist` (
  `time` double NOT NULL,
  `song` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`time`),
  KEY `song` (`song`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla rockolaweb.songlist: ~0 rows (aproximadamente)
DELETE FROM `songlist`;
/*!40000 ALTER TABLE `songlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `songlist` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
