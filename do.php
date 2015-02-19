<?php
include_once("modelos/clsUsuario.php");
function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}


$dict = getRequest();
$op = $dict['op'];
session_start();
if($op=="login"){
	$usuario= new clsUsuario();
	$usuario->estableceCampos($dict);
	$usuario = $usuario->login($dict);
	
	if ($usuario != NULL){
	
		$_SESSION['email'] = $usuario['email'];
		$_SESSION['nombre'] = $usuario['nombre'];	
		$_SESSION['apellidos'] = $usuario['apellidos'];
		$_SESSION['id'] = $usuario['id'];		
		$_SESSION['rol'] = $usuario['rol'];		
		header("Location: index.php?login=ok");
	}else{

		$_SESSION['ERRORES'][] = "Error al hacer login, vuelva intentarlo";
		header("Location: login.php?login=nok");
	}
	
}else if($op=="salir"){
	session_destroy();
	header("Location: login.php");
	
}else if($op=="registro"){
	$usuario= new clsUsuario();
	$usuario->estableceCampos($dict);
	$usuario->rol="C";
	$usuario->activo="0";
	$usuario->incluir();
	
	header("Location: login.php?registro=ok");
}
?>