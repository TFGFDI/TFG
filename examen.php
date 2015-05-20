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
	countdown('contador');
} );

	
</script>
<?php
	$examen = new ClsExamenes();
			
	$inicio = $_SESSION['inicio_examen'];
	
	$tiempo = $examen->getTiempoExamenActivo();
	$nuevafecha = strtotime ( '+'.$tiempo.' minute' , strtotime ( $inicio ) ) ;
	//$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
	$nuevafecha = date ( 'YmdHis' , $nuevafecha );
	
?>


<script>
function countdown(id){
	var t_final = <?php echo $nuevafecha?>;
	
	t_final = t_final.toString();
	
	var a_final = t_final.substr(0,4);
	var m_final = t_final.substring(4,6);
	var d_final = t_final.substring(6,8);
	var h_final = t_final.substring(8,10);
	var mm_final = t_final.substring(10,12);
	var s_final = t_final.substring(12,14);
	
    var fecha=new Date(a_final,m_final,d_final,h_final,mm_final,s_final,'00');
    var hoy=new Date();
    var dias=0;
    var horas=0;
    var minutos=0;
    var segundos=0;

    if (fecha>hoy){
        var diferencia=(fecha.getTime()-hoy.getTime())/1000;
        dias=Math.floor(diferencia/86400);
        diferencia=diferencia-(86400*dias);
        horas=Math.floor(diferencia/3600);
        diferencia=diferencia-(3600*horas);
        minutos=Math.floor(diferencia/60);
        diferencia=diferencia-(60*minutos);
        segundos=Math.floor(diferencia);

        document.getElementById(id).innerHTML='Queda ' + horas + ' Horas, ' + minutos + ' Minutos, ' + segundos + ' Segundos';

        if ( horas>0 || minutos>0 || segundos>0){
            setTimeout("countdown(\"" + id + "\")",1000);
        }else{
			alert('Tiempo expirado. Contacte con un profesor');
			$('#boton_envio').hide();
		}
    }
    else{
		
        document.getElementById('restante').innerHTML='Quedan ' + horas + ' Horas, ' + minutos + ' Minutos, ' + segundos + ' Segundos';
    }
}
</script>

	<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
		<?php require_once("menu_alumno.php"); ?>
		
	
		
		<?php echo $util->trad("duracion_examen",$lang);?>: <?php echo $tiempo?> min
		<br>
		<?php echo $util->trad("inicio_examen",$lang);?>: <?php echo $_SESSION['inicio_examen']?>
		<br>
		<div id="contador"></div>
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
		<input type="submit" value="Enviar" id="boton_envio">
		</form>
	</div>
	
<?php

require_once("bottom.php"); 

?>