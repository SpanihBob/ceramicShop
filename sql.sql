-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.6.7-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных diploma
CREATE DATABASE IF NOT EXISTS `diploma` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `diploma`;

-- Дамп структуры для таблица diploma.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryMicroImage` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.category: ~5 rows (приблизительно)
DELETE FROM `category`;
INSERT INTO `category` (`id`, `categoryName`, `categoryMicroImage`) VALUES
	(1, 'Посуда', 'тарелка.png'),
	(2, 'Коллекции', 'коллекция.png'),
	(3, 'Интерьер', 'ваза.png'),
	(4, 'Изделия на заказ', 'на заказ.png'),
	(5, 'Скидки', 'скидки.png');

-- Дамп структуры для таблица diploma.crockery
CREATE TABLE IF NOT EXISTS `crockery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crockeryName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crockeryImage` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='посуда';

-- Дамп данных таблицы diploma.crockery: ~5 rows (приблизительно)
DELETE FROM `crockery`;
INSERT INTO `crockery` (`id`, `crockeryName`, `crockeryImage`) VALUES
	(1, 'Тарелки', 'тарелка.jpg'),
	(2, 'Чайные пары', 'пара.jpg'),
	(3, 'Соусники', 'соус.jpg'),
	(4, 'Кружки', 'кружка.jpg');

-- Дамп структуры для таблица diploma.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house` int(11) DEFAULT NULL,
  `apartment` int(11) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `avatar` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.users: ~0 rows (приблизительно)
DELETE FROM `users`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
