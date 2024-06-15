-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2024 a las 18:50:03
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
-- Base de datos: `el_punto_de_hierro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_cliente`, `id_producto`, `fecha`) VALUES
(11, 2, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `nivel` int(11) NOT NULL DEFAULT 0 COMMENT '1=verificado,2=empleado,3=admin\r\n',
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '0=suspendido\r\n1=activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `correo`, `contrasena`, `telefono`, `direccion`, `nivel`, `estado`) VALUES
(2, 'Misa', 'misa@gmail.com', '$2y$10$8CtdROv.JHdrI53OFnyK2eiNLw56lBpcytVVH/xHnoQR/Ftbg9zS6', 987654321, 'calle A-2', 3, 1),
(8, 'misa212', 'mijaelcriales2003@gmail.com', '$2y$10$UniuvyBbX05DixlmcFDmuOquK0aJXl.xSBKOS2XjsTNp85SwWg5tS', 987654321, 'calle A-2', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `comentario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_venta`, `cantidad`, `total`, `comentario`) VALUES
(2, 4, 3.00, 162.30, NULL),
(3, 5, 4.00, 56.80, NULL),
(4, 6, 3.00, 42.60, NULL),
(5, 7, 6.00, 324.60, NULL),
(6, 8, 2.00, 28.40, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre_emp` varchar(200) NOT NULL,
  `dni` int(8) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre_emp`, `dni`, `id_usuario`) VALUES
(1, 'Misa . .', 60234124, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `id_medida` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `simple` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`id_medida`, `nombre`, `simple`) VALUES
(1, 'Unidad', 'Und'),
(2, 'Metros', 'Mt'),
(3, 'Kilogramo', 'Kg'),
(4, 'Litros', 'Lt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_prod` varchar(150) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `medida` int(5) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '1=mostrado\r\n0=no mostrado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_prod`, `descripcion`, `medida`, `imagen`, `precio`, `stock`, `estado`) VALUES
(1, 'misa', 'hola', 2, 'producto/images/images.jpeg', 50.10, 10, 0),
(2, 'producto_2', 'bueno', 4, 'producto/images/Megumin [Konosuba] (1080x1920).jfif', 14.20, 50, 0),
(3, 'Martillo de Carpintero', 'Martillo de carpintero con mango de madera, cabeza de acero.', 1, 'producto/images/martillo carpintero.jpg', 15.00, 50, 1),
(4, 'Destornillador de Punta Plana', 'Destornillador de punta plana, mango ergonÃ³mico.', 1, 'producto/images/Destornillador de Punta Plana.webp', 5.00, 50, 1),
(5, 'Alicates Universales', 'Alicates universales, acero inoxidable.', 1, 'producto/images/Alicates Universales.webp', 10.00, 50, 1),
(6, 'Llave Ajustable (loro)', 'Llave ajustable de 12 pulgadas.', 1, 'producto/images/Llave Ajustable.webp', 20.00, 50, 1),
(7, 'Llave Ajustable (loro)', 'Llave ajustable de 12 pulgadas.', 1, 'producto/images/Llave Ajustable2.png', 25.00, 50, 1),
(8, 'Taladro Eléctrico', 'Taladro Eléctrico de 500W, con velocidad variable.', 1, 'producto/images/Taladro Eléctrico.jpg', 70.00, 50, 1),
(9, 'Taladro Eléctrico A', 'Taladro Eléctrico de 450W, con velocidad variable.', 1, 'producto/images/Taladro Eléctrico2.webp', 60.00, 50, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_cliente`, `id_producto`, `fecha`) VALUES
(3, 2, 1, '2024-06-10 15:04:04'),
(4, 2, 1, '2024-06-08 15:05:22'),
(5, 2, 2, '2024-06-11 23:23:36'),
(6, 8, 2, '2024-06-12 22:32:57'),
(7, 8, 1, '2024-06-12 22:35:49'),
(8, 8, 2, '2024-06-12 22:41:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificar_correo`
--

CREATE TABLE `verificar_correo` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `token` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `verificar_correo`
--

INSERT INTO `verificar_correo` (`id`, `id_cliente`, `correo`, `token`, `fecha`) VALUES
(6, 8, 'mijaelcriales2003@gmail.com', '1ee2a32244812168ae01dbf290764093a081ca1095aa78d24c2019e7fb70f4e245997c9264776280264ca6166ed3062f71f0', '2024-06-07 20:09:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`) USING BTREE,
  ADD KEY `fk_detalle` (`id_venta`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`id_medida`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `medida` (`medida`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- Indices de la tabla `verificar_correo`
--
ALTER TABLE `verificar_correo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `verificar_correo`
--
ALTER TABLE `verificar_correo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`medida`) REFERENCES `medida` (`id_medida`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
