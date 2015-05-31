<?php 
session_start();
include_once("modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 
?>

	<div id="central1" style="height:300px;"> 
		<?php 
		if($_SESSION['rol']=='E'){
			require_once("menu_alumno.php");
		}else if($_SESSION['rol']=='P'){
			require_once("menu_profesor.php");
		}
		?>
		
		
	</div>
	
<?php

require_once("bottom.php"); 

?>

