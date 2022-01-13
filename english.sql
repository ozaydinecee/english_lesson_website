# Host: localhost  (Version 5.5.5-10.4.20-MariaDB)
# Date: 2022-01-13 17:24:02
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "instructor"
#

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

#
# Data for table "instructor"
#

INSERT INTO `instructor` VALUES (1,'Muhittin ','Gökmen','gokmen@gmail.com','1234','active'),(2,'Sultan','Turhan','turhan@gmail.com','1234','active'),(3,'Seniz','Demir','demirseniz@gmail.com','1234','active'),(4,'Tuna','Cakar','cakart@gmail.com','1234','inactive'),(5,'Suayb','Arslan','suaybars@gmail.com','1234','active'),(6,'Adem','Karahoca','ademkarahoca@gmail.com','1234','inactive');

#
# Structure for table "student"
#

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

#
# Data for table "student"
#

INSERT INTO `student` VALUES (6,'Ece','Özaydın','ozaydinecee@gmail.com','1234','active'),(7,'Aslı','Yılmaz','yilmazasl@mef.edu.tr','1234','active'),(8,'Admin','Admin','admin@gmail.com','1234','admin'),(11,'ahmethan','yılmaz','ahmethan@gmail.com','ece','inactive');

#
# Structure for table "lesson"
#

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `duration` varchar(11) DEFAULT NULL,
  `schedulestatus` varchar(20) DEFAULT NULL,
  `studentid` int(11) DEFAULT NULL,
  `instructorid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `studentid` (`studentid`),
  KEY `instructorid` (`instructorid`),
  CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`id`),
  CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`instructorid`) REFERENCES `instructor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

#
# Data for table "lesson"
#

INSERT INTO `lesson` VALUES (1,'2022-01-14','15:00:00','30 min','pending',6,1),(3,'2022-01-16','16:00:00','1 hour','pending',6,1),(4,'2022-01-17','17:00:00',NULL,'available',NULL,1),(5,'2022-01-17','17:00:00','1 hour','pending',6,2),(6,'2022-01-18','18:00:00',NULL,'available',NULL,2),(7,'2022-01-17','13:00:00',NULL,'available',NULL,2),(9,'2022-01-16','19:00:00','30 min','approved',6,2),(10,'2022-01-16','20:00:00','1 hour','pending',6,2),(12,'2022-01-20','20:00:00','','available',NULL,3),(19,'2022-01-21','21:00:00','1 hour','approved',7,2),(21,'2022-01-16','10:00:00','30 min','approved',7,3),(22,'2022-01-16','11:00:00','30 min','approved',7,4),(23,'2022-01-16','11:00:00',NULL,'available',NULL,2);
