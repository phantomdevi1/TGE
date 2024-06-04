-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 04 2024 г., 17:16
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tge`
--

-- --------------------------------------------------------

--
-- Структура таблицы `BlogPosts`
--

CREATE TABLE `BlogPosts` (
  `PostID` int NOT NULL,
  `Title` varchar(255) NOT NULL,
  `PostDate` date NOT NULL,
  `Content` text NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `BlogPosts`
--

INSERT INTO `BlogPosts` (`PostID`, `Title`, `PostDate`, `Content`, `CreatedAt`) VALUES
(1, 'Мы открыли магазин в Торопце', '2024-05-01', 'Мы рады сообщить, что теперь у нас есть магазин в городе Торопец. Магазин предлагает широкий ассортимент электроники, включая новейшие смартфоны, ноутбуки, и бытовую технику. Ждем вас по адресу: ул. Центральная, д. 15.', '2024-05-21 13:07:09'),
(2, 'Завезли новые LED-лампы', '2024-05-05', 'В нашем ассортименте появились новейшие модели LED-ламп, которые отличаются высокой яркостью и энергоэффективностью. Приходите в любой наш магазин и получите консультацию наших специалистов.', '2024-05-21 13:07:09'),
(3, 'Открытие нового магазина в Москве', '2024-05-10', 'Мы с гордостью объявляем об открытии нашего нового магазина в Москве. Вас ждут эксклюзивные предложения на смартфоны, ноутбуки и другую электронику. Адрес: ул. Тверская, д. 10.', '2024-05-21 13:07:09'),
(4, 'Большие скидки на всю продукцию', '2024-05-15', 'В честь открытия нашего нового магазина в Санкт-Петербурге мы предлагаем скидки до 50% на всю продукцию. Акция действует с 15 по 30 мая. Не упустите возможность приобрести качественную электронику по выгодным ценам!', '2024-05-21 13:07:09'),
(5, 'Обновление ассортимента в наших магазинах', '2024-05-20', 'Мы постоянно обновляем наш ассортимент, чтобы предложить вам только самые современные и качественные товары. В наших магазинах появились новые модели смартфонов, планшетов и умных часов. Заходите и выбирайте!', '2024-05-21 13:07:09'),
(6, 'Сервисное обслуживание в магазинах', '2024-05-25', 'Мы не только продаем электронику, но и предоставляем полный спектр сервисных услуг. Наши квалифицированные специалисты помогут вам с настройкой и ремонтом устройств. Приходите в любой наш магазин за консультацией.', '2024-05-21 13:07:09'),
(7, 'Акция на умные телевизоры', '2024-05-30', 'Только с 1 по 10 июня в наших магазинах проходит акция на умные телевизоры. Скидки до 30%! Не упустите шанс обновить свой телевизор и наслаждаться высоким качеством изображения и звука. Ждем вас в наших магазинах!', '2024-05-21 13:07:09');

-- --------------------------------------------------------

--
-- Структура таблицы `CallbackRequests`
--

CREATE TABLE `CallbackRequests` (
  `RequestID` int NOT NULL,
  `Name` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `RequestTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `CallbackRequests`
--

