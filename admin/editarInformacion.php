<?php 
session_start();
include_once("../modelos/clsInformacion.php");
include_once("../modelos/clsUtil.php");

$util = new clsUtil();

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

$informacion= new clsInformacion();
$informacion->estableceCampos($dict);
$inf = $informacion->getInformacionById();

	
?>

<script type="text/javascript"  src="../js/jquery-1.8.1.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/adapters/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="../css/estilos.css" media="screen" />
<link rel="stylesheet" href="../css/formulario.css" type="text/css" media="screen"/>

<script type="text/javascript">

	$(document).ready(function() {
		$('#informaciones').ckeditor();
	});
	
	
	
	
</script>

<div >
	<form name="formulario" id="formulario" method="post" action="../do.php" enctype="multipart/form-data">
		<input type="hidden" name="op" value="editarInformacion"> <!-- el campo OP indica que opcion del controlador se ejecuta-->
		<input type="hidden" name="id" value="<?php echo $dict['id']; ?>"> <!-- idNoticia -->
		<fieldset class="bloqueSombra bloqueRedondo">
		
				<legend class="bloqueRedondo">Editar Informaci&oacute;n</legend>					
					<input type="hidden" name="fecha" value="<?php echo $inf['fecha']?>">								
					<div class="bloque_campoForumulario">
						<label class="labelEnano" for="descripcion">Descripci&oacute;n</label>	<br>					
						<textarea name="informaciones" id="informaciones" class="textarea" tabindex="3"><?php echo $inf['informaciones']?></textarea>
					</div>
				
					<div class="bloque_campoForumulario">
						<label class="labelEnano" for="activo">Estado</label>
						<select name="activo" class="select_tamanhoPequenho" tabindex="4">
							<option value="1" <?php if($inf['activo']=='1'){ ?> selected <?php } ?> >Activa</option>
							<option value="0" <?php if($inf['activo']=='0'){ ?> selected <?php } ?> >Inactiva</option>
						</select>
					</div>
					<div style="text-align:center; margin-top:20px;">
						<input type="submit" value="Guardar" />
					</div>
		</fieldset>			
	</form>
</div>