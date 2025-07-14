-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: task_management_system
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `deadline` date DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,'Task Management System','Design a PHP task management System','2025-07-19','Completed','2025-07-12 17:36:25'),(2,3,'Gata System','Simple UI and DB','2025-07-13','Completed','2025-07-12 17:52:20'),(3,3,'School System','Simple UI and DB','2025-07-15','Completed','2025-07-12 17:59:24'),(4,1,'Registration System','School enrollment system','2025-07-15','Pending','2025-07-13 13:14:51'),(5,3,'Password generator','A simple site to generate strong passwords','2025-07-30','Pending','2025-07-13 13:43:56'),(6,4,'Bursary management platform','A simple UI with DB','2025-07-16','Pending','2025-07-14 17:20:16'),(7,4,'Bursary management platform','A simple UI with DB','2025-07-16','Pending','2025-07-14 17:23:13'),(8,5,'Gate Management System','Both frontend and backend.','2025-07-17','In Progress','2025-07-14 17:24:02'),(9,5,'Gate Management System','Both frontend and backend.','2025-07-17','In Progress','2025-07-14 17:32:55'),(10,5,'Gate Management System','Both frontend and backend.','2025-07-17','Completed','2025-07-14 17:33:14'),(11,5,'School System','UI and DB','2025-07-22','In Progress','2025-07-14 17:33:44'),(12,5,'School System','UI and DB','2025-07-22','Completed','2025-07-14 17:42:48'),(13,4,'Bursary management platform','A simple UI with DB','2025-07-23','Pending','2025-07-14 17:43:08'),(14,5,'Password generator','Simple and lightweight platform','2025-07-18','Completed','2025-07-14 17:47:49'),(15,3,'Bursary management platform','Bursary management platform','2025-07-21','Pending','2025-07-14 18:11:51'),(16,5,'Task Management System','Task Management System','2025-07-20','Pending','2025-07-14 18:14:39'),(17,5,'Task Management System','Task Management System','2025-07-20','Pending','2025-07-14 18:16:30'),(18,5,'School System','School System','2025-07-21','Pending','2025-07-14 18:17:40');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-14 22:18:17
