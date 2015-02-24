/*TABLAS*/

create table `usuarios` (
	`id` int (11),
	`nombre` varchar (765),
	`apellidos` varchar (765),
	`sexo` varchar (9),
	`fechanacimiento` varchar (765),
	`email` varchar (765),
	`nacionalidad` varchar (765),
	`contrasena` varchar (765),
	`rol` varchar (3),
	`activo` tinyint (1)
); 

create table `traducciones` (
	`id` int (11),
	`clave` varchar (765),
	`valor` varchar (765),
	`lang` varchar (9)
); 

/*DATOS*/
insert into `traducciones` (`clave`, `valor`, `lang`) values('login','Acceso Usuarios','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('login','Login','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('iniciar_sesion','Iniciar Sesion','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('iniciar_sesion','Log me in','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('registro','Registrate','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('registro','Sign in','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('recordar','¿No recuerda sus datos de acceso?','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('recordar','Can\'t you access to your account?','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('salir','Salir','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('salir','Log Out','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('formulario_registro','Formulario de registro','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('formulario_registro','Registration Form','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('nombre','Nombre','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('nombre','Name','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('apellidos','Apellidos','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('apellidos','Surname','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('nacionalidad','Nacionalidad','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('nacionalidad','Nacionality','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('nacimiento','Fecha de Nacimiento','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('nacimiento','Date of Birth','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('sexo','Sexo','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('sexo','Gender','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('masculino','Masculino','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('masculino','Male','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('femenino','Femenino','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('femenino','Female','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('contrasena','Contrase&ntilde;a','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('contrasena','Password','en');
insert into `traducciones` (`clave`, `valor`, `lang`) values('repetir','Repetir Contrase&ntilde;a','es');
insert into `traducciones` (`clave`, `valor`, `lang`) values('repetir','Repeat Password','en');

