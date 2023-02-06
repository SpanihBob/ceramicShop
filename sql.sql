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
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='корзина';

-- Дамп данных таблицы diploma.cart: ~3 rows (приблизительно)
DELETE FROM `cart`;
INSERT INTO `cart` (`id`, `product_id`, `user_id`, `count`, `add_time`) VALUES
	(191, 24, 14, 1, 1670748063),
	(220, 22, 5, 1, 1675242003),
	(226, 15, 5, 1, 1675316536);

-- Дамп структуры для таблица diploma.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `categoryMicroImage` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryTableName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategoryImage` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='категории';

-- Дамп данных таблицы diploma.category: ~9 rows (приблизительно)
DELETE FROM `category`;
INSERT INTO `category` (`id`, `categoryName`, `categoryId`, `categoryMicroImage`, `categoryTableName`, `subcategory`, `subcategoryImage`) VALUES
	(1, 'Посуда', 1, 'тарелка.png', 'crockery', 'Тарелки', 'тарелка.jpg'),
	(2, 'Посуда', 1, 'тарелка.png', 'crockery', 'Сервизы', 'пара.jpg'),
	(3, 'Посуда', 1, 'тарелка.png', 'crockery', 'Соусники', 'соус4.jpg'),
	(4, 'Посуда', 1, 'тарелка.png', 'crockery', 'Кружки', 'кр4.jpg'),
	(5, 'Коллекции', 2, 'коллекция.png', 'collections', 'Фантазия', 'keramicheskaya-posuda-2.jpg'),
	(6, 'Коллекции', 2, 'коллекция.png', 'collections', 'Времена года', '5d745e3f2661205065a5029954qi--posuda-mertsayuschij-serviz-avtorskij-nabor-posudy-ruchnoj-ra.jpg'),
	(7, 'Интерьер', 3, 'ваза.png', 'interior', 'Вазы', '4846_big.jpg'),
	(8, 'Интерьер', 3, 'ваза.png', 'interior', 'Скульптура', 'sfdgvkdmfbgkls.jpg'),
	(130, 'Вазы', 4, 'product_admin.png', 'vaza', 'Вазоны', '400.jpg');

-- Дамп структуры для таблица diploma.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.contacts: ~5 rows (приблизительно)
DELETE FROM `contacts`;
INSERT INTO `contacts` (`id`, `header`, `text`) VALUES
	(1, 'email', 'ceramicart@yandex.ru'),
	(2, 'адрес', 'Ижевск ул. Колхозная 199'),
	(3, 'адрес', 'Ижевск ул. Карла-Маркса 112'),
	(4, 'телефоны', '+79090556819'),
	(5, 'телефоны', '+79040559887');

-- Дамп структуры для таблица diploma.favor
CREATE TABLE IF NOT EXISTS `favor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.favor: ~4 rows (приблизительно)
DELETE FROM `favor`;
INSERT INTO `favor` (`id`, `product_id`, `user_id`) VALUES
	(72, 22, 5),
	(73, 22, 9),
	(74, 1, 9),
	(75, 15, 5);

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
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='продукты';

