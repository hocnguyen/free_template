/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.14 : Database - clickshareall
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`clickshareall` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `clickshareall`;

/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `type` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `filename` varchar(255) CHARACTER SET latin1 NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `link` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `is_order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `banners` */

LOCK TABLES `banners` WRITE;

insert  into `banners`(`id`,`name`,`position`,`type`,`is_active`,`filename`,`content`,`link`,`is_order`,`created`,`updated`) values (1,'macbook','2',1,1,'2209-ads18.jpg','','/category/10-electronics',2,'2017-03-17 15:05:49','2017-04-11 16:06:52'),(2,'sale','2',1,1,'4923-ads17.jpg','','/category/5-smartphone-tablets',1,'2017-03-17 15:22:39','2017-04-11 16:07:23'),(3,'Advertise right','3',1,1,'1439-clickbuyall-advertising.png','','/category/9-automotive-motorcyle',3,'2017-04-11 15:32:17','2017-04-11 16:03:29');

UNLOCK TABLES;

/*Table structure for table `banners_category` */

DROP TABLE IF EXISTS `banners_category`;

CREATE TABLE `banners_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` int(1) DEFAULT '1',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `banners_category` */

LOCK TABLES `banners_category` WRITE;

UNLOCK TABLES;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_hot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_hot` int(1) DEFAULT '0',
  `parent_id` int(11) DEFAULT '0',
  `is_display` int(1) DEFAULT '0',
  `is_order` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categories` */

LOCK TABLES `categories` WRITE;

insert  into `categories`(`id`,`name`,`image`,`image_hot`,`is_hot`,`parent_id`,`is_display`,`is_order`,`created`,`updated`) values (1,'Templates','','',1,0,1,1,'2017-06-09 10:03:05','2017-06-09 10:03:05'),(2,'Ecommerce','','',1,0,1,2,'2017-06-09 10:03:38','2017-06-09 10:03:38'),(3,'Apps & Mobile','','',1,0,1,3,'2017-06-09 10:03:59','2017-06-09 10:03:59'),(4,'Others','','',1,0,1,4,'2017-06-09 10:04:19','2017-06-09 10:04:19'),(5,'HTML/CSS Templates','','',1,1,1,5,'2017-06-09 10:05:27','2017-06-09 10:05:27'),(6,'Wordpress Templates','','',1,1,1,6,'2017-06-09 10:06:08','2017-06-09 10:06:08'),(7,'Joomla Templates','','',1,1,1,7,'2017-06-09 10:06:27','2017-06-09 10:06:27'),(8,'Oscommerce','','',1,1,1,8,'2017-06-09 10:07:00','2017-06-09 10:07:00'),(9,'Magento','','',1,2,1,9,'2017-06-09 10:13:53','2017-06-09 10:13:53'),(10,'OpenCart','','',1,2,1,10,'2017-06-09 10:14:15','2017-06-09 10:14:15'),(11,'Zencart','','',1,2,1,11,'2017-06-09 10:14:44','2017-06-09 10:14:44'),(12,'Prestashop','','',1,2,1,12,'2017-06-09 10:15:22','2017-06-09 10:15:22'),(13,'Blogger Templates','','',1,4,1,13,'2017-06-09 10:17:03','2017-06-09 10:17:03'),(14,'PSD Templates','','',1,4,1,14,'2017-06-09 10:17:25','2017-06-09 10:17:25');

UNLOCK TABLES;

/*Table structure for table `category_post` */

DROP TABLE IF EXISTS `category_post`;

CREATE TABLE `category_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `category_post` */

LOCK TABLES `category_post` WRITE;

insert  into `category_post`(`id`,`name`,`is_status`,`created`,`updated`) values (1,'Corporate IT',1,'2017-02-28 10:13:23','2017-03-24 15:53:02'),(2,'B2B Sales',1,'2017-02-28 10:13:38','2017-03-24 14:48:40'),(3,'IT Project Management',1,'2017-03-24 14:36:23','2017-03-24 14:49:28'),(4,'IT Applications',1,'2017-03-24 14:55:12','2017-03-24 14:55:12'),(5,'Customer Service',1,'2017-03-24 14:56:11','2017-03-24 14:56:11');

UNLOCK TABLES;

/*Table structure for table `compares` */

DROP TABLE IF EXISTS `compares`;

CREATE TABLE `compares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `compares_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `compares` */

LOCK TABLES `compares` WRITE;

UNLOCK TABLES;

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `id_read` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `contacts` */

LOCK TABLES `contacts` WRITE;

insert  into `contacts`(`id`,`title`,`email`,`message`,`id_read`,`created`,`updated`) values (1,'How do you can build this website?','jason@gmail.com','<p>I interested this website. Great!</p>\r\n',0,'2017-02-16 15:29:33','2017-02-16 15:29:33'),(2,'How did you do?','terry@gmail.com','<p>Perfect!</p>\r\n',1,'2017-02-16 15:49:50','2017-02-16 15:49:50'),(3,'Nice to meet you!','kevin@gmail.com','Great Idea',0,'2017-03-05 04:06:21','2017-03-05 04:06:21'),(4,'Nice to meet you!','kevin@gmail.com','Great Idea',0,'2017-03-05 04:08:33','2017-03-05 04:08:33'),(5,'Vinh Tran','kevin@gmail.com','Great Idea',0,'2017-03-05 04:14:16','2017-03-05 04:14:16'),(6,'Nice to meet you!','kevin@gmail.com','Great Idea',0,'2017-03-05 04:19:23','2017-03-05 04:19:23'),(7,'Vinh Tran','kevin@gmail.com','Great Idea',0,'2017-03-05 04:21:49','2017-03-05 04:21:49'),(8,'Kevin','Kevin','Hi, Nice to meet you!',1,'2017-03-05 04:31:47','2017-03-05 04:31:47'),(9,'Joinathan','Joinathan@gmail.com','Great',0,'2017-03-05 04:34:48','2017-03-05 04:34:48'),(10,'Vinh Tran','kevin@gmail.com','<p>Great Idea.&nbsp;I&#39;m looking for a way to limit a string in php and add on.&nbsp;at the end if the string was too long. thanks you.</p>\r\n',1,'2017-03-05 05:11:25','2017-03-15 07:33:58'),(11,'Tommy Vin','nguyennhuynhikt@gmail.com','Hi, How do you feel today.',1,'2017-03-27 04:02:05','2017-03-27 04:02:05');

