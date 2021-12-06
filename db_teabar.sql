-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2014 at 09:39 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_teabar`
--
CREATE DATABASE IF NOT EXISTS `db_teabar` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_teabar`;

-- --------------------------------------------------------

--
-- Table structure for table `tblcatalog`
--

CREATE TABLE IF NOT EXISTS `tblcatalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tblcatalog`
--

INSERT INTO `tblcatalog` (`id`, `cat`, `fname`, `descr`, `pic`, `qty`, `price`) VALUES
(18, '1', 'Flavor Milk1', 'Nom Nom Milk, Papaya Milk (Seasonal), Banana Milk, Strawberry Milk, Kiwi Milk, Banana Strawberry Milk, Red Bean Milk (cold/hot), Taro Milk (cold/hot), Honey Milk (cold/hot), Almond Milk (cold/hot), Chocolate Milk (cold/hot), Coconut Milk (seasonal)', 'factorymilkteawithboba.jpg', 5, '99.99'),
(19, '1', 'Tea (cold/hot)', 'Green Tea, Black Tea, Oolong Tea', 'kumquatgreenteawithaloe.jpg', 1, '99.99'),
(20, '1', 'Milk Tea (cold/hot)', 'Factory Milk Tea, Nom Nom Green tea, Green Milk Tea, Black Milk Tea, Oolong Milk Tea, Thai Milk Tea, Rose Milk Green Tea, Peppermint Milk Green Tea, Taro Milk Green/Black tea, Strawberry Milk Green/Black Tea, Almond Milk Green/Black Tea, Honey Milk Green/', 'thaiteamilk.jpg', 4, '99.99'),
(21, '1', 'Smoothie', 'Chocolate Milk Smoothie, Chocolate Banana Milk Smoothie, Mango Milk Smoothie, Matcha Milk Smoothie, Lychee Milk Smoothie, Kiwi Milk Smoothie, Red Bean Milk Smoothie, Green Apple Milk Smoothie, Taro Milk Smoothie, Strawberry Milk Smoothie, Banana Strawberr', 'caramelmilksmoothie.jpg', -4, '149.99'),
(22, '1', 'Blended Yogurt', 'Kumquat Yogurt, Orange Yogurt, Mango Yogurt, Peach Yogurt, Passion Fruit Yogurt, Lychee Yogurt', 'mangoyogurt.jpg', 7, '49.99'),
(23, '1', 'Juice', 'Honey Lemon Juice (cold/hot), Blueberry Juice, Kiwi Juice, Watermelon Juice (Seasonal)', 'blueberryjuicewithmixedfruitjelly.jpg', 90, '39.99'),
(24, '2', 'Fried Chicken Wings', 'Fried Chicken Wings', 'MG_0324.jpg', 0, '349.99'),
(25, '2', 'Fried Gyoza', 'Fried Gyoza', 'Factory-Tea-Bar-066.jpg', 0, '349.99'),
(26, '2', 'Crispy Chicken Cesar Salad', 'Crispy Chicken Cesar Salad', 'Factory-Tea-Bar-100.jpg', 0, '349.99'),
(27, '2', 'Fish Balls', 'Fish Balls', 'Factory-Tea-Bar-091.jpg', 0, '49.99'),
(28, '2', 'Sweet Potato Fries', 'Sweet Potato Fries', 'Factory-Tea-Bar-061.jpg', 0, '349.99'),
(29, '2', 'Popcorn Chicken', 'Popcorn Chicken', 'Factory-Tea-Bar-034.jpg', 0, '349.99'),
(30, '2', 'Banana Spring Rolls', 'Banana Spring Rolls', 'Factory-Tea-Bar-023.jpg', 0, '349.99'),
(31, '2', 'Cheese Fries (Cheese Powder)', 'Cheese Fries (Cheese Powder)', 'MG_0408.jpg', 0, '349.99'),
(32, '3', 'Condensed Milk with Milo Toast', 'Condensed Milk with Milo Toast', 'Factory-Tea-Bar-070.jpg', 2, '349.99');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE IF NOT EXISTS `tblcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `descr`) VALUES
(1, 'Drinks'),
(2, 'Snacks'),
(3, 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE IF NOT EXISTS `tblcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`id`, `fname`, `email`, `descr`, `ddate`) VALUES
(11, 'Bill', 'Bill@gmail.com', 'Service is awesome!', '05-08-2014');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE IF NOT EXISTS `tblcustomers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `us` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`id`, `fname`, `addr`, `mobile`, `email`, `us`) VALUES
(2, 'gigi pogi', '83 iba st qc', '78945613', 'lorddefiant18@gmail.com', 'gigipogi'),
(3, 'yeha eah eah', '412313111', '131231321', 'pogipol@gmail.com', 'qqq'),
(4, 'richard lacasandile', '83 iba st qc', '7456132131', 'pogipol@gmail.com', 'akosigigi'),
(8, 'moj', 'makati', '091', 'iuijkj@yahoo.com', 'rrtrtr'),
(9, 'Sample', '83 iba st qc', '7493345', 'pogipol@gmail.com', 'pieliedie'),
(10, 'qwe', 'qwe', '12313214', 'maddox1362@gmail.com', 'moj'),
(11, 'Bill Gates', '#555 California USA', '09151797707', 'gates@gmail.com', 'Bill');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE IF NOT EXISTS `tblfeedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`id`, `uid`, `content`, `ddate`, `stat`) VALUES
(30, 'tttt', 'dffgf', '03-21-2014', 'member'),
(33, 'tttt', 'fgfdg', '03-21-2014', 'admin'),
(34, 'tttt', 'gwapo mo ahahahahahahhaha', '03-21-2014', 'admin'),
(35, 'tttt', 'hi admin', '03-21-2014', 'member'),
(36, 'tttt', 'hahahahaahhahaha jk', '03-21-2014', 'admin'),
(37, 'gigipogi', 'hi amdin', '03-22-2014', 'member'),
(38, 'gigipogi', 'lul', '03-22-2014', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

CREATE TABLE IF NOT EXISTS `tblnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tblnews`
--

INSERT INTO `tblnews` (`id`, `topic`, `content`, `ddate`) VALUES
(5, 'Admin Notes Sample', 'Just testing Admin Notes', '05-03-2014'),
(6, 'Admin Notes Sample 2', 'Hi wahehehehe', '05-03-2014'),
(7, 'Admin 2', 'Admin 2 Testing ', '05-03-2014'),
(8, 'Please check stocks', 'sdfdfmgnkjdfgnlksdf', '05-03-2014'),
(9, 'uyyu', 'yutyuytu', '05-03-2014'),
(11, 'zxczx', 'dadsa', '05-05-2014'),
(12, 'vbnbvn', 'vbnvbn', '05-05-2014'),
(13, 'fafa', 'fafafa', '05-08-2014');

-- --------------------------------------------------------

--
-- Table structure for table `tblreservationdetails`
--

CREATE TABLE IF NOT EXISTS `tblreservationdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(255) NOT NULL,
  `itemid` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `fl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblreservationdetails`
--

INSERT INTO `tblreservationdetails` (`id`, `tid`, `itemid`, `qty`, `fl`) VALUES
(2, 'P0AX47WDC64BG6VO0X', 'Flavor Milk', 1, '4'),
(3, 'P0AX47WDC64BG6VO0X', 'Tea (cold/h', 1, '4'),
(4, 'FY5LO3GYXL162DF1EY', 'Juice', 1, '4'),
(5, '9TAVBFDKBQCFY2NKI9', 'Blended Yog', 1, '4'),
(6, '9TAVBFDKBQCFY2NKI9', 'Flavor Milk', 1, '4'),
(7, 'BXI3R757H2AGBIILMZ', 'Flavor Milk', 1, '23'),
(8, 'YR7G6RGD9R6QUHQ0Z5', 'Flavor Milk', 1, '23'),
(9, '0SA2013ZBQ8HVHFV4C', 'Tea (cold/h', 1, '22'),
(10, '0SA2013ZBQ8HVHFV4C', 'Milk Tea (c', 1, '22');

-- --------------------------------------------------------

--
-- Table structure for table `tblreservations`
--

CREATE TABLE IF NOT EXISTS `tblreservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(255) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `hh` varchar(255) NOT NULL,
  `fl` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tblreservations`
--

INSERT INTO `tblreservations` (`id`, `tid`, `ddate`, `hh`, `fl`) VALUES
(2, 'P0AX47WDC64BG6VO0X', '05-31-2014', '6:00 PM', 4),
(3, 'FY5LO3GYXL162DF1EY', '05-03-2014', '10:00 PM', 4),
(4, '9TAVBFDKBQCFY2NKI9', '05-03-2014', '10:00 PM', 4),
(5, 'BXI3R757H2AGBIILMZ', '05-08-2014', '1:00 AM', 23),
(6, 'YR7G6RGD9R6QUHQ0Z5', '05-08-2014', '1:00 AM', 23),
(7, '0SA2013ZBQ8HVHFV4C', '05-11-2014', '1:00 AM', 22);

-- --------------------------------------------------------

--
-- Table structure for table `tblsettings`
--

CREATE TABLE IF NOT EXISTS `tblsettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var` varchar(255) NOT NULL,
  `value` varchar(18000) NOT NULL,
  `opt1` varchar(255) NOT NULL,
  `opt2` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tblsettings`
--

INSERT INTO `tblsettings` (`id`, `var`, `value`, `opt1`, `opt2`, `pic`) VALUES
(1, 'companyname', 'Teabar Company', '', '', ''),
(2, 'banner', '', '', '', 'REPORTLOGO.png'),
(3, 'aboutus', 'The Tea Bar is basically a coffee shop but instead of coffee we serve tea but is also different to the traditional tea houses as it aimed at the wellness of our customers thus we provide information and help to our customers on how to use tea to stay healthy or combat stress, sicknesses and ill-feelings. Our managers are chemists trained in the art of tea making ready to help anytime', '', '', ''),
(4, 'contactus', '<h2>contach usssssssssssssssss asdasdasdsaasdsadsa</h2><h2>jjjjjsdfsdfsd</h2>', '', '', ''),
(5, 'terms', 'Payment<br><br>All payments are due upon receipt. If a payment is not received or payment method is declined, the buyer forfeits the ownership of any items purchased. If no payment is received, no items will be shipped.<br><br>Shipping Policies<br><br>Shipping will be paid for by the buyer in the amount agreed upon by the seller at the time of purchase. If an item is lost during shipping, the total cost of item, including shipping, will be refunded to the buyer by the seller. Shipping costs may double if shipping internationally. If an item is damaged during shipping, seller will not be held responsible.<br><br>Refund/Return Policy<br><br>Items are entitled to be refunded or returned based on complaint. If an item is damaged during shipping, a replacement item will be sent free of charge. If an item is unsatisfactory, a written explanation is needed before the item may be considered for a refund. Buyer must take into account the description of the item before requesting a refund. If the item matches the description by the seller and the buyer is unsatisfied, seller is not responsible for refund. Exchanges are granted on a case-by-case basis.<br><br>Cancellation<br><br>An item may be cancelled up until payment has been processed. Once payment has been processed, the buyer is responsible for payment.<br><br>Complaints<br><br>Any complaints about items or sellers may be sent to our support team: support@teabar.com. There is no guarantee of a resolution. Each case will be looked at individually, and the seller will be in contact as well.', '', '', ''),
(6, 'theme', 'success', '', '', ''),
(7, 'companyaddr', 'SCOUT MAGBANUA Corner Panay Avenue. Quezon city', '', '', ''),
(8, 'companyphone', '254565', '', '', ''),
(9, 'whatsup', 'The origin of tea bar can be traced back to the year 2737  BC. During that time, people usually consumed boiled water, owing to health  reasons. One day, Chinese Emperor Shen Nung was drinking a hot cup of water.  Suddenly, he noticed that wind had carried some dried leaves into his cup of  water. The aroma as well as the taste of the water, in which the leaves had  fallen, was so pleasing and energizing that he instantly fell in love with it.  Before anybody could realize it, tea had become one of the most popular drinks  of his kingdom.', '', '', ''),
(10, 'mission', 'The Teabar seeks to create and promote great-tasting, truly healthy, organic beverages. We strive to grow our business with the same honesty and integrity we use to craft our products, with sustainability and great taste for all', '', '', ''),
(11, 'vision', 'Whether in person or online, it is our mission at The TeaBar is&nbsp;to create a unique, pleasurable tea experience for each customer. We want to help the virgin tea lover discover the delight of tea making, while helping the well-seasoned aficionado discover new and exciting flavors. We do this by providing quality products along with informative resources. Most importantly we do this by caring about you, our customers. We want to create an atmosphere for our customers to feel warmly welcomed and comfortable.', '', '', ''),
(12, 'email', 'theteabarcompany@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactiondetails`
--

CREATE TABLE IF NOT EXISTS `tbltransactiondetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(255) NOT NULL,
  `itemid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `fl` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `tbltransactiondetails`
--

INSERT INTO `tbltransactiondetails` (`id`, `tid`, `itemid`, `qty`, `fl`) VALUES
(81, '8UX56130XG173805H', 19, 1, 0),
(82, '6HD871626M617130U', 20, 1, 0),
(83, '6HD871626M617130U', 19, 1, 0),
(84, '1DB85300DG4932522', 18, 3, 0),
(85, '89X711323R686043X', 22, 1, 0),
(86, '89X711323R686043X', 19, 1, 0),
(87, '89X711323R686043X', 23, 7, 0),
(88, '55Y21474YF0497143', 21, 3, 0),
(89, '55Y21474YF0497143', 21, 3, 0),
(90, '55Y21474YF0497143', 21, 3, 0),
(91, '1AS25687PK475330T', 22, 1, 0),
(92, '5T512037RW116851S', 18, 1, 0),
(93, '2W509183271356018', 23, 1, 0),
(94, '6JV9506246769523E', 19, 1, 0),
(95, '6JV9506246769523E', 22, 1, 0),
(96, '6JV9506246769523E', 23, 1, 0),
(97, '912257522T344715R', 32, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactions`
--

CREATE TABLE IF NOT EXISTS `tbltransactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ddate` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `transacid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`id`, `uid`, `ddate`, `stat`, `transacid`) VALUES
(49, 4, '04-24-2014', 'OK', '8UX56130XG173805H'),
(50, 4, '05-01-2014', 'OK', '6HD871626M617130U'),
(51, 4, '05-01-2014', 'OK', '1DB85300DG4932522'),
(52, 4, '05-01-2014', 'OK', '89X711323R686043X'),
(53, 4, '05-03-2014', 'OK', '55Y21474YF0497143'),
(54, 4, '05-03-2014', 'OK', '55Y21474YF0497143'),
(55, 4, '05-03-2014', 'OK', '55Y21474YF0497143'),
(56, 4, '05-03-2014', 'OK', '1AS25687PK475330T'),
(57, 22, '05-03-2014', 'OK', '5T512037RW116851S'),
(58, 22, '05-03-2014', 'OK', '2W509183271356018'),
(59, 22, '05-03-2014', 'OK', '6JV9506246769523E'),
(60, 22, '05-03-2014', 'OK', '912257522T344715R');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `us` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `us` (`us`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `us`, `pw`, `stat`) VALUES
(1, 'admin', 'admin', 'admin'),
(4, 'gigipogi', 'potaka', 'customer'),
(5, 'qqq', 'zzz', 'customer'),
(6, 'akosigigi', 'akosigigi', 'customer'),
(7, 'tttt', 'tttt', 'customer'),
(8, 'qwe', 'qwe', 'customer'),
(9, 'zzz', 'zzz', 'customer'),
(19, 'xxxx', 'xxxx', 'admin'),
(20, 'pieliedie', 'potaka', 'customer'),
(22, 'moj', '1234', 'customer'),
(23, 'Bill', 'windows', 'customer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
