/*
SQLyog Community v12.4.0 (64 bit)
MySQL - 11.2.2-MariaDB : Database - metrics_project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`metrics_project` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `metrics_project`;

/*Table structure for table `error_log` */

DROP TABLE IF EXISTS `error_log`;

CREATE TABLE `error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `error_type` varchar(256) NOT NULL,
  `method` varchar(256) NOT NULL,
  `file` varchar(256) NOT NULL,
  `message` varchar(512) NOT NULL,
  `error` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Table structure for table `metrics` */

DROP TABLE IF EXISTS `metrics`;

CREATE TABLE `metrics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `hostname` varchar(128) NOT NULL,
  `distro` varchar(256) NOT NULL,
  `kernal` varchar(256) NOT NULL,
  `uptime` varchar(256) NOT NULL,
  `network_name` varchar(256) NOT NULL,
  `ip_address` varchar(128) NOT NULL,
  `received_mb` varchar(128) NOT NULL,
  `sent_mb` varchar(128) NOT NULL,
  `cpu_load` char(3) NOT NULL,
  `cpu_free` char(3) NOT NULL,
  `memory_load` char(3) NOT NULL,
  `memory_free` char(3) NOT NULL,
  `storage_used` char(3) NOT NULL,
  `storage_free` char(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
