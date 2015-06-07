<?php 
session_start();
include_once("../modelos/clsImagen.php");
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

$imagen= new clsImagen();
$imagen->estableceCampos($dict);
$not = $imagen->getImagenById();

	
?>

<script type="text/javascript"  src="../js/jquery-1.8.1.min.js"></script>


<link rel="stylesheet" type="text/css" href="../css/estilos.css" media="screen" />
<link rel="stylesheet" href="../css/formulario.css" type="text/css" media="screen"/>

<script type="text/javascript">
/*
	$(document).ready(function() {
		$('.fancybox').fancybox();
		parent.$.fancybox.close();
		//window.open('');
	});
	*/
	
	$( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "1970:2015",
		showAnim: "explode"
	});
	
</script>

<div >
	<form name="formulario" id="formulario" method="post" action="../do.php" enctype="multipart/form-data">
		<input type="hidden" name="op" value="editarImagen"> <!-- el campo OP indica que opcion del controlador se ejecuta-->
		<input type="hidden" name="id" value="<?php echo $dict['id']; ?>"> <!-- idNoticia -->
		<fieldset class="bloqueSombra bloqueRedondo">
				<legend class="bloqueRedondo">Editar Imagenes</legend>					
					<div class="bloque_campoForumulario">				
						<label class="labelEnano" for="fecha">Fecha</label>
						<input type="text" name="fecha" id="datepicker" style="height:25px;" class="input input_tamanhoPequenho consulta " value="<?php echo $util->fechaFormato1($not['fecha']); ?>" tabindex="1" />
					</div>
			
					<div class="bloque_campoForumulario">
						<label class="labelEnano" for="titulo">Título</label>
						<input type="text" name="titulo" id="titulo" style="height:25px;" class="input input_tamanhoNormalGrande" tabindex="2" value="<?php echo $not['titulo'];?>"/>
					</div>
					<div class="bloque_campoForumulario">
						<label class="labelEnano" for="imagen">Imagen</label>
						<input type="file" name="titulo" id="imagen" class="input input_tamanhoNormalGrande" tabindex="3"/>
					</div>
				
					<div class="bloque_campoForumulario">
						<label class="labelEnano" for="activo">Estado</label>
					
						<select name="activo" class="select_tamanhoPequenho" tabindex="4">
							<option value="1" <?php if($not['activo']=='1'){ ?> selected <?php } ?> >Activa</option>
							<option value="0" <?php if($not['activo']=='0'){ ?> selected <?php } ?> >Inactiva</option>
						</select>
						
					</div>
					<div style="text-align:center; margin-top:20px;">
						<input type="submit" value="Guardar" />
					</div>
					<?php if(isset($dict['guardar'])){?>
							<div style="text-align:center;margin-top:10px; font-weight: bold; color:green">¡¡ DATOS GUARDADOS !!</div>
						<?php }?>
		</fieldset>			
		</fieldset>			
	</form>
</div>