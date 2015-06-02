<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
include_once("clases.php");
require_once("top.php"); 
?>

	<h2><?php echo $util->trad("historial_alumno",$lang);?></h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_alumno.php");  ?>
	
	
	<section class="bloquecompleto bloqueRedondeado" >
       
		<div class="datagrid" style="width:auto;">
			<table>
				<thead>
					<tr>
									
						<th>
							<span><?php echo $util->trad("fecha",$lang);?></span>
						</th>
						
						<th>
							<span>Ex&aacute;men</span>
						</th>
						<th>
							<span>Tiempo transcurrido</span>
						</th>
						<th>
							<span>Aciertos</span>
						</th>
						<th>
							<span>Nota Test</span>
						</th>
						<th>
							<span>Nota Desarrollo</span>
						</th>
						<th>
							<span>Nivel</span>
						</th>
						
					</tr>
				</thead>
				<tbody>
				<?php
					$examenes_r = new ClsExamenesRealizados();
					$filasTot = $examenes_r->getExamenesAlumno($_SESSION['id']);
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasTot)) { 
				?>
					<tr id="<?php echo $rowEmp['id']?>" <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> style="cursor:pointer">
						<td><?php echo $rowEmp['tiempo_ini']?></td>
						<td><?php echo $rowEmp['id_examen']?></td>
						<td><?php $examenes_r->calcularTiempo($rowEmp['tiempo_ini'],$rowEmp['tiempo_fin']);?></td>
						<td><?php echo $rowEmp['aciertos']?></td>
						<td><?php echo $rowEmp['nota']?></td>
						<td><?php echo $rowEmp['nota_desarrollo']?></td>
						<td><?php echo $rowEmp['nivel']?></td>
					</tr>
					
				<?php 
				$i++;
				}
				?>	
				<?php if ($i==0){?>
					<tr>
						<td colspan="7">No hay examenes realizados.</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
	
		
    </section>
	
</div>
	
<?php

require_once("bottom.php"); 

?>