-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-04-2025 a las 22:48:52
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
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` text COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_comentario` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id_noticia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `titular` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion_corta` text COLLATE utf8mb4_general_ci NOT NULL,
  `imagen_principal` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contenido` text COLLATE utf8mb4_general_ci NOT NULL,
  `referencia` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id_noticia`, `fecha`, `titular`, `descripcion_corta`, `imagen_principal`, `contenido`, `referencia`, `categoria`) VALUES
(5, '2025-02-17', '38 instituciones se manifiestan para exigir paridad con miras a las elecciones 2024', 'Colectivos de defensa de los derechos de las mujeres se manifestaron en inmediaciones del Tribunal Supremo Electoral para recordar a los políticos y candidatos que hay normas que velan por la presencia de las mujeres en los cargos.', 'uploads/img_67d2e914f05297.98232069.png', 'Organizaciones de jóvenes, de mujeres y otras relacionadas con los derechos de la mujer realizaron esta mañana una vigilia a metros de las instalaciones del Tribunal Supremo Electoral, para recordar a los postulantes a la silla presidencial, las normas que avalan la paridad de género y la presencia de la mujer en la política nacional.\r\nEl grupo de personas llegó hasta la plaza Abaroa donde esta mañana se dio inicio al Encuentro Multipartidario, con la presencia de representantes de los diferentes partidos políticos del país.\r\n“Queremos hacerles recuerdo y a exigirle al órgano electoral, que haga cumplir el principio de paridad y alternancia política. Hemos entregado una carta a cada uno de los representantes de los partidos políticos y a quienes están postulando en la próxima elección, para que se respete la democracia”, explicó Tania Sánchez, directora de la Coordinadora de la Mujer.\r\nCon carteles y pancartas sobre el tema, los manifestantes se apostaron sobre la calle Sánchez Lima esquina Rosendo Gutiérrez, desde donde hubo un prolongado corte de circulación vehicular, hasta este mediodía, por la presencia de los simpatizantes de los diferentes partidos políticos.\r\n', 'https://www.vision360.bo/noticias/2025/02/17/20265-38-instituciones-se-manifiestan-para-exigir-paridad-con-miras-a-las-elecciones-2024', ''),
(6, '2025-02-14', 'La brecha salarial entre mujeres y hombres en el fútbol es de un 744%', 'El Instituto de las Mujeres organizó, ayer jueves, una mesa redonda para abordar la brecha salarial entre mujeres y hombres en el deporte junto a expertas en la materia', 'uploads/img_67d2e9bd6a52e8.75835166.jpg', 'En el marco del 22 de febrero, Día de la Igualdad Salarial, el Instituto de las Mujeres organizó, ayer jueves, un encuentro para abordar la brecha salarial entre mujeres y hombres en el deporte.\r\nDurante la jornada, inaugurada por la directora del Instituto de las Mujeres, Cristina Hernández, se visibilizaron las brechas existentes en diferentes disciplinas deportivas en España a través de las experiencias profesionales de distintas expertas en la materia. Moderado por la redactora jefa de deportes de El País, Nadia Tronchoni; participaron en el conversatorio Amanda Gutiérrez, presidenta de FUTPO; Lucila Pascua, presidenta de la Asociación de Jugadoras de Baloncesto (AJUB); Laura Torvisco Pérez, entrenadora de primera división y directora deportiva; Marta Francés Gómez, triatleta y medallista olímpica en los Juegos Paralímpicos de Paris 2024 y Patricia Campos Doménech, expiloto y entrenadora de fútbol.\r\n', 'https://www.inmujeres.gob.es/actualidad/noticias/2025/BrechaSalarialDeporte.htm', ''),
(7, '2024-10-15', 'Desigualdad: Dos mil millones de mujeres sin acceso a la protección social', 'Un informe de ONU Mujeres revela que las políticas de prestación social, como la atención sanitaria y las pensiones, no están llegando a las mujeres, lo que las hace más vulnerables mujeres y las niñas a la pobreza en todo el mundo. Además, las elevadas tasas de inflación desde 2022 han disparado los precios golpeando con especial dureza a las mujeres.', 'uploads/img_67d2ea311a0464.72362079.png', 'Un informe de ONU Mujeres revela que las políticas de prestación social, como la atención sanitaria y las pensiones, no están llegando a las mujeres, lo que las hace más vulnerables mujeres y las niñas a la pobreza en todo el mundo. Además, las elevadas tasas de inflación desde 2022 han disparado los precios golpeando con especial dureza a las mujeres.\r\nrevela que unos alarmantes dos mil millones de mujeres y niñas no tienen acceso a ninguna forma de protección social.\r\nA pesar de algunos avances desde 2015, las disparidades de género en la cobertura de la protección social han aumentado en la mayoría de las regiones en desarrollo, lo que sugiere que los recientes avances han beneficiado desproporcionadamente a los hombres. Esto está poniendo en riesgo el progreso hacia el Objetivo de Desarrollo Sostenible 5 (ODS 5).\r\n', 'https://news.un.org/es/story/2024/10/1533551', ''),
(8, '2024-01-12', 'Los hombres indígenas abogan por la igualdad de género para beneficiar a las mujeres, y también a los hombres', '– La desigualdad de género es generalizada en todas partes. A nivel mundial, 9 de cada 10 personas, tanto mujeres como hombres, siguen albergando sesgos de género, según un reciente informe de las Naciones Unidas. Estas normas perjudican a las mujeres y las niñas, pero también son perjudiciales para los hombres y los niños.', 'uploads/img_67d2eaac574889.29174095.png', 'Este hecho es especialmente evidente para los trabajadores de salud de la remota comunidad indígena ngäbe de Panamá. Allí los trabajadores de salud ngäbe, como el Dr. Orlando López, describen resultados de salud alarmantes para mujeres y hombres, consecuencia tanto de la marginación de la comunidad como de las rígidas normas de género\r\nEl Centro de Salud Hato Chami atiende en gran medida a mujeres y niños ngäbe, pero los trabajadores de la salud alientan a los padres y esposos a visitarlos y participar.\r\n“Tenemos comunidades que tienen que caminar durante dos días para llegar a una clínica”, explicó el Dr. López. Solo unos pocos caminos pavimentados serpentean entre el terreno montañoso, y los minibuses locales son poco frecuentes, por lo que la mayoría de la gente tiene que caminar.\r\nPero su aislamiento no es solo geográfico, sino también económico. Una larga historia de discriminación racial contra los ngäbe, incluidas barreras en el mercado laboral formal, han contribuido a la pobreza extrema.\r\nCuando se añade la desigualdad de género a la mezcla, las dificultades aumentan.', 'https://www.unfpa.org/es/news/los-hombres-ind%C3%ADgenas-abogan-por-la-igualdad-de-g%C3%A9nero-para-beneficiar-las-mujeres-y-tambi%C3%A9n', ''),
(9, '2025-03-07', '38 instituciones se manifiestan para exigir paridad con miras a las elecciones 2024', 'Noticia prueba', 'uploads/img_67d31f41486682.98106876.png', 'fepoifhbweñjkvbwiñwevjlehfwlueicvywl', 'https://youtu.be/WOD66Fz2biU?si=25YnV1JBHObeAkwt', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
