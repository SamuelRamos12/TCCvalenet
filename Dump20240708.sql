CREATE DATABASE  IF NOT EXISTS `tcc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tcc`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: tcc
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `CPF` varchar(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telefone` varchar(15) DEFAULT NULL,
  `Endereco` varchar(255) DEFAULT NULL,
  `DataDeNascimento` date DEFAULT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES ('19716815155','Goku',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamentos`
--

DROP TABLE IF EXISTS `equipamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipamentos` (
  `IP` varchar(15) NOT NULL,
  `Mac` varchar(17) NOT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `Descricao` varchar(1000) DEFAULT NULL,
  `Cliente_CPF` varchar(11) DEFAULT NULL,
  `Funcionario_Matricula` int DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`IP`),
  UNIQUE KEY `Mac` (`Mac`),
  KEY `Cliente_CPF` (`Cliente_CPF`),
  KEY `fk_equipamentos_funcionario` (`Funcionario_Matricula`),
  CONSTRAINT `equipamentos_ibfk_1` FOREIGN KEY (`Cliente_CPF`) REFERENCES `clientes` (`CPF`),
  CONSTRAINT `fk_equipamentos_funcionario` FOREIGN KEY (`Funcionario_Matricula`) REFERENCES `funcionarios` (`Matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamentos`
--

LOCK TABLES `equipamentos` WRITE;
/*!40000 ALTER TABLE `equipamentos` DISABLE KEYS */;
INSERT INTO `equipamentos` VALUES ('12123123','3123123','DesktopPC','pc',NULL,12,'http://192.168.15.83:3000/d-solo/fdqsrtjug66tca/new-dashboard?orgId=1&from=1720151644486&to=1720151704486&panelId=1'),('192.168.1.1','9999','MikroTik','RouterBorder',NULL,12,'http://192.168.15.83:3000/d-solo/fdqsrtjug66tca/new-dashboard?orgId=1&from=1720151644486&to=1720151704486&panelId=1'),('192.168.15.50','88888','DesktopPC','Pc utilizado para sei la oq','19716815155',NULL,NULL),('1951983158','122555','DesktopPC','pc 2','19716815155',NULL,NULL);
/*!40000 ALTER TABLE `equipamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `Matricula` int NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `DataDeNascimento` date DEFAULT NULL,
  `EmailCorporativo` varchar(100) DEFAULT NULL,
  `PermissaoID` int DEFAULT NULL,
  PRIMARY KEY (`Matricula`),
  KEY `PermissaoID` (`PermissaoID`),
  CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`PermissaoID`) REFERENCES `permissoes` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (12,'jonh',NULL,NULL,NULL);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissoes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NomePermissao` varchar(50) NOT NULL,
  `Descricao` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-08 16:55:25
