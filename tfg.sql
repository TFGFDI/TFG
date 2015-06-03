-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2015 a las 18:38:56
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE IF NOT EXISTS `examenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_profesor` int(11) DEFAULT NULL,
  `nombre_profesor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `curso` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '0->privado 1->publico',
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id`, `id_profesor`, `nombre_profesor`, `fecha`, `curso`, `tipo`, `tiempo`, `estado`, `activo`) VALUES
(13, 4, 'Antonio Sarasa', '2015-03-24', '', 'Intensivo', 0, 1, 0),
(14, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(15, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(16, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(17, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(18, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(19, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(20, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(21, 6, 'Alberto Contreras', '2015-03-24', '', '', 0, 0, 0),
(22, 6, 'Alberto Contreras', '2015-03-24', '', '', 30, 1, 0),
(23, 4, 'Antonio Sarasa', '2015-04-09', '', '', 1, 0, 0),
(24, 4, 'Antonio Sarasa', '2015-04-16', '2015/2016', 'Anual', 1, 0, 0),
(25, 4, 'Antonio Sarasa', '2015-04-16', '2015/2016', 'Semestral', 15, 0, 0),
(26, 4, 'Antonio Sarasa', '2015-05-12', '', '', 60, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_realizados`
--

CREATE TABLE IF NOT EXISTS `examenes_realizados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tiempo_ini` datetime DEFAULT NULL,
  `tiempo_fin` datetime DEFAULT NULL,
  `aciertos` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `nota_desarrollo` float NOT NULL,
  `nivel` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `corregido` int(1) NOT NULL,
  `expirado` int(1) NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `examenes_realizados`
--

INSERT INTO `examenes_realizados` (`id`, `id_examen`, `id_usuario`, `tiempo_ini`, `tiempo_fin`, `aciertos`, `nota`, `nota_desarrollo`, `nivel`, `corregido`, `expirado`, `comentarios`) VALUES
(2, 23, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, '', 1, 0, NULL),
(3, 24, 28, '2015-04-16 09:51:52', '2015-04-16 09:52:15', 1, 0.333333, 0, '', 1, 0, ''),
(9, 24, 3, '2015-04-16 12:41:55', '0000-00-00 00:00:00', 0, 0, 1, '', 1, 0, ''),
(10, 24, 2, '2015-04-30 09:20:26', '2015-04-30 09:20:53', 2, 0.666667, 6.33, '', 1, 0, ''),
(11, 22, 2, '2015-05-18 12:29:57', '0000-00-00 00:00:00', 0, 0, 0, 'C3PO', 1, 0, ''),
(12, 22, 11, '2015-05-28 10:43:32', '0000-00-00 00:00:00', 0, 0, 0, '', 0, 0, ''),
(13, 26, 11, '2015-05-28 11:10:59', '2015-05-28 11:22:48', 13, 68.4211, 7, 'B2', 1, 0, ''),
(17, 26, 2, '2015-06-03 17:57:12', '2015-06-03 18:00:05', 10, 52.6316, 8, 'C2', 1, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `activo` enum('0','1') COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `fecha`, `imagen`, `titulo`, `activo`) VALUES
(3, '2015-05-18', 'Kv2FCPe24Hom.jpeg', 'Clases de Verano', '1'),
(4, '2015-05-18', 'o0Bs153Xe3x.jpeg', 'Clases de turismo.', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE IF NOT EXISTS `informacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `informaciones` text COLLATE utf8_spanish_ci,
  `activo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `informacion`
--

INSERT INTO `informacion` (`id`, `fecha`, `informaciones`, `activo`) VALUES
(1, '2015-05-18', '<p>Presentaci&oacute;n general</p><p>Los Cursos de Espa&ntilde;ol como Lengua Extranjera de la Universidad de Zaragoza desarrollan su labor a lo largo de todo el a&ntilde;o en Zaragoza y durante el verano trasladan su actividad a la ciudad de Jaca (Huesca), enclave tur&iacute;stico situado en los Pirineos.&nbsp;Entre las dos sedes, los alumnos extranjeros que nos visitan cada a&ntilde;o superan ampliamente el millar.</p><p>La Universidad de Zaragoza es pionera en la ense&ntilde;anza de espa&ntilde;ol a extranjeros desde 1927. Mantiene convenios con diferentes instituciones p&uacute;blicas y privadas de todo el mundo, colabora directamente con distintos organismos oficiales en la tarea de difusi&oacute;n del espa&ntilde;ol (Instituto Cervantes, Consejer&iacute;as de Educaci&oacute;n de diversas Embajadas de Espa&ntilde;a, Gobierno de Arag&oacute;n, Ministerio de Educaci&oacute;n, Cultura y Deporte) y es Centro Examinador Oficial para la obtenci&oacute;n del&nbsp;Diploma de Espa&ntilde;ol como Lengua Extranjera&nbsp;(DELE).</p><p>La Universidad de Zaragoza cuenta con un gran reconocimiento internacional, como lo demuestra el elevado n&uacute;mero de estudiantes extranjeros que la visitan dentro de los diferentes programas de cooperaci&oacute;n en los que participa (S&oacute;crates-Erasmus, Tempus, ALPA, Asia-Link, Leonardo, etc.). Sus Cursos de Espa&ntilde;ol, a los que asisten m&aacute;s de 1.000 alumnos al a&ntilde;o y en los que todo el profesorado cuenta con una alta especializaci&oacute;n filol&oacute;gica en ense&ntilde;anza de ELE, se integran en dichos programas y, adem&aacute;s, organizan cursos espec&iacute;ficos para las Universidades extranjeras que as&iacute; lo solicitan.</p>', '1'),
(2, '2015-05-28', 'tttttt', '1'),
(3, '2015-05-28', 'ipouiouoi', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `activo` enum('0','1') CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `fecha`, `titulo`, `descripcion`, `activo`) VALUES
(1, '2015-04-30', 'Abierto el plazo de Matricula', 'Ya esta disponible la opcion de matricularse bla bla bla', '1'),
(2, '2015-04-30', 'Noticia Nueva', 'Presentate a nuestros cursos, tenemos plazas libres', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=215 ;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`, `codigo`) VALUES
(1, 'Afghanistan', 'af'),
(2, 'Albania', 'al'),
(3, 'Algeria', 'dz'),
(4, 'American Samoa', 'as'),
(5, 'Andorra', 'ad'),
(6, 'Angola', 'ao'),
(7, 'Antigua and Barbuda', 'ai'),
(8, 'Argentina', 'ar'),
(9, 'Armenia', 'am'),
(10, 'Aruba', 'aw'),
(11, 'Australia', 'au'),
(12, 'Austria', 'at'),
(13, 'Azerbaijan', 'az'),
(14, 'Bahamas, The', 'bs'),
(15, 'Bahrain', 'bh'),
(16, 'Bangladesh', 'bd'),
(17, 'Barbados', 'bb'),
(18, 'Belarus', 'by'),
(19, 'Belgium', 'be'),
(20, 'Belize', 'bz'),
(21, 'Benin', 'bj'),
(22, 'Bermuda', 'bm'),
(23, 'Bhutan', 'bt'),
(24, 'Bolivia', 'bo'),
(25, 'Bosnia and Herzegovina', 'ba'),
(26, 'Botswana', 'bw'),
(27, 'Brazil', 'br'),
(28, 'Brunei Darussalam', 'bn'),
(29, 'Bulgaria', 'bg'),
(30, 'Burkina Faso', 'bf'),
(31, 'Burundi', 'bi'),
(32, 'Cambodia', 'kh'),
(33, 'Cameroon', 'cm'),
(34, 'Canada', 'ca'),
(35, 'Cape Verde', 'cv'),
(36, 'Cayman Islands', 'ky'),
(37, 'Central African Republic', 'cf'),
(38, 'Chad', 'td'),
(39, 'Chile', 'cl'),
(40, 'China', 'cn'),
(41, 'Colombia', 'co'),
(42, 'Comoros', 'km'),
(43, 'Congo, Dem. Rep.', 'cd'),
(44, 'Congo, Rep.', 'cg'),
(45, 'Costa Rica', 'cr'),
(46, 'Cote d Ivoire', 'ci'),
(47, 'Croatia', 'hr'),
(48, 'Cuba', 'cu'),
(49, 'Curacao', 'cw'),
(50, 'Cyprus', 'cy'),
(51, 'Czech Republic', 'cz'),
(52, 'Denmark', 'dk'),
(53, 'Djibouti', 'dj'),
(54, 'Dominica', 'dm'),
(55, 'Dominican Republic', 'do'),
(56, 'Ecuador', 'ec'),
(57, 'Egypt, Arab Rep.', 'eg'),
(58, 'El Salvador', 'sv'),
(59, 'Equatorial Guinea', 'gq'),
(60, 'Eritrea', 'er'),
(61, 'Estonia', 'ee'),
(62, 'Ethiopia', 'et'),
(63, 'Faeroe Islands', 'fo'),
(64, 'Fiji', 'fj'),
(65, 'Finland', 'fi'),
(66, 'France', 'fr'),
(67, 'French Polynesia', 'pf'),
(68, 'Gabon', 'ga'),
(69, 'Gambia, The', 'gm'),
(70, 'Georgia', 'ge'),
(71, 'Germany', 'de'),
(72, 'Ghana', 'gh'),
(73, 'Greece', 'gr'),
(74, 'Greenland', 'gl'),
(75, 'Grenada', 'gd'),
(76, 'Guam', 'gu'),
(77, 'Guatemala', 'gt'),
(78, 'Guinea', 'gn'),
(79, 'Guinea-Bissau', 'gw'),
(80, 'Guyana', 'gy'),
(81, 'Haiti', 'ht'),
(82, 'Honduras', 'hn'),
(83, 'Hong Kong SAR, China', 'hk'),
(84, 'Hungary', 'hu'),
(85, 'Iceland', 'is'),
(86, 'India', 'in'),
(87, 'Indonesia', 'id'),
(88, 'Iran, Islamic Rep.', 'ir'),
(89, 'Iraq', 'iq'),
(90, 'Ireland', 'ie'),
(91, 'Isle of Man', 'im'),
(92, 'Israel', 'il'),
(93, 'Italy', 'it'),
(94, 'Jamaica', 'jm'),
(95, 'Japan', 'jp'),
(96, 'Jordan', 'jo'),
(97, 'Kazakhstan', 'kz'),
(98, 'Kenya', 'ke'),
(99, 'Kiribati', 'ki'),
(100, 'Korea, Dem. Rep.', 'kp'),
(101, 'Korea, Rep.', 'kr'),
(102, 'Kosovo', 'xk'),
(103, 'Kuwait', 'kw'),
(104, 'Kyrgyz Republic', 'kg'),
(105, 'Lao PDR', 'la'),
(106, 'Latvia', 'lv'),
(107, 'Lebanon', 'lb'),
(108, 'Lesotho', 'ls'),
(109, 'Liberia', 'lr'),
(110, 'Libya', 'ly'),
(111, 'Liechtenstein', 'li'),
(112, 'Lithuania', 'lt'),
(113, 'Luxembourg', 'lu'),
(114, 'Macao SAR, China', 'mo'),
(115, 'Macedonia, FYR', 'mk'),
(116, 'Madagascar', 'mg'),
(117, 'Malawi', 'mw'),
(118, 'Malaysia', 'my'),
(119, 'Maldives', 'mv'),
(120, 'Mali', 'ml'),
(121, 'Malta', 'mt'),
(122, 'Marshall Islands', 'mh'),
(123, 'Mauritania', 'mr'),
(124, 'Mauritius', 'mu'),
(125, 'Mayotte', 'yt'),
(126, 'Mexico', 'mx'),
(127, 'Micronesia, Fed. Sts.', 'fm'),
(128, 'Moldova', 'md'),
(129, 'Monaco', 'mc'),
(130, 'Mongolia', 'mn'),
(131, 'Montenegro', 'me'),
(132, 'Morocco', 'ma'),
(133, 'Mozambique', 'mz'),
(134, 'Myanmar', 'mm'),
(135, 'Namibia', 'na'),
(136, 'Nepal', 'np'),
(137, 'Netherlands', 'nl'),
(138, 'New Caledonia', 'nc'),
(139, 'New Zealand', 'nz'),
(140, 'Nicaragua', 'ni'),
(141, 'Niger', 'ne'),
(142, 'Nigeria', 'ng'),
(143, 'Northern Mariana Islands', 'mp'),
(144, 'Norway', 'no'),
(145, 'Oman', 'om'),
(146, 'Pakistan', 'pk'),
(147, 'Palau', 'pw'),
(148, 'Panama', 'pa'),
(149, 'Papua New Guinea', 'pg'),
(150, 'Paraguay', 'py'),
(151, 'Peru', 'pe'),
(152, 'Philippines', 'ph'),
(153, 'Poland', 'pl'),
(154, 'Portugal', 'pt'),
(155, 'Puerto Rico', 'pr'),
(156, 'Qatar', 'wa'),
(157, 'Romania', 'ro'),
(158, 'Russian Federation', 'ru'),
(159, 'Rwanda', 'rw'),
(160, 'Samoa', 'ws'),
(161, 'San Marino', 'sm'),
(162, 'Sao Tome and Principe', 'st'),
(163, 'Saudi Arabia', 'sa'),
(164, 'Senegal', 'sn'),
(165, 'Serbia', 'rs'),
(166, 'Seychelles', 'sc'),
(167, 'Sierra Leone', 'sl'),
(168, 'Singapore', 'sg'),
(169, 'Slovak Republic', 'sk'),
(170, 'Slovenia', 'si'),
(171, 'Solomon Islands', 'sb'),
(172, 'Somalia', 'so'),
(173, 'South Africa', 'za'),
(174, 'South Sudan', 'ss'),
(175, 'Spain', 'es'),
(176, 'Sri Lanka', 'lk'),
(177, 'St. Kitts and Nevis', 'kn'),
(178, 'St. Lucia', 'lc'),
(179, 'St. Martin (French part)', 'mf'),
(180, 'St. Vincent and the Grenadines', 'vc'),
(181, 'Sudan', 'sd'),
(182, 'Suriname', 'sr'),
(183, 'Swaziland', 'sz'),
(184, 'Sweden', 'se'),
(185, 'Switzerland', 'ch'),
(186, 'Syrian Arab Republic', 'sy'),
(187, 'Tajikistan', 'tj'),
(188, 'Tanzania', 'tz'),
(189, 'Thailand', 'th'),
(190, 'Timor-Leste', 'tp'),
(191, 'Togo', 'tg'),
(192, 'Tonga', 'to'),
(193, 'Trinidad and Tobago', 'tt'),
(194, 'Tunisia', 'tn'),
(195, 'Turkey', 'tr'),
(196, 'Turkmenistan', 'tm'),
(197, 'Turks and Caicos Islands', 'tc'),
(198, 'Tuvalu', 'tv'),
(199, 'Uganda', 'ug'),
(200, 'Ukraine', 'ua'),
(201, 'United Arab Emirates', 'ae'),
(202, 'United Kingdom', 'uk'),
(203, 'United States', 'us'),
(204, 'Uruguay', 'uy'),
(205, 'Uzbekistan', 'uz'),
(206, 'Vanuatu', 'vu'),
(207, 'Venezuela, RB', 've'),
(208, 'Vietnam', 'vn'),
(209, 'Virgin Islands (U.S.)', 'vi'),
(210, 'West Bank and Gaza', 'ps'),
(211, 'Western Sahara', 'eh'),
(212, 'Yemen, Rep.', 'ye'),
(213, 'Zambia', 'zm'),
(214, 'Zimbabwe', 'zw');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_examen`
--

CREATE TABLE IF NOT EXISTS `preguntas_examen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pregunta` text COLLATE utf8_spanish_ci,
  `respuesta1` text COLLATE utf8_spanish_ci,
  `respuesta2` text COLLATE utf8_spanish_ci,
  `respuesta3` text COLLATE utf8_spanish_ci,
  `respuesta4` text COLLATE utf8_spanish_ci,
  `solucion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `preguntas_examen`
--

INSERT INTO `preguntas_examen` (`id`, `id_examen`, `tipo`, `pregunta`, `respuesta1`, `respuesta2`, `respuesta3`, `respuesta4`, `solucion`, `activo`) VALUES
(7, 9, 'Desarrollo', 'Escribe sobre tus vacaciones', '', '', '', '', '', NULL),
(9, 23, 'Test', 'Â¿Como se dice casa?', 'House', 'Dog', 'Apple', 'Red', 'a', NULL),
(10, 23, 'Desarrollo', 'Escribe sobre tus vacaciones', '', '', '', '', 'Desarrollo', NULL),
(11, 24, 'Test', 'Como se dice dog en espaÃ±ol?', 'oso', 'perro', 'gato', 'zorro', 'b', NULL),
(12, 24, 'Test', 'casa en espaÃ±ol?', 'home', 'biult', 'house', 'church', 'c', NULL),
(13, 24, 'Test', 'como estas? en espaÃ±ol', 'hi!', 'see you soon', 'how are you', 'see you later', 'c', NULL),
(14, 24, 'Desarrollo', 'Describe tus vacaciones.', '', '', '', '', 'Desarrollo', NULL),
(15, 24, 'Desarrollo', 'eeqe', '', '', '', '', 'Desarrollo', NULL),
(18, 26, 'Test', 'Â¿ A que te dedicas?', 'Me dedico a estudiante.', 'Soy estudiante', 'somos unos estudiantes', 'trabajo a estudiante', 'b', NULL),
(19, 26, 'Test', 'Â¿Que hora es?', 'Es la una en punto.', 'Son las una en punto', 'EstÃ¡ las dos y treinta', 'estamos la una y cinco', 'a', NULL),
(20, 26, 'Test', 'Â¿Quien es el hijo de mi tio?', 'Mi sobrino', 'Nuestro cuÃ±ado', 'Mi primo', 'estÃ¡ mi hermana', 'c', NULL),
(21, 26, 'Test', '......... llamo Eugenia como mi abuela.', 'Me', 'Mi', 'Les', 'Se', 'a', NULL),
(22, 26, 'Test', 'A Ã©l .........gustan los gatos.', 'les', 'le', 'me', 'te', 'b', NULL),
(23, 26, 'Test', 'Hoy hace.............frÃ­o.', 'muy', 'mucha', 'el', 'mucho', 'd', NULL),
(24, 26, 'Test', 'El lunes nosotros vamos ............ Madrid.', 'de', 'en', 'a', 'con', 'c', NULL),
(25, 26, 'Test', 'El no .......... hacer este ejercicio, pero vovotros sÃ­ .......... hacerlo.', 'puedo/podemos', 'puede/podÃ©is', 'puedes/podemos', 'poden/pueden', 'b', NULL),
(26, 26, 'Test', 'Â¿Que te duele?', 'Le duele la cabeza', 'Tengo me duele la espalda', 'Me duelen las muelas.', 'Te dueli los pies', 'c', NULL),
(27, 26, 'Test', 'Â¿Que vas hacer el fin de semana?', 'Voy a la playa', 'Vas a ir de compras', 'Vas en fiesta', 'voy en el campo', 'a', NULL),
(28, 26, 'Test', 'Â¿Has viajado alguna vez a otro paÃ­s?', 'Si, todavÃ­a', 'No, aÃºn no', 'Ya no', 'TodavÃ­a tambien', 'b', NULL),
(30, 26, 'Test', 'Londres .... la capital de Reino Unido y ........ en el noroeste de europa.', 'es/es', 'es/hay', 'es/estÃ¡', 'estÃ¡/estÃ¡', 'c', NULL),
(31, 26, 'Test', 'Tu examen ....... bien. Â¿......... contento?', 'es/hay', 'es/estÃ¡', 'estÃ¡/eres', 'estÃ¡/ estÃ¡s', 'd', NULL),
(32, 26, 'Test', 'Â¿............ disco compramos?', 'CuÃ¡les', 'CuÃ¡nto', 'QuÃ©', 'QuiÃ©n', 'c', NULL),
(33, 26, 'Test', 'El curso ............... la prÃ³xima semana.', 'empezar', 'empeza', 'empieza', 'empezaremos', 'c', NULL),
(34, 26, 'Test', 'El lunes ........... la fiesta del colegio.', 'fuimos', 'estuvo', 'estaba', 'fue', 'd', NULL),
(35, 26, 'Test', 'Â¿........... ayer todos los deberes de espaÃ±ol?', 'Has hecho', 'Hiciste', 'HacÃ­as', 'Haz', 'a', NULL),
(36, 26, 'Test', 'Cuando era pequeÃ±a mi abuela siempre ........... historias de miedo.', 'me contaba', 'me ha contado', 'me contÃ³', 'me cuenta', 'a', NULL),
(37, 26, 'Test', 'Â¿Le has comprado un regalo a tu hermano?', 'Si, me lo he comprado', 'Si, se lo he comprado', 'No, no te la he comprado', 'Si, si se he comprado', 'b', NULL),
(38, 26, 'Desarrollo', 'Â¿ Como fueron tus vacaciones?', '', '', '', '', 'Desarrollo', NULL),
(39, 22, 'Test', 'Â¿Que te dijo Maria?', 'Ella me dijo que no venir', 'Ella me decir mi que no viene', 'Ella me dijo que no viene', 'Ella me dijeron que sÃ­ viene', 'c', NULL),
(40, 22, 'Test', 'MaÃ±ana ......... qu entregar mis deberes al profesor.', 'tengo', 'tuve', 'he tenido', 'tenga', 'a', NULL),
(41, 22, 'Test', 'La semana pasada unos ladrones .......... la tele de mi vecino.', 'roba', 'habÃ­a robado', 'robaba', 'robaron', 'd', NULL),
(42, 22, 'Test', 'Ayer conocÃ­ a una chica. ........... muy guapa.', 'Estuvo', 'Fue', 'Era', 'Ha estado', 'c', NULL),
(43, 22, 'Test', 'Nunca .......... en Roma, pero la prÃ³xima semana ........ .', 'estuve/ van', 'estaba/ irÃ©', 'he estado/ irÃ©', 'estaba/ voy', 'c', NULL),
(44, 22, 'Test', 'Â¿.......... darme una barra de pan?', 'podremos', 'PodrÃ­a', 'Quiero', 'Podemos', 'b', NULL),
(45, 22, 'Test', 'El dia que ........ a MarÃ­a ........... lloviendo.', 'conocÃ­ / estaba', 'conocÃ­a / estaba', 'conocÃ­a / estuvo', 'conocÃ­ / estÃ¡', 'a', NULL),
(46, 22, 'Test', '............. la cama antes de salir, por favor.', 'Haya', 'No hago', 'Haz', 'Hice', 'c', NULL),
(47, 22, 'Test', 'Me duele la cabeza, voy a tomar una ..........', 'pastilla', 'vitamina', 'venda', 'masaje', 'a', NULL),
(48, 22, 'Test', 'Â¿Has comprado las entradas para el cine?', 'aÃºn no', 'ya', 'todavÃ­a no', 'aÃºn si', 'a', NULL),
(49, 22, 'Test', 'Â¡Ten cuidado! No ................. tan rÃ¡pido.', 'conduces', 'conducirÃ¡s', 'conduzcas', 'conducirÃ­a', 'c', NULL),
(50, 22, 'Test', 'Yo en tu lugar no le ......... nada.', 'dirÃ­a', 'dirÃ©', 'digo', 'dije', 'a', NULL),
(51, 22, 'Test', '............. he querido volver a trabajar.', 'Nadie', 'Nada', 'Nunca', 'Ningunos', 'c', NULL),
(52, 22, 'Test', 'Si ...... buen tiempo, iremos al campo.', 'hay', 'harÃ­a', 'haga', 'hace', 'd', NULL),
(53, 22, 'Test', 'Quiero un telefono que  ........ cÃ¡mara.', 'tuviera', 'tuviesen', 'tiene', 'tenga', 'd', NULL),
(54, 22, 'Test', 'me molesta mucho que ............ tarde.', 'estÃ©s', 'seas', 'llegues', 'eres', 'c', NULL),
(55, 22, 'Test', 'Por favor, ........ la ventana.', 'abro', 'abres', 'abre', 'abrirÃ¡n', 'c', NULL),
(56, 22, 'Test', 'Me ............ mucho tus pantalones.', 'gustas', 'gustan', 'gusta', 'gustarÃ¡n', 'c', NULL),
(58, 22, 'Desarrollo', 'Â¿Que haces en tu tiempo libre?', '', '', '', '', 'Desarrollo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_alumnos`
--

CREATE TABLE IF NOT EXISTS `respuestas_alumnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen_realizado` int(11) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `respuesta` text COLLATE utf8_spanish_ci,
  `solucion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentarios` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=84 ;

--
-- Volcado de datos para la tabla `respuestas_alumnos`
--

INSERT INTO `respuestas_alumnos` (`id`, `id_examen_realizado`, `id_pregunta`, `id_usuario`, `respuesta`, `solucion`, `comentarios`) VALUES
(25, 23, 9, 2, 'a', 'a', ''),
(26, 23, 10, 2, '<p>hjgjhg</p>', 'Desarrollo', '<p>No puedo entender nada</p><p><br /><strong>Nota: </strong>0</p>'),
(27, 24, 11, 2, 'b', 'b', ''),
(28, 24, 12, 2, 'd', 'c', ''),
(29, 24, 13, 2, 'a', 'c', ''),
(30, 24, 14, 2, '<p>Muy bonitas</p>', 'Desarrollo', '<p>Muy bien</p><p><br /><strong>Nota: </strong>8</p>'),
(31, 24, 11, 3, 'b', 'b', ''),
(32, 24, 12, 3, 'a', 'c', ''),
(33, 24, 13, 3, 'a', 'c', ''),
(34, 24, 14, 3, '<p>En Ourense!!</p>', 'Desarrollo', '<p>Bonito lugar.</p><p><br /><strong>Nota: </strong>3</p>'),
(35, 23, 9, 3, 'a', 'a', ''),
(36, 23, 10, 3, '<p>fferwer</p>', 'Desarrollo', ''),
(37, 24, 14, 3, '', 'Desarrollo', '<p>La proxima vez Intenta escribir un poco.</p><p><br /><strong>Nota: </strong>0</p>'),
(38, 24, 15, 3, '', 'Desarrollo', '<p>Nada</p><p><br /><strong>Nota: </strong>0</p>'),
(39, 24, 11, 2, 'b', 'b', ''),
(40, 24, 12, 2, 'd', 'c', ''),
(41, 24, 13, 2, 'a', 'c', ''),
(42, 24, 14, 2, '<p>Vacaiones en Menorca</p>', 'Desarrollo', '<p>Que envidia<br /><strong>Nota: </strong>5</p>'),
(43, 24, 15, 2, '<p>No lo entiendo</p>', 'Desarrollo', '<p>Pues estudia<br /><strong>Nota: </strong>6</p>'),
(44, 26, 18, 11, 'b', 'b', ''),
(45, 26, 19, 11, 'a', 'a', ''),
(46, 26, 20, 11, 'c', 'c', ''),
(47, 26, 21, 11, 'a', 'a', ''),
(48, 26, 22, 11, 'b', 'b', ''),
(49, 26, 23, 11, 'd', 'd', ''),
(50, 26, 24, 11, 'c', 'c', ''),
(51, 26, 25, 11, 'a', 'b', ''),
(52, 26, 26, 11, 'b', 'c', ''),
(53, 26, 27, 11, 'd', 'a', ''),
(54, 26, 28, 11, 'b', 'b', ''),
(55, 26, 30, 11, 'a', 'c', ''),
(56, 26, 31, 11, 'c', 'd', ''),
(57, 26, 32, 11, 'c', 'c', ''),
(58, 26, 33, 11, 'a', 'c', ''),
(59, 26, 34, 11, 'd', 'd', ''),
(60, 26, 35, 11, 'a', 'a', ''),
(61, 26, 36, 11, 'a', 'a', ''),
(62, 26, 37, 11, 'b', 'b', ''),
(63, 26, 38, 11, '<p>Mis vacaciones fueron divertidas, me fui de viaje a Ibiza con mis amigos y nos gusto mucho la isla.</p>', 'Desarrollo', '<p><br /><strong>Nota: </strong>7</p>'),
(64, 26, 18, 2, 'b', 'b', ''),
(65, 26, 19, 2, 'c', 'a', ''),
(66, 26, 20, 2, 'd', 'c', ''),
(67, 26, 21, 2, 'a', 'a', ''),
(68, 26, 22, 2, 'b', 'b', ''),
(69, 26, 23, 2, 'a', 'd', ''),
(70, 26, 24, 2, 'd', 'c', ''),
(71, 26, 25, 2, 'b', 'b', ''),
(72, 26, 26, 2, 'd', 'c', ''),
(73, 26, 27, 2, 'a', 'a', ''),
(74, 26, 28, 2, 'd', 'b', ''),
(75, 26, 30, 2, 'c', 'c', ''),
(76, 26, 31, 2, 'd', 'd', ''),
(77, 26, 32, 2, 'd', 'c', ''),
(78, 26, 33, 2, 'c', 'c', ''),
(79, 26, 34, 2, 'd', 'd', ''),
(80, 26, 35, 2, 'd', 'a', ''),
(81, 26, 36, 2, 'd', 'a', ''),
(82, 26, 37, 2, 'b', 'b', ''),
(83, 26, 38, 2, '<p>Muy divertidas</p>', 'Desarrollo', '<p>Uso correcto de los tiempos verbales</p><p><br /><strong>Nota: </strong>8</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traducciones`
--

CREATE TABLE IF NOT EXISTS `traducciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lang` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=64 ;

--
-- Volcado de datos para la tabla `traducciones`
--

INSERT INTO `traducciones` (`id`, `clave`, `valor`, `lang`) VALUES
(1, 'login', 'Acceso Usuarios', 'es'),
(2, 'login', 'Login', 'en'),
(3, 'iniciar_sesion', 'Iniciar Sesion', 'es'),
(4, 'iniciar_sesion', 'Log me in', 'en'),
(5, 'registro', 'Registrate', 'es'),
(6, 'registro', 'Sign in', 'en'),
(7, 'recordar', '¿No recuerda sus datos de acceso?', 'es'),
(8, 'recordar', 'Can''t you access to your account?', 'en'),
(9, 'salir', 'Salir', 'es'),
(10, 'salir', 'Log Out', 'en'),
(11, 'formulario_registro', 'Formulario de registro', 'es'),
(12, 'formulario_registro', 'Registration Form', 'en'),
(13, 'nombre', 'Nombre', 'es'),
(14, 'nombre', 'Name', 'en'),
(15, 'apellidos', 'Apellidos', 'es'),
(16, 'apellidos', 'Surname', 'en'),
(17, 'nacionalidad', 'Nacionalidad', 'es'),
(18, 'nacionalidad', 'Nacionality', 'en'),
(19, 'nacimiento', 'Fecha Nacimiento', 'es'),
(20, 'nacimiento', 'Date of Birth', 'en'),
(21, 'sexo', 'Sexo', 'es'),
(22, 'sexo', 'Gender', 'en'),
(23, 'masculino', 'Masculino', 'es'),
(24, 'masculino', 'Male', 'en'),
(25, 'femenino', 'Femenino', 'es'),
(26, 'femenino', 'Female', 'en'),
(27, 'contrasena', 'Contrase&ntilde;a', 'es'),
(28, 'contrasena', 'Password', 'en'),
(29, 'repetir', 'Repetir Contrase&ntilde;a', 'es'),
(30, 'repetir', 'Repeat Password', 'en'),
(31, 'telefono', 'Tel&eacute;fono', 'es'),
(32, 'telefono', 'Telephone', 'en'),
(35, 'cp', 'C&oacute;digo Postal', 'es'),
(36, 'ciudad', 'Ciudad', 'es'),
(37, 'ciudad', 'City', 'en'),
(38, 'historial_alumno', 'Historial Alumno', 'es'),
(39, 'historial_alumno', 'History', 'en'),
(40, 'fecha', 'Fecha', 'es'),
(41, 'fecha', 'Date', 'en'),
(42, 'modificar_perfil', 'Modificar perfil', 'es'),
(43, 'modificar_perfil', 'Edit profile', 'en'),
(44, 'dirección', 'Dirección', 'es'),
(45, 'dirección', 'Address', 'en'),
(50, 'informacion', 'Informaci&oacute;n', 'es'),
(51, 'informacion', 'Information', 'en'),
(52, 'noticias', 'Noticias', 'es'),
(53, 'noticias', 'News', 'en'),
(54, 'contacto', 'Contacto', 'es'),
(55, 'contacto', 'Contact', 'en'),
(56, 'cuenta_usuario', 'Cuenta Usuario', 'es'),
(57, 'cuenta_usuario', 'User profile', 'en'),
(58, 'hola', 'Hola', 'es'),
(59, 'hola', 'Hello', 'en'),
(60, 'inicio', 'Inicio', 'es'),
(61, 'inicio', 'Home', 'en'),
(62, 'examen', 'Hacer Ex&aacute;men', 'es'),
(63, 'examen', 'To test', 'en');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechanacimiento` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cp` int(11) NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `nacionalidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrasena` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `sexo`, `fechanacimiento`, `email`, `direccion`, `cp`, `ciudad`, `telefono`, `nacionalidad`, `contrasena`, `rol`, `activo`, `observaciones`) VALUES
(1, 'Evelin', 'Cruz', 'F', '12/05/1987', 'evi_cruz@hotmail.com', '', 0, '', 0, 'Spain', 'Y2NjY2Nj', 'A', '1', ''),
(2, 'Miguel', 'Ortega', 'M', '45/32/1111', 'aa@aa.es', 'c/ Rio Rosas 46', 28000, 'Masachusets', 999999999, 'Ireland', 'Y2NjY2Nj', 'E', '1', ''),
(3, 'Oliver', 'Garcia', 'M', '22/33/1234', 'bb@bb.es', '', 0, '', 0, 'Spain', 'Y2NjY2Nj', 'E', '1', ''),
(6, 'Alberto', 'Contreras', 'M', '03/12/2015', 'alberto@ucm.es', 'C/ matilde hernandez 84', 28777, 'Madrid', 673331223, 'France', 'Y2NjY2Nj', 'P', '1', ''),
(8, 'gregorio', 'Contreras', 'M', '03/11/2015', 'gtegorio@cc.es', '', 0, '', 0, 'Brazil', 'Y2NjY2Nj', 'E', '0', ''),
(11, 'maria', 'Gonzales', 'F', '10/11/1995', 'mariagonza@hotmail.com', 'c/ Jorge Juan, 45', 28012, 'Madrid', 655894452, 'Italy', 'Y2NjY2Nj', 'E', '1', ''),
(12, 'Jose', 'Martinez Perez', 'M', '02/12/1988', 'jositomar@hotmail.com', '', 28028, 'Madrid', 688421053, 'Thailand', 'Y2NjY2Nj', 'E', '0', ''),
(13, 'Jean pierre', 'barragato', 'M', '06/20/1984', 'jean@gmail.com', '', 28033, 'Zaragoza', 674258923, 'Italy', 'Y2NjY2Nj', 'E', '1', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
