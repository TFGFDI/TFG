<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

<link rel="icon" href="imagenes/favicon.ico" type="image/x-icon" />
<script type="text/javascript"  src="js/jquery-1.8.1.min.js"></script>
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" href="js/jquery-ui-1.11.3.custom/jquery-ui.css">  
<script src="js/jquery-ui-1.11.3.custom/jquery-ui.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- validaciones formularios  -->
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="js/additional-methods.js"></script>
  <script type="text/javascript" src="js/messages_es.js"></script>
  
  <script type="text/javascript"  src="js/validacionesFormularios.js"></script>
  
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
function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}


$dict = getRequest();

require_once("clases.php"); 
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

?>
<style>

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
			<a href="<?php echo $url?>?lang=en" style="margin-left:10px;" />
				<img src="./imagenes/eng.gif" />
			</a>
			<?php if(isset($_SESSION['nombre'])){?>
				<span  ><a href="do.php?op=salir" class="salir"><?php echo $util->trad("salir",$lang);?></a></span>
			<?php }?>
		</div>
		<?php if(isset($_SESSION['nombre'])){?>
		<div style="float:right;margin-right:15px">
			<span><?php echo $util->trad("hola",$lang);?> <b><?php echo $_SESSION['nombre']?></b></span>
		</div>
		<?php }?>
	</header >
	<div id="logo_inferior"  >
		<p class="cabecera_titulo">
		<span style=" font-weight: bold;">Cursos de español como lengua extranjera</span>
		<br>
		<span style="font-size: 15px;">Vicerrectorado de Cultura y Política Social </span>
		</p>
	</div>
	