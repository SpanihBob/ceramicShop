-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.8.4-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.1.0.6537
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
  `categoryTableName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.category: ~5 rows (приблизительно)
DELETE FROM `category`;
INSERT INTO `category` (`id`, `categoryName`, `categoryMicroImage`, `categoryTableName`) VALUES
	(1, 'Посуда', 'тарелка.png', 'crockery'),
	(2, 'Коллекции', 'коллекция.png', 'collection'),
	(3, 'Интерьер', 'ваза.png', 'interior'),
	(4, 'Изделия на заказ', 'на заказ.png', 'productsToOrder'),
	(5, 'Скидки', 'скидки.png', 'sale');

-- Дамп структуры для таблица diploma.crockery
CREATE TABLE IF NOT EXISTS `crockery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crockeryName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crockeryImage` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='посуда';

-- Дамп данных таблицы diploma.crockery: ~4 rows (приблизительно)
DELETE FROM `crockery`;
INSERT INTO `crockery` (`id`, `crockeryName`, `crockeryImage`) VALUES
	(1, 'Тарелки', 'тарелка.jpg'),
	(2, 'Чайные пары', 'пара.jpg'),
	(3, 'Соусники', 'соус4.jpg'),
	(4, 'Кружки', 'кр4.jpg');

-- Дамп структуры для таблица diploma.main
CREATE TABLE IF NOT EXISTS `main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.main: ~4 rows (приблизительно)
DELETE FROM `main`;
INSERT INTO `main` (`id`, `img`, `text`) VALUES
	(1, 'тарелки0Главная.jpg', 'Это проект о красоте, гармонии и легкости. \r\n\r\nПосуда и декор ручной работы из керамики и фарфора, созданная русским \r\n\r\nдизайнером - керамистом Александрой Малаховой. '),
	(2, 'тарелки1Главная.jpg', 'Это проект о красоте, гармонии и легкости. \r\n\r\nПосуда и декор ручной работы из керамики и фарфора, созданная русским \r\n\r\nдизайнером - керамистом Александрой Малаховой. '),
	(3, 'тарелки2Главная.jpg', 'Это проект о красоте, гармонии и легкости. \r\n\r\nПосуда и декор ручной работы из керамики и фарфора, созданная русским \r\n\r\nдизайнером - керамистом Александрой Малаховой. '),
	(4, 'тарелки3Главная.jpg', 'Это проект о красоте, гармонии и легкости. \r\n\r\nПосуда и декор ручной работы из керамики и фарфора, созданная русским \r\n\r\nдизайнером - керамистом Александрой Малаховой. ');

-- Дамп структуры для таблица diploma.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'имя',
  `category` int(11) DEFAULT NULL COMMENT 'категория',
  `subcategory` int(11) DEFAULT NULL COMMENT 'подкатегория',
  `price` int(11) DEFAULT NULL COMMENT 'цена',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'описание',
  `amount` int(11) DEFAULT NULL COMMENT 'колличество',
  `poster` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'картинка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.product: ~19 rows (приблизительно)
DELETE FROM `product`;
INSERT INTO `product` (`id`, `name`, `category`, `subcategory`, `price`, `description`, `amount`, `poster`) VALUES
	(1, 'тарелка 1', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 4, 'тар1.jpg'),
	(2, 'тарелка 2', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 5, 'тар2.jpg'),
	(3, 'тарелка 3', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'тар3.jpg'),
	(4, 'тарелка 4', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 4, 'тар4.jpg'),
	(5, 'тарелка 5', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 5, 'тар5.jpg'),
	(6, 'тарелка 6', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'тарелка.jpg'),
	(7, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'пара1.jpg'),
	(8, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'пара2.jpg'),
	(9, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'пара3.jpg'),
	(10, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'пара4.jpg'),
	(11, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус1.jpg'),
	(12, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус2.jpg'),
	(13, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус3.jpg'),
	(14, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус4.jpg'),
	(15, 'кружка', 1, 4, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр1.jpg'),
	(16, 'кружка', 1, 4, 1233, 'сммив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр2.jpg'),
	(17, 'кружка', 1, 4, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр3.jpg'),
	(18, 'кружка', 1, 4, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр4.jpg'),
	(19, 'чайная пара', 1, 2, 123, 'dsfgsdfgs fedgf d d fg d', 4, 'пара.jpg');

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
  `time_signup` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.users: ~1 rows (приблизительно)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `lastname`, `country`, `city`, `street`, `house`, `apartment`, `postcode`, `avatar`, `time_signup`) VALUES
	(5, '111', '$2y$10$fC/.JXaE3jRgL/knRVoTXOku3BAnZy/.Oxhii7TCug6bG/2jBhSXK', 'SpanihBob@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1662533535);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
