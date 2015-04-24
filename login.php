<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

<link rel="icon" href="imagenes/favicon.ico" type="image/x-icon" />
<script type="text/javascript"  src="js/jquery-1.8.1.min.js"></script>
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script src="js/bjqs.min.js"></script>
<script src="js/script.js"></script>

<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<link rel="stylesheet" type="text/css" href="css/estilos.css" media="screen" />
<link rel="stylesheet" href="css/formulario.css" type="text/css" media="screen"/>
    <title>TFG</title>  
    <script language="javascript">
		$(document).ready(function () { 
		  	
			$('nav ul li:first').addClass('activo')
			$('#informacion article').hide();
			$('#informacion article:first').show();

				$('nav ul li').on('click',function(){		
					$('nav ul li').removeClass('activo');
					$(this).addClass('activo')
					$('#informacion article').hide();
					var activeTab = $(this).find('a').attr('href');
					$(activeTab).show();
					
				});

		})

		
	</script>
</head>

<?php 
include_once("clases.php");
function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}


$dict = getRequest();
//session_start();
require_once("modelos/clsUtil.php"); 
$util= new clsUtil();


if(isset($dict['lang'])){
	$lang=$dict['lang'];
	$_SESSION['lang']=$lang;
}else if (isset($_SESSION['lang'])){
	$lang=$_SESSION['lang'];
}else{
	$lang='es';
}

$url=$util->getURL();

$noticia= new clsNoticia();					
$filas = $noticia->noticiasActivas();

$imagenes= new clsImagen();					
$filasImagen = $imagenes->imagenesActivas();

