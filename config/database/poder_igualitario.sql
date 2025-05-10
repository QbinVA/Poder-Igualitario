-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-05-2025 a las 21:12:59
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
(1, 'Kevin Valdovinos', 'kvaldovinos2@ucol.mx', 'JuanoManzano');

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
  `categoria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `archivada` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id_noticia`, `fecha`, `titular`, `descripcion_corta`, `imagen_principal`, `contenido`, `referencia`, `categoria`, `archivada`) VALUES
(5, '2025-02-17', '38 instituciones se manifiestan para exigir paridad con miras a las elecciones 2024', 'Colectivos de defensa de los derechos de las mujeres se manifestaron en inmediaciones del Tribunal Supremo Electoral para recordar a los políticos y candidatos que hay normas que velan por la presencia de las mujeres en los cargos.', 'uploads/img_67d2e914f05297.98232069.png', 'Organizaciones de jóvenes, de mujeres y otras relacionadas con los derechos de la mujer realizaron esta mañana una vigilia a metros de las instalaciones del Tribunal Supremo Electoral, para recordar a los postulantes a la silla presidencial, las normas que avalan la paridad de género y la presencia de la mujer en la política nacional.\r\nEl grupo de personas llegó hasta la plaza Abaroa donde esta mañana se dio inicio al Encuentro Multipartidario, con la presencia de representantes de los diferentes partidos políticos del país.\r\n“Queremos hacerles recuerdo y a exigirle al órgano electoral, que haga cumplir el principio de paridad y alternancia política. Hemos entregado una carta a cada uno de los representantes de los partidos políticos y a quienes están postulando en la próxima elección, para que se respete la democracia”, explicó Tania Sánchez, directora de la Coordinadora de la Mujer.\r\nCon carteles y pancartas sobre el tema, los manifestantes se apostaron sobre la calle Sánchez Lima esquina Rosendo Gutiérrez, desde donde hubo un prolongado corte de circulación vehicular, hasta este mediodía, por la presencia de los simpatizantes de los diferentes partidos políticos.\r\n', 'https://www.vision360.bo/noticias/2025/02/17/20265-38-instituciones-se-manifiestan-para-exigir-paridad-con-miras-a-las-elecciones-2024', '', 0),
(6, '2025-02-14', 'La brecha salarial entre mujeres y hombres en el fútbol es de un 744%', 'El Instituto de las Mujeres organizó, ayer jueves, una mesa redonda para abordar la brecha salarial entre mujeres y hombres en el deporte junto a expertas en la materia', 'uploads/img_67d2e9bd6a52e8.75835166.jpg', 'En el marco del 22 de febrero, Día de la Igualdad Salarial, el Instituto de las Mujeres organizó, ayer jueves, un encuentro para abordar la brecha salarial entre mujeres y hombres en el deporte.\r\nDurante la jornada, inaugurada por la directora del Instituto de las Mujeres, Cristina Hernández, se visibilizaron las brechas existentes en diferentes disciplinas deportivas en España a través de las experiencias profesionales de distintas expertas en la materia. Moderado por la redactora jefa de deportes de El País, Nadia Tronchoni; participaron en el conversatorio Amanda Gutiérrez, presidenta de FUTPO; Lucila Pascua, presidenta de la Asociación de Jugadoras de Baloncesto (AJUB); Laura Torvisco Pérez, entrenadora de primera división y directora deportiva; Marta Francés Gómez, triatleta y medallista olímpica en los Juegos Paralímpicos de Paris 2024 y Patricia Campos Doménech, expiloto y entrenadora de fútbol.\r\n', 'https://www.inmujeres.gob.es/actualidad/noticias/2025/BrechaSalarialDeporte.htm', '', 0),
(10, '2025-05-05', 'Pedro Dominguez', 'Publicacion de prueba para verificar el funcionamiento de las imagenes.', '../uploads/img_6818efc8dd17b6.21645956.jpeg', 'vowhbvibvuiopwvbwdivhpuogherivhbqergeiwrheru90gfqwkfq9fiqewfpiuqfh9rgefghqfhqer9fqoupfhqrf9orufywrchfnwe\'vfbywqhfovwqerh9fwr vnhwrf9wrhwerbwviwrherbcrkhbwer98gcerigb howreognvwrhfvwphg39broghwrepggebrg9pero8yghogvb8g0bov3hghbreerikgher98 435ughverg', 'https://youtu.be/cedT4OQnTOo?si=k4AnrYZyI3nTwX7G', 'Tecnología', 0),
(11, '2025-05-04', 'Comunidad de Tecoman', 'Publicacion dedicada a Tecoman y lo poco que hay en ese pinche rancho culero de muerda', '../uploads/img_6818f1f451ed14.42530819.jpg', 'El corrido de Tecomán es una canción que narra la historia de Marcelino Verduzco, quien intentó ser contrabandista pero fue sorprendido. La letra describe cómo Marcelino y sus compañeros dejaron Tecomán en pleno día y se dirigieron a Parotal para recoger mercancía, pasando por Santa María. Luego, Luisillo fue encargado de entregar los costales escondidos, mientras Marcelino ya había cargado las otras 30 cajas en una camioneta. Planeaban pasar por San Vicente para evitar sospechas y reunirse en Tecomán para beber cerveza, pero al llegar al pavimento fueron interceptados por soldados. Marcelino y el conductor de la camioneta fueron asesinados, mientras que el resto logró escapar. El que fue capturado vivo acabó confesando todo, dejando a Marcelino esperando en Tecomán.', 'https://es.wikipedia.org/wiki/Tecom%C3%A1n', 'Cultura', 0),
(13, '2025-05-09', 'q', 'q', '../uploads/img_681e56850c8f51.48138659.png', 'q', '', 'Noticias', 0);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

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