-- Дамп данных таблицы diploma.product: ~25 rows (приблизительно)
DELETE FROM `product`;
INSERT INTO `product` (`id`, `name`, `category`, `subcategory`, `price`, `description`, `amount`, `image`) VALUES
	(1, 'ТАРЕЛКА ГЛУБОКАЯ АССИМЕТРИЧНАЯ "КРАФТ"', 1, 1, 3499, 'Тарелка асиметричной формы глубокая ручной работы, диаметр 20см, оливковая. Керамика, полуфарфор', 4, '4f37789e77ccc9264dce6a8cee67.jpeg, 49b816286647442af5bf3171d884.jpeg'),
	(2, 'БЛЮДО "РАКУШКА МОРЕ"', 1, 1, 1610, 'Блюдо керамическое большое изготовлено мастером  вручную из глины. Подойдет для нарезки. Покрыто безопасными для здоровья пищевыми глазурями (цвет ультрамарин).', 5, '09eb7bd5dc2d4cae24df1c30e811.jpeg'),
	(3, 'ТАРЕЛКА БОЛЬШАЯ АССИМЕТРИЧНАЯ "КРАФТ"', 1, 1, 1610, 'Тарелка ассиметричной формы ручной работы, диаметр 25см, белая, посыпанная коричневой крошкой. Керамика, полуфарфор', 6, '9fb6a22f03d7f8d34ff36431da5c.jpeg, 1f16b7c166e4ec0400ac5aae84ae.jpeg'),
	(4, 'ТАРЕЛКА ОБЕДЕННАЯ ДЗЕНАРТ СЛОНОВАЯ КОСТЬ', 1, 1, 1500, 'Тарелка обеденная с текстурным узором в стиле Дзенарт, Диаметр 25 см, мягкий фарфор, цвет слоновая кость, ручная работа', 4, '9558b222ec95cc1a9717c58132ea.jpeg, 14d2fe15058cdbcb6800ef6af243.jpeg, 6baaeffedd763fd246dfff8efbd8.jpeg'),
	(5, 'БЛЮДО "ЖЕМЧУГ ВИНТАЖ"', 1, 1, 2500, 'Блюдо в виде ракушки, 27 на 29см, белое глянцевое, полуфарфор', 5, 'e83ac7d11d03753df95148553ba1.jpeg, d7c43e5fb44fa267e8ac65431b8f.jpeg, e5a7e7069a696193fc021ce8292c.jpeg, b206d8f7b6ba6954c21013b8ca80.jpeg, 70bbb5874d3c6b47837f8818a465.jpeg'),
	(6, 'БЛЮДО "ЖЕМЧУЖНАЯ РАКУШКА"', 1, 1, 2300, 'Блюдо в виде ракушки, 27 на 29см, белое глянцевое, полуфарфор', 6, '1c52293606f01a8378fbc83f9e22.jpeg, da3f90c91e10b971c89a16992593.jpeg, f98e92f35be5cec7318800fef8fb.jpeg, 9ea61ff013639dc653be483252cc.jpeg, ba08c2101efe2a0539cddabbdfde.jpeg'),
	(7, 'СЕРВИЗ "ДЗЕНАРТ МОРЕ ОТТЕНКИ" НА 6 ПЕРСОН, БОЛЬШОЙ', 1, 2, 4500, 'Сервиз ручной работы с текстурно росписью и несколькими оттенками синего цвета. 37 предметов: 6 больших тарелок 29см, 6 глубоких тарелок 20см (высота 5см), 6 десертных тарелок 17,5см, 6 кружек 350мл, 3 соусника, 3 блюдца в виде пера для закусок, кувшин 750мл, чайник заварочный 700мл, блюдо в виде ракушки 29см, салатница в виде ракушки 17*22см, сахарница 300мл с надписью Сахар, солонка и перечница. Ручная работа. Полуфарфор. Сине-голубой глянцевый цвет. Текстурная роспись.', 6, 'aa7ffb7f1eab4a1a34d8a11bb3b1.jpeg, b0a6df965649e2deb8bf8e82651b.jpeg, 957fc69e2d9270e12a10a629f373.jpeg, 5c4500d31bd5ea67ac7f453f71db.jpeg, 1f5d342aca15cb69c5ddbe9847ec.jpeg'),
	(8, 'СЕРВИЗ "КРАФТ" НА 4 ПЕРСОНЫ 14 ПРЕДМЕТОВ', 1, 2, 4400, 'Сервиз ручной работы с ассиметричными тарелками в крафовом стиле, оливковый. 4 персоны, 14 предметов. 4 тарелки 25см, 4 глубоких тарелки 20см, 4 кружки 330мл, 1 чайник (600см, 12см), 1 соусник/подсвечник с ручкой', 6, '6ac35d21845f302b3239fb3e4fd9.jpeg, 74c281b58af00031179021708301.jpeg, e8bdc67b9e6b78acd60b120729b1.jpeg, 40897915581c79ee386d8ce355b8.jpeg'),
	(9, 'СЕРВИЗ ЧАЙНЫЙ БЕЛЫЙ ЖЕМЧУГ С МЯТЫМИ ЧАШКАМИ, 6 ПЕРСОН, 14 ПРЕДМЕТОВ', 1, 2, 4500, 'Авторский экзсклюзивный чайный сервиз ручной работы на 6 персон: 14 предметов. 6 чайных чашек 250мл, 6 блюдец, 1 чайник, 1 сахарница. Белый, глянцевый. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор.', 6, '3b17495ca9935ee5914be8786e01.jpeg, ca649c05f5557fb7325e2485a489.jpeg'),
	(10, 'СЕРВИЗ "ЖЕМЧУЖИНА СЕРВИРОВКИ" С МЯТЫМИ ЧАШКАМИ, 49 ПРЕДЕМЕТОВ', 1, 2, 3800, 'Авторский экзсклюзивный чайный сервиз ручной работы на 6 персон. 49 предметов: 6 чайных чашек 250мл, 6 блюдец, 6 соусников, 6 подстановочных тарелок 27см, 6 обеденных тарелок 22см, 6 пиал, 1 кувшин на 750мл, 1 чайник 600мл , 1 сахарница 300мл 1 блюдо 25 на 23см, 1 салатница в виде ракушки, 1 блюдо в виде ракушки, тортовница, 6 колец для салфеток. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор. Цвет - Белый, глянцевый', 7, '1be5e6cca5e17edd0a750bb54a0c.jpeg, 240b2ae6567f93d6318567fc4da5.jpeg, 0b4b90524d77512cae8fae904b9f.jpeg, ee0c63100f4f7bea8a4f781648b0.jpeg, af0de661eef1f80037693f9e8c12.jpeg, 61256db8efa75842fe1b1a588956.jpeg'),
	(11, 'СОУСНИК "КРАФТ" С РУЧКОЙ', 1, 3, 230, 'Соусник минималистичный с ручкой ручной работы. Белый, оливковый. Соусник стилизованный под алюминиевую посуду. Керамика, полуфарфор', 7, '2fe8ba94560f17d7040fb6e56df5.jpeg'),
	(12, 'СОУСНИК "КРАФТ" С РУЧКОЙ', 1, 3, 380, 'Соусник минималистичный с ручкой ручной работы. Белый, посыпанный крошкой. Соусник стилизованный под алюминиевую посуду. Керамика, полуфарфор', 7, 'e01d1b32d0a519b5307ef8e70b31.jpeg, 338f38d0384a1984626115d216fc.jpeg'),
	(13, 'СОУСНИК "БЕЛЫЙ ЖЕМЧУГ"', 1, 3, 288, 'Соусник ручной работы для стильной сервировки с рельефной текстурой. Мягкий фарфор. Белый, глянцевый', 7, '4da89ee357da27a75cc3c4fdbda9.jpeg, 72bfbe4222f51144a886e3e00767.jpeg'),
	(14, 'СОУСНИК "ДЗЕНАРТ МОРЕ"', 1, 3, 250, 'Соусник с рельефным кантом, Диаметр 7,5 см, Высота 4см, мягкий фарфор, синего цвета, ручная работа', 7, '417b3138c787aa51b924e6b535c8.jpeg, 98ac9d0326d845fea8943e270207.jpeg'),
	(15, 'КРУЖКА "КРАФТ"', 1, 4, 1380, 'Кружка 330мл с выдавленным текстом, ручной работы, высота 10см', 8, '71a4343b3ce6f43efa65688c077c.jpeg'),
	(16, 'КРУЖКА "КРАФТ"', 1, 4, 804, 'Кружка 330мл, ручной работы, высота 10см, посыпанная крошкой, керамика, полуфарфор', 8, 'e864cd575a8877bcdc60002c4988.jpeg'),
	(17, 'КРУЖКА МИНИМАЛИЗМ "РАССВЕТ"', 1, 4, 690, 'Керамическая кружка для молока “Пчёлки” изготовлена вручную на гончарном круге. Кружка покрыта безопасными для здоровья пищевыми глазурями. Ручная роспись – надглазурная краска.', 8, 'cb3447b4c5a80e65d77ef2e79405.jpeg'),
	(18, 'КРУЖКА "СПИРАЛЬ БЕЛАЯ"', 1, 4, 1103, 'Кружка большая ручной работы, 500мл, белая, керамика', 8, '4c8e371dcb65e3a22dc160ddb587.jpeg'),
	(20, 'КОЛЛЕКЦИЯ "ВЕСЕННЯЯ"', 2, 6, 4332, 'Авторский экзсклюзивный сервиз ручной работы на 6 персон: 14 предметов. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор.', 2, 'images (10).jpg'),
	(21, 'КОЛЛЕКЦИЯ "ОСЕННЯЯ"', 2, 6, 3223, 'Авторский экзсклюзивный сервиз ручной работы на 6 персон: 14 предметов. Всю посуду можно мыть в посудомойке и ставить в СВЧ. Материал - мягкий фарфор.', 3, '1020x0_zktohkkeioyanctl_jpg_6b12.jpg'),
	(22, 'КОЛЛЕКЦИЯ "ПРЯНИЧНАЯ"', 2, 5, 4433, 'Чайный сервиз ручной работы на 4 персоны, пряничный, с потеками глазури. Чайник 650мл (14см высота), 2 кружки приянично-рифленые 350мл, 2 кружки с потеками глазури 350мл, 2 блюдца лучи 16см, 2 блюдца с мазками глазури 16см', 6, '27359a81156b528c5645e217b745.jpeg, 6c5fa41f8e0d6a436983e432a2a8.jpeg, 598c329dccd4e131d664146c48af.jpeg'),
	(23, 'ВАЗА ИЗ КЕРАМИКИ', 3, 7, 3550, 'Элегантная керамическая ваза для цветов ручной работы, сине-коричневая матовая глазурованная керамическая посуда, классическая форма.', 5, 'H5d2fa3f752b84df3993c303cb31d8286z.jpg'),
	(24, 'ВАЗА КЕРАМИКА 21 СМ', 3, 7, 5600, 'Ваза Керамика ручной работы, 21 см', 3, '6032230596.jpg'),
	(25, 'СКУЛЬПТУРА "ВОРОНА"', 3, 8, 4100, 'Малая керамическая скульптура "Ворона". Для оформления и росписи вороны выбраны приятные, мягкие цвета. Роспись осуществлена в городской тематике.', 3, 'skulptura-vorona-vn-01.jpg, skulptura-vorona-vn-02.jpg, skulptura-vorona-vn-03.jpg, skulptura-vorona-vn-04.jpg, skulptura-vorona-vn-05.jpg'),
	(43, 'Вазон-газон', 4, 130, 123, 'Ваза просто ваза', 1, '400.jpg');

