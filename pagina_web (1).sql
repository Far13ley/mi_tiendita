-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2024 a las 03:31:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pagina_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Producto` varchar(50) NOT NULL,
  `Precio` int(50) NOT NULL,
  `Otro` varchar(50) NOT NULL,
  `Imagenes` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Producto`, `Precio`, `Otro`, `Imagenes`, `id`) VALUES
('Principe', 10, '2x18', 'pri.jpeg', 6),
('Triki Trakes', 10, '2x18', 'tri.jpeg', 7),
('Barritas de Fresa', 6, 'Promo los viernes', 'bar f.jpeg', 8),
('Barritas de piña', 6, 'Promo los viernes', 'bar p.jpeg', 9),
('Barritas de mora', 6, 'Promo los viernes', 'bar m.jpeg', 10),
('Ice mora', 15, 'Pocas piezas', 'ice a.jpeg', 11),
('Ice cereza', 15, 'Pocas piezas', 'ice r.jpeg', 12),
('Bombones de chocolate', 12, '', 'bom.jpeg', 13),
('Mantecadas', 15, 'Producto muy vendido', 'man.jpeg', 14),
('Nitos', 15, 'Producto muy vendido', 'nit.jpeg', 15),
('Cacahuates', 8, 'Hot nust piratas', 'cac.jpeg', 16),
('Skwinkles', 12, 'Promocion los viernes', 'skw.jpeg', 17),
('Gomitas Pingüinos', 10, 'Preparados', 'gom p.jpeg', 18),
('Gomitas Lombriz', 10, 'Preparados', 'gom l.jpeg', 19),
('Gomitas Frutitas', 10, 'Preparados', 'gom f.jpeg', 20),
('Takis', 16, 'Producto muy vendido', 'ice r.jpeg', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `rol` varchar(20) DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `clave`, `rol`) VALUES
(1, 'Vania Nuñez', 'steph.fahey13@gmail.com', '$2y$10$CgOi6kIQ59efypRThHIVu.ibsOkhNB2qn03wNqb473QdH2FFc4H9e', 'admin'),
(2, 'Maria Perez', 'tetrt@gmail.com', '$2y$10$Xh/zwluCZ7qTzlLcWbwFyOzV7OadT4AdcaLqEXWSpCpK8ikMlqKrK', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
