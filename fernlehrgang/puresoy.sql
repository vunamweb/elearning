-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 25, 2020 lúc 04:52 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `puresoy`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `6_color`
--

DROP TABLE IF EXISTS `6_color`;
CREATE TABLE `6_color` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `6_color`
--

INSERT INTO `6_color` (`id`, `id_pdf`, `value`) VALUES
(2, 49, 'e0cf5d'),
(6, 60, 'e0cf5d'),
(7, 61, 'dca051'),
(8, 62, 'e0cf5d'),
(9, 63, 'e0cf5d'),
(10, 64, 'e0cf5d'),
(11, 65, 'e0cf5d'),
(12, 66, 'e0cf5d'),
(13, 67, '4670ba'),
(14, 68, 'dca051'),
(15, 69, 'dca051'),
(16, 70, 'e0cf5d'),
(17, 71, 'e0cf5d'),
(18, 72, 'e0cf5d'),
(19, 73, 'e0cf5d'),
(20, 74, 'e0cf5d'),
(21, 75, 'e0cf5d'),
(22, 76, 'e0cf5d'),
(23, 77, 'e0cf5d'),
(24, 78, 'e0cf5d'),
(25, 79, 'e0cf5d'),
(26, 80, 'e0cf5d'),
(27, 81, 'e0cf5d'),
(28, 82, 'e0cf5d'),
(29, 83, 'e0cf5d'),
(30, 84, 'e0cf5d'),
(41, 94, '8272b4'),
(32, 86, 'dca051'),
(33, 87, 'dca051'),
(34, 88, 'dca051'),
(35, 89, 'dca051'),
(36, 90, 'dca051'),
(42, 96, '92b76d');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `checkbox`
--

DROP TABLE IF EXISTS `checkbox`;
CREATE TABLE `checkbox` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `title_english` varchar(150) NOT NULL,
  `format_page` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `checkbox`
--

