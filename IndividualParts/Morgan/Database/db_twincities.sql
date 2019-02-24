-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2018 at 09:49 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_twincities`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_city`
--

CREATE TABLE `tb_city` (
  `woeid_city` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `country` varchar(45) NOT NULL,
  `population` int(11) NOT NULL,
  `currency` varchar(45) NOT NULL,
  `province` varchar(45) DEFAULT NULL,
  `area` float DEFAULT NULL,
  `time_zone` float DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_city`
--

INSERT INTO `tb_city` (`woeid_city`, `name`, `latitude`, `longitude`, `country`, `population`, `currency`, `province`, `area`, `time_zone`, `website`) VALUES
(25211, 'Kingston-Upon Hull', 53.73833038, -0.333332, 'United Kingdom', 319093, 'British Pound Stirling', 'Yorkshire', 71.45, 0, 'http://www.hull.gov.uk/'),
(733075, 'Rotterdam', 51.933312, 4.489051, 'Netherlands', 1007780, 'Euro', 'South Holland', 325.8, 1, 'https://www.rotterdam.nl');

-- --------------------------------------------------------

--
-- Table structure for table `tb_photo`
--

CREATE TABLE `tb_photo` (
  `photo_id` int(11) NOT NULL,
  `link` varchar(128) NOT NULL,
  `woeid_city` int(11) NOT NULL,
  `woeid_poi` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_photo`
--

INSERT INTO `tb_photo` (`photo_id`, `link`, `woeid_city`, `woeid_poi`, `name`) VALUES
(1, 'https://www.thedeep.co.uk/public/skin/social-fallback.jpg', 25211, 56870962, 'The Deep Aquarium'),
(2, 'https://i.pinimg.com/originals/ae/35/8a/ae358ada6fec91ea0de8e69fadad5f68.jpg', 25211, 92158782, 'Dinostar'),
(3, 'https://media-cdn.tripadvisor.com/media/photo-s/0c/8c/b5/e9/welcome-to-burton-constable.jpg', 25211, 14679, 'Burton Constable Hall'),
(4, 'https://i2-prod.hulldailymail.co.uk/incoming/article508236.ece/ALTERNATES/s615/Aerial-picture-of-Hull-city-centre.jpg', 25211, 56816533, 'Hull City Centre'),
(5, 'https://goo.gl/VeeFqV', 25211, 23702074, 'University of Hull'),
(6, 'https://www.yorkshire.com/media/35273/the-deep-13.jpg', 25211, 56870962, 'The Deep Aquarium'),
(7, 'https://upload.wikimedia.org/wikipedia/commons/3/33/The_Deep%2C_Hull%2C_England.jpg', 25211, 56870962, 'The Deep Aquarium'),
(8, 'https://cdn-ssl.funkidslive.com/wp-content/uploads/2009/06/Deep-2-1024x671.jpg', 25211, 56870962, 'The Deep Aquarium'),
(9, 'https://i2-prod.hulldailymail.co.uk/incoming/article995034.ece/ALTERNATES/s615b/made-in-hull-the-deep.jpg', 25211, 56870962, 'The Deep Aquarium'),
(10, 'http://dinostar.co.uk/img/second.jpg', 25211, 92158782, 'Dinostar'),
(11, 'http://dinostar.co.uk/img/first.jpg', 25211, 92158782, 'Dinostar'),
(12, 'https://media-cdn.tripadvisor.com/media/photo-s/0c/7b/4d/d2/img-20160811-wa0001-largejpg.jpg', 25211, 92158782, 'Dinostar'),
(13, 'https://media-cdn.tripadvisor.com/media/photo-s/09/42/9d/79/dinostar-hull-s-dinosaur.jpg', 25211, 92158782, 'Dinostar'),
(14, 'https://www.burtonconstable.com/content/844/Live/image/BC_085w.jpg', 25211, 14679, 'Burton Constable House'),
(15, 'https://www.burtonconstable.com/content/843/Live/image/Barrett%20West%20front%20(2).jpg', 25211, 14679, 'Burton Constable House'),
(16, 'https://wty.azureedge.net/cache/5/8/4/7/4/6/584746c02c334c93c5bfe7ad724d5ff16f11b2cf.jpg', 25211, 14679, 'Burton Constable House'),
(17, 'https://media-cdn.tripadvisor.com/media/photo-s/02/de/d1/82/interior.jpg', 25211, 14679, 'Burton Constable House'),
(18, 'https://goo.gl/BUvRuL', 25211, 56816533, 'Hull City Centre'),
(19, 'https://www.ukconstructionmedia.co.uk/wp-content/uploads/Hull-Queens-Gardens-1024x682.jpg', 25211, 56816533, 'Hull City Centre'),
(20, 'http://cityplanhull.co.uk/wp-content/uploads/2015/11/victoria-square-thin.jpg', 25211, 56816533, 'Hull City Centre'),
(21, 'https://media-cdn.tripadvisor.com/media/photo-s/0a/dc/48/1d/dsc-0128-largejpg.jpg', 25211, 56816533, 'Hull City Centre'),
(22, 'https://www.hull.ac.uk/assets/section/homepage/images/content/campus.x32d640d9.jpg', 25211, 23702074, 'University of Hull'),
(23, 'https://www.visitengland.com/sites/default/files/Hull-University--Derwent-in-Summer-MSP_7985-copy_0.jpg', 25211, 23702074, 'University of Hull'),
(24, 'https://www.findamasters.com/bespokePages/featuredlistings/BPID2923/21571.jpg', 25211, 23702074, 'University of Hull'),
(25, 'https://media.studentcrowd.net/w426-h284-q70-cfill/830671355502661_university-of-hull.jpg', 25211, 23702074, 'University of Hull'),
(26, 'https://upload.wikimedia.org/wikipedia/commons/e/e0/Maritiem_Museum_Rotterdam_1_Fotografie_Marco_de_Swart.jpg', 733075, 56816568, 'Maritime Museum Rotterdam'),
(27, 'https://media-cdn.tripadvisor.com/media/photo-s/01/fc/28/8b/early-am.jpg', 733075, 56816568, 'Maritime Museum Rotterdam'),
(28, 'https://www.maritiemmuseum.nl/media/cache/page_visual/media/exhibitionpage/header/topstukken.jpg', 733075, 56816568, 'Maritime Museum Rotterdam'),
(29, 'https://media-cdn.sygictraveldata.com/media/800x600/612664395a40232133447d33247d383635333433', 733075, 56816568, 'Maritime Museum Rotterdam'),
(30, 'https://www.maritiemmuseum.nl/media/overviewpage/header/maritiem-museum-rotterdam-75-.jpg?2-6-4', 733075, 56816568, 'Maritime Museum Rotterdam'),
(31, 'https://tickets.holland.com/wp-content/uploads/2016/09/kinderdijk_20-2.jpg', 733075, 730730, 'Kinderdijk'),
(32, 'https://assets.kinderdijk.nl/app/assets/cache/3875399203/kinderdijk-home-arrangementen-1920x1080.jpg', 733075, 730730, 'Kinderdijk'),
(33, 'https://media-cdn.tripadvisor.com/media/photo-s/03/62/22/6d/kinderdijk.jpg', 733075, 730730, 'Kinderdijk'),
(34, 'https://assets.kinderdijk.nl/app/assets/cache/1679429041/kinderdijk-algemene-voorwaarden-1920x1080.jpg', 733075, 730730, 'Kinderdijk'),
(35, 'http://www.alblasserdamsnieuws.nl/wordpress/wp-content/uploads/2018/05/IMG_9502-Medium.jpg', 733075, 730730, 'Kinderdijk'),
(36, 'https://www.diergaardeblijdorp.nl/wp-content/uploads/2015/05/savannezonnig-930x699.jpg', 733075, 22384441, 'Diergaarde Blijdorp: The Royal Zoo'),
(37, 'https://www.tws-groep.nl/wp-content/uploads/blijdorp.jpg', 733075, 22384441, 'Diergaarde Blijdorp: The Royal Zoo'),
(38, 'http://medias.photodeck.com/590eeb2f-7150-4650-b688-a67d5475c32e/301301_xgaplus.jpg', 733075, 22384441, 'Diergaarde Blijdorp: The Royal Zoo'),
(39, 'https://media-cdn.tripadvisor.com/media/photo-s/12/78/e1/37/oceanium-diergaarde-blijdorp.jpg', 733075, 22384441, 'Diergaarde Blijdorp: The Royal Zoo'),
(40, 'https://pubblestorage.blob.core.windows.net/d9c7ad83/content/2018/7/3064af81-27a1-42e5-bd82-f564e51ab83a.jpg', 733075, 22384441, 'Diergaarde Blijdorp: The Royal Zoo'),
(41, 'https://tickets.holland.com/wp-content/uploads/2016/09/euromast-12-e1500563789151.jpg', 733075, 729194, 'Euromast'),
(42, 'https://tickets.holland.com/wp-content/uploads/2016/09/euromast-12-e1500563789151.jpg', 733075, 729194, 'Euromast'),
(43, 'https://tickets.holland.com/wp-content/uploads/2016/09/euromast-12-e1500563789151.jpg', 733075, 729194, 'Euromast'),
(44, 'https://tickets.holland.com/wp-content/uploads/2016/09/euromast-12-e1500563789151.jpg', 733075, 729194, 'Euromast'),
(45, 'https://tickets.holland.com/wp-content/uploads/2016/09/euromast-12-e1500563789151.jpg', 733075, 729194, 'Euromast'),
(46, 'https://www.holland.com/upload_mm/a/6/9/57490_fullimage_32ec68fe4dd0a9691367a3023b3bd92bf3106fb567e91a7ea2b8ccf56e2c0ac7.jpg', 733075, 91412178, 'Erasmus Bridge'),
(47, 'https://i.ytimg.com/vi/_IzD8ktVq18/maxresdefault.jpg', 733075, 91412178, 'Erasmus Bridge'),
(48, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/RotterdamMaasNederland.jpg/770px-RotterdamMaasNederland.jpg', 733075, 91412178, 'Erasmus Bridge'),
(49, 'https://www.mimoa.eu/images/45665_l.jpg', 733075, 91412178, 'Erasmus Bridge'),
(50, 'https://goo.gl/iURCWy', 733075, 91412178, 'Erasmus Bridge');

-- --------------------------------------------------------

--
-- Table structure for table `tb_poi`
--

CREATE TABLE `tb_poi` (
  `woeid_poi` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `launch` date DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  `opening_time` varchar(128) DEFAULT NULL,
  `closing_time` varchar(128) DEFAULT NULL,
  `woeid_city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_poi`
--

INSERT INTO `tb_poi` (`woeid_poi`, `latitude`, `longitude`, `name`, `capacity`, `cost`, `launch`, `website`, `opening_time`, `closing_time`, `woeid_city`) VALUES
(14679, 53.813987, -0.195885, 'Burton Constable Hall', NULL, 11, '1560-01-01', 'https://www.burtonconstable.com/', '11.00', '17.00', 25211),
(729194, 51.90545, 4.466606, 'Euromast', 1200, 8.76, '1960-01-01', 'https://euromast.nl', '10.00', '22.00', 733075),
(730730, 51.884508, 4.632675, 'Kinderdijk', NULL, NULL, NULL, 'https://www.kinderdijk.com', NULL, NULL, 733075),
(22384441, 51.928132, 4.444112, 'Diergaarde Blijdorp - Royal Zoo', NULL, 21.5, '1857-01-01', 'https://www.diergaardeblijdorp.nl/', '9.00', '17.00', 733075),
(23702074, 53.773905, -0.367975, 'University of Hull', 18500, NULL, '1954-01-01', 'http://www.hull.ac.uk/', NULL, NULL, 25211),
(56816533, 53.744428, -0.337735, 'Hull City Centre', NULL, NULL, NULL, NULL, NULL, NULL, 25211),
(56816568, 51.917605, 4.48227, 'Maritime Museum Rotterdam - Oude Haven', NULL, 14, '1874-01-01', 'https://www.maritiemmuseum.nl', 'Tues to Sat: 10.00', 'Tues to Sat: 17.00', 733075),
(56870962, 53.739194, -0.330217, 'The Deep, Aquarium', NULL, 12.15, '2002-03-23', 'https://thedeep.co.uk', '10.00', '18.00', 25211),
(91412178, 51.90903, 4.487123, 'Erasmus Bridge', NULL, NULL, '1996-01-01', NULL, NULL, NULL, 733075),
(92158782, 53.739617, -0.333703, 'Dinostar', NULL, 3, '2005-01-01', 'http://dinostar.co.uk/', 'Sat and Sun: 11.00', 'Sat and Sun: 17.00', 25211);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_city`
--
ALTER TABLE `tb_city`
  ADD PRIMARY KEY (`woeid_city`),
  ADD UNIQUE KEY `tb_city_woeid_city_uindex` (`woeid_city`);

--
-- Indexes for table `tb_photo`
--
ALTER TABLE `tb_photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD UNIQUE KEY `tb_photo_photo_id_uindex` (`photo_id`),
  ADD KEY `tb_photo_woeid_city_uindex` (`woeid_city`) USING BTREE,
  ADD KEY `tb_photo_woeid_poi_uindex` (`woeid_poi`) USING BTREE;

--
-- Indexes for table `tb_poi`
--
ALTER TABLE `tb_poi`
  ADD PRIMARY KEY (`woeid_poi`),
  ADD KEY `tb_poi_woeid_poi_uindex` (`woeid_poi`) USING BTREE,
  ADD KEY `tb_poi_woeid_city_uindex` (`woeid_city`) USING BTREE;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_city`
--
ALTER TABLE `tb_city`
  ADD CONSTRAINT `tb_city_tb_photo_woeid_city_fk` FOREIGN KEY (`woeid_city`) REFERENCES `tb_photo` (`woeid_city`),
  ADD CONSTRAINT `tb_city_tb_poi_woeid_city_fk` FOREIGN KEY (`woeid_city`) REFERENCES `tb_poi` (`woeid_city`);

--
-- Constraints for table `tb_poi`
--
ALTER TABLE `tb_poi`
  ADD CONSTRAINT `tb_poi_tb_photo_woeid_poi_fk` FOREIGN KEY (`woeid_poi`) REFERENCES `tb_photo` (`woeid_poi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
