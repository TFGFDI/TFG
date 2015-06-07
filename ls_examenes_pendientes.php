<?php 
session_start();

if (($_SESSION["id"]=="") || ($_SESSION["rol"]!="P")){ 

header("Location: login.php");

}
include_once("clases.php");
require_once("top.php"); 


if (isset($dict['buscador'])){
	$buscador=$dict['buscador'];
}else{
	$buscador="";
}
if (isset($dict['filtro'])){
	$filtro = $dict['filtro'];
}else{
	$filtro="";
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



if (isset($dict['orden'])){
	$orden = $dict['orden'];
}else{
	$orden="";
}


?>
<script>
function eliminar(id){
	location.href="do.php?op=eliminar_examen_pendiente&id="+id;
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
     'href' : '#fancy_form'
  });
}

function openFancybox2(id) {
  $.fancybox({
     'autoScale': true,
     'transitionIn': 'elastic',
     'transitionOut': 'elastic',
     'speedIn': 500,
     'speedOut': 300,
     'autoDimensions': true,
     'centerOnScroll': true,
     'href' : '#fancy_form_edit',	
	 'content': '<form name="formulario" method="post" action="do.php" enctype="multipart/form-data">		<input type="hidden" name="op" value="editar_examen">	<fieldset class="bloqueSombra bloqueRedondo">	<legend class="bloqueRedondo">Nueva Pregunta</legend>	<div class="bloque_campoForumulario">	<label for="pregunta">Tiempo establecido</label>	<input type="text" name="tiempo_'+id+'"" id="spinner2" class="input" style="width:30%"/> &nbsp;min	</div>	<input type="submit" value="Editar">	</fieldset>		</form>'
  });
}

$(document).ready(function() {
		$(".fancybox").fancybox();
		$("#spinner").spinner({
		  step: 10
		});		
		$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}

		});

		$(".ifancybox").fancybox({
         'width' : '25%',
         'height' : '200px',
         'autoScale' : true,
         'transitionIn' : 'none',
         'transitionOut' : 'none',
         'type' : 'iframe',
		 afterClose: function () { 
                parent.location.reload(true);
            }
		});
		
	});
</script>	
	<h2>Gesti&oacute;n de ex&aacute;menes pendientes de corregir</h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_profesor.php");  ?>
		
	<section class="bloquecompleto bloqueRedondeado">
       
		<div class="datagrid" style="width:auto;">
			<table>
				<thead>
					<tr>
									
						<th>
							<span>Alumno</span>
						</th>
						
						<th>
							<span>Ex&aacute;men</span>
						</th>
						<th>
							<span>Nota</span>
						</th>						
						<th></th>
						<th></th>
						
					</tr>
				</thead>
				<tbody>
				<?php
					$examen= new clsExamenesRealizados();					
					
					//$filas = $examen->getExamenes($buscador,$filtro,$orden);
					$filasTot = $examen->getPendientesCorregir();
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 11; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $examen->getPendientesCorregirPaginacion($itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
					
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
					
					$usuario = new ClsUsuario();
					$nombre	= $usuario->getNombreById($rowEmp['id_usuario']);
					
				?>
					<tr <?php if($i%2==0){?>class="alt <?php if($rowEmp['expirado']==1){?> expirado<?php }?>"<?php }else{?>class="impar <?php if($rowEmp['expirado']==1){?> expirado<?php }?>"<?php }?> >
						
						<td><a href="corregir.php?id_usuario=<?php echo $rowEmp['id_usuario']?>&id_examen=<?php echo $rowEmp['id_examen']?>"> <?php echo $nombre?></a></td>
						<td><a href="corregir.php?id_usuario=<?php echo $rowEmp['id_usuario']?>&id_examen=<?php echo $rowEmp['id_examen']?>"><?php echo $rowEmp["id_examen"]?></a></td>
						<td><a href="corregir.php?id_usuario=<?php echo $rowEmp['id_usuario']?>&id_examen=<?php echo $rowEmp['id_examen']?>"><?php echo $rowEmp["nota"]?></a></td>
						
						<td><a href="corregir.php?id_usuario=<?php echo $rowEmp['id_usuario']?>&id_examen=<?php echo $rowEmp['id_examen']?>"><img src="imagenes/lapiz.gif"></a></td>
						
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="eliminar(this.id)"><img src="imagenes/eliminar.png" style="width:15px;"></td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php require_once("paginador.php"); ?>
			</table>
		</div>
	
		
    </section>
	
</div>
<div id="fancy_form" style="display:none">
	<form name="formulario" method="post" action="do.php" enctype="multipart/form-data">
		<input type="hidden" name="op" value="nuevo_examen">	
		
		<fieldset class="bloqueSombra bloqueRedondo">
				<legend class="bloqueRedondo">Nueva Pregunta</legend>					
					<div class="bloque_campoForumulario">
						<label for="pregunta">Tiempo establecido</label>
						<input type="text" name="tiempo" id="spinner" class="input input_tamanhoNormal" tabindex="1"/> &nbsp;min
					</div>					
					<input type="submit" value="Nuevo">
		</fieldset>			
	</form>
</div>

<div id="fancy_form_edit" style="display:none">
	<form name="formulario" method="post" action="do.php" enctype="multipart/form-data">
		<input type="hidden" name="op" value="editar_examen">	
		
		<fieldset class="bloqueSombra bloqueRedondo">
				<legend class="bloqueRedondo">Nueva Pregunta</legend>					
					<div class="bloque_campoForumulario">
						<label for="pregunta">Tiempo establecido</label>
						<input type="text" name="tiempo" id="spinner2" class="input input_tamanhoNormal" tabindex="1"/> &nbsp;min
					</div>					
					<input type="submit" value="Editar">
		</fieldset>			
	</form>
</div>
	
<?php

require_once("bottom.php"); 

?>