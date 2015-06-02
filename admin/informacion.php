<?php 
include_once("../modelos/clsInformacion.php");
require_once("../modelos/clsUtil.php"); 

$util= new clsUtil();

function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}


$dict = getRequest();

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

$fecha_nuevaNoticia=date('d')."/".date('m')."/".date('Y');

?>
<script>
$(document).ready(function() {
	$("#buscarInformacion").click(function(evento){
		$("#informacion").addClass("menuActivo");
			var campo=$('#campo_buscador').val();
			var c_activo=$('#activo').val();
			var c_fechaInicio=$('[name=fechaInicio]').val();
			var c_fechaFin=$('[name=fechaFin]').val();
			evento.preventDefault();

			$.post('./informacion.php',
				{buscador: campo, activo:c_activo, fechaInicio:c_fechaInicio, fechaFin:c_fechaFin},
				/* function(datos) {
					alert('Respuesta = '+datos);
				  }*/
				function(datos){
					$("#destino").html(datos);
				}
			);
	   });
	   
  	//$('#informaciones').ckeditor();
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

	   
});

	function cargarPagina(numPagina){
		var campo=$('#campo_buscador').val();
		var c_activo=$('#activo').val();
		var c_fechaInicio=$('[name=fechaInicio]').val();
		var c_fechaFin=$('[name=fechaFin]').val();

		$.post('./informacion.php',
				{pag: numPagina, buscador: campo, activo:c_activo, fechaInicio:c_fechaInicio, fechaFin:c_fechaFin},
				/* function(datos) {
					alert('Respuesta = '+datos);
				  }*/
				function(datos){
					$("#destino").html(datos);
				}
			);

	}; 
</script>
<section id="derecho_general" class="bloqueRedondo bloqueSombra">
	<h2 style="width:400px; float:left;">Gesti&oacute;n de Informaci&oacute;n</h2>
	<div id="nuevaInformacion" style="width:120px; float:right; margin:10px 10px 0px 0px; ">
		<input type="button" name="b_nuevaInformacion" value="Nueva Informacion" onclick="openFancybox()" id="b_nuevaInformacion">
	</div>
	<div id="buscador1" class="bloqueRedondo  bloqueSombra" style="margin-top:60px; border:1px solid silver;">
	<form name="formBuscador" method="get" action="" id="buscador">
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
			<input type="button" name="buscarInformacion" id="buscarInformacion" value="Buscar"  style="margin-right:10px;">
			<input type="button" name="limpiar" value="Limpiar" onclick="eliminar()" id="limpiar">
		</div>
		<div id="buscadorDch" style="margin-left:10px">
			<span class="avanzada" id="avanzada" onclick="mostrar();">B&uacute;squeda avanzada</span>
			<span class="avanzada" id="simple" onclick="mostrar();" style="display:none;">[X]</span>
		</div>
	</form>
	</div>
	<!--  para crear una nueva informacion -->
	<div id="fancy_form" style="display:none">
		<form name="formulario" method="post" action="../do.php" enctype="multipart/form-data">
			<input type="hidden" name="op" value="nueva_informacion"> <!-- el campo OP indica que opcion del controlador se ejecuta-->
			<fieldset class="bloqueSombra bloqueRedondo">
					<legend class="bloqueRedondo">Nueva Informaci&oacute;n</legend>					
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="fecha">Fecha</label>
							<input type="text" name="fecha" id="fecha" class="input input_tamanhoPequenho consulta" value="<?php echo $fecha_nuevaNoticia; ?>" tabindex="1" readonly />
						</div>
										
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="informacion">Informaci&oacute;n</label> <br>
							<textarea type="text" name="informaciones" id="informaciones" class="textarea" tabindex="3"></textarea>
						</div>
					
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="activo">Estado</label>
							<select name="activo" class="select_tamanhoPequenho" tabindex="4">
								<option value="1">Activa</option>
								<option value="0">Inactiva</option>
							</select>
						</div>
						<div style="text-align:center; margin-top:20px;">
							<input type="submit" value="Guardar" />
						</div>
			</fieldset>			
		</form>
	</div>
	
		<div class="datagrid" style="width:680px;">
			<table>
				<thead>
					<tr>
						<th onclick="orden('fecha','<?php echo $orden?>');" style="cursor:pointer" width="10%"><span>Fecha</span>
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
						
						<th onclick="orden('informaciones','<?php echo $orden?>');" style="cursor:pointer" width="50%"><span>Descripción</span>
							<?php 
								if($filtro=="informaciones"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
				
						<th onclick="orden('activo','<?php echo $orden?>');" style="cursor:pointer" width="5%"><span>Activo</span>
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
						<th width="5%"></th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
				<?php
			
					$informacion= new clsInformacion();					
					$filas = $informacion->getInformacion($buscador,$activo,$fechaInicio,$fechaFin,$filtro,$orden);
				
					
					$filasTot = $informacion->getInformacion($buscador,$activo,$fechaInicio,$fechaFin,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 4; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $informacion->getInformacionPaginacion($buscador,$activo,$fechaInicio,$fechaFin,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><?php echo $util->fechaFormato3($rowEmp["fecha"]);?></td>
						
						<td style="text-align:left;"><?php echo $util->reducirCadenaMedia($rowEmp["informaciones"]);?></td>
						<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activarInformacion(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="../imagenes/activo.png"><?php }else{?><img src="../imagenes/inactivo.png"><?php }?></td> 						
							
						<td><a class="ifancybox" href="editarInformacion.php?id=<?php echo $rowEmp['id']?>"><img src="../imagenes/lapiz.gif"></a></td> 
						
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="eliminarInformacion(this.id)"><img src="../imagenes/eliminar.png" style="width:15px;"></td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php if($totalPag>0){?>
					<?php if(ceil($total/$totalPag)>1){?>
					<tfoot>
					<tr >
						<td colspan="10">	
							<div id="paging" >
								<ul>
									
									<?php for($i=1; $i<=ceil($total/$numer_reg); $i++){ ?>
										
										<?php 
											$url = $util->getURLparametros();
											if(!strpos($url,"&pag=")===false){
												$url = $util->eliminarParametrosURL($url,"pag")."&";
											}
										?>
									
										<li><a style="cursor:pointer;" name="numPaginador"  onclick="cargarPagina(<?php echo $i ?>)" <?php if ($pag == $i){?>class="active" <?php }?>><span><?php echo $i ?></span></a></li>							
										
									<?php }?>
									
								</ul>
							</div>
						</td>
					</tr>
					</tfoot>	
					<?php }?>
				<?php }else{?>
					<tfoot>
					<tr>
						<td colspan="7" >	
							<div  id="paging" style="background:#fff; color:#005D8B; font-weight:bold; padding-top:10px; padding-bottom:10px; font-size:15px;" >
								<ul>
									<span>No se han encontrado resultados</span>
								</ul>
							</div>
						</td>
					</tr>
					</tfoot>
				<?php }?>
			</table>
		</div>
	
</section>

	