UNLOCK TABLES;

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryCode` char(2) NOT NULL,
  `countryName` varchar(45) NOT NULL,
  `currencyCode` char(3) DEFAULT NULL,
  `population` varchar(20) DEFAULT NULL,
  `isoNumeric` char(4) DEFAULT NULL,
  `languages` varchar(100) DEFAULT NULL,
  `isoAlpha3` char(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=252 DEFAULT CHARSET=utf8;

/*Data for the table `countries` */

LOCK TABLES `countries` WRITE;

insert  into `countries`(`id`,`countryCode`,`countryName`,`currencyCode`,`population`,`isoNumeric`,`languages`,`isoAlpha3`,`created`,`updated`) values (1,'AD','Andorra','EUR','84000','020','ca','AND','2017-02-19 10:05:31','2017-02-19 10:05:31'),(2,'AE','United Arab Emirates','AED','4975593','784','ar-AE,fa,en,hi,ur','ARE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(3,'AF','Afghanistan','AFN','29121286','004','fa-AF,ps,uz-AF,tk','AFG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(4,'AG','Antigua and Barbuda','XCD','86754','028','en-AG','ATG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(5,'AI','Anguilla','XCD','13254','660','en-AI','AIA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(6,'AL','Albania','ALL','2986952','008','sq,el','ALB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(7,'AM','Armenia','AMD','2968000','051','hy','ARM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(8,'AO','Angola','AOA','13068161','024','pt-AO','AGO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(9,'AQ','Antarctica','','0','010','','ATA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(10,'AR','Argentina','ARS','41343201','032','es-AR,en,it,de,fr,gn','ARG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(11,'AS','American Samoa','USD','57881','016','en-AS,sm,to','ASM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(12,'AT','Austria','EUR','8205000','040','de-AT,hr,hu,sl','AUT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(13,'AU','Australia','AUD','21515754','036','en-AU','AUS','2017-02-19 10:05:31','2017-02-19 10:05:31'),(14,'AW','Aruba','AWG','71566','533','nl-AW,pap,es,en','ABW','2017-02-19 10:05:31','2017-02-19 10:05:31'),(15,'AX','Åland','EUR','26711','248','sv-AX','ALA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(16,'AZ','Azerbaijan','AZN','8303512','031','az,ru,hy','AZE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(17,'BA','Bosnia and Herzegovina','BAM','4590000','070','bs,hr-BA,sr-BA','BIH','2017-02-19 10:05:31','2017-02-19 10:05:31'),(18,'BB','Barbados','BBD','285653','052','en-BB','BRB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(19,'BD','Bangladesh','BDT','156118464','050','bn-BD,en','BGD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(20,'BE','Belgium','EUR','10403000','056','nl-BE,fr-BE,de-BE','BEL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(21,'BF','Burkina Faso','XOF','16241811','854','fr-BF,mos','BFA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(22,'BG','Bulgaria','BGN','7148785','100','bg,tr-BG,rom','BGR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(23,'BH','Bahrain','BHD','738004','048','ar-BH,en,fa,ur','BHR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(24,'BI','Burundi','BIF','9863117','108','fr-BI,rn','BDI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(25,'BJ','Benin','XOF','9056010','204','fr-BJ','BEN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(26,'BL','Saint Barthélemy','EUR','8450','652','fr','BLM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(27,'BM','Bermuda','BMD','65365','060','en-BM,pt','BMU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(28,'BN','Brunei','BND','395027','096','ms-BN,en-BN','BRN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(29,'BO','Bolivia','BOB','9947418','068','es-BO,qu,ay','BOL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(30,'BQ','Bonaire','USD','18012','535','nl,pap,en','BES','2017-02-19 10:05:31','2017-02-19 10:05:31'),(31,'BR','Brazil','BRL','201103330','076','pt-BR,es,en,fr','BRA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(32,'BS','Bahamas','BSD','301790','044','en-BS','BHS','2017-02-19 10:05:31','2017-02-19 10:05:31'),(33,'BT','Bhutan','BTN','699847','064','dz','BTN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(34,'BV','Bouvet Island','NOK','0','074','','BVT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(35,'BW','Botswana','BWP','2029307','072','en-BW,tn-BW','BWA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(36,'BY','Belarus','BYR','9685000','112','be,ru','BLR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(37,'BZ','Belize','BZD','314522','084','en-BZ,es','BLZ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(38,'CA','Canada','CAD','33679000','124','en-CA,fr-CA,iu','CAN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(39,'CC','Cocos [Keeling] Islands','AUD','628','166','ms-CC,en','CCK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(40,'CD','Democratic Republic of the Congo','CDF','70916439','180','fr-CD,ln,ktu,kg,sw,lua','COD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(41,'CF','Central African Republic','XAF','4844927','140','fr-CF,sg,ln,kg','CAF','2017-02-19 10:05:31','2017-02-19 10:05:31'),(42,'CG','Republic of the Congo','XAF','3039126','178','fr-CG,kg,ln-CG','COG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(43,'CH','Switzerland','CHF','7581000','756','de-CH,fr-CH,it-CH,rm','CHE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(44,'CI','Ivory Coast','XOF','21058798','384','fr-CI','CIV','2017-02-19 10:05:31','2017-02-19 10:05:31'),(45,'CK','Cook Islands','NZD','21388','184','en-CK,mi','COK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(46,'CL','Chile','CLP','16746491','152','es-CL','CHL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(47,'CM','Cameroon','XAF','19294149','120','en-CM,fr-CM','CMR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(48,'CN','China','CNY','1330044000','156','zh-CN,yue,wuu,dta,ug,za','CHN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(49,'CO','Colombia','COP','47790000','170','es-CO','COL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(50,'CR','Costa Rica','CRC','4516220','188','es-CR,en','CRI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(51,'CU','Cuba','CUP','11423000','192','es-CU,pap','CUB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(52,'CV','Cape Verde','CVE','508659','132','pt-CV','CPV','2017-02-19 10:05:31','2017-02-19 10:05:31'),(53,'CW','Curacao','ANG','141766','531','nl,pap','CUW','2017-02-19 10:05:31','2017-02-19 10:05:31'),(54,'CX','Christmas Island','AUD','1500','162','en,zh,ms-CC','CXR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(55,'CY','Cyprus','EUR','1102677','196','el-CY,tr-CY,en','CYP','2017-02-19 10:05:31','2017-02-19 10:05:31'),(56,'CZ','Czechia','CZK','10476000','203','cs,sk','CZE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(57,'DE','Germany','EUR','81802257','276','de','DEU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(58,'DJ','Djibouti','DJF','740528','262','fr-DJ,ar,so-DJ,aa','DJI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(59,'DK','Denmark','DKK','5484000','208','da-DK,en,fo,de-DK','DNK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(60,'DM','Dominica','XCD','72813','212','en-DM','DMA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(61,'DO','Dominican Republic','DOP','9823821','214','es-DO','DOM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(62,'DZ','Algeria','DZD','34586184','012','ar-DZ','DZA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(63,'EC','Ecuador','USD','14790608','218','es-EC','ECU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(64,'EE','Estonia','EUR','1291170','233','et,ru','EST','2017-02-19 10:05:31','2017-02-19 10:05:31'),(65,'EG','Egypt','EGP','80471869','818','ar-EG,en,fr','EGY','2017-02-19 10:05:31','2017-02-19 10:05:31'),(66,'EH','Western Sahara','MAD','273008','732','ar,mey','ESH','2017-02-19 10:05:31','2017-02-19 10:05:31'),(67,'ER','Eritrea','ERN','5792984','232','aa-ER,ar,tig,kun,ti-ER','ERI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(68,'ES','Spain','EUR','46505963','724','es-ES,ca,gl,eu,oc','ESP','2017-02-19 10:05:31','2017-02-19 10:05:31'),(69,'ET','Ethiopia','ETB','88013491','231','am,en-ET,om-ET,ti-ET,so-ET,sid','ETH','2017-02-19 10:05:31','2017-02-19 10:05:31'),(70,'FI','Finland','EUR','5244000','246','fi-FI,sv-FI,smn','FIN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(71,'FJ','Fiji','FJD','875983','242','en-FJ,fj','FJI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(72,'FK','Falkland Islands','FKP','2638','238','en-FK','FLK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(73,'FM','Micronesia','USD','107708','583','en-FM,chk,pon,yap,kos,uli,woe,nkr,kpg','FSM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(74,'FO','Faroe Islands','DKK','48228','234','fo,da-FO','FRO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(75,'FR','France','EUR','64768389','250','fr-FR,frp,br,co,ca,eu,oc','FRA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(76,'GA','Gabon','XAF','1545255','266','fr-GA','GAB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(77,'GB','United Kingdom','GBP','62348447','826','en-GB,cy-GB,gd','GBR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(78,'GD','Grenada','XCD','107818','308','en-GD','GRD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(79,'GE','Georgia','GEL','4630000','268','ka,ru,hy,az','GEO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(80,'GF','French Guiana','EUR','195506','254','fr-GF','GUF','2017-02-19 10:05:31','2017-02-19 10:05:31'),(81,'GG','Guernsey','GBP','65228','831','en,nrf','GGY','2017-02-19 10:05:31','2017-02-19 10:05:31'),(82,'GH','Ghana','GHS','24339838','288','en-GH,ak,ee,tw','GHA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(83,'GI','Gibraltar','GIP','27884','292','en-GI,es,it,pt','GIB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(84,'GL','Greenland','DKK','56375','304','kl,da-GL,en','GRL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(85,'GM','Gambia','GMD','1593256','270','en-GM,mnk,wof,wo,ff','GMB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(86,'GN','Guinea','GNF','10324025','324','fr-GN','GIN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(87,'GP','Guadeloupe','EUR','443000','312','fr-GP','GLP','2017-02-19 10:05:31','2017-02-19 10:05:31'),(88,'GQ','Equatorial Guinea','XAF','1014999','226','es-GQ,fr','GNQ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(89,'GR','Greece','EUR','11000000','300','el-GR,en,fr','GRC','2017-02-19 10:05:31','2017-02-19 10:05:31'),(90,'GS','South Georgia and the South Sandwich Islands','GBP','30','239','en','SGS','2017-02-19 10:05:31','2017-02-19 10:05:31'),(91,'GT','Guatemala','GTQ','13550440','320','es-GT','GTM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(92,'GU','Guam','USD','159358','316','en-GU,ch-GU','GUM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(93,'GW','Guinea-Bissau','XOF','1565126','624','pt-GW,pov','GNB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(94,'GY','Guyana','GYD','748486','328','en-GY','GUY','2017-02-19 10:05:31','2017-02-19 10:05:31'),(95,'HK','Hong Kong','HKD','6898686','344','zh-HK,yue,zh,en','HKG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(96,'HM','Heard Island and McDonald Islands','AUD','0','334','','HMD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(97,'HN','Honduras','HNL','7989415','340','es-HN,cab,miq','HND','2017-02-19 10:05:31','2017-02-19 10:05:31'),(98,'HR','Croatia','HRK','4284889','191','hr-HR,sr','HRV','2017-02-19 10:05:31','2017-02-19 10:05:31'),(99,'HT','Haiti','HTG','9648924','332','ht,fr-HT','HTI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(100,'HU','Hungary','HUF','9982000','348','hu-HU','HUN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(101,'ID','Indonesia','IDR','242968342','360','id,en,nl,jv','IDN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(102,'IE','Ireland','EUR','4622917','372','en-IE,ga-IE','IRL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(103,'IL','Israel','ILS','7353985','376','he,ar-IL,en-IL,','ISR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(104,'IM','Isle of Man','GBP','75049','833','en,gv','IMN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(105,'IN','India','INR','1173108018','356','en-IN,hi,bn,te,mr,ta,ur,gu,kn,ml,or,pa,as,bh,sat,ks,ne,sd,kok,doi,mni,sit,sa,fr,lus,inc','IND','2017-02-19 10:05:31','2017-02-19 10:05:31'),(106,'IO','British Indian Ocean Territory','USD','4000','086','en-IO','IOT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(107,'IQ','Iraq','IQD','29671605','368','ar-IQ,ku,hy','IRQ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(108,'IR','Iran','IRR','76923300','364','fa-IR,ku','IRN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(109,'IS','Iceland','ISK','308910','352','is,en,de,da,sv,no','ISL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(110,'IT','Italy','EUR','60340328','380','it-IT,de-IT,fr-IT,sc,ca,co,sl','ITA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(111,'JE','Jersey','GBP','90812','832','en,fr,nrf','JEY','2017-02-19 10:05:31','2017-02-19 10:05:31'),(112,'JM','Jamaica','JMD','2847232','388','en-JM','JAM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(113,'JO','Jordan','JOD','6407085','400','ar-JO,en','JOR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(114,'JP','Japan','JPY','127288000','392','ja','JPN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(115,'KE','Kenya','KES','40046566','404','en-KE,sw-KE','KEN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(116,'KG','Kyrgyzstan','KGS','5776500','417','ky,uz,ru','KGZ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(117,'KH','Cambodia','KHR','14453680','116','km,fr,en','KHM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(118,'KI','Kiribati','AUD','92533','296','en-KI,gil','KIR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(119,'KM','Comoros','KMF','773407','174','ar,fr-KM','COM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(120,'KN','Saint Kitts and Nevis','XCD','51134','659','en-KN','KNA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(121,'KP','North Korea','KPW','22912177','408','ko-KP','PRK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(122,'KR','South Korea','KRW','48422644','410','ko-KR,en','KOR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(123,'KW','Kuwait','KWD','2789132','414','ar-KW,en','KWT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(124,'KY','Cayman Islands','KYD','44270','136','en-KY','CYM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(125,'KZ','Kazakhstan','KZT','15340000','398','kk,ru','KAZ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(126,'LA','Laos','LAK','6368162','418','lo,fr,en','LAO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(127,'LB','Lebanon','LBP','4125247','422','ar-LB,fr-LB,en,hy','LBN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(128,'LC','Saint Lucia','XCD','160922','662','en-LC','LCA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(129,'LI','Liechtenstein','CHF','35000','438','de-LI','LIE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(130,'LK','Sri Lanka','LKR','21513990','144','si,ta,en','LKA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(131,'LR','Liberia','LRD','3685076','430','en-LR','LBR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(132,'LS','Lesotho','LSL','1919552','426','en-LS,st,zu,xh','LSO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(133,'LT','Lithuania','EUR','2944459','440','lt,ru,pl','LTU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(134,'LU','Luxembourg','EUR','497538','442','lb,de-LU,fr-LU','LUX','2017-02-19 10:05:31','2017-02-19 10:05:31'),(135,'LV','Latvia','EUR','2217969','428','lv,ru,lt','LVA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(136,'LY','Libya','LYD','6461454','434','ar-LY,it,en','LBY','2017-02-19 10:05:31','2017-02-19 10:05:31'),(137,'MA','Morocco','MAD','33848242','504','ar-MA,ber,fr','MAR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(138,'MC','Monaco','EUR','32965','492','fr-MC,en,it','MCO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(139,'MD','Moldova','MDL','4324000','498','ro,ru,gag,tr','MDA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(140,'ME','Montenegro','EUR','666730','499','sr,hu,bs,sq,hr,rom','MNE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(141,'MF','Saint Martin','EUR','35925','663','fr','MAF','2017-02-19 10:05:31','2017-02-19 10:05:31'),(142,'MG','Madagascar','MGA','21281844','450','fr-MG,mg','MDG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(143,'MH','Marshall Islands','USD','65859','584','mh,en-MH','MHL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(144,'MK','Macedonia','MKD','2062294','807','mk,sq,tr,rmm,sr','MKD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(145,'ML','Mali','XOF','13796354','466','fr-ML,bm','MLI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(146,'MM','Myanmar [Burma]','MMK','53414374','104','my','MMR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(147,'MN','Mongolia','MNT','3086918','496','mn,ru','MNG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(148,'MO','Macao','MOP','449198','446','zh,zh-MO,pt','MAC','2017-02-19 10:05:31','2017-02-19 10:05:31'),(149,'MP','Northern Mariana Islands','USD','53883','580','fil,tl,zh,ch-MP,en-MP','MNP','2017-02-19 10:05:31','2017-02-19 10:05:31'),(150,'MQ','Martinique','EUR','432900','474','fr-MQ','MTQ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(151,'MR','Mauritania','MRO','3205060','478','ar-MR,fuc,snk,fr,mey,wo','MRT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(152,'MS','Montserrat','XCD','9341','500','en-MS','MSR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(153,'MT','Malta','EUR','403000','470','mt,en-MT','MLT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(154,'MU','Mauritius','MUR','1294104','480','en-MU,bho,fr','MUS','2017-02-19 10:05:31','2017-02-19 10:05:31'),(155,'MV','Maldives','MVR','395650','462','dv,en','MDV','2017-02-19 10:05:31','2017-02-19 10:05:31'),(156,'MW','Malawi','MWK','15447500','454','ny,yao,tum,swk','MWI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(157,'MX','Mexico','MXN','112468855','484','es-MX','MEX','2017-02-19 10:05:31','2017-02-19 10:05:31'),(158,'MY','Malaysia','MYR','28274729','458','ms-MY,en,zh,ta,te,ml,pa,th','MYS','2017-02-19 10:05:31','2017-02-19 10:05:31'),(159,'MZ','Mozambique','MZN','22061451','508','pt-MZ,vmw','MOZ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(160,'NA','Namibia','NAD','2128471','516','en-NA,af,de,hz,naq','NAM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(161,'NC','New Caledonia','XPF','216494','540','fr-NC','NCL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(162,'NE','Niger','XOF','15878271','562','fr-NE,ha,kr,dje','NER','2017-02-19 10:05:31','2017-02-19 10:05:31'),(163,'NF','Norfolk Island','AUD','1828','574','en-NF','NFK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(164,'NG','Nigeria','NGN','154000000','566','en-NG,ha,yo,ig,ff','NGA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(165,'NI','Nicaragua','NIO','5995928','558','es-NI,en','NIC','2017-02-19 10:05:31','2017-02-19 10:05:31'),(166,'NL','Netherlands','EUR','16645000','528','nl-NL,fy-NL','NLD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(167,'NO','Norway','NOK','5009150','578','no,nb,nn,se,fi','NOR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(168,'NP','Nepal','NPR','28951852','524','ne,en','NPL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(169,'NR','Nauru','AUD','10065','520','na,en-NR','NRU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(170,'NU','Niue','NZD','2166','570','niu,en-NU','NIU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(171,'NZ','New Zealand','NZD','4252277','554','en-NZ,mi','NZL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(172,'OM','Oman','OMR','2967717','512','ar-OM,en,bal,ur','OMN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(173,'PA','Panama','PAB','3410676','591','es-PA,en','PAN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(174,'PE','Peru','PEN','29907003','604','es-PE,qu,ay','PER','2017-02-19 10:05:31','2017-02-19 10:05:31'),(175,'PF','French Polynesia','XPF','270485','258','fr-PF,ty','PYF','2017-02-19 10:05:31','2017-02-19 10:05:31'),(176,'PG','Papua New Guinea','PGK','6064515','598','en-PG,ho,meu,tpi','PNG','2017-02-19 10:05:31','2017-02-19 10:05:31'),(177,'PH','Philippines','PHP','99900177','608','tl,en-PH,fil,ceb,tgl,ilo,hil,war,pam,bik,bcl,pag,mrw,tsg,mdh,cbk,krj,sgd,msb,akl,ibg,yka,mta,abx','PHL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(178,'PK','Pakistan','PKR','184404791','586','ur-PK,en-PK,pa,sd,ps,brh','PAK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(179,'PL','Poland','PLN','38500000','616','pl','POL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(180,'PM','Saint Pierre and Miquelon','EUR','7012','666','fr-PM','SPM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(181,'PN','Pitcairn Islands','NZD','46','612','en-PN','PCN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(182,'PR','Puerto Rico','USD','3916632','630','en-PR,es-PR','PRI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(183,'PS','Palestine','ILS','3800000','275','ar-PS','PSE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(184,'PT','Portugal','EUR','10676000','620','pt-PT,mwl','PRT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(185,'PW','Palau','USD','19907','585','pau,sov,en-PW,tox,ja,fil,zh','PLW','2017-02-19 10:05:31','2017-02-19 10:05:31'),(186,'PY','Paraguay','PYG','6375830','600','es-PY,gn','PRY','2017-02-19 10:05:31','2017-02-19 10:05:31'),(187,'QA','Qatar','QAR','840926','634','ar-QA,es','QAT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(188,'RE','Réunion','EUR','776948','638','fr-RE','REU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(189,'RO','Romania','RON','21959278','642','ro,hu,rom','ROU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(190,'RS','Serbia','RSD','7344847','688','sr,hu,bs,rom','SRB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(191,'RU','Russia','RUB','140702000','643','ru,tt,xal,cau,ady,kv,ce,tyv,cv,udm,tut,mns,bua,myv,mdf,chm,ba,inh,tut,kbd,krc,ava,sah,nog','RUS','2017-02-19 10:05:31','2017-02-19 10:05:31'),(192,'RW','Rwanda','RWF','11055976','646','rw,en-RW,fr-RW,sw','RWA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(193,'SA','Saudi Arabia','SAR','25731776','682','ar-SA','SAU','2017-02-19 10:05:31','2017-02-19 10:05:31'),(194,'SB','Solomon Islands','SBD','559198','090','en-SB,tpi','SLB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(195,'SC','Seychelles','SCR','88340','690','en-SC,fr-SC','SYC','2017-02-19 10:05:31','2017-02-19 10:05:31'),(196,'SD','Sudan','SDG','35000000','729','ar-SD,en,fia','SDN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(197,'SE','Sweden','SEK','9828655','752','sv-SE,se,sma,fi-SE','SWE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(198,'SG','Singapore','SGD','4701069','702','cmn,en-SG,ms-SG,ta-SG,zh-SG','SGP','2017-02-19 10:05:31','2017-02-19 10:05:31'),(199,'SH','Saint Helena','SHP','7460','654','en-SH','SHN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(200,'SI','Slovenia','EUR','2007000','705','sl,sh','SVN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(201,'SJ','Svalbard and Jan Mayen','NOK','2550','744','no,ru','SJM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(202,'SK','Slovakia','EUR','5455000','703','sk,hu','SVK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(203,'SL','Sierra Leone','SLL','5245695','694','en-SL,men,tem','SLE','2017-02-19 10:05:31','2017-02-19 10:05:31'),(204,'SM','San Marino','EUR','31477','674','it-SM','SMR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(205,'SN','Senegal','XOF','12323252','686','fr-SN,wo,fuc,mnk','SEN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(206,'SO','Somalia','SOS','10112453','706','so-SO,ar-SO,it,en-SO','SOM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(207,'SR','Suriname','SRD','492829','740','nl-SR,en,srn,hns,jv','SUR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(208,'SS','South Sudan','SSP','8260490','728','en','SSD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(209,'ST','São Tomé and Príncipe','STD','175808','678','pt-ST','STP','2017-02-19 10:05:31','2017-02-19 10:05:31'),(210,'SV','El Salvador','USD','6052064','222','es-SV','SLV','2017-02-19 10:05:31','2017-02-19 10:05:31'),(211,'SX','Sint Maarten','ANG','37429','534','nl,en','SXM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(212,'SY','Syria','SYP','22198110','760','ar-SY,ku,hy,arc,fr,en','SYR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(213,'SZ','Swaziland','SZL','1354051','748','en-SZ,ss-SZ','SWZ','2017-02-19 10:05:31','2017-02-19 10:05:31'),(214,'TC','Turks and Caicos Islands','USD','20556','796','en-TC','TCA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(215,'TD','Chad','XAF','10543464','148','fr-TD,ar-TD,sre','TCD','2017-02-19 10:05:31','2017-02-19 10:05:31'),(216,'TF','French Southern Territories','EUR','140','260','fr','ATF','2017-02-19 10:05:31','2017-02-19 10:05:31'),(217,'TG','Togo','XOF','6587239','768','fr-TG,ee,hna,kbp,dag,ha','TGO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(218,'TH','Thailand','THB','67089500','764','th,en','THA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(219,'TJ','Tajikistan','TJS','7487489','762','tg,ru','TJK','2017-02-19 10:05:31','2017-02-19 10:05:31'),(220,'TK','Tokelau','NZD','1466','772','tkl,en-TK','TKL','2017-02-19 10:05:31','2017-02-19 10:05:31'),(221,'TL','East Timor','USD','1154625','626','tet,pt-TL,id,en','TLS','2017-02-19 10:05:31','2017-02-19 10:05:31'),(222,'TM','Turkmenistan','TMT','4940916','795','tk,ru,uz','TKM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(223,'TN','Tunisia','TND','10589025','788','ar-TN,fr','TUN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(224,'TO','Tonga','TOP','122580','776','to,en-TO','TON','2017-02-19 10:05:31','2017-02-19 10:05:31'),(225,'TR','Turkey','TRY','77804122','792','tr-TR,ku,diq,az,av','TUR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(226,'TT','Trinidad and Tobago','TTD','1228691','780','en-TT,hns,fr,es,zh','TTO','2017-02-19 10:05:31','2017-02-19 10:05:31'),(227,'TV','Tuvalu','AUD','10472','798','tvl,en,sm,gil','TUV','2017-02-19 10:05:31','2017-02-19 10:05:31'),(228,'TW','Taiwan','TWD','22894384','158','zh-TW,zh,nan,hak','TWN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(229,'TZ','Tanzania','TZS','41892895','834','sw-TZ,en,ar','TZA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(230,'UA','Ukraine','UAH','45415596','804','uk,ru-UA,rom,pl,hu','UKR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(231,'UG','Uganda','UGX','33398682','800','en-UG,lg,sw,ar','UGA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(232,'UM','U.S. Minor Outlying Islands','USD','0','581','en-UM','UMI','2017-02-19 10:05:31','2017-02-19 10:05:31'),(233,'US','United States','USD','310232863','840','en-US,es-US,haw,fr','USA','2017-02-19 10:05:31','2017-02-19 10:05:31'),(234,'UY','Uruguay','UYU','3477000','858','es-UY','URY','2017-02-19 10:05:31','2017-02-19 10:05:31'),(235,'UZ','Uzbekistan','UZS','27865738','860','uz,ru,tg','UZB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(236,'VA','Vatican City','EUR','921','336','la,it,fr','VAT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(237,'VC','Saint Vincent and the Grenadines','XCD','104217','670','en-VC,fr','VCT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(238,'VE','Venezuela','VEF','27223228','862','es-VE','VEN','2017-02-19 10:05:31','2017-02-19 10:05:31'),(239,'VG','British Virgin Islands','USD','21730','092','en-VG','VGB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(240,'VI','U.S. Virgin Islands','USD','108708','850','en-VI','VIR','2017-02-19 10:05:31','2017-02-19 10:05:31'),(241,'VN','Vietnam','VND','89571130','704','vi,en,fr,zh,km','VNM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(242,'VU','Vanuatu','VUV','221552','548','bi,en-VU,fr-VU','VUT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(243,'WF','Wallis and Futuna','XPF','16025','876','wls,fud,fr-WF','WLF','2017-02-19 10:05:31','2017-02-19 10:05:31'),(244,'WS','Samoa','WST','192001','882','sm,en-WS','WSM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(245,'XK','Kosovo','EUR','1800000','0','sq,sr','XKX','2017-02-19 10:05:31','2017-02-19 10:05:31'),(246,'YE','Yemen','YER','23495361','887','ar-YE','YEM','2017-02-19 10:05:31','2017-02-19 10:05:31'),(247,'YT','Mayotte','EUR','159042','175','fr-YT','MYT','2017-02-19 10:05:31','2017-02-19 10:05:31'),(248,'ZA','South Africa','ZAR','49000000','710','zu,xh,af,nso,en-ZA,tn,st,ts,ss,ve,nr','ZAF','2017-02-19 10:05:31','2017-02-19 10:05:31'),(249,'ZM','Zambia','ZMW','13460305','894','en-ZM,bem,loz,lun,lue,ny,toi','ZMB','2017-02-19 10:05:31','2017-02-19 10:05:31'),(250,'ZW','Zimbabwe','ZWL','13061000','716','en-ZW,sn,nr,nd','ZWE','2017-02-19 10:05:31','2017-02-19 10:05:31');

UNLOCK TABLES;

/*Table structure for table `html_pages` */

DROP TABLE IF EXISTS `html_pages`;

CREATE TABLE `html_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagecode` varchar(250) NOT NULL,
  `page_title` varchar(250) NOT NULL,
  `page_text` longtext NOT NULL,
  `is_status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pagecode` (`pagecode`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `html_pages` */

LOCK TABLES `html_pages` WRITE;

insert  into `html_pages`(`id`,`pagecode`,`page_title`,`page_text`,`is_status`,`created`,`updated`) values (1,'buyer_protection','Buyer Protection','<p>Protecting Your Purchase from Click to Delivery</p>\r\n\r\n<div class=\"row buyer-protection-main\">\r\n<div class=\"col-sm-6\">\r\n<h4>Full Refund if you don&#39;t receive your order</h4>\r\n\r\n<ul>\r\n	<li>You will get a full refund if your order does not arrive within the delivery time promised by the seller.</li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"col-sm-6\">\r\n<h4>Full or Partial Refund , if the item is not as described</h4>\r\n\r\n<ul>\r\n	<li>If your item is significantly different from the seller&rsquo;s product description, you can A: Return it and get a full refund, or B: Get a partial refund and keep the item.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<p><a href=\"/helpcenter/buyer_protection_guarantees\">Learn More</a></p>\r\n',1,'2017-03-31 08:28:19','2017-04-11 14:22:21'),(2,'seller_guarantees','Seller Guarantees','<table class=\"table table-bordered\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Return<br />\r\n			Policy</td>\r\n			<td>\r\n			<p>If the product you receive is not as described or low quality, the seller promises that you may return it before order completion (when you click &lsquo;Confirm Order Received&rsquo; or exceed confirmation timeframe), receive a full refund, and that the return shipping fee will be paid by the seller. Details of the shipping method and fee payment should be agreed with the seller in advance. Or, you can choose to keep the product and agree the refund amount directly with the seller.</p>\r\n\r\n			<p>long details</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Seller<br />\r\n			Service</td>\r\n			<td>\r\n			<ul>\r\n				<li><em>On-time Delivery</em>If you do not receive your purchase within 60 days, you can ask for a full refund before order completion (when you click &lsquo;Confirm Order Received&rsquo; or exceed confirmation timeframe).</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><a href=\"\">Detail</a></p>\r\n',1,'2017-03-31 08:36:24','2017-03-31 09:15:40'),(3,'product_feedback','Product feedback','<p><span style=\"font-size:12px\"><span style=\"font-family:arial,helvetica,sans-serif\">We&nbsp;are&nbsp;committed&nbsp;to&nbsp;providing&nbsp;you&nbsp;with&nbsp;the&nbsp;Best&nbsp;Customer&nbsp;Service&nbsp;and&nbsp;Quality&nbsp;Products</span></span></p>\r\n\r\n<p><span style=\"font-size:12px\"><span style=\"font-family:arial,helvetica,sans-serif\">When&nbsp;purchasing&nbsp;our&nbsp;product,&nbsp;the&nbsp;Buyer&nbsp;agrees&nbsp;to&nbsp;contact&nbsp;us&nbsp;in&nbsp;case&nbsp;of&nbsp;a&nbsp;negative&nbsp;</span></span></p>\r\n\r\n<p><span style=\"font-size:12px\"><span style=\"font-family:arial,helvetica,sans-serif\">experience&nbsp;prior&nbsp;to&nbsp;leaving&nbsp;a&nbsp;negative&nbsp;or&nbsp;a&nbsp;neutral&nbsp;feedback&nbsp;to&nbsp;give&nbsp;us&nbsp;an&nbsp;opportunity</span></span></p>\r\n\r\n<p><span style=\"font-size:12px\"><span style=\"font-family:arial,helvetica,sans-serif\">to&nbsp;fix&nbsp;the&nbsp;problem.&nbsp;</span></span></p>\r\n\r\n<p><span style=\"font-size:12px\"><span style=\"font-family:arial,helvetica,sans-serif\">Please&nbsp;leave&nbsp;us&nbsp;a &quot;<span style=\"color:#ff0000\">5&nbsp;Star&nbsp;Positive&nbsp;Feedbacks</span>&nbsp;&quot;&nbsp;if&nbsp;you&nbsp;are&nbsp;satisfied&nbsp;with&nbsp;your&nbsp;items&nbsp;when</span></span></p>\r\n\r\n<p><span style=\"font-family:arial,helvetica,sans-serif\"><span style=\"font-size:18.0px\"><span style=\"font-size:12px\">you received.&nbsp;We&nbsp;will&nbsp;gladly&nbsp;do&nbsp;the&nbsp;same&nbsp;for&nbsp;you.</span></span></span></p>\r\n',1,'2017-04-05 15:21:35','2017-04-05 15:21:35'),(4,'buyer_protection_guarantees','Buyer Protection Guarantees','<h2>What protections can I get and how it works?</h2>\r\n\r\n<p>Everyone who shops on Clickbuyall.com receives the following guarantees for each purchase:</p>\r\n\r\n<p>1.&nbsp;&nbsp;&nbsp; Full refund if you don&rsquo;t receive your order</p>\r\n\r\n<p>You will get a <em>full refund</em> if your order does not arrive within the delivery time promised by the seller.</p>\r\n\r\n<p>&nbsp;How it works:</p>\r\n\r\n<p>Sellers on Clickbuyall.com set a delivery time with a maximum of 60 days (90 days for deliveries to Russia). If you can prove that you did not receive your order within the stated delivery time, you will get a full refund.</p>\r\n\r\n<p>Full refunds are not available in the following circumstances:</p>\r\n\r\n<p>&middot;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order did not arrive due to factors within your control (i.e. providing the wrong shipping address)</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your order did not arrive due to exceptional circumstances outside the seller&rsquo;s control (i.e. not cleared by customs, delayed by natural disaster)</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Other exceptional circumstances outside the control of Clickbuyall.com</p>\r\n\r\n<p>2.&nbsp;&nbsp;&nbsp; Refund or keep items not as described</p>\r\n\r\n<p>You can get a full refund if your item is significantly different from the seller&rsquo;s description, or you can choose a partial refund and keep the product.</p>\r\n\r\n<p>How it works:</p>\r\n\r\n<p>Every seller sets a return policy to resolve issues where the item is not as described (i.e. who is responsible for return shipping costs). If your item is not as described, you should contact the seller to discuss a resolution. If you can accept the product and want to keep it, you should negotiate a partial refund. Otherwise, you will get a full refund as established by the seller&rsquo;s return policy.</p>\r\n\r\n<p>Sellers can also offer additional guarantees for their products:</p>\r\n\r\n<p>1.&nbsp;&nbsp;&nbsp; Longer Protection</p>\r\n\r\n<p>You get 15 extra days to submit a Refund Request after your order has been completed.</p>\r\n\r\n<p>How it works:</p>\r\n\r\n<p>If your haven&rsquo;t received your item or find that it&rsquo;s not as described after the order is complete, you can still submit a refund request for up to 15 days.*</p>\r\n\r\n<p>*If you submit a refund request before the order is complete and then mark it as resolved, you cannot submit another refund request, even if the seller provides this service.</p>\r\n\r\n<p>2.&nbsp;&nbsp;&nbsp; Extra Returns</p>\r\n\r\n<p>You can return any product you have bought, even those in perfect condition. Please ensure that the product has not been used and is in the original packaging. The seller or the buyer pays the return shipping costs.</p>\r\n\r\n<p>How it works:</p>\r\n\r\n<p>You can return your purchase for any reason and get a full refund. The seller&rsquo;s return policy will determine who is responsible for the return shipping costs.*</p>\r\n\r\n<p>*This service becomes unavailable after the order is complete.</p>\r\n\r\n<p>3.&nbsp;&nbsp;&nbsp; Guaranteed Genuine</p>\r\n\r\n<p>If your purchase is found to be counterfeit, you can get up to two times the total amount you paid for it (shipping costs excluded).</p>\r\n\r\n<p>How it works:</p>\r\n\r\n<p>This service is offered by sellers participating in the Clickbuyall<u> Guaranteed Genuine Program</u> and covers certain types of products (see below). Participating sellers guarantee that their products are genuine. If they are found to be counterfeit, the seller will compensate the buyer by paying them up to two times the total cost of the products (shipping costs excluded). Clickbuyall.com will also fully refund the cost of the purchase.*&nbsp;</p>\r\n\r\n<p>*These products can also be covered by the Longer Protection guarantee.</p>\r\n\r\n<h2>Products Included in the Guaranteed Genuine Program</h2>\r\n\r\n<p><strong>? Jewelry</strong></p>\r\n\r\n<p>Participating sellers will assure that the jewelry they sell on Clickbuyall.com is genuine and matches the product description.</p>\r\n\r\n<p><strong>? Computers</strong><strong>, Communication Devices, Consumer Electronics, Watches, and other digital products</strong></p>\r\n\r\n<p>Participating sellers guarantee that the products they sell on Clickbuyall.com are genuine brand name products.</p>\r\n\r\n<p><strong>When</strong><strong> can I request a refund under the Guaranteed Genuine Program?</strong></p>\r\n\r\n<p>You can request a refund if all of the following conditions are satisfied:</p>\r\n\r\n<p>1.&nbsp;The products were purchased on Clickbuyall.com and are included in the Guaranteed Genuine Program (as described above).<br />\r\n2. The products are reasonably believed to be counterfeits or are different from their product descriptions on Clickbuyall.com.<br />\r\n3. The refund request complies with all other relevant rules and policies of Clickbuyall.com.*&nbsp;</p>\r\n\r\n<p>*Note: If you do not click &lsquo;Confirm Order Received&rsquo; in My Clickbuyall before the confirmation time limit expires, Clickbuyall.com will&nbsp;automatically consider the order to be satisfactory and will consider the order complete.</p>\r\n\r\n<p><strong>Compensation Standards:</strong></p>\r\n\r\n<p>Different product categories have different standards of compensation:</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;Computers, Communication Devices, Digital Products and Consumer Electronics:</p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"height:19px; width:284px\">\r\n			<p><strong>Problem</strong></p>\r\n			</td>\r\n			<td style=\"height:19px; width:256px\">\r\n			<p><strong>Compensation</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:64px; width:284px\">\r\n			<p>Computer, communication device or consumer electronics/ digital product is counterfeit.</p>\r\n			</td>\r\n			<td style=\"height:64px; width:256px\">\r\n			<p>Clickbuyall will fully refund the amount paid by the buyer. The seller will compensate up to two times the amount of the order placed.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:33px; width:284px\">\r\n			<p>Accessories (e.g. batteries) are not genuine.</p>\r\n			</td>\r\n			<td style=\"height:33px; width:256px\">\r\n			<p>15% of the total amount purchased will be refunded to the buyer by Clickbuyall.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:48px; width:284px\">\r\n			<p>Accessories (e.g. earphones, charger, data cable) are not genuine.</p>\r\n			</td>\r\n			<td style=\"height:48px; width:256px\">\r\n			<p>9% of the total amount purchased will be refunded to the buyer by Clickbuyall.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&middot;&nbsp;&nbsp;Watches</p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"height:19px; width:274px\">\r\n			<p><strong>Problem</strong></p>\r\n			</td>\r\n			<td style=\"height:19px; width:264px\">\r\n			<p><strong>Compensation</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:48px; width:274px\">\r\n			<p>Watch is counterfeit.</p>\r\n			</td>\r\n			<td style=\"height:48px; width:264px\">\r\n			<p>Clickbuyall will fully refund the amount paid by the buyer. The seller will compensate up to two times the amount of the order placed.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&middot;&nbsp;&nbsp;Jewelry</p>\r\n\r\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"height:19px; width:274px\">\r\n			<p><strong>Problem</strong></p>\r\n			</td>\r\n			<td style=\"height:19px; width:264px\">\r\n			<p><strong>Compensation</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:64px; width:274px\">\r\n			<p>Jewelry is counterfeit or different from the description on Clickbuyall.com.</p>\r\n			</td>\r\n			<td style=\"height:64px; width:264px\">\r\n			<p>Clickbuyall will fully refund the amount paid by the buyer. The seller will compensate up to two times the amount of the order placed. &nbsp; &nbsp;&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n',1,'2017-04-11 14:01:12','2017-04-11 14:36:34'),(6,'payments','How does Clickbuyall protect my payments?','<p><strong>Your transactions are always secured by Clickbuyall:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>For Buyers</strong><br />\r\n	Pay securely with your credit card without exposing your details.When paying online, your details are protected by VeriSign SSL encryption (the highest level of protection commercially available).</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>For Suppliers</strong><br />\r\n	We verifies the credit card details for every transaction. You will only be asked to ship the order after we confirm payment is received.</p>\r\n	</li>\r\n</ul>\r\n',1,'2017-04-11 14:39:49','2017-04-11 14:39:49'),(7,'shipping-delivery','Customs & import taxes','<ul>\r\n	<li>Orders may need to clear customs in your country.</li>\r\n	<li>Please check if your order will incur additional import duties, taxes or other customs related charges.</li>\r\n	<li>Import duties, taxes or other customs charges will be collected by the shipping company upon delivery.</li>\r\n	<li>Suppliers are not responsible for delays caused by the customs department in your country.</li>\r\n	<li>Additional costs or delays may occur during international trade. We sincerely hope that you do not use additional import costs or customs clearance delays as a reason for requesting refunds or leaving negative feedback.</li>\r\n</ul>\r\n',1,'2017-04-11 14:44:28','2017-04-11 14:44:28'),(5,'account-information','Protecting your account','<p><strong>How to improve your account security</strong><br />\r\n<strong>Important:</strong> If you suspect that an unauthorized party has already accessed or attempted to access your account, please contact us immediately.</p>\r\n\r\n<p>The following tips are proven ways to improve your account security:<br />\r\n<strong>1. Set a secure password</strong></p>\r\n\r\n<ul>\r\n	<li>Use a combination of&nbsp;letters or numbers ? e.g. beatlesfan28, with no spaces between&nbsp;</li>\r\n	<li>Use multiple words and numbers without spaces ? e.g. thebestboss84</li>\r\n	<li>Never use single words that can be found in any dictionary ? e.g. manager or bamboo</li>\r\n	<li>Never use personal information others can easily obtain or guess ? e.g. your name, phone number, or birth date</li>\r\n	<li>Never use your email address as the password</li>\r\n	<li>Never use common passwords ? e.g. 123456 or ABCDEF</li>\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p><strong>2. Sign in to Cliclbuyall</strong>&nbsp;<strong>regularly</strong><br />\r\nSigning into Cliclbuyall ensures your account information stays current</p>\r\n\r\n<p><strong>&nbsp;3. Be cautious when you receive requests for private or sensitive information</strong><br />\r\nNever click on links in emails to access Cliclbuyall or Cliclbuyall.com web pages if you suspect the message might not really be from us. Avoid filling out forms in email messages that ask for your personal information, such as your Member ID, password and credit card information. Most sign-in pages can be identified by addresses that begin with http://cliclbuyall.com/login.</p>\r\n\r\n<p><strong>4. Use anti-virus software and a firewall</strong><br />\r\nSome computer viruses steal your password and financial account information. For this reason, it is recommended that you install anti-virus software and update it on a regular basis. A firewall is a system designed to prevent unauthorized parties (usually referred to as &quot;hackers&quot;) from gaining access to sensitive information stored on your computer.&nbsp;</p>\r\n',1,'2017-04-11 14:31:35','2017-04-11 14:32:31'),(8,'customer-information','How do I avoid spam/phishing emails?','<p>What is phishing email? A phishing email&rsquo;s sender appears to be one of the people in you contact list. But it is actually from a phisher who was able to phish or hack your contact&rsquo;s email address.&nbsp; A phishing email can contain an attachment that if opened can release a Trojan with a key logger into your hard drive. When active, the key logger copies anything you type like email accounts, credit card numbers, passwords, etc for say PayPal, eBay, Amazon and more. These data is then sent to the phisher that he can now use for his own benefit.</p>\r\n\r\n<p>Some sellers ask you to go to a website which can track the shipping but need to log in as your account and password</p>\r\n\r\n<p>Once you log in , the seller can get your account and password . And your money will be stolen.</p>\r\n\r\n<p>Safety Tips:</p>\r\n\r\n<ul>\r\n	<li><strong>Avoid to click any links that seller give to you.&nbsp;</strong></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:21.0pt\"><strong>&nbsp; &nbsp; &nbsp;Don&rsquo;t log in any website which need to input your account and password.</strong></p>\r\n\r\n<ul>\r\n	<li><strong>To get familiar with Clickbuyall website links and keep them to your favorite list.</strong></li>\r\n	<li><strong>If you have any doubts about the the link, you can report the case to Clickbuyall.&nbsp;</strong></li>\r\n</ul>\r\n',1,'2017-04-11 14:50:19','2017-04-11 14:50:19'),(9,'feedback-ratings','How do I leave feedback for the seller?','<ul>\r\n	<li>Sign into<strong> My ClickBuyAll</strong></li>\r\n	<li>Confirm receipt of your order</li>\r\n	<li>On the <strong>Product Feedback</strong> page click <strong>button Create (+)</strong></li>\r\n	<li>Rate the seller by clicking the number of stars you want to give and enter an explanation of your rating; your explanation should cover the quality of the item and the seller&rsquo;s service; and click <strong>Create</strong></li>\r\n</ul>\r\n',1,'2017-04-11 14:53:32','2017-04-11 14:53:32'),(10,'security-center','Using anti-virus software and firewalls','<p>&nbsp;Some computer viruses steal your password and financial account information by recording your keystrokes. For this reason, it is recommended that you install an anti-virus software and update it on a regular basis. A firewall is a system designed to prevent unauthorized parties (usually referred to as &quot;hackers&quot;) from gaining access to sensitive information stored on your computer. Firewalls can be installed as either hardware and software or both.</p>\r\n\r\n<p>Was this page helpful? If not, <a href=\"/contact.html\">Contact Us</a></p>\r\n',1,'2017-04-11 15:00:21','2017-04-11 15:00:21'),(11,'protect-my-purchase','How can I protect my purchase?','<p><strong>More tips to help you avoid some common issues encountered by new buyers:</strong></p>\r\n\r\n<p><strong>1. Make sure you understand your local customs policies</strong></p>\r\n\r\n<p>It is important to remember that different countries have different customs policies. To avoid customs clearance problems relating to import qualifications or restrictions, you have the responsibility to find out whether the purchased products and the number of products being imported are in compliance with relevant local policies. You should also seek to understand whether the purchased products will attract additional local tariffs or customs duties.</p>\r\n\r\n<p>If you cannot complete the relevant import procedures because you require a CE certificate or other related document from the seller, please contact the seller for these documents as soon as possible.</p>\r\n\r\n<p><strong>2. Fill in the correct delivery address</strong></p>\r\n\r\n<p>To make sure your order will be delivered correctly, carefully fill in your delivery address before making any payment.</p>\r\n\r\n<p>&#39;PO Box&#39; is a mailbox. Since most of the products on the platform are couriered in the form of a package, using a PO Box as delivery address will mean your order may not be delivered. Avoid using PO Boxes as a delivery address.</p>\r\n\r\n<p>If you need to make any changes to the delivery address after you have made your payment, please contact the seller and seek their written consent first. Make sure you keep the original records of the relevant communications.</p>\r\n\r\n<p><strong>3. Quickly make all necessary arrangements for collecting your order when it arrives at the destination</strong></p>\r\n\r\n<p>The logistics company or post office will notify you when your order has arrived.&nbsp;Please check the delivery status and your mailbox regularly after you have placed your order.&nbsp;Once you have been notified that your order is ready for collection, please contact the logistics company or post office accordingly.</p>\r\n\r\n<p>If you didn&#39;t receive your order because you failed to arrange for its collection, the order will be finished.</p>\r\n\r\n<p><strong>4. Check your product carefully before confirmation</strong></p>\r\n\r\n<p>Logistics companies deliver packages in one of two ways:</p>\r\n\r\n<p>Driver/Shipper Release: the logistics company will deliver the package directly to the front or back door of the buyer&#39;s address</p>\r\n\r\n<p>Signature Obtained: the buyer must sign and acknowledge receipt of the package</p>\r\n\r\n<p>Please confirm with the seller your preferred method of delivery. If you choose Signature Obtained, you may need to pay extra fees. Please confirm with the seller on who will bear the cost of the extra fees prior to making payment.</p>\r\n\r\n<p>Please check the condition of your package before you sign and acknowledge receipt of delivery to avoid problems relating to product damage or the quantity of products that were delivered. Do not sign and acknowledge receipt of your order if the packaging on the outside has signs of damage.</p>\r\n\r\n<p>Please check the contents of your package immediately after signing and acknowledging receipt of delivery. Contact the seller immediately if you discover any further problems.</p>\r\n\r\n<p><strong>5. Confirm the return address with the buyer before returning your item</strong></p>\r\n\r\n<p>If you need to return an item because a quality issue or because it is substantially different from what was described, please make sure you confirm the return address with the seller before sending it back. &nbsp; &nbsp; &nbsp;</p>\r\n',1,'2017-04-11 15:05:31','2017-04-11 15:05:31'),(12,'why-did-my-login-fail','Why did my login fail? ','<p>To log in your account successfully, please ensure the correct registered email address (or Member ID) and password. Your password is case sensitive, so please check if your keyboard&#39;s Caps Lock light is on and also make sure there are no extra blank spaces in the password.</p>\r\n\r\n<p>If your registered email address and password are correct and you are still unable to sign in successfully, please follow the below steps to set your browsers:</p>\r\n\r\n<p>1. Check if your browser if you have blocked Third-party Cookies option. If the Third-party Cookies option has been blocked, please enable it</p>\r\n\r\n<p>2. Please be advised to delete cookies</p>\r\n\r\n<p>Was this page helpful? If not,<a href=\"/contact.html\">Contact Us</a></p>\r\n',1,'2017-04-11 15:14:24','2017-04-11 15:14:24');

UNLOCK TABLES;

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `flag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `languageculture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_display` int(1) DEFAULT '1',
  `is_active` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `languages` */

