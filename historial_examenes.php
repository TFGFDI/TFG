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
<script>

function visualizar(id){
	location.href="visualizar_examen.php?id="+id;
}
</script>	
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
                            <li><a onclick="openFancybox()"  title="Nuevo">Nuevo </a></li>
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
						
						<th>
							<span>N. preguntas</span>
						</th>
						
						<th>
							<span>Duraci&oacute;n</span>
						</th>				
						
						
					</tr>
				</thead>
				<tbody>
				<?php
					$examen= new clsExamenes();
					$examen_r= new clsExamenesRealizados();	
					
					$filasTot = $examen->getHistorico();
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 11; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $examen->getHistoricoPaginacion($itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
					$preguntas = new clsPreguntasExamen();
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
										
				?>
					<tr id="<?php echo $rowEmp['id']?>" <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> onclick="visualizar(this.id)" style="cursor:pointer">
						<td><?php echo $rowEmp['nombre_profesor']?></td>
						<td><?php echo $rowEmp['fecha']?></td>
						<td><?php echo $preguntas->getNumPreguntasTotales($rowEmp['id']);?></td>
						<td><?php echo $rowEmp['tiempo']?> min</td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php //require_once("paginador.php"); ?>
			</table>
		</div>
	
		
    </section>
	
</div>
	
<?php

require_once("bottom.php"); 

?>