<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 
?>

	<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
		<?php require_once("menu_alumno.php"); ?>
	</div>
	
<?php

require_once("bottom.php"); 

?>