LOCK TABLES `languages` WRITE;

insert  into `languages`(`id`,`name`,`flag`,`languageculture`,`is_display`,`is_active`,`created`,`updated`) values (1,'English','flag-icon-us','en',1,1,'2017-02-18 18:06:43','2017-03-15 03:58:49'),(2,'Vietnamese','flag-icon-vn','vi',1,0,'2017-03-03 13:29:39','2017-03-15 03:59:01'),(3,'Japanese','flag-icon-jp','jp',1,0,'2017-03-03 13:30:58','2017-03-03 14:10:04'),(4,'Français','flag-icon-fr','fr',1,0,'2017-03-03 13:31:56','2017-03-03 13:31:56'),(5,'Deutsch','flag-icon-de','de',1,0,'2017-03-03 13:33:31','2017-03-03 13:33:31'),(6,'Русский','flag-icon-ru','ru',1,0,'2017-03-03 13:35:08','2017-03-03 13:35:08');

UNLOCK TABLES;

/*Table structure for table `mail` */

DROP TABLE IF EXISTS `mail`;

CREATE TABLE `mail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci,
  `mail_body` text COLLATE utf8_unicode_ci,
  `mail_keys` text COLLATE utf8_unicode_ci,
  `is_status` int(2) DEFAULT '1',
  `is_order` int(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mail` */

