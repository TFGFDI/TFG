<?php 
session_start();
//include_once("../modelos/clsUsuario.php");
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
<style>
.fancybox-skin{
	height:400px!important;
}
</style>
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
	window.location="visualizarNoticia.php?id="+id+"";
}

function eliminar(_id){
	var r = confirm("\u00BF Seguro que desea eliminar?");
	if (r == true) {
		//location.href='../do.php?op=eliminarNoticia&id='+id+"";
		$.post('../do.php',
			{op: 'eliminarNoticia',id: _id},
			function() {
				cargarNoticias ();   
			}
		);
	} 
}

function eliminarImagen(_id){
	var r = confirm("\u00BF Seguro que desea eliminar?");
	if (r == true) {
		//location.href='../do.php?op=eliminarNoticia&id='+id+"";
		$.post('../do.php',
			{op: 'eliminarImagen',id: _id},
			function() {
				cargarImagenes ();   
			}
		);
	} 
}

function eliminarInformacion(_id){
	var r = confirm("\u00BF Seguro que desea eliminar?");
	if (r == true) {
		
		$.post('../do.php',
			{op: 'eliminarInformacion',id: _id},
			function() {
				cargarInformacion ();   
			}
		);
	} 
}


function activar(_id){
//	location.href='../do.php?op=activarNoticia&id='+id+"";
	$.post('../do.php',
	  { op: 'activarNoticia',id: _id},
	  function() {
		cargarNoticias ();   
	});
}

function activarImagen(_id){ 
//	location.href='../do.php?op=activarImagen&id='+_id+"";
	$.post('../do.php',
	  { op: 'activarImagen', id: _id},
	  function() {
		cargarImagenes();   
	});
}

function activarInformacion(_id){ 
//	location.href='../do.php?op=activarImagen&id='+_id+"";
	$.post('../do.php',
	  { op: 'activarInformacion', id: _id},
	  function() {
		cargarInformacion();   
	});
}

function crear(){
	location.href='nuevo.php';
}



cargarNoticias = function(){
	$("#noticias").addClass("menuActivo");
	$("#destino").load("noticias.php");
}

cargarImagenes = function(){
	$("#imagenes").addClass("menuActivo");
	$("#destino").load("imagenes.php");
}

cargarInformacion = function(){
	$("#info").addClass("menuActivo");
	$("#destino").load("informacion.php");
}
function mostrar(){
	$('#oculto').toggle('slow');
	$('#avanzada').toggle('slow');
	$('#simple').toggle('');
}


	
	
function openFancybox() {
  $.fancybox({
     'autoScale': true,
     'transitionIn': 'elastic',
     'transitionOut': 'elastic',
     'speedIn': 500,
     'speedOut': 300,
     'autoDimensions': true,
     'centerOnScroll': true,
//	 'scrolling':'no',
     'href' : '#fancy_form' , // id del div que se visualiza
/*	  
	afterClose: function () { 
			parent.location.reload(true);
		}
		*/
  });
}





$(document).ready(function() {
	//	$("#destino").load("cuentaUsuario.php");
	//	$("#cuenta").addClass("menuActivo");
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
		 'height' : '15%',
		 'scrolling'   : 'no',
		 'autoScale'         : true,
		'autoDimensions'    : true,
		 'transitionIn' : 'fade',
		 'transitionOut' : 'fade',
		 'type' : 'iframe',		
		 'padding' : 0,
		 'margin' : 20
	});
	

		
		$("#noticias").click(function(evento){
			$("#cuenta").removeClass();
			$("#imagenes").removeClass();
			$("#info").removeClass();
			$("#noticias").addClass("menuActivo");
			evento.preventDefault();
			$("#destino").load("noticias.php");
	   });
	   
	   	$("#imagenes").click(function(evento){ 
			$("#cuenta").removeClass();
			$("#noticias").removeClass();
			$("#info").removeClass();
			$("#imagenes").addClass("menuActivo");
			evento.preventDefault();
			$("#destino").load("imagenes.php");
	   });
	   
	   $("#info").click(function(evento){ 
			$("#cuenta").removeClass();
			$("#noticias").removeClass();
			$("#imagenes").removeClass();
			$("#info").addClass("menuActivo");
			evento.preventDefault();
			$("#destino").load("informacion.php");
	   });
	   
	    $("#cuenta").click(function(evento){ 
			$("#noticias").removeClass();
			$("#imagenes").removeClass();
			$("#info").removeClass();
			$("#cuenta").addClass("menuActivo");
			evento.preventDefault();
			$("#destino").load("cuentaUsuario.php");
	   });
	   
	

	});
	
</script>

	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_admin.php");  ?>
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
		<article id="caja1" class="caja">
			<div class="caja_titulo" >
				<p>Gestión Recursos</p>
			</div>	
			<div class="caja_contenido">
				<ul>
					<li><a href="#" id="noticias" title="Noticias">Gesti&oacute;n NOTICIAS</a></li>
					<li><a href="#" id="imagenes" title="Imagenes">Gesti&oacute;n IMAGENES</a></li>
					<li><a href="#" id="info" title="Informacion">Gesti&oacute;n INFO.</a></li>
				</ul>
			</div>
		</article>
		
	</section>
	
	<section id="destino" >
              
    </section>
	
</div>
<?php

require_once("./bottom.php"); 

?>