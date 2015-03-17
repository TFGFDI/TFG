<?php
include_once("clsDatos.php");
class clsExamenes{  

		
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
	 $sql = "insert into examenes(id_profesor,nombre_profesor,fecha,estado,activo) values ('$this->id_profesor','$this->nombre_profesor','$this->fecha','$this->estado','$this->activo')";
	 	
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update examenes set id_profesor='$this->id_profesor', nombre_profesor='$this->nombre_profesor', fecha='$this->fecha', estado='$this->estado', activo='$this->activo' where(id='$this->id')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from examenes where(id='$this->id')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE

public function getExamenes($buscador,$filtro,$orden){
	$objDatos = new clsDatos();
	if($buscador==""){
	
		$sql= "SELECT * FROM examenes WHERE estado=1 OR ( estado=0 AND id_profesor=".$_SESSION['id']." )";
	}else{
		$sql= "SELECT * FROM examenes WHERE estado=1 OR ( estado=0 AND id_profesor=".$_SESSION['id']." ) AND (nombre_profesor LIKE ('%".$buscador."%'))";
	}
			
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getExamenesPaginacion($buscador,$filtro,$orden,$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM examenes WHERE estado=1 OR ( estado=0 AND id_profesor=".$_SESSION['id']." )";
	}else{
		$sql= "SELECT * FROM examenes WHERE estado=1 OR ( estado=0 AND id_profesor=".$_SESSION['id']." ) AND (nombre_profesor LIKE ('%".$buscador."%'))";
	}
	
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	$sql=$sql." LIMIT $itemsInicio,$numer_reg ";
	
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}



public function getExamenesById(){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM examenes WHERE id='$this->id'";
	$res = $objDatos->filtro($sql);
	
	return $res;
}
}

?>