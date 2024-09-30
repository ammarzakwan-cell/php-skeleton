# RWNA

## Installation

`composer update`

Run this mysql script to set up DB schema.
````mysql
CREATE DATABASE  IF NOT EXISTS `rwna_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rwna_app`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rwna_app
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `attend_daily`
--

DROP TABLE IF EXISTS `attend_daily`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attend_daily` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empid` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `InTime1` time DEFAULT NULL,
  `OutTime1` time DEFAULT NULL,
  `InTime2` time DEFAULT NULL,
  `OutTime2` time DEFAULT NULL,
  `InTime3` time DEFAULT NULL,
  `OutTime3` time DEFAULT NULL,
  `DayNTD` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1164136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attend_daily`
--

LOCK TABLES `attend_daily` WRITE;
/*!40000 ALTER TABLE `attend_daily` DISABLE KEYS */;
INSERT INTO `attend_daily` VALUES (1164127,'RC2395','2020-12-01','07:30:00','07:30:00','00:00:00','18:04:00',NULL,NULL,NULL),(1164128,'RS1408','2020-12-01','07:30:00','07:30:00','00:00:00','18:48:00',NULL,NULL,NULL),(1164129,'RS1407','2020-12-01','07:30:00','07:30:00','00:00:00','03:05:00',NULL,NULL,NULL),(1164130,'RC2395','2020-12-02','07:20:00','07:59:00','00:00:00','18:48:00',NULL,NULL,NULL),(1164131,'RS1408','2020-12-02','07:59:00','07:59:00','00:00:00','01:50:00',NULL,NULL,NULL),(1164132,'RS1407','2020-12-02','07:51:00','07:51:00','00:00:00','18:16:00',NULL,NULL,NULL),(1164133,'RC0102','2020-12-03','07:59:00','07:59:00','00:00:00','23:50:00',NULL,NULL,NULL),(1164134,'RC0118','2020-12-03','07:59:00','07:59:00','00:00:00','12:03:00',NULL,NULL,NULL),(1164135,'RC0122','2020-12-03','08:00:00','08:00:00','00:00:00','17:00:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `attend_daily` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empbasic`
--

DROP TABLE IF EXISTS `empbasic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empbasic` (
  `id` int NOT NULL AUTO_INCREMENT,
  `EmpID` varchar(50) DEFAULT NULL,
  `PerConID` varchar(45) DEFAULT NULL,
  `PerConName` varchar(100) DEFAULT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `MiddleInitial` varchar(45) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `LastName2_c` varchar(300) DEFAULT NULL,
  `ICNo_c` varchar(45) DEFAULT NULL,
  `EmpStatus` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3896 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empbasic`
--

LOCK TABLES `empbasic` WRITE;
/*!40000 ALTER TABLE `empbasic` DISABLE KEYS */;
INSERT INTO `empbasic` VALUES (3893,'RC2395',NULL,NULL,'AL-SYAHIRDANIE',NULL,'BIN OTHMAN','AL-SYAHIRDANIE BIN OTHMAN','991209-13-6575','A'),(3894,'RS1408',NULL,NULL,'Zulaikha',NULL,'Awang Bakar','Zulaikha Binti Awang Bakar','000421-06-0360','A'),(3895,'RS1407',NULL,NULL,'Nurul Nabilah',NULL,'Mohamed Lazin','Nurul Nabilah Binti Mohamed Lazin','940721-03-5562','A');
/*!40000 ALTER TABLE `empbasic` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-28 15:48:54

````

Run the following command in terminal to start localhost web server, assuming ./public/ is public-accessible directory with index.php file:

``php -S localhost:8888 -t public public/index.php``