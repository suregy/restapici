# Host: 127.0.0.1  (Version 5.6.21)
# Date: 2019-09-04 08:43:30
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "hobby"
#

DROP TABLE IF EXISTS `hobby`;
CREATE TABLE `hobby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mhsid` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "hobby"
#

INSERT INTO `hobby` VALUES (1,1,'Membaca'),(2,1,'Menulis'),(3,2,'Berenang');

#
# Structure for table "mahasiswa"
#

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nrp` char(9) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `jurusan` varchar(64) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "mahasiswa"
#

INSERT INTO `mahasiswa` VALUES (1,'087675623','wahyu','sandhikagalih@gmail.com','Teknik Informatika','8ee7027d078ea812d0f63180881a1e18.jpg'),(2,'087675624','Jajang','Jajang@gmail.com','Teknik Mesin','6b67dc5af1ab213dd05bc31fddc78b72.jpg');

#
# Structure for table "nilai"
#

DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(11) DEFAULT NULL,
  `matkul` varchar(50) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "nilai"
#

INSERT INTO `nilai` VALUES (1,1,'Kimia',7),(2,1,'Fisika',7),(3,2,'Kimia',8),(4,2,'Fisika',8);
