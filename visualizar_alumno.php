<link rel="stylesheet" type="text/css" href="css/estilos.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/formulario.css" media="screen" />
<script type="text/javascript"  src="js/jquery-1.8.1.min.js"></script>
<?php 
session_start();
include_once("clases.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}

function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}


$dict = getRequest();
$lang='es';

$usuario= new clsUsuario();
$usuario->estableceCampos($dict);
$user = $usuario->getUsuarioById();
if($user['sexo'] =='M'){
	$sexo="Masculino";
}
if($user['sexo'] =='F'){
	$sexo="Femenino";
}
?>
<script>
	function ver(id){
		$('#examen_'+id).toggle('slow');
	}
	
	function ocultar(id){
		$('#'+id).toggle('slow');
	}
</script>
<div class="visualizar">
			
			<table class="ver">

					<tr>
						<td class="sub" style="text-align:right;">Nombre:</b></td>
						<td style="width:500px; ">
						<input type="text" name="nombre" id="nombre" value="<?php echo $user['nombre']?>" style="height:20px;border:none; margin-bottom:5px;"  class="input input_tamanhoMediano" />
						</td>
					</tr>

					<tr>

						<td class="sub" style="text-align:right;">Apellidos:</b></td>

						<td><input type="text" name="apellidos" id="apellidos" value="<?php echo $user['apellidos']?>" readonly style="height:20px;border:none; margin-bottom:5px;" class="input input_tamanhoNormal" />

						</td>

						

					</tr>
					<tr>

						<td class="sub" style="text-align:right;">Sexo:</td>

						<td><input type="text" name="sexo" id="sexo" value="<?php echo $sexo;?>" readonly style="height:20px;border:none; margin-bottom:5px;" class="input input_tamanhoPequenho" />

						</td>					

					</tr>

					<tr>

						<td class="sub" style="text-align:right;">Fecha Nacimiento:</td>

						<td >

						<input type="text" name="fechanacimiento" id="fechanacimiento" value="<?php echo $user['fechanacimiento'];?>" style="height:20px;border:none; margin-bottom:5px;" readonly class="input input_tamanhoPequenho" />

						</td>

					</tr>	
					<tr>

						<td class="sub" style="text-align:right;">Email:</td>

						<td >

						<a href="mailto:<?php echo $user['email']?>"  ><?php echo $user['email']?></a>

						</td>

					</tr>	
					<tr>

						<td class="sub" style="text-align:right;">Nacionalidad:</td>

						<td>

							<input type="text" name="nacionalidad" id="nacionalidad" value="<?php echo $user['nacionalidad']?>" style="height:25px;border:none; margin-bottom:5px; margin-top:5px;" class="input input_tamanhoMediano" />

						</td>						

					</tr>
					
					
					<tr>
						<td class="sub" style="text-align:right;">Observaciones:</td>
						<td>
							<textarea style="border:none;height:70px; margin-bottom:5px;"  cols="70" name="observaciones" id="observaciones"><?php echo $user['observaciones']?> </textarea>
					
						</td>						
					</tr>

					
				</table>
				<br />
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
							<span>Nota Test</span>
						</th>						
						<th>
							<span>Nota Desarrollo</span>
						</th>
						<th>
							<span>Nivel</span>
						</th>
						<th></th>
						
					</tr>
				</thead>
				<tbody>
				<?php
					$examenes_r = new ClsExamenesRealizados();
					$filasTot = $examenes_r->getExamenesAlumno($user['id']);
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasTot)) { 
				?>
					<tr id="<?php echo $rowEmp['id']?>" <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> onclick="ver(this.id)" style="cursor:pointer">
						<td><?php echo $rowEmp['tiempo_ini']?></td>
						<td><?php echo $rowEmp['id_examen']?></td>
						<td><?php $examenes_r->calcularTiempo($rowEmp['tiempo_ini'],$rowEmp['tiempo_fin']);?></td>
						<td><?php echo $rowEmp['aciertos']?></td>
						<td><?php echo $rowEmp['nota']?></td>
						<td><?php echo $rowEmp['nota_desarrollo']?></td>
						<td><?php echo $rowEmp['nivel']?></td>
						<td><a href="imprimir_examen.php?id=<?php echo $user['id']?>&examen=<?php echo $rowEmp['id_examen']?>" target="_blank">Imprimir</a></td>
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
									$res = $respuesta->getSolucion($rowEmp2['id'],$user['id']);
									
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
								<section <?php if($res['respuesta']==$rowEmp2['solucion']){?>style="color:green" <?php }else{?>style="color:red"<?php }?>>
									<b>Soluci&oacute;n:</b> <?php echo $rowEmp2['solucion']?>
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
		</div>