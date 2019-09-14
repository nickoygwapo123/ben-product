create database test;

use test;

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `Pname` varchar(100) NOT NULL,
  `Pdescription` varchar(100) NOT NULL,
  `Pprice` int(100) NOT NULL,
  `Pquantity` int(100) NOT NULL,
  PRIMARY KEY  (`id`)
);