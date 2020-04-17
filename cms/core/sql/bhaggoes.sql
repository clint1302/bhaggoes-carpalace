/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.19-MariaDB : Database - bhaggoes_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bhaggoes_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bhaggoes_db`;

/*Table structure for table `car_brands` */

DROP TABLE IF EXISTS `car_brands`;

CREATE TABLE `car_brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `car_brands` */

insert  into `car_brands`(`brand_id`,`title`,`remark`,`status`,`date_created`) values (1,'Toyota',NULL,NULL,'2017-07-28');

/*Table structure for table `car_categories` */

DROP TABLE IF EXISTS `car_categories`;

CREATE TABLE `car_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `remark` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `car_categories` */

insert  into `car_categories`(`category_id`,`title`,`remark`) values (1,'Trucks',NULL),(2,'SUV',NULL),(3,'Sedan',NULL),(4,'Wagon',NULL),(5,'Bus',NULL),(6,'Hatchback',NULL),(7,'Machinery',NULL),(8,'Coupe',NULL),(9,'Pickup',NULL);

/*Table structure for table `car_images` */

DROP TABLE IF EXISTS `car_images`;

CREATE TABLE `car_images` (
  `carimage_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` bigint(20) NOT NULL,
  `img1` varchar(45) DEFAULT NULL,
  `img2` varchar(45) DEFAULT NULL,
  `img3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`carimage_id`),
  KEY `car id_idx` (`car_id`),
  CONSTRAINT `car id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `car_images` */

/*Table structure for table `car_models` */

DROP TABLE IF EXISTS `car_models`;

CREATE TABLE `car_models` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`model_id`),
  KEY `car brand_idx` (`brand_id`),
  CONSTRAINT `car brand` FOREIGN KEY (`brand_id`) REFERENCES `car_brands` (`brand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `car_models` */

insert  into `car_models`(`model_id`,`brand_id`,`title`,`remark`,`date_created`) values (1,1,'Harrier',NULL,'2017-08-02'),(2,1,'Vitz',NULL,'2017-08-05'),(3,1,'Premio',NULL,NULL),(4,1,'Corrola',NULL,'0000-00-00'),(5,1,'Ist',NULL,'2017-08-05');

/*Table structure for table `cars` */

DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `car_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `year` bigint(20) DEFAULT NULL,
  `fuel` varchar(45) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `steering` varchar(45) DEFAULT NULL,
  `transmission` varchar(45) DEFAULT NULL,
  `mileage` bigint(20) DEFAULT NULL,
  `chassis` varchar(80) DEFAULT NULL,
  `engine_capacity` bigint(20) DEFAULT NULL,
  `cylinders` int(11) DEFAULT NULL,
  `wheeldrive` varchar(45) DEFAULT NULL,
  `doors` int(11) DEFAULT NULL,
  `wheelchair` varchar(45) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`car_id`),
  KEY `car model_idx` (`model_id`),
  KEY `car category_idx` (`category_id`),
  CONSTRAINT `car category` FOREIGN KEY (`category_id`) REFERENCES `car_categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `car model` FOREIGN KEY (`model_id`) REFERENCES `car_models` (`model_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `cars` */

insert  into `cars`(`car_id`,`model_id`,`category_id`,`title`,`color`,`price`,`year`,`fuel`,`seats`,`steering`,`transmission`,`mileage`,`chassis`,`engine_capacity`,`cylinders`,`wheeldrive`,`doors`,`wheelchair`,`featured`,`status`,`date_created`,`img`) values (1,1,2,NULL,'White','100000',2018,'Petrol',5,'Right','Automatic',1000,'FS2000',4500,6,'Fulltime 4WD',4,'none',0,1,NULL,'52842018-toyota-harrier-reviews-first-drive.jpg'),(2,1,2,NULL,'Black','120000',2018,'petrol',5,'left','automatic',1800,'FP2200',3000,6,'optinal 4wd',5,'none',0,1,NULL,'52842018-toyota-harrier-reviews-first-drive.jpg'),(3,5,6,NULL,'grey','6000',2010,'petrol',5,'right','automatic',12000,'CS1200',2000,4,'2wd',5,'none',0,1,NULL,'52842018-toyota-harrier-reviews-first-drive.jpg'),(4,2,8,NULL,'Brown','5000',2008,'petrol',5,'right','automatic',15000,'PP300',2500,4,'2wd',5,'none',0,1,NULL,'52842018-toyota-harrier-reviews-first-drive.jpg'),(5,1,1,NULL,'Black','1000',2018,'petrol',5,'right','manual',78,'FSDDF44',4500,6,'optinal 4wd',5,'none',0,1,NULL,'52842018-toyota-harrier-reviews-first-drive.jpg'),(6,2,8,NULL,'Green','1200',2000,'petrol',5,'right','automatic',12,'TR21',4555,8,'fulltime 4wd',7,'yes',0,1,NULL,'52842018-toyota-harrier-reviews-first-drive.jpg'),(13,1,2,NULL,'White','80000',2018,'petrol',5,'right','automatic',15000,'GP550',4500,6,'fulltime 4wd',5,'none',0,1,'2017-08-08','52842018-toyota-harrier-reviews-first-drive.jpg'),(14,1,2,NULL,'Grey Black','220000',2017,'petrol',5,'right','automatic',30000,'CS887',4500,6,'fulltime 4wd',4,'none',0,1,'2017-08-08','4156harrier.jpg'),(15,1,8,NULL,'asd','34234',32423,'petrol',3,'left','automatic',23423,'21312FSF',4500,6,'optinal 4wd',4,'yes',0,0,'2017-08-08','1932018-toyota-harrier-reviews-first-drive.jpg');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
