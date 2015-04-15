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
		<?php require_once("menu_profesor.php"); ?>
				
		<form name="formulario" method="post" action="do.php">
		<input type="hidden" name="op" value="corregir">
		<input type="hidden" name="id_examen" value="<?php echo $dict['id_examen']?>">
		<input type="hidden" name="id_usuario" value="<?php echo $dict['id_usuario']?>">
		<?php
			$respuestas = new ClsRespuestasAlumnos();
			$id_examen = $dict['id_examen'];
			$id_usuario = $dict['id_usuario'];
			$ar_preguntas = $respuestas->getRespuestas($id_examen,$id_usuario);
			
			$i=1;//Saber si es una fila par o impar para estilos
			while ($rowEmp = mysqli_fetch_assoc($ar_preguntas)) {
			
			$examen = new ClsPreguntasExamen();
			$pregunta = $examen->getPregunta($rowEmp["id_pregunta"]);
		?>
		<?php if ($rowEmp["solucion"]=="Desarrollo"){?>
		<div class="pregunta">
					
			
			<?php echo $i?>
			<section><b><?php echo $pregunta?></b></section>
			<br>
			<textarea rows="10" cols="80" disabled><?php echo $rowEmp['respuesta']?></textarea>	
			<br>
			Comentario del profesor:
			<br>
			<textarea name="comentario_<?php echo $rowEmp['id']?>" id="editor_<?php echo $rowEmp['id']?>"  rows="10" cols="80"></textarea>
		</div>
		<?php }?>
		
		<?php 
			$i++;
		}//fin while?>
		<?php if($rowEmp==NULL){?>
		<section class="aviso">
			<span><b>Este modelo de examen no tiene preguntas a desarrollar y se corrige automáticamente. </b></span>
		</section>
		<?php }?>
		<input type="submit" value="Ok">
		</form>
	</div>
	
<?php

require_once("bottom.php"); 

?>