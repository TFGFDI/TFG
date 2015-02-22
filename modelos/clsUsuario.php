<?php
include_once("clsDatos.php");

class clsUsuario{  
/*	
	private $nombre;
	private $apellidos;
	private $sexo; 
	private $fechanacimiento;     
    private $email;
    private $nacionalidad; 
	private $contrasena;
	private $rol;
	private $activo;
	
	function __construct($nombre,$apellidos,$sexo,$fechanacimiento,$email,$nacionalidad,$contrasena,$rol,$activo)
	{
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->sexo = $sexo;
		$this->fechanacimiento = $fechanacimiento;
		$this->email = $email;
		$this->nacionalidad = $nacionalidad;
		$this->contrasena = $contrasena;
		$this->rol = $rol;
		$this->activo = $activo;
		
	}*/
	
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
	 $sql = "insert into usuarios(nombre,apellidos,sexo,fechanacimiento,email,nacionalidad,contrasena,rol,activo) values ('$this->nombre','$this->apellidos','$this->sexo','$this->fechanacimiento','$this->email','$this->nacionalidad','$this->contrasena','$this->rol','$this->activo')";
	 	 
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update usuarios set nombre='$this->nombre', apellidos='$this->apellidos', sexo='$this->sexo', fechanacimiento='$this->fechanacimiento', email='$this->email', nacionalidad='$this->nacionalidad', contrasena='$this->contrasena', rol='$this->rol', activo='$this->activo' where(id='$this->id')";
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
	$this->estableceCampos( $dict);
	$sql = "SELECT * FROM usuarios where(email='$this->email' AND contrasena='$this->contrasena')";
	
	$res=$obj->filtro($sql);
	
	return $res;
		
	
}
public function getEstudiantes($filtro){
	$objDatos = new clsDatos();
	if($filtro==""){
		$sql= "SELECT * FROM usuarios WHERE rol='E'";
	}else{
		$sql= "SELECT * FROM usuarios WHERE rol='E' AND (nombre LIKE ('%".$filtro."%') OR apellidos LIKE ('%".$filtro."%') OR nacionalidad LIKE ('%".$filtro."%') OR email LIKE ('%".$filtro."%'))";
	}
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

}

?>