-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Fev 13, 2013 as 08:40 PM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

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
  `utiliza_sistema` tinyint(1) NOT NULL,
  `senha` varchar(11) NOT NULL,
  `acesso` int(11) NOT NULL,
  PRIMARY KEY (`id_entidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  PRIMARY KEY (`id_entidade_contato`),
  KEY `fk_id_entidade` (`id_entidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `processo_status`
--

CREATE TABLE IF NOT EXISTS `processo_status` (
  `id_processo_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id_processo_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
