<?php 
session_start();

if (($_SESSION["id"]=="")){ 

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
	location.href="do.php?op=eliminar_examen&id="+id;
}
function activar(id){
	var act = confirm('\u00BFDesea activar este modelo de ex\u00E1men?');
	if (act){
		location.href='do.php?op=activar_examen&id='+id;
	}
}
function desactivar(id){
	var act = confirm('\u00BFDesea desactivar este modelo de ex\u00E1men?');
	if (act){
		location.href='do.php?op=desactivar_examen&id='+id;
	}
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
	<h2>Gestion de profesores</h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_profesor.php");  ?>
	<section id="izquierdo_general" class="bloqueRedondo">
	    <article id="caja0" class="caja" >
                	<div class="caja_titulo">
		                <p>A&ntilde;adir ex&aacute;men</p>
                    </div>
                    <div class="caja_contenido"  >
		                <ul>
                            <li><a onclick="openFancybox()"  title="Nuevo">Nuevo </a></li>
                        </ul>
                    </div>
                </article>
		
		
	</section>
	
	<section id="derecho_general" class=" bloqueRedondeado">
       
		<div class="datagrid" style="width:auto;">
			<table>
				<thead>
					<tr>
						<th onclick="orden('nombre_profesor','<?php echo $orden?>');" style="cursor:pointer"><span>Profesor</span>
							<?php 
								if($filtro=="nombre_profesor"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						
						<th onclick="orden('curso','<?php echo $orden?>');" style="cursor:pointer"><span>Curso</span>
							<?php 
								if($filtro=="curso"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						
						<th onclick="orden('tipo','<?php echo $orden?>');" style="cursor:pointer"><span>Tipo</span>
							<?php 
								if($filtro=="tipo"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						
						<th>
							<span>Nº preguntas</span>
						</th>
						
						<th>
							<span>Duraci&oacute;n</span>
						</th>
						
						<th onclick="orden('estado','<?php echo $orden?>');" style="cursor:pointer"><span>Estado</span>
							<?php 
								if($filtro=="estado"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>	
						<th onclick="orden('activo','<?php echo $orden?>');" style="cursor:pointer"><span>Activo</span>
							<?php 
								if($filtro=="activo"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>	
						<th></th>
						<th></th>
						
					</tr>
				</thead>
				<tbody>
				<?php
					$examen= new clsExamenes();					
					$no_activos = $examen->ningunoActivo();
					//$filas = $examen->getExamenes($buscador,$filtro,$orden);
					$filasTot = $examen->getExamenes($buscador,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 11; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $examen->getExamenesPaginacion($buscador,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
					$preguntas = new clsPreguntasExamen();
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><a href="ls_preguntas_examen.php?id=<?php echo $rowEmp['id']?>"><?php echo $rowEmp['nombre_profesor']?></a></td>
					
						<td><?php echo $rowEmp["curso"]?></td>
						<td><?php echo $rowEmp["tipo"]?></td>
						<td><?php echo $preguntas->getNumPreguntasTotales($rowEmp['id']);?></td>
						<td><a id="<?php echo $rowEmp['id']?>" onclick="openFancybox2(this.id)"><?php echo $rowEmp["tiempo"]?> </a></td>
						<?php if($rowEmp['id_profesor']==$_SESSION['id']){?>
							<td><a href="do.php?op=cambiar_estado_examen&id=<?php echo $rowEmp['id']?>"><?php if($rowEmp["estado"]==0){?>Privado<?php }else if($rowEmp["estado"]==1){?>Compartido<?php }?></a></td>
						<?php }else{?>
							<td><?php if($rowEmp["estado"]==0){?>Privado<?php }else if($rowEmp["estado"]==1){?>Compartido<?php }?></td>
						<?php }?>
						
						<?php if(($rowEmp["estado"]==1)&&($rowEmp["activo"]==1)){?>
							<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="desactivar(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="imagenes/activo.png"><?php }else{?><img src="imagenes/inactivo.png"><?php }?></td>
						<?php }else if(($rowEmp["estado"]==1)&&($no_activos)){?>
							<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activar(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="imagenes/activo.png"><?php }else{?><img src="imagenes/inactivo.png"><?php }?></td>
						<?php }else{?>
							<td></td>
						<?php }?>
						<td><a href="ls_preguntas_examen.php?id=<?php echo $rowEmp['id']?>"><img src="imagenes/lapiz.gif"></a></td>
						
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
					<div class="bloque_campoForumulario">
						<label for="tipo">Tipo</label>
						<select type="text" name="tipo" class="input input_tamanhoNormal" tabindex="2">
							<option value="Semestral">Semestral</option>
							<option value="Anual">Anual</option>
							<option value="Intensivo">Intensivo</option>
						</select>
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
						<input type="text" name="tiempo" id="spinner2" class="input input_tamanhoNormal" tabindex="3"/> &nbsp;min
					</div>					
					<input type="submit" value="Editar">
		</fieldset>			
	</form>
</div>
	
<?php

require_once("bottom.php"); 

?>