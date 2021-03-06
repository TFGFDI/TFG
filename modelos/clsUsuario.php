<?php
include_once("clsDatos.php");

class clsUsuario{  

	
	public function get_nombre(){
		return $this->nombre;
	}
	
	public function get_apellidos(){
		return $this->apellidos;
	}
	
	public function get_sexo(){
		return $this->sexo;
	}
	
	public function get_fechanacimiento(){
		return $this->fechanacimiento;
	}
	
	public function get_email(){
		return $this->email;
	}
	
	public function get_nacionalidad(){
		return $this->nacionalidad;
	}
	
	public function get_contrasena(){
		return $this->contrasena;
	}
	
	public function get_rol(){
		return $this->rol;
	}
	
	public function get_activo(){
		return $this->activo;
	}
	
	function estableceObservacion($id, $obs){
		$objDatos = new clsDatos();
		$sql = "update usuarios set observaciones='$obs' where(id='$id')";
		$objDatos->ejecutar($sql);
	}
	
	function estableceCampos($arr,$prefix="") {
		if ($arr!="") {
			reset($arr);
			while (list($k,$v)=each($arr)) {
				$this->estableceCampo($k,$v,$prefix);
			}
		}
	}
	
	function estableceCampo($key,$valor,$prefix) {
		/*foreach($this->getCamposArray() as $campo=>$tipo) {
			if ($key==$prefix.$campo) $this->$campo = $valor;
		}*/
		$campo = $key;
		$campo = substr($campo,strlen($prefix));
		$this->$campo = $valor;
	}
	
//INICIO FUNCIONES BASICAS PARA AÑADIR,ELIMINAR y MODIFICAR
 public function incluir(){
	 $objDatos = new clsDatos(); 
	 $sql = "insert into usuarios(nombre,apellidos,sexo,fechanacimiento,email,telefono,direccion,cp,ciudad,nacionalidad,contrasena,rol,activo) values ('$this->nombre','$this->apellidos','$this->sexo','$this->fechanacimiento','$this->email','$this->telefono','$this->direccion','$this->cp','$this->ciudad','$this->nacionalidad','$this->contrasena','$this->rol','$this->activo')";
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update usuarios set nombre='$this->nombre', apellidos='$this->apellidos', sexo='$this->sexo', fechanacimiento='$this->fechanacimiento', email='$this->email', telefono='$this->telefono',direccion='$this->direccion',cp='$this->cp',ciudad='$this->ciudad',nacionalidad='$this->nacionalidad', contrasena='$this->contrasena', rol='$this->rol', activo='$this->activo' where(id='$this->id')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from usuarios where(id='$this->id')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE

public function login($dict){
	$obj = new clsDatos();
	$dict['contrasena']=base64_encode($dict['contrasena']);
	$this->estableceCampos( $dict);
	$sql = "SELECT * FROM usuarios where(email='$this->email' AND contrasena='$this->contrasena' AND activo='1')";
	$res=$obj->filtro($sql);
	return $res;	
}


public function getEstudiantes($buscador="",$activo="",$nacionalidad="",$filtro,$orden){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM usuarios WHERE rol='E'";
	}else{
		$sql= "SELECT * FROM usuarios WHERE rol='E' AND (nombre LIKE ('%".$buscador."%') OR apellidos LIKE ('%".$buscador."%') OR email LIKE ('%".$buscador."%'))";
	}
	
	if($activo!=""){
		$sql=$sql." AND activo=$activo ";
	}
	
	if($nacionalidad !=""){
		$sql=$sql." AND nacionalidad='$nacionalidad' ";
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getEstudiantesPaginacion($buscador="",$activo="",$nacionalidad="",$filtro="",$orden="",$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM usuarios WHERE rol='E'";
	}else{
		$sql= "SELECT * FROM usuarios WHERE rol='E' AND (nombre LIKE ('%".$buscador."%') OR apellidos LIKE ('%".$buscador."%') OR email LIKE ('%".$buscador."%'))";
	}
	
	if($activo!=""){
		$sql=$sql." AND activo=$activo ";
	}
	
	if($nacionalidad !=""){
		$sql=$sql." AND nacionalidad='$nacionalidad' ";
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	$sql=$sql." LIMIT $itemsInicio,$numer_reg ";
	
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getProfesores($buscador,$activo,$nacionalidad,$filtro,$orden){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM usuarios WHERE rol='P'";
	}else{
		$sql= "SELECT * FROM usuarios WHERE rol='P' AND (nombre LIKE ('%".$buscador."%') OR apellidos LIKE ('%".$buscador."%') OR email LIKE ('%".$buscador."%'))";
	}
	
	if($activo!=""){
		$sql=$sql." AND activo=$activo ";
	}
		
	
	if($nacionalidad !=""){
		$sql=$sql." AND nacionalidad='$nacionalidad' ";
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getProfesoresPaginacion($buscador,$activo,$nacionalidad,$filtro,$orden,$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM usuarios WHERE rol='P'";
	}else{
		$sql= "SELECT * FROM usuarios WHERE rol='P' AND (nombre LIKE ('%".$buscador."%') OR apellidos LIKE ('%".$buscador."%') OR email LIKE ('%".$buscador."%'))";
	}
	
	if($activo!=""){
		$sql=$sql." AND activo=$activo ";
	}
	
	if($nacionalidad !=""){
		$sql=$sql." AND nacionalidad='$nacionalidad' ";
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	$sql=$sql." LIMIT $itemsInicio,$numer_reg ";
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getUsuarioById(){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM usuarios WHERE id='$this->id'";
	$res = $objDatos->filtro($sql);
	
	return $res;
}

public function getContrasenaById($id_usuario){
	$objDatos = new clsDatos();
	$sql= "SELECT contrasena FROM usuarios WHERE id='$id_usuario'";
	$res = $objDatos->filtro($sql);
	
	return $res['contrasena'];
}

public function getNombreById($id){
	$objDatos = new clsDatos();
	$sql= "SELECT nombre FROM usuarios WHERE id='$id'";
	$res = $objDatos->filtro($sql);
	return $res['nombre'];
}

//comprobar si existe un usuario con un determinado email. Devuelve 1 si existe y 0 si NO existe
public function existeEmail($emailUser){
	$obj = new clsDatos();
	$sql = "SELECT * FROM usuarios where(email='$emailUser')";
	$res=$obj->existe($sql);
	return $res;	
}

public function getContrasenaByEmail($email){
	$objDatos = new clsDatos();
	$sql= "SELECT contrasena FROM usuarios WHERE email='$email'";
	$res = $objDatos->filtro($sql);
	
	return $res['contrasena'];
}

public function getCountSexo($sexo){
	$objDatos = new clsDatos();
	$sql= "SELECT count(*) as total FROM usuarios WHERE sexo='$sexo' AND activo='1' AND rol='E'";
	$res = $objDatos->filtro($sql);
	
	return $res['total'];
}

public function getNacionalidadJSON(){
	$objDatos = new clsDatos();
	$sql= "SELECT nacionalidad,COUNT(*) AS total FROM usuarios GROUP BY nacionalidad";
	$res = $objDatos->filtroListado($sql);
	$separador="";
	$json="[";
	while ($rowEmp = mysqli_fetch_assoc($res)) { 
		$sql= "SELECT codigo FROM paises WHERE nombre='".$rowEmp['nacionalidad']."'";
		$result = $objDatos->filtro($sql);
		$codigo=strtoupper($result['codigo']);
		
		$json.=$separador.'{"code":"'.$codigo.'",';
		$json.='"value":'.$rowEmp['total'].',';
		$json.='"name":"'.$rowEmp['nacionalidad'].'"}';
		$separador=",";
	}
	$json.="]";
	
	return $json;
	
	
}

public function getEmailAdministrador(){
	$objDatos = new clsDatos();
	$sql= "SELECT email FROM usuarios WHERE rol='A'";
	$res = $objDatos->filtroListado($sql);
	$email="";
	$sep="";
	while ($rowEmp = mysqli_fetch_assoc($res)) { 
		$email.=$sep.$rowEmp['email'];
		$sep=",";
	}
	return $email;
}

}

?>