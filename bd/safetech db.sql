CREATE TABLE IF NOT EXISTS `usuario` (
	`idusuario` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nome` varchar(75),
	`sobrenome` varchar(120),
	`cpf` varchar(15),
	`nascimento` date,
	`matricula` varchar(30),
	`cargo` varchar(50),
	`email` varchar(140),
	`senha` varchar(245),
	`cadastro` datetime,
	`alteracao` timestamp,
	`ativo` char(1) DEFAULT 'A',
	PRIMARY KEY (`idusuario`)
);

CREATE TABLE IF NOT EXISTS `telefone` (
	`idtelefone` int AUTO_INCREMENT NOT NULL UNIQUE,
	`idusuario` int,
	`numero` varchar(15),
	`cadastro` datetime,
	`alteracao` timestamp,
	`ativo` char(1) DEFAULT 'A',
	PRIMARY KEY (`idtelefone`)
);

CREATE TABLE IF NOT EXISTS `epi` (
	`idepi` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nome` varchar(120),
	`certificado` varchar(10),
	`foto` varchar(245),
	`cadastro` datetime,
	`alteracao` timestamp,
	`ativo` char(1) DEFAULT 'A',
	PRIMARY KEY (`idepi`)
);

CREATE TABLE IF NOT EXISTS `aluguel` (
	`idaluguel` int AUTO_INCREMENT NOT NULL UNIQUE,
	`idusuario` int,
	`idepi` int,
	`dataInicio` datetime,
	`dataFim` date,
	`codigoAluguel` int,
	`prioridade` varchar(15),
	`observacao` varchar(400),
	`cadastro` datetime,
	`alteracao` timestamp,
	`ativo` char(1) DEFAULT 'A',
	PRIMARY KEY (`idaluguel`)
);

CREATE TABLE IF NOT EXISTS `estoque` (
	`idestoque` int AUTO_INCREMENT NOT NULL UNIQUE,
	`idepi` int,
	`quantidade` int,
	`cadastro` datetime,
	`alteracao` timestamp,
	`ativo` char(1) DEFAULT 'A',
	PRIMARY KEY (`idestoque`)
);


ALTER TABLE `telefone` ADD CONSTRAINT `telefone_fk1` FOREIGN KEY (`idusuario`) REFERENCES `usuario`(`idusuario`);

ALTER TABLE `aluguel` ADD CONSTRAINT `aluguel_fk1` FOREIGN KEY (`idusuario`) REFERENCES `usuario`(`idusuario`);

ALTER TABLE `aluguel` ADD CONSTRAINT `aluguel_fk2` FOREIGN KEY (`idepi`) REFERENCES `epi`(`idepi`);
ALTER TABLE `estoque` ADD CONSTRAINT `estoque_fk1` FOREIGN KEY (`idepi`) REFERENCES `epi`(`idepi`);