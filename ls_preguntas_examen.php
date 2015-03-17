<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
include_once("clases.php");
require_once("top.php"); 

if (isset($dict['id'])){
	$id_examen = $dict['id'];
}else{
	header("Location: ls_examenes_profesor.php");
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


function ocultar(){
	$('#tipo_test').toggle('slow');
}
</script>
	
	<h2>Gestion de profesores</h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_profesor.php");  ?>
	<section id="izquierdo_general" class="bloqueRedondo">
	    <article id="caja0" class="caja" >
			<div class="caja_titulo">
				<p>A&ntilde;adir pregunta</p>
			</div>
			<div class="caja_contenido"  >
				<ul>
					<li><a class="nueva_pregunta" onclick="openFancybox()"> Nuevo</a></li>
				</ul>
			</div>
        </article>
	<input type="button" value="Volver a ex&aacute;menes" class="volver" onclick="window.location='ls_examenes_profesor.php'">	
		
	</section>
	
	<section id="derecho_general" class=" bloqueRedondeado">
       <?php 
		$examen = new ClsPreguntasExamen();
		$profesor=$examen->getProfesorExamenById($id_examen);
		$fecha=$examen->getFechaExamenById($id_examen);
		$estado=$examen->getEstadoExamenById($id_examen);
		$activo=$examen->getActivoExamenById($id_examen);
	   
	   ?>
	  <div class="titulo_examen">
		<div class="">Profesor: <?php echo $profesor?></div>
		<div class="">Fecha: <?php echo $fecha?></div>
		<div class="">Estado: <?php if($estado==0){?>Privado<?php }else if($estado==1){?>Compartido<?}?></div>
		<div class="">Activo: <?php if($activo==0){?>No activo<?php }else if($activo==1){?>Activo<?}?></div>
	  </div>
		<div class="datagrid" style="width:auto;">
			<table>
				<thead>
					<tr>
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
						<th onclick="orden('pregunta','<?php echo $orden?>');" style="cursor:pointer"><span>Pregunta</span>
							<?php 
								if($filtro=="pregunta"){
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
					$preguntas= new clsPreguntasExamen();					
					
					$filas = $preguntas->getPreguntas($id_examen);
					$filasTot = $preguntas->getPreguntas($id_examen);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 8; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $preguntas->getPreguntasExamenPaginacion($id_examen,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filas)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><a class="ifancybox" href="visualizar.php?id=<?php echo $rowEmp['id']?>"><?php echo $rowEmp['tipo']?></a></td>
						<td><?php echo $rowEmp["pregunta"]?></td>	
						<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activar(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="imagenes/activo.png"><?php }else{?><img src="imagenes/inactivo.png"><?php }?></td>
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="editar(this.id)"><img src="imagenes/lapiz.gif"></td>
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
	<div id="fancy_form" style="display:none">
	<form name="formulario" method="post" action="do.php" enctype="multipart/form-data">
		<input type="hidden" name="op" value="nueva_pregunta">
		<input type="hidden" name="id_examen" value="<?php echo $dict['id']?>">
		
		<fieldset class="bloqueSombra bloqueRedondo">
				<legend class="bloqueRedondo">Nueva Pregunta</legend>					
					<div class="bloque_campoForumulario">
						<label for="pregunta">Pregunta</label>
						<input type="text" name="pregunta" id="pregunta" class="input input_tamanhoNormal" tabindex="1"/>
					</div>
					<div class="bloque_campoForumulario">
						<label for="tipo">Tipo</label>
						<select name="tipo" class="select_tamanhoMediano" onchange="ocultar()">
							<option value="Test">Test</option>
							<option value="Desarrollo">Desarrollo</option>
						</select>
					</div>
					<div id="tipo_test" >
						<div class="bloque_campoForumulario">
							<label for="respuesta1">Respuesta A </label>
							<input type="text" name="respuesta1" id="respuesta1" class="input input_tamanhoNormal" tabindex="1"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="respuesta2">Respuesta B </label>
							<input type="text" name="respuesta2" id="respuesta2" class="input input_tamanhoNormal" tabindex="1"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="respuesta3">Respuesta C </label>
							<input type="text" name="respuesta3" id="respuesta3" class="input input_tamanhoNormal" tabindex="1"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="respuesta4">Respuesta D </label>
							<input type="text" name="respuesta4" id="respuesta4" class="input input_tamanhoNormal" tabindex="1"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="solucion">Soluci&oacute;n </label>
							<input type="radio" name="solucion" value="a">A
							<input type="radio" name="solucion" value="b">B
							<input type="radio" name="solucion" value="c">C
							<input type="radio" name="solucion" value="d">D
						</div>
					</div>
					<input type="submit" value="Guardar">
		</fieldset>			
	</form>
	</div>
</div>

	
<?php

require_once("bottom.php"); 

?>