-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2020 at 03:12 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escuela`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(25) NOT NULL,
  `legajo` int(50) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `id_mod` int(5) NOT NULL,
  `cursos_id` int(10) UNSIGNED NOT NULL,
  `usuarios_id_admin` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `legajo`, `nombre`, `apellido`, `email`, `id_mod`, `cursos_id`, `usuarios_id_admin`) VALUES
(33, 5555, 'Axel', 'Rose', 'axelrose@gmail.com', 1, 121, 1),
(35, 5217, 'Berenice', 'Basualdo', 'berebasualdo@gmail.com', 1, 311, 1),
(36, 4152, 'Bruce', 'Wayne', 'batman@gmail.com', 0, 232, 1),
(37, 5214, 'Alfred', 'Pennyworth', 'alfredmayordomo@gmail.com', 0, 332, 1),
(42, 1037, 'Maria Delia', 'Alonso', 'mariadelia@gmail.com', 1, 221, 1),
(43, 5412, 'Jane', 'Doe', 'janedoe@gmail.com', 0, 222, 1),
(44, 5632, 'Joe', 'Doe', 'jonedoe@gmail.com', 0, 322, 1);

-- --------------------------------------------------------

--
-- Table structure for table `carreras`
--

CREATE TABLE `carreras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_carrera` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carreras`
--

INSERT INTO `carreras` (`id`, `nombre_carrera`) VALUES
(1, 'Analisis Funcional'),
(2, 'Desarrollo de Software'),
(3, 'Infraestructura de Tecnologia');

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_curso` varchar(45) NOT NULL,
  `carreras_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `nombre_curso`, `carreras_id`) VALUES
(111, 'AF11', 1),
(112, 'AF12', 1),
(121, 'AF21', 1),
(122, 'AF22', 1),
(131, 'AF31', 1),
(132, 'AF32', 1),
(211, 'DS11', 2),
(212, 'DS12', 2),
(221, 'DS21', 2),
(222, 'DS22', 2),
(231, 'DS31', 2),
(232, 'DS32', 2),
(311, 'ITI11', 3),
(312, 'ITI12', 3),
(321, 'ITI21', 3),
(322, 'ITI22', 3),
(331, 'ITI31', 3),
(332, 'ITI32', 3);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_admin` int(5) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_admin`, `usuario`, `clave`, `nombre`, `apellido`) VALUES
(1, 'admin', '$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO', 'Fulano', 'de Tal'),
(6, 'admin3', '$2y$10$QSWsjoDlv7cPlhyigDZDCu6TtXY/rTQJ.1OdVnMZlxeHnGIi1jeVy', 'Mengano', 'de Tal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `fk_alumnos_cursos` (`cursos_id`),
  ADD KEY `fk_alumnos_usuarios1` (`usuarios_id_admin`);

--
-- Indexes for table `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cursos_carreras1` (`carreras_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumnos_cursos` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumnos_usuarios1` FOREIGN KEY (`usuarios_id_admin`) REFERENCES `usuarios` (`id_admin`) ON UPDATE CASCADE;

--
-- Constraints for table `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_carreras1` FOREIGN KEY (`carreras_id`) REFERENCES `carreras` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
