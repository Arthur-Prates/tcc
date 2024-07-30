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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
 (9,2,'2024-07-29','10:00:00','20:00:00','66a78f004e023','N','3','Uso pessoal :)','2024-07-29 09:45:52','2024-07-29 14:55:26','A'),
 (10,1,'2024-07-30','08:30:00','09:00:00','66a7f07dc51cb','N','1','NAO','2024-07-29 16:41:49','2024-07-29 16:41:49','A'),
 (11,1,'2024-10-08','00:00:00','17:00:00','66a7f15b36be4','N','1','NAO','2024-07-29 16:45:31','2024-07-29 16:45:31','A'),
 (12,1,'2024-10-08','00:00:00','17:00:00','66a7f16689a5f','N','1','NAO','2024-07-29 16:45:42','2024-07-29 16:45:42','A'),
 (13,1,'2024-10-08','00:00:00','17:00:00','66a7f2269ab40','N','1','NAO','2024-07-29 16:48:54','2024-07-29 16:48:54','A'),
 (14,1,'2024-10-08','00:00:00','17:00:00','66a7f239c4dc5','N','1','NAO','2024-07-29 16:49:13','2024-07-29 16:49:13','A'),
 (15,1,'2024-10-08','00:00:00','17:00:00','66a7f24c6fb1d','N','1','NAO','2024-07-29 16:49:32','2024-07-29 16:49:32','A'),
 (16,1,'2024-10-08','00:00:00','17:00:00','66a7f271a55d8','N','1','NAO','2024-07-29 16:50:09','2024-07-29 16:50:09','A'),
 (17,1,'2024-10-08','00:00:00','17:00:00','66a7f27cdb42c','N','1','NAO','2024-07-29 16:50:20','2024-07-29 16:50:20','A'),
 (18,1,'2024-10-08','00:00:00','17:00:00','66a7f285309c9','N','1','NAO','2024-07-29 16:50:29','2024-07-29 16:50:29','A'),
 (19,1,'2024-10-08','00:00:00','17:00:00','66a7f28c2ec84','N','1','NAO','2024-07-29 16:50:36','2024-07-29 16:50:36','A'),
 (20,27,'2024-10-08','00:00:00','17:00:00','66a8e8a92e183','N','1','NAO','2024-07-30 10:20:41','2024-07-30 10:20:41','A'),
 (21,27,'2024-10-08','06:00:00','17:00:00','66a8e8bbb0232','N','1','NAO','2024-07-30 10:20:59','2024-07-30 10:20:59','A'),
 (22,27,'2024-10-08','08:00:00','17:00:00','66a8e8ca84659','N','1','NAO','2024-07-30 10:21:14','2024-07-30 10:21:14','A'),
 (23,45,'2024-10-07','08:30:00','17:00:00','66a8e94e91288','N','1','NAO','2024-07-30 10:23:26','2024-07-30 10:23:26','A'),
 (24,45,'2024-10-10','09:00:00','17:00:00','66a8e96326eda','N','2','NAO','2024-07-30 10:23:47','2024-07-30 10:23:47','A'),
 (25,45,'2024-08-31','00:00:00','17:00:00','66a8e98e8a770','N','1','NAO','2024-07-30 10:24:30','2024-07-30 10:24:30','A'),
 (26,45,'2024-08-08','07:30:00','17:00:00','66a8e9c3d8b43','N','1','NAO','2024-07-30 10:25:23','2024-07-30 10:25:23','A'),
 (27,58,'2024-08-08','08:30:00','17:00:00','66a8ea151c95d','N','1','NAO','2024-07-30 10:26:45','2024-07-30 10:26:45','A'),
 (28,58,'2024-08-08','08:00:00','17:00:00','66a8ea26b733d','N','1','NAO','2024-07-30 10:27:02','2024-07-30 10:27:02','A'),
 (29,58,'2024-08-08','08:00:00','17:00:00','66a8eae99f628','N','1','NAO','2024-07-30 10:30:17','2024-07-30 10:30:17','A'),
 (30,58,'2024-08-05','08:00:00','17:00:00','66a8eb573b1a9','N','1','NAO','2024-07-30 10:32:07','2024-07-30 10:32:07','A'),
 (31,58,'2024-07-31','09:00:00','17:00:00','66a8eb65a8ca8','N','1','NAO','2024-07-30 10:32:21','2024-07-30 10:32:21','A'),
 (32,2,'2024-08-01','08:30:00','17:00:00','66a8eec092b96','N','1','NAO','2024-07-30 10:46:40','2024-07-30 10:46:40','A'),
 (33,2,'2024-07-30','14:00:00','17:00:00','66a8eee29de6d','N','1','NAO','2024-07-30 10:47:14','2024-07-30 10:47:14','A'),
 (34,2,'2024-08-03','07:00:00','17:00:00','66a8ef0460ffd','N','2','NAO','2024-07-30 10:47:48','2024-07-30 10:47:48','A'),
 (35,2,'2024-08-04','09:00:00','17:00:00','66a8ef17412da','N','2','NAO','2024-07-30 10:48:07','2024-07-30 10:48:07','A'),
 (36,2,'2024-08-08','08:30:00','17:00:00','66a8ef2831177','N','2','NAO','2024-07-30 10:48:24','2024-07-30 10:48:24','A'),
 (37,2,'2024-08-01','09:00:00','17:00:00','66a8ef3b9c561','N','1','NAO','2024-07-30 10:48:43','2024-07-30 10:48:43','A'),
 (38,2,'2024-07-31','00:00:00','17:00:00','66a8ef5285b35','N','3','NAO','2024-07-30 10:49:06','2024-07-30 10:49:06','A'),
 (39,2,'2024-07-30','11:00:00','17:00:00','66a8ef716026e','N','3','NAO','2024-07-30 10:49:37','2024-07-30 10:49:37','A'),
 (40,2,'2024-08-31','04:00:00','17:00:00','66a8ef8ba2841','N','2','NAO','2024-07-30 10:50:03','2024-07-30 10:50:03','A'),
 (41,2,'2024-08-31','11:00:00','17:00:00','66a8efb5d1ac0','N','2','NAO','2024-07-30 10:50:45','2024-07-30 10:50:45','A'),
 (42,2,'2024-08-02','08:00:00','17:00:00','66a8efcbcf981','N','1','NAO','2024-07-30 10:51:07','2024-07-30 10:51:07','A'),
 (43,2,'2024-07-30','13:00:00','17:00:00','66a8eff3a8731','N','3','NAO','2024-07-30 10:51:47','2024-07-30 10:51:47','A'),
 (44,2,'2024-08-04','08:00:00','17:00:00','66a8f3089de3d','N','1','NAO','2024-07-30 11:04:56','2024-07-30 11:04:56','A');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `epi`
