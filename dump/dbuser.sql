-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2023 a las 11:11:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbuser`
--

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log`
(
    `id`  int(11)      NOT NULL,
    `log` varchar(240) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios`
(
    `id`         int(11)      NOT NULL,
    `email`      varchar(150) NOT NULL,
    `password`   varchar(240) NOT NULL,
    `telefono`   varchar(12)  NOT NULL,
    `nombre`     varchar(200) NOT NULL,
    `imagen`     varchar(200) DEFAULT NULL,
    `disponible` tinyint(1)   NOT NULL,
    `token`      varchar(240) DEFAULT NULL,
    `admin`      boolean      DEFAULT 0
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;