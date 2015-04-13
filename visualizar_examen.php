<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("clases.php"); 
require_once("top.php"); 
?>
 <script>    
	$( document ).ready( function() {
	$('[id^=editor]').ckeditor();	
} );

	function volver(){
		location.href="historial_examenes.php";
	}
</script>
	<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
		<?php require_once("menu_profesor.php"); ?>	
		<?php
			$preguntas = new ClsPreguntasExamen();
			$id_examen = $dict['id'];
			$ar_preguntas = $preguntas->getPreguntas($id_examen);
			
			$i=1;//Saber si es una fila par o impar para estilos
			while ($rowEmp = mysqli_fetch_assoc($ar_preguntas)) {
			
			
		?>
		<div class="pregunta">
			<?php echo $i?>
			<section><b><?php echo $rowEmp["pregunta"]?></b></section>
					
			<?php if ($rowEmp["tipo"]=="Test"){?>
			<section class="respuesta">
				<input type="radio" <?php if ($rowEmp['solucion']=='a'){?>checked <?php }?> disabled><span><?php echo $rowEmp['respuesta1']?></span><br>
				<input type="radio" <?php if ($rowEmp['solucion']=='b'){?>checked <?php }?> disabled><span><?php echo $rowEmp['respuesta2']?></span><br>
				<input type="radio" <?php if ($rowEmp['solucion']=='c'){?>checked <?php }?> disabled><span><?php echo $rowEmp['respuesta3']?></span><br>
				<input type="radio" <?php if ($rowEmp['solucion']=='d'){?>checked <?php }?> disabled><span><?php echo $rowEmp['respuesta4']?></span><br>
			</section>
			<?php }else if ($rowEmp["tipo"]=="Desarrollo"){?>
			<br>
				<span>Pregunta de desarrollo libre</span>
			<?php }?>
		</div>
		
		
		<?php 
			$i++;
		}//fin while?>
		<input type="button" value="volver" onclick="volver()">
		
	</div>
	
<?php

require_once("bottom.php"); 

?>