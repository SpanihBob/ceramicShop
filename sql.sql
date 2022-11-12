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

-- Дамп структуры для таблица diploma.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL COMMENT 'id товара',
  `user_id` int(11) DEFAULT NULL COMMENT 'id пользователя',
  `count` int(11) DEFAULT NULL COMMENT 'кол-во товара',
  `add_time` int(11) DEFAULT NULL COMMENT 'время добавления в корзину',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='корзина';

-- Дамп данных таблицы diploma.cart: ~11 rows (приблизительно)
DELETE FROM `cart`;
INSERT INTO `cart` (`id`, `product_id`, `user_id`, `count`, `add_time`) VALUES
	(100, 22, 5, 1, 1668239143),
	(101, 23, 5, 1, 1668239169),
	(102, 14, 5, 1, 1668239180);

-- Дамп структуры для таблица diploma.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryMicroImage` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryTableName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='категории';

-- Дамп данных таблицы diploma.category: ~5 rows (приблизительно)
DELETE FROM `category`;
INSERT INTO `category` (`id`, `categoryName`, `categoryMicroImage`, `categoryTableName`) VALUES
	(1, 'Посуда', 'тарелка.png', 'crockery'),
	(2, 'Коллекции', 'коллекция.png', 'collection'),
	(3, 'Интерьер', 'ваза.png', 'interior'),
	(4, 'Изделия на заказ', 'на заказ.png', 'productsToOrder');

-- Дамп структуры для таблица diploma.collections
CREATE TABLE IF NOT EXISTS `collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.collections: ~2 rows (приблизительно)
DELETE FROM `collections`;
INSERT INTO `collections` (`id`, `name`, `image`) VALUES
	(1, 'Фантазия', 'keramicheskaya-posuda-2.jpg'),
	(2, 'Времена года', 'keramicheskaya-posuda-2.jpg');

-- Дамп структуры для таблица diploma.crockery
CREATE TABLE IF NOT EXISTS `crockery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='посуда';

-- Дамп данных таблицы diploma.crockery: ~4 rows (приблизительно)
DELETE FROM `crockery`;
INSERT INTO `crockery` (`id`, `name`, `image`) VALUES
	(1, 'Тарелки', 'тарелка.jpg'),
	(2, 'Чайные пары', 'пара.jpg'),
	(3, 'Соусники', 'соус4.jpg'),
	(4, 'Кружки', 'кр4.jpg');

-- Дамп структуры для таблица diploma.favor
CREATE TABLE IF NOT EXISTS `favor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.favor: ~7 rows (приблизительно)
DELETE FROM `favor`;
INSERT INTO `favor` (`id`, `product_id`, `user_id`) VALUES
	(35, 10, 5),
	(36, 4, 5),
	(37, 2, 5),
	(38, 25, 5),
	(39, 24, 5),
	(40, 16, 5),
	(41, 11, 5),
	(42, 21, 5);

-- Дамп структуры для таблица diploma.interior
CREATE TABLE IF NOT EXISTS `interior` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.interior: ~2 rows (приблизительно)
DELETE FROM `interior`;
INSERT INTO `interior` (`id`, `name`, `image`) VALUES
	(1, 'Вазы', '4846_big.jpg'),
	(2, 'Скульптура', 'sfdgvkdmfbgkls.jpg');

