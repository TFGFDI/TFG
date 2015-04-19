<?php
include_once("clsDatos.php");
class ClsUtil {

	
public function trad($clave,$lang='es'){
	//Obtiene el valor correspondiente a la clave e idioma dado para las traducciones
	$datos = new clsDatos();
	$conexion=$datos->conexion;
	$sql = "SELECT valor FROM traducciones WHERE clave='$clave' AND lang='$lang'";
	$resultado = mysqli_query($conexion,$sql) or die(mysql_error());	
	$res = mysqli_fetch_assoc($resultado);
	if ($res['valor']==NULL){
		$devuelve = $clave;
	}else{
		$devuelve =$res['valor'];
	}
		
	return $devuelve;
}

public function getURL(){
	//Obtener la url actual SIN parámetros
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	$ar_url=explode('?',$url);
	return $ar_url[0];

}

public function getPagina(){
	//Obtener la url actual SIN parámetros
	$url=$_SERVER['PHP_SELF'];
	$ar_url=explode('/',$url);
	$claves = array_keys($ar_url);
	
	return $ar_url[count($ar_url)-1];

}

public function getURLparametros(){
	//Obtener la url actual para añadir parametros
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	$ar_url=explode('?',$url);
	
	if(count($ar_url)>1){
		$cadena=$url.'&';
	}else{
		$cadena=$ar_url[0].'?';
	}
	
	return $cadena;

}


public function eliminarParametrosURL($url,$parametro){

	list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
	parse_str($qspart, $qsvars);
	unset($qsvars[$parametro]);
	$nuevoqs = http_build_query($qsvars);
	return $urlpart . '?' . $nuevoqs; 

}

static function desinfectar($cad){
		if($cad==NULL){
				$cad="";
		}
		$cad=trim($cad);//Eliminar espacios en blanco al principio y final
		$cad=addslashes($cad);//Escapa caracteres como ' " \ o NULL
		
		return $cad;
	}

/*  te convierte la fecha tipo 04/26/2015 a formato 2015-04-26 Se utiliza en nuevaNoticia */
static function fechaFormato($cad){  
	$vector=explode('/',$cad);
	$f=$vector[2].'-'.$vector[0].'-'.$vector[1];
	return $f;
}

/*  te convierte la fecha tipo 20/06/2015 a formato 2015/04/20 Se utiliza en nuevaNoticia */
static function fechaFormato2($cad){  
	$vector=explode('/',$cad);
	$f=$vector[2].'-'.$vector[1].'-'.$vector[0];
	return $f;
}

/*  te convierte la fecha tipo 2015-06-26 a formato  26/06/2015.  Se utiliza por ejemplo en editarNoticia*/
static function fechaFormato1($cad){  
	$vector=explode('-',$cad);
	$f=$vector[1].'/'.$vector[2].'/'.$vector[0];
	return $f;
}

 //funcion que muestra solo los primeros 20 caracteres de una cadena
static function reducirCadena($cad){
	$resumen;
	if(strlen($cad) > 20){
		$resumen= substr($cad, 0, 20)." ....";
	}else{
		$resumen=$cad;
	}
	return $resumen;
 }
 
static function reducirCadenaMedia($cad){
 
	$resumen;
	if(strlen($cad) > 45){
		$resumen= substr($cad, 0, 45)." ....";
	}else{
		$resumen=$cad;
	}
	return $resumen;
 }
 
