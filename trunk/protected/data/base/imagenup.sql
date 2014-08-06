-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-08-2014 a las 22:53:44
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `imagenup`
--
CREATE DATABASE IF NOT EXISTS `imagenup` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `imagenup`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `codigo_verificacion` varchar(128) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Truncar tablas antes de insertar `tbl_user`
--

TRUNCATE TABLE `tbl_user`;
--
-- Volcado de datos para la tabla `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `email`, `codigo_verificacion`, `activo`) VALUES
(1, 'test1', 'pass1', 'test1@example.com', '1234567890', 1),
(2, 'cristian', '1003889613', 'cristian@hotmail.com', '1', 0),
(3, 'jorge', 'djsistemas', 'jorge@hotmail.com', '265f294f24c5e66d1a106f237dab2d54190c2a12', 0),
(4, 'rodrigo', 'djsistemas', 'rodrigo@hotmail.com', '671c1e6fbe2c84faf306c3220ab461c840997300', 0),
(18, 'cristian araque', 'djsistemas', 'cris_tian8916@hotmail.com', '978e4a25d601ec948258784ef8c2927a361548b7', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
