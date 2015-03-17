<?php 
include_once("../modelos/clsImagen.php");

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


?>

<section id="derecho_general" class="bloqueRedondo bloqueSombra">
	<h2 style="width:400px; float:left;">Gestion de Imagenes</h2>
	<div id="nuevaImagen" style="width:120px; float:right; margin:10px 10px 0px 0px; ">
		<input type="button" name="b_nuevaNoticia" value="Nueva Imagen" onclick="nuevaImagen()" id="b_nuevaImagen">
	</div>
	<div id="buscador" class="bloqueRedondo  bloqueSombra" style="margin-top:60px; border:1px solid silver;">
		<div id="buscadorIzq">
			<form name="buscador" method="get" action="imagenes.php" id="buscador">
				<div class="divCampo">
					<input type="text" name="campo_b" value="<?php echo $buscador?>" class="input input_tamanhoGrande" >
				</div>
				<div id="oculto" style="display:none; padding:10px">
			
					<div class="bloque_campoForumulario">
						<label class="labelBuscador">Activos/Desactivos:</label>
						<select name="activo_b" id="activo_b" class="select_tamanhoPequenho_1" >
							<option value="0" selected>Activos & Desactivos</option>
							<option value="1">Activos</option>
							<option value="2">Desactivo</option>
						</select>
					</div>
					<div class="bloque_campoForumulario divCampo"  style="margin-top:10px;" >
						<label class="labelBuscador">Fecha:</label>
						<input type="text" name="campo_fecha" value="" class="input input_tamanhoPequeno" >
					</div>

				</div>
			</form>
		</div>
		<div id="buscadorDch">
			<input type="button" name="buscar" value="Buscar" onclick="buscador.submit()" style="margin-right:10px;">
			<input type="button" name="limpiar" value="Limpiar" onclick="eliminar()" id="limpiar">
		</div>
		<div id="buscadorDch" style="margin-left:10px">
			<span class="avanzada" id="avanzada" onclick="mostrar();">B&uacute;squeda avanzada</span>
			<span class="avanzada" id="simple" onclick="mostrar();" style="display:none;">[X]</span>
		</div>
	</div>
	
		<div class="datagrid" style="width:680px;">
			<table>
				<thead>
					<tr>
						<th onclick="orden('fecha','<?php echo $orden?>');" style="cursor:pointer"><span>Fecha</span>
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
						<th onclick="orden('titulo','<?php echo $orden?>');" style="cursor:pointer"><span>Título</span>
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
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$imagen= new clsImagen();					
					$filas = $imagen->getImagenes($buscador,$activo,$fecha,$filtro,$orden);
					
					$filasTot = $imagen->getImagenes($buscador,$activo,$fecha,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 8; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $imagen->getNoticisPaginacion($buscador,$activo,$fecha,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filas)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><?php echo $rowEmp["fecha"]?></td>
						<td><a class="ifancybox" href="visualizarImagen.php?id=<?php echo $rowEmp['idImagen']?>"><?php echo $rowEmp['titulo']?></a></td>
						<td><?php echo $rowEmp["descripcion"]?></td>
						<td><?php echo $rowEmp["nacionalidad"]?></td>
						<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activar(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="../imagenes/activo.png"><?php }else{?><img src="../imagenes/inactivo.png"><?php }?></td>
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['idImagen']?>" onclick=" "><img src="../imagenes/lapiz.gif"></td>
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['idImagen']?>" onclick="editar(this.id)"><img src="../imagenes/lapiz.gif"></td>
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['idImagen']?>" onclick="eliminar(this.id)"><img src="../imagenes/eliminar.png" style="width:15px;"></td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php require_once("../paginador.php"); ?>
			</table>
		</div>