-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: al_nadi_ul_falah
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` int(11) DEFAULT NULL,
  `old_amount` decimal(10,2) DEFAULT NULL,
  `new_amount` decimal(10,2) DEFAULT NULL,
  `old_mode` varchar(50) DEFAULT NULL,
  `new_mode` varchar(50) DEFAULT NULL,
  `old_date` date DEFAULT NULL,
  `new_date` date DEFAULT NULL,
  `edited_by` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending_approval','approved','rejected') DEFAULT NULL,
  `edit_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(50) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `class_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_name` (`class_name`,`class_number`),
  UNIQUE KEY `class_number` (`class_number`),
  UNIQUE KEY `class_number_2` (`class_number`),
  KEY `section_name` (`section_name`) USING BTREE,
  CONSTRAINT `fk_section_name` FOREIGN KEY (`section_name`) REFERENCES `sections` (`section_name`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,'Pre-Primary','Nursery',-3),(2,'Pre-Primary','Sr. KG',-1),(3,'Pre-Primary','Jr. KG',-2),(4,'Primary','Class 1',1),(5,'Primary','Class 2',2),(6,'Primary','Class 3',3),(7,'Primary','Class 4',4),(8,'Primary','Class 5',5),(9,'Primary','Class 6',6),(10,'Primary','Class 7',7),(11,'Primary','Class 8',8),(12,'Secondary','Class 9',9),(13,'Secondary','Class 10',10);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `division_name` varchar(10) NOT NULL,
  `division_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_division` (`division_name`,`division_number`) USING BTREE,
  KEY `fk_class_name` (`class_name`),
  CONSTRAINT `fk_class_name` FOREIGN KEY (`class_name`) REFERENCES `classes` (`class_name`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'Nursery','A',1),(2,'Sr. KG','A',2),(3,'Jr. KG','A',3),(4,'Class 1','A',4),(5,'Class 2','A',5),(6,'Class 3','A',6),(7,'Class 4','A',7),(8,'Class 5','A',8),(13,'Class 10','A',13);
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_master`
--

DROP TABLE IF EXISTS `fees_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_type` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `frequency` varchar(50) NOT NULL,
  `due_date` varchar(50) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `class` (`class`),
  KEY `section` (`section`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_master`
--