 static function reducirCadenaLarga($cad){
 
	$resumen;
	if(strlen($cad) > 60){
		$resumen= substr($cad, 0, 60)." ....";
	}else{
		$resumen=$cad;
	}
	return $resumen;
 }
	
public function getNacionalidades(){
$nacionalidades = array(
        'Afghan',
        'Albanian',
        'Algerian',
        'American',
        'Andorran',
        'Angolan',
        'Antiguans',
        'Argentinean',
        'Armenian',
        'Australian',
        'Austrian',
        'Azerbaijani',
        'Bahamian',
        'Bahraini',
        'Bangladeshi',
        'Barbadian',
        'Barbudans',
        'Batswana',
        'Belarusian',
        'Belgian',
        'Belizean',
        'Beninese',
        'Bhutanese',
        'Bolivian',
        'Bosnian',
        'Brazilian',
        'British',
        'Bruneian',
        'Bulgarian',
        'Burkinabe',
        'Burmese',
        'Burundian',
        'Cambodian',
        'Cameroonian',
        'Canadian',
        'Cape Verdean',
        'Central African',
        'Chadian',
        'Chilean',
        'Chinese',
        'Colombian',
        'Comoran',
        'Congolese',
        'Costa Rican',
        'Croatian',
        'Cuban',
        'Cypriot',
        'Czech',
        'Danish',
        'Djibouti',
        'Dominican',
        'Dutch',
        'East Timorese',
        'Ecuadorean',
        'Egyptian',
        'Emirian',
        'Equatorial Guinean',
        'Eritrean',
        'Estonian',
        'Ethiopian',
        'Fijian',
        'Filipino',
        'Finnish',
        'French',
        'Gabonese',
        'Gambian',
        'Georgian',
        'German',
        'Ghanaian',
        'Greek',
        'Grenadian',
        'Guatemalan',
        'Guinea-Bissauan',
        'Guinean',
        'Guyanese',
        'Haitian',
        'Herzegovinian',
        'Honduran',
        'Hungarian',
        'I-Kiribati',
        'Icelander',
        'Indian',
        'Indonesian',
        'Iranian',
        'Iraqi',
        'Irish',
        'Israeli',
        'Italian',
        'Ivorian',
        'Jamaican',
        'Japanese',
        'Jordanian',
        'Kazakhstani',
        'Kenyan',
        'Kittian and Nevisian',
        'Kuwaiti',
        'Kyrgyz',
        'Laotian',
        'Latvian',
        'Lebanese',
        'Liberian',
        'Libyan',
        'Liechtensteiner',
        'Lithuanian',
        'Luxembourger',
        'Macedonian',
        'Malagasy',
        'Malawian',
        'Malaysian',
        'Maldivan',
        'Malian',
        'Maltese',
        'Marshallese',
        'Mauritanian',
        'Mauritian',
        'Mexican',
        'Micronesian',
        'Moldovan',
        'Monacan',
        'Mongolian',
        'Moroccan',
        'Mosotho',
        'Motswana',
        'Mozambican',
        'Namibian',
        'Nauruan',
        'Nepalese',
        'New Zealander',
        'Nicaraguan',
        'Nigerian',
        'Nigerien',
        'North Korean',
        'Northern Irish',
        'Norwegian',
        'Omani',
        'Pakistani',
        'Palauan',
        'Panamanian',
        'Papua New Guinean',
        'Paraguayan',
        'Peruvian',
        'Polish',
        'Portuguese',
        'Qatari',
        'Romanian',
        'Russian',
        'Rwandan',
        'Saint Lucian',
        'Salvadoran',
        'Samoan',
        'San Marinese',
        'Sao Tomean',
        'Saudi',
        'Scottish',
        'Senegalese',
        'Serbian',
        'Seychellois',
        'Sierra Leonean',
        'Singaporean',
        'Slovakian',
        'Slovenian',
        'Solomon Islander',
        'Somali',
        'South African',
        'South Korean',
        'Spanish',
        'Sri Lankan',
        'Sudanese',
        'Surinamer',
        'Swazi',
        'Swedish',
        'Swiss',
        'Syrian',
        'Taiwanese',
        'Tajik',
        'Tanzanian',
        'Thai',
        'Togolese',
        'Tongan',
        'Trinidadian/Tobagonian',
        'Tunisian',
        'Turkish',
        'Tuvaluan',
        'Ugandan',
        'Ukrainian',
        'Uruguayan',
        'Uzbekistani',
        'Venezuelan',
        'Vietnamese',
        'Welsh',
        'Yemenite',
        'Zambian',
        'Zimbabwean'
);

return $nacionalidades;
}
}
?>