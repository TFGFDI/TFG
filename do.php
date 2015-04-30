
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
//var_dump($dict);exit();
session_start();

if($op=="login"){ 
	$usuario= new clsUsuario();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$usuario->estableceCampos($dict);
	$usuario = $usuario->login($dict);  //
	
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
			header("Location: alumno.php?login=ok");
		}
	}else{
		$_SESSION['ERRORES'][] = "Error al hacer login, vuelva intentarlo";
		header("Location: login.php?login=nok");
	}
	
}else if($op=="recuperarPassword"){
	$usuario= new clsUsuario();
	$existe = $usuario->existeEmail($dict['email']); 
	if($existe==1){  //enviar email
		$contrasena_cod = $usuario->getContrasenaByEmail($dict['email']);
		$contrasena_decod = base64_decode($contrasena_cod);
		$para=$dict['email'];
		$titulo="Recordatorio de Contrase&ntilde;a";
		
		$mensaje = "Su contrase&ntilde;a para acceder a la plataforma de Cursos de Espa&ntilde;ol es: <b>". $contrasena_decod."</b>";		
		mail($para, $titulo, $mensaje);
		echo "1";		
	}
	//NO existe
	if ($existe==0){
		echo "0";
		
	}

}else if($op=="duplicadoEmail"){

	$usuario= new clsUsuario();
	$existe = $usuario->existeEmail($dict['email']); 
	//if($existe >'0'){
	if($existe =='1'){
		echo 'false';
	}
	if($existe =='0'){
		echo 'true';
	}
	
}else if($op=="salir"){
	session_destroy();
	header("Location: login.php");
	
}else if($op=="registro"){ 
	$usuario= new clsUsuario();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$dict['contrasena']=base64_encode($dict['contrasena']);
	$usuario->estableceCampos($dict);
	if(isset($dict['rol'])){
		$usuario->rol="P";
	}else{
		$usuario->rol="E";
	}
	
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
	$usuario->estableceCampos($user);
	$usuario->editar();
	header("Location: ".$_SESSION['redireccion']);	
	
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
	$examen->tiempo=$dict['tiempo'];
	$examen->incluir();
	header("Location: ls_examenes_profesor.php");
}else if($op=="editar_examen"){
	$examen= new clsExamenes();
	
	//$examen->estableceCampos($dict);//Obtenemos el examen con el id que nos viene del objeto
	while ($id = current($dict)) {
		if (key($dict) != 'op') {
			$valor=$dict[key($dict)];
			$ar = explode('_',key($dict));			
		}
		next($dict);
	}
	$id= $ar[1];
	
	$examen->editarTiempoById($id,$valor);
	
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
	if($dict['tipo']=="Desarrollo"){
		$dict['solucion']="Desarrollo";
		
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

}else if($op=="empezar_examen"){
	$examen= new clsExamenes();
	$activo=$examen->getExamenActivo();
	$examen_r = new ClsExamenesRealizados();
	$examen_r->id_examen = $activo;
	$examen_r->id_usuario = $_SESSION['id'];
	$examen_r->tiempo_ini = date("Y-m-d H:i:s");
	$examen_r->incluir();
	$_SESSION['inicio_examen']=date("Y-m-d H:i:s");
	header("Location: examen.php");
	
}else if($op=="acabar_examen"){
	$respuesta = new ClsRespuestasAlumnos();
	$examen= new clsExamenes();
	$activo=$examen->getExamenActivo();
	$pregunta = new ClsPreguntasExamen();
	$id_usuario = $_SESSION['id'];
	
	//Calculo del tiempo realizado
	$error=false;
	$inicio = $_SESSION['inicio_examen'];
	$fin = date("Y-m-d H:i:s");
	$tiempo = $examen->getTiempoExamenActivo();
	$nuevafecha = strtotime ( '+'.$tiempo.' minute' , strtotime ( $inicio ) ) ;
	$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
	
	if($fin>$nuevafecha){
		$error=true;
		header("Location: alumno.php?error=tiempo_expirado");
	}
	if(! $error){
		//Insertamos las respuestas en la bbdd
		foreach($dict as $clave => $valor){
			
			if($clave !="op"){
				$respuesta->id_examen_realizado = $activo;
				$respuesta->id_pregunta = $clave;
				$respuesta->respuesta = $valor;
				$respuesta->id_usuario = $id_usuario;
				$respuesta->solucion = $pregunta->getSolucion($clave);
				$respuesta->comentarios = "";
				$respuesta->incluir();	
			}
			
		}
		
		//Recuperamos el examen
		$examen_r = new ClsExamenesRealizados();
		$examen_r->id_usuario = $id_usuario;
		$examen_r->id_examen = $activo;
		
		$ar_examen = $examen_r->getExamen();
		
		$aciertos = $respuesta->getAciertos($id_usuario, $activo);
		
		$preguntas_totales = $pregunta->getNumPreguntas($activo);
		
		if($preguntas_totales>0){
			$nota = $aciertos/$preguntas_totales;
		}else{
			$nota=0;
		}
		$ar_examen['aciertos'] = $aciertos;
		$ar_examen['nota'] = $nota;
		$ar_examen['tiempo_fin'] = $fin;
		$examen_r->estableceCampos($ar_examen);	
		$examen_r->actualizar();
		
		header("Location: index.php");
	}
}else if($op=="modificar_perfil"){
	$usuario= new clsUsuario();
	$error="";
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$usuario->estableceCampos($dict);
	if($dict['contrasena_antigua']== $usuario->getContrasenaById($_SESSION['id'])){
		if($dict['contrasena']==$dict['contrasena2']){
			$usuario->contrasena=$dict['contrasena'];
		}else{
			$error="noiguales";
		}
	}else{
		if($dict['contrasena_antigua']!=""){
			$error="no_coincide";
		}
		$usuario->contrasena=$usuario->getContrasenaById($_SESSION['id']);
	}
	
	
	$usuario->rol=$_SESSION['rol'];
	$usuario->id=$_SESSION['id'];
	$usuario->activo=1;
	
	if($error==""){
		$usuario->editar();
		header("Location: modificar_perfil.php?estado=ok");
	}else{
		header("Location: modificar_perfil.php?error=$error");
	}
	
}else if($op=="nueva_noticia"){
	$noticia= new clsNoticia();
	
	foreach($dict as $clave => $valor){

		if($clave == 'fecha'){
			$dict[$clave] = $util->fechaFormato2($valor);
		}else{
			$dict[$clave] = $util->desinfectar($valor);
		}
	}
	$noticia->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	$noticia->incluir();
	header("Location: admin/index.php?menu=0&cargarNoticias=1");	


	
}else if($op=="eliminarNoticia"){
	$noticia= new clsNoticia();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
		echo  $dict[$clave];
		echo "<br>";
	}
	$noticia->estableceCampos($dict);
	$noticia->eliminar();	

//	header("Location: admin/index.php");
	
}else if($op=="activarNoticia"){ 
	$noticia= new clsNoticia();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$noticia->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	$notic = $noticia->getNoticiaById();
	if($notic['activo']=='1'){
		$notic['activo']='0';
	}else{
		$notic['activo']='1';
	}
	$noticia->estableceCampos($notic);//modificamos el campo activo a 1 ó 0 
	$noticia->editar();
//	header("Location: admin/index.php?noticias=1");	
	
	
}else if($op=="editarNoticia"){
	$noticia= new clsNoticia();
	foreach($dict as $clave => $valor){
		if($clave == 'fecha'){
			$dict[$clave] = $util->fechaFormato($valor);
		}else{
			$dict[$clave] = $util->desinfectar($valor);
		}
	}
	$noticia->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	
	$noticia->editar();
//	header("Location: admin/index.php");
	
}
else if($op=="nueva_imagen"){
	$imagen= new clsImagen(); 
	
	//obtener nombre aleatorio

	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
	$cad = ""; 

	for($i=0;$i<12;$i++) { 
		$cad .= substr($str,rand(0,62),1); 
	}
	
	$sep=explode('image/',$_FILES["titulo"]["type"]); // Separamos image/ 
	$tipo=$sep[1]; // Optenemos el tipo de imagen que es 
	$target_path = "imagenes/galeria/";
	//$target_path = $target_path . basename( $_FILES['imagen']['name']); 	

	if(move_uploaded_file($_FILES['titulo']['tmp_name'], $target_path . '/' .$cad.'.'.$tipo)) { 
	} else{
	}
	
	foreach($dict as $clave => $valor){

		if($clave == 'fecha'){
			$dict[$clave] = $util->fechaFormato2($valor);
		}else{
			$dict[$clave] = $util->desinfectar($valor);
		}
	}
	$imagen->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	$imagen->imagen = $cad.'.'.$tipo;
	$imagen->incluir();
	header("Location: admin/index.php?menu=0&cargarImagenes=1");	
	
	
	
}else if($op=="eliminarImagen"){
	$imagen= new clsImagen();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
		echo  $dict[$clave];
		echo "<br>";
	}
	$imagen->estableceCampos($dict);
	$imagen->eliminar();	

