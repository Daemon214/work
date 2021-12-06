-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 05:54 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taray`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcatalog`
--

CREATE TABLE `tblcatalog` (
  `id` int(11) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `bs` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcatalog`
--

INSERT INTO `tblcatalog` (`id`, `cat`, `fname`, `descr`, `pic`, `qty`, `price`, `bs`) VALUES
(123, '10', 'Sotanghon Guisado (Pancit)', '', 'sotanghon guisado.jpg', 1, '50.00', 0),
(121, '10', 'Canton Bihon (Pancit)', '', 'canton bihon.jpeg', 1, '55.00', 0),
(122, '10', 'MIkki Bihon Guisado (Pancit)', '', 'miki guisado.jpg', 1, '55.00', 0),
(118, '12', 'Vegetale Fish Fillet (Rice Toppings)', '', 'vegetable fish fillet.jpg', 1, '60.00', 0),
(119, '10', 'Canton Guisado (Pancit)', '', 'canton guisado.jpg', 1, '60.00', 0),
(120, '10', 'Bihon Guisado (Pancit)', '', 'bihon guisado.jpg', 1, '55.00', 0),
(116, '12', 'Sweet and Sour Fish (Rice Toppings)', '', 'sweet-and-sour-fish.jpg', 1, '55.00', 0),
(117, '12', 'Sweet and Sour Porkchop (Rice Toppings)', '', 'sweet-and-sour-pork chop.jpg', 1, '60.00', 0),
(114, '12', 'Pork with Corn Souce (Rice Toppings)', '', 'pork with corn.jpg', 1, '60.00', 0),
(115, '12', 'Sweet and Sour Fish Fillet (Rice Toppings)', '', 'sweet and sour fish fillet.jpg', 1, '55.00', 0),
(111, '12', 'Pork Adobo', '', 'pork adobo.jpg', 1, '60.00', 0),
(112, '12', 'Pork Caldereta (Rice Toppings)', '', 'pork caldereta.jpg', 1, '60.00', 0),
(113, '12', 'Pork Vegetable', '', 'pork vege.jpg', 1, '60.00', 0),
(110, '12', 'Pineapple Porkchop', '', 'pineapple porkchop.jpg', 1, '60.00', 0),
(109, '12', 'Onion Porkchop (Rice Toppings)', '', 'onion porkchop.jpg', 1, '60.00', 0),
(108, '12', 'Liempo Grill (Rice Toppings)', '', 'liempo grill.jpg', 1, '60.00', 0),
(107, '12', 'Lechong Paksiw (Rice Toppings)', '', 'lechong paksiw.jpg', 1, '60.00', 0),
(106, '12', 'Fish Fillet (Rice Toppings)', '', 'fish fillet.jpg', 1, '55.00', 0),
(105, '12', 'Chicken Vegetable', '', 'chicken vegetable.jpg', 1, '60.00', 0),
(103, '12', 'Chicken Sweet and Sour (Rice Toppings)', '', 'chicken sweet and sour.jpg', 1, '55.00', 0),
(104, '12', 'Chicken Sweet and Spicy (Rice Toppings)', '', 'chicken sweet and spicy.jpg', 1, '55.00', 0),
(102, '12', 'Chicken Pineapple (Rice Toppings)', '', 'chicken pineapple.jpg', 1, '55.00', 0),
(101, '12', 'Chicken Ampalaya', '', 'chicken ampalaya.jpg', 1, '60.00', 0),
(99, '12', 'Beef Steak', '', 'beef steak.jpg', 1, '60.00', 0),
(100, '12', 'Chicken Adobo (Rice Toppings)', '', 'chicken adobo.jpg', 1, '55.00', 0),
(97, '12', 'Bicol Express (Rice Toppings)', '', 'bicol express.jpg', 1, '55.00', 0),
(98, '12', 'Beef Pares (Rice Toppings)', '', 'beef pares.jpg', 1, '60.00', 0),
(95, '11', 'Sinigang na Baka (Soup)', '', 'sinigang na baka.jpg', 1, '75.00', 0),
(96, '11', 'Nilagang Baka (Soup)', '', 'nilagang baka.jpg', 1, '75.00', 0),
(94, '11', 'Lomi (Soup)', '', 'lomi.jpg', 1, '60.00', 0),
(92, '11', 'Bulalo (Soup)', '', 'bulalo.jpg', 1, '65.00', 0),
(93, '11', 'Sinigang na Ulo ng Salmon (Soup)', '', 'sinigang salmon ulo.jpg', 1, '65.00', 0),
(91, '11', 'Sinigang na Baboy (Soup)', '', 'sinigang na baboy.png', 1, '65.00', 0),
(88, '13', 'Tokwat  Isda (Best Seller)', '', 'td.jpg', 1, '65.00', 0),
(89, '13', 'Chopsuey (Best Seller)', '', 'chop.jpg', 1, '65.00', 0),
(90, '11', 'Sotanghon (Soup)', '', 'sotanghon.jpg', 1, '55.00', 0),
(87, '13', 'Tokwat Baboy (Best Seller)', '', 'tb.jpg', 1, '65.00', 0),
(86, '13', 'Sisig (Best Seller)', '', 'Ps.jpg', 1, '65.00', 1),
(85, '9', 'PorkSilog (silog)', '', 'poksi.jpg', 1, '70.00', 0),
(83, '13', 'BangSilog (Silog)', '', 'bangsilog.jpg', 1, '70.00', 0),
(84, '9', 'Cornsilog (silog)', '', 'cornsilog.jpg', 1, '55.00', 0),
(81, '9', 'Hamsilog (silog)', '', 'hamsilog.jpg', 1, '55.00', 0),
(82, '13', 'Tosilog (silog)', '', 'tosilog.jpg', 1, '55.00', 0),
(80, '9', 'FootSilog (silog)', '', 'footsilog.jpg', 1, '55.00', 0),
(79, '9', 'Hotsilog (silog)', '', 'hotsilog.jpg', 1, '55.00', 0),
(75, '9', 'Tapsilog (silog)', '', 'tapsi.jpg', 1, '70.00', 0),
(77, '9', 'Chicksilog (silog)', '', 'chicksilog.jpg', 1, '70.00', 0),
(78, '9', 'Longsilog (silog)', '', 'longsilog.jpg', 1, '60.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `descr`) VALUES
(14, 'Pogi'),
(13, 'Best Sellers'),
(12, 'RIce Toppings'),
(11, 'Soup'),
(10, 'Pancit'),
(9, 'Silog meals');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `us` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `newsletter` int(11) NOT NULL DEFAULT 0,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`id`, `fname`, `mname`, `lname`, `addr`, `mobile`, `email`, `us`, `age`, `gender`, `newsletter`, `active`) VALUES
(1, 'sample', 'sample', 'sample', 'sample', '09123456789', 'mikel@gmail.com', 'sample', 21, 'male', 0, 1),
(2, 'sample', 'sample', 'sample', 'sample', '09123456789', 'mikel@gmail.com', 'sample', 21, 'male', 0, 1),
(3, 'Sean Kchassey', 'Nones', 'Ramos', '02 A.Bonifacio St, Bagong Silangan, Quezon City', '09662849872', 'seankc_13@yahoo.com', 'snkchssyrms13', 21, 'male', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbldata`
--

CREATE TABLE `tbldata` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `loc` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldata`
--

INSERT INTO `tbldata` (`id`, `fb_id`, `pic`, `lat`, `long`, `loc`, `desc`) VALUES
(1, 'samp', '1.jpg', '120.123186', '14.226148', 'manila', 'desc'),
(2, '2', '2.jpg', '120.983186', '14.626148', 'rizal ave', 'rizal ave');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeatured`
--

CREATE TABLE `tblfeatured` (
  `id` int(11) NOT NULL,
  `prodno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfeatured`
--

INSERT INTO `tblfeatured` (`id`, `prodno`) VALUES
(12, 33),
(11, 57),
(13, 86),
(14, 75),
(15, 88),
(16, 89),
(17, 87),
(18, 123);

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblingredients`
--

CREATE TABLE `tblingredients` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `grams` double NOT NULL,
  `ep` double NOT NULL,
  `carb` double NOT NULL,
  `protein` double NOT NULL,
  `fat` double NOT NULL,
  `kcal` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblingredients`
--

INSERT INTO `tblingredients` (`id`, `prod_id`, `fname`, `grams`, `ep`, `carb`, `protein`, `fat`, `kcal`) VALUES
(1, 33, 'Soy Bean Curd', 26, 1, 4, 11.4, 6.2, 117),
(2, 33, 'Tomato', 26, 0.99, 5.2, 0.9, 0.3, 27),
(3, 33, 'Cheese (Cheddar)', 14, 1, 7.8, 2.1, 22.7, 322),
(4, 33, 'Basil', 1, 0.64, 3.75, 2.44, 8.37, 1),
(5, 34, 'Carrot', 29, 0.89, 3.84, 2.78, 8.37, 45),
(6, 34, 'Cabbage (Green)', 28, 0.81, 4.8, 1.4, 0.3, 28),
(7, 34, 'Green Bean', 25, 0.93, 7.2, 3.1, 0.2, 43),
(8, 34, 'Seaweed (gamet)', 16, 1, 36.7, 23.7, 1.2, 252),
(15, 36, 'Potato', 118, 0.85, 16.8, 2.4, 0.1, 78),
(16, 36, 'Tomato', 31, 0.99, 5.2, 0.9, 0.3, 27),
(17, 36, 'Cheese (Cheddar)', 19, 1, 7.8, 21.7, 22.7, 322),
(18, 36, 'Basil', 5, 0.64, 3.57, 2.44, 8.37, 1),
(19, 35, 'Chickpea Flour', 40, 1, 4.07, 4.27, 8.37, 356),
(20, 35, 'Shiitake Mushroom', 29, 0.94, 6.9, 3.8, 0.6, 48),
(21, 37, 'Soy Bean Curd', 36, 1, 4, 11.4, 6.2, 117),
(22, 37, 'Flour (All-Purpose flour)', 20, 1, 73.7, 12.6, 0.8, 352),
(23, 37, 'Sesame Seed', 6, 1, 15.1, 25.1, 53.5, 642),
(24, 42, 'Soy Bean Curd', 81, 1, 4, 11.4, 6.2, 117),
(25, 42, 'Seaweed (Dried)', 4, 1, 36.7, 23.7, 1.2, 252),
(26, 41, 'Eggplant', 83, 0.91, 5.8, 1, 0.2, 29),
(27, 41, 'Tomato', 47, 0.99, 5.2, 0.9, 0.3, 27),
(28, 41, 'Cheese (Cheddar)', 8, 1, 7.8, 21.7, 22.7, 322),
(29, 41, 'Cheese (Parmesan)', 8, 1, 7.8, 21.7, 22.7, 322),
(30, 39, 'Brocolli', 30, 0.61, 3.57, 2.44, 8.37, 34),
(31, 39, 'Cauliflower', 35, 0.64, 5.2, 2.1, 0.3, 32),
(32, 39, 'Zucchini', 15, 0.95, 3.57, 2.44, 8.37, 17),
(33, 39, 'Corn Kernels', 8, 1, 63.2, 8.5, 21.8, 483),
(34, 39, 'Baguio Beans', 18, 0.54, 6, 4.2, 0.4, 44),
(35, 39, 'Carrots', 19, 0.89, 3.84, 2.78, 8.37, 45),
(36, 39, 'Chayote', 21, 1, 3.5, 0.3, 0.1, 16),
(37, 39, 'Mushroom', 22, 0.94, 6.9, 3.8, 0.6, 48),
(38, 39, 'Red and Green Bell Pepper', 6, 0.82, 6.03, 0.99, 0.02, 31),
(39, 39, 'Mashed Potato', 52, 1, 13.7, 1.7, 0.1, 62),
(40, 43, 'Tofu', 98, 1, 2, 8.1, 5.4, 89),
(41, 43, 'Mushroom', 27, 0.94, 6.9, 3.8, 0.6, 48),
(42, 43, 'Wheat Gluten', 27, 1, 13.79, 75.16, 0.27, 370),
(43, 43, 'Zucchini', 19, 0.95, 3.57, 2.44, 8.37, 17),
(44, 43, 'Bell Pepper (Red or Green)', 19, 0.82, 6.03, 0.99, 0.02, 31),
(45, 43, 'Shalots', 5, 0.83, 14.1, 1.7, 0.5, 68),
(46, 38, 'Wheat Gluten', 80, 1, 13.79, 75.16, 0.27, 370),
(47, 38, 'Garlic', 6, 0.85, 24.6, 7, 0.3, 129),
(48, 38, 'Pineapple', 18, 0.58, 13, 0.4, 0.2, 55),
(49, 40, 'Wheat Gluten', 250, 1, 13.79, 75.16, 0.27, 370),
(50, 40, 'Veggie Sausage', 235, 1, 4, 6, 2, 59),
(51, 40, 'Potato', 182, 1, 13.7, 1.7, 0.1, 62),
(52, 40, 'Carrots', 182, 0.89, 3.84, 2.78, 8.37, 45),
(53, 40, 'Green Peas', 90, 1, 4.07, 3.47, 8.37, 77),
(54, 40, 'Wheat Flour', 57, 1, 73.7, 12.6, 0.8, 352),
(55, 40, 'Olive', 50, 1, 3.6, 3.36, 8.37, 115),
(56, 40, 'Bell Pepper (Red or Green)', 40, 0.82, 6.03, 0.99, 0.02, 31),
(57, 45, 'Soy Bean Curd', 202, 1, 4, 11.4, 6.2, 117),
(58, 45, 'Bread Crumbs', 12, 1, 4.1, 4, 8.4, 383),
(59, 45, 'Seaweed (gamet)', 6, 1, 36.7, 23.7, 1.2, 252),
(60, 45, 'Carrots', 7, 0.89, 3.84, 2.78, 8.37, 50),
(61, 45, 'Green Peas', 4, 1, 4.07, 3.47, 8.37, 77),
(62, 45, 'Bell Pepper (Red or Green)', 9, 0.82, 6.03, 0.99, 0.02, 31),
(63, 45, 'Raisins', 5, 1, 3.6, 3.36, 8.37, 302),
(64, 44, 'Wheat Gluten', 179, 1, 13.79, 75.16, 0.27, 370),
(65, 44, 'Brocolli', 45, 0.61, 3.57, 2.44, 8.37, 34),
(66, 44, 'Cashew nuts w/ salt', 24, 1, 4.07, 3.47, 8.37, 574),
(67, 46, 'Eggplant', 46, 0.91, 5.8, 1, 0.2, 29),
(68, 46, 'Wheat Gluten', 45, 1, 13.79, 75.16, 0.27, 370),
(69, 46, 'Banana Heart', 40, 0.52, 7.2, 1.6, 0.4, 39),
(70, 46, 'Chinese Cabbage', 36, 0.88, 3.57, 2.44, 8.37, 13),
(71, 46, 'Green Bean', 20, 0.93, 7.2, 3.1, 0.2, 43),
(72, 46, 'Pechay', 15, 0.84, 3.2, 2, 0.5, 25),
(73, 46, 'Ground Peanuts', 7, 0.93, 9, 32.1, 50.7, 621),
(74, 47, 'Tofu', 130, 1, 2, 8.1, 5.4, 89),
(75, 47, 'Wheat Gluten', 120, 1, 13.79, 75.16, 0.27, 370),
(76, 47, 'Onion', 30, 0.83, 14.1, 1.7, 0.5, 68),
(77, 47, 'Bell Pepper (Red or Green)', 11, 0.82, 6.03, 0.99, 0.02, 31),
(78, 47, 'Garlic', 10, 0.85, 24.6, 7, 0.3, 129),
(79, 47, 'Ginger', 9, 0.74, 8.5, 1.1, 0.8, 46),
(80, 54, 'Lettuce (red leaf)', 57, 0.8, 2.26, 1.33, 0.22, 16),
(81, 54, 'Cucumber', 51, 0.81, 2.9, 0.6, 0.2, 16),
(82, 54, 'Tomato', 42, 0.99, 5.2, 0.9, 0.3, 27),
(83, 54, 'Pineapple', 18, 0.58, 13, 0.4, 0.2, 55),
(84, 54, 'Cheese (Cheddar)', 9, 1, 7.8, 21.7, 22.7, 322),
(85, 54, 'Olive', 6, 0.78, 2.6, 1, 16, 158),
(86, 54, 'Corn Kernels', 12, 1, 63.2, 8.5, 21.8, 483),
(87, 55, 'Lettuce (red leaf)', 40, 0.8, 2.26, 1.33, 0.22, 16),
(88, 55, 'Cucumber', 34, 0.81, 2.9, 0.6, 0.2, 16),
(89, 55, 'Tomato', 33, 0.99, 5.2, 0.9, 0.3, 27),
(90, 55, 'Bell Pepper (Red)', 8, 0.82, 6.03, 0.99, 0.02, 31),
(91, 56, 'Chapati', 54, 1, 46.36, 11.25, 1.95, 297),
(92, 56, 'Tomato', 7, 0.99, 5.2, 0.9, 0.3, 27),
(93, 56, 'Cucumber', 38, 0.81, 2.9, 0.6, 0.2, 16),
(94, 56, 'Vegan BBQ', 55, 1, 55, 40, 3, 396),
(96, 56, 'Lettuce (Iceberg)', 23, 0.95, 3.57, 2.44, 8.37, 14),
(97, 56, 'Cheese (Cheddar)', 10, 1, 7.8, 21.7, 22.7, 322),
(98, 56, 'Pesto Sauce', 20, 1, 0.76, 2.71, 1.94, 80),
(99, 57, 'Wheat Bread', 112, 1, 46.68, 10.72, 0.7, 267),
(100, 57, 'Tomato', 24, 0.99, 5.2, 0.9, 0.3, 27),
(101, 57, 'Tofu', 39, 1, 2, 8.1, 5.4, 89),
(102, 57, 'Ham', 45, 1, 3.87, 4.27, 9.02, 163),
(103, 57, 'Cheese (Cheddar)', 14, 1, 7.8, 21.7, 22.7, 322),
(104, 57, 'Lettuce (Iceberg)', 14, 0.95, 3.57, 2.44, 8.37, 14),
(105, 58, 'Mushroom (White Button)', 43, 0.94, 6.9, 3.8, 0.6, 48),
(106, 58, 'Tofu', 33, 1, 2, 8.1, 5.4, 89),
(107, 58, 'Oats', 11, 1, 77.9, 10, 4.7, 394),
(108, 58, 'Onion', 4, 0.83, 14.1, 1.7, 0.5, 68),
(109, 58, 'Tomato', 22, 0.99, 5.2, 0.9, 0.3, 27),
(110, 58, 'Wheat Buns', 98, 1, 46.68, 10.72, 0.7, 267),
(111, 58, 'Cheese (Cheddar)', 10, 1, 7.8, 21.7, 22.7, 322),
(112, 59, 'Chapati', 50, 1, 46.36, 11.25, 1.95, 297),
(113, 59, 'Eggplant', 31, 0.91, 5.8, 1, 0.2, 29),
(114, 59, 'Zucchini', 15, 0.95, 3.57, 2.44, 8.37, 17),
(115, 59, 'Bell Pepper (Red or Green)', 5, 0.82, 6.03, 0.99, 0.02, 31),
(116, 59, 'Cheese (Cheddar)', 10, 1, 7.8, 21.7, 22.7, 322),
(117, 59, 'Lettuce (Iceberg)', 19, 0.95, 3.57, 2.44, 8.37, 14),
(118, 59, 'Tomato', 6, 0.99, 5.2, 0.9, 0.3, 27),
(119, 59, 'Onion', 7, 0.83, 14.1, 1.7, 0.5, 68),
(120, 59, 'Cucumber', 19, 0.81, 2.9, 0.6, 0.2, 16),
(121, 59, 'Vegan Mayo', 14, 1, 2, 1, 4, 42),
(122, 60, 'Chapati', 50, 1, 46.36, 11.25, 1.95, 297),
(123, 60, 'Mango (Ripe, Yellow)', 20, 0.58, 18.9, 0.7, 0.2, 80),
(124, 60, 'Lettuce (Iceberg)', 19, 0.95, 3.57, 2.44, 8.37, 14),
(125, 60, 'Cucumber', 19, 0.81, 2.9, 0.6, 0.2, 16),
(126, 60, 'Veggie Ham', 14, 1, 2, 15, 3, 18),
(127, 60, 'Cheese (Cheddar)', 10, 1, 7.8, 21.7, 22.7, 322),
(128, 61, 'Wheat Bread', 113, 1, 46.68, 10.72, 0.7, 267),
(129, 61, 'Tomato', 25, 0.99, 5.2, 0.9, 0.3, 27),
(130, 61, 'Black Olives', 7, 1, 3.6, 3.36, 8.37, 115),
(131, 61, 'Eggplant', 50, 0.91, 5.8, 1, 0.2, 29),
(132, 61, 'Bell Pepper (Red or Green)', 11, 0.82, 6.03, 0.99, 0.02, 31),
(133, 61, 'Zucchini', 52, 0.95, 3.57, 2.44, 8.37, 17),
(134, 61, 'Onion', 19, 0.83, 14.1, 1.7, 0.5, 68),
(135, 61, 'Cheese (Cheddar)', 10, 1, 7.8, 21.7, 22.7, 322),
(136, 62, 'Soy Bean Curd', 199, 1, 4, 11.4, 6.2, 117),
(137, 62, 'Nori', 3, 1, 1, 12, 0, 35),
(138, 62, 'Ginger', 6, 0.74, 8.5, 1.1, 0.8, 46),
(139, 62, 'Onion', 24, 0.83, 14.1, 1.7, 0.5, 68),
(140, 62, 'Tomato', 30, 0.99, 5.2, 0.9, 0.3, 27),
(141, 62, 'Sweet and Sour Sauce', 87, 1, 38.22, 0.27, 0, 150),
(142, 63, 'Shiitake Mushroom', 16, 0.94, 6.9, 3.8, 0.6, 48),
(143, 63, 'Tofu', 42, 0.94, 6.9, 3.8, 0.6, 48),
(144, 63, 'Choplets', 43, 1, 4.1, 19.4, 0.1, 103),
(145, 63, 'Pineapple', 33, 0.58, 13, 0.4, 0.2, 55),
(146, 63, 'Carrots', 22, 0.89, 3.84, 2.78, 8.37, 50),
(147, 63, 'Bell Pepper (Red or Green)', 22, 0.82, 60.3, 0.99, 0.02, 31),
(148, 65, 'Taro', 30, 1, 9.7, 1.4, 0.4, 48),
(149, 65, 'Chayote', 30, 1, 3.5, 0.3, 0.1, 16),
(150, 65, 'Carrots', 20, 0.89, 3.84, 2.78, 8.37, 50),
(151, 65, 'Radish', 20, 0.93, 7.4, 2.1, 0.6, 43),
(152, 66, 'Pumpkin', 90, 0.71, 8.6, 1.4, 0.5, 44),
(153, 66, 'Onion', 4, 0.83, 14.1, 1.7, 0.5, 68),
(154, 66, 'Garlic', 3, 0.85, 24.6, 7, 0.3, 129),
(155, 64, 'Papad', 26, 1, 59.87, 25.56, 3.25, 371),
(156, 48, 'Spaghetti', 64, 1, 4.12, 3.91, 8.37, 211),
(157, 48, 'Assorted Nuts', 12, 1, 4.07, 3.47, 8.37, 85),
(158, 48, 'Basil', 8, 64, 3.57, 2.44, 8.37, 1),
(159, 48, 'Garlic', 8, 0.85, 24.6, 7, 0.3, 129),
(160, 49, 'Spaghetti', 64, 1, 4.12, 3.91, 8.37, 211),
(161, 49, 'Tomato Sauce', 18, 1, 3.57, 2.44, 8.37, 59),
(162, 49, 'Mushroom', 7, 0.94, 6.9, 3.8, 0.6, 48),
(163, 49, 'Olives', 5, 0.78, 2.6, 1, 16, 158),
(164, 49, 'Capers', 3, 1, 2.35, 1.82, 8.37, 2),
(165, 49, 'Leeks', 4, 1, 3.57, 2.44, 8.37, 8),
(166, 49, 'Celery', 3, 1, 3.57, 2.44, 8.37, 14),
(167, 49, 'Bell Pepper', 9, 0.82, 6.03, 0.99, 0.02, 31),
(168, 50, 'Spaghetti', 64, 1, 4.12, 3.91, 8.37, 211),
(169, 50, 'Veggie Ham', 16, 1, 2, 15, 3, 18),
(170, 50, 'Sauce', 13, 1, 12.7, 3.17, 1.19, 71),
(171, 51, 'Spaghetti', 64, 1, 4.12, 3.91, 8.37, 211),
(172, 51, 'Tomato', 18, 0.99, 5.2, 0.9, 0.3, 27),
(173, 51, 'Basil', 3, 64, 3.57, 2.44, 8.37, 1),
(174, 52, 'Spaghetti', 64, 1, 4.12, 3.91, 8.37, 211),
(175, 52, 'Olive Oil', 13, 1, 0, 0, 8.84, 119),
(176, 52, 'Mushroom', 9, 0.94, 6.9, 3.8, 0.6, 48),
(177, 52, 'Garlic', 6, 0.85, 24.6, 7, 0.3, 129),
(178, 53, 'Capellini', 56, 1, 4.12, 3.91, 8.37, 211),
(179, 53, 'Tomato Sauce', 14, 1, 3.57, 2.44, 8.37, 59),
(180, 53, 'Olives', 6, 0.78, 2.6, 1, 16, 158),
(181, 53, 'Mushroom', 7, 0.94, 6.9, 3.8, 0.6, 48),
(182, 67, 'Spinach', 12, 1, 5.9, 7.89, 6.09, 172),
(183, 67, 'Onion (Red)', 4, 0.83, 14.1, 1.7, 0.5, 68),
(184, 67, 'Garlic', 3, 0.85, 24.6, 7, 0.3, 129),
(185, 68, 'Tofu', 66, 0.94, 6.9, 3.8, 0.6, 48),
(186, 68, 'Veggie Meat', 77, 1, 9.9, 17.7, 0.7, 163),
(187, 68, 'Carrots', 15, 0.89, 3.84, 2.78, 8.37, 50),
(188, 68, 'Black Olives', 4, 1, 3.6, 3.36, 8.37, 115),
(189, 68, 'Black Peppers', 7, 0.82, 6.03, 0.99, 0.02, 31),
(190, 68, 'Cheese', 12, 1, 7.8, 21.7, 22.7, 322),
(191, 69, 'Tofu', 182, 1, 2, 8.1, 4.4, 89),
(192, 69, 'Mushroom (Fresh Button)', 33, 0.94, 6.9, 3.8, 0.6, 48),
(193, 70, 'Wheat', 45, 1, 13.79, 75.16, 0.27, 370),
(194, 74, 'Chicken', 190, 0.72, 0, 20.6, 3.1, 110),
(195, 74, 'Lemon Grass', 26, 1, 13.2, 0.3, 0.3, 57),
(196, 74, 'Ginger', 3, 0.74, 8.5, 1.1, 0.8, 46),
(197, 74, 'Basil', 7, 0.64, 3.57, 2.44, 8.37, 1),
(198, 74, 'Soy Sauce', 12, 1, 15, 3.5, 0.1, 75),
(199, 74, 'Bell Pepper', 17, 0.82, 6.03, 0.99, 0.02, 31),
(200, 71, 'Garlic', 6, 0.85, 24.6, 7, 0.3, 129),
(201, 71, 'Zucchini', 18, 0.95, 3.57, 2.44, 8.37, 17),
(202, 71, 'Tomato', 20, 0.99, 5.2, 0.9, 0.3, 27),
(203, 71, 'Carrots', 18, 0.89, 3.84, 2.78, 8.37, 50),
(204, 71, 'Onion', 6, 0.83, 14.1, 1.7, 0.5, 68),
(205, 71, 'Basil', 7, 0.64, 3.57, 2.44, 8.37, 1),
(206, 73, 'Split Pea (Yellow)', 17, 1, 11.3, 5.2, 0.3, 76),
(207, 73, 'Onion', 15, 0.83, 14.1, 1.7, 0.5, 69),
(208, 73, 'Brown Rice', 11, 1, 76.5, 10, 2.8, 371),
(209, 73, 'Garlic', 4, 0.85, 24.6, 7, 0.3, 129),
(210, 73, 'Ginger', 2, 0.74, 8.5, 1.1, 0.8, 46),
(211, 73, 'Eggplant', 6, 0.91, 5.8, 1, 0.2, 29),
(212, 73, 'Tomato', 20, 0.99, 5.2, 0.9, 0.3, 27),
(213, 73, 'Wheat Buns', 98, 1, 46.68, 10.72, 0.7, 267),
(214, 73, 'Cheese (Cheddar)', 10, 1, 7.8, 21.7, 22.7, 322),
(215, 72, 'Mushroom (White Button)', 37, 0.94, 6.9, 3.8, 0.6, 48),
(216, 72, 'Onion (Red)', 4, 0.83, 14.1, 1.7, 0.5, 68),
(217, 72, 'Garlic', 3, 0.85, 24.6, 7, 0.3, 129);

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

CREATE TABLE `tblnews` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `content` varchar(32767) NOT NULL,
  `ddate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblreservationdetails`
--

CREATE TABLE `tblreservationdetails` (
  `id` int(11) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `itemid` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `fl` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblreservations`
--

CREATE TABLE `tblreservations` (
  `id` int(11) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `hh` varchar(255) NOT NULL,
  `fl` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblreviews`
--

CREATE TABLE `tblreviews` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rating` double NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_content` varchar(10000) NOT NULL,
  `rev_name` varchar(255) NOT NULL,
  `rev_fb_id` varchar(255) NOT NULL,
  `ddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsettings`
--

CREATE TABLE `tblsettings` (
  `id` int(11) NOT NULL,
  `var` varchar(255) NOT NULL,
  `value` varchar(18000) NOT NULL,
  `opt1` varchar(255) NOT NULL,
  `opt2` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsettings`
--

INSERT INTO `tblsettings` (`id`, `var`, `value`, `opt1`, `opt2`, `pic`) VALUES
(1, 'companyname', 'Marshas Tapsilogan', '', '', ''),
(2, 'banner', '', '', '', 'bann.png'),
(3, 'aboutus', '', '', '', ''),
(4, 'contactus', '', '', '', ''),
(13, 'media', '<h3><b>TELEVISION</b></h3><ul><li><b><a target=\"_blank\" rel=\"nofollow\" href=\"https://www.youtube.com/watch?v=ZwuWJ_It1bc&amp;feature=youtu.b\">https://www.youtube.com/watch?v=ZwuWJ_It1bc&amp;feature=youtu.b</a></b></li></ul><br><h3><b>BLOGS</b></h3><ul><li><b><a target=\"_blank\" rel=\"nofollow\" href=\"http://samthingtodo.wordpress.com/2014/08/11/greens-restaurant-cafe/\">http://samthingtodo.wordpress.com/2014/08/11/greens-restaurant-cafe/</a></b></li></ul><br><h3><b>NEWSPAPER</b></h3><ul><li><a target=\"_blank\" rel=\"nofollow\" href=\"https://foursquare.com/greensresto/update/533cc49a498e5b5cceb9851b?ref=fb&amp;source=fbwall\">https://foursquare.com/greensresto/update/533cc49a498e5b5cceb9851b?ref=fb&amp;source=fbwall</a></li></ul><br><br>', '', '', ''),
(5, 'terms', 'Payment<br><br>All payments are due upon receipt. If a payment is not received or payment method is declined, the buyer forfeits the ownership of any items purchased. If no payment is received, no items will be shipped.<br><br>Shipping Policies<br><br>Shipping will be paid for by the buyer in the amount agreed upon by the seller at the time of purchase. If an item is lost during shipping, the total cost of item, including shipping, will be refunded to the buyer by the seller. Shipping costs may double if shipping internationally. If an item is damaged during shipping, seller will not be held responsible.<br><br>Refund/Return Policy<br><br>Items are entitled to be refunded or returned based on complaint. If an item is damaged during shipping, a replacement item will be sent free of charge. If an item is unsatisfactory, a written explanation is needed before the item may be considered for a refund. Buyer must take into account the description of the item before requesting a refund. If the item matches the description by the seller and the buyer is unsatisfied, seller is not responsible for refund. Exchanges are granted on a case-by-case basis.<br><br>Cancellation<br><br>An item may be cancelled up until payment has been processed. Once payment has been processed, the buyer is responsible for payment.<br><br>Complaints<br><br>Any complaints about items or sellers may be sent to our support team: support@teabar.com. There is no guarantee of a resolution. Each case will be looked at individually, and the seller will be in contact as well.', '', '', ''),
(6, 'theme', 'warning', '', '', ''),
(7, 'companyaddr', '02 A.Bonifacio St, Bagong Silangan, Quezon City', '', '', ''),
(8, 'companyphone', '09292360854', '', '', ''),
(9, 'whatsup', 'The origin of tea bar can be traced back to the year 2737  BC. During that time, people usually consumed boiled water, owing to health  reasons. One day, Chinese Emperor Shen Nung was drinking a hot cup of water.  Suddenly, he noticed that wind had carried some dried leaves into his cup of  water. The aroma as well as the taste of the water, in which the leaves had  fallen, was so pleasing and energizing that he instantly fell in love with it.  Before anybody could realize it, tea had become one of the most popular drinks  of his kingdom.', '', '', ''),
(10, 'mission', 'The Teabar seeks to create and promote great-tasting, truly healthy, organic beverages. We strive to grow our business with the same honesty and integrity we use to craft our products, with sustainability and great taste for all', '', '', ''),
(11, 'vision', 'Whether in person or online, it is our mission at The TeaBar is&nbsp;to create a unique, pleasurable tea experience for each customer. We want to help the virgin tea lover discover the delight of tea making, while helping the well-seasoned aficionado discover new and exciting flavors. We do this by providing quality products along with informative resources. Most importantly we do this by caring about you, our customers. We want to create an atmosphere for our customers to feel warmly welcomed and comfortable.', '', '', ''),
(12, 'email', 'Marshastaps@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbltracker`
--

CREATE TABLE `tbltracker` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL,
  `ddate` datetime NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactiondetails`
--

CREATE TABLE `tbltransactiondetails` (
  `id` int(11) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `itemid` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransactiondetails`
--

INSERT INTO `tbltransactiondetails` (`id`, `tid`, `itemid`, `qty`) VALUES
(25, '11', 118, 1),
(24, '11', 116, 1),
(21, '9', 89, 2),
(22, '10', 88, 1),
(23, '10', 89, 1),
(20, '9', 88, 1),
(26, '11', 117, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactions`
--

CREATE TABLE `tbltransactions` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ddate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`id`, `uid`, `total`, `ddate`, `status`, `fname`, `lname`, `contact`, `address`) VALUES
(11, 4, '175.00', '2021-11-18 16:00:00', 0, 'sample', 'sample', '09123456789', 'sample');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `us` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `us`, `pw`, `stat`, `active`) VALUES
(4, 'sample', 'sample', 'customer', 1),
(3, 'admin', 'admin', 'admin', 1),
(5, 'snkchssyrms13', 'redvelvet', 'customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblworkout`
--

CREATE TABLE `tblworkout` (
  `id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lbs130` int(11) NOT NULL,
  `lbs155` int(11) NOT NULL,
  `lbs180` int(11) NOT NULL,
  `lbs205` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblworkout`
--

INSERT INTO `tblworkout` (`id`, `activity`, `type`, `lbs130`, `lbs155`, `lbs180`, `lbs205`) VALUES
(1, 'Cycling, mountain bike, bmx', 'moderate', 502, 598, 659, 791),
(2, 'Weight lifting, light workout', 'moderate', 117, 211, 245, 279),
(7, 'Basketball game, competitive', 'moderate', 472, 563, 654, 745),
(5, 'Aerobics, general', 'moderate', 384, 457, 531, 605),
(6, 'Running, general', 'moderate', 472, 563, 654, 745),
(8, 'Martial arts, judo, karate, jujitsu', 'moderate', 590, 704, 817, 931),
(9, 'Playing tennis', 'moderate', 413, 493, 572, 651),
(10, 'Boxing, punching bag', 'moderate', 354, 422, 490, 588),
(11, 'Typing, computer data entry', 'normal', 89, 106, 123, 140),
(12, 'Cleaning, dusting', 'normal', 148, 176, 204, 233),
(13, 'General cleaning', 'normal', 207, 246, 286, 326),
(14, 'Gardening, general', 'normal', 236, 281, 327, 372),
(15, 'Bathing dog', 'normal', 207, 246, 286, 326),
(16, 'Walk / run, playing with animals', 'normal', 236, 281, 327, 372),
(17, 'General housework, light', 'normal', 148, 176, 204, 233),
(18, 'Fishing, general', 'light', 177, 211, 245, 279),
(19, 'General cleaning', 'light', 207, 246, 286, 326),
(20, 'Golf, general', 'light', 266, 317, 368, 419),
(21, 'Walking 3.0 mph, moderate', 'light', 195, 232, 270, 307),
(22, 'Tai chi', 'light', 236, 281, 327, 372),
(23, 'Gymnastics', 'light', 236, 281, 327, 372),
(24, 'Ballroom dancing, slow', 'light', 177, 211, 245, 279),
(25, 'Stretching, hatha yoga', 'light', 236, 281, 327, 372),
(26, 'Cycling, <10 mph, leisure bicycling', 'light', 236, 281, 327, 372),
(27, 'Mild stretching', 'normal', 148, 176, 204, 233),
(28, 'Darts (wall or lawn)', 'normal', 148, 176, 204, 233),
(29, 'Bakery, light effort', 'normal', 148, 176, 204, 233),
(30, 'Ballroom dancing, slow', 'normal', 177, 211, 245, 279),
(31, 'Carrying small children', 'normal', 1778, 211, 245, 279),
(32, 'Curling', 'normal', 236, 281, 327, 372),
(33, 'Electrical work, plumbing', 'normal', 207, 246, 286, 326),
(34, 'Farming, feeding small animals', 'normal', 236, 281, 327, 372);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldata`
--
ALTER TABLE `tbldata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfeatured`
--
ALTER TABLE `tblfeatured`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblingredients`
--
ALTER TABLE `tblingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnews`
--
ALTER TABLE `tblnews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreservationdetails`
--
ALTER TABLE `tblreservationdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreservations`
--
ALTER TABLE `tblreservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreviews`
--
ALTER TABLE `tblreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsettings`
--
ALTER TABLE `tblsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltracker`
--
ALTER TABLE `tbltracker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltransactiondetails`
--
ALTER TABLE `tbltransactiondetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `us` (`us`);

--
-- Indexes for table `tblworkout`
--
ALTER TABLE `tblworkout`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcatalog`
--
ALTER TABLE `tblcatalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbldata`
--
ALTER TABLE `tbldata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblfeatured`
--
ALTER TABLE `tblfeatured`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tblingredients`
--
ALTER TABLE `tblingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `tblnews`
--
ALTER TABLE `tblnews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tblreservationdetails`
--
ALTER TABLE `tblreservationdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblreservations`
--
ALTER TABLE `tblreservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblreviews`
--
ALTER TABLE `tblreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsettings`
--
ALTER TABLE `tblsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbltracker`
--
ALTER TABLE `tbltracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbltransactiondetails`
--
ALTER TABLE `tbltransactiondetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblworkout`
--
ALTER TABLE `tblworkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
