<?php
include_once("clases.php");
function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}


$dict = getRequest();
$op = $dict['op'];
$util = new clsUtil();
//var_dump($dict);
session_start();
if($op=="login"){
	$usuario= new clsUsuario();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$usuario->estableceCampos($dict);
	$usuario = $usuario->login($dict);
	
	if ($usuario != NULL){
	
		$_SESSION['email'] = $usuario['email'];
		$_SESSION['nombre'] = $usuario['nombre'];	
		$_SESSION['apellidos'] = $usuario['apellidos'];
		$_SESSION['id'] = $usuario['id'];		
		$_SESSION['rol'] = $usuario['rol'];	
		
		if($usuario['rol']=='A'){
			header("Location: admin/index.php?login=ok&menu=0");
		}else if($usuario['rol']=='P'){
			header("Location: profesores.php?login=ok");
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
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$usuario->estableceCampos($dict);
	$usuario->rol="E";
	$usuario->activo="0";
	$usuario->incluir();
	
	header("Location: login.php?registro=ok");
}else if($op=="activar"){
	$usuario= new clsUsuario();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
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
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$usuario->estableceCampos($dict);
	$usuario->eliminar();	

	header("Location: admin/index.php");
	
}else if($op=="editarUsuario"){
	$usuario= new clsUsuario();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$usuario->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	
	$usuario->editar();
	header("Location: admin/index.php");
	
}else if($op=="altaUsuario"){
	$usuario= new clsUsuario();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$usuario->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	
	$usuario->incluir();
	header("Location: admin/index.php");
	
}else if($op=="nuevo_examen"){
	$examen= new clsExamenes();
	$examen->id_profesor= $_SESSION["id"];//Obtenemos el usuario con el id que nos viene del objeto
	$examen->nombre_profesor= $_SESSION["nombre"]." ".$_SESSION["apellidos"];
	$examen->fecha = date("Y-m-d");
	$examen->estado = 0;
	$examen->activo = 0;
	$examen->incluir();
	header("Location: ls_examenes_profesor.php");
	
}else if($op=="eliminar_examen"){
	$examen= new clsExamenes();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$examen->estableceCampos($dict);	
	$examen->eliminar();
	
	if(isset($dict['id'])){
		$preguntas= new clsPreguntasExamen();
		$preguntas->eliminarPreguntasExamen($dict['id']);
	}
	
	header("Location: ls_examenes_profesor.php");

}else if($op=="cambiar_estado_examen"){
	$examen= new clsExamenes();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$examen->estableceCampos($dict);
	$ar_examen = $examen->getExamenesById();
	if(($ar_examen['estado']==1) && ($ar_examen['activo'])!=1){
		$ar_examen['estado']=0;
	}else if($ar_examen['estado']==0) {
		$ar_examen['estado']=1;
	}
	$examen->estableceCampos($ar_examen);
	$examen->editar();
	header("Location: ls_examenes_profesor.php");
	
}else if($op=="activar_examen"){
	$examen= new clsExamenes();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$examen->estableceCampos($dict);
	$examen->activar_examen();
	header("Location: ls_examenes_profesor.php");
	
}else if($op=="nueva_pregunta"){
	$pregunta= new clsPreguntasExamen();
	
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	
	$pregunta->estableceCampos($dict);
	
	$pregunta->incluir();
	header("Location: ls_preguntas_examen.php?id=".$dict['id_examen']);
	
}else if($op=="eliminar_pregunta_examen"){
	$pregunta= new clsPreguntasExamen();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$pregunta->estableceCampos($dict);	
	$pregunta->eliminar();
	header("Location: ls_preguntas_examen.php?id=".$dict['id_examen']);
	
}else if($op=="editar_pregunta"){
	$pregunta= new clsPreguntasExamen();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$pregunta->estableceCampos($dict);	
	$pregunta->editar();
	echo "<div style='text-align:center;padding-top:75px'>Pregunta modificada con &eacute;xito</div>";
	
}
?>