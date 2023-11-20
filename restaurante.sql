-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/11/2023 às 19:17
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `restaurante`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `amizades`
--

CREATE TABLE `amizades` (
  `id_amizades` int(11) NOT NULL,
  `usuario_seguiu` int(11) NOT NULL,
  `usuario_seguindo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `amizades`
--

INSERT INTO `amizades` (`id_amizades`, `usuario_seguiu`, `usuario_seguindo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id_curtidas` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagens`
--

CREATE TABLE `postagens` (
  `id_post` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `data_post` datetime NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `postagens`
--

INSERT INTO `postagens` (`id_post`, `usuario`, `comentario`, `data_post`, `foto`) VALUES
(1, 5, 'risotinho gostosinho', '2023-11-18 14:11:30', ''),
(2, 2, '', '2023-11-18 14:18:48', ''),
(3, 2, 'fffffffff', '2023-11-18 14:28:15', ''),
(4, 2, 'knojnjnhb', '2023-11-18 14:51:01', ''),
(5, 5, 'laakakakakkaa', '2023-11-18 14:51:54', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(450) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `data_nascimento` date NOT NULL,
  `informacoes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `data_nascimento`, `informacoes`) VALUES
(1, 'Professor Culinario', 'professor@gmail.com', 'professor123', '2000-04-04', 'Sou Professor e Gosto de comer, um churrasquinho então hmmmmmm'),
(2, 'teste', 'teste@gmail.com', '123', '2000-01-01', 'testes testes'),
(3, 'Amigo', 'amigo@gmail.com', 'amigo', '1998-08-29', 'Testar Os Amigos'),
(5, 'mateus silva freitas', 'teteu.sf01@gmail.com', '1234', '2001-02-16', 'eu gosto de comer');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `amizades`
--
ALTER TABLE `amizades`
  ADD PRIMARY KEY (`id_amizades`),
  ADD UNIQUE KEY `usuario_seguiu` (`usuario_seguiu`),
  ADD UNIQUE KEY `usuario_seguindo` (`usuario_seguindo`);

--
-- Índices de tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`id_curtidas`),
  ADD KEY `curtidas_post_fk` (`post`),
  ADD KEY `curtidas_usuario_fk` (`usuario`);

--
-- Índices de tabela `postagens`
--
ALTER TABLE `postagens`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `senha` (`senha`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `amizades`
--
ALTER TABLE `amizades`
  MODIFY `id_amizades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id_curtidas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagens`
--
ALTER TABLE `postagens`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `amizades`
--
ALTER TABLE `amizades`
  ADD CONSTRAINT `Fk_usu_seguindo` FOREIGN KEY (`usuario_seguindo`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `Fk_usu_seguiu` FOREIGN KEY (`usuario_seguiu`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_post_fk` FOREIGN KEY (`post`) REFERENCES `postagens` (`id_post`),
  ADD CONSTRAINT `curtidas_usuario_fk` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `postagens`
--
ALTER TABLE `postagens`
  ADD CONSTRAINT `postagens_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
