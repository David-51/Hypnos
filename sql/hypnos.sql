-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: hypnos
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

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
-- Current Database: `hypnos`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `hypnos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `hypnos`;

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrators` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `user_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `administrators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES ('fe8fd256-b9ca-11ec-91bd-005056214326','fe8e6c8c-b9ca-11ec-91bd-005056214326'),('fe90043f-b9ca-11ec-91bd-005056214326','fe8e8519-b9ca-11ec-91bd-005056214326');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `suite_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL,
  `date_checkin` date NOT NULL,
  `date_checkout` date NOT NULL,
  `number_of_nights` int GENERATED ALWAYS AS ((to_days(`date_checkout`) - to_days(`date_checkin`))) STORED,
  `price` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `suite_id` (`suite_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`suite_id`) REFERENCES `suites` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` (`id`, `booking_date`, `user_id`, `suite_id`, `date_checkin`, `date_checkout`, `price`) VALUES ('fea539db-b9ca-11ec-91bd-005056214326','2022-04-11 19:10:04','fe8e8519-b9ca-11ec-91bd-005056214326','fe880f2a-b9ca-11ec-91bd-005056214326','2022-03-20','2022-03-22',55000);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendars`
--

DROP TABLE IF EXISTS `calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendars` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `suite_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL,
  `booking_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `suite_id` (`suite_id`),
  KEY `user_id` (`user_id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `calendars_ibfk_1` FOREIGN KEY (`suite_id`) REFERENCES `suites` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `calendars_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `calendars_ibfk_3` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendars`
--

LOCK TABLES `calendars` WRITE;
/*!40000 ALTER TABLE `calendars` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establishments`
--

DROP TABLE IF EXISTS `establishments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `establishments` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `adress` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establishments`
--

LOCK TABLES `establishments` WRITE;
/*!40000 ALTER TABLE `establishments` DISABLE KEYS */;
INSERT INTO `establishments` VALUES ('fe7f1962-b9ca-11ec-91bd-005056214326','La rose d\'or','Canne','3 avenue de la place','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),('fe7f79ce-b9ca-11ec-91bd-005056214326','Le palace','Paris','31 avenue des champs Elysee','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),('fe7fb5f2-b9ca-11ec-91bd-005056214326','Burj Al Arib','Brest','13 place du bout du monde','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),('fe7fb70f-b9ca-11ec-91bd-005056214326','Miou Luxury Spa','Strasbourg','244 place de l\'ocean','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),('fe7fb7b4-b9ca-11ec-91bd-005056214326','Villa Honigg','Lille','32 place de l\'été polaire','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),('fe7fb853-b9ca-11ec-91bd-005056214326','The Obarai Udaivalis','Toulouse','131 rue des indiens','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),('fe7fc771-b9ca-11ec-91bd-005056214326','Kitakies','Annecy','1 place du lac','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
/*!40000 ALTER TABLE `establishments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `managers` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `establishment_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `user_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `establishment_id` (`establishment_id`),
  CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`establishment_id`) REFERENCES `establishments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `managers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `managers`
--

LOCK TABLES `managers` WRITE;
/*!40000 ALTER TABLE `managers` DISABLE KEYS */;
INSERT INTO `managers` VALUES ('16255bf0-9997-5489-d9f6-a6ab58790646','fe7f1962-b9ca-11ec-91bd-005056214326','16255bf0-9842-e0db-a468-824158790646'),('fe94f84e-b9ca-11ec-91bd-005056214326','fe7f79ce-b9ca-11ec-91bd-005056214326','fe8e91f0-b9ca-11ec-91bd-005056214326'),('fe9503ed-b9ca-11ec-91bd-005056214326','fe7fb5f2-b9ca-11ec-91bd-005056214326','fe8e92c3-b9ca-11ec-91bd-005056214326'),('fe95074c-b9ca-11ec-91bd-005056214326','fe7fb70f-b9ca-11ec-91bd-005056214326','fe8e937f-b9ca-11ec-91bd-005056214326'),('fe950a48-b9ca-11ec-91bd-005056214326','fe7fb7b4-b9ca-11ec-91bd-005056214326','fe8e942a-b9ca-11ec-91bd-005056214326'),('fe950d21-b9ca-11ec-91bd-005056214326','fe7fb853-b9ca-11ec-91bd-005056214326','fe8e9566-b9ca-11ec-91bd-005056214326'),('fe9511b4-b9ca-11ec-91bd-005056214326','fe7fc771-b9ca-11ec-91bd-005056214326','fe8e961f-b9ca-11ec-91bd-005056214326');
/*!40000 ALTER TABLE `managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `done` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES ('fe9a2a4c-b9ca-11ec-91bd-005056214326','2022-04-11 19:10:04','Warrel','Dane','warrel@example.com','Je voudrais louer un service supplémentaire','Bonjour, est-il possible de louer une voiture en arrivant ?',1),('fe9a5ebd-b9ca-11ec-91bd-005056214326','2022-04-11 19:10:04','Will','Smith','Will@example.com','Je souhaite en savoir plus sur une suite','there are Zombie here ?',0),('fe9a7ba0-b9ca-11ec-91bd-005056214326','2022-04-11 19:10:04','Chris','Roc','Chris@example.com','Je souhaite en savoir plus sur une suite','have you some Ice in this suite ?',0),('fe9b1122-b9ca-11ec-91bd-005056214326','2022-04-11 19:10:04','Dwayne','Johnson','Dwayne@example.com','J\'ai un souci avec cette application','i don\'t know how that work, can you help me ?',1),('fe9b12fc-b9ca-11ec-91bd-005056214326','2022-04-11 19:10:04','Bill','Gates','Bill@example.com','Je voudrais louer un service supplémentaire','Ive lost my Macbook, Have some computer here ?',0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pictures` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `suite_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL,
  `picture_link` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `suite_id` (`suite_id`),
  CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`suite_id`) REFERENCES `suites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES ('16255b8f-37f2-b742-bada-d35958790646','16255b79-3ee5-9000-cc64-539a58790646','/Client/public/images/suite1649785075-640x426.jpeg'),('16255b8f-8112-d6db-6b3c-ea5258790646','16255b79-3ee5-9000-cc64-539a58790646','/Client/public/images/suite1649785080-640x426.jpeg'),('16255b8f-cbfe-e919-b030-3c3558790646','16255b79-3ee5-9000-cc64-539a58790646','/Client/public/images/suite1649785084-640x426.jpeg'),('16255b90-5a93-eb2b-0c5a-7da958790646','16255b80-714e-8b04-cdb4-0d1a58790646','/Client/public/images/suite1649785093-640x426.jpeg'),('16255b98-ae9f-9790-1675-9c0c58790646','16255b80-714e-8b04-cdb4-0d1a58790646','/Client/public/images/suite1649785226-640x426.jpeg'),('16255b99-0222-df02-f439-788758790646','16255b80-714e-8b04-cdb4-0d1a58790646','/Client/public/images/suite1649785232-640x426.jpeg'),('16255b99-ce17-d182-e8c7-000b58790646','fe885ebd-b9ca-11ec-91bd-005056214326','/Client/public/images/suite1649785244-640x426.jpeg'),('16255b9a-13e2-099b-7485-f2e458790646','fe885ebd-b9ca-11ec-91bd-005056214326','/Client/public/images/suite1649785249-640x426.jpeg'),('16255ba4-d3c3-9ad7-ad06-e20158790646','16255ba2-0428-b171-a7ab-647e58790646','/Client/public/images/suite1649785421-640x426.jpeg'),('16255ba5-1136-06b3-bbe2-2e1f58790646','16255ba2-0428-b171-a7ab-647e58790646','/Client/public/images/suite1649785425-640x426.jpeg'),('16255ba5-53b8-c3dc-50f2-5aee58790646','16255ba2-0428-b171-a7ab-647e58790646','/Client/public/images/suite1649785429-640x426.jpeg'),('16255ba6-fc28-0bc9-5656-6fe758790646','16255ba0-84a2-e0a6-2e33-5e9858790646','/Client/public/images/suite1649785455-640x426.jpeg'),('16255ba7-3736-adde-4e2b-010558790646','16255ba0-84a2-e0a6-2e33-5e9858790646','/Client/public/images/suite1649785459-640x426.jpeg'),('16255ba7-863d-ca2b-e41c-9b3658790646','16255ba0-84a2-e0a6-2e33-5e9858790646','/Client/public/images/suite1649785464-640x426.jpeg'),('16255ba8-1edc-8e9c-2076-b5b658790646','16255ba3-2693-dbda-3b20-748358790646','/Client/public/images/suite1649785473-640x426.jpeg'),('16255ba8-7629-51de-aedd-27a958790646','16255ba3-2693-dbda-3b20-748358790646','/Client/public/images/suite1649785479-640x426.jpeg'),('16255ba8-b831-9315-c291-529a58790646','16255ba3-2693-dbda-3b20-748358790646','/Client/public/images/suite1649785483-640x426.jpeg'),('16255bb2-dcb5-d4ad-ae50-5fac58790646','16255bad-9e7d-b2a4-e7c1-b98358790646','/Client/public/images/suite1649785645-640x426.jpeg'),('16255bb3-2dc2-98e6-e082-48f658790646','16255bad-9e7d-b2a4-e7c1-b98358790646','/Client/public/images/suite1649785650-640x426.jpeg'),('16255bb3-6b4e-2536-cd36-596a58790646','16255bad-9e7d-b2a4-e7c1-b98358790646','/Client/public/images/suite1649785654-640x426.jpeg'),('16255bb4-0062-7d38-a92a-36cf58790646','16255bae-a80c-0d8f-8ced-e76f58790646','/Client/public/images/suite1649785664-640x426.jpeg'),('16255bb4-31e2-dae5-3050-471c58790646','16255bae-a80c-0d8f-8ced-e76f58790646','/Client/public/images/suite1649785667-640x426.jpeg'),('16255bb4-6d6b-aa41-5fc1-87aa58790646','16255bae-a80c-0d8f-8ced-e76f58790646','/Client/public/images/suite1649785670-640x426.jpeg'),('16255bb4-fd66-26a9-e220-c53358790646','16255baf-d751-8d53-c9d0-6e9858790646','/Client/public/images/suite1649785679-640x426.jpeg'),('16255bb5-3978-b6b2-07d5-8f6c58790646','16255baf-d751-8d53-c9d0-6e9858790646','/Client/public/images/suite1649785683-640x426.jpeg'),('16255bb5-76be-eda0-c3be-a19558790646','16255baf-d751-8d53-c9d0-6e9858790646','/Client/public/images/suite1649785687-640x426.jpeg'),('16255bbc-dbb0-1965-b836-846258790646','16255bba-2218-f482-75a7-dd4858790646','/Client/public/images/suite1649785805-640x426.jpeg'),('16255bbc-ff3f-f1ad-3db4-a53b58790646','16255bba-2218-f482-75a7-dd4858790646','/Client/public/images/suite1649785807-640x426.jpeg'),('16255bbd-25f3-f0a5-9cf8-c9b658790646','16255bba-2218-f482-75a7-dd4858790646','/Client/public/images/suite1649785810-640x426.jpeg'),('16255bbe-9e02-0cf8-b392-a0ea58790646','16255bba-f9f3-8623-3f9c-21b258790646','/Client/public/images/suite1649785833-640x426.jpeg'),('16255bc0-110e-c5d8-78ee-5dac58790646','16255bbb-b875-c650-3aad-a7ae58790646','/Client/public/images/suite1649785857-640x426.jpeg'),('16255bc0-448a-c66a-b34c-835558790646','16255bbb-b875-c650-3aad-a7ae58790646','/Client/public/images/suite1649785860-640x426.jpeg'),('16255bc0-8009-c5c7-b12f-caed58790646','16255bbb-b875-c650-3aad-a7ae58790646','/Client/public/images/suite1649785863-640x426.jpeg'),('16255bc1-563d-65f4-e290-29ab58790646','16255bba-f9f3-8623-3f9c-21b258790646','/Client/public/images/suite1649785877-640x426.jpeg'),('16255bc2-621a-1788-20fd-04c558790646','16255bba-f9f3-8623-3f9c-21b258790646','/Client/public/images/suite1649785899-640x426.jpeg'),('16255bcc-f530-5da6-25ad-cc1258790646','16255bc6-f06b-5286-e1a6-6b7458790646','/Client/public/images/suite1649786063-640x426.jpeg'),('16255bcd-2e0b-50d8-f33a-e32058790646','16255bc6-f06b-5286-e1a6-6b7458790646','/Client/public/images/suite1649786066-640x426.jpeg'),('16255bcd-66c6-e57c-defc-869258790646','16255bc6-f06b-5286-e1a6-6b7458790646','/Client/public/images/suite1649786070-640x426.jpeg'),('16255bcd-e0b9-51e1-8297-751458790646','16255bc8-3687-4f4a-8744-ac9158790646','/Client/public/images/suite1649786078-640x426.jpeg'),('16255bce-1495-857d-bd76-de5f58790646','16255bc8-3687-4f4a-8744-ac9158790646','/Client/public/images/suite1649786081-640x426.jpeg'),('16255bce-456a-3266-2e62-1b1958790646','16255bc8-3687-4f4a-8744-ac9158790646','/Client/public/images/suite1649786084-640x426.jpeg'),('16255bce-bb61-9a42-4fa5-ef4258790646','16255bcc-5ce6-2d44-5478-d0a158790646','/Client/public/images/suite1649786091-640x426.jpeg'),('16255bce-e39c-7276-a9d0-38eb58790646','16255bcc-5ce6-2d44-5478-d0a158790646','/Client/public/images/suite1649786094-640x426.jpeg'),('16255bcf-1366-5666-2c4e-64eb58790646','16255bcc-5ce6-2d44-5478-d0a158790646','/Client/public/images/suite1649786097-640x426.jpeg'),('16255bd9-71bb-ad0b-6a95-926558790646','16255bd6-abc9-6483-ce03-49bf58790646','/Client/public/images/suite1649786263-640x426.jpeg'),('16255bd9-991e-21f0-18ab-a23b58790646','16255bd6-abc9-6483-ce03-49bf58790646','/Client/public/images/suite1649786265-640x426.jpeg'),('16255bd9-da9a-1e9f-1640-c2cb58790646','16255bd6-abc9-6483-ce03-49bf58790646','/Client/public/images/suite1649786269-640x426.jpeg'),('16255bdb-297a-9e7d-240a-e94458790646','16255bd7-7cfa-acac-554e-f88e58790646','/Client/public/images/suite1649786290-640x426.jpeg'),('16255bdb-6c9b-02fa-6ba4-1f2c58790646','16255bd7-7cfa-acac-554e-f88e58790646','/Client/public/images/suite1649786294-640x426.jpeg'),('16255bdb-b01d-4b5e-b973-e02d58790646','16255bd7-7cfa-acac-554e-f88e58790646','/Client/public/images/suite1649786298-640x426.jpeg'),('16255bdc-32ec-a192-5437-b36e58790646','16255bd8-3c36-1f2e-d2cb-1c9858790646','/Client/public/images/suite1649786307-640x426.jpeg'),('16255bdc-663c-e491-65ed-162758790646','16255bd8-3c36-1f2e-d2cb-1c9858790646','/Client/public/images/suite1649786310-640x426.jpeg'),('16255bdc-9089-4091-cf68-296d58790646','16255bd8-3c36-1f2e-d2cb-1c9858790646','/Client/public/images/suite1649786313-640x426.jpeg'),('16255bf6-7023-1bd4-7705-cf2258790646','16255bf5-f006-4c19-05a4-f95a58790646','/Client/public/images/suite1649786726-640x426.jpeg'),('16255bf6-9294-25fc-6964-65df58790646','16255bf5-f006-4c19-05a4-f95a58790646','/Client/public/images/suite1649786729-640x426.jpeg'),('16255bf6-cce4-818d-441a-8aeb58790646','16255bf5-f006-4c19-05a4-f95a58790646','/Client/public/images/suite1649786732-640x426.jpeg'),('fe8c465b-b9ca-11ec-91bd-005056214326','fe880f2a-b9ca-11ec-91bd-005056214326','/Client/public/images/chambre1.jpeg'),('fe8c77f3-b9ca-11ec-91bd-005056214326','fe88589e-b9ca-11ec-91bd-005056214326','/Client/public/images/chambre2.jpeg'),('fe8c8158-b9ca-11ec-91bd-005056214326','fe885ebd-b9ca-11ec-91bd-005056214326','/Client/public/images/chambre3.jpeg'),('fe8c891e-b9ca-11ec-91bd-005056214326','fe880f2a-b9ca-11ec-91bd-005056214326','https://picsum.photos/640/480');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suites`
--

DROP TABLE IF EXISTS `suites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suites` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `title` varchar(255) NOT NULL,
  `link_to_booking` text,
  `description` text NOT NULL,
  `price` int NOT NULL,
  `establishment_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `establishment_id` (`establishment_id`),
  CONSTRAINT `suites_ibfk_1` FOREIGN KEY (`establishment_id`) REFERENCES `establishments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suites`
--

LOCK TABLES `suites` WRITE;
/*!40000 ALTER TABLE `suites` DISABLE KEYS */;
INSERT INTO `suites` VALUES ('16255b79-3ee5-9000-cc64-539a58790646','Grand penthouse','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',40000,'fe7f79ce-b9ca-11ec-91bd-005056214326'),('16255b80-714e-8b04-cdb4-0d1a58790646','Royal Penthouse Suite','https://loremi.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',50000,'fe7f79ce-b9ca-11ec-91bd-005056214326'),('16255ba0-84a2-e0a6-2e33-5e9858790646','Ty Wernar Penthouse','https://lorem.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',80000,'fe7fb5f2-b9ca-11ec-91bd-005056214326'),('16255ba2-0428-b171-a7ab-647e58790646','Delana Hilltop Residence,','https://lorempics.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',70000,'fe7fb5f2-b9ca-11ec-91bd-005056214326'),('16255ba3-2693-dbda-3b20-748358790646','The Royal Villa','https://loremipsumdolor.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',50000,'fe7fb5f2-b9ca-11ec-91bd-005056214326'),('16255bad-9e7d-b2a4-e7c1-b98358790646','Penthouse Suite','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',60000,'fe7fb70f-b9ca-11ec-91bd-005056214326'),('16255bae-a80c-0d8f-8ced-e76f58790646','Two Story Sky Villa','https://lorem.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',60000,'fe7fb70f-b9ca-11ec-91bd-005056214326'),('16255baf-d751-8d53-c9d0-6e9858790646','Appartement Penthouse','https://lorempic.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',540000,'fe7fb70f-b9ca-11ec-91bd-005056214326'),('16255bba-2218-f482-75a7-dd4858790646','Penthouse Suite','https://loremragnar.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',210000,'fe7fb7b4-b9ca-11ec-91bd-005056214326'),('16255bba-f9f3-8623-3f9c-21b258790646','Grand penthouse Suite','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',150000,'fe7fb7b4-b9ca-11ec-91bd-005056214326'),('16255bbb-b875-c650-3aad-a7ae58790646','The Royal Penthouse','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',140000,'fe7fb7b4-b9ca-11ec-91bd-005056214326'),('16255bc6-f06b-5286-e1a6-6b7458790646','the one Forgiven','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',214500,'fe7fb853-b9ca-11ec-91bd-005056214326'),('16255bc8-3687-4f4a-8744-ac9158790646','The master of puppies','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',152000,'fe7fb853-b9ca-11ec-91bd-005056214326'),('16255bcc-5ce6-2d44-5478-d0a158790646','The Good Suites','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',120000,'fe7fb853-b9ca-11ec-91bd-005056214326'),('16255bd6-abc9-6483-ce03-49bf58790646','The regent suite','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',120000,'fe7fc771-b9ca-11ec-91bd-005056214326'),('16255bd7-7cfa-acac-554e-f88e58790646','The first','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',80000,'fe7fc771-b9ca-11ec-91bd-005056214326'),('16255bd8-3c36-1f2e-d2cb-1c9858790646','Royal Suite','https://loremipsume.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',145000,'fe7fc771-b9ca-11ec-91bd-005056214326'),('16255bf5-f006-4c19-05a4-f95a58790646','the Selena\'s suite','https://lorem.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',250000,'fe7f1962-b9ca-11ec-91bd-005056214326'),('fe880f2a-b9ca-11ec-91bd-005056214326','Eros','https://iamaveryusefullinktobooking.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',35000,'fe7f1962-b9ca-11ec-91bd-005056214326'),('fe88589e-b9ca-11ec-91bd-005056214326','La Marinière','https://iamaveryusefullinktobooking.com','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',35000,'fe7f1962-b9ca-11ec-91bd-005056214326'),('fe885ebd-b9ca-11ec-91bd-005056214326','La Cupidon','https://iamaveryusefullinktobooking.com','Seul les anges résisteront',45000,'fe7f79ce-b9ca-11ec-91bd-005056214326');
/*!40000 ALTER TABLE `suites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT (uuid()),
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(3) NOT NULL DEFAULT 'use',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('16255b12-072f-db56-5359-950c58790646','grignon.david@gmail.com','David','Grignon','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','adm'),('16255bf0-9842-e0db-a468-824158790646','bruce@example.com','bruce','Wayne','$2y$10$6GB8d97t4.t5HsbGdlEdeubMT4is6ESVO2GY0Gimni5wj6NNVTm3i','man'),('fe8e6c8c-b9ca-11ec-91bd-005056214326','john.doe@example.com','john','Doe','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','adm'),('fe8e8519-b9ca-11ec-91bd-005056214326','jack@example.com','jack','Sparrow','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','adm'),('fe8e91f0-b9ca-11ec-91bd-005056214326','frodon@example.com','Frodon','baggins','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','man'),('fe8e92c3-b9ca-11ec-91bd-005056214326','sauron@example.com','Sauron','the magic daemon','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','man'),('fe8e937f-b9ca-11ec-91bd-005056214326','gandalf@example.com','gandalf','the magician','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','man'),('fe8e942a-b9ca-11ec-91bd-005056214326','ragnar@example.com','ragnar','lothbrokes','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','man'),('fe8e9566-b9ca-11ec-91bd-005056214326','kirk@example.com','kirk','hammett','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','man'),('fe8e961f-b9ca-11ec-91bd-005056214326','alexi@example.com','Alexi','Laiho','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','man'),('fe8e977e-b9ca-11ec-91bd-005056214326','jeff@example.com','Jeff','Loomis','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','use'),('fe8e9833-b9ca-11ec-91bd-005056214326','warrel@example.com','Warrel','Dane','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','use'),('fe8e98d9-b9ca-11ec-91bd-005056214326','Danny@example.com','Danny','Ocean','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','use'),('fe8e9983-b9ca-11ec-91bd-005056214326','Rusty@example.com','Rusty','Ryan','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','use'),('fe8e9a22-b9ca-11ec-91bd-005056214326','Jordan@example.com','Jordan','Belfort','$2y$10$rJdi/EQoVOI40Zqvb9A5s.SRPUWFSx72bdxZ70/V8IrTpX7lKZ16a','use');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-12 18:13:56
