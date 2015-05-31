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

$util = new ClsUtil();
$url=$util->getPagina();


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
			

		location.href='alumnos.php?menu=1&filtro='+filtro+"&orden="+orden;
		
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
         'width' : '70%',
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
	
	<h2>Gestion de Alumnos</h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_profesor.php");  ?>
	<br />
	<div id="buscador3" class=" bloqueSombra bloqueRedondo">
		<form name="formulario" method="get" action="./alumnos.php" id="formulario">
			<input type="hidden" name="menu" value="1">
			<div class="divCampo">
				<input type="text" name="buscador" value="<?php echo $buscador?>" class="input input_tamanhoGrande" id="buscador_input">
			</div>
			<div style="margin-top:20px;">
				<input type="button" value="Buscar" onclick="formulario.submit()" style="margin-right:10px;">
				<input type="button" value="Limpiar" onclick="limpiar()">
			</div>
		
		</form>
	</div>
	
	<section class="bloquecompleto bloqueRedondeado">	
		<div class="datagrid" style="width:auto;">
			<table>
				<thead>
					<tr>
						<th width="30%" onclick="orden('nombre','<?php echo $orden?>');" style="cursor:pointer"><span>Nombre</span>
							<?php 
								if($filtro=="nombre"){
									if($orden=="DESC"){ ?>
										<img src="imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th width="30%" onclick="orden('email','<?php echo $orden?>');" style="cursor:pointer"><span>Email</span>
							<?php 
								if($filtro=="email"){
									if($orden=="DESC"){ ?>
										<img src="imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						
						<th width="20%" onclick="orden('nacionalidad','<?php echo $orden?>');" style="cursor:pointer"><span>Nacionalidad</span>
							<?php 
								if($filtro=="nacionalidad"){
									if($orden=="DESC"){ ?>
										<img src="imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>	
						<th width="20%" onclick="orden('fechanacimiento','<?php echo $orden?>');" style="cursor:pointer"><span>Fecha Nacimiento</span>
							<?php 
								if($filtro=="fechanacimiento"){
									if($orden=="DESC"){ ?>
										<img src="imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>		
						
						
					</tr>
				</thead>
				<tbody>
				<?php
					$alumnos= new clsUsuario();					
					
					//$filas = $alumnos->getEstudiantes($buscador,"on",$nac,$filtro,$orden);
					$filasTot = $alumnos->getEstudiantes($buscador,"1",$nac,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 11; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $alumnos->getEstudiantesPaginacion($buscador,"1",$nac,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td style="text-align:left;"><a class="ifancybox" href="visualizar_alumno.php?id=<?php echo $rowEmp['id']?>"><?php echo $rowEmp['nombre']?> <?php echo $util->reducirCadena($rowEmp['apellidos'])?></a></td>
						<td style="text-align:left;"><?php echo$util->reducirCadena($rowEmp["email"])?></td>						
						<td style="text-align:left;"><?php echo $rowEmp["nacionalidad"]?></td>
						<td style="text-align:left;"><?php echo $rowEmp["fechanacimiento"]?></td>
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

	
<?php

require_once("bottom.php"); 

?>