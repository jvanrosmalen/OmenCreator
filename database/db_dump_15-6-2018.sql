-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: databases.aii.avans.nl    Database: jrosmale_db
-- ------------------------------------------------------
-- Server version	5.6.37-log

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
-- Table structure for table `armors`
--

DROP TABLE IF EXISTS `armors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_normal` int(11) NOT NULL,
  `price_good` int(11) NOT NULL,
  `price_master` int(11) NOT NULL,
  `armor_normal` int(11) NOT NULL,
  `armor_good` int(11) NOT NULL,
  `armor_master` int(11) NOT NULL,
  `structure_normal` int(11) NOT NULL,
  `structure_good` int(11) NOT NULL,
  `structure_master` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `armors_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armors`
--

LOCK TABLES `armors` WRITE;
/*!40000 ALTER TABLE `armors` DISABLE KEYS */;
INSERT INTO `armors` VALUES (1,'Lederen Pantser','Het meest voorkomende ‘pantser’ in Heimar biedt geringe bescherming, maar volle vrijheid en wordt als niet-agressief gezien door de meerderheid van de bevolking. Lederen pantsers zijn favoriet bij vagebonden en verkenners, klassen waar lenigheid een troef is.<br>',1,15,150,2,2,3,0,2,6),(2,'Versterkte Kledij','Enkel verkrijgbaar vanaf goede kwaliteit, versterkte kledij wordt gedragen door bijna iedereen van goede standing in Heimar, vooral tijdens diens vrije tijd of in formele kringen waar pantserdracht wordt afgekeurd. &nbsp;<br>',0,10,100,0,1,1,0,1,2),(5,'Mann-Plaat','Ook hier bekommeren de Mannheimers zich niet over de \'lichtere\' versies van de zwakkere naties. Echte mannen dragen Mann-plaat, bij Hymir!<div><br></div><div><i>Speltechnisch: Onder Mann-plaat verstaan we alle \'echte\' plaatpantsers van een aanzienlijk gewicht. Mann-plaat telt als een zwaar pantser en vereist de vaardigheid: \'Pantserdracht II\'.</i></div>',30,160,1600,10,10,15,0,10,30);
/*!40000 ALTER TABLE `armors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_rule_craft_equipment`
--

DROP TABLE IF EXISTS `call_rule_craft_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_rule_craft_equipment` (
  `craft_equipment_id` int(10) unsigned NOT NULL,
  `call_rule_id` int(10) unsigned NOT NULL,
  KEY `call_rule_craft_equipment_craft_equipment_id_index` (`craft_equipment_id`),
  KEY `call_rule_craft_equipment_call_rule_id_index` (`call_rule_id`),
  CONSTRAINT `call_rule_craft_equipment_call_rule_id_foreign` FOREIGN KEY (`call_rule_id`) REFERENCES `call_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `call_rule_craft_equipment_craft_equipment_id_foreign` FOREIGN KEY (`craft_equipment_id`) REFERENCES `craft_equipments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rule_craft_equipment`
--

LOCK TABLES `call_rule_craft_equipment` WRITE;
/*!40000 ALTER TABLE `call_rule_craft_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_rule_craft_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_rule_generic_equipment`
--

DROP TABLE IF EXISTS `call_rule_generic_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_rule_generic_equipment` (
  `generic_equipment_id` int(10) unsigned NOT NULL,
  `call_rule_id` int(10) unsigned NOT NULL,
  KEY `call_rule_generic_equipment_generic_equipment_id_index` (`generic_equipment_id`),
  KEY `call_rule_generic_equipment_call_rule_id_index` (`call_rule_id`),
  CONSTRAINT `call_rule_generic_equipment_call_rule_id_foreign` FOREIGN KEY (`call_rule_id`) REFERENCES `call_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `call_rule_generic_equipment_generic_equipment_id_foreign` FOREIGN KEY (`generic_equipment_id`) REFERENCES `generic_equipments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rule_generic_equipment`
--

LOCK TABLES `call_rule_generic_equipment` WRITE;
/*!40000 ALTER TABLE `call_rule_generic_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_rule_generic_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_rule_race`
--

DROP TABLE IF EXISTS `call_rule_race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_rule_race` (
  `race_id` int(10) unsigned NOT NULL,
  `call_rule_id` int(10) unsigned NOT NULL,
  KEY `call_rule_race_race_id_index` (`race_id`),
  KEY `call_rule_race_call_rule_id_index` (`call_rule_id`),
  CONSTRAINT `call_rule_race_call_rule_id_foreign` FOREIGN KEY (`call_rule_id`) REFERENCES `call_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `call_rule_race_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rule_race`
--

LOCK TABLES `call_rule_race` WRITE;
/*!40000 ALTER TABLE `call_rule_race` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_rule_race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_rule_skill`
--

DROP TABLE IF EXISTS `call_rule_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_rule_skill` (
  `skill_id` int(10) unsigned NOT NULL,
  `call_rule_id` int(10) unsigned NOT NULL,
  KEY `call_rule_skill_skill_id_index` (`skill_id`),
  KEY `call_rule_skill_call_rule_id_index` (`call_rule_id`),
  CONSTRAINT `call_rule_skill_call_rule_id_foreign` FOREIGN KEY (`call_rule_id`) REFERENCES `call_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `call_rule_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rule_skill`
--

LOCK TABLES `call_rule_skill` WRITE;
/*!40000 ALTER TABLE `call_rule_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_rule_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_rules`
--

DROP TABLE IF EXISTS `call_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `call_type_id` int(10) unsigned NOT NULL,
  `rules_operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `call_rules_id_index` (`id`),
  KEY `call_rules_call_type_id_foreign` (`call_type_id`),
  KEY `call_rules_rules_operator_foreign` (`rules_operator`),
  CONSTRAINT `call_rules_call_type_id_foreign` FOREIGN KEY (`call_type_id`) REFERENCES `call_types` (`id`),
  CONSTRAINT `call_rules_rules_operator_foreign` FOREIGN KEY (`rules_operator`) REFERENCES `immune_does_operators` (`operator_name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rules`
--

LOCK TABLES `call_rules` WRITE;
/*!40000 ALTER TABLE `call_rules` DISABLE KEYS */;
INSERT INTO `call_rules` VALUES (1,1,'doet'),(2,1,'is immuun aan'),(3,2,'doet'),(4,2,'is immuun aan'),(5,3,'doet'),(6,3,'is immuun aan'),(7,4,'doet'),(8,4,'is immuun aan'),(9,5,'doet'),(10,5,'is immuun aan'),(11,6,'doet'),(12,6,'is immuun aan'),(13,7,'doet'),(14,7,'is immuun aan'),(15,8,'doet'),(16,8,'is immuun aan'),(17,9,'doet'),(18,9,'is immuun aan'),(19,10,'doet'),(20,10,'is immuun aan'),(21,11,'doet'),(22,11,'is immuun aan'),(23,12,'doet'),(24,12,'is immuun aan'),(25,13,'doet'),(26,13,'is immuun aan'),(27,14,'doet'),(28,14,'is immuun aan');
/*!40000 ALTER TABLE `call_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_types`
--

DROP TABLE IF EXISTS `call_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `call_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `call_types_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_types`
--

LOCK TABLES `call_types` WRITE;
/*!40000 ALTER TABLE `call_types` DISABLE KEYS */;
INSERT INTO `call_types` VALUES (1,'Angst'),(2,'Bevel'),(3,'Bloeding'),(4,'Bottenbreker'),(5,'Door Pantser'),(6,'Gif'),(7,'Impact'),(8,'Infectie'),(9,'Klief'),(10,'Krachtslag'),(11,'Magisch'),(12,'Pareer'),(13,'Ontwapen'),(14,'Ontwijk');
/*!40000 ALTER TABLE `call_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_descent_class`
--

DROP TABLE IF EXISTS `character_descent_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_descent_class` (
  `character_id` int(10) unsigned NOT NULL,
  `player_class_id` int(10) unsigned NOT NULL,
  KEY `character_descent_class_character_id_index` (`character_id`),
  KEY `character_descent_class_player_class_id_index` (`player_class_id`),
  CONSTRAINT `character_descent_class_character_id_foreign` FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `character_descent_class_player_class_id_foreign` FOREIGN KEY (`player_class_id`) REFERENCES `player_classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_descent_class`
--

LOCK TABLES `character_descent_class` WRITE;
/*!40000 ALTER TABLE `character_descent_class` DISABLE KEYS */;
INSERT INTO `character_descent_class` VALUES (26,4),(26,7),(27,4),(27,7),(28,4),(28,7),(29,4),(29,7),(30,4),(30,7),(31,4),(31,7),(32,4),(32,7),(33,4),(33,7),(34,4),(34,7),(35,4),(35,7);
/*!40000 ALTER TABLE `character_descent_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_skill`
--

DROP TABLE IF EXISTS `character_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_skill` (
  `character_id` int(10) unsigned NOT NULL,
  `skill_id` int(10) unsigned NOT NULL,
  `purchase_ep_cost` int(11) NOT NULL,
  `is_descent_skill` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_out_of_class_skill` tinyint(1) NOT NULL,
  KEY `character_skill_character_id_index` (`character_id`),
  KEY `character_skill_skill_id_index` (`skill_id`),
  CONSTRAINT `character_skill_character_id_foreign` FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `character_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_skill`
--

LOCK TABLES `character_skill` WRITE;
/*!40000 ALTER TABLE `character_skill` DISABLE KEYS */;
INSERT INTO `character_skill` VALUES (26,1,0,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,13,2,1,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,14,1,1,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,18,2,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,21,2,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,22,2,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,2,1,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,4,1,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,9,1,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,17,2,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,7,1,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,8,1,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,16,1,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(26,54,1,0,'2018-06-15 10:56:08','2018-06-24 12:27:47',0),(27,1,0,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,13,2,1,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,14,1,1,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,51,6,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,16,1,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,21,2,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,15,2,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,17,2,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,9,1,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(27,2,1,0,'2018-06-17 07:57:58','2018-06-17 07:57:58',0),(28,1,0,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,13,2,1,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,14,1,1,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,16,1,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,54,1,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,51,6,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,9,1,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,10,1,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,11,1,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',0),(28,6,4,0,'2018-06-17 08:12:24','2018-06-17 08:12:24',1),(29,1,0,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,13,2,1,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,14,1,1,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,21,2,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,22,2,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,16,1,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,9,1,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,10,1,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,11,1,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,18,2,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,54,1,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,53,2,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(29,15,2,0,'2018-06-17 11:37:36','2018-06-17 11:37:36',0),(30,1,0,0,'2018-06-17 15:04:56','2018-06-17 15:04:56',0),(30,13,2,1,'2018-06-17 15:04:56','2018-06-17 15:04:56',0),(30,14,1,1,'2018-06-17 15:04:56','2018-06-17 15:04:56',0),(31,1,0,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,13,2,1,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,14,1,1,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,41,2,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,21,2,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,22,2,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,6,2,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,44,2,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,18,2,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,16,1,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,54,1,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,53,2,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,39,3,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(31,9,1,0,'2018-06-17 15:07:32','2018-06-17 15:07:32',0),(32,1,0,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,13,2,1,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,14,1,1,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,51,6,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,16,1,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,21,2,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,22,2,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,15,2,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,9,1,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(32,10,1,0,'2018-06-18 04:39:53','2018-06-18 04:39:53',0),(33,1,0,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,13,2,1,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,14,1,1,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,21,2,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,22,2,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,44,2,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,16,1,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,9,1,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,10,1,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,11,1,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,12,1,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,57,3,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,15,2,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,17,2,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,7,1,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,51,5,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(33,8,1,0,'2018-06-23 13:31:23','2018-06-23 13:31:23',0),(34,1,0,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,13,2,1,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,14,1,1,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,4,1,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,21,2,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,22,2,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,56,4,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,54,1,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,53,2,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,16,1,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(34,15,2,0,'2018-06-23 18:42:56','2018-06-23 18:42:56',0),(35,1,0,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,8,1,1,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,21,2,1,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,7,1,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,16,1,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,54,1,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,9,1,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,3,1,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,5,1,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,18,2,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',0),(35,47,2,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',1),(35,13,4,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',1),(35,22,4,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',1),(35,14,2,0,'2018-06-27 06:40:24','2018-06-27 06:40:24',1);
/*!40000 ALTER TABLE `character_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `character_user`
--

DROP TABLE IF EXISTS `character_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `character_user` (
  `character_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  KEY `character_user_character_id_index` (`character_id`),
  KEY `character_user_user_id_index` (`user_id`),
  CONSTRAINT `character_user_character_id_foreign` FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `character_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `character_user`
--

LOCK TABLES `character_user` WRITE;
/*!40000 ALTER TABLE `character_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `character_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `characters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `player_class_id` int(10) unsigned NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ep_amount` int(10) unsigned NOT NULL,
  `is_alive` tinyint(1) NOT NULL,
  `is_player_char` tinyint(1) NOT NULL,
  `nr_events_survived` int(10) unsigned NOT NULL,
  `link_to_background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spark_data` text COLLATE utf8_unicode_ci NOT NULL,
  `descent_ep_amount` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `create_status` int(10) unsigned NOT NULL,
  `faith_id` int(10) unsigned DEFAULT '1',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_info` mediumtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `characters_id_index` (`id`),
  KEY `characters_player_class_id_foreign` (`player_class_id`),
  KEY `characters_race_id_foreign` (`race_id`),
  KEY `characters_user_id_foreign` (`user_id`),
  KEY `fk_name` (`faith_id`),
  CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`faith_id`) REFERENCES `faiths` (`id`) ON DELETE CASCADE,
  CONSTRAINT `characters_player_class_id_foreign` FOREIGN KEY (`player_class_id`) REFERENCES `player_classes` (`id`),
  CONSTRAINT `characters_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`),
  CONSTRAINT `characters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characters`
--

LOCK TABLES `characters` WRITE;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;
INSERT INTO `characters` VALUES (26,'Ragnar',4,1,10,15,1,1,4,NULL,'{\"title\":\"Grondstoffen 3\",\"text\":[\"Ook al ben je geen handelaar (of net wel), je hebt ergens in het verleden &eacute;&eacute;n of meer grondstoffen  kunnen ruilen of kopen die je nog bij je hebt.\",\"Je ontvangt 1 grondstof ieder van de types: Huid, Stof, Huid\"],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'Groothertog',''),(27,'Arfast',4,1,12,15,1,1,0,NULL,'{\"title\":\"Heilig Reliek 1\",\"text\":[\"Je bent in het bezit van een klein reliek toegewijd aan jouw geloof.\",\"Je ontvangt een Niveau 1 Reliek.\"],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'Groothertog van Huis Myrlund',NULL),(28,'Stefan',4,1,8,15,0,1,0,NULL,'{\"title\":\"Vijand\\/Rivaal 1\",\"text\":[\"In het verre of recente verleden heb je een rivaal of vijand \\n\\t\\t\\t\\t\\t gemaakt die tot op deze dag nog in je weg kan lopen.\",\"Spelleiding zal beroep doen op je achtergrond en je  \\n\\t\\t\\t\\t\\tinformeren wie je vijand(en) zal zijn.\"],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'',NULL),(29,'Robinya',4,1,7,15,1,1,0,NULL,'{\"title\":\"Ziek 1\",\"text\":[\"Tijdens je reizen heb je een vervelende ziekte opgelopen.\\n\\t\\t\\t\\t Je begint het spel onder invloed van een Niveau 1 Ziekte.\",\"Koppig heb je wel op dokterskosten bespaart: Je ontvangt 5 Brons.\"],\"money\":5,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'Schildmaagd van de Sibbe',NULL),(30,'Conan',4,1,11,15,0,1,0,NULL,'{\"title\":\"Alles al meegemaakt\",\"text\":[\"Je hebt al in redelijk wat benarde situaties gezeten.\",\"Je ontvangt +1 Trauma Resistentie. Dit telt niet als een vaardigheid.\"],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":1,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,1,'',NULL),(31,'Rollo',4,1,6,20,1,1,3,NULL,'{\"title\":\"Grondstoffen 3\",\"text\":[\"Ook al ben je geen handelaar (of net wel), je hebt ergens in het verleden &eacute;&eacute;n of meer grondstoffen  kunnen ruilen of kopen die je nog bij je hebt.\",\"Je ontvangt 1 grondstof ieder van de types: Erts, Beender, Erts, Vacht, Vacht\"],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'',NULL),(32,'Nikita',4,1,7,15,1,1,0,NULL,'{\"title\":\"Vijand\\/Rivaal 1\",\"text\":[\"In het verre of recente verleden heb je een rivaal of vijand \\n\\t\\t\\t\\t\\t gemaakt die tot op deze dag nog in je weg kan lopen.\",\"Spelleiding zal beroep doen op je achtergrond en je  \\n\\t\\t\\t\\t\\tinformeren wie je vijand(en) zal zijn.\"],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'Groothertogin van Huis Stalhardt',NULL),(33,'Cleo',4,1,12,25,1,1,4,NULL,'{\"title\":\"Allergische reactie\",\"text\":[\"Indien je schade ontvangt van Spinnen ontvang je automatisch de ziekte Allergische Reactie. Deze zorgt ervoor dat je niet geheeld kan worden met Chirurgie tot de Allergie met de vaardigheid Menden is weggewerkt\"],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'',NULL),(34,'Thomaas',4,1,10,15,1,1,0,NULL,'{\"title\":\"Vergiftigd 1\",\"text\":[\"Je bent gebeten, gestoken of had nooit van die Ranae een drankje mogen aannemen.\\n\\t\\t\\t\\t Je begint het spel onder invloed van een Niveau 2 Gif.\",\"Koppig heb je wel op dokterskosten bespaart: Je ontvangt 5 Brons.\"],\"money\":5,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,2,'',NULL),(35,'Test1',2,1,10,20,1,1,0,NULL,'{\"title\":\"\",\"text\":[],\"money\":0,\"trauma\":0,\"income_bonus\":0,\"descent_ep\":0,\"wealth_bonus\":0,\"statistics\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0},\"resistances\":{\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0}}',3,1,0,5,'',NULL);
/*!40000 ALTER TABLE `characters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_rule_skill`
--

DROP TABLE IF EXISTS `class_rule_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_rule_skill` (
  `skill_id` int(10) unsigned NOT NULL,
  `class_rule_id` int(10) unsigned NOT NULL,
  KEY `class_rule_skill_skill_id_index` (`skill_id`),
  KEY `class_rule_skill_class_rule_id_index` (`class_rule_id`),
  CONSTRAINT `class_rule_skill_class_rule_id_foreign` FOREIGN KEY (`class_rule_id`) REFERENCES `class_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `class_rule_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_rule_skill`
--

LOCK TABLES `class_rule_skill` WRITE;
/*!40000 ALTER TABLE `class_rule_skill` DISABLE KEYS */;
INSERT INTO `class_rule_skill` VALUES (41,5);
/*!40000 ALTER TABLE `class_rule_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_rules`
--

DROP TABLE IF EXISTS `class_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player_class_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_rules_id_index` (`id`),
  KEY `class_rules_player_class_id_foreign` (`player_class_id`),
  CONSTRAINT `class_rules_player_class_id_foreign` FOREIGN KEY (`player_class_id`) REFERENCES `player_classes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_rules`
--

LOCK TABLES `class_rules` WRITE;
/*!40000 ALTER TABLE `class_rules` DISABLE KEYS */;
INSERT INTO `class_rules` VALUES (1,2),(2,3),(3,4),(4,5),(5,6),(6,7);
/*!40000 ALTER TABLE `class_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coins`
--

DROP TABLE IF EXISTS `coins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coin` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coins_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coins`
--

LOCK TABLES `coins` WRITE;
/*!40000 ALTER TABLE `coins` DISABLE KEYS */;
INSERT INTO `coins` VALUES (1,'Brons'),(2,'Zilver'),(3,'Goud');
/*!40000 ALTER TABLE `coins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `craft_equipment_damage_rule`
--

DROP TABLE IF EXISTS `craft_equipment_damage_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `craft_equipment_damage_rule` (
  `craft_equipment_id` int(10) unsigned NOT NULL,
  `damage_rule_id` int(10) unsigned NOT NULL,
  KEY `craft_equipment_damage_rule_craft_equipment_id_index` (`craft_equipment_id`),
  KEY `craft_equipment_damage_rule_damage_rule_id_index` (`damage_rule_id`),
  CONSTRAINT `craft_equipment_damage_rule_craft_equipment_id_foreign` FOREIGN KEY (`craft_equipment_id`) REFERENCES `craft_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `craft_equipment_damage_rule_damage_rule_id_foreign` FOREIGN KEY (`damage_rule_id`) REFERENCES `damage_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `craft_equipment_damage_rule`
--

LOCK TABLES `craft_equipment_damage_rule` WRITE;
/*!40000 ALTER TABLE `craft_equipment_damage_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `craft_equipment_damage_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `craft_equipment_resistance_rule`
--

DROP TABLE IF EXISTS `craft_equipment_resistance_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `craft_equipment_resistance_rule` (
  `craft_equipment_id` int(10) unsigned NOT NULL,
  `resistance_rule_id` int(10) unsigned NOT NULL,
  KEY `craft_equipment_resistance_rule_craft_equipment_id_index` (`craft_equipment_id`),
  KEY `craft_equipment_resistance_rule_resistance_rule_id_index` (`resistance_rule_id`),
  CONSTRAINT `craft_equipment_resistance_rule_craft_equipment_id_foreign` FOREIGN KEY (`craft_equipment_id`) REFERENCES `craft_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `craft_equipment_resistance_rule_resistance_rule_id_foreign` FOREIGN KEY (`resistance_rule_id`) REFERENCES `resistance_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `craft_equipment_resistance_rule`
--

LOCK TABLES `craft_equipment_resistance_rule` WRITE;
/*!40000 ALTER TABLE `craft_equipment_resistance_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `craft_equipment_resistance_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `craft_equipment_skill`
--

DROP TABLE IF EXISTS `craft_equipment_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `craft_equipment_skill` (
  `craft_equipment_id` int(10) unsigned NOT NULL,
  `skill_id` int(10) unsigned NOT NULL,
  KEY `craft_equipment_skill_craft_equipment_id_index` (`craft_equipment_id`),
  KEY `craft_equipment_skill_skill_id_index` (`skill_id`),
  CONSTRAINT `craft_equipment_skill_craft_equipment_id_foreign` FOREIGN KEY (`craft_equipment_id`) REFERENCES `craft_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `craft_equipment_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `craft_equipment_skill`
--

LOCK TABLES `craft_equipment_skill` WRITE;
/*!40000 ALTER TABLE `craft_equipment_skill` DISABLE KEYS */;
INSERT INTO `craft_equipment_skill` VALUES (1,55);
/*!40000 ALTER TABLE `craft_equipment_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `craft_equipment_statistic_rule`
--

DROP TABLE IF EXISTS `craft_equipment_statistic_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `craft_equipment_statistic_rule` (
  `craft_equipment_id` int(10) unsigned NOT NULL,
  `statistic_rule_id` int(10) unsigned NOT NULL,
  KEY `craft_equipment_statistic_rule_craft_equipment_id_index` (`craft_equipment_id`),
  KEY `craft_equipment_statistic_rule_statistic_rule_id_index` (`statistic_rule_id`),
  CONSTRAINT `craft_equipment_statistic_rule_craft_equipment_id_foreign` FOREIGN KEY (`craft_equipment_id`) REFERENCES `craft_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `craft_equipment_statistic_rule_statistic_rule_id_foreign` FOREIGN KEY (`statistic_rule_id`) REFERENCES `statistic_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `craft_equipment_statistic_rule`
--

LOCK TABLES `craft_equipment_statistic_rule` WRITE;
/*!40000 ALTER TABLE `craft_equipment_statistic_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `craft_equipment_statistic_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `craft_equipment_wealth_rule`
--

DROP TABLE IF EXISTS `craft_equipment_wealth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `craft_equipment_wealth_rule` (
  `craft_equipment_id` int(10) unsigned NOT NULL,
  `wealth_rule_id` int(10) unsigned NOT NULL,
  KEY `craft_equipment_wealth_rule_craft_equipment_id_index` (`craft_equipment_id`),
  KEY `craft_equipment_wealth_rule_wealth_rule_id_index` (`wealth_rule_id`),
  CONSTRAINT `craft_equipment_wealth_rule_craft_equipment_id_foreign` FOREIGN KEY (`craft_equipment_id`) REFERENCES `craft_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `craft_equipment_wealth_rule_wealth_rule_id_foreign` FOREIGN KEY (`wealth_rule_id`) REFERENCES `wealth_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `craft_equipment_wealth_rule`
--

LOCK TABLES `craft_equipment_wealth_rule` WRITE;
/*!40000 ALTER TABLE `craft_equipment_wealth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `craft_equipment_wealth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `craft_equipments`
--

DROP TABLE IF EXISTS `craft_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `craft_equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `craft_equipments_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `craft_equipments`
--

LOCK TABLES `craft_equipments` WRITE;
/*!40000 ALTER TABLE `craft_equipments` DISABLE KEYS */;
INSERT INTO `craft_equipments` VALUES (1,'Naaigerief','Een set met daarin alles dat je nodig hebt om te naaien: naalden, scharen, vingerhoed, etc.',10),(2,'Aambeeld','Een noodzakelijk stuk gereedschap voor iedere smid.',30);
/*!40000 ALTER TABLE `craft_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `damage_rule_generic_equipment`
--

DROP TABLE IF EXISTS `damage_rule_generic_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `damage_rule_generic_equipment` (
  `generic_equipment_id` int(10) unsigned NOT NULL,
  `damage_rule_id` int(10) unsigned NOT NULL,
  KEY `damage_rule_generic_equipment_generic_equipment_id_index` (`generic_equipment_id`),
  KEY `damage_rule_generic_equipment_damage_rule_id_index` (`damage_rule_id`),
  CONSTRAINT `damage_rule_generic_equipment_damage_rule_id_foreign` FOREIGN KEY (`damage_rule_id`) REFERENCES `damage_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `damage_rule_generic_equipment_generic_equipment_id_foreign` FOREIGN KEY (`generic_equipment_id`) REFERENCES `generic_equipments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `damage_rule_generic_equipment`
--

LOCK TABLES `damage_rule_generic_equipment` WRITE;
/*!40000 ALTER TABLE `damage_rule_generic_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `damage_rule_generic_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `damage_rule_race`
--

DROP TABLE IF EXISTS `damage_rule_race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `damage_rule_race` (
  `race_id` int(10) unsigned NOT NULL,
  `damage_rule_id` int(10) unsigned NOT NULL,
  KEY `damage_rule_race_race_id_index` (`race_id`),
  KEY `damage_rule_race_damage_rule_id_index` (`damage_rule_id`),
  CONSTRAINT `damage_rule_race_damage_rule_id_foreign` FOREIGN KEY (`damage_rule_id`) REFERENCES `damage_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `damage_rule_race_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `damage_rule_race`
--

LOCK TABLES `damage_rule_race` WRITE;
/*!40000 ALTER TABLE `damage_rule_race` DISABLE KEYS */;
/*!40000 ALTER TABLE `damage_rule_race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `damage_rule_skill`
--

DROP TABLE IF EXISTS `damage_rule_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `damage_rule_skill` (
  `skill_id` int(10) unsigned NOT NULL,
  `damage_rule_id` int(10) unsigned NOT NULL,
  KEY `damage_rule_skill_skill_id_index` (`skill_id`),
  KEY `damage_rule_skill_damage_rule_id_index` (`damage_rule_id`),
  CONSTRAINT `damage_rule_skill_damage_rule_id_foreign` FOREIGN KEY (`damage_rule_id`) REFERENCES `damage_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `damage_rule_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `damage_rule_skill`
--

LOCK TABLES `damage_rule_skill` WRITE;
/*!40000 ALTER TABLE `damage_rule_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `damage_rule_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `damage_rules`
--

DROP TABLE IF EXISTS `damage_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `damage_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `damage_type_id` int(10) unsigned NOT NULL,
  `rules_operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `damage_rules_id_index` (`id`),
  KEY `damage_rules_damage_type_id_foreign` (`damage_type_id`),
  KEY `damage_rules_rules_operator_foreign` (`rules_operator`),
  CONSTRAINT `damage_rules_damage_type_id_foreign` FOREIGN KEY (`damage_type_id`) REFERENCES `damage_types` (`id`),
  CONSTRAINT `damage_rules_rules_operator_foreign` FOREIGN KEY (`rules_operator`) REFERENCES `immune_does_operators` (`operator_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `damage_rules`
--

LOCK TABLES `damage_rules` WRITE;
/*!40000 ALTER TABLE `damage_rules` DISABLE KEYS */;
INSERT INTO `damage_rules` VALUES (1,1,'doet'),(2,1,'is immuun aan'),(3,2,'doet'),(4,2,'is immuun aan'),(5,3,'doet'),(6,3,'is immuun aan'),(7,4,'doet'),(8,4,'is immuun aan');
/*!40000 ALTER TABLE `damage_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `damage_types`
--

DROP TABLE IF EXISTS `damage_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `damage_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `damage_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `damage_types_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `damage_types`
--

LOCK TABLES `damage_types` WRITE;
/*!40000 ALTER TABLE `damage_types` DISABLE KEYS */;
INSERT INTO `damage_types` VALUES (1,'Vuur'),(2,'Zuur'),(3,'Magische'),(4,'Niet-Magische');
/*!40000 ALTER TABLE `damage_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descent_player_class_race`
--

DROP TABLE IF EXISTS `descent_player_class_race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descent_player_class_race` (
  `race_id` int(10) unsigned NOT NULL,
  `player_class_id` int(10) unsigned NOT NULL,
  KEY `descent_player_class_race_race_id_index` (`race_id`),
  KEY `descent_player_class_race_player_class_id_index` (`player_class_id`),
  CONSTRAINT `descent_player_class_race_player_class_id_foreign` FOREIGN KEY (`player_class_id`) REFERENCES `player_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `descent_player_class_race_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descent_player_class_race`
--

LOCK TABLES `descent_player_class_race` WRITE;
/*!40000 ALTER TABLE `descent_player_class_race` DISABLE KEYS */;
INSERT INTO `descent_player_class_race` VALUES (1,4),(1,7),(2,2),(2,3),(3,6),(4,4),(5,6);
/*!40000 ALTER TABLE `descent_player_class_race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ep_assignments`
--

DROP TABLE IF EXISTS `ep_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ep_assignments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` int(10) unsigned NOT NULL,
  `character_id` int(10) unsigned NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ep_assignment_id_index` (`id`),
  KEY `ep_assignments_character_id_foreign` (`character_id`),
  CONSTRAINT `ep_assignments_character_id_foreign` FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ep_assignments`
--

LOCK TABLES `ep_assignments` WRITE;
/*!40000 ALTER TABLE `ep_assignments` DISABLE KEYS */;
INSERT INTO `ep_assignments` VALUES (37,15,26,'','2018-06-15 10:56:08','2018-06-15 10:56:08'),(38,15,27,'','2018-06-17 07:57:58','2018-06-17 07:57:58'),(39,15,28,'','2018-06-17 08:12:24','2018-06-17 08:12:24'),(40,15,29,'','2018-06-17 11:37:36','2018-06-17 11:37:36'),(41,15,30,'','2018-06-17 15:04:56','2018-06-17 15:04:56'),(42,20,31,'','2018-06-17 15:07:32','2018-06-17 15:07:32'),(43,15,32,'','2018-06-18 04:39:53','2018-06-18 04:39:53'),(44,25,33,'','2018-06-23 13:31:23','2018-06-23 13:31:23'),(45,15,34,'','2018-06-23 18:42:56','2018-06-23 18:42:56'),(50,20,35,'background + survived','2018-06-27 06:40:24','2018-06-27 06:40:24');
/*!40000 ALTER TABLE `ep_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faiths`
--

DROP TABLE IF EXISTS `faiths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faiths` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faith_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faiths`
--

LOCK TABLES `faiths` WRITE;
/*!40000 ALTER TABLE `faiths` DISABLE KEYS */;
INSERT INTO `faiths` VALUES (1,'geen'),(2,'Alh&eacute;nnia'),(3,'Alfar'),(4,'Het Beest'),(5,'Hymir'),(6,'Melanthios'),(7,'Senestha'),(8,'Tallathan');
/*!40000 ALTER TABLE `faiths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fix_it`
--

DROP TABLE IF EXISTS `fix_it`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fix_it` (
  `skill_id` int(10) unsigned NOT NULL,
  `skill_group_id` int(10) unsigned NOT NULL,
  `prereq_set` mediumint(9) NOT NULL,
  KEY `skill_skill_group_prereqs_skill_id_index` (`skill_id`),
  KEY `skill_skill_group_prereqs_skill_group_id_index` (`skill_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fix_it`
--

LOCK TABLES `fix_it` WRITE;
/*!40000 ALTER TABLE `fix_it` DISABLE KEYS */;
INSERT INTO `fix_it` VALUES (1818981227,1701736041,-837088),(1818981227,1701736041,-837088),(1818981227,1701736041,-837088),(1818981227,1701736041,-837088),(1818981227,1701736041,-837088),(1969515631,1885695616,-8388096),(2053467680,1701716051,-1873806),(1852074849,1634890784,-3381894),(1952541801,1952803188,-6272640),(1952541801,1952803188,-6272695),(1952541801,1952803188,-6272695),(1768580979,1802858099,-778167),(1853125477,1919185505,-1873804),(1768580979,1952801640,-1152667),(1768580979,1952801640,-1152667),(1735619616,1382380393,-822171),(1986358899,1886744180,-1741280),(1819503474,1633904756,-6272640),(1852729698,1634494835,-1219296),(1885695591,1700950645,-1479878),(1885695591,1700950645,-1479878),(1936746866,1635019109,3),(1819568491,1818325875,-1761207),(1735619616,1382380393,-822171),(1819697505,1920213032,-2987670),(1819697505,1920213032,-2661012),(1819697505,1920213032,-3315356),(1701847140,1701978190,-2001803),(1853060197,1919640942,-1152653),(1701606260,1634624640,-8387328),(1633973107,1819634032,-1741184);
/*!40000 ALTER TABLE `fix_it` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_equipment_resistance_rule`
--

DROP TABLE IF EXISTS `generic_equipment_resistance_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_equipment_resistance_rule` (
  `generic_equipment_id` int(10) unsigned NOT NULL,
  `resistance_rule_id` int(10) unsigned NOT NULL,
  KEY `generic_equipment_resistance_rule_generic_equipment_id_index` (`generic_equipment_id`),
  KEY `generic_equipment_resistance_rule_resistance_rule_id_index` (`resistance_rule_id`),
  CONSTRAINT `generic_equipment_resistance_rule_generic_equipment_id_foreign` FOREIGN KEY (`generic_equipment_id`) REFERENCES `generic_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `generic_equipment_resistance_rule_resistance_rule_id_foreign` FOREIGN KEY (`resistance_rule_id`) REFERENCES `resistance_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_equipment_resistance_rule`
--

LOCK TABLES `generic_equipment_resistance_rule` WRITE;
/*!40000 ALTER TABLE `generic_equipment_resistance_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `generic_equipment_resistance_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_equipment_statistic_rule`
--

DROP TABLE IF EXISTS `generic_equipment_statistic_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_equipment_statistic_rule` (
  `generic_equipment_id` int(10) unsigned NOT NULL,
  `statistic_rule_id` int(10) unsigned NOT NULL,
  KEY `generic_equipment_statistic_rule_generic_equipment_id_index` (`generic_equipment_id`),
  KEY `generic_equipment_statistic_rule_statistic_rule_id_index` (`statistic_rule_id`),
  CONSTRAINT `generic_equipment_statistic_rule_generic_equipment_id_foreign` FOREIGN KEY (`generic_equipment_id`) REFERENCES `generic_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `generic_equipment_statistic_rule_statistic_rule_id_foreign` FOREIGN KEY (`statistic_rule_id`) REFERENCES `statistic_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_equipment_statistic_rule`
--

LOCK TABLES `generic_equipment_statistic_rule` WRITE;
/*!40000 ALTER TABLE `generic_equipment_statistic_rule` DISABLE KEYS */;
INSERT INTO `generic_equipment_statistic_rule` VALUES (3,1);
/*!40000 ALTER TABLE `generic_equipment_statistic_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_equipment_wealth_rule`
--

DROP TABLE IF EXISTS `generic_equipment_wealth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_equipment_wealth_rule` (
  `generic_equipment_id` int(10) unsigned NOT NULL,
  `wealth_rule_id` int(10) unsigned NOT NULL,
  KEY `generic_equipment_wealth_rule_generic_equipment_id_index` (`generic_equipment_id`),
  KEY `generic_equipment_wealth_rule_wealth_rule_id_index` (`wealth_rule_id`),
  CONSTRAINT `generic_equipment_wealth_rule_generic_equipment_id_foreign` FOREIGN KEY (`generic_equipment_id`) REFERENCES `generic_equipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `generic_equipment_wealth_rule_wealth_rule_id_foreign` FOREIGN KEY (`wealth_rule_id`) REFERENCES `wealth_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_equipment_wealth_rule`
--

LOCK TABLES `generic_equipment_wealth_rule` WRITE;
/*!40000 ALTER TABLE `generic_equipment_wealth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `generic_equipment_wealth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_equipments`
--

DROP TABLE IF EXISTS `generic_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_normal` int(11) NOT NULL,
  `price_good` int(11) NOT NULL,
  `price_master` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `generic_equipments_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_equipments`
--

LOCK TABLES `generic_equipments` WRITE;
/*!40000 ALTER TABLE `generic_equipments` DISABLE KEYS */;
INSERT INTO `generic_equipments` VALUES (1,'Beeldhouwwerk','Gemaakt door een kunstenaar met de vaardigheid ‘Beeldende kunsten’, deze prachtstukken kunnen een buste voorstellen van een voornaam persoon of een imposant geschiedkundig stuk. Beeldhouwwerken kunnen status of focus bijgeven aan personen die het aanschouwen.&nbsp;<br>',20,60,200),(2,'Borstbrand','Een kruidenzalfje gebruikt door moeders over geheel Heimar. De uitgewreven blaadjes zorgen voor een warm gevoel wat de resistentie tegen ziekte en gif aansterkt. &nbsp;<br>',20,0,0),(3,'Zilveren Juweel','<br>',0,0,100);
/*!40000 ALTER TABLE `generic_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immune_does_operators`
--

DROP TABLE IF EXISTS `immune_does_operators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immune_does_operators` (
  `operator_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  KEY `immune_does_operators_operator_name_index` (`operator_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immune_does_operators`
--

LOCK TABLES `immune_does_operators` WRITE;
/*!40000 ALTER TABLE `immune_does_operators` DISABLE KEYS */;
INSERT INTO `immune_does_operators` VALUES ('doet'),('is immuun aan');
/*!40000 ALTER TABLE `immune_does_operators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_03_09_102351_skill_tree_setup',1),('2016_04_27_141755_create_playerraces',1),('2016_04_27_190521_playerracesprereqs',1),('2016_04_30_212335_equipment_armor',1),('2016_05_03_114117_equipment_shield',1),('2016_05_05_104702_equipment_weapon',1),('2016_05_06_073209_statistic_rules',1),('2016_05_07_070823_resistence_rules',1),('2016_05_08_180530_damage_types_rules',1),('2016_08_02_131948_wealth_rules',1),('2016_08_04_065342_equipment_craft',1),('2016_08_15_072957_equipment_generic',1),('2016_09_23_140554_skill_rules_equipment_pivots',1),('2017_03_04_081703_add_roles_to_users',1),('2017_03_04_190448_crud_player_race_rules',1),('2017_03_05_142935_races_and_skills',1),('2017_03_05_195656_race_decent_prohibited_classes',1),('2017_03_08_194243_rename_prohibited_add_descent_pivot',1),('2017_03_10_112821_player_class_isplayer_wealthrules',1),('2017_03_12_111328_add_characters',1),('2017_04_22_142438_skill_groups',2),('2017_04_23_102304_skill_groups_skill_prereqs',3),('2017_04_24_122224_class_rules',4),('2017_04_25_124817_add_class_rule_skill',5),('2017_04_27_143720_secret_skill_wealth_prereq',6),('2017_05_14_144708_add_created_modified_characterskill_epassignment',7),('2017_05_14_182321_rename_ep_assignment_assignments',7),('2017_05_18_073032_add_lifespark',8),('2017_05_22_090943_characters_users',9),('2017_05_25_182511_spark_data_to_text',10),('2017_06_02_184342_ep_assignment_ondelete',11),('2017_06_16_115747_add_out_of_class_indication',12),('2017_06_18_113403_add_descent_ep_amount_to_character',13),('2017_07_01_155700_character_descent_class_pivot',14),('2017_08_11_095010_add_craft_skill',15),('2017_08_15_123613_characterActiveCreateStatus',16);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('jazz_cama@hotmail.com','c6fdcaeadc55aad4b95d0aaf47ff768943faa04d23d0669a4b56303be369768f','2017-08-13 11:33:29');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_class_skill`
--

DROP TABLE IF EXISTS `player_class_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_class_skill` (
  `skill_id` int(10) unsigned NOT NULL,
  `player_class_id` int(10) unsigned NOT NULL,
  KEY `player_class_skill_skill_id_index` (`skill_id`),
  KEY `player_class_skill_player_class_id_index` (`player_class_id`),
  CONSTRAINT `player_class_skill_player_class_id_foreign` FOREIGN KEY (`player_class_id`) REFERENCES `player_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `player_class_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_class_skill`
--

LOCK TABLES `player_class_skill` WRITE;
/*!40000 ALTER TABLE `player_class_skill` DISABLE KEYS */;
INSERT INTO `player_class_skill` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,6),(7,1),(8,2),(8,4),(8,6),(9,1),(10,1),(11,1),(12,4),(13,4),(14,4),(15,4),(15,6),(16,1),(17,1),(18,1),(20,5),(20,7),(21,1),(21,4),(22,4),(22,6),(39,4),(41,1),(42,1),(43,1),(44,1),(45,1),(47,5),(48,5),(48,6),(51,1),(52,6),(53,1),(54,1),(55,1),(56,4),(57,4);
/*!40000 ALTER TABLE `player_class_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_classes`
--

DROP TABLE IF EXISTS `player_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wealth_type_id` int(10) unsigned NOT NULL,
  `is_player_class` tinyint(1) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player_classes_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_classes`
--

LOCK TABLES `player_classes` WRITE;
/*!40000 ALTER TABLE `player_classes` DISABLE KEYS */;
INSERT INTO `player_classes` VALUES (1,'Algemeen',0,0,''),(2,'Geleerde',2,1,'<div>Iemand die zijn verstand en intellect als voornaamste troef ziet. Kennis is de voornaamste schat én wapen van een geleerde. Deze lieden gebruiken hun hogere intelligentie ten dienste van de gemeenschap; zij het als kruidige kwakzalver, rondtrekkende chirurgijn of uitzonderlijke wetenschapper.</div><div><br></div><div>Als heler ben je in een constant gevecht verwikkeld met de gevaarlijkste vijand van allemaal: de dood. Ze reizen mee in het gezelschap van een edele of ander voornaam persoon of achtervolgen de strijdwagens op zoek naar het volgende slagveld waar men hopelijk, al is het er maar één, levens kan redden. Gewapend met een arsenaal aan helingvaardigheden en onverschrokken moed moet de heler niet alleen zichzelf, maar ook zijn metgezellen in leven zien te houden. &nbsp; &nbsp;</div><div><br></div><div>Als wetenschapper ben je opgeleid in één van de resterende universiteiten die nog overblijven na de Oorlogen van Eenmaking. De universiteiten werden bekostigd door de Golyndische adel en werden al snel onschatbare parels van kennis. Hun bibliotheken werden gevuld met de meeste unieke werken. Na hun studie aan de universiteit trekken studenten vaak de wijde wereld in om op zoek te gaan naar verloren kennis of om te experimenteren in alle vrijheid. Vaak zullen geleerden ook een mecenas zoeken bij de Mannheimse of Golyndische adel. Onderzoek kost geld en tijd en de universiteiten hebben hier doorgaans geen fondsen meer voor.<br></div>'),(3,'Handelaar',3,1,'<div>Rap van tong en snel van geest, men vindt handelaars over geheel Heimar - &nbsp;van het kleinste dorp tot de hoofdstad zelf, waar het wemelt van kramers en handelsgilden. Sommige koopwaar komt zelfs van verre exotische werelddelen.</div><div><br></div><div>Handelaars zijn ook ambachtslieden zonder gelijken die alles kunnen vervaardigen met de juiste materialen; van pantsers of zwaarden smeden tot het maken van hoeden. De handelaar is niet alleen de maker van al deze goederen en essentiële avonturiers benodigdheden, maar kan deze ook verhandelen in de economie van Heimar via zijn diverse contacten. Zodoende kan hij werkelijk aan alles geraken voor de juiste prijs. Handelaars kan men bijna bij alle volkeren van Heimar vinden, hoewel de Goliad van deze klasse een ware kunst hebben gemaakt.</div>'),(4,'Krijger',2,1,'<div>Krijgers komen overal voor in Heimar en dit is niet gewijzigd sinds het land verenigd is en de grote oorlogen voorbij zijn. De strijd tegen de trollen houdt aan en aan de oostelijke en zuidelijke grenzen van het rijk zijn er zeker voldoende spanningen. De dappere, maar chaotische, Mannheim krijgers staan in schril contrast met het gedisciplineerde voetvolk van Golyndische afkomst; die weliswaar slechts strijden naargelang hun beloning. Doorgaans zijn hun kruisboogschutters de best betaalde manschappen op het slagveld.</div><div><br></div><div>De woeste Bhanda Korr zijn geboren voor de strijd en meten zich met alle vijanden die ze kunnen vinden, ook al zijn ze primitief, hun tactieken zijn wel uiterst efficiënt.</div>'),(5,'Ontwaakte',1,1,'<div>Sinds oudsher bestaan er mensen die volgens sommigen onder een speciaal gesternte geboren zijn, volgens anderen dan weer een vloek dragen of &nbsp;simpelweg een gave bezitten: de kracht van magie. Hierdoor zijn deze lieden tot uitzonderlijke dingen in staat, maar het hoe en waarom is voor velen in Heimar een groot mysterie, een subject van onderzoek of van wantrouwen. Het leren beheersen en kanaliseren van deze magie vraagt om discipline en bevatting. Indien men deze krachten niet kan beheersen zijn de gevolgen niet altijd te overzien. Het is dan ook niet verbazingwekkend dat ‘ontwaakten’ niet altijd graag gezien zijn. Vooral de Sibbe van de Alfar is enorm wantrouwig en zij zijn niet vies van het idee om deze onbetrouwbare ‘heksen’ weg te ruimen.</div><div><br></div><div>Een speciale ‘tak’ van deze lieden kan via vreemde occulte rituelen contact leggen met de gestorvenen. &nbsp;Genaamd Spiritist is dit ‘beroep’ lichtjes aanvaard in de maatschappij als link tussen overleden familie of vrienden. Hun unieke vaardigheden worden in wanhoop afgesmeekt als men denkt dat ergens geesten actief zijn maar ook om advies te vragen aan de voorouders. Het oproepen van de doden is zelden zonder gevaar en men weet niet altijd wat de juiste prijs is om de wereld van de doden te benaderen, laat staan te betreden.</div><div><br></div><div>Weer anderen verdwijnen vanaf pubertijd in de wildernis en worden slechts af en toe verwilderd waargenomen door woudlopers. Deze Druïden beschikken over natuurkrachten, kunnen met dieren praten en beschermen de ongerepte plaatsen van het land.</div>'),(6,'Vagebond',1,1,'<div>Een algemene noemer voor de meerderheid van verschillende ‘beroepen’ in de maatschappij van Heimar. &nbsp;Allen hebben ze de roep van het avontuur beantwoord en men kan &nbsp;ze doorheen het ganse land vinden. Huurlingen, charlatans, verkenners, herauten, gauwdieven, woudgidsen, barden, spionnen, skalds en meer kan men onder de rangen van de Vagebond rekenen.</div><div><br></div><div>Zij bieden hun verscheidenheid aan talenten aan waar het hun uitkomt, voor geld of goede en slechte bedoelingen. Ze blijven nooit lang op één plaats en reizen waar de zon hen brengt, op zoek naar een kick, een goed verhaal of een gevulde beurs. Sommigen onder hen beschikken over artistiek talent die de menselijke ziel beroert, kunstenaars betaald door een edelman, barden die de strijdlust van kameraden aanwakkeren of meesters van het geschreven woord.</div><div><br></div><div>Andere avonturiers zijn ervaren vechters die hun moorddadig talent aan de hoogste bieder verkopen, deze huurlingen dienen als extra troepen in een krijgsmacht, verkenners in de diepe wouden of hebben meer sinistere vaardigheden die het daglicht schuwen. Het pad van de misdaad ligt verrassend dichtbij en velen kunnen de verleiding niet weerstaan om de wet te breken. Als Vagebond kun je werkelijk alle kanten op.</div>'),(7,'Priester',2,1,'<div>Priester zijn is een roeping. De Goden hebben je uitgekozen om hun woord te verspreiden en je volk te beschermen. Een jonge priester, als het duidelijk wordt dat hij inderdaad uitgekozen is door één van de Goden van de Alfar, zal onder de hoede van de Sibbe of één van haar broeder- en zusterordes worden genomen en wordt dan ingewijd in de leer van de Goden.</div><div><br></div><div>Priesters die door een andere god worden uitgekozen zoeken doorgaans zelf hun pad wat zeer gevaarlijk is; een ketter is niets beter dan een heks in Heimar, en beiden belandden al vaak op de brandstapel. Ketterse priesters die, doorgaans maar zeker niet allemaal, tot de Ranae en Bhanda Korr behoren kunnen niet rekenen op structuur en begeleiding en vullen hun geloof vaak op een geheel eigen wijze in, volledig in het geheim uiteraard.</div>');
/*!40000 ALTER TABLE `player_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_race_skill`
--

DROP TABLE IF EXISTS `player_race_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_race_skill` (
  `skill_id` int(10) unsigned NOT NULL,
  `player_race_id` int(10) unsigned NOT NULL,
  KEY `player_race_skill_skill_id_index` (`skill_id`),
  KEY `player_race_skill_player_race_id_index` (`player_race_id`),
  CONSTRAINT `player_race_skill_player_race_id_foreign` FOREIGN KEY (`player_race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE,
  CONSTRAINT `player_race_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_race_skill`
--

LOCK TABLES `player_race_skill` WRITE;
/*!40000 ALTER TABLE `player_race_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `player_race_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prohibited_player_class_race`
--

DROP TABLE IF EXISTS `prohibited_player_class_race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prohibited_player_class_race` (
  `race_id` int(10) unsigned NOT NULL,
  `player_class_id` int(10) unsigned NOT NULL,
  KEY `player_class_race_race_id_index` (`race_id`),
  KEY `player_class_race_player_class_id_index` (`player_class_id`),
  CONSTRAINT `player_class_race_player_class_id_foreign` FOREIGN KEY (`player_class_id`) REFERENCES `player_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `player_class_race_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prohibited_player_class_race`
--

LOCK TABLES `prohibited_player_class_race` WRITE;
/*!40000 ALTER TABLE `prohibited_player_class_race` DISABLE KEYS */;
INSERT INTO `prohibited_player_class_race` VALUES (4,2),(4,3),(5,4);
/*!40000 ALTER TABLE `prohibited_player_class_race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_prereq_skill`
--

DROP TABLE IF EXISTS `race_prereq_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_prereq_skill` (
  `race_id` int(10) unsigned NOT NULL,
  `skill_id` int(10) unsigned NOT NULL,
  KEY `race_prereq_skill_race_id_index` (`race_id`),
  KEY `race_prereq_skill_skill_id_index` (`skill_id`),
  CONSTRAINT `race_prereq_skill_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE,
  CONSTRAINT `race_prereq_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_prereq_skill`
--

LOCK TABLES `race_prereq_skill` WRITE;
/*!40000 ALTER TABLE `race_prereq_skill` DISABLE KEYS */;
INSERT INTO `race_prereq_skill` VALUES (4,20),(1,43),(2,43),(1,47),(3,47),(4,47),(5,47),(1,51),(2,51),(1,53),(2,53);
/*!40000 ALTER TABLE `race_prereq_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_race_skill`
--

DROP TABLE IF EXISTS `race_race_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_race_skill` (
  `race_id` int(10) unsigned NOT NULL,
  `skill_id` int(10) unsigned NOT NULL,
  KEY `race_race_skill_race_id_index` (`race_id`),
  KEY `race_race_skill_skill_id_index` (`skill_id`),
  CONSTRAINT `race_race_skill_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE,
  CONSTRAINT `race_race_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_race_skill`
--

LOCK TABLES `race_race_skill` WRITE;
/*!40000 ALTER TABLE `race_race_skill` DISABLE KEYS */;
INSERT INTO `race_race_skill` VALUES (1,1),(2,7),(2,3),(3,4),(3,6),(4,2),(5,5);
/*!40000 ALTER TABLE `race_race_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_resistance_rule`
--

DROP TABLE IF EXISTS `race_resistance_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_resistance_rule` (
  `race_id` int(10) unsigned NOT NULL,
  `resistance_rule_id` int(10) unsigned NOT NULL,
  KEY `race_resistance_rule_race_id_index` (`race_id`),
  KEY `race_resistance_rule_resistance_rule_id_index` (`resistance_rule_id`),
  CONSTRAINT `race_resistance_rule_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE,
  CONSTRAINT `race_resistance_rule_resistance_rule_id_foreign` FOREIGN KEY (`resistance_rule_id`) REFERENCES `resistance_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_resistance_rule`
--

LOCK TABLES `race_resistance_rule` WRITE;
/*!40000 ALTER TABLE `race_resistance_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `race_resistance_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_statistic_rule`
--

DROP TABLE IF EXISTS `race_statistic_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_statistic_rule` (
  `race_id` int(10) unsigned NOT NULL,
  `statistic_rule_id` int(10) unsigned NOT NULL,
  KEY `race_statistic_rule_race_id_index` (`race_id`),
  KEY `race_statistic_rule_statistic_rule_id_index` (`statistic_rule_id`),
  CONSTRAINT `race_statistic_rule_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE,
  CONSTRAINT `race_statistic_rule_statistic_rule_id_foreign` FOREIGN KEY (`statistic_rule_id`) REFERENCES `statistic_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_statistic_rule`
--

LOCK TABLES `race_statistic_rule` WRITE;
/*!40000 ALTER TABLE `race_statistic_rule` DISABLE KEYS */;
INSERT INTO `race_statistic_rule` VALUES (3,2),(2,5),(2,4),(5,6),(1,2),(1,1),(4,3);
/*!40000 ALTER TABLE `race_statistic_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_wealth_rule`
--

DROP TABLE IF EXISTS `race_wealth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_wealth_rule` (
  `race_id` int(10) unsigned NOT NULL,
  `wealth_rule_id` int(10) unsigned NOT NULL,
  KEY `race_wealth_rule_race_id_index` (`race_id`),
  KEY `race_wealth_rule_wealth_rule_id_index` (`wealth_rule_id`),
  CONSTRAINT `race_wealth_rule_race_id_foreign` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE,
  CONSTRAINT `race_wealth_rule_wealth_rule_id_foreign` FOREIGN KEY (`wealth_rule_id`) REFERENCES `wealth_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_wealth_rule`
--

LOCK TABLES `race_wealth_rule` WRITE;
/*!40000 ALTER TABLE `race_wealth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `race_wealth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `races`
--

DROP TABLE IF EXISTS `races`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `races` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `race_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_player_race` tinyint(1) NOT NULL,
  `descent_class` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `player_races_id_index` (`id`),
  KEY `races_descent_class_foreign` (`descent_class`),
  CONSTRAINT `races_descent_class_foreign` FOREIGN KEY (`descent_class`) REFERENCES `player_classes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `races`
--

LOCK TABLES `races` WRITE;
/*!40000 ALTER TABLE `races` DISABLE KEYS */;
INSERT INTO `races` VALUES (1,'Mannheimer','De Mannheimers of Noormannen: een gehard volk dat door middel van bloederige oorlogen de rest van de volkeren heeft onderworpen. De Adel regeert met ijzeren hand en ‘hun’ oorlogsgod Hymir staat aan het hoofd van de Alfar: het aanbeden pantheon.<br>',0,NULL),(2,'Goliad','Het Golyndisch rijk strekte zich ooit uit over de gehele westelijke vallei, een vooruitstrevende grootmacht die industrie en economie hoog in het vaandel droeg. De Goliad, zoals de inwoners genoemd worden, spelen nu tweede viool in Heimar maar hebben een sterke invloed op zowat alle aspecten van de maatschappij, voornamelijk de handel.<br>',0,NULL),(3,'Khaliër','Onder het schaduwrijke loof van de immense wouden in Heimar is er een samenleving ontstaan van een trots volk dat in harmonie met hun omgeving leven onder het wakende oog van Ahlénnia, een ongenadige woudgodin en moederfiguur der Khaliërs.&nbsp;<br>',0,NULL),(4,'Bhanda Korr','De Antariaanse bergen ten oosten van Arduyn hebben een gevreesde reputatie als een gevaarlijk gebied vol roofdieren, donkere grotten en monsters. Maar wat de bergen écht gevaarlijk maakt volgens veel Heimaranen zijn de Bhanda Korr. Deze barbaarse stammen trokken lang, lang geleden over de bergen uit het oosten. Wild en onbeschaafd stortten ze zich in de strijd over heel Heimar.',0,NULL),(5,'Ranae','De herkomst van de Ranae is vaag en gehuld in mysterie, maar deze zigeuners zijn onmiskenbaar van zuiderse afkomst. Waar men ook doorheen het zuiden van Heimar reist, vindt men ongetwijfeld wel een Ranae karavaan op zijn pad.<br>',0,NULL);
/*!40000 ALTER TABLE `races` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resistance_rule_skill`
--

DROP TABLE IF EXISTS `resistance_rule_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resistance_rule_skill` (
  `skill_id` int(10) unsigned NOT NULL,
  `resistance_rule_id` int(10) unsigned NOT NULL,
  KEY `resistance_rule_skill_skill_id_index` (`skill_id`),
  KEY `resistance_rule_skill_resistance_rule_id_index` (`resistance_rule_id`),
  CONSTRAINT `resistance_rule_skill_resistance_rule_id_foreign` FOREIGN KEY (`resistance_rule_id`) REFERENCES `resistance_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resistance_rule_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resistance_rule_skill`
--

LOCK TABLES `resistance_rule_skill` WRITE;
/*!40000 ALTER TABLE `resistance_rule_skill` DISABLE KEYS */;
INSERT INTO `resistance_rule_skill` VALUES (16,1),(42,1);
/*!40000 ALTER TABLE `resistance_rule_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resistance_rules`
--

DROP TABLE IF EXISTS `resistance_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resistance_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resistance_id` int(10) unsigned NOT NULL,
  `rules_operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resistance_rules_id_index` (`id`),
  KEY `resistance_rules_resistance_id_foreign` (`resistance_id`),
  KEY `resistance_rules_rules_operator_foreign` (`rules_operator`),
  CONSTRAINT `resistance_rules_resistance_id_foreign` FOREIGN KEY (`resistance_id`) REFERENCES `resistances` (`id`),
  CONSTRAINT `resistance_rules_rules_operator_foreign` FOREIGN KEY (`rules_operator`) REFERENCES `rules_operators` (`operator`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resistance_rules`
--

LOCK TABLES `resistance_rules` WRITE;
/*!40000 ALTER TABLE `resistance_rules` DISABLE KEYS */;
INSERT INTO `resistance_rules` VALUES (1,1,'+',1),(2,4,'+',8);
/*!40000 ALTER TABLE `resistance_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resistances`
--

DROP TABLE IF EXISTS `resistances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resistances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resistance_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resistances_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resistances`
--

LOCK TABLES `resistances` WRITE;
/*!40000 ALTER TABLE `resistances` DISABLE KEYS */;
INSERT INTO `resistances` VALUES (1,'Angst'),(2,'Diefstal'),(3,'Trauma'),(4,'Gif'),(5,'Magie'),(6,'Ziekte');
/*!40000 ALTER TABLE `resistances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rules_operators`
--

DROP TABLE IF EXISTS `rules_operators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rules_operators` (
  `operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  KEY `rules_operators_operator_index` (`operator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rules_operators`
--

LOCK TABLES `rules_operators` WRITE;
/*!40000 ALTER TABLE `rules_operators` DISABLE KEYS */;
INSERT INTO `rules_operators` VALUES ('-'),('+'),('=');
/*!40000 ALTER TABLE `rules_operators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shields`
--

DROP TABLE IF EXISTS `shields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_normal` int(11) NOT NULL,
  `price_good` int(11) NOT NULL,
  `price_master` int(11) NOT NULL,
  `armor_normal` int(11) NOT NULL,
  `armor_good` int(11) NOT NULL,
  `armor_master` int(11) NOT NULL,
  `structure_normal` int(11) NOT NULL,
  `structure_good` int(11) NOT NULL,
  `structure_master` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shields_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shields`
--

LOCK TABLES `shields` WRITE;
/*!40000 ALTER TABLE `shields` DISABLE KEYS */;
INSERT INTO `shields` VALUES (1,'Beukelaar','Deze kleine schilden ziet men vooral in de zuidelijke gebieden en zijn vermoedelijk het eerst gebruikt door Ranae schermers. Het vergt snelheid en precisie om met dit lichte schild te blokkeren en biedt vanwege zijn geringe massa ook weinig bescherming tegenover de grotere schilden, maar met de juiste vaardigheid kan men de lichte beukelaar zelfs combineren met een tweehander of afstandswapen.&nbsp;<br>',7,70,700,7,10,12,0,10,24),(2,'Strijdschild','De meeste schilden vallen onder deze categorie en men kan ze vinden bij elke afkomst.&nbsp;<br>',10,100,1000,10,12,15,0,12,30);
/*!40000 ALTER TABLE `shields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_groups`
--

DROP TABLE IF EXISTS `skill_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc_short` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `skill_groups_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_groups`
--

LOCK TABLES `skill_groups` WRITE;
/*!40000 ALTER TABLE `skill_groups` DISABLE KEYS */;
INSERT INTO `skill_groups` VALUES (2,'Wapengebruik \'X\'','Bevat alle wapengebruik vaardigheden'),(4,'Wapengebruik 1-handige wapens','Alle vaardigheden voor 1-handige wapens');
/*!40000 ALTER TABLE `skill_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_levels`
--

DROP TABLE IF EXISTS `skill_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `skill_level` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `skill_levels_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_levels`
--

LOCK TABLES `skill_levels` WRITE;
/*!40000 ALTER TABLE `skill_levels` DISABLE KEYS */;
INSERT INTO `skill_levels` VALUES (1,'Debutant'),(2,'Avonturier'),(3,'Veteraan'),(4,'Held');
/*!40000 ALTER TABLE `skill_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_skill_group`
--

DROP TABLE IF EXISTS `skill_skill_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_skill_group` (
  `skill_id` int(10) unsigned NOT NULL,
  `skill_group_id` int(10) unsigned NOT NULL,
  KEY `skill_skill_group_skill_id_index` (`skill_id`),
  KEY `skill_skill_group_skill_group_id_index` (`skill_group_id`),
  CONSTRAINT `skill_skill_group_skill_group_id_foreign` FOREIGN KEY (`skill_group_id`) REFERENCES `skill_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `skill_skill_group_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_skill_group`
--

LOCK TABLES `skill_skill_group` WRITE;
/*!40000 ALTER TABLE `skill_skill_group` DISABLE KEYS */;
INSERT INTO `skill_skill_group` VALUES (21,2),(22,2),(56,2),(21,4);
/*!40000 ALTER TABLE `skill_skill_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_skill_group_prereqs`
--

DROP TABLE IF EXISTS `skill_skill_group_prereqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_skill_group_prereqs` (
  `skill_id` int(10) unsigned NOT NULL,
  `skill_group_id` int(10) unsigned NOT NULL,
  `prereq_set` mediumint(9) NOT NULL,
  KEY `skill_skill_group_prereqs_skill_id_index` (`skill_id`),
  KEY `skill_skill_group_prereqs_skill_group_id_index` (`skill_group_id`),
  CONSTRAINT `skill_skill_group_prereqs_skill_group_id_foreign` FOREIGN KEY (`skill_group_id`) REFERENCES `skill_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `skill_skill_group_prereqs_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_skill_group_prereqs`
--

LOCK TABLES `skill_skill_group_prereqs` WRITE;
/*!40000 ALTER TABLE `skill_skill_group_prereqs` DISABLE KEYS */;
INSERT INTO `skill_skill_group_prereqs` VALUES (15,2,1),(57,2,1);
/*!40000 ALTER TABLE `skill_skill_group_prereqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_skill_prereqs`
--

DROP TABLE IF EXISTS `skill_skill_prereqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_skill_prereqs` (
  `skill_id` int(10) unsigned NOT NULL,
  `skills_prereq_id` int(10) unsigned NOT NULL,
  `prereq_set` mediumint(9) NOT NULL,
  KEY `skill_skill_prereqs_skill_id_index` (`skill_id`),
  KEY `skill_skill_prereqs_skills_prereq_id_index` (`skills_prereq_id`),
  CONSTRAINT `skill_skill_prereqs_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE,
  CONSTRAINT `skill_skill_prereqs_skills_prereq_id_foreign` FOREIGN KEY (`skills_prereq_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_skill_prereqs`
--

LOCK TABLES `skill_skill_prereqs` WRITE;
/*!40000 ALTER TABLE `skill_skill_prereqs` DISABLE KEYS */;
INSERT INTO `skill_skill_prereqs` VALUES (8,7,1),(10,9,1),(11,10,1),(12,9,1),(14,13,1),(22,21,1),(42,16,1),(48,6,1),(48,47,2),(53,54,1);
/*!40000 ALTER TABLE `skill_skill_prereqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_statistic_rule`
--

DROP TABLE IF EXISTS `skill_statistic_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_statistic_rule` (
  `skill_id` int(10) unsigned NOT NULL,
  `statistic_rule_id` int(10) unsigned NOT NULL,
  KEY `skill_statistic_rule_skill_id_index` (`skill_id`),
  KEY `skill_statistic_rule_statistic_rule_id_index` (`statistic_rule_id`),
  CONSTRAINT `skill_statistic_rule_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE,
  CONSTRAINT `skill_statistic_rule_statistic_rule_id_foreign` FOREIGN KEY (`statistic_rule_id`) REFERENCES `statistic_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_statistic_rule`
--

LOCK TABLES `skill_statistic_rule` WRITE;
/*!40000 ALTER TABLE `skill_statistic_rule` DISABLE KEYS */;
INSERT INTO `skill_statistic_rule` VALUES (9,4),(10,4),(11,4),(12,4),(17,2),(18,5),(51,8);
/*!40000 ALTER TABLE `skill_statistic_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_wealth_rule`
--

DROP TABLE IF EXISTS `skill_wealth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_wealth_rule` (
  `skill_id` int(10) unsigned NOT NULL,
  `wealth_rule_id` int(10) unsigned NOT NULL,
  KEY `skill_wealth_rule_skill_id_index` (`skill_id`),
  KEY `skill_wealth_rule_wealth_rule_id_index` (`wealth_rule_id`),
  CONSTRAINT `skill_wealth_rule_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE,
  CONSTRAINT `skill_wealth_rule_wealth_rule_id_foreign` FOREIGN KEY (`wealth_rule_id`) REFERENCES `wealth_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_wealth_rule`
--

LOCK TABLES `skill_wealth_rule` WRITE;
/*!40000 ALTER TABLE `skill_wealth_rule` DISABLE KEYS */;
INSERT INTO `skill_wealth_rule` VALUES (43,4),(44,3),(45,2),(51,4);
/*!40000 ALTER TABLE `skill_wealth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ep_cost` mediumint(9) NOT NULL,
  `skill_level_id` int(10) unsigned NOT NULL,
  `description_small` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_long` text COLLATE utf8_unicode_ci NOT NULL,
  `mentor_required` tinyint(1) NOT NULL,
  `income_coin_id` int(10) unsigned NOT NULL,
  `income_amount` mediumint(9) NOT NULL,
  `statistic_prereq_id` int(10) unsigned NOT NULL,
  `statistic_prereq_amount` mediumint(9) NOT NULL,
  `secret_skill` tinyint(1) NOT NULL,
  `wealth_prereq_id` int(10) unsigned NOT NULL,
  `craft_skill` tinyint(1) NOT NULL,
  `skill_handout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `skills_skill_level_id_foreign` (`skill_level_id`),
  KEY `skills_income_coin_id_foreign` (`income_coin_id`),
  KEY `skills_statistic_prereq_id_foreign` (`statistic_prereq_id`),
  KEY `skills_id_index` (`id`),
  KEY `fk_wealth_prereq_id` (`wealth_prereq_id`),
  CONSTRAINT `fk_wealth_prereq_id` FOREIGN KEY (`wealth_prereq_id`) REFERENCES `wealth_types` (`id`),
  CONSTRAINT `skills_income_coin_id_foreign` FOREIGN KEY (`income_coin_id`) REFERENCES `coins` (`id`),
  CONSTRAINT `skills_skill_level_id_foreign` FOREIGN KEY (`skill_level_id`) REFERENCES `skill_levels` (`id`),
  CONSTRAINT `skills_statistic_prereq_id_foreign` FOREIGN KEY (`statistic_prereq_id`) REFERENCES `statistics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,'Volkskennis: Mannheim',1,1,'Karakter kent de Mannheimse samenleving','Het personage heeft een uitvoerige kennis over de oorlogszuchtige Mannheimers. Hij heeft kennis over tradities, belangrijke gebeurtenissen, cultuur en maatschappij. Test<div><br></div><div><i>Deze vaardigheid geeft recht op de hand-out Volkskennis: Mannheim. Deze vaardigheid is gratis indien het personage van deze afkomst is.</i><br></div>',0,1,0,1,0,0,1,0,'Volkskennis Mannheim.pdf'),(2,'Volkskennis: Bhanda Korr',1,1,'Karakter kent de Bhanda Korr samenleving','Het personage heeft een uitvoerige kennis over de barbaarse Bhanda Korr. Hij heeft kennis over tradities, belangrijke gebeurtenissen, cultuur en maatschappij.<div><br></div><div><i>Deze vaardigheid geeft recht op de hand-out Volkskennis: Bhanda Korr. Deze vaardigheid is gratis indien het personage van deze afkomst is.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(3,'Volkskennis: Goliad',1,1,'Karakter kent de Golindische samenleving','Het personage heeft een uitvoerige kennis over de wijze Goliad. Hij heeft kennis over tradities, belangrijke gebeurtenissen, cultuur en maatschappij.<div><br></div><div><i>Deze vaardigheid geeft recht op de hand-out Volkskennis: Goliad. Deze vaardigheid is gratis indien het personage van deze afkomst is.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(4,'Volkskennis: Khalië',1,1,'Karakter kent de Khalische samenleving','Het personage heeft een uitvoerige kennis over de waakzame Khaliërs. Hij heeft kennis over tradities, belangrijke gebeurtenissen, cultuur en maatschappij.<div><br></div><div><i>Deze vaardigheid geeft recht op de hand-out Volkskennis: Khalië. Deze vaardigheid is gratis indien het personage van deze afkomst is.</i><br></div>',0,1,0,1,0,0,1,0,'Volkskennis Khalie.pdf'),(5,'Volkskennis: Ranae',1,1,'Karakter kent de Ranae samenleving','Het personage heeft een uitvoerige kennis over de uitbundige Ranae. Hij heeft kennis over tradities, belangrijke gebeurtenissen, cultuur en maatschappij.<div><br></div><div><i>Deze vaardigheid geeft recht op de hand-out Volkskennis: Ranae. &nbsp;Deze vaardigheid is gratis indien het personage van deze afkomst is.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(6,'Woudlopen',2,1,'Karakter kan zonder gevaar in het bos','Het personage mag van paden afwijken en zich in het bos vertoeven zonder risico.<div><br></div><div><i>Personages zonder deze vaardigheid die zich in het bos bevinden, dienen zich aan te melden bij spelleiding na enige tijd ‘verdwaald’ rollenspel.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(7,'Lezen en Schrijven',1,1,'Karakter kan lezen en schrijven','Het personage kan de volkstaal lezen en schrijven.<div><br></div><div><i>De volkstaal wordt gesimuleerd door Nederlands.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(8,'Landkaart Lezen',1,1,'Karakter kan landkaarten lezen','Het personage is vaardig in het lezen van landkaarten.<div><br></div><div><i>Na enige minuten studie krijgt het personage een ongecodeerde versie van de landkaart. &nbsp;</i><br></div>',0,1,0,1,0,0,1,0,NULL),(9,'Vitaliteit I',1,1,'Karakter krijgt focus bij','Het personage ontvangt permanent +1 Focus&nbsp;<br>',0,1,0,1,0,0,1,0,NULL),(10,'Vitaliteit II',1,1,'Karakter krijgt Focus bij','Het personage ontvangt permanent +1 Focus&nbsp;<br>',0,1,0,1,0,0,1,0,NULL),(11,'Vitaliteit III',1,1,'Karakter krijgt Focus bij','Het personage ontvangt permanent +1 Focus&nbsp;<br>',0,1,0,1,0,0,1,0,NULL),(12,'Krijgskunst I',1,1,'Karakter krijgt Focus bij','Het personage ontvangt permanent +1 Focus&nbsp;<br>',0,1,0,1,0,0,1,0,NULL),(13,'Pantserdracht I',2,1,'Karakter kan maliën dragen','Het personage is in staat om één of meerdere stukken maliënkolder te dragen.<br>',0,1,0,1,0,0,1,0,NULL),(14,'Krijgstechniek: Balans',1,1,'Karakter staat stevig op zijn voeten','De strijder weet perfect zijn evenwicht te behouden in het midden van de strijd. &nbsp;Deze vaardigheid laat toe om niet neergeslagen te worden na spreuken of effecten zoals ‘Impact’. Men ontvangt wel nog altijd schade maar het effect ‘Impact’ wordt teniet gedaan.<div><br></div><div><i>&nbsp;Dit kost 1 Focus.&nbsp;</i><br></div>',0,1,0,1,0,0,1,0,NULL),(15,'Krijgstechniek: Vaste Hand',2,1,'Karakter is lastig te ontwapenen','De krijger is vaardig in het behouden van een wapen, zelfs na een poging tot ontwapening. &nbsp;Het personage mag 1 ontwapening tenietdoen door het roepen van ‘Vaste Hand’. &nbsp;Je mag je wapen behouden.<div><br></div><div><i>Dit kost 1 Focus.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(16,'Angst Resistentie I',1,1,'Karakter is niet snel bang','Het personage bezit stalen zenuwen en heeft de moed om een verschrikkelijke angst te overwinnen. Het personage negeert het eerste Angst effect dat men afroept en mag normaal reageren.&nbsp;<br>',0,1,0,1,0,0,1,0,NULL),(17,'Levenspunten I',2,1,'+1 Levenspunten','Het personage ontvangt +1 LP op elke locatie.<br>',0,1,0,1,0,0,1,0,NULL),(18,'Wilskracht I',2,1,'+1 Wilskracht','Het personage ontvangt permanent +1 Wilskracht<br>',0,1,0,1,0,0,1,0,NULL),(20,'Kannibalisme I',2,1,'Karakter herwint LP door kannibalisme','Indien juist bereid met sjamanisme en de nodige riten, verkrijgen de woeste Bhanda Korr de levenskracht van de ongelukkigen die ze verslinden. &nbsp;Deze vaardigheid laat de sjamaan toe om 1x per periode een ‘maaltijd’ te creëren van een vers menselijk slachtoffer (liefst levend) mits voldoende rollenspel.&nbsp;<div><br></div><div><i>Men verkrijgt een ‘pool’ van LP ( = de torso LP van het slachtoffer), elke Bhanda Korr die van de maaltijd nuttigt, herwint 1 LP op een te kiezen locatie. Als de ‘pool’ LP op is, is de maaltijd ook op. &nbsp;Spelleiding behoudt het recht om eventueel ziekten uit te delen. Men kan dit slechts 1 periode ‘vers’ houden, dus volgende periode ontvangt men geen voordeel van dezelfde maaltijd. &nbsp;Personages zonder Volkskennis: Bhanda Korr die het de eerste keer aanschouwen ontvangen +1 Trauma.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(21,'Wapengebruik: 1Handige Bijl',2,1,'Karakter  kan met 1-handige bijl vechten','Het personage kan een 1-handige bijl hanteren en doet hiermee 1 schade per rake slag.<div><br></div><div><i>Een bijl is noch stomp, noch scherp.</i></div>',0,1,0,1,0,0,1,0,NULL),(22,'Wapengebruik: 2Handige Bijl',2,1,'Karakter kan met 2-handige bijl vechten','Het karakter kan een 2-handige bijl hanteren en doet hiermee 2 schade per rake slag<div><br></div><div><i>Een bijl is noch stomp, noch scherp</i></div>',0,1,0,1,0,0,1,0,NULL),(39,'Inspiratie',3,1,'Het karakter inspireert tijdens de strijd','Het personage kan anderen inspireren in het heetst van de strijd door moedig een voorbeeld te geven.<div><br></div><div><i>Deze vaardigheid kost 1 status waarna men 1 van volgende effecten kan activeren:</i></div><div><ul><li><i>+1 schade op de charge. &nbsp;‘Chargeer!’</i><br></li><li><i>+1 schade met afstandswapens. &nbsp;“Klaar, richten, vuur!!”</i><br></li><li><i>1 Angst effect negeren. &nbsp;‘Moed houden, blijven staan!”</i><br></li><li><i>1 focus herwinnen. &nbsp;‘Volhouden, mannen!”</i><br></li></ul></div><div><i>Men moet steeds iets toepasselijks roepen + het gekozen effect. Men kan alleen maar 5 personen rondom affecteren, deze personen moeten in de onmiddellijke omgeving staan. &nbsp;(het is aangewezen dit op voorhand af te spreken om verwarring te voorkomen.)</i></div><div><i>Men kan deze vaardigheid meerdere keren per gevecht gebruiken.&nbsp;</i><br></div>',0,1,0,1,0,0,1,0,NULL),(41,'Multiklasse I (Vagebond)',2,2,'Het karakter verkrijgt de klasse Vagebond','Veel avonturiers blijven niet bij 1 klasse zitten maar breiden hun ervaring uit naar een tweede beroep of bezigheid.<br><br><i>Deze vaardigheid stelt je in staat om een tweede klasse te kiezen. Je kan kiezen uit volgende klassen:<br>&nbsp; Geleerde – Handelaar – Krijger – Vagebond.<br>Alle EP is nu aan basiskost ipv dubbele kost.<br><br>Voor de klassen: &nbsp;Ontwaakte – Priester heeft men toestemming van spelleiding nodig.</i><br>',0,1,0,1,0,0,1,0,NULL),(42,'Angst Resistentie II',1,1,'Karakter is niet snel bang','Het personage bezit stalen zenuwen en heeft de moed om een verschrikkelijke angst te overwinnen.<br><br><i>Dit verhoogt het aantal keer men een Angst effect mag negeren met 1.</i><br>',0,1,0,1,0,0,1,0,NULL),(43,'Welvaart (Rijk)',4,1,'Karakter is rijker dan normaal','Deze vaardigheid laat toe om 1 rijkdom hoger te beginnen dan normaal aangeduid door je klasse. Dit moet verwerkt worden in de achtergrond van je personage.<br><br><i>Deze vaardigheid kan enkel gekozen worden bij personagecreatie. &nbsp;Men moet toestemming van spelleiding hebben om deze vaardigheid te kiezen.</i><br>',1,1,0,1,0,0,3,0,NULL),(44,'Welvaart (Welvarend)',2,1,'Karakter is rijker dan normaal','Deze vaardigheid laat toe om 1 rijkdom hoger te beginnen dan normaal aangeduid door je klasse. Dit moet verwerkt worden in de achtergrond van je personage.<br><br><i>Deze vaardigheid kan enkel gekozen worden bij personagecreatie. &nbsp;Men moet toestemming van spelleiding hebben om deze vaardigheid te kiezen.</i><br>',1,1,0,1,0,0,2,0,NULL),(45,'Welvaart (Middenklasse)',1,1,'Karakter is rijker dan normaal','Deze vaardigheid laat toe om 1 rijkdom hoger te beginnen dan normaal aangeduid door je klasse. Dit moet verwerkt worden in de achtergrond van je personage.<br><br><i>Deze vaardigheid kan enkel gekozen worden bij personagecreatie. &nbsp;Men moet toestemming van spelleiding hebben om deze vaardigheid te kiezen.</i><br>',1,1,0,1,0,0,1,0,NULL),(47,'Roep der Natuur',1,1,'Karakter is een druïde','Het personage is ontwaakt met magisch potentieel en heeft de roep van het land aanhoort. &nbsp;Je mag je een Druïde noemen.<br><br><i>Deze vaardigheid is hetzelfde als Woudlopen maar in plaats van kennis en ervaring is de connectie meer primitiever en vloeit deze voort uit instinct. &nbsp; De enige magie-strekking die je vervolgens nog mag selecteren is Druïdisme.</i><br>',0,1,0,1,0,0,1,0,NULL),(48,'Monsterkennis: Feeën',1,1,'Karakter heeft basis kennis van Feeën','Het personage bezit een rudimentaire kennis over de mystieke feeën: sprookjesachtige wezens uit de folklore die zelden gezien worden.<br><br><i>Deze vaardigheid geeft recht op de hand-out Monsterkennis: Feeën</i><br>',0,1,0,1,0,0,1,0,NULL),(51,'Adelstand',5,1,'Karakter is van adel.','Je bent geboren in de adelstand!<br><br>Deze vaardigheid verhoogt je Status met +3 en je ontvangt de Titel Jonker / Jonkvrouw. &nbsp;Je rijkdom verandert automatisch naar Rijk. &nbsp;Je moet één van de 12 Hoge Huizen kiezen voor je politieke alliantie.<br><br><i>Je kan deze vaardigheid enkel selecteren bij personagecreatie. Spelleiding laat slechts een bepaald aantal edelen toe. Contacteer spelleiding voor toestemming.&nbsp;</i><br>',1,1,0,1,0,0,1,0,NULL),(52,'Stadssluipen',3,1,'Het personage kan zich ongezien voortbewegen in een bebouwde omgeving.','Het personage kan zich ongezien voortbewegen in een bebouwde omgeving. <br><br><i>Om de vaardigheid te initiëren mag niemand hem zien, daarna bindt hij een wit lint om het hoofd en kan vervolgens niet gezien worden zolang hij zich zeer traag voortbeweegt, geen geluid voortbrengt en binnen 1 meter van een bebouwing blijft. Eender welke vorm van actie verbreekt het sluipen en het personage wordt terug zichtbaar. &nbsp;De speler moet zelf het lint voorzien.&nbsp;</i>',0,1,0,1,0,0,1,0,NULL),(53,'Briefadel',2,1,'Karakter is een Ridder of Dame','Ridders of Dames zijn de onderklasse van de adel, trouwe vazallen die hun superieuren bijstaan met raad of zwaard.<div>Het personage is door middel van een adelbrief tot Ridder of Dame geslagen door een Titel via de vaardigheid Ridderslag. &nbsp;Deze vaardigheid geeft +1 Status maar is niet te combineren met Titel I of hoger. Het personage is gezworen aan een edel Huis en krijgt de bijhorende verantwoordelijkheden en voordelen. Dit telt als beroep en inkomsten zijn bijkomstig aan andere inkomsten. Een Ridder of Dame heeft geen domein maar kan dit wel aankopen met de bijpassende vaardigheid.</div><div><br></div><div><i>Deze vaardigheid kan men niet aankopen met Afkomstpunten en enkel tijdens personagecreatie!</i><br></div>',1,2,3,1,0,0,1,0,NULL),(54,'Heraldiek',1,1,'Karakter kent de heraldiek van adellijke huizen','Het personage kent de Adellijke Huizen van Heimar en kan deze op zicht herkennen.<br><i>Deze vaardigheid geeft recht op de hand-out: Heraldiek&nbsp;</i><br>',0,1,0,1,0,0,1,0,NULL),(55,'Naald en Draad',1,1,'Karakter is een vaardig kleermaker','Het personage is een leerling kleermaker en kan op dit niveau gewone kleren maken of herstellen. Men heeft hiervoor de nodige grondstoffen nodig (linnen, wol, zijde, etc..). Het herstellen van betere kwaliteit kleren herleidt de kleding naar deze kwaliteit. Deze vaardigheid laat toe om alle soorten versterkte kledij te herschikken.&nbsp;<br>',1,1,5,1,0,0,1,1,NULL),(56,'Wapengebruik: Paalwapen',4,1,'Karakter kan met een paalwapen vechten','Het personage kan een paalwapen hanteren en doet hiermee 2 schade.<div><br></div><div><i>&nbsp;Een paalwapen is stomp noch scherp.</i><br></div>',0,1,0,1,0,0,1,0,NULL),(57,'Krijgstechniek:  Cirkel des Doods',3,2,'Je draait rond en alles sterft','Zeer geschikt voor misinterpretatie van figuranten',1,1,0,1,0,0,1,0,NULL);
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistic_rules`
--

DROP TABLE IF EXISTS `statistic_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistic_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `statistic_id` int(10) unsigned NOT NULL,
  `rules_operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statistic_rules_id_index` (`id`),
  KEY `statistic_rules_statistic_id_foreign` (`statistic_id`),
  KEY `statistic_rules_rules_operator_foreign` (`rules_operator`),
  CONSTRAINT `statistic_rules_rules_operator_foreign` FOREIGN KEY (`rules_operator`) REFERENCES `rules_operators` (`operator`),
  CONSTRAINT `statistic_rules_statistic_id_foreign` FOREIGN KEY (`statistic_id`) REFERENCES `statistics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistic_rules`
--

LOCK TABLES `statistic_rules` WRITE;
/*!40000 ALTER TABLE `statistic_rules` DISABLE KEYS */;
INSERT INTO `statistic_rules` VALUES (1,3,'+',1),(2,1,'+',1),(3,1,'+',2),(4,4,'+',1),(5,2,'+',1),(6,2,'+',2),(7,3,'+',2),(8,3,'+',3),(9,1,'+',3);
/*!40000 ALTER TABLE `statistic_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `statistic_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statistics_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` VALUES (1,'Levenspunten'),(2,'Wilskracht'),(3,'Status'),(4,'Focus');
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_accepted` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_system_rep` tinyint(1) NOT NULL,
  `is_story_telling` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'StoryTelling','storytelling@test.com','$2y$10$HZhB17MYovMSo/3jd1zEye/D07S747CwQoETcrUCOkDWkEUTrU30m','oW0GcxX7vcQ5ZuHegbFw7aGGNPTOS9n9wg5QmTonVGt13I6lcP6HDt8E2nsO','2017-08-11 15:51:07','2017-09-04 06:53:22',1,0,0,1),(7,'SystemRep','systemrep@test.com','$2y$10$et2dJdKxQH6xuU2mYj4UleghWPRhS2kPSlnLRXFTqJ1qEOy66CWwe','UfPv3LywBdznJ6zCIQwDHmKAJ0CmN509bLZXJe9YZJxN1Ib9FvAd225640SB','2017-08-11 15:51:26','2018-06-18 03:36:30',1,0,1,0),(8,'PlayerPlayer','player@test.com','$2y$10$EXhiP8LXqVTY2K.7ExTTQuktHYrNOeof6vLTsUGViApOb4M6J0oWW','8u1Pw1809TBlfX5nAvGD2DoWJlrnfk83Ez4zs5WeOfu0dew54fG4J9NFAdj6','2017-08-12 07:02:27','2018-06-24 10:17:29',1,0,0,0),(10,'OmenAdmin','admin@test.com','$2y$10$5MtKqIDjYwN9BwRyFka2nudfDd7JNR9KPT/GWBLPiBvlNw56vSqAu','EV8ppLEbPnWhtigqyNMXoOXwMgVr4PNb6Pq1rJwLpcBgK9PmjavXZaPT2Yly','2017-09-04 06:54:09','2018-06-25 05:52:06',1,1,0,0),(11,'Pieter','Pieter.Bosman@gmail.com','$2y$10$Y9oo6gJpQBYr0uVOJ1QO5OqIszGwBJ3CSNfVOt1sQ7RbusUB724hG','U0RQqcXdPVtECls2KFY3DwYFmCaIT8cN4VbdyGIqpGxzrANSiUGomjfhAVIE','2017-09-04 08:22:38','2017-09-04 08:26:27',1,0,0,0),(12,'Jasper','jasper@jasper.com','$2y$10$x.7waZjteR/qm7jS4ZF/VehKyLxSrdQZPfHCFgLgwUTP8/Ams3aKC','woo6WiMtKxTxQYGIvzvbSMwyFVQmfl92zlBI9vEjIjvJFyEQLAkdc98HBi8T','2018-06-10 10:31:50','2018-06-10 10:35:49',1,0,0,0),(13,'linksonder','linksonder@gmail.com','$2y$10$3Jbn1UeBbSPeuJUpcG/24uQRHhcpe9fOZM3jIXVa5tZJtePhI/CWy','c14blWbtsTHYkRDQ4iJqUZwUpwq81djuYFJ2k0hFp72HJlmJOn3rLERKDM5N','2018-06-25 05:05:23','2018-06-25 05:09:23',0,0,0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wealth_rules`
--

DROP TABLE IF EXISTS `wealth_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wealth_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wealth_id` int(10) unsigned NOT NULL,
  `rules_operator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wealth_rules_id_index` (`id`),
  KEY `wealth_rules_wealth_id_foreign` (`wealth_id`),
  KEY `wealth_rules_rules_operator_foreign` (`rules_operator`),
  KEY `wealth_rules_value_type_id_foreign` (`value_type_id`),
  CONSTRAINT `wealth_rules_rules_operator_foreign` FOREIGN KEY (`rules_operator`) REFERENCES `rules_operators` (`operator`),
  CONSTRAINT `wealth_rules_value_type_id_foreign` FOREIGN KEY (`value_type_id`) REFERENCES `wealth_types` (`id`),
  CONSTRAINT `wealth_rules_wealth_id_foreign` FOREIGN KEY (`wealth_id`) REFERENCES `wealths` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wealth_rules`
--

LOCK TABLES `wealth_rules` WRITE;
/*!40000 ALTER TABLE `wealth_rules` DISABLE KEYS */;
INSERT INTO `wealth_rules` VALUES (1,1,'=',1),(2,1,'=',2),(3,1,'=',3),(4,1,'=',4);
/*!40000 ALTER TABLE `wealth_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wealth_types`
--

DROP TABLE IF EXISTS `wealth_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wealth_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wealth_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wealth_types_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wealth_types`
--

LOCK TABLES `wealth_types` WRITE;
/*!40000 ALTER TABLE `wealth_types` DISABLE KEYS */;
INSERT INTO `wealth_types` VALUES (1,'Arm'),(2,'Middenklasse'),(3,'Welvarend'),(4,'Rijk');
/*!40000 ALTER TABLE `wealth_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wealths`
--

DROP TABLE IF EXISTS `wealths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wealths` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wealth_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wealths_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wealths`
--

LOCK TABLES `wealths` WRITE;
/*!40000 ALTER TABLE `wealths` DISABLE KEYS */;
INSERT INTO `wealths` VALUES (1,'Welvaart');
/*!40000 ALTER TABLE `wealths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weapons`
--

DROP TABLE IF EXISTS `weapons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weapons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_normal` int(11) NOT NULL,
  `price_good` int(11) NOT NULL,
  `price_master` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `weapons_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weapons`
--

LOCK TABLES `weapons` WRITE;
/*!40000 ALTER TABLE `weapons` DISABLE KEYS */;
INSERT INTO `weapons` VALUES (1,'Zwaard (1-handig)','<div>Het meest verfijnde en nobele wapen, gedragen door alle volkeren maar minder voorkomend bij de Bhanda Korr. Je hebt eenhandige zwaarden die vrij standaard zijn in Heimar maar ook tweehandige zwaarden die enkel door ervaren, sterke krijgers gehanteerd worden. Bastaardzwaarden bestaan ook, maar komen veel minder voor. Dit wapen heeft de balans en het formaat om ofwel eenhandig als tweehandig gehanteerd te worden.<br><br></div><div>Speltechnisch: alle zwaarden tellen als scherpe wapens.</div><div><i>*Men heeft minstens de vaardigheid ‘Wapengebruik: 1handig zwaard’ nodig.</i></div>',5,50,1200),(2,'Zwaard (2-handig)','<div>Het meest verfijnde en nobele wapen, gedragen door alle volkeren maar minder voorkomend bij de Bhanda Korr. Je hebt eenhandige zwaarden die vrij standaard zijn in Heimar maar ook tweehandige zwaarden die enkel door ervaren, sterke krijgers gehanteerd worden. Bastaardzwaarden bestaan ook, maar komen veel minder voor. Dit wapen heeft de balans en het formaat om ofwel eenhandig als tweehandig gehanteerd te worden.<br><br></div><div>Speltechnisch: alle zwaarden tellen als scherpe wapens.</div><div><i>*Men heeft minstens de vaardigheid ‘Wapengebruik: 1handig zwaard’ nodig.</i></div>',10,100,2400),(3,'Bijl (1-handig)','<div>Het traditionele oorlogswapen van Mannheim; een bijl is favoriet bij vele krijgers omwille van de dodelijke impact in combinatie met een gescherpt blad. Eenhandige versies zijn vrij standaard, zeker onder Mannheimers en tweehandige versies zijn terecht gevreesd op elk slagveld.</div><div>&nbsp;&nbsp;</div><div>Speltechnisch: bijlen tellen als scherp noch stomp!</div><div><i>*Men heeft minstens de vaardigheid ‘Wapengebruik: 1handige bijl’ nodig.</i></div>',7,70,1500),(4,'Bijl (2-handig)','<div>Het traditionele oorlogswapen van Mannheim; een bijl is favoriet bij vele krijgers omwille van de dodelijke impact in combinatie met een gescherpt blad. Eenhandige versies zijn vrij standaard, zeker onder Mannheimers en tweehandige versies zijn terecht gevreesd op elk slagveld.</div><div>&nbsp;&nbsp;</div><div>Speltechnisch: bijlen tellen als scherp noch stomp!</div><div><i>*Men heeft minstens de vaardigheid ‘Wapengebruik: 1handige bijl’ nodig.</i></div>',12,120,2500);
/*!40000 ALTER TABLE `weapons` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-01 15:16:46
