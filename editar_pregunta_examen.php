<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
include_once("clases.php");
function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}

$dict = getRequest();
if (isset($dict['id'])){
	$id_examen = $dict['id'];
}else{
	header("Location: ls_examenes_profesor.php");
}

if (! isset($dict['opcion'])){ //Posibles valores: Ver / Editar
	$dict['opcion']="editar";
}
?>
<script type="text/javascript"  src="js/jquery-1.8.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilos.css" media="screen" />
<link rel="stylesheet" href="css/formulario.css" type="text/css" media="screen"/>
<script>
function ocultar(){
	$('#tipo_test').toggle('slow');
}
</script>
	<?php 
		$pregunta = new ClsPreguntasExamen();
		$pregunta = $pregunta->getPreguntaById($dict['id']);		
	
	?>
	<form name="formulario" method="post" action="do.php" enctype="multipart/form-data">
		<input type="hidden" name="op" value="editar_pregunta">
		<input type="hidden" name="id" value="<?php echo $dict['id']?>">
		<input type="hidden" name="id_examen" value="<?php echo $dict['id_examen']?>">
		
		<fieldset class="bloqueSombra bloqueRedondo">
				<legend class="bloqueRedondo">Nueva Pregunta</legend>					
					<div class="bloque_campoForumulario">
						<label for="pregunta">Pregunta</label>
						<input type="text" name="pregunta" id="pregunta" class="input input_tamanhoNormal" tabindex="1" value="<?php echo $pregunta['pregunta']?>"/>
					</div>
					<div class="bloque_campoForumulario">
						<label for="tipo">Tipo</label>
						<select name="tipo" class="select_tamanhoMediano" onchange="ocultar()">
							<option value="Test" <?php if($pregunta['tipo']=="Test"){?>selected<?php }?>>Test</option>
							<option value="Desarrollo" <?php if($pregunta['tipo']=="Desarrollo"){?>selected<?php }?>>Desarrollo</option>
						</select>
					</div>
					<div id="tipo_test" <?php if($pregunta['tipo']=="Desarrollo"){?>style="display:none"<?php }?>>
						<div class="bloque_campoForumulario">
							<label for="respuesta1">Respuesta A </label>
							<input type="text" name="respuesta1" id="respuesta1" class="input input_tamanhoNormal" tabindex="2" value="<?php echo $pregunta['respuesta1']?>"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="respuesta2">Respuesta B </label>
							<input type="text" name="respuesta2" id="respuesta2" class="input input_tamanhoNormal" tabindex="3" value="<?php echo $pregunta['respuesta2']?>"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="respuesta3">Respuesta C </label>
							<input type="text" name="respuesta3" id="respuesta3" class="input input_tamanhoNormal" tabindex="4" value="<?php echo $pregunta['respuesta3']?>"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="respuesta4">Respuesta D </label>
							<input type="text" name="respuesta4" id="respuesta4" class="input input_tamanhoNormal" tabindex="5" value="<?php echo $pregunta['respuesta4']?>"/>
						</div>
						<div class="bloque_campoForumulario">
							<label for="solucion">Soluci&oacute;n </label>
							<input type="radio" name="solucion" value="a" <?php if($pregunta['solucion']=="a"){?>checked<?php }?>>A
							<input type="radio" name="solucion" value="b" <?php if($pregunta['solucion']=="b"){?>checked<?php }?>>B
							<input type="radio" name="solucion" value="c" <?php if($pregunta['solucion']=="c"){?>checked<?php }?>>C
							<input type="radio" name="solucion" value="d" <?php if($pregunta['solucion']=="d"){?>checked<?php }?>>D
						</div>
					</div>
					<?php if($dict["opcion"]!="ver"){?>
						<input type="submit" value="Guardar">
					<?php }?>
		</fieldset>			
	</form>
	