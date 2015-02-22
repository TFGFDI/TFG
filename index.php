<?php 
session_start();
include_once("modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 
?>

	<div id="central">
		
	</div>
	
<?php

require_once("bottom.php"); 

?>