LOCK TABLES `mail` WRITE;

insert  into `mail`(`id`,`type`,`subject`,`mail_body`,`mail_keys`,`is_status`,`is_order`,`created`,`updated`) values (1,'REGISTRATION CONFIRMATION','Welcome to ClickBuyAll! Confirm your email address for added account security!','<div style=\" width:700px; margin:0 auto\">\r\n<div style=\"background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999\"><img src=\"http://clickbuyall.com/front/images/logo.png\" />\r\n<div style=\"font-size:16px;  padding-top:20px;\">\r\n<hr />\r\n<p><strong>Dear {name},</strong></p>\r\n\r\n<p><strong>Welcome to the {name-company}&nbsp;family!</strong></p>\r\n\r\n<p>Add another layer of security to your {name-company}&nbsp;account by confirming your email address.&nbsp;<br />\r\nBy confirming your email address you can easily track orders, receive promotional emails and recover your account details.</p>\r\n\r\n<p>Just click the button below. Too easy!</p>\r\n\r\n<p>{link_active}</p>\r\n\r\n<p>Sincerely,</p>\r\n\r\n<p>{domain-company}</p>\r\n<img src=\"http://clickbuyall.com/front/images/logo.png\" /></div>\r\n</div>\r\n</div>\r\n',NULL,1,NULL,'2017-02-16 23:12:07','2017-04-14 15:06:51'),(2,'Verification Change Password','Verification Email From ClickBuyAll Group','<div style=\" width:700px; margin:0 auto\">\r\n<div style=\"background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999\"><img src=\"http://clickbuyall.com/front/images/logo.png\" />\r\n<div style=\"font-size:16px;  padding-top:20px;\">\r\n<hr />\r\n<p><strong>Dear {name}</strong></p>\r\n\r\n<p><strong>You are confirming login. Please enter the following {link}.</strong></p>\r\n\r\n<p><small>Please pay attention:&nbsp;<br />\r\nAfter verification, you will be able to modify your password, login email address and cell phone number.&nbsp;<br />\r\nIf you did not apply for a verification email,&nbsp;<br />\r\nplease sign in to your account and change your password to ensure your account&#39;s security.&nbsp;<br />\r\nIn order to protect your account, please do not allow others access to your email.</small></p>\r\n\r\n<p>Sincerely,</p>\r\n\r\n<p>{domain-company}</p>\r\n<img src=\"http://clickbuyall.com/front/images/logo.png\" /></div>\r\n</div>\r\n</div>\r\n',NULL,1,NULL,'2017-03-23 07:10:18','2017-04-14 15:08:33'),(3,'Purchase Details','PURCHASE DETAILS','<div style=\" width:700px; margin:0 auto\">\r\n<div style=\"background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999\"><img src=\"http://clickbuyall.com/front/images/logo.png\" />\r\n<div style=\"font-size:16px;  padding-top:20px;\">\r\n<hr />\r\n<p><strong>Thank you for your purchase from {sitename} </strong></p>\r\n\r\n<p><strong>Order information</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<th>Customer Name</th>\r\n			<td>{customer_fname}</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Customer Email</th>\r\n			<td>{customer_email}</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Amount</th>\r\n			<td>{amount}</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Status</th>\r\n			<td>{status}</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Transaction ID</th>\r\n			<td>{transaction_id}</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Date of Purchase</th>\r\n			<td>{purchase_timestamp}</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Please check detail orders on website.</p>\r\n\r\n<p>Your comments are important to us because they help us provide the best service. If you have any please contact us at the support email: {supportEmail}. Big thank you for being awesome.</p>\r\n<img src=\"http://clickbuyall.com/front/images/logo.png\" /></div>\r\n</div>\r\n</div>\r\n',NULL,1,NULL,'2017-04-06 02:47:48','2017-04-14 15:12:15');

