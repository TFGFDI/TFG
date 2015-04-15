<link rel="stylesheet" type="text/css" href="css/estilos.css" media="screen" />
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

						<td class="sub">Nombre</b></td>

						<td><input type="text" name="nombre" id="nombre" value="<?php echo $user['nombre']?>" readonly style="width:100%;border:none">

						</td>

						

					</tr>

					<tr>

						<td class="sub">Apellidos</b></td>

						<td><input type="text" name="apellidos" id="apellidos" value="<?php echo $user['apellidos']?>" readonly style="width:100%;border:none">

						</td>

						

					</tr>
					<tr>

						<td class="sub">Sexo</td>

						<td><input type="text" name="sexo" id="sexo" value="<?php echo $user['sexo']?>" readonly style="width:100%;border:none">

						</td>					

					</tr>

					<tr>

						<td class="sub">Fecha de Nacimiento</td>

						<td style="width:650px">

						<input type="text" name="fechanacimiento" id="fechanacimiento" value="<?php echo $user['fechanacimiento']?>" readonly style="width:100%;border:none">

						</td>

					</tr>	
					<tr>

						<td class="sub">Email</td>

						<td style="width:650px">

						<a href="mailto:<?php echo $user['email']?>"><?php echo $user['email']?></a>

						</td>

					</tr>	
					<tr>

						<td class="sub">Nacionalidad</td>

						<td>

							<input type="text" name="nacionalidad" id="nacionalidad" value="<?php echo $user['nacionalidad']?>" readonly style="width:100%;border:none" style="width:100%;border:none">

						</td>						

					</tr>
					<tr>

						<td class="sub">Contrase&ntilde;a</td>

						<td>

							<input type="text" name="contrasena" id="contrasena" value="<?php echo $user['contrasena']?>" readonly style="width:100%;border:none" style="width:100%;border:none">

						</td>						

					</tr>

					
				</table>
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
		</div>