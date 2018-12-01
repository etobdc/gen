-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 08/08/2018 às 09:09
-- Versão do servidor: 10.2.16-MariaDB-10.2.16+maria~xenial
-- Versão do PHP: 7.2.8-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `imasul`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `api_integrations`
--

CREATE TABLE `api_integrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cidade_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `bairros`
--

INSERT INTO `bairros` (`id`, `name`, `cidade_id`, `created_at`, `updated_at`) VALUES
(1, 'Centro', 1, '2018-06-08 22:27:07', '2018-06-08 22:28:27'),
(3, 'Imigrantes', 1, '2018-06-08 22:28:41', '2018-06-08 22:28:41'),
(4, 'Centro', 2, '2018-06-10 00:07:27', '2018-06-10 00:07:27'),
(5, 'São Cristóvão', 1, '2018-07-19 15:49:54', '2018-07-19 15:49:54'),
(6, 'Dos Estados', 1, '2018-07-20 21:02:19', '2018-07-20 21:02:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `lead` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `slug`, `lead`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Este é o momento de investir, diz especialista em crise imobiliária', 'este-e-o-momento-de-investir-diz-especialista-em-crise-imobiliaria', 'Para o americano Ronald Rawald, executivo do fundo de private equity Cerberus, a recuperação no Brasil poderia levar dez anos', '<p>Belém tem 30 mil famílias procurando imóveis e a expectativa é que em 2018 entrem mais 10 mil famílias procurando imóveis para morar. Assim como a economia do país, o mercado imobiliária viveu um momento de baixa. </p><p>Mas 2018 se apresenta como um ano eleitoral, em que há investimentos na sociedade como um todo e, claro, influência também no setor dos imóveis para suprir essa demanda adormecida. \"2018, além de ser um ano que a gente espera ser de crescimento de PIB, de uma estabilidade um pouco melhor na economia, é um ano de eleição, em que a construção civil é o primeiro setor beneficiado. Na hora que entrar esse recurso, a gente espera que esse preço que hoje está colado, tenha um deslocamento, não se espera um grande deslocamento no valor de mercado do imóvel, mas se espera que ele dê uma valorizada\", explica o corretor Murilo Souza Filho. O grande desafio e a resposta para o questionamento sobre como agir no mercado imobiliário nesse início de 2018, segundo Murilo Souza é: <strong>COMPRAR PARA POUPAR</strong>. <em>\"Não existe mais como frear tanta demanda reprimida. </em></p><p>Qualquer valor, qualquer financiamento que melhore para o consumidor final vai deslocar esse preço. Não vamos esperar queda de preços nos valores imobiliários em 2018, vai existir sim, um descolamento\", projeta. Segundo Murilo, a compra do imóvel pode ser feita de várias formas, não precisa ter dinheiro à vista, a pessoa pode investir no metro quadrado, investir num lançamento, investir em uma série de produtos que vão ser ofertados em 2018. \"Procure um corretor, uma pessoa credenciada que pode ajudar nessa jornada\", pontua Murilo. No próximo vídeo da série o tema abordado será <strong><em>\"Tecnologia no Mercado Imobiliário\".</em></strong></p>', '195139201806075b198ccb65ec2.jpeg', '2018-06-07 22:51:39', '2018-06-12 22:25:36');

-- --------------------------------------------------------

--
-- Estrutura para tabela `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `imovel_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `name`, `quantidade`, `imovel_id`, `created_at`, `updated_at`) VALUES
(2, 'Churrasqueiras', 2, 4, '2018-06-11 03:33:14', '2018-06-11 03:34:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lead` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chapters`
--

CREATE TABLE `chapters` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cidades`
--

