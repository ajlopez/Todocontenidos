# phpMyAdmin MySQL-Dump
# http://phpwizard.net/phpMyAdmin/
#
# Host: localhost Database : todocontenidos

# --------------------------------------------------------
#
# Table structure for table 'articulos'
#

DROP TABLE IF EXISTS articulos;
CREATE TABLE articulos (
   Id int(11) NOT NULL auto_increment,
   Titulo varchar(100) NOT NULL,
   Contenido text NOT NULL,
   Resumen text NOT NULL,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Orden tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   Votos1 int(11) DEFAULT '0' NOT NULL,
   Votos2 int(11) DEFAULT '0' NOT NULL,
   Votos3 int(11) DEFAULT '0' NOT NULL,
   Votos4 int(11) DEFAULT '0' NOT NULL,
   Votos5 int(11) DEFAULT '0' NOT NULL,
   Imagen varchar(100) NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   FechaHoraAlta datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   FechaHoraModificacion datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Enlace varchar(100) NOT NULL,
   PRIMARY KEY (Id)
);

#
# Dumping data for table 'articulos'
#

INSERT INTO articulos (Id, Titulo, Contenido, Resumen, IdUsuario, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado, FechaHoraAlta, FechaHoraModificacion, Enlace) VALUES ( '1', 'Formularios en ASP', 'En este texto se explica la generacion y tratamiento de formularios en ASP', 'Tratamiento de formularios en ASP', '1', '0', '0', '0', '0', '0', '0', '0', '', '0', '2001-08-26 14:26:15', '2001-08-26 14:42:42', 'www.microsoft.com');
INSERT INTO articulos (Id, Titulo, Contenido, Resumen, IdUsuario, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado, FechaHoraAlta, FechaHoraModificacion, Enlace) VALUES ( '2', 'Nuevo Articulo', 'Nuevo', 'Nuevo', '1', '0', '0', '0', '0', '0', '0', '0', '', '0', '2001-08-26 14:50:16', '2001-08-26 14:50:16', '');

# --------------------------------------------------------
#
# Table structure for table 'categorias'
#

DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(60) NOT NULL,   Alias varchar(16) NOT NULL DEFAULT '',
   Detalle text NOT NULL,
   Resumen text NOT NULL,
   IdPadre int(11) DEFAULT '0' NOT NULL,   Terminos varchar(100) NOT NULL DEFAULT '',
   IdReferencia int(11) NOT NULL DEFAULT '0',   Estado tinyint(4) NOT NULL DEFAULT '0',   Visitas int(11) NOT NULL DEFAULT '0',   PRIMARY KEY (Id),
   KEY IdPadre (IdPadre)
);

#
# Dumping data for table 'categorias'
#

INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '1', 'Ciencias', 'Enlaces y contenidos de Física, Química, Astronomía, Biología.

