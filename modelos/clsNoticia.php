<?php
include_once("clsDatos.php");

class clsNoticia{  
	
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
	 $sql = "insert into noticias(fecha,titulo,descripcion,activo) values ('$this->fecha','$this->titulo','$this->descripcion','$this->activo')";
	 	
	 $objDatos->ejecutar($sql);

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update noticias set fecha='$this->fecha', titulo='$this->titulo', descripcion='$this->descripcion', activo='$this->activo' where(id='$this->id')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from noticias where(id='$this->id')";
	echo $sql;
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE

public function noticiasActivas(){
	$objDatos = new clsDatos();
	$sql="select * from noticias where activo='1' order by fecha DESC";
	$res = $objDatos->filtroListado($sql);
	return $res;
}

public function getNoticias($buscador,$activo,$fec,$filtro,$orden){

	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM noticias";
		/*if(($activo=="on")||($fec !="")){
			$sql=$sql." where"
			if(($activo=="on")&&($fec =="")){
				$sql=$sql. " activo";
			}
		}
		*/
	}else{
		$sql= "SELECT * FROM noticias WHERE  (titulo LIKE ('%".$buscador."%') OR descripcion LIKE ('%".$buscador."%') )";
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
//	echo $sql;
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getNoticiasPaginacion($buscador,$activo,$fecha,$filtro,$orden,$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	if($buscador==""){
		$sql= "SELECT * FROM noticias";
	}else{
		$sql= "SELECT * FROM noticias WHERE (titulo LIKE ('%".$buscador."%') OR descripcion LIKE ('%".$buscador."%'))";
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


public function getNoticiaById(){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM noticias WHERE id='$this->id'";
	$res = $objDatos->filtro($sql);
	
	return $res;
}



}

?>