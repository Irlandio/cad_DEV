-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jan-2021 às 18:36
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wda_crud`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ceps`
--

CREATE TABLE `ceps` (
  `id` int(11) NOT NULL,
  `cepOrig` varchar(10) NOT NULL,
  `cepDest` varchar(10) NOT NULL,
  `dist` float(10,2) NOT NULL,
  `criado` datetime NOT NULL,
  `modificado` datetime NOT NULL,
  `endOrig` varchar(100) NOT NULL,
  `endDest` varchar(100) NOT NULL,
  `latO` float(10,2) NOT NULL,
  `longO` float(10,2) NOT NULL,
  `latD` float(10,2) NOT NULL,
  `longD` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ceps`
--

INSERT INTO `ceps` (`id`, `cepOrig`, `cepDest`, `dist`, `criado`, `modificado`, `endOrig`, `endDest`, `latO`, `longO`, `latD`, `longD`) VALUES
(1, '89030055', '89030310', 0.99, '2020-12-29 12:20:00', '2021-01-04 15:35:48', 'R. Sï¿½o Paulo, Victor Konder, Blumenau - SC', 'Rua Kernel, Blumenau-SC', -26.89, -49.08, -26.89, -49.09),
(2, '89030000', '05001000', 443.35, '2020-12-29 12:29:00', '2020-12-31 17:28:22', 'R. São Paulo, Itoupava Seca, Blumenau - SC', 'Av. Francisco Matarazzo, Água Branca, São Paulo - SP', -26.89, -49.08, -23.53, -46.67),
(3, '30150281', '89030310', 943.28, '2020-12-30 12:44:45', '2021-01-04 15:35:09', 'Av. Bernardo Monteiro, Santa Efigï¿½nia, Belo Horizonte - MG', 'Rua Gustavo Salinger, Itoupava Seca Blumenal-SC', -19.93, -43.93, -26.89, -49.09),
(6, '89030400', '05001000', 428.11, '2021-01-02 19:24:07', '2021-01-04 15:35:25', 'Rua Coronel Feddersen, Blumenau-SC', 'Av. Francisco Matarazzo, ï¿½gua Branca, Sï¿½o Paulo - SP', -26.73, -49.07, -23.53, -46.67);

-- --------------------------------------------------------


--
-- Indexes for table `ceps`
--
ALTER TABLE `ceps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ceps`
--
ALTER TABLE `ceps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
