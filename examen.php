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

	
</script>
	<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
		<?php require_once("menu_alumno.php"); ?>
		
		<?php 
			$examen = new ClsExamenes();
			$tiempo = $examen->getTiempoExamenActivo();
			
			
		?>
		<?php echo $util->trad("duracion_examen",$lang);?>: <?php echo $tiempo?> min
		<br>
		<?php echo $util->trad("inicio_examen",$lang);?>: <?php echo $_SESSION['inicio_examen']?>
		<form name="formulario" method="post" action="do.php">
		<input type="hidden" name="op" value="acabar_examen">
		<?php
			$preguntas = new ClsPreguntasExamen();
			$id_examen = $examen->getExamenActivo();
			$ar_preguntas = $preguntas->getPreguntas($id_examen);
			
			$i=1;//Saber si es una fila par o impar para estilos
			while ($rowEmp = mysqli_fetch_assoc($ar_preguntas)) {
			
			
		?>
		<div class="pregunta">
			<?php echo $i?>
			<section><b><?php echo $rowEmp["pregunta"]?></b></section>
					
			<?php if ($rowEmp["tipo"]=="Test"){?>
			<section class="respuesta">
				<input type="radio" name="<?php echo $rowEmp['id']?>" value="a"><span><?php echo $rowEmp['respuesta1']?></span><br>
				<input type="radio" name="<?php echo $rowEmp['id']?>" value="b"><span><?php echo $rowEmp['respuesta2']?></span><br>
				<input type="radio" name="<?php echo $rowEmp['id']?>" value="c"><span><?php echo $rowEmp['respuesta3']?></span><br>
				<input type="radio" name="<?php echo $rowEmp['id']?>" value="d"><span><?php echo $rowEmp['respuesta4']?></span><br>
			</section>
			<?php }else if ($rowEmp["tipo"]=="Desarrollo"){?>
			<br>
				<textarea name="<?php echo $rowEmp['id']?>" id="editor_<?php echo $rowEmp['id']?>" rows="10" cols="80"></textarea>
			<?php }?>
		</div>
		
		
		<?php 
			$i++;
		}//fin while?>
		<input type="submit" value="Enviar">
		</form>
	</div>
	
<?php

require_once("bottom.php"); 

?>