--

/*!40000 ALTER TABLE `epi` DISABLE KEYS */;
INSERT INTO `epi` (`idepi`,`nomeEpi`,`certificado`,`foto`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'Capacete classe A','45414','capacete-classe-a.png','2024-07-01 13:58:30','2024-07-02 14:33:59','A'),
 (2,'Cinturão do tipo paraquedista','46159','6690108c370f1_cinturao-tipo-paraquedista.png','2024-07-01 14:06:03','2024-07-24 16:50:35','A'),
 (3,'Luva de segurança','40174','luva-de-seguranca.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (4,'Sapato de segurança sem cadarço','44350','sapato-sem-cadarco.png','2024-07-01 14:06:03','2024-07-02 14:33:59','A'),
 (16,'Avental Térmico em PVC','37999','66a7da0d35df5_avental-termico-em-pvc-rio-valley-para-media-temperatura-ate-200-antichama-ca-37999.png','2024-07-29 15:06:05','2024-07-30 09:02:25','A'),
 (17,'Botina de segurança em couro vaqueta','45611','66a7da5cc0a21_botina-de-seguranca-couro-vaqueta-marluvas-sem-bico-50b26_l11.png','2024-07-29 15:07:24','2024-07-29 15:07:24','A'),
 (18,'Japona operacional preta vertice com capuz','28733','66a7dab44eb2e_japona-operacional-preta-vertice-com-capuz-em-nylon-emborrachado-impermeavel-e-termica-ca-28729_z3.png','2024-07-29 15:08:52','2024-07-30 09:02:25','A'),
 (19,'Avental barbeiro kourion amarelo em algodão','28326','66a7db178af30_avental-barbeiro-kourion-amarelo-algodao.png','2024-07-29 15:10:31','2024-07-29 15:10:31','A'),
 (20,'Luva de algodão reciclado com latex reciflex dany','31325','66a7db6e2d1ad_1046629_luva-de-algodao-recilcado-com-latex-reciflex-danny-madeira-e-alvenaria.png','2024-07-29 15:11:58','2024-07-30 09:02:25','A'),
 (21,'Luva Hishildgrip kevlar','42750','66a7dbd0d520e_luva-hishieldgrip-kevlar-pecas-altamente-afiadas-alto-nivel-de-pega.png','2024-07-29 15:13:36','2024-07-30 09:02:25','A');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estoque`
--

/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` (`idestoque`,`idepi`,`quantidade`,`disponivel`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,1,56,46,'2024-07-05 09:55:37','2024-07-30 11:04:56','A'),
 (2,2,40,29,'2024-07-05 09:55:37','2024-07-30 11:04:56','A'),
 (3,3,60,43,'2024-07-05 09:55:37','2024-07-30 10:51:07','A'),
 (4,4,34,20,'2024-07-05 09:55:37','2024-07-30 10:51:07','A'),
 (10,16,21,16,'2024-07-29 15:06:05','2024-07-30 10:47:14','A'),
 (11,17,65,56,'2024-07-29 15:07:24','2024-07-30 10:51:47','A'),
 (12,18,24,19,'2024-07-29 15:08:52','2024-07-30 10:48:24','A'),
 (13,19,29,20,'2024-07-29 15:10:31','2024-07-30 10:51:47','A'),
 (14,20,52,43,'2024-07-29 15:11:58','2024-07-30 10:50:03','A'),
 (15,21,48,38,'2024-07-29 15:13:36','2024-07-30 11:04:56','A');
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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
 (14,4,1,'66a78f004e023','N','2024-07-29 09:45:52','2024-07-29 14:56:59','A'),
 (15,3,2,'66a78f004e023','N','2024-07-29 09:45:52','2024-07-29 14:55:34','A'),
 (16,3,1,'66a7f07dc51cb','N','2024-07-29 16:41:49','2024-07-29 16:41:49','A'),
 (17,2,1,'66a7f07dc51cb','N','2024-07-29 16:41:49','2024-07-29 16:41:49','A'),
 (18,1,1,'66a7f07dc51cb','N','2024-07-29 16:41:49','2024-07-29 16:41:49','A'),
 (19,16,1,'66a7f15b36be4','N','2024-07-29 16:45:31','2024-07-29 16:45:31','A'),
 (20,20,1,'66a7f15b36be4','N','2024-07-29 16:45:31','2024-07-29 16:45:31','A'),
 (21,21,1,'66a7f15b36be4','N','2024-07-29 16:45:31','2024-07-29 16:45:31','A'),
 (22,19,1,'66a7f15b36be4','N','2024-07-29 16:45:31','2024-07-29 16:45:31','A'),
 (23,18,1,'66a7f16689a5f','N','2024-07-29 16:45:42','2024-07-29 16:45:42','A'),
 (24,19,1,'66a7f16689a5f','N','2024-07-29 16:45:42','2024-07-29 16:45:42','A'),
 (25,4,1,'66a7f2269ab40','N','2024-07-29 16:48:54','2024-07-29 16:48:54','A'),
 (26,21,1,'66a7f2269ab40','N','2024-07-29 16:48:54','2024-07-29 16:48:54','A'),
 (27,20,1,'66a7f2269ab40','N','2024-07-29 16:48:54','2024-07-29 16:48:54','A'),
 (28,17,1,'66a7f2269ab40','N','2024-07-29 16:48:54','2024-07-29 16:48:54','A'),
 (29,20,1,'66a7f239c4dc5','N','2024-07-29 16:49:13','2024-07-29 16:49:13','A'),
 (30,16,1,'66a7f239c4dc5','N','2024-07-29 16:49:13','2024-07-29 16:49:13','A'),
 (31,19,1,'66a7f239c4dc5','N','2024-07-29 16:49:13','2024-07-29 16:49:13','A'),
 (32,4,1,'66a7f239c4dc5','N','2024-07-29 16:49:13','2024-07-29 16:49:14','A'),
 (33,20,1,'66a7f24c6fb1d','N','2024-07-29 16:49:32','2024-07-29 16:49:32','A'),
 (34,18,1,'66a7f271a55d8','N','2024-07-29 16:50:09','2024-07-29 16:50:09','A'),
 (35,16,1,'66a7f271a55d8','N','2024-07-29 16:50:09','2024-07-29 16:50:09','A'),
 (36,1,1,'66a7f271a55d8','N','2024-07-29 16:50:09','2024-07-29 16:50:09','A'),
 (37,21,1,'66a7f27cdb42c','N','2024-07-29 16:50:20','2024-07-29 16:50:20','A'),
 (38,1,1,'66a7f285309c9','N','2024-07-29 16:50:29','2024-07-29 16:50:29','A'),
 (39,4,1,'66a7f28c2ec84','N','2024-07-29 16:50:36','2024-07-29 16:50:36','A'),
 (40,3,1,'66a8e8a92e183','N','2024-07-30 10:20:41','2024-07-30 10:20:41','A'),
 (41,19,1,'66a8e8bbb0232','N','2024-07-30 10:20:59','2024-07-30 10:20:59','A'),
 (42,18,1,'66a8e8ca84659','N','2024-07-30 10:21:14','2024-07-30 10:21:14','A'),
 (43,17,1,'66a8e94e91288','N','2024-07-30 10:23:26','2024-07-30 10:23:26','A'),
 (44,21,1,'66a8e94e91288','N','2024-07-30 10:23:26','2024-07-30 10:23:26','A'),
 (45,20,1,'66a8e96326eda','N','2024-07-30 10:23:47','2024-07-30 10:23:47','A'),
 (46,16,1,'66a8e98e8a770','N','2024-07-30 10:24:30','2024-07-30 10:24:30','A'),
 (47,17,1,'66a8e9c3d8b43','N','2024-07-30 10:25:23','2024-07-30 10:25:23','A'),
 (48,17,1,'66a8ea151c95d','N','2024-07-30 10:26:45','2024-07-30 10:26:45','A'),
 (49,21,1,'66a8ea151c95d','N','2024-07-30 10:26:45','2024-07-30 10:26:45','A'),
 (50,18,1,'66a8ea151c95d','N','2024-07-30 10:26:45','2024-07-30 10:26:45','A'),
 (51,3,1,'66a8ea26b733d','N','2024-07-30 10:27:02','2024-07-30 10:27:02','A'),
 (52,19,1,'66a8ea26b733d','N','2024-07-30 10:27:02','2024-07-30 10:27:02','A'),
 (53,20,1,'66a8eae99f628','N','2024-07-30 10:30:17','2024-07-30 10:30:17','A'),
 (54,1,1,'66a8eae99f628','N','2024-07-30 10:30:17','2024-07-30 10:30:17','A'),
 (55,2,1,'66a8eae99f628','N','2024-07-30 10:30:17','2024-07-30 10:30:17','A'),
 (56,3,1,'66a8eb573b1a9','N','2024-07-30 10:32:07','2024-07-30 10:32:07','A'),
 (57,4,1,'66a8eb65a8ca8','N','2024-07-30 10:32:21','2024-07-30 10:32:21','A'),
 (58,2,1,'66a8eec092b96','N','2024-07-30 10:46:40','2024-07-30 10:46:40','A'),
 (59,1,1,'66a8eec092b96','N','2024-07-30 10:46:40','2024-07-30 10:46:40','A'),
 (60,3,1,'66a8eec092b96','N','2024-07-30 10:46:40','2024-07-30 10:46:40','A'),
 (61,17,1,'66a8eee29de6d','N','2024-07-30 10:47:14','2024-07-30 10:47:14','A'),
 (62,20,1,'66a8eee29de6d','N','2024-07-30 10:47:14','2024-07-30 10:47:14','A'),
 (63,16,1,'66a8eee29de6d','N','2024-07-30 10:47:14','2024-07-30 10:47:14','A'),
 (64,19,1,'66a8ef0460ffd','N','2024-07-30 10:47:48','2024-07-30 10:47:48','A'),
 (65,21,1,'66a8ef0460ffd','N','2024-07-30 10:47:48','2024-07-30 10:47:48','A'),
 (66,1,1,'66a8ef17412da','N','2024-07-30 10:48:07','2024-07-30 10:48:07','A'),
 (67,4,1,'66a8ef17412da','N','2024-07-30 10:48:07','2024-07-30 10:48:07','A'),
 (68,19,1,'66a8ef17412da','N','2024-07-30 10:48:07','2024-07-30 10:48:07','A'),
 (69,1,1,'66a8ef2831177','N','2024-07-30 10:48:24','2024-07-30 10:48:24','A'),
 (70,18,1,'66a8ef2831177','N','2024-07-30 10:48:24','2024-07-30 10:48:24','A'),
 (71,1,1,'66a8ef3b9c561','N','2024-07-30 10:48:43','2024-07-30 10:48:43','A'),
 (72,2,1,'66a8ef3b9c561','N','2024-07-30 10:48:43','2024-07-30 10:48:43','A'),
 (73,21,1,'66a8ef3b9c561','N','2024-07-30 10:48:43','2024-07-30 10:48:43','A'),
 (74,20,1,'66a8ef5285b35','N','2024-07-30 10:49:06','2024-07-30 10:49:06','A'),
 (75,17,1,'66a8ef5285b35','N','2024-07-30 10:49:06','2024-07-30 10:49:06','A'),
 (76,19,1,'66a8ef5285b35','N','2024-07-30 10:49:06','2024-07-30 10:49:06','A'),
 (77,21,1,'66a8ef716026e','N','2024-07-30 10:49:37','2024-07-30 10:49:37','A'),
 (78,17,1,'66a8ef716026e','N','2024-07-30 10:49:37','2024-07-30 10:49:37','A'),
 (79,2,1,'66a8ef716026e','N','2024-07-30 10:49:37','2024-07-30 10:49:37','A'),
 (80,20,1,'66a8ef8ba2841','N','2024-07-30 10:50:03','2024-07-30 10:50:03','A'),
 (81,4,1,'66a8ef8ba2841','N','2024-07-30 10:50:03','2024-07-30 10:50:03','A'),
 (82,1,1,'66a8efb5d1ac0','N','2024-07-30 10:50:45','2024-07-30 10:50:45','A'),
 (83,17,1,'66a8efb5d1ac0','N','2024-07-30 10:50:45','2024-07-30 10:50:45','A'),
 (84,2,1,'66a8efcbcf981','N','2024-07-30 10:51:07','2024-07-30 10:51:07','A'),
 (85,3,1,'66a8efcbcf981','N','2024-07-30 10:51:07','2024-07-30 10:51:07','A'),
 (86,4,1,'66a8efcbcf981','N','2024-07-30 10:51:07','2024-07-30 10:51:07','A'),
 (87,17,1,'66a8eff3a8731','N','2024-07-30 10:51:47','2024-07-30 10:51:47','A'),
 (88,21,1,'66a8eff3a8731','N','2024-07-30 10:51:47','2024-07-30 10:51:47','A'),
 (89,19,1,'66a8eff3a8731','N','2024-07-30 10:51:47','2024-07-30 10:51:47','A'),
 (90,1,1,'66a8f3089de3d','N','2024-07-30 11:04:56','2024-07-30 11:04:56','A'),
 (91,2,1,'66a8f3089de3d','N','2024-07-30 11:04:56','2024-07-30 11:04:56','A'),
 (92,21,1,'66a8f3089de3d','N','2024-07-30 11:04:56','2024-07-30 11:04:56','A');
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
 (10,'Ronan','Menezes','(46) 3 3464-3634','643.634.643-63','2006-07-23','10366396','funcionario','ronan@gmail.com','$2y$12$DnPemzy7C4pHoCe4vVDEleGEZ1T4fmNo6XegYZgXGbJGhzoloTCIi','2024-07-23 14:10:01','2024-07-29 14:48:46','A'),
 (12,'Quezia','Campelo Bastida','(23) 4 5252-3532','547.475.457-54','1988-02-16','27952047','adm','queziacampelo@gmail.com','$2y$12$iBrumFZKiBdr9OCePnZ2YeaebxoTU4bBdLrgJ5kTuQ.Cbeoa58N/2','2024-07-29 14:44:16','2024-07-29 14:48:12','A'),
 (13,'César','Linhares Mesquita','(32) 5 2352-3645','235.325.235-23','2020-07-16','5151058','funcionario','Cesarlinharesmesquita@hotmail.com','$2y$12$zalZ3rEbPKQ2mUpRg4hpVekVmMGl355baTHAgy11UCouxyI9Q8zMy','2024-07-29 14:44:37','2024-07-29 14:49:24','A'),
 (14,'Josildo','Velasco Bastos','(85) 8 5685-6858','353.634.634-63','1988-11-26','8507745','funcionario','Josildovelascobastos@gmail.com','$2y$12$5u5zr582ODwz9IVeA7EhDehREh0WrfROj.em6MI2p1g9ZjzJpHyq6','2024-07-29 14:44:47','2024-07-29 14:50:19','A'),
 (15,'Enrico','da Sousa Queiroga','(74) 5 7547-4579','677.696.796-79','1992-05-04','10546191','rh','Enricodasousaqueiroga@outlook.com','$2y$12$96Sg9hxyVjJqXAFuNMFtLuCOhhGc6zhjYAMClZXxTGdHBdpytR0uK','2024-07-29 14:45:02','2024-07-29 14:51:17','A'),
 (16,'Neuza ',' de Jesus Pessoa','(56) 8 5685-6967','363.463.463-63','1970-08-22','77114956','funcionario','Neuzadejesuspessoa@msn.com','$2y$12$aBThyeq8hPWEeqe9/nhfM..snK2/BKQR4anqLvC4xn0ile6yz1J4q','2024-07-29 14:45:15','2024-07-29 14:51:56','A'),
 (17,'Gilson','Vasconcellos Prucho','(45) 6 4564-5645','265.352.523-52','1982-08-10','56002693','rh','Gilsonvasconcellosprucho@gmail.com','$2y$12$UjVWvisx0Njtb.81dM6Hluu5.Uu3.XpHf.ehpU3NUnph3vAmVgD7i','2024-07-29 14:53:38','2024-07-29 14:53:39','A'),
 (18,'Renata','Milanez Spilman','(63) 4 6346-3464','436.363.464-36','2017-10-20','81476760','funcionario','Renata@pinhogel.com','$2y$12$zrrzjLuyJhAfgXDgqziQFeNtyPIUjS/54Rr7LafBIVcsPki65FKvC','2024-07-29 14:55:20','2024-07-29 14:58:40','A'),
 (19,'Isadorada','Avelino','(33) 9 8719-4164','704.189.816-47','2005-07-23','49509955','funcionario','isadora@bonita.com','$2y$12$K3ODu0C9yBZjMoHsIEScd.1MYk6sZxTw1K99sGTyRwKYuz5DYlLSi','2024-07-29 15:05:01','2024-07-29 15:05:44','A'),
 (20,'Maria',' Nazaré Anastacio Gomes','(34) 6 3463-4634','234.634.634-63','1977-07-16','66381520','rh','maria@chrome.com','$2y$12$ASgK./JN7UH6zn2PaZ8dy.Vh79QXTEuZVTp2aumr3y37NtElpfxPO','2024-07-29 16:02:13','2024-07-29 16:32:11','A'),
 (21,'João','Souza Silva','(31) 2 1286-800','634.634.634','2006-07-29','73446662','funcionario','teste@exemplo.us','$2y$12$81hRLlR6iFlVPYkgFUaUl.A8KNkycjcRsRI9PkY2Fx2jgSdSEHjGG','2024-07-29 16:03:42','2024-07-29 16:03:42','A'),
 (22,'Juan','Souza Silva','(60) 1 9521-325','754.577.457-4','2004-06-04','80600533','adm','madebyve@mailinator.com','$2y$12$273CmIpSRSIWl0I.XX7k..2i/573NbcsHY/JIDYK.ZlQxlbPtCt9i','2024-07-29 16:04:39','2024-07-29 16:04:40','A'),
 (23,'Ronaldo ','Lopes','(12) 3 5987-3548','886.457.897-43','2006-07-29','57740141','almoxarife','RonaldoLopes@gmail.com','$2y$12$I1AEP3ZygPhTzGaixJ.Tw.G0h4/nP3ho6DHiqDmGlqvrkR2rv7YXS','2024-07-29 16:24:03','2024-07-29 16:24:03','A'),
 (24,'Fransiscano ','Alentejo Auzier','(46) 6 3436-6343','457.457.457-45','1982-12-09','45792244','adm','AlentejoAuzier@mailinator.com','$2y$12$ca3Ov464ecv5g9YvBrdF0eg5LFCEyoUfYHQswZSEijBJYXJtfirXW','2024-07-29 16:24:23','2024-07-29 16:24:23','A'),
 (25,'Rayanne',' Navega Bezerra','(57) 5 4745-3476','634.634.634-64','2010-12-18','3376113','adm','NavegaBezerra@gmail.com','$2y$12$Nad83BO2GsvOr8bW3R3Aq.tR1Vpauc/84ut/VvpRzK1IhHYhKUZTu','2024-07-29 16:24:56','2024-07-29 16:24:56','A'),
 (26,'Lucca','Paulino Constantino','(63) 4 6363-3643','346.346.346-34','2020-08-01','42396183','rh','lucca@gmail.com','$2y$12$LCHSX9l3OxTB2oFSMqsA9u4Cy1EgKAyHmkl//Rkq6fDixLhxu92p.','2024-07-29 16:27:07','2024-07-29 16:27:07','A'),
 (27,'Vera','Negris Constantino','(76) 3 1357-4267','722.439.842-02','1991-07-29','7888667','funcionario','very@gmail.com','$2y$12$4WeHne55dIqbFizALuZ0JO.btyyRAJhOq4F3BVg9m8HXk.hKfNXQq','2024-07-29 16:27:24','2024-07-29 16:27:24','A'),
 (28,'Douglas ','Quindeler Pacheco','(45) 9 4287-4228','618.332.462-09','2000-05-02','15243471','funcionario','douglas@gmail.com','$2y$12$yDq1RFwD.A1HLnuZUh138e0g34Zlz2EWvxJ1bIHqdDZuFRwI0gx5C','2024-07-29 16:28:17','2024-07-29 16:28:17','A'),
 (29,'Claudio','Campos','(63) 6 4363-4646','673.464.367-43','1999-02-23','73849572','funcionario','Claudio@gmail.com','$2y$12$FQtwOvGgCLsfb2rHqQ9Zquq114mrXKlEqNIekK67Hru/w.ZZhK7YS','2024-07-29 16:28:21','2024-07-29 16:28:22','A'),
 (30,'Heládio ','Chiles Leal','(23) 5 3252-3523','438.769.967-98','1991-09-26','46733386','rh','Chiles@hotmail.com','$2y$12$spG.kqna7LQCEhkgWkGrVuq0/MDAFofX70fP06cmO4oF3KgHmG3XO','2024-07-29 16:28:51','2024-07-29 16:28:51','A'),
 (31,'Nilce','Carmoriz Siqueira','(12) 9 1749-2128','642.954.454-01','1986-07-29','81320672','almoxarife','nilce@gmail.com','$2y$12$NafMxyIcH0iJJ8sQYyfESeljEYlNssvLXCplpDDZF3MQ3dUV0vtVu','2024-07-29 16:29:21','2024-07-29 16:29:21','A'),
 (32,'Joaquim ','Portela Vaz','(74) 5 2352-5623','463.474.373-74','1990-02-23','12955049','funcionario','Joaquim@outlook.com','$2y$12$KXJ/Cx/Ypk0e7b89DeNtluAl6bS/Cm4tmqIOF6kXq82PkkZY4JiCu','2024-07-29 16:30:08','2024-07-29 16:30:09','A'),
 (33,'Roseanne','Mayerhofer Ubaldo','(62) 9 4652-7121','496.731.314-06','1999-06-25','85517234','funcionario','roseanne@gmail.com','$2y$12$hiIIWSTzjlouVvKLz9GsXObku9ZC0e/7AYFIa7VZ1p9YNQq9oZdyC','2024-07-29 16:30:13','2024-07-29 16:30:13','A'),
 (34,'Sayonara ','Ervano Vargas','(34) 4 5875-7457','623.223.234-23','2013-06-01','91800003','rh','Sayonara@google.com','$2y$12$ZEv2rU3lr4wS09p/61aD..IoBkBUo5rzk9mCJl7wBMNuS54N/rZGq','2024-07-29 16:31:10','2024-07-29 16:31:10','A'),
 (35,'Elio ','Faria Vieira','(27) 9 5821-8260','527.362.242-56','2006-07-29','33604836','adm','eliofariavieira@gmail.com','$2y$12$72lohp.EiRzWR7XsKucI7O070/jhZ5nmLwiHYAHmpDM4MFQ4I1UMW','2024-07-29 16:31:15','2024-07-29 16:31:15','A'),
 (36,'Iris','Avelino','(33) 9 8719-4164','123.456.789-52','2005-07-23','70848761','funcionario','isadora@linda.com','$2y$12$HCKlTy68G3XYhoQIokPGHOEPwpG/DHkjqJfbDQUheNaugKunE6QVy','2024-07-29 16:31:43','2024-07-29 16:31:44','A'),
 (37,'Dionísio ','Brum Quindeler','(73) 7 3473-4473','123.352.235-64','2006-07-29','10525079','almoxarife','Dionisio@icloud.com','$2y$12$SCfW8NZouZCis1p.Ly7ISuUvLmQtMGjYb/HzzrNbMt5/vUIx/X3Ia','2024-07-29 16:31:45','2024-07-29 16:31:45','A'),
 (38,'Fábio',' Queiroga Pedroso','(34) 7 3434-7743','344.352.346-75','2015-05-21','63122872','almoxarife','Fabio@youtube.com','$2y$12$0AvQZOamGs6YKuuKVzWTDeH/KFJjiDnYCoK13pY97gpvFrdSnNDbW','2024-07-29 16:32:50','2024-07-29 16:32:50','A'),
 (39,'Jane ','Estellet Bragança','(62) 9 7280-0783','511.547.841-26','2006-07-29','25387203','rh','jane@gmail.com','$2y$12$Lr1/0KliM4tPuTKIew0gi.krPzYjYPCUazn5aWM5id3RF5YE466Jm','2024-07-29 16:33:18','2024-07-29 16:33:19','A'),
 (40,'Estefane','Avelino','(33) 9 8575-5555','152.014.254-53','2006-12-31','24818815','rh','ester@gmail.com','$2y$12$afqSsdoBBaILYqy2HOqYxuz.8X.0JgYOh4yxf9OkViYE/Mg5eN8/W','2024-07-29 16:33:46','2024-07-29 16:33:47','A'),
 (41,'Alessandra',' Spilman de Oliveira','(73) 4 6734-6346','347.637.734-74','2006-07-29','94283497','funcionario','Alessandra@google.com','$2y$12$SPg/DJyqtl0i8CYa.xJC3eWMv1HJeyeh4ed3BdRuFnTEnN.VEZJdO','2024-07-29 16:33:54','2024-07-29 16:33:55','A'),
 (42,'Vera ','Werneck Consendey','(98) 9 8647-6236','244.382.823-90','1965-01-18','24391934','almoxarife','vera.consendey@gmail.com','$2y$12$7R1ytpAKHngeayP5g20r4OJGxn5mnIBwYJcHeJVxlXtmbp7saJkQ6','2024-07-29 16:34:13','2024-07-30 10:18:23','A'),
 (43,'Livia','Santos','(33) 6 9856-9855','123.548.482-15','2006-06-26','54831275','adm','livia@gmail.com','$2y$12$/7z0cePf.yagsjen03gDgOAlM2Ckdaj8AzFE2uRHDJTb8fFnOGb.a','2024-07-29 16:34:36','2024-07-29 16:34:36','A'),
 (44,'Rubia ','Caruso Costa','(36) 4 6634-3464','745.574.457-45','1990-05-06','74940919','funcionario','RubiaGomes@gmail.com','$2y$12$iJHou8vi5Q7l.AdOualo8u8X9QXniQ0TkUCl6uJRVzIDoVRA4M/mm','2024-07-29 16:34:44','2024-07-30 10:18:49','A'),
 (45,'Arlete ','Palmas Diniz','(92) 9 8847-6367','484.150.512-12','1986-05-04','42926075','funcionario','arlete.diniz@gmail.com','$2y$12$T2UQ9rkjISGYUTDgNQ1Cp.JQabejoA7l5mg55D8W1mGpHoOapP1JS','2024-07-29 16:35:01','2024-07-30 10:18:04','A'),
 (46,'Maria',' Beatriz Vilar Kassab','(64) 3 6346-3643','734.737.658-58','2006-07-29','10889350','funcionario','Beatriz@gmail.com','$2y$12$pLgjrZ8tosi.lelVZCht8uyrpo5b4y5jh2GDqOjjmIAnZkmFe4eeK','2024-07-29 16:35:18','2024-07-29 16:35:19','A'),
 (47,'Isabel','Pinto','(33) 6 9854-7855','125.874.639-93','2006-05-15','71762402','almoxarife','isa@gmail.com','$2y$12$rRaOFFE/hr.pma/UDymjT.4MuX2UQtmRLe4MOXCKw9CHylM/1j/Vq','2024-07-29 16:35:40','2024-07-29 16:35:41','A'),
 (48,'Edson',' Cunha Medeiros','(66) 6 4346-3643','343.745.734-76','1999-03-27','13122499','funcionario','Cunha@outlook.com','$2y$12$mE4Ac8u4HzKZPsDYH.AypeweWS8Mvorr5DLnMKDUutRLoMChsM4HK','2024-07-29 16:36:03','2024-07-29 16:36:03','A'),
 (49,'Aledio ','Texeira Vilela','(67) 9 7561-7532','654.242.621-39','1961-12-13','13276522','funcionario','aledio.vilela@gmail.com','$2y$12$wrf4FUIOjfLcBpkQxB6MTOIJncB.3RHbosaXYce/.wQe/ZkERdKk.','2024-07-29 16:36:18','2024-07-30 10:18:13','A'),
 (50,'Bianca','Santoro','(33) 6 9685-8514','125.893.322-25','2006-07-13','66086373','rh','bianca@gmail.com','$2y$12$5F96FTwtxIaaL2zfJsz4oO2lpH4ynXGnX5z3AaCiZGc/pKcw5HsfK','2024-07-29 16:36:30','2024-07-29 16:36:30','A'),
 (51,'Francielle ','Saldanha Linhares','(43) 6 7474-5747','343.434.623-23','2005-10-27','40078556','rh','frafran@iclou.com','$2y$12$930.FxE9KtJcYSL/VSG2keAEr2MEORJp6u05dxAA1nhiJ6mggamRO','2024-07-29 16:37:00','2024-07-29 16:37:01','A'),
 (52,'Kailany','Rodrigues','(33) 9 6655-8228','123.658.933-33','2005-02-01','86180474','adm','kai@gmail.com','$2y$12$jWHbHX2qswcekk/4aTbfxuGfaTB0a1qK9/Tjqj2bwSFaZLOcNObA6','2024-07-29 16:37:41','2024-07-29 16:37:41','A'),
 (53,'Rosimere',' Frotté Prata','(74) 7 4637-6347','458.458.584-64','1856-03-26','71067287','funcionario','Rosimere@gmail.com','$2y$12$V31thwF2J6QEBeLLDpgdzeGvw3f0zTmo6oxx2kk3N1XvLxzSr2OkW','2024-07-29 16:38:03','2024-07-29 16:38:03','A'),
 (54,'Clara','Santos Rodrigues','(33) 9 6582-2145','120.548.593-22','2003-12-29','44028155','rh','clara@gmail.com','$2y$12$FsiT98Z/1.a3/P.a53WM4eIvjsGg.4J7CGBKCSstLRjGlfpzxrhtq','2024-07-29 16:38:18','2024-07-29 16:38:18','A'),
 (55,'Milena','Miranda Vieira','(36) 6 4364-3634','745.754.745-75','2006-07-29','48484950','funcionario','Milena@gmail.com','$2y$12$VxKao.XBVrKrT/ELDjo4pOvLRK/QLpYTvJCpjc/hpKcpSYma6vJd.','2024-07-29 16:38:32','2024-07-29 16:38:32','A'),
 (56,'Marco ','Santoro Nobre','(33) 9 9658-2575','120.369.574-42','2006-07-29','40788240','funcionario','marcosantoro@gmail.com','$2y$12$y/LTGYKLqTqiqnUlQOQIt.aPAET1/HT/pO2kkA06cTrOwxvlTOulu','2024-07-29 16:39:14','2024-07-29 16:39:14','A'),
 (57,'Lua','Teixeira Marcela','(33) 9 8545-8702','120.363.256-52','2004-03-04','12747884','almoxarife','lua@gmail.com','$2y$12$TcoIEobLiuHnplJhITQhgOLXtFT5YkZ9cgrqMNoeG5jEnX7Z0B2Y2','2024-07-29 16:41:17','2024-07-29 16:41:17','A'),
 (58,'Manuel ','Leite Lucas','(95) 9 7250-1145','862.442.602-28','2023-08-03','12903547','funcionario','manuel.lucas@gmail.com','$2y$12$WU1k18639ecDOFeyXlqiaunSTcwart5AIbWgwzhGxjrmMDGVSPR72','2024-07-29 16:41:29','2024-07-30 10:17:34','A'),
 (59,'Marcos','Batista Oliveira','(33) 9 6525-8000','665.869.658-85','2004-06-08','53785377','almoxarife','marcosbatista@gmail.com','$2y$12$iM0aRAx54Cfa13hkTBCGk.dlKPxly1xkzaa6QWYLS2VFcnO/K896.','2024-07-29 16:42:05','2024-07-29 16:42:05','A'),
 (60,'Irene','Rosa  de Oliveira','(33) 9 6857-4585','362.584.122-58','2003-01-16','2315655','almoxarife','irene@gmail.com','$2y$12$8Y6PSiT5uaKwXM2EPH19j.Rg3QDVWE0hL3rGkm4iVWw92bMyjdVdC','2024-07-29 16:46:04','2024-07-29 16:46:04','A'),
 (61,'Cecilia','de Oliveira Santios','(33) 9 8585-2145','123.652.077-76','2006-07-01','4922248','almoxarife','cecilia@gmail.com','$2y$12$cOae9AqkLw16hiEyc/g1/et0OmPSmQANRfrwjclFAcLcFt4wRnTce','2024-07-29 16:47:30','2024-07-29 16:47:30','A'),
 (62,'Kaimar','Oliveira','(33) 9 8547-8545','121.035.282-22','2006-07-12','75974496','rh','kaimar@gmail.com','$2y$12$gIphMiZ0EQhGinPw0yJ0J.i8wbAKJYYcVXsNZgmjzF.S.zXwII8sa','2024-07-29 16:48:26','2024-07-29 16:48:26','A'),
 (63,'Lucas','Avelino','(33) 9 8585-2114','120.325.812-12','2006-06-28','13311579','rh','lucasavelino@gmail.com','$2y$12$V8zU5RqHWfkUR3fep.IyUeWKdVP.Bvn3hCw4yuomw3DeWVQHggO1e','2024-07-29 16:49:22','2024-07-29 16:49:22','A'),
 (64,'Mathues','Santos Barbosa','(31) 9 5825-4633','120.369.851-44','2005-03-09','35303677','rh','mathuesbarbosa@gmail.com','$2y$12$tlBZQhF7TLKPcDOWHl8XPO1KMlRb4b3z.PA.ZcJeidPzgFLPJVi/S','2024-07-29 16:50:19','2024-07-29 16:50:20','A'),
 (65,'Atila','Gambino','(31) 9 6525-6332','120.242.212-12','2006-07-01','57089055','almoxarife','atilagambino@gmail.com','$2y$12$D/.aEY7X65OZK/Q4eMCr/uoKFFyM8ryewRiIMcgr1TVIv435TD29u','2024-07-29 16:51:13','2024-07-29 16:51:13','A'),
 (66,'Gabrielle ','Lourenço Norte','(63) 9 7960-6683','374.664.551-40','1995-08-03','63920668','almoxarife','gabrielle.norte@gmail.com','$2y$12$3IfqaQ.6y9kBzKLEJqlsVOCG8BPIIXuHq7vJdj68qYWHiN.AIQTJu','2024-07-30 09:09:25','2024-07-30 09:09:25','A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
