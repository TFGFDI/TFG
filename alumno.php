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
	//openFancyboxPequenho();
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
					<p><?php echo $util->trad("cuenta_usuario",$lang);?></p>
				</div>
				<div class="caja_contenido"  >
					<ul>
						<li><a href="#"  id="cuenta" title="Inicio"><?php echo $util->trad("modificar_perfil",$lang);?></a></li>
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