Puedes colaborar enviando enlaces o contenidos.', 'Biología, Física, Geografía...', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '2', 'Internet', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '3', 'Artes y Humanidades', 'Las diversas artes y humanidades, todo sobre pintura, escultura, escritores, libros..', 'Libros, escritores, pintura...', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '4', 'Negocios', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '5', 'Empleo y Carrera', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '6', 'Educación', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '7', 'Entretenimiento', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '8', 'Familia y Padres', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '9', 'Regionales', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '10', 'Computación', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '11', 'Software', '', '', '10');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '12', 'Hardware', '', '', '10');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '13', 'Programación', '', '', '10');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '14', 'Física', '', '', '1');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '15', 'Química', '', '', '1');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '16', 'Matemáticas', '', '', '1');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '17', 'Astronomía', '', '', '1');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '18', 'Salud', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '19', 'Música', '', '', '3');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '20', 'Artes Plásticas', '', '', '3');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '21', 'Literatura', '', '', '3');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '22', 'Artes Escénicas', '', '', '3');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '23', 'Comercio Exterior', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '24', 'Agricultura', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '25', 'Ganadería', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '26', 'Industria', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '27', 'Universidades', '', '', '6');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '28', 'Juegos', '', '', '7');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '29', 'Cine', '', '', '7');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '30', 'Música', '', '', '7');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '31', 'Tiempo Libre', '', '', '7');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '32', 'Turismo', '', '', '7');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '33', 'Buscadores', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '34', 'Páginas Personales', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '35', 'Recursos Gráficos', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '36', 'Educación a Distancia', '', '', '6');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '37', 'Biología', '', '', '1');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '38', 'Sistemas Operativos', '', '', '10');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '39', 'Bases de Datos', '', '', '10');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '40', 'Seguridad y Hacking', '', '', '10');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '41', 'Celebridades', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '42', 'Portales Horizontales', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '43', 'Portales Verticales', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '44', 'Comercio Electrónico', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '45', 'Subastas', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '46', 'WebMail', '', '', '2');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '47', 'Museos', '', '', '6');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '48', 'Bibliotecas', '', '', '6');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '49', 'Gobierno', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '50', 'España', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '51', 'Argentina', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '52', 'México', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '53', 'Brasil', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '54', 'Chile', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '55', 'Estados Unidos', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '56', 'Venezuela', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '57', 'Colombia', '', '', '9');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '58', 'Teatro', '', '', '3');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '59', 'Cine', '', '', '3');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '60', 'Danza', '', '', '3');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '61', 'Empresas', '', '', '10');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '62', 'Banca', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '63', 'Petróleo', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '64', 'Metalurgia', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '65', 'Automotores', '', '', '4');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '66', 'Algebra', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '67', 'Cálculo', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '68', 'Probabilidad', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '69', 'Estadística', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '70', 'Lógica', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '71', 'Geometría', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '72', 'Teoría de Números', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '73', 'Matemáticos', '', '', '16');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '74', 'Zoología', '', '', '37');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '75', 'Botánica', '', '', '37');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '76', 'Genética', '', '', '37');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '77', 'Obesidad', '', '', '18');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '78', 'Diabetes', '', '', '18');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '79', 'Bulimia y Anorexia', '', '', '18');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '80', 'Embarazo', '', '', '18');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '81', 'Smalltalk', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '82', 'C/C++', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '83', 'COBOL', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '84', 'Pascal', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '85', 'Windows', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '86', 'Linux', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '87', 'Visual Basic', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '88', 'Visual Fox', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '89', 'Delphi', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '90', 'Sun', '', '', '61');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '91', 'Oracle', '', '', '61');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '92', 'Microsoft', '', '', '61');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '93', 'Dell', '', '', '61');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '94', 'Compaq', '', '', '61');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '95', 'Oracle', '', '', '39');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '96', 'MS SQL Server', '', '', '39');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '97', 'MySQL', '', '', '39');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '98', 'Informix', '', '', '39');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '99', 'DB2', '', '', '39');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '100', 'Sybase', '', '', '39');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '101', 'Interbase', '', '', '39');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '102', 'Software Administrativo', '', '', '11');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '103', 'Antivirus', '', '', '11');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '104', 'Mensajería Instantánea', '', '', '11');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '105', 'Diseño Gráfico', '', '', '11');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '106', 'Hogar', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '107', 'Decoración', '', '', '106');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '108', 'Jardinería', '', '', '106');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '109', 'Adolescentes', '', 'Sitios para adolescentes, citas, famosas y famosos...', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '110', 'Niños', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '111', 'Tecnología', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '112', 'Turismo', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '113', 'Paises y Ciudades', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '114', 'Dinero', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '115', 'Industria', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '116', 'Compras', 'Los sitios de compras de Internet, formas de pago, ofertas.', 'Sitios de compra, ofertas, formas de pago...', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '117', 'C Sharp', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '118', 'Eiffel', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '119', 'Java', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '120', 'Deportes', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '121', 'Noticias', 'Los sitios de Noticias en Internet. Diarios, revistas, periódicos, editoriales, radio y televisión.', 'Sitios de Noticias, Diarios, Periódicos, Radios, Noticieros...', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '122', 'Juegos', 'Todo sobre Juegos, en línea y fuera de línea. Juegos de tablero, de rol, apuestas, en red.', 'Juegos de tablero, en línea, apuestas...', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '123', 'Culturas', 'Culturas del mundo. Costumbres.', 'Culturas del mundo, Costumbres...', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '124', 'Oncología', '', '', '18');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '125', 'Religiones', '', '', '0');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '126', 'Libros', '', '', '116');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '127', 'CDs', '', '', '116');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '128', 'DVDs', '', '', '116');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '129', 'Regalos', '', '', '116');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '130', 'Ropa', '', '', '116');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '131', 'Juegos de Tablero', '', '', '122');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '132', 'Ajedrez', '', '', '131');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '133', 'Go', '', '', '131');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '134', 'Backgammon', '', '', '131');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '135', 'Juegos de Naipes', '', '', '122');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '136', 'Poker', '', '', '135');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '137', 'Bridge', '', '', '135');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '138', 'Solitarios', '', '', '135');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '139', 'Canasta', '', '', '135');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '140', 'Geografía', '', '', '1');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '141', 'América Latina', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '142', 'Europa', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '143', 'España', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '144', 'Estados Unidos', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '145', 'Canadá', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '146', 'Asia', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '147', 'Africa', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '148', 'Oceanía', '', '', '113');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '149', 'Galicia', '', '', '143');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '150', 'Cataluña', '', '', '143');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '151', 'Barcelona', '', '', '143');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '152', 'Madrid', '', '', '143');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '153', 'Málaga', '', '', '143');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '154', 'Cádiz', '', '', '143');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '155', 'Andalucía', '', '', '143');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '156', 'Argentina', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '157', 'Brasil', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '158', 'Chile', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '159', 'México', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '160', 'Venezuela', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '161', 'Colombia', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '162', 'Uruguay', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '163', 'Paraguay', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '164', 'Perú', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '165', 'Ecuador', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '166', 'Bolivia', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '167', 'Guatemala', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '168', 'Nicaragua', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '169', 'Costa Rica', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '170', 'Cuba', '', '', '141');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '171', 'Stocks y Acciones', '', '', '114');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '172', 'Finanzas Personales', '', '', '114');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '173', 'Banca', '', '', '114');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '174', 'Préstamos', '', '', '114');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '175', 'Tarjetas de Crédito', '', '', '114');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '176', 'Formas de Pago en Internet', '', '', '114');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '177', 'Formas de Pago en Internet', '', '', '114');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '178', 'Futbol', '', '', '120');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '179', 'Basquetbol', '', '', '120');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '180', 'Beisbol', '', '', '120');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '181', 'Atletismo', '', '', '120');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '182', 'Buscadores Regionales', '', '', '33');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '183', 'Buscadores Temáticos', '', '', '33');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '184', 'PowerBuilder', '', '', '13');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '185', 'Linux', '', '', '38');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '186', 'Windows', '', '', '38');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '187', 'Unix', '', '', '38');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '188', 'Mac OS', '', '', '38');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '189', 'Apple', '', '', '61');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '190', 'Equipos', '', '', '178');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '191', 'Argentina', '', '', '190');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '192', 'España', '', '', '190');
INSERT INTO categorias (Id, Descripcion, Detalle, Resumen, IdPadre) VALUES ( '193', 'Brasil', '', '', '190');

