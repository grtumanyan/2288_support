-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Sep 27, 2021 at 08:27 AM
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
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `data`, `date`) VALUES
(1, '{\"Djurslag\":\"Hund\",\"Ras_Hund\":\"Hund\",\"u00c5lder\":\"Valp/kattunge (0-6mu00e5n)\",\"Ku00f6n\":\"Hane\",\"Vikt\":\"0,5-2 kg\",\"Problemomru00e5de\":\"Mage och tarm\",\"Allmu00e4ntillstu00e5nd\":\"u00c4r som vanligt\",\"Har_djuret_u00e4tit_annat_u00e4n_sitt_foder_(sak/mu00e4nniskomat/grillspett_eller_liknande)\":\"Nej\",\"Symptombild\":\"Kru00e4kning\",\"Frekvens_(per_24h)\":\"1-5 ggr\",\"Dricker\":\"Nej\",\"Vu00e4tskestatus\":\"Fu00e5r behu00e5lla vu00e4tska\",\"Aptit\":\"Har god aptit\",\"Foderintag\":\"Fu00e5r behu00e5lla foder\",\"Tid\":\"Nyss\"}', '2021-09-27 07:59:31'),
(2, '{\"Djurslag\":\"Hund\",\"Ras_Hund\":\"Hund\",\"u00c5lder\":\"Valp/kattunge (0-6mu00e5n)\",\"Ku00f6n\":\"Hane\",\"Vikt\":\"0,5-2 kg\",\"Problemomru00e5de\":\"Mage och tarm\",\"Allmu00e4ntillstu00e5nd\":\"u00c4r som vanligt\",\"Har_djuret_u00e4tit_annat_u00e4n_sitt_foder_(sak/mu00e4nniskomat/grillspett_eller_liknande)\":\"Nej\",\"Symptombild\":\"Kru00e4kning\",\"Frekvens_(per_24h)\":\"1-5 ggr\",\"Dricker\":\"Nej\",\"Vu00e4tskestatus\":\"Fu00e5r behu00e5lla vu00e4tska\",\"Aptit\":\"Har god aptit\",\"Foderintag\":\"Fu00e5r behu00e5lla foder\",\"Tid\":\"Nyss\"}', '2021-09-27 07:59:31');

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
(3, 'Djurslag', '[\"Hund\",\"Katt\"]', 1, 1, NULL, ''),
(4, 'Ålder', '{\"Valp/kattunge (0-6mån)\",\n\"6 mån-2 år\",\n\"2-6 år\",\n\"över 6 år\"}', 2, 1, NULL, ''),
(5, 'Kön', '{\"Hane\",\n\"Hane kastrerad\",\n\"Tik\",\n\"Tik steriliserad\"}', 3, 1, NULL, ''),
(6, 'Vikt', '{\"0,5-2 kg\",\n\"2-4 kg\",\n\"4-10 kg\",\n\"10-20 kg\",\n\"20-40 kg\", \n\"över 40 kg\"}', 4, 1, NULL, ''),
(7, 'Problemområde', '[\"Mage och tarm\",\n\"Hud\",\n\"Ögon\",\n\"Luftvägar\",\n\"Sårskador\",\n\"Förgiftning\",\n\"Bett\",\n\"Munhåla\",\n\"Urinvägar\",\n\"Reproduktionsorgan\",\n\"Förlossning\",\n\"Dräktighet\",\n\"Löp\",\n\"Skendräktighet\",\n\"Rörelseapparat\"]', 5, 1, NULL, ''),
(8, 'Tid', '[\"Nyss\",\n\"0-2 h sedan\",\n\"Idag\",\n\"ett dygn\",\n\"1-3 dygn\",\n\"1 vecka\",\n\"Längre tid\",\n\"Återkommande/periodvis\"]', 6, 1, NULL, ''),
(9, 'Ras Hund', '{\"Hund\",\"HundTrubbNos\"}', 1, 2, 3, 'Hund'),
(10, 'Ras Katt', '{\"Katt\",\"KattTrubbNos\"}', 1, 2, 3, 'Katt'),
(11, 'Allmäntillstånd', '{\"Gott\",\n\"Dämpad/orolig\",\n\"Ligger mest/mycket orolig\",\n\"Piper/gnäller/skriker\"}', 1, 2, 7, 'Rörelseapparat'),
(12, 'Aptit', '{\"Ja\",\r\n\"Nej\"}', 2, 2, 7, 'Rörelseapparat'),
(13, 'Tydlig hälta', '{\"Nej\",\r\n\"Ja\"}', 3, 2, 7, 'Rörelseapparat'),
(14, 'Vilket benpar', '{\"Fram\",\r\n\"Bak\"}', 1, 3, 13, 'Ja'),
(15, 'Bajsar/kissar', '{\"Ja-utan problem\",\n\"Ja-med viss svårighet\",\n\"Nej-vill/kan inte gå ut för rastning\"}', 4, 2, 7, 'Rörelseapparat'),
(16, 'Svullnad', '{\"Nej\",\r\n\"Ja\"}', 5, 2, 7, 'Rörelseapparat'),
(17, 'Feber', '{\"Nej\",\r\n\"Ja\"}', 6, 2, 7, 'Rörelseapparat'),
(18, 'Allmäntillstånd ', '{\"Pigg\",\r\n\"Lite trött\",\r\n\"Mycket trött\"}', 1, 2, 7, 'Förlossning, dräktighet, löp'),
(19, 'Känt parning/insemineringsdatum', '{\"Nej\",\r\n\"Ja\"}', 2, 2, 7, 'Förlossning, dräktighet, löp'),
(20, 'Dygn i dräktigheten', '{\"<60\",\r\n\"65 +/- 5 dygn\",\r\n\">70 \"}', 1, 3, 19, 'Ja'),
(21, 'Senaste löp', '[\"Precis avslutat\",\r\n\"1v-1 mån sedan\",\r\n\"1-2 mån sedan\"]', 1, 2, 7, 'Skendräktighet'),
(22, 'Mjölk i juver/svullna juver', '[\"Nej\",\r\n\"Ja-lite\",\r\n\"Ja-mycket/besvärande\"]', 2, 2, 7, 'Skendräktighet'),
(23, 'Allmäntillstånd', '[\"Pigg/som vanligt\",\r\n\"Lite trött/mindre villig till promenad\",\r\n\"Mycket trött/vill inte alls promenera\"]', 3, 2, 7, 'Skendräktighet'),
(24, 'Boar', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Skendräktighet'),
(25, 'Adopterar (andra djur, gosedjur eller liknande)', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Skendräktighet'),
(26, 'Haft sitt första löp', '[\"Nej\",\r\n\"Ja\"]', 1, 2, 7, 'Löp'),
(27, 'Löper vanligen', '[\"1 gång/år\",\r\n\"2 ggr/år\",\r\n\"3 ggr/år\"]', 2, 2, 7, 'Löp'),
(28, 'Antal dagar i löp-KOlla intervall med repro', '[\"0-7\",\r\n\"7-10\",\r\n\"10-15\",\r\n\"15-23\",\r\n\">23 dagar\"]', 3, 2, 7, 'Löp'),
(29, 'Visar intresse för hanar/omvänt', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Löp'),
(30, 'Flytning', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Löp'),
(31, 'Färg', '[\"Klar\",\r\n\"Blodig\",\r\n\"Brunröd\",\r\n\"Gul\"]', 1, 3, 30, 'Ja'),
(32, 'Allmäntillstånd ', '[\"Pigg\",\n\"Lite trött\",\n\"Mycket trött\"]', 1, 2, 7, 'Dräktighet'),
(33, 'Känt parning/insemineringsdatum', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Dräktighet'),
(34, 'Första kull', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Dräktighet'),
(35, 'Feber', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Dräktighet'),
(36, 'Flytning', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Dräktighet'),
(37, 'Dygn i dräktigheten', '[\"<60\",\n\"64 +/- 5 dygn\",\n\">70\"]', 1, 3, 33, 'Ja'),
(38, 'Färg', '[\"Klar\",\r\n\"Brunröd\",\r\n\"Gul\",\r\n\"Grön\"]', 1, 3, 36, 'Ja'),
(39, 'Allmäntillstånd', '[\"Pigg\",\r\n\"Lite trött\",\r\n\"Mycket trött\"]', 1, 2, 7, 'Förlossning'),
(40, 'Känt parning/insemineringsdatum', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Förlossning'),
(41, 'Dygn i dräktigheten', '[\"<60\",\r\n\"65 +/- 5 dygn\",\r\n\">70\"] ', 1, 3, 40, 'Ja'),
(42, 'Första kull', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Förlossning'),
(43, 'Historik av dystoki', '[\"Nej\",\r\n\"Ja-behandlad medicinskt\",\r\n\"Ja-snittad\"] ', 1, 3, 42, 'Nej'),
(44, 'Har det gjorts bilddiagnostik', '[\"Nej\",\r\n\"Ja-röntgen\",\r\n\"Ja-ultraljud\"]', 4, 2, 7, 'Förlossning'),
(45, 'Tempad', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Förlossning'),
(46, 'Tempsänkning', '[\"Nej\",\r\n\"Ja\"]', 1, 3, 45, 'Ja'),
(47, 'Vattenavgång', '[\"Nej\",\r\n\"Ja\"]', 6, 2, 7, 'Förlossning'),
(48, 'Tid sedan vattenavgång', '[\"Nyss\"\r\n\"30 min-1,5h sedan\",\r\n\"2-3h sedan\"] ', 1, 3, 47, 'Ja'),
(49, 'Värkar', '[\"Nej\",\r\n\"Ja\"]', 7, 2, 7, 'Förlossning'),
(50, 'Intensitet', '[\"Inte så kraftiga\",\r\n\"Mycket kraftiga\"] ', 1, 3, 49, 'Ja'),
(51, 'Hur länge', '[\"Börjat nyss\",\r\n\"Mer än 30 min\",\r\n\"1-4 h\"] ', 2, 3, 49, 'Ja'),
(52, 'Var bor ni i förhållande till lämplig klinik', '[\"Mindre än 10 min till öppen klinik\",\r\n\"30min-1h till klinik\",\r\n\"1-2h till klinik\",\r\n\">2h till klinik \"]', 8, 2, 7, 'Förlossning'),
(53, 'Har det kommit några ungar', '[\"Nej\",\r\n\"Ja\"]', 9, 2, 7, 'Förlossning'),
(54, 'Levande', '[\"Nej\",\r\n\"Ja\",\r\n\"Några levande och några döda/mycket svaga\"] ', 1, 3, 53, 'Ja'),
(55, 'När kom senaste ungen', '[\"Nyss\",\r\n\"1-2h sedan\",\r\n\">2h sedan\"] ', 2, 3, 53, 'Ja'),
(56, 'Syns fosterblåsa/foster', '[\"Nej\",\r\n\"Ja\"]', 10, 2, 7, 'Förlossning'),
(57, 'Flytning', '[\"Nej\",\r\n\"Ja\"]', 11, 2, 7, 'Förlossning'),
(58, 'Färg', '[\"Klar\",\r\n\"Brunröd\",\r\n\"Grön\"] ', 1, 3, 57, 'Ja'),
(59, 'Tid förlupen sedan start på förlossning', '[\"0-6h\",\r\n\"6-12h\",\r\n\"12-18h\",\r\n\"24h eller mer\"]', 12, 2, 7, 'Förlossning'),
(60, 'Allmäntillstånd', '[\"Är som vanligt\",\r\n\"Lite orolig\",\r\n\"Tröttare än vanligt\",\r\n\"Mycket allmänpåverkad\"]', 1, 2, 7, 'Urinvägar'),
(61, 'Kissar djuret', '[\"Vet ej\",\r\n\"Ja\",\r\n\"Ja men mindre mängd\",\r\n\"Ja men mindre mängd och oftare\",\r\n\"Ja men dålig stråle\",\r\n\"Nej\",\r\n\"Mer än normalt\"]', 2, 2, 7, 'Urinvägar'),
(62, 'Är djuret besvärat i samband med urinering', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Urinvägar'),
(63, 'Feber', '[\"Nej\",\r\n\"Ja\",\r\n\"Vet ej\"]', 4, 2, 7, 'Urinvägar'),
(64, 'Blod i urinen', '[\"Nej\",\r\n\"Ja\",\r\n\"Vet ej\"]', 5, 2, 7, 'Urinvägar'),
(65, 'Vad har bitit djuret', '[\"Vet ej\",\r\n\"Hund\",\r\n\"Katt\",\r\n\"Orm\",\r\n\"Geting/bi/humla\",\r\n\"Mygg/knott/broms\"]', 1, 2, 7, 'Bett '),
(66, 'Allmänpåverkan', '[\"Nej\"\r\n\"Ja\"]', 2, 2, 7, 'Bett '),
(67, 'Är det svullet', '[\"Nej\",\r\n\"Lite\",\r\n\"Pågående ökande svullnad\",\r\n\"Stor\",\r\n\"Svullnad även på andra delar av kroppen där inga bett misstänks\"]', 3, 2, 7, 'Bett '),
(68, 'Visar djuret tecken på smärta', '[\"Nej\"\r\n\"Ja\"]', 4, 2, 7, 'Bett '),
(69, 'Finns det sår', '[\"Nej\"\r\n\"Ja\"]', 5, 2, 7, 'Bett '),
(70, 'Var sitter såret', '[\"Ansikte\",\r\n\"Huvud\",\r\n\"Kropp\",\r\n\"Ben/svans\",\r\n\"Tass\"]', 1, 3, 69, 'Ja'),
(71, 'Storlek', '[\"Punktformigt\",\r\n\"Ca 1-3 cm\",\r\n\">3 cm\"]', 2, 3, 69, 'Ja'),
(72, 'Djup', '[\"Ytligt skrap\",\r\n\"Går genom yttersta delen av huden\",\r\n\"Går att lyfta på huden och såret fortsätter in\",\r\n\"Flik/flikar som hänger\"]', 3, 3, 69, 'Ja'),
(73, 'Blödning', '[\"Nej\",\r\n\"Har blött lite men inte längre\",\r\n\"Blöder lite\",\r\n\"Blöder mycket\"]', 4, 3, 69, 'Ja'),
(74, 'Har ni helt säkra på att djuret fått i sig giftet?', '[\"Nej\"\r\n\"Ja\"]', 1, 2, 7, 'Förgiftning'),
(75, 'Vet ni vad djuret har ätit', '[\"Nej\",\r\n\"Fanns en blandning av saker som är potentiellt giftiga för djuret\",\r\n\"Ja\"]', 2, 2, 7, 'Förgiftning'),
(76, 'Har djuret några symptom', '[\"Nej\"\r\n\"Ja\"]', 3, 2, 7, 'Förgiftning'),
(77, 'Typ av gift', '[\"Choklad\",\r\n\"Lök\",\r\n\"Russin\",\r\n\"Vindruvor\",\r\n\"Giftsvamp\",\r\n\"Kylarvätska\",\r\n\"Xylitol\",\r\n\"Snus\",\r\n\"Läkemedel\",\r\n\"Nötter\",\r\n\"Råttgift\"]', 4, 2, 7, 'Förgiftning'),
(78, 'Allmänpåverkan', '[\"Nej\",\r\n\"Ja\"]', 1, 2, 7, 'Sårskador'),
(79, 'Vad har orsakat såret', '[\"Bett\",\r\n\"Trauma\",\r\n\"Vet ej\"]', 2, 2, 7, 'Sårskador'),
(80, 'Var sitter såret', '[\"Ansikte\",\r\n\"Huvud\",\r\n\"Kropp\",\r\n\"Ben/svans\",\r\n\"Tass\"]', 3, 2, 7, 'Sårskador'),
(81, 'Storlek', '[\"Punktformigt\",\r\n\"Ca 1-3 cm\",\r\n\">3 cm\"]', 4, 2, 7, 'Sårskador'),
(82, 'Djup', '[\"Ytligt skrap\",\r\n\"Går genom yttersta delen av huden\",\r\n\"Går att lyfta på huden och såret fortsätter in\",\r\n\"Flik/flikar som hänger\"]', 5, 2, 7, 'Sårskador'),
(83, 'Blödning', '[\"Nej\",\r\n\"Har blött lite men inte längre\",\r\n\"Blöder lite\",\r\n\"Blöder mycket\"]', 6, 2, 7, 'Sårskador'),
(84, 'Smuts', '[\"Ser rent ut\",\r\n\"Mindre mängd smuts\",\r\n\"Mycket smutsigt\"]', 7, 2, 7, 'Sårskador'),
(85, 'Har ni behandlat/rengjort med något', '[\"Nej\",\r\n\"Ja\"]', 8, 2, 7, 'Sårskador'),
(86, 'Allmäntillstånd', '[\"Är som vanligt\",\r\n\"Lite tröttare\",\r\n\"Mycket påverkad\"]', 1, 2, 7, 'Luftvägar'),
(87, 'Feber', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Luftvägar'),
(88, 'Hosta', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Luftvägar'),
(89, 'Typ av hosta', '[\"Torr\",\r\n\"Slemmig\"]', 1, 3, 88, 'Ja'),
(90, 'Harkling', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Luftvägar'),
(91, 'Nysning', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Luftvägar'),
(92, 'Frekvens (per 24h)', '[\"1-5 ggr\",\r\n\"5-10 ggr\",\r\n\">10 ggr\"]', 6, 2, 7, 'Luftvägar'),
(93, 'När uppvisar djuret symptom', '[\"I aktivitet\",\r\n\"Efter aktiviet\",\r\n\"I vila\",\r\n\"Efter vila\",\r\n\"Vid aktivitet och vila\"]', 7, 2, 7, 'Luftvägar'),
(94, 'Kniper med ögat/ögonen', '[\"Nej\",\r\n\"Ja\"]', 1, 2, 7, 'Ögon'),
(95, 'Liten pupill jämfört med andra ögat', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Ögon'),
(96, 'Rinner från ögat/ögonen', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Ögon'),
(97, 'Svullen i området (ögonlock, konjunktiva)', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Ögon'),
(98, 'Kliar djuret sig', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Ögon'),
(99, 'Färgförändringar', '[\"Nej\",\r\n\"Ja\"]', 6, 2, 7, 'Ögon'),
(100, 'Är 3:e ögonlocket synligt/svullet', '[\"Nej\",\r\n\"Ja\"]', 7, 2, 7, 'Ögon'),
(101, 'Allmäntillstånd', '[\"Är som vanligt\",\r\n\"Lite tröttare\",\r\n\"Mycket påverkad\"]', 1, 2, 7, 'Mage och tarm'),
(102, 'Har djuret ätit annat än sitt foder (sak/människomat/grillspett eller liknande)', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Mage och tarm'),
(103, 'Symptombild', '[\"Kräkning\",\r\n\"Diarré\",\r\n\"Kräkning och diarré\"]', 3, 2, 7, 'Mage och tarm'),
(104, 'Frekvens (per 24h)', '[\"1-5 ggr\",\r\n\"5-10 ggr\",\r\n\">10 ggr\"]', 4, 2, 7, 'Mage och tarm'),
(105, 'Dricker', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Mage och tarm'),
(106, 'Vätskestatus', '[\"Får behålla vätska\",\n\"Får ej behålla vätska\"]', 6, 2, 7, 'Mage och tarm'),
(107, 'Aptit', '[\"Har god aptit\",\r\n\"Mindre aptit än normalt\",\r\n\"Vill ej äta\"]', 7, 2, 7, 'Mage och tarm'),
(108, 'Foderintag', '[\"Får behålla foder\",\r\n\"Får behålla lite foder\",\r\n\"Kräks i anslutning till foderintag\",\r\n\"Kräks osmält föda (ej i anslutning till foderintag)\"]', 8, 2, 7, 'Mage och tarm'),
(109, 'Problemområde', '[\"Kropp\",\r\n\"Öron//tassar\"]', 1, 2, 7, 'Hud'),
(110, 'Klåda (slickar/gnager/hasar på rumpan)', '[\"Ingen klåda\",\r\n\"Kliar sig 1-5 ggr/dag\",\r\n\"Kliar sig längre stunder/intensivt/stannar på promenad för att klia sig\",\r\n\"Behöver hjälp att bryta klådbeteende\",\r\n\"Kliar sig natt som dag\"]', 1, 3, 109, 'Kropp'),
(111, 'Hud', '[\"Inga synliga hudförändringar\",\r\n\"Viss rodnad/plitor/skorpor\",\r\n\"Vätskande/fuktande hudlesioner (eller kladdig päls)\"]', 2, 3, 109, 'Kropp'),
(112, 'Ömmar', '[\"Nej\",\r\n\"Ja\"]', 3, 3, 109, 'Kropp'),
(113, 'Päls', '[\"Inga pälsförändringar\",\r\n\"Tappat/saknar päls i vissa omr\"]', 4, 3, 109, 'Kropp'),
(114, 'Har du behandlat med något', '[\"Nej\",\r\n\"Ja\"]', 5, 3, 109, 'Kropp'),
(115, 'Smärta', '[\"Nej\",\r\n\"Ja\"]', 1, 3, 109, 'Öron//tassar'),
(116, 'Klåda', '[\"Nej\",\r\n\"Ja\"]', 2, 3, 109, 'Öron//tassar'),
(117, 'Rodnad/svullnad', '[\"Nej\",\r\n\"Ja\"]', 3, 3, 109, 'Öron//tassar'),
(118, 'Sekret/vätska', '[\"Nej\",\r\n\"Ja\"]', 4, 3, 109, 'Öron//tassar'),
(119, 'Historik av problem', '[\"Nej\",\r\n\"Ja\"]', 5, 3, 109, 'Öron//tassar'),
(120, 'Har ni behandlat med något', '[\"Nej\",\r\n\"Ja\"]', 6, 3, 109, 'Öron//tassar'),
(121, 'Var sitter förändringarna?', '[\"Kroppen\",\r\n\"Huvud\",\r\n\"Tassar\"]', 1, 4, 111, 'Viss rodnad/plitor/skorpor'),
(122, 'Var sitter förändringarna?', '[\"Kroppen\",\r\n\"Huvud\",\r\n\"Tassar\"]', 1, 4, 111, 'Vätskande/fuktande hudlesioner (eller kladdig päls)'),
(123, 'Kan/får ni komma åt örat?', '[\"Nej\",\r\n\"Ja\"]', 1, 4, 115, 'Ja'),
(124, 'Typ av sekret/vätska?', '[\"Mörk/-t\",\r\n\"Gul/-t\",\r\n\"Kaffesumpliknande\",\r\n\"Röd missfärgning\",\r\n\"Klar vätska\"]', 1, 4, 117, 'Ja'),
(125, 'Kön', '[\"Hondjur\",\r\n\"Handjur\"]', 1, 2, 7, 'Reproduktionsorgan'),
(126, 'Problemområde', '[\"Penis\",\r\n\"Testiklar\"]', 1, 3, 125, 'Handjur'),
(127, 'Slickar sig ovanlig mycket', '[\"Nej\",\r\n\"Ja\"]\r\n', 1, 4, 126, 'Penis'),
(128, 'Läcker sekret', '[\"Nej\",\r\n\"Ja\"]\r\n', 2, 4, 126, 'Penis'),
(129, 'Färg', '[\"Klar/ljus\",\r\n\"Vit\",\r\n\"Gul\",\r\n\"Grön\"]\r\n', 1, 5, 128, 'Ja'),
(130, 'Illaluktande', '[\"Nej\",\r\n\"Ja\"]\r\n', 2, 5, 128, 'Ja'),
(131, 'Mängd', '[\"Lite\"\r\n\"En del\"\r\n\"Mycket\"]\r\n', 3, 5, 128, 'Ja'),
(132, 'Svullnad', '[\"Nej\",\r\n\"Ja\"]\r\n', 1, 4, 126, 'Testiklar'),
(133, 'Storleksskillnad', '[\"Nej\",\r\n\"Ja\"]\r\n', 2, 4, 126, 'Testiklar'),
(134, 'Konsistens', '[\"Normal\",\r\n\"Mjuk/blaskig\",\r\n\"Hård\"]\r\n', 3, 4, 126, 'Testiklar'),
(135, 'Ömhet', '[\"Nej\",\r\n\"Ja\"]\r\n', 4, 4, 126, 'Testiklar'),
(136, 'Storlek', '[\"1 mindre än normalt\",\r\n\"1 större än normalt\",\r\n\"1-2 testiklar saknas i scrotum\"]\r\n', 1, 5, 133, 'Ja'),
(137, 'Problemområde', '[\"Juver\",\n\"Vulva-Livmoder\"\n]', 1, 3, 125, 'Hondjur'),
(138, 'Allmäntillstånd', '[\"Är som vanligt\",\r\n\"Lite orolig\",\r\n\"Tröttare än vanligt\",\r\n\"Mycket allmänpåverkad\"]\r\n', 1, 4, 137, 'Juver'),
(139, 'Hormonell status', '[\"Lakterande\",\n\"Skendräktig\",\n\"I löp\",\n\"Dräktig\",\n\"Mellan två löp\"]\n', 2, 4, 137, 'Juver'),
(140, 'Nyligen opererad i området', '[\"Nej\",\r\n\"Ja\"]\r\n', 3, 4, 137, 'Juver'),
(141, 'Hur många juverdelar är påverkade', '[\"1\",\r\n\"2\",\r\n\"3\",\r\n\"4\",\r\n\"5\",\r\n\"Påverkan på alla delar på en/båda sidor\"]\r\n', 4, 4, 137, 'Juver'),
(142, 'Typ av förändring', '[\"Knöl/-ar\",\r\n\"Rodnad\",\r\n\"Rodnad och svullnad\",\r\n\"Svullnad\"]\r\n', 5, 4, 137, 'Juver'),
(143, 'Smärta', '[\"Nej\",\r\n\"Ja\"]\r\n', 6, 4, 137, 'Juver'),
(144, 'Feber', '[\"Nej\",\r\n\"Ja\"]\r\n', 7, 4, 137, 'Juver'),
(145, 'Allmäntillstånd', '[\"Är som vanligt\",\r\n\"Lite orolig\",\r\n\"Tröttare än vanligt\",\r\n\"Mycket allmänpåverkad\"]\r\n', 1, 4, 137, 'Vulva-Livmoder'),
(146, 'Hormonell status', '[\"Lakterande\",\n\"Skendräktig\",\n\"I löp\",\n\"Dräktig\",\n\"Mellan två löp\"]\n', 2, 4, 137, 'Vulva-Livmoder'),
(147, 'Flytning', '[\"Nej\",\r\n\"Ja\"]\r\n', 3, 4, 137, 'Vulva-Livmoder'),
(148, 'Typ av flytning', '[\"Blodig\",\r\n\"Brungrumlig/flockig\",\r\n\"Klar\",\r\n\"Gul, trögflytande\"]\r\n', 1, 5, 147, 'Ja'),
(149, 'Framvällande massa', '[\"Nej\",\r\n\"Ja\"]\r\n', 4, 4, 137, 'Vulva-Livmoder'),
(150, 'Nyligen opererad i området (vulva/livmoder)', '[\"Nej\",\r\n\"Ja\"]\r\n', 5, 4, 137, 'Vulva-Livmoder'),
(151, 'Aptit', '[\"Normal\",\r\n\"Ökad\",\r\n\"Sänkt\",\r\n\"Saknas\"]\r\n', 6, 4, 137, 'Vulva-Livmoder'),
(152, 'Törst', '[\"Normal\",\r\n\"Ökad\",\r\n\"Sänkt\"]\r\n', 7, 4, 137, 'Vulva-Livmoder'),
(153, 'Urinering', '[\"Normal\",\r\n\"Ökad\",\r\n\"Småskvätter\"]\r\n', 8, 4, 137, 'Vulva-Livmoder'),
(154, 'Kräkning', '[\"Nej\",\r\n\"Ja\"]\r\n', 9, 4, 137, 'Vulva-Livmoder'),
(155, 'Diarré', '[\"Nej\",\r\n\"Ja\"]\r\n', 10, 4, 137, 'Vulva-Livmoder');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
