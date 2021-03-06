-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jun 11, 2022 at 05:26 PM
-- Server version: 8.0.29
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SIBW`
--

CREATE USER 'usuario'@'%' IDENTIFIED BY 'usuario';
GRANT SELECT,INSERT,UPDATE ON SIBW.* TO 'usuario'@'%';

CREATE USER 'super'@'%' IDENTIFIED BY 'super';
GRANT ALL PRIVILEGES ON SIBW.* TO 'super'@'%';

-- --------------------------------------------------------

--
-- Table structure for table `Comentario`
--

CREATE TABLE `Comentario` (
  `ID` int NOT NULL,
  `ID_Usuario` int NOT NULL,
  `Fecha` datetime NOT NULL,
  `Texto` varchar(1000) NOT NULL,
  `ID_Producto` int NOT NULL,
  `Editado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Comentario`
--

INSERT INTO `Comentario` (`ID`, `ID_Usuario`, `Fecha`, `Texto`, `ID_Producto`, `Editado`) VALUES
(52, 12, '2022-06-01 23:41:19', 'no se', 5, 0),
(54, 21, '2022-06-02 01:51:17', 'asdddd', 5, 0),
(55, 21, '2022-06-02 01:51:24', 'dsaa\r\nno digass eso\r\n', 1, 1),
(58, 12, '2022-06-02 03:12:08', 'asdasdasdsa', 8, 1),
(61, 12, '2022-06-02 11:01:09', 'asd', 1, 0),
(64, 12, '2022-06-02 11:02:25', 'asdasd', 1, 0),
(69, 22, '2022-06-02 12:26:22', 'asdasd', 1, 0),
(71, 22, '2022-06-02 12:39:29', 'k', 3, 0),
(72, 12, '2022-06-10 23:32:20', 'una pena', 1, 1),
(85, 12, '2022-06-11 10:29:04', 'a que si?\r\n', 1, 0),
(88, 12, '2022-06-11 10:39:57', 'jaja sio', 7, 0),
(89, 12, '2022-06-11 19:00:01', 'esta perfecto', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Etiquetas`
--

