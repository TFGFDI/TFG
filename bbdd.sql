/*Mysql*/
CREATE TABLE `examenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_profesor` int(11) DEFAULT NULL,
  `nombre_profesor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `curso` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '0->privado 1->publico',
  `tiempo` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `examenes` */

insert  into `examenes`(`id`,`id_profesor`,`nombre_profesor`,`fecha`,`curso`,`tipo`,`estado`,`tiempo`,`activo`) values (1,5,'Antonio Sarasa','0000-00-00','2014/2015','Intensivo',1,2,1),(6,5,'Antonio Sarasa','2015-03-16','2014/2015','Intensivo',0,25,0),(7,6,'Alberto Verdejo','2015-03-14','2014/2015','Anual',1,30,0),(10,6,'Alberto Verdejo','2015-03-23','2015/2016','Anual',1,10,0),(11,5,'Antonio Sarasa','2015-03-24','2015/2016','Semestral',1,60,0),(13,5,'Antonio Sarasa','2015-04-15','2015/2016','Semestral',0,70,0);

/*Table structure for table `examenes_realizados` */

CREATE TABLE `examenes_realizados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tiempo_ini` datetime DEFAULT NULL,
  `tiempo_fin` datetime DEFAULT NULL,
  `aciertos` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `nota_desarrollo` float DEFAULT NULL,
  `corregido` int(1) DEFAULT NULL,
  `expirado` int(1) DEFAULT NULL,
  `comentarios` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `examenes_realizados` */

insert  into `examenes_realizados`(`id`,`id_examen`,`id_usuario`,`tiempo_ini`,`tiempo_fin`,`aciertos`,`nota`,`corregido`,`expirado`,`comentarios`) values (8,1,8,'2015-04-10 12:52:41','2015-04-10 12:55:41',0,0,1,0,''),(12,1,2,'2015-04-12 19:23:04','2015-04-12 19:25:16',3,1,1,0,''),(14,7,2,'2015-04-14 16:25:43','2015-04-14 16:35:43',0,0,0,0,'');

/*Table structure for table `preguntas_examen` */

CREATE TABLE `preguntas_examen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pregunta` text COLLATE utf8_spanish_ci,
  `respuesta1` text COLLATE utf8_spanish_ci,
  `respuesta2` text COLLATE utf8_spanish_ci,
  `respuesta3` text COLLATE utf8_spanish_ci,
  `respuesta4` text COLLATE utf8_spanish_ci,
  `solucion` text COLLATE utf8_spanish_ci,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `preguntas_examen` */

insert  into `preguntas_examen`(`id`,`id_examen`,`tipo`,`pregunta`,`respuesta1`,`respuesta2`,`respuesta3`,`respuesta4`,`solucion`,`activo`) values (1,1,'Test','Como se dice casa','Dog','House','Cat','Apple','b',NULL),(2,7,'Test','Como se dice perro ','Dog','House','Cat','Apple','a',NULL),(3,1,'Test','Como se dice perro ','Dog','House','Cat','Apple','a',NULL),(4,2,'Test','Como se dice manzana ','Dog','House','Cat','Apple','d',NULL),(5,1,'Desarrollo','Hablame de tus vacaciones','','','','','Desarrollo',NULL),(8,7,'Test','Pasado de Comer','ate','eat','eatten','eaten','a',NULL),(9,1,'Test','How do you say \'Hello\'','Hola','Adios','Caballo','Mariposa','a',NULL),(10,1,'Desarrollo','Desarrollo sobre tu mascota','','','','','Desarrollo',NULL),(11,1,'Desarrollo','Hablame de tus padres','','','','','Desarrollo',NULL),(12,7,'Test','Como se dice manzana','Dog','House','Cat','Apple','d',NULL);

/*Table structure for table `respuestas_alumnos` */

CREATE TABLE `respuestas_alumnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen_realizado` int(11) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `respuesta` text COLLATE utf8_spanish_ci,
  `solucion` text COLLATE utf8_spanish_ci,
  `comentarios` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `activo` enum('0','1') CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `activo` enum('0','1') COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `respuestas_alumnos` */

insert  into `respuestas_alumnos`(`id`,`id_examen_realizado`,`id_pregunta`,`id_usuario`,`respuesta`,`solucion`,`comentarios`) values (34,1,1,2,'b','b',''),(35,1,3,2,'a','a',''),(36,1,5,2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt at nibh vel feugiat. Suspendisse luctus nunc arcu, et tristique elit posuere vel. Morbi dui lorem, efficitur fringilla sem ac, cursus efficitur quam. Donec tincidunt mauris quis iaculis cursus. Nullam at sem nisl. Etiam porta aliquet libero, eu vehicula leo aliquet eu. Proin non urna vitae massa egestas pellentesque vel at lorem. Aliquam lacus quam, tempor vitae tortor ut, hendrerit finibus leo. Duis tempor, orci sed tempor porta, nulla arcu aliquam dolor, molestie fringilla eros mi et dui. Suspendisse potenti. Suspendisse potenti. Morbi rhoncus laoreet nisi sed hendrerit. Nunc nulla lacus, fringilla ut ligula nec, pellentesque vulputate odio. Donec mi nisi, commodo et velit at, viverra condimentum quam. Ut quis ante dignissim, tincidunt est vel, consectetur nunc. Mauris placerat nisi tortor, vitae tristique tortor luctus non.\r\n\r\nNulla arcu ipsum, dapibus et tincidunt eget, suscipit eget nulla. Duis nec dui risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque semper hendrerit nibh, a imperdiet nunc suscipit id. Quisque eget tellus vehicula, fermentum magna sit amet, scelerisque purus. Morbi dapibus, neque nec placerat feugiat, tellus nisl lobortis magna, id venenatis turpis dui at velit. Integer ante elit, semper ut erat ut, mollis venenatis mi. Morbi tortor nulla, molestie at porttitor at, viverra eget nisl. Donec vitae lectus pellentesque massa tristique blandit. Pellentesque iaculis congue quam, sed tristique sem sodales eu. Duis mi felis, viverra non magna et, ultrices gravida massa.\r\n\r\nFusce quis molestie nulla. Sed vulputate ex facilisis ex tincidunt, sit amet ultrices odio rutrum. Sed congue ipsum vel enim imperdiet luctus. Donec dignissim urna in massa eleifend, in pulvinar quam efficitur. Quisque bibendum congue accumsan. Suspendisse risus augue, fringilla ac urna id, consectetur vehicula nunc. Phasellus convallis venenatis eros nec porta. Curabitur in mi eget risus sollicitudin aliquet. Nunc gravida justo sit amet accumsan pharetra.\r\n\r\nPhasellus tristique erat quis commodo mollis. Curabitur sed sollicitudin odio. Proin pulvinar mi dolor, et pretium nisi consequat ac. Donec aliquam nisl non dapibus condimentum. Aenean non metus id sem vehicula bibendum. Vestibulum in vulputate justo, sed facilisis nisl. Aliquam vulputate lectus a lobortis ultricies. Phasellus mattis a diam ac porta. Pellentesque faucibus luctus lorem convallis aliquet. Sed ligula sem, molestie eu mi nec, condimentum mattis augue.','Desarrollo','<p>Muy bien</p>'),(37,1,9,2,'a','a',''),(38,1,10,2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt at nibh vel feugiat. Suspendisse luctus nunc arcu, et tristique elit posuere vel. Morbi dui lorem, efficitur fringilla sem ac, cursus efficitur quam. Donec tincidunt mauris quis iaculis cursus. Nullam at sem nisl. Etiam porta aliquet libero, eu vehicula leo aliquet eu. Proin non urna vitae massa egestas pellentesque vel at lorem. Aliquam lacus quam, tempor vitae tortor ut, hendrerit finibus leo. Duis tempor, orci sed tempor porta, nulla arcu aliquam dolor, molestie fringilla eros mi et dui. Suspendisse potenti. Suspendisse potenti. Morbi rhoncus laoreet nisi sed hendrerit. Nunc nulla lacus, fringilla ut ligula nec, pellentesque vulputate odio. Donec mi nisi, commodo et velit at, viverra condimentum quam. Ut quis ante dignissim, tincidunt est vel, consectetur nunc. Mauris placerat nisi tortor, vitae tristique tortor luctus non.\r\n\r\nNulla arcu ipsum, dapibus et tincidunt eget, suscipit eget nulla. Duis nec dui risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque semper hendrerit nibh, a imperdiet nunc suscipit id. Quisque eget tellus vehicula, fermentum magna sit amet, scelerisque purus. Morbi dapibus, neque nec placerat feugiat, tellus nisl lobortis magna, id venenatis turpis dui at velit. Integer ante elit, semper ut erat ut, mollis venenatis mi. Morbi tortor nulla, molestie at porttitor at, viverra eget nisl. Donec vitae lectus pellentesque massa tristique blandit. Pellentesque iaculis congue quam, sed tristique sem sodales eu. Duis mi felis, viverra non magna et, ultrices gravida massa.\r\n\r\nFusce quis molestie nulla. Sed vulputate ex facilisis ex tincidunt, sit amet ultrices odio rutrum. Sed congue ipsum vel enim imperdiet luctus. Donec dignissim urna in massa eleifend, in pulvinar quam efficitur. Quisque bibendum congue accumsan. Suspendisse risus augue, fringilla ac urna id, consectetur vehicula nunc. Phasellus convallis venenatis eros nec porta. Curabitur in mi eget risus sollicitudin aliquet. Nunc gravida justo sit amet accumsan pharetra.\r\n\r\nPhasellus tristique erat quis commodo mollis. Curabitur sed sollicitudin odio. Proin pulvinar mi dolor, et pretium nisi consequat ac. Donec aliquam nisl non dapibus condimentum. Aenean non metus id sem vehicula bibendum. Vestibulum in vulputate justo, sed facilisis nisl. Aliquam vulputate lectus a lobortis ultricies. Phasellus mattis a diam ac porta. Pellentesque faucibus luctus lorem convallis aliquet. Sed ligula sem, molestie eu mi nec, condimentum mattis augue.','Desarrollo','<p>Un poco regular</p>'),(39,1,11,2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt at nibh vel feugiat. Suspendisse luctus nunc arcu, et tristique elit posuere vel. Morbi dui lorem, efficitur fringilla sem ac, cursus efficitur quam. Donec tincidunt mauris quis iaculis cursus. Nullam at sem nisl. Etiam porta aliquet libero, eu vehicula leo aliquet eu. Proin non urna vitae massa egestas pellentesque vel at lorem. Aliquam lacus quam, tempor vitae tortor ut, hendrerit finibus leo. Duis tempor, orci sed tempor porta, nulla arcu aliquam dolor, molestie fringilla eros mi et dui. Suspendisse potenti. Suspendisse potenti. Morbi rhoncus laoreet nisi sed hendrerit. Nunc nulla lacus, fringilla ut ligula nec, pellentesque vulputate odio. Donec mi nisi, commodo et velit at, viverra condimentum quam. Ut quis ante dignissim, tincidunt est vel, consectetur nunc. Mauris placerat nisi tortor, vitae tristique tortor luctus non.\r\n\r\nNulla arcu ipsum, dapibus et tincidunt eget, suscipit eget nulla. Duis nec dui risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque semper hendrerit nibh, a imperdiet nunc suscipit id. Quisque eget tellus vehicula, fermentum magna sit amet, scelerisque purus. Morbi dapibus, neque nec placerat feugiat, tellus nisl lobortis magna, id venenatis turpis dui at velit. Integer ante elit, semper ut erat ut, mollis venenatis mi. Morbi tortor nulla, molestie at porttitor at, viverra eget nisl. Donec vitae lectus pellentesque massa tristique blandit. Pellentesque iaculis congue quam, sed tristique sem sodales eu. Duis mi felis, viverra non magna et, ultrices gravida massa.\r\n\r\nFusce quis molestie nulla. Sed vulputate ex facilisis ex tincidunt, sit amet ultrices odio rutrum. Sed congue ipsum vel enim imperdiet luctus. Donec dignissim urna in massa eleifend, in pulvinar quam efficitur. Quisque bibendum congue accumsan. Suspendisse risus augue, fringilla ac urna id, consectetur vehicula nunc. Phasellus convallis venenatis eros nec porta. Curabitur in mi eget risus sollicitudin aliquet. Nunc gravida justo sit amet accumsan pharetra.\r\n\r\nPhasellus tristique erat quis commodo mollis. Curabitur sed sollicitudin odio. Proin pulvinar mi dolor, et pretium nisi consequat ac. Donec aliquam nisl non dapibus condimentum. Aenean non metus id sem vehicula bibendum. Vestibulum in vulputate justo, sed facilisis nisl. Aliquam vulputate lectus a lobortis ultricies. Phasellus mattis a diam ac porta. Pellentesque faucibus luctus lorem convallis aliquet. Sed ligula sem, molestie eu mi nec, condimentum mattis augue.','Desarrollo','<p>Mal del todo</p>'),(40,7,2,2,'b','c',NULL),(41,7,8,2,'d','a',NULL);

/*Table structure for table `traducciones` */

CREATE TABLE `traducciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `traducciones` */

