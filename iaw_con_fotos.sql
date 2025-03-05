-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-02-2025 a las 13:23:03
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iaw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artigo`
--

DROP TABLE IF EXISTS `artigo`;
CREATE TABLE IF NOT EXISTS `artigo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `contido` longtext NOT NULL,
  `data` date NOT NULL,
  `subcategoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategoria` (`subcategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `artigo`
--

INSERT INTO `artigo` (`id`, `titulo`, `autor`, `contido`, `data`, `subcategoria`) VALUES
(1, 'Criticas y polemicas con Windows', 'usr01', 'HE VUELTO A EDITAR ESTO', '0000-00-00', 'Windows'),
(17, 'Mi primer artículo de Python', 'borja', 'Este es mi primer post relacionado con python...\r\nEspero que os guste ;D !', '2025-02-28', 'Python'),
(18, 'Segundo post de Python', 'borja', 'Este es mi segundo post de python para revisar si\r\nestá funcionando como yo quiero la redirección al crear un post...\r\n', '2025-02-28', 'Python'),
(3, 'Distribución', 'usr01', 'Una distribución Linux (GNU/Linux) (coloquial y abreviadamente llamada distro) es una\r\ndistribución de software basada en el núcleo Linux, y a menudo, un Sistema de gestión de paquetes que incluye\r\ndeterminados paquetes de software, para satisfacer las necesidades de un grupo específico de usuarios, dando así\r\norigen a ediciones domésticas, empresariales y para servidores. Por lo general están compuestas, total o\r\nmayoritariamente, de software libre, aunque a menudo incorporan aplicaciones o controladores propietarios', '0000-00-00', 'Linux'),
(4, 'Portabilidad', 'admin', 'La Portabilidad del núcleo Linux y arquitecturas soportadas, se refiere a que\r\noriginalmente escrito para procesadores Intel i386, el núcleo Linux fue recodificado para facilitar la\r\nportabilidad de éste.', '2024-08-12', 'Linux'),
(5, 'El bytecode', 'usr01', 'El bytecode Java es el tipo de instrucciones que la máquina virtual Java espera recibir,\r\npara posteriormente ser compiladas a lenguaje de maquina, mediante un compilador JIT a la hora de su ejecución.\r\nUsualmente es el resultado de utilizar un compilador del lenguaje de programación Java (como javac), pero puede\r\nser generado desde otros compiladores.', '2024-11-22', 'Java'),
(7, 'Origen de PHP', 'admin', 'Creado en 1994 por Rasmus Lerdorf, la primera encarnación de PHP era un conjunto\r\nsimple de ficheros binarios Common Gateway Interface (CGI) escritos en el lenguaje de programación C.\r\nOriginalmente utilizado para rastrear visitas de su currículum online, llamó al conjunto de scripts \"Personal Home\r\nPage Tools\", más frecuentemente referenciado como \"PHP Tools\". Con el paso del tiempo se quiso más funcionalidad,\r\ny Rasmus reescribió PHP Tools, produciendo una implementación más grande y rica. Este nuevo modelo fue capaz de\r\ninteraccionar con bases de datos, y mucho más, proporcionando un entorno de trabajo sobre cuyos usuarios podían\r\ndesarrollar aplicaciones web dinámicas sencillas tales como libros de visitas.', '2024-05-30', 'PHP'),
(8, 'Versiones importantes de PHP', 'usr01', 'PHP 3: En 1998, PHP 3 fue lanzado con el apoyo de Andi Gutmans y Zeev\r\nSuraski. Esta versión incluyó mejoras en el rendimiento y la modularidad del lenguaje.\r\nPHP 4: En 2000, se lanzó PHP 4 con mejoras en el rendimiento y la introducción del motor de scripting Zend,\r\ndesarrollado por Gutmans y Suraski.\r\nPHP 5: Lanzado en 2004, PHP 5 introdujo características de programación orientada a objetos, mejoras en el\r\nrendimiento y soporte para funciones avanzadas de XML.\r\nPHP 7: En 2015, se lanzó PHP 7, que mejoró significativamente el rendimiento y la eficiencia del lenguaje. También\r\nse introdujeron características como la declaración de tipos escalares y el operador de fusión de null.', '0000-00-00', 'PHP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_subcat`
--

DROP TABLE IF EXISTS `cat_subcat`;
CREATE TABLE IF NOT EXISTS `cat_subcat` (
  `categoria` varchar(30) NOT NULL,
  `subcategoria` varchar(30) NOT NULL,
  PRIMARY KEY (`subcategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cat_subcat`
--

INSERT INTO `cat_subcat` (`categoria`, `subcategoria`) VALUES
('Sistemas operativos', 'Windows'),
('Sistemas operativos', 'Linux'),
('Lenguajes de programacion', 'Java'),
('Lenguajes de programacion', 'PHP'),
('NuevaCategoria', 'NuevaSubcategoria'),
('Lenguajes de programacion', 'Python');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descripcion` longtext NOT NULL,
  `imagen` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `titulo`, `descripcion`, `imagen`) VALUES
(4, 'Catarata', 'Se llama cascada, caída, catarata, salto de agua o caída de agua\r\ngigante al tramo de un curso fluvial donde, por causa de un fuerte desnivel del lecho\r\no cauce, el agua cae verticalmente por efecto de la gravedad', './imaxes/catarata'),
(2, 'Rio', 'Un río es una corriente de agua que fluye con continuidad por un cauce en la superficie terrestre o bien puede ser subterráneo. Pueden ser tanto naturales como artificiales. Posee un caudal determinado, rara vez es constante a lo largo del año, y desemboca en el mar, en un lago o en otro río, en cuyo caso se denomina afluente.', './imaxes/rio.jpg'),
(3, 'Montaña', 'Una montaña es una figura topográfica del relieve terrestre positiva, una eminencia natural que se caracteriza por su altitud y, más generalmente, por su altura relativa, o incluso por su volumen, pendiente, espaciado o continuidad. Aparecen como parte de un conjunto —una cadena montañosa, es decir cordillera, macizo, sierra...— o formando un relieve aislado', './imaxes/montana.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

DROP TABLE IF EXISTS `unidades`;
CREATE TABLE IF NOT EXISTS `unidades` (
  `numero` int UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `password` varchar(35) NOT NULL,
  `rol` varchar(15) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `edad` int DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `password`, `rol`, `nombre`, `apellidos`, `edad`, `localidad`, `online`) VALUES
(1, 'borja', 'abc123.', 'admin', 'Borja', 'Fernandez Veloso', 25, 'Ourense', 1),
(2, 'chema', 'chema', 'invitado', 'chemaTest', 'ChemaTestquenovoyborrar', 29, 'Ourense', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
