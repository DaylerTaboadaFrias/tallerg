-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2018 a las 02:06:36
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

  
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `centraldent`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `textColor` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `idvisita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`, `idvisita`) VALUES
(1, 'Cliente: Taboada Frias Nanet', 'Cliente: Taboada Frias Nanet', '#3dc2bc', '#ffffff', '2018-07-20 07:30:00', '2018-07-20 08:30:00', 2),
(4, 'Brackets Alanez sandoval Cliente: Alanez Sandoval Esthefania', 'Brackets Alanez sandoval Cliente: Alanez Sandoval Esthefania', '#3dc2bc', '#ffffff', '2018-07-21 09:00:00', '2018-07-21 10:00:00', 6),
(5, 'Limpieza dental Cliente: Nina Ichota Alvaro', 'Limpieza dental Cliente: Nina Ichota Alvaro', '#3dc2bc', '#ffffff', '2018-07-20 14:30:00', '2018-07-20 15:30:00', 2),
(6, 'Empaste dental Taboada Fras Dayler Cliente: Taboada Frias Dayler', 'Empaste dental Taboada Fras Dayler Cliente: Taboada Frias Dayler', '#3dc2bc', '#ffffff', '2018-07-20 19:30:00', '2018-07-20 20:30:00', 7),
(7, 'Limpieza dental Cliente: Nina Ichota Alvaro', 'Empaste dental Taboada Fras Dayler Cliente: Taboada Frias Dayler', '#3dc2bc', '#ffffff', '2018-07-22 09:30:00', '2018-07-22 10:30:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Endodoncia', 'La endodoncia se utiliza para reparar y salvar su diente o muela en vez de extraerla.'),
(2, 'Diagnostico dental', 'El diagnÃ³stico en odontologÃ­a es la sÃ­ntesis de todos los datos recopilados en la historia clÃ­nica mÃ©dica y odontolÃ³gica, el examen radiogrÃ¡fico y el examen clÃ­nico extra e intraoral.'),
(3, 'Periodoncia', 'La periodoncia es la especialidad que se encarga de prevenir, diagnosticar y tratar las enfermedades que afectan a los tejidos que sirven como base para los dientes.'),
(4, 'Ortodoncia', 'La ortodoncia es una especialidad de la odontologÃ­a que se encarga de la correcciÃ³n de los dientes y huesos posicionados incorrectamente. '),
(5, 'Protesis', 'Las prÃ³tesis dentales son un sustituto artificial de los dientes naturales, fabricadas en materiales acrÃ­licos y resina, plÃ¡sticos especiales y en ocasiones en metales ligeros, y estÃ¡n diseÃ±adas para parecer reales.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE `enfermedad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `simbolo` varchar(4) NOT NULL,
  `idtrabajo` int(11) NOT NULL,
  `idreceta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`id`, `nombre`, `descripcion`, `simbolo`, `idtrabajo`, `idreceta`) VALUES
(1, 'Caries', 'La caries dental es la destruccion del esmalte dental, la capa dura externa de los dientes. Puede ser un problema para jovenes, adolescentes y adultos. La placa, una pelicula pegajosa de bacterias, se forma constantemente en los dientes.', 'H', 2, 1),
(2, 'Periodontitis', 'La periodontitis ocurre cuando se presenta inflamacion o la infeccion de las encias (gingivitis) y no es tratada. La infeccion e inflamacion se diseminan desde las encias (gingiva) hasta los ligamentos y el hueso que sirven de soporte a los dientes. La perdida de soporte hace que los dientes se aflojen y finalmente se caigan.', 'K', 1, 1),
(3, 'Dientes Oscurecidos', 'Sufrir un traumatismo en la boca puede afectar al nervio y los vasos sanguineos del diente. Si la consecuencia es una hemorragia pulpar, el diente se puede volver naranja, marron, gris o negro a medida que pasa el tiempo.', 'O', 5, 1),
(4, 'Piorrea', 'La piorrea o periodontitis es una enfermedad periodontal cronica relativamente comun entre la poblacion. Sin embargo, este hecho no la convierte en inofensiva, ya que en su versiun mas agresiva produce la perdida de los dientes.', 'Q', 8, 1),
(5, 'Sequedad bucal', 'La sequedad bucal es frecuentemente llamada sequedad en la boca. Se produce cuando las glandulas salivales no producen suficiente saliva como para mantener la boca humeda. Dado que la saliva es necesaria para masticar, tragar, saborear y hablar, estas actividades pueden ser mas dificiles con sequedad en la boca.', 'W', 7, 1),
(6, 'Gingivitis', 'La gingivitis es una enfermedad bucal generalmente bacteriana que provoca inflamacion y sangrado de las encias, causada por los restos alimenticios que quedan atrapados entre los dientes.', 'AA', 2, 1),
(7, 'Cancer bucal', 'El cancer bucal se produce en los labios (generalmente, en el inferior), dentro de la boca, en la parte posterior de la garganta, en las amigdalas o en las glandulas salivales. Afecta con mayor frecuencia a los hombres que a las mujeres, y principalmente lo padecen personas mayores de 40. El tabaquismo en combinacion con la ingesta fuerte de alcohol constituye factores claves de riesgo.', 'AF', 7, 1),
(8, 'Halitosis', 'La Halitosis, tambien conocida como mal aliento, se define como el conjunto de olores desagradables que se emiten por la boca. Es un problema que afecta una de cada dos personas.', 'AG', 2, 1),
(9, 'Candidiasis bucal', 'La candidiasis oral esta causada por un hongo llamado candida. La candida siempre esta presente en la flora de la boca, pero no se expande por el control del sistema inmunitario y de bacterias que conforman esta flora oral. Cuando este equilibrio se altera, crece y se forma la infeccion por la candida.', 'AI', 2, 1),
(10, 'Leucoplasia', 'La leucoplasia se presenta en las encias, el interior de las mejillas, la parte inferior de la boca (debajo de la lengua) y, a veces, en la lengua. No suele ser dolorosa y puede pasar desapercibida durante un tiempo.', 'AL', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedadsintoma`
--

CREATE TABLE `enfermedadsintoma` (
  `idenfermedad` int(11) NOT NULL,
  `idsintoma` int(11) NOT NULL,
  `ponderacion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enfermedadsintoma`
--

INSERT INTO `enfermedadsintoma` (`idenfermedad`, `idsintoma`, `ponderacion`) VALUES
(1, 1, 25),
(1, 2, 25),
(1, 3, 10),
(1, 4, 10),
(1, 5, 10),
(1, 6, 10),
(1, 7, 10),
(2, 6, 15),
(2, 8, 30),
(2, 3, 30),
(2, 9, 25),
(3, 3, 25),
(3, 10, 20),
(3, 11, 30),
(3, 12, 25),
(4, 6, 10),
(4, 5, 15),
(4, 9, 30),
(4, 4, 15),
(4, 13, 30),
(5, 14, 15),
(5, 15, 15),
(5, 16, 50),
(5, 4, 10),
(5, 17, 10),
(6, 18, 25),
(6, 6, 15),
(6, 19, 35),
(6, 20, 25),
(7, 21, 25),
(7, 22, 15),
(7, 23, 30),
(7, 24, 30),
(8, 5, 15),
(8, 15, 27),
(8, 17, 29),
(8, 14, 29),
(9, 25, 55),
(9, 14, 25),
(9, 5, 20),
(10, 26, 30),
(10, 27, 35),
(10, 22, 15),
(10, 25, 15),
(10, 14, 5),
(10, 5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `nit` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idtratamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `nit`, `fecha`, `idtratamiento`) VALUES
(1, 354673829, '2018-06-28', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `marca` varchar(15) NOT NULL,
  `medida` varchar(10) NOT NULL,
  `imagen` varchar(70) NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`id`, `nombre`, `marca`, `medida`, `imagen`, `tipo`) VALUES
(1, 'Paracetamol', 'Umbral', '150mg', ' ../Public/Imagen/100073534.jpg', 'Jarabe'),
(2, 'Aspirina', 'Bayer', '150gr', ' ../Public/Imagen/aspirina-500mg-comprimidos.png', 'Tableta'),
(3, 'Diclofenaco', 'MK', '50mg', '../Public/Imagen/diclofenaco.jpg', 'Tableta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentoreceta`
--

CREATE TABLE `medicamentoreceta` (
  `idmedicamento` int(11) NOT NULL,
  `idreceta` int(11) NOT NULL,
  `horafrecuencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicamentoreceta`
--

INSERT INTO `medicamentoreceta` (`idmedicamento`, `idreceta`, `horafrecuencia`) VALUES
(2, 1, 8),
(3, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id` int(11) NOT NULL,
  `recomendacion` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `idtratamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id`, `recomendacion`, `fecha`, `idtratamiento`) VALUES
(1, 'Tomar agua tibia.', '2018-07-13', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sintoma`
--

CREATE TABLE `sintoma` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `simbolo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sintoma`
--

INSERT INTO `sintoma` (`id`, `nombre`, `simbolo`) VALUES
(1, 'Dolor de diente.\r\n', 'A'),
(2, 'Perdida o rotura del diente.\r\n', 'B'),
(3, 'Problemas con el mal aliento.\r\n', 'C'),
(4, 'Sensibilidad dental.\r\n', 'D'),
(5, 'Sangrado al cepillarnos los dientes.\r\n', 'E'),
(6, 'Encias hinchadas o inflamadas.', 'F'),
(7, 'Aparicion de agujeros en los dientes.', 'G'),
(8, 'Pus entre los dientes y las encias.', 'I'),
(9, 'Dolor a la hora de masticar.', 'J'),
(10, 'Hemorragia agudo dentro del diente.', 'L'),
(11, 'Previamente golpe fuerte en un diente.', 'M'),
(12, 'Tonalidad de color de diente distinta al blanco y amarillo.', 'N'),
(13, 'Movilidad de una o varias piezas dentales.', 'P'),
(14, 'Sensacion de boca pegajosa y seca.', 'R'),
(15, 'Lengua seca y aspera.', 'S'),
(16, 'Saliva espesa y viscosa.', 'T'),
(17, 'Gusto desagradable.', 'U'),
(18, 'Encias de aspecto rojizo.', 'X'),
(19, 'Encias que sangran facilmente cuando te cepillas.', 'Y'),
(20, 'Encias retrasadas.', 'Z'),
(21, 'Una llaga en un diente que no cicatriza.', 'AB'),
(22, 'Crecimiento, bulto o engrosamiento de la piel de la boca.', 'AC'),
(23, 'Dolor o rigidez en la mandibula.', 'AD'),
(24, 'Dolor o dificultad para tragar algun alimento.', 'AE'),
(25, 'Aspecto blanco en la lengua.', 'AH'),
(26, 'Parches blancos en la lengua.', 'AJ'),
(27, 'Textura irregular en la parte interna de pomulos.', 'AK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE `trabajo` (
  `id` int(12) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `precio` float NOT NULL,
  `imagen` varchar(70) NOT NULL,
  `idcategoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajo`
--

INSERT INTO `trabajo` (`id`, `nombre`, `precio`, `imagen`, `idcategoria`) VALUES
(1, 'Tratamiento de conducto', 450, '../Public/Imagen/tratamiento-de-conducto-unirradicular-.jpg', 1),
(2, 'Limpieza dental', 100, ' ../Public/Imagen/fluoridprophylaxe.jpg', 3),
(3, 'Bracket', 3500, ' ../Public/Imagen/ortodoncia-825x360.jpg', 4),
(4, 'Protesis removible  de cromo', 1000, ' ../Public/Imagen/DSC03933.JPG', 5),
(5, 'Blanqueamiento', 600, ' ../Public/Imagen/SoJo-Dental-Dentures.jpg', 5),
(6, 'Protesis fija de acrilico', 300, '../Public/Imagen/CliÌnica-Dental-Arancha-.jpg', 5),
(7, 'Consulta dental', 50, '../Public/Imagen/shutterstock_96792142.jpg', 2),
(8, 'Empaste dental', 40, ' ../Public/Imagen/Revisiondental.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajotratamiento`
--

CREATE TABLE `trabajotratamiento` (
  `idtrabajo` int(11) NOT NULL,
  `idtratamiento` int(11) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajotratamiento`
--

INSERT INTO `trabajotratamiento` (`idtrabajo`, `idtratamiento`, `precio`, `cantidad`) VALUES
(2, 2, 100, 1),
(1, 3, 450, 1),
(2, 3, 100, 1),
(3, 4, 3500, 1),
(2, 4, 100, 1),
(8, 5, 40, 1),
(2, 5, 100, 1),
(7, 5, 50, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `montototal` float NOT NULL DEFAULT(0),
  `montopagado` float NOT NULL DEFAULT(0),
  `montoacobrar` float NOT NULL DEFAULT(0),
  `descripcion` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`id`, `fecha`, `montototal`, `montopagado`, `montoacobrar`, `descripcion`, `estado`, `idusuario`) VALUES
(2, '2018-06-28', 100, 0, 100, 'Limpieza dental', 'En proceso', 2),
(3, '2018-07-20', 550, 0, 550, 'Tratamiento de conducto, Limpieza dental', 'En proceso', 2),
(4, '2018-07-20', 3600, 100, 3500, 'Bracket, Limpieza dental', 'En proceso', 3),
(5, '2018-07-20', 190, 100, 90, 'Empaste dental, Consulta dental, Limpieza dental', 'En proceso', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cedula` int(7) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `nit` int(12) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `telefono` int(8) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tipo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `cedula`, `correo`, `password`, `nit`, `sexo`, `telefono`, `foto`, `tipo`) VALUES
(1, 'Nanet', 'Taboada Frias', 7736724, 'nanet@hotmail.com', 'NzczNjcyNA==', 354673829, 'M', 68836930, ' ../Public/Imagen/23736262_1306814656089842_824388478709000717_o.jpg', 'C'),
(2, 'Alvaro', 'Nina Ichota', 7736725, 'alvaro@hotmail.com', 'NzczNjcyNQ==', 736482934, 'M', 74839574, ' ../Public/Imagen/10363362_844160985660428_373995322960483158_n.jpg', 'A'),
(3, 'Esthefania', 'Alanez Sandoval', 7736726, 'esthefania@hotmail.com', 'NzczNjcyNg==', 748592834, 'M', 78656765, ' ../Public/Imagen/28235350_1860323637371506_7257382451386119938_o.jpg', 'C'),
(29, 'Dayler', 'Taboada Frias', 7736727, ' dayler@hotmail.com', 'NzQ1NTM0MjQ=', 743524634, 'M', 75474543, '../Public/Imagen/Dayler Taboada Frias.jpg', 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `pagoadelanto` float DEFAULT NULL,
  `idtratamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visita`
--

INSERT INTO `visita` (`id`, `descripcion`, `pagoadelanto`, `idtratamiento`) VALUES
(2, 'Limpieza dental', 25, 2),
(5, 'Limpieza dental cliente Nina Ichota Alvaro', 0, 2),
(6, 'Brackets Alanez sandoval', 100, 4),
(7, 'Empaste dental Taboada Fras Dayler', 100, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idvisita` (`idvisita`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtrabajo` (`idtrabajo`),
  ADD KEY `idreceta` (`idreceta`);

--
-- Indices de la tabla `enfermedadsintoma`
--
ALTER TABLE `enfermedadsintoma`
  ADD KEY `idenfermedad` (`idenfermedad`),
  ADD KEY `idsintoma` (`idsintoma`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idtratamiento` (`idtratamiento`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentoreceta`
--
ALTER TABLE `medicamentoreceta`
  ADD KEY `idmedicamento` (`idmedicamento`,`idreceta`),
  ADD KEY `idreceta` (`idreceta`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtratamiento` (`idtratamiento`);

--
-- Indices de la tabla `sintoma`
--
ALTER TABLE `sintoma`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `trabajotratamiento`
--
ALTER TABLE `trabajotratamiento`
  ADD KEY `idtrabajo` (`idtrabajo`,`idtratamiento`),
  ADD KEY `idtratamiento` (`idtratamiento`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtratamiento` (`idtratamiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sintoma`
--
ALTER TABLE `sintoma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`idvisita`) REFERENCES `visita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD CONSTRAINT `enfermedad_ibfk_1` FOREIGN KEY (`idreceta`) REFERENCES `receta` (`id`),
  ADD CONSTRAINT `enfermedad_ibfk_2` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajo` (`id`);

--
-- Filtros para la tabla `enfermedadsintoma`
--
ALTER TABLE `enfermedadsintoma`
  ADD CONSTRAINT `enfermedadsintoma_ibfk_1` FOREIGN KEY (`idenfermedad`) REFERENCES `enfermedad` (`id`),
  ADD CONSTRAINT `enfermedadsintoma_ibfk_2` FOREIGN KEY (`idsintoma`) REFERENCES `sintoma` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicamentoreceta`
--
ALTER TABLE `medicamentoreceta`
  ADD CONSTRAINT `medicamentoreceta_ibfk_1` FOREIGN KEY (`idreceta`) REFERENCES `receta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicamentoreceta_ibfk_2` FOREIGN KEY (`idmedicamento`) REFERENCES `medicamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD CONSTRAINT `trabajo_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `trabajotratamiento`
--
ALTER TABLE `trabajotratamiento`
  ADD CONSTRAINT `trabajotratamiento_ibfk_1` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trabajotratamiento_ibfk_2` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD CONSTRAINT `tratamiento_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
