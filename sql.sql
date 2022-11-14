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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='корзина';

-- Дамп данных таблицы diploma.cart: ~7 rows (приблизительно)
DELETE FROM `cart`;
INSERT INTO `cart` (`id`, `product_id`, `user_id`, `count`, `add_time`) VALUES
	(91, 23, 5, 1, 1668185706),
	(92, 24, 5, 1, 1668185710),
	(93, 1, 5, 1, 1668270132),
	(94, 4, 5, 1, 1668270394),
	(95, 5, 5, 1, 1668270943),
	(96, 3, 5, 1, 1668273862),
	(97, 2, 5, 1, 1668281774);

-- Дамп структуры для таблица diploma.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryMicroImage` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryTableName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='категории';

-- Дамп данных таблицы diploma.category: ~4 rows (приблизительно)
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
	(2, 'Времена года', '5d745e3f2661205065a5029954qi--posuda-mertsayuschij-serviz-avtorskij-nabor-posudy-ruchnoj-ra.jpg');

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
	(2, 'Сервизы', 'пара.jpg'),
	(3, 'Соусники', 'соус4.jpg'),
	(4, 'Кружки', 'кр4.jpg');

-- Дамп структуры для таблица diploma.favor
CREATE TABLE IF NOT EXISTS `favor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.favor: ~5 rows (приблизительно)
DELETE FROM `favor`;
INSERT INTO `favor` (`id`, `product_id`, `user_id`) VALUES
	(36, 22, 5),
	(37, 24, 5),
	(38, 1, 5),
	(39, 23, 5),
	(40, 3, 5);

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
  `name_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'имя url',
  `category` int(11) DEFAULT NULL COMMENT 'категория',
  `subcategory` int(11) DEFAULT NULL COMMENT 'подкатегория',
  `price` int(11) DEFAULT NULL COMMENT 'цена',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'описание',
  `amount` int(11) DEFAULT NULL COMMENT 'колличество',
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='продукты';

-- Дамп данных таблицы diploma.product: ~24 rows (приблизительно)
DELETE FROM `product`;
INSERT INTO `product` (`id`, `name`, `name_url`, `category`, `subcategory`, `price`, `description`, `amount`, `image`, `table_name`) VALUES
	(1, 'ТАРЕЛКА ГЛУБОКАЯ АССИМЕТРИЧНАЯ "КРАФТ"', 'tarelka-cg-2020-677', 1, 1, 3499, 'Тарелка асиметричной формы глубокая ручной работы, диаметр 20см, оливковая. Керамика, полуфарфор', 4, '4f37789e77ccc9264dce6a8cee67.jpeg, 49b816286647442af5bf3171d884.jpeg', 'product'),
	(2, 'БЛЮДО "РАКУШКА МОРЕ"', 'blyudo-cg-2020-547', 1, 1, 1610, 'Блюдо керамическое большое изготовлено мастером  вручную из глины. Подойдет для нарезки. Покрыто безопасными для здоровья пищевыми глазурями (цвет ультрамарин).', 5, '09eb7bd5dc2d4cae24df1c30e811.jpeg', 'product'),
	(3, 'ТАРЕЛКА БОЛЬШАЯ АССИМЕТРИЧНАЯ "КРАФТ"', 'tarelka-cg-2020-548', 1, 1, 1610, 'Тарелка асиметричной формы ручной работы, диаметр 25см, белая, посыпанная коричневой крошкой. Керамика, полуфарфор', 6, '9fb6a22f03d7f8d34ff36431da5c.jpeg, 1f16b7c166e4ec0400ac5aae84ae.jpeg', 'product'),
	(4, 'ТАРЕЛКА ОБЕДЕННАЯ ДЗЕНАРТ СЛОНОВАЯ КОСТЬ', 'tarelka-yablochki-cg-2020-685', 1, 1, 1500, 'Тарелка обеденная с текстурным узором в стиле Дзенарт, Диаметр 25 см, мягкий фарфор, цвет слоновая кость, ручная работа', 4, '9558b222ec95cc1a9717c58132ea.jpeg, 14d2fe15058cdbcb6800ef6af243.jpeg, 6baaeffedd763fd246dfff8efbd8.jpeg', 'product'),
	(5, 'БЛЮДО "ЖЕМЧУГ ВИНТАЖ"', 'blyudo-cg-2019-052', 1, 1, 2500, 'Блюдо в виде ракушки, 27 на 29см, белое глянцевое, полуфарфор', 5, 'e83ac7d11d03753df95148553ba1.jpeg, d7c43e5fb44fa267e8ac65431b8f.jpeg, e5a7e7069a696193fc021ce8292c.jpeg, b206d8f7b6ba6954c21013b8ca80.jpeg, 70bbb5874d3c6b47837f8818a465.jpeg', 'product'),
	(6, 'БЛЮДО "ЖЕМЧУЖНАЯ РАКУШКА"', 'blyudo-cg-2020-496', 1, 1, 2300, 'Блюдо в виде ракушки, 27 на 29см, белое глянцевое, полуфарфор', 6, '1c52293606f01a8378fbc83f9e22.jpeg, da3f90c91e10b971c89a16992593.jpeg, f98e92f35be5cec7318800fef8fb.jpeg, 9ea61ff013639dc653be483252cc.jpeg, ba08c2101efe2a0539cddabbdfde.jpeg', 'product'),
	(7, 'СЕРВИЗ "ДЗЕНАРТ МОРЕ ОТТЕНКИ" НА 6 ПЕРСОН, БОЛЬШОЙ', 'serviz-zhyolud-cg-2020-310', 1, 2, 4500, 'Сервиз ручной работы с текстурно росписью и несколькими оттенками синего цвета. 37 предметов: 6 больших тарелок 29см, 6 глубоких тарелок 20см (высота 5см), 6 десертных тарелок 17,5см, 6 кружек 350мл, 3 соусника, 3 блюдца в виде пера для закусок, кувшин 750мл, чайник заварочный 700мл, блюдо в виде ракушки 29см, салатница в виде ракушки 17*22см, сахарница 300мл с надписью Сахар, солонка и перечница. Ручная работа. Полуфарфор. Сине-голубой глянцевый цвет. Текстурная роспись.', 6, 'aa7ffb7f1eab4a1a34d8a11bb3b1.jpeg, b0a6df965649e2deb8bf8e82651b.jpeg, b0a6df965649e2deb8bf8e82651b.jpeg, 957fc69e2d9270e12a10a629f373.jpeg, 5c4500d31bd5ea67ac7f453f71db.jpeg, 1f5d342aca15cb69c5ddbe9847ec.jpeg', 'product'),
	(8, 'СЕРВИЗ "КРАФТ" НА 4 ПЕРСОНЫ 14 ПРЕДМЕТОВ', 'serviz-zhyolud-cg-2020-311', 1, 2, 4400, 'Сервиз ручной работы с ассиметричными тарелками в крафовом стиле, оливковый. 4 персоны, 14 предметов. 4 тарелки 25см, 4 глубоких тарелки 20см, 4 кружки 330мл, 1 чайник (600см, 12см), 1 соусник/подсвечник с ручкой', 6, '6ac35d21845f302b3239fb3e4fd9.jpeg, 74c281b58af00031179021708301.jpeg, e8bdc67b9e6b78acd60b120729b1.jpeg, 40897915581c79ee386d8ce355b8.jpeg', 'product'),
	(9, 'СЕРВИЗ ЧАЙНЫЙ БЕЛЫЙ ЖЕМЧУГ С МЯТЫМИ ЧАШКАМИ, 6 ПЕРСОН, 14 ПРЕДМЕТОВ', 'serviz-zhyolud-cg-2020-345', 1, 2, 4500, 'Авторский экзсклюзивный чайный сервиз ручной работы на 6 персон: 14 предметов. 6 чайных чашек 250мл, 6 блюдец, 1 чайник, 1 сахарница. Белый, глянцевый. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор.', 6, '3b17495ca9935ee5914be8786e01.jpeg, ca649c05f5557fb7325e2485a489.jpeg', 'product'),
	(10, 'СЕРВИЗ "ЖЕМЧУЖИНА СЕРВИРОВКИ" С МЯТЫМИ ЧАШКАМИ, 49 ПРЕДЕМЕТОВ', 'serviz-zhyolud-cg-2020-354', 1, 2, 3800, 'Авторский экзсклюзивный чайный сервиз ручной работы на 6 персон. 49 предметов: 6 чайных чашек 250мл, 6 блюдец, 6 соусников, 6 подстановочных тарелок 27см, 6 обеденных тарелок 22см, 6 пиал, 1 кувшин на 750мл, 1 чайник 600мл , 1 сахарница 300мл 1 блюдо 25 на 23см, 1 салатница в виде ракушки, 1 блюдо в виде ракушки, тортовница, 6 колец для салфеток. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор. Цвет - Белый, глянцевый', 7, '1be5e6cca5e17edd0a750bb54a0c.jpeg, 240b2ae6567f93d6318567fc4da5.jpeg, 0b4b90524d77512cae8fae904b9f.jpeg, ee0c63100f4f7bea8a4f781648b0.jpeg, af0de661eef1f80037693f9e8c12.jpeg, 61256db8efa75842fe1b1a588956.jpeg', 'product'),
	(11, 'СОУСНИК "КРАФТ" С РУЧКОЙ', 'cg-2020-449', 1, 3, 230, 'Соусник минималистичный с ручкой ручной работы. Белый, оливковый. Соусник стилизованный под алюминиевую посуду. Керамика, полуфарфор', 7, '2fe8ba94560f17d7040fb6e56df5.jpeg', 'product'),
	(12, 'СОУСНИК "КРАФТ" С РУЧКОЙ', 'cg-2020-393', 1, 3, 380, 'Соусник минималистичный с ручкой ручной работы. Белый, посыпанный крошкой. Соусник стилизованный под алюминиевую посуду. Керамика, полуфарфор', 7, 'e01d1b32d0a519b5307ef8e70b31.jpeg, 338f38d0384a1984626115d216fc.jpeg', 'product'),
	(13, 'СОУСНИК "БЕЛЫЙ ЖЕМЧУГ"', 'cg-2020-373', 1, 3, 288, 'Соусник ручной работы для стильной сервировки с рельефной текстурой. Мягкий фарфор. Белый, глянцевый', 7, '4da89ee357da27a75cc3c4fdbda9.jpeg, 72bfbe4222f51144a886e3e00767.jpeg', 'product'),
	(14, 'СОУСНИК "ДЗЕНАРТ МОРЕ"', 'cg-2020-3754', 1, 3, 250, 'Соусник с рельефным кантом, Диаметр 7,5 см, Высота 4см, мягкий фарфор, синего цвета, ручная работа', 7, '417b3138c787aa51b924e6b535c8.jpeg, 98ac9d0326d845fea8943e270207.jpeg', 'product'),
	(15, 'КРУЖКА "КРАФТ"', 'kruzhka-kraft102308', 1, 4, 1380, 'Кружка 330мл с выдавленным текстом, ручной работы, высота 10см', 8, 'cb3447b4c5a80e65d77ef2e79405.jpeg', 'product'),
	(16, 'КРУЖКА "КРАФТ"', 'kruzhka-kraft102309', 1, 4, 804, 'Кружка 330мл, ручной работы, высота 10см, посыпанная крошкой, керамика, полуфарфор', 8, 'e864cd575a8877bcdc60002c4988.jpeg', 'product'),
	(17, 'КРУЖКА МИНИМАЛИЗМ "РАССВЕТ"', 'cg-2020-503', 1, 4, 690, 'Керамическая кружка для молока “Пчёлки” изготовлена вручную на гончарном круге. Кружка покрыта безопасными для здоровья пищевыми глазурями. Ручная роспись – надглазурная краска.', 8, 'cb3447b4c5a80e65d77ef2e79405.jpeg', 'product'),
	(18, 'КРУЖКА "СПИРАЛЬ БЕЛАЯ"', 'cg-2020-592', 1, 4, 1103, 'Кружка большая ручной работы, 500мл, белая, керамика', 8, '4c8e371dcb65e3a22dc160ddb587.jpeg', 'product'),
	(20, 'КОЛЛЕКЦИЯ "ВЕСЕННЯЯ"', 'vesenniy-281305', 2, 2, 4332, 'Авторский экзсклюзивный сервиз ручной работы на 6 персон: 14 предметов. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор.', 2, 'images (10).jpg', 'product_collections'),
	(21, 'КОЛЛЕКЦИЯ "ОСЕННЯЯ"', 'jsenniy-281305', 2, 2, 3223, 'Авторский экзсклюзивный сервиз ручной работы на 6 персон: 14 предметов. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор.', 3, '1020x0_zktohkkeioyanctl_jpg_6b12.jpg', 'product_collections'),
	(22, 'КОЛЛЕКЦИЯ "ПРЯНИЧНАЯ"', 'prianichnyi-281305', 2, 1, 4432, 'Чайный сервиз ручной работы на 4 персоны, пряничный, с потеками глазури. Чайник 650мл (14см высота), 2 кружки приянично-рифленые 350мл, 2 кружки с потеками глазури 350мл, 2 блюдца лучи 16см, 2 блюдца с мазками глазури 16см', 6, '27359a81156b528c5645e217b745.jpeg, 6c5fa41f8e0d6a436983e432a2a8.jpeg, 598c329dccd4e131d664146c48af.jpeg', 'product_collections'),
	(23, 'Ваза из керамики', 'cg-2020-531', 3, 1, 3550, 'Элегантная керамическая ваза для цветов ручной работы, сине-коричневая матовая глазурованная керамическая посуда, классическая форма.', 5, 'H5d2fa3f752b84df3993c303cb31d8286z.jpg', 'product_interior'),
	(24, 'Ваза Керамика 21 см', 'bolshaya-napolnaya-vaza-dlya-czvetov', 3, 1, 5600, 'Ваза Керамика ручной работы, 21 см', 3, '6032230596.jpg, ', 'product_interior'),
	(25, 'Скульптура "Ворона"', 'malaya-keramicheskaya-skulptura-vorona-2', 3, 2, 4100, 'Малая керамическая скульптура "Ворона". Для оформления и росписи вороны выбраны приятные, мягкие цвета. Роспись осуществлена в городской тематике.', 3, 'skulptura-vorona-vn-01.jpg, skulptura-vorona-vn-02.jpg, skulptura-vorona-vn-03.jpg, skulptura-vorona-vn-04.jpg, skulptura-vorona-vn-05.jpg', 'product_interior');

-- Дамп структуры для таблица diploma.shopping
CREATE TABLE IF NOT EXISTS `shopping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.shopping: ~3 rows (приблизительно)
DELETE FROM `shopping`;
INSERT INTO `shopping` (`id`, `user_id`, `product_id`, `add_time`, `count`) VALUES
	(1, 5, 1, 1668281774, 3),
	(2, 5, 4, 1668281774, 2),
	(3, 9, 5, 1668281774, 54);