INSERT INTO `checkbox` (`id`, `title`, `title_english`, `format_page`) VALUES
(4, 'Roggen', 'rogen_english', 1),
(3, 'Weizen', '', 1),
(5, 'Gerste', '', 1),
(6, 'Hafer', '', 1),
(7, 'Dinkel', '', 1),
(8, 'Kamut', '', 1),
(9, 'Gluten', '', 1),
(10, 'Krebstiere', '', 1),
(11, 'Ei', '', 1),
(12, 'Fische', '', 1),
(13, 'Erdnüsse', '', 1),
(14, 'Soja', '', 1),
(15, 'Milch', '', 1),
(16, 'Mandeln', '', 1),
(17, 'Haselnüsse', '', 1),
(18, 'Walnüsse', '', 1),
(19, 'Kaschunüsse', '', 1),
(20, 'Pekannüsse', '', 1),
(21, 'Paranüsse', '', 1),
(22, 'Pistazien', '', 1),
(23, 'Makadamianüsse/Queenslandnüsse', '', 1),
(24, 'Nüsse (Schalenfrüchte)', '', 1),
(25, 'Sellerie', '', 1),
(26, 'Senf', '', 1),
(27, 'Sesamsamen', '', 1),
(28, 'Schwefeldioxid und Sulfite (E220-E228) in Konzentration von >10mg/kg bzw. 10ml/l, ausgedrückt als SO', '', 1),
(29, 'Lupinen', '', 1),
(30, 'Weichtiere', '', 1),
(31, 'Laktose', '', 2),
(32, 'Kakao', '', 2),
(33, 'Glutamat (E620-E625)', '', 2),
(34, 'Huhn', '', 2),
(35, 'Koriander', '', 2),
(36, 'Mais', '', 2),
(37, 'Hülsenfrüchte', '', 2),
(38, 'Rindfleisch', '', 2),
(39, 'Schweinefleisch', '', 2),
(41, 'Karotten', '', 2),
(44, 'test_ger', 'test_en', 1),
(45, 'test1', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `checkbox_english`
--

DROP TABLE IF EXISTS `checkbox_english`;
CREATE TABLE `checkbox_english` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `checkbox_english`
--

INSERT INTO `checkbox_english` (`id`, `title`) VALUES
(1, 'Egg'),
(2, 'Milk (inc. Lactose)'),
(3, 'Wheate'),
(4, 'Gluten (inc. Wheatmrye, baeley, oats, triticale, spelt, or kamut)'),
(5, 'Fish'),
(6, 'Crustacean Shellfish (inc. Molluscs)'),
(7, 'Tree Nuts (inc. Almond, Hazelnut, Walnut, Cashew; Pecan, Brasilnut, Pistachio, Macadamia, Queensland, etc.)'),
(8, 'Peanuts (inc. Peanut oil)'),
(9, 'Buckwheat'),
(10, 'Celery or Celeriac'),
(11, 'Colors (inc. Erythr FD&C Red 3), Tartrazine (FD&C Yellow 5), Caramel , Sudan Red, etc.)'),
(12, 'Soybeans'),
(13, 'Lupin'),
(14, 'Mustard'),
(15, 'Rice'),
(16, 'Seeds and their oils (inc. Seasame, poppy, sunflower, cotton seeds, etc.)'),
(17, 'Suifur');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `cid` int(11) NOT NULL,
  `navid` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `edit` int(1) NOT NULL DEFAULT 1,
  `img1` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `img2` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `img3` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `layout` int(1) NOT NULL DEFAULT 1,
  `img4` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `vid` int(11) NOT NULL,
  `vorlage` int(1) NOT NULL,
  `vorl_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pos` int(11) NOT NULL DEFAULT 1,
  `img0` int(11) DEFAULT NULL,
  `img5` int(11) NOT NULL DEFAULT 0,
  `img6` int(11) NOT NULL DEFAULT 0,
  `tid` int(11) NOT NULL DEFAULT 1,
  `ton` int(1) NOT NULL DEFAULT 1,
  `tpos` int(11) NOT NULL,
  `tlink` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tbackground` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `timage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `theadl` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `theight` int(11) NOT NULL,
  `twidth` int(11) NOT NULL,
  `tcolor` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tref` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `content`
--

INSERT INTO `content` (`cid`, `navid`, `content`, `edit`, `img1`, `img2`, `img3`, `layout`, `img4`, `vid`, `vorlage`, `vorl_name`, `pos`, `img0`, `img5`, `img6`, `tid`, `ton`, `tpos`, `tlink`, `tbackground`, `timage`, `theadl`, `theight`, `twidth`, `tcolor`, `tref`) VALUES
(12, 6, '', 1, NULL, NULL, NULL, 1, '0', 0, 0, '', 1, NULL, 0, 0, 1, 1, 1, NULL, NULL, '', '', 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `content_history`
--

DROP TABLE IF EXISTS `content_history`;
CREATE TABLE `content_history` (
  `id` int(11) NOT NULL,
  `datum` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `navid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `vorlage` int(1) NOT NULL,
  `vorl_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `edit` int(1) NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1,
  `img0` int(11) DEFAULT NULL,
  `img1` int(11) DEFAULT NULL,
  `img2` int(11) DEFAULT NULL,
  `img3` int(11) DEFAULT NULL,
  `layout` int(1) NOT NULL DEFAULT 1,
  `img4` int(11) NOT NULL DEFAULT 0,
  `img5` int(11) NOT NULL DEFAULT 0,
  `img6` int(11) NOT NULL DEFAULT 0,
  `tid` int(11) NOT NULL,
  `ton` int(1) NOT NULL DEFAULT 1,
  `tpos` int(11) NOT NULL,
  `tlink` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tbackground` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `theadl` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `theight` int(11) NOT NULL,
  `twidth` int(11) NOT NULL,
  `tcolor` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `tref` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `iso_code_2` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT '',
  `iso_code_3` varchar(3) COLLATE utf8_bin NOT NULL DEFAULT '',
  `address_format` text COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Đang đổ dữ liệu cho bảng `country`
--

INSERT INTO `country` (`country_id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `status`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '', 1),
(2, 'Albania', 'AL', 'ALB', '', 1),
(3, 'Algeria', 'DZ', 'DZA', '', 1),
(4, 'American Samoa', 'AS', 'ASM', '', 1),
(5, 'Andorra', 'AD', 'AND', '', 1),
(6, 'Angola', 'AO', 'AGO', '', 1),
(7, 'Anguilla', 'AI', 'AIA', '', 1),
(8, 'Antarctica', 'AQ', 'ATA', '', 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '', 1),
(10, 'Argentina', 'AR', 'ARG', '', 1),
(11, 'Armenia', 'AM', 'ARM', '', 1),
(12, 'Aruba', 'AW', 'ABW', '', 1),
(13, 'Australia', 'AU', 'AUS', '', 1),
(14, 'Austria', 'AT', 'AUT', '', 1),
(15, 'Azerbaijan', 'AZ', 'AZE', '', 1),
(16, 'Bahamas', 'BS', 'BHS', '', 1),
(17, 'Bahrain', 'BH', 'BHR', '', 1),
(18, 'Bangladesh', 'BD', 'BGD', '', 1),
(19, 'Barbados', 'BB', 'BRB', '', 1),
(20, 'Belarus', 'BY', 'BLR', '', 1),
(21, 'Belgium', 'BE', 'BEL', '', 1),
(22, 'Belize', 'BZ', 'BLZ', '', 1),
(23, 'Benin', 'BJ', 'BEN', '', 1),
(24, 'Bermuda', 'BM', 'BMU', '', 1),
(25, 'Bhutan', 'BT', 'BTN', '', 1),
(26, 'Bolivia', 'BO', 'BOL', '', 1),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH', '', 1),
(28, 'Botswana', 'BW', 'BWA', '', 1),
(29, 'Bouvet Island', 'BV', 'BVT', '', 1),
(30, 'Brazil', 'BR', 'BRA', '', 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', '', 1),
(32, 'Brunei Darussalam', 'BN', 'BRN', '', 1),
(33, 'Bulgaria', 'BG', 'BGR', '', 1),
(34, 'Burkina Faso', 'BF', 'BFA', '', 1),
(35, 'Burundi', 'BI', 'BDI', '', 1),
(36, 'Cambodia', 'KH', 'KHM', '', 1),
(37, 'Cameroon', 'CM', 'CMR', '', 1),
(38, 'Canada', 'CA', 'CAN', '', 1),
(39, 'Cape Verde', 'CV', 'CPV', '', 1),
(40, 'Cayman Islands', 'KY', 'CYM', '', 1),
(41, 'Central African Republic', 'CF', 'CAF', '', 1),
(42, 'Chad', 'TD', 'TCD', '', 1),
(43, 'Chile', 'CL', 'CHL', '', 1),
(44, 'China', 'CN', 'CHN', '', 1),
(45, 'Christmas Island', 'CX', 'CXR', '', 1),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', '', 1),
(47, 'Colombia', 'CO', 'COL', '', 1),
(48, 'Comoros', 'KM', 'COM', '', 1),
(49, 'Congo', 'CG', 'COG', '', 1),
(50, 'Cook Islands', 'CK', 'COK', '', 1),
(51, 'Costa Rica', 'CR', 'CRI', '', 1),
(52, 'Cote D\'Ivoire', 'CI', 'CIV', '', 1),
(53, 'Croatia', 'HR', 'HRV', '', 1),
(54, 'Cuba', 'CU', 'CUB', '', 1),
(55, 'Cyprus', 'CY', 'CYP', '', 1),
(56, 'Czech Republic', 'CZ', 'CZE', '', 1),
(57, 'Denmark', 'DK', 'DNK', '', 1),
(58, 'Djibouti', 'DJ', 'DJI', '', 1),
(59, 'Dominica', 'DM', 'DMA', '', 1),
(60, 'Dominican Republic', 'DO', 'DOM', '', 1),
(61, 'East Timor', 'TP', 'TMP', '', 1),
(62, 'Ecuador', 'EC', 'ECU', '', 1),
(63, 'Egypt', 'EG', 'EGY', '', 1),
(64, 'El Salvador', 'SV', 'SLV', '', 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', '', 1),
(66, 'Eritrea', 'ER', 'ERI', '', 1),
(67, 'Estonia', 'EE', 'EST', '', 1),
(68, 'Ethiopia', 'ET', 'ETH', '', 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '', 1),
(70, 'Faroe Islands', 'FO', 'FRO', '', 1),
(71, 'Fiji', 'FJ', 'FJI', '', 1),
(72, 'Finland', 'FI', 'FIN', '', 1),
(73, 'France', 'FR', 'FRA', '', 1),
(74, 'France, Metropolitan', 'FX', 'FXX', '', 1),
(75, 'French Guiana', 'GF', 'GUF', '', 1),
(76, 'French Polynesia', 'PF', 'PYF', '', 1),
(77, 'French Southern Territories', 'TF', 'ATF', '', 1),
(78, 'Gabon', 'GA', 'GAB', '', 1),
(79, 'Gambia', 'GM', 'GMB', '', 1),
(80, 'Georgia', 'GE', 'GEO', '', 1),
(81, 'Germany', 'DE', 'DEU', '', 1),
(82, 'Ghana', 'GH', 'GHA', '', 1),
(83, 'Gibraltar', 'GI', 'GIB', '', 1),
(84, 'Greece', 'GR', 'GRC', '', 1),
(85, 'Greenland', 'GL', 'GRL', '', 1),
(86, 'Grenada', 'GD', 'GRD', '', 1),
(87, 'Guadeloupe', 'GP', 'GLP', '', 1),
(88, 'Guam', 'GU', 'GUM', '', 1),
(89, 'Guatemala', 'GT', 'GTM', '', 1),
(90, 'Guinea', 'GN', 'GIN', '', 1),
(91, 'Guinea-bissau', 'GW', 'GNB', '', 1),
(92, 'Guyana', 'GY', 'GUY', '', 1),
(93, 'Haiti', 'HT', 'HTI', '', 1),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', '', 1),
(95, 'Honduras', 'HN', 'HND', '', 1),
(96, 'Hong Kong', 'HK', 'HKG', '', 1),
(97, 'Hungary', 'HU', 'HUN', '', 1),
(98, 'Iceland', 'IS', 'ISL', '', 1),
(99, 'India', 'IN', 'IND', '', 1),
(100, 'Indonesia', 'ID', 'IDN', '', 1),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', '', 1),
(102, 'Iraq', 'IQ', 'IRQ', '', 1),
(103, 'Ireland', 'IE', 'IRL', '', 1),
(104, 'Israel', 'IL', 'ISR', '', 1),
(105, 'Italy', 'IT', 'ITA', '', 1),
(106, 'Jamaica', 'JM', 'JAM', '', 1),
(107, 'Japan', 'JP', 'JPN', '', 1),
(108, 'Jordan', 'JO', 'JOR', '', 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', '', 1),
(110, 'Kenya', 'KE', 'KEN', '', 1),
(111, 'Kiribati', 'KI', 'KIR', '', 1),
(112, 'North Korea', 'KP', 'PRK', '', 1),
(113, 'Korea, Republic of', 'KR', 'KOR', '', 1),
(114, 'Kuwait', 'KW', 'KWT', '', 1),
(115, 'Kyrgyzstan', 'KG', 'KGZ', '', 1),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO', '', 1),
(117, 'Latvia', 'LV', 'LVA', '', 1),
(118, 'Lebanon', 'LB', 'LBN', '', 1),
(119, 'Lesotho', 'LS', 'LSO', '', 1),
(120, 'Liberia', 'LR', 'LBR', '', 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', '', 1),
(122, 'Liechtenstein', 'LI', 'LIE', '', 1),
(123, 'Lithuania', 'LT', 'LTU', '', 1),
(124, 'Luxembourg', 'LU', 'LUX', '', 1),
(125, 'Macau', 'MO', 'MAC', '', 1),
(126, 'Macedonia', 'MK', 'MKD', '', 1),
(127, 'Madagascar', 'MG', 'MDG', '', 1),
(128, 'Malawi', 'MW', 'MWI', '', 1),
(129, 'Malaysia', 'MY', 'MYS', '', 1),
(130, 'Maldives', 'MV', 'MDV', '', 1),
(131, 'Mali', 'ML', 'MLI', '', 1),
(132, 'Malta', 'MT', 'MLT', '', 1),
(133, 'Marshall Islands', 'MH', 'MHL', '', 1),
(134, 'Martinique', 'MQ', 'MTQ', '', 1),
(135, 'Mauritania', 'MR', 'MRT', '', 1),
(136, 'Mauritius', 'MU', 'MUS', '', 1),
(137, 'Mayotte', 'YT', 'MYT', '', 1),
(138, 'Mexico', 'MX', 'MEX', '', 1),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', '', 1),
(140, 'Moldova, Republic of', 'MD', 'MDA', '', 1),
(141, 'Monaco', 'MC', 'MCO', '', 1),
(142, 'Mongolia', 'MN', 'MNG', '', 1),
(143, 'Montserrat', 'MS', 'MSR', '', 1),
(144, 'Morocco', 'MA', 'MAR', '', 1),
(145, 'Mozambique', 'MZ', 'MOZ', '', 1),
(146, 'Myanmar', 'MM', 'MMR', '', 1),
(147, 'Namibia', 'NA', 'NAM', '', 1),
(148, 'Nauru', 'NR', 'NRU', '', 1),
(149, 'Nepal', 'NP', 'NPL', '', 1),
(150, 'Netherlands', 'NL', 'NLD', '', 1),
(151, 'Netherlands Antilles', 'AN', 'ANT', '', 1),
(152, 'New Caledonia', 'NC', 'NCL', '', 1),
(153, 'New Zealand', 'NZ', 'NZL', '', 1),
(154, 'Nicaragua', 'NI', 'NIC', '', 1),
(155, 'Niger', 'NE', 'NER', '', 1),
(156, 'Nigeria', 'NG', 'NGA', '', 1),
(157, 'Niue', 'NU', 'NIU', '', 1),
(158, 'Norfolk Island', 'NF', 'NFK', '', 1),
(159, 'Northern Mariana Islands', 'MP', 'MNP', '', 1),
(160, 'Norway', 'NO', 'NOR', '', 1),
(161, 'Oman', 'OM', 'OMN', '', 1),
(162, 'Pakistan', 'PK', 'PAK', '', 1),
(163, 'Palau', 'PW', 'PLW', '', 1),
(164, 'Panama', 'PA', 'PAN', '', 1),
(165, 'Papua New Guinea', 'PG', 'PNG', '', 1),
(166, 'Paraguay', 'PY', 'PRY', '', 1),
(167, 'Peru', 'PE', 'PER', '', 1),
(168, 'Philippines', 'PH', 'PHL', '', 1),
(169, 'Pitcairn', 'PN', 'PCN', '', 1),
(170, 'Poland', 'PL', 'POL', '', 1),
(171, 'Portugal', 'PT', 'PRT', '', 1),
(172, 'Puerto Rico', 'PR', 'PRI', '', 1),
(173, 'Qatar', 'QA', 'QAT', '', 1),
(174, 'Reunion', 'RE', 'REU', '', 1),
(175, 'Romania', 'RO', 'ROM', '', 1),
(176, 'Russian Federation', 'RU', 'RUS', '', 1),
(177, 'Rwanda', 'RW', 'RWA', '', 1),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', '', 1),
(179, 'Saint Lucia', 'LC', 'LCA', '', 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '', 1),
(181, 'Samoa', 'WS', 'WSM', '', 1),
(182, 'San Marino', 'SM', 'SMR', '', 1),
(183, 'Sao Tome and Principe', 'ST', 'STP', '', 1),
(184, 'Saudi Arabia', 'SA', 'SAU', '', 1),
(185, 'Senegal', 'SN', 'SEN', '', 1),
(186, 'Seychelles', 'SC', 'SYC', '', 1),
(187, 'Sierra Leone', 'SL', 'SLE', '', 1),
(188, 'Singapore', 'SG', 'SGP', '', 1),
(189, 'Slovak Republic', 'SK', 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 1),
(190, 'Slovenia', 'SI', 'SVN', '', 1),
(191, 'Solomon Islands', 'SB', 'SLB', '', 1),
(192, 'Somalia', 'SO', 'SOM', '', 1),
(193, 'South Africa', 'ZA', 'ZAF', '', 1),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '', 1),
(195, 'Spain', 'ES', 'ESP', '', 1),
(196, 'Sri Lanka', 'LK', 'LKA', '', 1),
(197, 'St. Helena', 'SH', 'SHN', '', 1),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', '', 1),
(199, 'Sudan', 'SD', 'SDN', '', 1),
(200, 'Suriname', 'SR', 'SUR', '', 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '', 1),
(202, 'Swaziland', 'SZ', 'SWZ', '', 1),
(203, 'Sweden', 'SE', 'SWE', '', 1),
(204, 'Switzerland', 'CH', 'CHE', '', 1),
(205, 'Syrian Arab Republic', 'SY', 'SYR', '', 1),
(206, 'Taiwan', 'TW', 'TWN', '', 1),
(207, 'Tajikistan', 'TJ', 'TJK', '', 1),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', '', 1),
(209, 'Thailand', 'TH', 'THA', '', 1),
(210, 'Togo', 'TG', 'TGO', '', 1),
(211, 'Tokelau', 'TK', 'TKL', '', 1),
(212, 'Tonga', 'TO', 'TON', '', 1),
(213, 'Trinidad and Tobago', 'TT', 'TTO', '', 1),
(214, 'Tunisia', 'TN', 'TUN', '', 1),
(215, 'Turkey', 'TR', 'TUR', '', 1),
(216, 'Turkmenistan', 'TM', 'TKM', '', 1),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', '', 1),
(218, 'Tuvalu', 'TV', 'TUV', '', 1),
(219, 'Uganda', 'UG', 'UGA', '', 1),
(220, 'Ukraine', 'UA', 'UKR', '', 1),
(221, 'United Arab Emirates', 'AE', 'ARE', '', 1),
(222, 'United Kingdom', 'GB', 'GBR', '', 1),
(223, 'United States', 'US', 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 1),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', '', 1),
(225, 'Uruguay', 'UY', 'URY', '', 1),
(226, 'Uzbekistan', 'UZ', 'UZB', '', 1),
(227, 'Vanuatu', 'VU', 'VUT', '', 1),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', '', 1),
(229, 'Venezuela', 'VE', 'VEN', '', 1),
(230, 'Viet Nam', 'VN', 'VNM', '', 1),
(231, 'Virgin Islands (British)', 'VG', 'VGB', '', 1),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', '', 1),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', '', 1),
(234, 'Western Sahara', 'EH', 'ESH', '', 1),
(235, 'Yemen', 'YE', 'YEM', '', 1),
(236, 'Yugoslavia', 'YU', 'YUG', '', 1),
(237, 'Zaire', 'ZR', 'ZAR', '', 1),
(238, 'Zambia', 'ZM', 'ZMB', '', 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `delete`
--

DROP TABLE IF EXISTS `delete`;
CREATE TABLE `delete` (
  `id` int(11) NOT NULL,
  `descr` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `query` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `delete`
--

INSERT INTO `delete` (`id`, `descr`, `query`, `dat`) VALUES
(1, 'Seiten und Navigation von: select 6 color', 'delete from nav where navid=6 or parent=6', '2016-02-19 14:24:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fernlehrgang_wait_lesson`
--

DROP TABLE IF EXISTS `fernlehrgang_wait_lesson`;
CREATE TABLE `fernlehrgang_wait_lesson` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `fernlehrgang_wait_lesson`
--

INSERT INTO `fernlehrgang_wait_lesson` (`id`, `id_user`, `level`, `date_time`) VALUES
(7, 22, '0_1', '2020-04-01 12:51:49'),
(8, 22, '1_2', '2020-04-10 13:15:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE `form` (
  `fid` int(11) NOT NULL,
  `fname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `inpnm` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `edit` int(1) NOT NULL DEFAULT 1,
  `fform` text COLLATE latin1_general_ci NOT NULL,
  `fval` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `post` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `betreff` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `antwort` text COLLATE latin1_general_ci NOT NULL,
  `extended` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `form_auswertung`
--

DROP TABLE IF EXISTS `form_auswertung`;
CREATE TABLE `form_auswertung` (
  `aid` int(11) NOT NULL,
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
  `teilnahme2` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `form_field`
--

DROP TABLE IF EXISTS `form_field`;
CREATE TABLE `form_field` (
  `ffid` int(11) NOT NULL,
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
  `fmax` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `galerie`
--

DROP TABLE IF EXISTS `galerie`;
CREATE TABLE `galerie` (
  `gid` int(11) NOT NULL,
  `gname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tn` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gnid` int(11) NOT NULL DEFAULT 0,
  `gtextde` text COLLATE latin1_general_ci NOT NULL,
  `gtexten` text COLLATE latin1_general_ci NOT NULL,
  `gpix` varchar(12) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gsize` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 1,
  `gdatum` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `galerie_group`
--

DROP TABLE IF EXISTS `galerie_group`;
CREATE TABLE `galerie_group` (
  `ggid` int(11) NOT NULL,
  `ggname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sort` int(11) DEFAULT NULL,
  `gglink` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sichtbar` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `galerie_name`
--

DROP TABLE IF EXISTS `galerie_name`;
CREATE TABLE `galerie_name` (
  `gnid` int(11) NOT NULL,
  `gnname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ggid` int(11) NOT NULL DEFAULT 0,
  `img` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `textde` text COLLATE latin1_general_ci NOT NULL,
  `texten` text COLLATE latin1_general_ci NOT NULL,
  `gntextde` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gntexten` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `besucher` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `sichtbar` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `imgid` int(11) NOT NULL,
  `navid` int(11) NOT NULL DEFAULT 0,
  `pos` int(11) NOT NULL DEFAULT 0,
  `image` longblob NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `size` int(11) NOT NULL DEFAULT 0,
  `imgname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `gid` int(11) NOT NULL DEFAULT 0,
  `edit` int(1) NOT NULL DEFAULT 1,
  `itext` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `longtext` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `img_group`
--

DROP TABLE IF EXISTS `img_group`;
CREATE TABLE `img_group` (
  `gid` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `art` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_color`
--

DROP TABLE IF EXISTS `morp_color`;
CREATE TABLE `morp_color` (
  `colid` int(11) NOT NULL,
  `color` varchar(7) NOT NULL,
  `colname` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `morp_color`
--

INSERT INTO `morp_color` (`colid`, `color`, `colname`) VALUES
(1, '8e8a89', 'hellgrau'),
(2, 'a62116', 'Rot'),
(3, 'e59a00', 'orange'),
(4, '2be500', 'green');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_courses`
--

DROP TABLE IF EXISTS `morp_courses`;
CREATE TABLE `morp_courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `morp_courses`
--

INSERT INTO `morp_courses` (`id`, `name`, `color`) VALUES
(46, 'course1', '#B97F53'),
(47, 'course2', '#B97F53'),
(48, 'course3', '#B97F53'),
(49, 'course4', '#B97F53'),
(50, 'course5', '#B97F53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_customer`
--

DROP TABLE IF EXISTS `morp_customer`;
CREATE TABLE `morp_customer` (
  `id` int(11) NOT NULL,
  `company` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `name` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `usr` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pwd` char(50) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_download`
--

DROP TABLE IF EXISTS `morp_download`;
CREATE TABLE `morp_download` (
  `id` int(11) NOT NULL,
  `benutzer` int(11) DEFAULT NULL,
  `datei` char(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `onceagain` tinyint(4) NOT NULL DEFAULT 0,
  `angelegt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_download_historie`
--

DROP TABLE IF EXISTS `morp_download_historie`;
CREATE TABLE `morp_download_historie` (
  `id` int(11) NOT NULL,
  `mdid` int(11) NOT NULL DEFAULT 0,
  `dldate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_email`
--

DROP TABLE IF EXISTS `morp_email`;
CREATE TABLE `morp_email` (
  `id` int(11) NOT NULL,
  `betreff` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `mail` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `datum` varchar(20) COLLATE latin1_german2_ci NOT NULL,
  `text` text COLLATE latin1_german2_ci NOT NULL,
  `to` varchar(50) COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_fa`
--

DROP TABLE IF EXISTS `morp_fa`;
CREATE TABLE `morp_fa` (
  `faid` int(11) NOT NULL,
  `fa` varchar(20) NOT NULL,
  `beschreibung` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `morp_fa`
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
-- Cấu trúc bảng cho bảng `morp_intern`
--

DROP TABLE IF EXISTS `morp_intern`;
CREATE TABLE `morp_intern` (
  `mid` int(11) NOT NULL,
  `muser` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `mpw` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `mberechtigung` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_kurse`
--

DROP TABLE IF EXISTS `morp_kurse`;
CREATE TABLE `morp_kurse` (
  `kid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tid` int(11) NOT NULL,
  `beschreibung` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `colid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `morp_kurse`
--

INSERT INTO `morp_kurse` (`kid`, `name`, `tid`, `beschreibung`, `img`, `colid`) VALUES
(22, 'fsf', 0, '<p>fsffsf</p>', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_kursplan`
--

DROP TABLE IF EXISTS `morp_kursplan`;
CREATE TABLE `morp_kursplan` (
  `pid` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  `von` varchar(5) NOT NULL,
  `bis` varchar(5) NOT NULL,
  `gesamt` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `raum` varchar(20) NOT NULL,
  `anzeige1` varchar(20) NOT NULL,
  `anzeige2` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_lesson`
--

DROP TABLE IF EXISTS `morp_lesson`;
CREATE TABLE `morp_lesson` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number_lesson` int(11) NOT NULL,
  `onepage` tinyint(1) NOT NULL,
  `pass_percent` int(11) NOT NULL,
  `wait-time` int(11) NOT NULL,
  `watch_video` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_mitarbeiter`
--

DROP TABLE IF EXISTS `morp_mitarbeiter`;
CREATE TABLE `morp_mitarbeiter` (
  `mid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `vorname` varchar(100) NOT NULL,
  `anrede` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fon` varchar(20) NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `img3` varchar(100) NOT NULL,
  `reihenfolge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_sprachdatei`
--

DROP TABLE IF EXISTS `morp_sprachdatei`;
CREATE TABLE `morp_sprachdatei` (
  `id` int(11) NOT NULL,
  `de` text NOT NULL,
  `en` text NOT NULL,
  `fr` text NOT NULL,
  `bez` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_stimmen`
--

DROP TABLE IF EXISTS `morp_stimmen`;
CREATE TABLE `morp_stimmen` (
  `stid` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `beruf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `text` text COLLATE latin1_general_ci NOT NULL,
  `img1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `textkurz` text COLLATE latin1_general_ci NOT NULL,
  `reihenfolge` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_suche_count`
--

DROP TABLE IF EXISTS `morp_suche_count`;
CREATE TABLE `morp_suche_count` (
  `sid` int(11) NOT NULL,
  `kid` int(11) NOT NULL DEFAULT 0,
  `navid` int(11) NOT NULL DEFAULT 0,
  `anzde` int(11) NOT NULL DEFAULT 0,
  `anzen` int(11) NOT NULL DEFAULT 0,
  `art` int(1) NOT NULL DEFAULT 1,
  `stid` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_suche_keyw`
--

DROP TABLE IF EXISTS `morp_suche_keyw`;
CREATE TABLE `morp_suche_keyw` (
  `kid` int(11) NOT NULL,
  `keyw` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `de` int(1) NOT NULL DEFAULT 0,
  `en` int(1) NOT NULL DEFAULT 0,
  `desc` int(1) NOT NULL DEFAULT 0,
  `title` int(1) NOT NULL DEFAULT 0,
  `wg` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `morp_trainer`
--

DROP TABLE IF EXISTS `morp_trainer`;
CREATE TABLE `morp_trainer` (
  `tid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `morp_trainer`
--

INSERT INTO `morp_trainer` (`tid`, `name`) VALUES
(2, 'new1'),
(3, 'new2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nav`
--

DROP TABLE IF EXISTS `nav`;
CREATE TABLE `nav` (
  `navid` int(11) NOT NULL,
  `ebene` int(11) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sichtbar` int(1) NOT NULL DEFAULT 1,
  `edit` int(1) NOT NULL DEFAULT 1,
  `keyw` varchar(255) CHARACTER SET utf8 NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lang` int(1) NOT NULL DEFAULT 1,
  `lock` int(1) NOT NULL DEFAULT 0,
  `bereich` int(1) NOT NULL DEFAULT 1,
  `button` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lnk` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emotional` int(11) NOT NULL,
  `design` int(11) NOT NULL,
  `oldlnk` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `anker` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `nid` int(11) NOT NULL,
  `ntitle` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ntext` text COLLATE latin1_general_ci NOT NULL,
  `nvon` date NOT NULL DEFAULT '0000-00-00',
  `nbis` date NOT NULL DEFAULT '0000-00-00',
  `nerstellt` date NOT NULL DEFAULT '0000-00-00',
  `edit` int(1) NOT NULL DEFAULT 1,
  `aktuell` int(1) NOT NULL DEFAULT 1,
  `nabstr` text COLLATE latin1_general_ci NOT NULL,
  `nautor` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `imgid` int(11) NOT NULL DEFAULT 0,
  `nlink` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ngid` int(11) NOT NULL DEFAULT 1,
  `nsubtitle` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT 0,
  `style` int(1) NOT NULL DEFAULT 1,
  `img1` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `img2` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `img3` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `img4` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `hid` int(11) NOT NULL,
  `sichtbar` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter` (
  `nlid` int(11) NOT NULL,
  `nlname` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nlsubj` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nlmail` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nldatum` date NOT NULL DEFAULT '0000-00-00',
  `text` text COLLATE latin1_general_ci NOT NULL,
  `nlimg1` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nlimg2` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `edit` int(1) NOT NULL DEFAULT 1,
  `layout` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_group`
--

DROP TABLE IF EXISTS `news_group`;
CREATE TABLE `news_group` (
  `ngid` int(11) NOT NULL,
  `ngname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `edit` int(1) NOT NULL DEFAULT 1,
  `format` int(1) NOT NULL DEFAULT 1,
  `nlang` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news_group`
--

INSERT INTO `news_group` (`ngid`, `ngname`, `edit`, `format`, `nlang`) VALUES
(1, 'fdffsd', 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nl_verteiler`
--

DROP TABLE IF EXISTS `nl_verteiler`;
CREATE TABLE `nl_verteiler` (
  `vid` int(11) NOT NULL,
  `vname` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `vemail` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page1_headline`
--

DROP TABLE IF EXISTS `page1_headline`;
CREATE TABLE `page1_headline` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_english` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `text_english` text NOT NULL,
  `ordering` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page1_headline`
--

INSERT INTO `page1_headline` (`id`, `id_pdf`, `title`, `title_english`, `text`, `text_english`, `ordering`) VALUES
(24, 49, 'Beschreibung', '', '<p>Das Soja Protein Isolate Emulsion Typ ISP920H ist aus nicht genmanipuliertes Soja gewonnen (NON-GMO) und besitzt hervorragende Emulgier- und Gelierungseigenschaften.</p>', '', 9),
(26, 49, 'Deklaration nach LMKV', '', '<p>Sojaeiwei&szlig;</p>', '', 8),
(28, 49, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>20 kg (netto) in wei&szlig;en Papiers&auml;cken mit PE Innensack; auf Paletten; 18 Monate nach dem Herstelldatum; verschlossen und dicht verpackt, ku?hl und trocken einlagern bei Temperaturen zwischen 5 und 25 Grad.</p>\r\n<p>Konformit&auml;tsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.</p>', '', 6),
(27, 49, 'Anwendung', 'title_english', '<p>Als Emulgator, zur Vermehrung des Eiwei&szlig;es im Lebensmittel wie z.B.: in Salami, D&ouml;ner/Kebab, tiefgefrorene Fleischprodukte.</p>', 'text_english', 4),
(30, 49, 'Sensorik', '', '<p>Cremig; Geschmackfrei und arttypisch</p>', '', 7),
(31, 49, 'Country of Origin', '', '<p>China</p>', '', 5),
(41, 60, 'Anwendung', '', 'Als Emulgator, zur Vermehrung des Eiweißes im Lebensmittel wie z.B.: in Salami, Döner/Kebab, tiefgefrorene Fleischprodukte.', '', 0),
(40, 60, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in weißen Papiersäcken mit PE Innensack; auf Paletten; 18 Monate nach dem Herstelldatum; verschlossen und dicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 5 und 25 Grad.\r\nKonformitätsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.', '', 0),
(39, 60, 'Deklaration nach LMKV', '', '<p><style type=\"text/css\">\r\n<!--\r\n /* Font Definitions */\r\n@font-face\r\n	{font-family:\"Cambria Math\";\r\n	panose-1:2 4 5 3 5 4 6 3 2 4;\r\n	mso-font-charset:0;\r\n	mso-generic-font-family:auto;\r\n	mso-font-pitch:variable;\r\n	mso-font-signature:-536870145 1107305727 0 0 415 0;}\r\n@font-face\r\n	{font-family:SimSun;\r\n	mso-font-alt:??;\r\n	mso-font-charset:134;\r\n	mso-generic-font-family:auto;\r\n	mso-font-pitch:variable;\r\n	mso-font-signature:3 680460288 22 0 262145 0;}\r\n /* Style Definitions */\r\np.MsoNormal, li.MsoNormal, div.MsoNormal\r\n	{mso-style-unhide:no;\r\n	mso-style-qformat:yes;\r\n	mso-style-parent:\"\";\r\n	margin:0cm;\r\n	margin-bottom:.0001pt;\r\n	mso-pagination:widow-orphan;\r\n	font-size:12.0pt;\r\n	font-family:\"Times New Roman\";\r\n	mso-fareast-font-family:SimSun;\r\n	mso-ansi-language:EN-US;\r\n	mso-fareast-language:EN-US;}\r\n.MsoChpDefault\r\n	{mso-style-type:export-only;\r\n	mso-default-props:yes;\r\n	font-size:10.0pt;\r\n	mso-ansi-font-size:10.0pt;\r\n	mso-bidi-font-size:10.0pt;\r\n	mso-fareast-font-family:SimSun;}\r\n@page WordSection1\r\n	{size:612.0pt 792.0pt;\r\n	margin:70.85pt 70.85pt 2.0cm 70.85pt;\r\n	mso-header-margin:36.0pt;\r\n	mso-footer-margin:36.0pt;\r\n	mso-paper-source:0;}\r\ndiv.WordSection1\r\n	{page:WordSection1;}\r\n-->\r\n</style>Sojaeiwei&szlig;</p>', '', 0),
(38, 60, 'Beschreibung', '', 'Das Soja Protein Isolate Emulsion Typ ISP920H ist aus nicht genmanipuliertes Soja gewonnen (NON-GMO) und besitzt hervorragende Emulgier- und Gelierungseigenschaften.', '', 0),
(42, 60, 'Sensorik', '', '<p>Cremig; geschmacksfrei und arttypisch</p>', '', 0),
(43, 60, 'Country of Origin', '', '<p>China</p>', '', 0),
(56, 63, 'Beschreibung', '', '<p>Das Sojaprotein-Isolat Injektion Typ EF &ndash; SPI 930E ist aus nicht genmanipulierten Sojabohnen (NON GMO) gewonnen. Es ist ein Sojaproteinisolat, das durch gute Dispergierbarkeit, Dispersionsstabilit&auml;t, L&ouml;slichkeitsstabilit&auml;t, niedrigen Brennwert und Vermeidung von Laktose St&ouml;rungen charakterisiert ist.</p>', '', 0),
(44, 61, 'Anwendung', '', 'Bäckerei; Zusatz in Fleischprodukte; Müsli usw.', '', 0),
(50, 62, 'Beschreibung', '', 'EF-SPI 930M ist aus nicht genmanipulierten Sojabohnen hergestellt. Es ist gekennzeichnet durch seine gute Löslichkeit, stabile Dispergierbarkeit und hervorragende Auflösung mit niedrigem Natriumion. ', '', 0),
(45, 61, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in brauen Papiersäcken mit PE Innensack; auf Paletten; 18 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad.\r\nKonformitätsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.', '', 0),
(46, 61, 'Deklaration nach LMKV', '', '<p><style type=\"text/css\">\r\n<!--\r\n /* Font Definitions */\r\n@font-face\r\n	{font-family:\"Cambria Math\";\r\n	panose-1:2 4 5 3 5 4 6 3 2 4;\r\n	mso-font-charset:0;\r\n	mso-generic-font-family:auto;\r\n	mso-font-pitch:variable;\r\n	mso-font-signature:-536870145 1107305727 0 0 415 0;}\r\n@font-face\r\n	{font-family:SimSun;\r\n	mso-font-alt:??;\r\n	mso-font-charset:134;\r\n	mso-generic-font-family:auto;\r\n	mso-font-pitch:variable;\r\n	mso-font-signature:3 680460288 22 0 262145 0;}\r\n /* Style Definitions */\r\np.MsoNormal, li.MsoNormal, div.MsoNormal\r\n	{mso-style-unhide:no;\r\n	mso-style-qformat:yes;\r\n	mso-style-parent:\"\";\r\n	margin:0cm;\r\n	margin-bottom:.0001pt;\r\n	mso-pagination:widow-orphan;\r\n	font-size:12.0pt;\r\n	font-family:\"Times New Roman\";\r\n	mso-fareast-font-family:SimSun;\r\n	mso-ansi-language:EN-US;\r\n	mso-fareast-language:EN-US;}\r\n.MsoChpDefault\r\n	{mso-style-type:export-only;\r\n	mso-default-props:yes;\r\n	font-size:10.0pt;\r\n	mso-ansi-font-size:10.0pt;\r\n	mso-bidi-font-size:10.0pt;\r\n	mso-fareast-font-family:SimSun;}\r\n@page WordSection1\r\n	{size:612.0pt 792.0pt;\r\n	margin:70.85pt 70.85pt 2.0cm 70.85pt;\r\n	mso-header-margin:36.0pt;\r\n	mso-footer-margin:36.0pt;\r\n	mso-paper-source:0;}\r\ndiv.WordSection1\r\n	{page:WordSection1;}\r\n-->\r\n</style>Sojaeiwei&szlig;</p>', '', 0),
(47, 61, 'Beschreibung', '', 'Das Sojaprotein Konzentrat – nicht funktional und ist aus nicht genmanipulierten Sojabohnen (NON GMO) gewonnen, die aus ökologisch kontrolliertem Anbau stammt. Es ist ein Sojakonzentrat mit normaler Funktionalität und ist reichlich an Ballaststoff.', '', 0),
(48, 61, 'Sensorik', '', '<p>Cremig; geschmacksfrei und arttypisch</p>', '', 0),
(49, 61, 'Country of Origin', '', '<p>China</p>', '', 0),
(51, 62, 'Deklaration nach LMKV', '', '<p>Sojaeiwei&szlig;</p>', '', 0),
(52, 62, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in brauen Papiersäcken mit PE Innensack; auf Paletten; 18 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 10 und 20 Grad.\r\nKonformitätsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.\r\n', '', 0),
(53, 62, 'Anwendung', '', '<p>Milchprodukte; Gesundheitsgetr&auml;nke; Babynahrung bzw. Nahrungserg&auml;nzung</p>', '', 0),
(54, 62, 'Sensorik', '', '<p>Cremig; geschmacksfrei und arttypisch</p>', '', 0),
(55, 62, 'Country of Origin', '', '<p>China</p>', '', 0),
(57, 63, 'Deklaration nach LMKV', '', '<p>Sojaeiwei&szlig;</p>', '', 0),
(58, 63, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in brauen Papiersäcken mit PE Innensack; auf Paletten; 18 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad.\r\nKonformitätsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.', '', 0),
(59, 63, 'Anwendung', '', 'Zusatz zu Mischungen; Trockengetränkepulver, Diätpulver, Babybrei usw.', '', 0),
(60, 63, 'Sensorik', '', '<p>Cremig; geschmacksfrei und arttypisch</p>', '', 0),
(61, 63, 'Country of Origin', '', '<p>China</p>', '', 0),
(62, 64, 'Beschreibung', '', 'Das Sojaprotein-Isolat Typ EF – SPI 930F ist aus nicht genmanipulierten Sojabohnen (NON GMO) gewonnen und sehr gut löslich, gut dispergierbar, Säurestabil, konglomerationsstabil, delaminationsstabil.', '', 0),
(68, 65, 'Anwendung', '', '<p>Als Emulgator, zur Vermehrung des Eiwei&szlig;es im Lebensmittel, wie z.B.: in Wurst, Schinken, tiefgefrorene Fleischprodukte.</p>\r\n<p>Ern&auml;hrungsformen/ -informationen: vegan, vegetarisch</p>', '', 0),
(63, 64, 'Deklaration nach LMKV', '', '<p>Sojaeiwei&szlig;</p>', '', 0),
(64, 64, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in brauen Papiersäcken mit PE Innensack; auf Paletten; 18 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad.\r\nKonformitätsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.', '', 0),
(65, 64, 'Anwendung', '', 'Milchprodukte, Zusatz für Milchpulver; Milchshakes; Proteingetränke usw.', '', 0),
(66, 64, 'Sensorik', '', '<p>Cremig; geschmacksfrei und arttypisch</p>', '', 0),
(67, 64, 'Country of Origin', '', '<p>China</p>', '', 0),
(69, 65, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in weißen Papiersäcken mit PE Innensack; auf Paletten; 18 Monate nach dem Herstelldatum; verschlossen und dicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 5 und 25 Grad.', '', 0),
(242, 94, 'Sensorik', '', '<p>Typisch, hell bis leicht gelbliches Pulver</p>', '', 0),
(70, 65, 'Deklaration nach LMKV', '', '<p><style type=\"text/css\">\r\n<!--\r\n /* Font Definitions */\r\n@font-face\r\n	{font-family:\"Cambria Math\";\r\n	panose-1:2 4 5 3 5 4 6 3 2 4;\r\n	mso-font-charset:0;\r\n	mso-generic-font-family:auto;\r\n	mso-font-pitch:variable;\r\n	mso-font-signature:-536870145 1107305727 0 0 415 0;}\r\n@font-face\r\n	{font-family:SimSun;\r\n	mso-font-alt:??;\r\n	mso-font-charset:134;\r\n	mso-generic-font-family:auto;\r\n	mso-font-pitch:variable;\r\n	mso-font-signature:3 680460288 22 0 262145 0;}\r\n /* Style Definitions */\r\np.MsoNormal, li.MsoNormal, div.MsoNormal\r\n	{mso-style-unhide:no;\r\n	mso-style-qformat:yes;\r\n	mso-style-parent:\"\";\r\n	margin:0cm;\r\n	margin-bottom:.0001pt;\r\n	mso-pagination:widow-orphan;\r\n	font-size:12.0pt;\r\n	font-family:\"Times New Roman\";\r\n	mso-fareast-font-family:SimSun;\r\n	mso-ansi-language:EN-US;\r\n	mso-fareast-language:EN-US;}\r\n.MsoChpDefault\r\n	{mso-style-type:export-only;\r\n	mso-default-props:yes;\r\n	font-size:10.0pt;\r\n	mso-ansi-font-size:10.0pt;\r\n	mso-bidi-font-size:10.0pt;\r\n	mso-fareast-font-family:SimSun;}\r\n@page WordSection1\r\n	{size:612.0pt 792.0pt;\r\n	margin:70.85pt 70.85pt 2.0cm 70.85pt;\r\n	mso-header-margin:36.0pt;\r\n	mso-footer-margin:36.0pt;\r\n	mso-paper-source:0;}\r\ndiv.WordSection1\r\n	{page:WordSection1;}\r\n-->\r\n</style>Sojaeiwei&szlig;</p>', '', 0),
(71, 65, 'Beschreibung', '', 'Das Soja Protein Isolate Gelierung Typ ISP 90G ist aus nicht genmanipuliertes Soja gewonnen (NON GMO) und besitzt hervorragende Gelierungseigenschaften und Wasserbindung. Gleichzeitig hat sie auch gute Emulgierung und weniger Asche.', '', 0),
(72, 65, 'Sensorik', '', 'Cremig; geschmacksfrei und arttypisch', '', 0),
(73, 65, 'Country of Origin', '', 'China', '', 0),
(75, 66, 'Anwendung', '', 'Als Emulgator, Bindemittel und Proteinmischung für die Fleischprodukte; Proteingetränke.', '', 0),
(76, 66, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in weißen Papiersäcken mit PE Innensack; auf Paletten; 18 Monate nach dem Herstelldatum; verschlossen und dicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 5 und 25 Grad.\r\nKonformitätsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.', '', 0),
(88, 68, 'Deklaration nach LMKV', '', '<p>Sojaeiwei&szlig;</p>', '', 0),
(82, 67, 'Deklaration nach LMKV', '', '<p>Sojaeiwei&szlig;</p>', '', 0),
(83, 67, 'Verpackung, Haltbarkeit und Lagerbedingung', '', 'Auf Paletten; 18 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad.\r\nKonformitätsbescheinigung zum Verpackungsmaterial nach EG 1935/2004 liegt vor.', '', 0),
(84, 67, 'Anwendung', '', 'Snacks; Fleischbällchen; Wurst; Vegetarische Produkte; Fleischersatz von Rindfleisch; Hühnerfleisch, Schinken usw. ', '', 0),
(85, 67, 'Sensorik', '', '<p>Typisch, hell bis leicht gelblich; in verschiedenen Formen mit verschiedenen Gr&ouml;&szlig;en.</p>', '', 0),
(86, 67, 'Country of Origin', '', '<p>China</p>', '', 0),
(87, 68, 'Beschreibung', '', 'Das Sojaprotein-Konzentrat YX 702 ist aus nicht genmanipulierten Sojabohnen (NON GMO) gewonnen und mit hervorragender Wasserbindefähigkeit, fetthaltiger Emulgierung.', '', 0),
(78, 66, 'Beschreibung', '', 'Das Soja Protein Isolate ISP930, ist aus nicht genmanipuliertes Soja gewonnen (NON GMO). Es besitzt eine gute Dispergierbarkeit und ist dickflüssig ', '', 0),
(81, 67, 'Beschreibung', '', '<p>Typisch, hell bis leicht gelblich; in verschiedenen Formen mit verschiedenen Gr&ouml;&szlig;en.</p>', '', 0),
(79, 66, 'Sensorik', '', '<p>Cremig; geschmacksfrei und arttypisch</p>', '', 0),
(80, 66, 'Country of Origin', '', '<p>China</p>', '', 0),
(89, 68, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20kg (netto) in weißen Papiersäcken mit PE Innensack; auf Paletten; 12 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, kühl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad.', '', 0),
(93, 68, 'Funktionsindex:', '', 'Emulsion: (Protein: Wasser: Öl): 1:6:6', '', 0),
(90, 68, 'Anwendung', '', 'Fleischprodukte: wie Hotdog, Wurst; Vegetarische Produkte.', '', 0),
(91, 68, 'Sensorik', '', 'Typisch, hell bis leicht gelbliches Pulver', '', 0),
(92, 68, 'Country of Origin', '', '<p>China</p>', '', 0),
(95, 69, 'Beschreibung', '', 'Sojakonzentrat, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.', '', 0),
(101, 69, 'Eigenschaften', '', 'Sojakonzentrat, staubfrei, stark gelbildend, gute Wasserbindung, gute Öl/Fett Adsorption bei 1:4:4.', '', 0),
(96, 69, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '20 kg Papiersäcke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur < 23°C, Luftfeuchtigkeit < 60°C.', '', 0),
(114, 70, 'Anwendung', '', '<p>Neutrale Proteinmilch, Gem&uuml;seproteindrinks, Nahrungsriegel.</p>', '', 0),
(98, 69, 'Anwendung', '', 'Backwaren, Fleisch / Geflügel / Fischprodukte, Brühwürste, Schinken, Bacon.', '', 0),
(107, 70, 'Beschreibung', '', 'EF-SPI950F ist aus nicht genmanipulierten Sojabohnen hergestellt. EF-SPI950F ist ein Sojaprotein charakterisiert durch geringe Viskosität und hohe Dispergierbarkeit.', '', 0),
(103, 69, 'Kennzeichnung', '', 'Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum', '', 0),
(109, 70, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 Kg/Sack Nettogewicht, mehrlagiger, mehrfach beschichteter Papiersack. Haltbarkeit: 12 Monate unter den o.g. Lagerbedingungen. Lagerung: Das Produkt sollte auf einer Palette und an einem trockenen k&uuml;hlen Platz gelagert werden (bei einer Temperatur &le; 23&deg;C und bei einer relativen Luftfeuchtigkeit von 	&le; 60&deg;C).</p>', '', 0),
(115, 70, '', '', 'Neutrale Proteinmilch, Gemüseproteindrinks, Nahrungsriegel.', '', 0),
(116, 71, 'Anwendung', '', 'Fleisch / Geflügel / Fischprodukte, Schinken / Bacon, Injection, Wurstwaren.', '', 0),
(112, 70, 'Country of Origin', '', '<p>China</p>', '', 0),
(113, 70, 'Kennzeichnung', '', 'Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.', '', 0),
(117, 71, 'Verpackung, Haltbarkeit und Lagerbedingung', '', 'Verpackungseinheit: 20 kg Papiersäcke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur < 23°C, Luftfeuchtigkeit < 60°C.', '', 0),
(121, 71, 'Kennzeichnung', '', 'Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.', '', 0),
(118, 71, 'Beschreibung', '', 'Hydrolisiertes Sojaprotein, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.', '', 0),
(119, 71, 'Eigenschaften', '', 'Sojaisolat, staubfrei, gute Verteilung in kaltem Wasser in weniger als 30 sec., normale Gelierung, wenig Schaumbildung beim Lösen, keine Agglomeration in kaltem Wasser.', '', 0),
(124, 72, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(123, 72, 'Anwendung', '', 'Multifunktional anwendbar, produktübergreifend anwendbar.', '', 0),
(125, 72, 'Kennzeichnung', '', 'Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.', '', 0),
(126, 72, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(127, 72, 'Eigenschaften', '', 'Sojaisolat, staubfrei, starke Wasserbindung verbessert die Struktur, temperaturstabil, gibt eine gute stabile Emulsion, emulsionsstabil, viskoseelastisch, gefrierstabil.', '', 0),
(128, 73, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(129, 73, 'Anwendung', '', 'Fleisch / Geflügel / Fischprodukte, Hackfleischprodukte, Wurstwaren.', '', 0),
(130, 73, 'Kennzeichnung', '', 'Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.', '', 0),
(131, 73, 'Beschreibung', '', 'Hydrolisiertes Sojaprotein , genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.\r\n', '', 0),
(132, 73, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Wasserbindung, gute Fettbindung, emulgierend, verbessert die Struktur.', '', 0),
(133, 74, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(134, 74, 'Anwendung', '', '<p>Fleisch / Gefl&uuml;gel / Fischprodukte, Hackfleischprodukte, Wurstwaren.</p>', '', 0),
(135, 74, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(136, 74, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein , genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(137, 74, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Wasserbindung, gute Fettbindung, emulgierend, mit Lecithin.', '', 0),
(138, 75, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(139, 75, 'Anwendung', '', 'Fleisch / Geflügel / Fischprodukte, Hackfleischprodukte, Wurstwaren.', '', 0),
(140, 75, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(141, 75, 'Beschreibung', '', 'Hydrolisiertes Sojaprotein, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.', '', 0),
(142, 75, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Dispergierbarkeit, gute Gelierung, hohe Viskosität verhindert Kochverluste, gute Wasserbindung, gute Fettbindung.', '', 0),
(143, 76, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(144, 76, 'Anwendung', '', 'Fleisch / Geflügel / Fischprodukte, Schinken / Bacon, Injection, Wurstwaren.', '', 0),
(145, 76, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(146, 76, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(147, 76, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Verteilung in kaltem Wasser in weniger als 30 sec., normale Gelierung, wenig Schaumbildung beim Lösen, keine Agglomeration in kaltem Wasser.', '', 0),
(148, 77, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(149, 77, 'Anwendung', '', 'Fleisch / Geflügel / Fischprodukte, Hackfleischprodukte, Wurstwaren.', '', 0),
(150, 77, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(151, 77, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(152, 77, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Wasserbindung, gute Fettbindung, emulgierend.', '', 0),
(153, 78, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(154, 78, 'Anwendung', '', 'Zusatz zu Mischungen, Trockengetränkepulver, Diätpulver, Proteinpulver.', '', 0),
(155, 78, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(156, 78, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(157, 78, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Dispergierbarkeit, gute Löslichkeit innerhalb 25 sec., mittlere Viskosität.', '', 0),
(158, 79, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(159, 79, 'Anwendung', '', 'Milchprodukte, Zusatz für Milchpulver, Milchshakes.', '', 0),
(160, 79, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(161, 79, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(162, 79, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Dispergierbarkeit, gute Löslichkeit innerhalb 25 sec., mittlere Viskosität, delaminatiosstabil.', '', 0),
(163, 80, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(164, 80, 'Anwendung', '', 'Milchprodukte, Zusatz für Milchpulver, Milchshakes, Proteingetränke.', '', 0),
(165, 80, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(166, 80, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(167, 80, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Dispergierbarkeit, gute Löslichkeit.', '', 0),
(168, 81, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(169, 81, 'Anwendung', '', 'Joghurt, Proteinrigel, Proteinpulver, Proteingetränke.', '', 0),
(170, 81, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(171, 81, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(172, 81, 'Eigenschaften', '', '<p>Proteinisolat, staubfrei, gute Dispergierbarkeit, gute L&ouml;slichkeit.</p>', '', 0),
(173, 82, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(174, 82, 'Anwendung', '', 'Trockenpulvermischungen, Proteinriegel, Proteindrinks für Ca-angereicherte Anwendungen.', '', 0),
(175, 82, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(176, 82, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(177, 82, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Dispergierbarkeit, hohe Löslichkeit, niedrige Viskosität, wirkt emulgierend, stabilisiert Emulsionen.', '', 0),
(178, 83, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(179, 83, 'Anwendung', '', 'Zusatz für Milchpulver, Proteinriegel, Proteindrinks, Sojamilchdrinks.', '', 0),
(180, 83, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(181, 83, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(182, 83, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Dispergierbarkeit, hohe Löslichkeit, niedrige Viskosität.', '', 0),
(183, 84, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackungseinheit: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(184, 84, 'Anwendung', '', 'Ready to drink (RTD) Getränke, Trockenpulvermischungen, natriumarm.', '', 0),
(185, 84, 'Kennzeichnung', '', '<p>Markenname, Produktname, Hersteller, CIQ Register Nr., Batch Nr., Herstelldatum, Verfalldatum.</p>', '', 0),
(186, 84, 'Beschreibung', '', '<p>Hydrolisiertes Sojaprotein, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(187, 84, 'Eigenschaften', '', 'Proteinisolat, staubfrei, gute Dispergierbarkeit, hohe Löslichkeit, niedrige Viskosität.', '', 0),
(241, 94, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>20kg (netto) in wei&szlig;en Papiers&auml;cken mit PE Innensack; auf Paletten; 24 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, k&uuml;hl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad. </p>', '', 0),
(238, 94, 'Produktbeschreibung ', '', '<p>Das Soja Faser, nennt man auch Soja Ballaststoff und wird aus nicht genmanipulierten Sojabohnen (NON GMO) gewonnen. Es enth&auml;lt Protein, Peptide, l&ouml;sbare Soja Polysaccharid ist ein Komplex von Protein, Peptide, l&ouml;sliche Soja Polysaccharid und unl&ouml;sliche Soja Faser. Das Soja Faser ist ein sehr umfangreiches Produkt und ist vielseitig einsetzbar. </p>', '', 0),
(193, 86, 'Deklaration nach LMKV', 'test11', '<p>Sojaeiwei&szlig;</p>', '<p>&nbsp;testt11zzz</p>', 0),
(194, 86, 'Beschreibung', 'test22', '<p>Das Sojaprotein-Konzentrat CSP310 ist aus nicht genmanipulierten Sojabohnen (NON GMO) gewonnen und mit hervorragender Wasserbindef&auml;higkeit, fetthaltiger Emulgierung.</p>', '<p>&nbsp;test22zzzz</p>', 0),
(195, 86, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>20kg (netto) in wei&szlig;en Papiers&auml;cken mit PE Innensack; auf Paletten; 12 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, k&uuml;hl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad.</p>', '', 0),
(196, 86, 'Funktionsindex:', '', 'Emulsion: (Protein: Wasser: Öl): 1:5:5', '', 0),
(197, 86, 'Anwendung', '', 'Fleischprodukte: wie Hotdog, Wurst; Vegetarische Produkte.', '', 0),
(198, 86, 'Sensorik', '', '<p>Typisch, hell bis leicht gelbliches Pulver</p>', '', 0),
(202, 87, 'Beschreibung', '', 'Alkoholextrahiertes Sojakonzentrat, genfreie Sojabohnen höchster Qualität.', '', 0),
(203, 87, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackung: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(208, 88, 'Beschreibung', '', 'Alkoholextrahiertes Sojakonzentrat, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.', '', 0),
(205, 87, 'Anwendung', '', 'Fleisch / Geflügel / Fischprodukte, Dumplings, Frikadellen, Fleischbällchen, Wurstwaren.', '', 0),
(209, 88, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackung: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>\r\n<p>&nbsp;</p>', '', 0),
(207, 87, 'Eigenschaften', '', 'Sojakonzentrat, staubfrei, gute Wasserbindung, gute Fettbindung, emulgierend.', '', 0),
(210, 88, 'Anwendung', '', 'Backwaren, Fleisch / Geflügel / Fischprodukte, Frühstückscerealien.', '', 0),
(211, 88, 'Eigenschaften', '', 'Sojakonzentrat, staubfrei, gute Wasserbindung, gute Fettbindung, emulgierend.', '', 0),
(212, 89, 'Beschreibung', '', 'Sojakonzentrat, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.', '', 0),
(213, 89, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackung: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(214, 89, 'Anwendung', '', 'Backwaren, Ketchups, Saucen, fettfreie Lebensmittel, zuckerreduzierte Lebensmittel für Würzmittel.', '', 0),
(215, 89, 'Eigenschaften', '', 'Sojakonzentrat, staubfrei, gute Expansion, gute Wasserbindung.', '', 0),
(216, 90, 'Beschreibung', '', '<p>Sojakonzentrat, genfreie Sojabohnen h&ouml;chster Qualit&auml;t, bei niedriger Temperatur entfettet.</p>', '', 0),
(217, 90, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>Verpackung: 20 kg Papiers&auml;cke, mehrlagig, PP - lined. Haltbarkeit: 12 Monate. Lagerung: Gelagert auf Paletten, Temperatur &lt; 23&deg;C, Luftfeuchtigkeit &lt; 60&deg;C.</p>', '', 0),
(218, 90, 'Anwendung', '', '<p>Backwaren, Ketchups, Saucen, fettfreie Lebensmittel, zuckerreduzierte Lebensmittel f&uuml;r W&uuml;rzmittel.</p>', '', 0),
(219, 90, 'Eigenschaften', '', '<p>Sojakonzentrat, staubfrei, gute Expansion, gute Wasserbindung.</p>', '', 0),
(240, 94, 'Anwendung', '', '<p>B&auml;ckerei Produkte; Fleisch Snacks; Tiefgefrorene Produkte</p>', '', 0),
(239, 94, 'Funktion', '', '<p>Stabilisierung der Schaumbildung; Stabilisierung&nbsp; der Emulsion; Stabilisierung in Frostauftauverfahren; Verl&auml;ngerung der Haltbarkeit eines Produktes geschmacklich; Quelle durch den nat&uuml;rlichen Ballaststoff; Verfeinert die Struktur; Fein im Geschmack; Kalorien reduziert; &Ouml;l - Ersatz; H&auml;lt der S&auml;ure und Alkalische Stand sowie dem Erhitzen und Ersch&uuml;tterungen. </p>', '', 0),
(244, 96, 'Produktbeschreibung', '', '<p>Soja Lecithin Pulver 93 ist aus nicht genmanipulierten Sojabohnen (NON&nbsp;GMO) gewonnen und sehr gut dispergierbar und stabil. Es ist auch geeignet f&uuml;r die Qualit&auml;tserh&ouml;hung bzw. - Verbesserung der Produkte.</p>', '', 0),
(245, 96, 'Anwendung', '', '<p>Lebensmittel (Schokolade, Milchprodukt usw.); Als Rohstoff f&uuml;r Pharmaindustrie, Haustierfutter; Emulgator usw.</p>', '', 0),
(246, 96, 'Verpackung, Haltbarkeit und Lagerbedingung', '', '<p>20kg (5kg*4), wei&szlig;en S&auml;cke mit Innen PE; in Karton; 12 Monate nach Herstelldatum. Verschlossen und lichtdicht verpackt, k&uuml;hl und trocken einlagern bei Temperaturen zwischen 10 und 25 Grad.</p>', '', 0),
(254, 49, 'titlez', 'english1_eng', '<p>textz</p>', '<p>&nbsp;text_eng11</p>', 1),
(255, 49, '', 'title_english', '', 'text_english', 2),
(256, 49, 'title3', 'title3_english', '<p>&nbsp;text3</p>', '<p>&nbsp;text3_english</p>', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page1_logo`
--

DROP TABLE IF EXISTS `page1_logo`;
CREATE TABLE `page1_logo` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `id_logo` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page1_logo`
--

INSERT INTO `page1_logo` (`id`, `id_pdf`, `id_logo`, `image`) VALUES
(149, 67, 19, 'icon7.png'),
(108, 61, 19, 'icon7.png'),
(162, 68, 19, 'icon7.png'),
(161, 68, 18, 'icon6.png'),
(160, 68, 13, 'icon1.png'),
(159, 68, 15, 'icon3.png'),
(152, 60, 18, 'icon6.png'),
(107, 61, 18, 'icon6.png'),
(106, 61, 16, 'icon4.png'),
(143, 66, 18, 'icon6.png'),
(151, 60, 13, 'icon1.png'),
(126, 49, 18, 'icon6.png'),
(125, 49, 13, 'icon1.png'),
(150, 60, 15, 'icon3.png'),
(148, 67, 18, 'icon6.png'),
(147, 67, 13, 'icon1.png'),
(146, 67, 15, 'icon3.png'),
(142, 66, 17, 'icon5.png'),
(128, 62, 19, 'icon7.png'),
(127, 62, 17, 'icon5.png'),
(139, 65, 18, 'icon6.png'),
(138, 65, 13, 'icon1.png'),
(135, 64, 19, 'icon7.png'),
(134, 64, 17, 'icon5.png'),
(130, 63, 19, 'icon7.png'),
(129, 63, 17, 'icon5.png'),
(170, 69, 18, 'icon6.png'),
(169, 69, 13, 'icon1.png'),
(168, 69, 14, 'icon2.png'),
(167, 69, 16, 'icon4.png'),
(174, 70, 19, 'icon7.png'),
(173, 70, 17, 'icon5.png'),
(182, 71, 18, 'icon6.png'),
(181, 71, 13, 'icon1.png'),
(180, 71, 17, 'icon5.png'),
(188, 72, 15, 'icon3.png'),
(187, 72, 16, 'icon4.png'),
(186, 72, 17, 'icon5.png'),
(189, 72, 14, 'icon2.png'),
(190, 72, 13, 'icon1.png'),
(191, 72, 18, 'icon6.png'),
(192, 72, 19, 'icon7.png'),
(217, 76, 18, 'icon6.png'),
(213, 75, 18, 'icon6.png'),
(212, 75, 13, 'icon1.png'),
(207, 74, 18, 'icon6.png'),
(206, 74, 13, 'icon1.png'),
(201, 73, 18, 'icon6.png'),
(200, 73, 13, 'icon1.png'),
(216, 76, 13, 'icon1.png'),
(221, 77, 18, 'icon6.png'),
(220, 77, 13, 'icon1.png'),
(225, 78, 19, 'icon7.png'),
(224, 78, 17, 'icon5.png'),
(231, 79, 19, 'icon7.png'),
(230, 79, 17, 'icon5.png'),
(235, 80, 19, 'icon7.png'),
(234, 80, 17, 'icon5.png'),
(241, 81, 19, 'icon7.png'),
(240, 81, 17, 'icon5.png'),
(245, 82, 19, 'icon7.png'),
(244, 82, 17, 'icon5.png'),
(249, 83, 19, 'icon7.png'),
(248, 83, 17, 'icon5.png'),
(259, 84, 19, 'icon7.png'),
(258, 84, 15, 'icon3.png'),
(257, 84, 17, 'icon5.png'),
(276, 86, 19, 'icon7.png'),
(275, 86, 18, 'icon6.png'),
(274, 86, 13, 'icon1.png'),
(273, 86, 15, 'icon3.png'),
(286, 88, 13, 'icon1.png'),
(285, 88, 16, 'icon4.png'),
(282, 87, 18, 'icon6.png'),
(281, 87, 13, 'icon1.png'),
(287, 88, 18, 'icon6.png'),
(293, 89, 14, 'icon2.png'),
(292, 89, 15, 'icon3.png'),
(291, 89, 16, 'icon4.png'),
(294, 89, 19, 'icon7.png'),
(306, 90, 19, 'icon7.png'),
(305, 90, 14, 'icon2.png'),
(304, 90, 15, 'icon3.png'),
(303, 90, 16, 'icon4.png'),
(337, 94, 18, 'icon6.png'),
(339, 96, 17, 'icon5.png'),
(336, 94, 15, 'icon3.png'),
(335, 94, 16, 'icon4.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page1_text_bottom`
--

DROP TABLE IF EXISTS `page1_text_bottom`;
CREATE TABLE `page1_text_bottom` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page1_text_bottom`
--

INSERT INTO `page1_text_bottom` (`id`, `id_pdf`, `value`) VALUES
(7, 60, ''),
(8, 61, ''),
(9, 62, ''),
(10, 63, ''),
(11, 64, ''),
(12, 65, ''),
(13, 66, ''),
(14, 67, ''),
(15, 68, ''),
(16, 69, ''),
(17, 70, ''),
(18, 71, ''),
(19, 72, ''),
(20, 73, ''),
(21, 74, ''),
(22, 75, ''),
(23, 76, ''),
(24, 77, ''),
(25, 78, ''),
(26, 79, ''),
(27, 80, ''),
(28, 81, ''),
(29, 82, ''),
(30, 83, ''),
(31, 84, ''),
(33, 86, ''),
(34, 87, ''),
(35, 88, ''),
(36, 89, ''),
(37, 90, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page1_text_top`
--

DROP TABLE IF EXISTS `page1_text_top`;
CREATE TABLE `page1_text_top` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `value` text NOT NULL,
  `value_english` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page1_text_top`
--

INSERT INTO `page1_text_top` (`id`, `id_pdf`, `value`, `value_english`) VALUES
(7, 49, '<p>ISP 920H Soja Protein Isolat Emulsion Typzzzz</p>', ''),
(10, 61, 'EF Sojaprotein Bio \r\nKonzentrat - nicht funktional', ''),
(9, 60, 'EF- SPI 920H\r\nSoja Protein Isolat - Emulsion Typ', ''),
(11, 62, 'EF SPI 930M\r\nSoja Protein Isolat', ''),
(12, 63, 'EF-SPI 930E\r\nSoja Protein Isolat', ''),
(13, 64, 'EF-SPI 930F\r\nSoja Protein Isolat', ''),
(14, 65, 'EF- SPI 90G\r\nSoja Protein Isolat - Gelierung Typ', ''),
(15, 66, 'EF- ISP 930\r\nSoja Protein Isolat - Emulsion und visko-elastischer Typ', ''),
(16, 67, 'EF- SHM01J\r\nTexturiertes Soja', ''),
(17, 68, 'EF- YX 702\r\nSoja Protein concentrades', ''),
(18, 69, 'EF- YX702\r\n', ''),
(19, 70, 'EF-SPI950F\r\nSoja Protein Isolat', ''),
(20, 71, 'EF- ISP 510\r\nSoja Protein Isolat ', ''),
(21, 72, 'EF-ISP 930H\r\nSoja Protein Isolat ', ''),
(22, 73, 'EF-ISOPRO FD95E\r\nSoja Protein Isolat ', ''),
(23, 74, 'EF-ISOPRO FD90I\r\nSoja Protein Isolat ', ''),
(24, 75, 'EF-ISOPRO FD90E\r\nSoja Protein Isolat ', ''),
(25, 76, 'EF-WDFPRO 950T\r\nSoja Protein Isolat ', ''),
(26, 77, 'EF-WDFPRO 950E\r\nSoja Protein Isolat ', ''),
(27, 78, 'EF-ISP YX 4000\r\nSoja Protein Isolat ', ''),
(28, 79, 'EF-ISP YX 4001\r\nSoja Protein Isolat ', ''),
(29, 80, 'EF-ISP 610\r\nSoja Protein Isolat ', ''),
(30, 81, 'EF-ISP 620\r\nSoja Protein Isolat ', ''),
(31, 82, 'EF-ISOPRO 516B\r\nSoja Protein Isolat ', ''),
(32, 83, 'EF-ISOPRO618B\r\nSoja Protein Isolat ', ''),
(33, 84, 'EF-ISOPRO619B\r\nSoja Protein Isolat ', ''),
(35, 86, 'EF-CSP 310\r\nDas Sojaprotein-Konzentrat CSP 310', 'test1\r\ntest2'),
(44, 96, 'EF 93\r\nSoja Lecithin Pulver', ''),
(45, 94, 'EF Soja Faser\r\nSoja Ballaststoff funktional', ''),
(36, 87, 'EF-WDFCON-EF\r\nAlkoholextrahiertes Sojakonzentrat, genfreie Sojabohnen höchster Qualität.', ''),
(37, 88, 'EF-WDFCON-C\r\nAlkoholextrahiertes Sojakonzentrat, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet..', ''),
(38, 89, 'EF-YX 100 nicht sterilisiert\r\nSojakonzentrat, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.', ''),
(39, 90, 'EF-YX 100 sterilisiert\r\nSojakonzentrat, genfreie Sojabohnen höchster Qualität, bei niedriger Temperatur entfettet.', ''),
(47, 100, 'germany', 'english'),
(50, 101, 'germany', 'english1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page2_footer`
--

DROP TABLE IF EXISTS `page2_footer`;
CREATE TABLE `page2_footer` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `name` text NOT NULL,
  `name_english` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page2_footer`
--

INSERT INTO `page2_footer` (`id`, `id_pdf`, `name`, `name_english`) VALUES
(14, 49, 'AMINOSÄURE ZUSAMMENSETZUNG (100G PRO TEIN)', 'aminosauenglish'),
(15, 49, 'NÄHRWERTE IN 100G', ''),
(18, 60, 'AMINOSÄURE ZUSAMMENSETZUNG (100G PROTEIN)', ''),
(19, 60, 'NÄHRWERTE IN 100G', ''),
(22, 62, 'AMINOSÄURE ZUSAMMENSETZUNG (100G PROTEIN)', ''),
(23, 62, 'NÄHRWERTE IN 100G', ''),
(24, 63, 'AMINOSÄURE ZUSAMMENSETZUNG (100G PROTEIN)', ''),
(25, 63, 'NÄHRWERTE IN 100G', ''),
(26, 64, 'AMINOSÄURE ZUSAMMENSETZUNG (100G PROTEIN)', ''),
(27, 64, 'NÄHRWERTE IN 100G', ''),
(30, 66, 'AMINOSÄURE ZUSAMMENSETZUNG (100G PROTEIN)', ''),
(29, 65, 'NÄHRWERTE IN 100G', ''),
(31, 66, 'NÄHRWERTE IN 100G', ''),
(33, 67, 'NÄHRWERTE IN 100G', ''),
(39, 71, 'NÄHRWERTE IN 100G', ''),
(38, 71, 'AMINOSÄURE ZUSAMMENSETZUNG (100G PROTEIN)', ''),
(74, 49, 'germany1z', 'englishzz'),
(76, 49, 'test_germany', 'test_english'),
(77, 86, '333', ''),
(78, 86, '5666', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page2_footer_item`
--

DROP TABLE IF EXISTS `page2_footer_item`;
CREATE TABLE `page2_footer_item` (
  `id` int(11) NOT NULL,
  `id_page2_footer` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `name_english` varchar(150) NOT NULL,
  `value` varchar(50) NOT NULL,
  `value_english` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page2_footer_item`
--

INSERT INTO `page2_footer_item` (`id`, `id_page2_footer`, `name`, `name_english`, `value`, `value_english`) VALUES
(30, 14, 'Analine', '', '4,1', ''),
(31, 14, 'Arginine', '', '8,0', ''),
(32, 14, 'Aspartic acid', '', '12,0', ''),
(33, 14, 'Glutamic acid', '', '20,4', ''),
(34, 14, 'Cystine', '', '1,3', ''),
(35, 14, 'Glycine', '', '4,1', ''),
(36, 14, 'Histidine', '', '2,6', ''),
(37, 14, 'Isoleucine', '', '4,2', ''),
(38, 14, 'Tyrosine', '', '4,1', ''),
(39, 14, 'Leucine', '', '7,7', ''),
(40, 14, 'Lysine', '', '6,4', ''),
(41, 14, 'Methionine', '', '1,3', ''),
(42, 14, 'Phenylalanine', '', '5,4', ''),
(43, 14, 'Proline', '', '5,3', ''),
(44, 14, 'Serine', '', '5,6', ''),
(45, 14, 'Threonine', '', '3,6', ''),
(46, 14, 'Tryptophan', '', '1,0', ''),
(47, 14, 'Valine', '', '4,5', ''),
(48, 15, 'Ballaststoff', '', '5,6g', ''),
(49, 15, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(50, 15, 'Fett', '', '3,4 g', ''),
(51, 15, 'Kohlenhydrate', '', '7,36 g', ''),
(52, 15, 'Protein', '', '81 g', ''),
(94, 18, 'Tryptophan', '', '1,0', ''),
(93, 18, 'Threonine', '', '3,6', ''),
(92, 18, 'Serine', '', '5,6', ''),
(91, 18, 'Proline', '', '5,3', ''),
(90, 18, 'Phenylalanine', '', '5,4', ''),
(89, 18, 'Methionine', '', '1,3', ''),
(88, 18, 'Lysine', '', '6,4', ''),
(87, 18, 'Leucine', '', '7,7', ''),
(86, 18, 'Tyrosine', '', '4,1', ''),
(85, 18, 'Isoleucine', '', '4,2', ''),
(84, 18, 'Histidine', '', '2,6', ''),
(83, 18, 'Glycine', '', '4,1', ''),
(82, 18, 'Cystine', '', '1,3', ''),
(81, 18, 'Glutamic acid', '', '20,4', ''),
(80, 18, 'Aspartic acid', '', '12,0', ''),
(79, 18, 'Arginine', '', '8,0', ''),
(78, 18, 'Analine', '', '4,1', ''),
(230, 30, 'Tryptophan', '', '1,0', ''),
(95, 18, 'Valine', '', '4,5', ''),
(96, 18, 'Ballaststoff', '', '8,0', ''),
(97, 19, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(98, 19, 'Fett', '', '3,4g', ''),
(99, 19, 'Kohlenhydrate', '', '7,36g', ''),
(100, 19, 'Protein', '', '81g', ''),
(102, 20, 'Tryptophan', '', '8,0', ''),
(103, 20, 'Threonine', '', '8,0', ''),
(104, 20, 'Serine', '', '8,0', ''),
(105, 20, 'Roline', '', '8,0', ''),
(106, 20, 'Phenylalanine', '', '8,0', ''),
(107, 20, 'Methionine', '', '8,0', ''),
(108, 20, 'Lysine', '', '8,0', ''),
(109, 20, 'Leucine', '', '8,0', ''),
(110, 20, 'Tyrosine', '', '8,0', ''),
(111, 20, 'Isoleucine', '', '8,0', ''),
(112, 20, 'Histidine', '', '8,0', ''),
(113, 20, 'Glycine', '', '8,0', ''),
(114, 20, 'Cystine', '', '8,0', ''),
(115, 20, 'Glutamic acid', '', '8,0', ''),
(116, 20, 'Aspartic acid', '', '8,0', ''),
(117, 20, 'Arginine', '', '8,0', ''),
(118, 20, 'Analine', '', '4,1', ''),
(119, 20, 'E-Coli', '', 'negativ', ''),
(120, 20, 'Valine', '', '8,0', ''),
(121, 20, 'Ballaststoff', '', '8,0', ''),
(122, 21, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(123, 21, 'Fett', '', '3,4 g', ''),
(124, 21, 'Kohlenhydrate', '', '7,36 g', ''),
(125, 21, 'Protein', '', '81 g', ''),
(127, 22, 'Analine', '', '3,793', ''),
(128, 22, 'Arginine', '', '7,725', ''),
(129, 22, 'Aspartic acid', '', '12,34', ''),
(130, 22, 'Glutamic acid', '', '19,741', ''),
(131, 22, 'Cystine', '', '1,133', ''),
(132, 22, 'Glycine', '', '4,152', ''),
(133, 22, 'Histidine', '', '2,625', ''),
(134, 22, 'Isoleucine', '', '4,14', ''),
(135, 22, 'Tyrosine', '', '4,684', ''),
(136, 22, 'Leucine', '', '7,737', ''),
(137, 22, 'Lysine', '', '6,129', ''),
(138, 22, 'Methionine', '', '1,295', ''),
(139, 22, 'Phenylalanine', '', '5,343', ''),
(140, 22, 'Proline', '', '4,637', ''),
(141, 22, 'Serine', '', '5,574', ''),
(142, 22, 'Threonine', '', '4,163', ''),
(143, 22, 'Tryptophan', '', '1,018', ''),
(144, 22, 'Valine', '', '3,77', ''),
(145, 23, 'Ballaststoff', '', '< 2g', ''),
(146, 23, 'Brennwert', '', '1.589,92 kJ/380 kcal', ''),
(147, 23, 'Fett', '', '&lt; 1', ''),
(148, 23, 'Kohlenhydrate', '', '&lt; 3', ''),
(149, 23, 'Protein', '', '90g', ''),
(282, 34, 'Arginine', '', '8,0', ''),
(256, 32, 'Arginine', '', '8,0', ''),
(281, 34, 'Analine', '', '4,1', ''),
(150, 19, 'Ballaststoffe', '', '5,6g', ''),
(153, 24, 'Analine', '', '3,793', ''),
(154, 24, 'Arginine', '', '7,725', ''),
(155, 24, 'Aspartic acid', '', '12,34', ''),
(156, 24, 'Glutamic acid', '', '19,741', ''),
(157, 24, 'Cystine', '', '1,133', ''),
(158, 24, 'Glycine', '', '4,152', ''),
(159, 24, 'Histidine', '', '2,625', ''),
(160, 24, 'Isoleucine', '', '4,14', ''),
(161, 24, 'Tyrosine', '', '4,684', ''),
(162, 24, 'Leucine', '', '7,737', ''),
(163, 24, 'Lysine', '', '6,129', ''),
(164, 24, 'Methionine', '', '1,295', ''),
(165, 24, 'Phenylalanine', '', '5,343', ''),
(166, 24, 'Proline', '', '4,637', ''),
(167, 24, 'Serine', '', '5,574', ''),
(168, 24, 'Threonine', '', '4,163', ''),
(169, 24, 'Tryptophan', '', '1,018', ''),
(170, 24, 'Valine', '', '3,77', ''),
(172, 25, 'Brennwert', '', '1.589,92 kJ/380 kcal', ''),
(173, 25, 'Fett', '', '< 1', ''),
(174, 25, 'Kohlenhydrate', '', '< 3', ''),
(175, 25, 'Protein', '', '90g', ''),
(176, 23, 'Zucker', '', '&lt; 1g', ''),
(177, 25, 'Zucker', '', '< 1g', ''),
(178, 26, 'Analine', '', '3,793', ''),
(179, 26, 'Arginine', '', '7,725', ''),
(180, 26, 'Aspartic acid', '', '12,34', ''),
(181, 26, 'Glutamic acid', '', '19,741', ''),
(182, 26, 'Cystine', '', '1,133', ''),
(183, 26, 'Glycine', '', '4,152', ''),
(184, 26, 'Histidine', '', '2,625', ''),
(185, 26, 'Isoleucine', '', '4,14', ''),
(186, 26, 'Tyrosine', '', '4,684', ''),
(187, 26, 'Leucine', '', '7,737', ''),
(188, 26, 'Lysine', '', '6,129', ''),
(189, 26, 'Methionine', '', '1,295', ''),
(190, 26, 'Phenylalanine', '', '5,343', ''),
(191, 26, 'Proline', '', '4,637', ''),
(192, 26, 'Serine', '', '5,574', ''),
(193, 26, 'Threonine', '', '4,163', ''),
(194, 26, 'Tryptophan', '', '1,018', ''),
(195, 26, 'Valine', '', '3,77', ''),
(196, 27, 'Brennwert', '', '1.589,92 kJ/380 kcal', ''),
(197, 27, 'Fett', '', '< 1', ''),
(198, 27, 'Kohlenhydrate', '', '< 3', ''),
(199, 27, 'Protein', '', '90g', ''),
(200, 27, 'Zucker', '', '< 1g', ''),
(201, 28, 'Tryptophan', '', '1,018', ''),
(202, 28, 'Threonine', '', '4,163', ''),
(203, 28, 'Serine', '', '5,574', ''),
(204, 28, 'Proline', '', '4,637', ''),
(205, 28, 'Phenylalanine', '', 'Phenylalanine', ''),
(206, 28, 'Methionine', '', '1,295', ''),
(207, 28, 'Lysine', '', '6,129', ''),
(208, 28, 'Leucine', '', '7,737', ''),
(209, 28, 'Tyrosine', '', '4,684', ''),
(210, 28, 'Isoleucine', '', '4,14', ''),
(211, 28, 'Histidine', '', '2,625', ''),
(212, 28, 'Glycine', '', '4,152', ''),
(213, 28, 'Cystine', '', '1,133', ''),
(214, 28, 'Glutamic acid', '', '19,741', ''),
(215, 28, 'Aspartic acid', '', '12,34', ''),
(216, 28, 'Arginine', '', '7,725', ''),
(217, 28, 'Analine', '', '3,793', ''),
(219, 28, 'Valine', '', '3,77', ''),
(220, 28, 'Ballaststoff', '', '8,0', ''),
(221, 29, 'Brennwert', '', '1.543 kJ', ''),
(222, 29, 'Fett', '', 'Max. 0,5', ''),
(223, 29, 'Kohlenhydrate', '', 'Max. 5g', ''),
(227, 29, 'Fett - davon gesättigte Fettsäuren (g)', '', 'Max. 0,1', ''),
(228, 29, 'Zucker', '', 'Max. 0,1', ''),
(229, 29, 'Eiweiß', '', 'Min. 90g', ''),
(231, 30, 'Threonine', '', '3,6', ''),
(232, 30, 'Serine', '', '5,6', ''),
(233, 30, 'Proline', '', '5,3', ''),
(234, 30, 'Phenylalanine', '', '5,4', ''),
(235, 30, 'Methionine', '', '1,3', ''),
(236, 30, 'Lysine', '', '6,4', ''),
(237, 30, 'Leucine', '', '7,7', ''),
(238, 30, 'Tyrosine', '', '4,1', ''),
(239, 30, 'Isoleucine', '', '4,2', ''),
(240, 30, 'Histidine', '', '2,6', ''),
(241, 30, 'Glycine', '', '4,1', ''),
(242, 30, 'Cystine', '', '1,3', ''),
(243, 30, 'Glutamic acid', '', '20,4', ''),
(244, 30, 'Aspartic acid', '', '12,0', ''),
(245, 30, 'Arginine', '', '8,0', ''),
(246, 30, 'Analine', '', '4,1', ''),
(247, 30, 'Valine', '', '4,5', ''),
(248, 30, 'Ballaststoff', '', '8,0', ''),
(249, 31, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(250, 31, 'Fett', '', '3,4g', ''),
(251, 31, 'Kohlenhydrate', '', '7,36g', ''),
(252, 31, 'Protein', '', '81g', ''),
(253, 31, 'Ballaststoffe', '', '5,6g', ''),
(255, 32, 'Analine', '', '4,1', ''),
(257, 32, 'Aspartic acid', '', '12,0', ''),
(258, 32, 'Glutamic acid', '', '20,4', ''),
(259, 32, 'Cystine', '', '1,3', ''),
(260, 32, 'Glycine', '', '4,1', ''),
(261, 32, 'Histidine', '', '2,6', ''),
(262, 32, 'Isoleucine', '', '4,2', ''),
(263, 32, 'Tyrosine', '', '4,1', ''),
(264, 32, 'Leucine', '', '7,7', ''),
(265, 32, 'Lysine', '', '6,4', ''),
(266, 32, 'Methionine', '', '1,3', ''),
(267, 32, 'Phenylalanine', '', '5,4', ''),
(268, 32, 'Roline', '', '5,3', ''),
(269, 32, 'Serine', '', '5,6', ''),
(270, 32, 'Threonine', '', '3,6', ''),
(271, 32, 'Tryptophan', '', '1,0', ''),
(272, 32, 'Valine', '', '4,5', ''),
(273, 33, 'Ballaststoff', '', '14g', ''),
(274, 33, 'Brennwert', '', '1528 KJ/360 kcal', ''),
(275, 33, 'Fett', '', '0,5g', ''),
(276, 33, 'Kohlenhydrate', '', '42g', ''),
(277, 33, 'Zucker', '', '8g', ''),
(278, 33, 'Ges. Fetts.', '', '0g', ''),
(279, 33, 'Eiweiß', '', '46g', ''),
(280, 33, 'Natrium', '', '35mg', ''),
(283, 34, 'Aspartic acid', '', '12,0', ''),
(284, 34, 'Glutamic acid', '', '20,4', ''),
(285, 34, 'Cystine', '', '1,3', ''),
(286, 34, 'Glycine', '', '4,1', ''),
(287, 34, 'Histidine', '', '2,6', ''),
(288, 34, 'Isoleucine', '', '4,2', ''),
(289, 34, 'Tyrosine', '', '4,1', ''),
(290, 34, 'Leucine', '', '7,7', ''),
(291, 34, 'Lysine', '', '6,4', ''),
(292, 34, 'Methionine', '', '1,3', ''),
(293, 34, 'Phenylalanine', '', '5,4', ''),
(294, 34, 'Proline', '', '5,3', ''),
(295, 34, 'Serine', '', '5,6', ''),
(296, 34, 'Threonine', '', '3,6', ''),
(297, 34, 'Tryptophan', '', '1,0', ''),
(298, 34, 'Valine', '', '4,5', ''),
(299, 35, 'Ballaststoff', '', '5,6g', ''),
(300, 35, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(301, 35, 'Fett', '', '3,4 g', ''),
(302, 35, 'Kohlenhydrate', '', '7,36 g', ''),
(303, 35, 'Protein', '', '81 g', ''),
(304, 36, 'Analine', '', '4,1', ''),
(305, 36, 'Arginine', '', '8,0', ''),
(306, 36, 'Aspartic acid', '', '12,0', ''),
(307, 36, 'Glutamic acid', '', '20,4', ''),
(308, 36, 'Cystine', '', '1,3', ''),
(309, 36, 'Glycine', '', '4,1', ''),
(310, 36, 'Histidine', '', '2,6', ''),
(311, 36, 'Isoleucine', '', '4,2', ''),
(312, 36, 'Tyrosine', '', '4,1', ''),
(313, 36, 'Leucine', '', '7,7', ''),
(314, 36, 'Lysine', '', '6,4', ''),
(315, 36, 'Methionine', '', '1,3', ''),
(316, 36, 'Phenylalanine', '', '5,4', ''),
(317, 36, 'Proline', '', '5,3', ''),
(318, 36, 'Serine', '', '5,6', ''),
(319, 36, 'Threonine', '', '3,6', ''),
(320, 36, 'Tryptophan', '', '1,0', ''),
(321, 36, 'Valine', '', '4,5', ''),
(322, 37, 'Ballaststoff', '', '5,6g', ''),
(323, 37, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(324, 37, 'Fett', '', '3,4 g', ''),
(325, 37, 'Kohlenhydrate', '', '7,36 g', ''),
(326, 37, 'Protein', '', '81 g', ''),
(327, 38, 'Tryptophan', '', '1,0', ''),
(328, 38, 'Threonine', '', '3,6', ''),
(329, 38, 'Serine', '', '5,6', ''),
(330, 38, 'Proline', '', '5,3', ''),
(331, 38, 'Phenylalanine', '', '5,4', ''),
(332, 38, 'Methionine', '', '1,3', ''),
(333, 38, 'Lysine', '', '6,4', ''),
(334, 38, 'Leucine', '', '7,7', ''),
(335, 38, 'Tyrosine', '', '4,1', ''),
(336, 38, 'Isoleucine', '', '4,2', ''),
(337, 38, 'Histidine', '', '2,6', ''),
(338, 38, 'Glycine', '', '4,1', ''),
(339, 38, 'Cystine', '', '1,3', ''),
(340, 38, 'Glutamic acid', '', '20,4', ''),
(341, 38, 'Aspartic acid', '', '12,0', ''),
(342, 38, 'Arginine', '', '8,0', ''),
(343, 38, 'Analine', '', '4,1', ''),
(344, 38, 'Valine', '', '4,5', ''),
(345, 38, 'Ballaststoff', '', '8,0', ''),
(346, 39, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(347, 39, 'Fett', '', '3,4g', ''),
(348, 39, 'Kohlenhydrate', '', '7,36g', ''),
(349, 39, 'Protein', '', '81g', ''),
(350, 39, 'Ballaststoffe', '', '5,6g', ''),
(351, 40, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(352, 40, 'Fett', '', '3,4g', ''),
(353, 40, 'Kohlenhydrate', '', '7,36g', ''),
(354, 40, 'Protein', '', '81g', ''),
(355, 40, 'Ballaststoffe', '', '5,6g', ''),
(356, 41, 'Tryptophan', '', '1,0', ''),
(357, 41, 'Threonine', '', '3,6', ''),
(358, 41, 'Serine', '', '5,6', ''),
(359, 41, 'Proline', '', '5,3', ''),
(360, 41, 'Phenylalanine', '', '5,4', ''),
(361, 41, 'Methionine', '', '1,3', ''),
(362, 41, 'Lysine', '', '6,4', ''),
(363, 41, 'Leucine', '', '7,7', ''),
(364, 41, 'Tyrosine', '', '4,1', ''),
(365, 41, 'Isoleucine', '', '4,2', ''),
(366, 41, 'Histidine', '', '2,6', ''),
(367, 41, 'Glycine', '', '4,1', ''),
(368, 41, 'Cystine', '', '1,3', ''),
(369, 41, 'Glutamic acid', '', '20,4', ''),
(370, 41, 'Aspartic acid', '', '12,0', ''),
(371, 41, 'Arginine', '', '8,0', ''),
(372, 41, 'Analine', '', '4,1', ''),
(373, 41, 'Valine', '', '4,5', ''),
(374, 41, 'Ballaststoff', '', '8,0', ''),
(375, 42, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(376, 42, 'Fett', '', '3,4g', ''),
(377, 42, 'Kohlenhydrate', '', '7,36g', ''),
(378, 42, 'Protein', '', '81g', ''),
(379, 42, 'Ballaststoffe', '', '5,6g', ''),
(380, 43, 'Tryptophan', '', '1,0', ''),
(381, 43, 'Threonine', '', '3,6', ''),
(382, 43, 'Serine', '', '5,6', ''),
(383, 43, 'Proline', '', '5,3', ''),
(384, 43, 'Phenylalanine', '', '5,4', ''),
(385, 43, 'Methionine', '', '1,3', ''),
(386, 43, 'Lysine', '', '6,4', ''),
(387, 43, 'Leucine', '', '7,7', ''),
(388, 43, 'Tyrosine', '', '4,1', ''),
(389, 43, 'Isoleucine', '', '4,2', ''),
(390, 43, 'Histidine', '', '2,6', ''),
(391, 43, 'Glycine', '', '4,1', ''),
(392, 43, 'Cystine', '', '1,3', ''),
(393, 43, 'Glutamic acid', '', '20,4', ''),
(394, 43, 'Aspartic acid', '', '12,0', ''),
(395, 43, 'Arginine', '', '8,0', ''),
(396, 43, 'Analine', '', '4,1', ''),
(397, 43, 'Valine', '', '4,5', ''),
(398, 43, 'Ballaststoff', '', '8,0', ''),
(399, 44, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(400, 44, 'Fett', '', '3,4g', ''),
(401, 44, 'Kohlenhydrate', '', '7,36g', ''),
(402, 44, 'Protein', '', '81g', ''),
(403, 44, 'Ballaststoffe', '', '5,6g', ''),
(404, 45, 'Tryptophan', '', '1,0', ''),
(405, 45, 'Threonine', '', '3,6', ''),
(406, 45, 'Serine', '', '5,6', ''),
(407, 45, 'Proline', '', '5,3', ''),
(408, 45, 'Phenylalanine', '', '5,4', ''),
(409, 45, 'Methionine', '', '1,3', ''),
(410, 45, 'Lysine', '', '6,4', ''),
(411, 45, 'Leucine', '', '7,7', ''),
(412, 45, 'Tyrosine', '', '4,1', ''),
(413, 45, 'Isoleucine', '', '4,2', ''),
(414, 45, 'Histidine', '', '2,6', ''),
(415, 45, 'Glycine', '', '4,1', ''),
(416, 45, 'Cystine', '', '1,3', ''),
(417, 45, 'Glutamic acid', '', '20,4', ''),
(418, 45, 'Aspartic acid', '', '12,0', ''),
(419, 45, 'Arginine', '', '8,0', ''),
(420, 45, 'Analine', '', '4,1', ''),
(421, 45, 'Valine', '', '4,5', ''),
(422, 45, 'Ballaststoff', '', '8,0', ''),
(423, 46, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(424, 46, 'Fett', '', '3,4g', ''),
(425, 46, 'Kohlenhydrate', '', '7,36g', ''),
(426, 46, 'Protein', '', '81g', ''),
(427, 46, 'Ballaststoffe', '', '5,6g', ''),
(428, 47, 'Tryptophan', '', '1,0', ''),
(429, 47, 'Threonine', '', '3,6', ''),
(430, 47, 'Serine', '', '5,6', ''),
(431, 47, 'Proline', '', '5,3', ''),
(432, 47, 'Phenylalanine', '', '5,4', ''),
(433, 47, 'Methionine', '', '1,3', ''),
(434, 47, 'Lysine', '', '6,4', ''),
(435, 47, 'Leucine', '', '7,7', ''),
(436, 47, 'Tyrosine', '', '4,1', ''),
(437, 47, 'Isoleucine', '', '4,2', ''),
(438, 47, 'Histidine', '', '2,6', ''),
(439, 47, 'Glycine', '', '4,1', ''),
(440, 47, 'Cystine', '', '1,3', ''),
(441, 47, 'Glutamic acid', '', '20,4', ''),
(442, 47, 'Aspartic acid', '', '12,0', ''),
(443, 47, 'Arginine', '', '8,0', ''),
(444, 47, 'Analine', '', '4,1', ''),
(445, 47, 'Valine', '', '4,5', ''),
(446, 47, 'Ballaststoff', '', '8,0', ''),
(447, 48, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(448, 48, 'Fett', '', '3,4g', ''),
(449, 48, 'Kohlenhydrate', '', '7,36g', ''),
(450, 48, 'Protein', '', '81g', ''),
(451, 48, 'Ballaststoffe', '', '5,6g', ''),
(452, 49, 'Tryptophan', '', '1,0', ''),
(453, 49, 'Threonine', '', '3,6', ''),
(454, 49, 'Serine', '', '5,6', ''),
(455, 49, 'Proline', '', '5,3', ''),
(456, 49, 'Phenylalanine', '', '5,4', ''),
(457, 49, 'Methionine', '', '1,3', ''),
(458, 49, 'Lysine', '', '6,4', ''),
(459, 49, 'Leucine', '', '7,7', ''),
(460, 49, 'Tyrosine', '', '4,1', ''),
(461, 49, 'Isoleucine', '', '4,2', ''),
(462, 49, 'Histidine', '', '2,6', ''),
(463, 49, 'Glycine', '', '4,1', ''),
(464, 49, 'Cystine', '', '1,3', ''),
(465, 49, 'Glutamic acid', '', '20,4', ''),
(466, 49, 'Aspartic acid', '', '12,0', ''),
(467, 49, 'Arginine', '', '8,0', ''),
(468, 49, 'Analine', '', '4,1', ''),
(469, 49, 'Valine', '', '4,5', ''),
(470, 49, 'Ballaststoff', '', '8,0', ''),
(471, 50, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(472, 50, 'Fett', '', '3,4g', ''),
(473, 50, 'Kohlenhydrate', '', '7,36g', ''),
(474, 50, 'Protein', '', '81g', ''),
(475, 50, 'Ballaststoffe', '', '5,6g', ''),
(476, 51, 'Tryptophan', '', '1,0', ''),
(477, 51, 'Threonine', '', '3,6', ''),
(478, 51, 'Serine', '', '5,6', ''),
(479, 51, 'Proline', '', '5,3', ''),
(480, 51, 'Phenylalanine', '', '5,4', ''),
(481, 51, 'Methionine', '', '1,3', ''),
(482, 51, 'Lysine', '', '6,4', ''),
(483, 51, 'Leucine', '', '7,7', ''),
(484, 51, 'Tyrosine', '', '4,1', ''),
(485, 51, 'Isoleucine', '', '4,2', ''),
(486, 51, 'Histidine', '', '2,6', ''),
(487, 51, 'Glycine', '', '4,1', ''),
(488, 51, 'Cystine', '', '1,3', ''),
(489, 51, 'Glutamic acid', '', '20,4', ''),
(490, 51, 'Aspartic acid', '', '12,0', ''),
(491, 51, 'Arginine', '', '8,0', ''),
(492, 51, 'Analine', '', '4,1', ''),
(493, 51, 'Valine', '', '4,5', ''),
(494, 51, 'Ballaststoff', '', '8,0', ''),
(495, 52, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(496, 52, 'Fett', '', '3,4g', ''),
(497, 52, 'Kohlenhydrate', '', '7,36g', ''),
(498, 52, 'Protein', '', '81g', ''),
(499, 52, 'Ballaststoffe', '', '5,6g', ''),
(500, 53, 'Tryptophan', '', '1,0', ''),
(501, 53, 'Threonine', '', '3,6', ''),
(502, 53, 'Serine', '', '5,6', ''),
(503, 53, 'Proline', '', '5,3', ''),
(504, 53, 'Phenylalanine', '', '5,4', ''),
(505, 53, 'Methionine', '', '1,3', ''),
(506, 53, 'Lysine', '', '6,4', ''),
(507, 53, 'Leucine', '', '7,7', ''),
(508, 53, 'Tyrosine', '', '4,1', ''),
(509, 53, 'Isoleucine', '', '4,2', ''),
(510, 53, 'Histidine', '', '2,6', ''),
(511, 53, 'Glycine', '', '4,1', ''),
(512, 53, 'Cystine', '', '1,3', ''),
(513, 53, 'Glutamic acid', '', '20,4', ''),
(514, 53, 'Aspartic acid', '', '12,0', ''),
(515, 53, 'Arginine', '', '8,0', ''),
(516, 53, 'Analine', '', '4,1', ''),
(517, 53, 'Valine', '', '4,5', ''),
(518, 53, 'Ballaststoff', '', '8,0', ''),
(519, 54, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(520, 54, 'Fett', '', '3,4g', ''),
(521, 54, 'Kohlenhydrate', '', '7,36g', ''),
(522, 54, 'Protein', '', '81g', ''),
(523, 54, 'Ballaststoffe', '', '5,6g', ''),
(524, 55, 'Tryptophan', '', '1,0', ''),
(525, 55, 'Threonine', '', '3,6', ''),
(526, 55, 'Serine', '', '5,6', ''),
(527, 55, 'Proline', '', '5,3', ''),
(528, 55, 'Phenylalanine', '', '5,4', ''),
(529, 55, 'Methionine', '', '1,3', ''),
(530, 55, 'Lysine', '', '6,4', ''),
(531, 55, 'Leucine', '', '7,7', ''),
(532, 55, 'Tyrosine', '', '4,1', ''),
(533, 55, 'Isoleucine', '', '4,2', ''),
(534, 55, 'Histidine', '', '2,6', ''),
(535, 55, 'Glycine', '', '4,1', ''),
(536, 55, 'Cystine', '', '1,3', ''),
(537, 55, 'Glutamic acid', '', '20,4', ''),
(538, 55, 'Aspartic acid', '', '12,0', ''),
(539, 55, 'Arginine', '', '8,0', ''),
(540, 55, 'Analine', '', '4,1', ''),
(541, 55, 'Valine', '', '4,5', ''),
(542, 55, 'Ballaststoff', '', '8,0', ''),
(543, 56, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(544, 56, 'Fett', '', '3,4g', ''),
(545, 56, 'Kohlenhydrate', '', '7,36g', ''),
(546, 56, 'Protein', '', '81g', ''),
(547, 56, 'Ballaststoffe', '', '5,6g', ''),
(548, 57, 'Tryptophan', '', '1,0', ''),
(549, 57, 'Threonine', '', '3,6', ''),
(550, 57, 'Serine', '', '5,6', ''),
(551, 57, 'Proline', '', '5,3', ''),
(552, 57, 'Phenylalanine', '', '5,4', ''),
(553, 57, 'Methionine', '', '1,3', ''),
(554, 57, 'Lysine', '', '6,4', ''),
(555, 57, 'Leucine', '', '7,7', ''),
(556, 57, 'Tyrosine', '', '4,1', ''),
(557, 57, 'Isoleucine', '', '4,2', ''),
(558, 57, 'Histidine', '', '2,6', ''),
(559, 57, 'Glycine', '', '4,1', ''),
(560, 57, 'Cystine', '', '1,3', ''),
(561, 57, 'Glutamic acid', '', '20,4', ''),
(562, 57, 'Aspartic acid', '', '12,0', ''),
(563, 57, 'Arginine', '', '8,0', ''),
(564, 57, 'Analine', '', '4,1', ''),
(565, 57, 'Valine', '', '4,5', ''),
(566, 57, 'Ballaststoff', '', '8,0', ''),
(567, 58, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(568, 58, 'Fett', '', '3,4g', ''),
(569, 58, 'Kohlenhydrate', '', '7,36g', ''),
(570, 58, 'Protein', '', '81g', ''),
(571, 58, 'Ballaststoffe', '', '5,6g', ''),
(572, 59, 'Tryptophan', '', '1,0', ''),
(573, 59, 'Threonine', '', '3,6', ''),
(574, 59, 'Serine', '', '5,6', ''),
(575, 59, 'Proline', '', '5,3', ''),
(576, 59, 'Phenylalanine', '', '5,4', ''),
(577, 59, 'Methionine', '', '1,3', ''),
(578, 59, 'Lysine', '', '6,4', ''),
(579, 59, 'Leucine', '', '7,7', ''),
(580, 59, 'Tyrosine', '', '4,1', ''),
(581, 59, 'Isoleucine', '', '4,2', ''),
(582, 59, 'Histidine', '', '2,6', ''),
(583, 59, 'Glycine', '', '4,1', ''),
(584, 59, 'Cystine', '', '1,3', ''),
(585, 59, 'Glutamic acid', '', '20,4', ''),
(586, 59, 'Aspartic acid', '', '12,0', ''),
(587, 59, 'Arginine', '', '8,0', ''),
(588, 59, 'Analine', '', '4,1', ''),
(589, 59, 'Valine', '', '4,5', ''),
(590, 59, 'Ballaststoff', '', '8,0', ''),
(591, 60, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(592, 60, 'Fett', '', '3,4g', ''),
(593, 60, 'Kohlenhydrate', '', '7,36g', ''),
(594, 60, 'Protein', '', '81g', ''),
(595, 60, 'Ballaststoffe', '', '5,6g', ''),
(596, 61, 'Tryptophan', '', '1,0', ''),
(597, 61, 'Threonine', '', '3,6', ''),
(598, 61, 'Serine', '', '5,6', ''),
(599, 61, 'Proline', '', '5,3', ''),
(600, 61, 'Phenylalanine', '', '5,4', ''),
(601, 61, 'Methionine', '', '1,3', ''),
(602, 61, 'Lysine', '', '6,4', ''),
(603, 61, 'Leucine', '', '7,7', ''),
(604, 61, 'Tyrosine', '', '4,1', ''),
(605, 61, 'Isoleucine', '', '4,2', ''),
(606, 61, 'Histidine', '', '2,6', ''),
(607, 61, 'Glycine', '', '4,1', ''),
(608, 61, 'Cystine', '', '1,3', ''),
(609, 61, 'Glutamic acid', '', '20,4', ''),
(610, 61, 'Aspartic acid', '', '12,0', ''),
(611, 61, 'Arginine', '', '8,0', ''),
(612, 61, 'Analine', '', '4,1', ''),
(613, 61, 'Valine', '', '4,5', ''),
(614, 61, 'Ballaststoff', '', '8,0', ''),
(615, 62, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(616, 62, 'Fett', '', '3,4g', ''),
(617, 62, 'Kohlenhydrate', '', '7,36g', ''),
(618, 62, 'Protein', '', '81g', ''),
(619, 62, 'Ballaststoffe', '', '5,6g', ''),
(620, 63, 'Tryptophan', '', '1,0', ''),
(621, 63, 'Threonine', '', '3,6', ''),
(622, 63, 'Serine', '', '5,6', ''),
(623, 63, 'Proline', '', '5,3', ''),
(624, 63, 'Phenylalanine', '', '5,4', ''),
(625, 63, 'Methionine', '', '1,3', ''),
(626, 63, 'Lysine', '', '6,4', ''),
(627, 63, 'Leucine', '', '7,7', ''),
(628, 63, 'Tyrosine', '', '4,1', ''),
(629, 63, 'Isoleucine', '', '4,2', ''),
(630, 63, 'Histidine', '', '2,6', ''),
(631, 63, 'Glycine', '', '4,1', ''),
(632, 63, 'Cystine', '', '1,3', ''),
(633, 63, 'Glutamic acid', '', '20,4', ''),
(634, 63, 'Aspartic acid', '', '12,0', ''),
(635, 63, 'Arginine', '', '8,0', ''),
(636, 63, 'Analine', '', '4,1', ''),
(637, 63, 'Valine', '', '4,5', ''),
(638, 63, 'Ballaststoff', '', '8,0', ''),
(639, 64, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(640, 64, 'Fett', '', '3,4g', ''),
(641, 64, 'Kohlenhydrate', '', '7,36g', ''),
(642, 64, 'Protein', '', '81g', ''),
(643, 64, 'Ballaststoffe', '', '5,6g', ''),
(644, 65, 'Tryptophan', '', '1,0', ''),
(645, 65, 'Threonine', '', '3,6', ''),
(646, 65, 'Serine', '', '5,6', ''),
(647, 65, 'Proline', '', '5,3', ''),
(648, 65, 'Phenylalanine', '', '5,4', ''),
(649, 65, 'Methionine', '', '1,3', ''),
(650, 65, 'Lysine', '', '6,4', ''),
(651, 65, 'Leucine', '', '7,7', ''),
(652, 65, 'Tyrosine', '', '4,1', ''),
(653, 65, 'Isoleucine', '', '4,2', ''),
(654, 65, 'Histidine', '', '2,6', ''),
(655, 65, 'Glycine', '', '4,1', ''),
(656, 65, 'Cystine', '', '1,3', ''),
(657, 65, 'Glutamic acid', '', '20,4', ''),
(658, 65, 'Aspartic acid', '', '12,0', ''),
(659, 65, 'Arginine', '', '8,0', ''),
(660, 65, 'Analine', '', '4,1', ''),
(661, 65, 'Valine', '', '4,5', ''),
(662, 65, 'Ballaststoff', '', '8,0', ''),
(663, 66, 'Brennwert', '', '1.414,192 kJ/338 kcal', ''),
(664, 66, 'Fett', '', '3,4g', ''),
(665, 66, 'Kohlenhydrate', '', '7,36g', ''),
(666, 66, 'Protein', '', '81g', ''),
(667, 66, 'Ballaststoffe', '', '5,6g', ''),
(668, 67, 'Tryptophan', '', '1,0', ''),
(669, 67, 'Threonine', '', '3,6', ''),
(670, 67, 'Serine', '', '5,6', ''),
(671, 67, 'Proline', '', '5,3', ''),
(672, 67, 'Phenylalanine', '', '5,4', ''),
(673, 67, 'Methionine', '', '1,3', ''),
(674, 67, 'Lysine', '', '6,4', ''),
(675, 67, 'Leucine', '', '7,7', ''),
(676, 67, 'Tyrosine', '', '4,1', ''),
(677, 67, 'Isoleucine', '', '4,2', ''),
(678, 67, 'Histidine', '', '2,6', ''),
(679, 67, 'Glycine', '', '4,1', ''),
(680, 67, 'Cystine', '', '1,3', ''),
(681, 67, 'Glutamic acid', '', '20,4', ''),
(682, 67, 'Aspartic acid', '', '12,0', ''),
(683, 67, 'Arginine', '', '8,0', ''),
(684, 67, 'Analine', '', '4,1', ''),
(685, 67, 'Valine', '', '4,5', ''),
(686, 67, 'Ballaststoff', '', '8,0', ''),
(687, 69, 'Verzehrbarer Ballaststoff (Trockenbasis)', '', 'Min. 60%', ''),
(688, 69, 'Proteingehalt i. Tr. ', '', 'Max. 20%', ''),
(689, 69, 'Feuchtigkeitsgrad (%)', '', 'Max. 10%', ''),
(690, 69, 'pH-Wert', '', '6,5 - 7,5', ''),
(691, 69, 'Fett', '', 'Max. 1%', ''),
(692, 69, 'Asche', '', 'Max. 5%', ''),
(693, 69, 'Blei', '', 'Max. 1,0 ppm', ''),
(694, 69, 'Arsen', '', 'Max. 0,5 ppm', ''),
(695, 71, 'Salmonellen', '', 'negativ', ''),
(696, 71, 'E. Coli', '', 'negativ', ''),
(697, 71, 'Pathogen', '', 'negativ', ''),
(698, 71, 'GKZ', '', 'Max. 30.000 cfu/g', ''),
(724, 76, 'fff_germany', 'english1', 'fffff_germany', 'english1111'),
(725, 77, '344', '', '4555', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page2_header`
--

DROP TABLE IF EXISTS `page2_header`;
CREATE TABLE `page2_header` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `name` text NOT NULL,
  `name_english` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page2_header`
--

INSERT INTO `page2_header` (`id`, `id_pdf`, `name`, `name_english`) VALUES
(16, 49, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(18, 49, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(26, 61, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(24, 60, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(25, 60, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(27, 61, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(28, 62, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(29, 62, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(30, 63, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(31, 63, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(32, 64, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(33, 64, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(34, 65, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(35, 65, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(36, 66, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(37, 66, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(38, 67, 'PHYSIKALISCHE UND CHEMISCHE EIGENSCHAFTEN', ''),
(39, 67, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(40, 68, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(41, 68, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(42, 68, 'CHEMISCHE EIGENSCHAFTEN', ''),
(43, 69, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(44, 69, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(45, 69, 'CHEMISCHE EIGENSCHAFTEN', ''),
(46, 70, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(47, 70, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(48, 70, 'CHEMISCHE EIGENSCHAFTEN', ''),
(49, 71, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(50, 71, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(51, 71, 'CHEMISCHE EIGENSCHAFTEN', ''),
(52, 72, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(53, 72, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(54, 72, 'CHEMISCHE EIGENSCHAFTEN', ''),
(55, 73, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(56, 73, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(57, 73, 'CHEMISCHE EIGENSCHAFTEN', ''),
(58, 74, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(59, 74, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(60, 74, 'CHEMISCHE EIGENSCHAFTEN', ''),
(61, 75, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(62, 75, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(63, 75, 'CHEMISCHE EIGENSCHAFTEN', ''),
(64, 76, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(65, 76, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(66, 76, 'CHEMISCHE EIGENSCHAFTEN', ''),
(67, 77, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(68, 77, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(69, 77, 'CHEMISCHE EIGENSCHAFTEN', ''),
(70, 78, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(71, 78, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(72, 78, 'CHEMISCHE EIGENSCHAFTEN', ''),
(73, 79, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(74, 79, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(75, 79, 'CHEMISCHE EIGENSCHAFTEN', ''),
(76, 80, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(77, 80, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(78, 80, 'CHEMISCHE EIGENSCHAFTEN', ''),
(79, 81, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(80, 81, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(81, 81, 'CHEMISCHE EIGENSCHAFTEN', ''),
(82, 82, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(83, 82, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(84, 82, 'CHEMISCHE EIGENSCHAFTEN', ''),
(85, 83, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(86, 83, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(87, 83, 'CHEMISCHE EIGENSCHAFTEN', ''),
(88, 84, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(89, 84, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(90, 84, 'CHEMISCHE EIGENSCHAFTEN', ''),
(122, 96, 'Nährwert', ''),
(121, 96, 'Mikrobiologische Eigenschaften', ''),
(94, 86, 'PHYSIKALISCHE EIGENSCHAFTEN', 'test33'),
(95, 86, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', 'test22'),
(96, 86, 'CHEMISCHE EIGENSCHAFTEN', 'test11'),
(97, 87, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(98, 87, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(99, 87, 'CHEMISCHE EIGENSCHAFTEN', ''),
(100, 88, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(101, 88, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(102, 88, 'CHEMISCHE EIGENSCHAFTEN', ''),
(103, 89, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(104, 89, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(105, 89, 'CHEMISCHE EIGENSCHAFTEN', ''),
(106, 90, 'PHYSIKALISCHE EIGENSCHAFTEN', ''),
(107, 90, 'MIKROBIOLOGISCHE EIGENSCHAFTEN', ''),
(108, 90, 'CHEMISCHE EIGENSCHAFTEN', ''),
(118, 94, 'Physikalische und chemische Eigenschaften', ''),
(119, 94, 'Mikrobiologische Eigenschaften', ''),
(120, 96, 'Technische Daten', ''),
(125, 49, 'test_ger1', 'englissdddd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page2_header_item`
--

DROP TABLE IF EXISTS `page2_header_item`;
CREATE TABLE `page2_header_item` (
  `id` int(11) NOT NULL,
  `id_page2_header` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `name_english` varchar(150) NOT NULL,
  `value` varchar(50) NOT NULL,
  `value_english` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page2_header_item`
--

INSERT INTO `page2_header_item` (`id`, `id_page2_header`, `name`, `name_english`, `value`, `value_english`) VALUES
(22, 16, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(24, 16, 'pH-Wert', '', '6,5-7,5', ''),
(25, 16, 'Fett', '', 'Max. 1%', ''),
(27, 16, 'Teilchengröße durch 100 Mesh', '', '95%', ''),
(28, 18, 'Salmonellen', '', 'negativ', ''),
(76, 26, 'Asche', '', 'Max. 7%', ''),
(30, 18, 'GKZ', '', 'max. 20.000 cfu/g', ''),
(31, 18, 'Hefen+Schimmel', '', 'max. 100 cfu/g', ''),
(74, 25, 'E-Coli', '', 'Negativ', ''),
(73, 24, 'Asche', '', 'Max. 5%', ''),
(72, 18, 'E-Coli', '', 'negativ', ''),
(71, 16, 'Asche', '', 'Max. 5%', ''),
(100, 30, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(101, 30, 'pH-Wert', '', '6,5 - 7,5', ''),
(69, 25, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(68, 25, 'Salmonellen', '', 'Negativ', ''),
(173, 24, 'Teilchengröße durch 100 Mesh', '', '95%', ''),
(66, 24, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(65, 24, 'Fett', '', 'Max. 1,0 %', ''),
(64, 24, 'pH-Wert', '', '6,5 - 7,5', ''),
(63, 24, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(77, 26, 'Teilchengröße durch 100 Mesh', '', '95%', ''),
(78, 26, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min 65%', ''),
(79, 26, 'Fett', '', 'Max. 1,0 %', ''),
(80, 26, 'pH-Wert', '', '6,5 - 7,5', ''),
(81, 26, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(82, 27, '', '', '', ''),
(83, 27, 'E-Coli', '', 'negativ', ''),
(84, 27, '', '', '', ''),
(85, 27, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(86, 27, 'Salmonellen', '', 'negativ', ''),
(87, 28, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(88, 28, 'pH-Wert', '', '6,5 - 7,5', ''),
(89, 28, 'Fett', '', 'Max. 1%', ''),
(91, 28, 'Teilchengröße durch 100 Mesh', '', 'Max. 5%', ''),
(92, 28, 'Asche', '', 'Max. 6%', ''),
(93, 29, 'Salmonellen', '', 'Negativ', ''),
(94, 29, 'GKZ', '', 'Max. 10.000 cfu/g', ''),
(95, 29, 'E-Coli', '', '< 10 cfu/g', ''),
(116, 28, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(175, 40, 'Farbe', '', 'Cream-weißes feines Pulver', ''),
(176, 42, 'Fett', '', 'Max. 1%', ''),
(174, 42, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(102, 30, 'Fett', '', 'Max. 1%', ''),
(117, 28, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(104, 30, 'Natrium (mg/100g)', '', 'max. 1000 - 1400', ''),
(105, 30, 'Asche', '', 'Max. 5%', ''),
(106, 31, 'Salmonellen', '', 'Negativ', ''),
(107, 31, 'GKZ', '', 'Max. 10.000 cfu/g', ''),
(108, 31, 'E-Coli', '', '<10 cfu/g', ''),
(110, 30, 'Proteingehalt i.Tr.', '', 'Min. 90%', ''),
(111, 28, 'Proteingehalt i.Tr.', '', 'Min. 90%', ''),
(112, 30, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(114, 30, 'Eisen (mg/100g)', '', 'Max. 8 - 15', ''),
(115, 30, 'Magnesium (mg/100g)', '', '40 - 100', ''),
(118, 28, 'Eisen (mg/100g)', '', 'Max. 8 - 15', ''),
(119, 28, 'Magnesium (mg/100g)', '', '40 - 100', ''),
(120, 16, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90% ', ''),
(121, 32, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(122, 32, 'pH-Wert', '', '6,5 - 7,5', ''),
(123, 32, 'Fett', '', 'Max. 1%', ''),
(124, 32, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(125, 32, 'Asche', '', 'Max. 5%', ''),
(126, 32, 'Proteingehalt i.Tr.', '', 'Min. 90%', ''),
(127, 32, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(128, 32, 'Eisen (mg/100g)', '', 'Max. 8 - 15', ''),
(129, 32, 'Magnesium (mg/100g)', '', '40 - 100', ''),
(130, 33, 'Salmonellen', '', 'Negativ', ''),
(131, 33, 'GKZ', '', 'Max. 10.000 cfu/g', ''),
(132, 33, 'E-Coli', '', '< 10 cfu/g', ''),
(133, 34, 'Asche', '', 'Max. 6%', ''),
(146, 34, 'Teilchengröße (100 Mesh)', '', 'Min. 95%', ''),
(135, 34, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(136, 34, 'Fett', '', 'Max. 1,0 %', ''),
(137, 34, 'pH-Wert', '', '6,5 - 7,5', ''),
(138, 34, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(163, 38, 'pH-Wert', '', '6,5 - 7,5', ''),
(164, 38, 'Fett', '', 'Max. 1%', ''),
(147, 36, 'Asche', '', 'Max. 5%', ''),
(142, 35, '', '', '', ''),
(143, 35, 'E-Coli', '', 'Negativ', ''),
(144, 35, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(145, 35, 'Hefen und Schimmel', '', 'Max. 100 cfu/g', ''),
(149, 36, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(150, 36, 'Fett', '', 'Max. 0,1%', ''),
(151, 36, 'pH-Wert', '', '6,5 - 7,5', ''),
(152, 36, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(162, 38, 'Feuchtigkeitsgrad (%)', '', 'Max. 10%', ''),
(156, 37, '', '', '', ''),
(157, 37, 'E-Coli', '', 'Negativ', ''),
(158, 37, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(159, 37, 'Salmonellen', '', 'Negativ', ''),
(160, 37, 'Hefen und Schimmel', '', 'Max. 100 cfu/g', ''),
(161, 36, 'Teilchengröße durch 100 Mesh', '', '95%', ''),
(172, 25, 'Hefe und Schimmel', '', 'max. 100 cfu/g', ''),
(166, 38, 'Asche', '', 'Max. 7%', ''),
(167, 38, 'Proteingehalt (Trockenbasis, N x 6,25)', '', '50%', ''),
(168, 39, 'Salmonellen', '', 'negativ', ''),
(169, 39, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(177, 40, 'Aroma', '', 'mild', ''),
(171, 39, 'E-Coli', '', 'negativ', ''),
(184, 40, 'Feingehalt %', '', 'Min. 95%', ''),
(178, 42, 'Asche', '', 'Max. 6%', ''),
(179, 42, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 70%', ''),
(180, 41, 'Salmonellen', '', 'Negativ', ''),
(181, 41, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(183, 41, 'E-Coli', '', 'Negativ', ''),
(185, 43, 'Farbe', '', 'Creme, leicht gelbes feines Pulver', ''),
(186, 43, 'Aroma', '', 'angenehm', ''),
(187, 43, 'Feingehalt %', '', 'Min. 95%', ''),
(188, 44, 'Salmonellen', '', 'Negativ', ''),
(189, 44, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(190, 44, 'E-Coli (mpn/100g)', '', 'Negativ', ''),
(191, 45, 'Fett', '', 'Max. 1%', ''),
(192, 45, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(193, 45, 'Asche', '', 'Max. 6%', ''),
(194, 45, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 70%', ''),
(195, 45, 'Funktionsindex (Protein : Wasser)', '', '1:4', ''),
(196, 45, 'Funktionsindex (Protein : Wasser:Öl)', '', '1:4:4', ''),
(197, 45, 'pH-Wert', '', '6,5 - 7,5', ''),
(198, 45, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(199, 45, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(200, 45, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(201, 45, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(202, 44, 'Hefen und Pilze', '', '50 g/max.', ''),
(203, 48, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(204, 48, 'pH-Wert', '', '6,5 - 7,5', ''),
(205, 48, 'Fett', '', 'Max. 1%', ''),
(213, 48, 'Natrium (mg/100g)', '', '1000 - 1400', ''),
(207, 48, 'Asche', '', 'Max. 6%', ''),
(208, 48, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90% ', ''),
(209, 47, 'Salmonellen', '', 'Negativ', ''),
(210, 47, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(214, 48, 'Kalium (mg/100g)', '', '75 - 300', ''),
(212, 47, 'E-Coli', '', 'Negativ', ''),
(215, 46, 'Farbe', '', 'Cream-weißes feines Pulver', ''),
(216, 46, 'Aroma', '', 'mild', ''),
(217, 46, 'Feingehalt %', '', 'Min. 95%', ''),
(218, 49, 'Farbe', '', 'Creme, leicht gelbes feines Pulver', ''),
(219, 51, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(220, 49, 'Aroma', '', 'angenehm', ''),
(221, 51, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(223, 49, 'Feingehalt %', '', 'Min. 95%', ''),
(224, 50, '', '', '', ''),
(225, 50, 'E-Coli', '', 'Negativ', ''),
(226, 50, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(227, 50, 'Salmonellen', '', 'Negativ', ''),
(228, 50, 'Hefen und Pilze', '', 'Max. 50g', ''),
(229, 51, 'Asche', '', 'Max. 5,0%', ''),
(230, 51, 'Fett', '', 'Max. 1,0%', ''),
(231, 51, 'Partikel Größe (% pass 100 mesh)', '', '95%', ''),
(232, 51, 'pH-Wert', '', '6,6 - 7,5', ''),
(233, 51, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(234, 51, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(235, 51, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(236, 51, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(237, 52, 'Farbe', '', 'Creme, leicht gelbes feines Pulver', ''),
(238, 52, 'Aroma', '', 'angenehm', ''),
(239, 52, 'Feingehalt %', '', 'Min. 95%', ''),
(240, 53, '', '', '', ''),
(241, 53, 'E-Coli', '', 'Negativ', ''),
(242, 53, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(243, 53, 'Salmonellen', '', 'Negativ', ''),
(244, 53, 'Hefen und Pilze', '', 'Max. 50g', ''),
(245, 54, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(246, 54, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(247, 54, 'Asche', '', 'Max. 5,0%', ''),
(248, 54, 'Fett', '', 'Max. 1,5%', ''),
(249, 54, 'Partikel Größe (% pass 100 mesh)', '', '95%', ''),
(250, 54, 'pH-Wert', '', '6,6 - 7,5', ''),
(251, 54, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(252, 54, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(253, 54, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(254, 54, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(255, 54, 'Funktionsindex (Protein : Wasser)', '', '1:7', ''),
(256, 54, 'Funktionsindex (Protein : Wasser : Öl)', '', '1:7:7', ''),
(257, 55, 'Farbe', '', 'leicht gelbes Pulver', ''),
(258, 55, 'Aroma', '', 'angenehm', ''),
(259, 55, 'Feingehalt %', '', 'Min. 99%', ''),
(260, 56, '', '', '', ''),
(261, 56, 'E-Coli', '', 'Negativ', ''),
(262, 56, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(263, 56, 'Salmonellen', '', 'Negativ', ''),
(264, 56, 'Hefen und Pilze', '', 'Max. 50g', ''),
(265, 57, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(266, 57, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(267, 57, 'Asche', '', 'Max. 6,0%', ''),
(268, 57, 'Fett', '', 'Max. 1,5%', ''),
(277, 58, 'Farbe', '', 'leicht gelbes Pulver', ''),
(270, 57, 'pH-Wert', '', '7.3 + / - 0.5', ''),
(271, 57, 'Natrium (mg/100g)', '', 'Max. 700 - 1000', ''),
(272, 57, 'Kalium (mg/100g)', '', 'Max. 150 - 400', ''),
(273, 57, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(274, 57, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(278, 58, 'Aroma', '', 'angenehm', ''),
(276, 57, 'Rohfaser', '', 'Max. 0,5%', ''),
(279, 58, 'Feingehalt %', '', 'Min. 99%', ''),
(280, 59, '', '', '', ''),
(281, 59, 'E-Coli', '', 'Negativ', ''),
(282, 59, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(283, 59, 'Salmonellen', '', 'Negativ', ''),
(284, 59, 'Hefen und Pilze', '', 'Max. 50g', ''),
(285, 60, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(286, 60, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(287, 60, 'Asche', '', 'Max. 6,0%', ''),
(288, 60, 'Fett', '', 'Max. 0,5%', ''),
(289, 60, 'pH-Wert', '', '7.0 + / - 0.5', ''),
(290, 60, 'Natrium (mg/100g)', '', 'Max. 700 - 1000', ''),
(291, 60, 'Kalium (mg/100g)', '', 'Max. 150 - 400', ''),
(292, 60, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(293, 60, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(294, 60, 'Rohfaser', '', 'Max. 0,5%', ''),
(295, 61, 'Farbe', '', 'leicht gelbes Pulver', ''),
(296, 61, 'Aroma', '', 'angenehm', ''),
(297, 61, 'Feingehalt %', '', 'Min. 98%', ''),
(298, 62, '', '', '', ''),
(299, 62, 'E-Coli', '', 'Negativ', ''),
(300, 62, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(301, 62, 'Salmonellen', '', 'Negativ', ''),
(302, 62, 'Hefen und Pilze', '', 'Max. 50g', ''),
(303, 63, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(304, 63, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(305, 63, 'Asche', '', 'Max. 6,0%', ''),
(306, 63, 'Fett', '', 'Max. 1,5%', ''),
(307, 63, 'pH-Wert', '', '7.0 + / - 0.5', ''),
(308, 63, 'Natrium (mg/100g)', '', 'Max. 700 - 1000', ''),
(309, 63, 'Kalium (mg/100g)', '', 'Max. 30 - 90', ''),
(310, 63, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(311, 63, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(313, 64, 'Farbe', '', 'Creme weißes feines Pulver', ''),
(314, 64, 'Aroma', '', 'angenehm', ''),
(315, 64, 'Feingehalt %', '', 'Min. 95%', ''),
(316, 65, '', '', '', ''),
(317, 65, 'E-Coli', '', 'Negativ', ''),
(318, 65, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(319, 65, 'Salmonellen', '', 'Negativ', ''),
(320, 65, 'Hefen und Pilze', '', 'Max. 50g', ''),
(321, 66, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 88%', ''),
(322, 66, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(323, 66, 'Asche', '', 'Max. 6,0%', ''),
(324, 66, 'Fett', '', 'Max. 1%', ''),
(325, 66, 'pH-Wert', '', '6.5 - 7.5', ''),
(326, 66, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(327, 66, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(328, 66, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(329, 66, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(330, 67, 'Farbe', '', 'Creme weißes feines Pulver', ''),
(331, 67, 'Aroma', '', 'angenehm', ''),
(332, 67, 'Feingehalt %', '', 'Min. 95%', ''),
(333, 68, '', '', '', ''),
(334, 68, 'E-Coli', '', 'Negativ', ''),
(335, 68, 'GKZ', '', 'Max. 10.000 cfu/g', ''),
(336, 68, 'Salmonellen', '', 'Negativ', ''),
(337, 68, 'Hefen und Pilze', '', 'Max. 50g', ''),
(338, 69, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(339, 69, 'Feuchtigkeitsgrad (%)', '', 'Max. 8,0%', ''),
(340, 69, 'Asche', '', 'Max. 6,0%', ''),
(341, 69, 'Fett', '', 'Max. 1%', ''),
(342, 69, 'pH-Wert', '', '7.0 - 7.8', ''),
(343, 69, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(344, 69, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(345, 69, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(346, 69, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(347, 70, 'Farbe', '', 'leicht gelbes Pulver', ''),
(348, 70, 'Aroma', '', 'leicht, natürlich, nussig', ''),
(349, 70, 'Feingehalt %', '', 'Min. 98%', ''),
(350, 71, '', '', '', ''),
(351, 71, 'E-Coli', '', 'Negativ', ''),
(352, 71, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(353, 71, 'Salmonellen', '', 'Negativ', ''),
(354, 71, 'Hefen und Pilze', '', 'Max. 50g', ''),
(355, 72, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(356, 72, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(357, 72, 'Asche', '', 'Max. 6,0%', ''),
(358, 72, 'Fett', '', 'Max. 1%', ''),
(359, 72, 'pH-Wert', '', '7.0 + / - 0.5', ''),
(360, 72, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(361, 72, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(362, 72, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(363, 72, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(364, 73, 'Farbe', '', 'leicht gelbes Pulver', ''),
(365, 73, 'Aroma', '', 'leicht, natürlich, nussig', ''),
(366, 73, 'Feingehalt %', '', 'Min. 98%', ''),
(367, 74, '', '', '', ''),
(368, 74, 'E-Coli', '', 'Negativ', ''),
(369, 74, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(370, 74, 'Salmonellen', '', 'Negativ', ''),
(371, 74, 'Hefen und Pilze', '', 'Max. 50g', ''),
(372, 75, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(373, 75, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(374, 75, 'Asche', '', 'Max. 6,0%', ''),
(375, 75, 'Fett', '', 'Max. 1%', ''),
(376, 75, 'pH-Wert', '', '7.0 + / - 0.5', ''),
(377, 75, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(378, 75, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(379, 75, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(380, 75, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(381, 76, 'Farbe', '', 'leicht gelbes Pulver', ''),
(382, 76, 'Aroma', '', 'angenehm', ''),
(383, 76, 'Feingehalt %', '', 'Min. 95%', ''),
(384, 77, '', '', '', ''),
(385, 77, 'E-Coli', '', 'Negativ', ''),
(386, 77, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(387, 77, 'Salmonellen', '', 'Negativ', ''),
(388, 77, 'Hefen und Pilze', '', 'Max. 50g', ''),
(389, 78, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(390, 78, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(391, 78, 'Asche', '', 'Max. 6,0%', ''),
(392, 78, 'Fett', '', 'Max. 1%', ''),
(393, 78, 'pH-Wert', '', '7.0 + / - 0.5', ''),
(394, 78, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(395, 78, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(396, 78, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(397, 78, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(398, 79, 'Farbe', '', 'leicht gelbes Pulver', ''),
(399, 79, 'Aroma', '', 'angenehm', ''),
(400, 79, 'Feingehalt %', '', 'Min. 95%', ''),
(401, 80, '', '', '', ''),
(402, 80, 'E-Coli', '', 'Negativ', ''),
(403, 80, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(404, 80, 'Salmonellen', '', 'Negativ', ''),
(405, 80, 'Hefen und Pilze', '', 'Max. 50g', ''),
(406, 81, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(407, 81, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(408, 81, 'Asche', '', 'Max. 6,0%', ''),
(409, 81, 'Fett', '', 'Max. 1%', ''),
(410, 81, 'pH-Wert', '', '6.5 - 7.0', ''),
(411, 81, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(412, 81, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(413, 81, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(414, 81, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(415, 82, 'Farbe', '', 'leicht gelbes Pulver', ''),
(416, 82, 'Aroma', '', 'angenehm', ''),
(417, 82, 'Feingehalt %', '', 'Min. 98%', ''),
(419, 83, 'E-Coli', '', 'Negativ', ''),
(420, 83, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(421, 83, 'Salmonellen', '', 'Negativ', ''),
(422, 83, 'Hefen und Pilze', '', 'Max. 50g', ''),
(423, 84, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(424, 84, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(425, 84, 'Asche', '', 'Max. 6,0%', ''),
(426, 84, 'Fett', '', 'Max. 1,5%', ''),
(427, 84, 'pH-Wert', '', '6.5 - 7.0', ''),
(428, 84, 'Natrium (mg/100g)', '', 'Max. 700 - 1000', ''),
(429, 84, 'Kalium (mg/100g)', '', 'Max. 150 - 400', ''),
(430, 84, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(431, 84, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(432, 85, 'Farbe', '', 'leicht gelbes Pulver', ''),
(433, 85, 'Aroma', '', 'angenehm', ''),
(434, 85, 'Feingehalt %', '', 'Min. 98%', ''),
(435, 86, '', '', '', ''),
(436, 86, 'E-Coli', '', 'Negativ', ''),
(437, 86, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(438, 86, 'Salmonellen', '', 'Negativ', ''),
(439, 86, 'Hefen und Pilze', '', 'Max. 50g', ''),
(440, 87, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(441, 87, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(442, 87, 'Asche', '', 'Max. 6,0%', ''),
(443, 87, 'Fett', '', 'Max. 1,5%', ''),
(444, 87, 'pH-Wert', '', '7.0 + / - 0.5', ''),
(445, 87, 'Natrium (mg/100g)', '', 'Max. 1300 - 1700', ''),
(446, 87, 'Kalium (mg/100g)', '', 'Max. 150 - 400', ''),
(447, 87, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(448, 87, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(449, 88, 'Farbe', '', 'leicht gelbes Pulver', ''),
(450, 88, 'Aroma', '', 'angenehm', ''),
(451, 88, 'Feingehalt %', '', 'Min. 98%', ''),
(452, 89, '', '', '', ''),
(453, 89, 'E-Coli', '', 'Negativ', ''),
(454, 89, 'GKZ', '', 'Max. 20.000 cfu/g', ''),
(455, 89, 'Salmonellen', '', 'Negativ', ''),
(456, 89, 'Hefen und Pilze', '', 'Max. 50g', ''),
(457, 90, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 90%', ''),
(458, 90, 'Feuchtigkeitsgrad (%)', '', 'Max. 7,0%', ''),
(459, 90, 'Asche', '', 'Max. 6,0%', ''),
(460, 90, 'Fett', '', 'Max. 1,5%', ''),
(461, 90, 'pH-Wert', '', '7.0 + / - 0.5', ''),
(462, 90, 'Natrium (mg/100g)', '', 'Max. 600 - 900', ''),
(463, 90, 'Kalium (mg/100g)', '', 'Max. 30 - 90', ''),
(464, 90, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(465, 90, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(617, 120, 'Säurezahl', '', 'Max. 35 mg KOH/g', ''),
(616, 120, 'Peroxidzahl', '', 'Max. 10 meq/kg', ''),
(610, 119, 'Salmonellen', '', 'negativ', ''),
(611, 119, 'E. Coli', '', 'negativ', ''),
(609, 118, 'Arsen', '', 'Max. 0,5 ppm', ''),
(608, 118, 'Blei', '', 'Max. 1,0 ppm', ''),
(607, 118, 'Asche', '', 'Max. 5%', ''),
(606, 118, 'Fett', '', 'Max. 1%', ''),
(605, 118, 'pH-Wert', '', '6,5 - 7,5', ''),
(604, 118, 'Feuchtigkeitsgrad (%)', '', 'Max. 10%', ''),
(603, 118, 'Proteingehalt i. Tr.', '', 'Max. 20%', ''),
(602, 118, 'Verzehrbarer Ballaststoff (Trockenbasis)', '', 'Min. 60%', ''),
(483, 94, 'Farbe', '444', 'Cream-weißes feines Pulver', '45666'),
(484, 94, 'Aroma', '', 'mild', ''),
(485, 94, 'Feingehalt %', '', 'Min. 95%', ''),
(486, 95, 'Salmonellen', '', 'Negativ', ''),
(487, 95, 'GKZ', '333', 'max. 30.000 cfu/g', '3444'),
(488, 95, 'E-Coli', '', 'Negativ', ''),
(489, 96, 'Fett', '', 'Max. 1%', ''),
(490, 96, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(491, 96, 'Asche', '111', 'Max. 6%', '111zzz'),
(492, 96, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 68%', ''),
(493, 97, 'Farbe', '', 'Cream-weißes feines Pulver', ''),
(494, 97, 'Aroma', '', 'angenehm', ''),
(495, 97, 'Feingehalt %', '', 'Min. 95%', ''),
(496, 98, 'Salmonellen', '', 'Negativ', ''),
(497, 98, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(498, 98, 'E-Coli', '', 'Negativ', ''),
(499, 99, 'Fett', '', 'Max. 1%', ''),
(500, 99, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(501, 99, 'Asche', '', 'Max. 7%', ''),
(502, 99, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 68%', ''),
(503, 99, 'Rohfaser', '', 'Max. 5%', ''),
(504, 99, 'Soluble', '', '2%', ''),
(505, 99, 'Insoluble', '', '15%', ''),
(506, 99, 'pH-Wert', '', '7.0 - 7.8', ''),
(507, 99, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(508, 99, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(509, 99, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(510, 99, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(511, 100, 'Farbe', '', 'Cream-weißes feines Pulver', ''),
(512, 100, 'Aroma', '', 'angenehm', ''),
(513, 100, 'Feingehalt %', '', 'Min. 95%', ''),
(514, 101, 'Salmonellen', '', 'Negativ', ''),
(515, 101, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(516, 101, 'E-Coli', '', 'Negativ', ''),
(517, 102, 'Fett', '', 'Max. 1%', ''),
(518, 102, 'Feuchtigkeitsgrad (%)', '', 'Max. 7%', ''),
(519, 102, 'Asche', '', 'Max. 7%', ''),
(520, 102, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 68%', ''),
(521, 102, 'Rohfaser', '', 'Max. 5%', ''),
(522, 102, 'Soluble', '', '2%', ''),
(523, 102, 'Insoluble', '', '15%', ''),
(524, 102, 'pH-Wert', '', '7.0 - 7.8', ''),
(525, 102, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(526, 102, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(527, 102, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(528, 102, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(529, 103, 'Farbe', '', 'weißes Pulver', ''),
(530, 103, 'Aroma', '', 'angenehm', ''),
(531, 103, 'Feingehalt %', '', 'unregelmäßige Partikel', ''),
(532, 104, 'Salmonellen', '', 'Negativ', ''),
(533, 104, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(534, 104, 'E-Coli', '', 'Negativ', ''),
(536, 105, 'Feuchtigkeitsgrad (%)', '', 'Max. 10%', ''),
(537, 105, 'Asche', '', 'Max. 5%', ''),
(538, 105, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 60%', ''),
(539, 105, 'Rohfaser', '', 'Max. 26%', ''),
(547, 105, 'Partikel Größe (% pass 100 mesh)', '', '90%', ''),
(542, 105, 'pH-Wert', '', '6,5 - 7,5', ''),
(543, 105, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(544, 105, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(545, 105, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(546, 105, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(548, 105, 'Funktionsindex (Faser : Wasser)', '', '1:8', ''),
(549, 104, 'Hefe und Pilze', '', '50 g/max.', ''),
(550, 106, 'Farbe', '', 'weißes Pulver', ''),
(551, 106, 'Aroma', '', 'angenehm', ''),
(552, 106, 'Feingehalt %', '', 'unregelmäßige Partikel', ''),
(553, 107, 'Salmonellen', '', 'Negativ', ''),
(554, 107, 'GKZ', '', 'max. 30.000 cfu/g', ''),
(555, 107, 'E-Coli', '', 'Negativ', ''),
(556, 107, 'Hefe und Pilze', '', '50 g/max.', ''),
(557, 108, 'Feuchtigkeitsgrad (%)', '', 'Max. 10%', ''),
(558, 108, 'Asche', '', 'Max. 5%', ''),
(559, 108, 'Proteingehalt (Trockenbasis, N x 6,25)', '', 'Min. 60%', ''),
(560, 108, 'Rohfaser', '', 'Max. 26%', ''),
(561, 108, 'Partikel Größe (% pass 100 mesh)', '', '90%', ''),
(562, 108, 'pH-Wert', '', '6,5 - 7,5', ''),
(563, 108, 'Natrium (mg/100g)', '', 'Max. 1000 - 1400', ''),
(564, 108, 'Kalium (mg/100g)', '', 'Max. 75 - 300', ''),
(565, 108, 'Eisen (mg/100) ', '', 'Max. 8,0 - 15,0', ''),
(566, 108, 'Magnesium (mg/100g)', '', 'Max. 40 - 100', ''),
(567, 108, 'Funktionsindex (Faser : Wasser)', '', '1:7', ''),
(568, 101, 'Hefe und Pilze', '', '50 g/max.', ''),
(569, 98, 'Hefe und Pilze', '', '50 g/max.', ''),
(570, 35, 'Salmonellen', '', 'Negativ', ''),
(618, 121, 'Aerobe mesophile Gesamtkeimzahl', '', 'Max. 1000 cfu/g', ''),
(615, 120, 'Wasser', '', 'Max. 1,5%', ''),
(614, 120, 'Aceton-Unlösliches', '', 'Min. 95%', ''),
(613, 119, 'GKZ', '', 'Max. 30.000 cfu/g', ''),
(612, 119, 'Pathogen', '', 'negativ', ''),
(619, 121, 'Hefen', '', 'Max. 100 cfu/g', ''),
(620, 121, 'Schimmel', '', ' Max.100 cfu/g', ''),
(621, 121, 'E. Coli', '', 'negativ', ''),
(622, 121, 'Salmonellen', '', 'negativ', ''),
(623, 122, 'Protein', '', 'Max. 7g/100g', ''),
(624, 122, 'Ballaststoffe', '', 'Max. 0,5g/100g', ''),
(625, 122, 'Fett', '', 'Max. 60g/100g', ''),
(626, 122, 'Energie kcal', '', 'Max. 650g/100g', ''),
(638, 16, 'test_ger1', 'english1', 'test_ger1', 'english1111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page2_text`
--

DROP TABLE IF EXISTS `page2_text`;
CREATE TABLE `page2_text` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `value` text NOT NULL,
  `value_english` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `page2_text`
--

INSERT INTO `page2_text` (`id`, `id_pdf`, `value`, `value_english`) VALUES
(47, 49, 'text-germanyzzz', 'text-englishzzzz'),
(43, 98, '<p>hhhhh</p>', ''),
(44, 98, '\"<p>hhhhh</p>\"', ''),
(7, 60, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(8, 61, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p>Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(9, 62, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p>Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(10, 63, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p>Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(11, 64, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p>Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(12, 65, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p>Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(13, 66, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(14, 67, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(15, 68, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Kennzeichnung</p>\r\n<div class=\"page\" title=\"Page 3\">\r\n<div class=\"layoutArea\">\r\n<div class=\"column\">\r\n<p>Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.</p>\r\n</div>\r\n</div>\r\n</div>', ''),
(16, 69, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Kennzeichnung</p>\r\n<div class=\"page\" title=\"Page 3\">\r\n<div class=\"layoutArea\">\r\n<div class=\"column\">\r\n<p>Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.</p>\r\n</div>\r\n</div>\r\n</div>', ''),
(17, 70, '', ''),
(18, 71, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(19, 72, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(20, 73, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(21, 74, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(22, 75, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(23, 76, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(24, 77, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(25, 78, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(26, 79, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(27, 80, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(28, 81, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(29, 82, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(30, 83, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(31, 84, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">GVO</p>\r\n<p class=\"western\" align=\"justify\">Es besteht keine Kennzeichnungspflicht nach der EG Verordnung zur Kennzeichnung, Zulassung und R&uuml;ckverfolgbarkeit gentechnisch ver&auml;nderter Lebens- und Futtermittel (VO(EG) Nr. 1829/2003 und 1830/2003).</p>', ''),
(42, 94, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Zertifikate und Lebensmittelrecht</p>\r\n<p>Das Produkt entspricht den Anforderungen des deutschen Lebensmittlerechts sowie anzuwendender EU Verordnungen</p>', ''),
(33, 86, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Kennzeichnung</p>\r\n<div class=\"page\" title=\"Page 3\">\r\n<div class=\"layoutArea\">\r\n<div class=\"column\">\r\n<p>Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.</p>\r\n</div>\r\n</div>\r\n</div>', 'hahaha'),
(34, 87, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Kennzeichnung</p>\r\n<div class=\"page\" title=\"Page 3\">\r\n<div class=\"layoutArea\">\r\n<div class=\"column\">\r\n<p>Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.</p>\r\n</div>\r\n</div>\r\n</div>', ''),
(35, 88, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Kennzeichnung</p>\r\n<div class=\"page\" title=\"Page 3\">\r\n<div class=\"layoutArea\">\r\n<div class=\"column\">\r\n<p>Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.</p>\r\n</div>\r\n</div>\r\n</div>', ''),
(36, 89, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Kennzeichnung</p>\r\n<div class=\"page\" title=\"Page 3\">\r\n<div class=\"layoutArea\">\r\n<div class=\"column\">\r\n<p>Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.</p>\r\n</div>\r\n</div>\r\n</div>', ''),
(37, 90, '<p style=\"font-family: Univers-57-Condensed; font-size: 18px; color: #706f6f;\">Kennzeichnung</p>\r\n<div class=\"page\" title=\"Page 3\">\r\n<div class=\"layoutArea\">\r\n<div class=\"column\">\r\n<p>Markenname, Produktname, Hersteller, CIQ Registriernummer, Chargennummer, Herstellungsdatum und Haltbarkeitsdatum.</p>\r\n</div>\r\n</div>\r\n</div>', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pdf`
--

DROP TABLE IF EXISTS `pdf`;
CREATE TABLE `pdf` (
  `pid` int(11) NOT NULL,
  `pdesc` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `psize` int(11) NOT NULL DEFAULT 0,
  `pdate` date NOT NULL DEFAULT '0000-00-00',
  `pgid` int(11) NOT NULL DEFAULT 1,
  `edit` int(1) NOT NULL DEFAULT 0,
  `pimage` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `pstart` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `pend` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `pdf`
--

INSERT INTO `pdf` (`pid`, `pdesc`, `pname`, `psize`, `pdate`, `pgid`, `edit`, `pimage`, `pstart`, `pend`) VALUES
(17, '', 'icon5.png', 1137, '2016-03-08', 4, 0, '', '', ''),
(16, '', 'icon4.png', 1232, '2016-03-08', 4, 0, '', '', ''),
(15, '', 'icon3.png', 1262, '2016-03-08', 4, 0, '', '', ''),
(14, '', 'icon2.png', 1241, '2016-03-08', 4, 0, '', '', ''),
(13, '', 'icon1.png', 1211, '2016-03-08', 4, 0, '', '', ''),
(18, '', 'icon6.png', 1259, '2016-03-08', 4, 0, '', '', ''),
(19, '', 'icon7.png', 1305, '2016-03-08', 4, 0, '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pdf_checkbox`
--

DROP TABLE IF EXISTS `pdf_checkbox`;
CREATE TABLE `pdf_checkbox` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `id_checkbox` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `pdf_checkbox`
--

INSERT INTO `pdf_checkbox` (`id`, `id_pdf`, `id_checkbox`) VALUES
(542, 66, 14),
(541, 65, 37),
(540, 65, 14),
(539, 64, 37),
(538, 64, 14),
(537, 63, 37),
(536, 63, 14),
(535, 49, 37),
(534, 49, 14),
(531, 60, 37),
(530, 60, 14),
(526, 61, 14),
(527, 61, 37),
(532, 62, 14),
(533, 62, 37),
(543, 66, 37),
(544, 67, 14),
(545, 67, 37),
(549, 68, 37),
(548, 68, 14),
(550, 69, 14),
(551, 69, 37),
(552, 70, 14),
(553, 70, 37),
(554, 71, 14),
(555, 71, 37),
(556, 72, 14),
(557, 72, 37),
(558, 73, 14),
(559, 73, 37),
(560, 74, 14),
(561, 74, 37),
(562, 75, 14),
(563, 75, 37),
(564, 76, 14),
(565, 76, 37),
(566, 77, 14),
(567, 77, 37),
(568, 78, 14),
(569, 78, 37),
(570, 79, 14),
(571, 79, 37),
(572, 80, 14),
(573, 80, 37),
(574, 81, 14),
(575, 81, 37),
(576, 82, 14),
(577, 82, 37),
(578, 83, 14),
(579, 83, 37),
(580, 84, 14),
(581, 84, 37),
(582, 85, 14),
(583, 85, 37),
(584, 86, 14),
(585, 86, 37),
(586, 87, 14),
(587, 87, 37),
(588, 88, 14),
(589, 88, 37),
(590, 89, 14),
(591, 89, 37),
(592, 90, 14),
(593, 90, 37),
(597, 94, 14),
(596, 94, 9),
(598, 96, 9),
(599, 96, 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pdf_checkbox_english`
--

DROP TABLE IF EXISTS `pdf_checkbox_english`;
CREATE TABLE `pdf_checkbox_english` (
  `id` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `id_checkbox` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `pdf_checkbox_english`
--

INSERT INTO `pdf_checkbox_english` (`id`, `id_pdf`, `id_checkbox`) VALUES
(5, 86, 3),
(4, 49, 1),
(6, 86, 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pdf_group`
--

DROP TABLE IF EXISTS `pdf_group`;
CREATE TABLE `pdf_group` (
  `pgid` int(11) NOT NULL,
  `pgname` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL,
  `pgart` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `pdf_group`
--

INSERT INTO `pdf_group` (`pgid`, `pgname`, `parent`, `pgart`) VALUES
(4, 'logo-page1', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pdf_store`
--

DROP TABLE IF EXISTS `pdf_store`;
CREATE TABLE `pdf_store` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_english` varchar(150) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `pdf_store`
--

INSERT INTO `pdf_store` (`id`, `title`, `title_english`, `date_time`) VALUES
(49, '0 Vorlage Maximum', '', '2016-03-04 05:43:09'),
(60, 'EF- ISP 920H- isolates', '', '2016-03-22 12:49:24'),
(61, 'EF- Sojaprotein Konzentrat  nicht funktional ', '', '2016-03-22 15:45:43'),
(62, 'EF- SPI 930M - isolates', '', '2016-03-22 16:33:08'),
(63, 'EF- SPI 930E - isolates', '', '2016-03-22 16:59:02'),
(64, 'EF- SPI 930F - isolates', '', '2016-03-23 17:03:16'),
(65, 'EF- SPI 90G - isolates', '', '2016-03-23 17:14:44'),
(66, 'EF- ISP 930 - isolates', '', '2016-03-23 17:41:26'),
(67, 'EF- SHM01J - textures', '', '2016-03-24 14:22:35'),
(68, 'EF- YX 702 - concentrades', '', '2016-03-24 17:03:41'),
(69, 'EF- YX702 - concentrades', '', '2016-03-25 16:20:50'),
(70, 'EF- SPI950F - isolates', '', '2016-03-25 17:05:24'),
(71, 'EF- ISP 510 - isolates', '', '2016-03-27 13:07:44'),
(72, 'EF- ISP 930H isolates', '', '2016-03-27 13:49:29'),
(73, 'EF- ISOPRO FD95E isolates', '', '2016-03-27 14:04:41'),
(74, 'EF- ISOPRO FD90I isolates', '', '2016-03-27 14:16:54'),
(75, 'EF- ISOPRO FD90E isolates', '', '2016-03-27 14:28:12'),
(76, 'EF- WDFPRO 950T isolates', '', '2016-03-27 14:38:15'),
(77, 'EF- WDFPRO 950E isolates', '', '2016-03-27 14:47:13'),
(78, 'EF- ISP YX 4000 isolates', '', '2016-03-27 14:56:11'),
(79, 'EF- ISP YX 4001 isolates', '', '2016-03-27 15:23:00'),
(80, 'EF- ISP 610 isolates', '', '2016-03-27 15:29:59'),
(81, 'EF- ISP 620 isolates', '', '2016-03-27 15:36:17'),
(82, 'EF- ISOPRO 516B isolates', '', '2016-03-27 15:42:24'),
(83, 'EF- ISOPRO618B isolates', '', '2016-03-27 15:49:53'),
(84, 'EF- ISOPRO619B isolates', '', '2016-03-27 15:56:01'),
(86, 'EF- CSP 310 - concentrades', 'EF- CSP 310 - concentrades-english', '2016-03-27 16:19:12'),
(87, 'EF- WDFCON-EF - concentrades', '', '2016-03-27 16:29:07'),
(88, 'EF- WDFCON-C - concentrades', '', '2016-03-27 16:41:17'),
(89, 'EF- YX 100 nicht sterilisiert - concentrades', '', '2016-03-27 16:48:04'),
(90, 'EF- YX 100 sterilisiert  - concentrade', '', '2016-03-27 17:00:34'),
(94, 'Soja Faser / Soja Ballaststoff funktional', '', '2016-04-20 13:56:15'),
(96, 'Soja Lecithin Pulver 93', '', '2016-04-20 14:43:37'),
(98, 'test', '', '2016-09-13 19:22:53'),
(100, 'test1_germany', 'test1', '2016-09-13 19:58:37'),
(101, 'test2_germany', 'test2', '2016-09-13 20:01:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pfad`
--

DROP TABLE IF EXISTS `pfad`;
CREATE TABLE `pfad` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `navid` int(11) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL DEFAULT 0,
  `page` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `wg` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `pfad`
--

INSERT INTO `pfad` (`id`, `url`, `navid`, `parent`, `page`, `wg`) VALUES
(3, 'select-6-color/', 6, 0, '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tabelle`
--

DROP TABLE IF EXISTS `tabelle`;
CREATE TABLE `tabelle` (
  `tabid` int(11) NOT NULL,
  `tabtext` text COLLATE latin1_general_ci NOT NULL,
  `spalte` int(11) NOT NULL DEFAULT 0,
  `reihe` int(11) NOT NULL DEFAULT 0,
  `edit` int(1) NOT NULL DEFAULT 1,
  `cid` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `tid` int(11) NOT NULL,
  `content` text COLLATE latin1_general_ci NOT NULL,
  `edit` int(1) NOT NULL DEFAULT 1,
  `tname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `layout` int(1) NOT NULL DEFAULT 1,
  `tlang` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `Anrede` int(11) NOT NULL,
  `Vorname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `uname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Strasse` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Hausnummer` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Plz` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `ort` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `land` int(11) NOT NULL,
  `Geburtsdatum` date NOT NULL,
  `Schuhgrosse` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pw` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email_gesch` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `telefonnummer_privat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Telefonnummer_geschaft` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Beschaftigt_bei` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `beschaftigt_als` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `beschaftigt_seit` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `active` int(11) NOT NULL,
  `token` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `berechtigung` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `admin` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`uid`, `Anrede`, `Vorname`, `Name`, `uname`, `Strasse`, `Hausnummer`, `Plz`, `ort`, `land`, `Geburtsdatum`, `Schuhgrosse`, `pw`, `email`, `email_gesch`, `telefonnummer_privat`, `Telefonnummer_geschaft`, `Beschaftigt_bei`, `beschaftigt_als`, `beschaftigt_seit`, `active`, `token`, `berechtigung`, `admin`) VALUES
(1, 0, '', '', 'morpheus', '', '', '', '', 0, '0000-00-00', '', 'db04cce4e9bafc1aaabbb7ceb7b5a2c5', '', '', '', '', '', '', '', 0, '', '1', 1),
(2, 0, '', '', 'vu', '', '', '', '', 0, '0000-00-00', '', 'e10adc3949ba59abbe56e057f20f883e', 'vukynamkhtn@gmail.com', '', '', '', '', '', '', 0, '', '1', 1),
(19, 0, '', '', 'bk', '', '', '', '', 0, '0000-00-00', '', '81dc9bdb52d04dc20036dbd8313ed055', 'post@pixel-dusche.de', '', '', '', '', '', '', 1, 'a78c516c9dc641f08f7e5dcd091e435e', NULL, 0),
(18, 0, '', '', 'vunam1', '', '', '', '', 0, '0000-00-00', '', 'e10adc3949ba59abbe56e057f20f883e', 'vukynamkhtn1@gmail.com', '', '', '', '', '', '', 1, '72892347140b418d3c2a34845d497254', NULL, 0),
(20, 0, '', '', 'bk1', '', '', '', '', 0, '0000-00-00', '', '81dc9bdb52d04dc20036dbd8313ed055', 'xacffm@gmx.de', '', '', '', '', '', '', 1, 'f1ea1f2c2163bc32e390cd679c8879ce', NULL, 0),
(22, 1, 'vu', 'nam', 'vunam', 'strass', 'haus', 'plz', 'ort', 22, '2017-02-15', 'sch', 'e10adc3949ba59abbe56e057f20f883e', 'vukynamkhtn@gmail.com', 'dd@yahoo.com', '12334466', '444', 'bes', '', '2017-02-16', 1, '5839c945c6583d7372946fd77abdecf5', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_test`
--

DROP TABLE IF EXISTS `user_test`;
CREATE TABLE `user_test` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_test` date NOT NULL,
  `level` varchar(11) NOT NULL,
  `number_lesson` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `user_test`
--

INSERT INTO `user_test` (`id`, `id_user`, `date_test`, `level`, `number_lesson`, `value`, `status`) VALUES
(19, 22, '2020-05-21', '1_1', 2, ',,,,1_1_1_3,1_1_1_4,1_1_2_3,1_1_2_4,', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_test_active`
--

DROP TABLE IF EXISTS `user_test_active`;
CREATE TABLE `user_test_active` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `z_protokoll`
--

DROP TABLE IF EXISTS `z_protokoll`;
CREATE TABLE `z_protokoll` (
  `prid` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT 0,
  `db` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT 0,
  `datum` date NOT NULL DEFAULT '0000-00-00',
  `art` varchar(6) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Đang đổ dữ liệu cho bảng `z_protokoll`
--

INSERT INTO `z_protokoll` (`prid`, `id`, `db`, `uid`, `datum`, `art`) VALUES
(16, 12, 'nav', 2, '2016-02-19', 'neu'),
(17, 6, 'nav', 2, '2016-02-19', 'edit');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `6_color`
--
ALTER TABLE `6_color`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `checkbox`
--
ALTER TABLE `checkbox`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `checkbox_english`
--
ALTER TABLE `checkbox_english`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`cid`);

--
-- Chỉ mục cho bảng `content_history`
--
ALTER TABLE `content_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Chỉ mục cho bảng `delete`
--
ALTER TABLE `delete`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `fernlehrgang_wait_lesson`
--
ALTER TABLE `fernlehrgang_wait_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`fid`);

--
-- Chỉ mục cho bảng `form_auswertung`
--
ALTER TABLE `form_auswertung`
  ADD PRIMARY KEY (`aid`);

--
-- Chỉ mục cho bảng `form_field`
--
ALTER TABLE `form_field`
  ADD PRIMARY KEY (`ffid`);

--
-- Chỉ mục cho bảng `galerie`
--
ALTER TABLE `galerie`
  ADD PRIMARY KEY (`gid`);

--
-- Chỉ mục cho bảng `galerie_group`
--
ALTER TABLE `galerie_group`
  ADD PRIMARY KEY (`ggid`);

--
-- Chỉ mục cho bảng `galerie_name`
--
ALTER TABLE `galerie_name`
  ADD PRIMARY KEY (`gnid`);

--
-- Chỉ mục cho bảng `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`imgid`);

--
-- Chỉ mục cho bảng `img_group`
--
ALTER TABLE `img_group`
  ADD PRIMARY KEY (`gid`);

--
-- Chỉ mục cho bảng `morp_color`
--
ALTER TABLE `morp_color`
  ADD PRIMARY KEY (`colid`);

--
-- Chỉ mục cho bảng `morp_courses`
--
ALTER TABLE `morp_courses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `morp_customer`
--
ALTER TABLE `morp_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `morp_download`
--
ALTER TABLE `morp_download`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `morp_download_historie`
--
ALTER TABLE `morp_download_historie`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `morp_email`
--
ALTER TABLE `morp_email`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `morp_fa`
--
ALTER TABLE `morp_fa`
  ADD PRIMARY KEY (`faid`);

--
-- Chỉ mục cho bảng `morp_intern`
--
ALTER TABLE `morp_intern`
  ADD PRIMARY KEY (`mid`);

--
-- Chỉ mục cho bảng `morp_kurse`
--
ALTER TABLE `morp_kurse`
  ADD PRIMARY KEY (`kid`);

--
-- Chỉ mục cho bảng `morp_kursplan`
--
ALTER TABLE `morp_kursplan`
  ADD PRIMARY KEY (`pid`);

--
-- Chỉ mục cho bảng `morp_lesson`
--
ALTER TABLE `morp_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `morp_mitarbeiter`
--
ALTER TABLE `morp_mitarbeiter`
  ADD PRIMARY KEY (`mid`);

--
-- Chỉ mục cho bảng `morp_sprachdatei`
--
ALTER TABLE `morp_sprachdatei`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `morp_stimmen`
--
ALTER TABLE `morp_stimmen`
  ADD PRIMARY KEY (`stid`);

--
-- Chỉ mục cho bảng `morp_suche_count`
--
ALTER TABLE `morp_suche_count`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `kid` (`kid`,`navid`,`art`);

--
-- Chỉ mục cho bảng `morp_suche_keyw`
--
ALTER TABLE `morp_suche_keyw`
  ADD PRIMARY KEY (`kid`),
  ADD UNIQUE KEY `keyword` (`keyw`);
ALTER TABLE `morp_suche_keyw` ADD FULLTEXT KEY `keyw` (`keyw`);

--
-- Chỉ mục cho bảng `morp_trainer`
--
ALTER TABLE `morp_trainer`
  ADD PRIMARY KEY (`tid`);

--
-- Chỉ mục cho bảng `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`navid`),
  ADD UNIQUE KEY `navid` (`ebene`,`navid`,`parent`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`nid`);

--
-- Chỉ mục cho bảng `newsletter`
--
ALTER TABLE `newsletter`
  ADD UNIQUE KEY `nlid` (`nlid`);

--
-- Chỉ mục cho bảng `news_group`
--
ALTER TABLE `news_group`
  ADD PRIMARY KEY (`ngid`);

--
-- Chỉ mục cho bảng `nl_verteiler`
--
ALTER TABLE `nl_verteiler`
  ADD UNIQUE KEY `vid` (`vid`);

--
-- Chỉ mục cho bảng `page1_headline`
--
ALTER TABLE `page1_headline`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page1_logo`
--
ALTER TABLE `page1_logo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page1_text_bottom`
--
ALTER TABLE `page1_text_bottom`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page1_text_top`
--
ALTER TABLE `page1_text_top`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page2_footer`
--
ALTER TABLE `page2_footer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page2_footer_item`
--
ALTER TABLE `page2_footer_item`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page2_header`
--
ALTER TABLE `page2_header`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page2_header_item`
--
ALTER TABLE `page2_header_item`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `page2_text`
--
ALTER TABLE `page2_text`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`pid`);

--
-- Chỉ mục cho bảng `pdf_checkbox`
--
ALTER TABLE `pdf_checkbox`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pdf_checkbox_english`
--
ALTER TABLE `pdf_checkbox_english`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pdf_group`
--
ALTER TABLE `pdf_group`
  ADD PRIMARY KEY (`pgid`);

--
-- Chỉ mục cho bảng `pdf_store`
--
ALTER TABLE `pdf_store`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pfad`
--
ALTER TABLE `pfad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Chỉ mục cho bảng `tabelle`
--
ALTER TABLE `tabelle`
  ADD PRIMARY KEY (`tabid`);

--
-- Chỉ mục cho bảng `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`tid`),
  ADD UNIQUE KEY `tname` (`tname`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Chỉ mục cho bảng `user_test`
--
ALTER TABLE `user_test`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_test_active`
--
ALTER TABLE `user_test_active`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `z_protokoll`
--
ALTER TABLE `z_protokoll`
  ADD PRIMARY KEY (`prid`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `6_color`
--
ALTER TABLE `6_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `checkbox`
--
ALTER TABLE `checkbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `checkbox_english`
--
ALTER TABLE `checkbox_english`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `content`
--
ALTER TABLE `content`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `content_history`
--
ALTER TABLE `content_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT cho bảng `delete`
--
ALTER TABLE `delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `fernlehrgang_wait_lesson`
--
ALTER TABLE `fernlehrgang_wait_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `form`
--
ALTER TABLE `form`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `form_auswertung`
--
ALTER TABLE `form_auswertung`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `form_field`
--
ALTER TABLE `form_field`
  MODIFY `ffid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `galerie`
--
ALTER TABLE `galerie`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `galerie_group`
--
ALTER TABLE `galerie_group`
  MODIFY `ggid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `galerie_name`
--
ALTER TABLE `galerie_name`
  MODIFY `gnid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `image`
--
ALTER TABLE `image`
  MODIFY `imgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `img_group`
--
ALTER TABLE `img_group`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `morp_color`
--
ALTER TABLE `morp_color`
  MODIFY `colid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `morp_courses`
--
ALTER TABLE `morp_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `morp_customer`
--
ALTER TABLE `morp_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_download`
--
ALTER TABLE `morp_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_download_historie`
--
ALTER TABLE `morp_download_historie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_email`
--
ALTER TABLE `morp_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_fa`
--
ALTER TABLE `morp_fa`
  MODIFY `faid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT cho bảng `morp_intern`
--
ALTER TABLE `morp_intern`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_kurse`
--
ALTER TABLE `morp_kurse`
  MODIFY `kid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `morp_kursplan`
--
ALTER TABLE `morp_kursplan`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `morp_lesson`
--
ALTER TABLE `morp_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_mitarbeiter`
--
ALTER TABLE `morp_mitarbeiter`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_sprachdatei`
--
ALTER TABLE `morp_sprachdatei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_stimmen`
--
ALTER TABLE `morp_stimmen`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_suche_count`
--
ALTER TABLE `morp_suche_count`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_suche_keyw`
--
ALTER TABLE `morp_suche_keyw`
  MODIFY `kid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `morp_trainer`
--
ALTER TABLE `morp_trainer`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nav`
--
ALTER TABLE `nav`
  MODIFY `navid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `nlid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `news_group`
--
ALTER TABLE `news_group`
  MODIFY `ngid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `nl_verteiler`
--
ALTER TABLE `nl_verteiler`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `page1_headline`
--
ALTER TABLE `page1_headline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT cho bảng `page1_logo`
--
ALTER TABLE `page1_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT cho bảng `page1_text_bottom`
--
ALTER TABLE `page1_text_bottom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `page1_text_top`
--
ALTER TABLE `page1_text_top`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `page2_footer`
--
ALTER TABLE `page2_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `page2_footer_item`
--
ALTER TABLE `page2_footer_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=726;

--
-- AUTO_INCREMENT cho bảng `page2_header`
--
ALTER TABLE `page2_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT cho bảng `page2_header_item`
--
ALTER TABLE `page2_header_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT cho bảng `page2_text`
--
ALTER TABLE `page2_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `pdf`
--
ALTER TABLE `pdf`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `pdf_checkbox`
--
ALTER TABLE `pdf_checkbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=600;

--
-- AUTO_INCREMENT cho bảng `pdf_checkbox_english`
--
ALTER TABLE `pdf_checkbox_english`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `pdf_group`
--
ALTER TABLE `pdf_group`
  MODIFY `pgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `pdf_store`
--
ALTER TABLE `pdf_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT cho bảng `pfad`
--
ALTER TABLE `pfad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tabelle`
--
ALTER TABLE `tabelle`
  MODIFY `tabid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `template`
--
ALTER TABLE `template`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `user_test`
--
ALTER TABLE `user_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `user_test_active`
--
ALTER TABLE `user_test_active`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `z_protokoll`
--
ALTER TABLE `z_protokoll`
  MODIFY `prid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