UNLOCK TABLES;

/*Table structure for table `manufacturers` */

DROP TABLE IF EXISTS `manufacturers`;

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_display` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `manufacturers` */

LOCK TABLES `manufacturers` WRITE;

insert  into `manufacturers`(`id`,`name`,`image`,`description`,`is_display`,`created`,`updated`) values (1,'Apple','5214-apple.png','<p>Apple is an American multinational technology company headquartered in Cupertino, California that designs, develops, and sells consumer electronics, computer software, and online services.</p>\r\n',1,'2017-02-19 05:20:44','2017-03-15 09:20:28'),(2,'Rolex','2379-rolex.png','<p>Rolex SA is a Swiss luxury watchmaker. The company and its subsidiary Montres Tudor SA design, manufacture, distribute and service wristwatches sold under the Rolex and Tudor brands</p>\r\n',1,'2017-02-19 05:27:17','2017-03-15 09:19:35'),(3,'Samsung','1418-samsung.jpeg','<p>Samsung Group is a South Korean multinational conglomerate headquartered in Samsung Town, Seoul. It comprises numerous affiliated businesses, most of them united under the Samsung brand, and is the largest South Korean chaebol.</p>\r\n',1,'2017-03-08 16:46:33','2017-03-15 09:18:51'),(4,'LG','4450-lg.jpeg','<p>Make life good. <em>LG</em> electronics, appliances and mobile devices feature innovative technology and sleek designs to suit your life and your style.</p>\r\n',1,'2017-03-08 16:47:05','2017-03-15 09:18:11'),(5,'Suzuki','9028-suzuki.png','<p>Suzuki Motor Corporation is a Japanese multinational corporation headquartered in Minami-ku, Hamamatsu, Japan, which specializes in manufacturing automobiles, four-wheel drive vehicles, motorcycles, ...</p>\r\n',1,'2017-03-08 16:57:58','2017-03-15 09:17:17'),(6,'Yamaha','6438-yamaha.png','<p>Yamaha Motor Company Limited is a Japanese manufacturer of motorcycles, marine products such as boats and outboard motors, and other motorized products.</p>\r\n',1,'2017-03-08 16:58:22','2017-03-15 09:16:16'),(7,'Casio','2120-casio.jpg','<p>Casio Computer Co., Ltd. is a multinational consumer electronics and commercial electronics manufacturing company headquartered in Shibuya, Tokyo, Japan.</p>\r\n',1,'2017-03-15 09:06:49','2017-03-15 09:06:49'),(8,'Patek Philippe','8771-patek_philippe.png','<p>Patek Philippe &amp; Co. is a Swiss watch manufacturer founded in 1851, located in Geneva and the Vall&eacute;e de Joux. It designs and manufactures timepieces and movements, including some of the most complicated mechanical watches.</p>\r\n',1,'2017-03-15 09:31:25','2017-03-15 09:31:25'),(9,'Nokia','3691-nokia.jpg','<p>Nokia Corporation, stylised as NOKIA, is a Finnish multinational communications and information technology company, founded in 1865. Nokia is headquartered in Espoo, Uusimaa, in the greater Helsinki metropolitan area.</p>\r\n',1,'2017-03-15 09:32:19','2017-03-15 09:32:19'),(10,'Uniqlo','7493-uniqlo.png','<p>Uniqlo Co., Ltd. is a Japanese casual wear designer, manufacturer and retailer. The company has been a wholly owned subsidiary of Fast Retailing Co., Ltd. since November 2005.</p>\r\n',1,'2017-03-15 09:34:57','2017-03-15 09:34:57'),(11,'Canon','7857-canon.png','<p>Canon Inc. is a Japanese multinational corporation specialized in the manufacture of imaging and optical products, including cameras, camcorders, photocopiers, steppers, computer printers and medical equipment.</p>\r\n',1,'2017-04-10 09:23:08','2017-04-10 09:23:08');

UNLOCK TABLES;

/*Table structure for table `newsletter` */

DROP TABLE IF EXISTS `newsletter`;

CREATE TABLE `newsletter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(125) NOT NULL,
  `user_id` int(10) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `newsletter` */

LOCK TABLES `newsletter` WRITE;

insert  into `newsletter`(`id`,`email`,`user_id`,`created`,`updated`) values (1,'jason@gmail.com',0,'2017-02-19 03:57:36','2017-02-19 03:57:36'),(2,'philips@gmail.com',0,'2017-02-19 03:57:52','2017-02-19 04:08:19'),(3,'kevin',0,'2017-03-13 16:00:33','2017-03-13 16:00:33'),(4,'terry@gmail.com',0,'2017-03-13 16:44:27','2017-03-13 16:44:27'),(5,'vinhtran@gmail.com',0,'2017-03-13 16:45:42','2017-03-13 16:45:42'),(6,'vinh@gmail.com',0,'2017-03-15 02:46:11','2017-03-15 02:46:11'),(7,'vinhit@gmail.com',0,'2017-03-15 03:05:37','2017-03-15 03:05:37');

UNLOCK TABLES;

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `download_status` int(11) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `order_items` */

LOCK TABLES `order_items` WRITE;

UNLOCK TABLES;

/*Table structure for table `order_sessions` */

DROP TABLE IF EXISTS `order_sessions`;

CREATE TABLE `order_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `is_download` int(1) DEFAULT '0',
  `sesssion_customer` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `order_sessions` */

LOCK TABLES `order_sessions` WRITE;

UNLOCK TABLES;

/*Table structure for table `order_status` */

DROP TABLE IF EXISTS `order_status`;

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `order_status` */

LOCK TABLES `order_status` WRITE;

insert  into `order_status`(`id`,`name`,`description`,`created`,`updated`) values (1,'PENDING','<p>Status Pending</p>\r\n','2017-02-27 14:10:41','2017-02-27 14:10:41'),(2,'APPROVED','<p>Status approved</p>\r\n','2017-02-27 14:11:29','2017-02-27 14:11:29'),(3,'DECLINED','<p>Status Declined&nbsp;</p>\r\n','2017-02-27 14:12:00','2017-02-27 14:12:00'),(4,'REFUNDED','<p>Status Refunded</p>\r\n','2017-02-27 14:12:30','2017-02-27 14:12:30');

UNLOCK TABLES;

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `data_orders` text COLLATE utf8_unicode_ci,
  `status_id` int(11) DEFAULT NULL,
  `is_download` int(1) DEFAULT '0',
  `type` int(11) DEFAULT '1',
  `id_read` int(1) DEFAULT '0',
  `sesssion_customer` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `orders` */

LOCK TABLES `orders` WRITE;

UNLOCK TABLES;

/*Table structure for table `payment_methods` */

DROP TABLE IF EXISTS `payment_methods`;

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `configuration` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `payment_methods` */

LOCK TABLES `payment_methods` WRITE;

insert  into `payment_methods`(`id`,`name`,`image`,`configuration`,`is_active`,`description`,`created`,`updated`) values (1,'Paypal','2181-paypal-512.png','apiUsername = vinh.tran_api1.xsonline.eu\r\napiPassword = 1398438984\r\napiSignature = AFcWxV21C7fd0v3bYYYRCpSSRl31AswfW46rYx7LRKB1MvSQZ5yH.fol\r\napiLive = 0',1,'<p>Paypal method payment is a secured way to pay.</p>\r\n','2017-02-18 06:35:35','2017-03-23 09:25:01'),(2,'Visa','3423-Visa-icon.png','<p>Visa</p>\r\n',1,'<p>Visa</p>\r\n','2017-03-23 09:52:09','2017-03-23 09:52:09'),(3,'Master card','2492-Master-Card-icon.png','<p>Master card</p>\r\n',1,'<p>Master card</p>\r\n','2017-03-23 09:53:40','2017-03-23 09:53:40'),(4,'Maestro','6441-Maestro-icon.png','<p>Maestro</p>\r\n',1,'<p>Maestro</p>\r\n','2017-03-23 09:58:03','2017-03-23 09:58:03'),(5,'American express','2463-American-Express-icon.png','<p>American express</p>\r\n',1,'<p>American express</p>\r\n','2017-03-23 10:00:51','2017-04-10 04:04:35');

UNLOCK TABLES;

/*Table structure for table `post_cate` */

DROP TABLE IF EXISTS `post_cate`;

CREATE TABLE `post_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `cate_post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `cate_post_id` (`cate_post_id`),
  CONSTRAINT `post_cate_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `post_cate_ibfk_2` FOREIGN KEY (`cate_post_id`) REFERENCES `category_post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `post_cate` */

LOCK TABLES `post_cate` WRITE;

insert  into `post_cate`(`id`,`post_id`,`cate_post_id`) values (16,2,5),(17,3,2),(21,4,3),(22,5,4),(23,6,1),(24,6,3),(25,7,4),(26,8,2);

UNLOCK TABLES;

/*Table structure for table `post_tag` */

DROP TABLE IF EXISTS `post_tag`;

CREATE TABLE `post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_post_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `tag_post_id` (`tag_post_id`),
  CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `post_tag` */

LOCK TABLES `post_tag` WRITE;

insert  into `post_tag`(`id`,`post_id`,`tag_post_id`,`created`,`updated`) values (1,2,1,'2017-03-29 14:59:09','2017-03-29 14:59:09'),(2,2,2,'2017-03-29 14:59:09','2017-03-29 14:59:09'),(3,2,3,'2017-03-29 14:59:09','2017-03-29 14:59:09'),(4,3,4,'2017-03-29 15:01:37','2017-03-29 15:01:37'),(5,3,5,'2017-03-29 15:01:37','2017-03-29 15:01:37'),(8,4,6,'2017-03-29 15:17:09','2017-03-29 15:17:09'),(9,4,7,'2017-03-29 15:17:09','2017-03-29 15:17:09'),(10,4,8,'2017-03-29 15:17:09','2017-03-29 15:17:09'),(11,5,6,'2017-03-29 15:18:06','2017-03-29 15:18:06'),(12,5,9,'2017-03-29 15:18:06','2017-03-29 15:18:06'),(13,6,10,'2017-03-29 15:19:02','2017-03-29 15:19:02'),(14,6,11,'2017-03-29 15:19:02','2017-03-29 15:19:02'),(15,7,12,'2017-03-29 15:20:00','2017-03-29 15:20:00'),(16,7,13,'2017-03-29 15:20:00','2017-03-29 15:20:00'),(17,8,14,'2017-03-29 15:21:07','2017-03-29 15:21:07'),(18,8,15,'2017-03-29 15:21:07','2017-03-29 15:21:07');

UNLOCK TABLES;

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `web_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_comment` int(1) DEFAULT '0',
  `is_status` int(1) DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `posts` */

LOCK TABLES `posts` WRITE;