-- Дамп структуры для таблица diploma.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'логин',
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'пароль',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'емайл',
  `user_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'имя',
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'фамилия',
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'город',
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'страна',
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'улица',
  `house` int(11) DEFAULT NULL COMMENT 'дом',
  `apartment` int(11) DEFAULT NULL COMMENT 'квартира',
  `postcode` int(11) DEFAULT NULL COMMENT 'индекс',
  `avatar` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'аватарка',
  `time_signup` int(20) DEFAULT NULL COMMENT 'время создания учетной записи',
  `admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='пользователи';

-- Дамп данных таблицы diploma.users: ~2 rows (приблизительно)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `login`, `password`, `email`, `user_name`, `lastname`, `country`, `city`, `street`, `house`, `apartment`, `postcode`, `avatar`, `time_signup`, `admin`) VALUES
	(5, '111', '$2y$10$fC/.JXaE3jRgL/knRVoTXOku3BAnZy/.Oxhii7TCug6bG/2jBhSXK', 'SpanihBob@gmail.com', 'Ася', 'Семенова', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000, '11116602.jpg', 1662533535, 1),
	(9, '222', '$2y$10$m.n41ZLocEMEMFisvulWy.1v7CXe2WgN4xIYgacmgjMdLgY2ZIjvK', 'xxcbgngd@fcvvx.f', 'Иван', 'Иванов', 'Россия', 'Ижевск', 'Колхозная', 4, 2, 426000, '22246231.jpg', 1668283681, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
