<?php 
session_start();
include_once("../modelos/clsInformacionphp");
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
				<input type="text" name="fecha" id="fecha" value="<?php echo $inf['fecha']?>" readonly style="width:100%;border:none">
			</td>
		</tr>

		<tr>
			<td class="sub">Descripción</td>
			<td>
			<input type="text" name="informaciones" id="informaciones" value="<?php echo $inf['informaciones']?>" readonly style="width:100%;border:none">
			</td>					
		</tr>

		<tr>
			<td class="sub">Estado</td>
			<td style="width:650px">
				<input type="text" name="activo" id="activo" value="<?php echo $estado?>" readonly style="width:100%;border:none">
			</td>

		</tr>	
		

	</table>

	
</div>