<?php
include_once("clsDatos.php");

class clsImagen{  
	
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
	 $sql = "insert into imagenes(fecha,titulo,imagen,activo) values ('$this->fecha','$this->titulo','$this->imagen','$this->activo')";
	 	 
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update imagenes set fecha='$this->fecha', titulo='$this->titulo', imagen='$this->imagen', activo='$this->activo' where(id='$this->id')";
		$objDatos->ejecutar($sql);
	
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from imagenes where(id='$this->id')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE

public function imagenesActivas(){
	$objDatos = new clsDatos();
	$sql="select * from imagenes where activo='1' order by fecha DESC"; 
	$res = $objDatos->filtroListado($sql);
	return $res;
}

public function getImagenes($buscador,$activo,$filtro,$orden){
	$objDatos = new clsDatos();
	$where=" where ";
	if($buscador==""){
		$sql= "SELECT * FROM imagenes";
	}else{
		$sql= "SELECT * FROM imagenes WHERE  (titulo LIKE ('%".$buscador."%') OR imagen LIKE ('%".$buscador."%') )";
		$where="";
	}
	
	if($activo!=""){
		if($where==""){
			$sql=$sql." AND activo='$activo' ";
		}else{
			$sql=$sql.$where." (activo='$activo')";
			$where="";
		}
		
	}
	

	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	
	 $res = $objDatos->filtroListado($sql);

	 return $res;
}

public function getImagenesPaginacion($buscador,$activo,$filtro,$orden,$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	$where=" where ";
	
	if($buscador==""){
		$sql= "SELECT * FROM imagenes";
	}else{
		$sql= "SELECT * FROM imagenes WHERE (titulo LIKE ('%".$buscador."%') OR imagen LIKE ('%".$buscador."%'))";
		$where="";
	}
	
	if($activo!=""){
		if($where==""){
			$sql=$sql." AND activo='$activo' ";
		}else{
			$sql=$sql.$where." (activo='$activo')";
			$where="";
		}
		
	}
	

	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	$sql=$sql." LIMIT $itemsInicio,$numer_reg ";
	

	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getImagenById(){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM imagenes WHERE id='$this->id'";
	$res = $objDatos->filtro($sql);
	
	return $res;
}


}

?>