//	header("Location: admin/index.php");
	
}else if($op=="activarImagen"){ 
	$imagen= new clsImagen();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$imagen->estableceCampos($dict);//Obtenemos el usuario con el id que nos viene del objeto
	$img = $imagen->getImagenById();
	if($img['activo']=='1'){
		$img['activo']='0';
	}else{
		$img['activo']='1';
	}
	$imagen->estableceCampos($img);//modificamos el campo activo a 1 ó 0 
	$imagen->editar();
//	header("Location: admin/index.php?noticias=1");	


}else if($op=="corregir"){	
	$respuesta = new ClsRespuestasAlumnos();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
		if(($clave !="op")&&($clave !="id_examen")&&($clave !="id_usuario")&&($clave !="nota_desarrollo")){
				$ar_resp = explode("_",$clave);
				$respuesta->actualizarRespuestas($ar_resp[1],$valor);
			}
	}
	$examen_realizado = new ClsExamenesRealizados();
	$examen_realizado->corregido($dict['id_examen'],$dict['id_usuario']);
	$examen_realizado->setNotaDesarrollo($dict['id_examen'],$dict['id_usuario'],$dict['nota_desarrollo']);
	header("Location: ls_examenes_pendientes.php");
	
}else if($op=="eliminar_examen_pendiente"){
	$examen= new clsExamenesRealizados();
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$examen->estableceCampos($dict);	
	$examen->eliminar();
	
	if(isset($dict['respuestas'])){
		$preguntas= new clsRespuestasAlumnos();
		$ar = explode('_',$dict['respuestas']);
		$preguntas->eliminarRespuestasAlumnos($ar[0],$ar[1]);
	}
	
	header("Location: ls_examenes_profesor.php");
	
}else if($op=="contactar"){
	foreach($dict as $clave => $valor){
		$dict[$clave] = $util->desinfectar($valor);
	}
	$para="mikgongin@hotmail.com";
	$titulo="Solicitud de informacion";
	$mensaje= $dict['email']." le ha mandado el siguiente mensaje:";
	$mensaje .=	$dict['mensaje'];
		
	mail($para, $titulo, $mensaje);
	

}



?>