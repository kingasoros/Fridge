-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Jún 12. 18:16
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
(9, 'bors'),
(10, 'csirke'),
(11, 'krumpli');

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
  `activation_expire` datetime DEFAULT current_timestamp(),
  `forgotten_password_token` varchar(255) NOT NULL,
  `forgotten_password_expires` datetime NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `profil`
--

INSERT INTO `profil` (`profil_id`, `password`, `last_name`, `phone_numb`, `user_name`, `first_name`, `email`, `activated`, `activation_token`, `activation_expire`, `forgotten_password_token`, `forgotten_password_expires`, `img`) VALUES
(4, 'd6cfeece5ca0d0bc8ea050258f33322a', 'Seres', 659200318, 'Animegirl', 'Kinga', 'kingasoros@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(5, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Nagy', 659200318, 'Janika9', 'Jani', 'oravec.anett@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(6, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Seres', 659200318, 'Animegirl04', 'Kinga', 'kingasoros@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(7, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Seres', 659200318, 'Girly', 'Jazmin', 'seresjazmin@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(8, 'cf54484152585938a98f86df5ba3316d', 'Nagy', 659200318, 'JaniExample', 'Jani', 'hmjgh@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(9, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Animegirl04', 'Kinga', '7ir6y7tir67iu@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(10, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Kata', 'Kinga', 'uyhkjmyukt@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(11, '7b17a441d87593e029b2e6b287bca618', 'Nagy', 659200318, 'Jani', 'Jani', 'yjt5yjue5t@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(12, '7b17a441d87593e029b2e6b287bca618', 'Nagy', 659200318, 'Jani', 'Jani', 'yjute5ryjit6e@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(13, '7b17a441d87593e029b2e6b287bca618', 'Eni', 659200318, 'Eni', 'Eni', 'yhjtdrjty@gmail.com', NULL, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(28, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Torma', 659200318, 'Kittike', 'Kitti', 'gfhbnd@gmail.com', 1, '4691f62ff7e299626237798f6045c14e', '2024-05-12 18:29:52', '', '2024-06-07 00:09:35', ''),
(29, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Nagy', 659200318, 'David', 'David', 'fbhd@gmail.com', 1, '5a9c702f87acb31331655911d380e07b', '2024-05-12 18:42:32', '', '2024-06-07 00:09:35', ''),
(30, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Torma', 659200318, 'David', 'David', 'grfjhn@gmail.com', 0, '2906ef6a5b747ecd43ad32fb0f798bc9', '2024-05-12 18:45:11', '', '2024-06-07 00:09:35', ''),
(31, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Kinga', 'Kitti', 'you@gmail.com', 1, '77c6a6f18649157a80fdba3314ea91e7', '2024-05-31 20:47:52', '', '2024-06-07 00:09:35', ''),
(32, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Animegirl', 'Kinga', 'utr5eyujhet65y@gmail.com', 1, 'cd6bdbb1ab345e450f7fd82dd66809d9', '2024-06-02 19:37:16', '', '2024-06-07 00:09:35', ''),
(33, '07a8d09abbb404f0364da296f02f3cd1', 'seres', 659200318, 'fel', 'kinga', 'ghjcgtyuj@gmail.com', 1, 'c08411afba32d2c67a25f50f23b6bbdf', '2024-06-03 14:43:32', '', '2024-06-07 00:09:35', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(20) NOT NULL,
  `img` varchar(255) NOT NULL,
  `paragraph` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `your_name` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `servings` varchar(255) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `activation_token` varchar(64) NOT NULL,
  `activation_expire` datetime NOT NULL DEFAULT current_timestamp(),
  `categories` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `img`, `paragraph`, `price`, `food_name`, `your_name`, `time`, `servings`, `activated`, `activation_token`, `activation_expire`, `categories`) VALUES
(4, '', 'yujytjftjyfytjhu yujkuyjkyujki yuykjryukjry', 1500, 'almas pite', 'Kinga', '00:00:30', '2', 0, '', '2024-05-31 20:15:23', 'dessert'),
(6, '', 'trhrdsthr', 1500, 'korte', 'Kinga', '00:00:30', '2', 0, '', '2024-05-31 20:15:23', 'fruits'),
(10, '', 'rtghthest', 1500, 'Gomba Leves', 'Emese', '00:00:30', '2', 0, '', '2024-05-31 20:15:23', ''),
(24, '', 'uiyf, i', 1500, 'Pipi leves', 'Kinga', '00:00:30', '2', 0, '', '2024-05-31 20:15:23', ''),
(25, '', 'ujtyu7jit65y7uijt65y7iju6ty7u867yu', 1500, 'krumplipure', 'Kinga', '00:00:30', '2', 0, 'e335a2118df429641b1c71bd2917e755', '2024-05-31 20:16:15', 'Vegan'),
(26, '', 'fgjcfgtjcfgjtufgtujfrtgjhutfrhujfrtg', 1500, 'tyukleves', 'Kinga', '00:00:30', '2', 0, '0499e0dd32aadabfb1e2b51b059a3703', '2024-05-31 20:20:37', 'main course'),
(27, '', 'gtrhnbsrthr4thr4thrw5thy', 1500, 'sult krumpli', 'Kinga', '00:00:30', '2', 1, '826ed6405d530db60dd41e73128d0fc8', '2024-05-31 20:43:18', 'Vegan'),
(28, '/9j/4AAQSkZJRgABAQEASABIAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAACRyWFlaAAABFAA', 'hujryujiyujhyrujkyujuky', 1500, 'Gomba szosz', 'Kinga', '00:00:30', '2', 1, '9527eb192a2fd636a64560d48cd65d7f', '2024-06-02 22:46:38', ''),
(30, '20240612171937.jpg', 'ertfhygsretfh', 1000, 'Tejberizs', 'kinga', '00:00:30', '2', 1, '4d815278b7352f96d3c596bca35a9671', '2024-06-12 17:19:37', 'Dessert'),
(31, '20240612173702.jpg', 'dxrjuhtyjiutyjkitugykiyu', 1500, 'tejesrizs', 'Kinga', '00:00:30', '2', 0, 'c3a3c5206a97f68ca8742dbf11466849', '2024-06-12 17:37:02', 'dessert'),
(32, '20240612174555.jpg', 'yujitygjiktyujikytukjiy', 1500, 'Rizs', 'Kinga', '00:00:30', '2', 0, 'f6498dfbe4d1d4e2d30f95afb71c097c', '2024-06-12 17:45:55', 'dessert'),
(33, '20240612175616.jpg', 'fgvchbnjmk', 1500, 'kacsa', 'Kinga', '00:00:30', '2', 1, '1869ed78559a9d55f89136aa59cb669b', '2024-06-12 17:56:16', 'dessert');

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
-- A tábla adatainak kiíratása `receipt_ingredient`
--

INSERT INTO `receipt_ingredient` (`receipt_ingredient_id`, `receipt_id`, `ingrediens_id`, `quantity`) VALUES
(2, 26, 10, '10dkg'),
(3, 26, 3, '1csipet'),
(4, 27, 11, '10dkg'),
(5, 27, 3, '1csipet'),
(6, 28, 7, '10dkg'),
(7, 28, 3, '10dkg'),
(13, 30, 8, '1l'),
(14, 30, 5, '2ek'),
(15, 31, 8, '1l'),
(16, 31, 5, '2ek'),
(17, 32, 8, '10dkg'),
(18, 32, 7, '10dkg'),
(19, 33, 7, '10dkg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_email_failures`
--

CREATE TABLE `user_email_failures` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_time_added` datetime DEFAULT NULL
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
-- A tábla indexei `user_email_failures`
--
ALTER TABLE `user_email_failures`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ingrediens`
--
ALTER TABLE `ingrediens`
  MODIFY `ingrediens_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `profil`
--
ALTER TABLE `profil`
  MODIFY `profil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `receipt_ingredient`
--
ALTER TABLE `receipt_ingredient`
  MODIFY `receipt_ingredient_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `user_email_failures`
--
ALTER TABLE `user_email_failures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `receipt_ingredient`
--
ALTER TABLE `receipt_ingredient`
  ADD CONSTRAINT `receipt_ingredient_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`receipt_id`),
  ADD CONSTRAINT `receipt_ingredient_ibfk_2` FOREIGN KEY (`ingrediens_id`) REFERENCES `ingrediens` (`ingrediens_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
