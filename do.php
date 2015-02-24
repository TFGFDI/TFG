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
var_dump($op);
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
		
		if($usuario['rol']=='A'){
			header("Location: admin/index.php?login=ok");
		}else{
			header("Location: index.php?login=ok");
		}
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
	$usuario->rol="E";
	$usuario->activo="0";
	$usuario->incluir();
	
	header("Location: login.php?registro=ok");
}else if($op=="activar"){
	$usuario= new clsUsuario();
	$usuario->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	$user = $usuario->getUsuarioById();
	if($user['activo']=='1'){
		$user['activo']='0';
	}else{
		$user['activo']='1';
	}
	$usuario->estableceCampos($user);//modificamos el campo activo a 1 ó 0 
	$usuario->editar();
	header("Location: admin/index.php");	
	
}else if($op=="eliminarUsuario"){
	$usuario= new clsUsuario();
	$usuario->estableceCampos($dict);
	$usuario->eliminar();	

	header("Location: admin/index.php");
	
}else if($op=="editarUsuario"){
	$usuario= new clsUsuario();
	$usuario->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	
	$usuario->editar();
	header("Location: admin/index.php");
	
}else if($op=="altaUsuario"){
	$usuario= new clsUsuario();
	$usuario->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	
	$usuario->incluir();
	header("Location: admin/index.php");
}
?>