# --------------------------------------------------------
#
# Table structure for table 'categoriasarticulos'
#

DROP TABLE IF EXISTS categoriasarticulos;
CREATE TABLE categoriasarticulos (
   Id int(11) NOT NULL auto_increment,
   IdArticulo int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdArticulo (IdArticulo, IdCategoria)
);

#
# Dumping data for table 'categoriasarticulos'
#

INSERT INTO categoriasarticulos (Id, IdArticulo, IdCategoria, IdEstado) VALUES ( '1', '1', '11', '0');
INSERT INTO categoriasarticulos (Id, IdArticulo, IdCategoria, IdEstado) VALUES ( '2', '1', '10', '0');

# --------------------------------------------------------
#
# Table structure for table 'categoriasitems'
#

DROP TABLE IF EXISTS categoriasitems;
CREATE TABLE categoriasitems (
   Id int(11) NOT NULL auto_increment,
   IdItem int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdCategoria (IdCategoria),
   KEY IdItem (IdItem)
);

#
# Dumping data for table 'categoriasitems'
#

INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '1', '1', '5', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '2', '6', '61', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '3', '6', '39', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '4', '12', '116', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '5', '12', '129', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '6', '11', '127', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '7', '10', '126', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '8', '9', '126', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '9', '8', '110', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '10', '3', '33', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '11', '13', '40', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '12', '5', '61', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '13', '5', '39', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '14', '15', '61', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '15', '16', '61', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '16', '17', '119', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '17', '18', '178', '0');
INSERT INTO categoriasitems (Id, IdItem, IdCategoria, IdEstado) VALUES ( '18', '6', '98', '0');