insert  into `posts`(`id`,`title`,`image`,`description`,`content`,`web_url`,`is_comment`,`is_status`,`user_id`,`created`,`updated`) values (2,'Reps Shouldn\'t be Afraid of Robots Taking Their Job','uploads/posts/20170324/8731-Robots-artificial-intelligence-robotics-automation.jpg','<p>Artificial intelligence can bring down costs and make customer service more consistent, but it won&#39;t be able to field a large portion of a company&#39;s customer calls; those require judgment and guidance&nbsp;</p>\r\n','<p>In 2013, a&nbsp;piece of research was produced at the Oxford Martin School, University of Oxford (pdf), which has become increasingly infamous since due to its chilling warning that 35% of all human occupations are at risk of being replaced by artificial intelligence.</p>\r\n\r\n<p>This useful page from the BBC lets you see how susceptible your job is&nbsp;based on the data and, unsurprisingly, customer service jobs rank quite highly. They are the 49th most likely job to be automated by artificial intelligence (AI) and&nbsp;have a 91% likelihood of being replaced by robots, a risk that&nbsp;falls into the study&rsquo;s &ldquo;quite likely&rdquo; category.</p>\r\n\r\n<h3>Customer Service Functions Already Experimenting with AI</h3>\r\n\r\n<p>Companies have already started to use AI in their customer service operations to find cost savings and improve the consistency of the service provided to customers. MasterCard, for example,&nbsp;is launching an AI bot that will allow consumers to make payments, ask questions and manage their accounts&nbsp;through instant messaging.</p>\r\n\r\n<p>This isn&rsquo;t the&nbsp;company&rsquo;s first experiment with AI; last year MasterCard&nbsp;launched biometric authentication tools, allowing cardholders to make payments and manage accounts with a selfie. In that case, use of AI addresses the simultaneous demand for increased security and decreased service friction (a cost-benefit shortcut describing the amount of effort required to cross security barriers in order to access one&rsquo;s account, versus&nbsp;the benefit of having an online service option).</p>\r\n\r\n<h3>When Self-Service Fails, You Need a Human</h3>\r\n\r\n<p>Despite the very real promise of AI, it&rsquo;s unlikely to dramatically reduce the amount of times customers will want to call a company. And when that call does happen, companies will almost certainly need a human to field the call.</p>\r\n\r\n<p>Most customers prefer self-service solutions, according to CEB data, but when efforts to DIY their way to a solution fails, the customer will reluctantly and&nbsp;exasperatedly&nbsp;contact the company&rsquo;s call center directly. And when they do, they are often more frustrated than they would have been if they had they called in the first place, and not used&nbsp;online tools.&nbsp;Customers approach almost all calls with &ldquo;emotional baggage.&rdquo;</p>\r\n\r\n<p>This has two implications. First, when technology fails,&nbsp;there needs to be a live human being on the phone, and, second, those front line reps need to be prepared for a&nbsp;higher level of intensity and complexity&nbsp;in the calls they take.</p>\r\n\r\n<p>For customer service mangers, filling open job positions with the right people will be even more important as service becomes automated and &ldquo;smart.&rdquo; And those people are what CEB calls &ldquo;controller&rdquo; reps.</p>\r\n\r\n<p>When the customer service robot cannot compute the nuanced needs of your customer, controllers will be best-equipped to intervene with human judgment and guidance.</p>\r\n','http://clickbuyall.dev',1,1,1,'2017-02-28 15:22:04','2017-03-29 14:59:08'),(3,'5 Tips for Hiring Millennials','uploads/posts/20170324/1652-digital-technology-on-Singapores-subway.jpg','<p>They spend less time researching new companies and are more skeptical of what they do learn, are keener on career development than their elders, and receive more job offers</p>\r\n','<p>Given&nbsp;millennials&nbsp;now form the&nbsp;largest group in the US workforce, and will only comprise a bigger proportion as more and more&nbsp;baby boomers&nbsp;retire, it is imperative that sales teams understand how to hire them, retain them, and get the most out of them. Five observations based on CEB surveys of hundreds of thousands employees can help here.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Millennials spend less time learning about organizations before deciding whether to apply</strong>:&nbsp;Although they apply to the same number of companies&nbsp;as their elders, millennials spend less than half as much time learning about potential employers compared to other generations.</p>\r\n\r\n	<p><strong>Implication</strong>: Your company as a whole, and your sales department&rsquo;s job posting, needs to stand out with a compelling brand message that emphasizes things millennials care about, such as professional development opportunities and growth potential.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Millennials are more attracted by the chance to advance their career or develop skills and experience</strong>: The most important attribute&nbsp;of the employee value proposition (EVP) &ndash; the benefits employees look for in exchange for the skills and experience they offer to a company &ndash; &nbsp;for millennials is the level of compensation, just like all other generations.</p>\r\n\r\n	<p>What&rsquo;s interesting though, is that millennials are more interested in career and individual development than other generations. Millennials are 11% more likely to say &ldquo;future career opportunity&rdquo; is one of the most important attributes they look for when selecting a job (see chart 1).</p>\r\n\r\n	<p><strong>Implication:&nbsp;</strong>Millennials are more concerned with opportunities and skill development than any other generation. Attract millennials to sales roles by developing an EVP that shows how the skills they will learn can help them succeed professionally and personally, and clearly outlines the potential career paths offered by your firm.</p>\r\n\r\n	<hr />\r\n	<p><a href=\"https://www.cebglobal.com/blogs/files/2017/03/Extent-to-which-millennials-EVP-preferences-differ-from-other-generations-extended.jpg\" rel=\"lightbox[329543]\"><img alt=\"Extent to which millennials\' EVP preferences differ from other generations\" class=\"aligncenter size-full wp-image-329559\" src=\"https://www.cebglobal.com/blogs/files/2017/03/Extent-to-which-millennials-EVP-preferences-differ-from-other-generations.jpg\" style=\"height:415px; width:600px\" /></a></p>\r\n\r\n	<p><strong>Chart 1: Extent to which millennials&rsquo; EVP preferences differ from other generations&rsquo;</strong> <em>Percentage point change in likelihood of selecting attribute in in top five most important attributes; n=17,971</em> Source: CEB Global Labor Market Survey</p>\r\n\r\n	<p style=\"text-align:right\">&nbsp;Click chart to expand</p>\r\n\r\n	<hr /></li>\r\n	<li>\r\n	<p><strong>M</strong><strong>illennial interviewees are more likely to receive offers</strong>: Millennials participate in the same number of interviews as other generations but are 12.5% more likely to receive an offer. Sales teams&nbsp;can improve their acceptance rate by dedicating extra attention to the candidate experience.</p>\r\n\r\n	<p><strong>Implication</strong>: In addition to making the application and hiring process seamless, sales teams should spend part of the interview time discussing why the candidate should be excited about working for the company. Again, ensure you highlight professional development and career advancement opportunities.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Millennials are more likely to use social media to learn about employers &mdash; but remain skeptical of what they see</strong>: Millennials spend less time learning about potential employers than other generations, and are&nbsp;most likely to use social media when doing so. Maybe as a result only 29% of them trust the information they receive.</p>\r\n\r\n	<p><strong>Implication:</strong>&nbsp;Social media channels will help your company increase its brand awareness, but be ready to back up what you&rsquo;ve already conveyed later in the hiring process.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Millennials are more likely to learn about organizations on mobile devices, but few firms optimize content for mobile users</strong>: Millennials are 7% more likely to research companies on mobile devices. Unfortunately only 33% of companies&rsquo; career websites are optimized for mobile use. Ensuring your site is accessible via mobile devices can help you stand out during millennials&rsquo; research.</p>\r\n\r\n	<p><strong>Implication:</strong>&nbsp;Recruiting and employment branding content needs to be optimized for mobile devices. Luckily most sales functions have experience creating content targeted at mobile devices, since field reps often need to be able to access information via their phone or tablet. You can use this familiarity to optimize recruiting content for mobile platforms as well.</p>\r\n	</li>\r\n</ol>\r\n','c',1,0,1,'2017-03-24 15:36:02','2017-03-29 15:01:37'),(4,'4 Principles of a High-Impact Dashboard','uploads/posts/20170324/6627-performance-analytics-analysis.jpg','<p>More data means worse reporting in many cases; the trick is to consolidate it all into a dashboard that will fit on one page. The job of an IT project manager is to steer highly complex and expensive IT projects to completion on time and &ndash; if possible &ndash; under budget, so a big part of their role is letting everyone know how projects are progressing.</p>\r\n','<p>However, like many other parts of a big business, the availability of a lot more data on the topic has made reporting much more difficult. Dashboards are now frequently stuffed with so much data that stakeholders struggle to process the information.</p>\r\n\r\n<p>Which is not good when the fundamental point of a&nbsp;dashboard is to encourage meaningful discussion and to provide decision makers with a clear view into the performance of a project or a program.</p>\r\n\r\n<p>Progressive project management offices (PMOs) have cut through the clutter by insisting that the dashboard fits on one page. Although it may sound a far cry from where some PMOs are now, it can be achieved by following four principles. This downloadable poster has more information too.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Keep it relevant</strong>: Make sure that the metrics you choose for the dashboards align to the needs of the stakeholders and aid their understanding of the decisions they need to make.</p>\r\n\r\n	<p>For example, some PMOs group their metrics into categories to provide insight into portfolio health and enable critical portfolio decisions.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Keep it simple</strong>: It&rsquo;s important to pay attention to the formatting when designing a dashboard as it can aid (or hinder) the consumability of information.</p>\r\n\r\n	<p>The appeal of a well-drawn dashboard-on-a-page is that it is easy to read and understand, with a clear color scheme that logically draws the eye across the page.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Keep it clear</strong>: Don&rsquo;t create overly complex graphs and charts on the dashboard purely for visual appeal. Review if your current visuals don&rsquo;t help you clearly communicate the story you want to tell.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Keep drill-down capabilities</strong>: While dashboards should have only the essential, high-level metrics, consider including supporting documents that contain details to help stakeholders drill-down data and learn more if required.</p>\r\n	</li>\r\n</ol>\r\n','',1,1,1,'2017-03-24 15:40:10','2017-03-29 15:17:09'),(5,'How to Create a Culture of Quality','uploads/posts/20170324/7250-programming-applications-DevOps-infrastructure.jpg','<p>Too much of a focus on speed can mean in-house applications are not up to the tasks required of them; the solution is to create a &quot;culture of quality&quot; throughout the whole development team &nbsp; &nbsp;</p>\r\n','<p>Over the past several years, those in charge of IT applications teams&nbsp;have&nbsp;emphasized the need for their staff to be as quick as possible in getting applications in to day-to-day use.</p>\r\n\r\n<p>But this emphasis on speed can have the unintended consequence of developers focusing less on other development objectives, like quality.&nbsp;The need for speed may tempt some development teams to make tradeoffs, but 84% of business partners are unwilling to sacrifice the quality of in-house software for speed.</p>\r\n\r\n<h3>Three Principles</h3>\r\n\r\n<p>Forward-thinking teams realize&nbsp;that the answer isn&rsquo;t to change applications processes but instead to inculcate a &ldquo;culture of quality&rdquo;&ndash; an environment in which all members of the applications &ldquo;delivery team&rdquo; take ownership of the role they play in providing good quality solutions, and understand how their day-to-day activities affect the quality of the software they&rsquo;re creating, at any speed.</p>\r\n\r\n<p>Adhering to three principles will help with that.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Explicitly define the behaviors needed to create a culture of quality</strong>:&nbsp;To create a culture in which quality and speed are complementary, make quality an integral part of development activities, rather than a series of process steps along the way. The secret to achieving both quality and speed is defining the behaviors each developer should exhibit on a daily basis, throughout all of their development activities, to ensure quality outcomes.</p>\r\n\r\n	<p>To determine these behaviors, the team at one insurer in CEB&rsquo;s network of applications groups brings development teams and the quality assurance (QA) function together to outline the activities to produce high quality work without sacrificing speed.</p>\r\n\r\n	<p>Once behaviors are explicitly defined, delivery teams can be held accountable for those behaviors and can more easily integrate quality into their day-to-day activities.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Ignite quality conversations within development teams</strong>:&nbsp;The existence of QA and testing functions may unintentionally encourage development teams to perceive quality as &ldquo;someone else&rsquo;s job.&rdquo; But this mindset can lead to low quality applications development and time-consuming rework.</p>\r\n\r\n	<p>Instead,&nbsp;create a culture in which development teams have regular and explicit conversations about quality, at a peer-to-peer level. When quality is discussed, analyzed, and deliberated on a regular basis, quality becomes an aspect of development that is valued by all members of the delivery team.</p>\r\n\r\n	<p>Managers&nbsp;can help foster conversations about quality within delivery teams by instituting a self-review process for developers on their quality activities, asking peers to rate each other on quality activities, or tying quality activities to business objectives.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Promote and reward quality ownership across development teams</strong>:&nbsp;Creating a culture that values high-quality work requires development teams to feel a sense of ownership for&nbsp;the quality of their solutions. To do so,&nbsp;use&nbsp;metrics to help promote &ldquo;quality ownership&rdquo; across development teams.</p>\r\n\r\n	<p>By using metrics to measure quality&nbsp;inputs&nbsp;as well as outcomes, managers can analyze patterns of consistent shortfalls and link those outcomes to the behaviors that produce them. A multinational software firm in CEB&rsquo;s networks,&nbsp;for example, uses a dashboard to measure and track behaviors across delivery teams.</p>\r\n\r\n	<p>This information is not used punitively, but to target resources and coaching to teams that do not consistently exhibit quality behaviors, and reward teams that do exhibit these behaviors with greater latitude.</p>\r\n	</li>\r\n</ol>\r\n','',1,1,1,'2017-03-24 15:50:49','2017-03-29 15:18:06'),(6,'How to Ease the Corporate IT versus Product IT Dilemma','uploads/posts/20170324/7511-communication-channels.jpg','<p>With digitization now such a high priority for a big chunk of the corporate world, many CIOs have to balance their corporate IT strategy with the needs of many product tech teams; five steps can help ease the tension</p>\r\n','<p>CIOs at technology companies are all too familiar with the power tussle that comes from setting a corporate IT strategy that doesn&rsquo;t align with a more ad-hoc technology strategy. And one that&rsquo;s pursued by product teams who often have more specialized skills and experience than the IT team anyway.</p>\r\n\r\n<p>But as digitization becomes one of the most important corporate priorities for so many of the world&rsquo;s big companies, this tussle is being repeated across a whole host of industries.</p>\r\n\r\n<p>For example, companies are adding &ldquo;internet of things&rdquo; sensors and data-driven services to differentiate many traditionally non-technological products. And this means that many firms are elevating (or have already elevated) the importance of product IT over corporate IT, resulting in internal competition over talent and the impression that &ldquo;a two-class system&rdquo; exists.</p>\r\n\r\n<h3>Five Ways to Minimize Internal Squabbling</h3>\r\n\r\n<p>At a&nbsp;recent Palo Alto meeting of CIOs in CEB&rsquo;s network, about half the CIOs present had responsibility for both product and corporate IT. The other half had responsibility for corporate IT only.</p>\r\n\r\n<p>The meeting produced five useful conclusions for CIOs who are thinking about their team&rsquo;s role in the company&rsquo;s new product IT initiatives.&nbsp;As one CIO said: no one but IT has the end-to-end understanding of the digital value chain, so many CIOs may be in a position to bridge the gap between product and corporate IT.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Start by (re)defining CIO&rsquo;s customers</strong>: In this period of transformation, CIOs need to consider which business leaders, employee groups, and external parties (including consumers) are &mdash; or are not &mdash; their customers.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Embrace more shared accountability</strong>: Even where the CIO takes responsibility for product IT, the ownership model is likely to involve far more shared accountability with business leaders than the black-and-white lines that previously separated corporate IT and other functions.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Give more attention to enterprise architecture</strong>: A surge in product IT has led to more complex design decisions that have far-reaching implications for integration and sustainability.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Understand&nbsp;where new business models depend on corporate IT</strong>: It&rsquo;s unrealistic that corporate IT and product IT will be completely separate, independent spheres. Even if the two are led by different organizational leaders, product and corporate IT will require close coordination on digital initiatives.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Take on a product management mindset</strong>: For a CIO with joint responsibility over corporate and product IT, the most effective CIOs take a product management approach, guided by a set of business capabilities. Both traditional IT delivery and product IT can be managed cohesively with product delivery process.</p>\r\n	</li>\r\n</ol>\r\n','',1,1,1,'2017-03-24 15:56:40','2017-03-29 15:19:02'),(7,'How Companies Can Support Employees’ Mental Health and Wellness','uploads/posts/20170329/2799-rewards-benefits.jpg','<p>Benefits teams should seek to understand what employees want, and then encourage them to use the services on offer.&nbsp;Many employers may be underestimating the impact of mental health and substance abuse problems on their workforce, according to a recent survey.</p>\r\n','<p>The &ldquo;Mental Health and Substance Abuse Benefits&rdquo; survey of 247 US employers conducted by the International Foundation of Employee Benefit Plans, found that 64% of firms reported less than 30% of their workforce is affected by mental health or substance abuse issues,&nbsp;according to&nbsp;<em>Employee Benefits News</em>&nbsp;(paywall).</p>\r\n\r\n<p>Whereas in fact, as the piece points out, &ldquo;about one in five American adults suffer from mental illness, according to the National Institute of Mental Health, and one in 10 American adults suffer from substance abuse, according to the Open Society Institute.&rdquo;</p>\r\n\r\n<p>The results also showed that, although 91% of the firms in the survey&nbsp;offered an employee assistance program (EAP) that provides employees access to assessment, counseling, or mental health services, few employees are taking advantage of these programs.</p>\r\n\r\n<h3>Get More Out&nbsp;of Your Wellness Program</h3>\r\n\r\n<p>Most&nbsp;companies continue to spend money on &ldquo;wellness&rdquo; or &ldquo;wellbeing programs,&rdquo; and employees expect them to do so. In fact, 83% of companies in a CEB poll say they now offer emotional and/or mental wellbeing programs, which underpins how&nbsp;it&rsquo;s become such a common part of the &ldquo;wellbeing portfolio.&rdquo;</p>\r\n\r\n<p>However, companies should still make sure they focus their wellbeing offer on what employees want.&nbsp;Benefits teams&nbsp;can improve the relevance of thier wellbeing program&nbsp;by collecting and analyzing employee mental health data (e.g., insurance claims) and other employee data (e.g., focus groups, surveys) to identify needs specific to their own workforce.</p>\r\n\r\n<p>Companies can see up to a 3% boost in employee performance by helping address employees&rsquo; emotional needs through the right total rewards package, according to CEB analysis. And&nbsp;addressing emotional needs has a particular impact on employees in entry and mid-level roles. CEB Total Rewards Leadership Council members can read more in the full study.</p>\r\n\r\n<p>To address the low usage rate of EAPs, benefits teams should improve their communications to encourage more employees take advantage of the benefits available to them.</p>\r\n\r\n<p>In fact, only 33% of firms believe&nbsp;their communications are successful at encouraging employees to be informed consumers of their benefits, according to CEB data. Carefully selecting the right communication content, channel, and source are the keys to employees getting the best use out of a well-designed program.</p>\r\n\r\n<p>When employees find their benefits to be relevant to them personally, they are more likely to consume their benefits and have higher perceptions of their company&rsquo;s benefit offerings. That, in turn,&nbsp;makes for healthier, happier, and higher performing employees.</p>\r\n','',1,1,1,'2017-03-29 07:17:11','2017-03-29 15:20:00'),(8,'B2B Salespeople Need to Act More Like Travel Agents','uploads/posts/20170329/4865-Travel-agent-agency-plane-tickets.jpg','<p>Customers are overwhelmed; they need help, not your latest sales pitch.Having more&nbsp;information doesn&rsquo;t always make it easier to decide. Consider the&nbsp;travel industry: with the explosion of internet travel sites in the 2000s, consumers took charge of their own travel, and travel agencies hemorrhaged&nbsp;business.</p>\r\n','<p>Fast forward to today and, according to the travel and leisure marketing firm MMGY, the use of travel agents&nbsp;increased by 50% from 2014 to 2015. The reason is that&nbsp;consumers, overwhelmed by information and inundated with choice, are again turning to someone to take the work out of travel planning.</p>\r\n\r\n<p>B2B buying and selling has followed a similar trajectory; a wealth of easily available information has made it possible for buyers to do much of the work themselves. By 2012,&nbsp;nearly 60% of a typical B2B purchasing decision &mdash; researching solutions, ranking options, benchmarking pricing, and so on &mdash; was happening before the buyer even had a conversation with a supplier, according to CEB analysis. But just because customers&nbsp;can&nbsp;research their purchase doesn&rsquo;t necessarily mean the process is going smoothly.</p>\r\n\r\n<p>In fact, the torrents of information, expanding array of options, and growing size and diversity of purchasing groups have led to a kind of purchase paralysis.&nbsp;Customers take longer than ever to make purchases, and abandon them more often. At the same time, second guessing and post-purchase regret are on the rise, while loyalty is falling. The increasing complexity of purchasing makes it increasingly hard, and buyers are now looking for sellers who can make the process easy once again.</p>\r\n\r\n<h3>Changing the Direction of Travel</h3>\r\n\r\n<p>If you think B2B purchasing hasn&rsquo;t become that bad, try&nbsp;this simple exercise: think about the last major purchase for which you sat on the buying committee. Perhaps it was a CRM solution, a consulting engagement, or new infrastructure. Now think about the stakeholder group on day one and how that group had changed by day 100.</p>\r\n\r\n<p>Think about the information you initially consulted and how that changed over time. Consider the revolving door of experts, colleagues, vendors, and their specialists. Think about the seemingly infinite set of options you needed to consider. Now ask yourself, if given the choice, would you do it that way again? Probably&nbsp;not.</p>\r\n\r\n<p>By becoming their customer&rsquo;s &ldquo;travel agent,&rdquo; leading suppliers are spinning the challenges customers face into tremendous commercial advantage. They&rsquo;re easing customers&rsquo; burdens by guiding them through difficult decisions and choices, and improving &ldquo;win rates&rdquo; for high-end solution sales by as much as 60%.</p>\r\n\r\n<p>This is borne out by three examples of how&nbsp;firms in three different industries simplify the purchase process.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>An employee wellness benefits provider uses content marketing</strong>: Programs to support&nbsp;employee wellness and keep health care costs in check are a fairly new type of service. As such, many HR departments have never made this kind of&nbsp;purchase. As employers try to learn about the&nbsp;market, a mob of brokers, sales people, &ldquo;employee evangelists,&rdquo; and others typically flood the decision makers with information.</p>\r\n\r\n	<p>As one firm that provided benefits watched its customers become increasingly overwhelmed, it created marketing and sales content focused exclusively on best practices for&nbsp;purchasing&nbsp;wellness benefits. The content&nbsp;is highly prescriptive, guiding customers through the stages of decision making, assessing their readiness to provide wellness benefits, and walking them through benchmarking exercises and even RFP builders.</p>\r\n\r\n	<p>This guidance is vendor-neutral; it doesn&rsquo;t promote the provider&rsquo;s solution, but instead guides prospects through the purchase process, offering practical tips and warnings about pitfalls they may encounter. Subtly, within the content, the provider orients customers toward its distinct strengths without overtly pitching its solution. The campaign has resulted in dramatic increases in marketing leads and sales.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>A marketing automation company creates&nbsp;bespoke presentations</strong>: When&nbsp;customer decision makers don&rsquo;t agree, it can make purchasing difficult and slow &ndash; or simply scuttle deals altogether. Consider the common situation where a marketing head approaches the CIO seeking approval&nbsp;for a marketing automation purchase.</p>\r\n\r\n	<p>If, as often happens, the CIO believes the company&rsquo;s CRM solution already does adequate marketing automation, they&nbsp;may block the purchase. To address this problem, one&nbsp;supplier built a series of ready-made decks for marketers to present to CIOs and other stakeholders in the purchasing decision.</p>\r\n\r\n	<p>These decks contain benchmarking tools, customizable ROI calculators, and other content to showcase the potential impact of the firm&rsquo;s solution, and, most powerfully, they use the language and metrics of the stakeholder receiving it.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>A health care software company uses networking events early in the sales process</strong>: Sellers often use references from previous customers to help get a new one through the final stages of a difficult purchase. Most sellers approach this in a similar way. They get their happiest customer on the phone with the prospective customer late in the sales process and ask them to sing the company&rsquo;s praises.</p>\r\n\r\n	<p>This software company takes another approach, asking customers who have recently completed a significant purchase that is similar to the one the prospect is evaluating to spend half a day alone with the prospective customer early in the purchase process. The engagement is billed as a networking and best-practice sharing event, so both companies benefit.</p>\r\n\r\n	<p>But the software company asks the customer reference to candidly discuss their purchase process. This includes openly discussing missteps they made, pitfalls to avoid, information to consult, RFP advice, and how to best engage with the software company. Because this is a true peer-to-peer networking opportunity, few prospects turn away the opportunity. As a result of the reference engagement approach, the software company has seen cycle times fall and deal win rates increase.</p>\r\n\r\n	<p>Like these companies, B2B suppliers need to focus on&nbsp;making it far easier for customers to buy. Senior sales managers need to start thinking aobut what opportunities &nbsp;they have to become their customers&rsquo; travel agent.</p>\r\n	</li>\r\n</ol>\r\n','',1,1,1,'2017-03-29 07:21:43','2017-03-29 15:21:06');

