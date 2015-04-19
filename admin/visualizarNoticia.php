<?php 
session_start();
include_once("../modelos/clsNoticia.php");
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

$noticia= new clsNoticia();
$noticia->estableceCampos($dict);
$not = $noticia->getNoticiaById();

if($not['activo']){
	$estado="Activa";
}else{
	$estado="Inactiva";
}
	
?>

<div class="visualizar">	
	<table class="ver">
		<tr>
			<td class="sub">Fecha</b></td>
			<td>
				<input type="text" name="fecha" id="fecha" value="<?php echo $not['fecha']?>" readonly style="width:100%;border:none">
			</td>
		</tr>

		<tr>
			<td class="sub">Título</b></td>
			<td>
				<input type="text" name="titulo" id="titulo" value="<?php echo $not['titulo']?>" readonly style="width:100%;border:none">
			</td>
		</tr>
		
		<tr>
			<td class="sub">Descripción</td>
			<td>
			<input type="text" name="descripcion" id="descripcion" value="<?php echo $not['descripcion']?>" readonly style="width:100%;border:none">
			</td>					
		</tr>

		<tr>
			<td class="sub">Estado</td>
			<td style="width:650px">
				<input type="text" name="fechanacimiento" id="fechanacimiento" value="<?php echo $estado?>" readonly style="width:100%;border:none">
			</td>

		</tr>	
		

	</table>

	
</div>