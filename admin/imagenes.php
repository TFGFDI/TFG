<?php 
include_once("../modelos/clsImagen.php");
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



if (isset($dict['orden'])){
	$orden = $dict['orden'];
}else{
	$orden="";
}

$fecha_nuevaImagen=date('d')."/".date('m')."/".date('Y');
?>
<script type="text/javascript"  src="../js/jquery-1.8.1.min.js"></script>
<script >
$(document).ready(function() { 
	$("#buscarImagenes").click(function(evento){
		$("#imagenes").addClass("menuActivo");
		var campo=$('#campo_buscador').val();
		var c_activo=$('#activo').val();
		evento.preventDefault();

		$.post('./imagenes.php',
			{buscador: campo, activo:c_activo},
			/* function(datos) {
				alert('Respuesta = '+datos);
			  }*/
			function(datos){
				$("#destino").html(datos);
			}
		);
    });
	   
});
function enlace(enlace){
	//abrir en una nueva ventana
	window.open(enlace);
}

function cargarPagina(numPagina){ 
	var campo=$('#campo_buscador').val();
	var c_activo=$('#activo').val();
	$.post('./imagenes.php',
		{pag: numPagina, buscador: campo, activo:c_activo},
		function(datos){
			$("#destino").html(datos);
		}
	);

}; 
</script>

<section id="derecho_general" class="bloqueRedondo bloqueSombra">
	<h2 style="width:400px; float:left;">Gestion de Imagenes</h2>
	<div id="nuevaImagen" style="width:120px; float:right; margin:10px 10px 0px 0px; ">
		<input type="button" name="b_nuevaNoticia" value="Nueva Imagen"  onclick="openFancyboxImagen()"id="b_nuevaImagen">
	</div>
	<div id="buscador2" class="bloqueRedondo  bloqueSombra" style="margin-top:60px; border:1px solid silver;">
		<div id="buscadorIzq">
			<form name="buscador" method="get" action="" id="buscador">
				<div class="divCampo">
					<input type="text" name="buscador" id="campo_buscador" value="<?php echo $buscador?>" class="input input_tamanhoGrande" >
				</div>
				<div id="oculto" <?php if($activo!=""){?><?php }else{?> style="display:none; margin-top:30px"<?php }?>>
					<div class="bloque_campoForumulario">
						<label class="labelBuscador">Activas/Desactivas:</label>
						<select name="activo" id="activo" class="select_tamanhoPequenho_1" >
							<option value="" <?php if($activo==""){?>selected<?php }?>>Activas & Desactivas</option>
							<option value="1" <?php if($activo=="1"){?>selected<?php }?>>Activas</option>
							<option value="0" <?php if($activo=="0"){?>selected<?php }?>>Desactivas</option>
						</select>
					</div>

				</div>
			</form>
		</div>
		
			<!--  para crear una nueva IMAGEN -->
	<div id="fancy_formImagen" style="display:none">
		<form name="formulario" method="post" action="../do.php" enctype="multipart/form-data">
			<input type="hidden" name="op" value="nueva_imagen"> <!-- el campo OP indica que opcion del controlador se ejecuta-->
			<fieldset class="bloqueSombra bloqueRedondo">
					<legend class="bloqueRedondo">Nueva Noticia</legend>					
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="fecha">Fecha</label>
							<input type="text" name="fecha" id="fecha" class="input input_tamanhoPequenho consulta" value="<?php echo $fecha_nuevaImagen; ?>" tabindex="1" readonly />
						</div>
				
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="titulo">Título</label>
							<input type="text" name="titulo" id="titulo" class="input input_tamanhoNormalGrande" tabindex="2"/>
						</div>
						<div class="bloque_campoForumulario">
							<label class="labelEnano" for="imagen">Imagen</label>
							<input type="file" name="titulo" id="imagen" class="input input_tamanhoNormalGrande" tabindex="2"/>
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
		
		
		<div id="buscadorDch">
			<input type="button" name="buscarImagenes" id="buscarImagenes" value="Buscar" style="margin-right:10px;"> <!--  onclick="buscador.submit()" => tienes que indicar el campo ACTION del form -->
			<input type="button" name="limpiar" value="Limpiar" onclick="eliminarImagen()" id="limpiar">
		</div>
		<div id="buscadorDch" style="margin-left:10px; margin-top:20px;">
			<span class="avanzada" id="avanzada" onclick="mostrar();">B&uacute;squeda avanzada</span>
			<span class="avanzada" id="simple" onclick="mostrar();" style="display:none;">[X]</span>
		</div>
	</div>
	
		<div class="datagrid" style="width:680px; ">
			<table >
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
						<th onclick="orden('titulo','<?php echo $orden?>');" style="cursor:pointer" width="70%"><span>Título</span>
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
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$imagen= new clsImagen();					
					$filas = $imagen->getImagenes($buscador,$activo,$filtro,$orden);
					
					$filasTot = $imagen->getImagenes($buscador,$activo,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 4; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $imagen->getImagenesPaginacion($buscador,$activo,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><?php echo $util->fechaFormato3($rowEmp["fecha"]);?></td>
						<td style="text-align:left;"><a class="ifancybox" href="visualizarImagen.php?id=<?php echo $rowEmp['id']?>"><?php echo $util->reducirCadenaLarga($rowEmp['titulo']);?></a></td>

						<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activarImagen(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="../imagenes/activo.png"><?php }else{?><img src="../imagenes/inactivo.png"><?php }?></td>
						<td  style="cursor:pointer;" onclick="enlace('<?php echo "../imagenes/galeria/".$rowEmp['imagen'] ?>')"><img src="../imagenes/fichero.png"> </td>
						
						<td><a class="ifancybox" href="editarImagen.php?id=<?php echo $rowEmp['id']?>"><img src="../imagenes/lapiz.gif"></a></td> 
					<!--	<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="editar(this.id)"><img src="../imagenes/lapiz.gif"></td> -->
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="eliminarImagen(this.id)"><img src="../imagenes/eliminar.png" style="width:15px;"></td>
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