CREATE TABLE `Etiquetas` (
  `ID_Producto` int NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Etiquetas`
--

INSERT INTO `Etiquetas` (`ID_Producto`, `Nombre`) VALUES
(1, 'GPUA'),
(1, 'NVIDIA'),
(9, '12'),
(9, '12th'),
(9, 'boxed'),
(9, 'cpu'),
(9, 'gen'),
(9, 'generacion'),
(9, 'intel'),
(9, 'overclock'),
(9, 'pc'),
(9, 'procesador'),
(9, 'top'),
(132, 'aqua'),
(132, 'asd'),
(132, 'dsa'),
(132, 'mana;sdlks');

-- --------------------------------------------------------

--
-- Table structure for table `Fabricante`
--

CREATE TABLE `Fabricante` (
  `Nombre` varchar(100) NOT NULL,
  `Facebook` varchar(100) DEFAULT NULL,
  `Twitter` varchar(100) DEFAULT NULL,
  `YouTube` varchar(100) DEFAULT NULL,
  `Pagina oficial` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Fabricante`
--

INSERT INTO `Fabricante` (`Nombre`, `Facebook`, `Twitter`, `YouTube`, `Pagina oficial`) VALUES
('AMD', 'AMD', 'amd', 'amd', 'https://www.amd.com'),
('asd', 'asd', 'asd', 'asd', 'asd'),
('Intel', 'Intel', 'intel', 'channelintel', 'https://www.intel.com'),
('Nintendo', 'Nintendo', 'nintendoeurope', 'Nintendo', 'https://www.nintendo.com/'),
('NVIDIA', 'NVIDIA', 'nvidia', 'NVIDIA', 'https://www.nvidia.com/es-es/geforce/graphics-cards/30-series/rtx-3090/'),
('Sony Computer Entertainment', 'playstation', 'playstation', 'PlayStation', 'https://www.playstation.com'),
('Western Digital', 'WesternDigitalCorporation', 'WesternDigital', 'westerndigital', 'https://www.westerndigital.com/'),
('XBOX', 'xbox', 'xbox', 'xbox', 'https://www.xbox.com');

-- --------------------------------------------------------

--
-- Table structure for table `Imagenes`
--

CREATE TABLE `Imagenes` (
  `ID_Imagen` int NOT NULL,
  `ID_Producto` int NOT NULL,
  `Ruta Imagen` varchar(100) NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Imagenes`
--

INSERT INTO `Imagenes` (`ID_Imagen`, `ID_Producto`, `Ruta Imagen`, `Descripcion`) VALUES
(1, 1, 'static/images/3090_3.png', 'Otra vista'),
(2, 1, 'static/images/3090_4.png', 'Otra vista de la GPU'),
(3, 1, 'static/images/3090.png', 'Vista trasera'),
(4, 2, 'static/images/controller.png', 'Vista frontal'),
(5, 2, 'static/images/elite2_1.png', 'Parte trasera'),
(6, 2, 'static/images/elite2_2.png', ''),
(7, 3, 'static/images/NVME_1.png', 'El propio disco duro SSD'),
(8, 3, 'static/images/NVME_2.png', ''),
(9, 4, 'static/images/ps5_1.png', 'Posici??n horizontal'),
(10, 4, 'static/images/ps5_2.png', 'Otra vista'),
(11, 4, 'static/images/PS5.png', 'Consola y mando'),
(12, 5, 'static/images/AMD_CPU_1.png', 'Caja del procesador'),
(13, 5, 'static/images/AMD_CPU_2.png', 'IHS del microprocesador'),
(14, 6, 'static/images/HDD_1.png', ''),
(15, 6, 'static/images/HDD_2.png', 'Interior del disco'),
(16, 7, 'static/images/nintendo_switch_oled_white_1.png', 'Caja de la consola'),
(17, 8, 'static/images/Series_X_1.png', 'Consola y mando en vista isom??trica'),
(18, 8, 'static/images/Series_X_2.png', 'Frontal de la consola'),
(19, 9, 'static/images/intel_cpu_1.png', 'Caja del procesador Intel'),
(20, 9, 'static/images/intel_cpu_2.png', 'IHS del microprocesador'),
(21, 10, 'static/images/slim1.png', 'Consola y mando'),
(22, 10, 'static/images/slim2.png', 'Caja de la consola'),
(23, 10, 'static/images/slim3.png', 'Vista frontal'),
(24, 10, 'static/images/slim4.png', 'Posisici??n en vertical'),
(25, 11, 'static/images/pro1.png', 'Caja de la consola'),
(26, 11, 'static/images/pro2.png', 'Posici??n en vertical'),
(27, 11, 'static/images/pro3.png', 'Posici??n en horizontal'),
(28, 12, 'static/images/ones1.png', 'Consola y mando'),
(29, 12, 'static/images/ones2.png', 'Frontal de la consola'),
(30, 12, 'static/images/ones3.png', 'Caja de la consola'),
(31, 13, 'static/images/x1.png', 'Consola y mando'),
(32, 13, 'static/images/x2.png', 'Frontal'),
(33, 13, 'static/images/x3.png', ''),
(34, 14, 'static/images/6900_1.png', 'Vista general'),
(35, 14, 'static/images/6900_2.png', 'Parte trasera'),
(36, 14, 'static/images/6900_3.png', 'PPuertos'),
(37, 14, 'static/images/6900_4.png', 'Frontal'),
(38, 15, 'static/images/switch1.png', 'Consola con los joycons'),
(39, 15, 'static/images/switch2.png', 'Se puede conectar a la TV'),
(40, 15, 'static/images/switch3.png', 'Tambi??n se pueden desacoplar los joycons'),
(41, 15, 'static/images/switch4.png', 'Caja de la consola'),
(42, 16, 'static/images/ps5mando1.png', 'Frontal'),
(43, 16, 'static/images/ps5mando2.png', 'Lateral'),
(44, 16, 'static/images/ps5mando3.png', 'Caja'),
(45, 17, 'static/images/ps4mando1.png', ''),
(46, 17, 'static/images/ps4mando2.png', 'Caja del mando'),
(47, 18, 'static/images/elite1.png', 'Frontal'),
(48, 18, 'static/images/elite2.png', 'Lateral'),
(49, 18, 'static/images/elite3.png', 'Caja del mando'),
(50, 19, 'static/images/5900x_1.png', 'Caja del microprocesador.'),
(51, 19, 'static/images/5900x_2.png', 'IHS del microprocesador.'),
(53, 1, 'static/images/3090_2.png', 'Vista general');

-- --------------------------------------------------------

--
-- Table structure for table `Pais`
--

CREATE TABLE `Pais` (
  `CountryCode` char(3) NOT NULL,
  `CountryName` varchar(200) NOT NULL,
  `Code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Pais`
--

INSERT INTO `Pais` (`CountryCode`, `CountryName`, `Code`) VALUES
('ABW', 'Aruba', 'AW'),
('AFG', 'Afghanistan', 'AF'),
('AGO', 'Angola', 'AO'),
('AIA', 'Anguilla', 'AI'),
('ALA', '??land', 'AX'),
('ALB', 'Albania', 'AL'),
('AND', 'Andorra', 'AD'),
('ARE', 'United Arab Emirates', 'AE'),
('ARG', 'Argentina', 'AR'),
('ARM', 'Armenia', 'AM'),
('ASM', 'American Samoa', 'AS'),
('ATA', 'Antarctica', 'AQ'),
('ATF', 'French Southern Territories', 'TF'),
('ATG', 'Antigua and Barbuda', 'AG'),
('AUS', 'Australia', 'AU'),
('AUT', 'Austria', 'AT'),
('AZE', 'Azerbaijan', 'AZ'),
('BDI', 'Burundi', 'BI'),
('BEL', 'Belgium', 'BE'),
('BEN', 'Benin', 'BJ'),
('BES', 'Bonaire', 'BQ'),
('BFA', 'Burkina Faso', 'BF'),
('BGD', 'Bangladesh', 'BD'),
('BGR', 'Bulgaria', 'BG'),
('BHR', 'Bahrain', 'BH'),
('BHS', 'Bahamas', 'BS'),
('BIH', 'Bosnia and Herzegovina', 'BA'),
('BLM', 'Saint Barth??lemy', 'BL'),
('BLR', 'Belarus', 'BY'),
('BLZ', 'Belize', 'BZ'),
('BMU', 'Bermuda', 'BM'),
('BOL', 'Bolivia', 'BO'),
('BRA', 'Brazil', 'BR'),
('BRB', 'Barbados', 'BB'),
('BRN', 'Brunei', 'BN'),
('BTN', 'Bhutan', 'BT'),
('BVT', 'Bouvet Island', 'BV'),
('BWA', 'Botswana', 'BW'),
('CAF', 'Central African Republic', 'CF'),
('CAN', 'Canada', 'CA'),
('CCK', 'Cocos [Keeling] Islands', 'CC'),
('CHE', 'Switzerland', 'CH'),
('CHL', 'Chile', 'CL'),
('CHN', 'China', 'CN'),
('CIV', 'Ivory Coast', 'CI'),
('CMR', 'Cameroon', 'CM'),
('COD', 'Democratic Republic of the Congo', 'CD'),
('COG', 'Republic of the Congo', 'CG'),
('COK', 'Cook Islands', 'CK'),
('COL', 'Colombia', 'CO'),
('COM', 'Comoros', 'KM'),
('CPV', 'Cape Verde', 'CV'),
('CRI', 'Costa Rica', 'CR'),
('CUB', 'Cuba', 'CU'),
('CUW', 'Curacao', 'CW'),
('CXR', 'Christmas Island', 'CX'),
('CYM', 'Cayman Islands', 'KY'),
('CYP', 'Cyprus', 'CY'),
('CZE', 'Czech Republic', 'CZ'),
('DEU', 'Germany', 'DE'),
('DJI', 'Djibouti', 'DJ'),
('DMA', 'Dominica', 'DM'),
('DNK', 'Denmark', 'DK'),
('DOM', 'Dominican Republic', 'DO'),
('DZA', 'Algeria', 'DZ'),
('ECU', 'Ecuador', 'EC'),
('EGY', 'Egypt', 'EG'),
('ERI', 'Eritrea', 'ER'),
('ESH', 'Western Sahara', 'EH'),
('ESP', 'Spain', 'ES'),
('EST', 'Estonia', 'EE'),
('ETH', 'Ethiopia', 'ET'),
('FIN', 'Finland', 'FI'),
('FJI', 'Fiji', 'FJ'),
('FLK', 'Falkland Islands', 'FK'),
('FRA', 'France', 'FR'),
('FRO', 'Faroe Islands', 'FO'),
('FSM', 'Micronesia', 'FM'),
('GAB', 'Gabon', 'GA'),
('GBR', 'United Kingdom', 'GB'),
('GEO', 'Georgia', 'GE'),
('GGY', 'Guernsey', 'GG'),
('GHA', 'Ghana', 'GH'),
('GIB', 'Gibraltar', 'GI'),
('GIN', 'Guinea', 'GN'),
('GLP', 'Guadeloupe', 'GP'),
('GMB', 'Gambia', 'GM'),
('GNB', 'Guinea-Bissau', 'GW'),
('GNQ', 'Equatorial Guinea', 'GQ'),
('GRC', 'Greece', 'GR'),
('GRD', 'Grenada', 'GD'),
('GRL', 'Greenland', 'GL'),
('GTM', 'Guatemala', 'GT'),
('GUF', 'French Guiana', 'GF'),
('GUM', 'Guam', 'GU'),
('GUY', 'Guyana', 'GY'),
('HKG', 'Hong Kong', 'HK'),
('HMD', 'Heard Island and McDonald Islands', 'HM'),
('HND', 'Honduras', 'HN'),
('HRV', 'Croatia', 'HR'),
('HTI', 'Haiti', 'HT'),
('HUN', 'Hungary', 'HU'),
('IDN', 'Indonesia', 'ID'),
('IMN', 'Isle of Man', 'IM'),
('IND', 'India', 'IN'),
('IOT', 'British Indian Ocean Territory', 'IO'),
('IRL', 'Ireland', 'IE'),
('IRN', 'Iran', 'IR'),
('IRQ', 'Iraq', 'IQ'),
('ISL', 'Iceland', 'IS'),
('ISR', 'Israel', 'IL'),
('ITA', 'Italy', 'IT'),
('JAM', 'Jamaica', 'JM'),
('JEY', 'Jersey', 'JE'),
('JOR', 'Jordan', 'JO'),
('JPN', 'Japan', 'JP'),
('KAZ', 'Kazakhstan', 'KZ'),
('KEN', 'Kenya', 'KE'),
('KGZ', 'Kyrgyzstan', 'KG'),
('KHM', 'Cambodia', 'KH'),
('KIR', 'Kiribati', 'KI'),
('KNA', 'Saint Kitts and Nevis', 'KN'),
('KOR', 'South Korea', 'KR'),
('KWT', 'Kuwait', 'KW'),
('LAO', 'Laos', 'LA'),
('LBN', 'Lebanon', 'LB'),
('LBR', 'Liberia', 'LR'),
('LBY', 'Libya', 'LY'),
('LCA', 'Saint Lucia', 'LC'),
('LIE', 'Liechtenstein', 'LI'),
('LKA', 'Sri Lanka', 'LK'),
('LSO', 'Lesotho', 'LS'),
('LTU', 'Lithuania', 'LT'),
('LUX', 'Luxembourg', 'LU'),
('LVA', 'Latvia', 'LV'),
('MAC', 'Macao', 'MO'),
('MAF', 'Saint Martin', 'MF'),
('MAR', 'Morocco', 'MA'),
('MCO', 'Monaco', 'MC'),
('MDA', 'Moldova', 'MD'),
('MDG', 'Madagascar', 'MG'),
('MDV', 'Maldives', 'MV'),
('MEX', 'Mexico', 'MX'),
('MHL', 'Marshall Islands', 'MH'),
('MKD', 'Macedonia', 'MK'),
('MLI', 'Mali', 'ML'),
('MLT', 'Malta', 'MT'),
('MMR', 'Myanmar [Burma]', 'MM'),
('MNE', 'Montenegro', 'ME'),
('MNG', 'Mongolia', 'MN'),
('MNP', 'Northern Mariana Islands', 'MP'),
('MOZ', 'Mozambique', 'MZ'),
('MRT', 'Mauritania', 'MR'),
('MSR', 'Montserrat', 'MS'),
('MTQ', 'Martinique', 'MQ'),
('MUS', 'Mauritius', 'MU'),
('MWI', 'Malawi', 'MW'),
('MYS', 'Malaysia', 'MY'),
('MYT', 'Mayotte', 'YT'),
('NAM', 'Namibia', 'NA'),
('NCL', 'New Caledonia', 'NC'),
('NER', 'Niger', 'NE'),
('NFK', 'Norfolk Island', 'NF'),
('NGA', 'Nigeria', 'NG'),
('NIC', 'Nicaragua', 'NI'),
('NIU', 'Niue', 'NU'),
('NLD', 'Netherlands', 'NL'),
('NOR', 'Norway', 'NO'),
('NPL', 'Nepal', 'NP'),
('NRU', 'Nauru', 'NR'),
('NZL', 'New Zealand', 'NZ'),
('OMN', 'Oman', 'OM'),
('PAK', 'Pakistan', 'PK'),
('PAN', 'Panama', 'PA'),
('PCN', 'Pitcairn Islands', 'PN'),
('PER', 'Peru', 'PE'),
('PHL', 'Philippines', 'PH'),
('PLW', 'Palau', 'PW'),
('PNG', 'Papua New Guinea', 'PG'),
('POL', 'Poland', 'PL'),
('PRI', 'Puerto Rico', 'PR'),
('PRK', 'North Korea', 'KP'),
('PRT', 'Portugal', 'PT'),
('PRY', 'Paraguay', 'PY'),
('PSE', 'Palestine', 'PS'),
('PYF', 'French Polynesia', 'PF'),
('QAT', 'Qatar', 'QA'),
('REU', 'R??union', 'RE'),
('ROU', 'Romania', 'RO'),
('RUS', 'Russia', 'RU'),
('RWA', 'Rwanda', 'RW'),
('SAU', 'Saudi Arabia', 'SA'),
('SDN', 'Sudan', 'SD'),
('SEN', 'Senegal', 'SN'),
('SGP', 'Singapore', 'SG'),
('SGS', 'South Georgia and the South Sandwich Islands', 'GS'),
('SHN', 'Saint Helena', 'SH'),
('SJM', 'Svalbard and Jan Mayen', 'SJ'),
('SLB', 'Solomon Islands', 'SB'),
('SLE', 'Sierra Leone', 'SL'),
('SLV', 'El Salvador', 'SV'),
('SMR', 'San Marino', 'SM'),
('SOM', 'Somalia', 'SO'),
('SPM', 'Saint Pierre and Miquelon', 'PM'),
('SRB', 'Serbia', 'RS'),
('SSD', 'South Sudan', 'SS'),
('STP', 'S??o Tom?? and Pr??ncipe', 'ST'),
('SUR', 'Suriname', 'SR'),
('SVK', 'Slovakia', 'SK'),
('SVN', 'Slovenia', 'SI'),
('SWE', 'Sweden', 'SE'),
('SWZ', 'Swaziland', 'SZ'),
('SXM', 'Sint Maarten', 'SX'),
('SYC', 'Seychelles', 'SC'),
('SYR', 'Syria', 'SY'),
('TCA', 'Turks and Caicos Islands', 'TC'),
('TCD', 'Chad', 'TD'),
('TGO', 'Togo', 'TG'),
('THA', 'Thailand', 'TH'),
('TJK', 'Tajikistan', 'TJ'),
('TKL', 'Tokelau', 'TK'),
('TKM', 'Turkmenistan', 'TM'),
('TLS', 'East Timor', 'TL'),
('TON', 'Tonga', 'TO'),
('TTO', 'Trinidad and Tobago', 'TT'),
('TUN', 'Tunisia', 'TN'),
('TUR', 'Turkey', 'TR'),
('TUV', 'Tuvalu', 'TV'),
('TWN', 'Taiwan', 'TW'),
('TZA', 'Tanzania', 'TZ'),
('UGA', 'Uganda', 'UG'),
('UKR', 'Ukraine', 'UA'),
('UMI', 'U.S. Minor Outlying Islands', 'UM'),
('URY', 'Uruguay', 'UY'),
('USA', 'United States', 'US'),
('UZB', 'Uzbekistan', 'UZ'),
('VAT', 'Vatican City', 'VA'),
('VCT', 'Saint Vincent and the Grenadines', 'VC'),
('VEN', 'Venezuela', 'VE'),
('VGB', 'British Virgin Islands', 'VG'),
('VIR', 'U.S. Virgin Islands', 'VI'),
('VNM', 'Vietnam', 'VN'),
('VUT', 'Vanuatu', 'VU'),
('WLF', 'Wallis and Futuna', 'WF'),
('WSM', 'Samoa', 'WS'),
('XKX', 'Kosovo', 'XK'),
('YEM', 'Yemen', 'YE'),
('ZAF', 'South Africa', 'ZA'),
('ZMB', 'Zambia', 'ZM'),
('ZWE', 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `Palabrota`
--

CREATE TABLE `Palabrota` (
  `palabra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Palabrota`
--

INSERT INTO `Palabrota` (`palabra`) VALUES
('anormal'),
('caca'),
('cerdo'),
('imbecil'),
('inutil'),
('joder'),
('marrano'),
('mierda'),
('payasa'),
('payaso'),
('puta'),
('subnormal');

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `ID` int NOT NULL,
  `Precio` double NOT NULL,
  `Nombre` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Descripci??n` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Titulo pagina` varchar(100) NOT NULL,
  `Nombre_Fabricante` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Publicado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Productos`
--

INSERT INTO `Productos` (`ID`, `Precio`, `Nombre`, `Descripci??n`, `Titulo pagina`, `Nombre_Fabricante`, `Publicado`) VALUES
(1, 2200, 'NVIDIA GeForce RTX 3090 Founders Edition', '<p> <!--Contiene una breve descripcion del articulo, ademas de estar justificado el texto-->\r\n    La GeForce RTX??? 3090 es una gran GPU endiablada (BFGPU) con rendimiento de la clase TITAN. Con\r\n    tecnolog??a de Ampere, la arquitectura RTX de la segunda generaci??n de NVIDIA, duplica el trazado de\r\n    rayos y el rendimiento de IA con n??cleos con trazado de rayos (RT) y n??cleos Tensor mejorados y nuevos\r\n    multiprocesadores de streaming mejorados. Adem??s, presenta unos asombrosos 24 GB de memoria G6X, todo para ofrecer la experiencia de gaming\r\n    definitiva.\r\n</p>\r\n\r\n<p>\r\n    Las unidades son muy limitadas debido a los problemas actuales del mundo, por lo que el precio ha subido\r\n    mucho. Adem??s s??lo se puede comprar una por usuario y en caso de detectar cualquier uso de bots o scripts para automatizar la compra masiva se le banear?? del sitio web.\r\n</p>\r\n\r\n<p>\r\n    Nota: Hay que tener en cuenta que es una tarjeta gr??fica muy larga por lo que es necesario medir el\r\n    interior de la caja disponible antes de proceder a comprarla (s??lo es una recomendaci??n).\r\n</p>\r\n\r\n<p>\r\n    Nota 2: Esta tarjeta es la versi??n LHR (Low Hash Rate) por lo que tiene bloqueada la mitad de la potencia para minar criptomonedas. Si la va a usar para minar, esta no es su tarjeta.\r\n</p>\r\n\r\n\r\n<table> <!--Tabla con las especificaciones del producto-->\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            N??cleos CUDA\r\n        </td>\r\n\r\n        <td>\r\n            10496\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Frecuencia normal(GHz)\r\n        </td>\r\n        <td>\r\n            1.40\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Frecuencia acelerada (GHz)\r\n        </td>\r\n        <td>\r\n            1.70\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Tipo de memoria\r\n        </td>\r\n        <td>\r\n            GDDR6X\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Cantidad de memoria\r\n        </td>\r\n        <td>\r\n            24GB\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Ancho de interfaz de memoria\r\n        </td>\r\n        <td>\r\n            384-bit\r\n        </td>\r\n    </tr>\r\n</table>\r\n\r\n\r\n<div class=\"video-container\">\r\n<div><strong>V??deo relacionado</strong></div>\r\n    <div>\r\n        <iframe class=\"video\" src=\"https://www.youtube.com/embed/BCcN8kCD90A\" title=\"YouTube video player\"\r\n            allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\"\r\n            allowfullscreen></iframe>\r\n    </div>\r\n</div>', 'NVIDIA RTX 3090', 'NVIDIA', 0),
(2, 180, 'Mando Xbox Elite Series 2', '<p>El mando Xbox Elite Series 2 se adapta al tama??o de tu mano y a tu estilo de juego con configuraciones que pueden mejorar la precisi??n, la velocidad y el alcance mediante gatillos de distintas formas y tama??os. Puedes intercambiar los joysticks de metal y crucetas para lograr un control y ergonom??a personalizados. Incorpora cuatro ranuras para palancas intercambiables que puedes conectar o quitar sin ninguna herramienta.</p>\r\n\r\n<p>\r\nDise??ado para satisfacer las necesidades de los jugadores competitivos de la actualidad, el nuevo Mando inal??mbrico Xbox Elite Series 2 cuenta con m??s de 30 nuevas formas para jugar como un profesional.\r\n</p>\r\n\r\n<p>\r\nUtiliza opciones de configuraci??n exclusivas, como la asignaci??n de botones a comandos de voz como \"grabar eso\" o \"hacer una captura de pantalla\". Asigna un bot??n para que act??e como la tecla May??s para habilitar entradas alternativas de cada uno de los otros botones.\r\n</p>', 'Mando Elite 2', 'XBOX', 1),
(3, 89.99, 'WD_Black PC SN750 NVMe', '<p>\r\nWD_BLACK??? SN750 NVMe??? SSD ofrece un rendimiento espectacular a los aficionados a los juegos y el hardware que est??n pensando en montar o mejorar un ordenador. WD_BLACK??? SN750 NVMe??? SSD est?? disponible en capacidades de hasta 4 TB y compite con algunos de los mejores discos del mercado para ofrecer una ventaja a los jugadores.\r\n</p>\r\n\r\n<p>\r\n<strong>El Rendimiento Es Importante:</strong> Tanto si quiere mejorar la velocidad general de su sistema como los tiempos de carga de juegos y niveles, elija la opci??n m??s r??pida: el disco WD_BLACK??? reduce el tiempo de espera para que pueda volver a la acci??n y jugar con ventaja.\r\n</p>\r\n\r\n<p>\r\n<strong>Espacio Para Juegos:</strong> El n??cleo del disco WD_BLACK??? es su revolucionaria tecnolog??a NAND. Al ofrecer el doble de densidad de almacenamiento que la generaci??n anterior, la tecnolog??a NAND 3D permite superar las limitaciones de almacenamiento y mostrar la enorme innovaci??n que esto representa. El resultado es una capacidad ampliada en un disco de una sola cara que ocupa aproximadamente lo mismo que un paquete de chicles y que aun as?? ofrece suficiente espacio para archivos grandes y videojuegos.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>\r\nCapacidad\r\n</td>\r\n<td>\r\n250 GB\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nConexi??n\r\n</td>\r\n<td>\r\nPCIe\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nConector\r\n</td>\r\n<td>\r\nM.2\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nDimensiones (largo, ancho y alto)\r\n</td>\r\n<td>\r\n80mm x 24.2mm x 8.1mm\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nRendimiento de lectura secuencial\r\n</td>\r\n<td>\r\n3100MB/s\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nRendimiento de escritura secuencial\r\n</td>\r\n<td>\r\n1600MB/s\r\n</td>\r\n</tr>\r\n</table>', 'WD Black NVME', 'Western Digital', 1),
(4, 500, 'PlayStation 5 Blu-Ray', '<p>\r\nLa consola PS5 hace posibles otras formas de juego que jam??s hab??as imaginado.\r\n</p>\r\n\r\n<p>\r\nExperimenta cargas r??pidas gracias a una unidad de estado s??lido (SSD) de alta velocidad, una inmersi??n m??s profunda con retroalimentaci??n h??ptica, gatillos adaptables y audio 3D, adem??s de una nueva generaci??n de juegos de PlayStation.\r\n</p>\r\n\r\n<p>\r\nDescubre una experiencia de juego m??s intensa mediante tecnolog??a h??ptica, gatillos adaptables y audio 3D y una inmersi??n que te dejar?? sin aliento.\r\n</p>\r\n<p>\r\nD??jate sorprender por unos gr??ficos adecuados y experimenta nuevas funciones de PS5.\r\n</p>\r\n<p>\r\n<strong>Incre??ble velocidad: </strong>La potencia de las unidades de CPU, GPU y SSD personalizadas con sistema de E / S integrado ofrece un rendimiento nunca antes visto en una consola PlayStation.\r\n</p>\r\n<p>\r\n<strong>SSD de ultra alta velocidad: </strong>Optimice sus sesiones de juego con tiempos de carga casi instant??neos para los juegos de PS5 instalados.\r\n</p>\r\n<p>\r\n<strong>Sistema de E / S integrado: </strong>La integraci??n de sistemas personalizados de la consola PS5 permite a los desarrolladores extraer datos del SSD tan r??pidamente que pueden crear juegos de formas previamente impensables.\r\n</p>\r\n\r\n<div class=\"video-container\">\r\n<div><strong>Video relacionado</strong></div>\r\n<div>\r\n<iframe class=\"video\" src=\"https://www.youtube-nocookie.com/embed/RkC0l4iekYo\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>\r\n</div>', 'PS5', 'Sony Computer Entertainment', 0),
(5, 350, 'AMD Ryzen 7 5700G', '<p>\r\nCuando cuentas con la arquitectura de procesadores m??s avanzada del mundo para jugadores y creadores de contenido, las posibilidades son infinitas. Ya sea que juegues los juegos m??s recientes, dise??es el pr??ximo rascacielos o proceses datos, necesitas un procesador poderoso que pueda dar respuesta a todas estas demandas, y m??s. Sin lugar a dudas, los procesadores para computadoras de escritorio AMD Ryzen??? serie 5000 elevan el nivel de expectativa para jugadores y artistas por igual.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>N??mero de n??cleos de CPU</td>\r\n<td>8</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>N??mero de subprocesos</td>\r\n<td>16</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Reloj de aumento m??x</td>\r\n<td>Hasta 4.6 GHz</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Reloj base</td>\r\n<td>3.8</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Cach?? L2 total</td>\r\n<td>4 MB</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Cach?? L3 total</td>\r\n<td>16 MB</td>\r\n</tr>\r\n<tr>\r\n<td>Socket</td>\r\n<td>AM4</td>\r\n</tr>\r\n\r\n</table>', 'AMD Ryzen 7 5700G', 'AMD', 0),
(6, 38.5, 'Western Digital Blue HDD 1TB 3.5\"\r\n', '<p>\r\nFabricado seg??n los m??s altos est??ndares de calidad y fiabilidad de WD, WD Blue ofrece prestaciones y capacidades de nivel b??sico ideales para sus necesidades de inform??tica. WD Blue est?? dise??ado por la marca en que conf??a con la calidad que esperar??a de una soluci??n de almacenamiento probada para su uso diario.\r\n</p>\r\n<p>\r\nUn cl??sico moderno. Los discos WD Blue est??n dise??ados y fabricados con la probada tecnolog??a de los premiados discos duros de WD para ordenadores de sobremesa y port??tiles. WD Blue establece las bases para el almacenamiento diario al proporcionar un rendimiento mejorado en comparaci??n con las anteriores generaciones y al mantener la calidad y fiabilidad de WD caracter??sticas de seis generaciones. La diferencia radica en que nuestros colores nunca desaparecen, generaci??n tras generaci??n.\r\n</p>', 'Western Digital Blue HDD 1TB', 'Western Digital', 0),
(7, 350, 'Nintendo Switch OLED Blanca', '<p>\r\nConsola Nintendo Switch (modelo OLED) incluye una pantalla de 7 pulgadas con un marco m??s fino. Los colores intensos y el alto contraste de la pantalla proporcionan una experiencia de juego port??til y de sobremesa enriquecedora, y aportan mucha vida a los juegos, tanto si compites a gran velocidad sobre el asfalto como si te ves las caras con enemigos temibles.\r\n</p>\r\n<p>\r\n<strong>Disfruta del modo sobremesa en el ??ngulo que prefieras. </strong>Abre el soporte y p??sale un mando a otro jugador para compartir la pantalla y disfrutar del multijugador competitivo y cooperativo, donde y cuando quieras.\r\nEl soporte ancho ajustable de Nintendo Switch (modelo OLED) puede colocarse en el ??ngulo que prefieras para disfrutar del modo sobremesa c??modamente.\r\n</p>\r\n\r\n<p>\r\n<strong>Nueva base con puerto LAN por cable.</strong>\r\nLa base incluida con Nintendo Switch (modelo OLED) cuenta con dos puertos USB, un puerto HDMI para conectarse al televisor y un nuevo puerto LAN por cable, que permite disfrutar del juego en l??nea de manera m??s estable en el modo televisor.\r\n</p>\r\n\r\n<p>\r\n<strong>64 GB de almacenamiento interno.</strong>\r\nNintendo Switch (modelo OLED) cuenta con 64 GB de almacenamiento interno. Puedes ampliar el espacio disponible con una tarjeta microSD compatible (a la venta por separado). Descarga tus juegos favoritos para disfrutar de ellos donde y cuando quieras.\r\n</p>\r\n<p>\r\n<strong>Altavoces integrados con audio optimizado.</strong>\r\nDisfruta de un sonido n??tido cuando juegues en el modo port??til o en el modo sobremesa.\r\n</p>\r\n<p>\r\nJuega donde, cuando y con quien quieras con sus tres modos de juego.\r\n</p>\r\n\r\n<ul>\r\n<li><strong>Modo televisor:</strong> la consola Nintendo Switch (modelo OLED) se encaja en la base para jugar en el televisor. El puerto LAN integrado ofrece otra forma de conectarse a internet en el modo televisor.\r\n</li>\r\n<li>\r\n<strong>Modo sobremesa:</strong> se abre el soporte de la parte posterior y se utiliza la pantalla de la consola para disfrutar como nunca de partidas multijugador con los dos mandos Joy-Con incluidos. El soporte ancho ajustable aporta m??s estabilidad y permite inclinar la consola en un ??ngulo mayor para ver mejor la pantalla.\r\n</li>\r\n<li>\r\n<strong>Modo port??til:</strong> los usuarios pueden llevarse la consola donde quieran y jugar con varios amigos de manera local o en l??nea. La pantalla OLED de 7 pulgadas ofrece colores m??s intensos y un alto contraste de imagen.\r\n</li>\r\n</ul>', 'Nintendo Switch OLED', 'Nintendo', 1),
(8, 500, 'Xbox Series X', '<p>\r\nPresentamos Xbox Series X, la Xbox m??s r??pida y potente de la historia. Juega a miles de t??tulos de cuatro generaciones de consolas: todos los juegos tienen el mejor aspecto y se juegan mejor en Xbox Series X. \r\n</p>\r\n<p>\r\nEn el coraz??n de Series X se incluye Xbox Velocity Architecture, que combina un disco SSD personalizado con software integrado para ofrecer un juego agilizado m??s r??pido y tiempos de descarga significativamente reducidos. Mu??vete sin problemas entre varios juegos en un instante con Reanudado r??pido. Explora nuevos mundos detallados y disfruta de la acci??n como nunca antes con los incomparables 12 teraflops de potencia de procesamiento de gr??ficos en bruto. \r\n</p>\r\n<p>\r\nDisfruta de juegos 4K a hasta 120 fotogramas por segundo, sonido espacial 3D avanzado y mucho m??s. Comienza con una biblioteca instant??nea de m??s de 100 juegos de alta calidad, incluidos t??tulos totalmente nuevos de Xbox Game Studios, como Halo Infinite, el d??a de su lanzamiento, con Xbox Game Pass Ultimate (la suscripci??n se vende por separado).*\r\n</p>\r\n\r\n\r\n<div class=\"video-container\">\r\n<div><strong>V??deo relacionado</strong></div>\r\n\r\n<div>\r\n<iframe class=\"video\" src=\"https://www.youtube-nocookie.com/embed/0tUqIHwHDEc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>\r\n</div>', 'XBOX Series X', 'XBOX', 0),
(9, 669.9, 'Intel Core i9-12900K', '<p>\r\nProcesador de escritorio desbloqueado Intel?? Core ??? i9-12900K de 12.?? generaci??n. Con tecnolog??a Intel?? Turbo Boost Max 3.0 y compatibilidad con PCIe Gen 5.0 y 4.0, compatibilidad con DDR5 y DDR4, los procesadores de escritorio Intel?? Core ??? desbloqueados de 12.a generaci??n est??n optimizados para jugadores entusiastas y creadores serios y ayudan a ofrecer overclocking de alto rendimiento para un impulso adicional. Soluci??n t??rmica NO incluida en la caja. Compatible con placas base basadas en chipset de la serie 600. 125W.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>Socket</td>\r\n<td>1700</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Frecuencia</td>\r\n<td>3,2 GHz</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Cach?? L3</td>\r\n<td>30 MB</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>N??cleos E+P</td>\r\n<td>16 (8P+8E)</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>RAM Soportada</td>\r\n<td>DDR4 y DDR5</td>\r\n</tr>\r\n</table>', 'Intel Core i9-12900K', 'Intel', 0),
(10, 395.57, 'PlayStation 4 Slim', '<p>\r\n??Conoce la nueva PS4 modelo SLIM, disfruta de una PS4 m??s estilizada y compacta con la misma potencia de juego!\r\n</p>\r\n<p>\r\n<strong>Disfruta de una PS4 m??s estilizada y compacta con la misma potencia de juego.</strong>\r\nComo novedad principal tiene un tama??o y peso reducidos. Un 30% m??s peque??a que la PS4 original y un peso de tan solo 2,1 kg.\r\n</p>\r\n<p>\r\n<strong>Mejoras en el apartado WiFi.</strong>\r\nAhora PS4 SLIM soporta WiFi 5Ghz ofreciendo mayor calidad de conexi??n, mejorando as?? tu experiencia online tanto en partidas como en contenidos multimedia streaming.\r\n</p>\r\n<p>\r\n<strong>Gr??ficos HDR.</strong>\r\nLa consola m??s vendida del mundo, ahora con un nuevo aspecto y tambi??n con asombrosos gr??ficos HDR. Disfruta de colores incre??blemente vivos y brillantes.\r\n</p>\r\n<p>\r\n<strong>Ahorro energ??tico</strong>\r\nMayor eficiencia energ??tica ayudando a su vez a que se caliente mucho menos.\r\n</p>\r\n<p>\r\n<strong>Control sin igual.</strong>\r\nEl mando inal??mbrico DUALSHOCK 4 se ha actualizado con un nuevo aspecto y dise??o, incluida una barra luminosa m??s visible y colorida para que tengas un control a??n mayor del juego en tus manos.\r\n</p>', 'PS4 Slim', 'Sony Computer Entertainment', 0),
(11, 450, 'PlayStation 4 Pro', '<p>\r\nPlayStation 4 Pro llega a la familia de consolas de sobremesa de Sony para llevar todo su potencial a otro nivel. Esta versi??n vitaminada de la actual consola de nueva generaci??n proporciona innnovaci??n en gr??ficos de alta tecnolog??a, mejorando el cat??logo de juegos actual con la ??ltima tecnolog??a de imagen a trav??s de la resoluci??n 4K y High Dymanic Range (HDR) en televisores compatibles. Los juegos que ya se ve??an extraordinariamente bien en PS4, se ver??n a??n m??s ricos y detallados gracias a la GPU m??s poderosa y la CPU m??s r??pida que PlayStation 4 Pro alberga en su interior.\r\n</p>\r\n<p>\r\nDisfruta de las mejoras de rendimiento que PlayStation 4 Pro ofrece en m??ltiples juegos ya compatibles como Battlefield 1, Call of Duty: Infinite Warfare, Titanfall 2, Dishonored 2, Rise of the Tomb Raider y Uncharted 4; consigue una experiencia incluso m??s inversiva en t??tulos de PlayStation VR como Driveclub VR o Battlezone; y contin??a aprovechando la potencia t??cnica de tu PlayStation 4 Pro en pr??ximos lanzamientos como Watch Dogs 2, Final Fantasy XV, The Last Guardian, Gran Turismo Sport y Horizon Zero Dawn.\r\n</p>\r\n<p>\r\n<strong>Caracter??sticas:</strong>\r\n</p>\r\n\r\n<p>\r\n<strong>GR??FICOS ESPECTACULARES.</strong> Si dispones de un televisor 4K podr??s disfrutar de una experiencia visual de mayor calidad, alcanzado una resoluci??n 4K (mediante renderizado de imagen o reescalado), as?? como una m??s r??pida y estable frecuencia de frames. Si dispones de un televisor HD podr??s disfrutar de una jugabilidad mejorada en t??tulos de PS4 alcanzando una resoluci??n de 1080p con una frecuencia de frames mayor y m??s estable.\r\n</p>\r\n<p>\r\n<strong>M??XIMO RENDIMIENTO.</strong> El doble de potencia (comparado con el modelo anterior) con una incre??ble combinaci??n de calidad visual y ejecuci??n en una consola.\r\n</p>\r\n<p>\r\n<strong>JUGABILIDAD MEJORADA.</strong> La frecuencia de frames ha sido mejorada en los juegos compatibles, siendo m??s r??pida para permitir una imagen super n??tida y unos gr??ficos m??s fluidos en pantalla.\r\n</p>\r\n<p>\r\n<strong>TECNOLOG??A DE ALTO RANGO DIN??MICO (HDR).</strong> Im??genes m??s realistas, sorprendentemente v??vidas y m??s cercanas a la resoluci??n del ojo humano real en los televisores compatibles con HDR.\r\n</p>\r\n<p>\r\n<strong>SHARE AND PLAY Y REMOTE PLAY MEJORADOS. </strong>Comparte o ejecuta en streaming tus juegos con una resoluci??n m??nima de 1080p y 60fps estables.\r\n</p>\r\n<p>\r\n<strong>M??S CONEXIONES.</strong> Velocidad de 2.4GHz/5GHz modo de Wi-Fi seleccionable y salida HDMI 2.0.\r\n</p>\r\n<p>\r\n<strong>DOS CONSOLAS, UNA FAMILIA PS4. </strong>Con??ctate con tus amigos entre consolas PlayStation 4 Pro y PlayStation 4 y eng??nchate a la mayor comunidad de jugadores online con PlayStation Plus.\r\n</p>\r\n\r\n<table>\r\n  <tr>\r\n    <td>Dimensiones: </td>\r\n    <td>295 x 327 x 55 mm</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Peso: </td>\r\n    <td>3,3kg</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Modelo: </td>\r\n    <td>CUH-7002B</td>\r\n  </tr>\r\n  <tr>\r\n    <td>CPU: </td>\r\n    <td>AMD Jaguar x86-64, 8-core</td>\r\n  </tr>\r\n  <tr>\r\n    <td>GPU: </td>\r\n    <td>AMD Radeon, 4.20 TFLOP</td>\r\n  </tr>\r\n  <tr>\r\n    <td>RAM: </td>\r\n    <td>8GB + 1GB de RAM convencional DRAM</td>\r\n  </tr>\r\n</table>', 'PS4 Pro', 'Sony Computer Entertainment', 0),
(12, 248.96, 'XBOX ONE S', '<p>\r\nM??s delgada, m??s ligera y m??s elegante. Juega a todo el cat??logo de Xbox One con la consola m??s peque??a, compacta y avanzada fabricada por Microsoft. La Xbox One S de 1TB es un 40% m??s peque??a, incluye fuente de alimentaci??n interna, lector infrarrojo, compatibilidad con resoluciones 4K Ultra HD en contenidos en streaming y pel??culas Blu-Ray y mejora tu experiencia de juego y video gracias al soporte de High Dynamic Range (HDR), que permite disfrutar de colores m??s vivos y mayor contraste entre blancos y negros en t??tulos como Gears of War 4 o Forza Horizon 3. Adem??s, la Xbox One S incluye la nueva versi??n m??s estilizada del Xbox One Controller, ahora con textura para mejor agarre, mayor rango inal??mbrico y tecnolog??a Bluetooth que permiten compatibilidad directa con ordenadores, tablets y smartphones bajo Windows 10.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>Color</td>\r\n<td>Blanco</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Capacidad de RAM</td>\r\n<td>8192 MB</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Tipo de RAM</td>\r\n<td>DDR3</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Modelo del procesador</td>\r\n<td>AMD Jaguar</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>GPU</td>\r\n<td>AMD Radeon</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Capacidad de almacenamiento</td>\r\n<td>1 TB </td>\r\n</tr>\r\n</table>', 'XBOX ONE S', 'XBOX', 0),
(13, 415, 'XBOX ONE X', '<p>\r\nVive la aut??ntica experiencia inmersiva 4K real con Xbox One X, la nueva consola de Microsoft que cuenta con un 40% m??s de potencia que cualquier otra m??quina del mercado.\r\n</p>\r\n\r\n<p>\r\nXbox One X ha sido dise??ada para ser la mejor consola para crear y jugar a juegos ofreciendo la mayor fidelidad gr??fica a trav??s de los mejores desarrolladores de videojuego del mundo. Xbox One X se ha creado para brindar una potencia sin l??mites, una compatibilidad absoluta y un dise??o del m??s alto nivel. Es la consola m??s potente y a la vez de menor tama??o que ha creado Xbox hasta la fecha.\r\n</p>\r\n<p>\r\nCon un 40 por ciento m??s de potencia que cualquier otra consola, permitir?? disfrutar de una experiencia de juego en resoluci??n 4K real si se usa con una pantalla 4K, como los televisores QLED TV de Samsung. Xbox One X tambi??n ofrece el mejor paquete de entretenimiento en 4K, al ser la ??nica consola con resoluci??n 4K Ultra HD para ver pel??culas en Blu-Ray y contenido en streaming, compatibilidad con HDR para juegos y v??deos y compatibilidad con Dolby Atmos.\r\n</p>\r\n<p>\r\n<strong>Resoluci??n 4K</strong>\r\nCon un procesamiento gr??fico de 6 teraflops, es la primera y ??nica consola con aut??ntica resoluci??n 4K y HDR. Todo ello dentro de la Xbox m??s peque??a hasta la fecha.\r\n</p>\r\n<p>\r\n<strong>Mayor velocidad</strong>\r\nDisfruta de la jugabilidad m??s suave gracias a su CPU AMD personalizada de 8 n??cleos y 2.3GHz y a su ancho de banda de memoria de 326GB/s.\r\n</p>\r\n\r\n<p>\r\n<strong>M??s memoria</strong>\r\nGracias al rendimiento de sus 12GB de memoria gr??fica GDDR5 los juegos se ejecutar??n mejor que nunca y con menores tiempos de carga.\r\n</p>\r\n\r\n<p>\r\n<strong>Compatible</strong>\r\nXbox One X es compatible con todos los juegos y accesorios de Xbox One y mejorar?? tu experiencia de juego incluso en pantallas con resoluci??n 1080p.\r\n</p>\r\n\r\n<p>\r\n<strong>Motor Scorpio</strong>\r\nCon 6 teraflops, ancho de banda de memoria de 326GB/s y chips avanzados de silicio personalizados es el procesador m??s potente visto en una consola.\r\n</p>\r\n\r\n<p>\r\n<strong>C??mara de vapor</strong>\r\nPor primera vez en consolas dom??sticas, Scorpio emplea refrigeraci??n l??quida para garantizar que no se sobrecaliente.\r\n</p>\r\n\r\n<p>\r\n<strong>Ventilador centr??fugo</strong>\r\nDise??ado al estilo de un turbocompresor, comprime r??pidamente el aire para ofrecer refrigeraci??n m??xima con el m??nimo ruido.\r\n</p>\r\n<p>\r\n<strong>M??todo Hovis</strong>\r\nUn vanguardista sistema digital de distribuci??n de energ??a que afina los voltajes que recibe cada chip logrando reducir el consumo sin afectar al rendimiento.\r\n</p>', 'XBOX ONE X', 'XBOX', 0),
(14, 1500, 'AMD Radeon RX 6900XT', '<p>\r\nLa tarjeta XT gr??fica AMD Radeon??? RX 6900 XT, potenciada con la arquitectura AMD RDNA??? 2 y equipada con 80 potentes unidades de procesamiento mejoradas, 128MB de la flamante tecnolog??a AMD Infinity Cache y 16GB de memoria GDDR6 dedicada, est?? dise??ada para alcanzar velocidades de cuadros ultraaltas y jugar en 4K con una calidad deslumbrante.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>Unidades de c??mputo</td>\r\n<td>80</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Frecuencia de aumento</td>\r\n<td>Hasta 2250 MHz</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Ray Accelerators</td>\r\n<td>80</td>\r\n</tr>\r\n<td>Tama??o de la memoria</td>\r\n<td>16 GB</td>\r\n</tr>\r\n<tr>\r\n<td>Tipo de memoria</td>\r\n<td>GDDR6</td>\r\n</tr>\r\n<tr>\r\n<td>Interfaz de memoria</td>\r\n<td>256-bit</td>\r\n</tr>\r\n</table>\r\n', 'RX6900XT', 'AMD', 0),
(15, 300, 'Nintendo Switch V2', '<p>\r\n??Alguna vez has dejado un juego por falta de tiempo? La consola Nintendo Switch V2 puede transformarse para adaptarse a tu situaci??n, de modo que puedes jugar a los juegos que t?? quieras por muy ocupado que est??s. Es una nueva era en la que no tienes que adaptar tu vida a los videojuegos: ahora es la consola la que se adapta a tu vida. Disfruta de tus juegos cuando quieras, donde quieras y como quieras con modos de juego flexibles.\r\n</p>\r\n<p>\r\nEn esta nueva versi??n Nintendo Switch V2 cuenta con las mismas prestaciones que Nintendo Switch 2017, salvo con una peque??a modificaci??n en la fabricaci??n del procesador para mejorar su eficiencia, y por lo tanto mejorar la autonom??a de la bater??a en esta versi??n que llega a ser de 4.5 a 9 horas. <br/>\r\n</p>\r\n\r\n<ul>\r\n<li class=\"separacion-abajo\"><strong>3 Modos de juego</strong></li>\r\n\r\n<ul>\r\n<li class=\"separacion-abajo\">\r\n<strong>Modo Televisor:</strong> Re??ne a todos ante una pantalla y disfruta del juego en compa????a. Conecta la consola al televisor y todos lo pasar??n en grande, ni??os y mayores. Es una forma estupenda de incluir a toda la casa, familia y amigos, en el juego.\r\n</li>\r\n<li class=\"separacion-abajo\">\r\n<strong>Modo Sobremesa:</strong> Comparte la pantalla, comparte la diversi??n. Si no tienes acceso a un televisor, abre el soporte de la consola y p??sale un Joy-Con a un amigo para jugar partidas cooperativas o competitivas en la misma pantalla de la consola.\r\n</li>\r\n<li class=\"separacion-abajo\">\r\n<strong>Modo Port??til:</strong> Lleva contigo una espl??ndida pantalla all?? donde vayas. Disfruta de la misma experiencia de juego que en el televisor, pero en tus manos. D??jate envolver en juegos a los que nunca pensaste que podr??as jugar fuera de casa, cuando quieras y como quieras.\r\n</li>\r\n</ul>\r\n<li class=\"separacion-abajo\">\r\n<strong>Multijugador local.</strong> Conecta hasta ocho consolas para partidas multijugador. Hasta ocho consolas Nintendo Switch se pueden conectar para jugar a juegos competitivos o cooperativos de un m??ximo de ocho jugadores.\r\n</li>\r\n<li class=\"separacion-abajo\">\r\n<strong>Multijugador online.</strong> Si te suscribes al servicio online de Nintendo Switch*, podr??s jugar partidas online con amigos u otros jugadores en todo el mundo. Tambi??n podr??s sincronizar una aplicaci??n para dispositivo m??vil que permite quedar para jugar, reunirse en salas online o chatear durante la partida. *La suscripci??n a este servicio de pago estar?? disponible de forma gratuita hasta su lanzamiento oficial en oto??o de 2017.\r\n</li>\r\n</ul>', 'Switch V2', 'Nintendo', 0),
(16, 64.95, 'Mando DualSense PlayStation 5', '<p>\r\nSi necesitas un buen mando que te acompa??e en tus sesiones de juego con tus amigos, el mando Sony PS5 DualSense??? es tu aliado.\r\n</p>\r\n\r\n<p>\r\n<strong>Multiplicar?? tus sensaciones</strong>\r\nEl nuevo DualSense, el mando que multiplicar?? tus sensaciones ofreci??ndote un nuevo concepto de inmersi??n. Haz que los mundos de juego cobren vida y empieza a crear nuevos y ??picos recuerdos. Siente la respuesta t??ctil capaz de transmitir las acciones del juego con dos activadores que sustituyen a los motores de vibraci??n tradicionales. Cuando lo tienes en las manos, estas vibraciones din??micas son capaces de simular todo tipo de sensaciones, como los elementos del entorno o el retroceso de diferentes armas.\r\n</p>', 'Mando PS5', 'Sony Computer Entertainment', 0),
(17, 45.41, 'Mando DualShock 4 PlayStation 4', '<p>\r\nToma el control de una nueva generaci??n de videojuegos con un mando inal??mbrico DualShock 4 Black redise??ado que pone en tus manos la mayor precisi??n en tus juegos de PlayStation 4. Con un panel t??ctil nuevo que revela desde arriba la barra luminosa y un elegante acabado mate, es la forma m??s ergon??micas e intuitiva de jugar que haya habido nunca.\r\n</p>\r\n\r\n<p>\r\n<strong>DISE??O ERGON??MICO.</strong>\r\nUn dise??o elegante y s??per confortable unido a los botones y sticks anal??gicos altamente sensibles aportan una mayor precisi??n durante el juego.\r\n</p>\r\n\r\n<p>\r\n<strong>Bot??n SHARE.</strong>\r\nUtiliza el bot??n SHARE para compartir tus haza??as en las redes sociales. Sube tu partida en streaming a Twitch, YouTube o Dailymotion o edita las grabaciones y comp??rtelas en Facebook y Twitter. Adem??s, podr??s invitar a tus amigos que se encuentren online para jugar a tus juegos contigo -incluso si no disponen del juego- con Share Play.\r\n</p>\r\n<p>\r\n<strong>TOUCH PAD.</strong>\r\nControla y dibuja mediante el touchpad de alta respuesta, ahora redise??ada para que puedas ver la barra de luz desde la parte superior mientras juegas.\r\n</p>\r\n<p>\r\n<strong>BARRA DE LUZ.</strong>\r\nLa barra de luz integrada puede emitir varios colores para personalizar tu experiencia y a??adir una nueva dimensi??n a los juegos. Adem??s, ayuda a la PlayStation Camera a trackear la posici??n del mando para mejorar la interacci??n virtual mientras utilizas PlayStation VR.\r\n\r\n<p>\r\n<strong>ALTAVOZ INTEGRADO Y CONECTOR DE AURICULARES EST??REO.</strong> Disfruta de los efectos extra de sonido -emitidos directamente desde el mando- y chatea con tus amigos online a trav??s de auriculares con micr??fono incorporado. Auriculares est??reo incluidos con la PS4.\r\n</p>\r\n<p>\r\n<strong>VIBRACI??N.</strong>\r\nSiente las vibraciones emitidas por  el mando mediante unos motores de vibraci??n m??s intuitivos y precisos.\r\n</p>\r\n<p>\r\n<strong>REMOTE PLAY.</strong>\r\nJuega a tus juegos de PS4 en streaming en Windows PC or Mac para poder seguir jugando si te encuentras lejos de tu televisor. El adaptador inal??mbrico DualShock 4 USB mejora la experiencia Remote Play permiti??ndote jugar de manera inal??mbrica.\r\n</p>\r\n<p>\r\n<strong>CONTROL CUSTOMIZADO.</strong>\r\nConfigura tu mando DualShock 4 de la manera que quieras: elige el volumen de los altavoces, deshabilita la vibraci??n, ajusta el brillo de la barra de luz para incrementar la vida ??til de tu bater??a cuando ya no la necesites. Puedes elegir si compartir los datos v??as Bluetooth o utilizando un cable USB para conectarlo a la PS4.\r\n</p>', 'Mando PS4', 'Sony Computer Entertainment', 0),
(18, 120.65, 'Mando Xbox Elite (Serie 1)', '<p>\r\nEl mando Xbox Elite se adapta al tama??o de tu mano y a tu estilo de juego con configuraciones que pueden mejorar la precisi??n, la velocidad y el alcance mediante gatillos de distintas formas y tama??os. Puedes intercambiar los joysticks de metal y crucetas para lograr un control y ergonom??a personalizados. Incorpora cuatro ranuras para palancas intercambiables que puedes conectar o quitar sin ninguna herramienta. Si accionas el bloqueo de gatillos de alta sensibilidad, podr??s disparar m??s r??pido y ahorrar tu valioso tiempo en cada toque de gatillo. Todas las superficies y detalles est??n dise??ados para satisfacer las demandas de los jugadores m??s competitivos: los anillos reforzados de bajo rozamiento alrededor de cada joystick minimizan el desgaste y aportan suavidad de movimiento. Por otro lado, los agarres de goma con relieve confieren al mando una apariencia s??lida y proporcionan m??s estabilidad.\r\n</p>', 'Mando XBOX Elite 1', 'XBOX', 0),
(19, 450.93, 'AMD Ryzen 9 5900X', '<p>\r\nEl procesador que ofrece la mejor experiencia de juego del mundo. 12 n??cleos para potenciar la experiencia de juego, la transmisi??n en vivo y mucho m??s.\r\n</p>\r\n\r\n<p>\r\n<strong>\r\nTecnolog??a AMD StoreMI:\r\n</strong>\r\nSoftware que combina la velocidad de SSD con la capacidad de disco duro en una sola unidad r??pida y f??cil de administrar, gratuita con la placa madre AMD Serie 400.\r\n</p>\r\n\r\n<p>\r\n<strong>Utilidad AMD Ryzen??? Master:</strong>\r\nLa utilidad de overclocking sencilla y a la vez potente para los procesadores AMD Ryzen???\r\n</p>\r\n\r\n<p>\r\n<strong>AMD Ryzen??? VR-Ready Premium:</strong>\r\nPara los usuarios que exigen una experiencia premium de realidad virtual, AMD ofrece procesadores especiales Ryzen??? VR-Ready Premium de alto rendimiento.\r\n</p>\r\n\r\n\r\n<table>\r\n<tr>\r\n<td>Frecuencia</td>\r\n<td>3,7 GHz</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>N??mero de n??cleos</td>\r\n<td>12</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Socket</td>\r\n<td>AM4</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Cach?? del procesador</td>\r\n<td>64 MB</td>\r\n</tr>\r\n\r\n</table>', 'AMD R9 5900X', 'AMD', 0),
(132, 321, 'dsa', '321', '123', 'AMD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE `Usuarios` (
  `ID` int NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Correo` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `esModerador` tinyint(1) NOT NULL,
  `esGestor` tinyint(1) NOT NULL,
  `esSuperusuario` tinyint(1) NOT NULL,
  `Genero` varchar(100) NOT NULL,
  `Foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Direccion` varchar(200) NOT NULL,
  `CountryCode` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`ID`, `Nombre`, `Correo`, `Password`, `esModerador`, `esGestor`, `esSuperusuario`, `Genero`, `Foto`, `Direccion`, `CountryCode`) VALUES
(12, 'Andr??s', 'example@example.com', '$2y$10$JWJrTYaMBQUBJuBwKJkCw.VGlSgxU1V88UnbihZClPSRvbHA1QTMO', 1, 1, 1, 'Hombre', 'static/images/ZDVORKB2B4GUPIPWBC3SN5IJXI_idUser12.jpg', 'Urb.', 'ESP'),
(21, 'asd', 'asd@asd.asd', '$2y$10$11PhWBIwb0r7ifuJt4XlQeEfVlWTN3bwgEHUU7IC58upQHfqME/96', 1, 0, 0, 'Hombre', NULL, 'asd', 'AGO'),
(22, 'asd', 'dsa@dsa.dsa', '$2y$10$jeCXE5MfHQ7t98S79ca2mOarTaw8o4FO1p3XKLWQyfcZkAYUxpIAG', 0, 0, 0, 'Prefiero no decirlo', 'static/images/default_user_idUser22.png', 'Urb.', 'ALB'),
(24, 'asdasd', 'asdasd@asdasd.asd', '$2y$10$8pU6sdOnBo9TWshwmM5c2efWCny9539y9K.OxbpVe/owEgdoHdD0W', 0, 1, 0, 'Hombre', NULL, 'asd', 'AFG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comentario`
--
ALTER TABLE `Comentario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indexes for table `Etiquetas`
--
ALTER TABLE `Etiquetas`
  ADD PRIMARY KEY (`ID_Producto`,`Nombre`);

--
-- Indexes for table `Fabricante`
--
ALTER TABLE `Fabricante`
  ADD PRIMARY KEY (`Nombre`),
  ADD KEY `Nombre` (`Nombre`),
  ADD KEY `Nombre_2` (`Nombre`);

--
-- Indexes for table `Imagenes`
--
ALTER TABLE `Imagenes`
  ADD PRIMARY KEY (`ID_Imagen`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indexes for table `Pais`
--
ALTER TABLE `Pais`
  ADD PRIMARY KEY (`CountryCode`),
  ADD KEY `CountryCode` (`CountryCode`);

--
-- Indexes for table `Palabrota`
--
ALTER TABLE `Palabrota`
  ADD PRIMARY KEY (`palabra`);

--
-- Indexes for table `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`),
  ADD UNIQUE KEY `Nombre_2` (`Nombre`),
  ADD KEY `Nombre_Fabricante` (`Nombre_Fabricante`),
  ADD KEY `Nombre_Fabricante_2` (`Nombre_Fabricante`);

--
-- Indexes for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Correo` (`Correo`),
  ADD KEY `CountryCode` (`CountryCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comentario`
--
ALTER TABLE `Comentario`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `Imagenes`
--
ALTER TABLE `Imagenes`
  MODIFY `ID_Imagen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `Productos`
--
ALTER TABLE `Productos`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comentario`
--
ALTER TABLE `Comentario`
  ADD CONSTRAINT `Comentario_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `Productos` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `Comentario_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuarios` (`ID`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `Etiquetas`
--
ALTER TABLE `Etiquetas`
  ADD CONSTRAINT `Etiquetas_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `Productos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Fabricante`
--
ALTER TABLE `Fabricante`
  ADD CONSTRAINT `delete_cascada_fabricante` FOREIGN KEY (`Nombre`) REFERENCES `Fabricante` (`Nombre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Imagenes`
--
ALTER TABLE `Imagenes`
  ADD CONSTRAINT `Imagenes_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `Productos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `Productos_ibfk_1` FOREIGN KEY (`Nombre_Fabricante`) REFERENCES `Fabricante` (`Nombre`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`CountryCode`) REFERENCES `Pais` (`CountryCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
