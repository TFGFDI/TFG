<?php			
class clsDatos{

public $conexion; 

public function __construct(){
    $servidor="localhost";
    $usuario="root";
	$pass="root";
    $base="tfg";
	
    //PARAMETROS CONNECT: servidor db, usuario db, pass db, nombre db
    $this->conexion=mysqli_connect($servidor,$usuario,$pass,$base);
    if ($this->conexion) {
      	mysqli_select_db($this->conexion,$base);
    } else {  
      	mysql_error();
	}
}  

public function __destruct(){ 
 
} 

//METODO para hacer consultas SELECT
public function filtro($sql){ 
	$resultado = mysqli_query($this->conexion,$sql) or die(mysql_error());	
	return mysqli_fetch_assoc($resultado);
}   

public function filtroListado($sql){ 
	$resultado = mysqli_query($this->conexion,$sql) or die(mysql_error());	
	return $resultado;
} 

//Metodo para hacer INSERT,UPDATE y DELETE
public function ejecutar($sql){ 
mysqli_query($this->conexion,$sql) or die(mysql_error());
	
}

//existe registro
public function existe($sql){ 
	$resultado = mysqli_query($this->conexion,$sql) or die(mysql_error());	
	return mysqli_num_rows($resultado);
} 				

}

?>