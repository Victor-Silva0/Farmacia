-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/10/2023 às 23:43
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbfarmatech`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `celular` varchar(16) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES
(1, 'Rafael Fernandes de Melo Lopes', '18981628848', 'rafael_lopes51@hotmail.com'),
(2, 'Victor Amaral', '18999999999', 'victor@hotmail.com'),
(3, 'Breno', '18999999999', 'breno@hotmail.com'),
(4, 'Pedro', '18976548888', 'pedro@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `conteudo` varchar(50) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `imagem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `imagem`) VALUES
(1, 'Dipirona Monoidratada 500mg/ml Solução Gotas 10ml EMS Genérico', 'EMS', '10ml', 5.39, 'dipirona.png'),
(2, 'Novalgina Solução Oral Analgésico e Antitérmico Infantil 100ml', 'Novalgina', '100ml', 40.19, 'novalgina.png'),
(3, 'Antialérgico Allegra Pediátrico 6mg/ml Suspensão Oral 60ml com Seringa', 'Allegra', '60ml', 37.68, 'allegra.png'),
(4, 'Vick VapoRub Descongestionante Pomada 12g', 'Vick', '12g', 14.29, 'vick.png'),
(5, 'Solução Fisiológica 0,9% Needs 500ml', 'Needs', '500ml', 7.99, 'sorofisiologico.png'),

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_da_venda`
--

CREATE TABLE `produtos_da_venda` (
  `idVenda` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos_da_venda`
--

INSERT INTO `produtos_da_venda` (`idVenda`, `idProduto`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nome`, `email`, `senha`) VALUES
(1, 'teste', 'teste@teste.com', '123456');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `idVenda` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `dhVenda` timestamp NULL DEFAULT current_timestamp(),
  `valor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`idVenda`, `idCliente`, `dhVenda`, `valor`) VALUES
(1, 1, '0000-00-00 00:00:00', 100),
(2, 2, '0000-00-00 00:00:00', 200);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices de tabela `produtos_da_venda`
--
ALTER TABLE `produtos_da_venda`
  ADD PRIMARY KEY (`idVenda`,`idProduto`),
  ADD KEY `fk_produtos_da_venda_produtos1_idx` (`idProduto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idVenda`),
  ADD KEY `fk_vendas_clientes1_idx` (`idCliente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produtos_da_venda`
--
ALTER TABLE `produtos_da_venda`
  ADD CONSTRAINT `fk_produtos_da_venda_produtos1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_da_venda_vendas1` FOREIGN KEY (`idVenda`) REFERENCES `vendas` (`idVenda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_vendas_clientes1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
