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
  `idaluguel` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idepi` int(11) NOT NULL,
  `quantidade` int(10) unsigned NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `codigoAluguel` varchar(20) NOT NULL,
  `devolvido` char(1) NOT NULL DEFAULT '',
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluguel`
--

/*!40000 ALTER TABLE `aluguel` DISABLE KEYS */;
INSERT INTO `aluguel` (`idaluguel`,`idusuario`,`idepi`,`quantidade`,`dataInicio`,`dataFim`,`codigoAluguel`,`devolvido`,`prioridade`,`observacao`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,1,1,'2024-07-02','2024-07-02','7891027305420','S','ALTA','NAO','2024-07-02 15:52:35','2024-07-04 09:03:38','A'),
 (2,1,1,1,'2024-07-02','2024-07-02','66844c87dab1e','S','ALTA','NAO','2024-07-02 15:52:55','2024-07-04 09:03:38','A'),
 (3,1,2,2,'2024-07-02','2024-07-02','66844c87dab1e','S','ALTA','NAO','2024-07-02 15:52:55','2024-07-04 09:03:38','A'),
 (4,1,2,3,'2024-07-02','2024-07-02','66845a1775553','S','ALTA','NAO','2024-07-02 16:50:47','2024-07-04 09:03:38','A'),
 (5,1,4,1,'2024-07-02','2024-07-02','66845a1775553','S','ALTA','NAO','2024-07-02 16:50:47','2024-07-04 09:03:38','A'),
 (6,1,3,1,'2024-07-02','2024-07-02','66845a1775553','S','ALTA','NAO','2024-07-02 16:50:47','2024-07-04 09:03:38','A'),
 (7,1,2,3,'2024-07-02','2024-07-02','66845a2a4b0fe','S','ALTA','NAO','2024-07-02 16:51:06','2024-07-04 09:03:39','A'),
 (8,1,4,1,'2024-07-02','2024-07-02','66845a2a4b0fe','S','ALTA','NAO','2024-07-02 16:51:06','2024-07-04 09:03:39','A'),
 (9,1,3,1,'2024-07-02','2024-07-02','66845a2a4b0fe','S','ALTA','NAO','2024-07-02 16:51:06','2024-07-04 09:03:39','A'),
 (10,1,2,3,'2024-07-02','2024-07-02','66845a71e3c4b','S','ALTA','NAO','2024-07-02 16:52:17','2024-07-04 09:03:39','A'),
 (11,1,4,1,'2024-07-02','2024-07-02','66845a71e3c4b','S','ALTA','NAO','2024-07-02 16:52:17','2024-07-04 09:03:39','A'),
 (12,1,3,1,'2024-07-02','2024-07-02','66845a71e3c4b','S','ALTA','NAO','2024-07-02 16:52:17','2024-07-04 09:03:39','A'),
 (13,1,2,3,'2024-07-02','2024-07-02','66845a7456344','S','ALTA','NAO','2024-07-02 16:52:20','2024-07-04 09:03:39','A'),
 (14,1,4,1,'2024-07-02','2024-07-02','66845a7456344','S','ALTA','NAO','2024-07-02 16:52:20','2024-07-04 09:03:39','A'),
 (15,1,3,1,'2024-07-02','2024-07-02','66845a7456344','S','ALTA','NAO','2024-07-02 16:52:20','2024-07-04 09:03:39','A'),
 (16,1,2,1,'2024-07-03','2024-07-03','66853f86a8655','S','ALTA','NAO','2024-07-03 09:09:42','2024-07-04 09:03:39','A'),
 (17,2,4,2,'2024-07-03','2024-07-05','66854a114fe67','S','media','','2024-07-03 09:54:41','2024-07-04 09:03:39','A'),
 (18,2,4,2,'2024-07-03','2024-07-05','66854c82b0af0','S','media','','2024-07-03 10:05:06','2024-07-04 09:03:39','A'),
 (19,2,4,1,'2024-07-03','2024-07-03','66854c935d2a0','S','BAIXA','','2024-07-03 10:05:23','2024-07-04 09:03:38','A'),
 (20,2,1,1,'2024-07-03','2024-07-03','66854cc06cbbe','S','ALTA','Estou precisando para ontem','2024-07-03 10:06:08','2024-07-04 09:03:38','A'),
 (21,2,2,1,'2024-07-03','2024-07-03','66854cc06cbbe','S','ALTA','Estou precisando para ontem','2024-07-03 10:06:08','2024-07-04 09:03:38','A'),
 (25,2,4,1,'2024-07-03','2024-07-03','66854d2c7d764','S','BAIXA','dddddddd','2024-07-03 10:07:56','2024-07-04 09:03:38','A'),
 (26,2,4,1,'2024-07-03','2024-07-03','66854d4444a95','S','BAIXA','Mexer no poste','2024-07-03 10:08:20','2024-07-04 09:03:39','A'),
 (27,2,3,2,'2024-07-03','2024-07-03','66854d4444a95','S','BAIXA','Mexer no poste','2024-07-03 10:08:20','2024-07-04 09:03:39','A'),
 (28,2,4,1,'2024-07-03','2024-07-10','66854face95fe','S','MEDIA','NAO','2024-07-03 10:18:36','2024-07-04 09:03:38','A'),
 (29,2,3,1,'2024-07-03','2024-07-10','66854face95fe','S','MEDIA','NAO','2024-07-03 10:18:36','2024-07-04 09:03:38','A'),
 (30,2,2,5,'2024-07-03','2024-07-10','66854face95fe','S','MEDIA','NAO','2024-07-03 10:18:36','2024-07-04 09:03:38','A'),
 (31,1,2,2,'2024-07-03','2024-07-03','6685506e784f7','S','ALTA','NAO','2024-07-03 10:21:50','2024-07-04 09:03:38','A'),
 (32,1,2,2,'2024-07-03','2024-07-03','66855072522bb','S','ALTA','NAO','2024-07-03 10:21:54','2024-07-04 09:03:38','A'),
 (33,2,2,2,'2024-07-03','2024-07-03','6685540fd13d0','S','BAIXA','NAO','2024-07-03 10:37:19','2024-07-04 09:03:38','A'),
 (34,2,4,2,'2024-07-03','2024-07-03','6685543d237b2','S','BAIXA','NAO','2024-07-03 10:38:05','2024-07-04 09:03:38','A'),
 (35,2,1,1,'2024-07-03','2024-07-03','6685543d237b2','S','BAIXA','NAO','2024-07-03 10:38:05','2024-07-04 09:03:38','A'),
 (36,2,1,1,'2024-07-04','2024-07-04','668683ac2d458','S','BAIXA','NAO','2024-07-04 08:12:44','2024-07-04 09:03:38','A');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `epi`
