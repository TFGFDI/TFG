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
	 $sql = "insert into examenes_realizados (id_examen,id_usuario,tiempo_ini,tiempo_fin,aciertos, nota, nota_desarrollo, corregido,expirado,comentarios) values ('$this->id_examen','$this->id_usuario','$this->tiempo_ini','$this->tiempo_fin', '$this->aciertos','$this->nota','$this->nota_desarrollo','$this->corregido','$this->expirado','$this->comentarios')";
	 	var_dump($sql);
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update examenes_realizados set id_examen='$this->id_examen', id_usuario='$this->id_usuario', tiempo_ini='$this->tiempo_ini', tiempo_fin='$this->tiempo_fin', aciertos='$this->aciertos', nota='$this->nota', nota_desarrollo='$this->nota_desarrollo', corregido='$this->corregido', expirado='$this->expirado',comentarios='$this->comentarios' where(id='$this->id')";
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

public function puedeExaminarse($examen,$usuario){
	$objDatos = new clsDatos();
	$puede=false;
	$sql= "SELECT count(*) as total FROM examenes_realizados WHERE id_examen='$examen' AND id_usuario='$usuario'";
	$res = $objDatos->filtro($sql);
	if($res['total']==0){
		$puede=true;
	}
	return $puede;
}

public function getPendientesCorregir(){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM examenes_realizados WHERE corregido=0";
	$res = $objDatos->filtroListado($sql);
	
	return $res;
}

public function getPendientesCorregirPaginacion($itemsInicio,$numer_reg){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM examenes_realizados WHERE corregido=0 LIMIT $itemsInicio,$numer_reg";
	$res = $objDatos->filtroListado($sql);
	
	return $res;
}


public function corregido($examen,$usuario){
	$objDatos = new clsDatos();
	$sql = "UPDATE examenes_realizados SET corregido=1 WHERE id_examen='$examen' AND id_usuario='$usuario'";
	$objDatos->ejecutar($sql);
}

public function expirado($examen,$usuario){
	$objDatos = new clsDatos();
	$sql = "UPDATE examenes_realizados SET expirado=1 WHERE id_examen='$examen' AND id_usuario='$usuario'";
	$objDatos->ejecutar($sql);
}

public function getExamenesAlumno($id_usuario){
	$objDatos = new clsDatos();
	$sql= "SELECT * FROM examenes_realizados WHERE id_usuario=$id_usuario";
	$res = $objDatos->filtroListado($sql);
	
	return $res;
}

public function calcularTiempo($ini,$fin){
	$ar_ini = explode(' ',$ini);
	$ar_fin = explode(' ',$fin);
	$datetime1 = new DateTime($ar_ini[1]);
	$datetime2 = new DateTime($ar_fin[1]);
	$interval = $datetime1->diff($datetime2);	
	echo $interval->format('%i minutos, %s segundos');
}

public function getNota($examen,$usuario){
	$objDatos = new clsDatos();
	$sql= "SELECT nota FROM examenes_realizados WHERE id_usuario=$usuario AND id_examen=$examen";
	$res = $objDatos->filtro($sql);
	
	return $res['nota'];
}

public function setNotaDesarrollo($examen,$usuario,$nota){
	$objDatos = new clsDatos();
	$sql= "UPDATE examenes_realizados SET nota_desarrollo=$nota WHERE id_examen='$examen' AND id_usuario='$usuario'";
	$res = $objDatos->filtro($sql);
	
	return $res['nota'];
}
public function getNotaBloque($from,$to){
	$objDatos = new clsDatos();
	$sql= "SELECT COUNT(*) as nota FROM examenes_realizados WHERE nota>='$from' AND nota<='$to'";
	$res = $objDatos->filtro($sql);
	
	return $res['nota'];
}

public function getMedia(){
	$objDatos = new clsDatos();
	$sql= "SELECT AVG(nota) as nota FROM examenes_realizados";
	$res = $objDatos->filtro($sql);
	
	return round($res['nota'],2);
}

public function getVarianza(){
	$objDatos = new clsDatos();
	$sql= "SELECT nota FROM examenes_realizados";
	$res = $objDatos->filtroListado($sql);
	
	while ($rowEmp = mysqli_fetch_assoc($res)) { 
		$ar_notas[]=$rowEmp['nota'];
	}
	$varianza = stats_variance($ar_notas); var_dump($varianza);
	return $varianza;
	
	
}

}

?>