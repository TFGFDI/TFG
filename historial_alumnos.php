<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
include_once("clases.php");
require_once("top.php"); 
?>
<script>
	function ver(id){
		$('#examen_'+id).toggle('slow');
	}
	
	function ocultar(id){
		$('#'+id).toggle('slow');
	}
</script>
	<h2><?php echo $util->trad("historial_alumno",$lang);?></h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_alumno.php");  ?>
	
	
	<section class="bloquecompleto bloqueRedondeado" >
       
		<div class="datagrid" style="width:auto;">
			<table>
				<thead>
					<tr>
									
						<th>
							<span>Fecha</span>
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
							<span>Nota</span>
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
					<tr id="<?php echo $rowEmp['id']?>" <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> onclick="ver(this.id)" style="cursor:pointer">
						<td><?php echo $rowEmp['tiempo_ini']?></td>
						<td><?php echo $rowEmp['id_examen']?></td>
						<td><?php $examenes_r->calcularTiempo($rowEmp['tiempo_ini'],$rowEmp['tiempo_fin']);?></td>
						<td><?php echo $rowEmp['aciertos']?></td>
						<td><?php echo $rowEmp['nota']?></td>
					</tr>
					<tr style="display:none;cursor:pointer" id="examen_<?php echo $rowEmp['id']?>" onclick="ocultar(this.id)">
						
						<td colspan="5">
							<div >
								<?php
								$preguntas = new ClsPreguntasExamen();
								$id_examen = $rowEmp['id_examen'];
								$ar_preguntas = $preguntas->getPreguntas($id_examen);
								
								$j=1;//Saber si es una fila par o impar para estilos
								while ($rowEmp2 = mysqli_fetch_assoc($ar_preguntas)) {
									$respuesta= new ClsRespuestasAlumnos();
									$res = $respuesta->getSolucion($rowEmp2['id'],$_SESSION['id']);
									
							?>
							<div class="pregunta">
								<?php echo $j?>
								<section><b><?php echo $rowEmp2["pregunta"]?></b></section>
										
								<?php if ($rowEmp2["tipo"]=="Test"){?>
								<section class="respuesta">
									<input type="radio" <?php if ($res['respuesta']=='a'){?>checked <?php }?> disabled><span><?php echo $rowEmp2['respuesta1']?></span><br>
									<input type="radio" <?php if ($res['respuesta']=='b'){?>checked <?php }?> disabled><span><?php echo $rowEmp2['respuesta2']?></span><br>
									<input type="radio" <?php if ($res['respuesta']=='c'){?>checked <?php }?> disabled><span><?php echo $rowEmp2['respuesta3']?></span><br>
									<input type="radio" <?php if ($res['respuesta']=='d'){?>checked <?php }?> disabled><span><?php echo $rowEmp2['respuesta4']?></span><br>
								</section>
								<section <?php if($res['respuesta']==$res['solucion']){?>style="color:green" <?php }else{?>style="color:red"<?php }?>>
									<b>Soluci&oacute;n:</b> <?php echo $res['solucion']?>
								</section>
								<?php }else if ($rowEmp2["tipo"]=="Desarrollo"){?>
								<br>
								<section class="respuesta">
									<span><b>Respuesta:</b><?php echo $res['respuesta']?></span>
									<br>
									<span><b>Comentario Profesor:</b><?php echo $res['comentarios']?></span>
								</section>
								<?php }?>
							</div>
							
							
							<?php 
								$j++;
							}//fin while?>
							</div>
						</td>
					</tr>
				<?php 
				$i++;
				}
				?>	
				</tbody>
			</table>
		</div>
	
		
    </section>
	
</div>
	
<?php

require_once("bottom.php"); 

?>