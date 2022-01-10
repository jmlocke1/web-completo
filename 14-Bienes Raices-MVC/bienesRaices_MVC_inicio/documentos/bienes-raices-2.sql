-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: bienes_raices
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
-- Table structure for table `ids_available`
--

DROP TABLE IF EXISTS `ids_available`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ids_available` (
  `id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ids_available`
--

LOCK TABLES `ids_available` WRITE;
/*!40000 ALTER TABLE `ids_available` DISABLE KEYS */;
/*!40000 ALTER TABLE `ids_available` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedorId_FK_idx` (`vendedorId`),
  CONSTRAINT `vendedorId_FK` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (1,'Casa de Lujo en el Lago',3000000.00,'0f76e57c6d8ef54ff67e35a6fd39ee48.jpg','Casa de lujo en el lago con vistas a la montaña nevada de Sant Roig de la Peñada.',4,2,4,'2021-12-06',1),(2,'Casa con id reciclado 2',400000.00,'dbcc4e093fb4c3b22803c35d569bf1c3.jpg','Casa de lujo en dos plantas con zona de recreo próxima.',2,1,1,'2021-12-06',2),(3,'Pestiño infumable',2000000.00,'2afbe228768153fb9b4f3b35fccb177a.jpg','Pestiño infumable de cara a la crisis testicular de los meritonenses estipulaños carpediens',5,3,6,'2021-12-06',3),(4,'Descripción muy larga',2000000.00,'b9e4ddf15c1c25d11e716b92021cd14b.jpg','CososeoCsososowCososeoCsososowCososeoCsososowCososeoCsososowCososeoCsososowCososeoCsososow',2,2,2,'2021-12-06',5);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'José Miguel','Izquierdo Martínez','111818181'),(2,'Juan','De la Torre','87485783'),(3,'Karen','López','98954579'),(4,'Mariano','Medina','758483838'),(5,'Merino','Macos','84757848');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-06 13:39:43
