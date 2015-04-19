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
	function limpiar(){
	
		$('#buscador_input').val('');		
		$('#activo').val('');
		$('#nac').val('');
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
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_admin.php");  ?>
	<h2>Gestion de alumnos</h2>
	

	<div id="divMenu_Vertical" class="bloqueRedondo_2 ">
		<ul class="menuVertical ">
			<li class="activo" style="border-top-left-radius: 0.5em;"><a href="alumnos.php?menu=1" >Consulta</a></li>
			<li style="border-bottom-left-radius: 0.5em;"><a href="./nuevo.php?menu=1&page=alumnos" >Alta</a></li>
			<li class="noMenu ">&nbsp;asd</li> 
		</ul>
	</div>
	<div id="contenidoBuscador" >
<?php require_once("../buscador.php");  ?>
	</div>
	<div id="contenido1">
		<div class="datagrid">
			<table>
				<thead>
					<tr>
						<th onclick="orden('nombre','<?php echo $orden?>');" style="cursor:pointer"><span>Nombre</span>
							<?php 
								if($filtro=="nombre"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th onclick="orden('apellidos','<?php echo $orden?>');" style="cursor:pointer"><span>Apellidos</span>
							<?php 
								if($filtro=="apellidos"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th onclick="orden('email','<?php echo $orden?>');" style="cursor:pointer"><span>Email</span>
							<?php 
								if($filtro=="email"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th onclick="orden('nacionalidad','<?php echo $orden?>');" style="cursor:pointer"><span>Nacionalidad</span>
							<?php 
								if($filtro=="nacionalidad"){
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
					$usuario= new clsUsuario();					
					$filas = $usuario->getEstudiantes($buscador,$activo,$nac,$filtro,$orden);
					
					$filasTot = $usuario->getEstudiantes($buscador,$activo,$nac,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 12; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $usuario->getEstudiantesPaginacion($buscador,$activo,$nac,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><a class="ifancybox" href="visualizar.php?id=<?php echo $rowEmp['id']?>"><?php echo $rowEmp['nombre']?></a></td>
						<td><?php echo $rowEmp["apellidos"]?></td>
						<td><?php echo $rowEmp["email"]?></td>
						<td><?php echo $rowEmp["nacionalidad"]?></td>
						<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activar(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="../imagenes/activo.png"><?php }else{?><img src="../imagenes/inactivo.png"><?php }?></td>
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