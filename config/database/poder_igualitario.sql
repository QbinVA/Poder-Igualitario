-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-05-2025 a las 15:22:53
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poder_igualitario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `nombre`, `correo`, `contrasena`) VALUES
(1, 'kevin123', 'kvaldovinos2@ucol.mx', 'JuanoManzano'),
(2, 'tester1', 'testeando@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(2, 'Economía'),
(3, 'Educación'),
(6, 'Líderes'),
(1, 'Política'),
(4, 'Salud y Bienestar'),
(5, 'Tecnología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_comentario` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_noticia`, `id_usuario`, `comentario`, `fecha_comentario`) VALUES
(1, 15, 3, 'me gusta esa cancion tambien esta bacana', '2025-05-17 15:06:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id_noticia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `titular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion_corta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagen_principal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `referencia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `archivada` tinyint(1) DEFAULT '0',
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id_noticia`, `fecha`, `titular`, `descripcion_corta`, `imagen_principal`, `contenido`, `referencia`, `archivada`, `id_categoria`) VALUES
(10, '2025-05-05', 'Pedro Dominguez', 'Publicacion de prueba para verificar el funcionamiento de las imagenes.', '../uploads/img_682741587f392.jpg', 'vowhbvibvuiopwvbwdivhpuogherivhbqergeiwrheru90gfqwkfq9fiqewfpiuqfh9rgefghqfhqer9fqoupfhqrf9orufywrchfnwe\'vfbywqhfovwqerh9fwr vnhwrf9wrhwerbwviwrherbcrkhbwer98gcerigb howreognvwrhfvwphg39broghwrepggebrg9pero8yghogvb8g0bov3hghbreerikgher98 435ughverg', 'https://youtu.be/cedT4OQnTOo?si=k4AnrYZyI3nTwX7G', 0, 4),
(11, '2025-05-04', 'Comunidad de Tecoman', 'Publicacion dedicada a Tecoman y lo poco que hay en ese pinche rancho culero de muerda', '../uploads/img_6818f1f451ed14.42530819.jpg', 'El corrido de Tecomán es una canción que narra la historia de Marcelino Verduzco, quien intentó ser contrabandista pero fue sorprendido. La letra describe cómo Marcelino y sus compañeros dejaron Tecomán en pleno día y se dirigieron a Parotal para recoger mercancía, pasando por Santa María. Luego, Luisillo fue encargado de entregar los costales escondidos, mientras Marcelino ya había cargado las otras 30 cajas en una camioneta. Planeaban pasar por San Vicente para evitar sospechas y reunirse en Tecomán para beber cerveza, pero al llegar al pavimento fueron interceptados por soldados. Marcelino y el conductor de la camioneta fueron asesinados, mientras que el resto logró escapar. El que fue capturado vivo acabó confesando todo, dejando a Marcelino esperando en Tecomán.', 'https://es.wikipedia.org/wiki/Tecom%C3%A1n', 0, 0),
(14, '2025-05-14', 'eladio camion', 'cantante bacano', '../uploads/img_6824bb772d3459.35485261.jpg', 'está bacano', 'https://youtu.be/VK_VnwC40WU?si=YpO04wcPQ3syoBc8', 0, 6),
(15, '2025-05-16', 'Fantasma', 'Canción de Gustavo Cerati', '../uploads/img_68275bf56f3157.23036471.jpeg', 'cancion bacana', 'https://youtu.be/cedT4OQnTOo?si=k4AnrYZyI3nTwX7G', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contrasena`, `fecha_registro`) VALUES
(1, 'qbin', 'valdokevin02@gmail.com', '$2y$10$g7NkSuEBnvXZrV1ZqLAkreb7D4O9K31qNFc4.KtvF9ffAubjE3okC', '2025-05-13 14:19:01'),
(2, 'usuario2', 'usuario2@gmail.com', '$2y$10$BibM4fWZy/H7yx1XZex6D.j1C8BYfSNuUWrQYLwOloIiPWrIIfOom', '2025-05-17 13:34:59'),
(3, 'kevarias', 'infokevarias@gmail.com', '$2y$10$JEZQZaL9xNHsRL8hbaqusOxN7wYlJHevrhLDEOGKGMwj8Bst5KGMW', '2025-05-17 13:36:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_noticia` (`id_noticia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_noticia`) REFERENCES `publicaciones` (`id_noticia`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
