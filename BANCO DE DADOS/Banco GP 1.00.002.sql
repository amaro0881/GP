-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jul 26, 2012 as 01:53 AM
-- Versão do Servidor: 5.1.53
-- Versão do PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `gp`
--
CREATE DATABASE `gp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gp`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `andamento`
--

CREATE TABLE IF NOT EXISTS `andamento` (
  `id_andamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo` int(11) NOT NULL,
  `data_andamento` varchar(10) NOT NULL,
  `andamento` longtext NOT NULL,
  `observacao` longtext NOT NULL,
  PRIMARY KEY (`id_andamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `andamento`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `entidade`
--

CREATE TABLE IF NOT EXISTS `entidade` (
  `id_entidade` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) NOT NULL,
  `autor` char(1) DEFAULT NULL,
  `responsavel` char(1) DEFAULT NULL,
  `coresponsavel` char(1) DEFAULT NULL,
  `requerente` char(1) DEFAULT NULL,
  `nome` varchar(200) NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `observacao` varchar(500) DEFAULT NULL,
  `data_cadastro` varchar(10) DEFAULT NULL,
  `data_alteracao` datetime NOT NULL,
  PRIMARY KEY (`id_entidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `entidade`
--

INSERT INTO `entidade` (`id_entidade`, `codigo`, `autor`, `responsavel`, `coresponsavel`, `requerente`, `nome`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cpf_cnpj`, `observacao`, `data_cadastro`, `data_alteracao`) VALUES
(1, 'ARMS', '1', '1', '', '1', 'Amaro Rocha Melo dos Santos', 'Rua Borja Reis', '891', 'Bloco 1 Apto 905', 'Engenho de Dentro', 'Rio de Janeiro', 'RJ', '12422379761', 'Responsável pelo projeto GP - Gestão de Projetos', '09/07/2012', '2012-07-10 02:21:49'),
(2, '123', '1', '', '1', '1', 'Amaro Costa', '', '', '', '', '', '', '', '', '', '2012-07-17 22:55:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entidade_contato`
--

CREATE TABLE IF NOT EXISTS `entidade_contato` (
  `id_entidade_contato` int(11) NOT NULL AUTO_INCREMENT,
  `id_entidade` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_entidade_contato`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `entidade_contato`
--

INSERT INTO `entidade_contato` (`id_entidade_contato`, `id_entidade`, `nome`, `telefone`, `email`) VALUES
(1, 1, 'Amaro Rocha Melo dos Santos', '8167-4113', 'amaro0881@gmail.com'),
(2, 1, 'Renata Guedes de Amorim Vieira', '8167-4116', 'guedes_renata@hotmail.com'),
(3, 1, 'Sandra Angelina ', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processo`
--

CREATE TABLE IF NOT EXISTS `processo` (
  `id_processo` int(11) NOT NULL AUTO_INCREMENT,
  `data_criacao` varchar(15) NOT NULL,
  `status` varchar(30) NOT NULL,
  `tipo_processo` varchar(30) NOT NULL,
  `autor` varchar(30) NOT NULL,
  `responsavel` varchar(30) NOT NULL,
  `coresponsavel` varchar(30) NOT NULL,
  `assunto` varchar(200) NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`id_processo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1002 ;

--
-- Extraindo dados da tabela `processo`
--

INSERT INTO `processo` (`id_processo`, `data_criacao`, `status`, `tipo_processo`, `autor`, `responsavel`, `coresponsavel`, `assunto`, `descricao`) VALUES
(3, '0000-00-00', '2', '0', '2', '1', '2', 'teste', 'teste2'),
(4, '0000-00-00', '6', '6', '1', '1', '2', 'tyeagf', 'sfasafsa'),
(1000, '0000-00-00', '5', '2', '2', '1', '2', 'af', 'fasfsa'),
(1001, '25/07/2012', '1', '3', '1', '1', '2', 'solicitação 1231231231231231231237123123123123 1231237123123123123123123 237123123 12312312312312371231231231231231231237 1231231231231231231237123123123  23712312312312312312312 23123123123', 'Gostaria de solicitar 123 1231231231231231231237');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processo_requerente`
--

CREATE TABLE IF NOT EXISTS `processo_requerente` (
  `id_processo_requerente` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo` int(11) NOT NULL,
  `id_requerente` varchar(200) NOT NULL,
  `observacao` varchar(500) NOT NULL,
  PRIMARY KEY (`id_processo_requerente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `processo_requerente`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `processo_sistema`
--

CREATE TABLE IF NOT EXISTS `processo_sistema` (
  `id_processo_sistema` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo` int(11) NOT NULL,
  `id_sistema` int(11) NOT NULL,
  `observacao` longtext NOT NULL,
  PRIMARY KEY (`id_processo_sistema`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `processo_sistema`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `processo_status`
--

CREATE TABLE IF NOT EXISTS `processo_status` (
  `id_processo_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id_processo_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `processo_status`
--

INSERT INTO `processo_status` (`id_processo_status`, `status`) VALUES
(1, 'Em Análise'),
(2, 'Pausada'),
(3, 'Cancelada'),
(4, 'Recusada'),
(5, 'Concluída'),
(6, 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

CREATE TABLE IF NOT EXISTS `sistema` (
  `id_sistema` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_sistema` varchar(30) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `observacao` longtext NOT NULL,
  PRIMARY KEY (`id_sistema`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`id_sistema`, `codigo_sistema`, `descricao`, `observacao`) VALUES
(1, '0CW123', 'CONTROLLER123', 'SISTEMA DE CONTROLE DE ESTOQUE123'),
(3, 'PDV', 'PONTO DE VENDA', 'SISTEMA DE PONTO DE VENDA'),
(4, 'FSA', 'FAS', 'FAS'),
(6, 'TE', 'TES', 'TEA'),
(8, '0CW', 'FSAF', 'SAFSAFSA'),
(9, 'AFSA', 'FSAFSA', 'FAS'),
(10, 'DSFSAF', 'FSF', 'FSFDA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_processo`
--

CREATE TABLE IF NOT EXISTS `tipo_processo` (
  `id_tipo_processo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_tipo_processo` varchar(30) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`id_tipo_processo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tipo_processo`
--

INSERT INTO `tipo_processo` (`id_tipo_processo`, `codigo_tipo_processo`, `descricao`) VALUES
(2, 'CORRECAO', 'CORREÇÃO'),
(3, 'SUGESTAO', 'SUGESTÃO'),
(4, 'IMPLEMENTACAO LIGISLACAO', 'IMPLEMENTAÇÃO POR CONTA DE LEGISLAÇÃO'),
(5, 'CORRECAO LEGISLACAO', ' CORREÇÃO POR CONTA DE LEGISLAÇÃO'),
(6, 'SUGESTAO2', 'SUGESTÃO PARA ATENDER OUTRAS ÁREAS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(8) DEFAULT NULL,
  `acesso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `acesso`) VALUES
(1, 'Administrador do sistema', 'admin', 'admin', 1),
(2, 'Amaro Rocha', 'Amaro', '123456', 1),
(3, 'Marcelo Alves', 'Alves', '123456', 1),
(4, 'Marco Pinheiro', 'Pinheiro', '123456', 1);
