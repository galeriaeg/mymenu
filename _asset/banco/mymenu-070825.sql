-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/08/2025 às 00:59
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

--
-- Despejando dados para a tabela `t_acesso`
--

INSERT INTO `t_acesso` (`id`, `idCardapio`, `idItem`, `qtde`) VALUES
(34, 0, 36, 4),
(35, 0, 38, 2),
(36, 0, 37, 2),
(37, 0, 39, 2),
(38, 0, 40, 1),
(39, 0, 41, 1);

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

--
-- Despejando dados para a tabela `t_cardapio`
--

INSERT INTO `t_cardapio` (`id`, `titulo`, `logo`, `link`, `link_hash`, `status`, `idUsuario`) VALUES
(29, 'Restaurante Fogo Vivo', '1617010653-logo-fogo-vivo.png', 'home?crd=Mjk=', 'Mjk=', 1, 19);

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
(54, 'Bebidas', 1, 29),
(64, 'Caldos', 1, 29),
(65, 'Café', 1, 29);

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
(17, '06/05/2025 11:37:49', '10/05/2025 14:40:58', '10/08/2025', 19, 1, 1);

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

--
-- Despejando dados para a tabela `t_customiza`
--

INSERT INTO `t_customiza` (`id`, `idUsuario`, `idCardapio`, `cor_botao`, `cor_texto_botao`, `cor_barra_botao`, `cor_topo`, `cor_texto_topo`, `cor_preco`, `parametro_destaque`, `codigo_path`, `tipo`) VALUES
(23, 19, 29, '#e5e7ea', '#666666', '#d3d7db', '#cbd0d5', '#333333', '#333333', 0, 849542, 2);

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
  `foto_bd` varchar(5) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `status` int(2) NOT NULL,
  `idCardapio` int(5) NOT NULL,
  `idCategoria` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_item`
--

INSERT INTO `t_item` (`id`, `cod_item`, `titulo`, `descricao`, `preco`, `foto`, `foto_bd`, `tipo`, `status`, `idCardapio`, `idCategoria`) VALUES
(36, 1, 'Caldo de carne', 'Caldo de carne com torradas', '9,00', '', '4.28', 'NORMAL', 1, 29, 64),
(37, 2, 'Caldo de caridade', 'Caldo de caridade com torradas', '7,50', '', '4.27', 'NORMAL', 1, 29, 64),
(38, 3, 'Água com gás', 'Água com gás 500ml', '2,20', '', '1.17', 'NORMAL', 1, 29, 54),
(39, 4, 'Água de coco', 'Água de coco gelada', '5,00', '', '1.69', 'NORMAL', 1, 29, 54),
(40, 5, 'Café com leite', 'Café com leite', '8,50', '', '3.23', 'NORMAL', 1, 29, 65),
(41, 6, 'Teste novo', 'Teste novo', '3,60', '', '6.35', 'NORMAL', 1, 29, 54),
(42, 7, 'Teste laptop', 'teste legenda', '1.200,0', '797834-img-teste.jpg', '', 'NORMAL', 1, 29, 54);

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

--
-- Despejando dados para a tabela `t_links_externos`
--

INSERT INTO `t_links_externos` (`id`, `site`, `instagram`, `facebook`, `blog`, `id_cardapio`) VALUES
(13, 'https://www.fogovivo.com/', 'https://www.instagram.com/paulinhogrilloficial/', 'https://www.facebook.com/', 'NULL', 29);

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_mymenu_categoria`
--

CREATE TABLE `t_mymenu_categoria` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_mymenu_categoria`
--

INSERT INTO `t_mymenu_categoria` (`id`, `nome`) VALUES
(1, 'ÁGUA'),
(2, 'BOLO'),
(3, 'CAFÉ'),
(4, 'CALDO E SOPA'),
(5, 'CERVEJA'),
(6, 'SOBREMESA'),
(7, 'DRINK'),
(8, 'ENTRADA'),
(9, 'ESPETINHO'),
(10, 'PASTEL'),
(11, 'PETISCO'),
(12, 'PIZZA'),
(13, 'REFRIGERANTE'),
(14, 'SALGADO'),
(15, 'SANDUíCHE'),
(16, 'SOBREMESA'),
(17, 'SOPA'),
(18, 'SUCO'),
(19, 'TORTA'),
(20, 'VITAMINA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_mymenu_files`
--

