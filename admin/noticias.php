<?php 
include_once("../modelos/clsNoticia.php");

require_once("../modelos/clsUtil.php"); 
$util= new clsUtil();

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

if (isset($dict['fecha'])){
	$fecha=$dict['fecha'];
}else{
	$fecha="";
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
	$("#buscarNoticias").click(function(evento){
		$("#noticias").addClass("menuActivo");
			var campo=$('#campo_b').val();
			var c_activo=$('#activo_b').val();
			var c_fecha=$('#fecha_b').val();
		
			//evento.preventDefault();
			
		//	$("#destino").load("noticias.php");
			$.post("noticias.php",{buscador: campo, activo:c_activo, fecha:c_fecha}, function(datos){ 
				$("destino").html(datos);
			});
	   });
 });
</script>
<section id="derecho_general" class="bloqueRedondo bloqueSombra">
	<h2 style="width:400px; float:left;">Gestion de Noticias</h2>
	<div id="nuevaNoticia" style="width:120px; float:right; margin:10px 10px 0px 0px; ">
		<input type="button" name="b_nuevaNoticia" value="Nueva Noticia" onclick="openFancybox()" id="b_nuevaNoticia">
	</div>
	<div id="buscador" class="bloqueRedondo  bloqueSombra" style="margin-top:60px; border:1px solid silver;">
	<form name="buscador" method="get" action="" id="buscador">
		<div id="buscadorIzq">
				<div class="divCampo">
					<input type="text" name="campo_b" id="campo_b" value="<?php echo $buscador?>" class="input input_tamanhoGrande" >
				</div>
				<div id="oculto" style="display:none; padding:10px">
					<div class="bloque_campoForumulario">
						<label class="labelBuscador">Activos/Desactivos:</label>
						<select name="activo_b" id="activo_b" class="select_tamanhoPequenho_1" >
							<option value="" selected>Activos & Desactivos</option>
							<option value="1">Activos</option>
							<option value="2">Desactivo</option>
						</select>
					</div>
					<div class="bloque_campoForumulario divCampo"  style="margin-top:10px;" >
						<label class="labelBuscador">Fecha:</label>
						<input type="text" name="fecha_b" id="fecha_id" value="" class="input input_tamanhoPequeno" >
					</div>

				</div>
		</div>
		<div id="buscadorDch">
			<input type="button" name="buscarNoticias" id="buscarNoticias" value="Buscar"  style="margin-right:10px;">
			<input type="button" name="limpiar" value="Limpiar" onclick="eliminar()" id="limpiar">
		</div>
		<div id="buscadorDch" style="margin-left:10px">
			<span class="avanzada" id="avanzada" onclick="mostrar();">B&uacute;squeda avanzada</span>
			<span class="avanzada" id="simple" onclick="mostrar();" style="display:none;">[X]</span>
		</div>
	</form>
	</div>
	<!--  para crear una nueva NOTICIA -->
	<div id="fancy_form" style="display:none">
		<form name="formulario" method="post" action="../do.php" enctype="multipart/form-data">
			<input type="hidden" name="op" value="nueva_noticia"> <!-- el campo OP indica que opcion del controlador se ejecuta-->
			<fieldset class="bloqueSombra bloqueRedondo">
					<legend class="bloqueRedondo">Nueva Noticia</legend>					
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="fecha">Fecha</label>
							<input type="text" name="fecha" id="fecha" class="input input_tamanhoPequenho consulta" value="<?php echo $fecha_nuevaNoticia; ?>" tabindex="1" readonly />
						</div>
				
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="titulo">Título</label>
							<input type="text" name="titulo" id="titulo" class="input input_tamanhoNormalGrande" tabindex="2"/>
						</div>
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="descripcion">Descripción</label>
							<input type="text" name="descripcion" id="descripcion" class="input input_tamanhoNormal" tabindex="3"/>
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
						<th onclick="orden('titulo','<?php echo $orden?>');" style="cursor:pointer" width="25%"><span>Título</span>
							<?php 
								if($filtro=="titulo"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th onclick="orden('descripcion','<?php echo $orden?>');" style="cursor:pointer" width="50%"><span>Descripción</span>
							<?php 
								if($filtro=="descripcion"){
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
			
					$noticia= new clsNoticia();					
					$filas = $noticia->getNoticias($buscador,$activo,$fecha,$filtro,$orden);
				
					
					$filasTot = $noticia->getNoticias($buscador,$activo,$fecha,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 8; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $noticia->getNoticiasPaginacion($buscador,$activo,$fecha,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filas)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><?php echo $rowEmp["fecha"]?></td>
						<td  style="text-align:left;"><a class="ifancybox" href="visualizarNoticia.php?id=<?php echo $rowEmp['id']?>"><?php echo $util->reducirCadena($rowEmp['titulo']);?></a></td>
						<td  style="text-align:left;"><?php echo $util->reducirCadenaMedia($rowEmp["descripcion"]);?></td>
						<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activar(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="../imagenes/activo.png"><?php }else{?><img src="../imagenes/inactivo.png"><?php }?></td> 						
							
						<td><a class="ifancybox" href="EditarNoticia.php?id=<?php echo $rowEmp['id']?>"><img src="../imagenes/lapiz.gif"></a></td> 
					<!--	<td style="cursor:pointer;text-align:center" id="<?php // echo $rowEmp['id']?>" onclick="editar(this.id)"><img src="../imagenes/lapiz.gif"></td> -->
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="eliminar(this.id)"><img src="../imagenes/eliminar.png" style="width:15px;"></td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php  require_once("../paginador.php"); ?>
			</table>
		</div>
	
</section>

	