UNLOCK TABLES;

/*Table structure for table `product_categories` */

DROP TABLE IF EXISTS `product_categories`;

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_display` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_categories` */

LOCK TABLES `product_categories` WRITE;

insert  into `product_categories`(`id`,`product_id`,`category_id`,`is_display`,`created`,`updated`) values (1,1,3,1,NULL,NULL),(2,2,2,1,NULL,NULL),(3,2,5,1,NULL,NULL),(4,2,8,1,NULL,NULL),(5,3,1,1,NULL,NULL),(6,3,5,1,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `product_manufacturers` */

DROP TABLE IF EXISTS `product_manufacturers`;

CREATE TABLE `product_manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `manufacturers_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_manufacturers` */

LOCK TABLES `product_manufacturers` WRITE;

UNLOCK TABLES;

/*Table structure for table `product_pics` */

DROP TABLE IF EXISTS `product_pics`;

CREATE TABLE `product_pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT '0',
  `image_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_pics` */

LOCK TABLES `product_pics` WRITE;

UNLOCK TABLES;

/*Table structure for table `product_reviews` */

DROP TABLE IF EXISTS `product_reviews`;

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` double DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `is_display` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_reviews` */

LOCK TABLES `product_reviews` WRITE;

UNLOCK TABLES;

/*Table structure for table `product_tags` */

DROP TABLE IF EXISTS `product_tags`;

CREATE TABLE `product_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL DEFAULT '0',
  `tag_id` int(11) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `product_tags` */

LOCK TABLES `product_tags` WRITE;

insert  into `product_tags`(`id`,`product_id`,`tag_id`,`count`,`created`,`updated`) values (1,1,1,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(2,1,2,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(3,1,3,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(4,1,4,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(5,1,5,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(6,2,6,0,'2017-06-13 14:09:05','2017-06-13 14:09:05'),(7,2,7,0,'2017-06-13 14:09:05','2017-06-13 14:09:05'),(8,2,8,0,'2017-06-13 14:09:05','2017-06-13 14:09:05'),(9,3,9,0,'2017-06-13 14:31:15','2017-06-13 14:31:15');

UNLOCK TABLES;

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `special_price` double DEFAULT NULL,
  `url_video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_status` int(1) DEFAULT '1',
  `is_wishlist` int(1) DEFAULT '1',
  `short_description` text COLLATE utf8_unicode_ci,
  `full_dsscription` text COLLATE utf8_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `products` */

LOCK TABLES `products` WRITE;

insert  into `products`(`id`,`name`,`sku`,`image`,`price`,`special_price`,`url_video`,`is_status`,`is_wishlist`,`short_description`,`full_dsscription`,`created_by`,`updated_by`,`created`,`updated`) values (1,'Restaurant Ionic Classy - Full Application with Firebase backend',NULL,'uploads/products/20170613/2942-restaurant-full-app-classy.jpg',23,0,'https://www.youtube.com/watch?v=wOaH4Cd8Pf0',1,1,'<p>&nbsp; &nbsp;&nbsp;What&rsquo;s new in version 1.2:<br />\r\n&nbsp; &nbsp; Integration with Facebook: Posts, Events and Albums from a Facebook page displayed in the app&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; What&rsquo;s new in version 1.1:<br />\r\n&nbsp; &nbsp; Different background image for each menu category card on Home screen</p>\r\n','<p>Restaurant Classy is a complete solution that consists of a mobile application and a powerful content backend with data updates. It suits any restaurant&rsquo;s needs to display its menu and receive orders from customers. The app provides an easy user interface helping customers to navigate through menu categories, place orders and proceed with the checkout. The Restaurant Classy app comes with a pack of useful features such as favorites, special offers and customized orders.</p>\r\n\r\n<h3>In a nutshell</h3>\r\n\r\n<p>The ultimate tool to build a mobile app for your restaurant, supporting offers, featuring products and more.Minimal setup effort, no code required.</p>\r\n\r\n<h3>Why choose Restaurant Classy</h3>\r\n\r\n<ul>\r\n	<li>No code knowledge or tech development required</li>\r\n	<li>Clean and user-friendly interface</li>\r\n	<li>Highly customizable structure, with modular architecture</li>\r\n	<li>Easy installation, detailed quick start guide</li>\r\n	<li>Easily maintainable data, via the Firebase Graphical User Interface</li>\r\n	<li>Free updates: new features added constantly</li>\r\n	<li>One codebase compatible with Android and iOS</li>\r\n	<li>Quick and efficient Support</li>\r\n</ul>\r\n',1,1,'2017-06-13 13:59:38','2017-06-13 13:59:38'),(2,'KuteShop – Multi-Purpose HTML Template',NULL,'uploads/products/20170613/1865-topthemepremium_kuteshop.jpg',30,NULL,'https://www.youtube.com/watch?v=wOaH4Cd8Pf0',1,1,'<p>KuteShop is a modern, clean and professional HTML Template, It is fully responsive, it looks stunning on all types of screens and devices.</p>\r\n','<p>It is super for fashion shop, digital shop, games shop, food shop, devices shop, household appliances shop or any other categories.</p>\r\n',1,1,'2017-06-13 14:09:04','2017-06-13 14:09:04'),(3,'Medicom – Medical & Health Template',NULL,'uploads/products/20170613/1590-medicom-medical-health.jpg',18,NULL,'https://www.youtube.com/watch?v=wOaH4Cd8Pf0',1,1,'<p><strong>Medicome</strong> is a Full Responsive Bootstrap 3, HTML5 and css3 template suitable for Hospital, Clinic, Dentist, medical &amp; health etc. I have also included a documentation folder to guide you through the code. I hope that I have covered everything but if there is something that you would like to know then I am happy to help out.&nbsp;</p>\r\n','<ul>\r\n	<li>Clean and Attractive Design</li>\r\n	<li>working ajax forms</li>\r\n	<li>W3C validated</li>\r\n	<li>Retina Ready</li>\r\n	<li>Wide &amp; Boxed Layout</li>\r\n	<li>4 Home Pages</li>\r\n	<li>Google Web Fonts</li>\r\n	<li>8 Color Variation</li>\r\n	<li>Drop Down Menu &amp; mega Drop Down Menu</li>\r\n	<li>Parallax Scrolling Effect</li>\r\n	<li>Awesome Font Icons</li>\r\n	<li>Well-commented</li>\r\n	<li>included bootstrarap3 non-responsive version</li>\r\n</ul>\r\n',1,1,'2017-06-13 14:31:15','2017-06-13 14:31:15');

UNLOCK TABLES;

/*Table structure for table `slidershow` */

DROP TABLE IF EXISTS `slidershow`;

CREATE TABLE `slidershow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `slidershow` */

LOCK TABLES `slidershow` WRITE;

insert  into `slidershow`(`id`,`name`,`image`,`description`,`link`,`position`,`rank`,`created`,`updated`) values (1,'Slide 1','1292-web_design.png','<p>Cool</p>\r\n','http://clickbuyall.dev',NULL,1,'2017-03-03 16:55:34','2017-03-17 11:06:22'),(2,'Slide 2','532-web_design_01.png','<p>Perfect</p>\r\n','http://clickbuyall.dev',NULL,2,'2017-03-03 17:00:24','2017-03-17 10:47:07');

UNLOCK TABLES;

/*Table structure for table `socials` */

DROP TABLE IF EXISTS `socials`;

CREATE TABLE `socials` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_link` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `is_display` int(20) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `socials` */

LOCK TABLES `socials` WRITE;

insert  into `socials`(`id`,`type`,`icon`,`social_link`,`is_display`,`created`,`updated`) values (1,'Facebook','social-facebook','http://facebook.com/designwebvn',1,'2017-02-16 14:30:31','2017-06-09 14:45:04'),(2,'Youtube','social-youtube','https://www.youtube.com/channel/UC7EkYADOxn_n5jiLXNGG0LA',1,'2017-03-23 10:21:32','2017-06-09 14:51:05'),(3,'Twitter','social-twitter','https://twitter.com',1,'2017-03-23 10:23:47','2017-06-09 14:51:27'),(4,'Google plus','social-gplus','https://plus.google.com',1,'2017-03-23 10:25:17','2017-06-09 14:51:45'),(5,'LinkedIn','social-linkedin','https://www.pinterest.com',1,'2017-03-23 10:26:10','2017-06-09 14:52:28');

UNLOCK TABLES;

/*Table structure for table `system_information` */

DROP TABLE IF EXISTS `system_information`;

CREATE TABLE `system_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `technical` text COLLATE utf8_unicode_ci,
  `modules` text COLLATE utf8_unicode_ci,
  `next_upgrade` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `system_information` */

LOCK TABLES `system_information` WRITE;

insert  into `system_information`(`id`,`author`,`version`,`technical`,`modules`,`next_upgrade`,`created`,`updated`) values (1,'Vinh Tran Quang - Designwebvn','clickbuyall vesion 1.0','<p>Yii Framework&nbsp;2.0.11.2, MySQL</p>\r\n\r\n<p>Jquery v2.2.4</p>\r\n\r\n<p>Bootstrap v3.3.7</p>\r\n\r\n<p>PHPExcel, ...</p>\r\n','<p>- Multi Language (current 6 languages English, Vietnamese, Japanese, <span style=\"color:rgb(34, 34, 34); font-family:consolas,lucida console,courier new,monospace; font-size:12px\">Fran&ccedil;ais,&nbsp;Deutsch,&nbsp;Русский</span>)</p>\r\n\r\n<p>- Export Data as Excel, Json, Html, Text&nbsp;...</p>\r\n\r\n<p>- Manage Catalog, Sales, Customers, Statistics, Posts (News), Configuration, System, ...</p>\r\n\r\n<p>- Payment method Paypal</p>\r\n\r\n<p>-&nbsp;Fully Responsive</p>\r\n\r\n<p>&nbsp;</p>\r\n','<p>- Promotions (Affiliates, Campaigns)</p>\r\n\r\n<p>- Payment method (Visa, Master card, American Express, ...&nbsp;Credit Cards processed by PayPal)</p>\r\n',NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` int(10) DEFAULT '0',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tags` */

LOCK TABLES `tags` WRITE;

insert  into `tags`(`id`,`name`,`slug`,`total`,`term_group`,`created`,`updated`) values (1,'Restaurant app','restaurant-app',1,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(2,'Restaurant Ionic','restaurant-ionic',1,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(3,'Restaurant full app','restaurant-full-app',1,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(4,'Restaurant Ionic Classy','restaurant-ionic-classy',1,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(5,'Restaurant Full Application','restaurant-full-application',1,0,'2017-06-13 13:59:39','2017-06-13 13:59:39'),(6,'food shop','food-shop',1,0,'2017-06-13 14:09:04','2017-06-13 14:09:04'),(7,'digital shop','digital-shop',1,0,'2017-06-13 14:09:05','2017-06-13 14:09:05'),(8,'games shop','games-shop',1,0,'2017-06-13 14:09:05','2017-06-13 14:09:05'),(9,'Medical theme','medical-theme',1,0,'2017-06-13 14:31:15','2017-06-13 14:31:15');

UNLOCK TABLES;

/*Table structure for table `tags_post` */

DROP TABLE IF EXISTS `tags_post`;

CREATE TABLE `tags_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tags_post` */

LOCK TABLES `tags_post` WRITE;

insert  into `tags_post`(`id`,`name`,`slug`,`total`,`created`,`updated`) values (1,'Robots','robots',1,'2017-03-29 14:59:09','2017-03-29 14:59:09'),(2,'customer','customer',1,'2017-03-29 14:59:09','2017-03-29 14:59:09'),(3,'University','university',1,'2017-03-29 14:59:09','2017-03-29 14:59:09'),(4,'Hiring Millennials','hiring-millennials',1,'2017-03-29 15:01:37','2017-03-29 15:01:37'),(5,'companies','companies',1,'2017-03-29 15:01:37','2017-03-29 15:01:37'),(6,'Information technology','information-technology',1,'2017-03-29 15:03:55','2017-03-29 15:18:06'),(7,'Dashboard','dashboard',1,'2017-03-29 15:03:56','2017-03-29 15:17:09'),(8,'IT project manager','it-project-manager',1,'2017-03-29 15:17:09','2017-03-29 15:17:09'),(9,'culture of quality','culture-of-quality',1,'2017-03-29 15:18:06','2017-03-29 15:18:06'),(10,'Product IT','product-it',1,'2017-03-29 15:19:02','2017-03-29 15:19:02'),(11,'corporate IT','corporate-it',1,'2017-03-29 15:19:02','2017-03-29 15:19:02'),(12,'Mental Health','mental-health',1,'2017-03-29 15:20:00','2017-03-29 15:20:00'),(13,'Rewards Leadership','rewards-leadership',1,'2017-03-29 15:20:00','2017-03-29 15:20:00'),(14,'Travel Agents','travel-agents',1,'2017-03-29 15:21:07','2017-03-29 15:21:07'),(15,'CEB analysis','ceb-analysis',1,'2017-03-29 15:21:07','2017-03-29 15:21:07');

UNLOCK TABLES;

/*Table structure for table `track` */

DROP TABLE IF EXISTS `track`;

CREATE TABLE `track` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `country_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_zone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `metro_code` int(11) DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `track_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `track` */

LOCK TABLES `track` WRITE;

UNLOCK TABLES;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `last_logged` datetime DEFAULT NULL,
  `is_online` int(1) DEFAULT '0',
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_read` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

LOCK TABLES `user` WRITE;

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`,`last_logged`,`is_online`,`fname`,`lname`,`address`,`phone`,`image`,`verify_key`,`id_read`,`created`,`updated`) values (1,'admin','fPqGv1yuQ-lKreZ_Ae4v1CWNARYAW13E','$2y$13$b2oCHIfdlerxwuA/cU90DuH1/uNq4RRt/GPJh3wMshmKTjph4gBHC','o2FOivPXXvFiUUXv7IjDn7seIfDggkNB_1492175779','admin@clickbuyall.com',20,10,1425269420,1492175779,'2015-03-24 11:26:16',1,'Vinh','Tran Quang','Da Nang','0905246855','uploads/customers/5300-IMG_1116.JPG',NULL,1,'2017-03-21 17:01:47','2017-03-21 15:38:07'),(2,'vinhtq','fPqGv1yuQ-lKreZ_Ae4v1CWNARYAW13E','$2y$13$IzUILhMGDjQ0pqzNK0I86uPmTgxFx0pPnnIuTjZ9HskI7mAKCmm3i',NULL,'infor@clickbuyall.com',10,10,0,1491630804,NULL,0,'Hoang','Tran Quang',NULL,NULL,NULL,NULL,1,'2017-03-21 17:01:54','2017-03-21 17:01:56'),(3,'designwebvn','OHiieEuDtfE4PztBj1syi3_L4qEyZ_fl','$2y$13$twfujgkDOdtpl.orAj1xyuuqO2g5.ikqpr/ZgR27yHWGhTnwpU0Ba',NULL,'designwebvn@gmail.com',10,10,1490028113,1491549343,NULL,0,'Vinh','Tran Quang','Da Nang','0905246868','uploads/customers/598-^0F89397AC7CFA68074D6A8CDCE9FAE140BDB0AFE5375267F75^pimgpsh_fullsize_distr.jpg',NULL,1,'2017-03-21 17:01:58','2017-03-21 14:58:23'),(4,'huyhoang','OHiieEuDtfE4PztBj1syi3_L4qEyZ_fl','$2y$13$twfujgkDOdtpl.orAj1xyuuqO2g5.ikqpr/ZgR27yHWGhTnwpU0Ba',NULL,'huyhoang@gmail.com',10,10,1490110539,1491549326,NULL,0,'Huy Hoang','Tran Quang','Da Nang','0905246855','uploads/customers/9422-Dat_Ma_Su_To.jpg',NULL,1,'2017-03-21 15:35:39','2017-03-21 15:36:40'),(8,'huykhanh','1iwffEYWeC1mnb1IuMw8kGc7gfbzRLcr','$2y$13$jiMQb768c1NaNSBh0HEVzO5/QHX0v9NP5yb1FhUnw6WZv.8yQJjvy',NULL,'nguyennhuynhikt@gmail.com',10,10,1490157748,1491549320,NULL,0,'Huy Khanh','Tran Quang','','','uploads/customers/7903-IMG_1117.JPG','23fd80dcbad6c847a8ea40473bd77d25',1,'2017-03-22 04:42:28','2017-03-31 07:30:15');

UNLOCK TABLES;

/*Table structure for table `widgets` */

DROP TABLE IF EXISTS `widgets`;

CREATE TABLE `widgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `is_active` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `widgets` */

LOCK TABLES `widgets` WRITE;

insert  into `widgets`(`id`,`title`,`content`,`is_active`,`created`,`updated`) values (1,'footer','<div class=\"row\">\r\n<div class=\"col-sm-4\">\r\n<div class=\"introduce-title\">Help Center</div>\r\n\r\n<ul>\r\n	<li><a href=\"/helpcenter/why-did-my-login-fail\">Why login fail?</a></li>\r\n	<li><a href=\"/helpcenter/feedback-ratings\">Feedback &amp; Ratings</a></li>\r\n	<li><a href=\"/helpcenter/customer-information\">Customer Protection</a></li>\r\n	<li><a href=\"/helpcenter/security-center\">Security Center</a></li>\r\n	<li><a href=\"/helpcenter/protect-my-purchase\">Protect my purchase</a></li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"col-sm-4\">\r\n<div class=\"introduce-title\">My Account</div>\r\n\r\n<ul>\r\n	<li><a href=\"/orders\">My Orders</a></li>\r\n	<li><a href=\"/wishlist\">My Wishlist</a></li>\r\n	<li><a href=\"/compare\">Compare</a></li>\r\n	<li><a href=\"/feedback\">Product feedback</a></li>\r\n	<li><a href=\"/infor\">My Information</a></li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"col-sm-4\">\r\n<div class=\"introduce-title\">Support</div>\r\n\r\n<ul>\r\n	<li><a href=\"/helpcenter/buyer_protection_guarantees\">Buyer Protection</a></li>\r\n	<li><a href=\"/helpcenter/account-information\">Account Information</a></li>\r\n	<li><a href=\"/helpcenter/payments\">Payments</a></li>\r\n	<li><a href=\"/helpcenter/shipping-delivery\">Shipping &amp; Delivery</a></li>\r\n	<li><a href=\"/contact.html\">Contact Us</a></li>\r\n</ul>\r\n</div>\r\n</div>\r\n',1,'2017-03-23 14:44:48','2017-04-11 15:14:55');

UNLOCK TABLES;

/*Table structure for table `wishlist` */

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `wishlist` */

LOCK TABLES `wishlist` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