-- Дамп структуры для таблица diploma.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'идентификатор пользователя',
  `star_count` int(11) DEFAULT NULL COMMENT 'колличество звезд',
  `reviews` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'отзыв',
  `add_time` int(11) DEFAULT NULL COMMENT 'время добавления',
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'картинки',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='отзывы';

-- Дамп данных таблицы diploma.review: ~3 rows (приблизительно)
DELETE FROM `review`;
INSERT INTO `review` (`id`, `user_id`, `star_count`, `reviews`, `add_time`, `image`) VALUES
	(1, 9, 5, ' все отлично', 1842342676, NULL),
	(2, 5, 4, 'все ок', 1834234235, NULL),
	(3, 12, 4, 'отлично', 1788222111, NULL);

-- Дамп структуры для таблица diploma.shopping
CREATE TABLE IF NOT EXISTS `shopping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  `product_count` int(11) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `buyer_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_house` int(11) DEFAULT NULL,
  `buyer_apartment` int(11) DEFAULT NULL,
  `buyer_postcode` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.shopping: ~13 rows (приблизительно)
DELETE FROM `shopping`;
INSERT INTO `shopping` (`id`, `user_id`, `product_id`, `add_time`, `product_count`, `product_price`, `buyer_name`, `buyer_last_name`, `buyer_email`, `buyer_country`, `buyer_city`, `buyer_street`, `buyer_house`, `buyer_apartment`, `buyer_postcode`) VALUES
	(32, 5, 9, 1670823777, 1, 4500, 'Ася', 'Семенова', 'SpanihBob@gmail.com', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000),
	(33, 5, 22, 1670823777, 1, 4432, 'Ася', 'Семенова', 'SpanihBob@gmail.com', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000),
	(34, 9, 21, 1670832613, 1, 3223, 'Иван', 'Иванов', 'xxcbgngd@fcvvx.f', 'Россия', 'Ижевск', 'Колхозная', 4, 2, 426000),
	(35, 5, 1, 1670839926, 2, 3499, 'Ася', 'Семенова', 'SpanihBob@gmail.com', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000),
	(36, 5, 1, 1671799284, 1, 3499, 'Ася', 'Семенова', 'SpanihBob@gmail.com', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000),
	(37, 10, 45, 1674896936, 1, 1223, 'Вася', 'Пупкин', 'spanihbobjjj@gmail.com', 'Россия', 'Ижевск', 'Областная', 1, 1, 426010),
	(38, 12, 14, 1674897007, 1, 250, 'Dj', 'Groove', 'spa@gmail.com', 'РФ', 'Ижевск', 'Переулок Можарова', 2, 1, 426010),
	(39, 5, 1, 1674947377, 1, 3499, 'Ася', 'Семенова', 'SpanihBob@gmail.com', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000),
	(40, 5, 1, 1675232983, 1, 3499, 'Ася', 'Семенова', 'SpanihBob@gmail.com', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000),
	(41, 9, 1, 1675252274, 2, 3499, 'Иван', 'Иванов', 'xxcbgngd@fcvvx.f', 'Россия', 'Ижевск', 'Колхозная', 4, 2, 426000),
	(42, 9, 22, 1675252274, 1, 4433, 'Иван', 'Иванов', 'xxcbgngd@fcvvx.f', 'Россия', 'Ижевск', 'Колхозная', 4, 2, 426000),
	(43, 9, 24, 1675252274, 1, 5600, 'Иван', 'Иванов', 'xxcbgngd@fcvvx.f', 'Россия', 'Ижевск', 'Колхозная', 4, 2, 426000),
	(44, 9, 23, 1675252274, 1, 3550, 'Иван', 'Иванов', 'xxcbgngd@fcvvx.f', 'Россия', 'Ижевск', 'Колхозная', 4, 2, 426000);

-- Дамп структуры для таблица diploma.storeinfo
CREATE TABLE IF NOT EXISTS `storeinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы diploma.storeinfo: ~0 rows (приблизительно)
DELETE FROM `storeinfo`;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='пользователи';

