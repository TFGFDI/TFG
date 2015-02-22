<?php
class ClsTraducciones {

public function get_clave(){
		return $this->clave;
	}
	
	public function get_valor(){
		return $this->valor;
	}
	
	public function get_lang(){
		return $this->lang;
	}
	
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
	 $sql = "insert into traducciones(clave,valor,lang) values ('$this->clave','$this->valor','$this->lang')";
	 	 
	 $objDatos->ejecutar($sql);
    

} 

public function editar(){
		$objDatos = new clsDatos();
		$sql = "update traducciones set clave='$this->clave', valor='$this->valor', lang='$this->lang' where(id='$this->id')";
		$objDatos->ejecutar($sql);
		
}
	
	
public function eliminar(){
	$objDatos = new clsDatos();
	$sql = "delete from traducciones where(id='$this->id')";
	$objDatos->ejecutar($sql);
	
}

//FUNCIONES PROPIAS DE LA CLASE	


}
?>