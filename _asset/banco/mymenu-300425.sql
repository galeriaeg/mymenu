-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/04/2025 às 19:44
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cardapp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_acesso`
--

CREATE TABLE `t_acesso` (
  `id` int(5) NOT NULL,
  `idCardapio` int(5) NOT NULL,
  `idItem` int(8) NOT NULL,
  `qtde` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_cardapio`
--

CREATE TABLE `t_cardapio` (
  `id` int(5) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `link` text NOT NULL,
  `link_hash` varchar(30) NOT NULL,
  `status` int(2) NOT NULL,
  `idUsuario` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_categoria`
--

CREATE TABLE `t_categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `idCardapio` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_categoria`
--

INSERT INTO `t_categoria` (`id`, `nome`, `status`, `idCardapio`) VALUES
(1, 'Petiscos', 1, 1),
(2, 'Bebidas geladas', 1, 1),
(3, 'Pizzas', 1, 1),
(4, 'Sanduiches', 1, 1),
(5, 'Drinks', 1, 1),
(14, 'Sobremesas', 1, 1),
(15, 'Sushi', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_contrato`
--

CREATE TABLE `t_contrato` (
  `id` int(8) NOT NULL,
  `data_cadastro` varchar(20) NOT NULL,
  `data_pagamento` varchar(20) NOT NULL,
  `data_expira` varchar(20) NOT NULL,
  `id_usuario` int(8) NOT NULL,
  `id_plano` int(3) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_contrato`
--

INSERT INTO `t_contrato` (`id`, `data_cadastro`, `data_pagamento`, `data_expira`, `id_usuario`, `id_plano`, `status`) VALUES
(15, '30/04/2025', '30/04/2025', '', 17, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_customiza`
--

CREATE TABLE `t_customiza` (
  `id` int(6) NOT NULL,
  `idUsuario` int(5) NOT NULL,
  `idCardapio` int(5) NOT NULL,
  `cor_botao` varchar(10) NOT NULL,
  `cor_texto_botao` varchar(10) NOT NULL,
  `cor_barra_botao` varchar(10) NOT NULL,
  `cor_topo` varchar(10) NOT NULL,
  `cor_texto_topo` varchar(10) NOT NULL,
  `cor_preco` varchar(10) NOT NULL,
  `parametro_destaque` int(8) NOT NULL,
  `codigo_path` int(6) NOT NULL,
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_item`
--

CREATE TABLE `t_item` (
  `id` int(8) NOT NULL,
  `cod_item` int(8) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` varchar(7) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `status` int(2) NOT NULL,
  `idCardapio` int(5) NOT NULL,
  `idCategoria` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_item`
--

INSERT INTO `t_item` (`id`, `cod_item`, `titulo`, `descricao`, `preco`, `foto`, `tipo`, `status`, `idCardapio`, `idCategoria`) VALUES
(1, 101, 'Batata frita com molho rosê - 200gm', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '17,50', 'batata.png', 'OFERTA', 1, 1, 1),
(2, 102, 'Bolinhas de queijo - 200gm', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '14,50', 'bolinha-queijo.png', 'NORMAL', 1, 1, 1),
(3, 103, 'Carne de sol com cubos de macaxeira frita', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '29,80', 'carne-sol.png', 'NORMAL', 1, 1, 1),
(4, 0, 'Espetinho de frango - 12g', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '7,50', 'espetinho-frango.png', 'NORMAL', 1, 1, 1),
(5, 0, 'Cerveja Amstel - lata 330ml', 'Cerveja Amstel lata de 330ml puro malte', '5,20', 'cerveja-amstel-lata.png', 'OFERTA', 1, 1, 2),
(6, 0, 'Cerveja Devassa - garrafa 350ml', 'Cerveja Devassa - garrafa 350ml', '6,00', 'cerveja-devassa-350.png', 'NORMAL', 1, 1, 2),
(7, 0, 'Cerveja Devassa 600ml', 'Cerveja Devassa Puro Malte - 600ml', '9,00', 'cerveja-devassa-600.png', 'OFERTA', 1, 1, 2),
(8, 0, 'Cerveja Heineken - Long neck  - 330ml', 'Cerveja Heineken - Long neck - 330ml', '10,00', 'cerveja-heineken-longneck.png', 'NORMAL', 1, 1, 2),
(9, 0, 'Cerveja Spaten Puro Malte - 600ml', 'Cerveja Spaten Puro Malte - 600ml', '12,80', 'cerveja-spaten-600.png', 'NORMAL', 1, 1, 2),
(10, 0, 'Drink Caipirinha de Limão', 'Drink Caipirinha de Limão', '16,80', 'drink-caipirinha.png', 'NORMAL', 1, 1, 5),
(11, 0, 'Drink Caipirosca', 'Drink Caipirosca com vodck', '22,00', 'drink-caipirosca.png', 'NORMAL', 1, 1, 5),
(12, 0, 'Drink Maracujá', 'Drink Maracujá com vodcka', '19,50', 'drink-maracuja.png', 'NORMAL', 1, 1, 5),
(13, 0, 'Drink Morango', 'Drink Morango', '19,50', 'drink-morango.png', 'NORMAL', 1, 1, 5),
(14, 0, 'Espetinho de gado - 120g', 'Espetinho de gado - 120g', '9,50', 'espetinho-gado.png', 'NORMAL', 1, 1, 1),
(15, 0, 'Refrigerante Coca-cola - 2L', 'Refrigerante Coca-cola - 2L', '12,50', 'refri-coca-2l.png', 'NORMAL', 1, 1, 2),
(16, 0, 'Refrigerante Fanta - lata 350ml', 'Refrigerante Fanta - lata 330ml', '5,80', 'refri-fanta-lata.png', 'OFERTA', 1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_links_externos`
--

CREATE TABLE `t_links_externos` (
  `id` int(5) NOT NULL,
  `site` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `blog` varchar(100) NOT NULL,
  `id_cardapio` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_planos`
--

CREATE TABLE `t_planos` (
  `id` int(3) NOT NULL,
  `nome` varchar(24) NOT NULL,
  `preco` varchar(10) NOT NULL,
  `stripe_pay` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_planos`
--

INSERT INTO `t_planos` (`id`, `nome`, `preco`, `stripe_pay`) VALUES
(1, 'Plano My Menu Trimestral', '119.70', 'https://buy.stripe.com/test_cN23fegS28zf7pm3ce'),
(2, 'Plano My Menu Semestral', ' 227.43', ''),
(3, 'Plano My Menu Anual', '430.92', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_token`
--

CREATE TABLE `t_token` (
  `id` int(11) NOT NULL,
  `codigo` int(6) NOT NULL,
  `data_criacao` varchar(20) NOT NULL,
  `id_usuario` int(8) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_token`
--

INSERT INTO `t_token` (`id`, `codigo`, `data_criacao`, `id_usuario`, `status`) VALUES
(12, 328734, '30/04/2025', 17, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_usuario`
--

CREATE TABLE `t_usuario` (
  `id` int(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `data_cadastro` varchar(20) NOT NULL,
  `tipo` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_usuario`
--

INSERT INTO `t_usuario` (`id`, `nome`, `cpf`, `email`, `senha`, `telefone`, `data_cadastro`, `tipo`, `status`) VALUES
(17, 'Francisco Kika Silva', '44166447017', 'kiki@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '85-988965454', '30/04/2025', 2, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `t_acesso`
--
ALTER TABLE `t_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_cardapio`
--
ALTER TABLE `t_cardapio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_categoria`
--
ALTER TABLE `t_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_contrato`
--
ALTER TABLE `t_contrato`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_customiza`
--
ALTER TABLE `t_customiza`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_item`
--
ALTER TABLE `t_item`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_links_externos`
--
ALTER TABLE `t_links_externos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_planos`
--
ALTER TABLE `t_planos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_token`
--
ALTER TABLE `t_token`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `t_acesso`
--
ALTER TABLE `t_acesso`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `t_cardapio`
--
ALTER TABLE `t_cardapio`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `t_categoria`
--
ALTER TABLE `t_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `t_contrato`
--
ALTER TABLE `t_contrato`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `t_customiza`
--
ALTER TABLE `t_customiza`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `t_item`
--
ALTER TABLE `t_item`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `t_links_externos`
--
ALTER TABLE `t_links_externos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `t_planos`
--
ALTER TABLE `t_planos`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `t_token`
--
ALTER TABLE `t_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `t_usuario`
--
ALTER TABLE `t_usuario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
