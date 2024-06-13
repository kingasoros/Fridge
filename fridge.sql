-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Jún 13. 14:33
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
(12, 'large skin-on, bone-in chicken thighs'),
(13, 'harissa paste'),
(14, 'honey'),
(15, 'olive oil'),
(16, 'garlic'),
(17, 'ground cumin'),
(18, 'ground coriander'),
(19, 'salt'),
(20, 'freshly ground black pepper'),
(21, 'green onion'),
(22, 'soy sauce'),
(23, 'sake'),
(24, 'rice vinegar'),
(25, 'brown sugar'),
(26, 'white sesame seeds'),
(27, 'crushed red pepper'),
(28, 'peanut oil'),
(29, 'toasted sesame oil'),
(30, 'boneless skinless chicken thighs'),
(31, 'grated fresh ginger'),
(32, 'finely minced garlic'),
(33, 'cooked rice'),
(34, 'salmon filet'),
(35, 'carrots'),
(36, 'radish'),
(37, 'red cabbage'),
(38, ' red cabbage');

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
(5, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Nagy', 659200318, 'Janika9', 'Jani', 'oravec.anett@gmail.com', 1, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(7, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Seres', 659200318, 'Girly', 'Jazmin', 'seresjazmin@gmail.com', 0, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(8, 'cf54484152585938a98f86df5ba3316d', 'Nagy', 659200318, 'JaniExample', 'Jani', 'hmjgh@gmail.com', 1, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(9, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Animegirl04', 'Kinga', '7ir6y7tir67iu@gmail.com', 1, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(10, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Kata', 'Kinga', 'uyhkjmyukt@gmail.com', 1, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(11, '7b17a441d87593e029b2e6b287bca618', 'Nagy', 659200318, 'Jani', 'Jani', 'yjt5yjue5t@gmail.com', 0, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(12, '7b17a441d87593e029b2e6b287bca618', 'Nagy', 659200318, 'Jani', 'Jani', 'yjute5ryjit6e@gmail.com', 1, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(13, '7b17a441d87593e029b2e6b287bca618', 'Eni', 659200318, 'Eni', 'Eni', 'yhjtdrjty@gmail.com', 1, '0', '2024-05-11 13:47:03', '', '2024-06-07 00:09:35', ''),
(28, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Torma', 659200318, 'Kittike', 'Kitti', 'gfhbnd@gmail.com', 1, '4691f62ff7e299626237798f6045c14e', '2024-05-12 18:29:52', '', '2024-06-07 00:09:35', ''),
(29, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Nagy', 659200318, 'David', 'David', 'fbhd@gmail.com', 1, '5a9c702f87acb31331655911d380e07b', '2024-05-12 18:42:32', '', '2024-06-07 00:09:35', ''),
(30, '53e4e87a31b9f0cf83bc71bd917f7dc4', 'Torma', 659200318, 'David', 'David', 'grfjhn@gmail.com', 1, '2906ef6a5b747ecd43ad32fb0f798bc9', '2024-05-12 18:45:11', '', '2024-06-07 00:09:35', ''),
(31, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Kinga', 'Kitti', 'you@gmail.com', 1, '77c6a6f18649157a80fdba3314ea91e7', '2024-05-31 20:47:52', '', '2024-06-07 00:09:35', ''),
(32, '7b17a441d87593e029b2e6b287bca618', 'Seres', 659200318, 'Animegirl', 'Kinga', 'utr5eyujhet65y@gmail.com', 1, 'cd6bdbb1ab345e450f7fd82dd66809d9', '2024-06-02 19:37:16', '', '2024-06-07 00:09:35', ''),
(33, '07a8d09abbb404f0364da296f02f3cd1', 'seres', 659200318, 'fel', 'kinga', 'ghjcgtyuj@gmail.com', 1, 'c08411afba32d2c67a25f50f23b6bbdf', '2024-06-03 14:43:32', '', '2024-06-07 00:09:35', ''),
(35, '9bdaf14eb255bf0b2457e5bb8427de5e', 'Seres', 659200318, 'Animegirl', 'Kinga', 'kingasoros@gmail.com', 1, '3644808847ca09d156b606cfebe55e75', '2024-06-13 11:22:36', '', '2024-06-13 11:22:36', '20240613112236.jpg');

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
  `categories` varchar(100) NOT NULL,
  `likes` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `img`, `paragraph`, `price`, `food_name`, `your_name`, `time`, `servings`, `activated`, `activation_token`, `activation_expire`, `categories`, `likes`) VALUES
(35, '20240612221451.webp', 'Step1\r\nPreheat the oven to 375 degrees F (190 degrees C). \r\n\r\nStep2\r\nStir harissa paste, honey, olive oil, minced garlic, cumin, coriander, salt, and pepper together in a bowl. Rub the mixture over each chicken thigh and under the skin, ensuring each thig', 2000, 'Harissa Honey Chicken', 'France Cevallos', '00:00:50', '4', 1, '1d18928ad3f0cd0fc9acb0cb3e219286', '2024-06-12 22:14:51', 'Chicken main course', 1),
(36, '20240612223229.webp', 'Step1\r\nCombine soy sauce, sake, rice vinegar, and brown sugar in a bowl and whisk well until sugar is dissolved.  Stir in sesame seeds and crushed red pepper and set aside. \r\n\r\nStep2\r\nHeat oils in a large skillet over high heat. Sprinkle salt and pepper e', 2200, 'Chicken Teriyaki', 'Nicole McLaughlin', '00:00:25', '3', 1, '98749217759397f55442570e07916043', '2024-06-12 22:32:29', 'Chicken main course', 1),
(37, '20240613110619.webp', 'Step1\r\nPreheat the oven to 400 degrees F (200 degrees C) and spray a baking dish with cooking spray.\r\n\r\nStep2\r\nCombine soy sauce, brown sugar, garlic, and ginger in a small bowl. Place the salmon in the prepared baking dish, skin side down. Pour teriyaki ', 2100, 'Teriyaki Salmon Bowl', 'Chef Mo', '00:00:30', '1', 1, '8ed801b9901ad3dbc1125f54d40a1645', '2024-06-13 11:06:19', 'Fish', 0);

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
(20, 35, 12, '4'),
(21, 35, 13, '3 tablespoons'),
(22, 35, 14, '2 tablespoons'),
(23, 35, 15, '2 tablespoons'),
(24, 35, 16, '2 cloves'),
(25, 35, 17, '1/2 teaspoon'),
(26, 35, 18, '1/2 teaspoon'),
(27, 35, 19, '1/2 teaspoon'),
(28, 35, 20, '1/8 teaspoon'),
(29, 35, 21, '1'),
(30, 36, 22, '1 cup'),
(31, 36, 23, '1/4 cup'),
(32, 36, 24, '3 tablespoons'),
(33, 36, 25, '1/3 cup'),
(34, 36, 26, '1 tablespoon'),
(35, 36, 27, '1/4 teaspoon'),
(36, 36, 28, '2 teaspoons'),
(37, 36, 29, '1 teaspoon'),
(38, 36, 19, '1 teaspoon'),
(39, 36, 20, '1/2 teaspoon'),
(40, 36, 30, '2 pounds'),
(41, 36, 31, '2 teaspoons'),
(42, 36, 32, '1 teaspoon'),
(43, 36, 21, '1 bunch'),
(44, 36, 33, '1 1/2 cups'),
(45, 37, 22, '1/4 cup low-sodium'),
(46, 37, 25, '3 tablespoons'),
(47, 37, 16, '1 small clove'),
(48, 37, 26, '1 teaspoon'),
(49, 37, 31, '1 tablespoon'),
(50, 37, 34, '1 (6 ounce)'),
(51, 37, 35, '1/4 cup grated'),
(52, 37, 36, '2'),
(53, 37, 37, '1 cup shredded'),
(54, 37, 33, '1 cup'),
(55, 37, 21, '1');

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
  MODIFY `ingrediens_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT a táblához `profil`
--
ALTER TABLE `profil`
  MODIFY `profil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT a táblához `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT a táblához `receipt_ingredient`
--
ALTER TABLE `receipt_ingredient`
  MODIFY `receipt_ingredient_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