# --------------------------------------------------------
#
# Table structure for table 'categoriasnoticias'
#

DROP TABLE IF EXISTS categoriasnoticias;
CREATE TABLE categoriasnoticias (
   Id int(11) NOT NULL auto_increment,
   IdNoticia int(11) DEFAULT '0' NOT NULL,
   IdCategoria int(11) DEFAULT '0' NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdNoticia (IdNoticia),
   KEY IdCategoria (IdCategoria)
);

#
# Dumping data for table 'categoriasnoticias'
#

INSERT INTO categoriasnoticias (Id, IdNoticia, IdCategoria, IdEstado) VALUES ( '1', '1', '11', '0');
INSERT INTO categoriasnoticias (Id, IdNoticia, IdCategoria, IdEstado) VALUES ( '2', '2', '10', '0');
INSERT INTO categoriasnoticias (Id, IdNoticia, IdCategoria, IdEstado) VALUES ( '3', '3', '11', '0');

# --------------------------------------------------------
#
# Table structure for table 'items'
#

DROP TABLE IF EXISTS items;
CREATE TABLE items (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(100) NOT NULL,
   Detalle text NOT NULL,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Url varchar(100) NOT NULL,
   Orden tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   Votos1 int(11) DEFAULT '0' NOT NULL,
   Votos2 int(11) DEFAULT '0' NOT NULL,
   Votos3 int(11) DEFAULT '0' NOT NULL,
   Votos4 int(11) DEFAULT '0' NOT NULL,
   Votos5 int(11) DEFAULT '0' NOT NULL,
   Imagen varchar(100) NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'items'
#

INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '1', 'Empleo Virtual 2000', 'Sitio de empleo. Teletrabajo. Ingrese su CV gratuitamente. Avisos de Empleo.', '1', 'www.empleovirtual2000.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '2', 'Yahoo', 'El buscador por excelencia', '1', 'www.yahoo.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '3', 'Google', 'Indexador de todas las páginas de Internet', '1', 'www.google.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '4', 'Inktomi', 'Indexador y buscador de páginas.', '1', 'www.inktomi.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '5', 'Sybase', '', '1', 'www.sybase.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '6', 'Informix', '', '1', 'www.informix.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '7', 'FoxKids', '', '1', 'www.foxkids.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '8', 'Disney Latino', '', '1', 'www.disneylatino.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '9', 'Librería Santa Fe', '', '1', 'www.lsf.com.ar', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '10', 'Yenni', '', '1', 'www.yenni.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '11', 'Musimundo', '', '1', 'www.musimundo.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '12', 'Fiera', '', '1', 'www.fiera.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '13', 'Security Focus', 'El portal de la seguridad. Enlaces, foros, novedades de bugs, exploits...', '1', 'www.securityfocus.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '14', 'Patagon.com', '', '1', 'www.patagon.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '15', 'Apple', '', '1', 'www.apple.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '16', 'Sun', '', '1', 'www.sun.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '17', 'Java en Sun', '', '1', 'java.sun.com', '0', '0', '0', '0', '0', '0', '0', '', '0');
INSERT INTO items (Id, Descripcion, Detalle, IdUsuario, Url, Orden, Visitas, Votos1, Votos2, Votos3, Votos4, Votos5, Imagen, IdEstado) VALUES ( '18', 'SuperGol', '', '1', 'www.supergol.com', '0', '0', '0', '0', '0', '0', '0', '', '0');

# --------------------------------------------------------
#
# Table structure for table 'noticias'
#

DROP TABLE IF EXISTS noticias;
CREATE TABLE noticias (
   Id int(10) unsigned NOT NULL auto_increment,
   Titulo varchar(100) NOT NULL,
   Resumen text NOT NULL,
   IdUsuario int(11) DEFAULT '0' NOT NULL,
   Copete text NOT NULL,
   Texto text NOT NULL,
   Imagen varchar(100) NOT NULL,
   TextoImagen text NOT NULL,
   Orden tinyint(4) DEFAULT '0' NOT NULL,
   Visitas int(11) DEFAULT '0' NOT NULL,
   IdEstado tinyint(4) DEFAULT '0' NOT NULL,
   VigenciaDesde date,
   VigenciaHasta date,
   PRIMARY KEY (Id),
   KEY IdUsuario (IdUsuario)
);

#
# Dumping data for table 'noticias'
#

INSERT INTO noticias (Id, Titulo, Resumen, IdUsuario, Copete, Texto, Imagen, TextoImagen, Orden, Visitas, IdEstado, VigenciaDesde, VigenciaHasta) VALUES ( '1', 'Lanzamiento de OX', 'El nuevo sistema operativo de Mac esta en la calle', '1', '', 'Texto del articulo', '', '', '0', '0', '0', '0000-00-00', '0000-00-00');
INSERT INTO noticias (Id, Titulo, Resumen, IdUsuario, Copete, Texto, Imagen, TextoImagen, Orden, Visitas, IdEstado, VigenciaDesde, VigenciaHasta) VALUES ( '2', 'Prueba', 'Prueba', '1', 'Prueba', 'Prueba', '', '', '0', '0', '0', '0000-00-00', '0000-00-00');
INSERT INTO noticias (Id, Titulo, Resumen, IdUsuario, Copete, Texto, Imagen, TextoImagen, Orden, Visitas, IdEstado, VigenciaDesde, VigenciaHasta) VALUES ( '3', 'Kylix', '', '1', '', 'Kylix
', '', '', '0', '0', '0', '0000-00-00', '0000-00-00');

# --------------------------------------------------------
#
# Table structure for table 'paises'
#

DROP TABLE IF EXISTS paises;
CREATE TABLE paises (
   Id int(11) NOT NULL auto_increment,
   Descripcion varchar(40) NOT NULL,
   PRIMARY KEY (Id),
   KEY Descripcion (Descripcion)
);

#
# Dumping data for table 'paises'
#

INSERT INTO paises (Id, Descripcion) VALUES ( '1', 'Argentina');
INSERT INTO paises (Id, Descripcion) VALUES ( '2', 'España');
INSERT INTO paises (Id, Descripcion) VALUES ( '3', 'México');

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

#
# Dumping data for table 'sesion'
#

INSERT INTO sesion (id, codigo, texto, tiempo) VALUES ( '8', 'sdeyqvbydfdiydqh', 'a:10:{s:15:\"CategoriaEnlace\";s:29:\"/todocontenidos/Cat.php?Id=86\";s:9:\"UsuarioId\";s:1:\"1\";s:13:\"UsuarioCodigo\";s:7:\"ajlopez\";s:13:\"UsuarioNombre\";s:5:\"Angel\";s:15:\"UsuarioApellido\";s:5:\"Lopez\";s:22:\"UsuarioEsAdministrador\";s:1:\"1\";s:10:\"ItemEnlace\";s:29:\"/todocontenidos/Cat.php?Id=86\";s:13:\"UsuarioEnlace\";s:32:\"/todocontenidos/Usuario.php?Id=1\";s:13:\"NoticiaEnlace\";s:35:\"/todocontenidos/Categoria.php?Id=10\";s:14:\"ArticuloEnlace\";s:33:\"/todocontenidos/Articulo.php?Id=1\";}', '998850381');

# --------------------------------------------------------
#
# Table structure for table 'tablas'
#

DROP TABLE IF EXISTS tablas;
CREATE TABLE tablas (
   Id int(11) NOT NULL auto_increment,
   Codigo varchar(30) NOT NULL,
   Descripcion varchar(50) NOT NULL,
   Singular varchar(50) NOT NULL,
   Plural varchar(50) NOT NULL,
   IdGenero tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   UNIQUE Codigo (Codigo)
);

#
# Dumping data for table 'tablas'
#

INSERT INTO tablas (Id, Codigo, Descripcion, Singular, Plural, IdGenero) VALUES ( '1', 'paises', 'Paises', 'Pais', 'Paises', '1');

# --------------------------------------------------------
#
# Table structure for table 'usuarios'
#

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
   Id int(11) NOT NULL auto_increment,
   Codigo varchar(16) NOT NULL,
   Contrasenia varchar(16) NOT NULL,
   IdReferente int(11) DEFAULT '0' NOT NULL,
   Nombre varchar(40) NOT NULL,
   Apellido varchar(40) NOT NULL,
   Email varchar(50) NOT NULL,
   Comentarios text NOT NULL,
   IdSexo tinyint(4) DEFAULT '0' NOT NULL,
   IdPais int(11) DEFAULT '0' NOT NULL,
   Provincia varchar(30) NOT NULL,
   Ciudad varchar(40) NOT NULL,
   CodigoPostal varchar(10) NOT NULL,
   FechaNacimiento date DEFAULT '0000-00-00' NOT NULL,
   EsAdministrador tinyint(4) DEFAULT '0' NOT NULL,
   FechaHoraAlta datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   FechaHoraModificacion datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   FechaHoraUltimoIngreso datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   Ingresos int(11) DEFAULT '0' NOT NULL,
   Puntos int(11) DEFAULT '0' NOT NULL,
   Pendientes int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (Id),
   UNIQUE Codigo (Codigo),
   KEY Email (Email),
   KEY IdReferente (IdReferente)
);

#
# Dumping data for table 'usuarios'
#

INSERT INTO usuarios (Id, Codigo, Contrasenia, IdReferente, Nombre, Apellido, Email, Comentarios, IdSexo, IdPais, Provincia, Ciudad, CodigoPostal, FechaNacimiento, EsAdministrador, FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso, Ingresos, Puntos, Pendientes) VALUES ( '1', 'ajlopez', 'ajlopez', '0', 'Angel', 'Lopez', 'webmaster@ajlopez.com', '', '0', '1', '', '', '', '0000-00-00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2001-08-26 10:13:27', '3', '0', '0');
INSERT INTO usuarios (Id, Codigo, Contrasenia, IdReferente, Nombre, Apellido, Email, Comentarios, IdSexo, IdPais, Provincia, Ciudad, CodigoPostal, FechaNacimiento, EsAdministrador, FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso, Ingresos, Puntos, Pendientes) VALUES ( '2', 'ragnarok', 'ragnarok', '0', 'Rag', 'Narok', 'raknarog@hotmail.com', '', '0', '2', '', '', '', '0000-00-00', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '0');
INSERT INTO usuarios (Id, Codigo, Contrasenia, IdReferente, Nombre, Apellido, Email, Comentarios, IdSexo, IdPais, Provincia, Ciudad, CodigoPostal, FechaNacimiento, EsAdministrador, FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso, Ingresos, Puntos, Pendientes) VALUES ( '3', 'pepe', 'pepe', '0', 'Pepito', 'Pepe', 'email', '', '1', '1', 'Provincia', 'Ciudad', '1000', '1970-09-08', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2001-07-09 15:55:37', '1', '0', '0');
INSERT INTO usuarios (Id, Codigo, Contrasenia, IdReferente, Nombre, Apellido, Email, Comentarios, IdSexo, IdPais, Provincia, Ciudad, CodigoPostal, FechaNacimiento, EsAdministrador, FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso, Ingresos, Puntos, Pendientes) VALUES ( '4', 'bgates', 'bgates', '0', 'William H', 'Gates III', 'bgates@microsoft.com', '', '1', '2', '', '', '', '1970-01-01', '0', '2001-07-09 15:46:19', '2001-07-09 15:51:09', '2001-07-09 15:53:22', '1', '0', '0');
INSERT INTO usuarios (Id, Codigo, Contrasenia, IdReferente, Nombre, Apellido, Email, Comentarios, IdSexo, IdPais, Provincia, Ciudad, CodigoPostal, FechaNacimiento, EsAdministrador, FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso, Ingresos, Puntos, Pendientes) VALUES ( '5', 'sjobs', 'sjobs', '0', 'Steve', 'Jobs', 'sjobs@apple.com', '', '1', '2', '', '', '', '1970-02-01', '0', '2001-07-09 15:54:52', '0000-00-00 00:00:00', '2001-07-09 15:54:52', '1', '0', '0');
---- Table structure for table `eventos`--DROP TABLE IF EXISTS eventos;CREATE TABLE eventos (  Id int(11) NOT NULL AUTO_INCREMENT,  IdUsuario int(11) NOT NULL DEFAULT '0',  FechaHora datetime NOT NULL DEFAULT '0000-00-00 00:00:00',  Tipo char(2) NOT NULL DEFAULT '',  Parametro varchar(255) NOT NULL DEFAULT '',  Subparametro varchar(255) NOT NULL DEFAULT '',  IdParametro int(11) NOT NULL DEFAULT '0',  Ip varchar(20) NOT NULL DEFAULT '',  PRIMARY KEY (`Id`),  KEY `IdUsuario` (`IdUsuario`));