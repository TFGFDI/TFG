<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

<link rel="icon" href="../imagenes/favicon.ico" type="image/x-icon" />
<script type="text/javascript"  src="../js/jquery-1.8.1.min.js"></script>
<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" href="../js/jquery-ui-1.11.3.custom/jquery-ui.css">  
<script src="../js/jquery-ui-1.11.3.custom/jquery-ui.js"></script>
<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<link rel="stylesheet" type="text/css" href="../css/estilos.css" media="screen" />
<link rel="stylesheet" href="../css/formulario.css" type="text/css" media="screen"/>
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

require_once("../modelos/clsUtil.php"); 
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
<body class="gradiante" >
<div id="contenedor" > 
	<header id="logo">
		<div style="float:left">
			<a href="http://www.unizar.es/">
				<img src="../imagenes/titulo.png" />
			</a>
		</div>
		<div style="float:right;margin-right:20px;">
			<span style="margin-right:15px"><a href="../do.php?op=salir">Salir</a></span>
			
		</div>
	</header >
	<div id="logo_inferior"  >
		<a href="http://culm.unizar.es/">
			<img src="../imagenes/logo.png" />
		</a>
	</div>