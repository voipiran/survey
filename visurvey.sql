-- MySQL dump 10.14  Distrib 5.5.64-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: visurvey
-- ------------------------------------------------------
-- Server version	5.5.64-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,1,'Category 1','category-1','2018-08-06 02:20:41','2018-08-06 02:20:41'),(2,NULL,1,'Category 2','category-2','2018-08-06 02:20:41','2018-08-06 02:20:41');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,NULL,1),(2,1,'name','text','نام',1,1,1,1,1,1,NULL,2),(3,1,'email','text','ایمیل',1,1,1,1,1,1,NULL,4),(4,1,'password','password','کلمه عبور',1,0,0,1,1,0,NULL,5),(5,1,'remember_token','text','Remember Token',0,0,0,0,0,0,NULL,6),(6,1,'created_at','timestamp','تاریخ ثبت نام',0,1,1,0,0,0,NULL,7),(7,1,'updated_at','timestamp','تاریخ بروزرسانی',0,0,0,0,0,0,NULL,8),(8,1,'avatar','image','تصویر',0,1,1,1,1,1,NULL,9),(9,1,'user_belongsto_role_relationship','relationship','نقش',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}',11),(10,1,'user_belongstomany_role_relationship','relationship','نقش های اضافه',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}',12),(12,1,'settings','hidden','تنظیمات',0,0,0,0,0,0,NULL,13),(13,2,'id','number','ID',1,0,0,0,0,0,'',1),(14,2,'name','text','Name',1,1,1,1,1,1,'',2),(15,2,'created_at','timestamp','Created At',0,0,0,0,0,0,'',3),(16,2,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',4),(17,3,'id','number','ID',1,0,0,0,0,0,NULL,1),(18,3,'name','text','Name',1,1,1,1,1,1,NULL,2),(19,3,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(20,3,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(21,3,'display_name','text','Display Name',1,1,1,1,1,1,NULL,5),(22,1,'role_id','text','نقش',0,1,1,1,1,1,NULL,10),(23,4,'id','number','ID',1,0,0,0,0,0,'',1),(24,4,'parent_id','select_dropdown','Parent',0,0,1,1,1,1,'{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2),(25,4,'order','text','Order',1,1,1,1,1,1,'{\"default\":1}',3),(26,4,'name','text','Name',1,1,1,1,1,1,'',4),(27,4,'slug','text','Slug',1,1,1,1,1,1,'{\"slugify\":{\"origin\":\"name\"}}',5),(28,4,'created_at','timestamp','Created At',0,0,1,0,0,0,'',6),(29,4,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',7),(30,5,'id','number','ID',1,0,0,0,0,0,'',1),(31,5,'author_id','text','Author',1,0,1,1,0,1,'',2),(32,5,'category_id','text','Category',1,0,1,1,1,0,'',3),(33,5,'title','text','Title',1,1,1,1,1,1,'',4),(34,5,'excerpt','text_area','Excerpt',1,0,1,1,1,1,'',5),(35,5,'body','rich_text_box','Body',1,0,1,1,1,1,'',6),(36,5,'image','image','Post Image',0,1,1,1,1,1,'{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}',7),(37,5,'slug','text','Slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}',8),(38,5,'meta_description','text_area','Meta Description',1,0,1,1,1,1,'',9),(39,5,'meta_keywords','text_area','Meta Keywords',1,0,1,1,1,1,'',10),(40,5,'status','select_dropdown','Status',1,1,1,1,1,1,'{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}',11),(41,5,'created_at','timestamp','Created At',0,1,1,0,0,0,'',12),(42,5,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',13),(43,5,'seo_title','text','SEO Title',0,1,1,1,1,1,'',14),(44,5,'featured','checkbox','Featured',1,1,1,1,1,1,'',15),(45,6,'id','number','ID',1,0,0,0,0,0,'',1),(46,6,'author_id','text','Author',1,0,0,0,0,0,'',2),(47,6,'title','text','Title',1,1,1,1,1,1,'',3),(48,6,'excerpt','text_area','Excerpt',1,0,1,1,1,1,'',4),(49,6,'body','rich_text_box','Body',1,0,1,1,1,1,'',5),(50,6,'slug','text','Slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}',6),(51,6,'meta_description','text','Meta Description',1,0,1,1,1,1,'',7),(52,6,'meta_keywords','text','Meta Keywords',1,0,1,1,1,1,'',8),(53,6,'status','select_dropdown','Status',1,1,1,1,1,1,'{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}',9),(54,6,'created_at','timestamp','Created At',1,1,1,0,0,0,'',10),(55,6,'updated_at','timestamp','Updated At',1,0,0,0,0,0,'',11),(56,6,'image','image','Page Image',0,1,1,1,1,1,'',12),(57,3,'acl_id','select_dropdown','سطح مدیریت',1,1,1,1,1,1,'{\"default\":\"option1\",\"options\":{\"0\":\"مدیریت سطح 0\",\"1\":\"مدیریت سطح 1\",\"2\":\"مدیریت سطح 2\",\"3\":\"مدیریت سطح 3\",\"4\":\"مدیریت سطح 4\",\"5\":\"مدیریت سطح 5\",\"6\":\"مدیریت سطح 6\"}}',4),(72,9,'id','text','Id',1,0,0,0,0,0,NULL,1),(73,9,'name','text','نام',0,1,1,1,1,1,NULL,2),(74,9,'family','text','نام خانوادگی',0,1,1,1,1,1,NULL,3),(81,1,'last_name','text','نام خانوادگی',0,1,1,1,1,1,NULL,3),(82,1,'first_name','text','First Name',1,1,1,1,1,1,NULL,4);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'users','users','کاربر','کاربران','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy',NULL,NULL,1,1,'{\"order_column\":null,\"order_display_column\":null}','2018-08-06 02:20:39','2018-11-08 13:01:25'),(2,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,NULL,'2018-08-06 02:20:39','2018-08-06 02:20:39'),(3,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null}','2018-08-06 02:20:39','2018-08-13 09:57:13'),(4,'categories','categories','Category','Categories','voyager-categories','TCG\\Voyager\\Models\\Category',NULL,'','',1,0,NULL,'2018-08-06 02:20:41','2018-08-06 02:20:41'),(5,'posts','posts','Post','Posts','voyager-news','TCG\\Voyager\\Models\\Post','TCG\\Voyager\\Policies\\PostPolicy','','',1,0,NULL,'2018-08-06 02:20:41','2018-08-06 02:20:41'),(6,'pages','pages','Page','Pages','voyager-file-text','TCG\\Voyager\\Models\\Page',NULL,'','',1,0,NULL,'2018-08-06 02:20:41','2018-08-06 02:20:41'),(9,'personel','personel','Personel','Personels','voyager-people','App\\Personel',NULL,NULL,NULL,1,1,'{\"order_column\":null,\"order_display_column\":null}','2018-11-04 21:06:43','2018-11-04 21:06:43');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'داشبورد','','_self','voyager-boat','#000000',NULL,1,'2018-08-06 02:20:39','2018-08-16 01:37:46','voyager.dashboard','null'),(2,1,'چند رسانه ای','','_self','voyager-images','#000000',NULL,4,'2018-08-06 02:20:39','2018-11-04 18:42:51','voyager.media.index','null'),(3,1,'کاربران','','_self','voyager-person','#000000',NULL,3,'2018-08-06 02:20:39','2018-11-04 18:42:37','voyager.users.index','null'),(4,1,'نقش ها','','_self','voyager-lock','#000000',NULL,2,'2018-08-06 02:20:39','2018-11-04 18:42:21','voyager.roles.index','null'),(5,1,'ابزارها','','_self','voyager-tools','#000000',NULL,8,'2018-08-06 02:20:39','2018-11-04 18:43:47',NULL,''),(6,1,'منوساز','','_self','voyager-list','#000000',5,1,'2018-08-06 02:20:40','2018-11-04 18:44:02','voyager.menus.index','null'),(7,1,'پایگاه داده','','_self','voyager-data','#000000',5,2,'2018-08-06 02:20:40','2018-11-04 18:44:16','voyager.database.index','null'),(8,1,'گزارش گیری','','_self','voyager-compass','#000000',5,3,'2018-08-06 02:20:40','2018-11-04 18:44:34','voyager.compass.index','null'),(9,1,'صفحه ساز','','_self','voyager-bread','#000000',5,4,'2018-08-06 02:20:40','2018-11-04 20:58:28','voyager.bread.index','null'),(10,1,'تنظیمات','','_self','voyager-settings','#000000',NULL,9,'2018-08-06 02:20:40','2018-11-04 20:59:01','voyager.settings.index','null'),(11,1,'دسته بندی ها','','_self','voyager-categories','#000000',NULL,7,'2018-08-06 02:20:41','2018-11-04 18:43:34','voyager.categories.index','null'),(12,1,'نوشته ها','','_self','voyager-news','#000000',NULL,5,'2018-08-06 02:20:41','2018-11-04 18:43:04','voyager.posts.index','null'),(13,1,'برگه ها','','_self','voyager-file-text','#000000',NULL,6,'2018-08-06 02:20:41','2018-11-04 18:43:20','voyager.pages.index','null'),(14,1,'افزونه ها','','_self','voyager-hook','#000000',5,5,'2018-08-06 02:20:42','2018-11-04 20:58:47','voyager.hooks','null'),(15,2,'منوی مقالات','/categories','_self',NULL,'#000000',NULL,1,'2018-08-16 01:33:30','2018-08-16 01:34:02',NULL,''),(16,2,'تتتت','/about-us','_self',NULL,'#000000',15,1,'2018-08-16 01:33:52','2018-08-16 01:34:04',NULL,''),(17,1,'تنظیمات','admin/phone/settings','_self','voyager-settings','#000000',NULL,10,'2018-11-08 06:30:59','2018-11-08 06:42:47',NULL,''),(18,1,'نظرسنجی','','_self','fas fa-poll','#000000',NULL,11,'2018-11-08 14:20:42','2018-11-09 17:44:46','surveys.index','null'),(19,1,'اپراتور ها','','_self','fas fa-headset','#000000',NULL,12,'2018-11-11 11:50:01','2018-11-11 11:59:56','operators.index','null');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2018-08-06 02:20:39','2018-08-06 02:20:39'),(2,'footer','2018-08-16 01:31:53','2018-08-16 01:31:53');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_01_01_000000_add_voyager_user_fields',1),(4,'2016_01_01_000000_create_data_types_table',1),(5,'2016_05_19_173453_create_menu_table',1),(6,'2016_10_21_190000_create_roles_table',1),(7,'2016_10_21_190000_create_settings_table',1),(8,'2016_11_30_135954_create_permission_table',1),(9,'2016_11_30_141208_create_permission_role_table',1),(10,'2016_12_26_201236_data_types__add__server_side',1),(11,'2017_01_13_000000_add_route_to_menu_items_table',1),(12,'2017_01_14_005015_create_translations_table',1),(13,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),(14,'2017_03_06_000000_add_controller_to_data_types_table',1),(15,'2017_04_21_000000_add_order_to_data_rows_table',1),(16,'2017_07_05_210000_add_policyname_to_data_types_table',1),(17,'2017_08_05_000000_add_group_to_settings_table',1),(18,'2017_11_26_013050_add_user_role_relationship',1),(19,'2017_11_26_015000_create_user_roles_table',1),(20,'2018_03_11_000000_add_user_settings',1),(21,'2018_03_14_000000_add_details_to_data_types_table',1),(22,'2018_03_16_000000_make_settings_value_nullable',1),(23,'2016_01_01_000000_create_pages_table',2),(24,'2016_01_01_000000_create_posts_table',2),(25,'2016_02_15_204651_create_categories_table',2),(26,'2017_04_11_000000_alter_post_nullable_fields_table',2),(27,'2018_07_18_053549_create_acls_table',3),(30,'2018_08_21_081440_create_subsystems_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysettings`
--

DROP TABLE IF EXISTS `mysettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mysettings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysettings`
--

LOCK TABLES `mysettings` WRITE;
/*!40000 ALTER TABLE `mysettings` DISABLE KEYS */;
INSERT INTO `mysettings` VALUES (1,'site.title','Site Title','نظرسنجی تلفنی','','text',1,'Site'),(2,'site.description','Site Description','نظرسنجی تلفنی','','text',2,'Site'),(3,'site.logo','Site Logo','settings\\November2018\\okj5kcf9kjaOx9vtpJ3p.png','','image',3,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID',NULL,'','text',4,'Site'),(5,'admin.bg_image','Admin Background Image','settings\\November2018\\42TS4jXxz7KTmgZEiM9y.png','','image',5,'Admin'),(6,'admin.title','Admin Title','نظرسنجی تلفنی','','text',1,'Admin'),(7,'admin.description','Admin Description','نظرسنجی تلفنی','','text',2,'Admin'),(8,'admin.loader','Admin Loader','settings\\November2018\\ghSVkNyXIHjUENL0DQlx.png','','image',3,'Admin'),(9,'admin.icon_image','Admin Icon Image','settings\\November2018\\IBvxef5uw1TpC51lOIKE.png','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)',NULL,'','text',1,'Admin');
/*!40000 ALTER TABLE `mysettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,0,'Hello World','Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.','<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','pages/page1.jpg','hello-world','Yar Meta Description','Keyword1, Keyword2','ACTIVE','2018-08-06 02:20:41','2018-08-06 02:20:41');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,3),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(16,3),(17,1),(17,3),(18,1),(18,3),(19,1),(19,3),(20,1),(20,3),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(31,2),(32,1),(32,2),(33,1),(33,2),(34,1),(34,2),(35,1),(35,2),(36,1),(37,1),(38,1),(39,1),(40,1),(52,1),(53,1),(54,1),(55,1),(56,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2018-08-06 02:20:40','2018-08-06 02:20:40'),(2,'browse_bread',NULL,'2018-08-06 02:20:40','2018-08-06 02:20:40'),(3,'browse_database',NULL,'2018-08-06 02:20:40','2018-08-06 02:20:40'),(4,'browse_media',NULL,'2018-08-06 02:20:40','2018-08-06 02:20:40'),(5,'browse_compass',NULL,'2018-08-06 02:20:40','2018-08-06 02:20:40'),(6,'browse_menus','menus','2018-08-06 02:20:40','2018-08-06 02:20:40'),(7,'read_menus','menus','2018-08-06 02:20:40','2018-08-06 02:20:40'),(8,'edit_menus','menus','2018-08-06 02:20:40','2018-08-06 02:20:40'),(9,'add_menus','menus','2018-08-06 02:20:40','2018-08-06 02:20:40'),(10,'delete_menus','menus','2018-08-06 02:20:40','2018-08-06 02:20:40'),(11,'browse_roles','roles','2018-08-06 02:20:40','2018-08-06 02:20:40'),(12,'read_roles','roles','2018-08-06 02:20:40','2018-08-06 02:20:40'),(13,'edit_roles','roles','2018-08-06 02:20:40','2018-08-06 02:20:40'),(14,'add_roles','roles','2018-08-06 02:20:40','2018-08-06 02:20:40'),(15,'delete_roles','roles','2018-08-06 02:20:40','2018-08-06 02:20:40'),(16,'browse_users','users','2018-08-06 02:20:40','2018-08-06 02:20:40'),(17,'read_users','users','2018-08-06 02:20:40','2018-08-06 02:20:40'),(18,'edit_users','users','2018-08-06 02:20:40','2018-08-06 02:20:40'),(19,'add_users','users','2018-08-06 02:20:40','2018-08-06 02:20:40'),(20,'delete_users','users','2018-08-06 02:20:40','2018-08-06 02:20:40'),(21,'browse_settings','settings','2018-08-06 02:20:40','2018-08-06 02:20:40'),(22,'read_settings','settings','2018-08-06 02:20:40','2018-08-06 02:20:40'),(23,'edit_settings','settings','2018-08-06 02:20:40','2018-08-06 02:20:40'),(24,'add_settings','settings','2018-08-06 02:20:40','2018-08-06 02:20:40'),(25,'delete_settings','settings','2018-08-06 02:20:40','2018-08-06 02:20:40'),(26,'browse_categories','categories','2018-08-06 02:20:41','2018-08-06 02:20:41'),(27,'read_categories','categories','2018-08-06 02:20:41','2018-08-06 02:20:41'),(28,'edit_categories','categories','2018-08-06 02:20:41','2018-08-06 02:20:41'),(29,'add_categories','categories','2018-08-06 02:20:41','2018-08-06 02:20:41'),(30,'delete_categories','categories','2018-08-06 02:20:41','2018-08-06 02:20:41'),(31,'browse_posts','posts','2018-08-06 02:20:41','2018-08-06 02:20:41'),(32,'read_posts','posts','2018-08-06 02:20:41','2018-08-06 02:20:41'),(33,'edit_posts','posts','2018-08-06 02:20:41','2018-08-06 02:20:41'),(34,'add_posts','posts','2018-08-06 02:20:41','2018-08-06 02:20:41'),(35,'delete_posts','posts','2018-08-06 02:20:41','2018-08-06 02:20:41'),(36,'browse_pages','pages','2018-08-06 02:20:41','2018-08-06 02:20:41'),(37,'read_pages','pages','2018-08-06 02:20:41','2018-08-06 02:20:41'),(38,'edit_pages','pages','2018-08-06 02:20:41','2018-08-06 02:20:41'),(39,'add_pages','pages','2018-08-06 02:20:41','2018-08-06 02:20:41'),(40,'delete_pages','pages','2018-08-06 02:20:41','2018-08-06 02:20:41'),(41,'browse_hooks',NULL,'2018-08-06 02:20:42','2018-08-06 02:20:42'),(52,'browse_personel','personel','2018-11-04 21:06:43','2018-11-04 21:06:43'),(53,'read_personel','personel','2018-11-04 21:06:43','2018-11-04 21:06:43'),(54,'edit_personel','personel','2018-11-04 21:06:43','2018-11-04 21:06:43'),(55,'add_personel','personel','2018-11-04 21:06:43','2018-11-04 21:06:43'),(56,'delete_personel','personel','2018-11-04 21:06:43','2018-11-04 21:06:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,NULL,'Lorem Ipsum Post',NULL,'This is the excerpt for the Lorem Ipsum Post','<p>This is the body of the lorem ipsum post</p>','posts/post1.jpg','lorem-ipsum-post','This is the meta description','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-08-06 02:20:41','2018-08-06 02:20:41'),(2,1,NULL,'My Sample Post',NULL,'This is the excerpt for the sample Post','<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>','posts/post2.jpg','my-sample-post','Meta Description for sample post','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-08-06 02:20:41','2018-08-06 02:20:41'),(3,1,NULL,'Latest Post',NULL,'This is the excerpt for the latest post','<p>This is the body for the latest post</p>','posts/post3.jpg','latest-post','This is the meta description','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-08-06 02:20:41','2018-08-06 02:20:41'),(4,1,NULL,'Yarr Post',NULL,'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.','<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>','posts/post4.jpg','yarr-post','this be a meta descript','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-08-06 02:20:41','2018-08-06 02:20:41');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acl_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator',0,'2018-08-06 02:20:40','2018-08-06 02:20:40'),(2,'user','Normal User',2,'2018-08-06 02:20:40','2018-08-06 02:20:40'),(3,'phone_manager','مدیرکل',1,'2018-11-06 12:48:06','2018-11-06 12:48:06');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_name` varchar(30) DEFAULT NULL,
  `survey_status` tinyint(4) DEFAULT NULL,
  `survey_voice` varchar(100) DEFAULT NULL,
  `survey_string` varchar(20) DEFAULT NULL,
  `survey_queue` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_voice_status` tinyint(4) DEFAULT NULL,
  `customer_voice_limit` tinyint(4) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime DEFAULT NULL,
  `uniqueid` varchar(30) DEFAULT NULL,
  `agent_number` varchar(30) DEFAULT NULL,
  `agent_name` varchar(30) DEFAULT NULL,
  `caller_number` varchar(30) DEFAULT NULL,
  `caller_name` varchar(30) DEFAULT NULL,
  `survey_value` varchar(5) DEFAULT NULL,
  `survey_location` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_voice_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'data_types','display_name_singular',5,'pt','Post','2018-08-06 02:20:41','2018-08-06 02:20:41'),(2,'data_types','display_name_singular',6,'pt','Página','2018-08-06 02:20:41','2018-08-06 02:20:41'),(3,'data_types','display_name_singular',1,'pt','Utilizador','2018-08-06 02:20:41','2018-08-06 02:20:41'),(4,'data_types','display_name_singular',4,'pt','Categoria','2018-08-06 02:20:41','2018-08-06 02:20:41'),(5,'data_types','display_name_singular',2,'pt','Menu','2018-08-06 02:20:41','2018-08-06 02:20:41'),(6,'data_types','display_name_singular',3,'pt','Função','2018-08-06 02:20:41','2018-08-06 02:20:41'),(7,'data_types','display_name_plural',5,'pt','Posts','2018-08-06 02:20:41','2018-08-06 02:20:41'),(8,'data_types','display_name_plural',6,'pt','Páginas','2018-08-06 02:20:41','2018-08-06 02:20:41'),(9,'data_types','display_name_plural',1,'pt','Utilizadores','2018-08-06 02:20:41','2018-08-06 02:20:41'),(10,'data_types','display_name_plural',4,'pt','Categorias','2018-08-06 02:20:41','2018-08-06 02:20:41'),(11,'data_types','display_name_plural',2,'pt','Menus','2018-08-06 02:20:42','2018-08-06 02:20:42'),(12,'data_types','display_name_plural',3,'pt','Funções','2018-08-06 02:20:42','2018-08-06 02:20:42'),(13,'categories','slug',1,'pt','categoria-1','2018-08-06 02:20:42','2018-08-06 02:20:42'),(14,'categories','name',1,'pt','Categoria 1','2018-08-06 02:20:42','2018-08-06 02:20:42'),(15,'categories','slug',2,'pt','categoria-2','2018-08-06 02:20:42','2018-08-06 02:20:42'),(16,'categories','name',2,'pt','Categoria 2','2018-08-06 02:20:42','2018-08-06 02:20:42'),(17,'pages','title',1,'pt','Olá Mundo','2018-08-06 02:20:42','2018-08-06 02:20:42'),(18,'pages','slug',1,'pt','ola-mundo','2018-08-06 02:20:42','2018-08-06 02:20:42'),(19,'pages','body',1,'pt','<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','2018-08-06 02:20:42','2018-08-06 02:20:42'),(20,'menu_items','title',1,'pt','Painel de Controle','2018-08-06 02:20:42','2018-08-06 02:20:42'),(21,'menu_items','title',2,'pt','Media','2018-08-06 02:20:42','2018-08-06 02:20:42'),(22,'menu_items','title',12,'pt','Publicações','2018-08-06 02:20:42','2018-08-06 02:20:42'),(23,'menu_items','title',3,'pt','Utilizadores','2018-08-06 02:20:42','2018-08-06 02:20:42'),(24,'menu_items','title',11,'pt','Categorias','2018-08-06 02:20:42','2018-08-06 02:20:42'),(25,'menu_items','title',13,'pt','Páginas','2018-08-06 02:20:42','2018-08-06 02:20:42'),(26,'menu_items','title',4,'pt','Funções','2018-08-06 02:20:42','2018-08-06 02:20:42'),(27,'menu_items','title',5,'pt','Ferramentas','2018-08-06 02:20:42','2018-08-06 02:20:42'),(28,'menu_items','title',6,'pt','Menus','2018-08-06 02:20:42','2018-08-06 02:20:42'),(29,'menu_items','title',7,'pt','Base de dados','2018-08-06 02:20:42','2018-08-06 02:20:42'),(30,'menu_items','title',10,'pt','Configurações','2018-08-06 02:20:42','2018-08-06 02:20:42'),(31,'menu_items','title',1,'en','dashboard','2018-11-04 18:41:32','2018-11-04 18:41:32'),(32,'menu_items','title',4,'en','Roles','2018-11-04 18:42:03','2018-11-04 18:42:03'),(33,'menu_items','title',3,'en','Users','2018-11-04 18:42:37','2018-11-04 18:42:37'),(34,'menu_items','title',2,'en','Media','2018-11-04 18:42:51','2018-11-04 18:42:51'),(35,'menu_items','title',12,'en','Posts','2018-11-04 18:43:04','2018-11-04 18:43:04'),(36,'menu_items','title',13,'en','Pages','2018-11-04 18:43:20','2018-11-04 18:43:20'),(37,'menu_items','title',11,'en','Categories','2018-11-04 18:43:34','2018-11-04 18:43:34'),(38,'menu_items','title',5,'en','Tools','2018-11-04 18:43:47','2018-11-04 18:43:47'),(39,'menu_items','title',6,'en','Menu Builder','2018-11-04 18:44:02','2018-11-04 18:44:02'),(40,'menu_items','title',7,'en','Database','2018-11-04 18:44:16','2018-11-04 18:44:16'),(41,'menu_items','title',8,'en','Compass','2018-11-04 18:44:34','2018-11-04 18:44:34'),(42,'menu_items','title',9,'en','BREAD','2018-11-04 20:58:28','2018-11-04 20:58:28'),(43,'menu_items','title',14,'en','Hooks','2018-11-04 20:58:47','2018-11-04 20:58:47'),(44,'menu_items','title',10,'en','Settings','2018-11-04 20:59:01','2018-11-04 20:59:01'),(48,'data_types','display_name_singular',1,'en','User','2018-11-06 12:45:24','2018-11-06 12:45:24'),(49,'data_types','display_name_plural',1,'en','Users','2018-11-06 12:45:24','2018-11-06 12:45:24'),(50,'menu_items','title',17,'en','Settings','2018-11-08 06:30:59','2018-11-08 06:30:59'),(51,'menu_items','title',18,'en','survey','2018-11-08 14:20:42','2018-11-08 14:20:42'),(52,'menu_items','title',19,'en','operators','2018-11-11 11:50:01','2018-11-11 11:50:01');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Mitis','','Mirza','mahdi064@gmail.com','users\\November2018\\HbvheuMlPryP1saLzIKv.jpg','$2y$10$mLhygN9j87WlCGd78DRtKuE.k4obrkiIY/kNLRjB3.PSwXaq1nZRi','bmD4kSt5JIX0FrmeaO2HBKiuYLEAXSXn9x9oHH0VwaRw0O5kclDR6lwEcNEq','{\"locale\":\"fa\"}','2018-08-06 02:20:41','2018-11-10 23:37:33'),(3,3,'حامد','','فلاح','hamedkouhfallah@gmail.com','users\\November2018\\6zrQVUeQSsbxJPGIQuh7.png','$2y$10$E9.mcZq3fuj6IiNBIb2mdOZeEGdVOOE.ATR8hlRMWLibHemUgAqfy','9gU755E36mxKnlqL4lw2NtMes2x5lZV1P6mHwhNCFsoN4f4hSGJW2jAa7bPm',NULL,'2018-11-06 13:01:55','2018-11-07 05:50:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'visurvey'
--

--
-- Dumping routines for database 'visurvey'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-08 10:33:34
