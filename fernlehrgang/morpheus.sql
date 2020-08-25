-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 18. Februar 2016 um 11:28
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `morpheus`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `navid` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `edit` int(1) NOT NULL DEFAULT '1',
  `img1` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `img2` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `img3` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `layout` int(1) NOT NULL DEFAULT '1',
  `img4` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `vid` int(11) NOT NULL,
  `vorlage` int(1) NOT NULL,
  `vorl_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pos` int(11) NOT NULL DEFAULT '1',
  `img0` int(11) DEFAULT NULL,
  `img5` int(11) NOT NULL DEFAULT '0',
  `img6` int(11) NOT NULL DEFAULT '0',
  `tid` int(11) NOT NULL DEFAULT '1',
  `ton` int(1) NOT NULL DEFAULT '1',
  `tpos` int(11) NOT NULL,
  `tlink` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tbackground` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `timage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `theadl` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `theight` int(11) NOT NULL,
  `twidth` int(11) NOT NULL,
  `tcolor` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tref` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `content`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `content_history`
--

CREATE TABLE IF NOT EXISTS `content_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `navid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `vorlage` int(1) NOT NULL,
  `vorl_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `edit` int(1) NOT NULL DEFAULT '1',
  `pos` int(11) NOT NULL DEFAULT '1',
  `img0` int(11) DEFAULT NULL,
  `img1` int(11) DEFAULT NULL,
  `img2` int(11) DEFAULT NULL,
  `img3` int(11) DEFAULT NULL,
  `layout` int(1) NOT NULL DEFAULT '1',
  `img4` int(11) NOT NULL DEFAULT '0',
  `img5` int(11) NOT NULL DEFAULT '0',
  `img6` int(11) NOT NULL DEFAULT '0',
  `tid` int(11) NOT NULL,
  `ton` int(1) NOT NULL DEFAULT '1',
  `tpos` int(11) NOT NULL,
  `tlink` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tbackground` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `theadl` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `theight` int(11) NOT NULL,
  `twidth` int(11) NOT NULL,
  `tcolor` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `tref` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `content_history`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `delete`
--

CREATE TABLE IF NOT EXISTS `delete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `query` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `delete`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `form`
--

CREATE TABLE IF NOT EXISTS `form` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `inpnm` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `edit` int(1) NOT NULL DEFAULT '1',
  `fform` text COLLATE latin1_general_ci NOT NULL,
  `fval` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `post` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `betreff` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `antwort` text COLLATE latin1_general_ci NOT NULL,
  `extended` int(1) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `form`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `form_auswertung`
--

