<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
			<h3>Alumno</h3>
			<div class="cabecera_imprimir">
						<span>Nombre:</span><?php echo $user['nombre']?><br>
						<span>Apellidos:</span><?php echo $user['apellidos']?><br>
						<span>Sexo:</span><?php echo $sexo;?><br>
						<span>Fecha Nacimiento:</span><?php echo $user['fechanacimiento'];?><br>
						<span>Email:</span><?php echo $user['email']?><br>
						<span>Nacionalidad:</span><?php echo $user['nacionalidad']?><br>
						<span>Observaciones:</span><?php echo $user['observaciones']?> <br>
			</div>		
				<br />
				
				<?php
					$examenes_r = new ClsExamenesRealizados();
					$examenes_r->id_usuario=$dict['id'];
					$examenes_r->id_examen=$dict['examen'];
					$filasTot = $examenes_r->getExamen();
					
					
					$i=0;//Saber si es una fila par o impar para estilos
					
				?>
				<h3>Ex&aacute;men</h3>
				<div class="cabecera_imprimir">	
						<span>Fecha Inicio:</span><?php echo $filasTot['tiempo_ini']?></br>
						<span>Ex&aacute;men:</span><?php echo $filasTot['id_examen']?></br>
						<span>Tiempo transcurrido:</span><?php $examenes_r->calcularTiempo($filasTot['tiempo_ini'],$filasTot['tiempo_fin']);?></br>
						<span>Aciertos:</span><?php echo $filasTot['aciertos']?></br>
						<span>Nota Test:</span><?php echo $filasTot['nota']?></br>
						<span>Nota Desarrollo:</span><?php echo $filasTot['nota_desarrollo']?></br>
						<span>Nivel:</span><?php echo $filasTot['nivel']?></br>
				</div>	
				</br>
		
				
					
							
								<?php
								$preguntas = new ClsPreguntasExamen();
								$id_examen = $filasTot['id_examen'];
								$ar_preguntas = $preguntas->getPreguntas($id_examen);
								
								$j=1;//Numero de Pregunta
								while ($rowEmp2 = mysqli_fetch_assoc($ar_preguntas)) {
									$respuesta= new ClsRespuestasAlumnos();
									$res = $respuesta->getSolucion($rowEmp2['id'],$user['id']);									
							?>
							<div class="pregunta" style="page-break-after: avoid;">
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
							<br>
							
							<?php 
								$j++;
							}//fin while?>
							
						
		</div>	
		
		<script>
			window.print();
			window.setTimeout(function(){window.close(), 5000});
		</script>