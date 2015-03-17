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
		$sql = "update imagenes set fecha='$this->fecha', titulo='$this->titulo', descripcion='$this->imagen', activo='$this->activo' where(idImagen='$this->idImagen')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from imagenes where(id='$this->idImagen')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE

public function getImagenes($buscador,$activo,$fec,$filtro,$orden){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM imagenes WHERE ";
	}else{
		$sql= "SELECT * FROM imagenes WHERE  (titulo LIKE ('%".$buscador."%') OR imagen LIKE ('%".$buscador."%') )";
	}
	
	if($activo=="on"){
		$sql=$sql." AND activo=1 ";
	}
	
	if($fec !=""){
		$sql=$sql." AND fecha='$fec' ";
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getImagenesPaginacion($buscador,$activo,$nacionalidad,$filtro,$orden,$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM imagenes WHERE ";
	}else{
		$sql= "SELECT * FROM imagenes WHERE (titulo LIKE ('%".$buscador."%') OR descripcion LIKE ('%".$buscador."%'))";
	}
	
	if($activo=="on"){
		$sql=$sql." AND activo=1 ";
	}
	
	if($fecha !=""){
		$sql=$sql." AND fecha='$fec' ";
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}
	
	$sql=$sql." LIMIT $itemsInicio,$numer_reg ";
	
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}




}

?>