LOCK TABLES `fees_master` WRITE;
/*!40000 ALTER TABLE `fees_master` DISABLE KEYS */;
INSERT INTO `fees_master` VALUES (8,'Tution Fee','1400','Jr. KG','Pre-Primary','Monthly','15'),(9,'Tution Fee','1400','Nursery','Pre-Primary','Monthly','15'),(13,'Tution Fee','1400','Class 1','Primary','Monthly','15'),(14,'Tution Fee','1400','Class 2','Primary','Monthly','15'),(22,'Dress','1400','Class 2','Primary','Yearly','15'),(26,'Dress','1400','Class 7','Primary','Yearly','10'),(27,'Dress','1400','Class 8','Primary','Yearly','10'),(28,'Dress','1400','Sr. KG','Pre-Primary','Monthly','10');
/*!40000 ALTER TABLE `fees_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_table`
--

DROP TABLE IF EXISTS `fees_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(50) NOT NULL,
  `gr_no` varchar(20) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `description` varchar(50) NOT NULL,
  `amount_paid` int(10) unsigned NOT NULL,
  `due_amount` decimal(10,2) NOT NULL,
  `month_of_payment` varchar(10) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `payment_date` datetime NOT NULL,
  `accepted_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_gr_no` (`gr_no`),
  CONSTRAINT `fees_table_ibfk_1` FOREIGN KEY (`gr_no`) REFERENCES `students` (`gr_no`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_table`
--

LOCK TABLES `fees_table` WRITE;
/*!40000 ALTER TABLE `fees_table` DISABLE KEYS */;
INSERT INTO `fees_table` VALUES (1,'R-2025123','123','Abid Akib Khan','Tuition Fees',12000,0.00,'July','Cash','2025-08-08 00:00:00','admin'),(2,'R-2025123','123','Abid Akib Khan','Tuition Fees',10000,0.00,'August','Cash','2025-08-08 00:00:00','staff'),(3,'R-2025124','123','Abid Akib Khan','Tuition Fees',20000,0.00,'September','Online','2025-08-09 00:00:00','admin');
/*!40000 ALTER TABLE `fees_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_admins`
--

DROP TABLE IF EXISTS `login_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_name` varchar(11) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `role` enum('Admin','Accountant') NOT NULL,
  `status` enum('active','deactive') NOT NULL,
  `default_section` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `default_section` (`default_section`),
  CONSTRAINT `login_admins_ibfk_1` FOREIGN KEY (`default_section`) REFERENCES `sections` (`section_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_admins`
--

LOCK TABLES `login_admins` WRITE;
/*!40000 ALTER TABLE `login_admins` DISABLE KEYS */;
INSERT INTO `login_admins` VALUES (1,'rafiq12@gmail.com','+91 8576898456','admin','$2y$10$m6Qc41wUf7rDF.kupv.T3OVQHfeV6oGB/6bB8ZQ33ES7v9vezwZYu','Rafiq',NULL,'Admin','active','Pre-Primary'),(2,'abc@gmail.com','+91 7689867545','staff','$2y$10$m6Qc41wUf7rDF.kupv.T3OVQHfeV6oGB/6bB8ZQ33ES7v9vezwZYu','Ishaq',NULL,'Accountant','active','Primary'),(3,'xyz@gmail.com','+91 7689867545','xyz','$2y$10$m6Qc41wUf7rDF.kupv.T3OVQHfeV6oGB/6bB8ZQ33ES7v9vezwZYu','Xyz',NULL,'Accountant','active','Primary'),(4,'aqib@gmail.com','+91 6575454678','aqib','$2y$10$m6Qc41wUf7rDF.kupv.T3OVQHfeV6oGB/6bB8ZQ33ES7v9vezwZYu','Aqib',NULL,'Admin','active','Pre-Primary');
/*!40000 ALTER TABLE `login_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(50) NOT NULL,
  `section_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `section_name` (`section_name`),
  UNIQUE KEY `section_number` (`section_number`),
  UNIQUE KEY `unique_section_name` (`section_name`),
  UNIQUE KEY `section_name_2` (`section_name`,`section_number`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'Pre-Primary',1),(2,'Primary',2),(3,'Secondary',3);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'school_name',200,7);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_changes`
--

DROP TABLE IF EXISTS `student_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old_gr_no` varchar(20) DEFAULT NULL,
  `new_gr_no` varchar(20) DEFAULT NULL,
  `changed_by` varchar(50) DEFAULT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_changes`
--

LOCK TABLES `student_changes` WRITE;
/*!40000 ALTER TABLE `student_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gr_no` varchar(20) NOT NULL,
  `roll_no` int(10) unsigned NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `section` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `division` varchar(10) NOT NULL,
  `management_quota` enum('Yes','No') DEFAULT 'No',
  `discount_percentage` decimal(5,2) DEFAULT 0.00,
  `total_fees_paid` int(11) NOT NULL,
  `due_fees` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `gr_no` (`gr_no`),
  KEY `section` (`section`,`class`,`division`),
  KEY `section_2` (`section`,`class`,`division`),
  KEY `class` (`class`),
  KEY `division` (`division`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section`) REFERENCES `sections` (`section_name`),
  CONSTRAINT `students_ibfk_2` FOREIGN KEY (`class`) REFERENCES `classes` (`class_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'123',1,'Abid','Akib','Khan','Amina','8768583923','Male','Pre-Primary','Sr. KG','A','No',0.00,42000,0,'2025-07-06 09:14:35'),(2,'124',1,'amin','sajid','Khan','asifa','9764875779','Male','Secondary','Class 10','A','Yes',50.00,20000,0,'2025-08-10 13:59:45');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `logo` varchar(50) NOT NULL DEFAULT './assets/school.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_info`
--

LOCK TABLES `system_info` WRITE;
/*!40000 ALTER TABLE `system_info` DISABLE KEYS */;
INSERT INTO `system_info` VALUES (1,'AL-NADI-UL FALAH ENGLISH HIGH SCHOOL','anfehs@gmail','+91 9867564778','abc, afhe8fe, Mumbra Thane Maharashtra India','2025-2026','./assets/school_logo.png');
/*!40000 ALTER TABLE `system_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-11  0:37:58
