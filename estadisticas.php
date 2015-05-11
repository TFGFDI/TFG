<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 

?>

	<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
	<?php require_once("menu_profesor.php");  ?>
		<section class="bloquecompleto bloqueRedondeado">
			<div id="sexo">				
				<iframe src="estadisticas_sexo.php" style="border:0;height: 350px"></iframe>
				<iframe src="estadisticas_notas.php" style="border:0;height: 350px;width:600px;"></iframe>
			</div>
			<div id="paises">		
				<iframe src="estadisticas_paises.php" style="border:0;height: 420px;width:940px;"></iframe>
			</div>
		</section>
	</div>
	
<?php

require_once("bottom.php"); 

?>