insert  into `traducciones`(`id`,`clave`,`valor`,`lang`) values (31,'login','Acceso Usuarios','es'),(32,'login','Login','en'),(33,'iniciar_sesion','Iniciar Sesion','es'),(34,'iniciar_sesion','Log me in','en'),(35,'registro','Registrate','es'),(36,'registro','Sign in','en'),(37,'recordar','¿No recuerda sus datos de acceso?','es'),(38,'recordar','Cant you access to your account?','en'),(39,'salir','Salir','es'),(40,'salir','Log Out','en'),(41,'formulario_registro','Formulario de registro','es'),(42,'formulario_registro','Registration Form','en'),(43,'nombre','Nombre','es'),(44,'nombre','Name','en'),(45,'apellidos','Apellidos','es'),(46,'apellidos','Surname','en'),(47,'nacionalidad','Nacionalidad','es'),(48,'nacionalidad','Nacionality','en'),(49,'nacimiento','Fecha Nacimiento','es'),(50,'nacimiento','Date of Birth','en'),(51,'sexo','Sexo','es'),(52,'sexo','Gender','en'),(53,'masculino','Masculino','es'),(54,'masculino','Male','en'),(55,'femenino','Femenino','es'),(56,'femenino','Female','en'),(57,'contrasena','Contrase&ntilde;a','es'),(58,'contrasena','Password','en'),(59,'repetir','Repetir Contrase&ntilde;a','es'),(60,'repetir','Repeat Password','en'),(61,'telefono','Tel&eacute;fono','es'),(62,'cp','C&oacute;digo Postal','es'),(63,'ciudad','Ciudad','es');


