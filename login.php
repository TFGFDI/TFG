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
<body class="gradiante">
<div id="contenedor"> 
	<header id="logo">
		<a href="http://www.unizar.es/">
			<img src="./imagenes/titulo.png" />
		</a>
	</header >
	<div id="logo_inferior"  >
		<a href="http://culm.unizar.es/">
			<img src="./imagenes/logo.png" />
		</a>
	</div>
	<div id="contenido">
		<nav id="menu">
			<ul>
				<li ><a href="#tab1">Información</a></li>
				<li ><a href="#tab2">Alta</a></li>
				<li><a href="#tab3">contacto</a></li>
			</ul>
		</nav>
		<section id="informacion" class="bloqueSombra bloqueBordesAzul">
			<article id="tab1">
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</p>
		  </article>
		  <article id="tab2">
			<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
		  </article>
		  <article id="tab3">
			<p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo. Integer leo pede, ornare a, lacinia eu, vulputate vel, nisl.</p>
		  </article>
		</section>
		
	</div>
	<div id="sidebar" >
		<div id="loguearse"  class="bloqueSombra bloqueBordesAzul">
			 <h2>Acceso Usuarios</h2>
			 <form name="formLoguin" class="loguin_form" method="POST" action="">
			 	<div>
					<label for="login">Usuario</label>
					<input type="text" name="login" value="" />
				</div>
				<div >
					<label for="password">Password</label>
					<input type="password"  name="password" value="" />
				</div>
				<div style="text-align:center;">
					<!-- el type 'button'no envia datos al servidor. Solo son utiles si se utiliza javaScript -->
					<input type="button"  name="" value="Iniciar Sesion" /> 
					<!-- type="submit" el type 'submit' eniva datos al servidor -->
				</div>
				<hr>
				<p >
					<a href="">Registrate</a>
				</p>
				<p>
					<a href="">¿No recuerda sus datos de acceso?</a>
				</p>
				
			</form>
		</div>
	</div>
	<footer>
		pie Pagina
	</footer>
	
<div> 
</body>
</html>