-- Дамп структуры для таблица diploma.main
CREATE TABLE IF NOT EXISTS `main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='главная';

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
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='продукты';

-- Дамп данных таблицы diploma.product: ~25 rows (приблизительно)
DELETE FROM `product`;
INSERT INTO `product` (`id`, `name`, `category`, `subcategory`, `price`, `description`, `amount`, `poster`, `image`, `table_name`) VALUES
	(1, 'тарелка 1', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 4, 'тар1.jpg', 'тар1.jpg, 1.jpg, 2.jpg, 3.jpg, 4.jpg, 5.jpg, 6.jpg, 7.jpg', 'product'),
	(2, 'тарелка 2', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 5, 'тар2.jpg', 'тар2.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(3, 'тарелка 3', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'тар3.jpg', 'тар3.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(4, 'тарелка 4', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 4, 'тар4.jpg', 'тар4.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(5, 'тарелка 5', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 5, 'тар5.jpg', 'тар5.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(6, 'тарелка 6', 1, 1, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'тарелка.jpg', 'тарелка.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(7, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'пара1.jpg', 'пара1.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(8, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'пара2.jpg', 'пара2.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(9, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'пара3.jpg', 'пара3.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(10, 'чайная пара', 1, 2, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'пара4.jpg', 'пара4.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(11, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус1.jpg', 'соус1.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(12, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус2.jpg', 'соус2.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(13, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус3.jpg', 'соус3.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(14, 'Соусник', 1, 3, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 7, 'соус4.jpg', 'соус4.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(15, 'кружка', 1, 4, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр1.jpg', 'кр1.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(16, 'кружка', 1, 4, 1233, 'сммив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр2.jpg', 'кр2.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(17, 'кружка', 1, 4, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр3.jpg', 'кр3.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(18, 'кружка', 1, 4, 1233, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 8, 'кр4.jpg', 'кр4.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(19, 'чайная пара', 1, 2, 123, 'dsfgsdfgs fedgf d d fg d', 4, 'пара.jpg', 'пара.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product'),
	(20, 'Весенняя', 2, 2, 4332, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 2, 'images (10).jpg', 'images (10).jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product_collections'),
	(21, 'Осенняя', 2, 2, 3223, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 3, '1020x0_zktohkkeioyanctl_jpg_6b12.jpg', '1020x0_zktohkkeioyanctl_jpg_6b12.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product_collections'),
	(22, 'Фэнтази', 2, 1, 4432, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 6, 'тарелки3главная.jpg', 'тарелки3главная.jpg, 1.jpg, 2.jpg, 3.jpg, 4.jpg, 5.jpg, 6.jpg, 7.jpg', 'product_collections'),
	(23, 'Ваза 1', 3, 1, 3223, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 5, '400.jpg', '400.jpg, 1.jpg, 2.jpg, 3.jpg, 4.jpg, 5.jpg, 6.jpg, 7.jpg', 'product_interior'),
	(24, 'Ваза 2', 3, 1, 2343, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 3, '400.jpg', '400.jpg, 1.jpg, 2.jpg, 3.jpg, 4.jpg, 5.jpg, 6.jpg, 7.jpg', 'product_interior'),
	(25, 'Скульптура', 3, 2, 3421, 'ив ифвбьаоифьбво иафывлоиафылвоиалыбои влоиыв', 3, 'sfdgvkdmfbgkls.jpg', 'sfdgvkdmfbgkls.jpg, тар1.jpg, тар2.jpg, тар3.jpg, тар1.jpg, тар1.jpg', 'product_interior');

-- Дамп структуры для таблица diploma.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'логин',
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'пароль',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'емайл',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'имя',
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'фамилия',
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'город',
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'страна',
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'улица',
  `house` int(11) DEFAULT NULL COMMENT 'дом',
  `apartment` int(11) DEFAULT NULL COMMENT 'квартира',
  `postcode` int(11) DEFAULT NULL COMMENT 'индекс',
  `avatar` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'аватарка',
  `time_signup` int(20) DEFAULT NULL COMMENT 'время создания учетной записи',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='пользователи';

-- Дамп данных таблицы diploma.users: ~1 rows (приблизительно)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `lastname`, `country`, `city`, `street`, `house`, `apartment`, `postcode`, `avatar`, `time_signup`) VALUES
	(5, '111', '$2y$10$fC/.JXaE3jRgL/knRVoTXOku3BAnZy/.Oxhii7TCug6bG/2jBhSXK', 'SpanihBob@gmail.com', 'Ася', 'Семенова', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000, '11116602.jpg', 1662533535);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
