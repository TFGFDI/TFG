<?php
include_once("clsDatos.php");
class clsExamenesRealizados{  

		
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
	 $sql = "insert into examenes_realizados (id_examen,id_usuario,tiempo_ini,tiempo_fin,aciertos, nota,comentarios) values ('$this->id_examen','$this->id_usuario','$this->tiempo_ini','$this->tiempo_fin', '$this->aciertos','$this->nota','$this->comentarios')";
	 	
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update examenes_realizados set id_examen='$this->id_examen', id_usuario='$this->id_usuario', tiempo_ini='$this->tiempo_ini', tiempo_fin='$this->tiempo_fin', aciertos='$this->aciertos', nota='$this->nota', comentarios='$this->comentarios' where(id='$this->id')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from examenes_realizados where(id='$this->id')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE
public function getExamen(){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM examenes_realizados WHERE id_examen='$this->id_examen' AND id_usuario='$this->id_usuario'";
	$res = $objDatos->filtro($sql);
	
	return $res;
}

public function actualizar(){
		$objDatos = new clsDatos();
		$sql = "update examenes_realizados set tiempo_fin='$this->tiempo_fin', aciertos='$this->aciertos', nota='$this->nota' where(id_examen='$this->id_examen' AND id_usuario='$this->id_usuario')";
		
		$objDatos->ejecutar($sql);
		
}

}

?>