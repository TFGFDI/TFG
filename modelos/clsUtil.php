<?php
include_once("clsDatos.php");
class ClsUtil {

	
public function trad($clave,$lang='es'){
	$datos = new clsDatos();
	$conexion=$datos->conexion;
	$sql = "SELECT valor FROM traducciones WHERE clave='$clave' AND lang='$lang'";
	$resultado = mysqli_query($conexion,$sql) or die(mysql_error());	
	$res = mysqli_fetch_assoc($resultado);
	
	return $res['valor'];
}

public function getURL(){
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	$ar_url=explode('?',$url);
	return $ar_url[0];

}

}
?>