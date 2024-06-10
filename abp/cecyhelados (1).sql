-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2024 a las 06:54:36
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
-- Base de datos: `cecyhelados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `card_number`, `cvv`, `card_type`, `password`) VALUES
(6, 'Norma', 'normaval@gmail.com', 'xsxqsxsq', '2131232312312312', '1111', 'MasterCard', '$2y$10$Sr4QdGGypvAKB41T3uY//eskMO62onAQNyRSEDntq2koRCDwcfiBC'),
(7, 'goku', 'loco@gmail.com', 'sdsdassd', '2132323123123132', '3213', 'Amex', '$2y$10$msHcGM3OZzJu7/9q7m.f9.tbO2yi7A2yvF4VDz9CDu..qEGaGUVUe'),
(8, 'alejandro reyes', 'resc071002hmcynsa7@soycecytem.mx', 'cda 21 de marzo 20', '7866878979787564', '2567', 'Visa', '$2y$10$VeE7Vd3BSR3sv5eWq9/IxejYA7ujGYX155EjUuRWZy80IC1SLHmGW'),
(9, 'cesar', 'goku95@gmail.com', 'cda 21 de marzo 20', '7866878979787564', '2567', 'Visa', '$2y$10$BDKXTYn2u8vwXRH5YqqAveC.TJgQXNYl5aLRCeqSnz4sUE1nOllRC'),
(11, 'leon', 'loca@gmail.com', 'cda 21 de marzo 20', '7866878979787564', '2567', 'Visa', '$2y$10$Yc3qwHbWnNylLCL5edXPNue1YvXfgrErsqGTDKnixE94PZvVavkKK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
