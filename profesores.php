<?php 
session_start();

if (($_SESSION["id"]=="") || ($_SESSION["rol"]!="P")){ 

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
	
	<section id="derecho_general">
		<section id="destino" >
			<?php 
				$noticias = new ClsNoticia();
				$ar_noticias = $noticias->noticiasActivas();
			?>
			<?php while ($rowEmp = mysqli_fetch_assoc($ar_noticias)) { ?>
					<div class="destacados">
						<div >
							<span class="fechaNoticia"> <?php echo $rowEmp['fecha']; ?></span>
							<span class="tituloNoticia"><?php echo $rowEmp['titulo']; ?></span>
						</div>
						<div class="descripcionNoticia"><?php echo $rowEmp['descripcion']; ?></div>
					</div>
				<?php } ?>
		
				  
		</section>
		</section>
	
</div>
	
	
<?php

require_once("bottom.php"); 

?>