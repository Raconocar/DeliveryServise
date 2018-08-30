-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 15 2018 г., 14:26
-- Версия сервера: 5.7.21
-- Версия PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `newdhl`
--

-- --------------------------------------------------------

--
-- Структура таблицы `couriers`
--

DROP TABLE IF EXISTS `couriers`;
CREATE TABLE IF NOT EXISTS `couriers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `telephone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `monday_start` varchar(100) DEFAULT NULL,
  `tuesday_start` varchar(100) DEFAULT NULL,
  `wednesday_start` varchar(100) DEFAULT NULL,
  `thuesday_start` varchar(100) DEFAULT NULL,
  `friday_start` varchar(100) DEFAULT NULL,
  `saturday_start` varchar(100) DEFAULT NULL,
  `sunday_start` varchar(100) DEFAULT NULL,
  `monday_stop` varchar(100) DEFAULT NULL,
  `tuesday_stop` varchar(100) DEFAULT NULL,
  `wednesday_stop` varchar(100) DEFAULT NULL,
  `thuesday_stop` varchar(100) DEFAULT NULL,
  `friday_stop` varchar(100) DEFAULT NULL,
  `saturday_stop` varchar(100) DEFAULT NULL,
  `sunday_stop` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `telephone`, `email`, `monday_start`, `tuesday_start`, `wednesday_start`, `thuesday_start`, `friday_start`, `saturday_start`, `sunday_start`, `monday_stop`, `tuesday_stop`, `wednesday_stop`, `thuesday_stop`, `friday_stop`, `saturday_stop`, `sunday_stop`) VALUES
(1, 'Thomas', '88005553535', '88005553535@,il.ru', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(2, 'Thomas', '88005553535', '88005553535@,il.ru', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(3, 'Thomas1', '88005553536', '88005553536@,il.ru', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(4, 'Thomas2', '88005553537', '88005553537@,il.ru', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(5, 'Thomas3', '88005553538', '88005553538@,il.ru', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(6, 'Петрович', '880055353', 'petrovich@mail.mail', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(7, 'Василий Ваганыч', '88005656656', 'sdfg@sdfrg.rr', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(8, 'Генадич', '88005656655', 'ma@ma.ma', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(9, 'Владимир Герасимович', '12435', 'sdfg@sdfrg.rr', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(10, 'Василий петрович', '222', 'r880055r54545r@mail.mail', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(11, 'Василич 12', '', '', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00', '17:00'),
(12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `operators`
--

DROP TABLE IF EXISTS `operators`;
CREATE TABLE IF NOT EXISTS `operators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `passwd` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `operators`
--

INSERT INTO `operators` (`id`, `login`, `name`, `email`, `passwd`) VALUES
(1, 'manager', 'Борис Кот', 'bor.kot.prosto.kot@meow.ru', 'e388f02f750e65ebba95ab9493cda01e');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `number` int(11) NOT NULL AUTO_INCREMENT,
  `courier` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL,
  `duedate` datetime NOT NULL,
  `cost` int(11) NOT NULL,
  `adress` varchar(300) NOT NULL,
  `status` enum('Принят','Ожидает курьера','В пути','Доставлен','Отменён') NOT NULL,
  `label` text NOT NULL,
  `owner` varchar(200) NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`number`, `courier`, `date`, `duedate`, `cost`, `adress`, `status`, `label`, `owner`) VALUES
(1, 'Thomas3', '2018-08-06 19:30:21', '2018-08-31 00:00:00', 150, 'dgnsath', 'Принят', 'twsrt', 'wrt'),
(2, 'Василий Ваганыч', '2018-08-06 19:31:33', '2018-08-30 00:00:00', 151, 'dgnsath', 'Принят', 'twsrt', 'wrt'),
(3, 'Василий петрович', '2018-08-06 19:31:34', '2018-08-30 00:00:00', 151, 'dgnsath', 'Принят', 'twsrt', 'wrt'),
(4, 'Thomas2', '2018-08-06 19:31:34', '2018-08-20 00:00:00', 1521, 'dgnsath', 'Принят', 'twsrt', 'wrt'),
(5, 'Петрович', '2018-08-06 19:31:34', '2018-08-23 00:00:00', 1541, 'dgnsath', 'Принят', 'twsrt', 'wrt'),
(6, 'Владимир Герасимович', '2018-08-06 19:31:34', '2018-09-30 00:00:00', 1571, 'dgnsath', 'Принят', 'twsrt', 'wrt'),
(7, 'Владимир Герасимович', '2018-08-09 00:00:00', '2018-08-15 00:00:00', 200, 'Улица пушкина дом колотушкина', 'Принят', 'фавыи', 'Дядя'),
(8, 'Владимир Герасимович', '2018-08-09 00:00:00', '2018-08-15 00:00:00', 200, 'Улица пушкина дом колотушкина', 'Принят', 'фавыи', 'Дядя'),
(9, 'Владимир Герасимович', '2018-08-10 00:00:00', '2018-08-14 00:00:00', 200, 'Улица пушкина дом колотушкина', 'Доставлен', 'фавыи', 'Дядя'),
(10, 'Василич 12', '2018-08-23 00:00:00', '2018-07-27 00:00:00', 200, 'Улица пушкина дом колотушкина', 'Ожидает курьера', 'Jn lzlb z,kjxysq cjr', 'Дядя Ваня'),
(11, 'Василич 12', '2018-08-08 00:00:00', '2018-08-16 00:00:00', 200, '', 'Отменён', 'Сок', 'Дядя Ваня'),
(12, 'Василич 12', '2018-08-08 00:00:00', '2018-08-17 00:00:00', 500, 'Улица пушкина дом колотушкина2', 'В пути', 'AliExpress', 'Дядя Ваня'),
(13, 'Василич 12', '2018-08-02 00:00:00', '2018-08-10 00:00:00', 500, 'Улица пушкина дом колотушкина23', 'Отменён', 'Сок', 'Дядя'),
(14, 'Thomas3', '2018-08-01 00:00:00', '2018-08-10 00:00:00', 400, 'Улица пушкина дом колотушкина23', 'Принят', 'фавыи', 'Дядя'),
(15, 'Thomas', '2018-08-08 00:00:00', '2018-08-22 00:00:00', 200, 'Улица пушкина дом колотушкина', 'Принят', 'фавыи', 'Дядя Петя'),
(16, 'Петрович', '2018-08-08 00:00:00', '2018-08-16 00:00:00', 200, 'Улица пушкина дом колотушкина', 'Принят', 'Сок', 'Дядя Петя');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