--

/*!40000 ALTER TABLE `epi` DISABLE KEYS */;
INSERT INTO `epi` (`idepi`,`nomeEpi`,`certificado`,`foto`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Capacete classe A','45414','capacete-classe-a.png','2024-07-01 13:58:30','2024-07-02 14:33:59','A'),
 (2,'Cinturão do tipo paraquedista','46159','cinturao-tipo-paraquedista.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (3,'Luva de segurança','40174','luva-de-seguranca.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (4,'Sapato de segurança sem cadarço','44350','sapato-sem-cadarco.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A');
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
  `ativo` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idestoque`,`idepi`) USING BTREE,
  UNIQUE KEY `idestoque` (`idestoque`),
  KEY `estoque_fk1` (`idepi`),
  CONSTRAINT `estoque_epi` FOREIGN KEY (`idepi`) REFERENCES `epi` (`idepi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estoque`
--

/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idusuario`,`nomeUsuario`,`sobrenome`,`cpf`,`nascimento`,`matricula`,`cargo`,`email`,`senha`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Ademiro','Silva','123.658.785-55','1985-09-21','552268412','adm','ademirosilva@gmail.com','$2y$12$IwZDV8oiSeQl.Xg8LqykseYTWY1U9NLtJZM6EWURS8tOYliyO7G5C','2024-06-29 12:40:56','2024-07-02 16:17:42','A'),
 (2,'Marco','Oliveira','026.555.266.98','2000-06-08','635987952','funcionario','marco@gmail.com','$2y$12$MVHQ0YLgb0ed7oD2V/TejOaeF30G.AnV/5BSXUwn8LndrK655/ddG','2024-07-02 13:21:53','2024-07-02 16:17:39','A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
