-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: May 06, 2022 at 10:43 AM
-- Server version: 8.0.28
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

-- --------------------------------------------------------

CREATE USER 'usuario'@'%' IDENTIFIED BY 'usuario';
GRANT SELECT,INSERT ON SIBW.* TO 'usuario'@'%';

--
-- Table structure for table `Comentario`
--

CREATE TABLE `Comentario` (
  `Nombre` varchar(200) NOT NULL,
  `ID` int NOT NULL,
  `Fecha` datetime NOT NULL,
  `Texto` varchar(1000) NOT NULL,
  `Correo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Comentario`
--

INSERT INTO `Comentario` (`Nombre`, `ID`, `Fecha`, `Texto`, `Correo`) VALUES
('Antonio Robles', 1, '2021-05-12 12:41:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam erat metus, pellentesque non libero ac, aliquam auctor odio. Pellentesque eu efficitur est. Donec facilisis tellus ac tellus fermentum, tempor tempor nulla posuere. Duis a arcu non orci suscipit eleifend. Maecenas malesuada sem et leo iaculis dapibus. Duis arcu erat, tempor vitae fermentum ac, convallis vel mauris. Sed lacinia quam nec rhoncus tempus.\r\n', 'example@fakemail.com'),
('Juan Hidalgo', 2, '2020-04-06 13:37:00', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam erat metus, pellentesque non libero ac, aliquam auctor odio. Pellentesque eu efficitur est. Donec facilisis tellus ac tellus fermentum, tempor tempor nulla posuere. Duis a arcu non orci suscipit eleifend. Maecenas malesuada sem et leo iaculis dapibus. Duis arcu erat, tempor vitae fermentum ac, convallis vel mauris. Sed lacinia quam nec rhoncus tempus.', 'ejemplo@fakemail2.com');

-- --------------------------------------------------------

--
-- Table structure for table `Fabrica`
--

CREATE TABLE `Fabrica` (
  `Nombre` varchar(100) NOT NULL,
  `ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Fabrica`
--

INSERT INTO `Fabrica` (`Nombre`, `ID`) VALUES
('AMD', 5),
('AMD', 14),
('AMD', 19),
('Intel', 9),
('Nintendo', 7),
('Nintendo', 15),
('NVIDIA', 1),
('Sony Computer Entertainment', 4),
('Sony Computer Entertainment', 10),
('Sony Computer Entertainment', 11),
('Sony Computer Entertainment', 16),
('Sony Computer Entertainment', 17),
('Western Digital', 3),
('Western Digital', 6),
('XBOX', 2),
('XBOX', 8),
('XBOX', 12),
('XBOX', 13),
('XBOX', 18);

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
  `ID_Producto` int NOT NULL,
  `Ruta Imagen` varchar(100) NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Imagenes`
--

INSERT INTO `Imagenes` (`ID_Producto`, `Ruta Imagen`, `Descripcion`) VALUES
(1, '3090_2.png', 'Vista generalmente apreciada por todos'),
(1, '3090_3.png', 'Otra vista'),
(1, '3090_4.png', 'Otra vista de la GPU'),
(1, '3090.png', 'Vista trasera'),
(2, 'controller.png', 'Vista frontal'),
(3, 'NVME.png', 'El propio disco duro SSD'),
(4, 'PS5.png', 'Consola y mando'),
(5, 'AMD_CPU.png', 'Caja del procesados AMD'),
(6, 'HDD.png', ''),
(7, 'nintendo_switch_oled_white_1.png', 'Caja de la consola'),
(8, 'Series_X.png', 'Consola y mando en vista isométrica'),
(9, 'intel_cpu.png', 'Caja del procesador Intel'),
(10, 'slim1.png', 'Consola y mando'),
(10, 'slim2.png', 'Caja de la consola'),
(10, 'slim3.png', 'Vista frontal'),
(10, 'slim4.png', 'Posisición en vertical'),
(11, 'pro1.png', 'Caja de la consola'),
(11, 'pro2.png', 'Posición en vertical'),
(11, 'pro3.png', 'Posición en horizontal'),
(12, 'ones1.png', 'Consola y mando'),
(12, 'ones2.png', 'Frontal de la consola'),
(12, 'ones3.png', 'Caja de la consola'),
(13, 'x1.png', 'Consola y mando'),
(13, 'x2.png', 'Frontal'),
(13, 'x3.png', ''),
(14, '6900_1.png', 'Vista general'),
(14, '6900_2.png', 'Parte trasera'),
(14, '6900_3.png', 'PPuertos'),
(14, '6900_4.png', 'Frontal'),
(15, 'switch1.png', 'Consola con los joycons'),
(15, 'switch2.png', 'Se puede conectar a la TV'),
(15, 'switch3.png', 'También se pueden desacoplar los joycons'),
(15, 'switch4.png', 'Caja de la consola'),
(16, 'ps5mando1.png', 'Frontal'),
(16, 'ps5mando2.png', 'Lateral'),
(16, 'ps5mando3.png', 'Caja'),
(17, 'ps4mando1.png', ''),
(17, 'ps4mando2.png', 'Caja del mando'),
(18, 'elite1.png', 'Frontal'),
(18, 'elite2.png', 'Lateral'),
(18, 'elite3.png', 'Caja del mando'),
(19, '5900x_1.png', 'Caja del microprocesador.'),
(19, '5900x_2.png', 'IHS del microprocesador.');

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
('cabron'),
('caca'),
('cerdo'),
('cojon'),
('gilipollas'),
('imbecil'),
('marrano'),
('payaso'),
('polla'),
('puta');

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `ID` int NOT NULL,
  `Precio` double NOT NULL,
  `Nombre` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Descripción` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Titulo pagina` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Productos`
--

INSERT INTO `Productos` (`ID`, `Precio`, `Nombre`, `Descripción`, `Titulo pagina`) VALUES
(1, 2200, 'NVIDIA GeForce RTX 3090 Founders Edition', '<p> <!--Contiene una breve descripcion del articulo, ademas de estar justificado el texto-->\r\n    La GeForce RTX™ 3090 es una gran GPU endiablada (BFGPU) con rendimiento de la clase TITAN. Con\r\n    tecnología de Ampere, la arquitectura RTX de la segunda generación de NVIDIA, duplica el trazado de\r\n    rayos y el rendimiento de IA con núcleos con trazado de rayos (RT) y núcleos Tensor mejorados y nuevos\r\n    multiprocesadores de streaming mejorados. Además, presenta unos asombrosos 24 GB de memoria G6X, todo para ofrecer la experiencia de gaming\r\n    definitiva.\r\n</p>\r\n\r\n<p>\r\n    Las unidades son muy limitadas debido a los problemas actuales del mundo, por lo que el precio ha subido\r\n    mucho. Además sólo se puede comprar una por usuario y en caso de detectar cualquier uso de bots o scripts para automatizar la compra masiva se le baneará del sitio web.\r\n</p>\r\n\r\n<p>\r\n    Nota: Hay que tener en cuenta que es una tarjeta gráfica muy larga por lo que es necesario medir el\r\n    interior de la caja disponible antes de proceder a comprarla (sólo es una recomendación).\r\n</p>\r\n\r\n<p>\r\n    Nota 2: Esta tarjeta es la versión LHR (Low Hash Rate) por lo que tiene bloqueada la mitad de la potencia para minar criptomonedas. Si la va a usar para minar, esta no es su tarjeta.\r\n</p>\r\n\r\n\r\n<table> <!--Tabla con las especificaciones del producto-->\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Núcleos CUDA\r\n        </td>\r\n\r\n        <td>\r\n            10496\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Frecuencia normal(GHz)\r\n        </td>\r\n        <td>\r\n            1.40\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Frecuencia acelerada (GHz)\r\n        </td>\r\n        <td>\r\n            1.70\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Tipo de memoria\r\n        </td>\r\n        <td>\r\n            GDDR6X\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Cantidad de memoria\r\n        </td>\r\n        <td>\r\n            24GB\r\n        </td>\r\n    </tr>\r\n\r\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\r\n        <td>\r\n            Ancho de interfaz de memoria\r\n        </td>\r\n        <td>\r\n            384-bit\r\n        </td>\r\n    </tr>\r\n</table>\r\n\r\n\r\n<div class=\"video-container\">\r\n<div><strong>Vídeo relacionado</strong></div>\r\n    <div>\r\n        <iframe class=\"video\" src=\"https://www.youtube.com/embed/BCcN8kCD90A\" title=\"YouTube video player\"\r\n            allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\"\r\n            allowfullscreen></iframe>\r\n    </div>\r\n</div>', 'NVIDIA RTX 3090'),
(2, 180, 'Mando Xbox Elite Series 2', '<p>El mando Xbox Elite Series 2 se adapta al tamaño de tu mano y a tu estilo de juego con configuraciones que pueden mejorar la precisión, la velocidad y el alcance mediante gatillos de distintas formas y tamaños. Puedes intercambiar los joysticks de metal y crucetas para lograr un control y ergonomía personalizados. Incorpora cuatro ranuras para palancas intercambiables que puedes conectar o quitar sin ninguna herramienta.</p>\r\n\r\n<p>\r\nDiseñado para satisfacer las necesidades de los jugadores competitivos de la actualidad, el nuevo Mando inalámbrico Xbox Elite Series 2 cuenta con más de 30 nuevas formas para jugar como un profesional.\r\n</p>\r\n\r\n<p>\r\nUtiliza opciones de configuración exclusivas, como la asignación de botones a comandos de voz como \"grabar eso\" o \"hacer una captura de pantalla\". Asigna un botón para que actúe como la tecla Mayús para habilitar entradas alternativas de cada uno de los otros botones.\r\n</p>', 'Mando Elite 2'),
(3, 89.99, 'WD_Black PC SN750 NVMe', '<p>\r\nWD_BLACK™ SN750 NVMe™ SSD ofrece un rendimiento espectacular a los aficionados a los juegos y el hardware que estén pensando en montar o mejorar un ordenador. WD_BLACK™ SN750 NVMe™ SSD está disponible en capacidades de hasta 4 TB y compite con algunos de los mejores discos del mercado para ofrecer una ventaja a los jugadores.\r\n</p>\r\n\r\n<p>\r\n<strong>El Rendimiento Es Importante:</strong> Tanto si quiere mejorar la velocidad general de su sistema como los tiempos de carga de juegos y niveles, elija la opción más rápida: el disco WD_BLACK™ reduce el tiempo de espera para que pueda volver a la acción y jugar con ventaja.\r\n</p>\r\n\r\n<p>\r\n<strong>Espacio Para Juegos:</strong> El núcleo del disco WD_BLACK™ es su revolucionaria tecnología NAND. Al ofrecer el doble de densidad de almacenamiento que la generación anterior, la tecnología NAND 3D permite superar las limitaciones de almacenamiento y mostrar la enorme innovación que esto representa. El resultado es una capacidad ampliada en un disco de una sola cara que ocupa aproximadamente lo mismo que un paquete de chicles y que aun así ofrece suficiente espacio para archivos grandes y videojuegos.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>\r\nCapacidad\r\n</td>\r\n<td>\r\n250 GB\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nConexión\r\n</td>\r\n<td>\r\nPCIe\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nConector\r\n</td>\r\n<td>\r\nM.2\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nDimensiones (largo, ancho y alto)\r\n</td>\r\n<td>\r\n80mm x 24.2mm x 8.1mm\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nRendimiento de lectura secuencial\r\n</td>\r\n<td>\r\n3100MB/s\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nRendimiento de escritura secuencial\r\n</td>\r\n<td>\r\n1600MB/s\r\n</td>\r\n</tr>\r\n</table>', 'WD Black NVME'),
(4, 500, 'PlayStation 5 Blu-Ray', '<p>\r\nLa consola PS5 hace posibles otras formas de juego que jamás habías imaginado.\r\n</p>\r\n\r\n<p>\r\nExperimenta cargas rápidas gracias a una unidad de estado sólido (SSD) de alta velocidad, una inmersión más profunda con retroalimentación háptica, gatillos adaptables y audio 3D, además de una nueva generación de juegos de PlayStation.\r\n</p>\r\n\r\n<p>\r\nDescubre una experiencia de juego más intensa mediante tecnología háptica, gatillos adaptables y audio 3D y una inmersión que te dejará sin aliento.\r\n</p>\r\n<p>\r\nDéjate sorprender por unos gráficos adecuados y experimenta nuevas funciones de PS5.\r\n</p>\r\n<p>\r\n<strong>Increíble velocidad: </strong>La potencia de las unidades de CPU, GPU y SSD personalizadas con sistema de E / S integrado ofrece un rendimiento nunca antes visto en una consola PlayStation.\r\n</p>\r\n<p>\r\n<strong>SSD de ultra alta velocidad: </strong>Optimice sus sesiones de juego con tiempos de carga casi instantáneos para los juegos de PS5 instalados.\r\n</p>\r\n<p>\r\n<strong>Sistema de E / S integrado: </strong>La integración de sistemas personalizados de la consola PS5 permite a los desarrolladores extraer datos del SSD tan rápidamente que pueden crear juegos de formas previamente impensables.\r\n</p>', 'PS5'),
(5, 350, 'AMD Ryzen 7 5700G', '<p>\r\nCuando cuentas con la arquitectura de procesadores más avanzada del mundo para jugadores y creadores de contenido, las posibilidades son infinitas. Ya sea que juegues los juegos más recientes, diseñes el próximo rascacielos o proceses datos, necesitas un procesador poderoso que pueda dar respuesta a todas estas demandas, y más. Sin lugar a dudas, los procesadores para computadoras de escritorio AMD Ryzen™ serie 5000 elevan el nivel de expectativa para jugadores y artistas por igual.\r\n</p>', 'AMD Ryzen 7 5700G'),
(6, 38.5, 'Western Digital Blue HDD 1TB 3.5\"\r\n', '<p>\r\nFabricado según los más altos estándares de calidad y fiabilidad de WD, WD Blue ofrece prestaciones y capacidades de nivel básico ideales para sus necesidades de informática. WD Blue está diseñado por la marca en que confía con la calidad que esperaría de una solución de almacenamiento probada para su uso diario.\r\n</p>\r\n<p>\r\nUn clásico moderno. Los discos WD Blue están diseñados y fabricados con la probada tecnología de los premiados discos duros de WD para ordenadores de sobremesa y portátiles. WD Blue establece las bases para el almacenamiento diario al proporcionar un rendimiento mejorado en comparación con las anteriores generaciones y al mantener la calidad y fiabilidad de WD características de seis generaciones. La diferencia radica en que nuestros colores nunca desaparecen, generación tras generación.\r\n</p>', 'Western Digital Blue HDD 1TB'),
(7, 350, 'Nintendo Switch OLED Blanca', '<p>\r\nLa consola Nintendo Switch (modelo OLED) incluye una pantalla OLED de 7 pulgadas con colores intensos y alto contraste. También cuenta con un soporte ancho ajustable para el modo sobremesa, una nueva base con puerto LAN por cable que permite jugar en línea con una conexión a internet más estable, 64 GB de memoria interna y altavoces integrados con audio optimizado para disfrutar de un sonido más nítido en los modos portátil y sobremesa. Además, Nintendo Switch (modelo OLED) permite jugar en el televisor y compartir los mandos Joy-Con extraíbles para divertirse como nunca en partidas multijugador.\r\n</p>', 'Nintendo Switch OLED'),
(8, 500, 'Xbox Series X', '<p>\r\nPresentamos Xbox Series X, la Xbox más rápida y potente de la historia. Juega a miles de títulos de cuatro generaciones de consolas: todos los juegos tienen el mejor aspecto y se juegan mejor en Xbox Series X. En el corazón de Series X se incluye Xbox Velocity Architecture, que combina un disco SSD personalizado con software integrado para ofrecer un juego agilizado más rápido y tiempos de descarga significativamente reducidos. Muévete sin problemas entre varios juegos en un instante con Reanudado rápido. Explora nuevos mundos detallados y disfruta de la acción como nunca antes con los incomparables 12 teraflops de potencia de procesamiento de gráficos en bruto. Disfruta de juegos 4K a hasta 120 fotogramas por segundo, sonido espacial 3D avanzado y mucho más. Comienza con una biblioteca instantánea de más de 100 juegos de alta calidad, incluidos títulos totalmente nuevos de Xbox Game Studios, como Halo Infinite, el día de su lanzamiento, con Xbox Game Pass Ultimate (la suscripción se vende por separado).*\r\n</p>', 'XBOX Series X'),
(9, 669.9, 'Intel Core i9-12900K', '<p>\r\nProcesador de escritorio desbloqueado Intel® Core ™ i9-12900K de 12.ª generación. Con tecnología Intel® Turbo Boost Max 3.0 y compatibilidad con PCIe Gen 5.0 y 4.0, compatibilidad con DDR5 y DDR4, los procesadores de escritorio Intel® Core ™ desbloqueados de 12.a generación están optimizados para jugadores entusiastas y creadores serios y ayudan a ofrecer overclocking de alto rendimiento para un impulso adicional. Solución térmica NO incluida en la caja. Compatible con placas base basadas en chipset de la serie 600. 125W.\r\n</p>', 'Intel Core i9-12900K'),
(10, 395.57, 'PlayStation 4 Slim', '<p>\r\n¡Conoce la nueva PS4 modelo SLIM, disfruta de una PS4 más estilizada y compacta con la misma potencia de juego!\r\n</p>\r\n<p>\r\n<strong>Disfruta de una PS4 más estilizada y compacta con la misma potencia de juego.</strong>\r\nComo novedad principal tiene un tamaño y peso reducidos. Un 30% más pequeña que la PS4 original y un peso de tan solo 2,1 kg.\r\n</p>\r\n<p>\r\n<strong>Mejoras en el apartado WiFi.</strong>\r\nAhora PS4 SLIM soporta WiFi 5Ghz ofreciendo mayor calidad de conexión, mejorando así tu experiencia online tanto en partidas como en contenidos multimedia streaming.\r\n</p>\r\n<p>\r\n<strong>Gráficos HDR.</strong>\r\nLa consola más vendida del mundo, ahora con un nuevo aspecto y también con asombrosos gráficos HDR. Disfruta de colores increíblemente vivos y brillantes.\r\n</p>\r\n<p>\r\n<strong>Ahorro energético</strong>\r\nMayor eficiencia energética ayudando a su vez a que se caliente mucho menos.\r\n</p>\r\n<p>\r\n<strong>Control sin igual.</strong>\r\nEl mando inalámbrico DUALSHOCK 4 se ha actualizado con un nuevo aspecto y diseño, incluida una barra luminosa más visible y colorida para que tengas un control aún mayor del juego en tus manos.\r\n</p>', 'PS4 Slim'),
(11, 450, 'PlayStation 4 Pro', '<p>\r\nPlayStation 4 Pro llega a la familia de consolas de sobremesa de Sony para llevar todo su potencial a otro nivel. Esta versión vitaminada de la actual consola de nueva generación proporciona innnovación en gráficos de alta tecnología, mejorando el catálogo de juegos actual con la última tecnología de imagen a través de la resolución 4K y High Dymanic Range (HDR) en televisores compatibles. Los juegos que ya se veían extraordinariamente bien en PS4, se verán aún más ricos y detallados gracias a la GPU más poderosa y la CPU más rápida que PlayStation 4 Pro alberga en su interior.\r\n</p>\r\n<p>\r\nDisfruta de las mejoras de rendimiento que PlayStation 4 Pro ofrece en múltiples juegos ya compatibles como Battlefield 1, Call of Duty: Infinite Warfare, Titanfall 2, Dishonored 2, Rise of the Tomb Raider y Uncharted 4; consigue una experiencia incluso más inversiva en títulos de PlayStation VR como Driveclub VR o Battlezone; y continúa aprovechando la potencia técnica de tu PlayStation 4 Pro en próximos lanzamientos como Watch Dogs 2, Final Fantasy XV, The Last Guardian, Gran Turismo Sport y Horizon Zero Dawn.\r\n</p>\r\n<p>\r\n<strong>Características:</strong>\r\n</p>\r\n\r\n<p>\r\n<strong>GRÁFICOS ESPECTACULARES.</strong> Si dispones de un televisor 4K podrás disfrutar de una experiencia visual de mayor calidad, alcanzado una resolución 4K (mediante renderizado de imagen o reescalado), así como una más rápida y estable frecuencia de frames. Si dispones de un televisor HD podrás disfrutar de una jugabilidad mejorada en títulos de PS4 alcanzando una resolución de 1080p con una frecuencia de frames mayor y más estable.\r\n</p>\r\n<p>\r\n<strong>MÁXIMO RENDIMIENTO.</strong> El doble de potencia (comparado con el modelo anterior) con una increíble combinación de calidad visual y ejecución en una consola.\r\n</p>\r\n<p>\r\n<strong>JUGABILIDAD MEJORADA.</strong> La frecuencia de frames ha sido mejorada en los juegos compatibles, siendo más rápida para permitir una imagen super nítida y unos gráficos más fluidos en pantalla.\r\n</p>\r\n<p>\r\n<strong>TECNOLOGÍA DE ALTO RANGO DINÁMICO (HDR).</strong> Imágenes más realistas, sorprendentemente vívidas y más cercanas a la resolución del ojo humano real en los televisores compatibles con HDR.\r\n</p>\r\n<p>\r\n<strong>SHARE AND PLAY Y REMOTE PLAY MEJORADOS. </strong>Comparte o ejecuta en streaming tus juegos con una resolución mínima de 1080p y 60fps estables.\r\n</p>\r\n<p>\r\n<strong>MÁS CONEXIONES.</strong> Velocidad de 2.4GHz/5GHz modo de Wi-Fi seleccionable y salida HDMI 2.0.\r\n</p>\r\n<p>\r\n<strong>DOS CONSOLAS, UNA FAMILIA PS4. </strong>Conéctate con tus amigos entre consolas PlayStation 4 Pro y PlayStation 4 y engánchate a la mayor comunidad de jugadores online con PlayStation Plus.\r\n</p>\r\n\r\n<table>\r\n  <tr>\r\n    <td>Dimensiones: </td>\r\n    <td>295 x 327 x 55 mm</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Peso: </td>\r\n    <td>3,3kg</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Modelo: </td>\r\n    <td>CUH-7002B</td>\r\n  </tr>\r\n  <tr>\r\n    <td>CPU: </td>\r\n    <td>AMD Jaguar x86-64, 8-core</td>\r\n  </tr>\r\n  <tr>\r\n    <td>GPU: </td>\r\n    <td>AMD Radeon, 4.20 TFLOP</td>\r\n  </tr>\r\n  <tr>\r\n    <td>RAM: </td>\r\n    <td>8GB + 1GB de RAM convencional DRAM</td>\r\n  </tr>\r\n</table>', 'PS4 Pro'),
(12, 248.96, 'XBOX ONE S', '<p>\r\nMás delgada, más ligera y más elegante. Juega a todo el catálogo de Xbox One con la consola más pequeña, compacta y avanzada fabricada por Microsoft. La Xbox One S de 1TB es un 40% más pequeña, incluye fuente de alimentación interna, lector infrarrojo, compatibilidad con resoluciones 4K Ultra HD en contenidos en streaming y películas Blu-Ray y mejora tu experiencia de juego y video gracias al soporte de High Dynamic Range (HDR), que permite disfrutar de colores más vivos y mayor contraste entre blancos y negros en títulos como Gears of War 4 o Forza Horizon 3. Además, la Xbox One S incluye la nueva versión más estilizada del Xbox One Controller, ahora con textura para mejor agarre, mayor rango inalámbrico y tecnología Bluetooth que permiten compatibilidad directa con ordenadores, tablets y smartphones bajo Windows 10.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>Color</td>\r\n<td>Blanco</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Capacidad de RAM</td>\r\n<td>8192 MB</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Tipo de RAM</td>\r\n<td>DDR3</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Modelo del procesador</td>\r\n<td>AMD Jaguar</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>GPU</td>\r\n<td>AMD Radeon</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Capacidad de almacenamiento</td>\r\n<td>1 TB </td>\r\n</tr>\r\n</table>', 'XBOX ONE S'),
(13, 415, 'XBOX ONE X', '<p>\r\nVive la auténtica experiencia inmersiva 4K real con Xbox One X, la nueva consola de Microsoft que cuenta con un 40% más de potencia que cualquier otra máquina del mercado.\r\n</p>\r\n\r\n<p>\r\nXbox One X ha sido diseñada para ser la mejor consola para crear y jugar a juegos ofreciendo la mayor fidelidad gráfica a través de los mejores desarrolladores de videojuego del mundo. Xbox One X se ha creado para brindar una potencia sin límites, una compatibilidad absoluta y un diseño del más alto nivel. Es la consola más potente y a la vez de menor tamaño que ha creado Xbox hasta la fecha.\r\n</p>\r\n<p>\r\nCon un 40 por ciento más de potencia que cualquier otra consola, permitirá disfrutar de una experiencia de juego en resolución 4K real si se usa con una pantalla 4K, como los televisores QLED TV de Samsung. Xbox One X también ofrece el mejor paquete de entretenimiento en 4K, al ser la única consola con resolución 4K Ultra HD para ver películas en Blu-Ray y contenido en streaming, compatibilidad con HDR para juegos y vídeos y compatibilidad con Dolby Atmos.\r\n</p>\r\n<p>\r\n<strong>Resolución 4K</strong>\r\nCon un procesamiento gráfico de 6 teraflops, es la primera y única consola con auténtica resolución 4K y HDR. Todo ello dentro de la Xbox más pequeña hasta la fecha.\r\n</p>\r\n<p>\r\n<strong>Mayor velocidad</strong>\r\nDisfruta de la jugabilidad más suave gracias a su CPU AMD personalizada de 8 núcleos y 2.3GHz y a su ancho de banda de memoria de 326GB/s.\r\n</p>\r\n\r\n<p>\r\n<strong>Más memoria</strong>\r\nGracias al rendimiento de sus 12GB de memoria gráfica GDDR5 los juegos se ejecutarán mejor que nunca y con menores tiempos de carga.\r\n</p>\r\n\r\n<p>\r\n<strong>Compatible</strong>\r\nXbox One X es compatible con todos los juegos y accesorios de Xbox One y mejorará tu experiencia de juego incluso en pantallas con resolución 1080p.\r\n</p>\r\n\r\n<p>\r\n<strong>Motor Scorpio</strong>\r\nCon 6 teraflops, ancho de banda de memoria de 326GB/s y chips avanzados de silicio personalizados es el procesador más potente visto en una consola.\r\n</p>\r\n\r\n<p>\r\n<strong>Cámara de vapor</strong>\r\nPor primera vez en consolas domésticas, Scorpio emplea refrigeración líquida para garantizar que no se sobrecaliente.\r\n</p>\r\n\r\n<p>\r\n<strong>Ventilador centrífugo</strong>\r\nDiseñado al estilo de un turbocompresor, comprime rápidamente el aire para ofrecer refrigeración máxima con el mínimo ruido.\r\n</p>\r\n<p>\r\n<strong>Método Hovis</strong>\r\nUn vanguardista sistema digital de distribución de energía que afina los voltajes que recibe cada chip logrando reducir el consumo sin afectar al rendimiento.\r\n</p>', 'XBOX ONE X'),
(14, 1500, 'AMD Radeon RX 6900XT', '<p>\r\nLa tarjeta XT gráfica AMD Radeon™ RX 6900 XT, potenciada con la arquitectura AMD RDNA™ 2 y equipada con 80 potentes unidades de procesamiento mejoradas, 128MB de la flamante tecnología AMD Infinity Cache y 16GB de memoria GDDR6 dedicada, está diseñada para alcanzar velocidades de cuadros ultraaltas y jugar en 4K con una calidad deslumbrante.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>Unidades de cómputo</td>\r\n<td>80</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Frecuencia de aumento</td>\r\n<td>Hasta 2250 MHz</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>Ray Accelerators</td>\r\n<td>80</td>\r\n</tr>\r\n<td>Tamaño de la memoria</td>\r\n<td>16 GB</td>\r\n</tr>\r\n<tr>\r\n<td>Tipo de memoria</td>\r\n<td>GDDR6</td>\r\n</tr>\r\n<tr>\r\n<td>Interfaz de memoria</td>\r\n<td>256-bit</td>\r\n</tr>\r\n</table>\r\n', 'RX6900XT'),
(15, 300, 'Nintendo Switch V2', '<p>\r\n¿Alguna vez has dejado un juego por falta de tiempo? La consola Nintendo Switch V2 puede transformarse para adaptarse a tu situación, de modo que puedes jugar a los juegos que tú quieras por muy ocupado que estés. Es una nueva era en la que no tienes que adaptar tu vida a los videojuegos: ahora es la consola la que se adapta a tu vida. Disfruta de tus juegos cuando quieras, donde quieras y como quieras con modos de juego flexibles.\r\n</p>\r\n<p>\r\nEn esta nueva versión Nintendo Switch V2 cuenta con las mismas prestaciones que Nintendo Switch 2017, salvo con una pequeña modificación en la fabricación del procesador para mejorar su eficiencia, y por lo tanto mejorar la autonomía de la batería en esta versión que llega a ser de 4.5 a 9 horas. <br/>\r\n</p>\r\n\r\n<ul>\r\n<li class=\"separacion-abajo\"><strong>3 Modos de juego</strong></li>\r\n\r\n<ul>\r\n<li class=\"separacion-abajo\">\r\n<strong>Modo Televisor:</strong> Reúne a todos ante una pantalla y disfruta del juego en compañía. Conecta la consola al televisor y todos lo pasarán en grande, niños y mayores. Es una forma estupenda de incluir a toda la casa, familia y amigos, en el juego.\r\n</li>\r\n<li class=\"separacion-abajo\">\r\n<strong>Modo Sobremesa:</strong> Comparte la pantalla, comparte la diversión. Si no tienes acceso a un televisor, abre el soporte de la consola y pásale un Joy-Con a un amigo para jugar partidas cooperativas o competitivas en la misma pantalla de la consola.\r\n</li>\r\n<li class=\"separacion-abajo\">\r\n<strong>Modo Portátil:</strong> Lleva contigo una espléndida pantalla allá donde vayas. Disfruta de la misma experiencia de juego que en el televisor, pero en tus manos. Déjate envolver en juegos a los que nunca pensaste que podrías jugar fuera de casa, cuando quieras y como quieras.\r\n</li>\r\n</ul>\r\n<li class=\"separacion-abajo\">\r\n<strong>Multijugador local.</strong> Conecta hasta ocho consolas para partidas multijugador. Hasta ocho consolas Nintendo Switch se pueden conectar para jugar a juegos competitivos o cooperativos de un máximo de ocho jugadores.\r\n</li>\r\n<li class=\"separacion-abajo\">\r\n<strong>Multijugador online.</strong> Si te suscribes al servicio online de Nintendo Switch*, podrás jugar partidas online con amigos u otros jugadores en todo el mundo. También podrás sincronizar una aplicación para dispositivo móvil que permite quedar para jugar, reunirse en salas online o chatear durante la partida. *La suscripción a este servicio de pago estará disponible de forma gratuita hasta su lanzamiento oficial en otoño de 2017.\r\n</li>\r\n</ul>', 'Switch V2'),
(16, 64.95, 'Mando DualSense PlayStation 5', '<p>\r\nSi necesitas un buen mando que te acompañe en tus sesiones de juego con tus amigos, el mando Sony PS5 DualSense™ es tu aliado.\r\n</p>\r\n\r\n<p>\r\n<strong>Multiplicará tus sensaciones</strong>\r\nEl nuevo DualSense, el mando que multiplicará tus sensaciones ofreciéndote un nuevo concepto de inmersión. Haz que los mundos de juego cobren vida y empieza a crear nuevos y épicos recuerdos. Siente la respuesta táctil capaz de transmitir las acciones del juego con dos activadores que sustituyen a los motores de vibración tradicionales. Cuando lo tienes en las manos, estas vibraciones dinámicas son capaces de simular todo tipo de sensaciones, como los elementos del entorno o el retroceso de diferentes armas.\r\n</p>', 'Mando PS5'),
(17, 45.41, 'Mando DualShock 4 PlayStation 4', '<p>\r\nToma el control de una nueva generación de videojuegos con un mando inalámbrico DualShock 4 Black rediseñado que pone en tus manos la mayor precisión en tus juegos de PlayStation 4. Con un panel táctil nuevo que revela desde arriba la barra luminosa y un elegante acabado mate, es la forma más ergonómicas e intuitiva de jugar que haya habido nunca.\r\n</p>\r\n\r\n<p>\r\n<strong>DISEÑO ERGONÓMICO.</strong>\r\nUn diseño elegante y súper confortable unido a los botones y sticks analógicos altamente sensibles aportan una mayor precisión durante el juego.\r\n</p>\r\n\r\n<p>\r\n<strong>Botón SHARE.</strong>\r\nUtiliza el botón SHARE para compartir tus hazañas en las redes sociales. Sube tu partida en streaming a Twitch, YouTube o Dailymotion o edita las grabaciones y compártelas en Facebook y Twitter. Además, podrás invitar a tus amigos que se encuentren online para jugar a tus juegos contigo -incluso si no disponen del juego- con Share Play.\r\n</p>\r\n<p>\r\n<strong>TOUCH PAD.</strong>\r\nControla y dibuja mediante el touchpad de alta respuesta, ahora rediseñada para que puedas ver la barra de luz desde la parte superior mientras juegas.\r\n</p>\r\n<p>\r\n<strong>BARRA DE LUZ.</strong>\r\nLa barra de luz integrada puede emitir varios colores para personalizar tu experiencia y añadir una nueva dimensión a los juegos. Además, ayuda a la PlayStation Camera a trackear la posición del mando para mejorar la interacción virtual mientras utilizas PlayStation VR.\r\n\r\n<p>\r\n<strong>ALTAVOZ INTEGRADO Y CONECTOR DE AURICULARES ESTÉREO.</strong> Disfruta de los efectos extra de sonido -emitidos directamente desde el mando- y chatea con tus amigos online a través de auriculares con micrófono incorporado. Auriculares estéreo incluidos con la PS4.\r\n</p>\r\n<p>\r\n<strong>VIBRACIÓN.</strong>\r\nSiente las vibraciones emitidas por  el mando mediante unos motores de vibración más intuitivos y precisos.\r\n</p>\r\n<p>\r\n<strong>REMOTE PLAY.</strong>\r\nJuega a tus juegos de PS4 en streaming en Windows PC or Mac para poder seguir jugando si te encuentras lejos de tu televisor. El adaptador inalámbrico DualShock 4 USB mejora la experiencia Remote Play permitiéndote jugar de manera inalámbrica.\r\n</p>\r\n<p>\r\n<strong>CONTROL CUSTOMIZADO.</strong>\r\nConfigura tu mando DualShock 4 de la manera que quieras: elige el volumen de los altavoces, deshabilita la vibración, ajusta el brillo de la barra de luz para incrementar la vida útil de tu batería cuando ya no la necesites. Puedes elegir si compartir los datos vías Bluetooth o utilizando un cable USB para conectarlo a la PS4.\r\n</p>', 'Mando PS4'),
(18, 120.65, 'Mando Xbox Elite (Serie 1)', '<p>\r\nEl mando Xbox Elite se adapta al tamaño de tu mano y a tu estilo de juego con configuraciones que pueden mejorar la precisión, la velocidad y el alcance mediante gatillos de distintas formas y tamaños. Puedes intercambiar los joysticks de metal y crucetas para lograr un control y ergonomía personalizados. Incorpora cuatro ranuras para palancas intercambiables que puedes conectar o quitar sin ninguna herramienta. Si accionas el bloqueo de gatillos de alta sensibilidad, podrás disparar más rápido y ahorrar tu valioso tiempo en cada toque de gatillo. Todas las superficies y detalles están diseñados para satisfacer las demandas de los jugadores más competitivos: los anillos reforzados de bajo rozamiento alrededor de cada joystick minimizan el desgaste y aportan suavidad de movimiento. Por otro lado, los agarres de goma con relieve confieren al mando una apariencia sólida y proporcionan más estabilidad.\r\n</p>', 'Mando XBOX Elite 1'),
(19, 450.93, 'AMD Ryzen 9 5900X', '<p>\r\nEl procesador que ofrece la mejor experiencia de juego del mundo. 12 núcleos para potenciar la experiencia de juego, la transmisión en vivo y mucho más.\r\n</p>\r\n\r\n<p>\r\n<strong>\r\nTecnología AMD StoreMI:\r\n</strong>\r\nSoftware que combina la velocidad de SSD con la capacidad de disco duro en una sola unidad rápida y fácil de administrar, gratuita con la placa madre AMD Serie 400.\r\n</p>\r\n\r\n<p>\r\n<strong>Utilidad AMD Ryzen™ Master:</strong>\r\nLa utilidad de overclocking sencilla y a la vez potente para los procesadores AMD Ryzen™\r\n</p>\r\n\r\n<p>\r\n<strong>AMD Ryzen™ VR-Ready Premium:</strong>\r\nPara los usuarios que exigen una experiencia premium de realidad virtual, AMD ofrece procesadores especiales Ryzen™ VR-Ready Premium de alto rendimiento.\r\n</p>\r\n', 'AMD R9 5900X'),
(20, 123, 'XBOX ONE S', '123', '123'),
(31, 123, 'asd', 'ads', 'asd'),
(32, 1, '11', '11', '11');

-- --------------------------------------------------------

--
-- Table structure for table `Tiene`
--

CREATE TABLE `Tiene` (
  `ID_Comentario` int NOT NULL,
  `ID_Producto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Tiene`
--

INSERT INTO `Tiene` (`ID_Comentario`, `ID_Producto`) VALUES
(1, 1),
(2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comentario`
--
ALTER TABLE `Comentario`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Fabrica`
--
ALTER TABLE `Fabrica`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nombre` (`Nombre`);

--
-- Indexes for table `Fabricante`
--
ALTER TABLE `Fabricante`
  ADD PRIMARY KEY (`Nombre`),
  ADD KEY `Nombre` (`Nombre`);

--
-- Indexes for table `Imagenes`
--
ALTER TABLE `Imagenes`
  ADD PRIMARY KEY (`ID_Producto`,`Ruta Imagen`);

--
-- Indexes for table `Palabrota`
--
ALTER TABLE `Palabrota`
  ADD PRIMARY KEY (`palabra`);

--
-- Indexes for table `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Tiene`
--
ALTER TABLE `Tiene`
  ADD PRIMARY KEY (`ID_Comentario`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comentario`
--
ALTER TABLE `Comentario`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Productos`
--
ALTER TABLE `Productos`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Fabrica`
--
ALTER TABLE `Fabrica`
  ADD CONSTRAINT `Fabrica_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `Productos` (`ID`),
  ADD CONSTRAINT `Fabrica_ibfk_2` FOREIGN KEY (`Nombre`) REFERENCES `Fabricante` (`Nombre`);

--
-- Constraints for table `Imagenes`
--
ALTER TABLE `Imagenes`
  ADD CONSTRAINT `Imagenes_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `Productos` (`ID`);

--
-- Constraints for table `Tiene`
--
ALTER TABLE `Tiene`
  ADD CONSTRAINT `Tiene_ibfk_1` FOREIGN KEY (`ID_Comentario`) REFERENCES `Comentario` (`ID`),
  ADD CONSTRAINT `Tiene_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `Productos` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
