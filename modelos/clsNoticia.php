<?php
include_once("clsDatos.php");
include_once("clsUtil.php"); 



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
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE

public function noticiasActivas(){
	$objDatos = new clsDatos();
	$sql="select * from noticias where activo='1' order by fecha DESC";
	$res = $objDatos->filtroListado($sql);
	return $res;
}

public function getNoticias($buscador,$activo,$fecInicio,$fecFin,$filtro,$orden){

	$objDatos = new clsDatos();
	$util= new clsUtil();
	$where=" where ";
	if($buscador==""){
		$sql= "SELECT * FROM noticias";

	}else{
		$sql= "SELECT * FROM noticias WHERE  (titulo LIKE ('%".$buscador."%') OR descripcion LIKE ('%".$buscador."%') )";
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
	

	
	if(($fecInicio !="")||($fecFin !="")){
		if(($fecInicio !="")&&($fecFin !="")){
			$f_inicio=$util->fechaFormato($fecInicio);
			$f_fin=$util->fechaFormato($fecFin);
			$fecha=" fecha between '$f_inicio' and '$f_fin' ";
		}else if (($fecInicio !="")||($fecFin =="")){
			$f_inicio=$util->fechaFormato($fecInicio);
			$fecha=" fecha >= '$f_inicio' ";
		}else if (($fecInicio =="")||($fecFin !="")){
			$f_fin=$util->fechaFormato($fecFin);
			$fecha= " fecha <= '$f_fin' ";
		}
	
		if($where==""){
			$sql=$sql." AND ".$fecha;
		}else{
			$sql=$sql.$where.$fecha;
			$where="";
		}
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}else{
		$sql=$sql." order by fecha DESC";
	}
//	echo $sql;
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getNoticiasPaginacion($buscador,$activo,$fecInicio,$fecFin,$filtro,$orden,$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
$util= new clsUtil();
	$where=" where ";
	if($buscador==""){
		$sql= "SELECT * FROM noticias";

	}else{
		$sql= "SELECT * FROM noticias WHERE  (titulo LIKE ('%".$buscador."%') OR descripcion LIKE ('%".$buscador."%') )";
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
	
	if(($fecInicio !="")||($fecFin !="")){
		if(($fecInicio !="")&&($fecFin !="")){
			$f_inicio=$util->fechaFormato($fecInicio);
			$f_fin=$util->fechaFormato($fecFin);
			$fecha=" fecha between '$f_inicio' and '$f_fin' ";
		}else if (($fecInicio !="")||($fecFin =="")){
			$f_inicio=$util->fechaFormato($fecInicio);
			$fecha=" fecha >= '$f_inicio' ";
		}else if (($fecInicio =="")||($fecFin !="")){
			$f_fin=$util->fechaFormato($fecFin);
			$fecha= " fecha <= '$f_fin' ";
		}
	
		if($where==""){
			$sql=$sql." AND ".$fecha;
		}else{
			$sql=$sql.$where.$fecha;
			$where="";
		}
	}
	
	if(($filtro!="")&&($orden!="")){
		$sql=$sql." order by $filtro $orden";
	}else{
		$sql=$sql." order by fecha DESC";
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