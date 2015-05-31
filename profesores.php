<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("clases.php"); 
require_once("top.php"); 


?>
<script>

	$(document).ready(function() {

	    $("#cuenta").click(function(evento){ 
			$("#cuenta").addClass("menuActivo");
			evento.preventDefault();
			$("#destino").load("modificar_perfil.php");
	   });
	   


	});
</script>
	
	<h2>Gestion de profesores</h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_profesor.php");  ?>
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
  
    </section>
	
</div>
	
	
<?php

require_once("bottom.php"); 

?>