INSERT INTO `cidades` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Concórdia', '2018-06-08 20:53:55', '2018-06-08 20:53:55'),
(2, 'Chapecó', '2018-06-08 20:54:05', '2018-06-08 20:54:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `secondary_phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `complement` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `moip_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `linkedin` varchar(250) DEFAULT NULL,
  `instagram` varchar(250) DEFAULT NULL,
  `endereco` varchar(350) NOT NULL,
  `link_mapa` varchar(350) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `telefone_2` varchar(15) DEFAULT NULL,
  `telefone_3` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `configs`
--

INSERT INTO `configs` (`id`, `name`, `keywords`, `description`, `facebook`, `linkedin`, `instagram`, `endereco`, `link_mapa`, `telefone`, `telefone_2`, `telefone_3`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Configurações do site', 'IMASUL,imsaul,imobiliaria,imobiliária,imóveis, concórdia, imoveis,alugar,vender,comprar,casas a venda, casas para alugar', 'IMASUL - Imobiliária', 'https://www.facebook.com/imasulimobiliaria/', NULL, NULL, 'R. Osvaldo Valentim Zandavalli, 360 - Centro, Concórdia - SC, 89700-136', 'https://bit.ly/2sCiR9p', '(49) 3442-2015', '(42) 99914-4895', '(49) 99999-9999', 'contato@imasulimobiliaria.com.br', '2018-06-06 20:47:37', '2018-07-23 22:11:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `configurations`
--

CREATE TABLE `configurations` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `corretores`
--

CREATE TABLE `corretores` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `corretores`
--

INSERT INTO `corretores` (`id`, `name`, `email`, `telefone`, `image`, `created_at`, `updated_at`) VALUES
(2, 'teste', 'everton@o2multi.com.br', '(49) 99999-9344', '201900201807235b563834d3ac0.png', '2018-07-23 23:19:00', '2018-07-23 23:19:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lead` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `details_title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `details_description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `promotional_price` int(11) NOT NULL DEFAULT 0,
  `promotion_active` tinyint(1) NOT NULL DEFAULT 0,
  `promotional_phrase` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `depoimentos`
--

CREATE TABLE `depoimentos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `depoimentos`
--

INSERT INTO `depoimentos` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Lindormar Arlindo', '<p>Lorem ipsum dolor sit a met dolorem lorem dlores Lorem ipsum dolor sit a met dolorem lorem dlores Lorem ipsum dolor sit a met dolorem lorem dlores Lorem ipsum dolor sit a met dolorem lorem dlores.</p>', '141111201806075b193cffd3ad3.jpeg', '2018-06-07 17:01:28', '2018-06-07 17:11:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2018-05-10 05:20:28', '2018-05-10 05:20:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `group_module`
--

CREATE TABLE `group_module` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `group_module`
--

INSERT INTO `group_module` (`id`, `group_id`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 1, 4, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 1, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem_extras`
--

CREATE TABLE `imagem_extras` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `imovel_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `imagem_extras`
--

INSERT INTO `imagem_extras` (`id`, `image`, `imovel_id`, `created_at`, `updated_at`) VALUES
(8, '003153201806185b26fd7909399.jpeg', 4, '2018-06-18 03:31:53', '2018-06-18 03:31:53'),
(9, '003204201806185b26fd84d2de3.jpeg', 4, '2018-06-18 03:32:04', '2018-06-18 03:32:04'),
(10, '022114201806185b27171af3fa2.jpeg', 4, '2018-06-18 05:21:15', '2018-06-18 05:21:15'),
(11, '171415201806205b2a8b67457ab.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(12, '171415201806205b2a8b67514ac.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(13, '171415201806205b2a8b6756e3a.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(14, '171415201806205b2a8b675c8d9.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(16, '171415201806205b2a8b676cc8a.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(17, '171415201806205b2a8b6771088.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(18, '171415201806205b2a8b677576c.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(19, '171415201806205b2a8b6778f96.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(20, '171415201806205b2a8b677febc.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(21, '171415201806205b2a8b6784582.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(22, '171415201806205b2a8b6788368.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(23, '171415201806205b2a8b678d0d1.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(24, '171415201806205b2a8b679083b.jpeg', 5, '2018-06-20 20:14:15', '2018-06-20 20:14:15'),
(25, '122712201807035b3b6ba0cc30d.jpeg', 7, '2018-07-03 15:27:12', '2018-07-03 15:27:12'),
(26, '122728201807035b3b6bb0ebf74.jpeg', 7, '2018-07-03 15:27:28', '2018-07-03 15:27:28'),
(27, '122746201807035b3b6bc25a470.jpeg', 7, '2018-07-03 15:27:46', '2018-07-03 15:27:46'),
(28, '122811201807035b3b6bdb539c4.jpeg', 7, '2018-07-03 15:28:11', '2018-07-03 15:28:11'),
(29, '130519201807175b4de98f3604f.jpeg', 9, '2018-07-17 16:05:19', '2018-07-17 16:05:19'),
(30, '130619201807175b4de9cb51a20.jpeg', 9, '2018-07-17 16:06:19', '2018-07-17 16:06:19'),
(31, '180520201807175b4e2fe0bd015.jpeg', 10, '2018-07-17 21:05:20', '2018-07-17 21:05:20'),
(32, '180534201807175b4e2feedceb0.jpeg', 10, '2018-07-17 21:05:34', '2018-07-17 21:05:34'),
(33, '180555201807175b4e30037c6ee.jpeg', 10, '2018-07-17 21:05:55', '2018-07-17 21:05:55'),
(34, '180629201807175b4e30254aa77.jpeg', 10, '2018-07-17 21:06:29', '2018-07-17 21:06:29'),
(35, '180650201807175b4e303a659d3.jpeg', 10, '2018-07-17 21:06:50', '2018-07-17 21:06:50'),
(36, '180708201807175b4e304c3200c.jpeg', 10, '2018-07-17 21:07:08', '2018-07-17 21:07:08'),
(37, '181133201807175b4e315583421.jpeg', 11, '2018-07-17 21:11:33', '2018-07-17 21:11:33'),
(38, '181157201807175b4e316d352c8.jpeg', 11, '2018-07-17 21:11:57', '2018-07-17 21:11:57'),
(39, '181228201807175b4e318c4162f.jpeg', 11, '2018-07-17 21:12:28', '2018-07-17 21:12:28'),
(40, '181245201807175b4e319d52d87.jpeg', 11, '2018-07-17 21:12:45', '2018-07-17 21:12:45'),
(41, '181311201807175b4e31b7cff61.jpeg', 11, '2018-07-17 21:13:11', '2018-07-17 21:13:11'),
(42, '182258201807175b4e34029b6d3.jpeg', 12, '2018-07-17 21:22:58', '2018-07-17 21:22:58'),
(43, '182324201807175b4e341c676a3.jpeg', 12, '2018-07-17 21:23:24', '2018-07-17 21:23:24'),
(44, '182344201807175b4e343082acd.jpeg', 12, '2018-07-17 21:23:44', '2018-07-17 21:23:44'),
(45, '182359201807175b4e343f959b5.jpeg', 12, '2018-07-17 21:23:59', '2018-07-17 21:23:59'),
(46, '183706201807175b4e375222f81.jpeg', 13, '2018-07-17 21:37:06', '2018-07-17 21:37:06'),
(47, '183723201807175b4e3763448ca.jpeg', 13, '2018-07-17 21:37:23', '2018-07-17 21:37:23'),
(48, '183744201807175b4e3778d3c3d.jpeg', 13, '2018-07-17 21:37:44', '2018-07-17 21:37:44'),
(49, '183812201807175b4e3794914bd.jpeg', 13, '2018-07-17 21:38:12', '2018-07-17 21:38:12'),
(50, '183831201807175b4e37a7ae58f.jpeg', 13, '2018-07-17 21:38:31', '2018-07-17 21:38:31'),
(51, '184259201807175b4e38b3b95e4.jpeg', 14, '2018-07-17 21:42:59', '2018-07-17 21:42:59'),
(52, '184315201807175b4e38c3b8445.jpeg', 14, '2018-07-17 21:43:15', '2018-07-17 21:43:15'),
(53, '184337201807175b4e38d9c47fc.jpeg', 14, '2018-07-17 21:43:37', '2018-07-17 21:43:37'),
(55, '184436201807175b4e39145e7aa.jpeg', 14, '2018-07-17 21:44:36', '2018-07-17 21:44:36'),
(56, '185018201807175b4e3a6ab6513.png', 15, '2018-07-17 21:50:18', '2018-07-17 21:50:18'),
(57, '185048201807175b4e3a889b7d1.png', 15, '2018-07-17 21:50:48', '2018-07-17 21:50:48'),
(58, '185122201807175b4e3aaaa55f8.jpeg', 15, '2018-07-17 21:51:22', '2018-07-17 21:51:22'),
(59, '185155201807175b4e3acba8670.jpeg', 15, '2018-07-17 21:51:55', '2018-07-17 21:51:55'),
(60, '185226201807175b4e3aea104e5.jpeg', 15, '2018-07-17 21:52:26', '2018-07-17 21:52:26'),
(61, '185246201807175b4e3afe46259.jpeg', 15, '2018-07-17 21:52:46', '2018-07-17 21:52:46'),
(62, '185301201807175b4e3b0dbfa7a.jpeg', 15, '2018-07-17 21:53:01', '2018-07-17 21:53:01'),
(63, '185327201807175b4e3b27e01bd.jpeg', 15, '2018-07-17 21:53:27', '2018-07-17 21:53:27'),
(64, '185346201807175b4e3b3a07be2.jpeg', 15, '2018-07-17 21:53:46', '2018-07-17 21:53:46'),
(66, '185453201807175b4e3b7d683c8.jpeg', 15, '2018-07-17 21:54:53', '2018-07-17 21:54:53'),
(69, '190643201807175b4e3e43b8d74.jpeg', 16, '2018-07-17 22:06:43', '2018-07-17 22:06:43'),
(70, '190704201807175b4e3e583b68d.jpeg', 16, '2018-07-17 22:07:04', '2018-07-17 22:07:04'),
(71, '191041201807175b4e3f3143773.jpeg', 17, '2018-07-17 22:10:41', '2018-07-17 22:10:41'),
(72, '191059201807175b4e3f4394633.jpeg', 17, '2018-07-17 22:10:59', '2018-07-17 22:10:59'),
(73, '191116201807175b4e3f54f2de0.jpeg', 17, '2018-07-17 22:11:17', '2018-07-17 22:11:17'),
(74, '191145201807175b4e3f7125454.jpeg', 17, '2018-07-17 22:11:45', '2018-07-17 22:11:45'),
(75, '191207201807175b4e3f87aa57a.jpeg', 17, '2018-07-17 22:12:07', '2018-07-17 22:12:07'),
(76, '182544201807185b4f86284663d.jpeg', 19, '2018-07-18 21:25:44', '2018-07-18 21:25:44'),
(77, '182607201807185b4f863f56f6c.jpeg', 19, '2018-07-18 21:26:07', '2018-07-18 21:26:07'),
(78, '182619201807185b4f864bd719e.jpeg', 19, '2018-07-18 21:26:19', '2018-07-18 21:26:19'),
(79, '120056201807195b507d78e880c.jpeg', 20, '2018-07-19 15:00:56', '2018-07-19 15:00:56'),
(80, '120115201807195b507d8ba9119.jpeg', 20, '2018-07-19 15:01:15', '2018-07-19 15:01:15'),
(81, '120130201807195b507d9ac3480.jpeg', 20, '2018-07-19 15:01:30', '2018-07-19 15:01:30'),
(82, '120500201807195b507e6cb8b08.jpeg', 21, '2018-07-19 15:05:00', '2018-07-19 15:05:00'),
(83, '120514201807195b507e7a89e42.jpeg', 21, '2018-07-19 15:05:14', '2018-07-19 15:05:14'),
(84, '120529201807195b507e892febb.jpeg', 21, '2018-07-19 15:05:29', '2018-07-19 15:05:29'),
(85, '120544201807195b507e981ad9e.jpeg', 21, '2018-07-19 15:05:44', '2018-07-19 15:05:44'),
(86, '121150201807195b50800682756.jpeg', 22, '2018-07-19 15:11:50', '2018-07-19 15:11:50'),
(87, '121211201807195b50801b06a38.jpeg', 22, '2018-07-19 15:12:11', '2018-07-19 15:12:11'),
(88, '121228201807195b50802c31853.jpeg', 22, '2018-07-19 15:12:28', '2018-07-19 15:12:28'),
(89, '121629201807195b50811dbdb5f.jpeg', 23, '2018-07-19 15:16:29', '2018-07-19 15:16:29'),
(90, '121647201807195b50812fc40ce.jpeg', 23, '2018-07-19 15:16:47', '2018-07-19 15:16:47'),
(91, '121706201807195b50814248276.jpeg', 23, '2018-07-19 15:17:06', '2018-07-19 15:17:06'),
(92, '122110201807195b50823670ce4.jpeg', 24, '2018-07-19 15:21:10', '2018-07-19 15:21:10'),
(93, '122125201807195b508245795d1.jpeg', 24, '2018-07-19 15:21:25', '2018-07-19 15:21:25'),
(94, '122139201807195b5082535b3f1.jpeg', 24, '2018-07-19 15:21:39', '2018-07-19 15:21:39'),
(96, '165629201807195b50c2bd0befb.jpeg', 25, '2018-07-19 19:56:29', '2018-07-19 19:56:29'),
(97, '181750201807205b52274e2ff76.jpeg', 26, '2018-07-20 21:17:50', '2018-07-20 21:17:50'),
(98, '181805201807205b52275dad437.jpeg', 26, '2018-07-20 21:18:05', '2018-07-20 21:18:05'),
(99, '181829201807205b52277593d05.png', 26, '2018-07-20 21:18:29', '2018-07-20 21:18:29'),
(100, '192055201807205b5236174b305.jpeg', 25, '2018-07-20 22:20:55', '2018-07-20 22:20:55'),
(101, '192129201807205b523639b6c54.jpeg', 25, '2018-07-20 22:21:29', '2018-07-20 22:21:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imovels`
--

CREATE TABLE `imovels` (
  `id` int(11) NOT NULL,
  `destaque` int(11) DEFAULT 0,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `cidade_id` int(11) NOT NULL,
  `bairro_id` int(11) NOT NULL,
  `quarto` int(11) NOT NULL,
  `garagem` int(11) NOT NULL,
  `banheiro` int(11) NOT NULL,
  `sala` int(11) NOT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `endereco` text NOT NULL,
  `description` text NOT NULL,
  `link_360` varchar(300) DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `imovels`
--

INSERT INTO `imovels` (`id`, `destaque`, `name`, `slug`, `codigo`, `status`, `tipo_id`, `cidade_id`, `bairro_id`, `quarto`, `garagem`, `banheiro`, `sala`, `preco`, `latitude`, `longitude`, `endereco`, `description`, `link_360`, `image`, `created_at`, `updated_at`) VALUES
(5, 1, 'Apartamento', 'apartamento', 'APTOV001', 1, 2, 1, 1, 3, 2, 2, 1, '0.00', '-27.226751', '-52.019436', 'Rua Carlos Gomes, 84\r\nCentro', '<p>Excelente apartamento novo pronto para morar.</p><p>Acabamento em porcelanato e piso laminado.</p>', NULL, '133821201806205b2a58cd15916.png', '2018-06-20 16:38:21', '2018-07-18 20:50:47'),
(6, 1, 'Sala comercial', 'sala-comercial', 'SC001', 2, 5, 1, 1, 0, 1, 5, 0, '2500.00', '27°14\'18.1\"S', '52°01\'17.6\"W', 'Rua Getulio Vargas, 1251', '<p>Excelente sala comercial para locação</p><p>3(três) andares</p><p>Diversas salas.</p>', NULL, '171631201806215b2bdd6fa8e94.jpeg', '2018-06-21 20:16:31', '2018-07-17 16:04:23'),
(7, 2, 'Apartamento', 'apartamento-1', 'APTOL001', 2, 2, 1, 3, 2, 1, 1, 1, '700.00', NULL, NULL, 'Rua', '<p>Apartamento semi mobiliado</p><p>Sacada com churrasqueira</p><p>01(uma) vaga de garagem</p><p><br></p>', NULL, '122453201807035b3b6b15f01fc.jpeg', '2018-07-03 15:24:54', '2018-07-17 21:03:06'),
(8, 1, 'Apartamento', 'apartamento-14', 'APTOL002', 2, 2, 1, 1, 4, 1, 2, 2, '1300.00', '-27.228328', '-52.020282', 'Rua Dr°Maruri, 1216', '<p>Apartamento fundos no centro</p><p>4 quartos, sendo uma suíte</p><p>Banheiro social.</p><p>Lavanderia</p><p>1 vaga de garagem.</p><p>Aproximadamente 150 mts²</p><p><br></p><p><br></p>', NULL, '193636201807045b3d21c4d0f0e.jpeg', '2018-07-04 22:36:36', '2018-07-17 21:02:32'),
(9, 1, 'Sala comercial', 'sala-comercial-15', 'SC002', 2, 5, 1, 1, 0, 0, 1, 1, '6500.00', NULL, NULL, 'Rua Independência, 40', '<p>Excelente sala comercial no centro, próxima ao Via Passarela.</p>', NULL, '130329201807175b4de92124bb6.jpeg', '2018-07-17 16:03:29', '2018-07-17 16:03:29'),
(10, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas', 'CSP001', 1, 1, 1, 1, 0, 0, 0, 0, '0.00', NULL, NULL, 'Concórdia-SC', '<p>Casas pré fabricadas(kit madeira)</p><p>Vários projetos.</p><p>Solicite um orçamento.</p>', NULL, '175941201807175b4e2e8de1005.jpeg', '2018-07-17 20:59:42', '2018-07-18 20:58:54'),
(11, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-1', 'CSP002', 1, 6, 1, 1, 2, 1, 1, 1, '49980.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>2 dormitórios</p><p>Sala </p><p>Cozinha</p><p>Banheiro</p><p><br></p>', NULL, '181058201807175b4e313222d41.jpeg', '2018-07-17 21:10:58', '2018-07-18 20:58:18'),
(12, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-2', 'CSP003', 1, 6, 1, 1, 2, 1, 3, 1, '76500.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>132 m²</p><p><br></p>', NULL, '182215201807175b4e33d7bcbf2.jpeg', '2018-07-17 21:22:15', '2018-07-18 20:52:08'),
(13, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-3', 'CSP004', 1, 6, 1, 1, 3, 1, 2, 2, '84600.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>141 m²</p><p><br></p>', NULL, '183559201807175b4e370fd0d4c.jpeg', '2018-07-17 21:35:59', '2018-07-18 20:51:36'),
(14, 2, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-4', 'CSP005', 1, 6, 1, 1, 3, 1, 1, 1, '37400.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>68 m²</p>', NULL, '184217201807175b4e3889b59dd.jpeg', '2018-07-17 21:42:17', '2018-07-18 20:51:04'),
(15, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-5', 'CSP006', 1, 6, 1, 1, 3, 1, 3, 2, '102000.00', NULL, NULL, 'Concórdia-sC', '<p>Casa pré fabricada(kit madeira)</p><p>176 m²</p><p><br></p>', NULL, '184933201807175b4e3a3d385fe.png', '2018-07-17 21:49:33', '2018-07-18 20:55:27'),
(16, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-6', 'CSP007', 1, 6, 1, 1, 3, 1, 1, 2, '99100.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>171m²</p><p>1 lavabo</p>', NULL, '190604201807175b4e3e1c1bef3.jpeg', '2018-07-17 22:06:04', '2018-07-18 20:56:04'),
(17, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-7', 'CSP008', 1, 6, 1, 1, 3, 1, 2, 1, '77800.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>134m²</p>', NULL, '191014201807175b4e3f16d3d56.jpeg', '2018-07-17 22:10:14', '2018-07-18 20:56:44'),
(19, 1, 'Casa pré fabricada', 'casa-pre-fabricada', 'CSP009', 1, 6, 1, 1, 3, 1, 2, 2, '0.00', NULL, NULL, 'Concórdia-SC', '<p>Casas pré fabricas em alto padrão(kit madeira)</p><p>Projetos a partir de 9m²</p><p>Solicite um orçamento.</p><p>Temos decks e assoalho sob encomenda.</p>', NULL, '182521201807185b4f86115465f.jpeg', '2018-07-18 21:25:21', '2018-07-18 21:25:21'),
(20, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-8', 'CSP010', 1, 6, 1, 1, 4, 1, 2, 1, '144000.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>249m²</p><p><br></p>', NULL, '115853201807195b507cfdf3b32.jpeg', '2018-07-19 14:58:54', '2018-07-19 14:58:54'),
(21, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-9', 'CSP011', 1, 6, 1, 1, 4, 2, 2, 2, '122600.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>212m²</p>', NULL, '120408201807195b507e3849d5c.jpeg', '2018-07-19 15:04:08', '2018-07-19 15:04:42'),
(22, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-10', 'CSP012', 1, 6, 1, 1, 4, 2, 2, 1, '85800.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>143m²</p>', NULL, '121127201807195b507fef4ff4e.jpeg', '2018-07-19 15:11:27', '2018-07-19 15:11:27'),
(23, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-11', 'CSP013', 1, 6, 1, 1, 4, 1, 2, 1, '142500.00', NULL, NULL, 'Concórdia-SC', '<p>Casa pré fabricada(kit madeira)</p><p>234m²</p>', NULL, '121602201807195b508102e1393.jpeg', '2018-07-19 15:16:02', '2018-07-19 15:16:02'),
(24, 1, 'Casas Pré Fabricadas', 'casas-pre-fabricadas-12', 'CSP014', 1, 6, 1, 1, 4, 1, 3, 2, '0.00', NULL, NULL, 'Concórdia-SC', '<p>Casas pré fabricadas</p><p>Kit madeira( acompanha portas e esquadrias)</p><p>Diversos projetos a partir de 9m²</p><p>Solicite um orçamento.</p>', NULL, '122012201807195b5081fce6797.jpeg', '2018-07-19 15:20:12', '2018-07-19 15:20:51'),
(25, 2, 'Sala comercial/barracão', 'sala-comercialbarracao', 'SC003', 3, 5, 1, 5, 0, 1, 2, 1, '2500.00', NULL, NULL, 'R. Tancredo de Almeida Neves, nº 3000\r\nBairro São Cristóvão\r\nConcórdia-sC', '<p>Sala comercial com 260m²</p><p>Banheiros masculino/feminino</p><p><br></p>', NULL, '191730201807205b52354aeac01.jpeg', '2018-07-19 19:55:07', '2018-07-20 22:17:31'),
(26, 1, 'Apartamento', 'apartamento-16', 'APTOV002', 3, 2, 1, 6, 3, 2, 2, 1, '250000.00', NULL, NULL, 'Rua Minas Gerais\r\nBairro dos Estados\r\nConcórdia-SC', '<p>ÓTIMA OPORTUNIDADE !!!</p><p>Residencial Malta</p><p>Apartamento 03 quartos(01 suite)</p><p>2 vagas de garagem</p><p>80 m² de área útil.</p><p>Sacada com churrasqueira.</p><p>Apartamento novo, pronto para morar !!! Disponibilidade para financiamento. </p>', NULL, '181414201807205b522676c0008.png', '2018-07-20 21:14:14', '2018-07-20 21:14:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `levels`
--

CREATE TABLE `levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_02_11_015001_create_modules_table', 1),
(9, '2018_02_11_020311_create_groups_table', 1),
(10, '2018_02_12_212338_create_group_module_table', 1),
(11, '2018_03_02_112149_create_configurations_table', 1),
(12, '2018_03_27_111739_create_api_integrations_table', 1),
(13, '2018_03_27_124835_create_categories_table', 1),
(14, '2018_03_27_140844_create_levels_table', 1),
(15, '2018_03_27_143052_create_courses_table', 1),
(16, '2018_04_03_173706_alter_table_courses', 1),
(17, '2018_04_03_183714_create_chapters_controller', 1),
(18, '2018_04_03_191315_create_classes_table', 2),
(19, '2018_04_04_115051_create_attachments_table', 2),
(20, '2018_04_04_194648_alter_table_course_add_values', 2),
(21, '2018_04_05_173941_alter_table_users_add_type', 2),
(22, '2018_04_05_180734_create_clients_table', 2),
(23, '2018_04_06_183719_create_orders_table', 2),
(24, '2018_04_09_132431_alter_clients_table_add_moip_id', 2),
(25, '2018_04_09_171927_alter_table_categories_add_picture_and_lead', 2),
(26, '2018_04_09_180439_alter_table_orders', 2),
(27, '2018_04_09_193312_alter_table_orderss', 3),
(28, '2018_04_11_112044_create_teachers_table', 3),
(29, '2018_04_11_121733_alter_table_courses_add_teacher', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `father_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_order` int(11) NOT NULL DEFAULT 0,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `has_son` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `modules`
--

INSERT INTO `modules` (`id`, `name`, `father_path`, `father_order`, `path`, `route`, `order`, `icon`, `has_son`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', '', 0, 'cms/dashboard', 'dashboard', 0, 'fa fa-dashboard', 0, '2018-05-10 05:20:28', '2018-05-10 05:20:28'),
(2, 'Administração', '', 2, 'cms/admin', 'admin', 10, 'fa fa-lock', 1, '2018-05-10 05:20:28', '2018-05-10 05:20:28'),
(3, 'Grupos de Usuários', 'cms/admin', 2, 'groups', 'groups', 1, '', 0, '2018-05-10 05:20:28', '2018-05-10 05:20:28'),
(4, 'Usuários', 'cms/admin', 2, 'users', 'users', 2, '', 0, '2018-05-10 05:20:28', '2018-05-10 05:20:28'),
(5, 'Páginas', '', 0, 'cms/pages', 'pages', 8, 'fa fa-file-text-o', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(6, 'Configurações', '', 0, 'cms/configs', 'configs', 9, 'fa fa-wrench', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(7, 'Depoimentos', '', 0, 'cms/depoimentos', 'depoimentos', 7, 'fa fa-commenting-o', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(8, 'Corretores', '', 0, 'cms/corretores', 'corretores', 6, 'fa fa-users', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(9, 'Blogs', '', 0, 'cms/blogs', 'blogs', 5, 'fa fa-newspaper-o\n', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(10, 'Slides', '', 0, 'cms/slides', 'slides', 3, 'fa fa-picture-o\n', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(11, 'Publicidades', '', 0, 'cms/publicidades', 'publicidades', 4, 'fa fa-file-image-o\r\n', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(12, 'Imóveis', '', 0, 'cms/imoveis', 'imoveis', 1, 'fa fa-home\r\n', 1, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(13, 'Tipo', 'cms/imoveis', 0, 'tipos', 'tipos', 1, 'fa fa-home\r\n', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(14, 'Cidades', 'cms/imoveis', 1, 'cidades', 'cidades', 1, '', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00'),
(15, 'Imóvel', 'cms/imoveis', 2, 'imovel', 'imovel', 1, '', 0, '2018-06-06 13:35:30', '2018-06-06 14:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `available` tinyint(1) NOT NULL DEFAULT 0,
  `moip_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Home - Encontramos o imóvel perfeito para você', 'Encontramos# o imóvel perfeito para você', '<p><strong>Sem tempo para pesquisar o imóvel desejado?</strong></p><p>Fique tranquilo, deixe seu nome, e-mail e WhatsApp no formulário a baixo, que entraremos em contato.</p>', NULL, '2018-06-06 19:58:29', '2018-06-06 21:45:28'),
(2, 'Home - Descrição acima de Depoimentos', 'IMASUL, 40 anos de# especialidade em realizar o sonho do imóvel próprio', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '', '2018-06-06 20:37:47', '2018-06-06 21:59:45'),
(3, 'Avaliação - Descrição', 'Nós da #IMASUL# avaliamos seu imóvel para diversos fins', '<p>Envie-nos uma mensagem através do formulário a baixo, que em breve nosso time de corretores entrará em contato.</p>', NULL, '2018-06-06 20:40:53', '2018-06-06 20:50:30'),
(4, 'Sobre - Descrição', 'IMASUL, 40 anos de especialidade em realizar o sonho do imóvel próprio', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '193001201806185b280839b8dc3.png', '2018-06-06 20:43:40', '2018-06-18 22:30:01'),
(5, 'Sobre - Missão', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>', '', '2018-06-06 20:44:22', '2018-06-06 20:44:22'),
(6, 'Sobre - Visão', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>', '', '2018-06-06 20:44:22', '2018-06-06 20:44:22'),
(7, 'Sobre - Valores', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>', '', '2018-06-06 20:44:22', '2018-06-06 20:44:22'),
(8, 'Blog - Descrição', 'Fique ligado nas novidades do mundo imobiliário', '<p>No blog da IMASUL, você sempre encontrará novidades sobre tudo que move o mundo imobiliário e da construção civil. Fique ligado.</p>', '', '2018-06-06 20:47:36', '2018-06-06 20:47:36'),
(9, 'Contato - Descrição', 'Envie uma mensagem para o time da #IMASUL', '<p>Envie-nos uma mensagem através do formulário a baixo, que em breve nosso time de corretores entrará em contato.</p>', '', '2018-06-06 20:48:54', '2018-07-23 22:02:15'),
(10, 'Banner Conheça o Imóveis', 'Realizamos o #seu sonho# do imóvel próprio', NULL, '175911201807255b58ba6f5833c.jpeg', '2018-06-06 20:48:54', '2018-07-25 20:59:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `publicidades`
--

CREATE TABLE `publicidades` (
  `id` int(11) NOT NULL,
  `local` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `link` varchar(250) NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `publicidades`
--

INSERT INTO `publicidades` (`id`, `local`, `name`, `titulo`, `link`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Realize seu sonho do imóvel próprio', 'Conheça os imóveis', 'http://localhost:8000/', '125246201806085b1a7c1ee510e.jpeg', '2018-06-08 15:48:49', '2018-06-12 23:48:38'),
(2, 2, 'Realize seu sonho do imóvel próprio', 'Conheça os imóveis', 'http://localhost:8000/', '125246201806085b1a7c1ee510e.jpeg', '2018-06-08 15:48:49', '2018-06-12 23:48:38'),
(3, 3, 'Realize seu sonho do imóvel próprio', 'Conheça os imóveis', 'http://localhost:8000/', '125246201806085b1a7c1ee510e.jpeg', '2018-06-08 15:48:49', '2018-06-12 23:48:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lead` text DEFAULT NULL,
  `image` char(100) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `slides`
--

INSERT INTO `slides` (`id`, `name`, `lead`, `image`, `link`, `created_at`, `updated_at`) VALUES
(2, 'Teste', 'testes', '204902201806075b199a3e0c2a2.jpeg', 'http://github.com/', '2018-06-07 23:49:02', '2018-06-08 14:52:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tipos`
--

INSERT INTO `tipos` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Casa', '2018-06-08 20:26:04', '2018-06-08 20:28:48'),
(2, 'Apartamento', '2018-06-08 20:28:54', '2018-06-08 20:28:54'),
(3, 'Terreno', '2018-06-20 15:11:19', '2018-06-20 15:11:19'),
(4, 'Barracâo', '2018-06-20 15:11:38', '2018-06-20 15:11:38'),
(5, 'Sala comercial', '2018-06-20 15:12:06', '2018-06-20 15:12:06'),
(6, 'Casas Pré Fabricadas', '2018-07-18 20:03:24', '2018-07-18 20:03:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `group_id`, `name`, `username`, `email`, `password`, `image`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
(1, 1, 'Administrador', 'imasul', 'youremail@mail.com', '$2y$10$qTD8K5SBFJF/2r8YNZGuHuHAPrC.6NTUcdHf7at.HK9jEyGLscn/y', NULL, 'hfeAtz8Df97Kn0IYZIAjD9vWrq9lAEUS65wwUnZ2LKJ7favR65lY92yk11JJ', '2018-02-13 13:28:36', '2018-06-19 20:34:02', 0);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `api_integrations`
--
ALTER TABLE `api_integrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_integrations_token_unique` (`token`);

--
-- Índices de tabela `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Índices de tabela `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chapters_slug_unique` (`slug`);

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Índices de tabela `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `corretores`
--
ALTER TABLE `corretores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`);

--
-- Índices de tabela `depoimentos`
--
ALTER TABLE `depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `group_module`
--
ALTER TABLE `group_module`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagem_extras`
--
ALTER TABLE `imagem_extras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imovels`
--
ALTER TABLE `imovels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Índices de tabela `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lessons_slug_unique` (`slug`);

--
-- Índices de tabela `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `levels_slug_unique` (`slug`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_order_index` (`order`);

--
-- Índices de tabela `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Índices de tabela `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Índices de tabela `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Índices de tabela `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices de tabela `publicidades`
--
ALTER TABLE `publicidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `api_integrations`
--
ALTER TABLE `api_integrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `corretores`
--
ALTER TABLE `corretores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `depoimentos`
--
ALTER TABLE `depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `group_module`
--
ALTER TABLE `group_module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `imagem_extras`
--
ALTER TABLE `imagem_extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de tabela `imovels`
--
ALTER TABLE `imovels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `publicidades`
--
ALTER TABLE `publicidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
