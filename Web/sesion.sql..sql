# phpMyAdmin MySQL-Dump
# http://phpwizard.net/phpMyAdmin/
#
# Host: localhost Database : Biblioteca
# --------------------------------------------------------

#
# Table structure for table 'sesion'
#

DROP TABLE IF EXISTS sesion;
CREATE TABLE sesion (
   id int(10) unsigned NOT NULL auto_increment,
   codigo varchar(20) NOT NULL,
   texto text NOT NULL,
   tiempo int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (id),
   KEY codigo (codigo),
   UNIQUE codigo_2 (codigo)
);