?>
<style>
#logo_inferior{
	
	width:800px;
	height:100px;
	margin:-20px auto 0 auto;
	position: relative;	
	border-style: solid;
	border-color: #2B4068;
	border-left-width: 0.2em;
	border-right-width: 0.2em; 
	border-bottom-width: 0.2em;
	border-radius: 0.5em;

	background: none repeat scroll 0 0 white; 
}
</style>
<body class="gradiante">
<div id="contenedor"> 
	<header id="logo">
		<div style="float:left">
			<a href="http://culm.unizar.es/">
			<img src="./imagenes/culm_blanco.png" />
		</a>
		</div>
		<div style="float:right;margin-right:20px;">			
			<a href="<?php echo $url?>?lang=es">
				<img src="./imagenes/esp.gif" />
			</a>
			<a href="<?php echo $url?>?lang=en">
				<img src="./imagenes/eng.gif" />
			</a>
		</div>
	</header >
	<div id="logo_inferior"  >
		<p class="cabecera_titulo">
		<span>Cursos de español como lengua extranjera</span>
		<br>
		<span style="font-size: 15px;">Vicerrectorado de Cultura y Política Social </span>
		</p>
	</div>

	
		<div id="slider">
		<ul class="bjqs">
			<?php while ($rowImg = mysqli_fetch_assoc($filasImagen)) { ?>
			<li>
				<img src="./imagenes/galeria/<?php echo $rowImg['imagen']; ?>" alt="" title="<?php echo $rowImg['titulo']; ?>">
			</li>
			<?php } ?>
		</ul>
	</div>
	
	<div id="sidebar" >
		<div id="loguearse"  class="bloqueSombra bloqueBordesAzul">
			 <h2><?php echo $util->trad("login",$lang);?></h2>
			 <form name="formLoguin" class="loguin_form" method="POST" action="do.php">
			 <input type="hidden" name="op" value="login">
			 	<div>
					<label for="login">Email</label>
					<input type="text" name="email" id="email" value="" />
				</div>
				<div >
					<label for="password">Password</label>
					<input type="password" name="contrasena" id="contrasena" value="" />
				</div>
				<div style="text-align:center;">
					
					<input type="button" value="<?php echo $util->trad("iniciar_sesion",$lang);?>" onclick="enviar()"/> 
					
				</div>
				<hr>
				<p >
					<a href="registro.php"><?php echo $util->trad("registro",$lang);?></a>
				</p>
				<p>
					<a href=""><?php echo $util->trad("recordar",$lang);?></a>
				</p>
				
			</form>
		</div>
	</div>
	
	<div id="contenido">
		<nav id="menu">
			<ul>
				<li ><a href="#tab1"><span style="font-size:26px; font-weight:bold;">I</span>NFORMACIÓN</a></li>
				<li ><a href="#tab2"><span style="font-size:26px; font-weight:bold;">N</span>OTICIAS</a></li>
				<li><a href="#tab3"><span style="font-size:26px; font-weight:bold;">C</span>ONTACTO</a></li>
			</ul>
		</nav>
		<section id="informacion" class="bloqueSombra bloqueBordesAzul">
			<article id="tab1">
			<p><span class="primeraPalabra"><span class="letraCapital">L</span>os</span> Cursos de Español como Lengua Extranjera de la Universidad de Zaragoza desarrollan su labor a lo largo de todo el año en Zaragoza y durante el verano trasladan su actividad a la ciudad de Jaca (Huesca), enclave turístico situado en los Pirineos.</p>
			<p><span class="primeraPalabra"><span class="letraCapital">L</span>a</span> Universidad de Zaragoza es pionera en la enseñanza de español a extranjeros desde 1927. Mantiene convenios con diferentes instituciones públicas y privadas de todo el mundo, colabora directamente con distintos organismos oficiales en la tarea de difusión del español (Instituto Cervantes, Consejerías de Educación de diversas Embajadas de España, Gobierno de Aragón, Ministerio de Educación, Cultura y Deporte) y es Centro Examinador Oficial para la obtención del Diploma de Español como Lengua Extranjera (DELE).</p>
			<p><span class="primeraPalabra"><span class="letraCapital">L</span>a</span> Universidad de Zaragoza cuenta con un gran reconocimiento internacional, como lo demuestra el elevado número de estudiantes extranjeros que la visitan dentro de los diferentes programas de cooperación en los que participa (Sócrates-Erasmus, Tempus, ALPA, Asia-Link, Leonardo, etc.). Sus Cursos de Español se integran en dichos programas y, además, organizan cursos específicos para las Universidades extranjeras que así lo solicitan.</p>
		  </article>
		  <article id="tab2">
			 <div>
				<?php while ($rowEmp = mysqli_fetch_assoc($filas)) { ?>
					<div class="destacados">
						<div >
							<span class="fechaNoticia"> <?php echo $rowEmp['fecha']; ?></span>
							<span class="tituloNoticia"><?php echo $rowEmp['titulo']; ?></span>
						</div>
						<div class="descripcionNoticia"><?php echo $rowEmp['descripcion']; ?></div>
					</div>
				<?php } ?>
		
			
			</div>
		  </article>
		  <article id="tab3">
		  <div>
			<fieldset  class="bloqueSombra bloqueRedondo" style="margin-top:10px; height:260px;">
				<legend class="bloqueRedondo">Contáctenos:</legend>
				<div id="bloque_contacto">
					<form name="formContacto"  id="formContacto" class="loguin_form" action="" method="post">
						<div>
							<label for="mail">E-mail: </label>
							<input type="text" name="mail" id="mail" class="input input_tamanhoNormal"/>
						</div>
						<div style="margin-top:15px">
							<label  for="mensaje">Comentario:</label>
							<textarea name="mensaje" class="" style=" width: 230px; height: 90px;"></textarea>
						</div>
						<div style="text-align:center;">
							<input type="submit" class="" value="Enviar" style="margin:5px 0 5px 0;">
						</div>
					</form>
				</div>
			</fieldset>
			<div id="mapa">
				<iframe src="mapa.php" class="mapa"></iframe> 
			</div>
			<div id="direccion">
					C/ Pedro Cerbuna,12 - 50009 Zaragoza - España 
					<div style="margin-top:5px;">
						<span style="font-weight:bold;">Tlf.:</span> 976 76 10 00
					</div>
				</div>
			</div>
		  </article>
		</section>
		
	</div>
	<script>
		function enviar(){
			var user= $('#email').val();
			var pass= $('#contrasena').val();
			
			if ((user=="") || (pass="")){
				alert('Compruebe que ha introducido todos los datos');
			}else{
				formLoguin.submit();
			}
		}		
	</script>
	
	
<?php include("bottom.php")?>
