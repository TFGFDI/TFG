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
                            <li><a href="do.php?op=nuevo_examen"  title="Inicio">Nuevo </a></li>
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
					
					$filas = $examen->getExamenes($buscador,$filtro,$orden);
					$filasTot = $examen->getExamenes($buscador,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 8; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $examen->getExamenesPaginacion($buscador,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filas)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><a href="ls_preguntas_examen.php?id=<?php echo $rowEmp['id']?>"><?php echo $rowEmp['nombre_profesor']?></a></td>
						<td><?php echo $rowEmp["fecha"]?></td>
						
						<td><?php if($rowEmp["estado"]==0){?>Privado<?php }else if($rowEmp["estado"]==1){?>Compartido<?}?></td>
						<td style="cursor:pointer;" id="<?php echo $rowEmp['id']?>" onclick="activar(this.id)"><?php if($rowEmp["activo"]=='1'){?><img src="imagenes/activo.png"><?php }else{?><img src="imagenes/inactivo.png"><?php }?></td>
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="editar(this.id)"><img src="imagenes/lapiz.gif"></td>
						<td style="cursor:pointer;text-align:center" id="<?php echo $rowEmp['id']?>" onclick="eliminar(this.id)"><img src="imagenes/eliminar.png" style="width:15px;"></td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php //require_once("../paginador.php"); ?>
			</table>
		</div>
	
		
    </section>
	
</div>

	
<?php

require_once("bottom.php"); 

?>