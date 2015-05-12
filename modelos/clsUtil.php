<?php
include_once("clsDatos.php");
class ClsUtil {

	
public function trad($clave,$lang='es'){
	//Obtiene el valor correspondiente a la clave e idioma dado para las traducciones
	$datos = new clsDatos();
	$conexion=$datos->conexion;
	$sql = "SELECT valor FROM traducciones WHERE clave='$clave' AND lang='$lang'";
	$resultado = mysqli_query($conexion,$sql) or die(mysql_error());	
	$res = mysqli_fetch_assoc($resultado);
	if ($res['valor']==NULL){
		$devuelve = $clave;
	}else{
		$devuelve =$res['valor'];
	}
		
	return $devuelve;
}

public function getURL(){
	//Obtener la url actual SIN parámetros
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	$ar_url=explode('?',$url);
	return $ar_url[0];

}

public function getPagina(){
	//Obtener la url actual SIN parámetros
	$url=$_SERVER['PHP_SELF'];
	$ar_url=explode('/',$url);
	$claves = array_keys($ar_url);
	
	return $ar_url[count($ar_url)-1];

}

public function getURLparametros(){
	//Obtener la url actual para añadir parametros
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	$ar_url=explode('?',$url);
	
	if(count($ar_url)>1){
		$cadena=$url.'&';
	}else{
		$cadena=$ar_url[0].'?';
	}
	
	return $cadena;

}


public function eliminarParametrosURL($url,$parametro){

	list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
	parse_str($qspart, $qsvars);
	unset($qsvars[$parametro]);
	$nuevoqs = http_build_query($qsvars);
	return $urlpart . '?' . $nuevoqs; 

}

static function desinfectar($cad){
		if($cad==NULL){
				$cad="";
		}
		$cad=trim($cad);//Eliminar espacios en blanco al principio y final
		$cad=addslashes($cad);//Escapa caracteres como ' " \ o NULL
		
		return $cad;
	}

/*  te convierte la fecha tipo 04/26/2015 a formato 2015-04-26 Se utiliza en nuevaNoticia */
static function fechaFormato($cad){  
	$vector=explode('/',$cad);
	$f=$vector[2].'-'.$vector[0].'-'.$vector[1];
	return $f;
}

/*  te convierte la fecha tipo 20/06/2015 a formato 2015/04/20 Se utiliza en nuevaNoticia */
static function fechaFormato2($cad){  
	$vector=explode('/',$cad);
	$f=$vector[2].'-'.$vector[1].'-'.$vector[0];
	return $f;
}

/*  te convierte la fecha tipo 2015-06-26 a formato  06/26/2015.  Se utiliza por ejemplo en editarNoticia*/
static function fechaFormato1($cad){  
	$vector=explode('-',$cad);
	$f=$vector[1].'/'.$vector[2].'/'.$vector[0];
	return $f;
}

/*  te convierte la fecha tipo 2015-06-26 a formato  26-06-2015.  Se utiliza por ejemplo en editarNoticia*/
static function fechaFormato3($cad){  
	$vector=explode('-',$cad);
	$f=$vector[2].'/'.$vector[1].'/'.$vector[0];
	return $f;
}

 //funcion que muestra solo los primeros 20 caracteres de una cadena
static function reducirCadena($cad){
	$resumen;
	if(strlen($cad) > 20){
		$resumen= substr($cad, 0, 20)." ....";
	}else{
		$resumen=$cad;
	}
	return $resumen;
 }
 
static function reducirCadenaMedia($cad){
 
	$resumen;
	if(strlen($cad) > 45){
		$resumen= substr($cad, 0, 45)." ....";
	}else{
		$resumen=$cad;
	}
	return $resumen;
 }
 
 static function reducirCadenaLarga($cad){
 
	$resumen;
	if(strlen($cad) > 60){
		$resumen= substr($cad, 0, 60)." ....";
	}else{
		$resumen=$cad;
	}
	return $resumen;
 }
	
public function getNacionalidades(){
	$objDatos = new clsDatos();
	$sql= "SELECT nombre FROM paises";
	$res = $objDatos->filtroListado($sql);
	
	while ($rowEmp = mysqli_fetch_assoc($res)) { 
		$nacionalidades[]=$rowEmp['nombre'];
	}
	
	
	return $nacionalidades;
}
}
?>