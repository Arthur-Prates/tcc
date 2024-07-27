-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema tcc
--

CREATE DATABASE IF NOT EXISTS tcc;
USE tcc;

--
-- Definition of table `aluguel`
--

DROP TABLE IF EXISTS `aluguel`;
CREATE TABLE `aluguel` (
  `idaluguel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idusuario` int(10) unsigned NOT NULL DEFAULT 0,
  `dataAluguel` date DEFAULT NULL,
  `horaInicial` time NOT NULL DEFAULT '00:00:00',
  `horaFim` time NOT NULL DEFAULT '00:00:00',
  `codigoAluguel` varchar(20) NOT NULL DEFAULT '',
  `devolvido` char(1) NOT NULL DEFAULT '',
  `prioridade` varchar(15) NOT NULL DEFAULT '',
  `observacao` varchar(400) DEFAULT NULL,
  `cadastro` datetime NOT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idaluguel`,`idusuario`),
  UNIQUE KEY `idaluguel` (`idaluguel`),
  KEY `FK_aluguel_usuario` (`idusuario`),
  CONSTRAINT `FK_aluguel_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluguel`
--

/*!40000 ALTER TABLE `aluguel` DISABLE KEYS */;
INSERT INTO `aluguel` (`idaluguel`,`idusuario`,`dataAluguel`,`horaInicial`,`horaFim`,`codigoAluguel`,`devolvido`,`prioridade`,`observacao`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (5,2,'2024-07-09','11:30:00','20:00:00','668d3b24c1bf5','N','BAIXA','NAO','2024-07-09 10:29:08','2024-07-09 10:29:08','A'),
 (6,2,'2024-07-10','09:00:00','16:00:00','668e709850be1','N','BAIXA','Testando o aluguel','2024-07-10 08:29:28','2024-07-10 08:29:28','A');
/*!40000 ALTER TABLE `aluguel` ENABLE KEYS */;


--
-- Definition of table `epi`
--

DROP TABLE IF EXISTS `epi`;
CREATE TABLE `epi` (
  `idepi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeEpi` varchar(120) DEFAULT NULL,
  `certificado` varchar(10) DEFAULT NULL,
  `foto` varchar(245) DEFAULT NULL,
  `cadastro` datetime DEFAULT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  PRIMARY KEY (`idepi`),
  UNIQUE KEY `idepi` (`idepi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `epi`
--

/*!40000 ALTER TABLE `epi` DISABLE KEYS */;
INSERT INTO `epi` (`idepi`,`nomeEpi`,`certificado`,`foto`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Capacete classe A','45414','668fd0317f4b8_capacete-classe-a.png','2024-07-01 13:58:30','2024-07-11 09:29:37','A'),
 (2,'Cinturão do tipo paraquedista','46159','cinturao-tipo-paraquedista.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (3,'Luva de segurança','40174','luva-de-seguranca.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (4,'Sapato de segurança sem cadarço','44350','sapato-sem-cadarco.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A');
/*!40000 ALTER TABLE `epi` ENABLE KEYS */;


--
-- Definition of table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `idestoque` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idepi` int(10) unsigned NOT NULL DEFAULT 0,
  `quantidade` int(10) unsigned DEFAULT NULL,
  `disponivel` int(10) unsigned NOT NULL DEFAULT 0,
  `cadastro` datetime DEFAULT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idestoque`,`idepi`) USING BTREE,
  UNIQUE KEY `idestoque` (`idestoque`),
  KEY `FK_estoque_epi` (`idepi`),
  CONSTRAINT `FK_estoque_epi` FOREIGN KEY (`idepi`) REFERENCES `epi` (`idepi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estoque`
--

/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` (`idestoque`,`idepi`,`quantidade`,`disponivel`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,100,70,'2024-07-05 09:55:37','2024-07-10 08:29:28','A'),
 (2,2,100,64,'2024-07-05 09:55:37','2024-07-10 08:29:28','A'),
 (3,3,100,85,'2024-07-05 09:55:37','2024-07-10 08:29:28','A'),
 (4,4,100,95,'2024-07-05 09:55:37','2024-07-10 08:18:39','A');
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;


--
-- Definition of table `produtoaluguel`
--

DROP TABLE IF EXISTS `produtoaluguel`;
CREATE TABLE `produtoaluguel` (
  `idprodutoAluguel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idepi` int(10) unsigned NOT NULL DEFAULT 0,
  `quantidade` int(10) unsigned NOT NULL DEFAULT 0,
  `codAluguel` varchar(25) NOT NULL DEFAULT '',
  `devolucao` char(1) NOT NULL DEFAULT 'N',
  `cadastro` datetime NOT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idprodutoAluguel`,`idepi`),
  KEY `FK_produtoAluguel_epi` (`idepi`),
  CONSTRAINT `FK_produtoAluguel_epi` FOREIGN KEY (`idepi`) REFERENCES `epi` (`idepi`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtoaluguel`
--

/*!40000 ALTER TABLE `produtoaluguel` DISABLE KEYS */;
INSERT INTO `produtoaluguel` (`idprodutoAluguel`,`idepi`,`quantidade`,`codAluguel`,`devolucao`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,2,'668be6995757f','N','2024-07-08 10:16:09','2024-07-08 10:16:09','A'),
 (2,2,1,'668be6995757f','N','2024-07-08 10:16:09','2024-07-08 10:16:09','A'),
 (3,4,3,'668be6995757f','N','2024-07-08 10:16:09','2024-07-08 10:16:09','A'),
 (4,4,3,'668d2365b4a53','N','2024-07-09 08:47:49','2024-07-09 08:47:49','A'),
 (5,4,1,'668d2e3a983fe','N','2024-07-09 09:34:02','2024-07-09 09:34:02','A'),
 (6,3,1,'668d2e3a983fe','N','2024-07-09 09:34:02','2024-07-09 09:34:02','A'),
 (7,1,1,'668d2e3a983fe','N','2024-07-09 09:34:02','2024-07-09 09:34:02','A'),
 (8,4,1,'668d2e6b93369','N','2024-07-09 09:34:51','2024-07-09 09:34:51','A'),
 (9,3,2,'668d2e6b93369','N','2024-07-09 09:34:51','2024-07-09 09:34:51','A'),
 (10,1,1,'668d2e6b93369','N','2024-07-09 09:34:51','2024-07-09 09:34:51','A'),
 (11,3,2,'668d3b24c1bf5','N','2024-07-09 10:29:08','2024-07-09 10:29:08','A'),
 (12,4,2,'668d3b24c1bf5','N','2024-07-09 10:29:08','2024-07-09 10:29:08','A'),
 (13,1,1,'668e709850be1','N','2024-07-10 08:29:28','2024-07-10 08:29:28','A'),
 (14,2,1,'668e709850be1','N','2024-07-10 08:29:28','2024-07-10 08:29:28','A'),
 (15,3,1,'668e709850be1','N','2024-07-10 08:29:28','2024-07-10 08:29:28','A');
/*!40000 ALTER TABLE `produtoaluguel` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(75) DEFAULT NULL,
  `sobrenome` varchar(120) DEFAULT NULL,
  `numero` varchar(20) NOT NULL DEFAULT '',
  `cpf` varchar(15) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `matricula` varchar(30) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `email` varchar(140) DEFAULT NULL,
  `senha` varchar(245) DEFAULT NULL,
  `cadastro` datetime DEFAULT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`,`nomeUsuario`,`sobrenome`,`numero`,`cpf`,`nascimento`,`matricula`,`cargo`,`email`,`senha`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Ademiro','Silva','','123.658.785-55','1985-09-21','552268412','adm','ademirosilva@gmail.com','$2y$12$FkTTBitYibaDb8VzfqLB7uqkb1vpnZ12vcOfZV7DljaIAuZMV4Gei','2024-06-29 12:40:56','2024-07-11 10:51:46','A'),
 (2,'Marco','Oliveira','','026.555.266-98','2000-06-08','635987952','funcionario','marco@gmail.com','$2y$12$WnUGZm5cvcOSdkN/5fTG2uKs6GR33c.UHkltgdaMEDV2K22kJ8ljO','2024-07-02 13:21:53','2024-07-11 10:51:52','A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
