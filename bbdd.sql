-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2015 a las 20:44:10
-- Versión del servidor: 5.5.13
-- Versión de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `traducciones`
--

CREATE TABLE IF NOT EXISTS `traducciones` (
  `id` int(11) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `lang` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `traducciones`
--

INSERT INTO `traducciones` (`id`, `clave`, `valor`, `lang`) VALUES
(NULL, 'login', 'Acceso Usuarios', 'es'),
(NULL, 'login', 'Login', 'en'),
(NULL, 'iniciar_sesion', 'Iniciar Sesion', 'es'),
(NULL, 'iniciar_sesion', 'Log me in', 'en'),
(NULL, 'registro', 'Registrate', 'es'),
(NULL, 'registro', 'Sign in', 'en'),
(NULL, 'recordar', '¿No recuerda sus datos de acceso?', 'es'),
(NULL, 'recordar', 'Can''t you access to your account?', 'en'),
(NULL, 'salir', 'Salir', 'es'),
(NULL, 'salir', 'Log Out', 'en'),
(NULL, 'formulario_registro', 'Formulario de registro', 'es'),
(NULL, 'formulario_registro', 'Registration Form', 'en'),
(NULL, 'nombre', 'Nombre', 'es'),
(NULL, 'nombre', 'Name', 'en'),
(NULL, 'apellidos', 'Apellidos', 'es'),
(NULL, 'apellidos', 'Surname', 'en'),
(NULL, 'nacionalidad', 'Nacionalidad', 'es'),
(NULL, 'nacionalidad', 'Nacionality', 'en'),
(NULL, 'nacimiento', 'Fecha Nacimiento', 'es'),
(NULL, 'nacimiento', 'Date of Birth', 'en'),
(NULL, 'sexo', 'Sexo', 'es'),
(NULL, 'sexo', 'Gender', 'en'),
(NULL, 'masculino', 'Masculino', 'es'),
(NULL, 'masculino', 'Male', 'en'),
(NULL, 'femenino', 'Femenino', 'es'),
(NULL, 'femenino', 'Female', 'en'),
(NULL, 'contrasena', 'Contrase&ntilde;a', 'es'),
(NULL, 'contrasena', 'Password', 'en'),
(NULL, 'repetir', 'Repetir Contrase&ntilde;a', 'es'),
(NULL, 'repetir', 'Repeat Password', 'en'),
(NULL, 'telefono', 'Tel&eacute;fono', 'es'),
(NULL, 'cp', 'C&oacute;digo Postal', 'es'),
(NULL, 'ciudad', 'Ciudad', 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sexo` enum('F','M') CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechanacimiento` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` smallint(6) NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cp` smallint(6) NOT NULL,
  `ciudad` varchar(255) CHARACTER SET utf32 COLLATE utf32_spanish2_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nacionalidad` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rol` enum('A','P','E') CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `sexo`, `fechanacimiento`, `telefono`, `direccion`, `cp`, `ciudad`, `email`, `nacionalidad`, `contrasena`, `rol`, `activo`) VALUES
(1, 'oliver', NULL, NULL, NULL, 0, '', 0, '', 'oli@gmail.com', NULL, '1', 'A', 1),
(2, 'luis alfonso  jjjjjjjjjjjjkkkkkkkkkkkkkkh', 'perez', NULL, NULL, 0, '', 0, '', 'luijjjjjjjjjjjjjjjjjjs@gmail.com', NULL, '1', 'P', 1),
(3, 'liza', 'almeida', NULL, NULL, 0, '', 0, '', 'liza@gmail.com', NULL, '1', 'E', 1),
(4, 'berto', 'asdf', '', '0000-00-00', 0, '', 0, '', 'berto@gmail.com', '', '1', 'P', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE TABLE `examenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_profesor` int(11) DEFAULT NULL,
  `nombre_profesor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '0->privado 1->publico',
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `preguntas_examen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pregunta` text COLLATE utf8_spanish_ci,
  `respuesta1` text COLLATE utf8_spanish_ci,
  `respuesta2` text COLLATE utf8_spanish_ci,
  `respuesta3` text COLLATE utf8_spanish_ci,
  `respuesta4` text COLLATE utf8_spanish_ci,
  `solucion` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `examenes_realizados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tiempo_ini` datetime DEFAULT NULL,
  `tiempo_fin` datetime DEFAULT NULL,
  `aciertos` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `comentarios` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `respuestas_alumnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen_realizado` int(11) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `respuesta` text COLLATE utf8_spanish_ci,
  `solucion` text COLLATE utf8_spanish_ci,
  `comentarios` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;