CREATE TABLE `t_mymenu_files` (
  `id` int(5) NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_mymenu_files`
--

INSERT INTO `t_mymenu_files` (`id`, `imagem`, `categoria`) VALUES
(1, '835608-cerveja-amstel-600.png', '5'),
(2, '757480-cerveja-amstel-lata-350.png', '5'),
(3, '607596-cerveja-amstel-lata-473.png', '5'),
(4, '506946-cerveja-devassa-600.png', '5'),
(5, '296219-cerveja-devassa-350.png', '5'),
(6, '224919-cerveja-devassa-lata-350.png', '5'),
(7, '772859-cerveja-spaten-600.png', '5'),
(8, '182396-cerveja-spaten-longneck-355.png', '5'),
(9, '259405-cerveja-spaten-269.png', '5'),
(10, '791609-cerveja-spaten-350.png', '5'),
(11, '631139-cerveja-heineken-longneck.png', '5'),
(12, '324630-cerveja-heineken-600.png', '5'),
(13, '411238-cerveja-heineken-350.png', '5'),
(14, '880068-cerveja-heineken-269.png', '5'),
(15, '886973-cerveja-heineken-350-zero.png', '5'),
(16, '958256-agua-500ml.png', '1'),
(17, '674866-agua-com-gas-500ml.png', '1'),
(18, '229216-bolo-chocolate.png', '2'),
(19, '808311-bolo-fofo.png', '2'),
(20, '112083-bolo-luiz-felipe.png', '2'),
(21, '482577-bolo-milho.png', '2'),
(22, '945833-cafezinho-preto.png', '3'),
(23, '645233-cafezinho-com-leite.png', '3'),
(24, '331061-cafezinho-chantilly.png', '3'),
(25, '503543-capuccino.png', '3'),
(26, '133330-frape-cafe.png', '3'),
(27, '916544-caldo-caridade.png', '4'),
(28, '615523-caldo-carne.png', '4'),
(29, '311180-caldo-carne2.png', '4'),
(30, '167869-caldo-mocoto.png', '4'),
(31, '906781-caldo-mocoto2.png', '4'),
(32, '235753-caldo-peixe.png', '4'),
(33, '766987-canja.png', '4'),
(34, '955464-sopa-legumes.png', '4'),
(35, '474313-brownie.png', '6'),
(36, '369955-pudim.png', '6'),
(37, '685663-pudim-fatia.png', '6'),
(38, '883597-rocambole.png', '6'),
(39, '466063-torta-limao.png', '6'),
(40, '238157-drink-caipirinha.png', '7'),
(41, '666767-drink-caipirosca.png', '7'),
(42, '613036-drink-maracuja.png', '7'),
(43, '377283-drink-morango.png', '7'),
(44, '744192-cerveja-antarctica-600.png', '5'),
(45, '291238-cerveja-antarctica-lata-350.png', '5'),
(46, '637852-cerveja-antarctica-lata-473.png', '5'),
(47, '563319-cerveja-antarctica-original-600.png', '5'),
(48, '771247-cerveja-antarctica-original-lata-350.png', '5'),
(49, '339727-cerveja-antarctica-original-lata-473.png', '5'),
(50, '278520-cerveja-budweiser-600.png', '5'),
(51, '651301-cerveja-budweiser-longneck-330.png', '5'),
(52, '229876-cerveja-budweiser-lata-350.png', '5'),
(53, '124667-cerveja-budweiser-lata-473.png', '5'),
(54, '513850-stella-artois-600.png', '5'),
(55, '755518-stella-artois-longneck-330.png', '5'),
(56, '300957-stella-artois-lata-350.png', '5'),
(57, '968693-stella-artois-lata-473.png', '5'),
(58, '865878-corona-logneck-355.png', '5'),
(59, '904910-corona-lata-473.png', '5'),
(60, '241262-cerveja-eisenbahn-600.png', '5'),
(61, '835198-cerveja-eisenbahn-longneck-355.png', '5'),
(62, '607729-cerveja-eisenbahn-lata-350.png', '5'),
(63, '909751-cerveja-skol-600.png', '5'),
(64, '868366-cerveja-skol-300.png', '5'),
(65, '486231-cerveja-skol-lata-350.png', '5'),
(66, '496478-brahma-duplo-malte-600.png', '5'),
(67, '873268-brahma-duplo-malte-lata-269.png', '5'),
(68, '573800-brahma-duplo-malte-lata-350.png', '5'),
(69, '155233-agua-coco.png', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_mymenu_planos`
--

CREATE TABLE `t_mymenu_planos` (
  `id` int(3) NOT NULL,
  `nome` varchar(24) NOT NULL,
  `periodo` varchar(6) NOT NULL,
  `preco` varchar(10) NOT NULL,
  `stripe_code` varchar(50) NOT NULL,
  `stripe_pay` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `t_mymenu_planos`
--

INSERT INTO `t_mymenu_planos` (`id`, `nome`, `periodo`, `preco`, `stripe_code`, `stripe_pay`) VALUES
(1, 'Plano My Menu Trimestral', '3', '106.50', '', 'https://buy.stripe.com/test_cN23fegS28zf7pm3ce'),
(2, 'Plano My Menu Semestral', '6', ' 202.35', '', ''),
(3, 'Plano My Menu Anual', '12', '383.40', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `t_token`
--

CREATE TABLE `t_token` (
  `id` int(11) NOT NULL,
  `codigo` int(6) NOT NULL,
  `data_criacao` varchar(20) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(19, 'TIAGO FREITAS VASCONCELOS', '53299394029', 'tiagofv@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '85-989897744', '', 2, 1),
(20, 'Administrador MyMenu', '44166447017', 'galeriaeg@gmail.com', '36ad8c46fed42f9fa77924b4821ed2062ae8cc14', '85-988965156', '05/05/2025', 1, 1);

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
-- Índices de tabela `t_mymenu_categoria`
--
ALTER TABLE `t_mymenu_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_mymenu_files`
--
ALTER TABLE `t_mymenu_files`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `t_mymenu_planos`
--
ALTER TABLE `t_mymenu_planos`
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `t_cardapio`
--
ALTER TABLE `t_cardapio`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `t_categoria`
--
ALTER TABLE `t_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `t_contrato`
--
ALTER TABLE `t_contrato`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `t_customiza`
--
ALTER TABLE `t_customiza`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `t_item`
--
ALTER TABLE `t_item`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `t_links_externos`
--
ALTER TABLE `t_links_externos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `t_mymenu_categoria`
--
ALTER TABLE `t_mymenu_categoria`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `t_mymenu_files`
--
ALTER TABLE `t_mymenu_files`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `t_mymenu_planos`
--
ALTER TABLE `t_mymenu_planos`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `t_token`
--
ALTER TABLE `t_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de tabela `t_usuario`
--
ALTER TABLE `t_usuario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
