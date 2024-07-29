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
-- Definition of table `emprestimo`
--

DROP TABLE IF EXISTS `emprestimo`;
CREATE TABLE `emprestimo` (
  `idemprestimo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idusuario` int(10) unsigned NOT NULL DEFAULT 0,
  `dataEmprestimo` date DEFAULT NULL,
  `horaInicial` time NOT NULL DEFAULT '00:00:00',
  `horaFim` time NOT NULL DEFAULT '00:00:00',
  `codigoEmprestimo` varchar(20) NOT NULL,
  `devolvido` char(1) NOT NULL DEFAULT '',
  `prioridade` varchar(15) NOT NULL DEFAULT '',
  `observacao` varchar(400) DEFAULT NULL,
  `cadastro` datetime NOT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idemprestimo`,`idusuario`) USING BTREE,
  UNIQUE KEY `idaluguel` (`idemprestimo`) USING BTREE,
  KEY `FK_aluguel_usuario` (`idusuario`),
  CONSTRAINT `FK_aluguel_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emprestimo`
--

/*!40000 ALTER TABLE `emprestimo` DISABLE KEYS */;
INSERT INTO `emprestimo` (`idemprestimo`,`idusuario`,`dataEmprestimo`,`horaInicial`,`horaFim`,`codigoEmprestimo`,`devolvido`,`prioridade`,`observacao`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,2,'2024-07-09','08:00:00','16:30:00','668be6995757f','S','1','','2024-07-08 10:16:09','2024-07-29 09:41:30','A'),
 (3,2,'2024-07-08','14:00:00','15:00:00','668c1918348b2','S','1','','2024-07-08 13:51:36','2024-07-29 09:41:30','A'),
 (4,2,'2024-07-08','15:00:00','17:00:00','668c226422cdb','S','1','','2024-07-08 14:31:16','2024-07-29 09:41:30','A'),
 (5,1,'2024-07-23','15:00:00','17:30:00','669feb82f020f','S','2','NAO','2024-07-23 14:42:26','2024-07-29 09:41:30','A'),
 (6,1,'2024-07-25','15:00:00','18:30:00','66a28f1079500','N','1','NAO','2024-07-25 14:44:48','2024-07-29 09:41:30','A'),
 (7,2,'2024-07-26','09:30:00','18:30:00','66a3954107a90','N','2','NAO','2024-07-26 09:23:29','2024-07-29 09:41:30','A'),
 (8,2,'2024-07-26','12:30:00','23:00:00','66a3affbe54d3','S','1','NAO','2024-07-26 11:17:31','2024-07-29 09:41:31','A'),
 (9,2,'2024-07-29','10:00:00','20:00:00','66a78f004e023','N','3','Uso pessoal :)','2024-07-29 09:45:52','2024-07-29 09:45:52','A');
/*!40000 ALTER TABLE `emprestimo` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `epi`
--

/*!40000 ALTER TABLE `epi` DISABLE KEYS */;
INSERT INTO `epi` (`idepi`,`nomeEpi`,`certificado`,`foto`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Capacete classe A','45414','capacete-classe-a.png','2024-07-01 13:58:30','2024-07-02 14:33:59','A'),
 (2,'Cinturão do tipo paraquedista','46159','6690108c370f1_cinturao-tipo-paraquedista.png','2024-07-01 14:06:03','2024-07-24 16:50:35','A'),
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estoque`
--

/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` (`idestoque`,`idepi`,`quantidade`,`disponivel`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,56,56,'2024-07-05 09:55:37','2024-07-29 10:29:35','A'),
 (2,2,40,36,'2024-07-05 09:55:37','2024-07-26 09:50:04','A'),
 (3,3,60,49,'2024-07-05 09:55:37','2024-07-29 09:45:52','A'),
 (4,4,34,27,'2024-07-05 09:55:37','2024-07-29 09:45:52','A');
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;


--
-- Definition of table `produtoemprestimo`
--

DROP TABLE IF EXISTS `produtoemprestimo`;
CREATE TABLE `produtoemprestimo` (
  `idprodutoEmprestimo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idepi` int(10) unsigned NOT NULL DEFAULT 0,
  `quantidade` int(10) unsigned NOT NULL DEFAULT 0,
  `codEmprestimo` varchar(25) NOT NULL,
  `devolucao` char(1) NOT NULL DEFAULT 'N',
  `cadastro` datetime NOT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idprodutoEmprestimo`,`idepi`) USING BTREE,
  KEY `FK_produtoemprestimo_epi` (`idepi`),
  CONSTRAINT `FK_produtoemprestimo_epi` FOREIGN KEY (`idepi`) REFERENCES `epi` (`idepi`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtoemprestimo`
--

/*!40000 ALTER TABLE `produtoemprestimo` DISABLE KEYS */;
INSERT INTO `produtoemprestimo` (`idprodutoEmprestimo`,`idepi`,`quantidade`,`codEmprestimo`,`devolucao`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,2,'668be6995757f','S','2024-07-08 10:16:09','2024-07-25 15:02:07','A'),
 (2,2,1,'668be6995757f','S','2024-07-08 10:16:09','2024-07-25 15:01:57','A'),
 (3,4,3,'668be6995757f','S','2024-07-08 10:16:09','2024-07-25 15:02:02','A'),
 (4,3,6,'668c1918348b2','N','2024-07-08 13:51:36','2024-07-08 13:51:36','A'),
 (5,4,3,'668c226422cdb','S','2024-07-08 14:31:16','2024-07-25 14:22:31','A'),
 (6,2,1,'669feb82f020f','S','2024-07-23 14:42:26','2024-07-25 14:20:05','A'),
 (7,3,2,'669feb82f020f','S','2024-07-23 14:42:26','2024-07-25 16:03:07','A'),
 (8,4,2,'669feb82f020f','S','2024-07-23 14:42:26','2024-07-25 14:19:51','A'),
 (9,1,1,'66a28e72468fa','N','2024-07-25 14:42:10','2024-07-25 14:42:10','A'),
 (10,1,1,'66a28f1079500','S','2024-07-25 14:44:48','2024-07-29 08:38:03','A'),
 (11,4,1,'66a28f1079500','S','2024-07-25 14:44:48','2024-07-29 08:39:20','A'),
 (14,4,1,'66a78f004e023','N','2024-07-29 09:45:52','2024-07-29 09:45:52','A'),
 (15,3,2,'66a78f004e023','N','2024-07-29 09:45:52','2024-07-29 09:45:52','A');
/*!40000 ALTER TABLE `produtoemprestimo` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(75) DEFAULT NULL,
  `sobrenome` varchar(120) DEFAULT NULL,
  `numero` varchar(20) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`,`nomeUsuario`,`sobrenome`,`numero`,`cpf`,`nascimento`,`matricula`,`cargo`,`email`,`senha`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Ademiro','Silva','(33) 9 6584-5625','123.658.785-55','1985-09-21','552268412','adm','ademirosilva@gmail.com','$2y$12$IwZDV8oiSeQl.Xg8LqykseYTWY1U9NLtJZM6EWURS8tOYliyO7G5C','2024-06-29 12:40:56','2024-07-11 13:32:41','A'),
 (2,'Marco','Oliveira','(33) 4 4532-5452','026.555.266-98','2000-06-08','635987952','funcionario','marco@gmail.com','$2y$12$MVHQ0YLgb0ed7oD2V/TejOaeF30G.AnV/5BSXUwn8LndrK655/ddG','2024-07-02 13:21:53','2024-07-29 10:15:45','A'),
 (3,'Clarisse','Oliveira','(23) 5 3252-3523','756.753.683-72','2006-07-23','42543966','adm','clarisse@gmail.com','$2y$12$ZuoD4MRYTEbl2txE47qCKOBp4L2WGS14tqiCHpAdr.1ei.hoxLYEO','2024-07-23 13:48:04','2024-07-23 13:48:05','A'),
 (4,'Renato Ro','Lopes','(34) 6 3664-3433','657.373.573-75','2000-07-03','26810269','adm','ronan@gmail.com','$2y$12$39VePe4PeSjkuzlEzHAGCeYkVphx5ayUosxFUHRrLGoshOENA3orS','2024-07-23 13:48:44','2024-07-24 14:53:13','A'),
 (5,'Fabio','Rodrigues','(88) 4 6784-6782','234.626.245-63','1999-06-10','53038746','rh','joao15.9@gmail.com','$2y$12$HH4T37CsgbA9ogPSpN8SW.OZXg3FhptSQha1.Ndswni4sxSQ9H/CW','2024-07-23 13:49:36','2024-07-23 13:50:48','A'),
 (10,'sadfasfasf','fasfasf','(46) 3 3464-3634','643.634.643-63','2006-07-23','10366396','funcionario','ronan@gmail.com','$2y$12$Zx4BS3MpsDgNqghJbOcjiu8GGP5oQ3P5ht9mUM9Tu5EmvWFAht/iG','2024-07-23 14:10:01','2024-07-23 14:10:01','A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
