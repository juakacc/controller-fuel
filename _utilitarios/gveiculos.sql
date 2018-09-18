-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2018 at 06:30 PM
-- Server version: 5.7.23
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gveiculos`
--
CREATE DATABASE IF NOT EXISTS `gveiculos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gveiculos`;

-- --------------------------------------------------------

--
-- Table structure for table `abastecimento`
--

CREATE TABLE `abastecimento` (
  `id` int(11) NOT NULL,
  `combustivel` varchar(45) NOT NULL,
  `qtd` double DEFAULT NULL,
  `data` date NOT NULL,
  `competencia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aquisicao`
--

CREATE TABLE `aquisicao` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `competencia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `competencia`
--

CREATE TABLE `competencia` (
  `id` int(11) NOT NULL,
  `veiculo_id` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `metrica_inicial` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conserto`
--

CREATE TABLE `conserto` (
  `id` int(11) NOT NULL,
  `servico` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `competencia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `metrica_inicial` double NOT NULL,
  `veiculo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `peca` varchar(255) NOT NULL,
  `qtd` int(11) NOT NULL,
  `aquisicao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_session_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `chassi` varchar(255) DEFAULT NULL,
  `sem_placa` tinyint(1) NOT NULL,
  `placa` varchar(45) DEFAULT NULL,
  `uf_placa` char(2) NOT NULL DEFAULT 'PB',
  `combustivel_padrao` varchar(20) NOT NULL,
  `tipo_metrica` char(2) NOT NULL DEFAULT 'km'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abastecimento`
--
ALTER TABLE `abastecimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_abastecimento_competencia1_idx` (`competencia_id`);

--
-- Indexes for table `aquisicao`
--
ALTER TABLE `aquisicao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aquisicao_conserto1_idx` (`competencia_id`),
  ADD KEY `conserto_id` (`competencia_id`);

--
-- Indexes for table `competencia`
--
ALTER TABLE `competencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `veiculo_id` (`veiculo_id`,`mes`,`ano`),
  ADD KEY `fk_competencia_veiculo1_idx` (`veiculo_id`);

--
-- Indexes for table `conserto`
--
ALTER TABLE `conserto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conserto_competencia1_idx` (`competencia_id`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `veiculo_id` (`veiculo_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aquisicao_id` (`aquisicao_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abastecimento`
--
ALTER TABLE `abastecimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aquisicao`
--
ALTER TABLE `aquisicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `competencia`
--
ALTER TABLE `competencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `conserto`
--
ALTER TABLE `conserto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `abastecimento`
--
ALTER TABLE `abastecimento`
  ADD CONSTRAINT `fk_abastecimento_competencia1` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aquisicao`
--
ALTER TABLE `aquisicao`
  ADD CONSTRAINT `fk_aquisicao_conserto1` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `competencia`
--
ALTER TABLE `competencia`
  ADD CONSTRAINT `fk_competencia_veiculo1` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conserto`
--
ALTER TABLE `conserto`
  ADD CONSTRAINT `fk_conserto_competencia1` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`aquisicao_id`) REFERENCES `aquisicao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
