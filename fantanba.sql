-- Progettazione Web 
DROP DATABASE if exists fantanba; 
CREATE DATABASE fantanba; 
USE fantanba; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: fantanba
-- ------------------------------------------------------
-- Server version	5.7.21-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `domanderecpw`
--

DROP TABLE IF EXISTS `domanderecpw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domanderecpw` (
  `iddomanda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `testo` varchar(45) NOT NULL,
  PRIMARY KEY (`iddomanda`),
  UNIQUE KEY `iddomanda_UNIQUE` (`iddomanda`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domanderecpw`
--

LOCK TABLES `domanderecpw` WRITE;
/*!40000 ALTER TABLE `domanderecpw` DISABLE KEYS */;
INSERT INTO `domanderecpw` VALUES (1,'MESE IN CUI SEI NATO'),(2,'NONNO PATERNO'),(3,'IL PRIMO ANIMALE DOMESTICO');
/*!40000 ALTER TABLE `domanderecpw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lastupdate`
--

DROP TABLE IF EXISTS `lastupdate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lastupdate` (
  `tipologia` varchar(45) NOT NULL,
  `data` datetime DEFAULT NULL,
  `utente` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tipologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lastupdate`
--

LOCK TABLES `lastupdate` WRITE;
/*!40000 ALTER TABLE `lastupdate` DISABLE KEYS */;
INSERT INTO `lastupdate` VALUES ('classifiche','2018-09-11 17:48:38','mattia'),('punteggio','2018-09-11 17:48:25','mattia');
/*!40000 ALTER TABLE `lastupdate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lega`
--

DROP TABLE IF EXISTS `lega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lega` (
  `idLega` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nomeLega` varchar(45) DEFAULT NULL,
  `team` int(11) unsigned NOT NULL,
  `puntiFatti` int(11) NOT NULL DEFAULT '0',
  `amministratoreLega` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLega`,`team`),
  KEY `idteamUtente_idx` (`team`),
  CONSTRAINT `team` FOREIGN KEY (`team`) REFERENCES `teamutente` (`idteamUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lega`
--

LOCK TABLES `lega` WRITE;
/*!40000 ALTER TABLE `lega` DISABLE KEYS */;
INSERT INTO `lega` VALUES (9,'FENOMENI',9,9,1),(9,'FENOMENI',10,8,0),(9,'FENOMENI',11,9,0),(9,'FENOMENI',12,3,0);
/*!40000 ALTER TABLE `lega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nbaplayer`
--

DROP TABLE IF EXISTS `nbaplayer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nbaplayer` (
  `idnbaPlayer` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  `squadraNba` varchar(45) DEFAULT NULL,
  `prezzo` int(11) DEFAULT '20',
  `ruolo` varchar(45) NOT NULL,
  `punteggio` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idnbaPlayer`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nbaplayer`
--

LOCK TABLES `nbaplayer` WRITE;
/*!40000 ALTER TABLE `nbaplayer` DISABLE KEYS */;
INSERT INTO `nbaplayer` VALUES (1,'james','HARDEN','rockets',35,'G',0),(2,'anthony ','DAVIS','pelicans',20,'AG',0),(3,'giannis','ANTETOKOUNMPO','buck',25,'AP',0),(4,'lebron','JAMES','cleveland',40,'AP',0),(5,'kevin','DURANT','warriors',35,'AP',0),(6,'russell','WESTBROOK','thunder',30,'PM',0),(7,'kyrie','IRVING','boston',30,'PM',0),(8,'pau','GASOL','spurs',10,'C',0),(9,'chris','PAUL','rockets',20,'PM',0),(10,'kevin','LOVE','cleveland',15,'AG',0),(13,'stephen','CURRY','golden state warriors',70,'PM',0),(16,'Kawhi','LEONARD','spurs',50,'AP',0),(17,'demarcus','COUSINS','pelicans',50,'C',0),(18,'paul','GEORGE','thunder',40,'AP',0),(19,'damian','LILLARD','portland',50,'PM',0),(21,'demar','DEROZAN','toronto',40,'G',0),(22,'jimmy','BUTLER','timberwolves',30,'G',0),(24,'blake','GRIFFIN','detroit',30,'AG',0),(25,'dwayne','WADE','miami',20,'G',0),(26,'joel','EMBIID','phila',40,'C',0),(28,'drayamond','GREEN','golden state warriars',30,'AG',0),(29,'kristaps','PORZINGIS','new york kniks',20,'C',0),(30,'karl-anthony','TOWNS','timberwolves',30,'C',0),(31,'donovan','MITCHELL','jazz',35,'G',0),(32,'victor','OLADIPO','indiana',30,'G',0),(33,'carmelo','ANTHONY','okc',35,'AP',0),(34,'ben','SIMMONS','76ers',40,'PM',0),(35,'andre','DRUMMOND','pistons',45,'C',0),(36,'al','HORFORD','celtics',45,'C',0),(37,'dwight','HOWARD','wizards',35,'C',0),(38,'zach','LAVINE','bulls',30,'G',0),(39,'j.j.','REDICK','76ers',20,'G',0);
/*!40000 ALTER TABLE `nbaplayer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playerinteam`
--

DROP TABLE IF EXISTS `playerinteam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playerinteam` (
  `player` int(10) unsigned NOT NULL,
  `squadra` int(10) unsigned NOT NULL,
  `titolare` int(2) DEFAULT '0',
  PRIMARY KEY (`player`,`squadra`),
  KEY `squadra_idx` (`squadra`),
  CONSTRAINT `player` FOREIGN KEY (`player`) REFERENCES `nbaplayer` (`idnbaPlayer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `squadra` FOREIGN KEY (`squadra`) REFERENCES `teamutente` (`idteamUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playerinteam`
--

LOCK TABLES `playerinteam` WRITE;
/*!40000 ALTER TABLE `playerinteam` DISABLE KEYS */;
INSERT INTO `playerinteam` VALUES (1,9,1),(1,11,1),(2,9,1),(2,10,1),(2,11,1),(3,9,1),(3,11,0),(4,10,1),(4,11,1),(4,12,1),(5,9,0),(5,12,0),(6,11,1),(7,9,1),(7,10,1),(8,9,0),(8,10,0),(8,11,0),(9,9,0),(9,11,0),(9,12,0),(10,9,0),(10,10,0),(10,12,0),(13,12,1),(17,9,1),(17,12,1),(18,10,0),(19,10,0),(21,10,1),(21,12,0),(22,9,0),(22,11,0),(22,12,1),(24,11,0),(24,12,1),(25,10,0),(26,10,1),(26,11,1),(26,12,0);
/*!40000 ALTER TABLE `playerinteam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teamutente`
--

DROP TABLE IF EXISTS `teamutente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teamutente` (
  `idteamUtente` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL DEFAULT 'squadra',
  `utente` int(10) unsigned DEFAULT NULL,
  `money` int(11) NOT NULL DEFAULT '400',
  PRIMARY KEY (`idteamUtente`),
  KEY `utente_idx` (`utente`),
  CONSTRAINT `utente` FOREIGN KEY (`utente`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teamutente`
--

LOCK TABLES `teamutente` WRITE;
/*!40000 ALTER TABLE `teamutente` DISABLE KEYS */;
INSERT INTO `teamutente` VALUES (9,'BOSTON',1,130),(10,'TORONTO',2,95),(11,'LAKERS',3,120),(12,'JAZZ',4,30);
/*!40000 ALTER TABLE `teamutente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `idUtente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL DEFAULT 'utente',
  `cognome` varchar(45) NOT NULL DEFAULT 'utente',
  `dataNascita` date DEFAULT NULL,
  `sesso` char(1) NOT NULL DEFAULT 'M',
  `nomeUtente` varchar(45) NOT NULL,
  `password` char(32) NOT NULL,
  `amministratore` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(45) NOT NULL DEFAULT 'avatar1',
  `email` varchar(45) NOT NULL,
  `domanda` varchar(45) NOT NULL,
  `risposta` varchar(45) NOT NULL,
  `tentativi` int(10) NOT NULL DEFAULT '3',
  PRIMARY KEY (`idUtente`),
  KEY `nomeUtente` (`nomeUtente`,`password`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,'Mattia','Di Donato','1995-04-03','M','mattia','asd123',1,'avatar1','mattiadido@gmail.com','1','aprile',2),(2,'Alice','BATTAGLINI','1994-07-24','F','alis','asd123',0,'avatar4','alice94mail@gmail.com','3','gaspare',3),(3,'Francesco','DI DONATO','2000-08-24','M','chicco','asd123',0,'avatar2','francescodido@gmail.com','1','agosto',3),(4,'Salvatore','COGNETTA','1996-05-05','M','salsiccia','asd123',0,'avatar1','salvatore1996@hotmail.it','2','gianni',3);
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-11 22:41:37