/* COntrasena encriptada: Y2NjY2Nj = cccccc */
CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `paises` */

insert  into `paises`(`id`,`nombre`,`codigo`) values (1,'Afghanistan','af'),(2,'Albania','al'),(3,'Algeria','dz'),(4,'American Samoa','as'),(5,'Andorra','ad'),(6,'Angola','ao'),(7,'Antigua and Barbuda','ai'),(8,'Argentina','ar'),(9,'Armenia','am'),(10,'Aruba','aw'),(11,'Australia','au'),(12,'Austria','at'),(13,'Azerbaijan','az'),(14,'Bahamas, The','bs'),(15,'Bahrain','bh'),(16,'Bangladesh','bd'),(17,'Barbados','bb'),(18,'Belarus','by'),(19,'Belgium','be'),(20,'Belize','bz'),(21,'Benin','bj'),(22,'Bermuda','bm'),(23,'Bhutan','bt'),(24,'Bolivia','bo'),(25,'Bosnia and Herzegovina','ba'),(26,'Botswana','bw'),(27,'Brazil','br'),(28,'Brunei Darussalam','bn'),(29,'Bulgaria','bg'),(30,'Burkina Faso','bf'),(31,'Burundi','bi'),(32,'Cambodia','kh'),(33,'Cameroon','cm'),(34,'Canada','ca'),(35,'Cape Verde','cv'),(36,'Cayman Islands','ky'),(37,'Central African Republic','cf'),(38,'Chad','td'),(39,'Chile','cl'),(40,'China','cn'),(41,'Colombia','co'),(42,'Comoros','km'),(43,'Congo, Dem. Rep.','cd'),(44,'Congo, Rep.','cg'),(45,'Costa Rica','cr'),(46,'Cote d Ivoire','ci'),(47,'Croatia','hr'),(48,'Cuba','cu'),(49,'Curacao','cw'),(50,'Cyprus','cy'),(51,'Czech Republic','cz'),(52,'Denmark','dk'),(53,'Djibouti','dj'),(54,'Dominica','dm'),(55,'Dominican Republic','do'),(56,'Ecuador','ec'),(57,'Egypt, Arab Rep.','eg'),(58,'El Salvador','sv'),(59,'Equatorial Guinea','gq'),(60,'Eritrea','er'),(61,'Estonia','ee'),(62,'Ethiopia','et'),(63,'Faeroe Islands','fo'),(64,'Fiji','fj'),(65,'Finland','fi'),(66,'France','fr'),(67,'French Polynesia','pf'),(68,'Gabon','ga'),(69,'Gambia, The','gm'),(70,'Georgia','ge'),(71,'Germany','de'),(72,'Ghana','gh'),(73,'Greece','gr'),(74,'Greenland','gl'),(75,'Grenada','gd'),(76,'Guam','gu'),(77,'Guatemala','gt'),(78,'Guinea','gn'),(79,'Guinea-Bissau','gw'),(80,'Guyana','gy'),(81,'Haiti','ht'),(82,'Honduras','hn'),(83,'Hong Kong SAR, China','hk'),(84,'Hungary','hu'),(85,'Iceland','is'),(86,'India','in'),(87,'Indonesia','id'),(88,'Iran, Islamic Rep.','ir'),(89,'Iraq','iq'),(90,'Ireland','ie'),(91,'Isle of Man','im'),(92,'Israel','il'),(93,'Italy','it'),(94,'Jamaica','jm'),(95,'Japan','jp'),(96,'Jordan','jo'),(97,'Kazakhstan','kz'),(98,'Kenya','ke'),(99,'Kiribati','ki'),(100,'Korea, Dem. Rep.','kp'),(101,'Korea, Rep.','kr'),(102,'Kosovo','xk'),(103,'Kuwait','kw'),(104,'Kyrgyz Republic','kg'),(105,'Lao PDR','la'),(106,'Latvia','lv'),(107,'Lebanon','lb'),(108,'Lesotho','ls'),(109,'Liberia','lr'),(110,'Libya','ly'),(111,'Liechtenstein','li'),(112,'Lithuania','lt'),(113,'Luxembourg','lu'),(114,'Macao SAR, China','mo'),(115,'Macedonia, FYR','mk'),(116,'Madagascar','mg'),(117,'Malawi','mw'),(118,'Malaysia','my'),(119,'Maldives','mv'),(120,'Mali','ml'),(121,'Malta','mt'),(122,'Marshall Islands','mh'),(123,'Mauritania','mr'),(124,'Mauritius','mu'),(125,'Mayotte','yt'),(126,'Mexico','mx'),(127,'Micronesia, Fed. Sts.','fm'),(128,'Moldova','md'),(129,'Monaco','mc'),(130,'Mongolia','mn'),(131,'Montenegro','me'),(132,'Morocco','ma'),(133,'Mozambique','mz'),(134,'Myanmar','mm'),(135,'Namibia','na'),(136,'Nepal','np'),(137,'Netherlands','nl'),(138,'New Caledonia','nc'),(139,'New Zealand','nz'),(140,'Nicaragua','ni'),(141,'Niger','ne'),(142,'Nigeria','ng'),(143,'Northern Mariana Islands','mp'),(144,'Norway','no'),(145,'Oman','om'),(146,'Pakistan','pk'),(147,'Palau','pw'),(148,'Panama','pa'),(149,'Papua New Guinea','pg'),(150,'Paraguay','py'),(151,'Peru','pe'),(152,'Philippines','ph'),(153,'Poland','pl'),(154,'Portugal','pt'),(155,'Puerto Rico','pr'),(156,'Qatar','wa'),(157,'Romania','ro'),(158,'Russian Federation','ru'),(159,'Rwanda','rw'),(160,'Samoa','ws'),(161,'San Marino','sm'),(162,'Sao Tome and Principe','st'),(163,'Saudi Arabia','sa'),(164,'Senegal','sn'),(165,'Serbia','rs'),(166,'Seychelles','sc'),(167,'Sierra Leone','sl'),(168,'Singapore','sg'),(169,'Slovak Republic','sk'),(170,'Slovenia','si'),(171,'Solomon Islands','sb'),(172,'Somalia','so'),(173,'South Africa','za'),(174,'South Sudan','ss'),(175,'Spain','es'),(176,'Sri Lanka','lk'),(177,'St. Kitts and Nevis','kn'),(178,'St. Lucia','lc'),(179,'St. Martin (French part)','mf'),(180,'St. Vincent and the Grenadines','vc'),(181,'Sudan','sd'),(182,'Suriname','sr'),(183,'Swaziland','sz'),(184,'Sweden','se'),(185,'Switzerland','ch'),(186,'Syrian Arab Republic','sy'),(187,'Tajikistan','tj'),(188,'Tanzania','tz'),(189,'Thailand','th'),(190,'Timor-Leste','tp'),(191,'Togo','tg'),(192,'Tonga','to'),(193,'Trinidad and Tobago','tt'),(194,'Tunisia','tn'),(195,'Turkey','tr'),(196,'Turkmenistan','tm'),(197,'Turks and Caicos Islands','tc'),(198,'Tuvalu','tv'),(199,'Uganda','ug'),(200,'Ukraine','ua'),(201,'United Arab Emirates','ae'),(202,'United Kingdom','uk'),(203,'United States','us'),(204,'Uruguay','uy'),(205,'Uzbekistan','uz'),(206,'Vanuatu','vu'),(207,'Venezuela, RB','ve'),(208,'Vietnam','vn'),(209,'Virgin Islands (U.S.)','vi'),(210,'West Bank and Gaza','ps'),(211,'Western Sahara','eh'),(212,'Yemen, Rep.','ye'),(213,'Zambia','zm'),(214,'Zimbabwe','zw');


CREATE TABLE `informacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `informaciones` text COLLATE utf8_spanish_ci,
  `activo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;