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
	function limpiar(id){
		$('#'+id).val('');
	}
	function calcularNota() {
        checkboxes=document.getElementsByClassName('input_nota');
		var total = 0; var media=0;
        for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
        {
            /*if(checkboxes[i].type == "checkbox") 
            {
                checkboxes[i].checked=source.checked; 
            }*/
			if(checkboxes[i].value==""){
				checkboxes[i].value=0;
			}
			total = parseFloat(total) + parseFloat(checkboxes[i].value);			
        }
		media = total/i;
		$('#nota_desarrollo').val(Math.round(media * 100) / 100);
    }
	
	function anadirNota(id,nota){
		var ar_nota= id.split("_");
		id=ar_nota[1];
		var comentario = $('#editor_'+id).val();
		comentario = comentario + "<br><b>Nota: </b>"+nota;
		$('#editor_'+id).val(comentario);
		
	}
	
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
			
			$examen = new ClsExamenesRealizados();
			$nota = $examen->getNota($id_examen,$id_usuario);
			
			$i=1;//Saber si es una fila par o impar para estilos
			$vacio=true;
			while ($rowEmp = mysqli_fetch_assoc($ar_preguntas)) {
			
			$examen = new ClsPreguntasExamen();
			$pregunta = $examen->getPregunta($rowEmp["id_pregunta"]);
			?>
			<?php if ($rowEmp["solucion"]=="Desarrollo"){?>
			<div class="pregunta">
				<?php $vacio=false;?>
				<?php echo $i?>
				<section><b><?php echo $pregunta?></b></section>
				<br>
				<textarea class="texto_respuesta" rows="10" cols="80" disabled><?php echo $rowEmp['respuesta']?></textarea>	
				Nota (De 0 a 10): <input type="text" id="nota_<?php echo $rowEmp['id']?>" class="input_nota" onchange="calcularNota();anadirNota(this.id,this.value)" onclick="limpiar(this.id)">
				<br>
				Comentario del profesor:
				<br>
				<textarea name="comentario_<?php echo $rowEmp['id']?>" id="editor_<?php echo $rowEmp['id']?>"  rows="10" cols="80"></textarea>
			</div>
			<?php }?>
			
			<?php 
				$i++;
			}//fin while?>
			<?php if(!$vacio){?>
			<section class="aviso">
				<span><b>Nota de test: </b> <?php echo $nota?></span>
				<br>
				<span><b>Nota de desarrollo: </b><input type="text" name="nota_desarrollo" id="nota_desarrollo"></span>
			</section>
			<?php }?>
			
			<?php if($vacio){?>
			<section class="aviso">
				<span><b>Este modelo de examen no tiene preguntas a desarrollar y se corrige automáticamente. </b></span>
			</section>
			<?php }?>
		<input type="submit" value="Ok" style="margin:5px">
		</form>
	</div>
	
<?php

require_once("bottom.php"); 

?>