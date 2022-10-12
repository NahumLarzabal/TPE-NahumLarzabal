-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2022 a las 22:43:28
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, ' Novela'),
(2, 'Terror'),
(3, 'Ciencia Ficcion'),
(5, 'Policia'),
(6, 'Suspenso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `nombre_libro` varchar(100) NOT NULL,
  `descripcion` varchar(5000) NOT NULL,
  `precio` double DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `autor`, `nombre_libro`, `descripcion`, `precio`, `id_categoria`, `imagen`) VALUES
(1, 'C.S. Lewis1', 'Las crónicas de Narnia: el príncipe Caspian', 'Las Crónicas de Narnia: El príncipe Caspian (título original en inglés: The Chronicles of Narnia: Prince Caspian) es una película de acción y fantasía dirigida por Andrew Adamson y basada en la novela homónima de C. S. Lewis. Producida por Walden Media y distribuida por Walt Disney Pictures, se estrenó el 16 de mayo de 2008 en Estados Unidos. Es la segunda entrega de la saga Las Crónicas de Narnia.  ', 3500, 3, 'img/portadas/63239350b9de7.jpg'),
(4, 'José Mauro de Vasconcelo', 'Mi planta de naranja lima', '          Mi planta de naranja lima (en portugués O Meu Pé de Laranja Lima) es una novela de José Mauro de Vasconcelos, una de las más leídas de la nueva literatura brasileña. El autor continúa la historia en Vamos a calentar el sol. Está narrada en primera persona y posee un altísimo nivel autobiográfico.\r\nEncabezó la lista de superventas en 1968, año de su primera edición. Posteriormente, la novela fue traducida a 32 idiomas y publicada en 19 países. Ha sido adoptado como texto lectura a nivel de enseñanza primaria.1​\r\nTres telenovelas se han realizado sobre la base de esta obra: en 1970 para la Rede Tupi, y en 1980 y 1998 para la Rede Bandeirantes. También se han realizado varias adaptaciones al cine, televisión y teatro, siendo dirigida por Aurelio Teixeira la primera para el cine en 1970.2​ En el 2011 se ha presentado su segunda versión cinematográfica.3​   \r\n        ', 11781, 5, NULL),
(31, 'garcia', 'asdasd11', '363edfgdfg', 222, 6, ''),
(32, 'garcia', 'sadda', '1', 2, 3, ''),
(33, 'C.S. Lewis', 'Narnia - El león, la bruja y el armario', ' The Lion, the Witch and the Wardrobe (titulada El león, la bruja y el ropero en la versión de la Editorial Andrés Bello y El león, la bruja y el armario en Ediciones Destino) es una novela fantástica infantil publicada por C. S. Lewis en 1950. Es el libro más conocido de la serie de siete libros llamada Las Crónicas de Narnia. Aunque en orden de publicación fue el primer libro de la serie escrito por el autor, es en realidad el segundo según la cronología interna, tras El sobrino del mago.\r\n        ', 2530, 3, 'img/portadas/632392ea92394.jpg'),
(39, '123d1231', 'asdas213sa', 'lal3llala', 34567, 5, ''),
(40, 'asdas', 'asd', '          asdasd', 34, 5, ''),
(41, 'autor', 'asdasd22211', '                              descrrp\r\n        \r\n        \r\n        ', 123456, 2, 'img/portadas/633f438cc0667.jpg'),
(44, 'Peron', 'PEron', '                    Peron            \r\n        \r\n        ', 100, 2, NULL),
(52, 'a', 'a', '            aaa', 2, 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nombre_apellido` varchar(255) NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `tipoUser` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `nombre_apellido`, `password`, `tipoUser`) VALUES
(1, 'admin@gmail.com', 'Admin', '$2y$10$ATqPXdv4tFHONS3xg9hQbOSWjExfYE2Q6VDQDUR3x93m7zwqO/DGa', 1),
(5, 'invitado@gmail.com', 'INVITADO', '$2y$10$6ci8LBfOoojsdKCu/Vz3beUqG./iyYwruf271sdafUa8binOTlD/S', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_categoria` (`id_categoria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
