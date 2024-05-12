-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Máj 12. 16:51
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
  `ingrediens_id` int(11) NOT NULL,
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
  `activated` tinyint(1) DEFAULT NULL,
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
(14, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Kinga', 'Kinga', 'tghrstr@gmail.com', NULL, '0', '2024-05-11 13:47:03'),
(15, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Juli', 'Juli', 'gfjydd@gmail.com', NULL, '', '2024-05-11 13:47:48');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(140) NOT NULL,
  `img` blob NOT NULL,
  `paragraph` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `your_name` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `servings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `img`, `paragraph`, `price`, `food_name`, `your_name`, `time`, `servings`) VALUES
(1, '', 'u876yui6i', 1500, 'Soup', 'Emese', '0000-00-00', '10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receipt_ingredient`
--

CREATE TABLE `receipt_ingredient` (
  `receipt_ingredient_id` int(60) NOT NULL,
  `receipt_id` int(60) NOT NULL,
  `ingredient_id` int(60) NOT NULL,
  `ingredient_id_quantity` varchar(255) NOT NULL
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
  ADD PRIMARY KEY (`receipt_ingredient_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ingrediens`
--
ALTER TABLE `ingrediens`
  MODIFY `ingrediens_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `profil`
--
ALTER TABLE `profil`
  MODIFY `profil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT a táblához `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(140) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `receipt_ingredient`
--
ALTER TABLE `receipt_ingredient`
  MODIFY `receipt_ingredient_id` int(60) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
