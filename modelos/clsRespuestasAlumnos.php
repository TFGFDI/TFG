<?php
include_once("clsDatos.php");
class clsRespuestasAlumnos{  

		
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
	 $sql = "insert into respuestas_alumnos (id_examen_realizado,id_pregunta,id_usuario,respuesta,solucion,comentarios) values ('$this->id_examen_realizado','$this->id_pregunta','$this->id_usuario','$this->respuesta','$this->solucion','$this->comentarios')";
	 	
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update respuestas_alumnos set id_examen_realizado='$this->id_examen_realizado', id_pregunta='$this->id_pregunta', id_usuario='$this->id_usuario', respuesta='$this->respuesta', solucion='$this->solucion', comentarios='$this->comentarios' where(id='$this->id')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from respuestas_alumnos where(id='$this->id')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE
public function getAciertos($id_usuario, $id_examen){
	$objDatos = new clsDatos();
	$sql = "SELECT COUNT(*) as total  FROM respuestas_alumnos WHERE id_usuario='$id_usuario' AND id_examen_realizado = '$id_examen' AND respuesta=solucion AND solucion <> 'Desarrollo'";
	
	$res = $objDatos->filtro($sql);
	
	return $res["total"];
}

}

?>