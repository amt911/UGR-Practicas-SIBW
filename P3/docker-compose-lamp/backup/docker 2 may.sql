-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: May 02, 2022 at 09:31 PM
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
-- Database: `docker`
--

-- --------------------------------------------------------

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
('Intel', 9),
('Nintendo', 7),
('NVIDIA', 1),
('Sony Computer Entertainment', 4),
('Western Digital', 3),
('Western Digital', 6),
('XBOX', 2),
('XBOX', 8);

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
(1, 'comment.png', ''),
(1, 'controller.png', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(1, 'intel_cpu.png', ''),
(1, 'NVME.png', ''),
(1, 'placeholder.png', ''),
(1, 'PS5.png', 'Consola con el mando en posición frontal'),
(1, 'Series_X.png', ''),
(2, 'controller.png', 'Vista frontal'),
(3, 'NVME.png', 'El propio disco duro SSD'),
(4, 'PS5.png', 'Consola y mando'),
(5, 'AMD_CPU.png', 'Caja del procesados AMD'),
(6, 'HDD.png', ''),
(7, 'nintendo_switch_oled_white_1.png', 'Caja de la consola'),
(8, 'Series_X.png', 'Consola y mando en vista isométrica'),
(9, 'intel_cpu.png', 'Caja del procesador Intel');

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
(1, 2200, 'NVIDIA GeForce RTX 3090 Founders Edition', '<p class=\"justificado\"> <!--Contiene una breve descripcion del articulo, ademas de estar justificado el texto-->\n    La GeForce RTX™ 3090 es una gran GPU endiablada (BFGPU) con rendimiento de la clase TITAN. Con\n    tecnología de Ampere, la arquitectura RTX de la segunda generación de NVIDIA, duplica el trazado de\n    rayos y el rendimiento de IA con núcleos con trazado de rayos (RT) y núcleos Tensor mejorados y nuevos\n    multiprocesadores de streaming mejorados. Además, presenta unos asombrosos 24 GB de memoria G6X, todo para ofrecer la experiencia de gaming\n    definitiva.\n</p>\n\n<p class=\"justificado\">\n    Las unidades son muy limitadas debido a los problemas actuales del mundo, por lo que el precio ha subido\n    mucho. Además sólo se puede comprar una por usuario y en caso de detectar cualquier uso de bots o scripts para automatizar la compra masiva se le baneará del sitio web.\n</p>\n\n<p class=\"justificado\">\n    Nota: Hay que tener en cuenta que es una tarjeta gráfica muy larga por lo que es necesario medir el\n    interior de la caja disponible antes de proceder a comprarla (sólo es una recomendación).\n</p>\n\n<p class=\"justificado\">\n    Nota 2: Esta tarjeta es la versión LHR (Low Hash Rate) por lo que tiene bloqueada la mitad de la potencia para minar criptomonedas. Si la va a usar para minar, esta no es su tarjeta.\n</p>\n\n\n<table> <!--Tabla con las especificaciones del producto-->\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\n        <td>\n            Núcleos CUDA\n        </td>\n\n        <td>\n            10496\n        </td>\n    </tr>\n\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\n        <td>\n            Frecuencia normal(GHz)\n        </td>\n        <td>\n            1.40\n        </td>\n    </tr>\n\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\n        <td>\n            Frecuencia acelerada (GHz)\n        </td>\n        <td>\n            1.70\n        </td>\n    </tr>\n\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\n        <td>\n            Tipo de memoria\n        </td>\n        <td>\n            GDDR6X\n        </td>\n    </tr>\n\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\n        <td>\n            Cantidad de memoria\n        </td>\n        <td>\n            24GB\n        </td>\n    </tr>\n\n    <tr> <!--Fila de la tabla y dentro contiene dos columnas-->\n        <td>\n            Ancho de interfaz de memoria\n        </td>\n        <td>\n            384-bit\n        </td>\n    </tr>\n</table>\n<p class=\"negrita\">Vídeo relacionado:</p>\n<div id=\"video-container\"> <!--Container donde se inserta un video (lo hago asi por temas de escalado)-->\n    <div>\n        <iframe id=\"video\" src=\"https://www.youtube.com/embed/BCcN8kCD90A\" title=\"YouTube video player\"\n            allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\"\n            allowfullscreen></iframe>\n    </div>\n</div>', 'NVIDIA RTX 3090'),
(2, 180, 'Mando Xbox Elite Series 2', '<p class=\"justificado\">El mando Xbox Elite Series 2 se adapta al tamaño de tu mano y a tu estilo de juego con configuraciones que pueden mejorar la precisión, la velocidad y el alcance mediante gatillos de distintas formas y tamaños. Puedes intercambiar los joysticks de metal y crucetas para lograr un control y ergonomía personalizados. Incorpora cuatro ranuras para palancas intercambiables que puedes conectar o quitar sin ninguna herramienta.</p>\r\n\r\n<p class=\"justificado\">\r\nDiseñado para satisfacer las necesidades de los jugadores competitivos de la actualidad, el nuevo Mando inalámbrico Xbox Elite Series 2 cuenta con más de 30 nuevas formas para jugar como un profesional.\r\n</p>\r\n\r\n<p class=\"justificado\">\r\nUtiliza opciones de configuración exclusivas, como la asignación de botones a comandos de voz como \"grabar eso\" o \"hacer una captura de pantalla\". Asigna un botón para que actúe como la tecla Mayús para habilitar entradas alternativas de cada uno de los otros botones.\r\n</p>', 'Mando Elite 2'),
(3, 89.99, 'WD_Black PC SN750 NVMe', '<p class=\"justificado\">\r\nWD_BLACK™ SN750 NVMe™ SSD ofrece un rendimiento espectacular a los aficionados a los juegos y el hardware que estén pensando en montar o mejorar un ordenador. WD_BLACK™ SN750 NVMe™ SSD está disponible en capacidades de hasta 4 TB y compite con algunos de los mejores discos del mercado para ofrecer una ventaja a los jugadores.\r\n</p>\r\n\r\n<p class=\"justificado\">\r\n<strong>El Rendimiento Es Importante:</strong> Tanto si quiere mejorar la velocidad general de su sistema como los tiempos de carga de juegos y niveles, elija la opción más rápida: el disco WD_BLACK™ reduce el tiempo de espera para que pueda volver a la acción y jugar con ventaja.\r\n</p>\r\n\r\n<p class=\"justificado\">\r\n<strong>Espacio Para Juegos:</strong> El núcleo del disco WD_BLACK™ es su revolucionaria tecnología NAND. Al ofrecer el doble de densidad de almacenamiento que la generación anterior, la tecnología NAND 3D permite superar las limitaciones de almacenamiento y mostrar la enorme innovación que esto representa. El resultado es una capacidad ampliada en un disco de una sola cara que ocupa aproximadamente lo mismo que un paquete de chicles y que aun así ofrece suficiente espacio para archivos grandes y videojuegos.\r\n</p>\r\n\r\n<table>\r\n<tr>\r\n<td>\r\nCapacidad\r\n</td>\r\n<td>\r\n250 GB\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nConexión\r\n</td>\r\n<td>\r\nPCIe\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nConector\r\n</td>\r\n<td>\r\nM.2\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nDimensiones (largo, ancho y alto)\r\n</td>\r\n<td>\r\n80mm x 24.2mm x 8.1mm\r\n</td>\r\n</tr>\r\n\r\n<tr>\r\n<td>\r\nRendimiento de lectura secuencial\r\n</td>\r\n<td>\r\n3100MB/s\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nRendimiento de escritura secuencial\r\n</td>\r\n<td>\r\n1600MB/s\r\n</td>\r\n</tr>\r\n</table>', 'WD Black NVME'),
(4, 500, 'PlayStation 5 Blu-Ray', '<p class=\"justificado\">\r\nLa consola PS5 hace posibles otras formas de juego que jamás habías imaginado.\r\n</p>\r\n\r\n<p class=\"justificado\">\r\nExperimenta cargas rápidas gracias a una unidad de estado sólido (SSD) de alta velocidad, una inmersión más profunda con retroalimentación háptica, gatillos adaptables y audio 3D, además de una nueva generación de juegos de PlayStation.\r\n</p>\r\n\r\n<p class=\"justificado\">\r\nDescubre una experiencia de juego más intensa mediante tecnología háptica, gatillos adaptables y audio 3D y una inmersión que te dejará sin aliento.\r\n</p>\r\n<p class=\"justificado\">\r\nDéjate sorprender por unos gráficos adecuados y experimenta nuevas funciones de PS5.\r\n</p>\r\n<p class=\"justificado\">\r\n<strong>Increíble velocidad: </strong>La potencia de las unidades de CPU, GPU y SSD personalizadas con sistema de E / S integrado ofrece un rendimiento nunca antes visto en una consola PlayStation.\r\n</p>\r\n<p class=\"justificado\">\r\n<strong>SSD de ultra alta velocidad: </strong>Optimice sus sesiones de juego con tiempos de carga casi instantáneos para los juegos de PS5 instalados.\r\n</p>\r\n<p class=\"justificado\">\r\n<strong>Sistema de E / S integrado: </strong>La integración de sistemas personalizados de la consola PS5 permite a los desarrolladores extraer datos del SSD tan rápidamente que pueden crear juegos de formas previamente impensables.\r\n</p>', 'PS5'),
(5, 350, 'AMD Ryzen 7 5700G', '<p class=\"justificado\">\r\nCuando cuentas con la arquitectura de procesadores más avanzada del mundo para jugadores y creadores de contenido, las posibilidades son infinitas. Ya sea que juegues los juegos más recientes, diseñes el próximo rascacielos o proceses datos, necesitas un procesador poderoso que pueda dar respuesta a todas estas demandas, y más. Sin lugar a dudas, los procesadores para computadoras de escritorio AMD Ryzen™ serie 5000 elevan el nivel de expectativa para jugadores y artistas por igual.\r\n</p>', 'AMD Ryzen 7 5700G'),
(6, 38.5, 'Western Digital Blue HDD 1TB 3.5\"\r\n', '<p class=\"justificado\">\r\nFabricado según los más altos estándares de calidad y fiabilidad de WD, WD Blue ofrece prestaciones y capacidades de nivel básico ideales para sus necesidades de informática. WD Blue está diseñado por la marca en que confía con la calidad que esperaría de una solución de almacenamiento probada para su uso diario.\r\n</p>\r\n<p class=\"justificado\">\r\nUn clásico moderno. Los discos WD Blue están diseñados y fabricados con la probada tecnología de los premiados discos duros de WD para ordenadores de sobremesa y portátiles. WD Blue establece las bases para el almacenamiento diario al proporcionar un rendimiento mejorado en comparación con las anteriores generaciones y al mantener la calidad y fiabilidad de WD características de seis generaciones. La diferencia radica en que nuestros colores nunca desaparecen, generación tras generación.\r\n</p>', 'Western Digital Blue HDD 1TB'),
(7, 350, 'Nintendo Switch OLED Blanca', '<p class=\"justificado\">\r\nLa consola Nintendo Switch (modelo OLED) incluye una pantalla OLED de 7 pulgadas con colores intensos y alto contraste. También cuenta con un soporte ancho ajustable para el modo sobremesa, una nueva base con puerto LAN por cable que permite jugar en línea con una conexión a internet más estable, 64 GB de memoria interna y altavoces integrados con audio optimizado para disfrutar de un sonido más nítido en los modos portátil y sobremesa. Además, Nintendo Switch (modelo OLED) permite jugar en el televisor y compartir los mandos Joy-Con extraíbles para divertirse como nunca en partidas multijugador.\r\n</p>', 'Nintendo Switch OLED'),
(8, 500, 'Xbox Series X', '<p class=\"justificado\">\r\nPresentamos Xbox Series X, la Xbox más rápida y potente de la historia. Juega a miles de títulos de cuatro generaciones de consolas: todos los juegos tienen el mejor aspecto y se juegan mejor en Xbox Series X. En el corazón de Series X se incluye Xbox Velocity Architecture, que combina un disco SSD personalizado con software integrado para ofrecer un juego agilizado más rápido y tiempos de descarga significativamente reducidos. Muévete sin problemas entre varios juegos en un instante con Reanudado rápido. Explora nuevos mundos detallados y disfruta de la acción como nunca antes con los incomparables 12 teraflops de potencia de procesamiento de gráficos en bruto. Disfruta de juegos 4K a hasta 120 fotogramas por segundo, sonido espacial 3D avanzado y mucho más. Comienza con una biblioteca instantánea de más de 100 juegos de alta calidad, incluidos títulos totalmente nuevos de Xbox Game Studios, como Halo Infinite, el día de su lanzamiento, con Xbox Game Pass Ultimate (la suscripción se vende por separado).*\r\n</p>', 'XBOX Series X'),
(9, 669.9, 'Intel Core i9-12900K', '<p class=\"justificado\">\r\nProcesador de escritorio desbloqueado Intel® Core ™ i9-12900K de 12.ª generación. Con tecnología Intel® Turbo Boost Max 3.0 y compatibilidad con PCIe Gen 5.0 y 4.0, compatibilidad con DDR5 y DDR4, los procesadores de escritorio Intel® Core ™ desbloqueados de 12.a generación están optimizados para jugadores entusiastas y creadores serios y ayudan a ofrecer overclocking de alto rendimiento para un impulso adicional. Solución térmica NO incluida en la caja. Compatible con placas base basadas en chipset de la serie 600. 125W.\r\n</p>', 'Intel Core i9-12900K'),
(10, 12, 'placeholder 1', 'asdasdasd', 'asdasdasd'),
(11, 12, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '123', '123'),
(12, 123, '123', '123', '123'),
(13, 123, '123', '123', '123'),
(14, 123, '123', '123', '123'),
(15, 123, '123', '123', '123'),
(16, 123, '123', '123', '123'),
(17, 123, '123', '123', '123'),
(18, 123, '123', '123', '123'),
(19, 123, '123', '123', '123'),
(20, 123, '123', '123', '123'),
(21, 123, '123', '123', '123');

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
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
