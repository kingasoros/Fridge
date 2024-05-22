-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Máj 23. 00:32
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `fridge`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ingrediens`
--

CREATE TABLE `ingrediens` (
  `ingrediens_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `ingrediens`
--

INSERT INTO `ingrediens` (`ingrediens_id`, `name`) VALUES
(1, 'alma'),
(3, 'so'),
(4, 'korte'),
(5, 'cukor'),
(6, 'liszt'),
(7, 'gomba'),
(8, 'tej'),
(9, 'bors');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `profil`
--

CREATE TABLE `profil` (
  `profil_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_name` varchar(140) NOT NULL,
  `phone_numb` int(11) NOT NULL,
  `user_name` varchar(140) NOT NULL,
  `first_name` varchar(140) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activated` tinyint(1) DEFAULT 0,
  `activation_token` varchar(64) NOT NULL,
  `activation_expire` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `profil`
--

INSERT INTO `profil` (`profil_id`, `password`, `last_name`, `phone_numb`, `user_name`, `first_name`, `email`, `activated`, `activation_token`, `activation_expire`) VALUES
(4, 'd6cfeece5ca0d0bc8ea050258f33322a', 'Seres', 659200318, 'Animegirl', 'Kinga', 'kingasoros@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(5, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Nagy', 659200318, 'Janika9', 'Jani', 'oravec.anett@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(6, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Seres', 659200318, 'Animegirl04', 'Kinga', 'kingasoros@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(7, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Seres', 659200318, 'Girly', 'Jazmin', 'seresjazmin@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(8, 'cf54484152585938a98f86df5ba3316d', 'Nagy', 659200318, 'JaniExample', 'Jani', 'hmjgh@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(9, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Animegirl04', 'Kinga', '7ir6y7tir67iu@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(10, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Kata', 'Kinga', 'uyhkjmyukt@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(11, '7b17a441d87593e029b2e6b287bca618', 'Nagy', 659200318, 'Jani', 'Jani', 'yjt5yjue5t@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(12, '7b17a441d87593e029b2e6b287bca618', 'Nagy', 659200318, 'Jani', 'Jani', 'yjute5ryjit6e@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(13, '7b17a441d87593e029b2e6b287bca618', 'Eni', 659200318, 'Eni', 'Eni', 'yhjtdrjty@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(28, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Torma', 659200318, 'Kittike', 'Kitti', 'gfhbnd@gmail.com', 1, '4691f62ff7e299626237798f6045c14e', '2024-05-12 18:29:52'),
(29, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Nagy', 659200318, 'David', 'David', 'fbhd@gmail.com', 1, '5a9c702f87acb31331655911d380e07b', '2024-05-12 18:42:32'),
(30, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Torma', 659200318, 'David', 'David', 'grfjhn@gmail.com', 0, '2906ef6a5b747ecd43ad32fb0f798bc9', '2024-05-12 18:45:11');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(20) NOT NULL,
  `img` blob NOT NULL,
  `paragraph` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `your_name` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `servings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `img`, `paragraph`, `price`, `food_name`, `your_name`, `time`, `servings`) VALUES
(1, '', 'u876yui6i', 1500, 'Soup', 'Emese', '00:00:00', '10'),
(2, '', 'fdghjvbnjudfhgnbjudhfgnbikdfgju fnhbgvfdghbdfghbs huhffghgfrh jhgfbhhb', 1500, 'Sos korte', 'Kinga', '00:00:30', '2'),
(4, '', 'yujytjftjyfytjhu yujkuyjkyujki yuykjryukjry', 1500, 'almas pite', 'Kinga', '00:00:30', '2'),
(6, '', 'trhrdsthr', 1500, 'korte', 'Kinga', '00:00:30', '2'),
(9, '', 'yhgjdtgyujtdyujt', 1500, 'Csirke', 'Kinga', '00:00:30', '2'),
(10, '', 'rtghthest', 1500, 'Gomba Leves', 'Emese', '00:00:30', '2'),
(24, '', 'uiyf, i', 1500, 'Pipi leves', 'Kinga', '00:00:30', '2');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receipt_ingredient`
--

CREATE TABLE `receipt_ingredient` (
  `receipt_ingredient_id` int(20) NOT NULL,
  `receipt_id` int(20) NOT NULL,
  `ingrediens_id` int(20) NOT NULL,
  `quantity` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ingrediens`
--
ALTER TABLE `ingrediens`
  ADD PRIMARY KEY (`ingrediens_id`);

--
-- A tábla indexei `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`profil_id`);

--
-- A tábla indexei `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- A tábla indexei `receipt_ingredient`
--
ALTER TABLE `receipt_ingredient`
  ADD PRIMARY KEY (`receipt_ingredient_id`),
  ADD KEY `receipt_id` (`receipt_id`),
  ADD KEY `ingrediens_id` (`ingrediens_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ingrediens`
--
ALTER TABLE `ingrediens`
  MODIFY `ingrediens_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `profil`
--
ALTER TABLE `profil`
  MODIFY `profil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `receipt_ingredient`
--
ALTER TABLE `receipt_ingredient`
  MODIFY `receipt_ingredient_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `receipt_ingredient`
--
ALTER TABLE `receipt_ingredient`
  ADD CONSTRAINT `receipt_ingredient_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `ingrediens` (`ingrediens_id`),
  ADD CONSTRAINT `receipt_ingredient_ibfk_2` FOREIGN KEY (`ingrediens_id`) REFERENCES `ingrediens` (`ingrediens_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
