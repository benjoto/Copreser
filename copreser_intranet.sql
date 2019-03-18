-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-08-2018 a las 10:47:42
-- Versión del servidor: 5.6.40
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `copreser_intranet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anula_retiro_en_bodega_log`
--

CREATE TABLE `anula_retiro_en_bodega_log` (
  `id` int(11) NOT NULL,
  `id_retiro_en_bodega` int(65) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anula_retiro_en_bodega_log`
--

INSERT INTO `anula_retiro_en_bodega_log` (`id`, `id_retiro_en_bodega`, `motivo`, `timestamp`) VALUES
(1, 2, '', '2018-05-14 14:00:48'),
(2, 3, 'repetida', '2018-05-16 18:23:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anula_visita_cliente_log`
--

CREATE TABLE `anula_visita_cliente_log` (
  `id` int(11) NOT NULL,
  `id_visita_cliente` int(65) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libreta_de_direcciones`
--

CREATE TABLE `libreta_de_direcciones` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(65) NOT NULL,
  `area` varchar(65) NOT NULL,
  `correo` varchar(65) NOT NULL,
  `anexo` int(3) NOT NULL,
  `celular` varchar(65) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libreta_de_direcciones`
--

INSERT INTO `libreta_de_direcciones` (`id`, `nombre_completo`, `area`, `correo`, `anexo`, `celular`) VALUES
(1, 'MATIAS ESGUEP AGUILAR', 'GERENCIA', 'NESGUEPA@COPRESER.CL', 319, '+56 9 8409 1528'),
(2, 'LUCIANO ARAVENA RIVEROS', 'COMERCIAL', 'LARAVENA@COPRESER.CL', 316, '+56 9 4448 7041'),
(3, 'NICOLAS ESGUEP UBILLA', 'GERENCIA', 'NESGUEP@COPRESER.CL', 330, '+56 9 8807 2941'),
(4, 'VIVIANA AGUILAR ESPINOLA', 'GERENCIA', 'VAGUILAR@COPRESER.CL', 318, '+56 9 8628 5754'),
(5, 'MIGUEL GARRIDO CABRERA', 'ADMINISTRACION', 'MGARRIDO@COPRESER.CL', 0, '+56 9 9792 3534'),
(6, 'CATALINA MEZA CISTERNA', 'PRODUCCION', 'CMEZA@COPRESER.CL', 317, '+56 9 6310 5385'),
(7, 'CLAUDIO ESPINA OYARCE', 'COMERCIAL', 'CESPINA@COPRESER.CL', 309, '+56 9 4423 5736'),
(8, 'DANIEL MALINA POBLETE', 'COMERCIAL', 'DMALINA@COPRESER.CL', 305, '+56 9 4878 2827'),
(9, 'HERNAN GANTES LOPEZ', 'COMERCIAL', 'HGANTES@COPRESER.CL', 307, '+56 9 9555 9058'),
(10, 'EVELYN BOZO', 'COMERCIAL', 'EBOZO@COPRESER.CL', 0, '+56 9 8817 0837'),
(11, 'NANCY ZARATE VERA', 'LOGISTICA', 'NZARATE@COPRESER.CL', 313, '+56 9 4045 5797'),
(12, 'MARISSA LOPEZ PEREIRA', 'ADMINISTRACION', 'MLOPEZ@COPRESER.CL', 0, '+56 9 4045 5796'),
(13, 'ARTURO GUTIERREZ ORTIZ', 'ADMINISTRACION', 'CONTABILIDAD@COPRESER.CL', 0, '+56 9 4698 4076'),
(14, 'JUAN RIVERA', 'LOGISTICA', '', 0, '+56 9 4045 5798'),
(15, 'DAVID LANDA', 'PRODUCCION', '', 0, '+56 9 8589 7783'),
(16, 'SALA DE REUNIONES', '', '', 308, ''),
(17, 'PILAR JALAF NAZAR', 'COMERCIAL', 'PJALAF@COPRESER.CL', 314, '+56 9 3252 9340'),
(18, 'JULIO CANTO QUINTANA', 'PORTERIA', '', 304, '+56 9 9572 8978');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiro_en_bodega`
--

CREATE TABLE `retiro_en_bodega` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(65) NOT NULL,
  `nombre_chofer` varchar(65) NOT NULL,
  `rut_chofer` varchar(65) NOT NULL,
  `patente_vehiculo` varchar(65) NOT NULL,
  `fecha` date NOT NULL,
  `hora_aprox` time NOT NULL,
  `autorizado_por` varchar(65) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `retiro_en_bodega`
--

INSERT INTO `retiro_en_bodega` (`id`, `nombre_empresa`, `nombre_chofer`, `rut_chofer`, `patente_vehiculo`, `fecha`, `hora_aprox`, `autorizado_por`, `timestamp`) VALUES
(1, 'MARIELA FLORES', 'ALEJANDRO ESPINOZA', '10758538-9', 'JFLK76', '2018-05-10', '15:00:00', 'LUCIANO ARAVENA', '2018-05-10 18:04:02'),
(2, 'PEPITO LOS PSLOTES', 'CLSUFIO ESPINA', '1-9', 'DFGH67', '1900-01-01', '16:00:00', 'VIVIANA AGUILAR', '2018-05-14 18:00:48'),
(3, 'ESTEPAZ', 'ALVARO CASTILLO O CRISTIAN VEGA ', '15743141-2     15925051-2', '', '1900-01-01', '15:00:00', 'LUCIANO ARAVENA', '2018-05-16 22:23:39'),
(4, 'MB4', 'OSCAR MORALES', '', '', '2018-05-16', '09:00:00', 'LUCIANO ARAVENA', '2018-05-16 22:05:36'),
(5, 'MB4', 'OSCAR MORALES', '', '', '2018-05-16', '09:00:00', 'LUCIANO ARAVENA', '2018-05-16 22:05:37'),
(6, 'MIGUEL HERNANDEZ', 'MIGUEL HERNANDEZ', '76837746-4', 'PPU CRLT 10', '2018-07-06', '11:00:00', '', '2018-07-05 22:44:55'),
(7, 'MIGUEL HERNANDEZ', 'MIGUEL HERNANDEZ', '13842279-8', 'PPU CRLT 10', '2018-07-06', '10:30:00', 'DANIEL MALINA', '2018-07-06 01:58:20'),
(8, 'MIGUEL HERNANDEZ', 'MIGUEL HERNANDEZ', '13842279-8', 'PPU CRLT 10', '2018-07-07', '11:00:00', 'DANIEL MALINA', '2018-07-06 01:59:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `nombre`, `email`, `password`, `admin`) VALUES
(6, 'NESGUEPA', 'NICOLAS ESGUEP', 'NESGUEP@COPRESER.CL', 'c667d53acd899a97a85de0c201ba99be', 1),
(38, 'MLOPEZ', 'MARISA LOPEZ', 'MLOPEZ@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 0),
(39, 'CESPINA', 'CLAUDIO ESPINA', 'CESPINA@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 1),
(40, 'CMEZA', 'CATALINA MEZA', 'CMEZA@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 1),
(41, 'LARAVENA', 'LUCIANO ARAVENA', 'LARAVENA@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 1),
(42, 'EBOZO', 'EVELIN BOZO', 'EBOZO@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 1),
(43, 'VAGUILAR', 'VIVIANA AGUILAR', 'VAGUILAR@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 1),
(44, 'NZARATE', 'NANCY ZARATE', 'NZARATE@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 1),
(46, 'HGANTES', 'HERNAN GANTES', 'HGANTES@COPRESER.CL', 'd95161d77739c318efb91a470b12d8ff', 1),
(47, 'DMALINA', 'DANIEL MALINA', 'DMALINA@COPRESER.CL', 'bbb5b595836da08258424414c9bdc250', 1),
(49, 'JCANTO', 'JULIO CANTO', '', 'b7adde8a9eec8ce92b5ee0507ce054a4', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita_cliente`
--

CREATE TABLE `visita_cliente` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(65) NOT NULL,
  `nombre_cliente` varchar(65) NOT NULL,
  `rut_cliente` varchar(65) NOT NULL,
  `patente_vehiculo` varchar(65) NOT NULL,
  `fecha` date NOT NULL,
  `ejecutivo_que_visita` varchar(65) NOT NULL,
  `hora_aprox` time NOT NULL,
  `autorizado_por` varchar(65) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visita_cliente`
--

INSERT INTO `visita_cliente` (`id`, `nombre_empresa`, `nombre_cliente`, `rut_cliente`, `patente_vehiculo`, `fecha`, `ejecutivo_que_visita`, `hora_aprox`, `autorizado_por`, `timestamp`) VALUES
(1, 'COPRESER VIÃ±A DEL MAR ', 'omar freire ', '', '', '2018-05-16', 'LUCIANO ARAVENA ', '18:00:00', 'LUCIANO ARAVENA', '2018-05-16 21:44:10'),
(2, 'ALEJANDRO ESPINOZA', 'alejandro espinoza', '', '', '2018-05-17', 'LUCIANO ARAVENA ', '10:00:00', 'LUCIANO ARAVENA', '2018-05-17 13:31:56'),
(3, 'MIGUEL HERNANDEZ', 'MIGUEL HERNANDEZ', '13.842.279-8', 'CRLT 10', '2018-06-08', 'DANIEL MALINA', '14:45:00', 'DANIEL MALINA', '2018-06-08 16:57:54'),
(4, 'ADQUIMICAL', 'ALBERTO CALABI', 'SI RUT', 'SIN DATOS', '2018-06-13', 'DANIEL MALINA', '15:30:00', 'DANIEL MALINA', '2018-06-13 17:23:54'),
(5, 'COMERCIAL FYC  SPA', 'CINCYA URETA', '76.740.323-2', '', '2018-06-15', 'RETIRO DE MERCADERIA', '12:15:00', 'CLAUDIO ESPINA', '2018-06-15 16:05:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anula_retiro_en_bodega_log`
--
ALTER TABLE `anula_retiro_en_bodega_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anula_visita_cliente_log`
--
ALTER TABLE `anula_visita_cliente_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libreta_de_direcciones`
--
ALTER TABLE `libreta_de_direcciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `retiro_en_bodega`
--
ALTER TABLE `retiro_en_bodega`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `visita_cliente`
--
ALTER TABLE `visita_cliente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anula_retiro_en_bodega_log`
--
ALTER TABLE `anula_retiro_en_bodega_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `anula_visita_cliente_log`
--
ALTER TABLE `anula_visita_cliente_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libreta_de_direcciones`
--
ALTER TABLE `libreta_de_direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `retiro_en_bodega`
--
ALTER TABLE `retiro_en_bodega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `visita_cliente`
--
ALTER TABLE `visita_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
