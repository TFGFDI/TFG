<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 
//echo $dict['menu'];
?>
<script>

	$(document).ready(function() {
	openFancyboxPequenho();
	    $("#cuenta").click(function(evento){ 
			$("#cuenta").addClass("menuActivo");
			evento.preventDefault();
			$("#destino").load("modificar_perfil.php");
	   });
	   
	function openFancyboxPequenho() {
		  $.fancybox({
			 'autoScale': true,
			 'transitionIn': 'elastic',
			 'transitionOut': 'elastic',
			 'speedIn': 500,
			 'speedOut': 300,
			 'autoDimensions': true,
			 'centerOnScroll': true,
			 'href' : '#fancy_datosModificados' , // id del div que se visualiza
		  });
	}

	});
</script>

	<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
		<?php require_once("menu_alumno.php"); ?>
		
		<section id="izquierdo_general" class="bloqueRedondo">
			<article id="caja0" class="caja" >
				<div class="caja_titulo">
					<p>Cuenta Usuario</p>
				</div>
				<div class="caja_contenido"  >
					<ul>
						<li><a href="#"  id="cuenta" title="Inicio">Modificar Cuenta</a></li>
					</ul>
				</div>
			</article>
		
			
		</section>
		
		<section id="destino" >
		
		<div id="fancy_datosModificados" style="display:none; height:150px;" >
			<fieldset class="bloqueSombra bloqueRedondo" style="height:130px;">
				<legend class="bloqueRedondo">Formulario Contacto</legend>	
				<h2 style="text-align:center;">¡¡ Consulta enviada !!</h2>
				<p style="font-size:18px; text-align:center;">
				En breve nos pondremos en contacto con usted.
				</p>
			</fieldset>			
		</div>
				  
		</section>
		
	</div>
	
<?php

require_once("bottom.php"); 

?>