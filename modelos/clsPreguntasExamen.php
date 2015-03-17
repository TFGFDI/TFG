<?php
include_once("clsDatos.php");
class clsPreguntasExamen{  

		
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
	 $sql = "insert into preguntas_examen(id_examen,tipo,pregunta,respuesta1,respuesta2,respuesta3,respuesta4,solucion) values ('$this->id_examen','$this->tipo','$this->pregunta','$this->respuesta1','$this->respuesta2','$this->respuesta3','$this->respuesta4','$this->solucion')";
	 	
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update preguntas_examen set id_examen='$this->id_examen', tipo='$this->tipo', pregunta='$this->pregunta', respuesta1='$this->respuesta1', respuesta2='$this->respuesta2', respuesta3='$this->respuesta3', respuesta4='$this->respuesta4', solucion='$this->solucion' where(id='$this->id')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from preguntas_examen where(id='$this->id')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE

public function getPreguntas($id_examen){
	$objDatos = new clsDatos();
		
		$sql= "SELECT * FROM preguntas_examen WHERE id_examen=".$id_examen;
	
		
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getPreguntasExamenPaginacion($id_examen,$itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	
		$sql= "SELECT * FROM preguntas_examen WHERE id_examen=".$id_examen;
		
	$sql=$sql." LIMIT $itemsInicio,$numer_reg ";
	
	
	 $res = $objDatos->filtroListado($sql);
	
	 return $res;
}

public function getProfesorExamenById($id_examen){
	$objDatos = new clsDatos();
	$sql= "SELECT nombre_profesor FROM examenes WHERE id='$id_examen'";
	$res = $objDatos->filtro($sql);
	
	return $res['nombre_profesor'];
}

public function getFechaExamenById($id_examen){
	$objDatos = new clsDatos();
	$sql= "SELECT fecha FROM examenes WHERE id='$id_examen'";
	$res = $objDatos->filtro($sql);
	
	return $res['fecha'];
}

public function getEstadoExamenById($id_examen){
	$objDatos = new clsDatos();
	$sql= "SELECT estado FROM examenes WHERE id='$id_examen'";
	$res = $objDatos->filtro($sql);
	
	return $res['estado'];
}

public function getActivoExamenById($id_examen){
	$objDatos = new clsDatos();
	$sql= "SELECT activo FROM examenes WHERE id='$id_examen'";
	$res = $objDatos->filtro($sql);
	
	return $res['activo'];
}

}

?>