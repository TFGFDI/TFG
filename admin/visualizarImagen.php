<?php 
session_start();
include_once("../modelos/clsImagen.php");
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
$img = $imagen->getImagenById();

if($img['activo']){
	$estado="Activa";
}else{
	$estado="Inactiva";
}
	
?>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" media="screen" />
<link rel="stylesheet" href="../css/formulario.css" type="text/css" media="screen"/>
<script >

	function enlace(enlace){
		//abrir en una nueva ventana
		window.open(enlace);
	}
</script>
<div class="visualizar">	
	<table class="ver">
		<tr>
			<td class="sub">Fecha</b></td>
			<td>
				<input type="text" name="fecha" id="fecha" value="<?php echo $img['fecha']?>" readonly style="width:100%;border:none">
			</td>
		</tr>

		<tr>
			<td class="sub">Título</b></td>
			<td>
				<input type="text" name="titulo" id="titulo" value="<?php echo $img['titulo']?>" readonly style="width:100%;border:none">
			</td>
		</tr>
		
		<tr>
			<td class="sub">Imagen</td>	
			<td  style="cursor:pointer;" onclick="enlace('<?php echo "../imagenes/galeria/".$img['imagen'] ?>')"><img src="../imagenes/fichero.png"> </td>			
		</tr>

		<tr>
			<td class="sub">Estado</td>
			<td style="width:650px">
				<input type="text" name="fechanacimiento" id="fechanacimiento" value="<?php echo $estado?>" readonly style="width:100%;border:none">
			</td>

		</tr>	
		

	</table>

	
</div>