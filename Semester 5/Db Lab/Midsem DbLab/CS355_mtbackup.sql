-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: FP
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary view structure for view `dept_proj`
--

DROP TABLE IF EXISTS `dept_proj`;
/*!50001 DROP VIEW IF EXISTS `dept_proj`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `dept_proj` AS SELECT 
 1 AS `DeptCode`,
 1 AS `SUM(SanctionedFund)`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `facproj`
--

DROP TABLE IF EXISTS `facproj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facproj` (
  `FID` smallint DEFAULT NULL,
  `PID` smallint DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  KEY `FID` (`FID`),
  KEY `PID` (`PID`),
  CONSTRAINT `facproj_ibfk_1` FOREIGN KEY (`FID`) REFERENCES `faculty` (`FID`),
  CONSTRAINT `facproj_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `project` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facproj`
--

LOCK TABLES `facproj` WRITE;
/*!40000 ALTER TABLE `facproj` DISABLE KEYS */;
INSERT INTO `facproj` VALUES (201,101,'PI'),(201,108,'COPI'),(201,109,'PI'),(202,103,'PI'),(203,110,'COPI'),(204,108,'PI'),(207,105,'PI'),(205,106,'COPI'),(207,108,'PI'),(207,110,'COPI'),(208,106,'PI'),(207,109,'PI');
/*!40000 ALTER TABLE `facproj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculty` (
  `FID` smallint NOT NULL,
  `FName` varchar(20) DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `ExtNo` int DEFAULT NULL,
  `DoJ` date DEFAULT NULL,
  `DeptCode` char(2) DEFAULT NULL,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES (201,'Alice','1984-09-04',1196003001,'2020-01-01','CS'),(202,'James','1986-09-04',1196003002,'2021-01-01','EE'),(203,'Bob','1992-09-04',1196003003,'2020-02-19','MM'),(204,'Wonder','1989-09-04',1196003004,'2019-05-21','ME'),(205,'Snow','1994-09-04',1196003005,'2018-10-11','CS'),(206,'Bert','1987-09-04',1196003006,'2019-08-04','CS'),(207,'Cob','1995-09-06',1196003007,'2021-01-07','EE'),(208,'Jeanie','1994-09-04',1196003008,'2018-12-01','CB'),(209,'Pruce','1985-09-04',1196003009,'2019-05-07','MM'),(210,'Gert','1983-09-04',1196003010,'2020-12-03','EE');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project` (
  `PID` smallint NOT NULL,
  `PName` varchar(30) DEFAULT NULL,
  `StartingDate` date DEFAULT NULL,
  `EndingDate` date DEFAULT NULL,
  `SanctionedFund` int DEFAULT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (101,'P101','2021-08-01','2022-02-02',8),(102,'P102','2021-03-08','2021-05-08',13),(103,'P103','2021-03-01','2021-07-03',6),(104,'P104','2021-01-06','2021-04-02',4),(105,'P105','2021-05-13','2021-09-05',6),(106,'P106','2021-04-14','2021-10-03',1),(107,'P107','2021-08-23','2021-12-22',5),(108,'P108','2021-11-13','2022-01-02',11),(109,'P109','2021-06-21','2021-11-21',3),(110,'P110','2021-07-08','2021-08-13',9);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `dept_proj`
--

/*!50001 DROP VIEW IF EXISTS `dept_proj`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`scot`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `dept_proj` AS select `combinded`.`DeptCode` AS `DeptCode`,sum(`combinded`.`SanctionedFund`) AS `SUM(SanctionedFund)` from (select `facproj`.`PID` AS `PID`,`faculty`.`FID` AS `FID`,`faculty`.`FName` AS `FName`,`faculty`.`DoB` AS `DoB`,`faculty`.`ExtNo` AS `ExtNo`,`faculty`.`DoJ` AS `DoJ`,`faculty`.`DeptCode` AS `DeptCode`,`facproj`.`role` AS `role`,`project`.`PName` AS `PName`,`project`.`StartingDate` AS `StartingDate`,`project`.`EndingDate` AS `EndingDate`,`project`.`SanctionedFund` AS `SanctionedFund` from ((`faculty` join `facproj` on((`faculty`.`FID` = `facproj`.`FID`))) join `project` on((`facproj`.`PID` = `project`.`PID`)))) `combinded` group by `combinded`.`DeptCode` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-15 18:16:42
