-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Apr 21, 2022 at 05:42 PM
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

CREATE USER 'usuario'@'%' IDENTIFIED BY 'usuario';
GRANT SELECT,INSERT ON docker.* TO 'usuario'@'%';

CREATE TABLE `Comentario` (
  `Nombre` varchar(200) NOT NULL,
  `ID` int NOT NULL,
  `Fecha` date NOT NULL,
  `Texto` varchar(1000) NOT NULL,
  `Correo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Comentario`
--

INSERT INTO `Comentario` (`Nombre`, `ID`, `Fecha`, `Texto`, `Correo`) VALUES
('Antonio Robles', 1, '2021-05-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam erat metus, pellentesque non libero ac, aliquam auctor odio. Pellentesque eu efficitur est. Donec facilisis tellus ac tellus fermentum, tempor tempor nulla posuere. Duis a arcu non orci suscipit eleifend. Maecenas malesuada sem et leo iaculis dapibus. Duis arcu erat, tempor vitae fermentum ac, convallis vel mauris. Sed lacinia quam nec rhoncus tempus.\r\n', 'example@fakemail.com'),
('Juan Hidalgo', 2, '2020-04-06', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam erat metus, pellentesque non libero ac, aliquam auctor odio. Pellentesque eu efficitur est. Donec facilisis tellus ac tellus fermentum, tempor tempor nulla posuere. Duis a arcu non orci suscipit eleifend. Maecenas malesuada sem et leo iaculis dapibus. Duis arcu erat, tempor vitae fermentum ac, convallis vel mauris. Sed lacinia quam nec rhoncus tempus.', 'ejemplo@fakemail2.com');

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
  `Nombre` varchar(300) NOT NULL,
  `Descripción` varchar(1500) NOT NULL,
  `Imagenes` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Titulo pagina` varchar(100) NOT NULL,
  `Comentarios` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Tabla` varchar(600) DEFAULT NULL,
  `Video` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Productos`
--

INSERT INTO `Productos` (`ID`, `Precio`, `Nombre`, `Descripción`, `Imagenes`, `Titulo pagina`, `Comentarios`, `Tabla`, `Video`) VALUES
(1, 2200, 'NVIDIA GeForce RTX 3090 Founders Edition', 'La GeForce RTX™ 3090 es una gran GPU endiablada (BFGPU) con rendimiento de la clase TITAN. Con tecnología de Ampere, la arquitectura RTX de la segunda generación de NVIDIA, duplica el trazado de rayos y el rendimiento de IA con núcleos con trazado de rayos (RT) y núcleos Tensor mejorados y nuevos multiprocesadores de streaming mejorados. Además, presenta unos asombrosos 24 GB de memoria G6X, todo para ofrecer la experiencia de gaming definitiva.\r\n\r\nLas unidades son muy limitadas debido a los problemas actuales del mundo, por lo que el precio ha subido mucho. Además sólo se puede comprar una por usuario y en caso de detectar cualquier uso de bots o scripts para automatizar la compra masiva se le baneará del sitio web.\r\n\r\nNota: Hay que tener en cuenta que es una tarjeta gráfica muy larga por lo que es necesario medir el interior de la caja disponible antes de proceder a comprarla (sólo es una recomendación).\r\n\r\nNota 2: Esta tarjeta es la versión LHR (Low Hash Rate) por lo que tiene bloqueada la mitad de la potencia para minar criptomonedas. Si la va a usar para minar, esta no es su tarjeta.', '3090.png\r\n3090_2.png\r\ncontroller.png\r\nNVME.png\r\nAMD_CPU.png\r\ncomment.png\r\nHDD.png', 'NVIDIA RTX 3090', 'Frontal\r\nVista generalmente apreciada\r\n*\r\n*\r\n*\r\n*\r\n*', 'Núcleos CUDA | 10496\r\nFrecuencia normal (GHz)|1.40\r\nFrecuencia acelerada (GHz)|1.70\r\nTipo de memoria|GDDR6X\r\nCantidad de memoria|24GB\r\nAncho de interfaz de memoria|384-bit\r\n', 'https://www.youtube.com/embed/BCcN8kCD90A'),
(2, 180, 'Mando Xbox Elite Series 2', 'El mando Xbox Elite Series 2 se adapta al tamaño de tu mano y a tu estilo de juego con configuraciones que pueden mejorar la precisión, la velocidad y el alcance mediante gatillos de distintas formas y tamaños. Puedes intercambiar los joysticks de metal y crucetas para lograr un control y ergonomía personalizados. Incorpora cuatro ranuras para palancas intercambiables que puedes conectar o quitar sin ninguna herramienta.\r\nDiseñado para satisfacer las necesidades de los jugadores competitivos de la actualidad, el nuevo Mando inalámbrico Xbox Elite Series 2 cuenta con más de 30 nuevas formas para jugar como un profesional.\r\nUtiliza opciones de configuración exclusivas, como la asignación de botones a comandos de voz como \"grabar eso\" o \"hacer una captura de pantalla\". Asigna un botón para que actúe como la tecla Mayús para habilitar entradas alternativas de cada uno de los otros botones.', 'controller.png\r\nprueba', 'Mando Elite 2', 'Vista frontal', 'A|1\r\nB|2\r\nC|3', NULL),
(3, 89.99, 'WD_Black PC SN750 NVMe', 'WD_BLACK™ SN750 NVMe™ SSD ofrece un rendimiento espectacular a los aficionados a los juegos y el hardware que estén pensando en montar o mejorar un ordenador. WD_BLACK™ SN750 NVMe™ SSD está disponible en capacidades de hasta 4 TB y compite con algunos de los mejores discos del mercado para ofrecer una ventaja a los jugadores.\r\n\r\nEl Rendimiento Es Importante: Tanto si quiere mejorar la velocidad general de su sistema como los tiempos de carga de juegos y niveles, elija la opción más rápida: el disco WD_BLACK™ reduce el tiempo de espera para que pueda volver a la acción y jugar con ventaja.\r\n\r\nEspacio Para Juegos: El núcleo del disco WD_BLACK™ es su revolucionaria tecnología NAND. Al ofrecer el doble de densidad de almacenamiento que la generación anterior, la tecnología NAND 3D permite superar las limitaciones de almacenamiento y mostrar la enorme innovación que esto representa. El resultado es una capacidad ampliada en un disco de una sola cara que ocupa aproximadamente lo mismo que un paquete de chicles y que aun así ofrece suficiente espacio para archivos grandes y videojuegos.', 'NVME.png', '', 'Frontal', 'Capacidad|250 GB\r\nConexión|PCIe\r\nConector|M.2\r\nDimensiones (largo, ancho y alto)|80mm x 24.2mm x 8.1mm\r\nRendimiento de lectura secuencial|3100MB/s\r\nRendimiento de escritura secuencial|1600MB/s', NULL),
(4, 500, 'PlayStation 5 Blu-Ray', 'La consola PS5 hace posibles otras formas de juego que jamás habías imaginado.\r\n\r\nExperimenta cargas rápidas gracias a una unidad de estado sólido (SSD) de alta velocidad, una inmersión más profunda con retroalimentación háptica, gatillos adaptables y audio 3D, además de una nueva generación de juegos de PlayStation.\r\n\r\nDescubre una experiencia de juego más intensa mediante tecnología háptica, gatillos adaptables y audio 3D y una inmersión que te dejará sin aliento.\r\n\r\nDéjate sorprender por unos gráficos adecuados y experimenta nuevas funciones de PS5.\r\n\r\nIncreíble velocidad\r\n\r\nLa potencia de las unidades de CPU, GPU y SSD personalizadas con sistema de E / S integrado ofrece un rendimiento nunca antes visto en una consola PlayStation.\r\n\r\nSSD de ultra alta velocidad\r\n\r\nOptimice sus sesiones de juego con tiempos de carga casi instantáneos para los juegos de PS5 instalados.\r\n\r\nSistema de E / S integrado\r\n\r\nLa integración de sistemas personalizados de la consola PS5 permite a los desarrolladores extraer datos del SSD tan rápidamente que pueden crear juegos de formas previamente impensables.', 'PS5.png', 'PS5', 'Consola y mando frontalmente hablando', NULL, NULL),
(5, 350, 'AMD Ryzen 7 5700G', 'Cuando cuentas con la arquitectura de procesadores más avanzada del mundo para jugadores y creadores de contenido, las posibilidades son infinitas. Ya sea que juegues los juegos más recientes, diseñes el próximo rascacielos o proceses datos, necesitas un procesador poderoso que pueda dar respuesta a todas estas demandas, y más. Sin lugar a dudas, los procesadores para computadoras de escritorio AMD Ryzen™ serie 5000 elevan el nivel de expectativa para jugadores y artistas por igual.', 'AMD_CPU.png', 'AMD Ryzen 7 5700G', NULL, NULL, NULL),
(6, 38.5, 'Western Digital Blue HDD 1TB 3.5\"\r\n', 'Fabricado según los más altos estándares de calidad y fiabilidad de WD, WD Blue ofrece prestaciones y capacidades de nivel básico ideales para sus necesidades de informática. WD Blue está diseñado por la marca en que confía con la calidad que esperaría de una solución de almacenamiento probada para su uso diario.\r\n\r\nUn clásico moderno. Los discos WD Blue están diseñados y fabricados con la probada tecnología de los premiados discos duros de WD para ordenadores de sobremesa y portátiles. WD Blue establece las bases para el almacenamiento diario al proporcionar un rendimiento mejorado en comparación con las anteriores generaciones y al mantener la calidad y fiabilidad de WD características de seis generaciones. La diferencia radica en que nuestros colores nunca desaparecen, generación tras generación.', 'HDD.png', 'Western Digital Blue HDD 1TB', 'Frontal del disco duro', NULL, NULL),
(7, 350, 'Nintendo Switch OLED Blanca', 'La consola Nintendo Switch (modelo OLED) incluye una pantalla OLED de 7 pulgadas con colores intensos y alto contraste. También cuenta con un soporte ancho ajustable para el modo sobremesa, una nueva base con puerto LAN por cable que permite jugar en línea con una conexión a internet más estable, 64 GB de memoria interna y altavoces integrados con audio optimizado para disfrutar de un sonido más nítido en los modos portátil y sobremesa. Además, Nintendo Switch (modelo OLED) permite jugar en el televisor y compartir los mandos Joy-Con extraíbles para divertirse como nunca en partidas multijugador.', 'nintendo_swich_oled_white_1.png', 'Nintendo Switch OLED', 'Caja de la consola', NULL, NULL),
(8, 500, 'Xbox Series X', 'Presentamos Xbox Series X, la Xbox más rápida y potente de la historia. Juega a miles de títulos de cuatro generaciones de consolas: todos los juegos tienen el mejor aspecto y se juegan mejor en Xbox Series X. En el corazón de Series X se incluye Xbox Velocity Architecture, que combina un disco SSD personalizado con software integrado para ofrecer un juego agilizado más rápido y tiempos de descarga significativamente reducidos. Muévete sin problemas entre varios juegos en un instante con Reanudado rápido. Explora nuevos mundos detallados y disfruta de la acción como nunca antes con los incomparables 12 teraflops de potencia de procesamiento de gráficos en bruto. Disfruta de juegos 4K a hasta 120 fotogramas por segundo, sonido espacial 3D avanzado y mucho más. Comienza con una biblioteca instantánea de más de 100 juegos de alta calidad, incluidos títulos totalmente nuevos de Xbox Game Studios, como Halo Infinite, el día de su lanzamiento, con Xbox Game Pass Ultimate (la suscripción se vende por separado).*', 'Series_X.png', 'XBOX Series X', 'Consola con mando', NULL, NULL),
(9, 669.9, 'Intel Core i9-12900K', 'Procesador de escritorio desbloqueado Intel® Core ™ i9-12900K de 12.ª generación. Con tecnología Intel® Turbo Boost Max 3.0 y compatibilidad con PCIe Gen 5.0 y 4.0, compatibilidad con DDR5 y DDR4, los procesadores de escritorio Intel® Core ™ desbloqueados de 12.a generación están optimizados para jugadores entusiastas y creadores serios y ayudan a ofrecer overclocking de alto rendimiento para un impulso adicional. Solución térmica NO incluida en la caja. Compatible con placas base basadas en chipset de la serie 600. 125W.', 'intel_cpu.png', 'Intel Core i9-12900K', 'Caja del procesador.', NULL, NULL);

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
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Constraints for table `Tiene`
--
ALTER TABLE `Tiene`
  ADD CONSTRAINT `Tiene_ibfk_1` FOREIGN KEY (`ID_Comentario`) REFERENCES `Comentario` (`ID`),
  ADD CONSTRAINT `Tiene_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `Productos` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
