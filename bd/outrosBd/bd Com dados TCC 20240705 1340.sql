-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB


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
  `idaluguel` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idepi` int(11) NOT NULL,
  `quantidade` int(10) unsigned NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `codigoAluguel` varchar(20) NOT NULL,
  `devolvido` char(1) NOT NULL DEFAULT 'N',
  `prioridade` varchar(15) NOT NULL,
  `observacao` varchar(400) DEFAULT NULL,
  `cadastro` datetime NOT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idaluguel`,`idusuario`,`idepi`) USING BTREE,
  UNIQUE KEY `idaluguel` (`idaluguel`),
  KEY `aluguel_fk1` (`idusuario`),
  KEY `aluguel_fk2` (`idepi`),
  CONSTRAINT `aluguel_epi` FOREIGN KEY (`idepi`) REFERENCES `epi` (`idepi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aluguel_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluguel`
--

/*!40000 ALTER TABLE `aluguel` DISABLE KEYS */;
INSERT INTO `aluguel` (`idaluguel`,`idusuario`,`idepi`,`quantidade`,`dataInicio`,`dataFim`,`codigoAluguel`,`devolvido`,`prioridade`,`observacao`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,1,1,'2024-07-02','2024-07-02','7891027305420','N','ALTA','NAO','2024-07-02 15:52:35','2024-07-02 16:10:44','A'),
 (2,1,1,1,'2024-07-02','2024-07-02','66844c87dab1e','N','ALTA','NAO','2024-07-02 15:52:55','2024-07-02 15:52:55','A'),
 (3,1,2,2,'2024-07-02','2024-07-02','66844c87dab1e','N','ALTA','NAO','2024-07-02 15:52:55','2024-07-02 15:52:55','A'),
 (4,1,2,3,'2024-07-02','2024-07-02','66845a1775553','N','ALTA','NAO','2024-07-02 16:50:47','2024-07-02 16:50:47','A'),
 (5,1,4,1,'2024-07-02','2024-07-02','66845a1775553','N','ALTA','NAO','2024-07-02 16:50:47','2024-07-02 16:50:47','A'),
 (6,1,3,1,'2024-07-02','2024-07-02','66845a1775553','N','ALTA','NAO','2024-07-02 16:50:47','2024-07-02 16:50:47','A'),
 (7,1,2,3,'2024-07-02','2024-07-02','66845a2a4b0fe','N','ALTA','NAO','2024-07-02 16:51:06','2024-07-02 16:51:06','A'),
 (8,1,4,1,'2024-07-02','2024-07-02','66845a2a4b0fe','N','ALTA','NAO','2024-07-02 16:51:06','2024-07-02 16:51:06','A'),
 (9,1,3,1,'2024-07-02','2024-07-02','66845a2a4b0fe','N','ALTA','NAO','2024-07-02 16:51:06','2024-07-02 16:51:06','A'),
 (10,1,2,3,'2024-07-02','2024-07-02','66845a71e3c4b','N','ALTA','NAO','2024-07-02 16:52:17','2024-07-02 16:52:17','A'),
 (11,1,4,1,'2024-07-02','2024-07-02','66845a71e3c4b','N','ALTA','NAO','2024-07-02 16:52:17','2024-07-02 16:52:17','A'),
 (12,1,3,1,'2024-07-02','2024-07-02','66845a71e3c4b','N','ALTA','NAO','2024-07-02 16:52:17','2024-07-02 16:52:17','A'),
 (13,1,2,3,'2024-07-02','2024-07-02','66845a7456344','N','ALTA','NAO','2024-07-02 16:52:20','2024-07-02 16:52:20','A'),
 (14,1,4,1,'2024-07-02','2024-07-02','66845a7456344','N','ALTA','NAO','2024-07-02 16:52:20','2024-07-02 16:52:20','A'),
 (15,1,3,1,'2024-07-02','2024-07-02','66845a7456344','N','ALTA','NAO','2024-07-02 16:52:20','2024-07-02 16:52:20','A'),
 (16,2,4,3,'2024-07-03','2024-07-03','668578a756223','N','BAIXA','NAO','2024-07-03 13:13:27','2024-07-03 13:13:27','A'),
 (17,2,4,5,'2024-07-03','2024-07-03','66859d8e10a3b','N','BAIXA','NAO','2024-07-03 15:50:54','2024-07-03 16:24:41','A'),
 (18,3,3,4,'2024-07-04','2024-07-04','6686e186941e7','N','MEDIA','6346','2024-07-04 14:53:10','2024-07-04 14:53:10','A'),
 (19,3,2,4,'2024-07-04','2024-07-04','6686e186941e7','N','MEDIA','6346','2024-07-04 14:53:10','2024-07-04 14:53:10','A'),
 (20,3,1,3,'2024-07-04','2024-07-04','6686e186941e7','N','MEDIA','6346','2024-07-04 14:53:10','2024-07-04 14:53:10','A'),
 (21,3,4,3,'2024-07-04','2024-07-04','6686e186941e7','N','MEDIA','6346','2024-07-04 14:53:10','2024-07-04 14:53:10','A'),
 (22,4,1,3,'2024-07-04','2024-07-04','6686e45e7582d','N','BAIXA','asfasf','2024-07-04 15:05:18','2024-07-04 15:05:18','A'),
 (23,4,2,4,'2024-07-04','2024-07-04','6686e45e7582d','N','BAIXA','asfasf','2024-07-04 15:05:18','2024-07-04 15:05:18','A'),
 (24,4,3,3,'2024-07-04','2024-07-04','6686e45e7582d','N','BAIXA','asfasf','2024-07-04 15:05:18','2024-07-04 15:05:18','A'),
 (25,4,4,7,'2024-07-04','2024-07-04','6686e45e7582d','N','BAIXA','asfasf','2024-07-04 15:05:18','2024-07-04 15:05:18','A'),
 (26,5,2,4,'2024-07-04','2024-07-04','6686e527da18b','N','ALTA','85gfjgfj','2024-07-04 15:08:39','2024-07-04 15:08:39','A'),
 (27,5,1,1,'2024-07-04','2024-07-04','6686e527da18b','N','ALTA','85gfjgfj','2024-07-04 15:08:39','2024-07-04 15:08:39','A'),
 (28,5,3,5,'2024-07-04','2024-07-04','6686e527da18b','N','ALTA','85gfjgfj','2024-07-04 15:08:39','2024-07-04 15:08:39','A'),
 (29,5,1,4,'2024-07-04','2024-07-04','6686e527da18b','N','ALTA','85gfjgfj','2024-07-04 15:08:39','2024-07-04 16:12:54','A'),
 (30,5,4,1,'2024-07-04','2024-07-04','6686e527da18b','N','ALTA','85gfjgfj','2024-07-04 15:08:39','2024-07-04 15:08:39','A'),
 (31,6,2,10,'2024-07-04','2024-07-31','6686e56440cae','N','ALTA','fghdhgf','2024-07-04 15:09:40','2024-07-04 15:09:40','A'),
 (32,6,1,4,'2024-07-04','2024-07-31','6686e56440cae','N','ALTA','fghdhgf','2024-07-04 15:09:40','2024-07-04 15:09:40','A'),
 (33,6,3,8,'2024-07-04','2024-07-31','6686e56440cae','N','ALTA','fghdhgf','2024-07-04 15:09:40','2024-07-04 15:09:40','A'),
 (34,6,4,8,'2024-07-04','2024-07-31','6686e56440cae','N','ALTA','fghdhgf','2024-07-04 15:09:40','2024-07-04 15:09:40','A'),
 (35,2,3,1,'2024-07-04','0000-00-00','6686e9a4bea61','N','BAIXA','NAO','2024-07-04 15:27:48','2024-07-04 15:27:48','A'),
 (36,2,4,2,'2024-07-04','0000-00-00','6686e9a4bea61','N','BAIXA','NAO','2024-07-04 15:27:48','2024-07-04 15:27:48','A'),
 (37,2,2,2,'2024-07-04','0000-00-00','6686e9a4bea61','N','BAIXA','NAO','2024-07-04 15:27:48','2024-07-04 15:27:48','A'),
 (38,2,1,1,'2024-07-04','0000-00-00','6686e9a4bea61','N','BAIXA','NAO','2024-07-04 15:27:48','2024-07-04 15:27:48','A');
/*!40000 ALTER TABLE `aluguel` ENABLE KEYS */;


--
-- Definition of table `epi`
--

DROP TABLE IF EXISTS `epi`;
CREATE TABLE `epi` (
  `idepi` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEpi` varchar(120) DEFAULT NULL,
  `certificado` varchar(10) DEFAULT NULL,
  `foto` varchar(245) DEFAULT NULL,
  `cadastro` datetime DEFAULT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  PRIMARY KEY (`idepi`),
  UNIQUE KEY `idepi` (`idepi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `epi`
--

/*!40000 ALTER TABLE `epi` DISABLE KEYS */;
INSERT INTO `epi` (`idepi`,`nomeEpi`,`certificado`,`foto`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Capacete classe A','45414','capacete-classe-a.png','2024-07-01 13:58:30','2024-07-02 14:33:59','A'),
 (2,'Cinturão do tipo paraquedista','46159','cinturao-tipo-paraquedista.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (3,'Luva de segurança','40174','luva-de-seguranca.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (4,'Sapato de segurança sem cadarço','44350','sapato-sem-cadarco.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (5,'Macacão','46445','macacao-de-seguranca.jpg','2024-07-04 14:22:28','2024-07-04 16:00:46','A');
/*!40000 ALTER TABLE `epi` ENABLE KEYS */;


--
-- Definition of table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `idestoque` int(11) NOT NULL AUTO_INCREMENT,
  `idepi` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `cadastro` datetime DEFAULT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  PRIMARY KEY (`idestoque`,`idepi`) USING BTREE,
  UNIQUE KEY `idestoque` (`idestoque`),
  KEY `estoque_fk1` (`idepi`),
  CONSTRAINT `estoque_epi` FOREIGN KEY (`idepi`) REFERENCES `epi` (`idepi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estoque`
--

/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` (`idestoque`,`idepi`,`quantidade`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,23,'2024-07-05 13:19:42','2024-07-05 13:19:57','A'),
 (2,2,17,'2024-07-05 13:19:42','2024-07-05 13:19:57','A'),
 (3,3,8,'2024-07-05 13:19:42','2024-07-05 13:19:57','A'),
 (4,4,50,'2024-07-05 13:19:42','2024-07-05 13:19:57','A'),
 (5,5,14,'2024-07-05 13:19:42','2024-07-05 13:19:57','A');
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;


--
-- Definition of table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE `telefone` (
  `idtelefone` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `cadastro` datetime DEFAULT NULL,
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  PRIMARY KEY (`idtelefone`,`idusuario`) USING BTREE,
  UNIQUE KEY `idtelefone` (`idtelefone`),
  KEY `telefone_fk1` (`idusuario`),
  CONSTRAINT `telefone_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `telefone`
--

/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(75) DEFAULT NULL,
  `sobrenome` varchar(120) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`,`nomeUsuario`,`sobrenome`,`cpf`,`nascimento`,`matricula`,`cargo`,`email`,`senha`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Ademiro','Silva','123.658.785-55','1985-09-21','552268412','adm','ademirosilva@gmail.com','$2y$12$IwZDV8oiSeQl.Xg8LqykseYTWY1U9NLtJZM6EWURS8tOYliyO7G5C','2024-06-29 12:40:56','2024-07-02 16:17:42','A'),
 (2,'Marco','Oliveira','026.555.266-98','2000-06-08','635987952','funcionario','marco@gmail.com','$2y$12$MVHQ0YLgb0ed7oD2V/TejOaeF30G.AnV/5BSXUwn8LndrK655/ddG','2024-07-02 13:21:53','2024-07-03 16:49:11','A'),
 (3,'Luciano','Pettersen','121.666.444-76','1975-05-20','432525566','adm','luciano@gmail.com','$2y$12$A12kuNsV6nMuaU7qOshSzOfMLuWnAU4ShYdacNgNRnNwcke1Tjh3G','2024-07-03 16:49:11','2024-07-04 14:53:41','A'),
 (4,'Rickelme','Ribeiro','123.145.767-34','2005-01-15','987654313','almoxarife','rickelme@gmail.com','$2y$12$3plLPn9Ng.XEhqBXl8nOn.5IM.9n6ehr12YtWP2JDuUlCG4q0lx0O','2024-07-03 16:49:11','2024-07-04 14:52:40','A'),
 (5,'Clarrise','Oliveira','111.111.111-11','2005-01-15','346433462','adm','clarisse@gmail.com','$2y$12$3plLPn9Ng.XEhqBXl8nOn.5IM.9n6ehr12YtWP2JDuUlCG4q0lx0O',NULL,'2024-07-04 15:06:49','A'),
 (6,'Ronan','Asfaf','235.547.123-53','1975-05-20','654754754','adm','ronan@gmail.com','$2y$12$3plLPn9Ng.XEhqBXl8nOn.5IM.9n6ehr12YtWP2JDuUlCG4q0lx0O',NULL,'2024-07-04 15:07:44','A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
