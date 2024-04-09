-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 09. 07:38
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.0.30

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
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `profil`
--

INSERT INTO `profil` (`profil_id`, `password`, `last_name`, `phone_numb`, `user_name`, `first_name`, `email`) VALUES
(1, 'francia', 'seres', 659200318, 'animegirl', 'kinga', 'kingasoros@gmail.com'),
(2, 'francia', 'seres', 659200318, 'animegirl', 'kinga', 'kingasoros@gmail.com'),
(3, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Seres', 659200318, 'Animegirl04', 'Kinga', 'kingasoros@gmail.com'),
(4, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Seres', 659200318, 'Girly', 'Jazmin', 'jazminseres@gmail.com');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(140) NOT NULL,
  `img` blob NOT NULL,
  `paragraph` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receipt_connect`
--

CREATE TABLE `receipt_connect` (
  `connect_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `ingrediens_id` int(11) NOT NULL,
  `quantity_conn` int(11) NOT NULL
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
-- A tábla indexei `receipt_connect`
--
ALTER TABLE `receipt_connect`
  ADD PRIMARY KEY (`connect_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ingrediens`
--
ALTER TABLE `ingrediens`
  MODIFY `ingrediens_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `profil`
--
ALTER TABLE `profil`
  MODIFY `profil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(140) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `receipt_connect`
--
ALTER TABLE `receipt_connect`
  MODIFY `connect_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
