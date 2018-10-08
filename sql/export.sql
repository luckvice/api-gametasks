-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.34-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para gametasks
CREATE DATABASE IF NOT EXISTS `gametasks` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `gametasks`;

-- Copiando estrutura para tabela gametasks.game_task
CREATE TABLE IF NOT EXISTS `game_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogo_task` int(11) NOT NULL,
  `id_plataforma_task` int(11) NOT NULL,
  `finalizado` enum('S','N') NOT NULL,
  `jogando` enum('S','N') NOT NULL,
  `parado` enum('S','N') NOT NULL,
  `rejogando` enum('S','N') NOT NULL,
  `current_progress_time` time DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `percent_complete` int(11) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_id_usuario` (`id_usuario`),
  KEY `FK_id_jogo_task` (`id_jogo_task`),
  KEY `FKid_plataforma_task` (`id_plataforma_task`),
  CONSTRAINT `FK_id_jogo_task` FOREIGN KEY (`id_jogo_task`) REFERENCES `jogos` (`id`),
  CONSTRAINT `FK_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FKid_plataforma_task` FOREIGN KEY (`id_plataforma_task`) REFERENCES `plataformas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gametasks.game_task: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `game_task` DISABLE KEYS */;
INSERT INTO `game_task` (`id`, `id_jogo_task`, `id_plataforma_task`, `finalizado`, `jogando`, `parado`, `rejogando`, `current_progress_time`, `id_usuario`, `percent_complete`, `priority`) VALUES
	(2, 1, 1, 'N', 'S', 'N', 'N', '00:00:00', 1, 0, 2);
/*!40000 ALTER TABLE `game_task` ENABLE KEYS */;

-- Copiando estrutura para tabela gametasks.generos
CREATE TABLE IF NOT EXISTS `generos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gnr_name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gametasks.generos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` (`id`, `gnr_name`) VALUES
	(1, 'Ação'),
	(2, 'FPS'),
	(3, 'RPG');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;

-- Copiando estrutura para tabela gametasks.generos_lista
CREATE TABLE IF NOT EXISTS `generos_lista` (
  `id_jogo` int(11) DEFAULT NULL,
  `id_genero` int(11) DEFAULT NULL,
  KEY `FK_id_jogo` (`id_jogo`),
  KEY `FK_id_genero` (`id_genero`),
  CONSTRAINT `FK_id_genero` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`),
  CONSTRAINT `FK_id_jogo` FOREIGN KEY (`id_jogo`) REFERENCES `jogos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gametasks.generos_lista: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `generos_lista` DISABLE KEYS */;
INSERT INTO `generos_lista` (`id_jogo`, `id_genero`) VALUES
	(1, 1),
	(1, 2);
/*!40000 ALTER TABLE `generos_lista` ENABLE KEYS */;

-- Copiando estrutura para tabela gametasks.jogos
CREATE TABLE IF NOT EXISTS `jogos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `sinopse` varchar(50) NOT NULL DEFAULT '0',
  `image_url` varchar(255) NOT NULL DEFAULT '0',
  `meta_critic_rank` varchar(255) NOT NULL DEFAULT '0',
  `produtora` varchar(50) DEFAULT NULL,
  `desenvolvedora` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gametasks.jogos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `jogos` DISABLE KEYS */;
INSERT INTO `jogos` (`id`, `nome`, `sinopse`, `image_url`, `meta_critic_rank`, `produtora`, `desenvolvedora`) VALUES
	(1, 'GTA VI', 'Ação', 'img/gta.png', '98', 'Take two', 'Rockstar Games'),
	(3, 'teste', '0', '0', '0', NULL, NULL),
	(4, 'Mortal Kombat XL', 'Luta', 'img/mortalkombat.png', '78', 'Warner Bros', 'NetherRealm Studios');
/*!40000 ALTER TABLE `jogos` ENABLE KEYS */;

-- Copiando estrutura para tabela gametasks.plataformas
CREATE TABLE IF NOT EXISTS `plataformas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pl_name` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gametasks.plataformas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `plataformas` DISABLE KEYS */;
INSERT INTO `plataformas` (`id`, `pl_name`) VALUES
	(1, 'Computador'),
	(2, 'PS4');
/*!40000 ALTER TABLE `plataformas` ENABLE KEYS */;

-- Copiando estrutura para tabela gametasks.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `genero` enum('M','F') DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `senha` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `nickname` varchar(50) NOT NULL DEFAULT '0',
  `steam_profile` varchar(50) NOT NULL DEFAULT '0',
  `psn_profile` varchar(50) NOT NULL DEFAULT '0',
  `live_profile` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela gametasks.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `genero`, `dt_nasc`, `senha`, `email`, `nickname`, `steam_profile`, `psn_profile`, `live_profile`) VALUES
	(1, 'Luck Soares eu editei aquii', 'M', '1993-05-16', 'minhasenhanaoengriptada', 'lucasmarcelo93@gmail.com', 'luckvice', 'https://steamcommunity.com/id/lucktechgaming/', 'https://psnprofiles.com/lucktechgamer', 'luckbrasil90'),
	(2, 'Aline', 'F', '1992-07-13', 'minhasenhanaoengriptada', 'aline@gmail.com', 'alinegamer', 'https://steamcommunity.com/id/alinegamer/', 'https://psnprofiles.com/alinegamer', 'alinegamer');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
