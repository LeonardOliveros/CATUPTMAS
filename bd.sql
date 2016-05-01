-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-02-2016 a las 10:11:11
-- Versión del servidor: 5.5.46-0ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `capsys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `id_ban` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ban` varchar(45) NOT NULL,
  `numero_cuenta_ban` varchar(60) NOT NULL,
  `tipo_cuenta_ban` varchar(20) NOT NULL,
  `monto_ban` double NOT NULL,
  `estado_ban` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_ban`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas_prestamos`
--

CREATE TABLE IF NOT EXISTS `cuotas_prestamos` (
  `id_cuo_pre` int(11) NOT NULL AUTO_INCREMENT,
  `prestamo_cuo_pre` int(11) NOT NULL,
  `numero_cuo_pre` int(2) NOT NULL,
  `fecha_cuo_pre` date NOT NULL,
  `cuota_cuo_pre` double DEFAULT NULL,
  `interes_cuo_pre` double DEFAULT NULL,
  `amortizacion_cuo_pre` double DEFAULT NULL,
  `capital_vivo_cuo_pre` double DEFAULT NULL,
  `estado_cuo_pre` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_cuo_pre`),
  KEY `cuotas_prestamo_prestamos` (`prestamo_cuo_pre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_dep` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_dep` varchar(45) NOT NULL,
  `estado_dep` varchar(10) NOT NULL,
  PRIMARY KEY (`id_dep`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id_eve` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_eve` varchar(45) NOT NULL,
  `fecha_inicio_eve` date NOT NULL,
  `fecha_fin_eve` date NOT NULL,
  `descripcion_eve` varchar(120) NOT NULL,
  `estado_eve` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_eve`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_mov` int(11) NOT NULL AUTO_INCREMENT,
  `socio_mov` int(11) NOT NULL,
  `referencia_mov` varchar(30) NOT NULL,
  `fecha_mov` date NOT NULL,
  `tipo_mov` varchar(21) NOT NULL,
  `forma_mov` varchar(15) NOT NULL,
  `monto_mov` double NOT NULL,
  `nota_mov` varchar(120) NOT NULL,
  `banco_mov` int(11) DEFAULT NULL,
  `estado_mov` varchar(10) NOT NULL,
  PRIMARY KEY (`id_mov`),
  KEY `movimientos_socios` (`socio_mov`),
  KEY `movimientos_bancos` (`banco_mov`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_prestamo`
--

CREATE TABLE IF NOT EXISTS `pagos_prestamo` (
  `id_pag_pre` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento_pag_pre` int(11) NOT NULL,
  `prestamo_pag_pre` int(11) NOT NULL,
  `monto_capital_pag_pre` double NOT NULL,
  `monto_interes_pag_pre` double NOT NULL,
  `monto_total_pag_pre` double NOT NULL,
  `fecha_pag_pre` date NOT NULL,
  PRIMARY KEY (`id_pag_pre`),
  KEY `pagos_prestamo_prestamos` (`prestamo_pag_pre`),
  KEY `pagos_prestamo_movimientos` (`movimiento_pag_pre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(40) NOT NULL,
  `key` varchar(50) NOT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_role`
--

CREATE TABLE IF NOT EXISTS `permisos_role` (
  `role` int(11) NOT NULL,
  `permiso` int(11) NOT NULL,
  `valor` tinyint(4) NOT NULL,
  UNIQUE KEY `id_rol` (`role`,`permiso`),
  KEY `permisos_role_permiso` (`permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_usuario`
--

CREATE TABLE IF NOT EXISTS `permisos_usuario` (
  `usuario` int(5) NOT NULL,
  `permiso` int(5) NOT NULL,
  `valor` tinyint(4) DEFAULT NULL,
  UNIQUE KEY `usuario` (`usuario`,`permiso`),
  KEY `permisos_usuario_permisos` (`permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE IF NOT EXISTS `prestamos` (
  `id_pre` int(11) NOT NULL AUTO_INCREMENT,
  `socio_pre` int(11) NOT NULL,
  `monto_pre` double NOT NULL,
  `plazo_pre` int(2) NOT NULL,
  `interes_pre` double NOT NULL,
  `fecha_solicitud_pre` date NOT NULL,
  `fecha_aprobacion_pre` date NOT NULL,
  `fecha_primer_pago_pre` date NOT NULL,
  `tipo_prestamo_pre` varchar(15) NOT NULL,
  `estado_pre` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pre`),
  KEY `prestamos_socios` (`socio_pre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(40) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE IF NOT EXISTS `socios` (
  `id_soc` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_rif_soc` varchar(10) NOT NULL,
  `apellidos_soc` varchar(45) NOT NULL,
  `nombres_soc` varchar(45) NOT NULL,
  `telefono_soc` varchar(12) NOT NULL,
  `telefono2_soc` varchar(12) NOT NULL,
  `direccion_soc` varchar(45) NOT NULL,
  `departamento_soc` int(11) NOT NULL,
  `sueldo_soc` double DEFAULT NULL,
  `aporte_patrono_soc` double DEFAULT NULL,
  `aporte_socio_soc` double DEFAULT NULL,
  `banco_soc` varchar(40) DEFAULT NULL,
  `tipo_cuenta_soc` varchar(30) DEFAULT NULL,
  `numero_cuenta_soc` varchar(40) DEFAULT NULL,
  `estado_soc` varchar(10) NOT NULL,
  PRIMARY KEY (`id_soc`),
  KEY `socios_departamentos` (`departamento_soc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `role` int(2) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `permiso`, `key`) VALUES
(1, 'Panel Administrativo', 'admin_access'),
(2, 'Registrar Banco', 'nuevo_banco'),
(3, 'Registrar Departamento', 'nuevo_departamento'),
(4, 'Registrar Movimiento', 'nuevo_movimiento'),
(5, 'Registrar Prestamo', 'nuevo_prestamo'),
(6, 'Registrar Socio', 'nuevo_socio'),
(7, 'Registrar Evento', 'nuevo_evento'),
(8, 'Listar Bancos', 'index_banco'),
(9, 'Listar Departamentos', 'index_departamento'),
(10, 'Listar Movimientos', 'index_movimiento'),
(11, 'Listar Prestamos', 'index_prestamo'),
(12, 'Listar Socios', 'index_socio'),
(13, 'Listar Eventos', 'index_evento'),
(14, 'Expedir Estado de Cuenta', 'estado_cuenta'),
(15, 'Reporte de Socios', 'reporte_socios'),
(16, 'Reporte de Movimientos', 'reporte_movimientos'),
(17, 'Reporte de Prestamos', 'reporte_prestamos'),
(18, 'Reporte de Deudores', 'reporte_deudores'),
(19, 'Calcular Amortizaciones', 'calcular_amortizaciones'),
(20, 'Actualizar Pagos', 'actualizar_pagos'),
(21, 'Listar Usuarios', 'index_usuario'),
(22, 'Modificar Banco', 'editar_banco'),
(23, 'Modificar Departamento', 'editar_departamento'),
(24, 'Modificar Movimiento', 'editar_movimiento'),
(25, 'Modificar Prestamo', 'editar_prestamo'),
(26, 'Modificar Socio', 'editar_socio'),
(27, 'Modificar Evento', 'editar_evento'),
(28, 'Consultar Banco', 'ver_banco'),
(29, 'Consultar Departamento', 'ver_departamento'),
(30, 'Consultar Movimiento', 'ver_movimiento'),
(31, 'Consultar Prestramo', 'ver_prestamo'),
(32, 'Consultar Socio', 'ver_socio'),
(33, 'Consultar Evento', 'ver_evento'),
(34, 'Eliminar Banco', 'borrar_banco'),
(35, 'Eliminar Departamento', 'borrar_departamento'),
(36, 'Eliminar Socio', 'borrar_socio'),
(37, 'Eliminar Evento', 'borrar_evento'),
(38, 'Crear Usuario', 'nuevo_usuario'),
(39, 'Eliminar Usuario', 'borrar_usuario'),
(40, 'Generar Estadisticas de Prestamos', 'estadisticas'),
(41, 'Generar Estadisticas de Capital', 'capital'),
(42, 'Reporte de Socios', 'reporte_socios'),
(43, 'Reporte de Prestamos', 'reporte_prestamos'),
(44, 'Reporte de Prestamo 2', 'reporte_prestamo'),
(45, 'Reporte de Movimientos', 'reporte_movimientos'),
(46, 'Reporte de Estado de Cuenta', 'reporte_estado_cuenta'),
(47, 'Reporte de Deudores', 'reporte_deudores');

--
-- Volcado de datos para la tabla `permisos_role`
--

INSERT INTO `permisos_role` (`role`, `permiso`, `valor`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 10, 1),
(1, 11, 1),
(1, 12, 1),
(1, 13, 1),
(1, 14, 1),
(1, 15, 1),
(1, 16, 1),
(1, 17, 1),
(1, 18, 1),
(1, 19, 1),
(1, 20, 1),
(1, 21, 1),
(1, 22, 1),
(1, 23, 1),
(1, 24, 1),
(1, 25, 1),
(1, 26, 1),
(1, 27, 1),
(1, 28, 1),
(1, 29, 1),
(1, 30, 1),
(1, 31, 1),
(1, 32, 1),
(1, 33, 1),
(1, 34, 1),
(1, 35, 1),
(1, 36, 1),
(1, 37, 1),
(1, 38, 1),
(1, 39, 1),
(1, 40, 1),
(1, 41, 1),
(1, 44, 1),
(1, 46, 1),
(2, 1, 0),
(2, 2, 0),
(2, 3, 0),
(2, 4, 0),
(2, 5, 0),
(2, 6, 0),
(2, 7, 0),
(2, 8, 0),
(2, 9, 0),
(2, 10, 0),
(2, 11, 0),
(2, 12, 0),
(2, 13, 0),
(2, 14, 0),
(2, 15, 0),
(2, 16, 0),
(2, 17, 0),
(2, 18, 0),
(2, 19, 0),
(2, 20, 0),
(2, 21, 0);

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Normal');

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `pass`, `role`, `estado`) VALUES
(1, 'Administrador', 'admin', '9ed24a00080cfe8565ddb5c3044b09ee868b1257', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuotas_prestamos`
--
ALTER TABLE `cuotas_prestamos`
  ADD CONSTRAINT `cuotas_prestamo_prestamos` FOREIGN KEY (`prestamo_cuo_pre`) REFERENCES `prestamos` (`id_pre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_bancos` FOREIGN KEY (`banco_mov`) REFERENCES `bancos` (`id_ban`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_socios` FOREIGN KEY (`socio_mov`) REFERENCES `socios` (`id_soc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos_prestamo`
--
ALTER TABLE `pagos_prestamo`
  ADD CONSTRAINT `pagos_prestamo_movimientos` FOREIGN KEY (`movimiento_pag_pre`) REFERENCES `movimientos` (`id_mov`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_prestamo_prestamos` FOREIGN KEY (`prestamo_pag_pre`) REFERENCES `prestamos` (`id_pre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos_role`
--
ALTER TABLE `permisos_role`
  ADD CONSTRAINT `permisos_role_permiso` FOREIGN KEY (`permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_role_roles` FOREIGN KEY (`role`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos_usuario`
--
ALTER TABLE `permisos_usuario`
  ADD CONSTRAINT `permisos_usuario_permisos` FOREIGN KEY (`permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_socios` FOREIGN KEY (`socio_pre`) REFERENCES `socios` (`id_soc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_departamentos` FOREIGN KEY (`departamento_soc`) REFERENCES `departamentos` (`id_dep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_role` FOREIGN KEY (`role`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
