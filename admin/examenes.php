<?php 
session_start();
include_once("../modelos/clsExamenes.php");
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

if (isset($dict['fechaInicio'])){
	$fechaInicio=$dict['fechaInicio'];
}else{
	$fechaInicio="";
}

if (isset($dict['fechaFin'])){
	$fechaFin=$dict['fechaFin'];
}else{
	$fechaFin="";
}





if (isset($dict['orden'])){
	$orden = $dict['orden'];
}else{
	$orden="";
}


?>
<script>
	function limpiar(){
	
		$('#campo_buscador').val('');		
		$('#activo').val('');
		$('#datepicker').val('');
		$('#datepicker1').val('');
		$("#formulario").submit();
		
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
	window.location="editar.php?id="+id+"&origen=examenes";
 }

	function ver(id){
		window.location="visualizar.php?id="+id+"";
	}

  
	function eliminar(id){
		
		
		var r = confirm("\u00BF Seguro que desea eliminar?");
		if (r == true) {
			location.href='../do.php?op=eliminarExamen&id='+id+"";
		} 


		
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
  	
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: "1970:2015",
			showAnim: "explode"
		});

		
		$( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: "1970:2015",
			showAnim: "explode"
		});
	
	
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
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_admin.php");  ?>
	<h2>Gestion de Ex&aacute;menes</h2>
	
	<div id="divMenu_Vertical" class="bloqueRedondo_2 ">
		<ul class="menuVertical ">
			<li class="activo" style="border-top-left-radius: 0.5em;"><a href="examenes.php?menu=2" >Consulta</a></li>
			<li style="border-bottom-left-radius: 0.5em;"><a href="#" >&nbsp;</a></li>
			<li class="noMenu ">&nbsp;asd</li> 
		</ul>
	</div>
	<div id="contenidoBuscador"    >
		<div id="buscador" class=" bloqueSombra bloqueRedondo"  style="height:150px;">
			<form name="formulario" method="get" action="<?php echo $url;?>" id="formulario">
			<input type="hidden" name="menu" value="3">
				<div id="buscadorIzq">
						<div class="divCampo">
							<input type="text" name="buscador" id="campo_buscador" value="<?php echo $buscador?>" class="input input_tamanhoGrande" >
						</div>
						
						<div id="oculto" <?php if(($activo!="")||($fechaFin!="")||($fechaInicio!="")){?><?php }else{?> style="display:none; padding:4px"<?php }?>>
							<div class="bloque_campoForumulario">
								<label class="labelBuscador">Activas/Desactivas:</label>
								<select name="activo" id="activo" class="select_tamanhoMediano" >
									<option value="" <?php if($activo==""){?>selected<?php }?>>Activas & Desactivas</option>
									<option value="1" <?php if($activo=="1"){?>selected<?php }?>>Activas</option>
									<option value="0" <?php if($activo=="0"){?>selected<?php }?>>Desactivas</option>
								</select>
							</div>
							<div class="bloque_campoForumulario divCampo"  style="margin-top:7px;" >
								<label class="labelBuscador">Fecha Inicio:</label>
								<input type="text" name="fechaInicio" id="datepicker" value="<?php echo $fechaInicio?>" class="input_tamanhoPequenho" >
							</div>
							<div class="bloque_campoForumulario divCampo"  style="margin-top:7px;" >
								<label class="labelBuscador">Fecha Fin:</label>
								<input type="text" name="fechaFin" id="datepicker1" value="<?php echo $fechaFin?>" class="input_tamanhoPequenho" >
							</div>
						</div>
				</div>
				<div id="buscadorDch">
					<input type="button" value="Buscar" onclick="formulario.submit()" style="margin-right:10px;">
					<input type="button" value="Limpiar" onclick="limpiar()" >
				</div>
				<div id="buscadorDch" style="margin-left:10px">
					<span class="avanzada" id="avanzada" onclick="mostrar();">B&uacute;squeda avanzada</span>
					<span class="avanzada" id="simple" onclick="mostrar();" style="display:none;">[X]</span>
				</div>
			</form>
		</div>
	</div>
	
	<div id="contenido1">
		<div class="datagrid">
			<table>
				<thead>
					<tr>
						<th width="50%" onclick="orden('nombre_profesor','<?php echo $orden?>');" style="cursor:pointer"><span>Profesor</span>
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
						<th width="20%" onclick="orden('fecha','<?php echo $orden?>');" style="cursor:pointer"><span>Fecha</span>
							<?php 
								if($filtro=="fecha"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th width="15%" onclick="orden('estado','<?php echo $orden?>');" style="cursor:pointer"><span>Estado</span>
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
						
						<th width="5%"></th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$examenes= new clsExamenes();					
					
					$filas = $examenes->getTodosExamenes($buscador,$filtro,$orden);
					$filasTot = $examenes->getTodosExamenes($buscador,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 8; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $examenes->getTodosExamenesPaginacion($buscador,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
						$activo="";
						if($rowEmp["estado"]==0){
							$estado="privado";
						}
						if($rowEmp["estado"]==1){
							$estado="publico";
						}
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td style="text-align:left;cursor:pointer" id="<?php echo $rowEmp['id']?>" onclick="editar(this.id)"><?php echo $util->reducirCadenaLarga($rowEmp['nombre_profesor'])?></td>
						<td><?php echo $util->fechaFormato3($rowEmp["fecha"])?></td>
						<td><?php echo $estado;?></td>						
						
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="editar(this.id)"><img src="../imagenes/lapiz.gif"></td>
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="eliminar(this.id)"><img src="../imagenes/eliminar.png" style="width:15px;"></td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php require_once("../paginador.php"); ?>
			</table>
		</div>
	
	</div>		
		
		
	
</div>
<?php

require_once("bottom.php"); 

?>