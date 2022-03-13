-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2022 at 05:39 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pagination`
--
CREATE DATABASE IF NOT EXISTS `pagination` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pagination`;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `nom_film` varchar(50) NOT NULL,
  `genre_film` varchar(50) NOT NULL,
  `date_film` date NOT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id_film`, `nom_film`, `genre_film`, `date_film`) VALUES
(1, 'Svensson, Svensson - I nöd och lust', 'Comedy', '2021-12-10'),
(2, 'Live and Let Die', 'Action|Adventure|Thriller', '2021-07-21'),
(3, 'Precious Find', 'Action|Sci-Fi', '2020-07-08'),
(4, 'Swamp Thing', 'Horror|Sci-Fi', '2021-01-19'),
(5, 'On Probation (Tiempo de Valientes)', 'Action|Comedy', '2021-05-14'),
(6, 'Indiscretion of an American Wife (a.k.a. Terminal ', 'Drama', '2021-11-09'),
(7, '20 Feet from Stardom (Twenty Feet from Stardom)', 'Documentary', '2021-08-22'),
(8, 'GasLand', 'Documentary', '2021-04-29'),
(9, 'Godzilla (Gojira)', 'Drama|Horror|Sci-Fi', '2020-12-05'),
(10, 'Dog\'s Breakfast, A', 'Comedy', '2022-01-20'),
(11, 'Syndromes and a Century (Sang sattawat)', 'Drama', '2020-06-26'),
(12, 'Brand Upon the Brain!', 'Adventure|Fantasy|Mystery', '2020-05-25'),
(13, 'Adulthood', 'Drama', '2020-09-23'),
(14, 'Redhead from Wyoming, The', 'Western', '2020-09-06'),
(15, 'Bachelorette', 'Comedy', '2021-06-15'),
(16, 'Fortress', 'Action|Thriller', '2020-01-06'),
(17, 'Sudden Manhattan', 'Comedy', '2021-04-09'),
(18, 'Before the Devil Knows You\'re Dead', 'Crime|Drama|Thriller', '2020-01-22'),
(19, 'Mission: Impossible', 'Action|Adventure|Mystery|Thriller', '2020-11-22'),
(20, 'What! No Beer?', 'Comedy', '2020-10-26'),
(21, 'Werewolf, The', 'Horror|Sci-Fi', '2020-05-22'),
(22, 'The Emperor\'s Candlesticks', 'Drama|Romance', '2020-02-18'),
(23, 'Interview with the Assassin', 'Drama', '2020-04-06'),
(24, 'Confessions of a Teenage Drama Queen', 'Comedy', '2021-07-14'),
(25, 'Pekko ja unissakävelijä', 'Comedy', '2020-02-21'),
(26, 'Dealing: Or the Berkeley-to-Boston Forty-Brick Los', 'Comedy|Drama|Thriller', '2020-08-31'),
(27, 'Footprints on the Moon (Le orme) (Primal Impulse)', 'Mystery|Thriller', '2020-12-05'),
(28, 'Burnt by the Sun 2 (Utomlyonnye solntsem 2)', 'Drama', '2020-12-07'),
(29, 'Shanks', 'Fantasy|Horror', '2020-06-11'),
(30, 'Midnight Madness', 'Comedy', '2022-01-30'),
(31, 'Mr. Lucky', 'Comedy|Romance', '2020-04-18'),
(32, 'Zero de conduite (Zero for Conduct) (Zéro de condu', 'Comedy|Drama', '2021-04-20'),
(33, 'Black Dog', 'Action|Thriller', '2021-01-31'),
(34, 'Fantastic Planet, The (Planète sauvage, La)', 'Animation|Sci-Fi', '2021-02-23'),
(35, 'Mail Order Bride', 'Comedy|Western', '2020-05-01'),
(36, 'Up Close and Personal', 'Drama|Romance', '2021-12-27'),
(37, 'Hitler\'s Madman', 'Drama|War', '2020-07-22'),
(38, 'Harvest (Stadt Land Fluss)', 'Drama|Romance', '2020-09-14'),
(39, 'Peg o\' My Heart', 'Drama|Romance', '2021-02-08'),
(40, 'Bonsái', 'Drama', '2021-01-18'),
(41, 'Peaceful Warrior', 'Drama', '2020-08-26'),
(42, 'Monster, The (Mostro, Il)', 'Comedy', '2022-02-10'),
(43, 'Ivan\'s Childhood (a.k.a. My Name is Ivan) (Ivanovo', 'Drama|War', '2020-09-14'),
(44, 'Saving Lincoln', 'Drama', '2020-07-26'),
(45, 'State Fair', 'Comedy|Drama|Romance', '2020-12-27'),
(46, 'Christmas Carol: The Movie', 'Animation|Children', '2020-12-21'),
(47, 'Experiment Perilous', 'Romance|Thriller', '2021-11-23'),
(48, 'Sleeping Car, The', 'Comedy|Horror', '2021-10-03'),
(49, 'The Monastery of Sendomir', 'Drama', '2020-02-04'),
(50, 'Flamingo Road', 'Drama|Romance', '2020-12-02'),
(51, 'Khartoum', 'Action|Adventure|Drama|War', '2020-07-19'),
(52, 'Rancho Notorious', 'Drama|Western', '2021-11-05'),
(53, 'Road Games (a.k.a. Roadgames)', 'Thriller', '2020-04-17'),
(54, 'Cruel Romance, A (Zhestokij Romans)', 'Drama|Romance', '2021-04-25'),
(55, 'Nadja', 'Drama', '2021-01-08'),
(56, 'Children of the Revolution', 'Comedy', '2021-02-13'),
(57, 'Four-Faced Liar, The', 'Comedy|Drama|Romance', '2020-02-22'),
(58, 'Cadillac Records', 'Drama|Musical', '2021-07-12'),
(59, 'Mulan II', 'Action|Animation|Children|Comedy|Musical', '2020-08-04'),
(60, 'You\'re Missing the Point', 'Comedy', '2021-06-20'),
(61, 'Karthik Calling Karthik', 'Comedy|Drama|Thriller', '2021-10-01'),
(62, 'Lasa y Zabala', '(no genres listed)', '2021-04-22'),
(63, '51', 'Horror|Sci-Fi', '2021-09-10'),
(64, 'Planet of the Vampires (Terrore nello spazio)', 'Horror|Sci-Fi', '2020-02-28'),
(65, 'Lady, The', 'Drama', '2020-02-07'),
(66, 'Monster Squad, The', 'Adventure|Comedy|Horror', '2020-09-04'),
(67, 'Ladyhawke', 'Adventure|Fantasy|Romance', '2020-05-24'),
(68, 'Kindred, The', 'Horror|Sci-Fi', '2021-04-15'),
(69, 'Seems Like Old Times', 'Comedy|Romance', '2020-03-21'),
(70, 'Aaron Loves Angela', 'Comedy|Drama|Romance|Thriller', '2020-12-04'),
(71, 'Agent Cody Banks 2: Destination London', 'Action|Adventure|Children|Comedy', '2020-12-06'),
(72, 'Dinotopia', 'Adventure|Fantasy', '2021-07-02'),
(73, 'If These Walls Could Talk', 'Drama', '2021-11-04'),
(74, 'Secret Adventures of Gustave Klopp, The (Narco)', 'Action|Comedy|Fantasy', '2020-05-06'),
(75, 'Before Sunrise', 'Drama|Romance', '2020-05-16'),
(76, 'Loosies', 'Comedy|Drama|Romance', '2021-08-18'),
(77, 'Madame Butterfly', 'Musical', '2020-07-22'),
(78, 'Stonewall Uprising', 'Documentary', '2020-12-06'),
(79, 'Lure of the Sila', 'Drama', '2021-03-30'),
(80, 'Dreamcatcher', 'Drama|Horror|Sci-Fi|Thriller', '2021-03-16'),
(81, 'Imitation of Life', 'Drama|Romance', '2020-07-02'),
(82, 'Miss You Can Do It', 'Documentary', '2021-03-09'),
(83, 'Griffin and Phoenix', 'Drama', '2021-07-03'),
(84, 'Serenity', 'Action|Adventure|Sci-Fi', '2020-06-14'),
(85, 'Alien Nation', 'Crime|Drama|Sci-Fi|Thriller', '2022-01-07'),
(86, 'Survive Style 5+', 'Fantasy|Mystery|Romance|Thriller', '2021-05-17'),
(87, 'Bat, The', 'Mystery|Thriller', '2020-07-02'),
(88, 'Three Little Words', 'Comedy|Musical|Romance', '2020-07-10'),
(89, 'Make Them Die Slowly (Cannibal Ferox)', 'Horror', '2021-11-26'),
(90, 'Color of Pomegranates, The (Sayat Nova)', 'Drama', '2020-04-25'),
(91, 'Postman, The', 'Action|Adventure|Drama|Sci-Fi', '2020-07-15'),
(92, 'Let Fury Have the Hour', 'Documentary', '2021-12-10'),
(93, 'Jungleground', 'Action|Sci-Fi|Thriller', '2020-09-25'),
(94, 'Spiral', 'Horror', '2020-10-14'),
(95, 'Seeking Asian Female', 'Documentary', '2020-07-15'),
(96, 'Reservoir Dogs', 'Crime|Mystery|Thriller', '2021-01-10'),
(97, 'Imago mortis', 'Horror', '2021-11-19'),
(98, 'Forest for the Trees, The (Der Wald vor lauter Bäu', 'Drama', '2021-09-20'),
(99, 'Sione\'s Wedding (Samoan Wedding)', 'Comedy|Romance', '2021-12-05'),
(100, 'Ernest Goes to School', 'Children|Comedy|Drama', '2020-08-23'),
(101, 'Played', 'Crime|Thriller', '2021-08-15'),
(102, 'Sea Fog', 'Drama', '2020-02-19'),
(103, 'Anguish (Angustia)', 'Horror', '2020-07-28'),
(104, 'Godzilla vs. Hedorah (Gojira tai Hedorâ) (Godzilla', 'Horror|Sci-Fi', '2020-08-13'),
(105, 'In a Dark Place', 'Horror|Mystery|Thriller', '2020-07-30'),
(106, 'Bedevilled (Kim Bok-nam salinsageonui jeonmal)', 'Crime|Drama|Horror', '2021-01-29'),
(107, 'Bloody Mama', 'Crime|Drama', '2020-03-16'),
(108, 'Hen Hop', 'Animation', '2022-01-26'),
(109, 'Antoine and Colette (Antoine et Colette)', 'Comedy|Drama', '2021-05-05'),
(110, 'It\'s a Bird', '(no genres listed)', '2020-03-31'),
(111, 'Brief Encounter', 'Drama|Romance', '2021-08-28'),
(112, 'Burton and Taylor', 'Drama', '2020-03-13'),
(113, 'Starfighters, The', 'Drama', '2021-11-10'),
(114, 'Jack and Sarah', 'Romance', '2020-09-13'),
(115, 'Beast of Yucca Flats, The', 'Horror|Sci-Fi', '2021-10-08'),
(116, 'Century of the Self, The', 'Documentary', '2021-08-31'),
(117, 'Wild Rovers', 'Western', '2021-12-07'),
(118, 'Goliath Awaits', 'Drama|Sci-Fi|War', '2021-01-18'),
(119, 'Vollidiot', 'Comedy|Drama', '2021-02-09'),
(120, 'Confessions of a Gangsta', 'Action', '2022-02-27'),
(121, 'Raw Deal', 'Action', '2021-11-10'),
(122, 'Palmetto', 'Crime|Drama|Mystery|Romance|Thriller', '2020-11-21'),
(123, 'Oasis', 'Drama|Romance', '2020-01-21'),
(124, 'Napoleon and Samantha', 'Adventure|Drama', '2021-11-04'),
(125, 'Circle of Eight', 'Horror|Mystery', '2020-12-02'),
(126, 'Girl from Jones Beach, The', 'Comedy', '2020-04-07'),
(127, 'Pointe-Courte, La', 'Drama', '2021-07-18'),
(128, 'Under Our Skin', 'Documentary', '2020-08-24'),
(129, 'Manito', 'Drama', '2020-03-24'),
(130, 'Producers, The', 'Comedy', '2020-04-04'),
(131, 'Letters from Iwo Jima', 'Drama|War', '2021-10-05'),
(132, 'Defiance', 'Drama|Thriller|War', '2021-01-15'),
(133, 'Invasion, The', 'Action|Drama|Horror|Sci-Fi|Thriller', '2020-05-25'),
(134, 'Mummy, The', 'Action|Adventure|Comedy|Fantasy|Horror|Thriller', '2020-09-20'),
(135, 'Dylan Moran: Like, Totally', 'Comedy', '2021-01-16'),
(136, 'Ways to Live Forever', 'Children|Drama', '2022-02-08'),
(137, 'Reality', 'Comedy', '2021-07-17'),
(138, 'Master of Disguise, The', 'Comedy|Mystery', '2021-04-22'),
(139, 'End of America, The', 'Documentary', '2020-02-08'),
(140, 'Small Town Gay Bar', 'Documentary', '2020-04-23'),
(141, 'Thrust in Me', '(no genres listed)', '2020-08-07'),
(142, 'Wild China', 'Documentary', '2020-12-06'),
(143, 'Adventures of Ford Fairlane, The', 'Action|Comedy', '2020-12-20'),
(144, 'Torn', 'Drama', '2020-12-30'),
(145, '25 Watts', 'Comedy|Drama', '2021-06-17'),
(146, 'Jean-Michel Basquiat: The Radiant Child', 'Documentary', '2021-11-09'),
(147, 'Illegal Tender', 'Crime|Drama|Thriller', '2022-03-05'),
(148, 'Death at a Funeral', 'Comedy', '2022-01-19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