CREATE TABLE IF NOT EXISTS `form_auswertung` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `vorname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wahrnehmung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arbeiter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `beruf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newsletter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wahrnehmungX` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wohnort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newsletter_topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `malsehen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `come` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ggggg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anrede` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Nachname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plz` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `strasse_firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plz_firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ort_firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fon_firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teilnahme1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teilnahme2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `form_auswertung`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `form_field`
--

CREATE TABLE IF NOT EXISTS `form_field` (
  `ffid` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `art` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `feld` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hilfe` text COLLATE utf8_unicode_ci NOT NULL,
  `spalte` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `reihenfolge` int(11) NOT NULL,
  `pflicht` int(1) NOT NULL,
  `email` int(1) NOT NULL,
  `auswahl` text COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `parent` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fehler` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `klasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cont` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fmin` int(11) NOT NULL,
  `fmax` int(11) NOT NULL,
  PRIMARY KEY (`ffid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `form_field`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `galerie`
--

CREATE TABLE IF NOT EXISTS `galerie` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tn` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gnid` int(11) NOT NULL DEFAULT '0',
  `gtextde` text COLLATE latin1_general_ci NOT NULL,
  `gtexten` text COLLATE latin1_general_ci NOT NULL,
  `gpix` varchar(12) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gsize` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '1',
  `gdatum` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `galerie`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `galerie_group`
--

CREATE TABLE IF NOT EXISTS `galerie_group` (
  `ggid` int(11) NOT NULL AUTO_INCREMENT,
  `ggname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sort` int(11) DEFAULT NULL,
  `gglink` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sichtbar` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ggid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `galerie_group`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `galerie_name`
--

CREATE TABLE IF NOT EXISTS `galerie_name` (
  `gnid` int(11) NOT NULL AUTO_INCREMENT,
  `gnname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ggid` int(11) NOT NULL DEFAULT '0',
  `img` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `textde` text COLLATE latin1_general_ci NOT NULL,
  `texten` text COLLATE latin1_general_ci NOT NULL,
  `gntextde` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gntexten` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `besucher` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `sichtbar` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gnid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `galerie_name`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `imgid` int(11) NOT NULL AUTO_INCREMENT,
  `navid` int(11) NOT NULL DEFAULT '0',
  `pos` int(11) NOT NULL DEFAULT '0',
  `image` longblob NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `size` int(11) NOT NULL DEFAULT '0',
  `imgname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gid` int(11) NOT NULL DEFAULT '0',
  `edit` int(1) NOT NULL DEFAULT '1',
  `itext` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `longtext` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`imgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `image`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `img_group`
--

CREATE TABLE IF NOT EXISTS `img_group` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `art` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `img_group`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_color`
--

CREATE TABLE IF NOT EXISTS `morp_color` (
  `colid` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(7) NOT NULL,
  `colname` varchar(20) NOT NULL,
  PRIMARY KEY (`colid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `morp_color`
--

INSERT INTO `morp_color` (`colid`, `color`, `colname`) VALUES
(1, '8e8a89', 'hellgrau'),
(2, 'a62116', 'Rot'),
(3, 'e59a00', 'orange'),
(4, '2be500', 'green');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_customer`
--

CREATE TABLE IF NOT EXISTS `morp_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `name` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `usr` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pwd` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_customer`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_download`
--

CREATE TABLE IF NOT EXISTS `morp_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer` int(11) DEFAULT NULL,
  `datei` char(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `onceagain` tinyint(4) NOT NULL DEFAULT '0',
  `angelegt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_download`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_download_historie`
--

CREATE TABLE IF NOT EXISTS `morp_download_historie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mdid` int(11) NOT NULL DEFAULT '0',
  `dldate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_download_historie`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_email`
--

CREATE TABLE IF NOT EXISTS `morp_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `betreff` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `mail` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `datum` varchar(20) COLLATE latin1_german2_ci NOT NULL,
  `text` text COLLATE latin1_german2_ci NOT NULL,
  `to` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_email`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_fa`
--

CREATE TABLE IF NOT EXISTS `morp_fa` (
  `faid` int(11) NOT NULL AUTO_INCREMENT,
  `fa` varchar(20) NOT NULL,
  `beschreibung` varchar(100) NOT NULL,
  PRIMARY KEY (`faid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=345 ;

--
-- Daten für Tabelle `morp_fa`
--

INSERT INTO `morp_fa` (`faid`, `fa`, `beschreibung`) VALUES
(1, 'fa-clock-o', '_ Uhr'),
(2, 'fa-star', '_ stern'),
(3, 'fa-cutlery', 'messer gabel'),
(4, 'fa-camera', '_ camera'),
(5, 'fa-camera-retro', '_ camera-retro'),
(6, 'fa-desktop', 'bildschirm'),
(7, 'fa-adjust', 'adjust'),
(8, 'fa-anchor', 'anchor'),
(9, 'fa-archive', 'archive'),
(10, 'fa-area-chart', 'area-chart'),
(11, 'fa-arrows', 'arrows'),
(12, 'fa-arrows-h', 'arrows-h'),
(13, 'fa-arrows-v', 'arrows-v'),
(14, 'fa-asterisk', 'asterisk'),
(15, 'fa-at', 'at'),
(16, 'fa-automobile', 'automobile'),
(17, 'fa-ban', 'ban'),
(18, 'fa-bank', 'bank'),
(19, 'fa-bar-chart', 'bar-chart'),
(20, 'fa-bar-chart-o', 'bar-chart-o'),
(21, 'fa-barcode', 'barcode'),
(22, 'fa-bars', 'bars'),
(23, 'fa-bed', 'bed'),
(24, 'fa-beer', 'beer'),
(25, 'fa-bell', 'bell'),
(26, 'fa-bell-o', 'bell-o'),
(27, 'fa-bell-slash', 'bell-slash'),
(28, 'fa-bell-slash-o', 'bell-slash-o'),
(29, 'fa-bicycle', 'bicycle'),
(30, 'fa-binoculars', 'binoculars'),
(31, 'fa-birthday-cake', 'birthday-cake'),
(32, 'fa-bolt', 'bolt'),
(33, 'fa-bomb', 'bomb'),
(34, 'fa-book', 'book'),
(35, 'fa-bookmark', 'bookmark'),
(36, 'fa-bookmark-o', 'bookmark-o'),
(37, 'fa-briefcase', 'briefcase'),
(38, 'fa-bug', 'bug'),
(39, 'fa-building', 'building'),
(40, 'fa-building-o', 'building-o'),
(41, 'fa-bullhorn', 'bullhorn'),
(42, 'fa-bullseye', 'bullseye'),
(43, 'fa-bus', 'bus'),
(44, 'fa-cab', 'cab'),
(45, 'fa-calculator', 'calculator'),
(46, 'fa-calendar', ' felix calendar'),
(47, 'fa-calendar-o', 'calendar-o'),
(48, 'fa-camera', 'camera'),
(49, 'fa-camera-retro', 'camera-retro'),
(50, 'fa-car', 'car'),
(54, 'fa-caret-square-o-up', 'caret-square-o-up'),
(55, 'fa-cart-arrow-down', 'cart-arrow-down'),
(56, 'fa-cart-plus', 'cart-plus'),
(57, 'fa-cc', 'cc'),
(58, 'fa-certificate', 'certificate'),
(59, 'fa-check', 'check'),
(60, 'fa-check-circle', 'check-circle'),
(61, 'fa-check-circle-o', 'check-circle-o'),
(62, 'fa-check-square', 'check-square'),
(63, 'fa-check-square-o', 'check'),
(64, 'fa-child', 'child'),
(65, 'fa-circle', 'circle'),
(66, 'fa-circle-o', 'circle-o'),
(67, 'fa-circle-o-notch', 'circle-o-notch'),
(68, 'fa-circle-thin', 'circle-thin'),
(69, 'fa-clock-o', 'clock-o'),
(70, 'fa-close', 'close'),
(71, 'fa-cloud', 'cloud'),
(72, 'fa-cloud-download', 'cloud-download'),
(73, 'fa-cloud-upload', 'cloud-upload'),
(74, 'fa-code', 'code'),
(75, 'fa-code-fork', 'code-fork'),
(76, 'fa-coffee', 'coffee'),
(77, 'fa-cog', 'cog'),
(78, 'fa-cogs', 'cogs'),
(79, 'fa-comment', ' felix sprechblase'),
(80, 'fa-comment-o', 'comment-o'),
(81, 'fa-comments', 'comments'),
(82, 'fa-comments-o', 'comments-o'),
(83, 'fa-compass', 'compass'),
(84, 'fa-copyright', 'copyright'),
(85, 'fa-credit-card', 'credit-card'),
(86, 'fa-crop', 'crop'),
(87, 'fa-crosshairs', 'crosshairs'),
(88, 'fa-cube', 'cube'),
(89, 'fa-cubes', 'cubes'),
(90, 'fa-cutlery', 'cutlery'),
(91, 'fa-dashboard', 'dashboard'),
(92, 'fa-database', 'database'),
(93, 'fa-desktop', 'desktop'),
(94, 'fa-diamond', 'diamond'),
(95, 'fa-dot-circle-o', 'dot-circle-o'),
(96, 'fa-download', 'download'),
(97, 'fa-edit', 'edit'),
(98, 'fa-ellipsis-h', 'ellipsis-h'),
(99, 'fa-ellipsis-v', 'ellipsis-v'),
(100, 'fa-envelope', 'envelope'),
(101, 'fa-envelope-o', 'envelope-o'),
(102, 'fa-envelope-square', 'envelope-square'),
(103, 'fa-eraser', 'eraser'),
(104, 'fa-exchange', 'exchange'),
(105, 'fa-exclamation', 'exclamation'),
(339, 'fa-twitter', ' twitter'),
(108, 'fa-external-link', 'external-link'),
(110, 'fa-eye', 'eye'),
(111, 'fa-eye-slash', 'eye-slash'),
(112, 'fa-eyedropper', 'eyedropper'),
(113, 'fa-fax', 'fax'),
(114, 'fa-female', 'female'),
(115, 'fa-fighter-jet', 'fighter-jet'),
(116, 'fa-file-archive-o', 'file-archive-o'),
(117, 'fa-file-audio-o', 'file-audio-o'),
(118, 'fa-file-code-o', 'file-code-o'),
(119, 'fa-file-excel-o', 'file-excel-o'),
(120, 'fa-file-image-o', 'file-image-o'),
(121, 'fa-file-movie-o', 'file-movie-o'),
(122, 'fa-file-pdf-o', 'file-pdf-o'),
(123, 'fa-file-photo-o', 'file-photo-o'),
(124, 'fa-file-picture-o', 'file-picture-o'),
(125, 'fa-file-powerpoint-o', 'file-powerpoint-o'),
(126, 'fa-file-sound-o', 'file-sound-o'),
(127, 'fa-file-video-o', 'file-video-o'),
(128, 'fa-file-word-o', 'file-word-o'),
(129, 'fa-file-zip-o', 'file-zip-o'),
(130, 'fa-film', 'film'),
(131, 'fa-filter', 'filter'),
(132, 'fa-fire', 'fire'),
(133, 'fa-fire-extinguisher', 'fire-extinguisher'),
(134, 'fa-flag', 'flag'),
(135, 'fa-flag-checkered', 'flag-checkered'),
(136, 'fa-flag-o', 'flag-o'),
(137, 'fa-flash', 'flash'),
(138, 'fa-flask', 'flask'),
(139, 'fa-folder', 'folder'),
(140, 'fa-folder-o', 'folder-o'),
(141, 'fa-folder-open', 'folder-open'),
(142, 'fa-folder-open-o', 'folder-open-o'),
(143, 'fa-frown-o', 'frown-o'),
(144, 'fa-futbol-o', 'futbol-o'),
(145, 'fa-gamepad', 'gamepad'),
(146, 'fa-gavel', 'gavel'),
(147, 'fa-gear', 'gear'),
(148, 'fa-gears', 'gears'),
(149, 'fa-genderless', 'genderless'),
(150, 'fa-gift', 'gift'),
(151, 'fa-glass', 'glass'),
(152, 'fa-globe', 'globe'),
(153, 'fa-graduation-cap', 'graduation-cap'),
(154, 'fa-group', 'group'),
(155, 'fa-hdd-o', 'hdd-o'),
(156, 'fa-headphones', 'headphones'),
(157, 'fa-heart', ' heart'),
(158, 'fa-heart-o', 'heart-o'),
(159, 'fa-heartbeat', 'heartbeat'),
(160, 'fa-history', 'history'),
(161, 'fa-home', 'home'),
(162, 'fa-hotel', 'hotel'),
(163, 'fa-image', 'image'),
(164, 'fa-inbox', 'inbox'),
(165, 'fa-info', 'info'),
(166, 'fa-info-circle', 'info-circle'),
(167, 'fa-institution', 'institution'),
(168, 'fa-key', 'key'),
(169, 'fa-keyboard-o', 'keyboard-o'),
(170, 'fa-language', 'language'),
(171, 'fa-laptop', 'laptop'),
(172, 'fa-leaf', 'Blatt'),
(173, 'fa-legal', 'legal'),
(174, 'fa-lemon-o', 'lemon-o'),
(175, 'fa-level-down', 'level-down'),
(176, 'fa-level-up', 'level-up'),
(177, 'fa-life-bouy', 'life-bouy'),
(178, 'fa-life-buoy', 'life-buoy'),
(179, 'fa-life-ring', 'life-ring'),
(180, 'fa-life-saver', 'life-saver'),
(181, 'fa-lightbulb-o', 'lightbulb-o'),
(182, 'fa-line-chart', 'line-chart'),
(183, 'fa-location-arrow', 'location-arrow'),
(184, 'fa-lock', 'lock'),
(185, 'fa-magic', 'magic'),
(186, 'fa-magnet', 'magnet'),
(187, 'fa-mail-forward', 'mail-forward'),
(188, 'fa-mail-reply', 'mail-reply'),
(189, 'fa-mail-reply-all', 'mail-reply-all'),
(190, 'fa-male', 'male'),
(191, 'fa-map-marker', 'map-marker'),
(192, 'fa-meh-o', 'meh-o'),
(193, 'fa-microphone', 'microphone'),
(194, 'fa-microphone-slash', 'microphone-slash'),
(195, 'fa-minus', 'minus'),
(196, 'fa-minus-circle', 'minus-circle'),
(197, 'fa-minus-square', 'minus-square'),
(198, 'fa-minus-square-o', 'minus-square-o'),
(199, 'fa-mobile', 'mobile'),
(200, 'fa-mobile-phone', 'mobile-phone'),
(201, 'fa-money', 'money'),
(202, 'fa-moon-o', 'moon-o'),
(203, 'fa-mortar-board', 'mortar-board'),
(204, 'fa-motorcycle', 'motorcycle'),
(205, 'fa-music', 'music'),
(206, 'fa-navicon', 'navicon'),
(207, 'fa-newspaper-o', ' felix newspaper-o'),
(208, 'fa-paint-brush', 'paint-brush'),
(209, 'fa-paper-plane', 'paper-plane'),
(210, 'fa-paper-plane-o', 'felix paper-plane-o'),
(211, 'fa-paw', 'paw'),
(212, 'fa-pencil', 'pencil'),
(213, 'fa-pencil-square', 'pencil-square'),
(214, 'fa-pencil-square-o', 'pencil-square-o'),
(215, 'fa-phone', 'phone'),
(216, 'fa-phone-square', 'phone-square'),
(217, 'fa-photo', 'photo'),
(218, 'fa-picture-o', 'picture-o'),
(219, 'fa-pie-chart', 'pie-chart'),
(220, 'fa-plane', 'plane'),
(221, 'fa-plug', 'plug'),
(222, 'fa-plus', 'plus'),
(223, 'fa-plus-circle', 'plus-circle'),
(224, 'fa-plus-square', 'plus-square'),
(225, 'fa-plus-square-o', 'plus-square-o'),
(226, 'fa-power-off', 'power-off'),
(227, 'fa-print', 'print'),
(228, 'fa-puzzle-piece', 'puzzle-piece'),
(229, 'fa-qrcode', 'qrcode'),
(230, 'fa-question', 'question'),
(231, 'fa-question-circle', 'question-circle'),
(232, 'fa-quote-left', 'quote-left'),
(233, 'fa-quote-right', 'quote-right'),
(234, 'fa-random', 'random'),
(235, 'fa-recycle', 'recycle'),
(236, 'fa-refresh', 'refresh'),
(237, 'fa-remove', 'remove'),
(238, 'fa-reorder', 'reorder'),
(239, 'fa-reply', 'reply'),
(240, 'fa-reply-all', 'reply-all'),
(241, 'fa-retweet', 'retweet'),
(242, 'fa-road', 'road'),
(243, 'fa-rocket', 'rocket'),
(244, 'fa-rss', ' rss'),
(245, 'fa-rss-square', 'rss-square'),
(246, 'fa-search', 'search'),
(247, 'fa-search-minus', 'search-minus'),
(248, 'fa-search-plus', 'search-plus'),
(249, 'fa-send', 'send'),
(250, 'fa-send-o', 'send-o'),
(251, 'fa-server', 'server'),
(252, 'fa-share', 'share'),
(253, 'fa-share-alt', 'share-alt'),
(254, 'fa-share-alt-square', 'share-alt-square'),
(255, 'fa-share-square', 'share-square'),
(256, 'fa-share-square-o', 'share-square-o'),
(257, 'fa-shield', 'shield'),
(258, 'fa-ship', 'ship'),
(259, 'fa-shopping-cart', 'shopping-cart'),
(260, 'fa-sign-in', 'sign-in'),
(261, 'fa-sign-out', 'sign-out'),
(262, 'fa-signal', 'signal'),
(263, 'fa-sitemap', 'sitemap'),
(264, 'fa-sliders', 'sliders'),
(265, 'fa-smile-o', 'smile-o'),
(266, 'fa-soccer-ball-o', 'soccer-ball-o'),
(267, 'fa-sort', 'sort'),
(268, 'fa-sort-alpha-asc', 'sort-alpha-asc'),
(269, 'fa-sort-alpha-desc', 'sort-alpha-desc'),
(270, 'fa-sort-amount-asc', 'sort-amount-asc'),
(271, 'fa-sort-amount-desc', 'sort-amount-desc'),
(272, 'fa-sort-asc', 'sort-asc'),
(273, 'fa-sort-desc', 'sort-desc'),
(274, 'fa-sort-down', 'sort-down'),
(275, 'fa-sort-numeric-asc', 'sort-numeric-asc'),
(276, 'fa-sort-numeric-desc', 'sort-numeric-desc'),
(277, 'fa-sort-up', 'sort-up'),
(278, 'fa-space-shuttle', 'space-shuttle'),
(279, 'fa-spinner', 'spinner'),
(280, 'fa-spoon', 'spoon'),
(281, 'fa-square', 'square'),
(282, 'fa-square-o', 'square-o'),
(283, 'fa-star', ' stern'),
(284, 'fa-star-half', 'star-half'),
(285, 'fa-star-half-empty', 'star-half-empty'),
(286, 'fa-star-half-full', 'star-half-full'),
(287, 'fa-star-half-o', 'star-half-o'),
(288, 'fa-star-o', 'star-o'),
(289, 'fa-street-view', 'street-view'),
(290, 'fa-suitcase', 'suitcase'),
(291, 'fa-support', 'support'),
(292, 'fa-tachometer', 'tachometer'),
(293, 'fa-tag', 'tag'),
(294, 'fa-tags', 'tags'),
(295, 'fa-tasks', 'tasks'),
(296, 'fa-taxi', 'taxi'),
(297, 'fa-terminal', 'terminal'),
(298, 'fa-thumb-tack', 'thumb-tack'),
(299, 'fa-thumbs-down', 'thumbs-down'),
(300, 'fa-thumbs-o-down', 'thumbs-o-down'),
(301, 'fa-thumbs-o-up', 'thumbs-o-up'),
(302, 'fa-thumbs-up', 'Finger up'),
(303, 'fa-ticket', 'ticket'),
(304, 'fa-times', 'times'),
(305, 'fa-times-circle', 'times-circle'),
(306, 'fa-times-circle-o', 'times-circle-o'),
(307, 'fa-tint', 'tint'),
(308, 'fa-toggle-down', 'toggle-down'),
(309, 'fa-toggle-left', 'toggle-left'),
(310, 'fa-toggle-off', 'toggle-off'),
(311, 'fa-toggle-on', 'toggle-on'),
(312, 'fa-toggle-right', 'toggle-right'),
(313, 'fa-toggle-up', 'toggle-up'),
(314, 'fa-trash', 'trash'),
(315, 'fa-trash-o', 'trash-o'),
(316, 'fa-tree', 'tree'),
(317, 'fa-trophy', 'trophy'),
(318, 'fa-truck', 'truck'),
(319, 'fa-tty', 'tty'),
(320, 'fa-umbrella', 'umbrella'),
(321, 'fa-university', 'university'),
(322, 'fa-unlock', 'unlock'),
(323, 'fa-unlock-alt', 'unlock-alt'),
(324, 'fa-unsorted', 'unsorted'),
(325, 'fa-upload', 'upload'),
(326, 'fa-user', 'user'),
(327, 'fa-user-plus', 'user-plus'),
(328, 'fa-user-secret', 'user-secret'),
(329, 'fa-user-times', 'user-times'),
(330, 'fa-users', ' User'),
(331, 'fa-video-camera', 'video-camera'),
(332, 'fa-volume-down', 'volume-down'),
(333, 'fa-volume-off', 'volume-off'),
(334, 'fa-volume-up', 'volume-up'),
(335, 'fa-warning', 'warning'),
(336, 'fa-wheelchair', 'wheelchair'),
(337, 'fa-wifi', 'wifi'),
(338, 'fa-wrench', 'wrench'),
(341, 'fa-xing', ' xing'),
(342, ' fa-xing-square', ' xing 2'),
(344, 'fa-facebook', ' facebook');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_intern`
--

CREATE TABLE IF NOT EXISTS `morp_intern` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `muser` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `mpw` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `mberechtigung` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_intern`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_kurse`
--

CREATE TABLE IF NOT EXISTS `morp_kurse` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tid` int(11) NOT NULL,
  `beschreibung` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `colid` int(11) NOT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `morp_kurse`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_kursplan`
--

CREATE TABLE IF NOT EXISTS `morp_kursplan` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `tag` int(11) NOT NULL,
  `von` varchar(5) NOT NULL,
  `bis` varchar(5) NOT NULL,
  `gesamt` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `raum` varchar(20) NOT NULL,
  `anzeige1` varchar(20) NOT NULL,
  `anzeige2` varchar(20) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Daten für Tabelle `morp_kursplan`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_mitarbeiter`
--

CREATE TABLE IF NOT EXISTS `morp_mitarbeiter` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `vorname` varchar(100) NOT NULL,
  `anrede` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fon` varchar(20) NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `img3` varchar(100) NOT NULL,
  `reihenfolge` int(11) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_mitarbeiter`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_sprachdatei`
--

CREATE TABLE IF NOT EXISTS `morp_sprachdatei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `de` text NOT NULL,
  `en` text NOT NULL,
  `fr` text NOT NULL,
  `bez` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_sprachdatei`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_stimmen`
--

CREATE TABLE IF NOT EXISTS `morp_stimmen` (
  `stid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `beruf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `text` text COLLATE latin1_general_ci NOT NULL,
  `img1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `textkurz` text COLLATE latin1_general_ci NOT NULL,
  `reihenfolge` int(11) NOT NULL,
  PRIMARY KEY (`stid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_stimmen`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_suche_count`
--

CREATE TABLE IF NOT EXISTS `morp_suche_count` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(11) NOT NULL DEFAULT '0',
  `navid` int(11) NOT NULL DEFAULT '0',
  `anzde` int(11) NOT NULL DEFAULT '0',
  `anzen` int(11) NOT NULL DEFAULT '0',
  `art` int(1) NOT NULL DEFAULT '1',
  `stid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sid`),
  UNIQUE KEY `kid` (`kid`,`navid`,`art`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=FIXED AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_suche_count`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_suche_keyw`
--

CREATE TABLE IF NOT EXISTS `morp_suche_keyw` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `keyw` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `de` int(1) NOT NULL DEFAULT '0',
  `en` int(1) NOT NULL DEFAULT '0',
  `desc` int(1) NOT NULL DEFAULT '0',
  `title` int(1) NOT NULL DEFAULT '0',
  `wg` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`),
  UNIQUE KEY `keyword` (`keyw`),
  FULLTEXT KEY `keyw` (`keyw`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `morp_suche_keyw`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `morp_trainer`
--

CREATE TABLE IF NOT EXISTS `morp_trainer` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `morp_trainer`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nav`
--

CREATE TABLE IF NOT EXISTS `nav` (
  `navid` int(11) NOT NULL AUTO_INCREMENT,
  `ebene` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sichtbar` int(1) NOT NULL DEFAULT '1',
  `edit` int(1) NOT NULL DEFAULT '1',
  `keyw` varchar(255) CHARACTER SET utf8 NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lang` int(1) NOT NULL DEFAULT '1',
  `lock` int(1) NOT NULL DEFAULT '0',
  `bereich` int(1) NOT NULL DEFAULT '1',
  `button` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lnk` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emotional` int(11) NOT NULL,
  `design` int(11) NOT NULL,
  `oldlnk` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `anker` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`navid`),
  UNIQUE KEY `navid` (`ebene`,`navid`,`parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `nav`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `ntitle` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ntext` text COLLATE latin1_general_ci NOT NULL,
  `nvon` date NOT NULL DEFAULT '0000-00-00',
  `nbis` date NOT NULL DEFAULT '0000-00-00',
  `nerstellt` date NOT NULL DEFAULT '0000-00-00',
  `edit` int(1) NOT NULL DEFAULT '1',
  `aktuell` int(1) NOT NULL DEFAULT '1',
  `nabstr` text COLLATE latin1_general_ci NOT NULL,
  `nautor` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `imgid` int(11) NOT NULL DEFAULT '0',
  `nlink` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ngid` int(11) NOT NULL DEFAULT '1',
  `nsubtitle` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `style` int(1) NOT NULL DEFAULT '1',
  `img1` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `img2` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `img3` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `img4` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `hid` int(11) NOT NULL,
  `sichtbar` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `news`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `nlid` int(11) NOT NULL AUTO_INCREMENT,
  `nlname` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nlsubj` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nlmail` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nldatum` date NOT NULL DEFAULT '0000-00-00',
  `text` text COLLATE latin1_general_ci NOT NULL,
  `nlimg1` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nlimg2` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `edit` int(1) NOT NULL DEFAULT '1',
  `layout` int(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `nlid` (`nlid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `newsletter`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_group`
--

CREATE TABLE IF NOT EXISTS `news_group` (
  `ngid` int(11) NOT NULL AUTO_INCREMENT,
  `ngname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `edit` int(1) NOT NULL DEFAULT '1',
  `format` int(1) NOT NULL DEFAULT '1',
  `nlang` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ngid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `news_group`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nl_verteiler`
--

CREATE TABLE IF NOT EXISTS `nl_verteiler` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `vname` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `vemail` text COLLATE latin1_general_ci NOT NULL,
  UNIQUE KEY `vid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `nl_verteiler`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pdf`
--

CREATE TABLE IF NOT EXISTS `pdf` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pdesc` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `psize` int(11) NOT NULL DEFAULT '0',
  `pdate` date NOT NULL DEFAULT '0000-00-00',
  `pgid` int(11) NOT NULL DEFAULT '1',
  `edit` int(1) NOT NULL DEFAULT '0',
  `pimage` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `pstart` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `pend` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `pdf`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pdf_group`
--

CREATE TABLE IF NOT EXISTS `pdf_group` (
  `pgid` int(11) NOT NULL AUTO_INCREMENT,
  `pgname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL,
  `pgart` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pgid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `pdf_group`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pfad`
--

CREATE TABLE IF NOT EXISTS `pfad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `navid` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `page` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `wg` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `pfad`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabelle`
--

CREATE TABLE IF NOT EXISTS `tabelle` (
  `tabid` int(11) NOT NULL AUTO_INCREMENT,
  `tabtext` text COLLATE latin1_general_ci NOT NULL,
  `spalte` int(11) NOT NULL DEFAULT '0',
  `reihe` int(11) NOT NULL DEFAULT '0',
  `edit` int(1) NOT NULL DEFAULT '1',
  `cid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tabid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `tabelle`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE latin1_general_ci NOT NULL,
  `edit` int(1) NOT NULL DEFAULT '1',
  `tname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `layout` int(1) NOT NULL DEFAULT '1',
  `tlang` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tid`),
  UNIQUE KEY `tname` (`tname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `template`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pw` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `berechtigung` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `uname`, `pw`, `berechtigung`, `admin`) VALUES
(1, 'morpheus', 'db04cce4e9bafc1aaabbb7ceb7b5a2c5', '1', 1),
(2, 'vu', '81dc9bdb52d04dc20036dbd8313ed055', '1', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `z_protokoll`
--

CREATE TABLE IF NOT EXISTS `z_protokoll` (
  `prid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `db` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT '0',
  `datum` date NOT NULL DEFAULT '0000-00-00',
  `art` varchar(6) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`prid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `z_protokoll`
--

