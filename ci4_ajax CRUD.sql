/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.22-MariaDB : Database - ci4_datatables
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2022-07-07-052915','App\\Database\\Migrations\\Mahasiswa','default','App',1657171823,1);

/*Table structure for table `people` */

DROP TABLE IF EXISTS `people`;

CREATE TABLE `people` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `people` */

insert  into `people`(`id`,`name`,`phone`,`email`,`country`,`image`) values 
(11,'Warren Hammond','(884) 227-2597','blandit.at@google.couk','Mexico',NULL),
(12,'Harlan Collins','1-367-741-6865','mattis.velit@protonmail.com','Poland',NULL),
(13,'Oliver Daniels','(335) 276-4427','ullamcorper.duis@hotmail.ca','Philippines',NULL),
(14,'Karleigh Martin','1-422-356-8397','bibendum.ullamcorper@yahoo.couk','Indonesia',NULL),
(15,'Destiny Alford','1-362-759-4522','tortor.nibh@protonmail.couk','New Zealand',NULL),
(16,'Jakeem Kelley','1-174-680-1219','lectus.ante.dictum@hotmail.com','Costa Rica',NULL),
(17,'Ocean York','1-912-331-9227','dolor.dapibus@yahoo.ca','France',NULL),
(18,'Kaye Black','(632) 594-1588','dui.augue.eu@google.net','Netherlands',NULL),
(20,'Hope Macias','(514) 514-5385','eget@outlook.net',' Indonesia',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
