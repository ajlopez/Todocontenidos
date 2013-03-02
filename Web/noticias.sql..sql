# phpMyAdmin MySQL-Dump
# http://phpwizard.net/phpMyAdmin/
#
# Host: localhost Database : Portal
# --------------------------------------------------------

#
# Table structure for table 'noticias'
#

DROP TABLE IF EXISTS noticias;
CREATE TABLE noticias (
   Id int(10) unsigned NOT NULL auto_increment,
   IdCategoria int(10) unsigned DEFAULT '0' NOT NULL,
   Titulo varchar(100) NOT NULL,
   Resumen text NOT NULL,
   Copete text NOT NULL,
   Texto text NOT NULL,
   Imagen varchar(100) NOT NULL,
   PRIMARY KEY (Id),
   KEY IdCategoria (IdCategoria)
);
