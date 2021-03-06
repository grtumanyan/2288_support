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
(4, '??lder', '{\"Valp/kattunge (0-6m??n)\",\n\"6 m??n-2 ??r\",\n\"2-6 ??r\",\n\"??ver 6 ??r\"}', 2, 1, NULL, ''),
(5, 'K??n', '{\"Hane\",\n\"Hane kastrerad\",\n\"Tik\",\n\"Tik steriliserad\"}', 3, 1, NULL, ''),
(6, 'Vikt', '{\"0,5-2 kg\",\n\"2-4 kg\",\n\"4-10 kg\",\n\"10-20 kg\",\n\"20-40 kg\", \n\"??ver 40 kg\"}', 4, 1, NULL, ''),
(7, 'Problemomr??de', '[\"Mage och tarm\",\n\"Hud\",\n\"??gon\",\n\"Luftv??gar\",\n\"S??rskador\",\n\"F??rgiftning\",\n\"Bett\",\n\"Munh??la\",\n\"Urinv??gar\",\n\"Reproduktionsorgan\",\n\"F??rlossning\",\n\"Dr??ktighet\",\n\"L??p\",\n\"Skendr??ktighet\",\n\"R??relseapparat\"]', 5, 1, NULL, ''),
(8, 'Tid', '[\"Nyss\",\n\"0-2 h sedan\",\n\"Idag\",\n\"ett dygn\",\n\"1-3 dygn\",\n\"1 vecka\",\n\"L??ngre tid\",\n\"??terkommande/periodvis\"]', 6, 1, NULL, ''),
(9, 'Ras Hund', '{\"Hund\",\"HundTrubbNos\"}', 1, 2, 3, 'Hund'),
(10, 'Ras Katt', '{\"Katt\",\"KattTrubbNos\"}', 1, 2, 3, 'Katt'),
(11, 'Allm??ntillst??nd', '{\"Gott\",\n\"D??mpad/orolig\",\n\"Ligger mest/mycket orolig\",\n\"Piper/gn??ller/skriker\"}', 1, 2, 7, 'R??relseapparat'),
(12, 'Aptit', '{\"Ja\",\r\n\"Nej\"}', 2, 2, 7, 'R??relseapparat'),
(13, 'Tydlig h??lta', '{\"Nej\",\r\n\"Ja\"}', 3, 2, 7, 'R??relseapparat'),
(14, 'Vilket benpar', '{\"Fram\",\r\n\"Bak\"}', 1, 3, 13, 'Ja'),
(15, 'Bajsar/kissar', '{\"Ja-utan problem\",\n\"Ja-med viss sv??righet\",\n\"Nej-vill/kan inte g?? ut f??r rastning\"}', 4, 2, 7, 'R??relseapparat'),
(16, 'Svullnad', '{\"Nej\",\r\n\"Ja\"}', 5, 2, 7, 'R??relseapparat'),
(17, 'Feber', '{\"Nej\",\r\n\"Ja\"}', 6, 2, 7, 'R??relseapparat'),
(18, 'Allm??ntillst??nd ', '{\"Pigg\",\r\n\"Lite tr??tt\",\r\n\"Mycket tr??tt\"}', 1, 2, 7, 'F??rlossning, dr??ktighet, l??p'),
(19, 'K??nt parning/insemineringsdatum', '{\"Nej\",\r\n\"Ja\"}', 2, 2, 7, 'F??rlossning, dr??ktighet, l??p'),
(20, 'Dygn i dr??ktigheten', '{\"<60\",\r\n\"65 +/- 5 dygn\",\r\n\">70 \"}', 1, 3, 19, 'Ja'),
(21, 'Senaste l??p', '[\"Precis avslutat\",\r\n\"1v-1 m??n sedan\",\r\n\"1-2 m??n sedan\"]', 1, 2, 7, 'Skendr??ktighet'),
(22, 'Mj??lk i juver/svullna juver', '[\"Nej\",\r\n\"Ja-lite\",\r\n\"Ja-mycket/besv??rande\"]', 2, 2, 7, 'Skendr??ktighet'),
(23, 'Allm??ntillst??nd', '[\"Pigg/som vanligt\",\r\n\"Lite tr??tt/mindre villig till promenad\",\r\n\"Mycket tr??tt/vill inte alls promenera\"]', 3, 2, 7, 'Skendr??ktighet'),
(24, 'Boar', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Skendr??ktighet'),
(25, 'Adopterar (andra djur, gosedjur eller liknande)', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Skendr??ktighet'),
(26, 'Haft sitt f??rsta l??p', '[\"Nej\",\r\n\"Ja\"]', 1, 2, 7, 'L??p'),
(27, 'L??per vanligen', '[\"1 g??ng/??r\",\r\n\"2 ggr/??r\",\r\n\"3 ggr/??r\"]', 2, 2, 7, 'L??p'),
(28, 'Antal dagar i l??p-KOlla intervall med repro', '[\"0-7\",\r\n\"7-10\",\r\n\"10-15\",\r\n\"15-23\",\r\n\">23 dagar\"]', 3, 2, 7, 'L??p'),
(29, 'Visar intresse f??r hanar/omv??nt', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'L??p'),
(30, 'Flytning', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'L??p'),
(31, 'F??rg', '[\"Klar\",\r\n\"Blodig\",\r\n\"Brunr??d\",\r\n\"Gul\"]', 1, 3, 30, 'Ja'),
(32, 'Allm??ntillst??nd ', '[\"Pigg\",\n\"Lite tr??tt\",\n\"Mycket tr??tt\"]', 1, 2, 7, 'Dr??ktighet'),
(33, 'K??nt parning/insemineringsdatum', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Dr??ktighet'),
(34, 'F??rsta kull', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Dr??ktighet'),
(35, 'Feber', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Dr??ktighet'),
(36, 'Flytning', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Dr??ktighet'),
(37, 'Dygn i dr??ktigheten', '[\"<60\",\n\"64 +/- 5 dygn\",\n\">70\"]', 1, 3, 33, 'Ja'),
(38, 'F??rg', '[\"Klar\",\r\n\"Brunr??d\",\r\n\"Gul\",\r\n\"Gr??n\"]', 1, 3, 36, 'Ja'),
(39, 'Allm??ntillst??nd', '[\"Pigg\",\r\n\"Lite tr??tt\",\r\n\"Mycket tr??tt\"]', 1, 2, 7, 'F??rlossning'),
(40, 'K??nt parning/insemineringsdatum', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'F??rlossning'),
(41, 'Dygn i dr??ktigheten', '[\"<60\",\r\n\"65 +/- 5 dygn\",\r\n\">70\"] ', 1, 3, 40, 'Ja'),
(42, 'F??rsta kull', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'F??rlossning'),
(43, 'Historik av dystoki', '[\"Nej\",\r\n\"Ja-behandlad medicinskt\",\r\n\"Ja-snittad\"] ', 1, 3, 42, 'Nej'),
(44, 'Har det gjorts bilddiagnostik', '[\"Nej\",\r\n\"Ja-r??ntgen\",\r\n\"Ja-ultraljud\"]', 4, 2, 7, 'F??rlossning'),
(45, 'Tempad', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'F??rlossning'),
(46, 'Temps??nkning', '[\"Nej\",\r\n\"Ja\"]', 1, 3, 45, 'Ja'),
(47, 'Vattenavg??ng', '[\"Nej\",\r\n\"Ja\"]', 6, 2, 7, 'F??rlossning'),
(48, 'Tid sedan vattenavg??ng', '[\"Nyss\"\r\n\"30 min-1,5h sedan\",\r\n\"2-3h sedan\"] ', 1, 3, 47, 'Ja'),
(49, 'V??rkar', '[\"Nej\",\r\n\"Ja\"]', 7, 2, 7, 'F??rlossning'),
(50, 'Intensitet', '[\"Inte s?? kraftiga\",\r\n\"Mycket kraftiga\"] ', 1, 3, 49, 'Ja'),
(51, 'Hur l??nge', '[\"B??rjat nyss\",\r\n\"Mer ??n 30 min\",\r\n\"1-4 h\"] ', 2, 3, 49, 'Ja'),
(52, 'Var bor ni i f??rh??llande till l??mplig klinik', '[\"Mindre ??n 10 min till ??ppen klinik\",\r\n\"30min-1h till klinik\",\r\n\"1-2h till klinik\",\r\n\">2h till klinik \"]', 8, 2, 7, 'F??rlossning'),
(53, 'Har det kommit n??gra ungar', '[\"Nej\",\r\n\"Ja\"]', 9, 2, 7, 'F??rlossning'),
(54, 'Levande', '[\"Nej\",\r\n\"Ja\",\r\n\"N??gra levande och n??gra d??da/mycket svaga\"] ', 1, 3, 53, 'Ja'),
(55, 'N??r kom senaste ungen', '[\"Nyss\",\r\n\"1-2h sedan\",\r\n\">2h sedan\"] ', 2, 3, 53, 'Ja'),
(56, 'Syns fosterbl??sa/foster', '[\"Nej\",\r\n\"Ja\"]', 10, 2, 7, 'F??rlossning'),
(57, 'Flytning', '[\"Nej\",\r\n\"Ja\"]', 11, 2, 7, 'F??rlossning'),
(58, 'F??rg', '[\"Klar\",\r\n\"Brunr??d\",\r\n\"Gr??n\"] ', 1, 3, 57, 'Ja'),
(59, 'Tid f??rlupen sedan start p?? f??rlossning', '[\"0-6h\",\r\n\"6-12h\",\r\n\"12-18h\",\r\n\"24h eller mer\"]', 12, 2, 7, 'F??rlossning'),
(60, 'Allm??ntillst??nd', '[\"??r som vanligt\",\r\n\"Lite orolig\",\r\n\"Tr??ttare ??n vanligt\",\r\n\"Mycket allm??np??verkad\"]', 1, 2, 7, 'Urinv??gar'),
(61, 'Kissar djuret', '[\"Vet ej\",\r\n\"Ja\",\r\n\"Ja men mindre m??ngd\",\r\n\"Ja men mindre m??ngd och oftare\",\r\n\"Ja men d??lig str??le\",\r\n\"Nej\",\r\n\"Mer ??n normalt\"]', 2, 2, 7, 'Urinv??gar'),
(62, '??r djuret besv??rat i samband med urinering', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Urinv??gar'),
(63, 'Feber', '[\"Nej\",\r\n\"Ja\",\r\n\"Vet ej\"]', 4, 2, 7, 'Urinv??gar'),
(64, 'Blod i urinen', '[\"Nej\",\r\n\"Ja\",\r\n\"Vet ej\"]', 5, 2, 7, 'Urinv??gar'),
(65, 'Vad har bitit djuret', '[\"Vet ej\",\r\n\"Hund\",\r\n\"Katt\",\r\n\"Orm\",\r\n\"Geting/bi/humla\",\r\n\"Mygg/knott/broms\"]', 1, 2, 7, 'Bett '),
(66, 'Allm??np??verkan', '[\"Nej\"\r\n\"Ja\"]', 2, 2, 7, 'Bett '),
(67, '??r det svullet', '[\"Nej\",\r\n\"Lite\",\r\n\"P??g??ende ??kande svullnad\",\r\n\"Stor\",\r\n\"Svullnad ??ven p?? andra delar av kroppen d??r inga bett misst??nks\"]', 3, 2, 7, 'Bett '),
(68, 'Visar djuret tecken p?? sm??rta', '[\"Nej\"\r\n\"Ja\"]', 4, 2, 7, 'Bett '),
(69, 'Finns det s??r', '[\"Nej\"\r\n\"Ja\"]', 5, 2, 7, 'Bett '),
(70, 'Var sitter s??ret', '[\"Ansikte\",\r\n\"Huvud\",\r\n\"Kropp\",\r\n\"Ben/svans\",\r\n\"Tass\"]', 1, 3, 69, 'Ja'),
(71, 'Storlek', '[\"Punktformigt\",\r\n\"Ca 1-3 cm\",\r\n\">3 cm\"]', 2, 3, 69, 'Ja'),
(72, 'Djup', '[\"Ytligt skrap\",\r\n\"G??r genom yttersta delen av huden\",\r\n\"G??r att lyfta p?? huden och s??ret forts??tter in\",\r\n\"Flik/flikar som h??nger\"]', 3, 3, 69, 'Ja'),
(73, 'Bl??dning', '[\"Nej\",\r\n\"Har bl??tt lite men inte l??ngre\",\r\n\"Bl??der lite\",\r\n\"Bl??der mycket\"]', 4, 3, 69, 'Ja'),
(74, 'Har ni helt s??kra p?? att djuret f??tt i sig giftet?', '[\"Nej\"\r\n\"Ja\"]', 1, 2, 7, 'F??rgiftning'),
(75, 'Vet ni vad djuret har ??tit', '[\"Nej\",\r\n\"Fanns en blandning av saker som ??r potentiellt giftiga f??r djuret\",\r\n\"Ja\"]', 2, 2, 7, 'F??rgiftning'),
(76, 'Har djuret n??gra symptom', '[\"Nej\"\r\n\"Ja\"]', 3, 2, 7, 'F??rgiftning'),
(77, 'Typ av gift', '[\"Choklad\",\r\n\"L??k\",\r\n\"Russin\",\r\n\"Vindruvor\",\r\n\"Giftsvamp\",\r\n\"Kylarv??tska\",\r\n\"Xylitol\",\r\n\"Snus\",\r\n\"L??kemedel\",\r\n\"N??tter\",\r\n\"R??ttgift\"]', 4, 2, 7, 'F??rgiftning'),
(78, 'Allm??np??verkan', '[\"Nej\",\r\n\"Ja\"]', 1, 2, 7, 'S??rskador'),
(79, 'Vad har orsakat s??ret', '[\"Bett\",\r\n\"Trauma\",\r\n\"Vet ej\"]', 2, 2, 7, 'S??rskador'),
(80, 'Var sitter s??ret', '[\"Ansikte\",\r\n\"Huvud\",\r\n\"Kropp\",\r\n\"Ben/svans\",\r\n\"Tass\"]', 3, 2, 7, 'S??rskador'),
(81, 'Storlek', '[\"Punktformigt\",\r\n\"Ca 1-3 cm\",\r\n\">3 cm\"]', 4, 2, 7, 'S??rskador'),
(82, 'Djup', '[\"Ytligt skrap\",\r\n\"G??r genom yttersta delen av huden\",\r\n\"G??r att lyfta p?? huden och s??ret forts??tter in\",\r\n\"Flik/flikar som h??nger\"]', 5, 2, 7, 'S??rskador'),
(83, 'Bl??dning', '[\"Nej\",\r\n\"Har bl??tt lite men inte l??ngre\",\r\n\"Bl??der lite\",\r\n\"Bl??der mycket\"]', 6, 2, 7, 'S??rskador'),
(84, 'Smuts', '[\"Ser rent ut\",\r\n\"Mindre m??ngd smuts\",\r\n\"Mycket smutsigt\"]', 7, 2, 7, 'S??rskador'),
(85, 'Har ni behandlat/rengjort med n??got', '[\"Nej\",\r\n\"Ja\"]', 8, 2, 7, 'S??rskador'),
(86, 'Allm??ntillst??nd', '[\"??r som vanligt\",\r\n\"Lite tr??ttare\",\r\n\"Mycket p??verkad\"]', 1, 2, 7, 'Luftv??gar'),
(87, 'Feber', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Luftv??gar'),
(88, 'Hosta', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, 'Luftv??gar'),
(89, 'Typ av hosta', '[\"Torr\",\r\n\"Slemmig\"]', 1, 3, 88, 'Ja'),
(90, 'Harkling', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, 'Luftv??gar'),
(91, 'Nysning', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Luftv??gar'),
(92, 'Frekvens (per 24h)', '[\"1-5 ggr\",\r\n\"5-10 ggr\",\r\n\">10 ggr\"]', 6, 2, 7, 'Luftv??gar'),
(93, 'N??r uppvisar djuret symptom', '[\"I aktivitet\",\r\n\"Efter aktiviet\",\r\n\"I vila\",\r\n\"Efter vila\",\r\n\"Vid aktivitet och vila\"]', 7, 2, 7, 'Luftv??gar'),
(94, 'Kniper med ??gat/??gonen', '[\"Nej\",\r\n\"Ja\"]', 1, 2, 7, '??gon'),
(95, 'Liten pupill j??mf??rt med andra ??gat', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, '??gon'),
(96, 'Rinner fr??n ??gat/??gonen', '[\"Nej\",\r\n\"Ja\"]', 3, 2, 7, '??gon'),
(97, 'Svullen i omr??det (??gonlock, konjunktiva)', '[\"Nej\",\r\n\"Ja\"]', 4, 2, 7, '??gon'),
(98, 'Kliar djuret sig', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, '??gon'),
(99, 'F??rgf??r??ndringar', '[\"Nej\",\r\n\"Ja\"]', 6, 2, 7, '??gon'),
(100, '??r 3:e ??gonlocket synligt/svullet', '[\"Nej\",\r\n\"Ja\"]', 7, 2, 7, '??gon'),
(101, 'Allm??ntillst??nd', '[\"??r som vanligt\",\r\n\"Lite tr??ttare\",\r\n\"Mycket p??verkad\"]', 1, 2, 7, 'Mage och tarm'),
(102, 'Har djuret ??tit annat ??n sitt foder (sak/m??nniskomat/grillspett eller liknande)', '[\"Nej\",\r\n\"Ja\"]', 2, 2, 7, 'Mage och tarm'),
(103, 'Symptombild', '[\"Kr??kning\",\r\n\"Diarr??\",\r\n\"Kr??kning och diarr??\"]', 3, 2, 7, 'Mage och tarm'),
(104, 'Frekvens (per 24h)', '[\"1-5 ggr\",\r\n\"5-10 ggr\",\r\n\">10 ggr\"]', 4, 2, 7, 'Mage och tarm'),
(105, 'Dricker', '[\"Nej\",\r\n\"Ja\"]', 5, 2, 7, 'Mage och tarm'),
(106, 'V??tskestatus', '[\"F??r beh??lla v??tska\",\n\"F??r ej beh??lla v??tska\"]', 6, 2, 7, 'Mage och tarm'),
(107, 'Aptit', '[\"Har god aptit\",\r\n\"Mindre aptit ??n normalt\",\r\n\"Vill ej ??ta\"]', 7, 2, 7, 'Mage och tarm'),
(108, 'Foderintag', '[\"F??r beh??lla foder\",\r\n\"F??r beh??lla lite foder\",\r\n\"Kr??ks i anslutning till foderintag\",\r\n\"Kr??ks osm??lt f??da (ej i anslutning till foderintag)\"]', 8, 2, 7, 'Mage och tarm'),
(109, 'Problemomr??de', '[\"Kropp\",\r\n\"??ron//tassar\"]', 1, 2, 7, 'Hud'),
(110, 'Kl??da (slickar/gnager/hasar p?? rumpan)', '[\"Ingen kl??da\",\r\n\"Kliar sig 1-5 ggr/dag\",\r\n\"Kliar sig l??ngre stunder/intensivt/stannar p?? promenad f??r att klia sig\",\r\n\"Beh??ver hj??lp att bryta kl??dbeteende\",\r\n\"Kliar sig natt som dag\"]', 1, 3, 109, 'Kropp'),
(111, 'Hud', '[\"Inga synliga hudf??r??ndringar\",\r\n\"Viss rodnad/plitor/skorpor\",\r\n\"V??tskande/fuktande hudlesioner (eller kladdig p??ls)\"]', 2, 3, 109, 'Kropp'),
(112, '??mmar', '[\"Nej\",\r\n\"Ja\"]', 3, 3, 109, 'Kropp'),
(113, 'P??ls', '[\"Inga p??lsf??r??ndringar\",\r\n\"Tappat/saknar p??ls i vissa omr\"]', 4, 3, 109, 'Kropp'),
(114, 'Har du behandlat med n??got', '[\"Nej\",\r\n\"Ja\"]', 5, 3, 109, 'Kropp'),
(115, 'Sm??rta', '[\"Nej\",\r\n\"Ja\"]', 1, 3, 109, '??ron//tassar'),
(116, 'Kl??da', '[\"Nej\",\r\n\"Ja\"]', 2, 3, 109, '??ron//tassar'),
(117, 'Rodnad/svullnad', '[\"Nej\",\r\n\"Ja\"]', 3, 3, 109, '??ron//tassar'),
(118, 'Sekret/v??tska', '[\"Nej\",\r\n\"Ja\"]', 4, 3, 109, '??ron//tassar'),
(119, 'Historik av problem', '[\"Nej\",\r\n\"Ja\"]', 5, 3, 109, '??ron//tassar'),
(120, 'Har ni behandlat med n??got', '[\"Nej\",\r\n\"Ja\"]', 6, 3, 109, '??ron//tassar'),
(121, 'Var sitter f??r??ndringarna?', '[\"Kroppen\",\r\n\"Huvud\",\r\n\"Tassar\"]', 1, 4, 111, 'Viss rodnad/plitor/skorpor'),
(122, 'Var sitter f??r??ndringarna?', '[\"Kroppen\",\r\n\"Huvud\",\r\n\"Tassar\"]', 1, 4, 111, 'V??tskande/fuktande hudlesioner (eller kladdig p??ls)'),
(123, 'Kan/f??r ni komma ??t ??rat?', '[\"Nej\",\r\n\"Ja\"]', 1, 4, 115, 'Ja'),
(124, 'Typ av sekret/v??tska?', '[\"M??rk/-t\",\r\n\"Gul/-t\",\r\n\"Kaffesumpliknande\",\r\n\"R??d missf??rgning\",\r\n\"Klar v??tska\"]', 1, 4, 117, 'Ja'),
(125, 'K??n', '[\"Hondjur\",\r\n\"Handjur\"]', 1, 2, 7, 'Reproduktionsorgan'),
(126, 'Problemomr??de', '[\"Penis\",\r\n\"Testiklar\"]', 1, 3, 125, 'Handjur'),
(127, 'Slickar sig ovanlig mycket', '[\"Nej\",\r\n\"Ja\"]\r\n', 1, 4, 126, 'Penis'),
(128, 'L??cker sekret', '[\"Nej\",\r\n\"Ja\"]\r\n', 2, 4, 126, 'Penis'),
(129, 'F??rg', '[\"Klar/ljus\",\r\n\"Vit\",\r\n\"Gul\",\r\n\"Gr??n\"]\r\n', 1, 5, 128, 'Ja'),
(130, 'Illaluktande', '[\"Nej\",\r\n\"Ja\"]\r\n', 2, 5, 128, 'Ja'),
(131, 'M??ngd', '[\"Lite\"\r\n\"En del\"\r\n\"Mycket\"]\r\n', 3, 5, 128, 'Ja'),
(132, 'Svullnad', '[\"Nej\",\r\n\"Ja\"]\r\n', 1, 4, 126, 'Testiklar'),
(133, 'Storleksskillnad', '[\"Nej\",\r\n\"Ja\"]\r\n', 2, 4, 126, 'Testiklar'),
(134, 'Konsistens', '[\"Normal\",\r\n\"Mjuk/blaskig\",\r\n\"H??rd\"]\r\n', 3, 4, 126, 'Testiklar'),
(135, '??mhet', '[\"Nej\",\r\n\"Ja\"]\r\n', 4, 4, 126, 'Testiklar'),
(136, 'Storlek', '[\"1 mindre ??n normalt\",\r\n\"1 st??rre ??n normalt\",\r\n\"1-2 testiklar saknas i scrotum\"]\r\n', 1, 5, 133, 'Ja'),
(137, 'Problemomr??de', '[\"Juver\",\n\"Vulva-Livmoder\"\n]', 1, 3, 125, 'Hondjur'),
(138, 'Allm??ntillst??nd', '[\"??r som vanligt\",\r\n\"Lite orolig\",\r\n\"Tr??ttare ??n vanligt\",\r\n\"Mycket allm??np??verkad\"]\r\n', 1, 4, 137, 'Juver'),
(139, 'Hormonell status', '[\"Lakterande\",\n\"Skendr??ktig\",\n\"I l??p\",\n\"Dr??ktig\",\n\"Mellan tv?? l??p\"]\n', 2, 4, 137, 'Juver'),
(140, 'Nyligen opererad i omr??det', '[\"Nej\",\r\n\"Ja\"]\r\n', 3, 4, 137, 'Juver'),
(141, 'Hur m??nga juverdelar ??r p??verkade', '[\"1\",\r\n\"2\",\r\n\"3\",\r\n\"4\",\r\n\"5\",\r\n\"P??verkan p?? alla delar p?? en/b??da sidor\"]\r\n', 4, 4, 137, 'Juver'),
(142, 'Typ av f??r??ndring', '[\"Kn??l/-ar\",\r\n\"Rodnad\",\r\n\"Rodnad och svullnad\",\r\n\"Svullnad\"]\r\n', 5, 4, 137, 'Juver'),
(143, 'Sm??rta', '[\"Nej\",\r\n\"Ja\"]\r\n', 6, 4, 137, 'Juver'),
(144, 'Feber', '[\"Nej\",\r\n\"Ja\"]\r\n', 7, 4, 137, 'Juver'),
(145, 'Allm??ntillst??nd', '[\"??r som vanligt\",\r\n\"Lite orolig\",\r\n\"Tr??ttare ??n vanligt\",\r\n\"Mycket allm??np??verkad\"]\r\n', 1, 4, 137, 'Vulva-Livmoder'),
(146, 'Hormonell status', '[\"Lakterande\",\n\"Skendr??ktig\",\n\"I l??p\",\n\"Dr??ktig\",\n\"Mellan tv?? l??p\"]\n', 2, 4, 137, 'Vulva-Livmoder'),
(147, 'Flytning', '[\"Nej\",\r\n\"Ja\"]\r\n', 3, 4, 137, 'Vulva-Livmoder'),
(148, 'Typ av flytning', '[\"Blodig\",\r\n\"Brungrumlig/flockig\",\r\n\"Klar\",\r\n\"Gul, tr??gflytande\"]\r\n', 1, 5, 147, 'Ja'),
(149, 'Framv??llande massa', '[\"Nej\",\r\n\"Ja\"]\r\n', 4, 4, 137, 'Vulva-Livmoder'),
(150, 'Nyligen opererad i omr??det (vulva/livmoder)', '[\"Nej\",\r\n\"Ja\"]\r\n', 5, 4, 137, 'Vulva-Livmoder'),
(151, 'Aptit', '[\"Normal\",\r\n\"??kad\",\r\n\"S??nkt\",\r\n\"Saknas\"]\r\n', 6, 4, 137, 'Vulva-Livmoder'),
(152, 'T??rst', '[\"Normal\",\r\n\"??kad\",\r\n\"S??nkt\"]\r\n', 7, 4, 137, 'Vulva-Livmoder'),
(153, 'Urinering', '[\"Normal\",\r\n\"??kad\",\r\n\"Sm??skv??tter\"]\r\n', 8, 4, 137, 'Vulva-Livmoder'),
(154, 'Kr??kning', '[\"Nej\",\r\n\"Ja\"]\r\n', 9, 4, 137, 'Vulva-Livmoder'),
(155, 'Diarr??', '[\"Nej\",\r\n\"Ja\"]\r\n', 10, 4, 137, 'Vulva-Livmoder');

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