INSERT INTO `CallbackRequests` (`RequestID`, `Name`, `PhoneNumber`, `RequestTime`) VALUES
(7, 'Илья', '89051234567', '2024-05-21 19:09:46');

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `ProductID` int DEFAULT NULL,
  `Quantity` int NOT NULL,
  `OrderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `OrderStatus` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`OrderID`, `UserID`, `ProductID`, `Quantity`, `OrderDate`, `OrderStatus`) VALUES
(29, 5, 11, 3, '2024-06-04 12:29:35', 'выдан'),
(30, 5, 12, 3, '2024-06-04 12:29:40', 'доставлен'),
(31, 5, 14, 1, '2024-06-04 12:29:44', 'отказ'),
(32, 5, 11, 1, '2024-06-04 13:13:28', 'в обработке');

-- --------------------------------------------------------

--
-- Структура таблицы `Products`
--

CREATE TABLE `Products` (
  `ProductID` int NOT NULL,
  `ImagePath` varchar(255) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `Products`
--

INSERT INTO `Products` (`ProductID`, `ImagePath`, `Name`, `Description`) VALUES
(11, 'img/product/soldering_iron.png', 'Паяльник', 'Электрический паяльник - незаменимый инструмент для проведения пайки электронных компонентов и соединений. Он обеспечивает равномерный нагрев рабочей поверхности, что делает пайку точной и эффективной. Идеально подходит как для профессионального использования, так и для домашних ремонтных работ.'),
(12, 'img/product/iron.png', 'Утюг', 'Электрический утюг - неотъемлемый предмет в любом доме. Он помогает сохранить вашу одежду в идеальном состоянии, устраняя складки и морщины. Современные модели утюгов обладают различными функциями, такими как подача пара, регулировка температуры и защита от накипи, обеспечивая оптимальные результаты при глажке.'),
(13, 'img/product/lamp.png', 'Светильник', 'Настольный светильник - прекрасное решение для освещения вашего рабочего места или учебного стола. Он обеспечивает яркое и равномерное освещение, что позволяет комфортно работать или учиться в темное время суток. Современные модели светильников часто имеют регулируемую яркость и цветовую температуру, а также встроенные порты USB для зарядки мобильных устройств.'),
(14, 'img/product/spotlight.png', 'Прожектор', 'Мощный прожектор - незаменимый помощник при освещении больших площадей, таких как строительные участки, сады или парковки. Он обеспечивает яркое и дальнобойное освещение, что делает его идеальным для использования как на открытом воздухе, так и внутри помещений. Некоторые модели прожекторов оснащены датчиками движения или солнечными батареями, обеспечивая удобство использования и экономию энергии.'),
(15, 'img/product/toaster.png', 'Тостер', 'Электрический тостер - простое и удобное устройство для приготовления вкусных тостов. Он позволяет быстро и равномерно поджаривать хлеб, обеспечивая при этом идеальную хрустящую корку и мягкое мякиш. Современные модели тостеров обладают различными функциями, такими как регулировка степени прожарки, автоматическое отключение и поддержание тепла.'),
(16, 'img/product/fan.png', 'Вентилятор', 'Электрический вентилятор - отличное решение для обеспечения циркуляции воздуха в вашем доме или офисе. Он помогает создать приятный микроклимат в помещении, обеспечивая охлаждение в жаркие дни и циркуляцию теплого воздуха в холодные. Современные модели вентиляторов обладают различными режимами работы, скоростями вращения и направлениями потока воздуха.'),
(17, 'img/product/blender.png', 'Блендер', 'Электрический блендер - универсальное устройство для приготовления различных блюд и напитков. Он позволяет быстро и эффективно измельчать и смешивать продукты, создавая гладкие и однородные текстуры. Блендеры часто используются для приготовления смузи, коктейлей, соусов, пюре и других блюд.');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `UserID` int NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `isAdmin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`UserID`, `Username`, `Password`, `Email`, `isAdmin`) VALUES
(3, 'egor', '$2y$10$3n2bxicfZwLOsqaEZVzmhuyessud/vsbwGesyCbnOk0aOn71OPYAS', 'egor@mail.ru', 1),
(4, 'ilia', '$2y$10$37pv0cvoGbJI1L1kZyJ26u9OWCATA2iFOkH9Vs7XMaqsZUB/akWfS', 'gruzdev_ilya16@mail.ru', 1),
(5, 'user', '$2y$10$6RZzsnSE2L.qDw614yd7v.u2QwECv13t7EwXck0cAsJh3RPTRqNFG', 'user@mail.ru', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `BlogPosts`
--
ALTER TABLE `BlogPosts`
  ADD PRIMARY KEY (`PostID`);

--
-- Индексы таблицы `CallbackRequests`
--
ALTER TABLE `CallbackRequests`
  ADD PRIMARY KEY (`RequestID`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Индексы таблицы `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `BlogPosts`
--
ALTER TABLE `BlogPosts`
  MODIFY `PostID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `CallbackRequests`
--
ALTER TABLE `CallbackRequests`
  MODIFY `RequestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
