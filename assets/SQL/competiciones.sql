-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2024 a las 15:41:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `competiciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listado`
--

CREATE TABLE `listado` (
  `Modalidad` varchar(40) NOT NULL,
  `Competicion` varchar(500) NOT NULL,
  `Categoria` varchar(30) NOT NULL,
  `Distancia` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listado`
--

INSERT INTO `listado` (`Modalidad`, `Competicion`, `Categoria`, `Distancia`, `fecha`) VALUES
('Triatlon', 'Triatlón Ciudad del Puerto', 'Adultos', 'Sprint', '2024-05-10'),
('Duatlon', 'Duatlón Juvenil', 'Menores', 'Corta', '2024-06-15'),
('Triatlon Cros', 'Triatlón Cross Rural', 'Adultos', 'Olimpica', '2024-07-20'),
('Acuatlon', 'Acuatlón Junior', 'Menores', 'Supersprint', '2024-08-05'),
('Duatlon Cros', 'Duatlón Cross Kids', 'Menores', 'Corta', '2024-11-25'),
('Triatlon Cros', 'Triatlón Cross Mountain', 'Adultos', 'Sprint', '2024-12-02'),
('Triatlon Cros', 'Triatlon Prueba', 'Adultos', 'Sprint', '2024-10-17'),
('Triatlon Cros', 'Triatlon Calima Posadas', 'Adultos', 'Media Distancia', '2024-09-18'),
('Acuatlon', 'Campeonato de Europa de Acuatlon', 'Adultos', 'Olimpica', '2024-04-12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
