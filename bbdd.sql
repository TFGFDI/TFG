
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

insert  into `traducciones`(`id`,`clave`,`valor`,`lang`) values (31,'login','Acceso Usuarios','es'),(32,'login','Login','en'),(33,'iniciar_sesion','Iniciar Sesion','es'),(34,'iniciar_sesion','Log me in','en'),(35,'registro','Registrate','es'),(36,'registro','Sign in','en'),(37,'recordar','¿No recuerda sus datos de acceso?','es'),(38,'recordar','Can\'t you access to your account?','en'),(39,'salir','Salir','es'),(40,'salir','Log Out','en'),(41,'formulario_registro','Formulario de registro','es'),(42,'formulario_registro','Registration Form','en'),(43,'nombre','Nombre','es'),(44,'nombre','Name','en'),(45,'apellidos','Apellidos','es'),(46,'apellidos','Surname','en'),(47,'nacionalidad','Nacionalidad','es'),(48,'nacionalidad','Nacionality','en'),(49,'nacimiento','Fecha Nacimiento','es'),(50,'nacimiento','Date of Birth','en'),(51,'sexo','Sexo','es'),(52,'sexo','Gender','en'),(53,'masculino','Masculino','es'),(54,'masculino','Male','en'),(55,'femenino','Femenino','es'),(56,'femenino','Female','en'),(57,'contrasena','Contrase&ntilde;a','es'),(58,'contrasena','Password','en'),(59,'repetir','Repetir Contrase&ntilde;a','es'),(60,'repetir','Repeat Password','en'),(61,'telefono','Tel&eacute;fono','es'),(62,'cp','C&oacute;digo Postal','es'),(63,'ciudad','Ciudad','es');