-- Дамп данных таблицы diploma.users: ~4 rows (приблизительно)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `login`, `password`, `email`, `user_name`, `lastname`, `country`, `city`, `street`, `house`, `apartment`, `postcode`, `avatar`, `time_signup`, `admin`) VALUES
	(5, '111', '$2y$10$fC/.JXaE3jRgL/knRVoTXOku3BAnZy/.Oxhii7TCug6bG/2jBhSXK', 'SpanihBob@gmail.com', 'Ася', 'Семенова', 'Россия', 'Ижевск', 'Пушкинская', 2, 12, 426000, '11116602.jpg', 1662533535, 1),
	(9, '222', '$2y$10$m.n41ZLocEMEMFisvulWy.1v7CXe2WgN4xIYgacmgjMdLgY2ZIjvK', 'xxcbgngd@fcvvx.f', 'Иван', 'Иванов', 'Россия', 'Ижевск', 'Колхозная', 4, 2, 426000, '22246231.jpg', 1668283681, NULL),
	(10, '333', '$2y$10$txOyzjTFW.AZtlT6P6Pvcu4dqQWryuFLA812bOR7umxyVTvzzcD1q', 'spanihbobjjj@gmail.com', 'Вася', 'Пупкин', 'Россия', 'Ижевск', 'Областная', 1, 1, 426010, '33377134.png', 1669616263, NULL),
	(12, '444', '$2y$10$JQvclITOeu3Md8jcjm9Ko.Gg0vIoHYBxtV8OOyTbmSkPlEd4rB48u', 'spa@gmail.com', 'Dj', 'Groove', 'РФ', 'Ижевск', 'Переулок Можарова', 2, 1, 426010, '44466284.png', 1669621508, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
