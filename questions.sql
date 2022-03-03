-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 172.24.0.1
-- Generation Time: Sep 08, 2021 at 02:36 PM
-- Server version: 5.7.22-log
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `support`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL,
  `options` text NOT NULL,
  `number` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `parent_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `options`, `number`, `level`, `parent_id`, `parent_answer`) VALUES
(3, 'Djurslag', '{\"Hund\",\"Katt\"}', 1, 1, NULL, ''),
(4, 'Ålder', '{\"Valp (0-6mån)\",\"6 mån-2 år\"}', 2, 1, NULL, ''),
(5, 'Kön', '{\"Hane\",\"Hane kastrerad\"}', 3, 1, NULL, ''),
(6, 'Vikt', '{\"0,5-2 kg\",\"4-10 kg\"}', 4, 1, NULL, ''),
(7, 'Problemområde', '{\"Mage och tarm\",\"Rörelseapparat\"}', 5, 1, NULL, ''),
(8, 'Tid', '{\"Nyss\",\"0-2 h sedan\"}', 6, 1, NULL, ''),
(9, 'Ras Hund', '{\"3\",\"4\"}', 1, 2, 3, 'Hund'),
(10, 'Ras Katt', '{\"1\",\"2\"}', 1, 2, 3, 'Katt'),
(11, 'Allmäntillstånd', '{\"Gott\",\r\n\"Dämpad/orolig\",\r\n\"Ligger mest/mycket orolig\",\r\n\"Piper/gnäller/skriker\"}', 1, 2, 7, 'Rörelseapparat'),
(12, 'Aptit', '{\"Ja\",\r\n\"Nej\"}', 2, 2, 7, 'Rörelseapparat'),
(13, 'Tydlig hälta', '{\"Nej\",\r\n\"Ja\"}', 3, 2, 7, 'Rörelseapparat'),
(14, 'Vilket benpar', '{\"Fram\",\r\n\"Bak\"}', 1, 3, 13, 'Ja'),
(15, 'Bajsar/kissar', '{\"Ja-utan problem\",\n\"Ja-med viss svårighet\",\n\"Nej-vill/kan inte gå ut för rastning\"}', 4, 2, 7, 'Rörelseapparat'),
(16, 'Svullnad', '{\"Nej\",\r\n\"Ja\"}', 5, 2, 7, 'Rörelseapparat'),
(17, 'Feber', '{\"Nej\",\r\n\"Ja\"}', 6, 2, 7, 'Rörelseapparat'),
(18, 'Allmäntillstånd ', '{\"Pigg\",\r\n\"Lite trött\",\r\n\"Mycket trött\"}', 1, 2, 7, 'Förlossning, dräktighet, löp'),
(19, 'Känt parning/insemineringsdatum', '{\"Nej\",\r\n\"Ja\"}', 2, 2, 7, 'Förlossning, dräktighet, löp'),
(20, 'Dygn i dräktigheten', '{\"<60\",\r\n\"65 +/- 5 dygn\",\r\n\">70 \"}', 1, 3, 19, 'Ja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
