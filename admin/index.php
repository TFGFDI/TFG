<?php 
session_start();
include_once("../modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 

?>
<?php 
if (isset($dict['buscador'])){
	$buscador=$dict['buscador'];
}else{
	$buscador="";
}

if (isset($dict['activo'])){
	$activo=$dict['activo'];
}else{
	$activo="";
}

if (isset($dict['nac'])){
	$nac=$dict['nac'];
}else{
	$nac="";
}
if (isset($dict['filtro'])){
	$filtro = $dict['filtro'];
}else{
	$filtro="";
}
if (isset($dict['orden'])){
	$orden = $dict['orden'];
}else{
	$orden="";
}


?>
<script>
	function limpiar(){
		$('#buscador_input').val('');
		$('#activo').val('');
		$('#nac').val('');
		$("#buscador").submit();
	}
	function orden(filtro,orden){
		
		if(orden ==""){
			orden="ASC";
		} else if(orden =="ASC"){
			orden="DESC";
		}else if(orden =="DESC"){
			orden="ASC";
		}
			

		location.href='index.php?filtro='+filtro+"&orden="+orden;
		
	}
	function editar(id){
	window.location="editar.php?id="+id+"&origen=estudiantes";
 }

	function ver(id){
		window.location="visualizar.php?id="+id+"";
	}

  
	function eliminar(id){
		
		
		var r = confirm("\u00BF Seguro que desea eliminar?");
		if (r == true) {
			location.href='../do.php?op=eliminarUsuario&id='+id+"";
		} 


		
	}
	
	function activar(id){
		location.href='../do.php?op=activar&id='+id+"";
	}
	function crear(){
		location.href='nuevo.php';
	}
	
	function mostrar(){
		$('#oculto').toggle('slow');
		$('#avanzada').toggle('slow');
		$('#simple').toggle('');
	}
	
	$(document).ready(function() {
		$(".fancybox").fancybox();

		$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}

		});

		$(".ifancybox").fancybox({
         'width' : '45%',
         'height' : '75%',
	     'scrolling'   : 'no',
		 'autoScale'         : true,
        'autoDimensions'    : true,
         'transitionIn' : 'fade',
         'transitionOut' : 'fade',
         'type' : 'iframe',		
		 'padding' : 0,
		 'margin' : 20
		});

	});
	
</script>

<h2>Gestion de alumnos</h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_admin.php");  ?>
	<section id="izquierdo_general" class="bloqueRedondo">
	    <article id="caja0" class="caja" >
                	<div class="caja_titulo">
		                <p>Cuenta Usuario</p>
                    </div>
                    <div class="caja_contenido"  >
		                <ul>
                            <li><a href="./consultaCuentaUsuario.php"  title="Inicio">Modificar Cuenta</a></li>
                        </ul>
                    </div>
                </article>
		<article id="caja1" class="caja">
			<div class="caja_titulo" >
				<p>Gestión Recursos</p>
			</div>	
			<div class="caja_contenido">
				<ul>
					<li><a href="./consultaNoticias.php"  title="Inicio">Gestión NOTICIAS</a></li>
					<li><a href="./crearNoticia.php" title="Empresa">Gestión IMAGENES</a></li>
				</ul>
			</div>
		</article>
		
	</section>
	
	<section id="derecho_general" class=" bloqueRedondeado">
              
    </section>
	
</div>
<?php

require_once("bottom.php"); 

?>